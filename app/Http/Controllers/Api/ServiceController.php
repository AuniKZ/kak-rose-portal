<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;

class ServiceController extends Controller
{
    public function create(Service $service)
    {
        // Fetch ONLY pending or confirmed appointments
        $bookedSlots = Appointment::whereIn('status', ['pending', 'confirmed'])
            ->get(['start_time', 'end_time'])
            ->map(function ($appointment) {
                return [
                    'start' => \Carbon\Carbon::parse($appointment->start_time)->format('Y-m-d H:i:s'),
                    'end'   => \Carbon\Carbon::parse($appointment->end_time)->format('Y-m-d H:i:s'),
                ];
            })
            ->values();

        return view('bookings.create', compact('service', 'bookedSlots'));
    }
    
    public function index()
    {
        return response()->json(Service::where('is_active', true)->get());
    }
}
