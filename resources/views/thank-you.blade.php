<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-50">
    <div class="max-w-4xl mx-auto px-6 py-10">

        <a href="{{ route('shop', ['subdomain' => $subdomain]) }}"
            class="bg-white text-indigo-600 font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-gray-100 transition absolute top-0 right-0 m-4">
            ← Back to Shop
        </a>
        <!-- Thank You Message -->
        <div
            class=" flex flex-col items-center sm:flex-row sm:items-center sm:justify-start text-green-600 text-3xl font-bold mb-6 mt-10 md:mt-0">
            <svg class="h-12 w-12 text-green-500 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                <polyline points="22 4 12 14.01 9 11.01" />
            </svg>
            <span class="text-center sm:text-left">Thank You for Your Order!</span>

        </div>

        <!-- <p class="text-green-500 text-xl mb-4 text-center sm:text-left">
    <strong>Order #:{{ $checkout->id }}</strong> 
</p> -->




        <!-- Order Summary Card -->
        <div class="bg-white p-6 rounded-lg shadow-[inset_0px_3px_34px_1px_#00000024] border-2 border-gray-300">
            <!-- Order Details -->
            <h3 class="text-xl font-semibold mb-4">Order Summary</h3>

            <div class="space-y-4 border-b pb-4">
               @php
    $cartData = json_decode($checkout->cart_data, true);
    $grandTotal = $cartData['grand_total'] ?? 0;
    unset($cartData['grand_total']);
    $cartItems = $cartData['cart'] ?? []; // Ensure we target the correct 'cart' array
@endphp

@foreach($cartItems as $item)
    <div class="flex items-center space-x-4 border rounded-lg p-3">
        <img src="{{ $item['image'] ?? 'default_image_url.jpg' }}" class="w-16 h-16 object-cover rounded"
            alt="{{ $item['name'] }}">
        <div class="flex-grow">
            <p class="font-semibold">{{ $item['name'] }}</p>
            <p class="text-sm text-gray-600">Price: <span class="font-bold">₱{{ number_format($item['totalPrice'], 2) }}</span></p>
            <p class="text-sm text-gray-600">Shipping: <span class="font-bold">₱{{ number_format($item['shippingFee'] ?? 0, 2) }}</span></p>
            <p class="text-sm text-gray-600">Quantity: <span class="font-bold">{{ $item['quantity'] }}</span></p>
        </div>
    </div>
@endforeach

            </div>

            <!-- Grand Total -->
            <div class="mt-4 text-lg font-bold text-gray-700 flex justify-start gap-4">
                <span>Grand Total:</span>
                <span class="text-red-500">₱{{ number_format($grandTotal, 2) }}</span>
            </div>
        </div>

        <!-- Customer Information Section -->
        <div class="mt-6 bg-white p-6 rounded-lg shadow-[inset_0px_3px_34px_1px_#00000024] border-2 border-gray-300">
            <h3 class="text-xl font-semibold mb-4">Customer Information</h3>
            <p><strong>Name:</strong> {{ $checkout->first_name }} {{ $checkout->last_name }}</p>
            <p><strong>Phone:</strong> {{ $checkout->phone }}</p>
            <p><strong>Address:</strong> {{ $checkout->address }}, {{ $checkout->barangay }}, {{ $checkout->city }},
                {{ $checkout->state }}, Zip: {{ $checkout->zip_code }}</p>
        </div>


        <!-- Proof of Payment -->
        <!-- <div class="mt-6 bg-white p-6 rounded-lg shadow-[inset_0px_3px_34px_1px_#00000024] border-2 border-gray-300">
            <h3 class="text-xl font-semibold mb-4">Proof of Payment</h3>
            @if($checkout->proof_of_payment)
                <img src="{{ asset('storage/' . $checkout->proof_of_payment) }}" class="w-40 h-40 object-cover mt-2" alt="Proof of Payment">
            @else
                <p class="text-sm text-gray-600">No proof of payment uploaded.</p>
            @endif
        </div>
    </div> -->

        <div class="flex justify-center  mt-8">
            <a href="{{ $user->facebook_link }}" target="_blank" id="contact-us-btn"
                class="inline-block w-full max-w-xs md:max-w-md z-50">
                <button
                    class="w-full flex items-center justify-center bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded-md shadow space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 24 24">
                        <path
                            d="M12 2C6.486 2 2 6.262 2 11.5c0 2.511 1.084 4.789 2.938 6.469V22l2.703-1.484c1.056.29 2.184.449 3.359.449 5.514 0 10-4.262 10-9.5S17.514 2 12 2zm.244 13.469-2.547-2.578-4.422 2.578 5.875-6.047 2.547 2.578 4.422-2.578-5.875 6.047z" />
                    </svg>
                    <span>Contact Seller</span>
                </button>
            </a>
        </div>

        <div class="flex justify-center mt-4 mb-16">
            <a href="{{ $user->join_fb_group }}" target="_blank" id="contact-us-btn"
                class="inline-block w-full max-w-xs md:max-w-md z-50">
                <button
                    class="w-full flex items-center justify-center bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded-md shadow space-x-2">
                    <!-- Material Icons: Group -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 24 24">
                        <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 
                5s-3 1.34-3 3 1.34 3 3 3zm-8 
                0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 
                5 5 6.34 5 8s1.34 3 3 3zm0 
                2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 
                0c-.29 0-.62.02-.97.05 1.16.84 
                1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />
                    </svg>
                    <span>Join Fb Group</span>
                </button>
            </a>
        </div>


</body>

</html>