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
                The <span class="text-white font-semibold">STABILITY</span> of an Established Business Backed by 20+
                Years of Experience
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
                <li class="flex items-center justify-start gap-2">
                    <i class="fas fa-circle-check text-white"></i>
                    With Online Suport System-Tools and Trainings
                </li>
            </ul>
        </div>

        <!-- Right: Image -->
        <div class="flex justify-center md:justify-end">
            <img src="https://d1yei2z3i6k35z.cloudfront.net/4624298/682afadc83470_SBGPowderJar240grams120servings350029007.png"
                alt="Nutriinnovations Plus Nextgen" class="w-64 h-64 md:w-full md:h-auto object-cover rounded-xl ">
        </div>
    </div>
    <section class="py-8 sm:py-16 px-4">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-2xl md:text-3xl font-bold uppercase text-gray-200 mb-4">Real Testemonials</h2>
            <p class="text-lg text-gray-200 mb-12">Narito ang kwento ng mga taong kumita at nagbago ang buhay.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                <!-- Testimonial 1 -->
                <div
                    class="bg-gray-200 border border-gray-200 p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <p class="text-gray-700">"Napaka-solid ng system! Dati nag-struggle ako magbenta, pero ngayon may
                        sarili na akong team."</p>
                    <div class="mt-4 font-medium text-indigo-600">– Maria L.</div>
                </div>

                <!-- Testimonial 2 -->
                <div
                    class="bg-gray-200 border border-gray-200 p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <p class="text-gray-700">"Legit ang kitaan. Ang bilis rin ng support team nila!"</p>
                    <div class="mt-4 font-medium text-indigo-600">– Joel D.</div>
                </div>

                <!-- Testimonial 3 -->
                <div
                    class="bg-gray-200 border border-gray-200 p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <p class="text-gray-700">"Walang hype—totoong may resulta! Salamat sa mentoring at products."</p>
                    <div class="mt-4 font-medium text-indigo-600">– Carlo R.</div>
                </div>

                <!-- Testimonial 4 -->
                <div
                    class="bg-gray-200 border border-gray-200 p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <p class="text-gray-700">"Sulit ang effort! Dito ko nahanap ang tamang system para sa online
                        business ko."</p>
                    <div class="mt-4 font-medium text-indigo-600">– Liza M.</div>
                </div>

                <!-- Testimonial 5 -->
                <div
                    class="bg-gray-200 border border-gray-200 p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <p class="text-gray-700">"Reliable at hindi pabago-bago ang plano. May long-term vision talaga."</p>
                    <div class="mt-4 font-medium text-indigo-600">– Kevin S.</div>
                </div>

                <!-- Testimonial 6 -->
                <div
                    class="bg-gray-200 border border-gray-200 p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <p class="text-gray-700">"Dati puro try and error lang ako, pero ngayon tuloy-tuloy na ang income ko
                        dahil sa guidance dito."</p>
                    <div class="mt-4 font-medium text-indigo-600">– Angela V.</div>
                </div>
            </div>
        </div>
    </section>

    <section class=" px-4">
        <div class="max-w-6xl mx-auto text-center">

            <div class="rounded-xl overflow-hidden shadow-lg">
                <img src="https://d1yei2z3i6k35z.cloudfront.net/4624298/682b006f2b974_BlueandWhiteGradientSign-upandLoginWebsitePageUIDesktopPrototype.jpg"
                    alt="Sign-up and Login UI" class="w-full h-auto object-cover" />
            </div>
        </div>
    </section>

</div>
</div>
@endsection