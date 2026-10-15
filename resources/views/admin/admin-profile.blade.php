@extends('admin.admin')

@section('title', 'Admin Profile & System Settings - Kak Rose Admin')

@section('content')
<div>
    <h2 class="font-serif-title text-3xl font-bold text-[#1B3629]">Administrator Profile</h2>
    <p class="text-[#706B63] text-sm mt-0.5">Manage identity details, operational practice hours, and active administrative session logs.</p>
</div>

@if(session('success'))
<div class="p-4 bg-[#DCFCE7] border border-[#BBF7D0] text-[#166534] rounded-2xl text-xs font-bold shadow-sm">
    {{ session('success') }}
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <!-- Identity Card -->
    <div class="bg-white p-6 rounded-3xl border border-[#E2DDD5] shadow-sm space-y-4 text-center flex flex-col items-center justify-center">
        <div class="w-20 h-20 rounded-3xl bg-[#122A21] text-[#D4AF37] font-serif-title font-bold text-2xl flex items-center justify-center shadow-md">
            RO
        </div>
        <div>
            <span class="px-3 py-1 bg-[#F2EFE9] text-[#1B3629] text-[10px] font-bold uppercase tracking-wider rounded-full">
                SUPER ADMIN
            </span>
            <h3 class="font-serif-title font-bold text-2xl text-[#122A21] mt-2">
                {{ Auth::user()->name ?? 'Rosmawati binti Ahmad' }}
            </h3>
            <p class="text-xs text-[#8C7A6B] mt-0.5">{{ Auth::user()->email ?? 'kakroseurutanmelayu@gmail.com' }}</p>
            <p class="text-xs text-[#8C7A6B]">{{ Auth::user()->phone ?? '+60149186109' }}</p>
        </div>
        <div class="w-full pt-4 border-t border-[#E2DDD5] space-y-2 text-xs text-[#706B63]">
            <div class="flex justify-between">
                <span>System Identifier</span>
                <span class="font-mono font-bold text-[#122A21]">ADM-001</span>
            </div>
            <div class="flex justify-between">
                <span>Scope of Authority</span>
                <span class="font-bold text-[#122A21]">Full Management</span>
            </div>
        </div>
    </div>

    <!-- Contact & Credentials Details -->
    <div class="lg:col-span-2 bg-white p-6 rounded-3xl border border-[#E2DDD5] shadow-sm space-y-4">
        <h3 class="font-serif-title font-bold text-xl text-[#122A21] border-b border-[#E2DDD5] pb-3">
            Identity & Credentials
        </h3>
        
        <form method="POST" action="{{ route('admin.profile.update') }}" class="space-y-4 text-xs">
            @csrf
            @method('PATCH')
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-[#706B63] mb-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name ?? 'Rosmawati binti Ahmad') }}" required 
                           class="w-full p-3 rounded-2xl bg-[#FAF8F5] border border-[#E2DDD5] focus:outline-none focus:border-[#122A21]">
                </div>
                <div>
                    <label class="block font-bold text-[#706B63] mb-1">Professional Email</label>
                    <input type="email" name="email" value="{{ old('email', Auth::user()->email ?? 'kakroseurutanmelayu@gmail.com') }}" required 
                           class="w-full p-3 rounded-2xl bg-[#FAF8F5] border border-[#E2DDD5] focus:outline-none focus:border-[#122A21]">
                </div>
                <div>
                    <label class="block font-bold text-[#706B63] mb-1">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone ?? '+60149186109') }}" 
                           class="w-full p-3 rounded-2xl bg-[#FAF8F5] border border-[#E2DDD5] focus:outline-none focus:border-[#122A21]">
                </div>
                <div>
                    <label class="block font-bold text-[#706B63] mb-1">Role & Designation</label>
                    <input type="text" value="Owner & Sole Lead Therapist" disabled 
                           class="w-full p-3 rounded-2xl bg-[#F4F1EA] border border-[#E2DDD5] text-[#8C7A6B] cursor-not-allowed font-medium">
                </div>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit" class="px-5 py-2.5 bg-[#122A21] text-[#D4AF37] font-bold rounded-xl hover:bg-[#1B3629] transition shadow-sm">
                    Save Account Changes
                </button>
            </div>
        </form>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- Solo Practice Center Schedule -->
    <div class="bg-white p-6 rounded-3xl border border-[#E2DDD5] shadow-sm space-y-4">
        <div class="flex items-center justify-between border-b border-[#E2DDD5] pb-3">
            <div>
                <h3 class="font-serif-title font-bold text-lg text-[#122A21]">Center Treatment Schedule</h3>
                <p class="text-xs text-[#8C7A6B] mt-0.5">Therapist availability for appointment bookings.</p>
            </div>
            <span class="px-2.5 py-1 bg-[#DCFCE7] text-[#166534] text-[10px] font-bold uppercase tracking-wider rounded-full">
                Active Solo Practitioner
            </span>
        </div>

        <div class="space-y-2 text-xs">
            <div class="flex justify-between items-center p-3 bg-[#FAF8F5] border border-[#E2DDD5] rounded-2xl">
                <span class="font-bold text-[#122A21]">Monday - Sunday</span>
                <span class="font-semibold text-[#166534]">08:30 AM - 10:30 PM</span>
            </div>
            <div class="flex justify-between items-center p-3 bg-[#FAF8F5] border border-[#E2DDD5] rounded-2xl">
                <span class="font-bold text-[#122A21]">Saturday & Public Holidays</span>
                <span class="font-semibold text-[#8C7A6B]">By Appointment Only</span>
            </div>
        </div>
    </div>

    <!-- Security Logs & Session Info -->
    <div class="bg-white p-6 rounded-3xl border border-[#E2DDD5] shadow-sm space-y-4">
        <div class="flex items-center justify-between border-b border-[#E2DDD5] pb-3">
            <div>
                <h3 class="font-serif-title font-bold text-lg text-[#122A21]">Activity & Security Info</h3>
                <p class="text-xs text-[#8C7A6B] mt-0.5">Current session authentication details.</p>
            </div>
            <span class="w-2.5 h-2.5 rounded-full bg-[#166534]" title="Session Active"></span>
        </div>

        <div class="space-y-3 text-xs">
            <div class="flex justify-between items-center p-3 bg-[#FAF8F5] border border-[#E2DDD5] rounded-2xl">
                <div>
                    <div class="font-bold text-[#122A21]">Last Authenticated Session</div>
                    <div class="text-[11px] text-[#8C7A6B] mt-0.5">
                        {{ \Carbon\Carbon::parse(session('login_time', now()))->setTimezone('Asia/Kuala_Lumpur')->format('d M Y, h:i A') }}
                    </div>
                </div>
                <span class="px-2.5 py-1 bg-[#F2EFE9] text-[#1B3629] rounded-lg text-[10px] font-bold uppercase">
                    Direct Web Access
                </span>
            </div>

            <div class="flex justify-between items-center p-3 bg-[#FAF8F5] border border-[#E2DDD5] rounded-2xl">
                <div>
                    <div class="font-bold text-[#122A21]">Permission Scope</div>
                    <div class="text-[11px] text-[#8C7A6B] mt-0.5">Full Read/Write Access across Rosters & Ledger</div>
                </div>
                <span class="font-bold text-[#166534]">Granted</span>
            </div>
        </div>
    </div>

</div>
@endsection