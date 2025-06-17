<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <link rel="shortcut icon" href="{{ asset('assets/favicon/favicon.ico') }}">

    {{-- Tailwind via Vite --}}
    @vite('resources/css/app.css')

    {{-- Fonts --}}
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body class="bg-gray-700 text-gray-800">

    <x-header />

    <main class="px-4 py-16 mt-[70px] sm:mt-[100px]">
        @yield('content')
    </main>

    <x-footer />

</body>

</html>
