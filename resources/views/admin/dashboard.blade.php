@extends('admin.admin')

@section('title', 'Admin Overview - Kak Rose Urutan Melayu')

@section('content')
<div>
    <h2 class="font-serif-title text-3xl font-bold text-[#1B3629]">Center Performance</h2>
    <p class="text-[#706B63] text-sm mt-0.5">Real-time tracking of bookings, sales revenue, and client intake forms.</p>
</div>

@if(session('success'))
    <div class="p-4 bg-[#E8F5E9] border border-[#A5D6A7] text-[#1B5E20] rounded-xl text-xs font-semibold">
        {{ session('success') }}
    </div>
@endif

<!-- Sales Tracking KPI Cards -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
    <!-- Total Sales -->
    <a href="{{ route('admin.revenue.index') }}" class="bg-white p-5 rounded-2xl border border-[#E2DDD5] shadow-sm flex items-center justify-between hover:border-[#1B3629] transition group cursor-pointer">
        <div>
            <span class="text-[11px] font-bold text-[#706B63] uppercase tracking-wider block group-hover:text-[#1B3629]">Total Revenue (Completed) &rarr;</span>
            <span class="text-2xl font-bold text-[#122A21] mt-1 block">RM {{ number_format($totalSales ?? 0, 2) }}</span>
        </div>
    </a>

    <!-- This Month Sales -->
    <a href="{{ route('admin.revenue.index') }}" class="bg-white p-5 rounded-2xl border border-[#E2DDD5] shadow-sm flex items-center justify-between hover:border-[#1B3629] transition group cursor-pointer">
        <div>
            <span class="text-[11px] font-bold text-[#706B63] uppercase tracking-wider block group-hover:text-[#1B3629]">This Month's Revenue &rarr;</span>
            <span class="text-2xl font-bold text-[#1B3629] mt-1 block">RM {{ number_format($monthlySales ?? 0, 2) }}</span>
        </div>
    </a>

    <!-- Total Completed Appointments -->
    <a href="{{ route('admin.revenue.index') }}" class="bg-white p-5 rounded-2xl border border-[#E2DDD5] shadow-sm flex items-center justify-between hover:border-[#1B3629] transition group cursor-pointer">
        <div>
            <span class="text-[11px] font-bold text-[#706B63] uppercase tracking-wider block group-hover:text-[#1B3629]">Completed Sessions &rarr;</span>
            <span class="text-2xl font-bold text-[#122A21] mt-1 block">{{ $completedCount ?? 0 }}</span>
        </div>
    </a>
</div>

