<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kumita ng ADDITIONAL Income kahit nasa bahay lang</title>
    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/favicon/site.webmanifest') }}">
    <link rel="shortcut icon" href="{{ asset('assets/favicon/favicon.ico') }}" type="image/x-icon">

    <!-- SEO Basic Meta -->
    <meta name="title" content="Kumita ng ADDITIONAL Income kahit nasa bahay lang">
    <meta name="description" content="Learn how to earn extra ₱1,880 up to 50,000 daily income even with no experience. Join our FREE webinar and start your path to financial freedom today.">
    <meta name="keywords" content="income opportunity, extra income, online business, work from home, financial freedom, free webinar, earn money online">
    <meta name="author" content="GlobalPreneursBusiness">

    <!-- Open Graph / Facebook Meta -->
    <meta property="og:title" content="Kumita ng ADDITIONAL Income kahit nasa bahay lang" />
    <meta property="og:description" content="Learn how to earn extra ₱1,880 up to 50,000 daily income even with no experience. Join our FREE webinar and start your path to financial freedom today." />
    <meta property="og:image" content="{{ asset('assets/images/social-media-banner.jpg') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="GlobalPreneursBusiness" />
</head>


<style>
/* Bounce animation only for elements with .bounce class */
.bounce {
  display: inline-block; 
  animation: bounce 3s infinite;
}

@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    transform: translateY(0);
  }
  40% {
    transform: translateY(-15px);
  }
  60% {
    transform: translateY(-7px);
  }
}

</style>


<body class="bg-gray-50 font-sans text-gray-800">



<div class="w-full bg-red-600 text-white p-4 text-center shadow-lg z-50">
  <span class="text-sm md:text-base">
    Don’t miss this FREE webinar! 
  </span>
  <a href="#!" class="font-bold underline openFormBtn text-sm md:text-base">
    Reserve Your Spot
  </a>
</div>


<!-- Hero Section -->
<section class="relative bg-black text-white">
  <div class="max-w-6xl mx-auto px-6 pb-8 pt-16 md:pb-16 md:pt-28 text-center">
    <h1 class="text-4xl md:text-6xl font-extrabold mb-6">
      Tired of Working Hard But Still Short Every Month?<br>
      <span class="text-yellow-500">
        Discover the Smart New Way Filipinos Are Earning ₱50,000–₱100,000/Month Online — Even With Zero Experience.
      </span>
    </h1>

    <p class="text-xl md:text-3xl mb-8">
      Join our <span class="font-bold">FREE webinar</span> and discover the step-by-step system that lets beginners earn real, stable online income — no prior experience needed.
    </p>

    <a href="#!" class="openFormBtn inline-block bounce  bg-yellow-400 hover:bg-yellow-500 hover:shadow-yellow-300 text-gray-900 text-xl sm:text-2xl font-bold uppercase px-10 py-4 rounded-md  shadow-xl transition transform hover:-translate-y-1 hover:shadow-2xl">
      <i class="fas fa-rocket mr-2"></i> Yes! Show Me How To Earn
    </a>

    <p class="text-teal-600 font-bold mb-4 mt-6">
      ⚡ Seats are filling fast — reserve your slot today!
    </p>
  </div>
</section>





<!-- Multi-Layered Wavy Divider -->
<div class="bottom-0 left-0 w-full overflow-hidden leading-[0]">
    <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-32 md:h-40">
        <path d="M0,100 C300,80 900,120 1200,100 L1200,0 L0,0 Z" class="fill-black" style="opacity:0.25"></path>
        <path d="M0,80 C400,60 800,100 1200,80 L1200,0 L0,0 Z" class="fill-black" style="opacity:0.5"></path>
        <path d="M0,60 C350,90 850,30 1200,60 L1200,0 L0,0 Z" class="fill-black"></path>
    </svg>
</div>




