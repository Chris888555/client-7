<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://www.youtube.com/iframe_api"></script>

    @vite(['resources/css/app.css'])

    <title>Landing Page 24/7</title>


    <style>
    body {
        background: url('https://dw8.site/client-test/uploads%2FUntitled%20design%20%282%29.jpg') no-repeat center center fixed;
        background-size: 100% 100%;
        min-height: 100vh;
        width: 100%;
    }

    #custom-video::-webkit-media-controls {
        display: none !important;
    }

    #custom-video {
        cursor: pointer;
        /* shows hand icon when hovering */
    }
    </style>
</head>

<body class="pt-0">
    <div class=" w-full sm:max-w-[900px] p-6 text-center mx-auto mt-2 sm:mt-10">




      <h1 class="text-[35px] leading-[40px] sm:leading-[50px] sm:text-5xl font-bold text-yellow-400 first-letter:uppercase font-[Roboto]">
    {{ $landing_page_content	['headline'] ?? 'Default Headline' }}
</h1>

<p class="text-2xl sm:text-3xl text-gray-200 mt-2 first-letter:uppercase">
    {{ $landing_page_content	['subheadline'] ?? 'Default Subheadline' }}
</p>

        
       
       
    </div>

    <div class="max-w-3xl w-full text-center mx-auto p-2">
        <div class="mt-6">
            <div
                class="bg-blue-500 text-white text-center p-4 shadow-lg border-t border-x border-blue-400 rounded-t-2xl">
                <!-- <h2 class="text-2xl font-bold mb-2 flex items-center justify-center gap-2">
                    <svg class="h-6 w-6 text-yellow-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    Don't Miss This!
                </h2> -->
                <p class="text-[13px] sm:text-lg">Watch The Video Now To Discover All The Details!</p>
            </div>
        </div>


        <div class="relative w-full">
           @php
            $isMp4 = Str::endsWith($landing_page_content	['video_link'], '.mp4');
            @endphp

           @if ($isMp4)
                <!-- Show MP4 Video -->
                <video id="custom-video" controls
                    class="w-full border-x-8 border-b-8 border-blue-400 border-blue-500 shadow-[0_15px_40px_rgba(8,_112,_184,_0.3)] rounded-b-2xl"
                    poster="{{ $landing_page_content	['video_thumbnail'] }}">
                    <source src="{{ $landing_page_content	['video_link'] }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @else



            <!-- Show YouTube Embed -->
            <div id="youtube-video"
                class="w-full aspect-video border-x-8 border-b-8 border-blue-500 shadow-[0_15px_40px_rgba(8,_112,_184,_0.3)] rounded-b-2xl overflow-hidden">
                <iframe id="youtube-iframe" width="100%" height="100%" src="{{ $landing_page_content	['video_link'] }}?enablejsapi=1"
                    title="Sales Funnel Video" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>

            </div>
            @endif


            <!-- Play Button for only mp4 video, hide this to the youtube video -->
            <div id="play-button" class="absolute inset-0 flex items-center justify-center cursor-pointer">
                <img src="https://d1yei2z3i6k35z.cloudfront.net/1841686/67e55a7e66930_Sybbex.png" alt="Play Button"
                    class=" mt-4 w-12 h-12 md:w-16 md:h-16 opacity-90 transition transform hover:scale-110 mb-9"
                    onclick="playVideo()">
            </div>
        </div>
    </div>


 

