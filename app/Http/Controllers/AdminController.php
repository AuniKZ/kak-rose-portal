<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use App\Models\IntakeForm;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['user', 'service', 'intakeForm'])
            ->latest()
            ->get();

        // 1. Fetch Users who are NOT admins
        $clients = User::where('is_admin', false)
            ->where(function ($query) {
                $query->whereHas('appointments')
                    ->orWhere('role', 'client');
            })
            ->withCount('appointments')
            ->latest()
            ->get();

        // 2. Fallback to IntakeForm if no non-admin User records exist
        if ($clients->isEmpty()) {
            $clients = IntakeForm::latest()
                ->get()
                ->map(function ($form) {
                    return (object) [
                        'id' => $form->id,
                        'name' => $form->full_name ?? $form->name ?? 'Client #' . $form->id,
                        'email' => $form->email ?? 'N/A',
                        'phone' => $form->phone_number ?? $form->phone ?? 'N/A',
                        'is_postpartum' => $form->is_postpartum ?? false,
                        'appointments_count' => 1,
                    ];
                });
        }

        // 3. Identify Unique Critical Health Condition Clients (3+ Soreness/Pain Areas)
        $criticalClients = $clients->filter(function ($client) {
            // Check if $client is a User model instance
            if ($client instanceof User) {
                // Fetch the client's latest intake form through appointments
                $latestIntake = IntakeForm::whereHas('appointment', function ($q) use ($client) {
                    $q->where('user_id', $client->id);
                })->latest()->first();
            } else {
                // Fallback object from IntakeForm
                $latestIntake = IntakeForm::find($client->id);
            }

            if (!$latestIntake || empty($latestIntake->soreness_areas)) {
                return false;
            }

            $soreness = $latestIntake->soreness_areas;
            if (is_string($soreness)) {
                $areas = array_filter(array_map('trim', explode(',', $soreness)));
            } elseif (is_array($soreness)) {
                $areas = array_filter($soreness);
            } else {
                $areas = [];
            }

            return count($areas) >= 3;
        });

        $criticalCount = $criticalClients->count();

        $completedAppointments = $appointments->where('status', 'completed');

        $totalSales = $completedAppointments->sum(fn($app) => (float) ($app->service->price ?? 0));
        $monthlySales = $completedAppointments->filter(function ($app) {
            $date = Carbon::parse($app->updated_at ?? $app->appointment_date ?? $app->created_at);
            return $date->isCurrentMonth();
        })->sum(fn($app) => (float) ($app->service->price ?? 0));

        $completedCount = $completedAppointments->count();

        return view('admin.dashboard', compact(
            'appointments',
            'clients',
            'totalSales',
            'monthlySales',
            'completedCount',
            'criticalCount',
            'criticalClients'
        ));
    }

    public function revenue(Request $request)
    {
        $period = $request->get('period', 'month');

        $query = Appointment::with(['user', 'service'])
            ->where('status', 'completed');

        $allCompleted = $query->latest()->get();

        // Reference date logic based on latest record timestamp
        $latestApp = $allCompleted->first();
        $refDate = $latestApp ? Carbon::parse($latestApp->appointment_date ?? $latestApp->start_time ?? $latestApp->created_at) : Carbon::now();

        if ($period === 'day') {
            $completedAppointments = $allCompleted->filter(function ($app) use ($refDate) {
                $d = Carbon::parse($app->appointment_date ?? $app->start_time ?? $app->created_at);
                return $d->isSameDay($refDate);
            });
        } elseif ($period === 'week') {
            $completedAppointments = $allCompleted->filter(function ($app) use ($refDate) {
                $d = Carbon::parse($app->appointment_date ?? $app->start_time ?? $app->created_at);
                return $d->isSameWeek($refDate);
            });
        } elseif ($period === 'month') {
            $completedAppointments = $allCompleted->filter(function ($app) use ($refDate) {
                $d = Carbon::parse($app->appointment_date ?? $app->start_time ?? $app->created_at);
                return $d->isSameMonth($refDate);
            });
        } elseif ($period === 'year') {
            $completedAppointments = $allCompleted->filter(function ($app) use ($refDate) {
                $d = Carbon::parse($app->appointment_date ?? $app->start_time ?? $app->created_at);
                return $d->isSameYear($refDate);
            });
        } elseif ($period === 'range' && $request->filled('start_date') && $request->filled('end_date')) {
            $start = Carbon::parse($request->start_date)->startOfDay();
            $end = Carbon::parse($request->end_date)->endOfDay();
            $completedAppointments = $allCompleted->filter(function ($app) use ($start, $end) {
                $d = Carbon::parse($app->appointment_date ?? $app->start_time ?? $app->created_at);
                return $d->between($start, $end);
            });
        } else {
            $completedAppointments = $allCompleted;
        }

        $totalRevenue = (float) $completedAppointments->sum(fn($a) => $a->service->price ?? 0);
        $totalTransactions = $completedAppointments->count();
        $averageTicket = $totalTransactions > 0 ? $totalRevenue / $totalTransactions : 0;

        $serviceBreakdown = $completedAppointments
            ->groupBy(fn($a) => $a->service->title ?? $a->service->name ?? 'General Treatment')
            ->map(function ($group) {
                return [
                    'count' => $group->count(),
                    'total' => (float) $group->sum(fn($a) => $a->service->price ?? 0),
                ];
            });

        // Dynamic chart formatting based on selected period
        $timelineData = [];
        foreach ($completedAppointments as $app) {
            $rawDate = $app->appointment_date ?? $app->start_time ?? $app->created_at;
            $carbonDate = Carbon::parse($rawDate);

            if ($period === 'day') {
                $key = $carbonDate->format('h:i A');
            } elseif ($period === 'week' || $period === 'month') {
                $key = $carbonDate->format('d M');
            } else {
                $key = $carbonDate->format('M Y');
            }

            $price = (float) ($app->service->price ?? 0);
            $timelineData[$key] = ($timelineData[$key] ?? 0) + $price;
        }

        uksort($timelineData, function ($a, $b) {
            return strtotime($a) - strtotime($b);
        });

        $chartLabels = array_keys($timelineData);
        $chartValues = array_values($timelineData);

        return view('admin.revenue-index', compact(
            'completedAppointments',
            'totalRevenue',
            'totalTransactions',
            'averageTicket',
            'serviceBreakdown',
            'chartLabels',
            'chartValues',
            'period'
        ));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $appointment->status = $request->status;

        if ($request->status === 'cancelled') {
            $appointment->cancellation_reason = $request->cancellation_reason ?? 'Cancelled by admin';
        }

        $appointment->save();

        return back()->with('success', 'Appointment status updated to ' . ucfirst($request->status));
    }
}