<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css'])
</head>

@include('includes.nav')

<body class="bg-gray-100">
      <div class="container w-full mt-0 mb-0 m-auto p-4 sm:p-8">
        <!-- Welcome Section -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-3xl font-semibold text-blue-900">Welcome, {{ Auth::user()->name }}!</h1>
            <p class="mt-4 text-lg text-gray-700">
                We're excited to have you as a part of our community! You can now start sharing your sales funnel link
                with your clients to educate them about your offer—automated 24/7.
            </p>
        </div>

        <!-- Funnel Link Section -->
        <div class="bg-white p-6 mt-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-blue-900">Your Sales Funnel Link</h2>
            <p class="mt-4 text-lg text-gray-700">
                Simply click the button below to go to the next page where you can copy your sales funnel link and share
                it with your clients:
            </p>
            <div class="flex items-center mt-4 space-x-2">
                <!-- Redirect Button to the next page -->
                <a href="{{ route('funnel.main') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-center">
                    Go to Sales Funnel
                </a>
            </div>
            <p class="mt-2 text-sm text-gray-600">Share this link with your clients to educate them about your offer automatically—24/7.</p>
        </div>

        <!-- Lead Collection and Follow-up Section -->
        <div class="bg-white p-6 mt-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold text-blue-900">Educate and Convert</h3>
            <p class="mt-4 text-lg text-gray-700">
                Once you've shared your link, your clients can learn about your offers at any time of the day, 24/7.
                Use this tool to build trust and convert interest into real opportunities.
            </p>
        </div>
    </div>

    <script>
    function copyLink() {
        // Dynamically generate the sales funnel link using the route
        const funnelLink = "{{ url('create-landing-page/' . Auth::user()->subdomain) }}";

        // Create an input to select and copy the link
        const input = document.createElement('input');
        input.value = funnelLink;
        document.body.appendChild(input);
        input.select();
        input.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text to clipboard
        document.execCommand('copy');
        document.body.removeChild(input);

        // Provide feedback to the user
        alert('Sales funnel link copied to clipboard!');
    }
    </script>
</body>

</html>
