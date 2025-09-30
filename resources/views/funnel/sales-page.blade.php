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
        <iframe class="w-full h-full" 
                src="https://www.youtube.com/embed/FCdHL774wJA?rel=0&playsinline=1" 
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
          class="block text-center rounded-md bg-teal-600 hover:bg-teal-700 text-white px-4 py-3 font-semibold shadow flex items-center justify-center gap-2">
            Get Started Now 
            <i class="fa-solid fa-arrow-right"></i>
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
<!-- Community Reviews -->
<div class="mt-12 max-w-5xl mx-auto">
 <h3 class="text-xl font-semibold text-slate-900 mb-4 flex items-center gap-1">
  <i class="fa-solid fa-star text-yellow-500"></i>
  <i class="fa-solid fa-star text-yellow-500"></i>
  <i class="fa-solid fa-star text-yellow-500"></i>
  <i class="fa-solid fa-star text-yellow-500"></i>
  <i class="fa-solid fa-star text-yellow-500"></i>
  <span class="ml-2">Community Reviews</span>
</h3>


  <!-- Comments Container -->
  <div id="testimonials" class="bg-white border rounded-xl p-4 shadow-sm space-y-4 max-h-96 overflow-y-auto">

    <!-- Review 1 -->
    <div class="review flex items-start gap-3 bg-slate-50 p-3 rounded-md">
      <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-semibold">AC</div>
      <div>
        <div class="font-medium">Ana C.</div>
        <div class="text-sm text-slate-600 mt-1">"Nagkaroon ako ng pambayad ng bills dahil dito, sobrang thankful!"</div>
      </div>
    </div>

    <!-- Review 2 -->
    <div class="review flex items-start gap-3 bg-slate-50 p-3 rounded-md">
      <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-semibold">RM</div>
      <div>
        <div class="font-medium">Ryan M.</div>
        <div class="text-sm text-slate-600 mt-1">"Hindi na ako stressed sa dagdag income, mabilis ang resulta."</div>
      </div>
    </div>

    <!-- Review 3 -->
    <div class="review flex items-start gap-3 bg-slate-50 p-3 rounded-md">
      <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-semibold">JS</div>
      <div>
        <div class="font-medium">Jenny S.</div>
        <div class="text-sm text-slate-600 mt-1">"First time kong kumita online, legit at guided ang system."</div>
      </div>
    </div>

    <!-- Review 4 -->
    <div class="review flex items-start gap-3 bg-slate-50 p-3 rounded-md">
      <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-semibold">LT</div>
      <div>
        <div class="font-medium">Leo T.</div>
        <div class="text-sm text-slate-600 mt-1">"Dati wala akong alam sa ganito, pero ngayon may extra income na ako."</div>
      </div>
    </div>

    <!-- Review 5 -->
    <div class="review flex items-start gap-3 bg-slate-50 p-3 rounded-md">
      <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-semibold">MK</div>
      <div>
        <div class="font-medium">Mia K.</div>
        <div class="text-sm text-slate-600 mt-1">"Perfect sa busy mom like me, pwede gawin kahit gabi lang."</div>
      </div>
    </div>

    <!-- Review 6 -->
    <div class="review flex items-start gap-3 bg-slate-50 p-3 rounded-md">
      <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-semibold">DV</div>
      <div>
        <div class="font-medium">Daryl V.</div>
        <div class="text-sm text-slate-600 mt-1">"Sobrang dali sundan, parang may personal coach online."</div>
      </div>
    </div>

    <!-- Review 7 -->
    <div class="review flex items-start gap-3 bg-slate-50 p-3 rounded-md">
      <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-semibold">KC</div>
      <div>
        <div class="font-medium">Kim C.</div>
        <div class="text-sm text-slate-600 mt-1">"As a student, malaking tulong pang-allowance at project expenses."</div>
      </div>
    </div>

    <!-- Review 8 -->
    <div class="review flex items-start gap-3 bg-slate-50 p-3 rounded-md">
      <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-semibold">JG</div>
      <div>
        <div class="font-medium">Joel G.</div>
        <div class="text-sm text-slate-600 mt-1">"Nakapagpadala agad ako ng pera sa pamilya, sobrang sulit."</div>
      </div>
    </div>

    <!-- Review 9 -->
    <div class="review flex items-start gap-3 bg-slate-50 p-3 rounded-md">
      <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-semibold">SH</div>
      <div>
        <div class="font-medium">Shiela H.</div>
        <div class="text-sm text-slate-600 mt-1">"Legit system, di na ako nagduda after first payout."</div>
      </div>
    </div>

    <!-- Review 10 -->
    <div class="review flex items-start gap-3 bg-slate-50 p-3 rounded-md">
      <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-semibold">AB</div>
      <div>
        <div class="font-medium">Alex B.</div>
        <div class="text-sm text-slate-600 mt-1">"No need technical skills, kahit beginner kaya."</div>
      </div>
    </div>


      <div class="review flex items-start gap-3 bg-slate-50 p-3 rounded-md">
        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-semibold">FM</div>
        <div>
          <div class="font-medium">Faith M.</div>
          <div class="text-sm text-slate-600 mt-1">"As a breadwinner, malaking ginhawa to sa pamilya namin."</div>
        </div>
      </div>

      <div class="review flex items-start gap-3 bg-slate-50 p-3 rounded-md">
        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-semibold">TG</div>
        <div>
          <div class="font-medium">Tom G.</div>
          <div class="text-sm text-slate-600 mt-1">"Side hustle na hindi kumakain ng oras, solid!"</div>
        </div>
      </div>

      <div class="review flex items-start gap-3 bg-slate-50 p-3 rounded-md">
        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-semibold">NL</div>
        <div>
          <div class="font-medium">Nina L.</div>
          <div class="text-sm text-slate-600 mt-1">"Nakapag-ipon ako kahit maliit lang simula, grabe helpful."</div>
        </div>
      </div>

      <div class="review flex items-start gap-3 bg-slate-50 p-3 rounded-md">
        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-semibold">PR</div>
        <div>
          <div class="font-medium">Paul R.</div>
          <div class="text-sm text-slate-600 mt-1">"Step-by-step talaga, walang confusion sa proseso."</div>
        </div>
      </div>

      <div class="review flex items-start gap-3 bg-slate-50 p-3 rounded-md">
        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-semibold">GH</div>
        <div>
          <div class="font-medium">Grace H.</div>
          <div class="text-sm text-slate-600 mt-1">"Pwede kahit sa cellphone lang gawin, sobrang dali."</div>
        </div>
      </div>

      <div class="review flex items-start gap-3 bg-slate-50 p-3 rounded-md">
        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-semibold">ED</div>
        <div>
          <div class="font-medium">Edison D.</div>
          <div class="text-sm text-slate-600 mt-1">"First payout ko, di ako makapaniwala legit pala talaga."</div>
        </div>
      </div>

      <div class="review flex items-start gap-3 bg-slate-50 p-3 rounded-md">
        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-semibold">RL</div>
        <div>
          <div class="font-medium">Rica L.</div>
          <div class="text-sm text-slate-600 mt-1">"Dati hirap sa pambayad tuition, ngayon may dagdag income."</div>
        </div>
      </div>

      <div class="review flex items-start gap-3 bg-slate-50 p-3 rounded-md">
        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-semibold">VC</div>
        <div>
          <div class="font-medium">Vince C.</div>
          <div class="text-sm text-slate-600 mt-1">"Flexible oras, kahit working student kaya gawin."</div>
        </div>
      </div>

      <div class="review flex items-start gap-3 bg-slate-50 p-3 rounded-md">
        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-semibold">MB</div>
        <div>
          <div class="font-medium">Monica B.</div>
          <div class="text-sm text-slate-600 mt-1">"Safe gamitin at legit payout, kaya tuloy-tuloy ako."</div>
        </div>
      </div>

      <div class="review flex items-start gap-3 bg-slate-50 p-3 rounded-md">
        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-semibold">CD</div>
        <div>
          <div class="font-medium">Carl D.</div>
          <div class="text-sm text-slate-600 mt-1">"Sobrang convenient, kahit naka-break lang sa work."</div>
        </div>
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


{{-- Fake notifications--}}
<x-fake-notifications />

  </div>
</section>

</body>
</html>