<section class="relative py-16">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <!-- Heading -->
    <h2 class="text-3xl sm:text-4xl font-extrabold mb-8">
      Learn the Smart Way to Start Your Business
    </h2>

     <h3 class="text-2xl font-extrabold text-red-500 mb-8">Watch the video now!</h3>

    <!-- Video Container -->
    <div class="relative w-full max-w-4xl mx-auto rounded-2xl overflow-hidden shadow-xl">
      <video 
        class="w-full h-auto rounded-2xl" 
        controls 
        loop 
        playsinline 
        preload="auto"
      >
        <source src="{{ asset('assets/videos/landing_video.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
      </video>

      <!-- Overlay gradient (optional aesthetic) -->
      <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent pointer-events-none"></div>
    </div>

    <!-- CTA below video -->
    <div class="mt-10">
      <a href="#!" class="openFormBtn inline-block bounce  bg-yellow-400 hover:bg-yellow-500 hover:shadow-yellow-300 text-gray-900 text-xl sm:text-2xl font-bold uppercase px-10 py-4 rounded-md  shadow-xl transition transform hover:-translate-y-1 hover:shadow-2xl">
      <i class="fas fa-rocket mr-2"></i> Yes! Show Me How To Earn
    </a>
      <p class="text-teal-600 font-bold mb-4 mt-6">⚡ Seats are filling fast — reserve your slot today!</p>
    </div>
  </div>
</section>




<!-- Swiper CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>


<!-- Flipped Angled Top Divider -->
<div class="top-0 left-0 w-full overflow-hidden leading-[0] mb-[-2px]">
    <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-15 md:h-12">
        <path d="M0,40 L0,120 L1200,120 L1200,40 L600,0 Z" class="fill-black"></path>
    </svg>
</div>

<!-- Opportunity & Reveal Section -->
<section class="mx-auto px-6 py-20 bg-black">
  <div class="max-w-5xl mx-auto text-center text-white">

    <!-- Hook / Intro -->
    <p class="text-2xl md:text-3xl font-sans font-semibold leading-relaxed mb-4">
      If you’ve been praying for an <strong class="text-yellow-400">opportunity to earn more</strong> without sacrificing your time or family, this might be it.
    </p>

    <p class="text-2xl md:text-3xl font-sans font-semibold leading-relaxed mb-4">
      Many <strong class="text-yellow-400">professionals and OFWs</strong> are now quietly learning how to turn their free hours into <strong class="text-yellow-400">real income</strong> — through a simple system that works for anyone who follows it.
    </p>

    <!-- Reveal -->
    <p class="text-2xl md:text-3xl font-sans font-semibold leading-relaxed mb-4">
      Inside, you’ll discover the exact process that allows ordinary Filipinos to build a steady <strong class="text-yellow-400">₱50,000–₱100,000/month</strong> income online.
    </p>

    <p class="text-2xl md:text-3xl font-sans font-semibold leading-relaxed mb-4">
      Even if they have <strong class="text-yellow-400">zero experience</strong>.
    </p>

  </div>



 <div class="swiper mySwiper max-w-2xl mx-auto mt-16 ">
      <div class="swiper-wrapper">

      <!-- Image 1 -->
        <div class="swiper-slide">
          <img src="/assets/testi-images/testi-1.jpg" alt="Testimonial 1" class="w-full rounded-lg object-cover border-4 border-white">
        </div>

        <!-- Image 2 -->
        <div class="swiper-slide">
          <img src="/assets/testi-images/testi-2.jpg" alt="Testimonial 2" class="w-full rounded-lg object-cover border-4 border-white">
        </div>

        <!-- Image 3 -->
        <div class="swiper-slide">
          <img src="/assets/testi-images/testi-3.jpg" alt="Testimonial 3" class="w-full rounded-lg object-cover border-4 border-white">
        </div>

        <!-- Image 4 -->
        <div class="swiper-slide">
          <img src="/assets/testi-images/testi-4.jpg" alt="Testimonial 4" class="w-full rounded-lg object-cover border-4 border-white">
        </div>



      </div>
      

         <!-- Controls -->
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>

      <div class="swiper-pagination mt-2"></div>



        <style>
          .swiper-button-prev,
          .swiper-button-next {
            color: white !important; 
            background-color: #0d9488; 
            width: 40px;
            height: 40px;
            border-radius: 50%; 
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px; 
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
          }

          .swiper-button-prev:hover,
          .swiper-button-next:hover {
            background-color: #0f766e; 
          }

          
          .swiper-button-prev::after,
          .swiper-button-next::after {
            font-size: 18px;
          }
      
            .swiper-pagination {
          position: relative !important; 
          bottom: auto !important;
        }
        
        .swiper-pagination-bullet {
          background-color: #0d9488 !important;
          opacity: 0.5 !important;
        }
        .swiper-pagination-bullet-active {
          background-color: #0d9488 !important;
          opacity: 1 !important;
        }
      </style>
    </div>
  </div>

  <!-- Swiper Init -->
