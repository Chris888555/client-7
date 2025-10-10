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


<body class="antialiased text-white" style="background: linear-gradient(to bottom right, #000000, #111111);">

  

<section class="">
  <div class="max-w-5xl mx-auto px-6 py-12 lg:py-20">
    <!-- Header -->
    <div class="text-center">
      <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight text-white">
        Launch Your Own Online Business Today with Our 
        <span class="text-yellow-400">Proven & Tested System</span>
      </h1>
      <p class="mt-6 text-2xl text-gray-300">
        Discover How You Can Start Earning — Watch the FREE Webinar Below!
      </p>
    </div>

  <!-- Video + Offer Grid -->
  <div class="mt-10 grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
      <div class="flex items-center justify-between bg-gray-900 text-white px-4 py-2 rounded-t-xl shadow">
        <div class="flex items-center gap-2 text-sm font-medium">
          <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
          <span id="watchingNow">123 Watching Now</span>
        </div>
        <span class="text-xs opacity-80">LIVE</span>
      </div>

      <div class="aspect-video bg-black rounded-b-xl overflow-hidden shadow-lg">
        <iframe class="w-full h-full" 
                src="https://www.youtube.com/embed/FCdHL774wJA?rel=0&playsinline=1" 
                title="Sales Video" frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" 
                allowfullscreen>
        </iframe>
      </div>
    </div>

  <!-- Right: Offer / Benefits -->
  <aside class="bg-gray-900/80 backdrop-blur p-6 rounded-xl shadow-sm lg:sticky lg:top-20">
    <h3 class="text-xl font-semibold text-white">Why This is For You</h3>
        <ul id="offer" class="mt-4 space-y-3 text-gray-300">
        <li class="flex items-start gap-3">
            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-yellow-400 text-black">
              <i class="fa-solid fa-check text-sm"></i>
            </span>
            Extra ₱50,000+ income potential
        </li>
        <li class="flex items-start gap-3">
            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-yellow-400 text-black">
              <i class="fa-solid fa-check text-sm"></i>
            </span>
            Done-for-you cookie-cutter system
        </li>
        <li class="flex items-start gap-3">
            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-yellow-400 text-black">
              <i class="fa-solid fa-check text-sm"></i>
            </span>
            Step-by-step mentorship
        </li>
        <li class="flex items-start gap-3">
            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-yellow-400 text-black">
              <i class="fa-solid fa-check text-sm"></i>
            </span>
            No experience needed
        </li>
        </ul>

       <div class="mt-6">
        <a href="{{ route('buy.now.choose', $funnel->page_link) }}" 
          class="block text-center rounded-md bg-yellow-400 hover:bg-yellow-500 text-black px-4 py-3 font-semibold shadow flex items-center justify-center gap-2 transition">
            Get Started Now 
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    <div class="mt-4 text-xs text-gray-400">
      ⚡ Limited slots only. Secure your spot today.
    </div>
  </aside>
</div>

<!-- Fake Watching Now Script -->
<script>
  let baseCount = 123; 
  const counterEl = document.getElementById('watchingNow');

  function updateCount() {
    let change = Math.floor(Math.random() * 11) - 5;
    if (change === 0) change = (Math.random() < 0.5 ? -1 : 1);

    baseCount = Math.max(80, baseCount + change);
    counterEl.textContent = `${baseCount} Watching Now`;

    const nextInterval = Math.floor(Math.random() * (60000 - 10000 + 1)) + 10000;
    setTimeout(updateCount, nextInterval);
  }

  updateCount();
</script>




<!-- Testimonials Section -->
<section class=" py-20 px-6">
  <div class="max-w-6xl mx-auto text-center">
    <h2 class="text-3xl md:text-4xl font-bold mb-12">What People Are Saying</h2>
    
    <div class="grid md:grid-cols-3 gap-8">
      
      <!-- Testimonial 1 -->
      <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center">
        <div class="w-full aspect-video rounded-lg overflow-hidden mb-4">
          <iframe class="w-full h-full" src="https://www.youtube.com/embed/cHe2EMmLiV4" 
            title="Testimonial 1" frameborder="0" allowfullscreen></iframe>
        </div>
        <p class="text-gray-700 italic">“I am a breadwinner, now kumikita through online gamit ang proven system.”</p>
        <h4 class="mt-4 font-semibold text-gray-900">Mary May Balisnomo</h4>
        <span class="text-sm text-gray-500">Health Care Employee in UK</span>
      </div>

      <!-- Testimonial 2 -->
      <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center">
        <div class="w-full aspect-video rounded-lg overflow-hidden mb-4">
          <iframe class="w-full h-full" src="https://www.youtube.com/embed/NoBO_DzX4HI" 
            title="Testimonial 2" frameborder="0" allowfullscreen></iframe>
        </div>
        <p class="text-gray-700 italic">“Talagang sulit yung effort. Ang dami kong natutunan at higit sa lahat kumikita ako even online.”</p>
        <h4 class="mt-4 font-semibold text-gray-900">Genilyn Farinas</h4>
        <span class="text-sm text-gray-500">Health Care Employee in UK</span>
      </div>

      <!-- Testimonial 3 -->
      <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center">
        <div class="w-full aspect-video rounded-lg overflow-hidden mb-4">
          <iframe class="w-full h-full" src="https://www.youtube.com/embed/KHvGSlKMSFk" 
            title="Testimonial 3" frameborder="0" allowfullscreen></iframe>
        </div>
        <p class="text-gray-700 italic">“Sa una nagduda ako, pero pagkatapos nakita ko ang results — natuwa ako.”</p>
        <h4 class="mt-4 font-semibold text-gray-900">Irene Perez</h4>
        <span class="text-sm text-gray-500">Nurse in UK</span>
      </div>

    </div>
  </div>
</section>



{{-- Fake notifications--}}
<x-fake-notifications />

  </div>
</section>

</body>
</html>
