@extends('layouts.funnel')

@section('title', 'Thank You')

@section('content')
<div class="container mx-auto px-4 py-20 text-center">

 <!-- Floating Download Button -->
<button id="downloadBtn" 
    class="fixed top-5 right-5 bg-gradient-to-br from-purple-600 to-pink-500 text-white px-5 py-3 rounded-full shadow-2xl hover:scale-105 transform transition-all duration-300 z-50 flex items-center gap-3 animate-pulse">
    
    <!-- Font Awesome Icon -->
    <i class="fas fa-download text-lg"></i>
    
        <span class="font-semibold text-sm">Download</span>
    </button>


    <!-- Thank You Card -->
    <div id="thankYouCard" class="max-w-lg mx-auto bg-white rounded-2xl shadow-lg p-10">

        <!-- Success Icon -->
        <svg class="w-16 h-16 mx-auto text-green-500 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>

        <h2 class="text-3xl font-bold mb-4 text-gray-800">Thank You!</h2>
        <p class="text-gray-600 mb-6">
            Your order has been successfully placed. <br>
            We will process it and notify you once it’s confirmed.
        </p>

    

        @if($order)
        <!-- Orderer Details -->
        <div class="bg-gray-50 border rounded-lg p-6 mb-4 text-left">
            <h3 class="text-lg font-semibold mb-3">Orderer Details</h3>
            <p><strong>Full Name:</strong> {{ $order->full_name }}</p>
            <p><strong>Mobile:</strong> {{ $order->mobile }}</p>
            <p><strong>Address:</strong> {{ $order->address }}</p>
        </div>

        <!-- Package Summary -->
        <div class="bg-gray-50 border rounded-lg p-6 mb-4 text-left">
            <h3 class="text-lg font-semibold mb-3">Package Summary</h3>
            <p><strong>Package Name:</strong> {{ $order->package_name }}</p>
            <p><strong>Price:</strong> ₱{{ number_format($order->package_price, 2) }}</p>
        </div>

        <!-- Payment Method Details -->
        <div class="bg-gray-50 border rounded-lg p-6 mb-6 text-left">
            <h3 class="text-lg font-semibold mb-3">Payment Method</h3>
            <p><strong>Method:</strong> {{ $order->payment_method_name }}</p>
            <p><strong>Account Name:</strong> {{ $order->payment_account_name }}</p>
            <p><strong>Account Number:</strong> {{ $order->payment_account_number }}</p>
        </div>
        @endif

        <!-- Note Section -->
        <div class="bg-yellow-100 border-l-4 border-yellow-400 text-yellow-700 p-4 mb-6 text-left rounded-lg">
            <p class="font-semibold">Note:</p>
            <p>Please message the admin in Messenger so your account can be processed immediately.</p>
        </div>

       <!-- Messenger Button -->
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ $buttons['messenger_btn'] }}" target="_blank"
            class="flex items-center gap-2 px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition transform hover:scale-105 duration-200 shadow-md">
                <!-- Font Awesome Messenger Icon -->
                <i class="fab fa-facebook-messenger text-lg"></i>
                <span class="font-medium">Message Admin</span>
            </a>
        </div>


    </div>
</div>

<!-- html2canvas -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
document.getElementById('downloadBtn').addEventListener('click', function() {
    const capture = document.getElementById('thankYouCard');

    html2canvas(capture, {scale: 2, useCORS: true}).then(canvas => {
        const link = document.createElement('a');
        link.download = 'thank-you-card.png';
        link.href = canvas.toDataURL('image/png');
        link.click();
    });
});
</script>
@endsection
