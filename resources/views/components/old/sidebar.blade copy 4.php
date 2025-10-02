<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Sidebar with Main Content</title>

  @vite('resources/css/app.css')
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

  <style>
  
    .sidebar-frame::-webkit-scrollbar {
      width: 2px;  
    }

    .sidebar-frame::-webkit-scrollbar-track {
      background: transparent;
    }

    .sidebar-frame::-webkit-scrollbar-thumb {
      background-color: rgba(255,255,255,0.15); 
      border-radius: 2px;
      transition: background-color 0.3s ease;
    }

    .sidebar-frame::-webkit-scrollbar-thumb:hover {
      background-color: rgba(255,255,255,0.3);
    }

    .sidebar-frame {
      scrollbar-width: thin;  
      scrollbar-color: rgba(255,255,255,0.15) transparent;
    }

    :root{
      --sidebar-top: #18484e;
      --sidebar-bottom: #0f3940;
      --sidebar-accent: #cfeff1;
      --sidebar-text: rgba(255,255,255,0.95);
      --sidebar-sub: rgba(255,255,255,0.72);
      --hover-bg: rgba(255,255,255,0.04);
      --active-bg: rgba(255,255,255,0.08);
      --inner-border: rgba(0,0,0,0.18);
    }

    body { 
      font-family: "Poppins", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; 
      min-height:100vh; 
      margin:0;
      padding:0;
      display:flex; 
    }

    .sidebar-frame{
        width: 280px;
        background: linear-gradient(180deg, var(--sidebar-top), var(--sidebar-bottom));
        padding: 20px 14px;
        color: var(--sidebar-text);
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        z-index: 50;
        overflow-y: auto;
        overflow-x: hidden;  
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease;
    }

    
    .sidebar-hidden {
      transform: translateX(-100%);
    }

    .sidebar-frame::after{
      content: "";
      position: absolute;
      right: -42px;
      top: 36px;
      width: 100px;
      height: calc(100% - 72px);
      background: transparent;
      border-radius: 0 22px 22px 0;
      box-shadow: inset -8px 0 0 rgba(0,0,0,0.08);
      pointer-events: none;
      
    }
    

  

    nav.menu{ margin-top:18px; display:flex; flex-direction:column; gap:6px; flex-grow:1; }

    .menu-item{
      display:flex;
      gap:12px;
      align-items:center;
      padding:10px 12px;
      border-radius:10px;
      color:var(--sidebar-text);
      cursor:pointer;
      position:relative;
      overflow:visible;
    }

    .menu-item::before{
      content: "";
      position: absolute;
      left: -8px;
      width: 8px;
      height: 36px;
      background: transparent;
      border-radius: 8px;
      transform: translateX(-6px);
      transition: all 200ms ease;
      opacity: 0;
    }

    .menu-item:hover{
      background: var(--hover-bg);
      transform: translateX(6px);
      margin-right:6px;
    }

    .menu-item:hover::before{
      background: var(--sidebar-accent);
      transform: translateX(0);
      opacity: 1;
      box-shadow: 0 6px 16px rgba(2,8,10,0.12);
    }

    .menu-item .icon{
      width:38px;
      height:38px;
      min-width:38px;
      border-radius:8px;
      display:grid;
      place-items:center;
      background: rgba(255,255,255,0.02);
      color: var(--sidebar-accent);
      transition: all 160ms ease;
    }

    .menu-item .label{ font-weight:500; color:var(--sidebar-text); font-size:15px; }

    .menu-item.active{
      background: var(--active-bg);
      transform: translateX(6px);
      margin-right:6px;
    }

    .menu-item.active::before{
      background: var(--sidebar-accent);
      transform: translateX(0);
      opacity:1;
      box-shadow: 0 8px 20px rgba(2,8,10,0.12);
    }

    .menu-item.active .icon{
      background: var(--sidebar-accent);
      color: #083237;
      box-shadow: 0 6px 18px rgba(2,8,10,0.12);
    }

    nav ul li a.active {
      background-color: #374151;
      color: #ffffff;
    }

    .menu-item .sub{ margin-left:auto; font-size:12px; color:var(--sidebar-sub); padding-right:6px; }

    .sidebar-footer{ margin-top:auto; }

    .logout{
      display:flex;
      align-items:center;
      gap:12px;
      color:var(--sidebar-sub);
      padding:8px 12px;
      border-radius:8px;
      transition: all 160ms ease;
    }

    .logout:hover{ background: var(--hover-bg); color:var(--sidebar-text); transform: translateX(6px); }
    .logout .dot{ width:8px; height:8px; background: rgba(255,255,255,0.06); border-radius:9999px; margin-left:6px; }

    @media (max-width:768px){
      .sidebar-frame { width: 240px; }
    }
    

    .sidebar-frame {
        transition: transform 0.3s ease;
        }

        /* Mobile - sidebar hidden */
    .sidebar-hidden {
        transform: translateX(-100%);
        }

     
    @media (min-width: 768px) {
    .sidebar-frame {
            transform: translateX(0) !important; 
            transition: none !important;  
        }
        }

  </style>
