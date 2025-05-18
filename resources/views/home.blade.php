@extends('layouts.header')

@section('title', 'Home')

@section('content')
<!-- Font Awesome CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">



<div class="max-w-6xl mx-auto px-4 md:px-6 py-10 md:py-16 text-gray-200 space-y-16">
    <!-- Hero Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
        <!-- Left: Text -->
        <div class="space-y-5 text-left">

            <!-- Login Member Button -->
            <a href="{{ route('login') }}" 
               class="inline-block px-6 py-3 mb-6 text-white bg-yellow-500 hover:bg-yellow-600 rounded font-semibold uppercase tracking-wide">
                Member Login 
            </a>

            <h2 class="text-3xl md:text-5xl font-bold uppercase leading-tight tracking-tight">
                NUTRIINNOVATIONS PLUS NEXTGEN
            </h2>
            <p class="text-xl md:text-2xl font-semibold leading-snug">
                The Limitless Potential of a <span class="text-blue-300">PIONEERING COMPANY</span><br
                    class="hidden md:block">
                COMBINED WITH
            </p>
            <p class="text-lg md:text-xl text-gray-300">
                The <span class="text-white font-semibold">STABILITY</span> of an Established, Twenty-Year Business
            </p>

            <!-- Checklist -->
            <ul class="space-y-3 text-base md:text-lg text-white font-medium">
                <li class="flex items-center justify-start gap-2">
                    <i class="fas fa-circle-check text-white"></i>
                    Trusted by thousands nationwide
                </li>
                <li class="flex items-center justify-start gap-2">
                    <i class="fas fa-circle-check text-white"></i>
                    Secured with SEC registration
                </li>
                <li class="flex items-center justify-start gap-2">
                    <i class="fas fa-circle-check text-white"></i>
                    Unique health and wellness products
                </li>
                <li class="flex items-center justify-start gap-2">
                    <i class="fas fa-circle-check text-white"></i>
                    Tested income-generating system
                </li>
                <li class="flex items-center justify-start gap-2">
                    <i class="fas fa-circle-check text-white"></i>
                    Proven success over 20 years
                </li>
            </ul>
        </div>

        <!-- Right: Image -->
        <div class="flex justify-center md:justify-end">
            <img src="https://d1yei2z3i6k35z.cloudfront.net/4624298/6829ba1ba6a5c_Copyofgetyoursnow4.png"
                alt="Nutriinnovations Plus Nextgen"
                class="w-64 h-64 md:w-[300px] md:h-[300px] object-cover rounded-xl shadow-xl">
        </div>
    </div>

    <!-- Testimonials -->
    <div class="bg-gray-800 p-6 md:p-10 rounded-xl shadow-lg space-y-6">
        <h3 class="text-2xl md:text-3xl font-bold text-center">What Our Members Say</h3>
        <div class="space-y-6">
            <blockquote class="italic border-l-4 border-blue-500 pl-4">
                "Napaka-solid ng system! Dati nag-struggle ako magbenta, pero ngayon may sarili na akong team."
                <br>– <strong>Maria L.</strong>
            </blockquote>
            <blockquote class="italic border-l-4 border-green-500 pl-4">
                "Legit ang kitaan. Ang bilis rin ng support team nila!"
                <br>– <strong>Joel D.</strong>
            </blockquote>
            <blockquote class="italic border-l-4 border-purple-500 pl-4">
                "Walang hype—totoong may resulta! Salamat sa mentoring at products."
                <br>– <strong>Carlo R.</strong>
            </blockquote>
            <blockquote class="italic border-l-4 border-yellow-500 pl-4">
                "Sulit ang effort! Dito ko nahanap ang tamang system para sa online business ko."
                <br>– <strong>Liza M.</strong>
            </blockquote>
            <blockquote class="italic border-l-4 border-pink-500 pl-4">
                "Reliable at hindi pabago-bago ang plano. May long-term vision talaga."
                <br>– <strong>Kevin S.</strong>
            </blockquote>
        </div>
    </div>
</div>
@endsection
