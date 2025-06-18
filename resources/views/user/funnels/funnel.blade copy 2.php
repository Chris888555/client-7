@extends('layouts.funnel')

@section('title', 'Sales Funnel')

@section('content')
@foreach ($funnel->blocks->sortBy('sort_order') as $block)
@if (!$block->is_active)
@continue
@endif

@php
$content = is_array($block->content) ? $block->content : json_decode($block->content, true);
@endphp



<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://www.youtube.com/iframe_api"></script>

@if ($block->block_name === 'hero')
<section class="w-full pt-14 pb-1 px-4 sm:px-8" id="video-wrapper-{{ $block->id }}" data-video="{{ $content['video_url'] ?? '' }}">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-gray-600 text-3xl sm:text-4xl font-bold mb-4">{{ $content['headline'] ?? '' }}</h1>
        <p class="text-lg sm:text-xl mb-6">{{ $content['subheadline'] ?? '' }}</p>

        @if(($content['video_type'] ?? '') === 'youtube')
    {{-- YOUTUBE VIDEO --}}
    <div class="mt-6">
        <div class="bg-red-500 text-white text-center p-4 shadow-lg border-t border-x rounded-t-2xl">
            <h2 class="text-xl sm:text-2xl text-gray-100 font-bold mb-2 flex items-center justify-center gap-2">
                <svg class="h-6 w-6 text-gray-100" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="8" x2="12" y2="12" />
                    <line x1="12" y1="16" x2="12.01" y2="16" />
                </svg>
                Don't Miss This!
            </h2>
            <p class="text-[13px] sm:text-lg text-gray-100">Watch The Video Now To Discover All The Details!</p>
        </div>
    </div>
    <div class="p-2 bg-white border-gray-200 shadow-[0_15px_40px_rgba(8,_112,_184,_0.3)] rounded-b-2xl">
        <div class="w-full aspect-video overflow-hidden">
            <iframe id="youtube-iframe" width="100%" height="100%" class="rounded-2xl"
                src="{{ $content['video_url'] }}?enablejsapi=1" title="Sales Funnel Video" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>
    </div>
@else
    {{-- MP4 VIDEO WITH THUMBNAIL + PLAY OVERLAY --}}
    <div class="relative aspect-video w-full overflow-hidden rounded-2xl">
       <img id="video-thumbnail" src="{{ $thumbnailUrl }}" class="absolute top-0 left-0 w-full h-full object-cover z-0" alt="Video Thumbnail" />
        <div id="video-overlay" class="absolute top-0 left-0 w-full h-full bg-black/50 flex items-center justify-center z-10 cursor-pointer">
            <div id="play-button">
                <img src="https://d1yei2z3i6k35z.cloudfront.net/1841686/6849e177d93fd_Sybbex.png"
                    class="w-[40px] sm:w-[80px]" alt="Play Icon" />
            </div>
        </div>
        <div id="video-click-layer" class="absolute top-0 left-0 w-full h-full z-20 cursor-pointer"></div>
        <video id="video-player" class="w-full h-full object-cover z-30 rounded-2xl" preload="none">
            <source src="{{ $content['video_url'] ?? '' }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
@endif






        <div class="mt-10">
            <a href="{{ $content['cta_link'] ?? '#' }}"
                class="inline-block px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-lg font-semibold rounded-full shadow-lg hover:from-indigo-600 hover:to-blue-600 transition duration-300 ease-in-out transform hover:scale-105">
                {{ $content['cta_text'] ?? 'Click Here' }}
            </a>
        </div>

    </div>
</section>










@endif
@endforeach

@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const video = document.getElementById('video-player');
    const overlay = document.getElementById('video-overlay');
    const playIcon = document.getElementById('play-button');
    const clickLayer = document.getElementById('video-click-layer');
    const thumbnail = document.getElementById('video-thumbnail');
    const youtubeIframe = document.getElementById('youtube-iframe');

    let userCookie = localStorage.getItem('user_cookie');
    if (!userCookie) {
        userCookie = 'user_' + Math.random().toString(36).substr(2, 9);
        localStorage.setItem('user_cookie', userCookie);
        console.log('[Init] Generated user_cookie:', userCookie);
    } else {
        console.log('[Init] Found user_cookie:', userCookie);
    }

   const wrapper = document.querySelector('[id^="video-wrapper-"]');