</head>
<body>

<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 md:hidden"></div>


<!-- Sidebar -->
<aside id="sidebar" class="sidebar-frame sidebar-hidden md:translate-x-0">  

<button id="closeSidebar" class="absolute top-3 right-3 md:hidden p-1 rounded-full hover:bg-gray-200 transition-colors">
    <svg 
        class="h-8 w-8 text-slate-500" 
        width="24" 
        height="24" 
        viewBox="0 0 24 24" 
        stroke-width="2" 
        stroke="currentColor" 
        fill="none" 
        stroke-linecap="round" 
        stroke-linejoin="round"
    >
        <path stroke="none" d="M0 0h24v24H0z"/>
        <polyline points="11 7 6 12 11 17" />
        <polyline points="17 7 12 12 17 17" />
    </svg>
</button>



@php
    use Illuminate\Support\Facades\Auth;

    $user = Auth::user();
    $fullName = $user?->name ?? 'User';
    $profileImage = $user && $user->profile_picture 
                    ? asset('storage/' . $user->profile_picture) 
                    : asset('assets/profile_picture/profile.png');
                    $avatarUrl = 'https://ui-avatars.com/api/?name=' . urlencode($fullName) . '&background=18484e&color=ffffff&rounded=true&size=64';
@endphp

<!-- Profile -->
<div class="profile-card mt-8 md:mt-0 flex flex-col items-center text-center bg-white/5 border border-white/5 rounded-lg p-4 relative gap-2">
    <!-- Avatar -->
    <div class="avatar w-16 h-16 rounded-full p-[3px] grid place-items-center shadow-[0_6px_18px_rgba(2,8,10,0.18)] border-2 border-white/6 mb-2">
        <img src="{{ $profileImage }}" alt="User avatar" class="w-14 h-14 rounded-full object-cover block" />
    </div>

    <!-- Profile Info -->
    <div class="profile-info">
        <div class="name font-semibold text-white tracking-[0.2px]">{{ $fullName }}</div>
        @if($user?->email)
            <div class="email text-[13px] text-white/70 mt-1">{{ $user->email }}</div>
        @endif
    </div>
</div>





  <!-- Menu start code -->
<nav class="menu">


 <!-- Dashboard -->
<a href="{{ route('user.dashboard') }}" class="menu-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
    <span class="icon"><span class="material-icons">dashboard</span></span>
    <span class="label">Dashboard</span>
</a>

<!-- Materials -->
<a href="{{ route('materials.showByCategory') }}" class="menu-item {{ request()->routeIs('materials.showByCategory') ? 'active' : '' }}">
    <span class="icon"><span class="material-icons">folder</span></span>
    <span class="label">Materials</span>
</a>

<!-- Funnel -->
<a href="{{ route('funnel.index') }}" class="menu-item {{ request()->routeIs('funnel.index') ? 'active' : '' }}">
    <span class="icon"><span class="material-icons">insights</span></span>
    <span class="label">Funnel</span>
</a>

<!-- My Leads -->
<a href="{{ route('funnel.myLeads') }}" class="menu-item {{ request()->routeIs('funnel.myLeads') ? 'active' : '' }}">
    <span class="icon"><span class="material-icons">people</span></span>
    <span class="label">My Leads</span>
</a>

<!-- Orders -->
<a href="{{ route('orders.index') }}" class="menu-item {{ request()->routeIs('orders.index') ? 'active' : '' }}">
    <span class="icon"><span class="material-icons">shopping_cart</span></span>
    <span class="label">Orders</span>
</a>

<!-- Payment Method -->
<a href="{{ route('payment-method.create') }}" class="menu-item {{ request()->routeIs('payment-method.create') ? 'active' : '' }}">
    <span class="icon"><span class="material-icons">credit_card</span></span>
    <span class="label">Create MOP</span>
</a>

<!-- Courses -->
<a href="{{ route('user.academy.courses') }}" class="menu-item {{ request()->routeIs('user.academy.courses') ? 'active' : '' }}">
    <span class="icon"><span class="material-icons">school</span></span>
    <span class="label">Master Class</span>
</a>

<!-- My Profile -->
<a href="{{ route('user.myprofile') }}" class="menu-item {{ request()->routeIs('user.myprofile') ? 'active' : '' }}">
    <span class="icon"><span class="material-icons">person</span></span>
    <span class="label">My Profile</span>
</a>




