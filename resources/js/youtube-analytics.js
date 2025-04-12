
let ytPlayer = null;
let ytProgressInterval;
let ytMaxProgress = 0;

// Create player after API is ready
function onYouTubeIframeAPIReady() {
    ytPlayer = new YT.Player('youtube-iframe', {
        events: {
            'onStateChange': onPlayerStateChange
        }
    });
}

function onPlayerStateChange(event) {
    if (event.data === YT.PlayerState.PLAYING) {
        trackYTProgress(); // Start tracking when video plays
    } else {
        clearInterval(ytProgressInterval); // Stop tracking if paused or ended
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
