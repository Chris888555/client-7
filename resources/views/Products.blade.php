@extends('layouts.header')

@section('title', 'Our Products')

@section('content')
<section class="max-w-6xl mx-auto px-6 py-12 space-y-12">
    <!-- Page Title -->
    <div class="text-center">
        <h2 class="text-5xl font-bold text-gray-200">Our Products</h2>
        <p class="text-gray-200 mt-2">Explore our trusted health and wellness products.</p>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        <!-- Product 1 -->
        <div class="border border-white p-6 rounded-md text-center">
            <img src="https://d1yei2z3i6k35z.cloudfront.net/4624298/6829cef53ab32_487313253_550620331390756_8343306385939964530_n.jpg"
                alt="Drink Juice" class="w-full h-auto object-cover rounded mb-4">
            <h3 class="text-lg font-semibold text-gray-200 mb-1">Drink Juice</h3>
            <p class="text-sm text-gray-200 mb-2">Refreshing natural juice packed with vitamins and antioxidants.</p>

        </div>

        <!-- Product 2 -->
        <div class="border border-white p-6 rounded-md text-center">
            <img src="https://d1yei2z3i6k35z.cloudfront.net/4624298/6829cea95cde8_b3ea9185-8168-492f-ac42-519ccc7b7beb.jpeg"
                alt="Coffee Strong" class="w-full h-auto  object-cover rounded mb-4">
            <h3 class="text-lg font-semibold text-gray-200 mb-1">Coffee Strong</h3>
            <p class="text-sm text-gray-200 mb-2">Bold and energizing coffee blend for your daily boost.</p>

        </div>

        <!-- Product 3 -->
        <div class="border border-white p-6 rounded-md text-center">
            <img src="https://d1yei2z3i6k35z.cloudfront.net/4624298/6829ce25489be_486940050_546779351774854_5209543123287410448_n.jpg"
                alt="Radiance C" class="w-full h-auto object-cover rounded mb-4">
            <h3 class="text-lg font-semibold text-gray-200 mb-1">Radiance C</h3>
            <p class="text-sm text-gray-200 mb-2">Formulated to help reduce joint pain and inflammation, supporting
                healthy mobility and comfort.</p>
        </div>

    </div>
</section>
@endsection