
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

</style>


    <!-- ############ PC Sidebar #####################################################################-->
   <aside id="sidebar" 
       class="fixed w-[280px] h-screen p-5 hidden md:block transition-all duration-300 overflow-y-scroll bg-teal-600 text-gray-200">


    
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

        </ul>
    </aside>



    <!-- ############ Mobile Sidebar #####################################################################-->
    <div id="overlay" class="fixed inset-0 bg-black opacity-50 hidden md:hidden z-40"></div> <!-- Overlay -->

    <div id="mobile-sidebar"
    class="fixed inset-0 z-50 p-5 transform -translate-x-full transition-transform md:hidden overflow-y-auto w-[300px]  bg-teal-600 text-gray-200">
    

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


   
