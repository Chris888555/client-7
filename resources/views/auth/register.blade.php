@extends('layouts.guest')

@section('title', 'Register')

@section('content')
<div class="w-full max-w-xl bg-white rounded-2xl shadow-2xl p-6 sm:p-10">
    <div class="text-center mb-8">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-500">Create Your Account</h1>
    </div>

    {{-- Show errors --}}
    @if ($errors->any())
    <div class="mb-4 text-sm text-red-600 text-center">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-6">
            <label for="name" class="block text-sm font-semibold text-gray-500 mb-1">Name</label>
            <input type="text" name="name" id="name" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-300"
                value="{{ old('name') }}">
        </div>

        <div class="mb-6">
            <label for="email" class="block text-sm font-semibold text-gray-500 mb-1">Email</label>
            <input type="email" name="email" id="email" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-300"
                value="{{ old('email') }}">
        </div>

        <div class="mb-6">
            <label for="password" class="block text-sm font-semibold text-gray-500 mb-1">Password</label>
            <input type="password" name="password" id="password" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-300">
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-500 mb-1">Confirm
                Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-300">
        </div>

        <button type="submit"
            class="w-full bg-teal-700 hover:bg-teal-800 text-white font-bold py-3 rounded-lg transition duration-200">
            Register
        </button>
    </form>

</div>
@endsection