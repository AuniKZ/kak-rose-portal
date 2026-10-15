<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Services & Packages - Kak Rose Urutan Melayu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-serif-title { font-family: 'Playfair Display', serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body x-data="{ searchFilter: '', selectedCategory: 'all' }" class="bg-[#FAF8F5] text-[#2C3531] min-h-screen antialiased flex flex-col justify-between">

    <!-- Top Navigation Bar -->
    <header class="bg-[#FAF8F5] border-b border-[#E8E2D8] px-6 py-4 sticky top-0 z-50 backdrop-blur-md bg-opacity-90">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Clickable Brand Logo -->
            <a href="/" class="flex items-center gap-3 transition hover:opacity-80 active:scale-95 duration-200">
                <img src="{{ asset('images/logo.png') }}" alt="Kak Rose Urutan Melayu" class="h-14 md:h-16 w-auto object-contain py-1">
            </a>
            <a href="/" class="text-xs font-bold uppercase tracking-wider text-[#1B3629] bg-[#EFEBE4] hover:bg-[#1B3629] hover:text-white px-4 py-2.5 rounded-full transition flex items-center gap-2 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Home
            </a>
        </div>
    </header>

    <!-- Page Hero Header -->
    <section class="bg-gradient-to-b from-[#F4F0E8] to-[#FAF8F5] border-b border-[#E8E2D8] py-12 px-6">
        <div class="max-w-4xl mx-auto text-center space-y-4">
            <span class="text-xs font-bold uppercase tracking-widest text-[#8C7A6B] bg-[#EFEBE4] px-3 py-1 rounded-full border border-[#E2DDD5]">
                Full Sanctuary Treatment Menu
            </span>
            <h1 class="font-serif-title text-4xl md:text-5xl font-bold text-[#1B3629] leading-tight">
                Therapy Services & Packages
            </h1>
            <p class="text-[#706B63] text-sm md:text-base max-w-xl mx-auto leading-relaxed">
                Explore our complete range of traditional Malay healing therapies, customized postpartum recovery packages, and body rejuvenation treatments.
            </p>

            <!-- Live Search Bar -->
            <div class="max-w-md mx-auto pt-4">
                <div class="relative">
                    <input type="text" 
                           x-model="searchFilter" 
                           placeholder="Search treatments..." 
                           class="w-full pl-11 pr-4 py-3 bg-white border border-[#E2DDD5] rounded-full text-xs font-medium focus:outline-none focus:ring-2 focus:ring-[#1B3629] focus:border-transparent shadow-sm">
                    <svg class="w-4 h-4 text-[#8C7A6B] absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <main class="max-w-7xl mx-auto px-6 py-10 w-full flex-grow">

        <!-- Category Filter Tabs -->
        <div class="flex flex-wrap justify-center gap-2.5 mb-10 pb-4 border-b border-[#E8E2D8]">
            <button @click="selectedCategory = 'all'" :class="selectedCategory === 'all' ? 'bg-[#1B3629] text-white shadow-md' : 'bg-white text-[#706B63] hover:bg-[#EFEBE4] border border-[#E2DDD5]'" class="text-xs font-bold px-5 py-2.5 rounded-full transition-all">All Treatments</button>
            <button @click="selectedCategory = 'mawar'" :class="selectedCategory === 'mawar' ? 'bg-[#1B3629] text-white shadow-md' : 'bg-white text-[#706B63] hover:bg-[#EFEBE4] border border-[#E2DDD5]'" class="text-xs font-bold px-5 py-2.5 rounded-full transition-all">Mawar Package</button>
            <button @click="selectedCategory = 'tanjung'" :class="selectedCategory === 'tanjung' ? 'bg-[#1B3629] text-white shadow-md' : 'bg-white text-[#706B63] hover:bg-[#EFEBE4] border border-[#E2DDD5]'" class="text-xs font-bold px-5 py-2.5 rounded-full transition-all">Tanjung Package</button>
            <button @click="selectedCategory = 'kemboja'" :class="selectedCategory === 'kemboja' ? 'bg-[#1B3629] text-white shadow-md' : 'bg-white text-[#706B63] hover:bg-[#EFEBE4] border border-[#E2DDD5]'" class="text-xs font-bold px-5 py-2.5 rounded-full transition-all">Kemboja Package</button>
            <button @click="selectedCategory = 'ros'" :class="selectedCategory === 'ros' ? 'bg-[#1B3629] text-white shadow-md' : 'bg-white text-[#706B63] hover:bg-[#EFEBE4] border border-[#E2DDD5]'" class="text-xs font-bold px-5 py-2.5 rounded-full transition-all">Rose Package</button>
        </div>

        <!-- Treatment Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
                @php
                    $serviceTitle = $service->title ?? $service->name ?? '';
                    $titleLower = strtolower($serviceTitle);
                    $category = 'single';
                    
                    // Priority 1: Check database column ($service->image_url or $service->image_path)
                    // Priority 2: Match static local image based on title
                    // Priority 3: Fallback Unsplash image
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
                    }
                @endphp

                <div x-show="(selectedCategory === 'all' || selectedCategory === '{{ $category }}') && ('{{ strtolower($serviceTitle) }}'.includes(searchFilter.toLowerCase()) || '{{ strtolower($service->description) }}'.includes(searchFilter.toLowerCase()))"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    class="bg-white border border-[#E8E2D8] rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-[#1B3629] transition-all duration-300 flex flex-col justify-between group relative cursor-pointer">
                    
                    <!-- Clickable Stretch Anchor (makes whole card clickable) -->
                    <a href="/book/{{ $service->id }}" class="absolute inset-0 z-10 focus:outline-none focus:ring-2 focus:ring-[#1B3629] focus:ring-offset-2 rounded-2xl" aria-label="Book {{ $serviceTitle }}"></a>

                    <div>
                        <!-- Top Image Thumbnail -->
                        <div class="relative h-44 w-full bg-[#F2EFE9] overflow-hidden">
                            <img src="{{ $cardImage }}" 
                                alt="{{ $serviceTitle }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent pointer-events-none"></div>

                            <!-- Top Badges Overlay -->
                            <div class="absolute top-3 left-3 right-3 flex justify-between items-center pointer-events-none">
                                <span class="inline-flex items-center gap-1 text-[11px] font-bold tracking-wider uppercase text-[#1B3629] bg-white/95 backdrop-blur-sm px-2.5 py-1 rounded-full shadow-sm">
                                    <svg class="w-3 h-3 text-[#8C7A6B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $service->duration_minutes }} Mins
                                </span>

                                @if($category !== 'single')
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#D4AF37] bg-[#1B3629]/90 backdrop-blur-sm px-2.5 py-1 rounded-full border border-[#D4AF37]/30 shadow-sm">
                                        Package
                                    </span>
                                @else
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#1B3629] bg-white/95 backdrop-blur-sm px-2.5 py-1 rounded-full shadow-sm">
                                        Single Session
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Card Body Content -->
                        <div class="p-6">
                            <h3 class="font-serif-title text-xl font-bold text-[#1B3629] group-hover:text-[#2C4D3B] mb-2 leading-snug">
                                {{ $serviceTitle }}
                            </h3>

                            <p class="text-[#706B63] text-xs sm:text-sm leading-relaxed mb-4 line-clamp-3">
                                {{ $service->description }}
                            </p>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div class="px-6 pb-6 pt-4 border-t border-[#F2EFE9] flex items-center justify-between mt-auto">
                        <div>
                            <span class="text-[10px] uppercase tracking-wider text-[#A3998C] font-bold block">Investment</span>
                            <span class="text-xl font-bold text-[#1B3629]">RM {{ number_format($service->price, 2) }}</span>
                        </div>

                        <!-- Visual Button Indicator -->
                        <span class="inline-flex items-center gap-2 text-xs font-bold bg-[#1B3629] text-white px-4 py-2.5 rounded-full group-hover:bg-[#2C4D3B] transition shadow-md">
                            <span>Book Now</span>
                            <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </span>
                    </div>

                </div>
            @endforeach
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-[#12241B] text-[#8C7A6B] py-8 text-center text-xs border-t border-[#1B3629] mt-12">
        <div class="max-w-7xl mx-auto px-6 space-y-2">
            <p class="font-serif-title text-base text-[#FAF8F5]">Kak Rose Urutan Melayu</p>
            <p>&copy; {{ date('Y') }} All rights reserved. Sentuhan Aura Tradisi.</p>
        </div>
    </footer>

</body>
</html>