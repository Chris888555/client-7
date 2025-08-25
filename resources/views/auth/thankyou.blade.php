@extends('layouts.guest')

@section('title', 'Pending Approval')

@section('content')
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white/5 backdrop-blur-md border border-white/30 rounded-xl p-8 w-full max-w-lg shadow-lg text-center">
        <i class="fas fa-circle-check text-green-500 text-6xl mb-6"></i>
        <h1 class="text-4xl font-extrabold text-white mb-4">Registration Successful</h1>
        <p class="text-white/80 text-lg mb-6">
            Thank you for registering. Please wait for the admin to approve your account.
        </p>
        <a href="{{ route('login') }}"
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg 
                  focus:outline-none focus:ring-2 focus:ring-white 
                  shadow-[0_0_10px_2px_rgba(255,255,255,0.5)] transition duration-200">
            Back to Login
        </a>
    </div>
</div>
@endsection
