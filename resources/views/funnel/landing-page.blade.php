<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start Your Journey to Financial Freedom | Free Webinar</title>
    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/favicon/site.webmanifest') }}">
    <link rel="shortcut icon" href="{{ asset('assets/favicon/favicon.ico') }}" type="image/x-icon">

    <!-- SEO Basic Meta -->
    <meta name="title" content="Start Your Journey to Financial Freedom | Free Webinar">
    <meta name="description" content="Learn how to earn extra ₱20,000+ monthly income even with no experience. Join our FREE webinar and start your path to financial freedom today.">
    <meta name="keywords" content="income opportunity, extra income, online business, work from home, financial freedom, free webinar, earn money online">
    <meta name="author" content="Success Academy">

    <!-- Open Graph / Facebook Meta -->
    <meta property="og:title" content="Start Your Journey to Financial Freedom | Free Webinar" />
    <meta property="og:description" content="Learn how to earn extra ₱20,000+ monthly income even with no experience. Join our FREE webinar and start your path to financial freedom today." />
    <meta property="og:image" content="{{ asset('assets/images/income-opportunity-banner.png') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Success Academy" />
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



<div class="w-full bg-yellow-400 text-gray-900 p-4 text-center shadow-lg z-50">
  <span class="text-sm md:text-base">
    Don’t miss this FREE webinar! 
  </span>
  <a href="#!" class="font-bold underline openFormBtn text-sm md:text-base">
    Reserve Your Spot
  </a>
</div>


<!-- Hero Section -->
<section class="relative bg-teal-900 text-white">
    <div class="max-w-6xl mx-auto px-6 pb-8 pt-16 md:pb-16 md:pt-28 text-center">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-6">
            Gusto mo bang <span class="text-yellow-400">KUMITA ng ADDITIONAL</span> income kahit nasa bahay ka lang? 
            <span class="text-yellow-400">Totoong kitaan na legal at ethical</span>
        </h1>
        <p class="text-xl md:text-3xl mb-8">
            Join our <span class="font-bold">FREE webinar</span> to learn how to earn stable income<br class="hidden md:block"> as a INFINITE partner.
        </p>

        <a href="#!" class="openFormBtn inline-block bounce bg-yellow-400 hover:bg-yellow-500 text-gray-900 text-xl font-semibold px-10 py-4 rounded-full shadow-xl transition transform hover:-translate-y-1 hover:shadow-2xl">
            <i class="fas fa-rocket mr-2"></i> Yes! Show Me How To Earn
        </a>
        <p class="text-white font-bold mb-4 mt-6">⚡ Only <span id="spots">10</span> spots left! Sign up before they’re gone!</p>
    </div>
</section>



<!-- Multi-Layered Wavy Divider -->
<div class="bottom-0 left-0 w-full overflow-hidden leading-[0]">
    <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-32 md:h-40">
        <path d="M0,100 C300,80 900,120 1200,100 L1200,0 L0,0 Z" class="fill-teal-900" style="opacity:0.25"></path>
        <path d="M0,80 C400,60 800,100 1200,80 L1200,0 L0,0 Z" class="fill-teal-900" style="opacity:0.5"></path>
        <path d="M0,60 C350,90 850,30 1200,60 L1200,0 L0,0 Z" class="fill-teal-900"></path>
    </svg>
</div>




<!-- Benefits Section -->
<section class="max-w-6xl mx-auto px-6 py-20">
    <h2 class="text-3xl md:text-4xl font-bold text-center mb-16">
        Ano ang Matututunan Mo sa FREE Webinar?
    </h2>
    <div class="grid md:grid-cols-3 gap-12 text-center">

        <!-- Benefit 1 -->
        <div class="bg-white rounded-2xl shadow-xl p-10 hover:shadow-2xl transition duration-300">
            <i class="fa-solid fa-people-group text-teal-600 text-4xl mb-4"></i>
            <h3 class="text-2xl font-semibold mb-2">Magandang Opportunity</h3>
            <p class="text-gray-600 text-xl">Alamin ang best opportunity na swak sa kahit anong status—OFWs, nanay, business owners, freelancers, employees, at iba pa.</p>
        </div>

        <!-- Benefit 2 -->
        <div class="bg-white rounded-2xl shadow-xl p-10 hover:shadow-2xl transition duration-300">
            <i class="fa-solid fa-lightbulb text-teal-600 text-4xl mb-4"></i>
            <h3 class="text-2xl font-semibold mb-2">Proven Strategies & Tools</h3>
            <p class="text-gray-600 text-xl">Makakakuha ka ng ready-to-use strategies at tools na pwede mong kopyahin para palaguin ang negosyo gaya ng mga natulungan naming kumita sa community.</p>
        </div>

        <!-- Benefit 3 -->
        <div class="bg-white rounded-2xl shadow-xl p-10 hover:shadow-2xl transition duration-300">
            <i class="fa-solid fa-rocket text-teal-600 text-4xl mb-4"></i>
            <h3 class="text-2xl font-semibold mb-2">Become an INFINITE Partner</h3>
            <p class="text-gray-600 text-xl">Matutunan kung paano maging INFINITE partner at simulan kumita ng additional income kahit sa bahay lang gamit ang strategies at tools na ipapakita sa webinar.</p>
        </div>

    </div>
