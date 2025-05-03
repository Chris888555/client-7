<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    @vite(['resources/css/app.css'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.2/dist/cdn.min.js" defer></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-50">

    <div class="container mx-auto p-6 space-y-8">
        <!-- Title -->
        <h2 class="text-3xl font-bold text-gray-700 text-left px-4 py-2">Checkout</h2>

        <a href="{{ route('shop', ['subdomain' => request()->route('subdomain')]) }}"
            class="bg-white text-indigo-600 font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-gray-100 transition absolute top-0 right-0 m-4">
            ← Back to Shop
        </a>



        <div class="flex flex-col md:flex-row space-y-8 md:space-y-0 md:space-x-8">
            <!-- Order Summary Section -->
            <div
                class="flex-1 bg-white p-8 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)]">
                <h3 class="text-2xl font-semibold text-gray-700 mb-6">Order Summary</h3>
                <ul id="cart-items" class="space-y-6">
                    <!-- Cart items will be dynamically injected here -->
                </ul>

                <div class="mt-6 border-t pt-4">
                    <p class="text-2xl font-bold text-gray-700">Grand Total: <span id="cart-total"
                            class="text-red-500">₱0.00</span></p>
                </div>
            </div>

            <!-- Checkout Form Section -->
            <div class="flex-1 p-1 ">
                <h1 class="text-gray-700 text-2xl md:text-3xl font-bold text-left">Shipping Information</h1>
    <p class="text-gray-600 text-left mb-4">Fill up the form to place your order and enjoy our special SBG offer. Get your products delivered hassle-free!</p>

                <form id="orderForm" action="{{ route('checkout.store', ['subdomain' => $user->subdomain]) }}"
                    method="POST" enctype="multipart/form-data" class="space-y-6" onsubmit="clearCart(event)">
                    @csrf
                    <input type="hidden" name="cart_data" id="cart-data">

                    <!-- Customer Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                            <input type="text" name="first_name" required
                                class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                            <input type="text" name="last_name" required
                                class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                        <input type="text" name="phone" required
                            class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    

   <div>
    <!-- Region Dropdown -->
    <select id="region" name="region" class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
    <option value="">Select Region</option>
    @foreach($regions as $region)
        <option value="{{ $region['code'] }}">{{ $region['name'] }}</option>
    @endforeach
</select>

</div>


<div>
    <!-- Province Dropdown -->
    <select id="state" name="state" class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <option value="">Select Province</option>
    </select>
</div>

<div>
    <!-- City/Municipality Dropdown -->
    <select id="city" name="city" class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <option value="">Select City/Municipality</option>
    </select>
</div>

<div>
    <!-- Barangay Dropdown -->
    <select id="barangay" name="barangay" class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <option value="">Select Barangay</option>
    </select>
</div>


                    <!-- House Number/Street/Landmark -->
<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">House Number/Street/Land Mark</label>
    <input type="text" name="address" required
        class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
</div>

                 <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Zip Code</label>
        <input type="text" name="zip_code" required
            class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>

 <!-- Payment Option -->
<div>
    <label for="payment-option" class="block text-sm font-medium text-gray-700 mb-2">Choose Payment Option</label>
    <select id="payment-option" name="payment_option" onchange="showPaymentDetails()" required
    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <option value="" disabled selected>Select Payment Method</option>
        @foreach ($paymentMethods as $method)
            <option value="{{ $method->method_name }}">{{ ucfirst($method->method_name) }}</option>
        @endforeach
        <option value="cod">Cash On Delivery</option> <!-- Static COD -->
    </select>
</div>

<!-- Payment Details -->
<div id="payment-details" class="mt-6 text-sm text-gray-700">
    <!-- Dynamic payment details will appear here based on selected option -->
</div>

<!-- Attach Proof of Payment -->
<div id="attach-proof-of-payment" class="mt-6">
    <h3 class="text-xl font-semibold text-gray-800 mb-4">Attach Proof of Payment</h3>
    <div class="flex flex-col items-center space-y-4">
        <div class="relative w-full pt-10 pb-6 bg-white border-2 border-gray-300 border-dashed rounded-md cursor-pointer hover:border-gray-400 focus:outline-none">
            <label class="flex justify-center w-full transition" id="drop">
                <span class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <span class="font-medium text-gray-600">Drop files to Attach, or <span class="text-blue-600 underline">browse</span></span>
                </span>
                <input type="file" name="file_upload" class="hidden" accept="image/png,image/jpeg" id="input">
            </label>
            <!-- File Path (Centered) -->
            <div id="file-path" class="mt-2 text-gray-600 text-sm text-center"></div>
            <!-- Image Preview -->
            <div id="image-preview" class="mt-4"></div>
        </div>
    </div>
</div>

  <script>
$(document).ready(function() {
    // When Region is selected
    $('#region').change(function() {
        var regionCode = $(this).val();
        $('#state').html('<option value="">Loading...</option>');  // Reset state dropdown
        $('#city').html('<option value="">Select City/Municipality</option>');  // Reset city dropdown
        $('#barangay').html('<option value="">Select Barangay</option>');  // Reset barangay dropdown

        if (regionCode) {
            $.get('/provinces/' + regionCode, function(data) {
                var options = '<option value="">Select Province</option>';  // Default option for non-NCR regions
                if (regionCode === '13') {  // Check if region is NCR (Region Code 13)
                    options = '<option value="">Select District</option>';  // Change 'Province' to 'District'
                    $.each(data, function(key, district) {
                        options += '<option value="' + district.code + '">' + district.name + '</option>';
                    });
                } else {
                    // For non-NCR regions, display provinces
                    $.each(data, function(key, province) {
                        options += '<option value="' + province.code + '">' + province.name + '</option>';
                    });
                }
                $('#state').html(options);  // Update the state dropdown with districts or provinces
            });
        }
    });

    // When State (formerly Province or District) is selected
    $('#state').change(function() {
        var stateCode = $(this).val();
        $('#city').html('<option value="">Loading...</option>');  // Reset city dropdown
        $('#barangay').html('<option value="">Select Barangay</option>');  // Reset barangay dropdown

        if (stateCode) {
            if (stateCode === '13') {  // Handle selection for NCR district
                $.get('/districts/' + stateCode + '/cities.json', function(data) {
                    var options = '<option value="">Select City/Municipality</option>';
                    $.each(data, function(key, city) {
                        options += '<option value="' + city.code + '">' + city.name + '</option>';
                    });
                    $('#city').html(options);  // Update city dropdown for NCR
                });
            } else {
                // For non-NCR states, fetch cities from provinces
                $.get('/cities/' + stateCode, function(data) {
                    var options = '<option value="">Select City/Municipality</option>';
                    $.each(data, function(key, city) {
                        options += '<option value="' + city.code + '">' + city.name + '</option>';
                    });
                    $('#city').html(options);  // Update city dropdown
                });
            }
        }
    });

    // When City is selected
    $('#city').change(function() {
        var cityCode = $(this).val();
        $('#barangay').html('<option value="">Loading...</option>');  // Reset barangay dropdown

        if (cityCode) {
            $.get('/barangays/' + cityCode, function(data) {
                var options = '<option value="">Select Barangay</option>';
                $.each(data, function(key, barangay) {
                    options += '<option value="' + barangay.code + '">' + barangay.name + '</option>';
                });
                $('#barangay').html(options);  // Update barangay dropdown
            });
        }
    });
});

</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Ensure the page is fully loaded before attaching event listener

        // Function to show/hide payment proof section
        function showPaymentDetails() {
            const paymentOption = document.getElementById('payment-option').value;
            const proofOfPaymentSection = document.getElementById('attach-proof-of-payment');

            // If COD is selected, hide the Attach Proof of Payment section
            if (paymentOption === 'cod') {
                proofOfPaymentSection.style.display = 'none';
            } else {
                proofOfPaymentSection.style.display = 'block';
            }
        }

        // Attach the onchange event handler to the payment method select dropdown
        document.getElementById('payment-option').addEventListener('change', showPaymentDetails);

        // Initialize the view on page load (to cover the case when the page loads with a preselected value)
        showPaymentDetails();
    });
