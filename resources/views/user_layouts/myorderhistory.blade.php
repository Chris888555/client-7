@extends('layouts.users')

@section('title', 'Order History')

@section('content')
<div class="container m-auto p-4 sm:p-8 max-w-full">

    <x-page-header-text title="Order History" />

<div class="bg-white p-6 rounded-2xl border">
  

    {{-- Toolbar --}}
    <div class="flex items-center justify-between mb-4 mt-6">
        <input type="text" placeholder="Search..."
            class="border px-4 py-2 rounded-lg text-sm w-1/1 lg:w-1/3 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-opacity-50 focus:border-teal-400 transition-shadow duration-300" />

        <div class="relative">
            <button id="filterToggle" class="text-gray-600 hover:text-gray-800">
                <span class="material-icons">filter_alt</span>
            </button>

            {{-- Filter Dropdown --}}
            <div id="filterDropdown"
                class="absolute right-0 mt-2 bg-white border rounded-lg shadow-lg p-4 w-64 hidden z-50">
                <label class="block text-sm font-medium text-gray-700 mb-1">Filter by Date</label>
                <input type="date" class="w-full border px-3 py-2 rounded-md text-sm" />
            </div>
        </div>
    </div>

    {{-- Orders Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs whitespace-nowrap">
                <tr>
                    <th class="px-4 py-3">Invoice No</th>
                    <th class="px-4 py-3">Order Date</th>
                    <th class="px-4 py-3">Full Name</th>
                    <th class="px-4 py-3">Contact No</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Delivery Method</th>
                    <th class="px-4 py-3">Payment Method</th>
                    <th class="px-4 py-3">Paid Amount</th>
                    <th class="px-4 py-3">Product</th>
                    <th class="px-4 py-3">Qty</th>
                    <th class="px-4 py-3">Action</th>

                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <tr>
                    <td class="px-4 py-3 whitespace-nowrap">INV-1001</td>
                    <td class="px-4 py-3 whitespace-nowrap">2025-05-28</td>
                    <td class="px-4 py-3 whitespace-nowrap">Maria Santos</td>
                    <td class="px-4 py-3 whitespace-nowrap">09171234567</td>
                    <td class="px-4 py-3 font-semibold whitespace-nowrap">
                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Pending</span>
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">For Delivery</td>
                    <td class="px-4 py-3 whitespace-nowrap">GCash</td>
                    <td class="px-4 py-3 whitespace-nowrap">₱1,200.00</td>
                    <td class="px-4 py-3 whitespace-nowrap">Soap</td>
                    <td class="px-4 py-3 whitespace-nowrap">2</td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        <a href="#" class="text-blue-500 hover:text-blue-700" title="View Order">
                            <span class="material-icons">visibility</span>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-3 whitespace-nowrap">INV-1002</td>
                    <td class="px-4 py-3 whitespace-nowrap">2025-05-27</td>
                    <td class="px-4 py-3 whitespace-nowrap">Juan Dela Cruz</td>
                    <td class="px-4 py-3 whitespace-nowrap">09181112222</td>
                    <td class="px-4 py-3 font-semibold whitespace-nowrap">
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">Shipped</span>
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">Pickup</td>
                    <td class="px-4 py-3 whitespace-nowrap">Cash</td>
                    <td class="px-4 py-3 whitespace-nowrap">₱950.00</td>
                    <td class="px-4 py-3 whitespace-nowrap">Lotion</td>
                    <td class="px-4 py-3 whitespace-nowrap">1</td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        <a href="#" class="text-blue-500 hover:text-blue-700" title="View Order">
                            <span class="material-icons">visibility</span>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-3 whitespace-nowrap">INV-1003</td>
                    <td class="px-4 py-3 whitespace-nowrap">2025-05-26</td>
                    <td class="px-4 py-3 whitespace-nowrap">Ana Lopez</td>
                    <td class="px-4 py-3 whitespace-nowrap">09221234567</td>
                    <td class="px-4 py-3 font-semibold whitespace-nowrap">
                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">Cancelled</span>
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">For Delivery</td>
                    <td class="px-4 py-3 whitespace-nowrap">Bank Transfer</td>
                    <td class="px-4 py-3 whitespace-nowrap">₱1,500.00</td>
                    <td class="px-4 py-3 whitespace-nowrap">Coffee</td>
                    <td class="px-4 py-3 whitespace-nowrap">3</td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        <a href="#" class="text-blue-500 hover:text-blue-700" title="View Order">
                            <span class="material-icons">visibility</span>
                        </a>
                    </td>
                </tr>


            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4 flex justify-center">
            <!-- Add pagination controls here -->
        </div>
    </div>
</div>
</div>

{{-- Script to toggle the filter dropdown --}}

<script>
const filterToggle = document.getElementById('filterToggle');
const filterDropdown = document.getElementById('filterDropdown');

// Toggle dropdown on icon click
filterToggle.addEventListener('click', function(e) {
    e.stopPropagation(); // Prevent immediate close
    filterDropdown.classList.toggle('hidden');
});

// Hide dropdown when clicking outside
document.addEventListener('click', function(e) {
    if (!filterDropdown.contains(e.target) && !filterToggle.contains(e.target)) {
        filterDropdown.classList.add('hidden');
    }
});
</script>
@endsection