<!-- Footer start code-->
<div class="sidebar-footer">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg 
                text-[15px] font-semibold text-[rgba(255,255,255,0.72)] 
                hover:bg-[rgba(255,255,255,0.04)] hover:text-white transition-all">
            
            <!-- Power icon using Material Icons -->
            <span class="w-9 h-9 min-w-9 flex items-center justify-center rounded-lg bg-transparent text-[rgba(255,255,255,0.7)]">
                <span class="material-icons">power_settings_new</span>
            </span>
            
            <span>Logout</span>
            
            <span class="w-2 h-2 bg-[rgba(255,255,255,0.06)] rounded-full ml-auto"></span>
        </button>
    </form>
</div>


</aside>


<!-- Topbar start code-->
<header class="bg-gray-50 fixed top-0 right-0 h-[70px] flex items-center justify-between px-4 sm:px-8 z-40 
               w-full md:w-[calc(100%-280px)] md:ml-[280px] ">
  <!-- Left -->
  <div class="flex flex items-start gap-3">
    <button id="toggleSidebar" class="md:hidden transition">
        <svg class="h-8 w-8 text-teal-800" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z"/>
            <line x1="4" y1="6" x2="20" y2="6" />
            <line x1="4" y1="12" x2="14" y2="12" />
            <line x1="4" y1="18" x2="18" y2="18" />
        </svg>
    </button>

    <h1 class="text-lg font-semibold text-gray-700"></h1>

  </div>
  <!-- Right -->
  <div class="relative flex items-center gap-4">
    <input type="text" placeholder="Search..." class="hidden sm:block px-3 py-1 border rounded-md text-sm focus:outline-none focus:ring focus:ring-blue-300">

       <button class=" w-9 h-9 rounded-full flex items-center justify-center">
         <span class="material-icons text-yellow-500">notifications</span>
    </button>

    <!-- Initials Avatar Name-->
    <div id="avatarDropdownBtn" class="w-9 h-9 rounded-full border cursor-pointer overflow-hidden">
     <img src="{{ $avatarUrl }}" alt="{{ $fullName }}" class="w-full h-full object-cover">
    </div>

    <!-- Dropdown Menu -->
    <ul id="dropdownMenu" class="absolute right-0 top-12 w-64 bg-white border rounded-lg shadow-lg hidden z-50">
      <li class="px-4 py-2 border-b text-gray-500 select-none cursor-default flex items-center space-x-2">
        <i class="fas fa-user-circle text-gray-400"></i>
        <span>{{ $fullName }}</span>
      </li>
      <li>
        <a href="/myprofile" class="block w-full px-4 py-2 hover:bg-gray-100 flex items-center space-x-2 text-gray-500">
          <i class="fas fa-edit text-gray-400"></i>
          <span>Edit Profile</span>
        </a>
      </li>
      <li>
        <form method="POST" action="/logout">
          @csrf
          <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2 text-gray-500">
            <i class="fas fa-sign-out-alt text-gray-400"></i>
            <span>Logout</span>
          </button>
        </form>
      </li>
    </ul>
  </div>
</header>



<!-- Dropdown js -->
<script>
  const avatarBtn = document.getElementById('avatarDropdownBtn');
  const dropdownMenu = document.getElementById('dropdownMenu');

  avatarBtn.addEventListener('click', () => {
    dropdownMenu.classList.toggle('hidden');
  });


  document.addEventListener('click', (e) => {
    if (!avatarBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
      dropdownMenu.classList.add('hidden');
    }
  });
</script>




<script>
document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".menu-item");
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggleSidebar");
    const closeBtn = document.getElementById("closeSidebar");
    const overlay = document.getElementById("overlay");
    const topbarTitle = document.querySelector("header h1");

    // --- Set initial topbar title on page load ---
    const activeItem = document.querySelector(".menu-item.active");
    if (activeItem) {
        topbarTitle.innerText = activeItem.dataset.title || activeItem.querySelector(".label").innerText;
    }

    // --- Click menu item: set active + topbar title + close sidebar on mobile ---
    menuItems.forEach(item => {
        item.addEventListener("click", function () {
            menuItems.forEach(i => i.classList.remove("active"));
            this.classList.add("active");

            topbarTitle.innerText = this.dataset.title || this.querySelector(".label").innerText;

            if (window.innerWidth < 768) {
                sidebar.classList.add("sidebar-hidden");
                overlay.classList.add("hidden");
            }
        });
    });

    // --- Sidebar toggle for mobile ---
    toggleBtn.addEventListener("click", () => {
        sidebar.classList.remove("sidebar-hidden");
        overlay.classList.remove("hidden");
    });

    closeBtn.addEventListener("click", () => {
        sidebar.classList.add("sidebar-hidden");
        overlay.classList.add("hidden");
    });

    overlay.addEventListener("click", () => {
        sidebar.classList.add("sidebar-hidden");
        overlay.classList.add("hidden");
    });
});


</script>


</body>
</html>
