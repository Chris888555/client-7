<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/app.css'])

    <title>Home</title>

</head>

<header class="bg-gray-600 shadow-md py-4 fixed w-full top-0 z-50">
    <div class="container mx-auto flex justify-between items-center px-6">
        <!-- Left: Navigation Links -->
        <nav class="hidden md:flex space-x-6">
            <a href="{{ route('home') }}" class="text-gray-200 hover:text-yellow-500 font-semibold transition">Home</a>
            <a href="{{ route('login') }}" class="text-gray-200 hover:text-yellow-500 font-semibold transition">Login</a>
            <a href="{{ route('register') }}" class="text-gray-200 hover:text-yellow-500 font-semibold transition">Sign
                Up</a>
        </nav>

       <!-- Mobile Menu Button -->
<div class="md:hidden">
    <button id="menu-toggle" class="text-white focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
            </path>
        </svg>
    </button>
</div>


        <!-- Right: Logo/Text -->
        <div>
    <a href="{{ route('home') }}">
        <img id="sidebar-logo-img" src="https://d1yei2z3i6k35z.cloudfront.net/4624298/681b9a807efb8_RealEstate1920x700px.png" alt="My Logo" class="h-10 w-auto object-contain" />
    </a>
</div>

    </div>

    <!-- Mobile Navigation Dropdown -->
    <div id="mobile-menu" class="md:hidden hidden bg-white shadow-md absolute w-full left-0 top-[60px] p-4">
        <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-yellow-500 font-semibold">Home</a>
        <a href="{{ route('login') }}" class="block py-2 text-gray-700 hover:text-yellow-500 font-semibold">Login</a>
        <a href="{{ route('register') }}" class="block py-2 text-gray-700 hover:text-yellow-500 font-semibold">Sign Up</a>
    </div>
</header>

<script>
// Mobile Menu Toggle
document.getElementById('menu-toggle').addEventListener('click', function() {
    document.getElementById('mobile-menu').classList.toggle('hidden');
});
</script>

<body>

</body>

</html>