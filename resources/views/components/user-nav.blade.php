
@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Storage;

    $user = Auth::user();
    $fullName = $user?->name ?? 'User';
    $profilePicturePath = 'profile_pictures/' . ($user?->id ?? '0') . '.jpg'; 
    $profilePictureExists = $user ? Storage::disk('public')->exists($profilePicturePath) : false;
@endphp


<nav class="flex items-center justify-between pl-5 pr-5 sm:pr-8 py-[23px] sm:py-[14px]">
    <!-- Desktop Burger Icon -->
    <button id="pc-burger-icon" class="hidden lg:inline-block text-gray-700 mr-4">
        <svg class="h-8 w-8 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
</svg>

    </button>

    <!-- Mobile Burger Icon and Logo -->
    <div class="flex items-center lg:hidden space-x-2">
        <button id="mobile-burger-icon" class="inline-block text-gray-500">
            <svg class="h-7 w-7 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
            </svg>
        </button>

        <a href="/dashboard" id="nav-logo" class="flex items-center space-x-2">
            <img id="nav-logo-img" src="/assets/images/mylogo.png" 
            alt="My Logo" class="h-8 w-auto ml-4 object-contain" />
        </a>
    </div>

    <ul class="flex ml-auto items-center space-x-4">
        <!-- Notification Icon -->
        <li>
            <button class="relative focus:outline-none mt-2" aria-label="Notifications">
                <svg class="fi-icon-btn-icon h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0">
                    </path>
                </svg>
                <span class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-600 rounded-full"></span>
            </button>
        </li>

        <!-- Dropdown Menu -->
        <li class="relative">
            <button class="flex items-center space-x-2 focus:outline-none" id="dropdownButton" type="button">
                <img 
                    src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($fullName) }}" 
                    alt="Profile" 
                    class="w-8 h-8 rounded-full"
                >
            </button>


            <ul id="dropdownMenu" class="absolute right-0 mt-2 w-64 bg-white border rounded-lg shadow-lg hidden z-50">
                <li class="px-4 py-2 border-b text-gray-500 select-none cursor-default flex items-center space-x-2">
                    <i class="fas fa-user-circle text-gray-400"></i>
                    <span>{{ $fullName }}</span>
                </li>
                <li>
                    <a href="/myprofile"
                        class="block w-full px-4 py-2 hover:bg-gray-100 flex items-center space-x-2 text-gray-500">
                        <i class="fas fa-edit text-gray-400"></i>
                        <span>Edit Profile</span>
                    </a>
                </li>
                <li>
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2 text-gray-500">
                            <i class="fas fa-sign-out-alt text-gray-400"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>


<script>
document.getElementById('dropdownButton').addEventListener('click', function(event) {
    var dropdownMenu = document.getElementById('dropdownMenu');
    dropdownMenu.classList.toggle('hidden');
    event.stopPropagation();
});

document.addEventListener('click', function(event) {
    var dropdownMenu = document.getElementById('dropdownMenu');
    var dropdownButton = document.getElementById('dropdownButton');

    if (!dropdownMenu.contains(event.target) && !dropdownButton.contains(event.target)) {
        dropdownMenu.classList.add('hidden');
    }
});
</script>

<script>
// Mobile Sidebar
const burgerIcon = document.getElementById('mobile-burger-icon'); // Mobile burger icon
const mobileSidebar = document.getElementById('mobile-sidebar');
const overlay = document.getElementById('overlay');
const closeSidebar = document.getElementById('close-sidebar');


// Toggle Mobile Sidebar
burgerIcon.addEventListener('click', () => {
    mobileSidebar.classList.toggle('translate-x-0');
    mobileSidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
});

// Close Mobile Sidebar when Overlay is clicked
overlay.addEventListener('click', () => {
    mobileSidebar.classList.add('-translate-x-full');
    mobileSidebar.classList.remove('translate-x-0');
    overlay.classList.add('hidden');
});

// Close Mobile Sidebar when Close Button is clicked
closeSidebar.addEventListener('click', () => {
    mobileSidebar.classList.add('-translate-x-full');
    mobileSidebar.classList.remove('translate-x-0');
    overlay.classList.add('hidden');
});

// PC Sidebar Toggle
document.getElementById('pc-burger-icon').addEventListener('click', function() {
    let sidebar = document.getElementById('sidebar');
    let mainContent = document.getElementById('main-content');
    let header = document.getElementById('main-header');
    let texts = document.querySelectorAll('.sidebar-text');
    let items = document.querySelectorAll('.sidebar-item');
    let logoImg = document.getElementById('sidebar-logo-img');
    let logoText = document.getElementById('logo-text');
    let logoContainer = document.getElementById('sidebar-logo');

    if (sidebar.classList.contains('w-[280px]')) {
        sidebar.classList.remove('w-[280px]');
        sidebar.classList.add('w-[96px]'); // Adjust width when collapsed
        mainContent.classList.remove('lg:ml-[280px]');
        mainContent.classList.add('lg:ml-[96px]'); // Adjust the margin for the collapsed sidebar
        header.classList.remove('lg:ml-[280px]');
        header.classList.add('lg:ml-[96px]'); // Adjust header margin for collapsed sidebar
        texts.forEach(text => text.classList.add('hidden'));
        items.forEach(item => {
            item.classList.add('mt-1');
            item.classList.add('p-3');
            logoContainer.classList.remove('pl-2', 'pr-4');
            logoContainer.classList.add('px-4'); 
           logoContainer.classList.add('bg-gray-700', 'rounded', 'mt-2');

        });

        // Hide the logo image and show the letter "N" when collapsed
        logoImg.classList.add('hidden'); // Hide the logo image
        logoText.classList.remove('hidden'); // Show the letter "N"
        logoText.classList.add('text-3xl'); // Make the letter "N" larger

    } else {
        sidebar.classList.remove('w-[96px]');
        sidebar.classList.add('w-[280px]'); // Reset to original width when expanded
        mainContent.classList.remove('lg:ml-[96px]');
        mainContent.classList.add('lg:ml-[280px]'); // Reset the margin when sidebar expands
        header.classList.remove('lg:ml-[96px]');
        header.classList.add('lg:ml-[280px]'); // Reset header margin when sidebar expands
        texts.forEach(text => text.classList.remove('hidden'));
        items.forEach(item => {
            item.classList.remove('mt-1');
            item.classList.remove('p-3');
            logoContainer.classList.remove('px-4');
            logoContainer.classList.add('pl-2', 'pr-4');
            logoContainer.classList.remove('bg-gray-700', 'rounded', 'mt-2');

        });

        // Reset to the original logo (image)
        logoImg.classList.remove('hidden'); // Show the logo image
        logoText.classList.add('hidden'); // Hide the letter "N"
        logoText.classList.remove('text-3xl'); // Reset text size
    }
});
</script>