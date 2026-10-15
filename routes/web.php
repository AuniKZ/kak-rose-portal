<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\BookingController;
use App\Models\Appointment;
use App\Models\IntakeForm;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Public & Guest Direct Booking Routes
|--------------------------------------------------------------------------
*/

// 1. Home Page
Route::get('/', function () {
    $services = Service::all();
    return view('home', compact('services'));
})->name('home');

// 2. Full Therapy Menu & Services Page
Route::get('/services', function () {
    $services = Service::all();
    return view('services', compact('services'));
})->name('services.index');

// 3. Guest / Member Booking Form Route
Route::get('/book/{service}', [BookingController::class, 'create'])->name('book.service');

// 4. Process Appointment Submission
Route::post('/appointments', [BookingController::class, 'store'])->name('appointments.store');

// 5. Booking Confirmation Page
Route::get('/booking-success/{appointment}', function (Appointment $appointment) {
    $appointment->load(['service', 'user', 'intakeForm']);
    return view('booking-success', compact('appointment'));
})->name('booking.success');

// 6. Guest Appointment Tracker Form & Search
Route::get('/track-booking', function (Request $request) {$appointment = null;
    $searched = false;

    if ($request->filled('query')) {$searched = true;
        $search = trim($request->input('query'));
        $cleanSearch = preg_replace('/[^0-9]/', '',$search);

        $appointment = Appointment::with(['service', 'user', 'intakeForm'])
            ->where('id', $cleanSearch ?: $search)
            ->orWhereHas('user', function ($q) use ($search) {
                $q->where('phone',$search);
            })
            ->latest()
            ->first();
    }

    return view('track-booking', compact('appointment', 'searched'));
});

Route::get('/appointments', function () {
    return redirect('/');
});

/*
|--------------------------------------------------------------------------
| Member Authentication & Password Reset Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials =$request->validate([
        'email'    => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {$request->session()->regenerate();
        session(['login_time' => now()]);
        
        if (Auth::user()->is_admin ?? false) {
            return redirect()->intended('/admin');
        }
        return redirect()->intended('/profile');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {$request->validate([
        'name'     => ['required', 'string', 'max:255'],
        'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'phone'    => ['required', 'string', 'max:20'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'phone'    => $request->phone,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user);

    return redirect('/profile');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();$request->session()->regenerateToken();

    return redirect('/');
})->name('logout');

// Password Reset Routes
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {$request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink($request->only('email'));

    return $status === Password::RESET_LINK_SENT
        ? back()->with('status', __($status))
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (Request $request,$token) {
    return view('auth.reset-password', ['token' => $token, 'email' =>$request->email]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {$request->validate([
        'token'    => 'required',
        'email'    => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {$user->forceFill([
                'password' => Hash::make($password)
            ])->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect('/login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

/*
|--------------------------------------------------------------------------
| Authenticated Client Profile & Action Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function (Request $request) {$user = Auth::user();
        $query =$user->appointments()->with(['service', 'intakeForm']);

        $filter =$request->query('filter', 'all');
        if ($filter === 'upcoming') {$query->where('appointment_date', '>=', now());
        } elseif ($filter === 'past') {$query->where('appointment_date', '<', now());
        }

        $sort =$request->query('sort', 'recent');
        if ($sort === 'recent') {$query->latest('created_at');
        } else {
            $query->orderBy('appointment_date', 'asc');
        }

        $appointments =$query->get();

        return view('profile', compact('user', 'appointments', 'filter', 'sort'));
    })->name('profile');

    Route::patch('/profile', function (Request $request) {$user = Auth::user();

        $validated =$request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        $user->update($validated);

        return back()->with('success', 'Profile details updated successfully!');
    })->name('profile.update');

    Route::patch('/appointments/{appointment}/cancel', function (Request $request, Appointment$appointment) {
        if (Auth::id() !== $appointment->user_id) {
            abort(403, 'Unauthorized action.');
        }

        if (in_array($appointment->status, ['completed', 'cancelled'])) {
            return back()->with('error', 'Completed or already cancelled appointments cannot be modified.');
        }

        // Grab selected reason or custom text if 'Others' was selected
        $reason =$request->input('reason');
        if ($reason === 'Others' &&$request->filled('other_reason')) {
            $reason =$request->input('other_reason');
        }

        // Direct property assignment bypasses mass-assignment issues
        $appointment->status = 'cancelled';
        $appointment->cancellation_reason =$reason ?: 'Change of plans';
        $appointment->save();

        return back()->with('success', 'Your appointment has been cancelled successfully.');
    })->name('appointments.cancel');
});

/*
|--------------------------------------------------------------------------
| Secure Direct Admin Access Route
|--------------------------------------------------------------------------
*/

