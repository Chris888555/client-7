<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>

    {{-- Vite for Tailwind and local assets --}}
    @vite('resources/css/app.css')

    {{-- Google Font --}}
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

</head>

<body class="bg-gradient-to-br from-teal-700 via-teal-400 to-teal-900">

<x-header />

    <main class="flex items-center justify-center px-4 py-16 overflow-y-auto">
        @yield('content')
    </main>
<x-footer />

</body>

</html>