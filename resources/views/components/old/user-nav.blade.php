
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

   


    <ul class="flex ml-auto items-center space-x-4">

    <!-- Online Status -->
        <div class="flex items-center gap-2">
            <span id="server-status-dot" class="h-3 w-3 rounded-full bg-green-500"></span>
            <span id="server-status-text" class="text-sm text-gray-600">Online</span>
        </div>

        <script>
        function setAlwaysOnline() {
            document.getElementById("server-status-dot").className = "h-3 w-3 rounded-full bg-green-500";
            document.getElementById("server-status-text").textContent = "Online";
        }

        async function checkServerStatus() {
            try {
                await fetch("/ping", { cache: "no-store" });
            } catch (e) {}
            setAlwaysOnline();
        }

        setInterval(checkServerStatus, 5000);
        checkServerStatus();
        </script>



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
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('mobile-overlay');

// ✅ MOBILE open
const mobileBurger = document.getElementById('mobile-burger-icon');
if (mobileBurger) {
    mobileBurger.addEventListener('click', () => {
        if (window.innerWidth < 992) {
            sidebar.classList.remove('translate-x-[-100%]');
            sidebar.classList.add('translate-x-0');

            overlay.classList.remove('hidden', 'opacity-0');
            setTimeout(() => overlay.classList.add('show'), 10);
        }
    });
}

// ✅ MOBILE close
const closeSidebar = document.getElementById('close-sidebar');
if (closeSidebar) closeSidebar.addEventListener('click', closeMobileSidebar);
overlay.addEventListener('click', closeMobileSidebar);

function closeMobileSidebar() {
    sidebar.classList.remove('translate-x-0');
    sidebar.classList.add('translate-x-[-100%]');

    overlay.classList.remove('show');
    overlay.classList.add('opacity-0');
    setTimeout(() => overlay.classList.add('hidden'), 300);
}

// ✅ DESKTOP collapse toggle
const pcBurger = document.getElementById('pc-burger-icon');
if (pcBurger) {
    pcBurger.addEventListener('click', () => {
        if (window.innerWidth >= 992) {
            sidebar.classList.toggle('collapsed');
        }
    });
}

// ✅ Hover effect on nav items
const links = document.querySelectorAll('#sidebar .nav-link');
links.forEach(link => {
    link.addEventListener('mouseenter', () => {
        if (!sidebar.classList.contains('collapsed')) {
            link.style.backgroundColor = '{{ $theme->nav_hover_bg_color }}';
            link.style.color = '{{ $theme->nav_text_hover_color }}';
        }
    });

    link.addEventListener('mouseleave', () => {
        if (!sidebar.classList.contains('collapsed')) {
            link.style.backgroundColor = '';
            link.style.color = '{{ $theme->nav_text_color }}';
        }
    });
});
</script>
