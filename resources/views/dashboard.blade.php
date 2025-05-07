@extends('layouts.app')
@section('title', 'Dashboard') <!-- Custom title for this page -->
@section('content')
@include('includes.nav')
<main class="container m-auto p-4 sm:p-8 max-w-full">

<h1 class="text-2xl md:text-3xl font-bold text-left text-blue-400">Dashboard</h1>
    <p class="text-gray-600 text-left mb-4 ">Income dashboard: NutriInnovations earnings at a glance </p>

    <!-- Top Section: Image and Video Side by Side -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Left: Image (professional card layout) -->
        <div class="flex items-center justify-center mb-6 bg-gray-50">
            <div class="text-center w-full">
                <img src="https://d1yei2z3i6k35z.cloudfront.net/12320059/681b7bbbd3ca1_Screenshot2025-05-07at11.26.24PM.png"
                    alt="Antonio R. Ocampo Jr."
                    class="w-full h-full object-cover rounded-xl shadow-md mx-auto" />
            </div>
        </div>
        <!-- Right: Video (keeps video aspect ratio) -->
        <div class="flex items-center justify-center mb-6 bg-gray-50">
            <div class="w-full h-full">
                <video class="rounded-xl w-full h-full object-cover" controls>
                    <source
                        src="https://d1yei2z3i6k35z.cloudfront.net/12320059/681b79b659dc8_FDownloader.Net_AQO3jKZcKMNQkaz0azSiqTLD5ZKm7YnybY129TY-HCwKL7NyYwSK9kgAV-NqCc1vQopJP1QJj5DhekIwZ5WM0V7C_720p_HD.mp4"
                        type="video/mp4" />
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>

   <!-- Income Dashboard Section -->

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-16">
        <!-- Direct Income -->
        <div class="bg-white p-6 rounded-2xl shadow-md">
            <h3 class="text-xl font-semibold text-gray-700">Wholesale Commission</h3>
            <p class="text-2xl font-bold text-[#008080] mt-2">₱1,250</p>
        </div>
        <!-- Team Income -->
        <div class="bg-white p-6 rounded-2xl shadow-md">
            <h3 class="text-xl font-semibold text-gray-700">Cycle Commission</h3>
            <p class="text-2xl font-bold text-[#008080] mt-2">₱3,480</p>
        </div>
        <!-- Bonus -->
        <div class="bg-white p-6 rounded-2xl shadow-md">
            <h3 class="text-xl font-semibold text-gray-700">Infinity Bonus</h3>
            <p class="text-2xl font-bold text-[#008080] mt-2">₱620</p>
        </div>
        <!-- Total Earnings -->
        <div class="bg-white p-6 rounded-2xl shadow-md">
            <h3 class="text-xl font-semibold text-gray-700">Total Earnings</h3>
            <p class="text-2xl font-bold text-[#008080] mt-2">₱5,350</p>
        </div>
    </div>

</main>
@endsection
