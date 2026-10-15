@extends('admin.admin')

@section('title', 'Full Appointment Rosters - Kak Rose Admin')

@section('content')
<!-- Header Bar -->
<div class="flex items-center justify-between">
    <div>
        <h2 class="font-serif-title text-3xl font-bold text-[#1B3629]">Full Appointment Rosters</h2>
        <p class="text-[#706B63] text-sm mt-0.5">Filter, track, and manage all client bookings and session statuses.</p>
    </div>
    <span class="bg-[#122A21] text-[#D4AF37] px-4 py-2 rounded-xl text-xs font-bold shadow-sm">
        Total Records: {{ count($appointments) }}
    </span>
</div>

@if(session('success'))
    <div class="p-4 bg-[#E8F5E9] border border-[#A5D6A7] text-[#1B5E20] rounded-xl text-xs font-semibold">
        {{ session('success') }}
    </div>
@endif

<!-- Filter Form -->
<div class="bg-white p-5 rounded-2xl border border-[#E2DDD5] shadow-sm">
    <form method="GET" action="{{ route('admin.appointments.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        
        <!-- Search Client -->
        <div>
            <label class="block text-[11px] font-bold text-[#706B63] mb-1 uppercase tracking-wider">Search Client</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Name, Phone, or Email..." 
                class="w-full text-xs p-2.5 rounded-xl border border-[#E2DDD5] focus:ring-2 focus:ring-[#122A21] outline-none">
        </div>

        <!-- Status Filter -->
        <div>
            <label class="block text-[11px] font-bold text-[#706B63] mb-1 uppercase tracking-wider">Status</label>
            <select name="status" class="w-full text-xs p-2.5 rounded-xl border border-[#E2DDD5] focus:ring-2 focus:ring-[#122A21] outline-none cursor-pointer">
                <option value="all" {{ request('status') === 'all' || !request('status') ? 'selected' : '' }}>All Statuses</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <!-- Health Condition Filter -->
        <div>
            <label class="block text-[11px] font-bold text-[#706B63] mb-1 uppercase tracking-wider">Health Intake Filter</label>
            <select name="filter" class="w-full text-xs p-2.5 rounded-xl border border-[#E2DDD5] focus:ring-2 focus:ring-[#122A21] outline-none cursor-pointer">
                <option value="" {{ !request('filter') ? 'selected' : '' }}>All Health Types</option>
                <option value="critical" {{ request('filter') === 'critical' ? 'selected' : '' }}>Critical Intake (3+ Pain Areas)</option>
                <option value="postpartum" {{ request('filter') === 'postpartum' ? 'selected' : '' }}>Postpartum Clients</option>
            </select>
        </div>

        <!-- Filter by Date -->
        <div>
            <label class="block text-[11px] font-bold text-[#706B63] mb-1 uppercase tracking-wider">Filter by Date</label>
            <input type="date" name="date" value="{{ request('date') }}" 
                class="w-full text-xs p-2.5 rounded-xl border border-[#E2DDD5] focus:ring-2 focus:ring-[#122A21] outline-none">
        </div>

        <!-- Submit CTAs -->
        <div class="flex items-end gap-2">
            <button type="submit" class="flex-1 bg-[#122A21] text-[#D4AF37] font-bold text-xs py-2.5 rounded-xl hover:bg-[#1B3629] transition shadow-sm">
                Apply Filters
            </button>
            <a href="{{ route('admin.appointments.index') }}" class="px-3 py-2.5 border border-[#E2DDD5] rounded-xl text-xs font-semibold text-[#706B63] hover:bg-gray-100 transition">
                Reset
            </a>
        </div>
    </form>
</div>

