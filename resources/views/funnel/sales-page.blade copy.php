@extends('layouts.funnel')

@section('title', 'Ace Brew Coffee Sales Page')

@section('content')
<div class="max-w-6xl mx-auto my-10 p-6 lg:p-12 bg-white">
    <!-- Congratulations / Hook -->
  <div class="text-center mb-16">
    <h1 class="text-3xl sm:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">
    Congratulations!
</h1>

    <h2 class="text-3xl font-bold text-gray-900"> You’re one step closer to enjoying the rich flavor of   <span class="text-orange-600 font-semibold">Ace Brew Coffee</span>. </h2>


    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
        Watch this short presentation to discover how you can 
        <span class="font-semibold text-orange-500">save more</span> 
        and unlock <span class="font-semibold text-orange-500">exclusive perks</span>!
    </p>
</div>


    <!-- Main Video Sales Presentation -->
    <div class="w-full mb-12 rounded-2xl overflow-hidden shadow-lg">
        <video class="w-full rounded-2xl" controls>
            <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

 <!-- Offer / Membership -->
<div class="text-center space-y-6 mb-16">
    <h2 class="text-3xl font-bold text-gray-900">🔥 Special Offer for You!</h2>
    <p class="text-gray-600 max-w-2xl mx-auto">
        Become a member today and enjoy 
        <span class="font-semibold text-orange-600">exclusive discounts, free shipping, and priority access</span> 
        to new blends only for loyal Ace Brew drinkers.
    </p>

    <div class="flex flex-col sm:flex-row justify-center gap-6 mt-8">
        @if($funnel->shop_btn)
        <a href="{{ $funnel->shop_btn }}" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 rounded-full font-semibold text-lg shadow-md transition">
            <i class="fas fa-shopping-cart mr-2"></i> Shop Now
        </a>
        @endif

        @if($funnel->referral_btn)
        <a href="{{ $funnel->referral_btn }}" class="bg-gray-800 hover:bg-gray-900 text-white px-8 py-4 rounded-full font-semibold text-lg shadow-md transition">
            <i class="fas fa-users mr-2"></i> Become a Member
        </a>
        @endif

        @if($funnel->messenger_btn)
        <a href="{{ $funnel->messenger_btn }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-full font-semibold text-lg shadow-md transition">
            <i class="fab fa-facebook-messenger mr-2"></i> Message Us
        </a>
        @endif
    </div>
</div>


<!-- Video Testimonials Section -->
<section class="bg-gray-50 py-20 rounded-3xl">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900">💬 Hear from Our <span class="text-orange-600">Happy Customers</span></h2>
            <p class="text-lg text-gray-600 mt-2">Real stories. Real brews. Real smiles.</p>
        </div>

        <!-- Testimonial Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @for($i = 1; $i <= 6; $i++)
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden flex flex-col">
                    <video class="w-full h-56 object-cover" controls>
                        <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <p class="text-gray-700 italic">"Ace Brew changed my mornings! Fresh, bold, and smooth. Highly recommended!"</p>
                        <h4 class="mt-4 font-bold text-gray-900">Customer {{ $i }}</h4>
                        <span class="text-yellow-400">★★★★★</span>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</section>
@endsection