<script>
  var swiper = new Swiper(".mySwiper", {
    loop: true,
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
</script>

<div class="text-center mt-12">
  <a href="#!" class="openFormBtn inline-block bounce  bg-yellow-400 hover:bg-yellow-500 hover:shadow-yellow-300 text-gray-900 text-xl sm:text-2xl font-bold uppercase px-10 py-4 rounded-md  shadow-xl transition transform hover:-translate-y-1 hover:shadow-2xl">
      <i class="fas fa-rocket mr-2"></i> Yes! Show Me How To Earn
    </a>

  <p class="text-teal-600 font-bold mb-4 mt-6">
    ⚡ Seats are filling fast — reserve your slot today!
  </p>
</div>

</section>

<!-- Flipped Angled Bottom  -->
<div class="bottom-0 left-0 w-full overflow-hidden leading-[0]">
    <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-15 md:h-12">
        <path d="M0,80 L0,0 L1200,0 L1200,80 L600,120 Z" class="fill-black"></path>
    </svg>
</div>



<!-- Who I Am Section -->
@if($whoIamSection)
<section class="mx-auto px-6 py-16 md:py-20 bg-gray-50">
  <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-12">

    <!-- Image -->
    <div class="md:w-1/2 flex justify-center md:justify-start">
      @if($whoIamSection->image_path)
        <img src="{{ asset('storage/' . $whoIamSection->image_path) }}" 
             alt="{{ $whoIamSection->name }}" 
             class="w-80 md:w-full object-cover ">
      @endif
    </div>

    <!-- Text Content -->
    <div class="md:w-1/2 text-left space-y-4">


      <!-- Hook -->
      <p class="text-gray-800 font-bold text-xl md:text-2xl">
        {!! $whoIamSection->hook !!}
      </p>

      <!-- Title -->
      <h2 class="text-3xl md:text-4xl font-bold text-gray-800">
        I’m <span class="text-teal-600">{{ $whoIamSection->name }}</span>
      </h2>

      <!-- Intro Paragraph -->
      <p class="text-gray-700 text-lg md:text-base leading-relaxed">
        {!! $whoIamSection->intro !!}
      </p>

      <!-- Transition Paragraph -->
      <p class="text-gray-700 text-lg md:text-base leading-relaxed">
        {!! $whoIamSection->transition !!}
      </p>

      <!-- Bullets -->
      @if(!empty($whoIamSection->bullets))
        <ul class="text-gray-700 text-lg md:text-base leading-relaxed list-none pl-0 space-y-2">
          @foreach($whoIamSection->bullets as $bullet)
            <li class="flex items-start gap-2">
              <i class="fa-solid fa-circle-dot mt-1 text-teal-600"></i>
              <span>{!! $bullet !!}</span>
            </li>
          @endforeach
        </ul>
      @endif



      <!-- Motivation -->
      <p class="text-gray-800 text-lg md:text-base leading-relaxed font-semibold mt-4">
        {!! $whoIamSection->motivation !!}
      </p>

      <!-- Testimonial -->
      @if($whoIamSection->testimonial)
        <p class="mt-4 text-gray-600 italic">
          {!! $whoIamSection->testimonial !!}
        </p>
      @endif

      <!-- Call-to-Action -->
      <div class="mt-6 md:mt-8 flex justify-center md:justify-start">
          <a href="#!" class="openFormBtn inline-block bounce text-center bg-yellow-400 hover:bg-yellow-500 hover:shadow-yellow-300 text-gray-900 text-xl sm:text-2xl font-bold uppercase px-10 py-4 rounded-md  shadow-xl transition transform hover:-translate-y-1 hover:shadow-2xl">
      <i class="fas fa-rocket mr-2"></i> Yes! Show Me How To Earn
    </a>

          
      </div>

    </div>
  </div>
</section>
@endif













<!-- Flipped Angled Top Divider -->
<div class="top-0 left-0 w-full overflow-hidden leading-[0]">
    <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-15 md:h-12">
        <path d="M0,40 L0,120 L1200,120 L1200,40 L600,0 Z" class="fill-black"></path>
    </svg>
</div>

<!-- Final CTA -->
<section class="bg-black text-white text-center mt-[-1px]">
  <div class="max-w-6xl mx-auto px-6 py-20 text-center">
    <h2 class="text-4xl md:text-5xl font-bold mb-6">Start Something New!</h2>
    <p class="text-lg md:text-xl mb-8">Start with hope — this opportunity can change your life. Don’t miss out!</p>
     <a href="#!" class="openFormBtn inline-block bounce  bg-yellow-400 hover:bg-yellow-500 hover:shadow-yellow-300 text-gray-900 text-xl sm:text-2xl font-bold uppercase px-10 py-4 rounded-md  shadow-xl transition transform hover:-translate-y-1 hover:shadow-2xl">
      <i class="fas fa-rocket mr-2"></i> Yes! Show Me How To Earn
    </a>

           <p class="text-teal-600 font-bold mb-4 mt-6">⚡ Seats are filling fast — reserve your slot today!</p>
  </div>
</section>



<!-- Flipped Angled Bottom  -->
<div class="bottom-0 left-0 w-full overflow-hidden leading-[0]">
    <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-15 md:h-12">
        <path d="M0,80 L0,0 L1200,0 L1200,80 L600,120 Z" class="fill-black"></path>
    </svg>
</div>

<!-- FAQ Section -->
<section class="max-w-6xl mx-auto px-6 py-20">
  <h2 class="text-4xl font-bold text-center mb-16">Frequently Asked Questions</h2>

  <div class="space-y-4">
    <!-- FAQ Item 1 -->
    <div class="border rounded-2xl overflow-hidden">
      <button class="w-full text-left px-6 py-4 bg-black text-white flex justify-between items-center faq-btn">
        <span class="font-semibold text-lg">Paano ginagawa ng mga students natin para kumita ng extra kahit busy o may trabaho?</span>
        <i class="fas fa-chevron-down transition-transform"></i>
      </button>
      <div class="faq-content px-6 py-4 bg-white hidden">
       Simple lang — sinundan lang nila ‘yung step-by-step system na tinuturo namin.
May automation tools na nagtatrabaho kahit wala sila, kaya kahit OFW, employee, o parent, kaya nilang mag-run ng business part-time.
      </div>
    </div>

  

    <!-- FAQ Item 2 -->
    <div class="border rounded-2xl overflow-hidden">
      <button class="w-full text-left px-6 py-4 bg-black text-white flex justify-between items-center faq-btn">
        <span class="font-semibold text-lg">Bakit ang bilis ng resulta ng iba kahit baguhan sila?</span>
        <i class="fas fa-chevron-down transition-transform"></i>
      </button>
      <div class="faq-content px-6 py-4 bg-white hidden">
       Kasi hindi sila nagsimula mag-isa.
From day one, may mentorship, training, at community na naggaguide sa kanila.
So instead of trial and error, direkta silang tinuturuan kung ano gumagana.
      </div>
    </div>

    <!-- FAQ Item 3 -->
    <div class="border rounded-2xl overflow-hidden">
      <button class="w-full text-left px-6 py-4 bg-black text-white flex justify-between items-center faq-btn">
        <span class="font-semibold text-lg">Gano ka-secure ‘tong opportunity na ‘to?</span>
        <i class="fas fa-chevron-down transition-transform"></i>
      </button>
      <div class="faq-content px-6 py-4 bg-white hidden">
      Solid — kasi hindi ito hype o “quick money” na gawa-gawa lang.
Ito ay real business model, real products, at real results.
Kung kaya ng iba na ordinaryong tao, kaya mo rin basta committed ka.
      </div>
    </div>


    <!-- FAQ Item 4 -->
    <div class="border rounded-2xl overflow-hidden">
      <button class="w-full text-left px-6 py-4 bg-black text-white flex justify-between items-center faq-btn">
        <span class="font-semibold text-lg">Ano usually ang nagbabago sa mga sumali dito?</span>
        <i class="fas fa-chevron-down transition-transform"></i>
      </button>
      <div class="faq-content px-6 py-4 bg-white hidden">
       Bukod sa extra income, nagbabago mindset nila.
Mas nagiging confident, mas nagiging goal-driven, at mas natutong mag-create ng income online.
Yung iba, nagsimula lang curious — ngayon sila na yung inspiration ng iba.
      </div>
    </div>

    
  </div>
</section>

  <!-- CTA Button + Note -->
  <div class="mx-auto text-center mb-12 p-6">
    <a href="#!" class="openFormBtn inline-block bounce  bg-yellow-400 hover:bg-yellow-500 hover:shadow-yellow-300 text-gray-900 text-xl sm:text-2xl font-bold uppercase px-10 py-4 rounded-md  shadow-xl transition transform hover:-translate-y-1 hover:shadow-2xl">
      <i class="fas fa-rocket mr-2"></i> Yes! Show Me How To Earn
    </a>

    <p class="text-teal-600 font-bold mb-4 mt-6">⚡ Seats are filling fast — reserve your slot today!</p>
  </div>


<!-- Messenger Floating Button + Card -->
<div class="fixed bottom-2 right-2 sm:bottom-6 sm:right-6 z-50" id="messengerWrapper">
  <!-- Floating Button -->
  <button id="messengerBtn"
    class="flex items-center justify-center w-14 h-14 rounded-full bg-blue-500 text-white shadow-lg hover:bg-blue-600 transition"
    aria-label="Open Messenger">
    <i class="fab fa-facebook-messenger text-2xl"></i>
  </button>

  <!-- Messenger Card -->
  <div id="messengerCard"
       class="hidden mt-3 w-72 bg-white rounded-lg shadow-lg border border-gray-200 p-4">
    <div class="flex justify-between items-start">
      <h4 class="text-sm font-semibold text-gray-800">Need Help?</h4>
      <button id="closeMessenger" class="text-gray-400 hover:text-gray-600">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <p class="text-sm text-gray-600 mt-2">
      May concern or question? Pwede mo akong i-contact here directly.
    </p>

    <a href="{{ $funnel['messenger_btn'] }}" target="_blank" rel="noopener"
       class="mt-3 inline-flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition shadow">
      <i class="fab fa-facebook-messenger"></i>
      <span class="font-medium text-sm">Message Admin</span>
    </a>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("messengerBtn");
    const card = document.getElementById("messengerCard");
    const close = document.getElementById("closeMessenger");
    const wrapper = document.getElementById("messengerWrapper");

    // Open card
    btn.addEventListener("click", () => {
      btn.classList.add("hidden");
      card.classList.remove("hidden");
    });

    // Close via X button
    close.addEventListener("click", () => {
      card.classList.add("hidden");
      btn.classList.remove("hidden");
    });

    // Close if click outside card
    document.addEventListener("click", (e) => {
      if (!wrapper.contains(e.target) && !card.classList.contains("hidden")) {
        card.classList.add("hidden");
        btn.classList.remove("hidden");
      }
    });
  });
