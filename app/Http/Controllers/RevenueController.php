<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::with(['user', 'service'])
            ->where('status', 'completed');

        // Filter by Date Range if provided
        if ($request->filled('start_date')) {
            $query->whereDate('appointment_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('appointment_date', '<=', $request->end_date);
        }

        $completedAppointments = $query->latest()->get();

        $totalRevenue = $completedAppointments->sum(fn($a) => $a->service->price ?? 0);
        $totalTransactions = $completedAppointments->count();
        $averageTicket = $totalTransactions > 0 ? $totalRevenue / $totalTransactions : 0;

        // Group revenue by service packages for breakdown
        $serviceBreakdown = $completedAppointments->groupBy(fn($a) => $a->service->title ?? 'General Treatment')
            ->map(function ($group) {
                return [
                    'count' => $group->count(),
                    'total' => $group->sum(fn($a) => $a->service->price ?? 0),
                ];
            });

        return view('admin.revenue-index', compact(
            'completedAppointments',
            'totalRevenue',
            'totalTransactions',
            'averageTicket',
            'serviceBreakdown'
        ));
    }
}