<script>
    // Get dynamic countdown data from the server
    const days = {{ $landing_page_content['fomo_countdown']['days'] ?? 0 }};
    const hours = {{ $landing_page_content['fomo_countdown']['hours'] ?? 0 }};
    const minutes = {{ $landing_page_content['fomo_countdown']['minutes'] ?? 0 }};
    const seconds = 0; // Start from zero seconds for countdown

    // Convert the current countdown data into a future target timestamp
    const now = new Date();
    const targetDate = new Date(now.getTime() + (days * 24 * 60 * 60 * 1000) + (hours * 60 * 60 * 1000) + (minutes * 60 * 1000) + (seconds * 1000));

    // Function to update the countdown
    function updateCountdown() {
        const currentTime = new Date();
        const timeRemaining = targetDate - currentTime;

        if (timeRemaining <= 0) {
            document.getElementById("days").textContent = "00";
            document.getElementById("hours").textContent = "00";
            document.getElementById("minutes").textContent = "00";
            document.getElementById("seconds").textContent = "00";
            return;
        }

        // Calculate remaining days, hours, minutes, and seconds
        const remainingDays = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
        const remainingHours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const remainingMinutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
        const remainingSeconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

        // Update the HTML elements with the calculated values
        document.getElementById("days").textContent = remainingDays < 10 ? "0" + remainingDays : remainingDays;
        document.getElementById("hours").textContent = remainingHours < 10 ? "0" + remainingHours : remainingHours;
        document.getElementById("minutes").textContent = remainingMinutes < 10 ? "0" + remainingMinutes : remainingMinutes;
        document.getElementById("seconds").textContent = remainingSeconds < 10 ? "0" + remainingSeconds : remainingSeconds;
    }

    // Update the countdown every second
    setInterval(updateCountdown, 1000);
</script>



<section class="bg-green-50 py-4 px-0 md:px-12 mt-[-120px] sm:mt-[-150px]">
  <div class="relative max-w-4xl mx-auto text-center rounded-xl pb-10 pt-[130px] sm:pt-[190px] px-6">
    
   <!-- Arrow Container Positioned at Bottom -->
<div class="absolute bottom-0 left-0 right-0 mb-[150px] flex justify-between px-[20px] z-10">
  <!-- Left Arrow -->
  <div class="w-[100px] h-[100px] lg:!ml-[150px] overflow-hidden">
    <img src="/assets/images/left-arrow.png" 
         alt="Left Arrow" 
         class="w-full h-full object-cover">
  </div>

  <!-- Right Arrow -->
  <div class="w-[100px] h-[100px] lg:!mr-[150px] overflow-hidden">
    <img src="/assets/images/right-arrow.png" 
         alt="Right Arrow" 
         class="w-full h-full object-cover">
  </div>
</div>



        <p class="text-xl md:text-2xl font-semibold text-gray-800 mb-4">
  {{ $landing_page_content['intro_headline'] }}
</p>
<p class="text-md text-gray-600 mb-8 max-w-2xl mx-auto">
  {{ $landing_page_content['intro_paragraph'] }}
</p>

<!-- Benefits List -->
<h2 class="text-2xl md:text-3xl font-bold text-green-800 mb-6">
  {{ $landing_page_content['benefits_title'] }}
</h2>

@php
    $benefits = is_array($landing_page_content['benefits_list'] ?? null)
        ? $landing_page_content['benefits_list']
        : explode(',', $landing_page_content['benefits_list'] ?? '');
@endphp

<ul class="text-lg text-green-900 space-y-4 text-left max-w-xl mx-auto mb-16">
  @foreach($benefits as $benefit)
    <li class="flex">
      <span class="w-6 flex-shrink-0 mr-2">✔</span>
      <span class="block">{{ trim($benefit) }}</span>
    </li>
  @endforeach
</ul>
   
    <!-- FOMO Countdown -->
<div class="fomo-countdown text-center p-4  text-white mt-6">
    
    <div class="flex justify-center space-x-2 sm:space-x-3 md:space-x-4">
        <!-- Days -->
        <div class="count-box bg-yellow-400 p-2 rounded-md shadow w-20 sm:w-20 md:w-16">
            <p id="days" class="text-xl font-bold">{{ $landing_page_content	['fomo_countdown']['days'] ?? 0 }}</p>
            <p class="text-xs">Days</p>
        </div>
        <!-- Hours -->
        <div class="count-box bg-blue-400 p-2 rounded-md shadow w-20 sm:w-20 md:w-16">
            <p id="hours" class="text-xl font-bold">{{ $landing_page_content	['fomo_countdown']['hours'] ?? 0 }}</p>
            <p class="text-xs">Hours</p>
        </div>
        <!-- Minutes -->
        <div class="count-box bg-green-400 p-2 rounded-md shadow w-20 sm:w-20 md:w-16">
            <p id="minutes" class="text-xl font-bold">{{ $landing_page_content	['fomo_countdown']['minutes'] ?? 0 }}</p>
            <p class="text-xs">Minutes</p>
        </div>
        <!-- Seconds -->
        <div class="count-box bg-red-400 p-2 rounded-md shadow w-20 sm:w-20 md:w-16">
            <p id="seconds" class="text-xl font-bold">00</p>
            <p class="text-xs">Seconds</p>
        </div>
    </div>
