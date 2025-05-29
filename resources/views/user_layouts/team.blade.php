@extends('layouts.users')

@section('title', 'Rank Status')

@section('content')
<div class="container m-auto p-4 sm:p-8 max-w-full">

    {{-- Team Members --}}
    <div class="flex flex-wrap gap-2 mb-6">
        <a href="/teams"
            class="flex items-center px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition">
            <span class="material-icons mr-2">group</span> Team
        </a>
        <a href="/genealogy"
            class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
            <span class="material-icons mr-2">device_hub</span> Genealogy
        </a>

        <a href="javascript:void(0)"
            class="flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg">
            <span class="material-icons mr-2">add_circle</span> Enroll
        </a>
    </div>

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
                    class="absolute right-0 mt-2 bg-white border rounded-lg shadow-lg p-4 w-56 hidden z-50">

                    <label class="block text-sm font-medium text-gray-700 mb-1">Filter by Package Rank</label>
                    <select id="packageFilter" class="w-full border px-3 py-2 rounded-md text-sm mb-4">
                        <option value="">All</option>
                        <option value="Standard">Standard</option>
                        <option value="Gold">Gold</option>
                        <option value="Platinum">Platinum</option>
                    </select>

                    <label class="block text-sm font-medium text-gray-700 mb-1">Filter by Level</label>
                    <select id="levelFilter" class="w-full border px-3 py-2 rounded-md text-sm">
                        <option value="">All</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <!-- Add more levels if needed -->
                    </select>
                </div>

            </div>
        </div>


        {{-- Team Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-700" id="teamTable">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs whitespace-nowrap">
                    <tr>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Username</th>
                        <th class="px-4 py-3">Sponsor</th>
                        <th class="px-4 py-3">Package</th>
                        <th class="px-4 py-3">Rank</th>
                        <th class="px-4 py-3">Level</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap">Juan Dela Cruz</td>
                        <td class="px-4 py-3 whitespace-nowrap">juan123</td>
                        <td class="px-4 py-3 whitespace-nowrap">Maria Clara</td>
                        <td class="px-4 py-3 whitespace-nowrap">Gold</td>
                        <td class="px-4 py-3 whitespace-nowrap">Dreamer</td>
                        <td class="px-4 py-3 whitespace-nowrap">3</td>
                    </tr>

                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap">Ana Reyes</td>
                        <td class="px-4 py-3 whitespace-nowrap">ana_r</td>
                        <td class="px-4 py-3 whitespace-nowrap">Pedro Santos</td>
                        <td class="px-4 py-3 whitespace-nowrap">Standard</td>
                        <td class="px-4 py-3 whitespace-nowrap">Affiliate</td>
                        <td class="px-4 py-3 whitespace-nowrap">1</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap">Maria Lopez</td>
                        <td class="px-4 py-3 whitespace-nowrap">maria_l</td>
                        <td class="px-4 py-3 whitespace-nowrap">Ana Reyes</td>
                        <td class="px-4 py-3 whitespace-nowrap">Platinum</td>
                        <td class="px-4 py-3 whitespace-nowrap">Rising Star</td>
                        <td class="px-4 py-3 whitespace-nowrap">4</td>
                    </tr>
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-4 flex justify-center">
                <!-- Add pagination controls here -->
            </div>

        </div>
    </div>

    <script>
    // Toggle filter dropdown
    document.getElementById('filterToggle').addEventListener('click', function() {
        const dropdown = document.getElementById('filterDropdown');
        dropdown.classList.toggle('hidden');
    });

    // Filter by Package Rank and Level
    function applyFilters() {
        const packageFilter = document.getElementById('packageFilter').value.toLowerCase();
        const levelFilter = document.getElementById('levelFilter').value;
        const rows = document.querySelectorAll('#teamTable tbody tr');

        rows.forEach(row => {
            const packageRank = row.children[3].textContent.toLowerCase();
            const level = row.children[5].textContent;

            const packageMatch = packageFilter === '' || packageRank === packageFilter;
            const levelMatch = levelFilter === '' || level === levelFilter;

            row.style.display = (packageMatch && levelMatch) ? '' : 'none';
        });
    }

    document.getElementById('packageFilter').addEventListener('change', applyFilters);
    document.getElementById('levelFilter').addEventListener('change', applyFilters);


    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('filterDropdown');
        const toggleBtn = document.getElementById('filterToggle');

        if (!dropdown.contains(event.target) && !toggleBtn.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
    </script>

</div>
@endsection