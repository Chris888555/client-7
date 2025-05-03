@extends('layouts.app')

@section('title', 'Funnel Subscription Panel')

@section('content')

@include('includes.nav')

<div class="container m-auto p-4 sm:p-8 max-w-full">
     <h1 class="text-2xl md:text-3xl font-bold text-left text-blue-400">Manage Funnels Payment</h1>
    <p class="text-gray-600 text-left mb-4">Monitor the subscription payments here.</p>


    {{-- Display success or error messages --}}
    @if(session('status'))
    <div class="alert alert-success bg-green-100 text-green-800 p-4 rounded-md mb-4">
        {{ session('status') }}
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger bg-red-100 text-red-800 p-4 rounded-md mb-4">
        {{ session('error') }}
    </div>
    @endif


    {{-- Filter dropdown --}}
    <div class="mb-4">
        <label for="status" class="block mb-2 text-sm font-medium text-gray-700">Filter by Status:</label>
        <select id="status" name="status" onchange="window.location.href='/manual-approval/status/' + this.value;"
            class="bg-white border border-gray-300 text-gray-700 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-60 p-2">
            <option value="all" {{ request()->route('status') == 'all' ? 'selected' : '' }}>All</option>
            <option value="pending" {{ request()->route('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="approved" {{ request()->route('status') == 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="rejected" {{ request()->route('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
            <option value="expired" {{ request()->route('status') == 'expired' ? 'selected' : '' }}>Expired Plan
            </option>
        </select>



    </div>

    @php
    $currentStatus = request()->route('status') ?? 'all';
    @endphp

    <div class="flex items-center justify-between mb-4">
    <span class="inline-block px-4 py-2 rounded-md text-sm font-medium
        @switch($currentStatus)
            @case('approved') bg-green-100 text-green-800 @break
            @case('pending') bg-yellow-100 text-yellow-800 @break
            @case('rejected') bg-red-100 text-red-800 @break
            @case('expired-plan') bg-gray-200 text-gray-800 @break
            @default bg-blue-100 text-blue-800
        @endswitch
    ">
        Viewing: {{ ucfirst(str_replace('-', ' ', $currentStatus)) }}
    </span>

    <form action="{{ route('manual.bulkDelete') }}" method="POST" id="bulkDeleteForm">
        @csrf
        <button type="submit" class="bg-red-500 text-sm font-medium text-white py-2 px-4 rounded-md hover:bg-red-600 flex items-center gap-2" id="bulkDeleteBtn" disabled>
    <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="3 6 5 6 21 6" />
        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
        <line x1="10" y1="11" x2="10" y2="17" />
        <line x1="14" y1="11" x2="14" y2="17" />
    </svg>
    Delete Selected
</button>

   
</div>

        <div class="overflow-x-auto bg-white border rounded-md ">
            <table class="table-auto w-full border-collapse whitespace-nowrap">
                <thead class="bg-gray-200 whitespace-nowrap">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">
                            <input type="checkbox" id="selectAll">
                        </th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Name</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Plan</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Status</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Proof Image</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop through all funnels --}}
                    @foreach($funnels as $funnel)
                    <tr class="border-b">
                        <td class="px-4 py-2 text-sm">
                            <input type="checkbox" name="funnels[]" value="{{ $funnel->id }}" class="checkbox">
                        </td>
                        {{-- Check if status is expired --}}
                        @if($funnel->status === 'expired')
                        <td class="px-4 py-2 text-sm">{{ $funnel->user->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2 text-sm capitalize">{{ ucfirst($funnel->status) }}</td>
                        <td class="px-4 py-2 text-sm">N/A</td>
                        <td class="px-4 py-2 text-sm">N/A</td> {{-- Action column also N/A --}}
                        @else
                        <td class="px-4 py-2 text-sm">{{ $funnel->user->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2 text-sm capitalize">
                            {{ ucfirst(str_replace('_', ' ', $funnel->plan_duration)) }}</td>
                        <td class="px-4 py-2 text-sm capitalize">{{ ucfirst($funnel->status) }}</td>
                        <td class="px-4 py-2 text-sm" x-data="{ openModal: false }">
                            @if($funnel->proof_image)
                            <img src="{{ asset('storage/' . $funnel->proof_image) }}" width="90" alt="Proof Image"
                                class="rounded-md border cursor-pointer " @click="openModal = true" />
                            @else
                            No proof image
                            @endif

                            <!-- Modal -->
                            <div x-show="openModal" x-transition
                                class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center"
                                @click="openModal = false">
                                <div class="bg-white p-4 rounded-md w-[95%] sm:w-[700px]">
                                    <div class="flex justify-end">
                                        <button @click="openModal = false"
                                            class="text-gray-500 border-2 border-gray-100 rounded-lg">
                                            <svg class="h-8 w-8 text-red-500" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                                <line x1="9" y1="9" x2="15" y2="15" />
                                                <line x1="15" y1="9" x2="9" y2="15" />
                                            </svg>
                                        </button>
                                    </div>
                                    <img src="{{ asset('storage/' . $funnel->proof_image) }}" alt="Proof Image"
                                        class="w-full rounded-md mt-4">
                                </div>
                            </div>
                        </td>
                        @endif

                        <td class="px-4 py-2 text-sm ">
                            <div class="flex items-center space-x-2  ">
                                {{-- Status Label --}}
                                @if($funnel->status == 'approved')
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Approved</span>
                                @elseif($funnel->status == 'rejected')
                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Rejected</span>
                                @elseif($funnel->status == 'pending')
                                <span
                                    class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm">Pending</span>
                                @elseif($funnel->status == 'expired-plan')
                                <span class="bg-gray-200 text-gray-800 px-3 py-1 rounded-full text-sm">Expired</span>
                                @endif

   

    {{-- Buttons Based on Current Status --}}
    @if($funnel->status == 'pending')
    <form action="{{ route('manual.rejectFunnel', $funnel->id) }}" method="POST" class="inline-block">
        @csrf
        @method('PUT')
        <button class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600 text-sm"
            type="submit">Reject</button>
    </form>
    <form action="{{ route('manual.approveFunnel', $funnel->id) }}" method="POST" class="inline-block">
        @csrf
        @method('PUT')
        <button class="bg-green-500 text-white py-1 px-3 rounded-md hover:bg-green-600 text-sm"
            type="submit">Approve</button>
    </form>
    @elseif($funnel->status == 'approved')
    <form action="{{ route('manual.rejectFunnel', $funnel->id) }}" method="POST" class="inline-block">
        @csrf
        @method('PUT')
        <button class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600 text-sm"
            type="submit">Reject</button>
    </form>
    <form action="{{ route('manual.pendingFunnel', $funnel->id) }}" method="POST" class="inline-block">
        @csrf
        @method('PUT')
        <button class="bg-yellow-500 text-white py-1 px-3 rounded-md hover:bg-yellow-600 text-sm"
            type="submit">Pending</button>
    </form>
    @elseif($funnel->status == 'rejected')
    <form action="{{ route('manual.approveFunnel', $funnel->id) }}" method="POST" class="inline-block">
        @csrf
        @method('PUT')
        <button class="bg-green-500 text-white py-1 px-3 rounded-md hover:bg-green-600 text-sm"
            type="submit">Approve</button>
    </form>
    <form action="{{ route('manual.pendingFunnel', $funnel->id) }}" method="POST" class="inline-block">
        @csrf
        @method('PUT')
        <button class="bg-yellow-500 text-white py-1 px-3 rounded-md hover:bg-yellow-600 text-sm"
            type="submit">Pending</button>
    </form>
    @endif
    
</div>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
 </form>


<div class="mt-4 flex justify-center">
    {{ $funnels->links() }}
</div>

<script>
document.getElementById('selectAll').addEventListener('change', function () {
    const checkboxes = document.querySelectorAll('.checkbox');
    checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    toggleBulkDeleteBtn();
});

const checkboxes = document.querySelectorAll('.checkbox');
checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', toggleBulkDeleteBtn);
});

function toggleBulkDeleteBtn() {
    const selected = document.querySelectorAll('.checkbox:checked').length;
    document.getElementById('bulkDeleteBtn').disabled = selected === 0;
}
</script>


</div>
@endsection