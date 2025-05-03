
@extends('layouts.app')

@section('title', 'Update Playlist')

@section('content')

@include('includes.nav')

<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>


<div class="container m-auto p-4 sm:p-8 max-w-full">
      <h1 class="text-2xl md:text-3xl font-bold text-left text-blue-400">Manage Playlist Videos</h1>
        <p class="text-gray-600 text-left mb-4">Manage your playlist by editing or removing videos as needed.</p>



    
        <!-- Playlist List -->
        <ul>
            @foreach($playlists as $playlist)
            <li class="bg-white p-4 mt-6 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)] mb-4 cursor-pointer" x-data="{ open: false }">
                <!-- Clickable Header for Title -->
                <div class="flex justify-between items-center">
                    <div class="flex flex-col space-y-2">
                        <!-- Title -->
                        <h2 class="text-base font-bold">{{ $playlist->title }}</h2>
                    </div>

                    <!-- Toggle Arrow Button for Expanding/Collapsing the Form -->
                    <button class="flex items-center space-x-2" @click="open = !open">
                        <!-- Open Arrow -->
                        <svg x-show="!open" class="w-7 h-7 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-width="2" d="M5 8l5 5 5-5"></path>
                        </svg>
                        <!-- Close Arrow -->
                        <svg x-show="open" class="w-7 h-7 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-width="2" d="M5 12l5-5 5 5"></path>
                        </svg>
                    </button>
                </div>

                <!-- Expanded Edit Form (Hidden/Visible on Toggle) -->
                <div x-show="open" x-transition class="mt-4">
                    <!-- Video and Delete Button Inline (below the Title) -->
                    <div class="flex items-center gap-2 mb-4">
                        <!-- Video Thumbnail (Rectangle) -->
                        <img src="{{ asset('storage/' . $playlist->thumbnail_url) }}" alt="{{ $playlist->title }}"
                            class="w-[70px] h-[40px] object-cover">

                        <!-- Delete Button Inline -->
                        <form action="{{ route('admin.delete-playlist', $playlist->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this playlist?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                        </form>
                    </div>

                    <!-- Form to Edit Playlist -->
                    <form action="{{ route('admin.update-playlist.submit', $playlist->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" value="{{ $playlist->id }}">

                        <!-- Title Input -->
                        <label for="title" class="block text-sm font-semibold">Title</label>
                        <input type="text" name="title" value="{{ $playlist->title }}"
                            class="mt-1 mb-4 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800" required>

                        <!-- Video Link Input -->
                        <label for="video_link" class="block text-sm font-semibold">Video Link</label>
                        <input type="url" name="video_link" value="{{ $playlist->video_link }}"
                            class="mt-1 mb-4 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800" required>

                        <!-- Thumbnail Upload -->
                        <label for="thumbnail" class="block text-sm font-semibold">Thumbnail (Optional)</label>
                        <input type="file" name="thumbnail" class="mt-1 block w-full p-[10px] border bg-white border-gray-300 rounded-lg text-gray-800 cursor-pointer hover:bg-gray-100">

                        <div class="flex gap-2 mt-4">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                            <button type="button" @click="open = false"
                                class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                        </div>
                    </form>

                </div>
            </li>
            @endforeach
        </ul>
    </div>
@endsection