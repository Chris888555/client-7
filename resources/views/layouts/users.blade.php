<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>@yield('title', config('app.name'))</title>

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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

    {{-- Additional Scripts --}}
    @yield('head')
    <style>
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col {
            flex: 1;
            padding: 15px;
            box-sizing: border-box;
        }

        .col-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .col-4 {
            flex: 0 0 33.3333%;
            max-width: 33.3333%;
        }

        .col-3 {
            flex: 0 0 25%;
            max-width: 25%;
        }

        .col-8 {
            flex: 0 0 66.6667%;
            max-width: 66.6667%;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.5rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn {
            display: inline-block;
            font-weight: 500;
            color: #fff;
            text-align: center;
            vertical-align: middle;
            user-select: none;
            background-color: #007bff;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.15s ease-in-out;
            text-decoration: none;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-md {
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }

        .mt-2 { margin-top: 0.5rem; }   /* ~8px */
        .mt-4 { margin-top: 1.5rem; }   /* ~24px */

        .mb-2 { margin-bottom: 0.5rem; } /* ~8px */
        .mb-4 { margin-bottom: 1.5rem; } /* ~24px */

        .p-2 { padding: 0.5rem; }   /* ~8px */
        .p-4 { padding: 1.5rem; }   /* ~24px */

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
            color: #212529;
            border: 1px solid #dee2e6;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border: 1px solid #dee2e6;
            text-align: left;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .active {
            background-color: #007bff;
            color: #fff;
        }

        .nav-item.active,
        .list-group-item.active {
            font-weight: bold;
            background-color: #007bff;
            color: #fff;
        }

        .text-center {
            text-align: center;
        }


    </style>
</head>

<body class="flex flex-col lg:flex-row overflow-hidden bg-gray-800">

    <x-sidebar /> {{-- Sidebar Component --}}

    <div class="flex-1 overflow-y-auto ">
        <header id="main-header" class="bg-gray-800 p-4 sm:p-5 flex-1 flex flex-col transition-all duration-300 ml-0 lg:ml-[280px]">
            <x-user-nav /> {{-- Navbar Component --}}
        </header>

        <main id="main-content" class="bg-gray-50 rounded-3xl transition-all duration-300 mr-0 md:mr-4 ml-0 lg:ml-[280px] overflow-y-auto" style="height: calc(100vh - 80px);">
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
    <script src="{{ asset('userjs/alert.js') }}"></script>
    @yield('js')
</body>

</html>
