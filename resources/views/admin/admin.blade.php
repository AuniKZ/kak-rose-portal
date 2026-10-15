<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kak Rose Admin')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js Core Library -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-serif-title { font-family: 'Playfair Display', serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#F9F8F3] text-[#2C3531] min-h-screen flex">

    <!-- Unified Left Sidebar -->
    <aside class="w-64 bg-[#F2EFE9] border-r border-[#E2DDD5] p-6 flex flex-col justify-between min-h-screen shrink-0">
        
        <!-- Top Navigation Area -->
        <div class="space-y-8">
            <div>
            <a href="/" class="flex items-center gap-3 transition hover:opacity-80 active:scale-95 duration-200">
                <img src="{{ asset('images/logo.png') }}" alt="Kak Rose Urutan Melayu" class="h-14 md:h-16 w-auto object-contain py-1">
            </a>
                <p class="text-[10px] uppercase font-bold text-[#837B70] tracking-wider mt-0.5">Admin Management System</p>
            </div>

            <!-- Global Navigation Links -->
            <nav class="space-y-2 text-xs font-semibold">
                <!-- Admin Overview -->
                <a href="{{ Route::has('admin.dashboard') ? route('admin.dashboard') : url('/admin') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.dashboard*') || request()->is('admin') ? 'bg-[#E2DDD5] text-[#1B3629]' : 'text-[#706B63] hover:bg-[#EBE6DD] hover:text-[#1B3629]' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Admin Overview
                </a>

                <!-- Sales & Revenue Tracking -->
                <a href="{{ Route::has('admin.revenue.index') ? route('admin.revenue.index') : url('/admin/revenue') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.revenue*') || request()->is('admin/revenue*') ? 'bg-[#E2DDD5] text-[#1B3629]' : 'text-[#706B63] hover:bg-[#EBE6DD] hover:text-[#1B3629]' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Sales & Revenue Tracking
                </a>

                <!-- Full Appointment Roster -->
                <a href="{{ Route::has('admin.appointments.index') ? route('admin.appointments.index') : url('/admin/appointments') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.appointments*') || request()->is('admin/appointments*') ? 'bg-[#E2DDD5] text-[#1B3629]' : 'text-[#706B63] hover:bg-[#EBE6DD] hover:text-[#1B3629]' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Full Appointment Roster
                </a>

                <!-- Client Records -->
                <a href="{{ Route::has('admin.clients.index') ? route('admin.clients.index') : url('/admin/clients') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.clients*') || request()->is('admin/clients*') ? 'bg-[#E2DDD5] text-[#1B3629]' : 'text-[#706B63] hover:bg-[#EBE6DD] hover:text-[#1B3629]' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 100 8.002 4 4 0 000-8.002zM15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Client Records
                </a>
            </nav>
        </div>

        <!-- Combined Admin Profile & Compact Logout Card -->
        <div class="p-2.5 bg-[#EAE5DC] rounded-2xl border border-[#D5CFC4] flex items-center justify-between gap-2 shadow-sm">
            
            <!-- Profile Link -->
            <a href="{{ Route::has('admin.profile') ? route('admin.profile') : '#' }}" 
            class="flex items-center gap-2.5 flex-1 min-w-0 group cursor-pointer"
            title="View Admin Profile">
                <div class="w-9 h-9 rounded-xl bg-[#122A21] text-[#D4AF37] font-bold text-xs flex items-center justify-center shrink-0">
                    RO
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-bold text-[#122A21] leading-tight truncate group-hover:underline">
                        {{ Auth::user()->name ?? 'Rosmawati binti Ahmad' }}
                    </p>
                    <p class="text-[10px] text-[#8C7A6B] leading-tight truncate mt-0.5">Owner & Lead Therapist</p>
                </div>
            </a>

            <!-- Compact Logout Button -->
            <form method="POST" action="{{ route('logout') }}" class="shrink-0">
                @csrf
                <button type="submit" 
                        class="w-8 h-8 flex items-center justify-center text-[#706B63] hover:text-[#991B1B] hover:bg-[#D5CFC4]/50 rounded-xl transition"
                        title="Log Out">
                    <svg class="w-4 h-4 stroke-current fill-none" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>

        </div>
    </aside>

    <!-- Main Content Yield -->
    <main class="flex-1 p-8 space-y-6 overflow-y-auto">

        <!-- Critical Health Intake Banner Alert -->
        @if(isset($criticalCount) && $criticalCount > 0)
            <div x-data="{ open: true }" x-show="open" x-cloak class="bg-amber-50/90 border border-amber-200/80 rounded-2xl p-4 shadow-sm relative overflow-hidden transition-all">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-300 text-amber-700 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] font-bold uppercase tracking-wider bg-amber-200/80 text-amber-900 px-2 py-0.5 rounded-md">
                                    Health Intake Notice
                                </span>
                                <span class="text-xs font-bold text-amber-900">
                                    {{ $criticalCount }} {{ Str::plural('Client', $criticalCount) }} with Multi-Area Pain
                                </span>
                            </div>
                            <p class="text-xs text-amber-800/90 mt-1 leading-relaxed">
                                There {{ $criticalCount === 1 ? 'is' : 'are' }} <strong class="text-amber-950 font-bold">{{ $criticalCount }} registered {{ Str::plural('client', $criticalCount) }}</strong> with 3 or more severe sore/pain areas logged in their intake form. Please inspect their intake background before therapy sessions.
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        <a href="{{ Route::has('admin.appointments.index') ? route('admin.appointments.index', ['filter' => 'critical']) : url('/admin/appointments?filter=critical') }}" class="px-3.5 py-1.5 bg-[#1B3629] hover:bg-[#122A21] text-white text-xs font-bold rounded-xl transition shadow-xs flex items-center gap-1.5">
                            <span>Review Clients</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        <button @click="open = false" type="button" class="text-amber-700 hover:text-amber-900 p-1 rounded-lg hover:bg-amber-100/60 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>