</div>

<!-- Custom CSS for Smaller Display -->
<style>
    .count-box {
        width: 64px; /* base width for desktop */
        padding: 8px;
    }

    .count-box p {
        font-size: 1.25rem; /* 20px */
        line-height: 1.2;
    }

    .count-box p.text-xs {
        font-size: 0.75rem; /* 12px */
    }

    @media (max-width: 640px) {
        .count-box {
            width: 56px !important;
            padding: 6px !important;
        }

        .count-box p {
            font-size: 1rem !important; /* 16px */
        }

        .count-box p.text-xs {
            font-size: 10px !important;
        }
    }

    @media (max-width: 480px) {
        .count-box {
            width: 50px !important;
        }

        .count-box p {
            font-size: 0.875rem !important; /* 14px */
        }

        .count-box p.text-xs {
            font-size: 8px !important;
        }
    }
</style>

<p class="mt-2 text-lg font-semibold text-green-700 flex items-center justify-center gap-2">
  <span class="material-icons text-green-600 text-2xl">check_circle</span>
  Claim your discount today!
</p>


<!-- For Referral Link Button -->

@if($landing_page_content['Referral_link_toggle'] ?? false)
<div class="w-full flex justify-center m-auto">
  <a href="{{ $landing_page_content['Referral_link'] }}" target="_blank"
     class="mt-4 inline-block bg-green-600 text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:bg-green-700 transition capitalize text-base md:text-lg lg:text-xl px-8 py-3 w-full sm:w-[60%] text-center">
    {{ $landing_page_content['Referral_button_text'] }}
    <span class="block text-sm font-normal text-white opacity-90">{{ $landing_page_content['Referral_button_subtext'] }}</span>
  </a>
</div>
@endif

  </div>
</section>

<!-- Wave SVG -->
<svg
  class="w-full h-16 md:h-24 lg:h-32"
  xmlns="http://www.w3.org/2000/svg"
  viewBox="0 0 1440 320"
  preserveAspectRatio="none"
  style="transform: scaleY(-1);"
>
  <path
    d="M0,160L48,176C96,192,192,224,288,224C384,224,480,192,576,181.3C672,171,768,181,864,170.7C960,160,1056,128,1152,138.7C1248,149,1344,203,1392,229.3L1440,256V320H0Z"
    class="fill-green-50 dark:fill-green-50"
  ></path>
</svg>


<!-- Include Owl Carousel CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<div class="testimonial-section  relative mt-8">
    <!-- Headline -->
    <h3 class="text-xl lg:text-4xl font-bold text-center text-gray-200 mb-3 leading-tight  ">
        {{ $landing_page_content['testimonial_headline'] ?? 'What Our Clients Say' }}
    </h3>
    
    <!-- Subheadline -->
    <p class="text-sm lg:text-xl text-center text-gray-300  max-w-2xl mx-auto ">
        {{ $landing_page_content['testimonial_subheadline'] ?? 'Real results from real people' }}
    </p>

    <!-- Testimonial Carousel -->
@if (!empty($landing_page_content['testimonial_images']))
    <div class="owl-carousel testimonial-carousel owl-theme py-8 lg:py-8  ">

        @foreach ($landing_page_content['testimonial_images'] as $img)
            <div class="item">
                <div class="overflow-hidden rounded-xl shadow-lg transition duration-300 ease-in-out transform">
                    <img src="{{ asset($img) }}" alt="Testimonial Image" class="w-full h-auto object-cover">
                </div>
            </div>
        @endforeach
    </div>
