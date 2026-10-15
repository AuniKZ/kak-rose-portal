<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book {{ $service->title ?? $service->name }} - Kak Rose Urutan Melayu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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

        /* Customizing Flatpickr theme */
        .flatpickr-calendar {
            background: #FAF8F5 !important;
            border: 1px solid #E2DDD5 !important;
            box-shadow: 0 20px 25px -5px rgba(27, 54, 41, 0.1) !important;
            border-radius: 1rem !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
        .flatpickr-day.selected, .flatpickr-day.selected:hover {
            background: #1B3629 !important;
            border-color: #1B3629 !important;
        }
    </style>
</head>
<body class="pattern-bg text-[#2C3531] min-h-screen antialiased flex flex-col justify-between relative overflow-x-hidden">

    <!-- Decorative Soft Glow Blurs -->
    <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[700px] h-[350px] bg-[#D4AF37]/15 blur-[130px] pointer-events-none rounded-full"></div>
    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[800px] h-[300px] bg-[#1B3629]/10 blur-[140px] pointer-events-none rounded-full"></div>

    <!-- Sticky Navigation Header -->
    <header class="bg-[#F4F0E8]/85 backdrop-blur-md border-b border-[#E8E2D8] px-6 md:px-12 py-4 sticky top-0 z-20">
        <div class="w-full flex justify-between items-center">
            <a href="/" class="flex items-center gap-3 transition hover:opacity-80 active:scale-95 duration-200">
                <img src="{{ asset('images/logo.png') }}" alt="Kak Rose Urutan Melayu" class="h-14 md:h-16 w-auto object-contain py-1">
            </a>

            <div class="flex items-center gap-3">
                <a href="{{ route('services.index') }}" class="text-xs font-semibold text-[#1B3629] hover:text-[#8C7A6B] transition flex items-center gap-1.5 bg-white/80 px-4 py-2 rounded-full border border-[#E2DDD5] shadow-xs">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>Back to Menu</span>
                </a>
                <a href="/login" class="hidden sm:flex text-xs font-bold text-white bg-[#1B3629] hover:bg-[#2C4D3B] transition px-4 py-2 rounded-full shadow-xs">
                    Member Log In
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Form Section -->
    <main class="max-w-2xl mx-auto p-6 md:p-10 w-full my-auto z-10">
        <div class="bg-white/95 backdrop-blur-md border border-[#EBE6DD] rounded-3xl p-6 md:p-10 shadow-2xl shadow-[#1B3629]/10 space-y-8 relative">
            
            <div class="text-center space-y-2">
                <span class="inline-block text-[10px] uppercase tracking-[0.2em] font-extrabold text-[#D4AF37] bg-[#1B3629] px-3.5 py-1 rounded-full shadow-xs">
                    Guest Booking Sanctuary
                </span>
                <h2 class="font-serif-title text-3xl md:text-4xl font-bold text-[#1B3629]">
                    Reserve Your Session
                </h2>
            </div>

            <!-- Global Validation Error Banner -->
            @if ($errors->any())
                <div class="p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl text-xs space-y-1 shadow-xs">
                    <p class="font-bold flex items-center gap-1.5 text-red-800 mb-1">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Please fix the following issues:
                    </p>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Service Summary Card -->
            <div class="bg-[#FAF8F5] border border-[#E2DDD5] rounded-2xl p-5 flex items-center justify-between shadow-inner relative overflow-hidden">
                <div class="absolute top-0 left-0 bottom-0 w-1.5 bg-gradient-to-b from-[#1B3629] via-[#D4AF37] to-[#1B3629]"></div>
                <div class="space-y-1 pl-2">
                    <span class="text-[10px] uppercase text-[#837B70] font-bold tracking-wider">Selected Treatment</span>
                    <h3 class="font-serif-title text-xl font-bold text-[#1B3629]">{{ $service->title ?? $service->name }}</h3>
                    <p class="text-xs text-[#706B63] max-w-md pt-0.5">{{ $service->description }}</p>
                    <div class="pt-1">
                        <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-[#1B3629] bg-white border border-[#E2DDD5] px-2.5 py-0.5 rounded-md">
                            ⏱ {{ $service->duration_minutes }} Mins
                        </span>
                    </div>
                </div>
                <div class="text-right shrink-0 pl-4">
                    <span class="text-[10px] uppercase text-[#837B70] font-bold tracking-wider block">Investment</span>
                    <span class="text-lg font-extrabold text-[#1B3629]">RM {{ number_format($service->price ?? 0, 2) }}</span>
                </div>
            </div>

            <form action="/appointments" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="service_id" value="{{ $service->id }}">

                <!-- Guest Contact Details -->
                <div class="space-y-4 p-6 bg-[#FAF8F5]/80 rounded-2xl border border-[#EBE6DD]">
                    <div class="flex items-center gap-2 border-b border-[#E8E2D8] pb-3">
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <h3 class="text-xs font-bold uppercase tracking-wider text-[#1B3629]">Contact Information</h3>
                    </div>

                    <div>
                        <label class="block text-xs font-bold mb-1.5 text-[#1B3629]">Full Name *</label>
                        <input type="text" name="client_name" required value="{{ old('client_name') }}" placeholder="Enter your full name" 
                            class="w-full p-3.5 bg-white border border-[#E2DDD5] rounded-xl text-xs font-medium text-[#1B3629] placeholder-[#A09A90] focus:outline-none focus:border-[#1B3629] focus:ring-1 focus:ring-[#1B3629] transition shadow-xs">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold mb-1.5 text-[#1B3629]">Phone Number *</label>
                            <input type="tel" name="client_phone" required value="{{ old('client_phone') }}" placeholder="e.g. +60123456789" 
                                class="w-full p-3.5 bg-white border border-[#E2DDD5] rounded-xl text-xs font-medium text-[#1B3629] placeholder-[#A09A90] focus:outline-none focus:border-[#1B3629] focus:ring-1 focus:ring-[#1B3629] transition shadow-xs">
                        </div>
                        <div>
                            <label class="block text-xs font-bold mb-1.5 text-[#1B3629]">Email Address</label>
                            <input type="email" name="client_email" value="{{ old('client_email') }}" placeholder="client@example.com" 
                                class="w-full p-3.5 bg-white border border-[#E2DDD5] rounded-xl text-xs font-medium text-[#1B3629] placeholder-[#A09A90] focus:outline-none focus:border-[#1B3629] focus:ring-1 focus:ring-[#1B3629] transition shadow-xs">
                        </div>
                    </div>
                </div>

                <!-- Date & Time Picker Section -->
                <div class="p-6 bg-[#FAF8F5]/80 rounded-2xl border border-[#EBE6DD] space-y-4">
                    <div class="flex items-center justify-between border-b border-[#E8E2D8] pb-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <label for="appointment_date" class="block text-xs font-bold uppercase tracking-wider text-[#1B3629]">Select Date & Time *</label>
                        </div>
                    </div>

                    <div class="text-xs text-[#706B63] bg-white border border-[#E8E2D9] p-3 rounded-xl flex items-center gap-2.5 shadow-xs">
                        <svg class="w-4 h-4 text-[#1B3629] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Operating Hours: <strong class="text-[#1B3629] font-semibold">8:30 AM – 10:30 PM</strong> daily.</span>
                    </div>

                    <div class="relative">
                        <input type="text" id="appointment_date" name="appointment_date" required placeholder="Select preferred date & time..." 
                            class="w-full p-3.5 bg-white border border-[#E2DDD5] rounded-xl text-xs font-semibold text-[#1B3629] placeholder-[#A09A90] cursor-pointer focus:outline-none focus:border-[#1B3629] focus:ring-1 focus:ring-[#1B3629] transition shadow-xs">
                    </div>

                    <div id="booked-slots-preview" class="hidden text-xs bg-red-50/90 border border-red-200 text-red-700 p-4 rounded-xl space-y-2.5 transition-all">
                        <div id="overlap-alert-message" class="hidden font-bold text-red-800 bg-red-100/90 border border-red-300 p-3 rounded-lg flex items-start gap-2.5 shadow-xs">
                            <svg class="w-4 h-4 text-red-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>This selected time overlaps with an existing appointment. Please choose another slot!</span>
                        </div>

                        <div class="font-bold flex items-center gap-1.5 pt-1 text-red-800">
                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            Reserved Slots on Selected Date:
                        </div>
                        <ul id="booked-slots-list" class="list-disc list-inside space-y-1 text-[11px] font-medium text-red-700 pl-1"></ul>
                    </div>

                    @error('appointment_date')
                        <p class="text-xs text-red-600 mt-1 font-medium flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Emergency Contact Section -->
                <div class="p-6 bg-[#FAF8F5]/80 rounded-2xl border border-[#EBE6DD] space-y-4">
                    <div class="flex items-center gap-2 border-b border-[#E8E2D8] pb-3">
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <h3 class="text-xs font-bold uppercase tracking-wider text-[#1B3629]">Emergency Contact</h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold mb-1.5 text-[#1B3629]">Contact Name *</label>
                            <input type="text" name="emergency_contact_name" required value="{{ old('emergency_contact_name') }}" placeholder="Full Name" 
                                class="w-full p-3.5 bg-white border border-[#E2DDD5] rounded-xl text-xs font-medium text-[#1B3629] placeholder-[#A09A90] focus:outline-none focus:border-[#1B3629] focus:ring-1 focus:ring-[#1B3629] transition shadow-xs">
                        </div>
                        <div>
                            <label class="block text-xs font-bold mb-1.5 text-[#1B3629]">Contact Phone *</label>
                            <input type="tel" id="emergency_contact_phone" name="emergency_contact_phone" required value="{{ old('emergency_contact_phone') }}" placeholder="e.g. +60123456789" 
                                class="w-full p-3.5 bg-white border border-[#E2DDD5] rounded-xl text-xs font-medium text-[#1B3629] placeholder-[#A09A90] focus:outline-none focus:border-[#1B3629] focus:ring-1 focus:ring-[#1B3629] transition shadow-xs">
                            
                            <p id="emergency-phone-error" class="hidden text-[11px] text-red-600 mt-1.5 font-semibold">
                                Please enter a valid Malaysian phone number (e.g. +60123456789 or 0123456789).
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Submit CTA Container Box -->
                <div class="bg-[#0F231A] text-white p-6 rounded-2xl shadow-xl space-y-4 border border-[#173326]">
                    <div class="flex items-center justify-between border-b border-[#1A3B2C] pb-4">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-[#D4AF37]">Total Investment</span>
                        <span class="text-xl font-bold tracking-tight text-white">
                            RM {{ number_format($service->price ?? 0, 2) }}
                        </span>
                    </div>

                    <button type="submit" id="submit-btn" class="w-full bg-[#D4AF37] hover:bg-[#C2A02E] active:bg-[#B39327] text-[#0F231A] font-bold text-sm py-3.5 px-6 rounded-xl transition flex items-center justify-center gap-2 group shadow-md disabled:opacity-50 disabled:cursor-not-allowed">
                        <span>Confirm & Schedule Appointment</span>
                        <svg class="w-4 h-4 text-[#0F231A] group-hover:translate-x-1 transition-transform stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>

                    <p class="text-[11px] text-center text-[#90A39A] font-medium tracking-wide">
                        Payment will be settled upon appointment completion.
                    </p>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center py-6 text-xs font-medium text-[#837B70] z-10">
        &copy; {{ date('Y') }} Kak Rose Urutan Melayu. All rights reserved.
    </footer>

    <!-- JS -->
    <script>
        const rawBookedSlots = @json($bookedSlots ?? []);
        
        const bookedSlots = rawBookedSlots.filter(slot => {
            const status = (slot.status || '').toLowerCase();
            return status === 'pending' || status === 'confirmed';
        });

        const serviceDuration = parseInt("{{ $service->duration_minutes ?? 45 }}", 10);
        const phoneRegex = /^(\+?60|0)1[0-9]{8,9}$/;

        let hasTimeOverlap = false;

        const submitBtn = document.getElementById('submit-btn');
        const emergencyPhoneInput = document.getElementById('emergency_contact_phone');
        const emergencyPhoneError = document.getElementById('emergency-phone-error');

        function validatePhoneField(inputEl, errorEl) {
            if (!inputEl) return true;
            const val = inputEl.value.trim();
            if (val.length === 0) return true;
            
            const isValid = phoneRegex.test(val);

            if (!isValid) {
                if (errorEl) errorEl.classList.remove('hidden');
                inputEl.classList.add('border-red-500');
                inputEl.classList.remove('border-[#E2DDD5]');
            } else {
                if (errorEl) errorEl.classList.add('hidden');
                inputEl.classList.remove('border-red-500');
                inputEl.classList.add('border-[#E2DDD5]');
            }
            return isValid;
        }

        function updateSubmitState() {
            if (!submitBtn) return;
            const emergencyOk = validatePhoneField(emergencyPhoneInput, emergencyPhoneError);
            submitBtn.disabled = hasTimeOverlap || !emergencyOk;
        }

        if (emergencyPhoneInput) {
            emergencyPhoneInput.addEventListener('input', updateSubmitState);
            emergencyPhoneInput.addEventListener('blur', updateSubmitState);
        }

        function timeToMinutes(timeStr) {
            if (!timeStr) return 0;
            const parts = timeStr.trim().split(' ')[1] ? timeStr.trim().split(' ')[1].split(':') : timeStr.trim().split(':');
            const hours = parseInt(parts[0], 10) || 0;
            const minutes = parseInt(parts[1], 10) || 0;
            return (hours * 60) + minutes;
        }

        function checkOverlapAndRender() {
            const dateInput = document.getElementById('appointment_date');
            const previewContainer = document.getElementById('booked-slots-preview');
            const listContainer = document.getElementById('booked-slots-list');
            const alertMessage = document.getElementById('overlap-alert-message');

            if (!dateInput || !dateInput.value) {
                if (alertMessage) alertMessage.classList.add('hidden');
                if (previewContainer) previewContainer.classList.add('hidden');
                hasTimeOverlap = false;
                updateSubmitState();
                return;
            }

            const [selDate, selTime] = dateInput.value.trim().split(' ');

            if (!selDate || !selTime) {
                hasTimeOverlap = false;
                updateSubmitState();
                return;
            }

            const dayBookings = bookedSlots.filter(slot => slot.date === selDate);

            if (dayBookings.length > 0) {
                listContainer.innerHTML = dayBookings.map(slot => {
                    const startPart = slot.start.split(' ')[1] ? slot.start.split(' ')[1].substring(0, 5) : '00:00';
                    const endPart = slot.end.split(' ')[1] ? slot.end.split(' ')[1].substring(0, 5) : '00:00';
                    return `<li>${startPart} – ${endPart} (Reserved)</li>`;
                }).join('');
                previewContainer.classList.remove('hidden');
            } else {
                previewContainer.classList.add('hidden');
            }

            const selStartMin = timeToMinutes(selTime);
            const selEndMin = selStartMin + serviceDuration;

            hasTimeOverlap = dayBookings.some(slot => {
                const resStartMin = timeToMinutes(slot.start);
                const resEndMin = timeToMinutes(slot.end);

                return (selStartMin < resEndMin) && (selEndMin > resStartMin);
            });

            if (hasTimeOverlap) {
                alertMessage.classList.remove('hidden');
                previewContainer.classList.remove('hidden');
            } else {
                alertMessage.classList.add('hidden');
            }

            updateSubmitState();
        }

        const fp = flatpickr("#appointment_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            altInput: true,
            altFormat: "F j, Y @ h:i K",
            altInputClass: "w-full p-3.5 bg-white border border-[#E2DDD5] rounded-xl text-xs font-semibold text-[#1B3629] placeholder-[#A09A90] cursor-pointer focus:outline-none focus:border-[#1B3629] focus:ring-1 focus:ring-[#1B3629] transition shadow-xs",
            minDate: "today",
            minTime: "08:30",
            maxTime: "22:30",
            minuteIncrement: 30,
            
            onDayCreate: function(dObj, dStr, fpInstance, dayElem) {
                if (!dayElem.dateObj) return;
                const d = dayElem.dateObj;
                const dateStr = d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0') + '-' + String(d.getDate()).padStart(2, '0');
                
                const hasBookings = bookedSlots.some(slot => slot.date === dateStr);
                if (hasBookings) {
                    dayElem.innerHTML += `<span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-red-500 rounded-full pointer-events-none"></span>`;
                }
            },

            onChange: function() {
                setTimeout(checkOverlapAndRender, 50);
            },
            onClose: function() {
                setTimeout(checkOverlapAndRender, 50);
            }
        });

        document.getElementById('appointment_date').addEventListener('change', checkOverlapAndRender);
    </script>
</body>
</html>