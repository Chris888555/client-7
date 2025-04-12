
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
    playButton.style.display = 'flex';  // Ensure play button is visible for MP4 videos

    video.addEventListener('play', () => {
        playButton.style.display = 'none'; // Hide play button when video starts playing
        trackProgress();  // Start tracking video progress
    });

    video.addEventListener('pause', () => {
        playButton.style.display = 'flex'; // Show play button when video is paused
        clearInterval(progressInterval);  // Stop tracking progress when paused
    });

    // Function to play the video when the play button is clicked
    function playVideo() {
        video.play();  // Play the video
        playButton.style.display = 'none'; // Hide the play button
    }

    // Track the video progress
    function trackProgress() {
        progressInterval = setInterval(() => {
            const progress = (video.currentTime / video.duration) * 100;  // Calculate progress as percentage
            maxProgress = Math.max(maxProgress, progress);  // Update max progress
            sendProgressToBackend(progress, maxProgress);  // Send progress to the backend
        }, 1000); // Send progress every second
    }

    // Function to send progress to the backend
    function sendProgressToBackend(progress, maxProgress) {
        const videoLink = "{{ $user->video_link }}"; // Get the video link from Laravel Blade
        const subdomain = "{{ $user->subdomain }}"; // Get the user's subdomain from Laravel Blade

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

// If it's a YouTube video, hide the play button (no play button needed for YouTube)
if (youtubeVideo) {
    playButton.style.display = 'none'; // Hide the play button for YouTube videos
}

