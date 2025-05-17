@extends('layouts.header')

@section('title', 'Our Products')

@section('content')
<section class="max-w-6xl mx-auto px-6 py-12 space-y-12">
    <!-- Page Title -->
    <div class="text-center">
        <h2 class="text-3xl font-bold text-gray-900">Our Products</h2>
        <p class="text-gray-600 mt-2">Explore our trusted health and wellness products.</p>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        <!-- Product 1 -->
        <div class="border border-white p-6 rounded-md text-center">
            <img src="https://via.placeholder.com/150" alt="Drink Juice" class="w-full h-40 object-cover rounded mb-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-1">Drink Juice</h3>
            <p class="text-sm text-gray-700 mb-2">Refreshing natural juice packed with vitamins and antioxidants.</p>
            <span class="text-base font-bold text-green-600">₱180</span>
        </div>

        <!-- Product 2 -->
        <div class="border border-white p-6 rounded-md text-center">
            <img src="https://via.placeholder.com/150" alt="Coffee Strong" class="w-full h-40 object-cover rounded mb-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-1">Coffee Strong</h3>
            <p class="text-sm text-gray-700 mb-2">Bold and energizing coffee blend for your daily boost.</p>
            <span class="text-base font-bold text-green-600">₱320</span>
        </div>

        <!-- Product 3 -->
        <div class="border border-white p-6 rounded-md text-center">
            <img src="https://via.placeholder.com/150" alt="SkinSo White" class="w-full h-40 object-cover rounded mb-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-1">SkinSo White</h3>
            <p class="text-sm text-gray-700 mb-2">Effective skincare formula for a radiant and glowing complexion.</p>
            <span class="text-base font-bold text-green-600">₱450</span>
        </div>
    </div>
</section>
@endsection
