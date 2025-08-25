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

    {{-- Google Font --}}
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="bg-gray-700 bg-cover bg-center" 
      style="background-image: url('https://i.pinimg.com/736x/e7/2a/5b/e72a5b414d4a4503aec8126351002cd5.jpg');">


<main class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-xl px-4">
        <div class="p-2">
            @yield('content')
        </div>
    </div>
</main>


{{-- Additional Scripts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('userjs/alert.js') }}"></script>
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
