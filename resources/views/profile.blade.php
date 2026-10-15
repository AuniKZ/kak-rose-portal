<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Account Profile - Kak Rose Urutan Melayu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-serif-title { font-family: 'Playfair Display', serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#FBF9F5] text-[#2C3531] min-h-screen selection:bg-[#1B3629] selection:text-white" 
      x-data="{ 
          cancelModalOpen: false, 
          editProfileOpen: false, 
          selectedAppointmentId: null, 
          cancelReason: 'Change of plans', 
          otherReason: '' 
      }">

    <!-- Top Navigation Header -->
        <header class="bg-white/80 backdrop-blur-md border-b border-[#E8E2D8] sticky top-0 z-40">
            <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
                
                <!-- Brand Logo & Title -->
                <a href="/" class="flex items-center gap-3 transition hover:opacity-80 active:scale-95 duration-200">
                    <img src="{{ asset('images/logo.png') }}" alt="Kak Rose Urutan Melayu" class="h-14 md:h-16 w-auto object-contain py-1">
                </a>

                <!-- Navigation Actions -->
                <div class="flex items-center gap-5 text-xs font-semibold text-[#1B3629]">
                    <a href="/" class="hover:text-[#8C7A6B] flex items-center gap-1.5 transition-colors">
                        <svg class="w-4 h-4 text-[#8C7A6B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        <span>Back to Home</span>
                    </a>
                    <span class="border-l border-[#E2DDD5] h-4"></span>
                    <span class="px-2.5 py-1 bg-[#F2EFE9] text-[#1B3629] rounded-full text-[11px] font-bold">{{ $user->name }}</span>
                    <form action="/logout" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-[#837B70] hover:text-red-600 transition-colors">Log Out</button>
                    </form>
                </div>
            </div>
        </header>

    <main class="max-w-6xl mx-auto px-6 py-8 md:py-12 space-y-8">
        
        <!-- Welcome Banner -->
        <div class="relative overflow-hidden bg-gradient-to-r from-[#1B3629] via-[#2A4D3B] to-[#1B3629] rounded-3xl p-8 text-white shadow-lg">
            <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-[#D4AF37]/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#D4AF37] bg-white/10 backdrop-blur-md px-3 py-1 rounded-full border border-white/10">Client Portal</span>
                    <h2 class="font-serif-title text-3xl md:text-4xl font-bold mt-2">Welcome Back, {{ explode(' ', $user->name)[0] }}</h2>
                    <p class="text-[#D3DEC9] text-xs sm:text-sm mt-1 max-w-xl">Manage your personal details, wellness intake records, and active therapy sessions.</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="/services" class="inline-flex items-center gap-2 bg-[#D4AF37] hover:bg-[#C29F2E] text-[#1B3629] font-bold text-xs px-5 py-3 rounded-2xl transition shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>New Session</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl text-xs font-semibold flex items-center gap-2 shadow-sm">
                <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl text-xs font-semibold space-y-1 shadow-sm">
                @foreach($errors->all() as $error)
                    <p class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 inline-block"></span>
                        <span>{{ $error }}</span>
                    </p>
                @endforeach
            </div>
        @endif

        <!-- Profile & Health Overview Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Profile Info Card -->
            <div class="bg-white border border-[#E8E2D8] rounded-3xl p-6 shadow-sm hover:shadow-md transition flex flex-col justify-between relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-[#F9F8F3] rounded-bl-full -z-0"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-5">
                        <div class="w-16 h-16 bg-[#1B3629] text-[#D4AF37] rounded-2xl flex items-center justify-center font-serif-title font-bold text-xl shadow-inner border border-[#D4AF37]/30">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <button @click="editProfileOpen = true" class="px-3.5 py-1.5 bg-[#F4F0E8] border border-[#E2DDD5] text-[#1B3629] hover:bg-[#1B3629] hover:text-white rounded-xl text-xs font-bold transition shadow-sm">
                            Edit Profile
                        </button>
                    </div>
                    <h3 class="font-serif-title text-xl font-bold text-[#1B3629]">{{ $user->name }}</h3>
                    
                    <div class="mt-3 space-y-2 text-xs">
                        <div class="flex items-center gap-2 text-[#706B63]">
                            <svg class="w-4 h-4 text-[#8C7A6B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span class="truncate">{{ $user->email }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-[#706B63]">
                            <svg class="w-4 h-4 text-[#8C7A6B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>{{ $user->phone ?? 'No phone added' }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-5 border-t border-[#F2EFE9] flex justify-between items-center text-xs relative z-10">
                    <span class="text-[#837B70] font-medium">Total Bookings</span>
                    <span class="font-bold bg-[#1B3629] text-white px-3 py-1 rounded-full text-[11px] shadow-sm">
                        {{ $user->appointments->count() }} Sessions
                    </span>
                </div>
            </div>

            <!-- Health Intake Card -->
            @php $latestIntake = $user->intakeForms->last(); @endphp
            <div class="md:col-span-2 bg-white border border-[#E8E2D8] rounded-3xl p-6 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between pb-4 border-b border-[#F2EFE9] mb-4">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#1B3629]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            <h3 class="font-serif-title text-lg font-bold text-[#1B3629]">Health & Medical Intake Assessment</h3>
                        </div>
                        <span class="text-[10px] uppercase tracking-wider font-bold text-[#8C7A6B] bg-[#FAF8F5] px-2.5 py-1 rounded-lg border border-[#E8E2D8]">Confidential</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
                        <div class="p-3.5 bg-[#FAF8F5] rounded-2xl border border-[#F2EFE9]">
                            <span class="text-[#837B70] font-medium block mb-0.5">Postpartum Status</span>
                            <span class="font-bold text-[#1B3629] text-sm">{{ $latestIntake->postpartum_status ?? 'Not Specified' }}</span>
                        </div>
                        <div class="p-3.5 bg-[#FAF8F5] rounded-2xl border border-[#F2EFE9]">
                            <span class="text-[#837B70] font-medium block mb-0.5">Emergency Contact</span>
                            <span class="font-bold text-[#1B3629] text-sm">{{ $latestIntake->emergency_contact_name ?? 'N/A' }} <span class="text-xs text-[#837B70] font-normal">({{ $latestIntake->emergency_contact_phone ?? 'N/A' }})</span></span>
                        </div>
                        <div class="md:col-span-2 p-3.5 bg-[#FAF8F5] rounded-2xl border border-[#F2EFE9]">
                            <span class="text-[#837B70] font-medium block mb-0.5">Target Areas / Soreness Focus</span>
                            <span class="font-bold text-[#1B3629] text-sm leading-relaxed block">{{ $latestIntake->soreness_areas ?? 'None specified' }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-[11px] text-[#A3998C] italic flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-[#A3998C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>This background helps our therapist tailor session pressure and traditional herbs safely.</span>
                </div>
            </div>

        </div>

        <!-- Appointment History Section -->
        <div class="bg-white rounded-3xl border border-[#E8E2D8] p-6 md:p-8 shadow-sm">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-[#F2EFE9] mb-6">
                <div>
                    <h3 class="font-serif-title text-2xl font-bold text-[#1B3629]">Appointment History</h3>
                    <p class="text-xs text-[#706B63] mt-1">Manage your active, upcoming, and recent treatment sessions.</p>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <form method="GET" action="{{ route('profile') }}" class="flex flex-wrap items-center gap-2">
                        <select name="filter" onchange="this.form.submit()" 
                            class="text-xs bg-[#FAF8F5] border border-[#E2DDD5] text-[#1B3629] font-semibold px-3 py-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1B3629] shadow-sm">
                            <option value="all" {{ request('filter') === 'all' ? 'selected' : '' }}>All Appointments</option>
                            <option value="upcoming" {{ request('filter') === 'upcoming' ? 'selected' : '' }}>Upcoming Only</option>
                            <option value="past" {{ request('filter') === 'past' ? 'selected' : '' }}>Past Sessions</option>
                        </select>

                        <select name="sort" onchange="this.form.submit()" 
                            class="text-xs bg-[#FAF8F5] border border-[#E2DDD5] text-[#1B3629] font-semibold px-3 py-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1B3629] shadow-sm">
                            <option value="recent" {{ request('sort', 'recent') === 'recent' ? 'selected' : '' }}>Sort: Recently Booked</option>
                            <option value="upcoming" {{ request('sort') === 'upcoming' ? 'selected' : '' }}>Sort: By Date (Earliest)</option>
                        </select>
                    </form>

                    <a href="/services" class="bg-[#1B3629] hover:bg-[#2A4D3B] text-white text-xs font-bold px-4 py-2 rounded-xl transition shadow-sm inline-flex items-center gap-1.5">
                        <span>Book New</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </a>
                </div>
            </div>

            <!-- Table Wrapper -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[10px] uppercase tracking-wider font-bold text-[#8C7A6B] border-b border-[#F2EFE9] pb-3">
                            <th class="pb-3 px-2">Date & Time</th>
                            <th class="pb-3 px-2">Therapy Service</th>
                            <th class="pb-3 px-2">Duration</th>
                            <th class="pb-3 px-2">Investment</th>
                            <th class="pb-3 px-2">Status</th>
                            <th class="pb-3 px-2 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#F4F0E8] text-sm">
                        @forelse ($appointments as $appointment)
                            <tr class="hover:bg-[#FAF8F5]/80 transition group">
                                <td class="py-4 px-2 font-semibold text-[#1B3629]">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-[#8C7A6B] group-hover:text-[#1B3629] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <span>{{ \Carbon\Carbon::parse($appointment->start_time)->format('d M Y, h:i A') }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-2 font-medium text-slate-700">
                                    {{ $appointment->service->title ?? $appointment->service->name }}
                                </td>
                                <td class="py-4 px-2 text-xs text-[#837B70]">
                                    <span class="bg-[#F2EFE9] px-2.5 py-1 rounded-md font-semibold text-[#1B3629]">
                                        {{ $appointment->service->duration_minutes ?? 60 }} Mins
                                    </span>
                                </td>
                                <td class="py-4 px-2 font-bold text-[#1B3629]">
                                    RM {{ number_format($appointment->service->price, 2) }}
                                </td>
                                <td class="py-4 px-2">
                                    <span class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full border
                                        {{ $appointment->status === 'confirmed' ? 'bg-emerald-50 text-emerald-800 border-emerald-200' : '' }}
                                        {{ $appointment->status === 'pending' ? 'bg-amber-50 text-amber-800 border-amber-200' : '' }}
                                        {{ $appointment->status === 'completed' ? 'bg-blue-50 text-blue-800 border-blue-200' : '' }}
                                        {{ $appointment->status === 'cancelled' ? 'bg-red-50 text-red-700 border-red-200' : '' }}">
                                        <span class="w-1.5 h-1.5 rounded-full 
                                            {{ $appointment->status === 'confirmed' ? 'bg-emerald-500' : '' }}
                                            {{ $appointment->status === 'pending' ? 'bg-amber-500' : '' }}
                                            {{ $appointment->status === 'completed' ? 'bg-blue-500' : '' }}
                                            {{ $appointment->status === 'cancelled' ? 'bg-red-500' : '' }}"></span>
                                        {{ $appointment->status === 'pending' ? 'Pending Review' : ucfirst($appointment->status) }}
                                    </span>
                                </td>
                                <td class="py-4 px-2 text-right">
                                    @if(in_array($appointment->status, ['pending', 'confirmed']))
                                        <button @click="selectedAppointmentId = {{ $appointment->id }}; cancelModalOpen = true;" 
                                                class="px-3.5 py-1.5 bg-white border border-red-200 text-red-600 hover:bg-red-600 hover:text-white font-bold text-xs rounded-xl transition shadow-sm">
                                            Cancel
                                        </button>
                                    @elseif($appointment->status === 'completed')
                                        <span class="text-[11px] font-semibold text-[#8C7A6B] italic">Completed</span>
                                    @elseif($appointment->status === 'cancelled')
                                        <span class="text-[11px] font-semibold text-red-400 italic">Cancelled</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-xs text-[#837B70]">
                                    <svg class="w-10 h-10 text-[#D6D0C4] mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <p class="font-semibold text-sm text-[#1B3629]">No appointments found</p>
                                    <p class="mt-0.5 text-xs text-[#837B70]">Try switching your status filter or schedule a new session.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Edit Profile Modal -->
    <div x-show="editProfileOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4" x-cloak x-transition>
        <div @click.away="editProfileOpen = false" class="bg-white rounded-3xl p-6 md:p-8 max-w-md w-full shadow-2xl border border-[#E8E2D8]">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-serif-title text-xl font-bold text-[#1B3629]">Edit Profile Details</h3>
                <button @click="editProfileOpen = false" class="text-[#837B70] hover:text-[#1B3629]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <p class="text-xs text-[#706B63] mb-5">Update your contact profile so we can get in touch prior to your appointments.</p>

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-xs font-semibold text-[#1B3629] mb-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required 
                           class="w-full px-4 py-2.5 bg-[#FAF8F5] border border-[#E2DDD5] rounded-xl text-sm focus:outline-none focus:border-[#1B3629] focus:ring-1 focus:ring-[#1B3629]">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-[#1B3629] mb-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required 
                           class="w-full px-4 py-2.5 bg-[#FAF8F5] border border-[#E2DDD5] rounded-xl text-sm focus:outline-none focus:border-[#1B3629] focus:ring-1 focus:ring-[#1B3629]">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-[#1B3629] mb-1">Phone Number</label>
                    <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" required 
                           class="w-full px-4 py-2.5 bg-[#FAF8F5] border border-[#E2DDD5] rounded-xl text-sm focus:outline-none focus:border-[#1B3629] focus:ring-1 focus:ring-[#1B3629]">
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-[#F2EFE9] mt-6">
                    <button type="button" @click="editProfileOpen = false" class="px-4 py-2.5 text-xs font-semibold text-[#706B63] hover:text-[#1B3629]">Cancel</button>
                    <button type="submit" class="px-5 py-2.5 text-xs font-bold bg-[#1B3629] text-white rounded-xl hover:bg-[#2A4D3B] transition shadow-md">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Cancellation Reason Modal -->
    <div x-show="cancelModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4" x-cloak x-transition>
        <div @click.away="cancelModalOpen = false" class="bg-white rounded-3xl p-6 md:p-8 max-w-md w-full shadow-2xl border border-[#E8E2D8]">
            <div class="flex justify-between items-center mb-2">
                <h3 class="font-serif-title text-xl font-bold text-[#1B3629]">Cancel Appointment</h3>
                <button @click="cancelModalOpen = false" class="text-[#837B70] hover:text-[#1B3629]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <p class="text-xs text-[#706B63] mb-5">Please let us know why you need to cancel this therapy session.</p>

            <form :action="'/appointments/' + selectedAppointmentId + '/cancel'" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-xs font-semibold text-[#1B3629] mb-1">Reason for Cancellation</label>
                    <select name="reason" x-model="cancelReason" required class="w-full px-4 py-2.5 bg-[#FAF8F5] border border-[#E2DDD5] rounded-xl text-sm focus:outline-none focus:border-[#1B3629] focus:ring-1 focus:ring-[#1B3629]">
                        <option value="Change of plans">Change of plans</option>
                        <option value="Health / Medical issue">Health / Medical issue</option>
                        <option value="Schedule conflict">Schedule conflict</option>
                        <option value="Booked by mistake">Booked by mistake</option>
                        <option value="Others">Others (Please specify)</option>
                    </select>
                </div>

                <div x-show="cancelReason === 'Others'" class="space-y-1">
                    <label class="block text-xs font-semibold text-[#1B3629]">Specify Details</label>
                    <textarea name="other_reason" x-model="otherReason" rows="3" placeholder="Please type your reason here..." class="w-full px-4 py-2.5 bg-[#FAF8F5] border border-[#E2DDD5] rounded-xl text-sm focus:outline-none focus:border-[#1B3629] focus:ring-1 focus:ring-[#1B3629]"></textarea>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-[#F2EFE9] mt-6">
                    <button type="button" @click="cancelModalOpen = false" class="px-4 py-2.5 text-xs font-semibold text-[#706B63] hover:text-[#1B3629]">Keep Booking</button>
                    <button type="submit" class="px-5 py-2.5 text-xs font-bold bg-red-600 text-white rounded-xl hover:bg-red-700 transition shadow-md">Confirm Cancellation</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>