<!-- Appointments Table -->
<div class="bg-white border border-[#E2DDD5] rounded-2xl shadow-sm overflow-hidden relative">
    <div class="p-5 border-b border-[#E2DDD5] bg-[#FCFCFA] flex justify-between items-center">
        <div>
            <h3 class="font-serif-title font-bold text-xl text-[#122A21]">Recent Appointment Rosters</h3>
            <p class="text-xs text-[#8C7A6B]">Summary of recent client bookings</p>
        </div>
        <a href="{{ route('admin.appointments.index') }}" class="bg-[#122A21] text-[#D4AF37] hover:bg-[#1B3629] text-xs px-4 py-2 rounded-xl font-bold transition shadow-sm">
            View Full Roster & Filters &rarr;
        </a>
    </div>

    <div class="relative max-h-[360px] overflow-hidden">
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

                        <!-- Service & Price -->
                        <td class="p-4">
                            <div class="bg-[#F2EFE9] text-[#1B3629] px-3 py-1.5 rounded-xl font-bold inline-block text-xs">
                                {{ $app->service?->title ?? $app->service?->name ?? 'Unassigned Service' }}
                            </div>
                            <div class="text-[11px] font-bold text-[#8C7A6B] mt-1.5 pl-0.5">
                                RM{{ number_format($app->service?->price ?? 0, 2) }}
                            </div>
                        </td>

                        <!-- Postpartum -->
                        <td class="p-4 text-[#706B63] font-medium">
                            {{ ($app->intakeForm->is_postpartum ?? false) ? 'Yes' : 'No' }}
                        </td>

                        <!-- Intake Notes / Areas -->
                        <td class="p-4 text-[#706B63] max-w-xs leading-relaxed">
                            @if(is_array($app->intakeForm->soreness_areas ?? null))
                                {{ implode(', ', $app->intakeForm->soreness_areas) }}
                            @else
                                {{ $app->intakeForm->soreness_areas ?? '-' }}
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
                                <form action="/admin/appointments/{{ $app->id }}/status" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" 
                                        class="px-2.5 py-1.5 bg-[#F9F8F3] border border-[#E2DDD5] rounded-xl text-xs font-semibold text-[#1B3629] focus:outline-none cursor-pointer">
                                        <option value="pending" {{ $app->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $app->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="completed">Completed</option>
                                        <option value="cancelled">Cancel Appointment</option>
                                    </select>
                                </form>
                            @endif
                        </td>

                        <!-- Cancellation Reason -->
                        <td class="p-4 text-[#706B63] italic">
                            {{ $app->cancellation_reason ?? '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-[#8C7A6B]">
                            No appointment bookings found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="absolute bottom-0 left-0 right-0 h-28 bg-gradient-to-t from-white via-white/80 to-transparent pointer-events-none"></div>
    </div>

    <div class="p-3 bg-white border-t border-[#E2DDD5] text-center relative z-10">
        <a href="{{ route('admin.appointments.index') }}" class="text-xs font-bold text-[#122A21] hover:text-[#D4AF37] transition inline-flex items-center gap-1">
            <span>Click to view full roster and filters ({{ $appointments->count() }} total)</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </a>
    </div>
</div>

<!-- Client Records Summary (with Fade-out Effect) -->
<div class="bg-white border border-[#E2DDD5] rounded-3xl shadow-sm overflow-hidden relative">
    <div class="p-6 border-b border-[#E2DDD5] flex items-center justify-between">
        <div>
            <h3 class="font-serif-title font-bold text-xl text-[#122A21]">Recent Client Records</h3>
            <p class="text-xs text-[#8C7A6B] mt-0.5">Overview of registered client profiles and total sessions.</p>
        </div>
        <a href="/admin/clients" class="bg-[#122A21] text-[#D4AF37] hover:bg-[#1B3629] text-xs font-bold px-4 py-2.5 rounded-xl transition shadow-sm">
            View All Clients &rarr;
        </a>
    </div>

    <!-- Table Container with Controlled Height for Fading Effect -->
    <div class="relative max-h-[320px] overflow-hidden">
        <table class="w-full text-left border-collapse text-xs">
            <thead>
                <tr class="bg-[#F8F6F0] text-[#706B63] uppercase text-[11px] tracking-wider border-b border-[#E2DDD5]">
                    <th class="p-4 font-bold">Client Name</th>
                    <th class="p-4 font-bold">Contact Info</th>
                    <th class="p-4 font-bold">Postpartum Status</th>
                    <th class="p-4 font-bold">Total Sessions</th>
                    <th class="p-4 font-bold">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#E2DDD5]">
                @forelse(($clients ?? []) as $client)
                <tr class="hover:bg-[#FAF8F5]">
                    <td class="p-4 font-bold text-[#122A21]">
                        {{ $client->name }}
                    </td>
                    <td class="p-4">
                        <div class="text-[#122A21] font-medium">{{ $client->email }}</div>
                        <div class="text-[11px] text-[#8C7A6B]">{{ $client->phone }}</div>
                    </td>
                    <td class="p-4">
                        @if(!empty($client->is_postpartum) || (method_exists($client, 'appointments') && optional($client->appointments)->pluck('intakeForm')->pluck('is_postpartum')->contains(true)))
                            <span class="px-2.5 py-1 bg-[#F2EFE9] text-[#1B3629] rounded-lg text-[10px] font-bold uppercase">
                                Postpartum
                            </span>
                        @else
                            <span class="text-[#706B63]">Standard</span>
                        @endif
                    </td>
                    <td class="p-4 font-bold text-[#166534]">
                        {{ $client->appointments_count ?? 1 }} Session(s)
                    </td>
                    <td class="p-4">
                        <a href="/admin/clients/{{ $client->id }}" class="text-xs font-bold text-[#122A21] hover:underline">
                            View Profile
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-[#8C7A6B]">
                        No registered client records found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Gradient Fade Overlay at the bottom -->
        <div class="absolute bottom-0 left-0 right-0 h-28 bg-gradient-to-t from-white via-white/80 to-transparent pointer-events-none"></div>
    </div>

    <!-- Clickable Footer Bar to view full records -->
    <a href="/admin/clients" class="block text-center py-3.5 bg-white border-t border-[#E2DDD5] text-xs font-bold text-[#122A21] hover:bg-[#FAF8F5] transition relative z-10">
        Click to view full client database ({{ count($clients ?? []) }} total) &or;
    </a>
</div>
@endsection