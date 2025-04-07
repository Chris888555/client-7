<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Playlist</title>
    @vite(['resources/css/app.css'])
    <!-- Include Vite compiled CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<!-- Include Sidebar -->
@include('includes.nav')

<body class="bg-white min-h-screen flex items-center justify-center">



    <!-- Playlist Upload Form -->
    <div class="w-[90%] max-w-[700px] mx-auto bg-white  p-8 rounded-2xl border-2 border-gray-200 mt-[100px]">
        <h1 class="text-2xl font-bold text-gray-800 text-center mb-6">Upload Playlist Video</h1>

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

        <!-- Form to upload playlist -->
        <form action="{{ route('playlists.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Title Input -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-semibold text-gray-700">Title</label>
                <input type="text" name="title" required
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800">
            </div>

            <!-- Video Link Input -->
            <div class="mb-4">
                <label for="video_link" class="block text-sm font-semibold text-gray-700">Video Link (YouTube or
                    MP4)</label>
                <input type="url" name="video_link" required
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800">
            </div>

            <!-- Thumbnail Image Upload -->
            <div class="mb-4">
                <label for="thumbnail" class="block text-sm font-semibold text-gray-700">Thumbnail Image </label>
                <input type="file" name="thumbnail" accept="image/*"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg text-gray-800">
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="bg-gradient-to-br from-indigo-600 to-purple-500 w-full text-white py-3 rounded-lg font-bold text-lg hover:bg-blue-700 transition-transform transform hover:scale-105 flex items-center justify-center space-x-2">
                <svg class="h-6 w-6 text-white" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <path d="M7 18a4.6 4.4 0 0 1 0 -9h0a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1" />
                    <polyline points="9 15 12 12 15 15" />
                    <line x1="12" y1="12" x2="12" y2="21" />
                </svg>
                <span>Upload Playlist</span>
            </button>

        </form>


    </div>
   <div class="flex justify-center mt-10">
    <a href="{{ route('admin.update-playlist') }}"
        class="inline-block bg-blue-500 text-white py-4 px-6 rounded-md hover:bg-blue-700 flex items-center gap-2">
        <svg class="h-6 w-6 text-slate-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
        </svg>
        Go to Update Playlist
    </a>
</div>






</body>

</html>