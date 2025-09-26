<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Global Entrepreneurs - Home</title>
  @vite('resources/css/app.css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

</head>
<body class="bg-white text-gray-800">

  <!-- Navbar -->
<nav class="bg-emerald-700 shadow-sm fixed top-0 left-0 w-full z-50">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
    
    <!-- Logo -->
    <a href="{{ url('/') }}" class="flex items-center text-white font-bold text-2xl">
      <img id="logo-full" src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-14 w-auto">
      <!-- Global Entrepreneurs -->
    </a>

    <div class="space-x-6">
      <a href="{{ route('login') }}" 
         class="bg-yellow-400 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-100">
        Login
      </a>
    </div>
    
  </div>
</nav>



  <!-- Hero Section -->
  <section class="pt-32 pb-20">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">
      <div>
       <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight text-gray-800">
        <span class="text-emerald-700">Dream Big</span> as You Dream It Will Become” from The Greatest Salesman in the World- <span class="italic text-2xl">by Og Mandino</span>
      </h2>

        <p class="text-lg text-gray-600 mb-8">
        Every big dream starts with a single step. Believe in yourself, take action, and watch your aspirations turn into reality.
      </p>

        <div class="space-x-4">
          <a href="{{ route('login') }}">
            <button class="bg-emerald-700 text-yellow-400 font-semibold px-6 py-3 rounded-lg shadow hover:bg-emerald-700">
              Join Our Community
            </button>
          </a>
        </div>
      </div>
      <div class="">
         <img src="{{ asset('assets/images/mentor.png') }}" alt="Teamwork" class="mb-[-90px]">
      </div>
    </div>
  </section>

<!-- Opposite Flipped Angled Bottom -->
<div class="bottom-0 left-0 w-full overflow-hidden leading-[0] mb-[-1px]">
    <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-15 md:h-12">
        <path d="M0,40 L0,120 L1200,120 L1200,40 L600,0 Z" class="fill-emerald-700"></path>
    </svg>
</div>


<!-- Mission & Vision Section -->
<section class="bg-emerald-700 py-20">
  <div class="max-w-7xl mx-auto px-6 text-center">
    <h3 class="text-3xl font-bold mb-12 text-yellow-400">Our Mission</h3>
    <p class="text-white mb-12">
      Our mission is to inspire individuals to unleash their full potential, embrace their unique gifts, and create thriving digital businesses that leave a meaningful legacy. By harnessing the power of innovation, collaboration, and lifelong growth, we open pathways to personal and financial freedom—while cultivating a community of visionary leaders dedicated to creating lasting, positive impact in the world.
    </p>

    <h3 class="text-3xl font-bold mb-12 text-yellow-400">Our Vision</h3>
    <p class="text-white">
      We strive to be a globally recognized force of empowered leaders, redefining success through innovation, unity, and lasting legacy. We envision a future where every member reaches extraordinary heights, ignites inspiration in others, and together we build a dynasty of transformative impact and enduring success.
    </p>
  </div>
</section>

<!-- Flipped Angled Bottom  -->
<div class="bottom-0 left-0 w-full overflow-hidden leading-[0]">
    <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-15 md:h-12">
        <path d="M0,80 L0,0 L1200,0 L1200,80 L600,120 Z" class="fill-emerald-700"></path>
    </svg>
</div>



<!-- Features Section -->
<section class="bg-white py-20">
  <div class="max-w-7xl mx-auto px-6">
    <h3 class="text-3xl font-bold text-center mb-12 text-emerald-700">Why Join Global Entrepreneurs?</h3>
    <div class="grid md:grid-cols-3 gap-10">
      
      <div class="p-6 bg-gray-50 rounded-lg shadow hover:shadow-md transition text-center">
        <i class="fas fa-lightbulb text-4xl text-emerald-700 mb-4"></i>
        <h4 class="text-xl font-semibold mb-3">Innovative Tools</h4>
        <p class="text-gray-600">Access cutting-edge tools and strategies to grow your digital business efficiently.</p>
      </div>
      
      <div class="p-6 bg-gray-50 rounded-lg shadow hover:shadow-md transition text-center">
        <i class="fas fa-chalkboard-teacher text-4xl text-emerald-700 mb-4"></i>
        <h4 class="text-xl font-semibold mb-3">Expert Guidance</h4>
        <p class="text-gray-600">Learn from experienced entrepreneurs and mentors who have built successful businesses.</p>
      </div>
      
      <div class="p-6 bg-gray-50 rounded-lg shadow hover:shadow-md transition text-center">
        <i class="fas fa-users text-4xl text-emerald-700 mb-4"></i>
        <h4 class="text-xl font-semibold mb-3">Supportive Community</h4>
        <p class="text-gray-600">Connect, collaborate, and grow with like-minded team members.</p>
      </div>
      
    </div>
  </div>
</section>

  

  <!-- Footer -->
  <footer class="bg-green-800 text-white py-8">
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
      <p>&copy; 2025 Global Entrepreneurs. All rights reserved.</p>
      <div class="space-x-4 mt-4 md:mt-0">
        <a href="#" class="hover:text-blue-400">Facebook</a>
        <a href="#" class="hover:text-blue-400">Twitter</a>
        <a href="#" class="hover:text-blue-400">Instagram</a>
      </div>
    </div>
  </footer>

</body>
</html>
