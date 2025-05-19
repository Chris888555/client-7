@extends('layouts.header')

@section('title', 'Our Products')

@section('content')

<div class="container m-auto p-0 sm:p-8 max-w-full">
    <div class="max-w-6xl mx-auto text-gray-200 ">

        <!-- Products Video -->
        <section class="px-6 pb-12 rounded-lg ">
            <div class="flex justify-center rounded-lg border-4">
                <video autoplay playsinline controls class="rounded-md shadow-lg max-w-full h-auto" preload="metadata">
                    <source
                        src="https://d1yei2z3i6k35z.cloudfront.net/4624298/682aedd0443da_AQP97hxAQERvniI-U4dMTddz5s4LP2QtRJ26L5vOcFkQmZxqFMXArxzyGFKRFGl01ka_6Sne8z9FXsH5Eany451p.mp4"
                        type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </section>


        <!-- Products Section -->
        <section class="px-6 mt-6 rounded-lg ">
            <div class="text-center mb-10">
                <h2 class="ext-2xl md:text-3xl font-bold uppercase ">Our Products</h2>
                <p class="text-gray-300 mt-2">Explore our trusted health and wellness products.</p>
            </div>

            <div class="flex flex-col md:flex-row md:flex-wrap gap-8 justify-center items-stretch">
                <!-- Product 1 -->
                <div class="border border-white p-6 rounded-md text-center flex-1 min-w-[280px] max-w-sm ">
                    <img src="https://d1yei2z3i6k35z.cloudfront.net/4624298/6829cef53ab32_487313253_550620331390756_8343306385939964530_n.jpg"
                        alt="Drink Juice" class="w-full h-auto object-cover rounded mb-4">
                    <h3 class="text-lg font-semibold mb-1">Drink Juice</h3>
                    <p class="text-sm text-gray-300 mb-2">Refreshing natural juice packed with vitamins and
                        antioxidants.</p>
                </div>

                <!-- Product 2 -->
                <div class="border border-white p-6 rounded-md text-center flex-1 min-w-[280px] max-w-sm ">
                    <img src="https://d1yei2z3i6k35z.cloudfront.net/4624298/6829cea95cde8_b3ea9185-8168-492f-ac42-519ccc7b7beb.jpeg"
                        alt="Coffee Strong" class="w-full h-auto object-cover rounded mb-4">
                    <h3 class="text-lg font-semibold mb-1">Coffee Strong</h3>
                    <p class="text-sm text-gray-300 mb-2">Bold and energizing coffee blend for your daily boost.</p>
                </div>

                <!-- Product 3 -->
                <div class="border border-white p-6 rounded-md text-center flex-1 min-w-[280px] max-w-sm ">
                    <img src="https://d1yei2z3i6k35z.cloudfront.net/4624298/6829ce25489be_486940050_546779351774854_5209543123287410448_n.jpg"
                        alt="Radiance C" class="w-full h-auto object-cover rounded mb-4">
                    <h3 class="text-lg font-semibold mb-1">Radiance C</h3>
                    <p class="text-sm text-gray-300 mb-2">Formulated to help reduce joint pain and inflammation,
                        supporting
                        healthy mobility and comfort.</p>
                </div>
            </div>
        </section>



        <div class="px-6 py-12 mt-6   ">

            <h2 class="ext-2xl md:text-3xl font-bold uppercase  text-center mb-6">What Our Customers Say</h2>

            <section class="flex flex-col md:flex-row  rounded-lg justify-center gap-6">
                <div class="flex-1 rounded-lg">
                    <video controls class="rounded-md shadow-lg max-w-full h-auto w-full border-4" preload="metadata">
                        <source
                            src="https://d1yei2z3i6k35z.cloudfront.net/12320059/681b79b659dc8_FDownloader.Net_AQO3jKZcKMNQkaz0azSiqTLD5ZKm7YnybY129TY-HCwKL7NyYwSK9kgAV-NqCc1vQopJP1QJj5DhekIwZ5WM0V7C_720p_HD.mp4"
                            type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>

                <div class="flex-1 rounded-lg">
                    <video controls class="rounded-md shadow-lg max-w-full h-auto w-full border-4" preload="metadata">
                        <source
                            src="https://d1yei2z3i6k35z.cloudfront.net/4624298/682af135e1df1_AQNNNp0nUQVDjS9SVFM8GQVCtw-iZYyItxHfv1jA8bS4EuPZ5dOvbbIgHp7_LtHGzHKDK9ciuHiYl-7q7iNnJUoCf51etdnH_Ia8SeJoIsxL7MD9kt6EADJTty2LJK4fspjkTxPQvg.mp4"
                            type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </section>
        </div>

    </div>
</div>

@endsection