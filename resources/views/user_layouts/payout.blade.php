@extends('layouts.users')

@section('title', 'Withdrawal Request')

@section('content')
<div class="w-full p-4 sm:p-8">

  <x-page-header-text title="Request Withdrawal" />

  <div class="bg-white p-8 rounded-2xl border mb-8 max-w-full">

      <form action="#" method="POST" class="space-y-6 w-full">
          @csrf

          <div class="flex flex-col gap-2">
              <label for="amount" class="text-sm font-medium text-gray-700">Amount</label>
              <input type="number" name="amount" id="amount" min="100" step="any"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-opacity-50 focus:border-teal-400 transition-shadow duration-300"
                  placeholder="Enter amount (min ₱500)" required>
          </div>

          <div class="flex flex-col gap-2">
              <label for="method" class="text-sm font-medium text-gray-700">Withdrawal Method</label>
              <select name="method" id="method"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-opacity-50 focus:border-teal-400 transition-shadow duration-300"
                  required>
                  <option value="">Select Method</option>
                  <option value="gcash">GCash</option>
                  <option value="gotyme">GoTyme</option>
                  <option value="bank">Bank Transfer</option>
              </select>
          </div>

          <div class="flex flex-col gap-2">
              <label for="account_details" class="text-sm font-medium text-gray-700">Account Details</label>
              <textarea name="account_details" id="account_details" rows="3"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-opacity-50 focus:border-teal-400 transition-shadow duration-300"
                  placeholder="e.g. 0917XXXXXXX or Bank Account No." required></textarea>
          </div>

          <div class="pt-2">
              <button type="submit"
                  class="w-full text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center flex items-center justify-center gap-2">
                  <span class="fa fa-save mr-2"></span> Submit Request
              </button>
          </div>
      </form>
  </div>

 {{-- Toolbar --}}
      <x-page-header-text title="Withdrawal Logs" />
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
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Account Name</th>
                        <th class="px-4 py-3">Method</th>
                        <th class="px-4 py-3">Account</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Date Requested</th>
                        <th class="px-4 py-3">Date Processed</th>
                        <th class="px-4 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap">1</td>
                        <td class="px-4 py-3 whitespace-nowrap">Juan Dela Cruz</td>
                        <td class="px-4 py-3 whitespace-nowrap">GCash</td>
                        <td class="px-4 py-3 whitespace-nowrap">0917XXXXXXX</td>
                        <td class="px-4 py-3 whitespace-nowrap">₱1,000.00</td>
                        <td class="px-4 py-3 whitespace-nowrap">2025-05-01</td>
                        <td class="px-4 py-3 whitespace-nowrap"></td>
                        <td class="px-4 py-3 font-semibold whitespace-nowrap">
                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Pending</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap">2</td>
                        <td class="px-4 py-3 whitespace-nowrap">Juan Dela Cruz</td>
                        <td class="px-4 py-3 whitespace-nowrap">GoTyme</td>
                        <td class="px-4 py-3 whitespace-nowrap">GoTyme-1234567890</td>
                        <td class="px-4 py-3 whitespace-nowrap">₱2,500.00</td>
                        <td class="px-4 py-3 whitespace-nowrap">2025-04-28</td>
                        <td class="px-4 py-3 whitespace-nowrap">2025-04-29</td>
                        <td class="px-4 py-3 font-semibold whitespace-nowrap">
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Approved</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap">3</td>
                        <td class="px-4 py-3 whitespace-nowrap">Juan Dela Cruz</td>
                        <td class="px-4 py-3 whitespace-nowrap">Bank Transfer</td>
                        <td class="px-4 py-3 whitespace-nowrap">BPI - 1234 5678 90</td>
                        <td class="px-4 py-3 whitespace-nowrap">₱1,500.00</td>
                        <td class="px-4 py-3 whitespace-nowrap">2025-04-15</td>
                        <td class="px-4 py-3 whitespace-nowrap">2025-04-16</td>
                        <td class="px-4 py-3 font-semibold whitespace-nowrap">
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">Rejected</span>
                        </td>
                    </tr>
                </tbody>
            </table>

            {{--  add pagination part--}}
            <div class="mt-4 flex justify-center">
                  <!-- Add pagination controls here -->
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


</div>
@endsection