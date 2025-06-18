<style>
/* Webkit Browsers (Chrome, Safari, Edge) */
::-webkit-scrollbar {
    width: 2px;
    /* Decreased vertical scrollbar width */
    height: 4px;
    /* Decreased horizontal scrollbar height */
}

::-webkit-scrollbar-thumb {
    background-color: #1F2937;
    /* Tailwind Gray 800 */
    border-radius: 10px;
}
</style>


<!-- ############ PC Sidebar #####################################################################-->
<aside id="sidebar"
    class="fixed w-[280px] h-screen p-5 hidden md:block transition-all duration-300 overflow-y-scroll bg-gray-800 text-gray-200">



    <div id="sidebar-logo" class="text-lg font-bold mb-6 flex items-center space-x-2 pl-3 pr-4">
             <a href="/dashboard">
            <img id="sidebar-logo-img" src="/assets/images/mylogo.png" alt="My Logo" class="h-12 w-auto object-contain m-l-4" />
            <span id="logo-text" class="text-gray-300 text-3xl ml-[3px] rounded hidden"> R </span>
        </a>
    </div>


    <!-- Pc Sidebar Links -->
    <ul>

        <li class="mb-2 flex items-center gap-2 sidebar-item rounded px-3 hover:bg-gray-500 hover:text-gray-200">
            <span class="material-icons bg-gray-500 text-gray-200 rounded p-1">
                dashboard
            </span>
            <a href="{{ route('admin.dashboard') }}" class="block p-2 sidebar-text">Dashboard</a>
        </li>

        
       <li class="mb-2 flex items-center gap-2 sidebar-item rounded px-3 hover:bg-gray-500 hover:text-gray-200">
            <span class="material-icons bg-gray-500 text-gray-200 rounded p-1">
               manage_accounts
            </span>
            <a href="{{ route('admin.manage-users') }}" class="block p-2 sidebar-text">Manage Users</a>
        </li>
       

        <li class="mb-2 flex items-center gap-2 sidebar-item rounded px-3 hover:bg-gray-500 hover:text-gray-200">
            <span class="material-icons bg-gray-500 text-gray-200 rounded p-1">
               library_add
            </span>
            <a href="{{ route('materials.create') }}" class="block p-2 sidebar-text">Create Materials</a>
        </li>

         <li class="mb-2 flex items-center gap-2 sidebar-item rounded px-3 hover:bg-gray-500 hover:text-gray-200">
            <span class="material-icons bg-gray-500 text-gray-200 rounded p-1">
                video_call
            </span>
            <a href="{{ route('academy.create') }}" class="block p-2 sidebar-text">Create Academy</a>
        </li>

         <li class="mb-2 flex items-center gap-2 sidebar-item rounded px-3 hover:bg-gray-500 hover:text-gray-200">
            <span class="material-icons bg-gray-500 text-gray-200 rounded p-1">
                tune
            </span>
            <a href="{{ route('list.showtable') }}" class="block p-2 sidebar-text">Manage Funnel</a>
        </li>



    </ul>
</aside>



<!-- ############ Mobile Sidebar #####################################################################-->
<div id="overlay" class="fixed inset-0 bg-black opacity-50 hidden md:hidden z-40"></div> <!-- Overlay -->

<div id="mobile-sidebar"
    class="fixed inset-0 z-50 p-5 transform -translate-x-full transition-transform md:hidden overflow-y-auto w-[300px]  bg-gray-800 text-gray-200">


    <div class="flex justify-between items-center mb-6 pl-3 pr-4">
        <a href="/dashboard">
            <img src="/assets/images/mylogo.png"
                alt="My Logo" class="h-10 w-auto object-contain" />
        </a>

        <button id="close-sidebar" class="text-white text-lg">
            <svg class="h-8 w-8 text-gray-200 hover:text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                <line x1="9" y1="9" x2="15" y2="15" />
                <line x1="15" y1="9" x2="9" y2="15" />
            </svg>
        </button>
    </div>

    <!-- Mobile Sidebar Links -->
    <ul>
        <li class="mb-2 flex items-center gap-2 sidebar-item rounded px-3 hover:bg-teal-700 hover:text-gray-200">
            <span class="material-icons bg-teal-700 text-white rounded p-1">
                dashboard
            </span>
            <a href="{{ route('admin.dashboard') }}" class="block p-2 sidebar-text">Dashboard</a>
        </li>

    </ul>
</div>