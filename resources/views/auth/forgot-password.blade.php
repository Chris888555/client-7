@extends('layouts.guest')

@section('title', 'Forgot Password')

@section('content')
<div class="min-h-screen flex items-center justify-center">
  <div class="bg-white/5 backdrop-blur-md border border-white/30 rounded-xl p-8 w-full max-w-md shadow-lg">
    <h1 class="text-2xl font-semibold mb-2 text-center text-white">Forgot Password</h1>
    <p class="text-center text-white/80 mb-6 text-sm">
        Please enter your registered email address. We will send your login details there.
    </p>

    <form method="POST" action="{{ route('forgot-password.send') }}">
      @csrf

      @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5" role="alert">
          {{ session('success') }}
        </div>
      @endif

      @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5" role="alert">
          {{ $errors->first() }}
        </div>
      @endif

      <label for="login" class="block mb-2 font-semibold text-white">Email</label>
      <input id="login" name="login" type="text" required 
        class="w-full px-4 py-3 border border-white/50 rounded-lg bg-gray-100 text-gray-800 placeholder-gray-500
               focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent transition" 
        placeholder="Enter your registered email" />

      <button type="submit" 
        class="mt-6 w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 
               focus:outline-none focus:ring-2 focus:ring-white 
               shadow-[0_0_10px_2px_rgba(255,255,255,0.5)] transition duration-300">
        Send Password
      </button>
    </form>
  </div>
</div>
@endsection
