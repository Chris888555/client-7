<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Funnel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .funnel-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        h1, h2, p {
            margin: 20px 0;
        }
        .video-container {
            margin-top: 20px;
        }
        .testimonial-images img {
            width: 100px;
            height: 100px;
            margin: 10px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="funnel-container">
        <!-- Headline -->
        <h1>{{ $funnel_content['headline'] ?? 'Default Headline' }}</h1>
        
        <!-- Subheadline -->
        <h2>{{ $funnel_content['subheadline'] ?? 'Default Subheadline' }}</h2>

        <!-- Video Section -->
        <div class="video-container">
            <a href="{{ $funnel_content['video_link'] ?? '#' }}" target="_blank">
                Watch the video: Click Here
            </a>
        </div>

        <!-- Testimonial Section -->
        <div class="testimonial-container">
            <h3>{{ $funnel_content['testimonial_headline'] ?? 'Default Testimonial Headline' }}</h3>
            <p>{{ $funnel_content['testimonial_subheadline'] ?? 'Default Testimonial Subheadline' }}</p>
            
            <div class="testimonial-images">
                @foreach($funnel_content['testimonial_images'] ?? [] as $image)
                    <img src="{{ asset('images/' . $image) }}" alt="Testimonial Image">
                @endforeach
            </div>

            <div class="testimonial-videos">
                @foreach($funnel_content['testimonial_video_link'] ?? [] as $video_link)
                    <a href="{{ $video_link }}" target="_blank">Watch Testimonial Video</a><br>
                @endforeach
            </div>
        </div>

        <!-- FOMO Countdown -->
        <div class="fomo-countdown">
            <h4>Offer Countdown</h4>
            <p>{{ $funnel_content['fomo_countdown']['days'] ?? 0 }} Days</p>
            <p>{{ $funnel_content['fomo_countdown']['hours'] ?? 0 }} Hours</p>
            <p>{{ $funnel_content['fomo_countdown']['minutes'] ?? 0 }} Minutes</p>
        </div>

        <!-- Messenger, Referral, and Group Links -->
        <div class="links">
            @if($funnel_content['Messenger_link_toggle'] ?? false)
                <p><a href="{{ $funnel_content['Messenger_link'] }}" target="_blank">Message Us on Messenger</a></p>
            @endif
            @if($funnel_content['Referral_link_toggle'] ?? false)
                <p><a href="{{ $funnel_content['Referral_link'] }}" target="_blank">Join Referral Program</a></p>
            @endif
            @if($funnel_content['Group_chat_link_toggle'] ?? false)
                <p><a href="{{ $funnel_content['Group_chat_link'] }}" target="_blank">Join Our Group Chat</a></p>
            @endif
        </div>
    </div>
</body>
</html>
