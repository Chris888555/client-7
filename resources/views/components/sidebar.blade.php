<style>
/* Webkit Browsers (Chrome, Safari, Edge) */
::-webkit-scrollbar {
    width: 1px;
    /* thinner vertical scrollbar */
    height: 2px;
    /* thinner horizontal scrollbar */
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
            <img id="sidebar-logo-img"
                src="https://d1yei2z3i6k35z.cloudfront.net/4624298/681b9a807efb8_RealEstate1920x700px.png" alt="My Logo"
                class="h-10 w-auto object-contain " />
            <span id="logo-text" class="text-teal-700 text-3xl ml-[3px] rounded hidden"> N </span>
        </a>
    </div>


    <!-- Pc Sidebar Links -->
    <ul>

        <li class="mb-2 flex items-center gap-2 sidebar-item rounded px-3 hover:bg-teal-700 hover:text-gray-200">
            <span class="material-icons bg-teal-700 text-white rounded p-1">
                dashboard
            </span>
            <a href="{{ route('user.dashboard') }}" class="block p-2 sidebar-text">Dashboard</a>

        </li>

        <li class="mb-2 flex items-center gap-2 sidebar-item rounded px-3 hover:bg-teal-700 hover:text-gray-200">
            <span class="material-icons bg-teal-700 text-white rounded p-1">
                insights
            </span>
            <a href="{{ route('income-stats') }}" class="block p-2 sidebar-text">Income Stats</a>
        </li>

        <li class="mb-2 flex items-center gap-2 sidebar-item rounded px-3 hover:bg-teal-700 hover:text-gray-200">
            <span class="material-icons bg-teal-700 text-white rounded p-1">
                device_hub
            </span>
            <a href="#" class="block p-2 sidebar-text">Network Geology</a>
        </li>

        <li class="mb-2 flex items-center gap-2 sidebar-item rounded px-3 hover:bg-teal-700 hover:text-gray-200">
            <span class="material-icons bg-teal-700 text-white rounded p-1">
                groups
            </span>
            <a href="teams" class="block p-2 sidebar-text">My Referrals</a>
        </li>

        <li class="mb-2 flex items-center gap-2 sidebar-item rounded px-3 hover:bg-teal-700 hover:text-gray-200">
            <span class="material-icons bg-teal-700 text-white rounded p-1">
                account_balance_wallet
            </span>
            <a href="#" class="block p-2 sidebar-text">Encashment</a>
        </li>

        <li class="mb-2 flex items-center gap-2 sidebar-item rounded px-3 hover:bg-teal-700 hover:text-gray-200">
            <span class="material-icons bg-teal-700 text-white rounded p-1">
                star
            </span>
            <a href="teams" class="block p-2 sidebar-text">Rank Status</a>
        </li>

        <li class="mb-2 flex items-center gap-2 sidebar-item rounded px-3 hover:bg-teal-700 hover:text-gray-200">
            <span class="material-icons bg-teal-700 text-white rounded p-1">
                inventory
            </span>
            <a href="teams" class="block p-2 sidebar-text">Packages</a>
        </li>

        
        <li class="mb-2 flex items-center gap-2 sidebar-item rounded px-3 hover:bg-teal-700 hover:text-gray-200">
            <span class="material-icons bg-teal-700 text-white rounded p-1">
                store
            </span>
            <a href="teams" class="block p-2 sidebar-text">Reorder Store</a>
        </li>


         <li class="mb-2 flex items-center gap-2 sidebar-item rounded px-3 hover:bg-teal-700 hover:text-gray-200">
            <span class="material-icons bg-teal-700 text-white rounded p-1">
                receipt_long
            </span>
            <a href="teams" class="block p-2 sidebar-text">My Oders History</a>
        </li>


        <li class="mb-2 flex items-center gap-2 sidebar-item rounded px-3 hover:bg-teal-700 hover:text-gray-200">
            <span class="material-icons bg-teal-700 text-white rounded p-1">
                shopping_basket
            </span>
            <a href="teams" class="block p-2 sidebar-text">Dropshipping Orders</a>
        </li>


        <li class="mb-2 flex items-center gap-2 sidebar-item rounded px-3 hover:bg-teal-700 hover:text-gray-200">
            <span class="material-icons bg-teal-700 text-white rounded p-1">
                list_alt
            </span>
            <a href="teams" class="block p-2 sidebar-text">All Income Logs</a>
        </li>

        
        <hr class="border-t border-gray-700 my-6" />

        <li class="mb-2 flex items-center gap-2 sidebar-item rounded px-3 hover:bg-teal-700 hover:text-gray-200">
            <span class="material-icons bg-teal-700 text-white rounded p-1">
                download
            </span>
            <a href="{{ route('materials.index') }}" class="block p-2 sidebar-text">Marketing Images</a>
        </li>

        <li class="mb-2 flex items-center gap-2 sidebar-item rounded px-3 hover:bg-teal-700 hover:text-gray-200">
            <span class="material-icons bg-teal-700 text-white rounded p-1">
                palette
            </span>
            <a href="#" class="block p-2 sidebar-text">Canva Template</a>
        </li>

        <li class="mb-2 flex items-center gap-2 sidebar-item rounded px-3 hover:bg-teal-700 hover:text-gray-200">
            <span class="material-icons bg-teal-700 text-white rounded p-1">
                school
            </span>
            <a href="#" class="block p-2 sidebar-text">Nextgen Academy</a>
        </li>

        
        <hr class="border-t border-gray-700 my-6" />

        <li class="mb-2 flex items-center gap-2 sidebar-item rounded px-3 hover:bg-teal-700 hover:text-gray-200">
            <span class="material-icons bg-teal-700 text-white rounded p-1">
               filter_alt
            </span>
            <a href="#" class="block p-2 sidebar-text">Sale Funnel Pro</a>
        </li>

        <hr class="border-t border-gray-700 my-6" />

        <li class="mb-2 flex items-center gap-2 sidebar-item rounded px-3 hover:bg-teal-700 hover:text-gray-200">
            <span class="material-icons bg-teal-700 text-white rounded p-1">
                   settings
            </span>
            <a href="#" class="block p-2 sidebar-text">Package Settings</a>
        </li>

    </ul>
</aside>



<!-- ############ Mobile Sidebar #####################################################################-->
<div id="overlay" class="fixed inset-0 bg-black opacity-50 hidden md:hidden z-40"></div> <!-- Overlay -->

<div id="mobile-sidebar"
    class="fixed inset-0 z-50 p-5 transform -translate-x-full transition-transform md:hidden overflow-y-auto w-[300px]  bg-gray-800 text-gray-200">


    <div class="flex justify-between items-center mb-6 pl-3 pr-4">
        <a href="/dashboard">
            <img src="https://d1yei2z3i6k35z.cloudfront.net/4624298/681b9a807efb8_RealEstate1920x700px.png"
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
            <a href="{{ route('user.dashboard') }}" class="block p-2 sidebar-text">Dashboard</a>
        </li>

        <li class="mb-2 flex items-center gap-2 sidebar-item rounded px-3 hover:bg-teal-700 hover:text-gray-200">
            <span class="material-icons bg-teal-700 text-white rounded p-1">
                insights
            </span>
            <a href="{{ route('income-stats') }}" class="block p-2 sidebar-text">Income Stats</a>
        </li>
    </ul>
</div>