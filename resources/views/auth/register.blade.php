<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Kak Rose Urutan Melayu</title>
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

    <!-- Sticky Header with Clickable Logo -->
    <header class="bg-[#F4F0E8]/85 backdrop-blur-md border-b border-[#E8E2D8] px-6 md:px-12 py-4 sticky top-0 z-20">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <!-- Clickable Brand Logo -->
            <a href="/" class="flex items-center gap-3 transition hover:opacity-80 active:scale-95 duration-200">
                <img src="{{ asset('images/logo.png') }}" alt="Kak Rose Urutan Melayu" class="h-14 md:h-16 w-auto object-contain py-1">
            </a>
            <!-- Navigation Actions -->
            <div class="flex items-center gap-3">
                <a href="/" class="text-xs font-semibold text-[#1B3629] hover:text-[#8C7A6B] transition flex items-center gap-1.5 bg-white/80 px-4 py-2 rounded-full border border-[#E2DDD5] shadow-xs">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>Back to Home</span>
                </a>
            </a>
        </div>
    </header>

    <!-- Main Registration Card -->
    <main class="w-full max-w-md mx-auto p-6 md:p-8 my-auto z-10">
        <div class="bg-white/95 backdrop-blur-md border border-[#EBE6DD] rounded-3xl p-8 shadow-2xl shadow-[#1B3629]/10 space-y-6 relative">
            
            <!-- Header Title -->
            <div class="text-center space-y-2">
                <span class="inline-block text-[10px] uppercase tracking-[0.2em] font-extrabold text-[#D4AF37] bg-[#1B3629] px-3.5 py-1 rounded-full shadow-xs">
                    Member Sanctuary
                </span>
                <h1 class="font-serif-title text-3xl font-bold text-[#1B3629]">Create Account</h1>
                <p class="text-xs text-[#837B70]">Join us to book your traditional Malay therapy session.</p>
            </div>

            <!-- Error Notification Box -->
            @if ($errors->any())
                <div class="p-3.5 bg-red-50/90 border border-red-200 text-red-700 text-xs rounded-xl flex items-start gap-2 shadow-xs">
                    <svg class="w-4 h-4 text-red-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="/register" method="POST" class="space-y-4">
                @csrf

                <!-- Full Name -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1B3629] mb-1.5">Full Name *</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#837B70]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Enter your full name" 
                               class="w-full pl-10 pr-3.5 py-3 bg-[#FAF8F5] border border-[#E2DDD5] rounded-xl text-xs font-semibold text-[#1B3629] placeholder-[#A09A90] focus:outline-none focus:bg-white focus:border-[#1B3629] focus:ring-1 focus:ring-[#1B3629] transition shadow-xs">
                    </div>
                </div>

                <!-- Email Address -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1B3629] mb-1.5">Email Address *</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#837B70]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="client@example.com" 
                               class="w-full pl-10 pr-3.5 py-3 bg-[#FAF8F5] border border-[#E2DDD5] rounded-xl text-xs font-semibold text-[#1B3629] placeholder-[#A09A90] focus:outline-none focus:bg-white focus:border-[#1B3629] focus:ring-1 focus:ring-[#1B3629] transition shadow-xs">
                    </div>
                </div>

                <!-- Phone Number -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1B3629] mb-1.5">Phone Number *</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#837B70]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="e.g. +60123456789" 
                               class="w-full pl-10 pr-3.5 py-3 bg-[#FAF8F5] border border-[#E2DDD5] rounded-xl text-xs font-semibold text-[#1B3629] placeholder-[#A09A90] focus:outline-none focus:bg-white focus:border-[#1B3629] focus:ring-1 focus:ring-[#1B3629] transition shadow-xs">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1B3629] mb-1.5">Password *</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#837B70]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <input type="password" name="password" required placeholder="••••••••" 
                               class="w-full pl-10 pr-3.5 py-3 bg-[#FAF8F5] border border-[#E2DDD5] rounded-xl text-xs font-semibold text-[#1B3629] placeholder-[#A09A90] focus:outline-none focus:bg-white focus:border-[#1B3629] focus:ring-1 focus:ring-[#1B3629] transition shadow-xs">
                    </div>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1B3629] mb-1.5">Confirm Password *</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#837B70]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <input type="password" name="password_confirmation" required placeholder="••••••••" 
                               class="w-full pl-10 pr-3.5 py-3 bg-[#FAF8F5] border border-[#E2DDD5] rounded-xl text-xs font-semibold text-[#1B3629] placeholder-[#A09A90] focus:outline-none focus:bg-white focus:border-[#1B3629] focus:ring-1 focus:ring-[#1B3629] transition shadow-xs">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full mt-2 bg-[#D4AF37] hover:bg-[#C2A02E] active:bg-[#B39327] text-[#0F231A] font-bold text-xs uppercase tracking-widest py-3.5 rounded-xl transition shadow-lg shadow-[#D4AF37]/20 flex items-center justify-center gap-2 group">
                    <span>Complete Registration</span>
                    <svg class="w-4 h-4 text-[#0F231A] group-hover:translate-x-1 transition-transform stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </form>

            <!-- Bottom Link -->
            <p class="text-center text-xs text-[#837B70] pt-2 border-t border-[#E8E2D8]">
                Already have an account? <a href="/login" class="text-[#1B3629] font-extrabold hover:underline">Log In</a>
            </p>
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center py-6 text-xs font-medium text-[#837B70] z-10">
        &copy; {{ date('Y') }} Kak Rose Urutan Melayu. All rights reserved.
    </footer>

</body>
</html>