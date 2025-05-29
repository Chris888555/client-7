@extends('layouts.users')

@section('title', 'All Income Logs')

@section('content')

<div class="container m-auto p-4 sm:p-8 max-w-full">

   <x-page-header-text title="All Income Logs" />

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

  
    {{-- Logs Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs whitespace-nowrap">
                <tr>
                    <th class="px-4 py-3">Reference No</th>
                    <th class="px-4 py-3">Transaction Date</th>
                    <th class="px-4 py-3">Amount</th>
                    <th class="px-4 py-3">Notes</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <tr>
                    <td class="px-4 py-3 whitespace-nowrap">REF-001</td>
                    <td class="px-4 py-3 whitespace-nowrap">2025-05-20</td>
                    <td class="px-4 py-3 whitespace-nowrap">₱500.00</td>
                    <td class="px-4 py-3 whitespace-nowrap">Wholesale Commissions</td>
                </tr>
                <tr>
                    <td class="px-4 py-3 whitespace-nowrap">REF-002</td>
                    <td class="px-4 py-3 whitespace-nowrap">2025-05-21</td>
                    <td class="px-4 py-3 whitespace-nowrap">₱0.00</td>
                    <td class="px-4 py-3 whitespace-nowrap">Cycle Commissions</td>
                </tr>
                <tr>
                    <td class="px-4 py-3 whitespace-nowrap">REF-003</td>
                    <td class="px-4 py-3 whitespace-nowrap">2025-05-22</td>
                    <td class="px-4 py-3 whitespace-nowrap">₱0.00</td>
                    <td class="px-4 py-3 whitespace-nowrap">Infinity Commissions</td>
                </tr>
                <tr>
                    <td class="px-4 py-3 whitespace-nowrap">REF-004</td>
                    <td class="px-4 py-3 whitespace-nowrap">2025-05-23</td>
                    <td class="px-4 py-3 whitespace-nowrap">₱0.00</td>
                    <td class="px-4 py-3 whitespace-nowrap">Group Sales Commissions</td>
                </tr>
                <tr>
                    <td class="px-4 py-3 whitespace-nowrap">REF-005</td>
                    <td class="px-4 py-3 whitespace-nowrap">2025-05-24</td>
                    <td class="px-4 py-3 whitespace-nowrap">₱0.00</td>
                    <td class="px-4 py-3 whitespace-nowrap">Dropshipping Commissions</td>
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
