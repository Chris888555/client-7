@extends('layouts.users')

@section('title', 'Academy')

@section('content')



<div class="container m-auto p-4 sm:p-8 max-w-full">

    @if($playlists->isEmpty())
    <x-no-materials />
    @else
    <div class="grid md:grid-cols-[300px_1fr] gap-6">
        <!-- Fixed Sidebar Playlist (only sticky on md and up) -->
        <aside class="hidden md:block sticky top-4 self-start h-[calc(100vh-100px)] overflow-y-auto pr-2 ">
            @foreach($playlists as $playlist)
            <div class="bg-gray-100 cursor-pointer playlist-item flex gap-3 items-center p-2 mt-4 hover:bg-gray-200 rounded-lg hover:border-l-4 border-gray-400"
                onclick="setActiveAndLoadVideo(this, '{{ $playlist->video_link }}')">

                <img src="{{ $playlist->thumbnail_url ? asset('storage/' . $playlist->thumbnail_url) : 'https://via.placeholder.com/120x90' }}"
                    class="w-[75px] h-[40px] object-cover rounded" alt="{{ $playlist->title }}">
                <div class="text-sm font-medium text-gray-800 leading-snug">{{ $playlist->title }}</div>
            </div>
            @endforeach
        </aside>

        <!-- Main Video Player -->
        <section class="w-full">
            <div class="bg-white rounded-lg shadow p-2 sm:p-4 mt-4">
                <div class="relative w-full pb-[56.25%] h-0 overflow-hidden rounded-lg">
                    <iframe id="mainVideoPlayer" class="absolute top-0 left-0 w-full h-full rounded-lg" frameborder="0"
                        allowfullscreen></iframe>
                </div>

            </div>

        </section>

    </div>

    <!-- Mobile Playlist (shown only on small screens) -->
    <div class="md:hidden mt-6 space-y-4">
        <section class="h-[calc(100vh-380px)] overflow-y-auto rounded-lg p-2">
            @foreach($playlists as $playlist)
            <div class="bg-gray-100 cursor-pointer playlist-item flex gap-3 items-center p-2 mt-3 hover:bg-gray-200 rounded-lg hover:border-l-4 border-gray-400"
                onclick="setActiveAndLoadVideo(this, '{{ $playlist->video_link }}')">
                <img src="{{ $playlist->thumbnail_url ? asset('storage/' . $playlist->thumbnail_url) : 'https://via.placeholder.com/120x90' }}"
                    class="w-[75px] h-[40px] object-cover rounded" alt="{{ $playlist->title }}">
                <div class="text-sm font-medium text-gray-800 leading-snug">{{ $playlist->title }}</div>
            </div>
            @endforeach
        </section>
    </div>


    @endif
</div>


<script>
function isYouTube(url) {
    return /(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/.test(url);
}

function getYouTubeEmbedURL(url) {
    const match = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/);
    return match ? `https://www.youtube.com/embed/${match[1]}?autoplay=1` : url;
}

function loadVideo(videoLink) {
    const player = document.getElementById('mainVideoPlayer');
    player.src = isYouTube(videoLink) ? getYouTubeEmbedURL(videoLink) : videoLink;
}

// New: Load and mark clicked video as active
function setActiveAndLoadVideo(element, videoLink) {
    // Remove active class from all items
    document.querySelectorAll('.playlist-item').forEach(el => {
        el.classList.remove('playlist-active', 'bg-gray-200', 'border-l-4', 'border-blue-500');
    });

    // Add active class to clicked item
    element.classList.add('playlist-active', 'bg-gray-200', 'border-l-4', 'border-blue-500');

    // Load the selected video
    loadVideo(videoLink);
}

// Load the first video and mark it active by default
document.addEventListener('DOMContentLoaded', function() {
    @if(!$playlists->isEmpty())
        loadVideo('{{ $playlists->first()->video_link }}');

        // Find and highlight the first playlist item
        const firstItem = document.querySelector('.playlist-item');
        if (firstItem) {
            firstItem.classList.add('playlist-active', 'bg-gray-200', 'border-l-4', 'border-blue-500');
        }
    @endif
});
</script>
@endsection