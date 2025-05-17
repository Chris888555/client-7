@extends('layouts.header')

@section('title', 'Home')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-12 space-y-16">

    <!-- Hook Section -->
    <section class="text-center space-y-6 px-4 py-8 border border-white rounded-md max-w-4xl mx-auto">
        <h1 class="text-4xl font-extrabold text-gray-900">Welcome to NutriInnovations</h1>
        <p class="text-xl text-gray-700 max-w-3xl mx-auto">
            Your trusted partner in health essentials through dropshipping & affiliate marketing
        </p>
        <a href="/" 
           class="inline-block px-8 py-3 rounded-md bg-green-600 text-white font-semibold hover:bg-green-700 transition">
           Join as Affiliate
        </a>
    </section>

    <!-- Highlights Section -->
    <section class="grid md:grid-cols-3 gap-8 px-4">
        <div class="border border-white rounded-md p-6 text-center">
            <h3 class="text-xl font-semibold mb-2">High-Demand Essentials</h3>
            <p class="text-gray-700">
                We offer vitamins, herbal products, and daily health boosters ready for dropshipping.
            </p>
        </div>
        <div class="border border-white rounded-md p-6 text-center">
            <h3 class="text-xl font-semibold mb-2">Zero Inventory Required</h3>
            <p class="text-gray-700">
                No need to stock products. We handle fulfillment while you focus on selling.
            </p>
        </div>
        <div class="border border-white rounded-md p-6 text-center">
            <h3 class="text-xl font-semibold mb-2">Affiliate Ready</h3>
            <p class="text-gray-700">
                Earn commissions by promoting our top-selling health essentials.
            </p>
        </div>
    </section>

    <!-- Product Line Section -->
    <section class="max-w-5xl mx-auto space-y-8 px-4">
        <h2 class="text-3xl font-bold text-gray-900 text-center mb-6">Our Product Line</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
            <div class="border border-white rounded-md p-6">
                <h3 class="text-xl font-semibold mb-2">Vitamins & Supplements</h3>
            </div>
            <div class="border border-white rounded-md p-6">
                <h3 class="text-xl font-semibold mb-2">Herbal Essentials</h3>
            </div>
            <div class="border border-white rounded-md p-6">
                <h3 class="text-xl font-semibold mb-2">Skincare & Wellness</h3>
            </div>
        </div>
    </section>

    <!-- Affiliate Call-to-Action -->
    <section class="border border-white rounded-md max-w-3xl mx-auto p-8 text-center space-y-4">
        <h2 class="text-2xl font-bold text-gray-900">Start Earning with Our Affiliate Program</h2>
        <p class="text-gray-700">
            Get your own affiliate link and start promoting right away. Track your commissions in real-time!
        </p>
        <a href="/" 
           class="inline-block px-8 py-3 rounded-md bg-green-600 text-white font-semibold hover:bg-green-700 transition">
           Join as Affiliate
        </a>
    </section>

</div>
@endsection
