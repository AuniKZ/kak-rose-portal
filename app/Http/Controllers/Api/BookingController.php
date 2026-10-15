<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\IntakeForm;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Render the Blade booking page with active booked slots.
     */
    public function create(Service $service)
    {
        $bookedSlots = Appointment::whereIn('status', ['pending', 'confirmed'])
            ->where('appointment_date', '>=', now()->startOfDay())
            ->get()
            ->map(function ($appointment) {
                $date  = Carbon::parse($appointment->appointment_date)->format('Y-m-d');
                $start = Carbon::parse($appointment->start_time)->format('H:i:s');
                $end   = Carbon::parse($appointment->end_time)->format('H:i:s');

                return [
                    'start'      => "{$date} {$start}",
                    'end'        => "{$date} {$end}",
                    'date'       => $date,
                    'full_start' => "{$date} {$start}",
                    'full_end'   => "{$date} {$end}",
                    'status'     => $appointment->status,
                ];
            })
            ->values();

        if (Auth::check()) {
            return view('book-service-member', compact('service', 'bookedSlots'));
        }

        return view('book-service-guest', compact('service', 'bookedSlots'));
    }

    /**
     * API Endpoint: Return available time slots for a given date & service.
     */
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'date'       => 'required|date',
            'service_id' => 'required|exists:services,id',
        ]);

        $service  = Service::findOrFail($request->service_id);
        $date     = Carbon::parse($request->date)->format('Y-m-d');
        $duration = (int) $service->duration_minutes;

        // Operating hours (8:30 AM - 10:30 PM)
        $operatingStart = Carbon::parse("$date 08:30:00");
        $operatingEnd   = Carbon::parse("$date 22:30:00");

        // Fetch active bookings
        $existingBookings = Appointment::where('appointment_date', $date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->get();

        $availableSlots = [];
        $currentSlot    = $operatingStart->copy();

        while ($currentSlot->copy()->addMinutes($duration)->lte($operatingEnd)) {
            $slotStart = $currentSlot->format('H:i:s');
            $slotEnd   = $currentSlot->copy()->addMinutes($duration)->format('H:i:s');

            $isOverlap = false;
            foreach ($existingBookings as $booking) {
                $bStart = Carbon::parse($booking->start_time)->format('H:i:s');
                $bEnd   = Carbon::parse($booking->end_time)->format('H:i:s');

                if ($slotStart < $bEnd && $slotEnd > $bStart) {
                    $isOverlap = true;
                    break;
                }
            }

            if (!$isOverlap) {
                $availableSlots[] = $currentSlot->format('H:i');
            }

            $currentSlot->addMinutes(30);
        }

        return response()->json(['available_slots' => $availableSlots]);
    }

    /**
     * Store new appointment and client intake info.
     */
    public function store(Request $request)
    {
        $phoneRegex = 'regex:/^(\+?60|0)1[0-9]{8,9}$/';

        // Dynamic validation rules based on Auth state
        $rules = [
            'service_id'              => 'required|exists:services,id',
            'appointment_date'        => 'required',
            'postpartum_status'       => 'nullable|string',
            'soreness_areas'          => 'nullable|array',
            'soreness_details'        => 'nullable|string|max:1000',
            'emergency_contact_name'  => ['required', 'string', 'max:255'],
            'emergency_contact_phone' => ['required', 'string', $phoneRegex],
        ];

        if (!Auth::check()) {
            $rules['client_name']  = 'required|string|max:255';
            $rules['client_phone'] = ['required', 'string', $phoneRegex];
            $rules['client_email'] = 'nullable|email';
        }

        $validated = $request->validate($rules, [
            'client_phone.regex'            => 'Please enter a valid phone number.',
            'emergency_contact_phone.regex' => 'Please enter a valid emergency contact phone number.',
        ]);

        // Auto-create or resolve user
        if (Auth::check()) {
            $userId = Auth::id();
        } else {
            $guestEmail = $validated['client_email'] ?? 'guest_' . time() . '@kakrose.com';

            $user = User::firstOrCreate(
                ['phone' => $validated['client_phone']],
                [
                    'name'     => $validated['client_name'] ?? 'Guest Client',
                    'email'    => $guestEmail,
                    'password' => Hash::make(Str::random(16)),
                    'is_admin' => false,
                ]
            );

            $userId = $user->id;
        }

        $service = Service::findOrFail($validated['service_id']);

        // Normalize appointment time using Carbon
        $startTime       = Carbon::parse($validated['appointment_date']);
        $formattedStart = $startTime->format('H:i:s');
        $formattedEnd   = $startTime->copy()->addMinutes($service->duration_minutes ?? 60)->format('H:i:s');
        $appointmentDate = $startTime->format('Y-m-d');

        // Prevent double booking
        $conflict = Appointment::where('appointment_date', $appointmentDate)
            ->whereIn('status', ['pending', 'confirmed'])
            ->where(function ($query) use ($formattedStart, $formattedEnd) {
                $query->where('start_time', '<', $formattedEnd)
                      ->where('end_time', '>', $formattedStart);
            })->exists();

        if ($conflict) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Selected time slot overlaps with an existing reservation.'], 422);
            }
            return back()->withErrors(['appointment_date' => 'Selected time slot overlaps with an existing reservation.']);
        }

        // Save appointment
        $appointment = Appointment::create([
            'user_id'          => $userId,
            'service_id'       => $service->id,
            'appointment_date' => $appointmentDate,
            'start_time'       => $formattedStart,
            'end_time'         => $formattedEnd,
            'status'           => 'pending',
        ]);

        // Format soreness areas array to string safely
        $selectedAreas = $validated['soreness_areas'] ?? [];
        $formattedAreas = !empty($selectedAreas) ? implode(', ', $selectedAreas) : 'None selected';
        if (!empty($validated['soreness_details'])) {
            $formattedAreas .= ' (Details: ' . $validated['soreness_details'] . ')';
        }

        // Save intake form
        IntakeForm::create([
            'user_id'                 => $userId,
            'appointment_id'          => $appointment->id,
            'postpartum_status'       => $validated['postpartum_status'] ?? 'No',
            'soreness_areas'          => $formattedAreas,
            'emergency_contact_name'  => $validated['emergency_contact_name'],
            'emergency_contact_phone' => $validated['emergency_contact_phone'],
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'message'        => 'Booking created successfully!',
                'appointment_id' => $appointment->id,
            ], 201);
        }

        return redirect()->route('booking.success', $appointment->id);
    }

    /**
     * Admin Endpoint: Update appointment status.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'cancellation_reason' => 'nullable|string|max:255',
        ]);

        $appointment = Appointment::findOrFail($id);
        $newStatus = strtolower($request->status);

        $appointment->status = $newStatus;

        // If admin sets status to cancelled, record the cancellation reason
        if ($newStatus === 'cancelled') {
            $adminReason = $request->input('cancellation_reason');
            $appointment->cancellation_reason = !empty($adminReason) 
                ? 'Cancelled by admin: ' . $adminReason 
                : 'Cancelled by admin';
        }

        $appointment->save();

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Appointment status updated successfully!',
                'status'  => $appointment->status,
                'cancellation_reason' => $appointment->cancellation_reason,
            ]);
        }

        return back()->with('success', 'Appointment status updated successfully!');
    }
}