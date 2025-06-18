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

@if ($block->block_name === 'hero')
<section class="w-full pt-14 pb-1 px-4 sm:px-8">
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const video = document.getElementById('video-player');
    const overlay = document.getElementById('video-overlay');
    const playIcon = document.getElementById('play-button');
    const clickLayer = document.getElementById('video-click-layer');
    const thumbnail = document.getElementById('video-thumbnail');

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

        video.addEventListener('pause', () => {
            overlay.style.display = 'flex';
            playIcon.style.display = 'block';
            thumbnail.style.display = 'block'; // Show thumbnail again if needed
        });

        video.addEventListener('play', () => {
            overlay.style.display = 'none';
            playIcon.style.display = 'none';
            thumbnail.style.display = 'none'; // Hide thumbnail
        });
    }
});
</script>



        <div class="mt-10">
            <a href="{{ $content['cta_link'] ?? '#' }}"
                class="inline-block px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-lg font-semibold rounded-full shadow-lg hover:from-indigo-600 hover:to-blue-600 transition duration-300 ease-in-out transform hover:scale-105">
                {{ $content['cta_text'] ?? 'Click Here' }}
            </a>
        </div>

    </div>
</section>


@elseif ($block->block_name === 'countdown')
<section class="py-10 text-center">
    <h2 class="text-xl md:text-2xl font-extrabold mb-2 text-gray-600 tracking-tight">{{ $content['title'] ?? '' }}</h2>
    <p class="text-sm md:text-base text-gray-600 mb-4">{{ $content['subtitle'] ?? '' }}</p>

    <div id="countdown" class="flex justify-center gap-3 md:gap-5 text-center text-sm md:text-base font-semibold">
        <div class="flex flex-col items-center">
            <div class="bg-gradient-to-r from-red-600 to-red-500 shadow text-white px-3 py-2 rounded-lg text-lg md:text-xl" id="days">00</div>
            <div class="text-xs text-gray-700 mt-1 uppercase tracking-wide">Days</div>
        </div>
        <div class="flex flex-col items-center">
            <div class="bg-gradient-to-r from-red-600 to-red-500 shadow text-white px-3 py-2 rounded-lg text-lg md:text-xl" id="hours">00</div>
            <div class="text-xs text-gray-700 mt-1 uppercase tracking-wide">Hours</div>
        </div>
        <div class="flex flex-col items-center">
            <div class="bg-gradient-to-r from-red-600 to-red-500 shadow text-white px-3 py-2 rounded-lg text-lg md:text-xl" id="minutes">00</div>
            <div class="text-xs text-gray-700 mt-1 uppercase tracking-wide">Minutes</div>
        </div>
        <div class="flex flex-col items-center">
            <div class="bg-gradient-to-r from-red-600 to-red-500 shadow text-white px-3 py-2 rounded-lg text-lg md:text-xl" id="seconds">00</div>
            <div class="text-xs text-gray-700 mt-1 uppercase tracking-wide">Seconds</div>
        </div>
    </div>
</section>


