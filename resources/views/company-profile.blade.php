@extends('layouts.header')

@section('title', 'Company Profile')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-12 space-y-16">

    <!-- Hero Section -->
    <section class="border border-white p-6 rounded-md text-center">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Welcome to Our Company</h1>
        <p class="text-lg text-gray-700 max-w-2xl mx-auto">
            We empower entrepreneurs by providing tools and a supportive environment to succeed online.
        </p>
    </section>

    <!-- Mission and Vision -->
    <section class="grid md:grid-cols-2 gap-8">
        <div class="border border-white p-6 rounded-md">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Our Mission</h2>
            <p class="text-gray-700 leading-relaxed">
                To equip individuals with innovative solutions and proven systems that support growth in digital business.
            </p>
        </div>
        <div class="border border-white p-6 rounded-md">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Our Vision</h2>
            <p class="text-gray-700 leading-relaxed">
                To become a top-tier platform recognized for transforming ordinary people into successful digital entrepreneurs.
            </p>
        </div>
    </section>

    <!-- Founder Profile -->
    <section class="text-center border border-white p-8 rounded-md max-w-2xl mx-auto">
        <img src="https://via.placeholder.com/150" alt="Juan de Lacrus Mona" class="w-32 h-32 mx-auto rounded-full mb-4">
        <h3 class="text-xl font-bold text-gray-900">Juan Dela Cruz</h3>
        <p class="text-sm text-gray-500 mb-3">Founder & CEO</p>
        <p class="text-gray-700 text-sm leading-relaxed">
            Juan is a visionary leader dedicated to helping others grow their business through innovation, mentorship, and digital strategy.
        </p>
    </section>

</div>
@endsection