</section>


<!-- Ergency Call to action Section -->
<section class="max-w-5xl mx-auto px-6 mt-8">
  <div class="relative overflow-visible text-center">
      <!-- Card -->
      <div class="bg-yellow-400 text-gray-900 relative z-10 rounded-2xl shadow-lg shadow-gray-800/50 px-4 py-16 md:py-20">
          <h3 class="text-3xl md:text-4xl font-bold mb-6">
              Don’t Miss This Opportunity!
          </h3>
          <p class="text-lg md:text-xl mb-6">
              Make sure mag-sign up ka **today** para mapanoon mo ang <span class="font-bold">exclusive FREE webinar</span> <br class="hidden md:block">at hindi masayang ang opportunity na naghihintay sayo.
          </p>
          <p class="text-lg md:text-xl mb-6">
              Imagine kung kikita ka ng <span class="font-bold">₱20K–₱100K per month</span> sa business na ito.<br class="hidden md:block"> Ano ang maitutulong nito sayo at sa pamilya mo?
          </p>
          <p class="text-lg md:text-xl mb-8 font-semibold">
              Sign up now at watch the FREE exclusive webinar. <span class="text-red-600 font-bold">Only 10 slots left!</span> <br class="hidden md:block">Para sa mga gusto ma-guided.
          </p>
          <a href="#!" class="openFormBtn inline-block bounce bg-teal-700 hover:bg-teal-800 text-white text-xl font-semibold px-10 py-4 rounded-full shadow-xl transition transform hover:-translate-y-1 hover:shadow-2xl">
            <i class="fas fa-rocket mr-2"></i> Yes! Show Me How To Earn
        </a>
      </div>

      <!-- peak -->
      <div class="absolute top-0 left-0 w-full -translate-y-1/2 z-20">
          <svg viewBox="0 0 1200 100" preserveAspectRatio="none" class="w-full h-16">
              <path d="M0,100 L600,0 L1200,100 Z" class="fill-yellow-400"/>
          </svg>
      </div>
  </div>
</section>







<!-- Swiper CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<!-- Testimonial Carousel -->
<section class=" mx-auto px-6 py-16 md:py-28">
 <div class="max-w-5xl mx-auto "> 
  <h3 class="text-3xl md:text-4xl font-bold mb-6 text-center">
             What Our Partner Says!
          </h3>
      
  <div class="swiper mySwiper">
    <div class="swiper-wrapper ">

      <!-- First Testimonial -->
      <div class="swiper-slide">
        <div class="md:px-16"> 
        <div class="p-8 md:p-12 flex flex-col md:flex-row items-center md:items-start gap-6">
          <!-- Image -->
          <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Maria R." class="w-24 h-24 rounded-full object-cover flex-shrink-0">
          <!-- Text -->
          <div class="text-center md:text-left">
            <h3 class="font-bold text-lg">Maria R.</h3>
            <p class="text-teal-600 font-medium mb-2">Entrepreneur</p>
            <div class="flex justify-center md:justify-start mb-4 text-yellow-500">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>
            <p class="text-gray-600">"Grabe, sobrang easy lang pala mag-start dito. Ngayon may extra income na ako every month!"</p>
          </div>
        </div>
      </div>
    </div>

      <!-- Second Testimonial -->
      <div class="swiper-slide">
        <div class="md:px-16"> 
        <div class="p-8  md:p-12 flex flex-col md:flex-row items-center md:items-start gap-6">
          <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="John D." class="w-24 h-24 rounded-full object-cover flex-shrink-0">
          <div class="text-center md:text-left">
            <h3 class="font-bold text-lg">John D.</h3>
            <p class="text-teal-600 font-medium mb-2">Freelancer</p>
            <div class="flex justify-center md:justify-start mb-4 text-yellow-500">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <p class="text-gray-600">"Super helpful ng mga mentors dito. Lagi silang nandyan kapag kailangan mo ng tips."</p>
          </div>
        </div>
      </div>
      </div>

      <!-- Third Testimonial -->
      <div class="swiper-slide">
        <div class="md:px-16"> 
        <div class="p-8  md:p-12 flex flex-col md:flex-row items-center md:items-start gap-6">
          <img src="https://randomuser.me/api/portraits/women/22.jpg" alt="Anna L." class="w-24 h-24 rounded-full object-cover flex-shrink-0">
          <div class="text-center md:text-left">
            <h3 class="font-bold text-lg">Anna L.</h3>
            <p class="text-teal-600 font-medium mb-2">Online Seller</p>
            <div class="flex justify-center md:justify-start mb-4 text-yellow-500">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>
            <p class="text-gray-600">"Akala ko mahirap, pero ngayon mas malaki income ko dito kaysa sa trabaho ko. Ang saya!"</p>
          </div>
        </div>
      </div>
    </div>
  </div>

   <!-- Controls -->
    <div class="swiper-button-prev text-teal-600"></div>
    <div class="swiper-button-next text-teal-600"></div>
    <div class="swiper-pagination"></div>
    <style>
    .swiper-button-prev,
    .swiper-button-next {
      color: #0d9488 !important; /* teal-600 */
    }

    .swiper-pagination-bullet {
      background-color: #0d9488 !important; /* teal-600 */
      opacity: 0.5 !important; /* default inactive look */
    }

    .swiper-pagination-bullet-active {
      background-color: #0d9488 !important; /* teal-600 */
      opacity: 1 !important;
    }
    </style>


   </div>