<script>
document.addEventListener("DOMContentLoaded", function() {
    let time = ({{ $content['days'] ?? 0 }} * 86400) +
               ({{ $content['hours'] ?? 0 }} * 3600) +
               ({{ $content['minutes'] ?? 0 }} * 60) +
               ({{ $content['seconds'] ?? 0 }});

    let dEl = document.getElementById("days");
    let hEl = document.getElementById("hours");
    let mEl = document.getElementById("minutes");
    let sEl = document.getElementById("seconds");

    function updateCountdown() {
        if (time <= 0) {
            dEl.textContent = hEl.textContent = mEl.textContent = sEl.textContent = "00";
            return;
        }

        const d = Math.floor(time / 86400);
        const h = Math.floor((time % 86400) / 3600);
        const m = Math.floor((time % 3600) / 60);
        const s = time % 60;

        dEl.textContent = String(d).padStart(2, '0');
        hEl.textContent = String(h).padStart(2, '0');
        mEl.textContent = String(m).padStart(2, '0');
        sEl.textContent = String(s).padStart(2, '0');

        time--;
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
});
</script>


@elseif ($block->block_name === 'features')
<section class="py-10 bg-gray-100 text-center">
    <h2 class="text-xl md:text-2xl font-extrabold mb-8 text-gray-600 tracking-tight">{{ $content['title'] ?? '' }}</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 max-w-6xl mx-auto px-3">
        @foreach ($content['items'] ?? [] as $item)
        <div class="bg-white p-4 md:p-5 rounded-xl shadow-md hover:shadow-lg transition duration-200 text-left">
            <h3 class="flex items-center gap-2 text-base md:text-lg font-semibold text-gray-800">
                <span class="material-icons text-teal-600 text-lg md:text-xl">verified</span>
                {{ $item['title'] ?? '' }}
            </h3>
            <p class="text-sm md:text-base text-gray-600 mt-1">{{ $item['description'] ?? '' }}</p>
        </div>
        @endforeach
    </div>
</section>



@elseif ($block->block_name === 'testimonials')
<section class="py-10 px-4 text-center ">
  <h2 class="text-xl md:text-2xl font-extrabold mb-8 text-gray-600 tracking-tight">{{ $content['title'] ?? '' }}</h2>
  
  <div class="max-w-3xl mx-auto space-y-4 md:space-y-6">
    @foreach ($content['testimonials'] ?? [] as $t)
    <div class="bg-gradient-to-r from-teal-50 to-white p-5 rounded-2xl shadow-md border border-teal-200">
      <p class="italic text-gray-700 text-sm md:text-base leading-relaxed">“{{ $t['feedback'] ?? '' }}”</p>
      <p class="font-semibold text-teal-700 mt-3 text-sm md:text-base">- {{ $t['name'] ?? '' }}</p>
    </div>
    @endforeach
  </div>
</section>


@elseif ($block->block_name === 'faq')
<section class="py-10 ">
    <h2 class="text-xl md:text-2xl font-extrabold mb-8 text-gray-600 tracking-tight text-center">
        {{ $content['title'] ?? '' }}
    </h2>

    <div class="max-w-3xl mx-auto px-4 space-y-3">
        @foreach ($content['questions'] ?? [] as $index => $q)
        <div x-data="{ open: false }" class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
            <button 
                @click="open = !open" 
                class="w-full flex justify-between items-center px-4 py-3 text-left text-sm md:text-base font-semibold text-gray-800 hover:bg-gray-100 transition">
                <span>{{ $q['q'] ?? '' }}</span>
                <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 transform transition-transform text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" x-collapse class="px-4 pb-4 text-sm md:text-base text-gray-700">
                {{ $q['a'] ?? '' }}
            </div>
        </div>
        @endforeach
    </div>
</section>

@elseif ($block->block_name === 'footer')
<section class="py-10 mt-20 bg-gray-100 border-t border-gray-300 text-center px-4">
    <div class="max-w-5xl mx-auto space-y-3">
        <p class="text-sm text-gray-600">
            {{ $content['text'] ?? '' }}
        </p>
        <p class="text-xs text-gray-500 leading-relaxed">
            {{ $content['disclaimer'] ?? '' }}
        </p>
    </div>
</section>


@elseif ($block->block_name === 'messengerbtn')
<!-- Floating Messenger Button + Card -->
<div x-data="{ open: false }" class="fixed bottom-5 right-5 z-50 flex flex-col items-end space-y-2">

    <!-- Floating Card -->
    <div x-show="open" x-transition x-cloak
         @click.away="open = false"
         class="w-64 mb-2 bg-white rounded-xl shadow-xl p-4 text-center text-sm border border-blue-200">
        <h2 class="text-lg font-semibold mb-3 text-gray-800">Need Help?</h2>
        <a href="{{ $content['btn_link'] ?? '#' }}"
           class="inline-block bg-blue-600 text-white font-semibold px-4 py-2 rounded shadow hover:bg-blue-700 transition">
            {{ $content['btn_text'] ?? 'Click Here' }}
        </a>
    </div>

    <!-- Toggle Button -->
    <button @click="open = !open" 
        class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full shadow-lg transition">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2C6.48 2 2 6.01 2 10.5c0 2.54 1.34 4.81 3.52 6.33v3.15c0 .43.45.7.83.51l3.58-1.79c.67.11 1.36.17 2.07.17 5.52 0 10-4.01 10-8.5S17.52 2 12 2z" />
        </svg>
    </button>
</div>



@endif
@endforeach

@endsection