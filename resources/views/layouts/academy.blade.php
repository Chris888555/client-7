<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>

    <link rel="shortcut icon" href="{{ asset('assets/favicon/favicon.ico') }}">

    {{-- ✅ Tailwind (Vite) --}}
    @vite('resources/css/app.css')

    {{-- ✅ Fonts --}}
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@latest/src/css/icons.css">

    {{-- ✅ Plugins --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    {{-- ✅ Alpine.js --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @yield('head')
</head>

<style>
    /* ✅ Scrollbar */
    *::-webkit-scrollbar {
        width: 3px;
        height: 3px;
    }

    *::-webkit-scrollbar-thumb {
        background-color: #ccc;
        border-radius: 10px;
    }

    /* ✅ SweetAlert cleanup */
    .swal2-confirm,
    .swal2-cancel {
        outline: none !important;
        border: none !important;
        box-shadow: none !important;
    }

    html, body {
        height: 100%;
        min-height: 100vh;
    }

    #layout-wrapper {
        min-height: 100vh;
    }

    #main-content {
        flex: 1 1 auto;
    }
</style>

<body class="flex flex-col lg:flex-row bg-gray-100 overflow-x-hidden">

    {{-- ✅ Page Wrapper --}}
    <div class="flex-grow overflow-hidden">

        {{-- ✅ Main Content --}}
        <main id="main-content" class="bg-gray-100 transition-all duration-300 h-screen overflow-y-auto">
            @yield('content')
        </main>

    </div>

    {{-- ✅ JS Plugins --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    {{-- ⚠️ Bootstrap JS removed (no longer needed with Tailwind) --}}

    <script>
        $(document).ready(function () {
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
