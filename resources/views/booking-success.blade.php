<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed - Kak Rose Urutan Melayu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-serif-title { font-family: 'Playfair Display', serif; }
        [x-cloak] { display: none !important; }
        @media print {
            header, footer, .no-print { display: none !important; }
            body { background: white !important; }
            .print-card { border: none !important; shadow: none !important; }
        }
    </style>
</head>
<body class="bg-[#FBF9F5] text-[#2C3531] min-h-screen antialiased flex flex-col justify-between selection:bg-[#1B3629] selection:text-white">

    <!-- Navigation Header -->
    <header class="bg-white/80 backdrop-blur-md border-b border-[#E8E2D8] px-6 py-4 sticky top-0 z-40">
        <div class="max-w-4xl mx-auto flex justify-between items-center">
            
            <!-- Clickable Brand Logo -->
            <a href="/" class="flex items-center gap-3 transition hover:opacity-80 active:scale-95 duration-200">
                <img src="{{ asset('images/logo.png') }}" alt="Kak Rose Urutan Melayu" class="h-14 md:h-16 w-auto object-contain py-1">
            </a>

            @auth
                <a href="{{ route('profile') }}" class="text-xs font-semibold text-[#1B3629] hover:text-[#8C7A6B] transition-colors flex items-center gap-1.5 bg-[#FAF8F5] border border-[#E2DDD5] px-3.5 py-2 rounded-xl">
                    <span>My Roster Profile</span>
                    <svg class="w-3.5 h-3.5 text-[#8C7A6B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            @else
                <a href="/" class="text-xs font-semibold text-[#1B3629] hover:text-[#8C7A6B] transition-colors flex items-center gap-1.5 bg-[#FAF8F5] border border-[#E2DDD5] px-3.5 py-2 rounded-xl">
                    <svg class="w-3.5 h-3.5 text-[#8C7A6B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>Back to Home</span>
                </a>
            @endauth
        </div>
    </header>

    <main class="max-w-xl mx-auto px-6 py-8 md:py-12 w-full my-auto">
        <div class="bg-white border border-[#E8E2D8] rounded-3xl p-6 sm:p-8 shadow-md text-center space-y-6 relative overflow-hidden print-card">
            
            <!-- Ambient Background Glow -->
            <div class="absolute -top-12 -right-12 w-40 h-40 bg-[#D4AF37]/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-12 -left-12 w-40 h-40 bg-[#1B3629]/5 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Animated Success Badge -->
            <div class="relative z-10">
                <div class="w-20 h-20 bg-emerald-50 text-[#1B3629] rounded-full flex items-center justify-center mx-auto border-2 border-emerald-200/60 shadow-inner">
                    <div class="w-14 h-14 bg-[#1B3629] text-[#D4AF37] rounded-full flex items-center justify-center shadow-md">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </div>
                </div>
            </div>

            <!-- Dynamic Header Section -->
            <div class="relative z-10">
                @auth
                    <!-- Member Header -->
                    <span class="text-[10px] uppercase tracking-widest font-bold text-[#D4AF37] bg-[#122A21] px-3.5 py-1 rounded-full inline-block mb-2 shadow-sm border border-[#D4AF37]/20">
                        Member Exclusive Pass
                    </span>
                    <h2 class="font-serif-title text-3xl font-bold text-[#1B3629]">Session Scheduled!</h2>
                    <p class="text-xs text-[#706B63] mt-2 max-w-sm mx-auto leading-relaxed">
                        Welcome back, <strong class="text-[#1B3629]">{{ Auth::user()->name }}</strong>. We have linked this treatment directly to your personal account history.
                    </p>
                @else
                    <!-- Guest Header -->
                    <span class="text-[10px] uppercase tracking-widest font-bold text-[#8C7A6B] bg-[#FAF8F5] border border-[#E8E2D8] px-3.5 py-1 rounded-full inline-block mb-2">
                        Booking Received
                    </span>
                    <h2 class="font-serif-title text-3xl font-bold text-[#1B3629]">Appointment Scheduled!</h2>
                    <p class="text-xs text-[#706B63] mt-2 max-w-sm mx-auto leading-relaxed">
                        Thank you, <strong class="text-[#1B3629]">{{ $appointment->user->name ?? 'Valued Client' }}</strong>. Your request has been successfully logged. Please keep your reference code for your records.
                    </p>
                @endauth
            </div>

            <!-- Booking Card Summary / Receipt Structure -->
            <div class="bg-[#FAF8F5] border border-[#E2DDD5] rounded-2xl p-5 text-left space-y-3.5 relative overflow-hidden shadow-inner">
                
                <div class="flex justify-between items-center border-b border-[#EBE6DD] pb-3">
                    <span class="text-xs text-[#837B70] font-medium">Reference Code</span>
                    <span class="text-xs font-mono font-bold text-[#1B3629] bg-white px-3 py-1 rounded-lg border border-[#E2DDD5] shadow-sm">
                        #KR-{{ sprintf('%04d', $appointment->id) }}
                    </span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-xs text-[#837B70]">Treatment</span>
                    <span class="text-xs font-bold text-[#1B3629] text-right">{{ $appointment->service->title ?? $appointment->service->name }}</span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-xs text-[#837B70]">Date & Time</span>
                    <span class="text-xs font-bold text-[#1B3629] text-right">
                        {{ \Carbon\Carbon::parse($appointment->appointment_date ?? $appointment->start_time)->format('D, d M Y') }} @ {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}
                    </span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-xs text-[#837B70]">Total Investment</span>
                    <span class="text-sm font-bold text-[#1B3629]">RM {{ number_format($appointment->service->price ?? 0, 2) }}</span>
                </div>

                <div class="flex justify-between items-center border-t border-[#EBE6DD] pt-3">
                    <span class="text-xs text-[#837B70]">Status</span>
                    <span class="text-[10px] font-bold uppercase tracking-wider bg-amber-50 text-amber-800 border border-amber-200 px-3 py-0.5 rounded-full flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                        {{ ucfirst($appointment->status ?? 'pending') }}
                    </span>
                </div>
            </div>

            <!-- Member vs Guest Dynamic Banner -->
            <div class="relative z-10">
                @auth
                    <!-- Member Notice -->
                    <div class="p-4 bg-gradient-to-r from-[#122A21] to-[#1B3629] text-white rounded-2xl text-left flex items-start space-x-3 shadow-md border border-[#D4AF37]/20">
                        <div class="w-8 h-8 rounded-xl bg-[#D4AF37]/20 flex items-center justify-center shrink-0 text-[#D4AF37] mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-[#D4AF37]">Saved to Your Member Profile</p>
                            <p class="text-[11px] text-[#FAF8F5]/80 leading-relaxed mt-0.5">
                                You can review, manage, or modify all upcoming treatment details at any time from your member dashboard.
                            </p>
                        </div>
                    </div>

                    <!-- Member CTAs -->
                    <div class="pt-2 space-y-3 no-print">
                        <a href="{{ route('profile') }}" class="flex items-center justify-center gap-2 w-full bg-[#1B3629] hover:bg-[#2A4D3B] text-white py-3.5 rounded-xl font-bold text-xs transition shadow-md">
                            <span>View Appointment in My Roster</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        <div class="flex items-center justify-between px-2 pt-1">
                            <button onclick="window.print()" class="text-xs font-semibold text-[#8C7A6B] hover:text-[#1B3629] flex items-center gap-1 transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                                <span>Print Receipt</span>
                            </button>
                            <a href="/" class="text-xs font-semibold text-[#837B70] hover:text-[#1B3629] transition">
                                Return to Homepage
                            </a>
                        </div>
                    </div>
                @else
                    <!-- Guest Notice -->
                    <div class="p-4 bg-[#F4F0E8] rounded-2xl border border-[#E2DDD5] text-left flex items-start space-x-3">
                        <div class="w-7 h-7 rounded-lg bg-white flex items-center justify-center shrink-0 text-[#8C7A6B] shadow-sm border border-[#E2DDD5] mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <p class="text-[11px] text-[#706B63] leading-relaxed">
                            Forgot your reference code later? You can easily look up your appointment details anytime on our guest portal using your registered phone number.
                        </p>
                    </div>

                    <!-- Guest CTAs -->
                    <div class="pt-2 space-y-3 no-print">
                        <a href="/track-booking?query={{ optional($appointment->user)->phone }}" class="flex items-center justify-center gap-2 w-full bg-[#1B3629] hover:bg-[#2A4D3B] text-white py-3.5 rounded-xl font-bold text-xs transition shadow-md">
                            <span>Track Appointment Status</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        <div class="flex items-center justify-between px-2 pt-1">
                            <button onclick="window.print()" class="text-xs font-semibold text-[#8C7A6B] hover:text-[#1B3629] flex items-center gap-1 transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                                <span>Print Confirmation</span>
                            </button>
                            <a href="/" class="text-xs font-semibold text-[#837B70] hover:text-[#1B3629] transition">
                                Return to Homepage
                            </a>
                        </div>
                    </div>
                @endauth
            </div>

        </div>
    </main>

    <footer class="text-center py-6 text-xs text-[#837B70] border-t border-[#E8E2D8]/50 bg-white/40">
        &copy; {{ date('Y') }} Kak Rose Urutan Melayu. All rights reserved.
    </footer>

</body>
</html>