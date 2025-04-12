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
                    class="w-10 h-10 md:w-16 md:h-16 opacity-90 transition transform hover:scale-110 mb-9"
                    onclick="playVideo()">
            </div>
        </div>

        <p class="text-sm text-gray-300 rounded-lg mt-6">
            Ready to start your business? Click the button below to sign up for FREE.
        </p>




        <a href="{{ $user->facebook_link }}" class="mt-4 inline-block bg-yellow-500 text-gray-800 font-bold py-4 px-10 rounded-lg shadow-lg hover:bg-yellow-400 transition capitalize  
           text-lg px-6 py-3 md:text-2xl md:px-8 md:py-4 lg:text-3xl lg:px-10 lg:py-4 w-[80%] sm:w-[60%] text-center">


            Get Your Free Slot
            <span class="block text-sm font-normal text-gray-700">Message me now here</span>
        </a>

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
    <div class="w-full flex justify-center sm:w-[700px] m-auto">
        <a href="{{ $user->join_fb_group }}" class="mt-4 inline-block bg-yellow-500 text-gray-800 font-bold py-4 px-10 rounded-lg shadow-lg hover:bg-yellow-400 transition capitalize  
            text-lg px-6 py-3 md:text-2xl md:px-8 md:py-4 lg:text-3xl lg:px-10 lg:py-4 w-[80%] sm:w-[60%] text-center">
            Join Messenger Group
            <span class="block text-sm font-normal text-gray-700">Click To Join Group Chat</span>
        </a>
    </div>
    @endif

    @if($user->page_toggle == 1)
    <div class="w-full flex justify-center sm:w-[700px] m-auto">
        <a href="{{ $user->page_link }}" class="mt-4 inline-block bg-yellow-500 text-gray-800 font-bold py-4 px-10 rounded-lg shadow-lg hover:bg-yellow-400 transition capitalize  
            text-lg px-6 py-3 md:text-2xl md:px-8 md:py-4 lg:text-3xl lg:px-10 lg:py-4 w-[80%] sm:w-[60%] text-center">
            Creat Your Free Account
            <span class="block text-sm font-normal text-gray-700">Click Here Now</span>
        </a>
    </div>
    @endif
</div>


    <footer class="bg-gray-800 text-gray-400 py-10">
        <div class="container mx-auto text-center">
            <p class="text-sm">
                Â© 2025 <a href="https://www.businessforhome.com" class="hover:underline">Sybbex Team Ph</a>. All Rights
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
    // MP4 Analytics Script
    const video = document.getElementById('custom-video');
    const playButton = document.getElementById('play-button');
    const youtubeVideo = document.getElementById('youtube-video');

    // Function to get the cookie value by name
    function getCookie(name) {
        let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        return match ? match[2] : null;
    }

    // Function to set a cookie if not already set
    function setCookie(name, value, days) {
        const d = new Date();
        d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000)); // Set cookie expiration
        const expires = "expires=" + d.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/"; // Set cookie
    }

    // Retrieve the user_cookie from the browser or set a new one if not present
    let userCookie = getCookie('user_cookie');
    if (!userCookie) {
        userCookie = 'user_' + Math.random().toString(36).substr(2, 9); // Generate unique user_cookie
        setCookie('user_cookie', userCookie, 365); // Store cookie for 1 year
    }

    let progressInterval;
    let maxProgress = 0; // Variable to track the highest progress

    if (video) {
        playButton.style.display = 'flex'; // Ensure play button is visible for MP4 videos

        video.addEventListener('play', () => {
            playButton.style.display = 'none'; // Hide play button when video starts playing
            trackProgress(); // Start tracking video progress
        });

        video.addEventListener('pause', () => {
            playButton.style.display = 'flex'; // Show play button when video is paused
            clearInterval(progressInterval); // Stop tracking progress when paused
        });

        // Function to play the video when the play button is clicked
        function playVideo() {
            video.play(); // Play the video
            playButton.style.display = 'none'; // Hide the play button
        }

        // Track the video progress
        function trackProgress() {
            progressInterval = setInterval(() => {
                const progress = (video.currentTime / video.duration) * 100; // Calculate progress as percentage
                maxProgress = Math.max(maxProgress, progress); // Update max progress
                sendProgressToBackend(progress, maxProgress); // Send progress to the backend
            }, 1000); // Send progress every second
        }

        // Function to send progress to the backend
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
                    max_watch_percentage: maxProgress // Send max watch percentage
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

</body>

</html>