@endif

<!-- Include jQuery and Owl Carousel JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


<script>
$(".testimonial-carousel").owlCarousel({
    center: true,
    loop: true,
    margin: 20,
    autoplay: true,
    autoplayTimeout: 4000,
    dots: true,   // Show dots

    responsive: {
        0: {
            items: 1,
            stagePadding: 50,
        },
        768: {
            items: 2,
            stagePadding: 70,
        },
        1024: {
            items: 3,
            stagePadding: 100,
        }
    },
    onInitialized: function () {
        setTimeout(function () {
            $(".testimonial-carousel").trigger("refresh.owl.carousel");
        }, 100);
    }
});

</script>


<style>
   /* REMOVE or COMMENT OUT THIS BLOCK */
.owl-dots {
    display: flex !important;
    justify-content: center;
    margin-top: 20px;
}

.owl-dot {
    width: 12px;
    height: 12px;
    margin: 0 6px;
    border-radius: 50%;
    background: #666;
    transition: background 0.3s;
}


.testimonial-carousel + .owl-dots {
    display: block !important;
    text-align: center;
    margin-top: 20px;
    position: relative;
    z-index: 50;
}



    /* Carousel container ensures no overflow */
    .testimonial-section {
        max-width: 100%; /* Ensure the container doesn't exceed the screen width */
        overflow: hidden; /* Hide any overflow content */
        padding: 0 10px; /* Add padding for responsiveness */
    }

    /* Style for carousel items */
    .testimonial-carousel .item {
        transition: transform 0.4s ease, opacity 0.4s ease;
        opacity: 1; /* Full opacity for all images */
        transform: scale(0.95); /* Side images are slightly smaller */
        padding: 15px; /* Space around items */
        width: 100%; /* Full container width */
        max-width: 100%; /* Prevents overflow */
    }

    /* Style for center images */
.testimonial-carousel .owl-item.center .item {
    transform: scale(1.10); /* Increase from 1.2 or 1.0 to 1.15 for more emphasis */
    opacity: 1;
    z-index: 2;
}

/* Adjust side items to be a bit smaller for better contrast */
.testimonial-carousel .owl-item.active:not(.center) .item {
    transform: scale(0.9);
}


    /* Prevent overflow and maintain image aspect ratio */
    .testimonial-carousel .item img {
        max-width: 100%; /* Ensure images fit within the container */
        height: auto; /* Maintain aspect ratio */
        display: block; /* Prevent inline spacing */
    }
    /* Blur side images */
.testimonial-carousel .owl-item:not(.center) .item img {
    filter: blur(3px);
    transition: filter 0.3s ease;
}

/* Keep center image clear */
.testimonial-carousel .owl-item.center .item img {
    filter: none;
}

</style>

<!--For Group Chat Link Button -->
@if($landing_page_content['Referral_link_toggle'] ?? false)
<div class="w-full md:max-w-4xl flex justify-center m-auto px-4">
  <a href="{{ $landing_page_content['Group_chat_link'] }}" target="_blank"
     class="mt-4 inline-block bg-green-600 text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:bg-green-700 transition capitalize text-base md:text-lg lg:text-xl px-8 py-3 w-full sm:w-[60%] text-center">
    {{ $landing_page_content['Group_chat_button_text'] }}
    <span class="block text-sm font-normal text-white opacity-90">{{ $landing_page_content['Group_chat_button_subtext'] }}</span>
  </a>
