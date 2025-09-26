<!doctype html>
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

<body class="antialiased bg-slate-50 text-slate-800">

<section class="bg-white">
  <div class="max-w-5xl mx-auto px-6 py-12 lg:py-20">
    <!-- Header -->
    <div class="text-center">
      <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight text-slate-900">
        Launch Your Own Online Business Today with Our <span class="text-teal-600">Proven & Tested System </span>
      </h1>
      <p class="mt-6 text-2xl text-slate-600">Discover How You Can Start Earning — Watch the FREE Webinar Below!</p>
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
      <iframe class="w-full h-full" src="https://www.youtube.com/embed/VIDEO_ID?rel=0&playsinline=1" 
              title="Sales Video" frameborder="0" 
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" 
              allowfullscreen>
      </iframe>
    </div>
  </div>


  <!-- Right: Offer / Benefits -->
  <aside class="bg-slate-50 p-6 rounded-xl shadow-sm lg:sticky lg:top-20">
    <h3 class="text-xl font-semibold text-slate-900">Why This is For You</h3>
        <ul id="offer" class="mt-4 space-y-3 text-slate-700">
        <li class="flex items-start gap-3">
            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-emerald-100 text-emerald-600">
            <i class="fa-solid fa-check text-sm"></i>
            </span>
            Extra ₱20,000+ income potential
        </li>
        <li class="flex items-start gap-3">
            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-emerald-100 text-emerald-600">
            <i class="fa-solid fa-check text-sm"></i>
            </span>
            Done-for-you cookie-cutter system
        </li>
        <li class="flex items-start gap-3">
            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-emerald-100 text-emerald-600">
            <i class="fa-solid fa-check text-sm"></i>
            </span>
            Step-by-step mentorship
        </li>
        <li class="flex items-start gap-3">
            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-emerald-100 text-emerald-600">
            <i class="fa-solid fa-check text-sm"></i>
            </span>
            No experience needed
        </li>
        </ul>

        <div class="mt-6">
         <a href="{{ route('buy.now.choose', $funnel->page_link) }}" 
            class="block text-center rounded-md bg-teal-600 hover:bg-teal-700 text-white px-4 py-3 font-semibold shadow">
            Get Started Now
        </a>
        </div>

    <div class="mt-4 text-xs text-slate-500">
      Limited slots only. Secure your spot today.
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






    
<!-- Live Testimonials with Initials Avatar -->
<div class="mt-12 max-w-5xl mx-auto">
  <h3 class="text-xl font-semibold text-slate-900 mb-4">Community Reviews</h3>

  <!-- Comments Container -->
  <div id="testimonials" class="bg-white border rounded-xl p-4 shadow-sm space-y-4 max-h-96 overflow-y-auto">
    <!-- Existing Comments -->
    <div class="flex items-start gap-3 bg-slate-50 p-3 rounded-md">
      <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-semibold">
        MR
      </div>
      <div>
        <div class="font-medium">Maria R.</div>
        <div class="text-sm text-slate-600 mt-1">"Nakapag-earn agad ng extra ₱18k sa unang buwan. Super helpful ang mentoring!"</div>
      </div>
    </div>

    <div class="flex items-start gap-3 bg-slate-50 p-3 rounded-md">
      <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-semibold">
        JP
      </div>
      <div>
        <div class="font-medium">Jun P.</div>
        <div class="text-sm text-slate-600 mt-1">"Plug-and-play ang system—di ko kailangan mag-setup ng sobra."</div>
      </div>
    </div>

    <div class="flex items-start gap-3 bg-slate-50 p-3 rounded-md">
      <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-semibold">
        ES
      </div>
      <div>
        <div class="font-medium">Ella S.</div>
        <div class="text-sm text-slate-600 mt-1">"Perfect para sa mga busy na nanay—pwede gawin kapag may free time."</div>
      </div>
    </div>
  </div>

  <!-- Comment Form Inline (Mobile + PC-friendly, input only) -->
    <div class="mt-4 w-full">
    <div class="flex flex-col sm:flex-row gap-2 items-start w-full">
        
        <input id="nameInput" type="text" placeholder="Full Name"
            class="flex-1 sm:flex-[2] w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
        
        <input id="commentInput" type="text" placeholder="Write a comment..."
            class="flex-1 sm:flex-[5] w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
        
        <button id="addCommentBtn"
            class="w-full sm:w-auto bg-teal-600 text-white px-4 py-2 rounded-md hover:bg-teal-700 transition">
            Post
        </button>
    </div>

    <p id="errorNote" class="text-sm text-red-600 mt-2 hidden">
        You are not a member. You cannot comment here.
    </p>
    </div>



<script>
  const addBtn = document.getElementById('addCommentBtn');
  const nameInput = document.getElementById('nameInput');
  const commentInput = document.getElementById('commentInput');
  const errorNote = document.getElementById('errorNote');

  function showError() {
    errorNote.classList.remove('hidden');
  }

  addBtn.addEventListener('click', (e) => {
    e.preventDefault();
    showError();
  });

  commentInput.addEventListener('keypress', (e) => {
    if(e.key === 'Enter') {
      e.preventDefault();
      showError();
    }
  });
</script>


  </div>
</section>

</body>
</html>