</section>

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





<!-- Flipped Angled Top Divider -->
<div class="top-0 left-0 w-full overflow-hidden leading-[0]">
    <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-15 md:h-12">
        <path d="M0,40 L0,120 L1200,120 L1200,40 L600,0 Z" class="fill-teal-900"></path>
    </svg>
</div>

<!-- Final CTA -->
<section class="bg-teal-900 text-white text-center mt-[-1px]">
  <div class="max-w-6xl mx-auto px-6 py-20 text-center">
    <h2 class="text-4xl md:text-5xl font-bold mb-6">Start Something New!</h2>
    <p class="text-lg md:text-xl mb-8">Start with hope — this opportunity can change your life. Don’t miss out!</p>
    <a href="#!" class="openFormBtn inline-block bounce bg-yellow-400 hover:bg-yellow-500 text-gray-900 text-xl font-semibold px-10 py-4 rounded-full shadow-xl transition transform hover:-translate-y-1 hover:shadow-2xl">
      <i class="fas fa-rocket mr-2"></i> Sign Up Now & Watch the FREE Webinar
    </a>
  </div>
</section>



<!-- Flipped Angled Bottom  -->
<div class="bottom-0 left-0 w-full overflow-hidden leading-[0]">
    <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-15 md:h-12">
        <path d="M0,80 L0,0 L1200,0 L1200,80 L600,120 Z" class="fill-teal-900"></path>
    </svg>
</div>

<!-- FAQ Section -->
<section class="max-w-6xl mx-auto px-6 py-20">
  <h2 class="text-4xl font-bold text-center mb-16">Frequently Asked Questions</h2>

  <div class="space-y-4">
    <!-- FAQ Item 1 -->
    <div class="border rounded-2xl overflow-hidden">
      <button class="w-full text-left px-6 py-4 bg-indigo-50 flex justify-between items-center faq-btn">
        <span class="font-semibold text-lg">Paano ako makaka-access sa webinar?</span>
        <i class="fas fa-chevron-down transition-transform"></i>
      </button>
      <div class="faq-content px-6 py-4 bg-white hidden">
        Pagkatapos mong mag-sign up gamit ang form, makakakuha ka agad ng access sa exclusive webinar.
      </div>
    </div>

    <!-- FAQ Item 2 -->
    <div class="border rounded-2xl overflow-hidden">
      <button class="w-full text-left px-6 py-4 bg-indigo-50 flex justify-between items-center faq-btn">
        <span class="font-semibold text-lg">Libre ba ang webinar?</span>
        <i class="fas fa-chevron-down transition-transform"></i>
      </button>
      <div class="faq-content px-6 py-4 bg-white hidden">
        Oo! 100% libre ang access sa aming webinar para sa lahat ng gustong matuto kung paano kumita online, kahit busy ka o anuman ang ginagawa mo.
      </div>
    </div>

    <!-- FAQ Item 3 -->
    <div class="border rounded-2xl overflow-hidden">
      <button class="w-full text-left px-6 py-4 bg-indigo-50 flex justify-between items-center faq-btn">
        <span class="font-semibold text-lg">Para kanino ba ito?</span>
        <i class="fas fa-chevron-down transition-transform"></i>
      </button>
      <div class="faq-content px-6 py-4 bg-white hidden">
        Para ito sa iyo basta handa kang matuto at magpaturo. Tutulungan ka namin kung paano mo ito gagawin sa mas madaling paraan at epektibong strategy.
      </div>
    </div>

    <!-- FAQ Item 4 -->
    <div class="border rounded-2xl overflow-hidden">
      <button class="w-full text-left px-6 py-4 bg-indigo-50 flex justify-between items-center faq-btn">
        <span class="font-semibold text-lg">May mga tools ba tayo?</span>
        <i class="fas fa-chevron-down transition-transform"></i>
      </button>
      <div class="faq-content px-6 py-4 bg-white hidden">
        Oo! Lahat ng marketing materials, videos, sales funnel, trainings, at webinar ay provided para mapalago mo ang iyong business.
      </div>
    </div>

    <!-- FAQ Item 5 -->
    <div class="border rounded-2xl overflow-hidden">
      <button class="w-full text-left px-6 py-4 bg-indigo-50 flex justify-between items-center faq-btn">
        <span class="font-semibold text-lg">Sigurado ba akong kikita dito?</span>
        <i class="fas fa-chevron-down transition-transform"></i>
      </button>
      <div class="faq-content px-6 py-4 bg-white hidden">
        Oo! 100% basta susundin mo ang mga guide at ang lahat ng ituturo ko sa iyo bilang mentor mo dito sa ating platform.
      </div>
    </div>

    <!-- FAQ Item 6 -->
    <div class="border rounded-2xl overflow-hidden">
      <button class="w-full text-left px-6 py-4 bg-indigo-50 flex justify-between items-center faq-btn">
        <span class="font-semibold text-lg">Ok lang ba kahit walang experience?</span>
        <i class="fas fa-chevron-down transition-transform"></i>
      </button>
      <div class="faq-content px-6 py-4 bg-white hidden">
        Oo! Hindi mo kailangan ng experience. May step-by-step training kami kung paano mo gagawin, at higit sa lahat, nandito ako para gabayan ka sa bawat hakbang.
      </div>
    </div>

  </div>