</script>



                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-gradient-to-br from-indigo-600 to-purple-500 text-white py-3 rounded-lg hover:bg-green-700 transition ease-in-out duration-200 flex items-center justify-center gap-2">
                        <svg class="h-5 w-5 text-slate-50" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14L21 3M21 3L14.5 21a.55 .55 0 0 1-1 0L10 14L3 10.5a.55 .55 0 0 1 0-1L21 3" />
                        </svg>
                        Place Order
                    </button>

                </form>
            </div>
        </div>
    </div>
    <script>
    // Select the input field and the element to show the file path
    const fileInput = document.getElementById('input');
    const filePath = document.getElementById('file-path');

    // Add event listener for when a file is selected
    fileInput.addEventListener('change', function() {
        const file = fileInput.files[0];

        if (file) {
            // Show the file path in red color
            filePath.textContent = `File selected: ${file.name}`;
            filePath.style.color = 'blue'; // Set text color to red
        } else {
            filePath.textContent = ''; // Clear if no file is selected
        }
    });
    </script>

<script>
    const paymentMethods = @json($paymentMethods->pluck('account_name', 'method_name'));
    const paymentNumbers = @json($paymentMethods->pluck('account_number', 'method_name'));
</script>

    <script>
    // Function to show payment details based on selected payment method
     function showPaymentDetails() {
    const paymentOption = document.getElementById('payment-option').value;
    const paymentDetailsDiv = document.getElementById('payment-details');
    paymentDetailsDiv.style.border = '2px dashed #ccc';
    paymentDetailsDiv.style.padding = '16px';
    paymentDetailsDiv.style.borderRadius = '8px';

    if (paymentOption === 'cod') {
        paymentDetailsDiv.innerHTML = `<p>No need to upload payment proof. Pay upon delivery.</p>`;
    } else if (paymentMethods[paymentOption] && paymentNumbers[paymentOption]) {
        paymentDetailsDiv.innerHTML = `
            <p>Account Name: <span class="text-red-500">${paymentMethods[paymentOption]}</span></p>
            <p>Account Number: <span class="text-red-500">${paymentNumbers[paymentOption]}</span></p>
        `;
    } else {
        paymentDetailsDiv.innerHTML = '';
    }
}
    

    // Function to clear cart from sessionStorage when form is submitted
    function clearCart(event) {
        // Prevent the form from submitting immediately
        event.preventDefault();

        // Clear the cart from sessionStorage
        sessionStorage.removeItem('cart');

        // After clearing the cart, submit the form
        document.getElementById('orderForm').submit();
    }

    document.addEventListener("DOMContentLoaded", function() {
        let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
        let cartItemsContainer = document.getElementById('cart-items');
        let cartTotalElement = document.getElementById('cart-total');
        let cartDataInput = document.getElementById('cart-data');

        if (cart.length === 0) {
            cartItemsContainer.innerHTML = "<p class='text-center text-gray-500'>Your cart is empty.</p>";
            return;
        }

        let total = 0;
        cartItemsContainer.innerHTML = '';

        cart.forEach(item => {
            let itemTotal = item.totalPrice + item.shippingFee;
            total += itemTotal;

            cartItemsContainer.innerHTML += `
               <li class="flex items-center border-b pb-4">
                <img src="${item.image}" class="w-20 sm:w-40 h-auto object-cover rounded mr-4" alt="${item.name}">
                <div class="flex-grow">
                    <p class="mb-1 text-[15px] sm:mb-2 sm:text-[20px] font-semibold text-gray-700">${item.name}</p>
                      <p class="text-[15px] sm:text-xl text-gray-600">Prduct Price: <span class="font-bold">&#8369;${item.totalPrice.toLocaleString('en-US', { maximumFractionDigits: 2 })}</span></p>
                    <p class="text-[15px] sm:text-xl text-gray-600">Shipping Fee: <span class="font-bold">₱${item.shippingFee.toLocaleString('en-US', { maximumFractionDigits: 2 })}</span></p>
                    <p class="text-[15px] sm:text-xl text-gray-600">Quantity: <span class="font-bold">${item.quantity}</span></p>
                </div>
            </li>
            `;
        });

       // Set the calculated grand total in the input field and show it
    cartTotalElement.textContent = `₱${total.toLocaleString('en-US', { maximumFractionDigits: 2 })}`;
    cartDataInput.value = JSON.stringify({
        cart: cart,
        grand_total: total
    });
});
    </script>



</body>

</html>