@extends('layouts.header')

@section('title', 'Home')

@section('content')

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<section class="min-h-screen flex flex-col justify-center items-center text-gray-200 px-6 py-20">
    <div class="max-w-5xl text-center">
        <h1 class="text-5xl font-extrabold mb-6 text-yellow-400 drop-shadow-lg">
            Elevate Your <span class="text-yellow-400">Coding Skills</span> with Laravel & PHP
        </h1>
        <p class="text-lg md:text-xl mb-8 max-w-3xl mx-auto leading-relaxed text-gray-300">
            Build powerful, scalable web applications using the latest tools and frameworks. 
            Master Laravel and PHP with expert tutorials, tips, and project-based learning.
        </p>
        <a href="/products" 
           class="inline-flex items-center gap-3 bg-yellow-400 hover:bg-yellow-500 text-teal-900 font-semibold px-8 py-3 rounded shadow-lg transition duration-300">
           Explore Products
           <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    <div class="mt-16 grid grid-cols-1 sm:grid-cols-3 gap-10 max-w-6xl w-full">
        <div class="bg-gray-600 rounded-lg p-8 shadow-lg hover:shadow-2xl transition-shadow duration-500">
            <i class="fas fa-code text-yellow-300 text-4xl mb-4"></i>
            <h3 class="text-xl font-semibold mb-2 text-yellow-300">Clean Code</h3>
            <p class="text-gray-200 text-sm leading-relaxed">
                Write maintainable, reusable, and efficient code using best practices and modern standards.
            </p>
        </div>
        <div class="bg-gray-600 rounded-lg p-8 shadow-lg hover:shadow-2xl transition-shadow duration-500">
            <i class="fas fa-cogs text-yellow-300 text-4xl mb-4"></i>
            <h3 class="text-xl font-semibold mb-2 text-yellow-300">Advanced Tools</h3>
            <p class="text-gray-200 text-sm leading-relaxed">
                Utilize Laravel's powerful features like Eloquent, Queues, and Blade templating for rapid development.
            </p>
        </div>
        <div class="bg-gray-600 rounded-lg p-8 shadow-lg hover:shadow-2xl transition-shadow duration-500">
            <i class="fas fa-rocket text-yellow-300 text-4xl mb-4"></i>
            <h3 class="text-xl font-semibold mb-2 text-yellow-300">Fast Deployment</h3>
            <p class="text-gray-200 text-sm leading-relaxed">
                Deploy your applications with confidence using modern CI/CD pipelines and cloud platforms.
            </p>
        </div>
    </div>
</section>

@endsection
