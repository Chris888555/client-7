<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://www.youtube.com/iframe_api"></script>

    @vite(['resources/css/app.css'])

    <title>Sales Funnel 24/7</title>


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


        <h1
            class="text-[35px] leading-[40px] sm:leading-[50px] sm:text-5xl font-bold text-yellow-400 capitalize font-[Roboto]">
            {{ $user->headline }}</h1>

        <p class="text-2xl sm:text-3xl text-gray-200 mt-2 capitalize">{{ $user->subheadline }}
        </p>

        <!-- <p class="text-base sm:text-lg text-[#38e6d6] mt-2 italic font-[Lato]">
            No Inviting, No Selling, Daily Passive Income, Daily Payout
        </p> -->
    </div>

    <div class="max-w-3xl w-full text-center mx-auto p-2">
        <div class="mt-6">
            <div
                class="bg-blue-600 text-white text-center p-4 shadow-lg border-t border-x border-blue-700 rounded-t-2xl">
                <h2 class="text-2xl font-bold mb-2 flex items-center justify-center gap-2">
                    <svg class="h-6 w-6 text-yellow-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    Don't Miss This!
                </h2>
                <p class="text-[13px] sm:text-lg">Watch The Video Now To Discover All The Details!</p>
            </div>
        </div>


        <div class="relative w-full">
            @php
            $isMp4 = Str::endsWith($user->video_link, '.mp4');
            @endphp

            @if ($isMp4)
            <!-- Show MP4 Video -->
            <video id="custom-video" controls
                class="w-full border-x-8 border-b-8 border-gray-200 shadow-[0_15px_40px_rgba(8,_112,_184,_0.3)] rounded-b-2xl"
                poster="http://127.0.0.1:8000/storage/marketing_image/mgyZOswCeGIk46PQheD0HQpgnn6GrL1sJif8owCD.jpg">
                <source src="{{ $user->video_link }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            @else


            <!-- Show YouTube Embed -->
            <div id="youtube-video"
                class="w-full aspect-video border-x-8 border-b-8 border-gray-200 shadow-[0_15px_40px_rgba(8,_112,_184,_0.3)] rounded-b-2xl overflow-hidden">
                <iframe id="youtube-iframe" width="100%" height="100%" src="{{ $user->video_link }}?enablejsapi=1"
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

        <p class="text-sm text-gray-300 rounded-lg mt-6">
            Ready to start your business? Click the button below to sign up and start earning.
        </p>



        <!--For Messenger Link Button -->
        <!-- <a href="{{ $user->facebook_link }}" class="mt-4 inline-block bg-yellow-500 text-gray-800 font-bold py-4 px-10 rounded-lg shadow-lg hover:bg-yellow-400 transition capitalize  
           text-lg px-6 py-3 md:text-2xl md:px-8 md:py-4 lg:text-3xl lg:px-10 lg:py-4 w-[80%] sm:w-[60%] text-center">


       Message Me Here
            <span class="block text-sm font-normal text-gray-700">Click Here To Message Us Now</span>
        </a> -->

        <!--For Referral Link Button -->
        @if($user->page_toggle == 1)
        <div class="w-full flex justify-center sm:w-[700px] m-auto">
            <a href="{{ $user->page_link }}" class="mt-4 inline-block bg-yellow-500 text-gray-800 font-bold py-4 px-10 rounded-lg shadow-lg hover:bg-yellow-400 transition capitalize  
            text-lg px-6 py-3 md:text-2xl md:px-8 md:py-4 lg:text-3xl lg:px-10 lg:py-4 w-[80%] sm:w-[60%] text-center">
                Reserve Your Slot Now
                <span class="block text-sm font-normal text-gray-700">Click Here Now To Reserve Your Slot</span>
            </a>
        </div>
        @endif

    </div>


    <div class="w-full pl-10 pr-10 max-w-[700px] space-y-6 m-auto mb-10 mt-10">
        <h2 class="text-[25px] font-bold text-white text-center">Why a Sales Funnel Is the Best Strategy</h2>
        <div class="bg-white pl-10 pr-10 pt-5 pb-5 rounded-lg shadow-md flex items-center relative">
            <div
                class="absolute -left-5 top-1/2 transform -translate-y-1/2 bg-yellow-600 text-white text-2xl font-bold px-4 py-2 rounded-lg">
                1</div>
            <div>
                <h2 class="text-lg font-bold">24/7 Lead Generation </h2>
                <p class="text-sm text-gray-600">Your funnel works around the clock — capturing leads and driving sales
                    even while you sleep.</p>
            </div>
        </div>
        <div class="bg-white pl-10 pr-10 pt-5 pb-5 rounded-lg shadow-md flex items-center relative">
            <div
                class="absolute -right-5 top-1/2 transform -translate-y-1/2 bg-purple-600 text-white text-2xl font-bold px-4 py-2 rounded-lg">
                2</div>
            <div>
                <h2 class="text-lg font-bold">More Freedom</h2>
                <p class="text-sm text-gray-600">Say goodbye to manual follow-ups. Your funnel automates the sales
                    process so you can focus on growing your business.
                </p>
            </div>
        </div>
        <div class="bg-white pl-10 pr-10 pt-5 pb-5 rounded-lg shadow-md flex items-center relative">
            <div
                class="absolute -left-5 top-1/2 transform -translate-y-1/2 bg-green-600 text-white text-2xl font-bold px-4 py-2 rounded-lg">
                3</div>
            <div>
                <h2 class="text-lg font-bold">Boost Conversions Like a Pro</h2>
                <p class="text-sm text-gray-600">Designed to guide visitors step-by-step, turning cold traffic into hot
                    buyers — without the tech overwhelm.</p>
            </div>
        </div>
    </div>



    @if($user->group_toggle == 1)
    <div class="w-full flex justify-center sm:w-[700px] m-auto mb-8">
        <a href="{{ $user->join_fb_group }}" class="mt-4 inline-block bg-yellow-500 text-gray-800 font-bold py-4 px-10 rounded-lg shadow-lg hover:bg-yellow-400 transition capitalize  
            text-lg px-6 py-3 md:text-2xl md:px-8 md:py-4 lg:text-3xl lg:px-10 lg:py-4 w-[80%] sm:w-[60%] text-center">
            Join Messenger Group
            <span class="block text-sm font-normal text-gray-700">Click To Join Group Chat</span>
        </a>
    </div>
    @endif


    </div>


    <footer class="bg-gray-800 text-gray-400 py-10">
        <div class="container mx-auto text-center">
            <p class="text-sm">
                © 2025 <a href="https://www.businessforhome.com" class="hover:underline">BusinessForHome</a>. All Rights
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
            const videoLink = "{{ $user->video_link }}";
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
        const videoLink = "{{ $user->video_link }}";
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
            <a href="{{ $user->facebook_link }}" target="_blank"
                class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded-full">
                Message us on Messenger
            </a>
        </div>

    </div>



</body>

</html>