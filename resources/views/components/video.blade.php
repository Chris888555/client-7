<!-- Carousel Wrapper -->
<div class="testimonial-videos owl-carousel owl-theme bg-black py-10 px-6 rounded-t-xl">
    @foreach($funnel_content['testimonial_video_link'] ?? [] as $video_link)
        <div class="video-item relative flex justify-center items-center rounded-xl overflow-hidden">
            @if (strpos($video_link, '.mp4') !== false)
                <video class="video-player" controls>
                    <source src="{{ asset($video_link) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @else
                @php
                    preg_match('/(?:https?:\/\/(?:www\.)?youtube\.com\/(?:v\/|watch\?v=)|youtu\.be\/)([A-Za-z0-9_-]{11})/', $video_link, $matches);
                    $video_id = $matches[1] ?? null;
                @endphp

                @if($video_id)
                    <iframe class="video-player" 
                        src="https://www.youtube.com/embed/{{ $video_id }}?rel=0&showinfo=0" 
                        frameborder="0" allowfullscreen></iframe>
                @else
                    <p class="text-white text-center">Invalid video link</p>
                @endif
            @endif
        </div>
    @endforeach
</div>

<!-- Controls -->
<div class="carousel-controls text-center pb-6 bg-black rounded-b-xl">
     <button class="prev-slide bg-gray-800 p-2 rounded-full hover:bg-gray-700 transition">
            <svg class="h-8 w-8 text-slate-50" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <polyline points="12 8 8 12 12 16" />
                <line x1="16" y1="12" x2="8" y2="12" />
            </svg>
        </button>

        <button class="next-slide bg-blue-600 p-2 rounded-full hover:bg-blue-500 transition">
            <svg class="h-8 w-8 text-slate-50" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <circle cx="12" cy="12" r="9" />
                <line x1="16" y1="12" x2="8" y2="12" />
                <line x1="16" y1="12" x2="12" y2="16" />
                <line x1="16" y1="12" x2="12" y2="8" />
            </svg>
        </button>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
    $(document).ready(function () {
       var owl = $('.testimonial-videos').owlCarousel({
    center: true,
    items: 3,
    loop: true,
    margin: 30,
    dots: true, // ✅ this makes sure dots are shown
    responsive: {
        0: {
            items: 1,
            stagePadding: 40
        },
        768: {
            items: 2
        },
        1024: {
            items: 3
        }
    }
});


        $('.prev-slide').click(() => owl.trigger('prev.owl.carousel'));
        $('.next-slide').click(() => owl.trigger('next.owl.carousel'));

        owl.on('changed.owl.carousel', function () {
            $('.testimonial-videos .owl-item').each(function () {
                const item = $(this);
                const video = item.find('.video-player');
                if (item.hasClass('center')) {
                    video.addClass('scale-up');
                } else {
                    video.removeClass('scale-up');
                }
            });
        });
    });
</script>

<style>
/* Container per video */
/* Item wrapper for each video */
.video-item {
    width: 100%;
    padding: 10px;
    background: #111;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

/* Shared styles for iframe and video */
.video-player {
    width: 100%;
    height: auto;
    aspect-ratio: 16 / 9;
    max-height: 350px;
    object-fit: contain;
    border-radius: 12px;
    transition: all 0.4s ease;
    box-shadow: none;
    pointer-events: auto;
}

/* Style only for center item (visual highlight) */
.owl-item.center .video-player {
    box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
    outline: 3px solid rgba(255, 255, 255, 0.2);
    z-index: 10;
}

/* Responsive for smaller screens */
@media (max-width: 768px) {
    .video-player {
        max-height: 250px;
    }
}
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

.owl-dot.active {
    background: #fff;
}

</style>