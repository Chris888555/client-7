@extends('layouts.header')

@section('title', 'Company Profile')

@section('content')
<!-- Font Awesome CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


<div class="container m-auto p-4 sm:p-8 max-w-full">
<div class="max-w-6xl mx-auto text-gray-200 ">


    <!-- Company Intro -->
    <section class="space-y-6 text-center lg:text-left">
        <h1 class="text-2xl md:text-3xl font-bold uppercase ">
            NUTRIINNOVATIONS
        </h1>
        <p class="text-xl md:text-2xl font-semibold leading-snug max-w-4xl ">
            THE BUSINESS OF INNOVATION: The latest marketing venture of Nutrisense International.  
            Allows Nutripreneurs from all walks of life to take advantage of our 20-year business experience and expertise.
        </p>
        <p class="text-lg md:text-xl text-gray-300 max-w-3xl ">
            An online/offline marketing system and earning opportunity: your vehicle to prosperity and financial freedom.
        </p>
    </section>

    <!-- Leadership Team -->
     <section class="mt-8 text-center lg:text-left">
        <h2 class="text-2xl md:text-3xl font-bold uppercase leading-tight tracking-tight">
            THE NUTRIINNOVATIONS LEADERSHIP TEAM
        </h2>

        <p class="text-lg md:text-xl font-semibold mb-8  max-w-4xl ">
            Combining decades of local and international experience in:
        </p>

        <ul class="pl-6 text-gray-300 max-w-xl  space-y-2 text-left">
            <li class="list-disc">Product Development, Importation and Distribution</li>
            <li class="list-disc">Sales, Marketing and Branding, Financial Management</li>
            <li class="list-disc">Supply Chain Management</li>
            <li class="list-disc">Systems Engineering</li>
        </ul>

        <!-- Leaders -->
        <div class="mt-14 space-y-14 max-w-5xl mx-auto">

            <!-- Leader 1 -->
            <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
                <div class="flex-shrink-0">
                    <img src="https://d1yei2z3i6k35z.cloudfront.net/4624298/6829c4f470ab7_Copyofgetyoursnow13.jpg" alt="Jorge Benedict Gelido" 
                         class="w-36 h-36 md:w-40 md:h-40 object-cover rounded-xl shadow-lg border-4 border-gray-100">
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-yellow-400 mb-2">Jorge Benedict Gelido — <span class="text-white font-normal">Chairman</span></h3>
                    <ul class="pl-6 text-gray-300 space-y-1 text-left">
                        <li class="list-disc">Guiding and leading since 2006 with strategic leadership and vision for the company.</li>
                        <li class="list-disc">Drives branding, marketing, and corporate communications for Nutriinnovations.</li>
                        <li class="list-disc">Expert in forging global partnerships and securing exclusive U.S. supply agreements.</li>
                        <li class="list-disc">Ensures alignment between Nutriinnovations’ strengths and partners’ needs.</li>
                    </ul>
                </div>
            </div>

            <!-- Leader 2 -->
            <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
                <div class="flex-shrink-0">
                    <img src="https://d1yei2z3i6k35z.cloudfront.net/4624298/6829c5f34d53a_Copyofgetyoursnow14.jpg" alt="Jheanne Gelido" 
                         class="w-36 h-36 md:w-40 md:h-40 object-cover rounded-xl shadow-lg border-4 border-gray-100">
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-yellow-400 mb-2">Jheanne Gelido — <span class="text-white font-normal">President</span></h3>
                    <ul class="pl-6 text-gray-300 space-y-1 text-left">
                        <li class="list-disc">Controls all aspects of bookkeeping, finances, and inventory systems.</li>
                        <li class="list-disc">Oversees product manufacture, supply chain, and logistics.</li>
                        <li class="list-disc">Directs day-to-day internal operations.</li>
                        <li class="list-disc">Supports growth with optimized back-office practices.</li>
                        <li class="list-disc">Leads and manages our growing nationwide sales force.</li>
                    </ul>
                </div>
            </div>

            <!-- Leader 3 -->
            <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
                <div class="flex-shrink-0">
                    <img src="https://d1yei2z3i6k35z.cloudfront.net/4624298/6829c658c1041_Copyofgetyoursnow15.jpg" alt="Maria Nina Cotero" 
                         class="w-36 h-36 md:w-40 md:h-40 object-cover rounded-xl shadow-lg border-4 border-gray-100">
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-yellow-400 mb-2">Maria Nina Cotero — <span class="text-white font-normal">Founder</span></h3>
                    <ul class="pl-6 text-gray-300 space-y-1 text-left">
                        <li class="list-disc">Over 20 years of experience in global product import and marketing.</li>
                        <li class="list-disc">Heads overall product development and global supplier coordination.</li>
                        <li class="list-disc">Key liaison between U.S. partners and the Philippine market.</li>
                        <li class="list-disc">An icon of innovative, world-class products since the early 2000s.</li>
                    </ul>
                </div>
            </div>

            <!-- Leader 4 -->
            <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
                <div class="flex-shrink-0">
                    <img src="https://d1yei2z3i6k35z.cloudfront.net/4624298/6829c6ae00806_Copyofgetyoursnow16.jpg" alt="Jaime A. Cotero" 
                         class="w-36 h-36 md:w-40 md:h-40 object-cover rounded-xl shadow-lg border-4 border-gray-100">
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-yellow-400 mb-2">Jaime A. Cotero — <span class="text-white font-normal">Management Information Consultant</span></h3>
                    <ul class="pl-6 text-gray-300 space-y-1 text-left">
                        <li class="list-disc">American engineer with 30+ years of experience in large-scale petroleum infrastructure.</li>
                        <li class="list-disc">Based in Houston; managed projects across the U.S. including Georgia, Florida, and Texas.</li>
                        <li class="list-disc">Provides expertise in workflow optimization and operational efficiency.</li>
                        <li class="list-disc">Enhances productivity and ensures stability, profitability, and growth at Nutriinnovations.</li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    <!-- Legalities Section -->
<section class="mt-16 text-center lg:text-left">
    <h2 class="text-2xl md:text-3xl font-bold uppercase leading-tight tracking-tight text-gray-200">
        LEGALITIES
    </h2>
    <p class="text-lg md:text-xl font-semibold mb-6 text-gray-300 max-w-4xl">
        Nutriinnovations operates with full compliance under Philippine business laws and regulations.
        Below is a copy of our official documentation ensuring our legitimacy and commitment to ethical practices.
    </p>

    <div class="flex justify-center">
        <img src="https://d1yei2z3i6k35z.cloudfront.net/4624298/682ae7cdb1a74_BlueandWhiteGradientSign-upandLoginWebsitePageUIDesktopPrototype1.png" 
             alt="Company Legalities" 
             class="w-full max-w-4xl rounded-lg ">
    </div>
</section>

 </div>
</div>
@endsection
