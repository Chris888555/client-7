


<style>
/* Webkit Browsers (Chrome, Safari, Edge) */
::-webkit-scrollbar {
    width: 2px;
    /* Decreased vertical scrollbar width */
    height: 4px;
    /* Decreased horizontal scrollbar height */
}

::-webkit-scrollbar-thumb {
    background-color: #008080;
    border-radius: 10px;
}


.sidebar-item:not(.no-hover):hover {
    background-color: {{ $navSettings->nav_list_bg_hover_color ?? '#cccccc' }};
    color: {{ $navSettings->nav_text_list_hover_color ?? '#ffffff' }};
}
</style>


    <!-- ############ PC Sidebar #####################################################################-->
    <aside id="sidebar" class="fixed w-[280px] h-screen p-5 hidden md:block transition-all duration-300 overflow-y-scroll"
        style="background-color: {{ $navSettings->nav_bg_color ?? 'indigo' }}; color: {{ $navSettings->nav_text_color ?? '#000000' }};">

    
        <div id="sidebar-logo" class="text-lg font-bold mb-6 flex items-center space-x-2 px-4">
            <a href="/">
                <img id="sidebar-logo-img"
                    src="https://d1yei2z3i6k35z.cloudfront.net/4624298/681b9a807efb8_RealEstate1920x700px.png"
                    alt="My Logo" class="h-10 w-auto object-contain" />
                <span id="logo-text" class="text-xl ml-[3px] hidden">N</span> 
            </a>
        </div>
        
       
    <!-- Pc Sidebar Links -->
        <ul>

            <li
                class="mb-2 flex items-center space-x-2 sidebar-item rounded px-4 hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                <span class="material-icons">dashboard</span>
                <a href="{{ route('dashboard') }}" class="block p-2 sidebar-text">Dashboard</a>
            </li>


            <li
                class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                <span class="material-icons">trending_up</span> <!-- Representing charts or analytics -->
                <a href="{{ route('funnel.page') }}" class="block p-2 sidebar-text">Sales Funnel</a>
            </li>

            <li
                class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                <span class="material-icons">insert_chart</span> <!-- Representing charts or analytics -->
                <a href="{{ route('video.analytics') }}" class="block p-2 sidebar-text">Video Analytics</a>
            </li>

            <li
                class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                <span class="material-icons">cloud_download</span>
                <a href="{{ route('marketing.downloadable') }}" class="block p-2 sidebar-text">Downloadable</a>
            </li>


            <li
                class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                <span class="material-icons">school</span>
                <a href="{{ route('academy') }}" class="block p-2 sidebar-text">Academy</a>
            </li>

             <li
                class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                <span class="material-icons">shopping_bag</span>
                <a href="{{ route('order.details') }}" class="block p-2 sidebar-text">My Orders</a>
            </li>

            <li
                class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                <span class="material-icons">account_circle</span>
                <a href="{{ route('profile.uploadForm') }}" class="block p-2 sidebar-text">Edit Profile</a>
            </li>

             @if(Auth::user()->is_admin == 1)
            
            <hr class="border-t- border-t-gray-200 mt-8 mb-8">

            <!-- <h3  class="text-sm  mb-2 flex items-center px-4 text-gray-400 ">Admin Panel </h3> -->
            <li
                class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                <span class="material-icons">manage_accounts</span>
                <a href="{{ route('admin.manage-users') }}" class="block p-2 sidebar-text">Manage Users</a>
            </li>

            @endif


            @if(Auth::user()->is_admin == 1)
            <li
                class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                <span class="material-icons">cloud_upload</span>
                <a href="{{ route('marketing.index') }}" class="block p-2 sidebar-text">Upload Posting</a>
            </li>
            @endif


            @if(Auth::user()->is_admin == 1)
            <li
                class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                <span class="material-icons">video_library</span>
                <a href="{{ route('admin.upload-playlist') }}" class="block p-2 sidebar-text">Upload Playlist</a>
            </li>
            @endif

            @if(Auth::user()->is_admin == 1)
            <li
                class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                <span class="material-icons">settings</span>
                <a href="{{ route('funnel.settings') }}" class="block p-2 sidebar-text">Funnel Setting</a>
            </li>
            @endif

             @if(Auth::user()->is_admin == 1)
                <li
                    class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                    <span class="material-icons">payment</span>
                    <a href="{{ route('manual-approval') }}" class="block p-2 sidebar-text">Payment Approval</a>
                </li>
                @endif

            
           
         @if(Auth::user()->is_admin == 1)
          <!--For shop start code -->
              <hr class="border-t- border-t-gray-200 mt-8 mb-8">
            <li
                class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                <span class="material-icons">cloud_upload</span>
                <a href="{{ route('products.create') }}" class="block p-2 sidebar-text">Upload Products</a>
            </li>
            @endif

             @if(Auth::user()->is_admin == 1)
            <li
                class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                <span class="material-icons">settings</span>
                <a href="{{ route('product.edit') }}" class="block p-2 sidebar-text">Manage Products</a>
            </li>
            @endif

            <!--For shop end code -->

            <li @if(Auth::user()->is_admin == 1)
                <hr class="border-t border-t-gray-200 mt-8 mb-8">

            <li
                class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                <span class="material-icons">settings</span>
                <a href="{{ route('nav-settings.index') }}" class="block p-2 sidebar-text">Sidebar Setting</a>
            </li>

            @endif

        </ul>
    </aside>



    <!-- ############ Mobile Sidebar #####################################################################-->
    <div id="overlay" class="fixed inset-0 bg-black opacity-50 hidden md:hidden z-40"></div> <!-- Overlay -->

    <div id="mobile-sidebar"
    class="fixed inset-0 z-50 p-5 transform -translate-x-full transition-transform md:hidden overflow-y-auto"
    style="width: 300px; background-color: {{ $navSettings->nav_bg_color ?? '#ffffff' }}; color: {{ $navSettings->nav_text_color ?? '#000000' }};">
    

    <div class="flex justify-between items-center mb-6 px-4">
        <a href="/">
            <img src="https://d1yei2z3i6k35z.cloudfront.net/4624298/681b9a807efb8_RealEstate1920x700px.png"
                alt="My Logo" class="h-10 w-auto object-contain" />
        </a>
        <button id="close-sidebar" class="text-white text-lg">
            <svg class="h-8 w-8 text-gray-500 hover:text-gray-800" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                <line x1="9" y1="9" x2="15" y2="15" />
                <line x1="15" y1="9" x2="9" y2="15" />
            </svg>
        </button>
    </div>

    <!-- Mobile Sidebar Links -->
    <ul>
        <li class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
            <span class="material-icons">dashboard</span>
            <a href="/dashboard" class="block p-2 sidebar-text">Dashboard</a>
        </li>
    </ul>
</div>


   
