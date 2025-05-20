@extends('layouts.users')

@section('title', 'Dashboard')

@section('content')
<main class="container m-auto p-4 sm:p-8 max-w-full">

    <x-page-header-text title="Dashboard" />


    <div class=" mb-2">

        <!-- Profile Card with Gradient Dark Gray Theme -->
        <div
            class="mb-6 bg-gradient-to-br from-gray-800 to-gray-700 rounded-2xl border border-gray-700 p-6 shadow-xl text-gray-300 flex flex-col md:flex-row md:items-center md:justify-between gap-6">

            <!-- Profile Info -->
            <div class="flex items-center space-x-5">
                <img src="https://ceoroundtable.heart.org/wp-content/uploads/2018/05/Bradway-Robert_-tie_external_2017small.jpg"
                    alt="Profile Picture"
                    class="w-24 h-24 rounded-full object-cover border-4 border-teal-500 shadow-md">
                <div>
                    <h2 class="text-lg md:text-2xl font-bold text-white flex items-center space-x-2">
                        <span>Juan Dela Cruz</span>
                        <svg class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </h2>
                    <p class="text-sm text-gray-400 mt-1 flex items-center space-x-2">
                        <i class="fa-solid fa-ranking-star text-teal-400"></i>
                        <span class="text-teal-400 font-semibold">Rank:</span>
                        <span class="text-white">Affiliate</span>
                    </p>
                    <!-- Live Date -->
                    <p id="live-date" class="text-xs text-gray-400 mt-2"></p>
                </div>
            </div>

            <script>
            // Function to format date like: Tuesday, May 20, 2025
            function formatDate(date) {
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                return date.toLocaleDateString(undefined, options);
            }

            // Set the live date text on page load
            document.addEventListener("DOMContentLoaded", () => {
                const liveDateElem = document.getElementById("live-date");
                const now = new Date();
                liveDateElem.textContent = formatDate(now);
            });
            </script>


            <!-- Total Accumulated Income -->
            <div
                class="flex items-center space-x-4 bg-gray-800 p-4 rounded-xl shadow-inner border border-teal-600 md:w-96">
                <div class="bg-teal-500 text-white rounded-full p-3 ">
                    <i class="fa-solid fa-wallet text-xl mx-1"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Total Accumulated Income</p>
                    <p class="text-2xl font-bold text-teal-400">₱ 50,000</p> <!-- Replace with dynamic data -->
                </div>
            </div>

        </div>


        {{-- Earnings Summary Cards --}}
        <div class="mb-8 grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="bg-teal-800 rounded-xl p-6 flex items-center space-x-3">
                <span class="bg-white text-teal-600 rounded-full p-3 inline-flex items-center justify-center">
                    <i class="fas fa-money-bill-wave"></i>
                </span>
                <div>
                    <p class="text-gray-200 text-sm mb-1">Withdrawable Balance</p>
                    <h3 class="text-xl font-bold text-gray-100">₱ 10,000.00</h3>
                </div>
            </div>

            <div class="bg-teal-800 rounded-xl p-6 flex items-center space-x-3">
                <span class="bg-white text-teal-600 rounded-full p-3 inline-flex items-center justify-center">
                    <i class="fas fa-credit-card"></i>
                </span>
                <div>
                    <p class="text-gray-200 text-sm mb-1">Total Payout</p>
                    <h3 class="text-xl font-bold text-gray-100">₱ 15,000.00</h3>
                </div>
            </div>
        </div>

        {{-- Commission Cards --}}
        <div class="mb-6 grid grid-cols-1 lg:grid-cols-5 col-span-1 md:col-span-2 lg:col-span-3 w-full
            divide-y divide-gray-200 lg:divide-y-0 lg:divide-x divide-gray-300 rounded-xl bg-white border">

            <div class="flex items-center space-x-3 p-6 rounded-tl-xl rounded-bl-xl">
                <span class="bg-teal-600 text-white rounded-full p-3 inline-flex items-center justify-center">
                    <i class="fas fa-box"></i>
                </span>
                <div>
                    <p class="text-gray-600 text-sm mb-1">Whole Sale Commissions</p>
                    <h3 class="text-xl font-bold text-teal-600">₱ 5,000.00</h3>
                </div>
            </div>

            <div class="flex items-center space-x-3 p-6">
                <span class="bg-teal-600 text-white rounded-full p-3 inline-flex items-center justify-center">
                    <i class="fas fa-sync-alt"></i>
                </span>
                <div>
                    <p class="text-gray-600 text-sm mb-1">Cycle Commissions</p>
                    <h3 class="text-xl font-bold text-teal-600">₱ 3,000.00</h3>
                </div>
            </div>

            <div class="flex items-center space-x-3 p-6">
                <span class="bg-teal-600 text-white rounded-full p-3 inline-flex items-center justify-center">
                    <i class="fas fa-infinity"></i>
                </span>
                <div>
                    <p class="text-gray-600 text-sm mb-1">Infinity Commissions</p>
                    <h3 class="text-xl font-bold text-teal-600">₱ 2,000.00</h3>
                </div>
            </div>

            <div class="flex items-center space-x-3 p-6">
                <span class="bg-teal-600 text-white rounded-full p-3 inline-flex items-center justify-center">
                    <i class="fas fa-sitemap"></i>
                </span>
                <div>
                    <p class="text-gray-600 text-sm mb-1">Group Sales Commissions</p>
                    <h3 class="text-xl font-bold text-teal-600">₱ 4,000.00</h3>
                </div>
            </div>

            <div class="flex items-center space-x-3 p-6  ">
                <span class="bg-teal-600 text-white rounded-full p-3 inline-flex items-center justify-center">
                    <i class="fas fa-truck"></i>
                </span>
                <div>
                    <p class="text-gray-600 text-sm mb-1">Dropshipping Commissions</p>
                    <h3 class="text-xl font-bold text-teal-600">₱ 1,000.00</h3>
                </div>
            </div>

        </div>



        <div class="mb-6">
            <details class="bg-gray-100 rounded-xl border border p-4 text-gray-600">
                <summary class="cursor-pointer text-base md:text-lg font-semibold flex items-center justify-between">
                    <span><i class="fa-solid fa-sitemap mr-2 text-teal-400"></i> View Network Stats</span>
                    <i class="fa-solid fa-chevron-down text-gray-400"></i>
                </summary>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Total Network -->
                    <div class="bg-gray-800 rounded-xl p-4 border border-gray-700 shadow">
                        <h3 class="text-base md:text-lg font-semibold mb-1 flex items-center space-x-2 text-gray-300">
                            <i class="fa-solid fa-users text-teal-400"></i>
                            <span>Total Network</span>
                        </h3>
                        <p class="text-2xl md:text-3xl font-bold text-teal-300">1,250</p>
                        <p class="text-gray-400 text-xs md:text-sm">Total Downlines</p>
                    </div>

                    <!-- Left Leg -->
                    <div class="bg-gray-800 rounded-xl p-4 border border-gray-700 shadow">
                        <h3 class="text-base md:text-lg font-semibold mb-1 flex items-center space-x-2 text-gray-300">
                            <i class="fa-solid fa-arrow-left text-blue-400"></i>
                            <span>Left Team</span>
                        </h3>
                        <p class="text-2xl md:text-3xl font-bold text-blue-300">500</p>
                        <p class="text-gray-400 text-xs md:text-sm">Total Points: <span
                                class="text-white font-semibold">1,000 CV</span></p>
                    </div>

                    <!-- Right Leg -->
                    <div class="bg-gray-800 rounded-xl p-4 border border-gray-700 shadow">
                        <h3 class="text-base md:text-lg font-semibold mb-1 flex items-center space-x-2 text-gray-300">
                            <i class="fa-solid fa-arrow-right text-purple-400"></i>
                            <span>Right Team</span>
                        </h3>
                        <p class="text-2xl md:text-3xl font-bold text-purple-300">600</p>
                        <p class="text-gray-400 text-xs md:text-sm">Total Points: <span
                                class="text-white font-semibold">1,200 CV</span></p>
                    </div>

                    <!-- Remaining Points -->
                    <div class="bg-gray-800 rounded-xl p-4 border border-gray-700 shadow">
                        <h3 class="text-base md:text-lg font-semibold mb-1 flex items-center space-x-2 text-gray-300">
                            <i class="fa-solid fa-chart-simple text-yellow-400"></i>
                            <span>Waiting Points</span>
                        </h3>
                        <p class="text-2xl md:text-3xl font-bold text-yellow-300">200 CV</p>
                        <p class="text-gray-400 text-xs md:text-sm">Remaining points</p>
                    </div>
                </div>
            </details>
        </div>



        <!-- Referral, Shop, and Landing Page Links -->
        <div class="space-y-6 mb-6">

            <!-- Sale Funnel Page Link -->
            <div class="rounded-lg border border-stroke bg-white p-4">
                <h2 class="text-base font-semibold text-gray-700 md:text-title-sm">Sale Funnel Link</h2>
                <p class="text-sm text-gray-600 md:text-base">
                    Use this sales funnel link to promote your campaigns through Facebook ads and other marketing
                    channels.
                </p>
                <div class="relative mt-4">
                    <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-gray-400" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path d="M3 5a2 2 0 012-2h14a2 2 0 012 2v4H3V5zm0 6h18v8a2 2 0 01-2 2H5a2 2 0 01-2-2v-8z" />
                        </svg>
                    </div>
                    <div id="salesfunnel-link"
                        class="w-full rounded-lg border border-gray-300 bg-gray-50 py-4 ps-11 pe-28 text-gray-900 text-sm overflow-hidden whitespace-nowrap text-ellipsis">
                        https://nextgen.com/landing/chan888
                    </div>
                    <button onclick="copyToClipboard('salesfunnel-link')"
                        class="absolute bottom-2.5 end-2.5 rounded-lg bg-teal-600 px-3 py-2 text-white hover:bg-teal-700 flex items-center gap-1">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                        </svg>
                        <span class="text-sm">Copy</span>
                    </button>
                </div>
            </div>

            <!-- Refferal Link -->
            <div class="rounded-lg border border-stroke bg-white p-4">
                <h2 class="text-base font-semibold text-gray-700 md:text-title-sm">Referral Link</h2>
                <p class="text-sm text-gray-600 md:text-base">
                    Share this referral link with your friends who are ready to sign up.
                </p>
                <div class="relative mt-4">
                    <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            class="size-5 text-gray-400">
                            <path
                                d="M10 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM1.615 16.428a1.224 1.224 0 0 1-.569-1.175 6.002 6.002 0 0 1 11.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 0 1 7 18a9.953 9.953 0 0 1-5.385-1.572ZM16.25 5.75a.75.75 0 0 0-1.5 0v2h-2a.75.75 0 0 0 0 1.5h2v2a.75.75 0 0 0 1.5 0v-2h2a.75.75 0 0 0 0-1.5h-2v-2Z">
                            </path>
                        </svg>
                    </div>
                    <div id="referral-link"
                        class="w-full rounded-lg border border-gray-300 bg-gray-50 py-4 ps-11 pe-28 text-gray-900 text-sm overflow-hidden whitespace-nowrap text-ellipsis">
                        https://nextgen.com/chan888
                    </div>

                    <button onclick="copyToClipboard('referral-link')"
                        class="absolute bottom-2.5 end-2.5 rounded-lg bg-teal-600 px-3 py-2 text-white hover:bg-teal-700 flex items-center gap-1">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                        </svg>
                        <span class="text-sm">Copy</span>
                    </button>
                </div>
            </div>

            <!-- Shop Link -->
            <div class="rounded-lg border border-stroke bg-white p-4">
                <h2 class="text-base font-semibold text-gray-700 md:text-title-sm">Shop Link</h2>
                <p class="text-sm text-gray-600 md:text-base">
                    Share your shop link with customers who want to buy products directly.
                </p>
                <div class="relative mt-4">
                    <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-4">
                        <!-- New shop bag icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-gray-400" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M6 7V6a6 6 0 1112 0v1h2a1 1 0 011 1v13a2 2 0 01-2 2H5a2 2 0 01-2-2V8a1 1 0 011-1h2zm2 0h8V6a4 4 0 00-8 0v1z" />
                        </svg>
                    </div>

                    <div id="shop-link"
                        class="w-full rounded-lg border border-gray-300 bg-gray-50 py-4 ps-11 pe-28 text-gray-900 text-sm overflow-hidden whitespace-nowrap text-ellipsis">
                        https://nextgen.com/shop/chan888
                    </div>
                    <button onclick="copyToClipboard('shop-link')"
                        class="absolute bottom-2.5 end-2.5 rounded-lg bg-teal-600 px-3 py-2 text-white hover:bg-teal-700 flex items-center gap-1">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                        </svg>
                        <span class="text-sm">Copy</span>
                    </button>
                </div>
            </div>

        </div>





        {{-- Table of Users --}}
        <div class="bg-white rounded-xl border p-6">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800 flex items-center gap-2">
                <i class="fas fa-users text-teal-600"></i> Free Signup Clients
            </h2>

            <div class="overflow-x-auto max-w-full">
                <table class="table-auto w-full border-collapse border border-gray-300 min-w-[700px]">
                    <thead class="bg-teal-50">
                        <tr>
                            <th
                                class="border-b border-teal-200 px-5 py-3 text-left text-sm font-medium text-teal-700 uppercase tracking-wide">
                                <i class="fas fa-user mr-2"></i> Full Name
                            </th>
                            <th
                                class="border-b border-teal-200 px-5 py-3 text-left text-sm font-medium text-teal-700 uppercase tracking-wide">
                                <i class="fas fa-envelope mr-2"></i> Email
                            </th>
                            <th
                                class="border-b border-teal-200 px-5 py-3 text-left text-sm font-medium text-teal-700 uppercase tracking-wide">
                                <i class="fas fa-phone mr-2"></i> Number
                            </th>
                            <th
                                class="border-b border-teal-200 px-5 py-3 text-left text-sm font-medium text-teal-700 uppercase tracking-wide">
                                <i class="fas fa-calendar-alt mr-2"></i> Date Signed Up
                            </th>
                            <th
                                class="border-b border-teal-200 px-5 py-3 text-left text-sm font-medium text-teal-700 uppercase tracking-wide">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-teal-50 transition-colors duration-150">
                            <td class="border-b border-gray-200 px-5 py-4 text-gray-900 font-medium">Juan Dela Cruz</td>
                            <td class="border-b border-gray-200 px-5 py-4 text-gray-700">juan@example.com</td>
                            <td class="border-b border-gray-200 px-5 py-4 text-gray-700">09171234567</td>
                            <td class="border-b border-gray-200 px-5 py-4 text-gray-700">May 17, 2025</td>
                            <td class="border-b border-gray-200 px-5 py-4 text-red-600 font-semibold">Not Active</td>
                        </tr>
                        <tr class="hover:bg-teal-50 transition-colors duration-150">
                            <td class="border-b border-gray-200 px-5 py-4 text-gray-900 font-medium">Maria Santos</td>
                            <td class="border-b border-gray-200 px-5 py-4 text-gray-700">maria@example.com</td>
                            <td class="border-b border-gray-200 px-5 py-4 text-gray-700">09181234567</td>
                            <td class="border-b border-gray-200 px-5 py-4 text-gray-700">May 16, 2025</td>
                            <td class="border-b border-gray-200 px-5 py-4 text-red-600 font-semibold">Not Active</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


</main>
@endsection