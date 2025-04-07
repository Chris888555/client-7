<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Navigation</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed w-[280px] bg-[#3e377b] text-white h-screen p-5 hidden md:block transition-all duration-300 overflow-y-auto">
        <h2 id="sidebar-logo" class="text-lg font-bold mb-6 flex items-center space-x-2 sidebar-item px-4 ">My Logo
        </h2>

        <ul>
            <li
                class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                <span class="material-icons">dashboard</span>
                <a href="{{ route('dashboard') }}" class="block p-2 sidebar-text">Dashboard</a>
            </li>

            <li
                class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                <span class="material-icons">insert_chart</span> <!-- Representing charts or analytics -->
                <a href="{{ route('funnel.main') }}" class="block p-2 sidebar-text">Sales Funnel</a>
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


            @if(Auth::user()->is_admin == 1)
            <div class="border-t border-t-gray-500 pt-8 mt-8">
                <li
                    class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                    <span class="material-icons">manage_accounts</span>
                    <a href="{{ route('admin.manage-users') }}" class="block p-2 sidebar-text">Manage Users</a>
                </li>

                @endif


                @if(Auth::user()->is_admin == 1)
                <li
                    class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                    <span class="material-icons">video_library</span>
                    <a href="{{ route('marketing.index') }}" class="block p-2 sidebar-text">Upload Downloadable</a>
                </li>
                @endif


                @if(Auth::user()->is_admin == 1)
                <li
                    class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                    <span class="material-icons">cloud_upload</span>
                    <a href="{{ route('admin.upload-playlist') }}" class="block p-2 sidebar-text">Upload Playlist</a>
                </li>
                @endif

            </div>

            <li
                class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                <span class="material-icons">account_circle</span>
                <a href="{{ route('profile.uploadForm') }}" class="block p-2 sidebar-text">Edit Profile</a>
            </li>

            <li </ul>

    </aside>

    <!-- Main Content -->
    <div id="main-content" class="flex-1 flex flex-col ml-0 sm:ml-[280px] transition-all duration-300 overflow-x-auto">
        <!-- Header Toolbar -->
        <header
            class="bg-white shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)] p-4 flex justify-between items-center">

            <!-- PC Sidebar Toggle Button -->
            <button id="pc-menu-toggle" class="hidden md:block text-blue-900">
                <svg class="h-8 w-8 text-[#3e377b]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="6" x2="21" y2="6" />
                    <line x1="3" y1="12" x2="21" y2="12" />
                    <line x1="3" y1="18" x2="21" y2="18" />
                </svg>
            </button>

            <!-- Mobile Sidebar Toggle -->
            <button id="menu-toggle" class="md:hidden text-blue-900">
                <svg class="h-8 w-8 text-[#3e377b]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="17" y1="10" x2="3" y2="10" />
                    <line x1="21" y1="6" x2="3" y2="6" />
                    <line x1="21" y1="14" x2="3" y2="14" />
                    <line x1="17" y1="18" x2="3" y2="18" />
                </svg>
            </button>

            <!-- Profile Section -->
            <div class="relative flex items-center space-x-4">
                <h2 class="text-sm font-medium text-gray-700">
                    {{ explode(' ', auth()->user()->name)[0] }}
                </h2>

                <button id="profile-btn" class="flex items-center space-x-2 focus:outline-none">
                    @if(auth()->user()->profile_picture)
                    <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile Photo"
                        class="h-8 w-8 object-cover rounded-full">
                    @else
                    <img src="{{ asset('storage/profile_photos/default.png') }}" alt="Default Profile Photo"
                        class="h-8 w-8 object-cover rounded-full">
                    @endif
                </button>

                <!-- Dropdown Menu -->
                <div id="dropdown-menu"
                    class="absolute right-0 mt-[150px] w-[150px] bg-white border border-gray-200 shadow-md rounded-md hidden">
                    <a href="{{ route('profile.uploadForm') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Edit Profile</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>

        </header>

        <!-- Mobile Sidebar -->
        <div id="mobile-sidebar"
            class="fixed inset-0 bg-[#3e377b] text-white z-50 p-5 transform -translate-x-full transition-transform md:hidden">
            <div class="flex justify-end">
                <button id="close-sidebar" class="text-white text-lg">
                    <svg class="h-8 w-8 text-gray-200" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                        <line x1="9" y1="9" x2="15" y2="15" />
                        <line x1="15" y1="9" x2="9" y2="15" />
                    </svg>
                </button>
            </div>
            <h2 class="text-lg font-bold mb-6 flex items-center space-x-2 sidebar-item px-4 ">My Logo</h2>
            <ul>
                <li
                    class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                    <span class="material-icons">dashboard</span>
                    <a href="{{ route('dashboard') }}" class="block p-2 sidebar-text">Dashboard</a>
                </li>

                <li
                    class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                    <span class="material-icons">insert_chart</span> <!-- Representing charts or analytics -->
                    <a href="{{ route('funnel.main') }}" class="block p-2 sidebar-text">Sales Funnel</a>
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


                @if(Auth::user()->is_admin == 1)

                <li
                    class="border-t border-t-gray-500 pt-8 mt-8 mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                    <span class="material-icons">manage_accounts</span>
                    <a href="{{ route('admin.manage-users') }}" class="block p-2 sidebar-text">Manage Users</a>
                </li>

                @endif


                @if(Auth::user()->is_admin == 1)
                <li
                    class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                    <span class="material-icons">video_library</span>
                    <a href="{{ route('marketing.index') }}" class="block p-2 sidebar-text">Upload Downloadable</a>
                </li>
                @endif


                @if(Auth::user()->is_admin == 1)
                <li
                    class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                    <span class="material-icons">cloud_upload</span>
                    <a href="{{ route('admin.upload-playlist') }}" class="block p-2 sidebar-text">Upload Playlist</a>
                </li>
                @endif



                <li
                    class="mb-2 flex items-center space-x-2 sidebar-item hover:bg-gray-200 rounded px-4 hover:text-blue-900">
                    <span class="material-icons">account_circle</span>
                    <a href="{{ route('profile.uploadForm') }}" class="block p-2 sidebar-text">Edit Profile</a>
                </li>



            </ul>
        </div>

        <script>
        // Mobile Sidebar Toggle
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('mobile-sidebar').classList.remove('-translate-x-full');
        });

        document.getElementById('close-sidebar').addEventListener('click', function() {
            document.getElementById('mobile-sidebar').classList.add('-translate-x-full');
        });

        // PC Sidebar Toggle
        document.getElementById('pc-menu-toggle').addEventListener('click', function() {
            let sidebar = document.getElementById('sidebar');
            let mainContent = document.getElementById('main-content');
            let texts = document.querySelectorAll('.sidebar-text');
            let items = document.querySelectorAll('.sidebar-item');
            let logo = document.getElementById('sidebar-logo');

            if (sidebar.classList.contains('w-[280px]')) {
                sidebar.classList.remove('w-[280px]');
                sidebar.classList.add('w-[96px]'); // Adjust width when collapsed
                mainContent.classList.remove('sm:ml-[280px]');
                mainContent.classList.add('sm:ml-[96px]'); // Adjust the margin for the collapsed sidebar
                texts.forEach(text => text.classList.add('hidden'));
                items.forEach(item => {
                    item.classList.add('mt-4');
                    item.classList.add('p-2');
                });
                logo.textContent = 'R';
                logo.classList.add('ml-1');
                logo.classList.add('text-xl');
            } else {
                sidebar.classList.remove('w-[96px]');
                sidebar.classList.add('w-[280px]'); // Reset to original width when expanded
                mainContent.classList.remove('sm:ml-[96px]');
                mainContent.classList.add('sm:ml-[280px]'); // Reset the margin when sidebar expands
                texts.forEach(text => text.classList.remove('hidden'));
                items.forEach(item => {
                    item.classList.remove('mt-4');
                    item.classList.remove('p-2');
                });
                logo.textContent = 'Real Estate';
                logo.classList.remove('ml-1');
                logo.classList.add('text-xl');
            }
        });

        // Profile Dropdown Toggle
        document.getElementById("profile-btn").addEventListener("click", function() {
            document.getElementById("dropdown-menu").classList.toggle("hidden");
        });
        </script>

</body>

</html>