<!-- Full Table -->
<div class="bg-white border border-[#E2DDD5] rounded-2xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-xs">
            <thead>
                <tr class="bg-[#F8F6F0] text-[#706B63] uppercase text-[11px] tracking-wider border-b border-[#E2DDD5]">
                    <th class="p-4 font-bold">Date & Time</th>
                    <th class="p-4 font-bold">Client Details</th>
                    <th class="p-4 font-bold">Service</th>
                    <th class="p-4 font-bold">Postpartum</th>
                    <th class="p-4 font-bold">Intake Notes / Areas</th>
                    <th class="p-4 font-bold">Status & Action</th>
                    <th class="p-4 font-bold">Cancellation Reason</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#E2DDD5]">
                @forelse($appointments as $app)
                <tr class="hover:bg-[#FAF8F5]">
                    <!-- Date & Time -->
                    <td class="p-4 font-medium text-[#122A21]">
                        <div class="font-bold text-sm">{{ \Carbon\Carbon::parse($app->appointment_date ?? $app->start_time)->format('d M Y') }}</div>
                        <div class="text-[11px] text-[#8C7A6B] mt-0.5">
                            {{ \Carbon\Carbon::parse($app->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($app->end_time)->format('h:i A') }}
                        </div>
                    </td>

                    <!-- Client Details -->
                    <td class="p-4">
                        <div class="font-bold text-[#122A21] text-sm">{{ $app->user->name ?? 'Guest' }}</div>
                        <div class="text-[11px] text-[#706B63]">{{ $app->user->email ?? '' }}</div>
                        <div class="text-[11px] text-[#8C7A6B]">{{ $app->user->phone ?? '' }}</div>
                    </td>

                    <!-- Service & Price Badge -->
                    <td class="p-4">
                        <div class="bg-[#F2EFE9] text-[#1B3629] px-3 py-1.5 rounded-xl font-bold inline-block text-xs">
                            {{ $app->service?->title ?? $app->service?->name ?? 'Unassigned Service' }}
                        </div>
                        <div class="text-[11px] font-bold text-[#8C7A6B] mt-1.5 pl-0.5">
                            RM{{ number_format($app->service?->price ?? 0, 2) }}
                        </div>
                    </td>

                    <!-- Postpartum Status -->
                    <td class="p-4 text-[#706B63] font-medium">
                        {{ $app->intakeForm?->postpartum_status ?? 'No' }}
                    </td>

                    <!-- Intake Notes / Areas -->
                    <td class="p-4 text-[#706B63] max-w-xs leading-relaxed">
                        @php
                            $soreness = $app->intakeForm->soreness_areas ?? null;
                            if (is_string($soreness)) {
                                $areas = array_filter(array_map('trim', explode(',', $soreness)));
                            } elseif (is_array($soreness)) {
                                $areas = array_filter($soreness);
                            } else {
                                $areas = [];
                            }
                            $isCritical = count($areas) >= 3;
                        @endphp

                        @if(count($areas) > 0)
                            <div class="space-y-1">
                                @if($isCritical)
                                    <span class="inline-block text-[10px] uppercase font-bold text-amber-900 bg-amber-100 border border-amber-300 px-2 py-0.5 rounded-md mb-1">
                                        ⚠️ Critical Intake ({{ count($areas) }} Areas)
                                    </span>
                                @endif
                                <p class="text-xs text-[#2C3531] font-medium">
                                    {{ implode(', ', $areas) }}
                                </p>
                            </div>
                        @else
                            <span class="text-slate-400">-</span>
                        @endif
                    </td>

                    <!-- Status & Action -->
                    <td class="p-4">
                        @if($app->status === 'completed')
                            <span class="px-3 py-1.5 bg-[#DCFCE7] text-[#166534] rounded-lg text-xs font-bold uppercase tracking-wider inline-block">
                                COMPLETED
                            </span>
                        @elseif($app->status === 'cancelled')
                            <span class="px-3 py-1.5 bg-red-100 text-red-700 rounded-lg text-xs font-bold uppercase tracking-wider inline-block">
                                CANCELLED
                            </span>
                        @else
                            <form action="/appointments/{{ $app->id }}/status" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" 
                                    class="px-2.5 py-1.5 bg-[#F9F8F3] border border-[#E2DDD5] rounded-xl text-xs font-semibold text-[#1B3629] focus:outline-none cursor-pointer">
                                    <option value="pending" {{ $app->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $app->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="completed" {{ $app->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $app->status === 'cancelled' ? 'selected' : '' }}>Cancel Appointment</option>
                                </select>
                            </form>
                        @endif
                    </td>

                    <!-- Cancellation Reason -->
                    <td class="p-4 text-xs font-medium text-slate-600">
                        @if(strtolower($app->status) === 'cancelled')
                            <span class="text-red-700 font-semibold bg-red-50 border border-red-200 px-2.5 py-1.5 rounded-lg inline-block max-w-[200px] break-words">
                                {{ $app->cancellation_reason ?: 'Cancelled by admin' }}
                            </span>
                        @else
                            <span class="text-slate-400">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-8 text-center text-[#8C7A6B]">
                        No appointment bookings found matching your search filter.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection