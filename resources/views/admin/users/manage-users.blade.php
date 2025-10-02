@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
<div class="container mx-auto p-4 sm:p-8 max-w-full">

<!-- Filter -->
<div class="flex flex-col md:flex-row md:items-center gap-4 mb-6">
    <!-- Search and Status Filter -->
    <form id="filter-form" method="GET" class="flex flex-col md:flex-row items-center gap-4 w-full md:w-auto">
       <div class="w-full max-w-sm min-w-[200px]">
            <div class="relative flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="absolute w-5 h-5 top-2.5 left-2.5 text-slate-600">
                <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                </svg>

                <input 
                type="text" 
                name="search" 
                id="search-input" 
                value="{{ request('search') }}"
                placeholder="Search by name..." 
                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-10 pr-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                />
            </div>
        </div>

        <select name="status" id="status-select" class="w-full md:w-48 px-4 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md  transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow cursor-pointer">
            <option value="">All Status</option>
            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Approved</option>
            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Pending</option>
        </select>
    </form>

    <!-- Bulk Actions -->
    <div class="flex items-center gap-1 w-full md:w-auto">
        <select id="bulk-action" class="w-full md:w-48 px-4 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md  transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow cursor-pointe">
            <option value="">Select Action</option>
            <option value="approve">Set Approved</option>
            <option value="disapprove">Set Pending</option>
            <option value="make-admin">Make Admin</option>
            <option value="make-user">Make User</option>
            <option value="delete">Delete</option>
        </select>
        <button id="apply-action" class="rounded-md bg-teal-600 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-teal-700 hover:bg-teal-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">Apply</button>
    </div>
</div>

    <div class="flex gap-6 mb-4">
    @if(request('status') === '1')
        <div class="text-green-600 font-semibold">Approved: {{ $totalApproved }}</div>
    @elseif(request('status') === '0')
        <div class="text-yellow-600 font-semibold">Pending: {{ $totalPending }}</div>
    @else
        <div class="text-green-600 font-semibold">Approved: {{ $totalApproved }}</div>
        <div class="text-yellow-600 font-semibold">Pending: {{ $totalPending }}</div>
    @endif
</div>

   <!-- Table -->
 <div class="overflow-x-auto bg-white rounded-xl shadow-sm border">
    <table class="min-w-full divide-y divide-gray-200 whitespace-nowrap">
             <thead class="bg-gray-100 whitespace-nowrap">
            <tr class="bg-gray-100 text-left">
                <th class="px-4 py-3 text-left">
                    <input type="checkbox" id="select-all">
                </th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Name</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Email</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Password</th> 
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Status</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Role</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr class="border-t whitespace-nowrap ">
                <td class="px-4 py-3 text-sm text-left">
                    <input type="checkbox" class="user-checkbox" value="{{ $user->id }}">
                </td>
                <td class="px-4 py-3 text-sm text-left">{{ $user->name }}</td>
                <td class="px-4 py-3 text-sm text-left">{{ $user->email }}</td>
                <td class="px-4 py-3 text-sm text-left text-red-600">{{ $user->dpassword ?? 'N/A' }}</td> <!-- Display plaintext password -->
                <td class="px-4 py-3 text-sm text-left {{ $user->is_approved ? 'text-green-600' : 'text-yellow-600' }}">
                    {{ $user->is_approved ? 'Approved' : 'Pending' }}
                </td>
                <td class="px-4 py-3 text-sm">{{ ucfirst($user->role) }}</td>
            </tr>
            @empty
           <tr>
             <td colspan="100%" class="px-4 py-6 text-center text-gray-500">
                 <x-no-data />
               </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

  <!-- Pagination -->
  <x-paginations :paginator="$users" />

</div>

</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    document.getElementById('status-select').addEventListener('change', function() {
        document.getElementById('filter-form').submit();
    });

document.getElementById('select-all').addEventListener('change', function () {
    const checkboxes = document.querySelectorAll('.user-checkbox');
    checkboxes.forEach(cb => cb.checked = this.checked);
});

document.getElementById('apply-action').addEventListener('click', function () {
    const selectedAction = document.getElementById('bulk-action').value;
    const userIds = Array.from(document.querySelectorAll('.user-checkbox:checked')).map(cb => cb.value);

    if (!selectedAction || userIds.length === 0) {
        Swal.fire('Warning', 'Please select an action and at least one user.', 'warning');
        return;
    }

    fetch('{{ route('admin.bulk-action') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ action: selectedAction, user_ids: userIds })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            Swal.fire('Success', data.message, 'success').then(() => location.reload());
        } else {
            Swal.fire('Error', 'Something went wrong.', 'error');
        }
    });
});
</script>
@endsection
