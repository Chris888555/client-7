
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
       <svg class="h-8 w-8 text-gray-400"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <rect x="4" y="4" width="16" height="16" rx="2" />  <line x1="9" y1="4" x2="9" y2="20" /></svg>
    </button>


    <!-- Mobile Burger Icon and Logo -->
    <div class="flex items-center lg:hidden space-x-2">
        <button id="mobile-burger-icon" class="inline-block text-gray-500">
            <svg class="h-7 w-7 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
            </svg>
        </button>
    </div>

    <div class="p-4 text-gray-500 text-based sm:text-xl font-bold">
    @yield('title', 'Dashboard')
   </div>

        <div class="relative w-full xl:w-[430px] hidden xl:block">
        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-white/30 text-sm"></i>
        <input
            id="search-input"
            type="text"
            placeholder="Search or type command..."
            class="h-11 w-full rounded-lg border border-gray-200 bg-transparent py-2.5 pr-14 pl-12 text-sm text-gray-800 placeholder:text-gray-400 
                shadow-theme-xs focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-none
                dark:border-gray-800 dark:bg-dark-900 dark:bg-white/[0.03] dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
        />
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
// Dropdown menu
const dropdownButton = document.getElementById('dropdownButton');
const dropdownMenu = document.getElementById('dropdownMenu');

dropdownButton?.addEventListener('click', (event) => {
    dropdownMenu?.classList.toggle('hidden');
    event.stopPropagation();
});

document.addEventListener('click', (event) => {
    if (!dropdownMenu?.contains(event.target) && !dropdownButton?.contains(event.target)) {
        dropdownMenu?.classList.add('hidden');
    }
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const mobileSidebar = document.getElementById("mobile-sidebar");
  const mobileBurgerIcon = document.getElementById("mobile-burger-icon");
  const closeSidebarIcons = document.querySelectorAll("#close-sidebar");
  const mobileOverlay = document.getElementById("mobile-overlay");

  const desktopSidebar = document.getElementById("sidebar");
  const pcBurgerIcon = document.getElementById("pc-burger-icon");
  const logoText = document.querySelector("#logo-text");
  const logoInitial = document.querySelector("#logo-initial");
  const sidebarTexts = document.querySelectorAll(".sidebar-text");

  // MOBILE: Open
  mobileBurgerIcon?.addEventListener("click", () => {
    mobileSidebar.classList.remove("-translate-x-full");
    mobileOverlay.classList.remove("hidden");
  });

  // MOBILE: Close
  closeSidebarIcons.forEach(el => {
    el.addEventListener("click", () => {
      mobileSidebar.classList.add("-translate-x-full");
      mobileOverlay.classList.add("hidden");
    });
  });

  // MOBILE: Close on overlay click
  mobileOverlay?.addEventListener("click", () => {
    mobileSidebar.classList.add("-translate-x-full");
    mobileOverlay.classList.add("hidden");
  });

  // DESKTOP: Collapse/Expand
  let isCollapsed = false;
  pcBurgerIcon?.addEventListener("click", () => {
    isCollapsed = !isCollapsed;
    desktopSidebar.classList.toggle("w-[280px]");
    desktopSidebar.classList.toggle("w-[80px]");

    // Toggle logo text
    if (logoText && logoInitial) {
      logoText.classList.toggle("hidden");
      logoInitial.classList.toggle("hidden");
    }

    // Toggle menu item text
    sidebarTexts.forEach(span => {
      span.classList.toggle("hidden");
    });

  document.querySelectorAll(".sidebar-item").forEach(item => {
    if (isCollapsed) {
        item.classList.add("justify-center", "px-0", "hover:bg-transparent");
        item.classList.remove("px-4", "hover:bg-slate-100");
    } else {
        item.classList.remove("justify-center", "px-0", "hover:bg-transparent");
        item.classList.add("px-4", "hover:bg-slate-100");
    }

    });
  });
});
</script>
