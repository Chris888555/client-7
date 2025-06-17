@extends('layouts.users')

@section('title', 'Dashboard')

@section('content')
<main class="container m-auto p-4 sm:p-8 max-w-full">
    <x-page-header-text title="User Dashboard" />

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-2">Name</h2>
            <p>{{ Auth::user()->name }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-2">Email</h2>
            <p>{{ Auth::user()->email }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-2">Username</h2>
            <p>{{ Auth::user()->username }}</p>
        </div>
    </div>

    <div class="mt-8">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                Logout
            </button>
        </form>
    </div>
</main>
@endsection
