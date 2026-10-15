<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kak Rose Urutan Melayu - Traditional Sanctuary & Wellness</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-serif-title { font-family: 'Playfair Display', serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body x-data="{ sidebarOpen: false, searchFilter: '', selectedCategory: 'all' }" class="bg-[#FAF8F5] text-[#2C3531] antialiased selection:bg-[#1B3629] selection:text-white">

    <!-- Top Announcement Bar -->
    <div class="bg-[#12241B] text-[#E3EBE6] text-[11px] py-2 px-4 text-center tracking-wider font-medium uppercase border-b border-[#1B3629]">
        <span>Experience Authentic Traditional Malay & Postpartum Healing Sanctuary</span>
    </div>

    <!-- Slide-out Navigation Drawer -->
    <div x-cloak x-show="sidebarOpen" class="relative z-50">
        <div x-show="sidebarOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false" 
             class="fixed inset-0 bg-black/60 backdrop-blur-sm"></div>

        <div class="fixed inset-y-0 left-0 max-w-xs w-full bg-[#111111] text-white shadow-2xl flex flex-col justify-between z-50 transform transition-transform duration-300 ease-in-out"
             x-show="sidebarOpen"
             x-transition:enter="transition ease-in-out duration-300 transform"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in-out duration-300 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full">
            
            <div class="p-6 space-y-6 overflow-y-auto">
                <div class="flex justify-between items-center pb-4 border-b border-zinc-800">
                    <a href="/" class="block">
                        <img src="{{ asset('images/logo.png') }}" alt="Kak Rose Urutan Melayu" class="h-12 w-auto object-contain">
                    </a>
                    <button @click="sidebarOpen = false" class="text-zinc-400 hover:text-white p-1">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="relative">
                    <input type="text" x-model="searchFilter" placeholder="Search services..." 
                           class="w-full bg-zinc-900 text-xs text-white pl-4 pr-10 py-2.5 rounded-full border border-zinc-800 focus:outline-none focus:border-amber-200/50 placeholder-zinc-500">
                    <svg class="w-4 h-4 text-zinc-400 absolute right-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>

                <nav class="space-y-1 text-sm font-medium text-zinc-300">
                    <a href="/" class="block py-2.5 px-3 rounded-lg hover:bg-zinc-900 hover:text-white transition">Home</a>
                    <a href="#about" @click="sidebarOpen = false" class="block py-2.5 px-3 rounded-lg hover:bg-zinc-900 hover:text-white transition">About Us</a>
                    <a href="#services" @click="sidebarOpen = false" class="block py-2.5 px-3 rounded-lg hover:bg-zinc-900 hover:text-white transition">Services & Therapy Menu</a>
                    <a href="#contact" @click="sidebarOpen = false" class="block py-2.5 px-3 rounded-lg hover:bg-zinc-900 hover:text-white transition">Contact & Location</a>
                    
                    <div class="pt-4 border-t border-zinc-800 space-y-2">
                        @auth
                            <a href="/profile" class="flex items-center gap-2.5 py-2.5 px-3 rounded-lg hover:bg-zinc-900 text-amber-200 transition text-xs font-semibold">
                                <span class="w-5 h-5 rounded-full bg-[#D4AF37] text-[#1B3629] flex items-center justify-center text-[10px] font-bold uppercase">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>
                                <span>My Profile & Bookings</span>
                            </a>
                        @else
                            <a href="/login" class="block py-2.5 text-center text-xs font-semibold border border-zinc-700 rounded-xl hover:bg-zinc-900 transition">Member Sign In / Promos</a>
                        @endauth
                    </div>

                </nav>
            </div>

            <div class="p-6 border-t border-zinc-900 flex justify-around items-center text-zinc-400">
                <a href="tel:+60149186109" title="Call Us" class="hover:text-amber-200 transition p-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </a>
                <a href="#contact" @click="sidebarOpen = false" title="Location" class="hover:text-amber-200 transition p-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Sticky Header -->
    <header class="bg-[#FAF8F5] border-b border-[#E8E2D8] shadow-sm sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between gap-8">
        
        <!-- Left: Brand Logo -->
        <div class="flex-shrink-0">
            <a href="/" class="block group">
                <img src="{{ asset('images/logo.png') }}" 
                    alt="Kak Rose Urutan Melayu" 
                    class="h-16 md:h-20 w-auto object-contain group-hover:scale-105 transition-transform duration-200">
            </a>
        </div>

        <!-- Right Container: Top Utility Info Bar + Bottom Navigation Menu -->
        <div class="flex-grow flex flex-col justify-between space-y-3">
            
            <!-- Top Utility Row: Address, Email, Phone -->
            <div class="flex items-center justify-start space-x-6 text-xs font-semibold text-[#1B3629] border-b border-[#E8E2D8] pb-2.5">
                <!-- Location -->
                <a href="https://maps.app.goo.gl/43jnQLpafSEW44ij7" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="flex items-center space-x-1.5 hover:text-[#8C7A6B] transition group" 
                   title="Open in Google Maps">
                    <svg class="w-4 h-4 text-[#1B3629] flex-shrink-0 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>Johor Bahru, Johor, Malaysia</span>
                </a>

                <!-- Email -->
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=kakroseurutanmelayu@gmail.com" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="flex items-center space-x-1.5 hover:text-[#8C7A6B] transition flex-shrink-0">
                    <svg class="w-4 h-4 text-[#1B3629]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>kakroseurutanmelayu@gmail.com</span>
                </a>

                <!-- Phone -->
                <a href="tel:+60149186109" class="flex items-center space-x-1.5 hover:text-[#8C7A6B] transition flex-shrink-0">
                    <svg class="w-4 h-4 text-[#1B3629]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span>+60 14-918 6109</span>
                </a>
            </div>

            <!-- Bottom Navigation Row: Links & Actions -->
            <div class="flex items-center justify-between pt-1 px-6">
                <!-- Reordered Left Navigation Links -->
                <nav class="flex items-center space-x-4 lg:space-x-5 text-xs xl:text-sm font-semibold text-[#1B3629] whitespace-nowrap">
                    <a href="/" class="hover:text-[#8C7A6B] transition">Overview</a>
                    <a href="#about" class="hover:text-[#8C7A6B] transition">About</a>
                    <a href="#heritage" class="hover:text-[#8C7A6B] transition">Heritage</a>
                    <a href="#membership" class="hover:text-[#8C7A6B] transition">Membership</a>
                    <a href="#sanctuary" class="hover:text-[#8C7A6B] transition">Sanctuary</a>
                    <a href="#services" class="hover:text-[#8C7A6B] transition">Services</a>
                    <a href="#contact" class="hover:text-[#8C7A6B] transition">Contact</a>
                </nav>

                <!-- Right Action Links & Button -->
                <div class="flex items-center space-x-6">
                    <!-- Track Booking -->
                    <a href="/track-booking" class="text-sm font-semibold text-[#1B3629] hover:text-[#8C7A6B] transition flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <span>Track Booking</span>
                    </a>

                    @auth
                        @if(Auth::user()->is_admin)
                            <!-- Admin Portal Pill -->
                            <a href="{{ Route::has('admin.dashboard') ? route('admin.dashboard') : url('/admin') }}" 
                            title="Admin Management Portal"
                            class="flex items-center gap-2 bg-[#122A21] text-[#FAF8F5] hover:bg-[#1B3629] px-3.5 py-2 rounded-full transition shadow-sm text-xs font-semibold">
                                <span class="w-5 h-5 rounded-full bg-[#D4AF37] text-[#122A21] flex items-center justify-center text-[10px] font-bold uppercase shrink-0">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>
                                <span class="max-w-[100px] truncate">
                                    Admin Portal
                                </span>
                                <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        @else
                            <!-- Regular Client Profile Pill -->
                            <a href="{{ Route::has('profile') ? route('profile') : url('/profile') }}" 
                            title="{{ Auth::user()->name }}"
                            class="flex items-center gap-2 bg-[#1B3629] text-[#FAF8F5] hover:bg-[#2C4D3B] px-3.5 py-2 rounded-full transition shadow-sm text-xs font-semibold">
                                <span class="w-5 h-5 rounded-full bg-[#D4AF37] text-[#1B3629] flex items-center justify-center text-[10px] font-bold uppercase shrink-0">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>
                                <span class="max-w-[100px] truncate">
                                    {{ Str::words(Auth::user()->name, 1, '') }}
                                </span>
                                <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </a>
                        @endif
                    @else
                        <!-- Member Login -->
                        <a href="/login" class="text-sm font-semibold text-[#1B3629] hover:text-[#8C7A6B] transition">
                            Member Login
                        </a>

                        <!-- Primary Call-to-Action -->
                        <a href="#services" class="text-xs font-bold bg-[#1B3629] text-white px-5 py-2.5 rounded-full hover:bg-[#2C4D3B] transition shadow-sm uppercase tracking-wider">
                            Book Treatment
                        </a>
                    @endauth
                </div>
            </div>

        </div>

    </div>
</header>

    <!-- Hero Section -->
    <section class="relative bg-cover bg-center bg-no-repeat min-h-[85vh] flex items-center justify-center text-center px-4" 
        style="background-image: url('{{ asset('images/hero-bg.jpeg') }}');">
        
        <div class="absolute inset-0 bg-[#1B3629]/80 backdrop-blur-[2px]"></div>

        <div class="relative z-10 max-w-4xl mx-auto space-y-6 py-20">
            <div>
                <span class="inline-block px-4 py-1.5 rounded-full border border-[#C5D5CC]/30 bg-white/10 text-white text-xs font-semibold uppercase tracking-widest backdrop-blur-md">
                    Sentuhan Aura Tradisi
                </span>
            </div>

            <h1 class="font-serif text-4xl sm:text-5xl md:text-6xl font-bold text-white tracking-tight leading-tight">
                Restorative Malay Massage <br class="hidden sm:inline">& Postpartum Recovery
            </h1>

            <p class="text-sm md:text-base text-slate-200 max-w-2xl mx-auto font-light leading-relaxed">
                Indulge in time-honored Malay healing techniques designed to relieve tension, boost circulation, and provide comprehensive maternal care in a soothing environment.
            </p>

            <div class="pt-4">
                <a href="/services" class="inline-block bg-white hover:bg-[#FAF8F5] text-[#1B3629] font-bold text-xs uppercase tracking-wider px-8 py-4 rounded-xl transition duration-200 shadow-lg hover:shadow-xl">
                    Explore Therapy Menu
                </a>
            </div>
        </div>
    </section>

    <!-- Highlights Section -->
    <section class="bg-[#F2EFE9] border-y border-[#E2DDD5] py-8">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
            <div class="space-y-1">
                <div class="text-[#1B3629] font-bold text-sm">Certified Therapist</div>
                <p class="text-xs text-[#706B63]">Experienced practitioner trained in traditional Malay wellness</p>
            </div>
            <div class="space-y-1 md:border-x md:border-[#E2DDD5] px-4">
                <div class="text-[#1B3629] font-bold text-sm">Postpartum Care</div>
                <p class="text-xs text-[#706B63]">Specialized body restore & comforting maternal therapies</p>
            </div>
            <div class="space-y-1">
                <div class="text-[#1B3629] font-bold text-sm">Pure Natural Oils</div>
                <p class="text-xs text-[#706B63]">Infused with traditional herbal remedies & aromatherapy</p>
            </div>
        </div>
    </section>

    <!-- About Kak Ros Section -->
    <section id="about" class="bg-[#FAF8F5] border-t border-[#E8E2D8] py-16 px-6">
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            
            <!-- Bio Content (Left Side) -->
            <div class="space-y-6 order-2 md:order-1">
                <span class="text-xs uppercase font-bold text-[#837B70] tracking-widest block">Meet Your Therapist</span>
                <h2 class="font-serif-title text-3xl md:text-4xl font-bold text-[#1B3629]">
                    Personalized Bodywork Handled Directly by Kak Ros
                </h2>
                <p class="text-xs md:text-sm text-[#706B63] leading-relaxed">
                    With years of practical experience in traditional Malay bodywork, postpartum care, and holistic wind-release therapies, Kak Ros provides a grounded, restorative sanctuary environment for women looking to realign their energy and recover bodily strength.
                </p>
                
                <div class="pt-2">
                    <a href="#services" class="inline-flex items-center gap-2 bg-[#1B3629] text-white text-xs font-bold px-6 py-3 rounded-full hover:bg-[#2C4D3B] transition">
                        <span>Explore Available Treatments</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Image / Visual (Right Side) -->
            <div class="relative order-1 md:order-2">
                <div class="aspect-[4/5] rounded-2xl overflow-hidden border border-[#EBE6DD] shadow-md">
                    <img src="{{ asset('images/kak-ros-portrait.jpg') }}" alt="Kak Ros - Master Therapist" class="w-full h-full object-cover">
                </div>
                <!-- Floating Overlay Card (Positioned to the bottom-left of the image) -->
                <div class="absolute -bottom-6 -left-6 bg-[#1B3629] text-[#D4AF37] p-6 rounded-2xl shadow-xl hidden sm:block max-w-xs">
                    <p class="block text-2xl sm:text-3xl font-serif font-bold text-[#D4AF37] mb-1">Personal Care</p>
                    <p class="text-xs font-medium text-[#FAF8F5]/90 leading-relaxed">
                        Every treatment is individually prepared and performed personally by Kak Ros.
                    </p>
                </div>
            </div>

        </div>
    </section>

    <!-- Heritage Section -->
    <section id="heritage" class="bg-white border-y border-[#E8E2D8] py-16 px-6">
        <div class="max-w-7xl mx-auto px-6">
            
            <div class="flex flex-col lg:flex-row items-center gap-10 lg:gap-16">
                
                <!-- Left Side: Image Container -->
                <div class="w-full lg:w-1/2 relative flex-shrink-0">
                    <div class="relative z-10 rounded-2xl overflow-hidden shadow-lg border border-[#E8E2D8] bg-white">
                        <img src="{{ asset('images/heritage-main.jpg') }}" 
                            alt="Batu Tungku" 
                            class="w-full h-[380px] sm:h-[460px] object-cover">
                    </div>

                    <!-- Floating Accent Badge -->
                    <div class="absolute -bottom-6 -right-2 sm:right-6 z-20 bg-[#1B3629] text-white p-5 sm:p-6 rounded-2xl shadow-xl max-w-[240px] sm:max-w-[260px] border border-[#2C4D3B]">
                        <span class="block text-2xl sm:text-3xl font-serif font-bold text-[#D4AF37] mb-1">100%</span>
                        <p class="text-xs font-medium text-[#FAF8F5]/90 leading-relaxed">
                            Authentic Malay Healing Techniques & Natural Herbal Remedies
                        </p>
                    </div>
                </div>

                <!-- Right Side: Text & Content -->
                <div class="w-full lg:w-1/2 space-y-5">
                    
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-[#8C7A6B]">Heritage & Tradition</span>
                        <h2 class="font-serif-title text-3xl md:text-4xl font-bold text-[#1B3629]">
                            Traditional Malay Therapy & Postpartum Rituals
                        </h2>
                    </div>

                    <p class="text-[#5A544B] leading-relaxed text-xs sm:text-sm">
                        At Kak Rose Urutan Melayu, we honor generations of traditional Malay therapy. Every stroke, herb, and technique is designed to restore natural energy flows, ease deep muscle tension, and nourish mothers through their postpartum recovery journey.
                    </p>

                    <!-- 3 Pillars Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 border-t border-[#E8E2D8]">
                        
                        <div class="space-y-1">
                            <div class="w-8 h-8 rounded-full bg-[#F2EFE9] flex items-center justify-center text-[#1B3629]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xs font-bold text-[#1B3629]">Aura & Energy</h3>
                            <p class="text-[11px] text-[#706B63] leading-relaxed">Restoring bodily balance by releasing trapped internal wind.</p>
                        </div>

                        <div class="space-y-1">
                            <div class="w-8 h-8 rounded-full bg-[#F2EFE9] flex items-center justify-center text-[#1B3629]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                </svg>
                            </div>
                            <h3 class="text-xs font-bold text-[#1B3629]">Herbal Botanicals</h3>
                            <p class="text-[11px] text-[#706B63] leading-relaxed">Handpicked traditional Malay oils, tungku herbs, and body wraps.</p>
                        </div>

                        <div class="space-y-1">
                            <div class="w-8 h-8 rounded-full bg-[#F2EFE9] flex items-center justify-center text-[#1B3629]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-2.364-7.636 4.5 4.5 0 00-5.318 1.318L12 5.364l-.364-.364a4.5 4.5 0 00-6.318 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xs font-bold text-[#1B3629]">Maternal Care</h3>
                            <p class="text-[11px] text-[#706B63] leading-relaxed">Specialized postpartum sanctuary rituals for mothers.</p>
                        </div>

                    </div>

                    <!-- Call to Action -->
                    <div class="pt-2">
                        <a href="#services" class="inline-flex items-center gap-2 text-xs font-bold bg-[#1B3629] text-white px-5 py-3 rounded-full hover:bg-[#2C4D3B] transition shadow-md group">
                            <span>Explore Heritage Therapies</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </section>

    <!-- Direct Booking Perks & Member Value Section -->
    <section id="membership" class="bg-[#FAF8F5] py-16 px-6 border-b border-[#E8E2D8]">
        <div class="max-w-6xl mx-auto space-y-12">
            
            <!-- Header -->
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs uppercase tracking-widest font-bold text-[#8C7A6B]">Direct Booking Privilege</span>
                <h2 class="font-serif-title text-3xl md:text-4xl font-bold text-[#1B3629]">
                    Why Book Direct With Us?
                </h2>
                <p class="text-xs md:text-sm text-[#706B63] leading-relaxed">
                    Enjoy priority therapist selection, personalized intake assessments, and exclusive member privileges when scheduling directly through our official sanctuary portal.
                </p>
            </div>

            <!-- Perks Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Perk 1: Priority Time Slots -->
                <div class="bg-[#FAF8F5] border border-[#EBE6DD] rounded-2xl p-6 space-y-4 hover:border-[#1B3629] transition duration-300 group">
                    <div class="w-12 h-12 rounded-xl bg-[#1B3629] text-[#D4AF37] flex items-center justify-center font-bold shadow-sm group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-serif text-lg font-bold text-[#1B3629] mb-1">Priority Scheduling</h3>
                        <p class="text-xs text-[#706B63] leading-relaxed">
                            Access real-time schedule openings and secure preferred morning or evening slots before public release.
                        </p>
                    </div>
                </div>

                <!-- Perk 2: Dedicated 1-on-1 Care -->
                <div class="bg-[#FAF8F5] border border-[#EBE6DD] rounded-2xl p-6 space-y-4 hover:border-[#1B3629] transition duration-300 group">
                    <div class="w-12 h-12 rounded-xl bg-[#1B3629] text-[#D4AF37] flex items-center justify-center font-bold shadow-sm group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-serif text-lg font-bold text-[#1B3629] mb-1">Dedicated 1-on-1 Care</h3>
                        <p class="text-xs text-[#706B63] leading-relaxed">
                            Every single session is personally conducted by Kak Ros, ensuring consistent traditional pressure and focused attention.
                        </p>
                    </div>
                </div>

                <!-- Perk 3: Health Intake History -->
                <div class="bg-[#FAF8F5] border border-[#EBE6DD] rounded-2xl p-8 hover:shadow-md transition-all duration-300 flex flex-col justify-between space-y-6">
                    <div class="w-12 h-12 rounded-xl bg-[#1B3629] flex items-center justify-center shrink-0 shadow-sm">
                        <svg class="w-6 h-6 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-serif text-lg font-bold text-[#1B3629] mb-1">
                            Health Intake History
                        </h3>
                        <p class="text-xs text-[#706B63] leading-relaxed">
                            Your sore areas, postpartum status, and oil preferences are saved for tailored session preparation every visit[cite: 13].
                        </p>
                    </div>
                </div>

                <!-- Perk 4: Instant Reschedule & Cancellation -->
                <div class="bg-[#FAF8F5] border border-[#EBE6DD] rounded-2xl p-6 space-y-4 hover:border-[#1B3629] transition duration-300 group">
                    <div class="w-12 h-12 rounded-xl bg-[#1B3629] text-[#D4AF37] flex items-center justify-center font-bold shadow-sm group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-serif text-lg font-bold text-[#1B3629] mb-1">Flexibility & Easy Edits</h3>
                        <p class="text-xs text-[#706B63] leading-relaxed">
                            Manage your account details, track session statuses, and handle cancellations directly from your client dashboard.
                        </p>
                    </div>
                </div>

            </div>

            <!-- Banner / Action Line -->
            <div class="bg-[#12241B] rounded-2xl p-6 md:p-8 flex flex-col md:flex-row justify-between items-center gap-6 shadow-md border border-[#1B3629]">
                <div class="space-y-1 text-center md:text-left">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#D4AF37]">Member Privilege</span>
                    <h4 class="font-serif-title text-xl font-bold text-white">Not a registered member yet?</h4>
                    <p class="text-xs text-[#A3998C]">Register an account in under 1 minute to store your intake history and track appointments.</p>
                </div>
                
                <div class="flex items-center gap-3 shrink-0">
                    @auth
                        <a href="/profile" class="bg-[#D4AF37] text-[#1B3629] px-6 py-3 rounded-xl font-bold text-xs hover:bg-[#c29f2e] transition shadow">
                            View Client Account &rarr;
                        </a>
                    @else
                        <a href="/register" class="bg-[#D4AF37] text-[#1B3629] px-6 py-3 rounded-xl font-bold text-xs hover:bg-[#c29f2e] transition shadow">
                            Create Free Account
                        </a>
                        <a href="/login" class="text-xs font-semibold text-white hover:underline px-3 py-2">
                            Sign In
                        </a>
                    @endauth
                </div>
            </div>

        </div>
    </section>

    <!-- Automatic Photo-Only Sanctuary Slider Section -->
    <section id="sanctuary" class="bg-white border-y border-[#E8E2D8] py-16 px-6">
        <div class="max-w-5xl mx-auto space-y-8">
            
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs uppercase tracking-widest font-bold text-[#8C7A6B]">Treatment & Therapy Space</span>
                <h2 class="font-serif-title text-3xl md:text-4xl font-bold text-[#1B3629]">
                    Step Inside Our Sanctuary
                </h2>
                <p class="text-xs md:text-sm text-[#706B63] leading-relaxed">
                    Experience authentic Malay therapeutic healing in a clean, serene, and certified treatment space.
                </p>
            </div>

            <!-- Alpine.js Auto-Sliding Carousel -->
            <div x-data="{
                    active: 0,
                    slides: [
                        '{{ asset('images/sanctuary/storefront.jpeg') }}',
                        '{{ asset('images/sanctuary/reception.jpeg') }}',
                        '{{ asset('images/sanctuary/room-1.jpeg') }}',
                        '{{ asset('images/sanctuary/room-2.jpeg') }}'
                    ],
                    timer: null,
                    startTimer() {
                        this.timer = setInterval(() => {
                            this.next();
                        }, 3500);
                    },
                    stopTimer() {
                        clearInterval(this.timer);
                    },
                    next() {
                        this.active = (this.active + 1) % this.slides.length;
                    },
                    prev() {
                        this.active = (this.active - 1 + this.slides.length) % this.slides.length;
                    }
                }"
                x-init="startTimer()"
                @mouseenter="stopTimer()"
                @mouseleave="startTimer()"
                class="relative w-full max-w-4xl mx-auto rounded-2xl overflow-hidden shadow-md border border-[#EBE6DD] bg-black group">

                <!-- Image Slides Container -->
                <div class="relative h-[380px] sm:h-[480px] md:h-[540px] w-full flex items-center justify-center bg-zinc-900">
                    <template x-for="(slide, index) in slides" :key="index">
                        <img :src="slide" 
                            alt="Sanctuary Photo"
                            x-show="active === index"
                            x-transition:enter="transition ease-out duration-700"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-500"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute inset-0 w-full h-full object-cover">
                    </template>
                </div>

                <!-- Left Navigation Arrow -->
                <button @click="prev()" 
                        type="button"
                        aria-label="Previous Slide"
                        class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/40 text-white backdrop-blur-md flex items-center justify-center opacity-80 group-hover:opacity-100 hover:bg-[#1B3629] hover:text-[#D4AF37] transition shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <!-- Right Navigation Arrow -->
                <button @click="next()" 
                        type="button"
                        aria-label="Next Slide"
                        class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/40 text-white backdrop-blur-md flex items-center justify-center opacity-80 group-hover:opacity-100 hover:bg-[#1B3629] hover:text-[#D4AF37] transition shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <!-- Bottom Indicator Dots -->
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-2 bg-black/30 backdrop-blur-md px-3 py-1.5 rounded-full">
                    <template x-for="(slide, index) in slides" :key="index">
                        <button @click="active = index" 
                                type="button"
                                :class="active === index ? 'w-6 bg-[#D4AF37]' : 'w-2 bg-white/60 hover:bg-white'"
                                class="h-2 rounded-full transition-all duration-300"></button>
                    </template>
                </div>

            </div>

            <!-- Specialties Tags Bar (Kept intact below the picture slider) -->
            <div class="bg-white rounded-2xl p-6 border border-[#EBE6DD] space-y-4 max-w-4xl mx-auto">
                <div class="flex items-center justify-between">
                    <h3 class="font-serif-title text-sm font-bold text-[#1B3629] uppercase tracking-wider">
                        Our In-House Specialized Treatments
                    </h3>
                </div>
                
                <div class="flex flex-wrap gap-2 text-xs">
                    <span class="bg-[#FAF8F5] text-[#1B3629] border border-[#E8E2D8] px-3 py-1.5 rounded-lg font-medium">Urutan Pra Natal</span>
                    <span class="bg-[#FAF8F5] text-[#1B3629] border border-[#E8E2D8] px-3 py-1.5 rounded-lg font-medium">Urutan Bersalin & Postnatal</span>
                    <span class="bg-[#FAF8F5] text-[#1B3629] border border-[#E8E2D8] px-3 py-1.5 rounded-lg font-medium">Urutan Ikhtiar Hamil</span>
                    <span class="bg-[#FAF8F5] text-[#1B3629] border border-[#E8E2D8] px-3 py-1.5 rounded-lg font-medium">Urutan Saraf & Separuh Badan</span>
                    <span class="bg-[#FAF8F5] text-[#1B3629] border border-[#E8E2D8] px-3 py-1.5 rounded-lg font-medium">Sengkak</span>
                    <span class="bg-[#FAF8F5] text-[#1B3629] border border-[#E8E2D8] px-3 py-1.5 rounded-lg font-medium">Sauna Herba</span>
                    <span class="bg-[#FAF8F5] text-[#1B3629] border border-[#E8E2D8] px-3 py-1.5 rounded-lg font-medium">Bekam Angin & Bekam Darah</span>
                    <span class="bg-[#FAF8F5] text-[#1B3629] border border-[#E8E2D8] px-3 py-1.5 rounded-lg font-medium">Terapi Letop & Accupunture</span>
                </div>
            </div>

        </div>
    </section>

    <!-- Main Content & Service Preview Section -->
    <main id="services" class="bg-[#FAF8F5] py-16 px-6 border-b border-[#E8E2D8]">
        <div class="max-w-6xl mx-auto space-y-8">
            
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
                <div>
                    <span class="text-xs uppercase font-bold text-[#837B70] tracking-widest block mb-1">Our Treatments</span>
                    <h2 class="font-serif-title text-3xl md:text-4xl font-bold text-[#1B3629]">Therapy Services & Packages</h2>
                </div>
                <p class="text-[#706B63] text-xs max-w-md leading-relaxed">
                    Select a treatment or postpartum recovery package below to view availability and book your session instantly.
                </p>
            </div>

            <!-- Category Filter Tabs -->
            <div class="flex flex-wrap gap-2 pb-4 border-b border-[#E2DDD5]">
                <button @click="selectedCategory = 'all'" 
                        :class="selectedCategory === 'all' ? 'bg-[#1B3629] text-white' : 'bg-[#F2EFE9] text-[#706B63] hover:bg-[#E2DDD5]'"
                        class="text-xs font-semibold px-4 py-2 rounded-full transition-colors duration-200">
                    All Treatments
                </button>
                <button @click="selectedCategory = 'mawar'" 
                        :class="selectedCategory === 'mawar' ? 'bg-[#1B3629] text-white' : 'bg-[#F2EFE9] text-[#706B63] hover:bg-[#E2DDD5]'"
                        class="text-xs font-semibold px-4 py-2 rounded-full transition-colors duration-200">
                    Mawar Package
                </button>
                <button @click="selectedCategory = 'tanjung'" 
                        :class="selectedCategory === 'tanjung' ? 'bg-[#1B3629] text-white' : 'bg-[#F2EFE9] text-[#706B63] hover:bg-[#E2DDD5]'"
                        class="text-xs font-semibold px-4 py-2 rounded-full transition-colors duration-200">
                    Tanjung Package
                </button>
                <button @click="selectedCategory = 'kemboja'" 
                        :class="selectedCategory === 'kemboja' ? 'bg-[#1B3629] text-white' : 'bg-[#F2EFE9] text-[#706B63] hover:bg-[#E2DDD5]'"
                        class="text-xs font-semibold px-4 py-2 rounded-full transition-colors duration-200">
                    Kemboja Package
                </button>
                <button @click="selectedCategory = 'ros'" 
                        :class="selectedCategory === 'ros' ? 'bg-[#1B3629] text-white' : 'bg-[#F2EFE9] text-[#706B63] hover:bg-[#E2DDD5]'"
                        class="text-xs font-semibold px-4 py-2 rounded-full transition-colors duration-200">
                    Rose Package
                </button>
            </div>

            <!-- Fading Wrapper Container -->
            <div class="relative overflow-hidden pt-2">
                
                <!-- Service Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-h-[460px] overflow-hidden">
                    @foreach($services as $service)
                    @php
                        $serviceTitle = $service->title ?? $service->name ?? '';
                        $titleLower = strtolower($serviceTitle);
                        $category = 'single';
                        
                        $cardImage = $service->image_url ?? null;

                        if (!$cardImage) {
                            if (str_contains($titleLower, 'mawar')) {
                                $category = 'mawar';
                                $cardImage = asset('images/mawar.jpg');
                            } elseif (str_contains($titleLower, 'tanjung')) {
                                $category = 'tanjung';
                                $cardImage = asset('images/tanjung.jpg');
                            } elseif (str_contains($titleLower, 'kemboja')) {
                                $category = 'kemboja';
                                $cardImage = asset('images/kemboja.jpg');
                            } elseif (str_contains($titleLower, 'ros')) {
                                $category = 'ros';
                                $cardImage = asset('images/ros.jpg');
                            } elseif (str_contains($titleLower, 'half body')) {
                                $cardImage = asset('images/half-body.jpg');
                            } else {
                                $cardImage = 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?q=80&w=800&auto=format&fit=crop';
                            }
                        } else {
                            if (str_contains($titleLower, 'mawar')) $category = 'mawar';
                            elseif (str_contains($titleLower, 'tanjung')) $category = 'tanjung';
                            elseif (str_contains($titleLower, 'kemboja')) $category = 'kemboja';
                            elseif (str_contains($titleLower, 'ros')) $category = 'ros';
                        }
                    @endphp
                    
                    <!-- Entire Card as Clickable Link -->
                    <a href="/book/{{ $service->id }}"
                    x-show="(selectedCategory === 'all' || selectedCategory === '{{ $category }}') && (searchFilter === '' || $el.getAttribute('data-name').includes(searchFilter.toLowerCase()))"
                    data-name="{{ $titleLower }}"
                    class="bg-white border border-[#EBE6DD] rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:border-[#1B3629] transition-all duration-300 flex flex-col justify-between group cursor-pointer block">
                        
                        <!-- Card Top Image Header with Overlay Badges -->
                        <div class="relative h-44 w-full bg-zinc-100 overflow-hidden">
                            <img src="{{ $cardImage }}" 
                                alt="{{ $serviceTitle }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            
                            <!-- Duration Badge -->
                            <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-md px-3 py-1 rounded-full border border-black/5 shadow-sm text-[11px] font-bold text-[#1B3629] flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-[#837B70]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ $service->duration_minutes }} MINS</span>
                            </div>

                            <!-- Service Category Badge -->
                            <div class="absolute top-3 right-3">
                                @if($category !== 'single')
                                    <span class="bg-[#1B3629] text-[#D4AF37] text-[10px] font-extrabold uppercase tracking-widest px-2.5 py-1 rounded-full shadow-sm">
                                        PACKAGE
                                    </span>
                                @else
                                    <span class="bg-white/90 backdrop-blur-md text-[#837B70] text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-full border border-black/5 shadow-sm">
                                        SINGLE SESSION
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                            <div class="space-y-2">
                                <h3 class="font-serif text-xl font-bold text-[#1B3629] group-hover:text-[#2C4D3B] flex items-center justify-between transition-colors">
                                    <span>{{ $serviceTitle }}</span>
                                </h3>

                                <p class="text-[#706B63] text-xs leading-relaxed line-clamp-2">
                                    {{ $service->description }}
                                </p>
                            </div>

                            <!-- Card Footer -->
                            <div class="pt-4 border-t border-[#F2EFE9] flex justify-between items-center mt-auto">
                                <div>
                                    <span class="text-[10px] uppercase text-[#A3998C] font-bold tracking-wider block">INVESTMENT</span>
                                    <span class="text-lg font-bold text-[#1B3629]">
                                        RM {{ number_format($service->price, 2) }}
                                    </span>
                                </div>

                                <!-- Visual Button Pill (inherits parent click) -->
                                <div class="bg-[#1B3629] text-white text-xs font-semibold px-4 py-2 rounded-full group-hover:bg-[#2C4D3B] transition-colors duration-200 flex items-center gap-1.5 shadow-sm">
                                    <span>Book Now</span>
                                    <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                    </a>
                    @endforeach
                </div>

                <!-- Gradient Fade-out Mask -->
                <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-white via-white/80 to-transparent pointer-events-none z-20"></div>

                <!-- Redirect CTA Button -->
                <div class="absolute bottom-4 inset-x-0 z-30 flex justify-center">
                    <a href="/services" class="bg-[#1B3629] text-white text-xs font-bold px-8 py-3.5 rounded-full shadow-lg hover:bg-[#2C4D3B] hover:shadow-xl transition-all duration-300 flex items-center gap-2 group border border-[#3E6550]">
                        <span>View Full Therapy Menu & Packages</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer id="contact" class="bg-[#12241B] text-[#D0C8B8] border-t border-[#2C4D3B] pt-16 pb-12 px-6 mt-16">
        <div class="max-w-6xl mx-auto space-y-12">
            
            <!-- Main Footer Columns -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 text-xs">
                
                <!-- Col 1: Brand & Bio -->
                <div class="space-y-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Kak Rose Urutan Melayu" class="h-12 w-auto object-contain brightness-0 invert">
                    <p class="text-[#A3998C] leading-relaxed">
                        Authentic traditional Malay therapy, targeted bodywork, and specialized postpartum care performed personally by Kak Ros.
                    </p>
                </div>

                <!-- Col 2: Sanctuary Hours -->
                <div class="space-y-3">
                    <h5 class="text-white font-serif text-sm font-bold tracking-wider uppercase">Sanctuary Hours</h5>
                    <p class="text-[#D0C8B8] font-medium">Monday – Sunday<br><span class="text-[#A3998C]">8:30 AM – 10:30 PM</span></p>
                    <p class="text-[#837B70] text-[11px] leading-relaxed">
                        Strictly by appointment only to ensure personalized 1-on-1 care.
                    </p>
                </div>

                <!-- Col 3: Location & Directions -->
                <div class="space-y-3">
                    <h5 class="text-white font-serif text-sm font-bold tracking-wider uppercase">Sanctuary Location</h5>
                    <p class="text-[#A3998C] leading-relaxed">
                        Johor Bahru, Johor, Malaysia
                    </p>
                    <div class="pt-1 flex flex-col gap-2">
                        <!-- Google Maps Link -->
                        <a href="https://maps.app.goo.gl/43jnQLpafSEW44ij7" 
                        target="_blank" 
                        rel="noopener noreferrer" 
                        class="inline-flex items-center gap-2 text-[#D4AF37] hover:underline font-semibold text-xs transition-colors">
                            <svg class="w-4 h-4 text-[#D4AF37] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Open in Google Maps</span>
                        </a>

                        <!-- WhatsApp Link (Matched Format) -->
                        <a href="https://wa.me/0149186109" 
                        target="_blank" 
                        rel="noopener noreferrer" 
                        class="inline-flex items-center gap-2 text-[#D4AF37] hover:underline font-semibold text-xs transition-colors">
                            <svg class="w-4 h-4 text-[#D4AF37] shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                            </svg>
                            <span>WhatsApp Kak Ros</span>
                        </a>
                    </div>
                </div>

                <!-- Col 4: Quick Links -->
                <div class="space-y-3">
                    <h5 class="text-white font-serif text-sm font-bold tracking-wider uppercase">Quick Links</h5>
                    <ul class="space-y-2 text-[#A3998C]">
                        <li><a href="#services" class="hover:text-white transition-colors duration-200">Therapy Menu & Packages</a></li>
                        <li><a href="/login" class="hover:text-white transition-colors duration-200">Client Portal / Sign In</a></li>
                        <li><a href="#about" class="hover:text-white transition-colors duration-200">About Kak Ros</a></li>
                    </ul>
                </div>

            </div>

            <!-- Sub-footer Bottom Bar -->
            <div class="border-t border-[#1F3D2F] pt-8 flex flex-col sm:flex-row justify-between items-center text-[11px] text-[#837B70] gap-4">
                <div>&copy; {{ date('Y') }} Kak Rose Urutan Melayu. All rights reserved.</div>
                <div class="flex items-center gap-6">
                    <a href="/portal-access-9f8a3b1c7e2d41a089b5c3e" class="hover:text-[#A3998C] transition-colors duration-200">Staff Portal</a>
                </div>
            </div>

        </div>
    </footer>

</body>
</html>