</script>




<!-- Footer / Disclaimer -->
<footer class="bg-gray-100 text-gray-400 text-sm py-6 px-6 text-center space-y-3">
  <div class="flex justify-center">
    <img id="logo-full" src="{{ asset('assets/images/funnel-logo.png') }}" alt="Logo" class="h-14 w-auto">
  </div>
  <p class="font-semibold text-gray-600">© 2025 Global Entrepreneurs Official.</p>
  <p class="mx-auto max-w-3xl">
    Disclaimer: This webinar and training are for educational and informational purposes only. No specific income is guaranteed, and results depend on each participant's effort. The platform and content comply with Facebook Ads and Community Guidelines.
  </p>
</footer>




<script>
// Simple FAQ toggle
document.querySelectorAll('.faq-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    const content = btn.nextElementSibling;
    const icon = btn.querySelector('i');

    content.classList.toggle('hidden');
    icon.classList.toggle('rotate-180'); // chevron rotation
  });
});
</script>


<!-- Modal -->
<div id="formModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-white w-full max-w-lg mx-4 rounded-2xl shadow-2xl p-10 relative">
    <button onclick="closeModal()"
      class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full bg-red-500 text-white hover:bg-red-600 text-2xl shadow-md transition">
      <i class="fa-solid fa-xmark"></i>
    </button>

    <!-- STEP 1 -->
    <div id="step1">
      <h2 class="text-2xl font-bold mb-6 text-left">
        We want to help you build your dream lifestyle.
        <span class="text-red-500">Tell us a bit about you</span> so we can guide you better.
      </h2>

      <div class="space-y-3 mb-4">
        <label class="block border rounded-xl px-4 py-3 cursor-pointer hover:bg-gray-50">
          <input type="radio" name="profile_type" value="Business Owner" class="mr-2"> Business Owner
        </label>
        <label class="block border rounded-xl px-4 py-3 cursor-pointer hover:bg-gray-50">
          <input type="radio" name="profile_type" value="Solopreneur / Agent / Distributor" class="mr-2"> Solopreneur / Agent / Distributor
        </label>
        <label class="block border rounded-xl px-4 py-3 cursor-pointer hover:bg-gray-50">
          <input type="radio" name="profile_type" value="OFW" class="mr-2"> OFW
        </label>
        <label class="block border rounded-xl px-4 py-3 cursor-pointer hover:bg-gray-50">
          <input type="radio" name="profile_type" value="Employee" class="mr-2"> Employee
        </label>
        <label class="block border rounded-xl px-4 py-3 cursor-pointer hover:bg-gray-50">
          <input type="radio" name="profile_type" value="Student" class="mr-2"> Student
        </label>
      </div>

      <button id="next1"
        class="mt-6 w-full py-3 bg-gray-900 hover:bg-gray-800 text-white rounded-lg font-semibold transition">
        NEXT →
      </button>
    </div>

    <!-- STEP 2 -->
    <div id="step2" class="hidden">
      <h2 class="text-2xl font-bold mb-6 text-left">
        If given the chance to start a business that could help you achieve your goals, 
        <span class="text-red-500">how much capital do you currently have saved in the bank?</span>
      </h2>


      <div class="space-y-3 mb-6">
        <label class="block border rounded-xl px-4 py-3 cursor-pointer hover:bg-gray-50">
          <input type="radio" name="capital" value="Less than ₱20k" class="mr-2"> Less than ₱20k
        </label>
        <label class="block border rounded-xl px-4 py-3 cursor-pointer hover:bg-gray-50">
          <input type="radio" name="capital" value="₱20k - ₱50k" class="mr-2"> ₱20k - ₱50k
        </label>
        <label class="block border rounded-xl px-4 py-3 cursor-pointer hover:bg-gray-50">
          <input type="radio" name="capital" value="₱50k - ₱100k" class="mr-2"> ₱50k - ₱100k
        </label>
        <label class="block border rounded-xl px-4 py-3 cursor-pointer hover:bg-gray-50">
          <input type="radio" name="capital" value="₱100k - ₱200k above" class="mr-2"> ₱100k - ₱200k above
        </label>
      </div>

      <div class="flex justify-between gap-3">
        <button id="back1"
          class="w-1/2 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-semibold transition">
          ← Back
        </button>
        <button id="next2"
          class="w-1/2 py-3 bg-gray-900 hover:bg-gray-800 text-white rounded-lg font-semibold transition">
          NEXT →
        </button>
      </div>
    </div>


    <!-- STEP 3 -->
    <div id="step3" class="hidden">
      <h2 class="text-2xl font-bold mb-6 text-left">
      What’s your main reason for wanting to 
      <span class="text-red-500">start an online business?</span>
    </h2>

      <div class="space-y-3 mb-6">
        <label class="block border rounded-xl px-4 py-3 cursor-pointer hover:bg-gray-50">
          <input type="radio" name="goal" value="To earn extra income" class="mr-2"> To create additional side income
        </label>
        <label class="block border rounded-xl px-4 py-3 cursor-pointer hover:bg-gray-50">
          <input type="radio" name="goal" value="To build a business" class="mr-2"> To prepare for retirement / long-term security
        </label>
        <label class="block border rounded-xl px-4 py-3 cursor-pointer hover:bg-gray-50">
          <input type="radio" name="goal" value="To replace my job income" class="mr-2"> To replace my current job income eventually
        </label>
        <label class="block border rounded-xl px-4 py-3 cursor-pointer hover:bg-gray-50">
          <input type="radio" name="goal" value="To replace my job income" class="mr-2"> To provide more for my family
        </label>
      </div>

      <div class="flex justify-between gap-3">
        <button id="back2"
          class="w-1/2 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-semibold transition">
          ← Back
        </button>
        <button id="next3"
          class="w-1/2 py-3 bg-gray-900 hover:bg-gray-800 text-white rounded-lg font-semibold transition">
          NEXT →
        </button>
      </div>
    </div>

    <!-- STEP 4 -->
    <div id="step4" class="hidden">
      <p class="text-teal-600 font-bold mb-4 mt-2 text-left">
    ⚡ Seats are filling fast — reserve your slot today!
      </p>
      <h2 class="text-2xl font-bold mb-6 text-left">
        Don’t overthink — just 
        <span class="text-red-500">learn the system that’s already working.</span>
      </h2>

      <form id="leadForm" class="space-y-4">
        @csrf
        <input type="hidden" name="page_link" value="{{ $funnel->page_link }}">
        <input type="hidden" name="role" id="profile_type">
        <input type="hidden" name="capital" id="capital_selected">
        <input type="hidden" name="goal" id="goal_selected">
        <input type="hidden" name="commitment" value="Interested">

        <div>
          <input type="text" name="name" placeholder="Enter Full Name"
            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
          <p class="error-message text-red-500 text-sm mt-1 hidden" data-error="name"></p>
        </div>

        <div>
          <input type="email" name="email" placeholder="Enter Email"
            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
          <p class="error-message text-red-500 text-sm mt-1 hidden" data-error="email"></p>
        </div>

        <div>
          <input type="text" name="phone" placeholder="Enter Phone Number"
            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
          <p class="error-message text-red-500 text-sm mt-1 hidden" data-error="phone"></p>
        </div>

        <div class="flex justify-between items-center gap-3 pt-4">
          <button type="button" id="back3"
            class="w-1/2 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-semibold transition">
            ← Back
          </button>
          <button type="submit"
            class="w-1/2 py-3 bg-gray-900 hover:bg-gray-800 text-white rounded-lg font-semibold shadow-lg transition flex items-center justify-center gap-2">
            <i class="fa-solid fa-rocket"></i> Get Instant Access
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const s1 = step1, s2 = step2, s3 = step3, s4 = step4;
  const profile = document.getElementById('profile_type');
  const capital = document.getElementById('capital_selected');
  const goal = document.getElementById('goal_selected');
  const next1 = document.getElementById('next1');
  const next2 = document.getElementById('next2');
  const next3 = document.getElementById('next3');
  const back1 = document.getElementById('back1');
  const back2 = document.getElementById('back2');
  const back3 = document.getElementById('back3');

  // Hide NEXT if Less than ₱20k
  document.querySelectorAll('input[name="capital"]').forEach(r => {
    r.addEventListener('change', () => {
      if (r.value === 'Less than ₱20k' && r.checked) {
        next2.classList.add('hidden');
        Swal.fire({
          icon: 'info',
          title: 'We’re looking for partners with a bit more starting capital.',
          text: 'If your capital is under ₱20k, we recommend saving a little more before joining the program.',
          confirmButtonColor: '#0d9488',
        });
      } else next2.classList.remove('hidden');
    });
  });

  next1.onclick = () => {
    const p = document.querySelector('input[name="profile_type"]:checked');
    if (!p) return Swal.fire({icon:'warning',title:'Select your profile first',confirmButtonColor:'#0d9488'});
    profile.value = p.value; s1.classList.add('hidden'); s2.classList.remove('hidden');
  };

  next2.onclick = () => {
    const c = document.querySelector('input[name="capital"]:checked');
    if (!c) return Swal.fire({icon:'warning',title:'Please select your capital range',confirmButtonColor:'#0d9488'});
    capital.value = c.value; s2.classList.add('hidden'); s3.classList.remove('hidden');
  };

  next3.onclick = () => {
    const g = document.querySelector('input[name="goal"]:checked');
    if (!g) return Swal.fire({icon:'warning',title:'Please select your goal',confirmButtonColor:'#0d9488'});
    goal.value = g.value; s3.classList.add('hidden'); s4.classList.remove('hidden');
  };

  back1.onclick = () => { s2.classList.add('hidden'); s1.classList.remove('hidden'); };
  back2.onclick = () => { s3.classList.add('hidden'); s2.classList.remove('hidden'); };
  back3.onclick = () => { s4.classList.add('hidden'); s3.classList.remove('hidden'); };

  function openModal(){formModal.classList.remove('hidden');formModal.classList.add('flex');}
  function closeModal(){formModal.classList.add('hidden');formModal.classList.remove('flex');s1.classList.remove('hidden');[s2,s3,s4].forEach(e=>e.classList.add('hidden'));}
  window.closeModal = closeModal;
  document.querySelectorAll(".openFormBtn").forEach(b=>b.onclick=e=>{e.preventDefault();openModal();});
  formModal.addEventListener('click',e=>{if(e.target===e.currentTarget)closeModal();});

  leadForm.addEventListener('submit',e=>{
    e.preventDefault();
    document.querySelectorAll(".error-message").forEach(el=>{el.classList.add("hidden");el.textContent="";});
    let fd=new FormData(e.target);
    fetch("{{ route('funnel.store') }}",{method:"POST",headers:{"X-CSRF-TOKEN":document.querySelector('input[name=\"_token\"]').value},body:fd})
      .then(r=>r.json()).then(d=>{
        if(d.status==="error"){
          Object.keys(d.errors).forEach(k=>{
            let el=document.querySelector(`[data-error=\"${k}\"]`);
            if(el){el.textContent=d.errors[k][0];el.classList.remove("hidden");}
          });
        }else if(d.status==="success"){window.location.href=d.redirect;}
      });
  });
});
</script>
