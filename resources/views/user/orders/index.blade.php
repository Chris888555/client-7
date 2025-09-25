@extends('layouts.users')

@section('title', 'My Orders')

@section('content')
<div class="container m-auto p-4 sm:p-8 max-w-full">

    <!-- Orders Table -->
    <div id="ordersTable" class="overflow-x-auto bg-white rounded-xl shadow-sm border mb-6">
    <!-- Bulk Action -->
    <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-6 px-4 pb-4">
        <h2 class="text-lg font-semibold text-gray-700">My Orders</h2>
        <button id="bulkDeleteBtn" 
                class="w-auto self-start sm:self-auto bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition">
            Delete Selected
        </button>
    </div>

        <table class="min-w-full divide-y divide-gray-200 whitespace-nowrap">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-6 text-left">
                        <input type="checkbox" id="checkAll">
                    </th>
                    <th class="px-4 py-6 text-left text-xs font-medium text-gray-600 uppercase">Full Name</th>
                    <th class="px-4 py-6 text-left text-xs font-medium text-gray-600 uppercase">Mobile</th>
                    <th class="px-4 py-6 text-left text-xs font-medium text-gray-600 uppercase">Address</th>
                    <th class="px-4 py-6 text-left text-xs font-medium text-gray-600 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($orders as $order)
                <tr>
                    <td class="px-4 py-3">
                        <input type="checkbox" class="orderCheckbox" value="{{ $order->id }}">
                    </td>
                    <td class="px-4 py-3">
                        {{ $order->full_name }}
                        @if($order->created_at->isToday())
                            <span class="ml-2 inline-block px-2 py-0.5 text-xs font-semibold text-white bg-green-500 rounded-full">
                                NEW - Today
                            </span>
                        @endif
                    </td>
                    <td class="px-4 py-3">{{ $order->mobile }}</td>
                    <td class="px-4 py-3">{{ $order->address }}</td>
                    <td class="px-4 py-3">
                        <button 
                            class="viewOrderDetails bg-blue-600 text-white px-3 py-1 rounded-md hover:bg-blue-700"
                            data-id="{{ $order->id }}">
                            View All Details
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                        <x-no-data />
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <x-paginations :paginator="$orders" />
    </div>

    <!-- Order Details Wrapper (per order) -->
    @foreach($orders as $order)
    <div id="order-details-{{ $order->id }}" class="orderDetails hidden w-full mx-auto bg-white rounded-xl shadow p-6 transition">
        <button class="backToTable mb-4 text-sm text-gray-700 bg-gray-200 border border-transparent rounded-lg px-3 py-1 
                       hover:border-gray-300 hover:bg-transparent transition">
            &larr; Back
        </button>

        <h2 class="text-2xl font-bold mb-4 text-gray-700">Order Summary</h2>

        <div class="border rounded-lg p-4 bg-gray-50 mb-4">
            <h3 class="font-semibold mb-2 text-gray-600">User Info</h3>
            <p><strong>Full Name:</strong> {{ $order->full_name }}</p>
            <p><strong>Mobile:</strong> {{ $order->mobile }}</p>
            <p><strong>Address:</strong> {{ $order->address }}</p>
        </div>

        <div class="border rounded-lg p-4 bg-gray-50 mb-4">
            <h3 class="font-semibold mb-2 text-gray-600">Package Details</h3>
            <p><strong>Package:</strong> {{ $order->package_name }}</p>
            <p><strong>Price:</strong> ₱{{ number_format($order->package_price, 2) }}</p>
        </div>

        <div class="border rounded-lg p-4 bg-gray-50 mb-4">
            <h3 class="font-semibold mb-2 text-gray-600">Payment Method</h3>
            <p><strong>Method:</strong> {{ $order->payment_method_name }}</p>
            <p><strong>Account Name:</strong> {{ $order->payment_account_name }}</p>
            <p><strong>Account Number:</strong> {{ $order->payment_account_number }}</p>

            @if($order->payment_proof)
            <div class="mt-3">
                <p><strong>Payment Proof:</strong></p>
                <a href="{{ asset('storage/'.$order->payment_proof) }}" target="_blank">
                    <img src="{{ asset('storage/'.$order->payment_proof) }}" 
                        alt="Payment Proof" 
                        class="w-64 h-56 rounded-md shadow cursor-pointer hover:opacity-80 transition mt-2">
                </a>
                <div class="mt-2">
                    <a href="{{ asset('storage/'.$order->payment_proof) }}" target="_blank" 
                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                        View Full Image
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
    @endforeach

</div>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select All
    document.getElementById('checkAll')?.addEventListener('change', function() {
        document.querySelectorAll('.orderCheckbox').forEach(cb => cb.checked = this.checked);
    });

    // Bulk Delete
    document.getElementById('bulkDeleteBtn')?.addEventListener('click', function(e) {
        e.preventDefault();
        let ids = [];
        document.querySelectorAll('.orderCheckbox:checked').forEach(cb => ids.push(cb.value));

        if(ids.length === 0){
            Swal.fire('Warning','Please select at least one order.','warning');
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete selected orders?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("{{ route('user.orders.bulkDelete') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ ids: ids })
                })
                .then(res => res.json())
                .then(data => {
                    if(data.success){
                        Swal.fire('Deleted!', data.message, 'success').then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                });
            }
        });
    });

    // View Order Details
    const ordersTable = document.getElementById('ordersTable');
    document.querySelectorAll('.viewOrderDetails').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = btn.dataset.id;
            ordersTable.classList.add('hidden');
            document.getElementById(`order-details-${id}`).classList.remove('hidden');
        });
    });

    // Back to Table
    document.querySelectorAll('.backToTable').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.orderDetails').forEach(el => el.classList.add('hidden'));
            ordersTable.classList.remove('hidden');
        });
    });
});
</script>
@endsection