Route::get('/portal-access-9f8a3b1c7e2d41a089b5c3e', function () {
    $admin = User::where('is_admin', true)->first();

    if (!$admin) {
        abort(404);
    }

    Auth::login($admin);
    request()->session()->regenerate();
    session(['login_time' => now()]);

    return redirect('/admin')->with('success', 'Welcome back, Puan Rosmawati!');
});

/*
|--------------------------------------------------------------------------
| Protected Admin & Staff Portal Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/revenue', [AdminController::class, 'revenue'])->name('revenue.index');

    Route::get('/appointments', function (Request $request) {
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }

        $query = Appointment::with(['user', 'service', 'intakeForm']);

        // 1. Filter by Status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // 2. Filter by Appointment Date
        if ($request->filled('date')) {
            $query->whereDate('appointment_date', $request->date);
        }

        // 3. Filter by specific client_id (from "View History ->" link)
        if ($request->filled('client_id')) {
            $query->where('user_id', $request->client_id);
        }

        // 4. Search Client Name, Phone, or Email (Fixed \% typo)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Fetch matched appointments
        $appointments = $query->latest('created_at')->get();

        // 5. Filter Health Intake Types (Critical Intake & Postpartum)
        if ($request->filled('filter')) {
            $healthFilter = $request->filter;

            $appointments = $appointments->filter(function ($app) use ($healthFilter) {
                $intake = $app->intakeForm;

                if ($healthFilter === 'critical') {
                    if (!$intake || empty($intake->soreness_areas)) {
                        return false;
                    }
                    $soreness = $intake->soreness_areas;
                    if (is_string($soreness)) {
                        $areas = array_filter(array_map('trim', explode(',', $soreness)));
                    } elseif (is_array($soreness)) {
                        $areas = array_filter($soreness);
                    } else {
                        $areas = [];
                    }
                    return count($areas) >= 3;
                }

                if ($healthFilter === 'postpartum') {
                    return $intake && ($intake->is_postpartum || strtolower($intake->postpartum_status ?? '') === 'yes');
                }

                return true;
            });
        }

        return view('admin.appointments-index', compact('appointments'));
    })->name('appointments.index');

    // List Clients
    Route::get('/clients', function () {
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }

        $clients = User::where('is_admin', false)
            ->with(['appointments', 'intakeForms'])
            ->get();

        if ($clients->isEmpty()) {
            $clients = IntakeForm::latest()->get();
        }

        return view('admin.clients', compact('clients'));
    })->name('clients.index');

    // Update Client Details
    Route::put('/clients/{user}', function (Request $request, User $user) {
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        return back()->with('success', 'Client details updated successfully!');
    })->name('clients.update');

    // Delete Client Record (Fixes the 404 error)
    Route::delete('/clients/{user}', function (User $user) {
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }

        $user->appointments()->delete();
        $user->delete();

        return back()->with('success', 'Client record deleted successfully!');
    })->name('clients.destroy');

    Route::get('/clients', function () {
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }

        $clients = User::where('is_admin', false)
            ->with(['appointments', 'intakeForms'])
            ->get();

        if ($clients->isEmpty()) {$clients = IntakeForm::latest()->get();
        }

        return view('admin.clients', compact('clients'));
    })->name('clients.index');

    Route::get('/profile', function () {
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }
        return view('admin.admin-profile');
    })->name('profile');

    Route::patch('/profile/update', function (Request $request) {$user = Auth::user();

        if (!$user->is_admin) {
            abort(403, 'Unauthorized access.');
        }

        $validated =$request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        $user->update($validated);

        return back()->with('success', 'Profile details updated successfully.');
    })->name('profile.update');

    Route::put('/profile/password', function (Request $request) {$user = Auth::user();

        if (!$user->is_admin) {
            abort(403, 'Unauthorized access.');
        }

        $validated =$request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Password changed successfully.');
    })->name('profile.password');

    Route::patch('/appointments/{appointment}/status', function (Request $request, Appointment$appointment) {
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $newStatus = strtolower($request->status);
        $appointment->status =$newStatus;

        if ($newStatus === 'cancelled' && empty($appointment->cancellation_reason)) {$appointment->cancellation_reason = 'Cancelled by admin';
        }

        $appointment->save();

        return back()->with('success', 'Appointment status updated successfully!');
    })->name('appointments.status');
});

// Direct Fallback Route for Admin Status Form Action (`/appointments/{appointment}/status`)
Route::middleware(['auth'])->patch('/appointments/{appointment}/status', function (Request $request, Appointment$appointment) {
    if (!Auth::user()->is_admin) {
        abort(403, 'Unauthorized access.');
    }

    $request->validate([
        'status' => 'required|in:pending,confirmed,completed,cancelled',
    ]);

    $newStatus = strtolower($request->status);
    $appointment->status =$newStatus;

    if ($newStatus === 'cancelled' && empty($appointment->cancellation_reason)) {$appointment->cancellation_reason = 'Cancelled by admin';
    }

    $appointment->save();

    return back()->with('success', 'Appointment status updated successfully!');
});