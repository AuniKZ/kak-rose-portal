<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - Kak Rose Urutan Melayu</title>
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
            <a href="/" class="text-xs font-semibold text-[#1B3629] hover:text-[#8C7A6B] transition flex items-center gap-1.5 bg-white/80 px-4 py-2 rounded-full border border-[#E2DDD5] shadow-xs">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Back to Home</span>
            </a>
        </div>
    </header>

    <!-- Main Login Card -->
    <main class="w-full max-w-md mx-auto p-6 md:p-8 my-auto z-10">
        <div class="bg-white/95 backdrop-blur-md border border-[#EBE6DD] rounded-3xl p-8 shadow-2xl shadow-[#1B3629]/10 space-y-6 relative">
            
            <!-- Header Title -->
            <div class="text-center space-y-2">
                <span class="inline-block text-[10px] uppercase tracking-[0.2em] font-extrabold text-[#D4AF37] bg-[#1B3629] px-3.5 py-1 rounded-full shadow-xs">
                    Welcome Back
                </span>
                <h1 class="font-serif-title text-3xl font-bold text-[#1B3629]">Client Sanctuary</h1>
                <p class="text-xs text-[#837B70]">Log in to manage your appointments and therapy sessions.</p>
            </div>

            <!-- Session Status Alert -->
            @if (session('status'))
                <div class="p-3.5 bg-[#E3EBE6] border border-[#C5D5CC] text-[#1B3629] text-xs font-semibold rounded-xl flex items-start gap-2 shadow-xs">
                    <svg class="w-4 h-4 text-[#1B3629] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <form action="/login" method="POST" class="space-y-4" novalidate>
                @csrf

                <!-- Email Address Field -->
                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-[#1B3629] mb-1.5">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#837B70]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               value="{{ old('email') }}" 
                               placeholder="e.g. client@example.com"
                               required 
                               class="w-full pl-10 pr-3.5 py-3 bg-[#FAF8F5] border @error('email') border-red-500 bg-red-50/30 @else border-[#E2DDD5] @enderror rounded-xl text-xs font-semibold text-[#1B3629] placeholder-[#A09A90] focus:outline-none focus:bg-white focus:border-[#1B3629] focus:ring-1 focus:ring-[#1B3629] transition shadow-xs">
                    </div>

                    @error('email')
                        <p class="text-xs font-semibold text-red-600 mt-1.5 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 shrink-0 fill-current" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-[#1B3629]">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-[#837B70] hover:text-[#1B3629] hover:underline font-bold">
                                Forgot Password?
                            </a>
                        @else
                            <a href="/forgot-password" class="text-xs text-[#837B70] hover:text-[#1B3629] hover:underline font-bold">
                                Forgot Password?
                            </a>
                        @endif
                    </div>
                    
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#837B70]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <input type="password" 
                               name="password" 
                               id="password"
                               placeholder="••••••••"
                               required 
                               class="w-full pl-10 pr-3.5 py-3 bg-[#FAF8F5] border @error('password') border-red-500 bg-red-50/30 @else border-[#E2DDD5] @enderror rounded-xl text-xs font-semibold text-[#1B3629] placeholder-[#A09A90] focus:outline-none focus:bg-white focus:border-[#1B3629] focus:ring-1 focus:ring-[#1B3629] transition shadow-xs">
                    </div>

                    @error('password')
                        <p class="text-xs font-semibold text-red-600 mt-1.5 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 shrink-0 fill-current" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full mt-2 bg-[#D4AF37] hover:bg-[#C2A02E] active:bg-[#B39327] text-[#0F231A] font-bold text-xs uppercase tracking-widest py-3.5 rounded-xl transition shadow-lg shadow-[#D4AF37]/20 flex items-center justify-center gap-2 group">
                    <span>Log In</span>
                    <svg class="w-4 h-4 text-[#0F231A] group-hover:translate-x-1 transition-transform stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </form>

            <!-- Bottom Link -->
            <p class="text-center text-xs text-[#837B70] pt-2 border-t border-[#E8E2D8]">
                Don't have an account? <a href="/register" class="text-[#1B3629] font-extrabold hover:underline">Sign Up</a>
            </p>
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center py-6 text-xs font-medium text-[#837B70] z-10">
        &copy; {{ date('Y') }} Kak Rose Urutan Melayu. All rights reserved.
    </footer>

</body>
</html>