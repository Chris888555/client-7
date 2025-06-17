@extends('layouts.guest')

@section('title', 'Pending Approval')

@section('content')
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<div class="flex items-center justify-center">
    <div class="w-full max-w-lg p-8   text-center">
        <i class="fas fa-circle-check text-green-500 text-6xl mb-6"></i>
        <h1 class="text-4xl font-extrabold text-gray-800 mb-4">Registration Successful</h1>
        <p class="text-gray-600 text-lg mb-6">
            Thank you for registering. Please wait for the admin to approve your account.
        </p>
        <a href="{{ route('login') }}"
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-200">
            Back to Login
        </a>
    </div>
</div>
@endsection
