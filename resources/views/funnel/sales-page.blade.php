@extends('layouts.funnel')

@section('title', 'Ace Brew Coffee Sales Page')

@section('content')

<!-- ================= HERO + OFFER SECTION ================= -->
<section class="bg-gray-900 text-white py-20 px-6 lg:px-12">
  <div class="max-w-6xl mx-auto">

      <!-- Congratulations / Hook -->
      <div class="text-center mb-16">
          <h1 class="text-3xl sm:text-5xl font-extrabold mb-6 leading-tight">
              Congratulations!
          </h1>

          <h2 class="text-3xl font-bold">
              You’re one step closer to enjoying the rich flavor of   
              <span class="text-blue-400 font-semibold">Ace Brew Coffee</span>.
          </h2>

          <p class="text-xl text-gray-300 max-w-2xl mx-auto mt-4">
              Watch this short presentation to discover how you can 
              <span class="font-semibold text-blue-400">save more</span> 
              and unlock <span class="font-semibold text-blue-400">exclusive perks</span>!
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
      <div class="text-center space-y-6">
          <h2 class="text-3xl font-bold"> Special Offer for You!</h2>
          <p class="text-gray-300 max-w-2xl mx-auto">
              Become a member today and enjoy 
              <span class="font-semibold text-blue-400">exclusive discounts, free shipping, and priority access</span> 
              to new blends only for loyal Ace Brew drinkers.
          </p>

          <div class="flex flex-col sm:flex-row justify-center gap-6 mt-8">
              <!-- Member Button -->
              <a href="{{ route('buy.now.choose', $user->username) }}" 
                 class="bg-blue-400 hover:bg-blue-600 text-white px-8 py-4 rounded-2xl font-semibold text-lg shadow-md transition flex items-center gap-2">
                  <i class="fas fa-users"></i> Become a Member
              </a>

              <!-- Referral Button -->
              @if($funnel->referral_btn_state)
              <a href="{{ $funnel->referral_btn }}" 
                 class="bg-gray-800 hover:bg-gray-700 text-white px-8 py-4 rounded-2xl font-semibold text-lg shadow-md transition flex items-center gap-2">
                  <i class="fas fa-credit-card"></i> Pay Direct Company
              </a>
              @endif

              <!-- Shop Button -->
              @if($funnel->shop_btn_state)
              <a href="{{ $funnel->shop_btn }}" 
                 class="bg-white text-gray-900 hover:bg-gray-100 px-8 py-4 rounded-2xl font-semibold text-lg shadow-md transition flex items-center gap-2">
                  <i class="fas fa-shopping-cart"></i> Shop Now
              </a>
              @endif
          </div>
      </div>
  </div>
</section>

<!-- ================= DIVIDER SECTION ================= -->
<section class="w-full relative">
    <img src="{{ asset('assets/images/divider-image.png') }}" 
         alt="Divider" 
         class="w-full h-auto object-cover">
</section>

<!-- ================= TESTIMONIALS SECTION ================= -->
<section class="bg-white py-20 px-6 lg:px-12">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900">Hear from Our <span class="text-blue-600">Happy Customers</span></h2>
            <p class="text-lg text-gray-600 mt-2">Real stories. Real brews. Real smiles.</p>
        </div>

        <!-- Testimonial Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($testimonials as $testimonial)
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden flex flex-col">
                    
                    <!-- Video Section -->
                    @if($testimonial->video_link)
                        @php
                            $isUpload = Str::endsWith($testimonial->video_link, ['.mp4', '.webm', '.ogg']);
                        @endphp

                        @if($isUpload)
                            <video class="w-full" controls>
                                <source src="{{ asset($testimonial->video_link) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <div class="relative w-full" style="padding-top: 56.25%;">
                                <iframe class="absolute top-0 left-0 w-full h-full object-cover"
                                        src="{{ $testimonial->video_link }}"
                                        frameborder="0"
                                        allowfullscreen>
                                </iframe>
                            </div>
                        @endif
                    @else
                        <p class="w-full h-56 flex items-center justify-center bg-gray-100 text-gray-400">
                            No video available
                        </p>
                    @endif

                    <!-- Text Section -->
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <p class="text-gray-700 italic">"{{ $testimonial->message }}"</p>
                        <h4 class="mt-4 font-bold text-gray-900">{{ $testimonial->name }}</h4>
                        <span class="text-yellow-400">★★★★★</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
