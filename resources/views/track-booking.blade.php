<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Your Booking - Kak Rose Urutan Melayu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-serif-title { font-family: 'Playfair Display', serif; }

        /* Subtle Luxury Traditional Pattern */
        .pattern-bg {
            background-color: #FAF8F5;
            background-image: radial-gradient(#D4AF37 0.75px, transparent 0.75px), radial-gradient(#1B3629 0.75px, #FAF8F5 0.75px);
            background-size: 30px 30px;
            background-position: 0 0, 15px 15px;
            opacity: 0.95;
        }
    </style>
</head>
<body class="pattern-bg text-[#2C3531] min-h-screen antialiased flex flex-col justify-between relative overflow-x-hidden">

    <!-- Decorative Soft Glow Blurs -->
    <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[700px] h-[350px] bg-[#D4AF37]/15 blur-[130px] pointer-events-none rounded-full"></div>
    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[800px] h-[300px] bg-[#1B3629]/10 blur-[140px] pointer-events-none rounded-full"></div>

    <!-- Full-Width Header -->
    <header class="bg-[#F4F0E8]/85 backdrop-blur-md border-b border-[#E8E2D8] px-6 md:px-12 py-4 sticky top-0 z-20">
        <div class="w-full flex justify-between items-center">
            <!-- Clickable Brand Logo -->
            <a href="/" class="flex items-center gap-3 transition hover:opacity-80 active:scale-95 duration-200">
                <img src="{{ asset('images/logo.png') }}" alt="Kak Rose Urutan Melayu" class="h-14 md:h-16 w-auto object-contain py-1">
            </a>

            <!-- Single Action Link: Back to Home -->
            <a href="/" class="text-xs font-semibold text-[#1B3629] hover:text-[#8C7A6B] transition flex items-center gap-1.5 bg-white/80 px-4 py-2 rounded-full border border-[#E2DDD5] shadow-xs">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Back to Home</span>
            </a>
        </div>
    </header>

    <!-- Main Content Container -->
    <main class="max-w-lg mx-auto p-6 md:p-10 w-full my-auto z-10">
        <div class="bg-white/95 backdrop-blur-md border border-[#EBE6DD] rounded-3xl p-8 md:p-10 shadow-2xl shadow-[#1B3629]/10 space-y-7 relative">
            
            <!-- Header Title -->
            <div class="text-center space-y-2">
                <span class="inline-block text-[10px] uppercase tracking-[0.2em] font-extrabold text-[#D4AF37] bg-[#1B3629] px-3.5 py-1 rounded-full shadow-xs">
                    Guest Portal
                </span>
                <h2 class="font-serif-title text-3xl md:text-4xl font-bold text-[#1B3629] pt-1">Track Appointment</h2>
                <p class="text-xs text-[#706B63] max-w-xs mx-auto leading-relaxed">
                    Enter your registered phone number or booking reference number below.
                </p>
            </div>

            <!-- Search Form -->
            <form action="/track-booking" method="GET" class="space-y-3">
                <div class="relative flex items-center">
                    <input type="text" name="query" value="{{ request('query') }}" placeholder="e.g. +60123456789 or 22" required
                           class="w-full pl-4 pr-26 py-3.5 bg-[#FAF8F5] border border-[#E2DDD5] rounded-2xl text-xs font-medium text-[#1B3629] placeholder-[#A09A90] focus:outline-none focus:border-[#1B3629] focus:ring-1 focus:ring-[#1B3629] transition shadow-inner">
                    <button type="submit" class="absolute right-1.5 bg-[#1B3629] text-white px-4 py-2.5 rounded-xl font-semibold text-xs hover:bg-[#2C4D3B] transition shadow-md flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <span>Search</span>
                    </button>
                </div>
            </form>

            <!-- Search Results -->
            @if($searched)
                @if($appointment)
                    <div class="bg-[#FAF8F5] border border-[#E2DDD5] rounded-2xl p-6 space-y-3.5 relative overflow-hidden shadow-xs">
                        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#1B3629] via-[#D4AF37] to-[#1B3629]"></div>

                        <div class="flex justify-between items-center border-b border-[#EBE6DD] pb-2.5">
                            <span class="text-xs font-medium text-[#837B70]">Booking ID</span>
                            <span class="text-xs font-bold text-[#1B3629] tracking-wider bg-white px-2.5 py-1 rounded-lg border border-[#EBE6DD]">
                                #KR-{{ sprintf('%04d', $appointment->id) }}
                            </span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-xs font-medium text-[#837B70]">Client Name</span>
                            <span class="text-xs font-bold text-[#1B3629] text-right">{{ $appointment->user->name }}</span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-xs font-medium text-[#837B70]">Service</span>
                            <span class="text-xs font-bold text-[#1B3629] text-right">{{ $appointment->service->title ?? $appointment->service->name }}</span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-xs font-medium text-[#837B70]">Date & Time</span>
                            <span class="text-xs font-bold text-[#1B3629] text-right">{{ \Carbon\Carbon::parse($appointment->start_time)->format('D, d M Y @ h:i A') }}</span>
                        </div>

                        <div class="flex justify-between items-center pt-2.5 border-t border-[#EBE6DD]">
                            <span class="text-xs font-medium text-[#837B70]">Status</span>
                            @if($appointment->status === 'confirmed')
                                <span class="text-[10px] font-bold uppercase tracking-wider bg-emerald-100/80 text-emerald-800 border border-emerald-200 px-3 py-1 rounded-full flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 animate-pulse"></span> Confirmed
                                </span>
                            @elseif($appointment->status === 'cancelled')
                                <span class="text-[10px] font-bold uppercase tracking-wider bg-rose-100/80 text-rose-800 border border-rose-200 px-3 py-1 rounded-full flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-600"></span> Cancelled
                                </span>
                            @else
                                <span class="text-[10px] font-bold uppercase tracking-wider bg-amber-100/80 text-amber-800 border border-amber-200 px-3 py-1 rounded-full flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-600 animate-ping"></span> Pending Approval
                                </span>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="bg-rose-50/80 border border-rose-200 text-rose-800 text-xs rounded-2xl p-4 text-center leading-relaxed">
                        No active booking found for that phone number or ID. Please check your details and try again.
                    </div>
                @endif
            @endif

        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center py-6 text-xs font-medium text-[#837B70] z-10">
        &copy; {{ date('Y') }} Kak Rose Urutan Melayu. All rights reserved.
    </footer>

</body>
</html>