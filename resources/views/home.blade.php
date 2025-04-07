<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/app.css'])

    <title>Home</title>
    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
</head>

@include('includes.main-header')

<body class="bg-gray-100 text-gray-900 flex flex-col min-h-screen">

    <!-- Main Content Wrapper -->
    <main class="flex-grow flex flex-col items-center justify-center mt-[10%]">
        <div class="p-8 w-full max-w-4xl text-center">
        
            <!-- Custom Selector for the Welcome Header -->
            <h2 class="welcome-text">
                Welcome to Sybbex Team Philippines
            </h2>

            <!-- Custom Selector for the Modern Trading Header -->
            <h2 class="modern-trading-text">
                Modern Trading for Smart Investors
            </h2>

            <!-- Custom Selector for the Paragraph Text -->
            <p class="main-paragraph">
                Sybbex is your guide to the latest technology and smart solutions in trading. Our innovative solutions are designed to meet the needs of the most sophisticated investors. Trust our team of professional traders with your finances and see that smart investing is the key to achieving your financial goals.
            </p>
           
        </div>
    </main>

    @include('includes.footer')

</body>

</html>
