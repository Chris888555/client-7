<header class="bg-gray-700 fixed w-full top-0 left-0 z-50 px-1 sm:px-6 lg:p-4 border border-gray-400">

    <div class="container max-w-6xl mx-auto flex items-center justify-between p-4">

        <!-- Mobile layout: burger left, logo center, login right -->
        <div class="flex items-center justify-between w-full md:w-auto">
            <!-- Burger icon on mobile only -->
            <button id="mobile-menu-button" class="md:hidden focus:outline-none" aria-label="Toggle menu"
                onclick="toggleMobileMenu()">
                <svg class="h-8 w-8 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </button>

            <!-- Logo image centered on mobile, left-aligned on md+ -->
            <div class="mx-auto md:mx-0 text-center md:text-left">
                <img src="https://d1yei2z3i6k35z.cloudfront.net/4624298/681b9a807efb8_RealEstate1920x700px.png"
                    alt="Company Logo" class="h-8 md:h-12 inline-block" />
            </div>


            <!-- Mobile login button -->
            <div class="md:hidden">
                <a href="/login"
                    class="bg-yellow-400 text-teal-900 px-4 py-2 rounded hover:bg-yellow-500 transition inline-block text-center font-semibold">
                    Login
                </a>
            </div>
        </div>

        <!-- Desktop menu -->
        <nav class="hidden md:flex space-x-8 text-white font-medium">
            <a href="/" class="hover:text-yellow-300">Home</a>
            <a href="/company-profile" class="hover:text-yellow-300">Company Profile</a>
            <a href="/products" class="hover:text-yellow-300">Products</a>
        </nav>

        <!-- Desktop Login button -->
        <div class="hidden md:block">
            <a href="/login"
                class="bg-yellow-400 text-teal-900 px-4 py-2 rounded hover:bg-yellow-500 transition inline-block text-center font-semibold">
                Login
            </a>
        </div>
    </div>

    <!-- Mobile dropdown menu -->
    <nav id="mobile-menu" class="hidden md:hidden bg-teal-700">
        <a href="/" class="block px-6 py-3 border-b border-teal-600 text-white hover:bg-yellow-400 hover:text-teal-900"
            onclick="toggleMobileMenu()">Home</a>
        <a href="/company-profile"
            class="block px-6 py-3 border-b border-teal-600 text-white hover:bg-yellow-400 hover:text-teal-900"
            onclick="toggleMobileMenu()">Company Profile</a>
        <a href="/products"
            class="block px-6 py-3 border-b border-teal-600 text-white hover:bg-yellow-400 hover:text-teal-900"
            onclick="toggleMobileMenu()">Products</a>
    </nav>



    <script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }
    </script>
</header>