const videoUrl = wrapper?.dataset.video ?? '';
console.log('Video URL:', videoUrl);


    
    const pageLink = "{{ $funnel->page_link ?? '' }}";
    const username = "{{ $funnel->user->name ?? '' }}";

    let progressInterval;
    let maxProgress = 0;

    // ✅ MP4 VIDEO LOGIC
    if (video && overlay && playIcon && clickLayer && thumbnail) {
        function toggleVideo() {
            if (video.paused) {
                video.play();
            } else {
                video.pause();
            }
        }

        overlay.addEventListener('click', toggleVideo);
        clickLayer.addEventListener('click', toggleVideo);

        video.addEventListener('play', () => {
            console.log('[Event] Video play triggered');
            overlay.style.display = 'none';
            playIcon.style.display = 'none';
            thumbnail.style.display = 'none';

            sendProgressToBackend(0, 0); // first save

            startMP4Tracking();
        });

        video.addEventListener('pause', () => {
            console.log('[Event] Video paused');
            overlay.style.display = 'flex';
            playIcon.style.display = 'block';
            thumbnail.style.display = 'block';
            clearInterval(progressInterval);
        });

        function startMP4Tracking() {
            progressInterval = setInterval(() => {
                const duration = video.duration || 1;
                const progress = video.currentTime / duration;
                maxProgress = Math.max(maxProgress, progress);
                console.log('[Tracking] Current progress:', progress.toFixed(2), '% | Max:', maxProgress.toFixed(2), '%');
                sendProgressToBackend(progress, maxProgress);
            }, 1000);
        }
    }

    // ✅ FUNCTION TO SAVE DATA
    function sendProgressToBackend(progress, maxProgress) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        if (!csrfToken) {
            console.error('[Error] CSRF token missing.');
            return;
        }

        fetch('{{ route('video.progress.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
          body: JSON.stringify({
            user_cookie: userCookie,
            video_url: videoUrl, // <-- ito ang tama
            page_link: pageLink,
            username: username,
            progress: progress,
            max_watch_percentage: maxProgress
        })


        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            console.log('[Success] Server Response:', data);
        })
        .catch(error => {
            console.error('[Fetch Error]', error);
        });
    }

    // ✅ YOUTUBE LOGIC
    if (youtubeIframe) {
    if (playIcon) playIcon.style.display = 'none';

    let ytPlayer;
    let ytInterval;
    let ytMaxProgress = 0;
    let ytStarted = false;

    // 👇 Make sure this runs immediately
    function onYouTubeIframeAPIReady() {
        console.log('[YT] Iframe API Ready');

        ytPlayer = new YT.Player('youtube-iframe', {
            events: {
                'onStateChange': function (event) {
                    console.log('[YT] Player state changed:', event.data);

                    if (event.data === YT.PlayerState.PLAYING) {
                        if (!ytStarted) {
                            ytStarted = true;
                            sendProgressToBackend(0, 0);
                            console.log('[YT] Started tracking');
                        }

                        ytInterval = setInterval(() => {
                            const currentTime = ytPlayer.getCurrentTime();
                            const duration = ytPlayer.getDuration() || 1;
                            const progress = currentTime / duration;
                            ytMaxProgress = Math.max(ytMaxProgress, progress);

                            console.log('[YT] Progress:', progress.toFixed(2), '| Max:', ytMaxProgress.toFixed(2));

                            sendProgressToBackend(progress, ytMaxProgress);
                        }, 1000);
                    }

                    if (event.data === YT.PlayerState.PAUSED || event.data === YT.PlayerState.ENDED) {
                        clearInterval(ytInterval);
                        console.log('[YT] Paused or Ended');
                    }
                }
            }
        });
    }

    // 👇 Inject the API
    if (!window.YT) {
        const tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        document.head.appendChild(tag);
        window.onYouTubeIframeAPIReady = onYouTubeIframeAPIReady;
    } else {
        onYouTubeIframeAPIReady();
    }
}

</script>
@endsection
