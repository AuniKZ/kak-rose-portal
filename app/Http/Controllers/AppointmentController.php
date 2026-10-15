<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display the full appointment roster with search, status, and health filters.
     */
    public function index(Request $request)
    {
        $query = Appointment::with(['user', 'service', 'intakeForm']);

        // Filter by Client Search (Name, Email, or Phone)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filter by Appointment Status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by Appointment Date
        if ($request->filled('date')) {
            $query->whereDate('appointment_date', $request->date);
        }

        // Filter by Specific Client ID (from "View History ->" link)
        if ($request->filled('client_id')) {
            $query->where('user_id', $request->client_id);
        }

        $appointments = $query->latest()->get();

        // Handle Health Intake Filters (Critical Intake & Postpartum)
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
    }

    /**
     * Show booking view for members or guests.
     */
    public function create(Service $service)
    {
        $rawAppointments = Appointment::all();

        $bookedSlots = $rawAppointments->filter(function ($app) {
            $status = strtolower($app->status ?? '');
            return in_array($status, ['pending', 'confirmed']);
        })->map(function ($app) {
            $rawDate = $app->appointment_date ?? $app->start_time ?? $app->created_at;
            $date = Carbon::parse($rawDate)->format('Y-m-d');

            $startStr = $app->start_time ?? '09:00:00';
            $fullStart = strlen($startStr) === 8 ? "{$date} {$startStr}" : $startStr;
            $start = Carbon::parse($fullStart);

            $endStr = $app->end_time ?? null;
            $fullEnd = $endStr ? (strlen($endStr) === 8 ? "{$date} {$endStr}" : $endStr) : null;
            $end = $fullEnd ? Carbon::parse($fullEnd) : $start->copy()->addHour();

            return [
                'start'  => $start->format('Y-m-d H:i:s'),
                'end'    => $end->format('Y-m-d H:i:s'),
                'date'   => $date,
                'status' => strtolower($app->status ?? 'pending'),
            ];
        })->values();

        if (Auth::check()) {
            return view('book-service-member', compact('service', 'bookedSlots'));
        }

        return view('book-service-guest', compact('service', 'bookedSlots'));
    }
}