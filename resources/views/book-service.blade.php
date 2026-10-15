<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book {{ $service->title ?? $service->name }} - Kak Rose Urutan Melayu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Flatpickr CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-serif-title { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#FAF8F5] text-[#2C3531] min-h-screen antialiased">

    <!-- Top Navigation Header -->
    <header class="bg-[#F4F0E8] border-b border-[#E8E2D8] px-6 py-4">
        <div class="max-w-3xl mx-auto flex justify-between items-center">
            <a href="{{ route('services.index') }}" class="text-xs font-semibold text-[#1B3629] hover:underline flex items-center gap-1.5 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Treatment Menu
            </a>

            <div class="text-xs font-semibold text-[#1B3629]">
                @auth
                    <span class="flex items-center gap-1.5 bg-white border border-[#E2DDD5] px-3 py-1 rounded-full shadow-sm">
                        <svg class="w-3.5 h-3.5 text-[#1B3629]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        {{ Auth::user()->name }}
                    </span>
                @else
                    <a href="/login" class="text-[#837B70] hover:text-[#1B3629] transition">Have a member account? <span class="underline font-bold text-[#1B3629]">Log In</span></a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="max-w-3xl mx-auto p-6 md:p-10">
        <div class="bg-white border border-[#EBE6DD] rounded-2xl p-6 md:p-10 shadow-sm">
            
            <!-- Service Info Banner -->
            <div class="mb-8 pb-6 border-b border-[#F2EFE9]">
                <span class="text-[10px] font-bold uppercase tracking-widest text-[#837B70]">Booking Session</span>
                <h2 class="font-serif-title text-2xl md:text-3xl font-bold text-[#1B3629] mt-1">
                    {{ $service->title ?? $service->name }}
                </h2>
                <p class="text-xs text-[#706B63] mt-2 leading-relaxed">
                    {{ $service->description }}
                </p>
                <div class="flex items-center gap-4 mt-4 text-xs text-[#706B63]">
                    <span class="bg-[#FAF8F5] px-3 py-1 rounded-md border border-[#EBE6DD] font-semibold">⏱ {{ $service->duration_minutes }} Mins</span>
                    <span>•</span>
                    <span class="font-bold text-[#1B3629] text-base">RM {{ number_format($service->price, 2) }}</span>
                </div>
            </div>

            <form action="/appointments" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="service_id" value="{{ $service->id }}">

                <!-- Guest Contact Details (Shown if NOT Logged In) -->
                @guest
                <div class="space-y-4 pb-6 border-b border-[#F2EFE9]">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-[#1B3629]">Guest Client Information</h3>
                    
                    <div>
                        <label class="block text-xs font-semibold text-[#1B3629] mb-1">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="guest_name" required value="{{ old('guest_name') }}"
                               class="w-full px-3.5 py-2.5 bg-[#FAF8F5] border border-[#E2DDD5] rounded-xl text-sm focus:outline-none focus:border-[#1B3629]">
                        @error('guest_name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-[#1B3629] mb-1">Phone Number <span class="text-red-500">*</span></label>
                            <input type="tel" id="guest_phone" name="guest_phone" required value="{{ old('guest_phone') }}" placeholder="e.g. 0123456789"
                                   class="w-full px-3.5 py-2.5 bg-[#FAF8F5] border border-[#E2DDD5] rounded-xl text-sm focus:outline-none focus:border-[#1B3629] transition-colors">
                            <p id="guest-phone-error" class="hidden text-xs text-red-600 mt-1.5 font-medium">Please enter a valid Malaysian phone number.</p>
                            @error('guest_phone') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-[#1B3629] mb-1">Email Address <span class="text-[#837B70] font-normal">(Optional)</span></label>
                            <input type="email" name="guest_email" value="{{ old('guest_email') }}" placeholder="e.g. client@email.com"
                                   class="w-full px-3.5 py-2.5 bg-[#FAF8F5] border border-[#E2DDD5] rounded-xl text-sm focus:outline-none focus:border-[#1B3629]">
                        </div>
                    </div>
                </div>
                @endguest

                <!-- Date & Time Selection Card -->
                <div class="bg-white border border-[#EBE6DD] rounded-2xl p-6 md:p-8 shadow-sm space-y-4">
                    <label for="appointment_date" class="block text-xs font-bold uppercase tracking-wider text-[#1B3629]">
                        Select Date & Time <span class="text-red-500">*</span>
                    </label>
                    
                    <!-- Operating Hours Banner -->
                    <div class="text-xs text-[#706B63] bg-[#FAF8F5] border border-[#E8E2D9] p-3 rounded-xl flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-[#1B3629] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Operating Hours: <strong class="text-[#1B3629]">8:30 AM – 10:30 PM</strong> daily.</span>
                    </div>

                    <!-- Date Input Container -->
                    <div class="relative">
                        <input 
                            type="text" 
                            id="appointment_date" 
                            name="appointment_date" 
                            required 
                            placeholder="Click to choose date and time..."
                            class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#1B3629] text-sm bg-slate-50/50 cursor-pointer text-[#1B3629] font-medium"
                        >
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Booked Slots & Overlap Error Banner -->
                    <div id="booked-slots-preview" class="hidden text-xs bg-red-50 border border-red-200 text-red-700 p-3.5 rounded-xl space-y-2">
                        <div id="overlap-alert-message" class="hidden font-bold text-red-800 bg-red-100 border border-red-300 p-2.5 rounded-lg flex items-center gap-2">
                            <svg class="w-4 h-4 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>This selected time overlaps with an existing appointment. Please choose another slot!</span>
                        </div>

                        <div class="font-bold flex items-center gap-1.5 pt-1">
                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            Reserved Slots on Selected Date:
                        </div>
                        <ul id="booked-slots-list" class="list-disc list-inside space-y-0.5 text-[11px] font-medium text-red-600"></ul>
                    </div>

                    @error('appointment_date')
                        <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Client Intake Form Card -->
                <div class="bg-white border border-[#EBE6DD] rounded-2xl p-6 md:p-8 shadow-sm space-y-6">
                    <div class="border-b border-[#EBE6DD] pb-4">
                        <h3 class="font-serif text-lg font-bold text-[#1B3629]">Client Health & Intake Details</h3>
                        <p class="text-xs text-[#8C7A6B] mt-0.5">Help us tailor your treatment session to your specific body needs.</p>
                    </div>

                    <!-- Postpartum Status -->
                    <div>
                        <label class="block text-xs font-semibold text-[#1B3629] mb-1">Postpartum Status</label>
                        <select name="postpartum_status" class="w-full px-3.5 py-2.5 bg-[#FAF8F5] border border-[#E2DDD5] rounded-xl text-sm focus:outline-none focus:border-[#1B3629]">
                            <option value="No">No / Not Postpartum</option>
                            <option value="Yes (< 6 months)">Yes (Less than 6 months postpartum)</option>
                            <option value="Yes (> 6 months)">Yes (More than 6 months postpartum)</option>
                        </select>
                    </div>

                    <!-- Areas of Soreness -->
                    <div>
                        <label class="block text-xs font-semibold text-[#1B3629] mb-2">
                            Areas of Soreness / Target Focus <span class="text-[#837B70] font-normal">(Select all that apply)</span>
                        </label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                            @php
                                $sorenessOptions = [
                                    'Lower Back', 'Shoulders & Neck', 'Upper Back',
                                    'Hips & Pelvis', 'Legs & Calves', 'Joint / Knee Pain',
                                    'Arms & Wrists', 'Abdominal / Sengkak'
                                ];
                            @endphp

                            @foreach($sorenessOptions as $option)
                                <label class="flex items-center gap-2 p-2.5 bg-[#FAF8F5] border border-[#E2DDD5] rounded-xl cursor-pointer hover:border-[#1B3629] transition">
                                    <input type="checkbox" name="soreness_areas[]" value="{{ $option }}" class="w-4 h-4 accent-[#1B3629] rounded">
                                    <span class="text-xs text-[#2C3531] font-medium">{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Additional Details Text Area -->
                    <div>
                        <label class="block text-xs font-semibold text-[#1B3629] mb-1">
                            Specific Problems or Notes <span class="text-[#837B70] font-normal">(Optional)</span>
                        </label>
                        <textarea name="soreness_details" rows="3" placeholder="e.g. Pain worsens when sitting, feeling wind in body, previous caesarean section..." 
                                  class="w-full px-3.5 py-2.5 bg-[#FAF8F5] border border-[#E2DDD5] rounded-xl text-sm focus:outline-none focus:border-[#1B3629]"></textarea>
                    </div>

                    <!-- Emergency Contact -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                        <div>
                            <label class="block text-xs font-semibold text-[#1B3629] mb-1">
                                Emergency Contact Name <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="emergency_contact_name" 
                                value="{{ old('emergency_contact_name', Auth::user()->name ?? '') }}"
                                placeholder="Full Name" 
                                required 
                                class="w-full px-3.5 py-2.5 bg-[#FAF8F5] border border-[#E2DDD5] rounded-xl text-sm focus:outline-none focus:border-[#1B3629]"
                            >
                            @error('emergency_contact_name')
                                <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#1B3629] mb-1">
                                Emergency Contact Phone <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="tel" 
                                id="emergency_contact_phone"
                                name="emergency_contact_phone" 
                                value="{{ old('emergency_contact_phone', Auth::user()->phone ?? '') }}"
                                placeholder="e.g. 0123456789" 
                                required 
                                class="w-full px-3.5 py-2.5 bg-[#FAF8F5] border border-[#E2DDD5] rounded-xl text-sm focus:outline-none focus:border-[#1B3629] transition-colors"
                            >
                            
                            <!-- Frontend Validation Error Text -->
                            <p id="emergency-phone-error" class="hidden text-xs text-red-600 mt-1.5 font-medium">
                                Please enter a valid Malaysian phone number.
                            </p>

                            <!-- Backend Laravel Error Text -->
                            @error('emergency_contact_phone')
                                <p class="text-xs text-red-600 mt-1.5 font-medium">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="submit-btn" class="w-full bg-[#1B3629] text-white py-3.5 rounded-xl font-semibold text-sm hover:bg-[#2C4D3B] transition shadow-md mt-6 disabled:opacity-50 disabled:cursor-not-allowed">
                    Confirm & Schedule Appointment
                </button>
            </form>
        </div>
    </main>

    <!-- JS -->
    <script>
        const rawBookedSlots = @json($bookedSlots ?? []);
        
        // Filter: Keep pending & confirmed slots; exclude completed & cancelled
        const bookedSlots = rawBookedSlots.filter(slot => {
            const status = (slot.status || '').toLowerCase();
            return status === 'pending' || status === 'confirmed';
        });

        const serviceDuration = {{ $service->duration_minutes ?? 60 }};
        const phoneRegex = /^(\+?60|0)1[0-9]{8,9}$/;

        let hasTimeOverlap = false;
        let isEmergencyPhoneValid = true;
        let isGuestPhoneValid = true;

        const submitBtn = document.getElementById('submit-btn');
        const emergencyPhoneInput = document.getElementById('emergency_contact_phone');
        const emergencyPhoneError = document.getElementById('emergency-phone-error');
        const guestPhoneInput = document.getElementById('guest_phone');
        const guestPhoneError = document.getElementById('guest-phone-error');
        const dateInput = document.getElementById('appointment_date');

        function updateSubmitState() {
            if (!submitBtn) return;
            
            // Check if phone inputs pass regex validation
            const emergencyOk = validatePhoneField(emergencyPhoneInput, emergencyPhoneError);
            const guestOk = guestPhoneInput ? validatePhoneField(guestPhoneInput, guestPhoneError) : true;
            
            // Only disable if there is an explicit time overlap error or invalid phone format
            const isBlocked = hasTimeOverlap || !emergencyOk || !guestOk;
            
            submitBtn.disabled = isBlocked;
        }

        function validatePhoneField(inputEl, errorEl) {
            if (!inputEl) return true;
            const val = inputEl.value.trim();
            if (val.length === 0) return true; // Let browser HTML5 required handle empty state on submit
            
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

        function handlePhoneValidation() {
            isEmergencyPhoneValid = validatePhoneField(emergencyPhoneInput, emergencyPhoneError);
            isGuestPhoneValid = validatePhoneField(guestPhoneInput, guestPhoneError);
            updateSubmitState();
        }

        if (emergencyPhoneInput) {
            emergencyPhoneInput.addEventListener('input', handlePhoneValidation);
            emergencyPhoneInput.addEventListener('blur', handlePhoneValidation);
        }

        if (guestPhoneInput) {
            guestPhoneInput.addEventListener('input', handlePhoneValidation);
            guestPhoneInput.addEventListener('blur', handlePhoneValidation);
        }

        function getLocalDateString(dateObj) {
            return flatpickr.formatDate(dateObj, "Y-m-d");
        }

        const fp = flatpickr("#appointment_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            altInput: true,
            altFormat: "F j, Y @ h:i K",
            altInputClass: "w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#1B3629] text-sm bg-slate-50/50 cursor-pointer text-[#1B3629] font-medium",
            minDate: "today",
            minTime: "08:30",
            maxTime: "22:30",
            minuteIncrement: 30,
            
            onDayCreate: function(dObj, dStr, fpInstance, dayElem) {
                if (!dayElem.dateObj) return;
                const dateStr = getLocalDateString(dayElem.dateObj);
                
                const hasBookings = bookedSlots.some(slot => slot.date === dateStr);
                if (hasBookings) {
                    dayElem.innerHTML += `<span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-red-500 rounded-full pointer-events-none"></span>`;
                }
            },

            onChange: function(selectedDates) {
                const previewContainer = document.getElementById('booked-slots-preview');
                const listContainer = document.getElementById('booked-slots-list');
                const alertMessage = document.getElementById('overlap-alert-message');

                if (!selectedDates.length) {
                    if (alertMessage) alertMessage.classList.add('hidden');
                    if (previewContainer) previewContainer.classList.add('hidden');
                    hasTimeOverlap = false;
                    updateSubmitState();
                    return;
                }

                const selectedStart = selectedDates[0];
                const selectedEnd = new Date(selectedStart.getTime() + serviceDuration * 60000);
                const selectedDateOnly = getLocalDateString(selectedStart);

                const dayBookings = bookedSlots.filter(slot => slot.date === selectedDateOnly);
                
                if (dayBookings.length > 0) {
                    listContainer.innerHTML = dayBookings.map(slot => {
                        // slot.start format: "YYYY-MM-DD HH:mm:ss"
                        const parts = slot.start.split(' ');
                        const timePart = parts[1] ? parts[1].substring(0, 5) : '';
                        const endPart = slot.end ? slot.end.split(' ')[1].substring(0, 5) : '';
                        return `<li>${timePart} – ${endPart} (Reserved)</li>`;
                    }).join('');
                    previewContainer.classList.remove('hidden');
                } else {
                    previewContainer.classList.add('hidden');
                }

                // Robust time overlap check using timestamp comparisons
                hasTimeOverlap = dayBookings.some(slot => {
                    // Split "YYYY-MM-DD HH:mm:ss" into components safely
                    const [startDateStr, startTimeStr] = slot.start.split(' ');
                    const [endDateStr, endTimeStr] = slot.end.split(' ');

                    const [sYear, sMonth, sDay] = startDateStr.split('-').map(Number);
                    const [sHour, sMin, sSec] = startTimeStr.split(':').map(Number);
                    
                    const [eYear, eMonth, eDay] = endDateStr.split('-').map(Number);
                    const [eHour, eMin, eSec] = endTimeStr.split(':').map(Number);

                    const existingStart = new Date(sYear, sMonth - 1, sDay, sHour, sMin, sSec || 0);
                    const existingEnd = new Date(eYear, eMonth - 1, eDay, eHour, eMin, eSec || 0);

                    return (selectedStart < existingEnd && selectedEnd > existingStart);
                });

                if (hasTimeOverlap) {
                    alertMessage.classList.remove('hidden');
                    previewContainer.classList.remove('hidden');
                } else {
                    alertMessage.classList.add('hidden');
                }

                updateSubmitState();
            }
        });
    </script>
</body>
</html>