</section>


<!-- Footer / Disclaimer -->
<footer class="bg-gray-100 text-gray-400 text-sm py-6 px-6 text-center">
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



        <p class="text-red-600 font-bold mb-4 mt-8">⚡ Only <span id="spots">10</span> spots left! Sign up before they’re gone!</p>
        <h2 class="text-2xl font-bold mb-6 text-center">
             Mag-sign Up para sa FREE Webinar at Alamin Kung Paano Kumita sa INFINITE PROGRAM!
        </h2>


        <form id="leadForm" class="space-y-4">
            @csrf
            <input type="hidden" name="page_link" value="{{ $funnel->page_link }}">
            
            <div>
                <input type="text" name="name" placeholder="Enter Full Name" class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                <p class="error-message text-red-500 text-sm mt-1 hidden" data-error="name"></p>
            </div>
            <div>
                <input type="email" name="email" placeholder="Enter Email" class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                <p class="error-message text-red-500 text-sm mt-1 hidden" data-error="email"></p>
            </div>
            <div>
                <input type="text" name="phone" placeholder="Enter Phone Number" class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                <p class="error-message text-red-500 text-sm mt-1 hidden" data-error="phone"></p>
            </div>
           
            <button type="submit" class="w-full py-3 bg-teal-600 hover:bg-teal-700 text-white rounded-lg font-semibold shadow-lg transition flex items-center justify-center gap-2">
              <i class="fa-solid fa-rocket"></i>
              Get Instant Access
            </button>
        </form>
    </div>
</div>

<script>
document.getElementById("leadForm").addEventListener("submit", function(e){
    e.preventDefault();
    document.querySelectorAll(".error-message").forEach(el => { el.classList.add("hidden"); el.textContent = ""; });

    let formData = new FormData(this);
    fetch("{{ route('funnel.store') }}", {
        method: "POST",
        headers: { "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === "error"){
            Object.keys(data.errors).forEach(key => {
                let errorEl = document.querySelector(`[data-error="${key}"]`);
                if(errorEl){ errorEl.textContent = data.errors[key][0]; errorEl.classList.remove("hidden"); }
            });
        }else if(data.status === "success"){
            window.location.href = data.redirect;
        }
    })
    .catch(err => console.error(err));
});

document.addEventListener("DOMContentLoaded", function() {
    function openModal(){ document.getElementById('formModal').classList.remove('hidden'); document.getElementById('formModal').classList.add('flex'); }
    function closeModal(){ document.getElementById('formModal').classList.add('hidden'); document.getElementById('formModal').classList.remove('flex'); }
    window.closeModal = closeModal;

    document.querySelectorAll(".openFormBtn").forEach(btn => {
        btn.addEventListener("click", function(e){ e.preventDefault(); openModal(); });
    });

    document.getElementById('formModal').addEventListener("click", function(e){
        if(e.target === this) closeModal();
    });
});
</script>
