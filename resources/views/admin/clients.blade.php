@extends('admin.admin')

@section('title', 'Client Records - Kak Rose Admin Portal')

@section('content')
<div x-data="{ 
    editModalOpen: false, 
    deleteModalOpen: false, 
    editId: null,
    editName: '',
    editEmail: '',
    editPhone: '',
    deleteId: null,
    deleteName: '',
    openEdit(id, name, email, phone) {
        this.editId = id;
        this.editName = name;
        this.editEmail = email;
        this.editPhone = phone;
        this.editModalOpen = true;
    },
    openDelete(id, name) {
        this.deleteId = id;
        this.deleteName = name;
        this.deleteModalOpen = true;
    }
}">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="font-serif-title text-3xl font-bold text-[#1B3629]">Client Directory</h2>
            <p class="text-[#706B63] text-sm mt-0.5">View registered clients, booking counts, and intake form statuses.</p>
        </div>
        
        <!-- Top KPI Badge -->
        <div class="bg-white px-4 py-2 rounded-2xl border border-[#E2DDD5] shadow-sm flex items-center gap-3 self-start sm:self-auto">
            <span class="text-xs text-[#706B63] font-semibold">Total Registered:</span>
            <span class="text-lg font-bold text-[#122A21]">{{ count($clients ?? []) }}</span>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
        <div class="mt-4 p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-semibold flex items-center gap-2">
            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="mt-4 p-3.5 bg-red-50 border border-red-200 text-red-700 rounded-xl text-xs font-semibold space-y-1">
            @foreach($errors->all() as $error)
                <p>• {{ $error }}</p>
            @endforeach
        </div>
    @endif

    <!-- Main Directory Card -->
    <div class="mt-6 bg-white border border-[#E2DDD5] rounded-2xl shadow-sm overflow-hidden">
        
        <!-- Search Header -->
        <div class="p-4 border-b border-[#E2DDD5] bg-[#FCFCFA] flex items-center justify-between gap-4">
            <div class="relative w-full sm:w-72">
                <input type="text" 
                       placeholder="Search client by name or email..." 
                       class="w-full pl-9 pr-4 py-2 bg-white border border-[#E2DDD5] rounded-xl text-xs text-[#122A21] focus:outline-none focus:border-[#1B3629]">
                <svg class="w-4 h-4 text-[#8C7A6B] absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-[#F8F6F0] text-[#706B63] uppercase text-[11px] tracking-wider border-b border-[#E2DDD5]">
                        <th class="p-4 font-bold">Client Name</th>
                        <th class="p-4 font-bold">Contact Info</th>
                        <th class="p-4 font-bold">Postpartum Status</th>
                        <th class="p-4 font-bold">Total Sessions</th>
                        <th class="p-4 font-bold text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E2DDD5]">
                    @forelse($clients as $client)
                    <tr class="hover:bg-[#FAF8F5] transition">
                        <td class="p-4 font-bold text-[#122A21]">
                            {{ $client->name }}
                        </td>
                        <td class="p-4">
                            <div class="text-[#122A21] font-medium">{{ $client->email }}</div>
                            <div class="text-[11px] text-[#8C7A6B] mt-0.5">{{ $client->phone ?? $client->phone_number ?? 'No Phone Provided' }}</div>
                        </td>
                        <td class="p-4">
                            @if(optional($client->appointments)->pluck('intakeForm')->pluck('is_postpartum')->contains(true))
                                <span class="px-2.5 py-1 bg-[#F2EFE9] text-[#1B3629] rounded-lg text-[10px] font-bold uppercase tracking-wider">
                                    Postpartum
                                </span>
                            @else
                                <span class="text-[#706B63]">Standard</span>
                            @endif
                        </td>
                        <td class="p-4 font-bold text-[#166534]">
                            <span class="px-2.5 py-1 bg-[#DCFCE7] rounded-lg text-xs">
                                {{ $client->appointments_count ?? $client->appointments->count() }} Booking(s)
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ Route::has('admin.appointments.index') ? route('admin.appointments.index', ['client_id' => $client->id]) : url('/admin/appointments?client_id=' . $client->id) }}" 
                                    class="font-bold text-[#122A21] hover:text-[#1B3629] hover:underline" 
                                    title="View Booking History">
                                    View History &rarr;
                                </a>

                                <span class="text-[#E2DDD5]">|</span>

                                <!-- Edit Action Button -->
                                <button type="button" 
                                        @click="openEdit({{ $client->id }}, '{{ addslashes($client->name) }}', '{{ addslashes($client->email) }}', '{{ addslashes($client->phone ?? $client->phone_number ?? '') }}')" 
                                        class="p-1.5 text-[#1B3629] hover:bg-[#F2EFE9] rounded-lg transition cursor-pointer" 
                                        title="Edit Client Info">
                                    <svg class="w-4 h-4 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>

                                <!-- Delete Action Button -->
                                <button type="button" 
                                        @click="openDelete({{ $client->id }}, '{{ addslashes($client->name) }}')" 
                                        class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition cursor-pointer" 
                                        title="Delete Client">
                                    <svg class="w-4 h-4 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-[#8C7A6B]">
                            No registered client records found in database.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Client Modal -->
    <div x-show="editModalOpen" 
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
        <div @click.away="editModalOpen = false" class="bg-white border border-[#E2DDD5] rounded-2xl p-6 max-w-md w-full shadow-2xl space-y-4">
            <div class="flex justify-between items-center border-b border-[#E2DDD5] pb-3">
                <h3 class="font-serif-title text-xl font-bold text-[#1B3629]">Edit Client Details</h3>
                <button @click="editModalOpen = false" type="button" class="text-[#8C7A6B] hover:text-[#122A21] font-bold text-lg cursor-pointer">&times;</button>
            </div>

            <form :action="'/admin/clients/' + editId" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold text-[#122A21] mb-1">Full Name</label>
                    <input type="text" name="name" x-model="editName" required class="w-full px-3.5 py-2 bg-white border border-[#E2DDD5] rounded-xl text-xs focus:outline-none focus:border-[#1B3629]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#122A21] mb-1">Email Address</label>
                    <input type="email" name="email" x-model="editEmail" required class="w-full px-3.5 py-2 bg-white border border-[#E2DDD5] rounded-xl text-xs focus:outline-none focus:border-[#1B3629]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#122A21] mb-1">Phone Number</label>
                    <input type="text" name="phone" x-model="editPhone" class="w-full px-3.5 py-2 bg-white border border-[#E2DDD5] rounded-xl text-xs focus:outline-none focus:border-[#1B3629]">
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-[#E2DDD5]">
                    <button type="button" @click="editModalOpen = false" class="px-4 py-2 text-xs font-semibold text-[#706B63] hover:text-[#122A21] cursor-pointer">Cancel</button>
                    <button type="submit" class="px-4 py-2 text-xs font-bold bg-[#1B3629] text-white rounded-xl hover:bg-[#122A21] transition cursor-pointer">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="deleteModalOpen" 
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
        <div @click.away="deleteModalOpen = false" class="bg-white border border-[#E2DDD5] rounded-2xl p-6 max-w-sm w-full shadow-2xl space-y-4 text-center">
            <div class="w-12 h-12 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>

            <div>
                <h3 class="font-serif-title text-lg font-bold text-[#122A21]">Delete Client Record?</h3>
                <p class="text-xs text-[#706B63] mt-1">Are you sure you want to delete <strong class="text-[#122A21]" x-text="deleteName"></strong>? This action cannot be undone.</p>
            </div>

            <form :action="'/admin/clients/' + deleteId" method="POST" class="flex items-center justify-center gap-3 pt-2">
                @csrf
                @method('DELETE')
                
                <button type="button" @click="deleteModalOpen = false" class="px-4 py-2 text-xs font-semibold text-[#706B63] hover:text-[#122A21] cursor-pointer">Cancel</button>
                <button type="submit" class="px-4 py-2 text-xs font-bold bg-red-600 text-white rounded-xl hover:bg-red-700 transition cursor-pointer">Confirm Delete</button>
            </form>
        </div>
    </div>

</div>
@endsection