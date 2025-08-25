
<style>
/* 🔵 SCROLLBAR */
.sidebar-section *::-webkit-scrollbar {
    width: 4px;
    height: 4px;
}
.sidebar-section *::-webkit-scrollbar-thumb {
    background-color: {{ $theme->sidebar_bg }};
    border-radius: 10px;
}

/* 🔵 MOBILE: Slide-in/out behavior */
.translate-start {
    transform: translateX(-100%);
    transition: all 0.3s ease;
}
.translate-show {
    transform: translateX(0);
    transition: all 0.3s ease;
}
#mobile-overlay {
    transition: opacity 0.3s ease;
    opacity: 0;
}

#mobile-overlay.show {
    opacity: 1; 
}



#sidebar {
    margin-left: 5px;
}



/* 🔵 DESKTOP MODE OVERRIDES */
@media (min-width: 992px) {
    #sidebar {
        position: relative !important;
        transform: none !important;
        transition: width 0.3s ease, padding 0.3s ease;
    }
    #mobile-overlay {
        display: none !important;
    }


/* 🔵 COLLAPSE behavior (desktop only) */
#sidebar.collapsed {
    width: 80px !important;
    padding: 1rem 0.5rem !important;
    overflow-x: hidden !important; 
    overflow-y: auto !important;
    
}

/* 🔵 Sidebar text fade/shrink */
.sidebar-text {
    display: inline-block;
    opacity: 1;
    max-width: 100%;
    overflow: hidden;
    white-space: nowrap;
    transition: opacity 0.3s ease, max-width 0.3s ease, transform 0.3s ease;

}
#sidebar.collapsed .sidebar-text {
    opacity: 0;
    max-width: 0;
 }

/* 🔵 Default: align logo to start */
    .logo-container {
        justify-content: flex-start !important;
    }
/* 🔵 Collapsed: center the logo */
    #sidebar.collapsed .logo-container {
        justify-content: center !important;
    }
    

/*🔵 Shared logo styles */
#logo-full,
#logo-initial {
    transition: opacity 0.3s ease, transform 0.3s ease;
    display: inline-block;
    opacity: 1;
    overflow: hidden;
    white-space: nowrap;
}

/* 🔵When collapsed: fade out full logo, fade in short logo */
#sidebar.collapsed #logo-full {
    opacity: 0;
    max-width: 0;
}
#sidebar:not(.collapsed) #logo-initial {
    opacity: 0;
    max-width: 0;
}

}

/* 🔵 Overlay color on top using ::before */
.sidebar-overlay::before {
    content: "";
    position: absolute;
    inset: 0;
    background-color: {{ $theme->sidebar_bg }};
    opacity: 0.8;
    border-radius: inherit;
    z-index: 1;
}

/* 🔵 Ensure content is above overlay */
.sidebar-overlay > * {
    position: relative;
    z-index: 2;
}


</style>


