<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>

    <link rel="shortcut icon" href="{{ asset('assets/favicon/favicon.ico') }}"> 

    {{-- Vite for Tailwind and local assets --}}
    @vite('resources/css/app.css')

    {{-- Google Font: Nunito (Default Laravel UI font) --}}
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- Material Icons (Used for built-in Google icons) --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    {{-- Font Awesome 6.4.2 (for modern icon sets) --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    {{-- Phosphor Icons (alternative modern icon set) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@latest/src/css/icons.css">

    {{-- CropperJS (image cropping tool styling) --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">

    {{-- SweetAlert2 (for beautiful alert modals) --}}
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    {{-- Alpine.js (for reactive behavior in Blade) --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Additional Scripts --}}
    @yield('head')

</head>

<style>

    /* 🔵 Thin Gray Scrollbar for #main-content */
#main-content {
    scrollbar-width: thin; /* Firefox */
    scrollbar-color: #D1D5DB transparent; /* Firefox */
}

#main-content::-webkit-scrollbar {
    width: 4px;
    height: 4px;
}

#main-content::-webkit-scrollbar-thumb {
    background-color: #D1D5DB; /* Tailwind gray-300 */
    border-radius: 10px;
}

#main-content::-webkit-scrollbar-track {
    background: transparent;
}

.swal2-confirm,
.swal2-cancel {
  outline: none !important;
  border: none !important;
  box-shadow: none !important;
}
</style>

<body class="flex flex-col lg:flex-row overflow-hidden bg-gray-50 ">


    <x-admin-sidebar />{{-- Sidebar Component --}}

    <div class="flex-1 overflow-y-auto ">
        <header id="main-header" class="bg-gray-50  flex-1 flex flex-col transition-all duration-300 ml-0 ">
            <x-admin-nav /> {{-- Navbar Component --}}
        </header>

       <main id="main-content" class="bg-gray-50 transition-all duration-300 mr-0 ml-0 overflow-y-auto pb-6" style="height: calc(100vh - 80px);">
            @yield('content') {{-- Dynamic content --}}
       </main>

        {{-- Success Alert Message --}}
      <x-alert-success />
    </div>

    {{-- JavaScript --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Additional Scripts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    @yield('js')
</body>

</html>
