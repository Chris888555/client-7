@extends('layouts.app')

@section('title', 'Academy | Video Playlist')

@section('content')

@include('includes.nav')


<!-- Main Content Section -->
<main class="container m-auto p-4 sm:p-8 max-w-full">
    <h1 class="text-2xl md:text-3xl font-bold text-left">Our Academy</h1>
    <p class="text-gray-600 text-left mb-4">Explore our training programs to level up your skills and unlock new
        opportunities for success.</p>


    <!-- Check if playlists are available -->
    @if($playlists->isEmpty())
    <div class="w-full flex items-center flex-wrap justify-center gap-10 border boder-gray-300 rounded-lg p-4">
        <div class="grid gap-4 w-60">
            <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" width="128" height="124" viewBox="0 0 128 124"
                fill="none">
                <g filter="url(#filter0_d_14133_718)">
                    <path
                        d="M4 61.0062C4 27.7823 30.9309 1 64.0062 1C97.0319 1 124 27.7699 124 61.0062C124 75.1034 119.144 88.0734 110.993 98.3057C99.7572 112.49 82.5878 121 64.0062 121C45.3007 121 28.2304 112.428 17.0071 98.3057C8.85599 88.0734 4 75.1034 4 61.0062Z"
                        fill="#F9FAFB" />
                </g>
                <path
                    d="M110.158 58.4715H110.658V57.9715V36.9888C110.658 32.749 107.226 29.317 102.986 29.317H51.9419C49.6719 29.317 47.5643 28.165 46.3435 26.2531L46.342 26.2509L43.7409 22.2253L43.7404 22.2246C42.3233 20.0394 39.8991 18.7142 37.2887 18.7142H20.8147C16.5749 18.7142 13.1429 22.1462 13.1429 26.386V57.9715V58.4715H13.6429H110.158Z"
                    fill="#EEF2FF" stroke="#A5B4FC" />
                <path
                    d="M49 20.2142C49 19.6619 49.4477 19.2142 50 19.2142H106.071C108.281 19.2142 110.071 21.0051 110.071 23.2142V25.6428H53C50.7909 25.6428 49 23.8519 49 21.6428V20.2142Z"
                    fill="#A5B4FC" />
                <circle cx="1.07143" cy="1.07143" r="1.07143" transform="matrix(-1 0 0 1 36.1429 23.5)"
                    fill="#4F46E5" />
                <circle cx="1.07143" cy="1.07143" r="1.07143" transform="matrix(-1 0 0 1 29.7144 23.5)"
                    fill="#4F46E5" />
                <circle cx="1.07143" cy="1.07143" r="1.07143" transform="matrix(-1 0 0 1 23.2858 23.5)"
                    fill="#4F46E5" />
                <path
                    d="M112.363 95.459L112.362 95.4601C111.119 100.551 106.571 104.14 101.323 104.14H21.8766C16.6416 104.14 12.0808 100.551 10.8498 95.4592C10.8497 95.4591 10.8497 95.459 10.8497 95.459L1.65901 57.507C0.0470794 50.8383 5.09094 44.4286 11.9426 44.4286H111.257C118.108 44.4286 123.166 50.8371 121.541 57.5069L112.363 95.459Z"
                    fill="white" stroke="#E5E7EB" />
                <path
                    d="M65.7893 82.4286C64.9041 82.4286 64.17 81.6945 64.17 80.7877C64.17 77.1605 58.686 77.1605 58.686 80.7877C58.686 81.6945 57.9519 82.4286 57.0451 82.4286C56.1599 82.4286 55.4258 81.6945 55.4258 80.7877C55.4258 72.8424 67.4302 72.8639 67.4302 80.7877C67.4302 81.6945 66.6961 82.4286 65.7893 82.4286Z"
                    fill="#4F46E5" />
                <path
                    d="M79.7153 68.5462H72.9358C72.029 68.5462 71.2949 67.8121 71.2949 66.9053C71.2949 66.0201 72.029 65.286 72.9358 65.286H79.7153C80.6221 65.286 81.3562 66.0201 81.3562 66.9053C81.3562 67.8121 80.6221 68.5462 79.7153 68.5462Z"
                    fill="#4F46E5" />
                <path
                    d="M49.9204 68.546H43.1409C42.2341 68.546 41.5 67.8119 41.5 66.9051C41.5 66.0198 42.2341 65.2858 43.1409 65.2858H49.9204C50.8056 65.2858 51.5396 66.0198 51.5396 66.9051C51.5396 67.8119 50.8056 68.546 49.9204 68.546Z"
                    fill="#4F46E5" />
                <circle cx="107.929" cy="91.0001" r="18.7143" fill="#EEF2FF" stroke="#E5E7EB" />
                <path
                    d="M115.161 98.2322L113.152 96.2233M113.554 90.1965C113.554 86.6461 110.676 83.7679 107.125 83.7679C103.575 83.7679 100.697 86.6461 100.697 90.1965C100.697 93.7469 103.575 96.6251 107.125 96.6251C108.893 96.6251 110.495 95.9111 111.657 94.7557C112.829 93.5913 113.554 91.9786 113.554 90.1965Z"
                    stroke="#4F46E5" stroke-width="1.6" stroke-linecap="round" />
                <defs>
                    <filter id="filter0_d_14133_718" x="2" y="0" width="124" height="124" filterUnits="userSpaceOnUse"
                        color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                            result="hardAlpha" />
                        <feOffset dy="1" />
                        <feGaussianBlur stdDeviation="1" />
                        <feComposite in2="hardAlpha" operator="out" />
                        <feColorMatrix type="matrix"
                            values="0 0 0 0 0.0627451 0 0 0 0 0.0941176 0 0 0 0 0.156863 0 0 0 0.05 0" />
                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_14133_718" />
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_14133_718" result="shape" />
                    </filter>
                </defs>
            </svg>
            <div>
                <h2 class="text-center text-black text-base font-semibold leading-relaxed pb-1">No data found
                </h2>

            </div>
        </div>
    </div>
    @else

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($playlists as $playlist)
        <!-- Video Card -->

        <div class="bg-white rounded-lg shadow-[rgba(0,_0,_0,_0.24)_0px_3px_8px] overflow-hidden p-[10px]">
            <!-- Thumbnail Wrapper (Only this gets overlay) -->
            <div class="relative group cursor-pointer" onclick="openModal('{{ $playlist->video_link }}')">
                <!-- Thumbnail Image -->
                @if($playlist->thumbnail_url)
                <img src="{{ asset('storage/' . $playlist->thumbnail_url) }}" alt="{{ $playlist->title }}"
                    class="w-full h-auto object-cover ">
                @else
                <img src="https://via.placeholder.com/150" alt="No Thumbnail" class="w-full h-auto object-cover">
                @endif

                <!-- Play Button Overlay (Appears on Hover) -->
                <div
                    class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30 opacity-0 group-hover:opacity-100 transition-opacity">
                    <svg class="h-12 w-12 text-white opacity-90 hover:opacity-100 transition-all" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <!-- Video Title (Outside the Overlay, Inside the Card) -->
            <div class="p-4">
                <h3 class="text-xl font-semibold text-gray-900 flex items-center gap-2">
                    <svg class="h-6 w-6 text-violet-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18" />
                        <line x1="7" y1="2" x2="7" y2="22" />
                        <line x1="17" y1="2" x2="17" y2="22" />
                        <line x1="2" y1="12" x2="22" y2="12" />
                        <line x1="2" y1="7" x2="7" y2="7" />
                        <line x1="2" y1="17" x2="7" y2="17" />
                        <line x1="17" y1="17" x2="22" y2="17" />
                        <line x1="17" y1="7" x2="22" y2="7" />
                    </svg>
                    {{ $playlist->title }}
                </h3>

                <!-- Reaction Buttons -->
                <div class="flex items-center gap-4 mt-3">
                    <!-- Heart (Love) Reaction -->
                    <button class="flex items-center gap-1 text-gray-600 hover:text-red-500 transition">
                        <svg class="h-6 w-6 text-red-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path d="M12 20l-7 -7a4 4 0 0 1 6.5 -6a.9 .9 0 0 0 1 0a4 4 0 0 1 6.5 6l-7 7" />
                        </svg>
                        <span class="text-sm">Love</span>
                    </button>

                    <!-- Like Reaction -->
                    <button class="flex items-center gap-1 text-gray-600 hover:text-blue-500 transition">
                        <svg class="h-6 w-6 text-blue-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path
                                d="M7 11v8a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-7a1 1 0 0 1 1 -1h3a4 4 0 0 0 4 -4v-1a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 3 0 0 1 -2 2h-7a3 3 0 0 1 -3 -3" />
                        </svg>
                        <span class="text-sm">Like</span>
                    </button>
                </div>
            </div>


        </div>
        @endforeach
    </div>
    @endif
    </div>

    <!-- Modal -->
    <div id="videoModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-75 hidden">
        <!-- Close Button -->


        <button id="closeModal" class="absolute top-[32px] right-8 text-gray-600 hover:text-gray-900 text-2xl z-50">
            <svg class="h-8 w-8 text-yellow-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                <line x1="9" y1="9" x2="15" y2="15" />
                <line x1="15" y1="9" x2="9" y2="15" />
            </svg>
        </button>



        <!-- Video Container -->
        <div
            class="bg-white rounded-lg overflow-hidden relative w-[90%] max-w-3xl mx-auto shadow-[0_20px_50px_rgba(8,_112,_184,_0.7)]">

            <div class="p-2">
                <div class="relative" style="padding-top: 56.25%;">
                    <iframe id="videoIframe" class="absolute top-0 left-0 w-full h-full" frameborder="0"
                        allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
        </div>
</main>

<script>
function isYouTube(url) {
    return /(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/.test(url);
}

function getYouTubeEmbedURL(url) {
    var matches = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/);
    return matches && matches[1] ? "https://www.youtube.com/embed/" + matches[1] + "?autoplay=0" : url;
}

function openModal(videoLink) {
    const modal = document.getElementById('videoModal');
    const iframe = document.getElementById('videoIframe');
    const embedUrl = isYouTube(videoLink) ? getYouTubeEmbedURL(videoLink) : videoLink;

    iframe.src = embedUrl;
    modal.classList.remove('hidden');
}

function closeModal() {
    const modal = document.getElementById('videoModal');
    const iframe = document.getElementById('videoIframe');
    iframe.src = '';
    modal.classList.add('hidden');
}

document.getElementById('closeModal').addEventListener('click', closeModal);

window.addEventListener('click', function(event) {
    const modal = document.getElementById('videoModal');
    if (event.target === modal) {
        closeModal();
    }
});
</script>
@endsection