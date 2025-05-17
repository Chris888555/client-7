<header class="bg-gray-50 border fixed w-full top-0 left-0 z-50 px-1 sm:px-6">
    <div class="container mx-auto flex items-center justify-between p-4">
        {{-- Mobile layout: burger left, logo center, login right --}}
        <div class="flex items-center justify-between w-full md:w-auto">
            {{-- Burger icon on mobile only --}}
            <button id="mobile-menu-button" class="md:hidden focus:outline-none" aria-label="Toggle menu"
                onclick="toggleMobileMenu()">
                <svg class="h-8 w-8 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </button>

            {{-- Logo centered on mobile --}}
            <div class="mx-auto text-2xl font-bold text-teal-600 md:mx-0 md:text-left">
                LOGO
            </div>

            {{-- Mobile login button --}}
            <div class="md:hidden">
                <button class="bg-teal-500 text-white px-4 py-2 rounded hover:bg-teal-600 transition">
                    Login
                </button>
            </div>
        </div>

        {{-- Desktop menu --}}
        <nav class="hidden md:flex space-x-8 text-gray-700 font-medium">
            <a href="/" class="hover:text-teal-600">Home</a>
            <a href="/company-profile" class="hover:text-teal-600">Company Profile</a>
            <a href="/products" class="hover:text-teal-600">Products</a>
        </nav>

        {{-- Desktop Login button --}}
        <div class="hidden md:block">
            <button class="bg-teal-500 text-white px-4 py-2 rounded hover:bg-teal-600 transition">
                Login
            </button>
        </div>
    </div>

    {{-- Mobile dropdown menu --}}
    <nav id="mobile-menu" class="hidden md:hidden bg-white">
        <a href="/" class="block px-6 py-3 border-b border-gray-200 text-gray-700 hover:bg-teal-50 hover:text-teal-600"
            onclick="toggleMobileMenu()">
            Home
        </a>
        <a href="/company-profile" class="block px-6 py-3 border-b border-gray-200 text-gray-700 hover:bg-teal-50 hover:text-teal-600"
            onclick="toggleMobileMenu()">
            Company Profile
        </a>
        <a href="/products" class="block px-6 py-3 border-b border-gray-200 text-gray-700 hover:bg-teal-50 hover:text-teal-600"
            onclick="toggleMobileMenu()">
            Products
        </a>

    </nav>

    <script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }
    </script>
</header>