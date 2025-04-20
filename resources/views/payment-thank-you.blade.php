<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css'])

    <title>Thank You</title>

</head>
<body>
    

<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-gray-100 to-white px-4">
    <div class="bg-white px-10 py-12 rounded-2xl shadow-xl text-center max-w-lg w-full border border-gray-200">
        <div class="mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-500 mx-auto" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2l4 -4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
            </svg>
        </div>
        <h1 class="text-3xl font-extrabold text-green-600 mb-3">Slot Reserved Successfully!</h1>
        <p class="text-gray-600 text-base leading-relaxed mb-6">
            Thank you for taking the first step towards something great. <br>
            If you have any questions, feel free to reach out to us.
        </p>


        <div class="text-sm text-yellow-600 bg-yellow-100 p-4 rounded-lg mb-6 flex items-center gap-2 justify-center">
            Your payment will be reviewed by the admin. Please wait for confirmation or message us nowhhhj.
        </div>

        <a href="{{ $user->facebook_link }}" target="_blank"
            class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm md:text-base px-4 py-2 md:px-6 md:py-3 rounded-full shadow transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                <path
                    d="M12 2C6.48 2 2 6.1 2 11.02c0 2.86 1.58 5.38 4.1 7.08v3.9l3.76-2.06c.7.18 1.43.28 2.14.28 5.52 0 10-4.1 10-9.18S17.52 2 12 2zm.13 12.99l-2.18-2.32-4.32 2.32 5.34-5.71 2.18 2.32 4.32-2.32-5.34 5.71z" />
            </svg>
            Message Us on Messenger
        </a>
    </div>
</div>
</body>
</html>
