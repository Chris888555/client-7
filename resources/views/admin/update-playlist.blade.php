<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Playlist</title>
    @vite(['resources/css/app.css'])
    <!-- Include Vite compiled CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include AlpineJS for handling expand/collapse functionality -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</head>

<body>

<!-- Include Sidebar -->
@include('includes.nav')

<div class="container w-full max-w-7xl mt-0 mb-0 m-auto p-4 sm:p-8">
        <h1 class="text-xl font-semibold mb-4">Update Playlist</h1>

       <!-- Success Message -->
        @if(session('success'))
        <div id="success-message"
            class="flex w-full overflow-hidden bg-emerald-50 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)] dark:bg-gray-800 mb-4">
            <div class="flex items-center justify-center w-12 bg-emerald-500">
                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
                </svg>
            </div>

            <div class="px-4 py-2 -mx-3">
                <div class="mx-3">
                    <span class="font-semibold text-emerald-500 dark:text-emerald-400">Success</span>
                    <p class="text-sm text-gray-600 dark:text-gray-200">{{ session('success') }}</p>
                </div>
            </div>
        </div>

        <script>
        // Hide the success message after 3 seconds
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 5000);
        </script>
        @endif

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
                            class="w-full p-2 mb-4 border rounded" required>

                        <!-- Video Link Input -->
                        <label for="video_link" class="block text-sm font-semibold">Video Link</label>
                        <input type="url" name="video_link" value="{{ $playlist->video_link }}"
                            class="w-full p-2 mb-4 border rounded" required>

                        <!-- Thumbnail Upload -->
                        <label for="thumbnail" class="block text-sm font-semibold">Thumbnail (Optional)</label>
                        <input type="file" name="thumbnail" class="w-full p-2 mb-4 border rounded">

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
</body>

</html>