<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Grind & Lifestyle Club - Home</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-white text-gray-800">

  <!-- Navbar -->
  <nav class="bg-white shadow-sm fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-2xl font-bold text-blue-600">Grind & Lifestyle Club</h1>
      <div class="space-x-6 hidden md:flex">
        <a href="{{ route('login') }}" 
          class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Login
        </a>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="pt-32 pb-20">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">
      <div>
        <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
          Build Your <span class="text-blue-600">Team & Business</span> Faster
        </h2>
        <p class="text-lg text-gray-600 mb-8">
          Join our network marketing team and gain access to a free sales funnel, top-performing products, and a supportive community that helps you grow.
        </p>
        <div class="space-x-4">
        <a href="{{ route('login') }}">
      <button class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700">
            Join Our Team
        </button>
    </a>

          
        </div>
      </div>
      <div class="hidden md:block">
        <img src="https://i.pinimg.com/736x/a5/56/ba/a556ba77e3b9127c95daccc33fb50e54.jpg" alt="Teamwork" class="">
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto px-6">
      <h3 class="text-3xl font-bold text-center mb-12">Why Join Grind & Lifestyle Club?</h3>
      <div class="grid md:grid-cols-3 gap-10">
        <div class="p-6 bg-gray-50 rounded-lg shadow hover:shadow-md transition">
          <h4 class="text-xl font-semibold mb-3">Free Sales Funnel</h4>
          <p class="text-gray-600">Get a ready-to-use funnel that generates leads and sales for your business.</p>
        </div>
        <div class="p-6 bg-gray-50 rounded-lg shadow hover:shadow-md transition">
          <h4 class="text-xl font-semibold mb-3">Effective Products</h4>
          <p class="text-gray-600">Promote high-quality products that people love and convert easily.</p>
        </div>
        <div class="p-6 bg-gray-50 rounded-lg shadow hover:shadow-md transition">
          <h4 class="text-xl font-semibold mb-3">Supportive Community</h4>
          <p class="text-gray-600">Connect, learn, and grow with like-minded entrepreneurs and team members.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white py-8">
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
      <p>&copy; 2025 Grind & Lifestyle Club. All rights reserved.</p>
      <div class="space-x-4 mt-4 md:mt-0">
        <a href="#" class="hover:text-blue-400">Facebook</a>
        <a href="#" class="hover:text-blue-400">Twitter</a>
        <a href="#" class="hover:text-blue-400">Instagram</a>
      </div>
    </div>
  </footer>

</body>
</html>
