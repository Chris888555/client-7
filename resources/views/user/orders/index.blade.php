@extends('layouts.users')

@section('title', 'My Orders')

@section('content')
<div class="container m-auto p-4 sm:p-8 max-w-full">
   

    <!-- Orders Table -->
    <div id="ordersTable" class="overflow-x-auto bg-white rounded-xl shadow-sm border mb-6">
    
    <table class="min-w-full divide-y divide-gray-200 whitespace-nowrap">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-6 text-left text-xs font-medium text-gray-600 uppercase">Full Name</th>
                <th class="px-4 py-6 text-left text-xs font-medium text-gray-600 uppercase">Mobile</th>
                <th class="px-4 py-6 text-left text-xs font-medium text-gray-600 uppercase">Address</th>
                <th class="px-4 py-6 text-left text-xs font-medium text-gray-600 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($orders as $order)
            <tr>
                <td class="px-4 py-3">{{ $order->full_name }}</td>
                <td class="px-4 py-3">{{ $order->mobile }}</td>
                <td class="px-4 py-3">{{ $order->address }}</td>
                <td class="px-4 py-3">
                    <button 
                        class="viewOrderDetails bg-blue-600 text-white px-3 py-1 rounded-md hover:bg-blue-700"
                        data-full_name="{{ $order->full_name }}"
                        data-mobile="{{ $order->mobile }}"
                        data-address="{{ $order->address }}"
                        data-package="{{ $order->package_name }}"
                        data-price="{{ $order->package_price }}"
                        data-payment_method="{{ $order->payment_method_name }}"
                        data-account_name="{{ $order->payment_account_name }}"
                        data-account_number="{{ $order->payment_account_number }}"
                        data-proof="{{ $order->payment_proof }}">
                        View Summary
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                    No orders yet.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <x-paginations :paginator="$orders" />
</div>


     
    
<!-- Order Summary -->
<div id="orderSummary" class="hidden max-w-3xl mx-auto bg-white rounded-xl shadow p-6 transition">
    <button id="backToTable" 
            class="mb-4 text-sm text-gray-700 bg-gray-200 border border-transparent rounded-lg px-3 py-1 
                   hover:border-gray-300 hover:bg-transparent transition">
        &larr; Back
    </button>
    <div id="summaryContent"></div>
</div>



</div>
@endsection

@section('js')
<!-- Order Summary -->
<div id="orderSummary" class="hidden w-full bg-white rounded-xl shadow p-6">
    <button id="backToTable" class="mb-4 text-sm text-gray-500 hover:underline">&larr; Back</button>
    <div id="summaryContent" class="w-full space-y-4"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.viewOrderDetails');
    const ordersTable = document.getElementById('ordersTable');
    const orderSummary = document.getElementById('orderSummary');
    const summaryContent = document.getElementById('summaryContent');
    const backBtn = document.getElementById('backToTable');

    buttons.forEach(btn => {
        btn.addEventListener('click', function() {
            const data = btn.dataset;

            // hide table, show summary
            ordersTable.classList.add('hidden');
            orderSummary.classList.remove('hidden');

            summaryContent.innerHTML = `
                <h2 class="text-2xl font-bold mb-4 text-gray-700">Order Summary</h2>

                <!-- User Info -->
                <div class="border rounded-lg p-4 bg-gray-50 mb-4">
                    <h3 class="font-semibold mb-2 text-gray-600">User Info</h3>
                    <p><strong>Full Name:</strong> ${data.full_name}</p>
                    <p><strong>Mobile:</strong> ${data.mobile}</p>
                    <p><strong>Address:</strong> ${data.address}</p>
                </div>

                <!-- Package Info -->
                <div class="border rounded-lg p-4 bg-gray-50 mb-4">
                    <h3 class="font-semibold mb-2 text-gray-600">Package Details</h3>
                    <p><strong>Package:</strong> ${data.package}</p>
                    <p><strong>Price:</strong> ₱${data.price}</p>
                </div>

                <!-- Payment Info -->
                <div class="border rounded-lg p-4 bg-gray-50 mb-4">
                    <h3 class="font-semibold mb-2 text-gray-600">Payment Method</h3>
                    <p><strong>Method:</strong> ${data.payment_method}</p>
                    <p><strong>Account Name:</strong> ${data.account_name}</p>
                    <p><strong>Account Number:</strong> ${data.account_number}</p>
                    <p><strong>Payment Proof:</strong> 
                        <a href="/storage/${data.proof}" target="_blank" class="text-blue-600 underline">View</a>
                    </p>
                </div>
            `;
        });
    });

    backBtn.addEventListener('click', function() {
        orderSummary.classList.add('hidden');
        ordersTable.classList.remove('hidden');
    });
});
</script>
@endsection
