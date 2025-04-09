
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    @vite(['resources/css/app.css'])
</head>



<body class="bg-gray-100 flex items-center justify-center min-h-screen px-2">
    <div class="bg-white p-8 rounded-lg shadow-md w-[90%] max-w-[400px] mx-auto">
        <h2 class="text-2xl font-bold text-center mb-4">Forgot Password</h2>

         <!-- Alert Message -->
        @if ($errors->any())
        <div id="alert-message"
            class="mt-4 flex w-full overflow-hidden bg-yellow-50 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)] dark:bg-yellow-800">
            <div class="flex items-center justify-center w-12 bg-yellow-500">
                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
                </svg>
            </div>

            <div class="px-4 py-2 -mx-3">
                <div class="mx-3">
                    <span class="font-semibold text-yellow-500 dark:text-yellow-400">Alert</span>
                    <p class="text-sm text-gray-600 dark:text-gray-200">
                        @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span><br>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>

        <script>
        // Hide the alert message after 10 seconds
        setTimeout(function() {
            document.getElementById('alert-message').style.display = 'none';
        }, 10000);
        </script>
        @endif

        <form action="{{ route('password.check') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-gray-700">Enter your registered email:</label>
                <input type="email" id="email" name="email" required class="w-full p-2 border rounded-md">
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">
                Continue
            </button>
        </form>
    </div>
</body>
</html>
