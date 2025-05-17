<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

  {{-- Vite for Tailwind and local assets --}}
    @vite('resources/css/app.css')
    
<body>
    

    <style>
        /* Custom Styles */
        .welcome-text {
            font-size:30px; /* 20px */
            font-weight: bold;
            background: linear-gradient(to bottom right, #16a34a, #3b82f6); /* Green to Blue gradient */
            -webkit-background-clip: text;
            color: transparent;
            margin-bottom: 1rem;
            margin-top: 20px;
        }

        .modern-trading-text {
            font-size: 20px; /* 18px */
            font-weight: bold;
            color: #4b5563; /* Gray color */
            margin-bottom: 1rem;
        }

        .main-paragraph {
            font-size: 15px; /* 32px */
            color: #4b5563; /* Gray color */
            margin-bottom: 1.5rem;
        }

        /* Responsive Design */
        @media screen and (min-width: 640px) {
            .welcome-text {
                font-size: 45px; /* 60px */
            }

            .modern-trading-text {
                font-size: 30px; /* 32px */
            }

            .main-paragraph {
                font-size: 20px; /* 80px */
            }
        }
    </style>

@include('includes.main-header')

<body class="text-gray-900 flex flex-col min-h-screen">

    <!-- Main Content Wrapper -->
    <main class="flex-grow flex flex-col items-center justify-center mt-[10%]">
        <div class="p-8 w-full max-w-4xl text-center">
        
            <!-- Custom Selector for the Welcome Header -->
            <h2 class="welcome-text">
                Welcome to NutriInnovations
            </h2>

            <!-- Custom Selector for the Modern Trading Header -->
            <h2 class="modern-trading-text">
                New Opportunity for Everyone
            </h2>

            <!-- Custom Selector for the Paragraph Text -->
            <p class="main-paragraph">
                NutriInnovations is your partner in discovering groundbreaking opportunities in health and wellness. Our mission is to provide innovative solutions that empower individuals to achieve better health and live more fulfilling lives. Join us in creating a future full of opportunity and growth.
            </p>
           
        </div>
    </main>

    @include('includes.footer')

</body>

</html>