<!-- ✅ WRAPPER -->
<section class="sidebar-section">
    <!-- ✅ MOBILE OVERLAY -->
    <div id="mobile-overlay"
        class="fixed inset-0 bg-white bg-opacity-80 z-20 hidden lg:hidden opacity-0 transition-opacity duration-300">
    </div>


    <!-- ✅ SINGLE SIDEBAR -->
    <aside id="sidebar"
        class="fixed lg:relative top-0 bottom-0 left-0 z-30 border rounded-2xl my-2 ml-4 p-4 text-white sidebar-overlay translate-x-[-100%] transition-all duration-300"
        style="
            width: 280px;
            height: calc(100vh - 1rem);
            background-image: url('https://i.pinimg.com/originals/e6/53/f5/e653f5f2b28067b4d36fb537f2679ee4.jpg');
            background-size: cover;
            background-position: center;
        "
    >
        <!-- ✅ CLOSE BUTTON - mobile only -->
        <div class="flex lg:hidden justify-end mb-3">
            <span id="close-sidebar" class="material-icons cursor-pointer" style="color: {{ $theme->logo_color }};">close</span>
        </div>

        <!-- ✅ LOGO -->
        <div class="flex items-center justify-start mb-3 logo-container h-16">
            <div class="rounded p-2 flex items-center justify-center mx-auto lg:mx-0">
                <span id="logo-full" style="color: {{ $theme->logo_color }};" class="text-base font-bold">Grind & Lifestyle Club</span>
                <span id="logo-initial" style="color: {{ $theme->logo_color }};" class="text-lg font-bold hidden">G</span>
            </div>
        </div>

        <hr class="my-2 border-gray-500">

        <!-- ✅ MENU -->
        <nav class="overflow-y-auto overflow-x-hidden max-h-[calc(100vh-150px)]">
            <ul class="flex flex-col text-sm font-semibold text-gray-300 ">

          <li>
            <a href="{{ route('user.dashboard') }}"
                    class="sidebar-item flex items-center gap-4 px-3 py-2 transition rounded-lg"
                    style="color: {{ $theme->nav_text_color }};"
                    onmouseover="this.style.backgroundColor='{{ $theme->nav_hover_bg_color }}'; this.style.color='{{ $theme->nav_text_hover_color }}';"
                    onmouseout="this.style.backgroundColor=''; this.style.color='{{ $theme->nav_text_color }}';">
                    
                    <div class="rounded-lg p-2 flex items-center justify-center"
                        style="background-color: {{ $theme->icon_bg_color }}; color: {{ $theme->icon_text }};">
                        <span class="material-icons text-xs">dashboard</span>
                    </div>
                    <span class="sidebar-text text-base">Dashboard</span>
                </a>
            </li>

            
                <li>
            <a href="{{ route('materials.showByCategory') }}"
                    class="sidebar-item flex items-center gap-4 px-3 py-2 transition rounded-lg"
                    style="color: {{ $theme->nav_text_color }};"
                    onmouseover="this.style.backgroundColor='{{ $theme->nav_hover_bg_color }}'; this.style.color='{{ $theme->nav_text_hover_color }}';"
                    onmouseout="this.style.backgroundColor=''; this.style.color='{{ $theme->nav_text_color }}';">
                    
                    <div class="rounded-lg p-2 flex items-center justify-center"
                        style="background-color: {{ $theme->icon_bg_color }}; color: {{ $theme->icon_text }};">
                        <span class="material-icons text-xs">image</span>
                    </div>
                    <span class="sidebar-text text-base">Marketing Images</span>
                </a>
            </li>
            

            <li>
            <a href="{{ route('funnel.index') }}"
                    class="sidebar-item flex items-center gap-4 px-3 py-2 transition rounded-lg"
                    style="color: {{ $theme->nav_text_color }};"
                    onmouseover="this.style.backgroundColor='{{ $theme->nav_hover_bg_color }}'; this.style.color='{{ $theme->nav_text_hover_color }}';"
                    onmouseout="this.style.backgroundColor=''; this.style.color='{{ $theme->nav_text_color }}';">
                    
                    <div class="rounded-lg p-2 flex items-center justify-center"
                        style="background-color: {{ $theme->icon_bg_color }}; color: {{ $theme->icon_text }};">
                        <span class="material-icons text-xs">filter_alt</span>
                    </div>
                    <span class="sidebar-text text-base">Sales Funnel</span>
                </a>
            </li>

             <li>
            <a href="{{ route('funnel.myLeads') }}"
                    class="sidebar-item flex items-center gap-4 px-3 py-2 transition rounded-lg"
                    style="color: {{ $theme->nav_text_color }};"
                    onmouseover="this.style.backgroundColor='{{ $theme->nav_hover_bg_color }}'; this.style.color='{{ $theme->nav_text_hover_color }}';"
                    onmouseout="this.style.backgroundColor=''; this.style.color='{{ $theme->nav_text_color }}';">
                    
                    <div class="rounded-lg p-2 flex items-center justify-center"
                        style="background-color: {{ $theme->icon_bg_color }}; color: {{ $theme->icon_text }};">
                        <span class="material-icons text-xs">people</span>
                    </div>
                    <span class="sidebar-text text-base">My Leads</span>
                </a>
            </li>



                <li>
            <a href="{{ route('orders.index') }}"
                    class="sidebar-item flex items-center gap-4 px-3 py-2 transition rounded-lg"
                    style="color: {{ $theme->nav_text_color }};"
                    onmouseover="this.style.backgroundColor='{{ $theme->nav_hover_bg_color }}'; this.style.color='{{ $theme->nav_text_hover_color }}';"
                    onmouseout="this.style.backgroundColor=''; this.style.color='{{ $theme->nav_text_color }}';">
                    
                    <div class="rounded-lg p-2 flex items-center justify-center"
                        style="background-color: {{ $theme->icon_bg_color }}; color: {{ $theme->icon_text }};">
                        <span class="material-icons text-xs">local_fire_department</span>
                    </div>
                    <span class="sidebar-text text-base">My Orders</span>
                </a>
            </li>
            

              <li>
            <a href="{{ route('payment-method.create') }}"
                    class="sidebar-item flex items-center gap-4 px-3 py-2 transition rounded-lg"
                    style="color: {{ $theme->nav_text_color }};"
                    onmouseover="this.style.backgroundColor='{{ $theme->nav_hover_bg_color }}'; this.style.color='{{ $theme->nav_text_hover_color }}';"
                    onmouseout="this.style.backgroundColor=''; this.style.color='{{ $theme->nav_text_color }}';">
                    
                    <div class="rounded-lg p-2 flex items-center justify-center"
                        style="background-color: {{ $theme->icon_bg_color }}; color: {{ $theme->icon_text }};">
                        <span class="material-icons text-xs">credit_card</span>
                    </div>
                    <span class="sidebar-text text-base">Create Mop</span>
                </a>
            </li>



         

            </ul>
        </nav>
    </aside>
</section>