</div>
@endif


    </div>


    <footer class="bg-gray-800/20 text-gray-300 py-10 mt-16">

        <div class="container mx-auto text-center">
            <p class="text-sm">
                © 2025 <a href="#" class="hover:underline">NutriInnovations</a>. All Rights
                Reserved.
            </p>
            <p class="text-xs mt-2 px-4">
                This site is not a part of the Facebook website or Facebook Inc. Additionally, this site is not endorsed
                by Facebook in any way.
                <span class="font-semibold">FACEBOOK</span> is a trademark of <span class="font-semibold">FACEBOOK,
                    Inc.</span>
            </p>
        </div>
    </footer>

    <script>
    const video = document.getElementById('custom-video');
    const playButton = document.getElementById('play-button');
    const youtubeVideo = document.getElementById('youtube-video');

    let userCookie = localStorage.getItem('user_cookie');
    if (!userCookie) {
        userCookie = 'user_' + Math.random().toString(36).substr(2, 9);
        localStorage.setItem('user_cookie', userCookie);
    }

    let progressInterval;
    let maxProgress = 0;

    if (video) {
        // Start with play button visible
        playButton.style.display = 'flex';

        // ✅ PLAY via button
        playButton.addEventListener('click', () => {
            video.play();
        });

        // ✅ When video plays, hide play button
        video.addEventListener('play', () => {
            playButton.style.display = 'none';
            trackProgress();
        });

        // ✅ When video pauses, show play button
        video.addEventListener('pause', () => {
            playButton.style.display = 'flex';
            clearInterval(progressInterval);
        });

        // ✅ Clicking the video will pause only (not play)
        video.addEventListener('click', () => {
            if (!video.paused) {
                video.pause();
            }
        });

        function trackProgress() {
            progressInterval = setInterval(() => {
                const progress = (video.currentTime / video.duration) * 100;
                maxProgress = Math.max(maxProgress, progress);
                sendProgressToBackend(progress, maxProgress);
            }, 1000);
        }

        function sendProgressToBackend(progress, maxProgress) {
            const videoLink = "{{ $landing_page_content['video_link'] }}";
            const subdomain = "{{ $user->subdomain }}";

            fetch('/save-video-progress', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    user_cookie: userCookie,
                    video_link: videoLink,
                    subdomain: subdomain,
                    progress: progress,
                    max_watch_percentage: maxProgress
                })
            });
        }
    }

    if (youtubeVideo) {
        playButton.style.display = 'none';
    }
    </script>



    <script>
    // Youtube Analytics Script
    let ytPlayer = null;
    let ytProgressInterval;
    let ytMaxProgress = 0;


    function onYouTubeIframeAPIReady() {
        ytPlayer = new YT.Player('youtube-iframe', {
            events: {
                'onStateChange': onPlayerStateChange
            }
        });
    }

    function onPlayerStateChange(event) {
        if (event.data === YT.PlayerState.PLAYING) {
            trackYTProgress();
        } else {
            clearInterval(ytProgressInterval);
        }
    }

    function trackYTProgress() {
        ytProgressInterval = setInterval(() => {
            const currentTime = ytPlayer.getCurrentTime();
            const duration = ytPlayer.getDuration();
            const progress = (currentTime / duration) * 100;
            ytMaxProgress = Math.max(ytMaxProgress, progress);

            sendYTProgressToBackend(progress, ytMaxProgress);
        }, 1000);
    }

    function sendYTProgressToBackend(progress, maxProgress) {
        const videoLink = "{{ $landing_page_content['video_link'] }}";
        const subdomain = "{{ $user->subdomain }}";

        fetch('/save-video-progress', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                user_cookie: userCookie,
                video_link: videoLink,
                subdomain: subdomain,
                progress: progress,
                max_watch_percentage: maxProgress
            })
        });
    }
    </script>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Include Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Messenger Logo Button & Support Card -->
    <div x-data="{ open: false }" class="fixed bottom-5 right-5 z-50">

        <!-- Button -->
        <button @click="open = !open"
            class="bg-blue-600 text-white p-3 rounded-full shadow-lg flex items-center justify-center">
            <i class="fab fa-facebook-messenger text-white text-xl"></i>
        </button>

        <!-- Card -->
        <div x-show="open" @click.outside="open = false" x-transition
            class="mt-2 bg-white p-5 rounded-lg shadow-lg w-80 absolute bottom-16 right-0 border-4 border-gray-300" style="display: none;">
            <p class="text-gray-800 text-lg">Need help? Message us now on Messenger.</p>
            <a href="{{ $landing_page_content['Messenger_link'] }}" target="_blank"
                class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded-full">
                Message us on Messenger
            </a>
        </div>

    </div>



</body>

</html>