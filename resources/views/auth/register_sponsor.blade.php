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

        <div class="mb-4">
            <label for="name" class="block text-sm font-semibold text-gray-500 mb-1">First name</label>
            <input type="text" id="firstname" name="firstname" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-300" value="{{ old('name') }}">
        </div>
        <div class="mb-4">
            <label for="name" class="block text-sm font-semibold text-gray-500 mb-1">Last name</label>
            <input type="text" id="lastname" name="lastname" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-300" value="{{ old('name') }}">
        </div>

        <div class="mb-6">
            <label for="name" class="block text-sm font-semibold text-gray-500 mb-1">Username</label>
            <input type="text" id="username" name="username" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-300" value="{{ old('email') }}">
        </div>

        <div class="mb-6">
            <label for="password" class="block text-sm font-semibold text-gray-500 mb-1">Password</label>
            <input type="password" name="password" id="password" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-300">
        </div>

        <div class="mb-6">
            <label for="text" class="block text-sm font-semibold text-gray-500 mb-1">Sponsor</label>
            <input type="text" name="sponsor" id="sponsor" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-300">
        </div>

        <div class="mb-6">
            <label for="text" class="block text-sm font-semibold text-gray-500 mb-1">Code ID</label>
            <input type="text" name="codeid" id="codeid" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-300">
        </div>

        <div class="mb-6">
            <label for="test" class="block text-sm font-semibold text-gray-500 mb-1">Upline</label>
            <input type="test" name="upline" id="upline" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-300">
        </div>

        <div class="mb-6">
            <label for="position" class="block text-sm font-semibold text-gray-500 mb-1">Position</label>
            <select name="position" id="position" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-300">
                <option value="L">Left</option>
                <option value="R">Right</option>
            </select>
        </div>


        <button type="submit"
            class="w-full bg-teal-700 hover:bg-teal-800 text-white font-bold py-3 rounded-lg transition duration-200">
            Register
        </button>
    </form>

</div>
@endsection