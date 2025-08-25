@extends('layouts.users')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto p-4 sm:p-8 max-w-full">

    <div class="flex flex-col md:flex-row gap-6">

        <!-- Left: Profile Card (centered) -->
        <div class="w-full md:w-1/3 bg-white  rounded-xl p-6 flex flex-col items-center">
            <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('assets/profile_picture/profile.png') }}"
                 alt="Profile Photo"
                 class="h-52 w-52 object-cover rounded-full border-8 border-gray-300 mb-4">

            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900">Hello, {{ Auth::user()->name }}</h1>
                <p class="text-gray-700 mt-1">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <!-- Right: Recent Leads Card (larger) -->
        <div class="w-full md:w-2/3 bg-white  rounded-xl p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Leads</h2>

            @if($recentLeads->count() > 0)
                <ul class="space-y-3 max-h-[32rem] overflow-y-auto">
                    @foreach($recentLeads as $lead)
                        <li class="p-4 bg-gray-50 rounded-lg shadow flex justify-between items-center hover:bg-gray-100 transition">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $lead->name }}</p>
                                <p class="text-sm text-gray-500">{{ $lead->email }}</p>
                            </div>
                            <span class="text-sm text-gray-400">{{ $lead->created_at->format('M d, Y') }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-400 text-center">No recent leads.</p>
            @endif
        </div>

    </div>

</div>
@endsection
