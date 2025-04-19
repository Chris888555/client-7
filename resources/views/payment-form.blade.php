@extends('layouts.app')

@section('title', 'Payment Form')

@section('content')


<div class="container m-auto p-4 sm:p-16 max-w-full">

    <div class="bg-white p-8 sm:px-16 sm: py-10 rounded-lg shadow max-w-4xl mx-auto ">

        <h1 class="text-2xl md:text-3xl font-bold text-left">Fill out the form to complete your payment.</h1>
        <p class="text-gray-600 text-left mb-6">Please fill in the required details to finalize your payment process
            securely.</p>

       

            <form method="POST" action="{{ route('payment.store', ['subdomain' => $user->subdomain]) }}" enctype="multipart/form-data" class="space-y-4">
    @csrf

            <!-- First Name and Last Name Inline -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="first_name" class="block font-medium text-gray-700">First Name</label>
                    <input type="text" id="first_name" name="first_name" required
                        class="mt-2 w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                </div>

                <div>
                    <label for="last_name" class="block font-medium text-gray-700">Last Name</label>
                    <input type="text" id="last_name" name="last_name" required
                        class="mt-2 w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- Email and Number Inline -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="email" class="block font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required
                        class="mt-2 w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="number" class="block font-medium text-gray-700">Number</label>
                    <input type="text" id="number" name="number" required
                        class="mt-2 w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- Shipping Address Full Width -->
            <div>
                <label for="shipping_address" class="mt-10 block font-medium text-gray-700">Shipping Address</label>
                <input type="text" id="shipping_address" name="shipping_address" required
                    class="mt-2 w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Zip Code and Barangay Inline -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 ">
                <div>
                    <label for="zip_code" class="block font-medium text-gray-700">Zip Code</label>
                    <input type="text" id="zip_code" name="zip_code" required
                        class="mt-2 w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="barangay" class="block font-medium text-gray-700">Barangay</label>
                    <input type="text" id="barangay" name="barangay" required
                        class="mt-2 w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <section class=" mt-10">
                        <h1 class="text-2xl md:text-3xl font-bold text-left mt-16">Our Packages</h1>
                    <p class="text-gray-600 text-left ">Choose your desired package and proceed to the payment section below.</p>
            </section>

       <!-- Pricing Section -->
<section class=" mt-10">
    <div class="flex flex-col md:flex-row gap-4 justify-center items-stretch">
        
        <!-- STARTER PACKAGE 1 -->
        <div class="bg-white p-6 rounded-lg border-4 border-gray-300 text-center flex-1 mt-0 sm:mt-4">
            <h3 class="text-2xl font-semibold mb-4">Starter Package</h3>
            <p class="text-lg text-gray-600 mb-4">Perfect for students.</p>
            <div class="text-3xl font-bold text-gray-900 mb-4">₱2,500</div>
            <ul class="list-none text-left text-gray-600 mb-6">
                <li class="flex items-center mb-2">
                    <div class="flex items-center justify-center w-8 h-8 mr-2">
                        <svg class="h-6 w-6 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 11 12 14 22 4" />
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                        </svg>
                    </div>
                   ₱12,000 potential income per day
                </li>

                <li class="flex items-center mb-2">
                    <div class="flex items-center justify-center w-8 h-8 mr-2">
                        <svg class="h-6 w-6 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 11 12 14 22 4" />
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                        </svg>
                    </div>
                    Free shipping 
                </li>
            </ul>
        </div>

        <!-- STARTER PACKAGE 2 -->
        <div class="bg-white p-6 rounded-lg border-4 border-gray-300 text-center flex-1 mt-0 sm:mt-4">
            <h3 class="text-2xl font-semibold mb-4">Elite Package</h3>
            <p class="text-lg text-gray-600 mb-4">Best for business.</p>
            <div class="text-3xl font-bold text-gray-900 mb-4">₱10,000</div>
            <ul class="list-none text-left text-gray-600 mb-6">
                <li class="flex items-center mb-2">
                    <div class="flex items-center justify-center w-8 h-8 mr-2">
                        <svg class="h-6 w-6 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 11 12 14 22 4" />
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                        </svg>
                    </div>
                    ₱48,000 potential income per day
                </li>

                <li class="flex items-center mb-2">
                    <div class="flex items-center justify-center w-8 h-8 mr-2">
                        <svg class="h-6 w-6 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 11 12 14 22 4" />
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                        </svg>
                    </div>
                    Free shipping
                </li>
            </ul>
        </div>

       

    </div>
</section>




            <!-- Payment Method Selection -->
            <div>
                <label for="payment_method" class="block font-medium text-gray-700">Select Payment Method</label>
                <select id="payment_method" name="payment_method" required
                    class="mt-2 w-full border border-gray-300 rounded-md p-4 focus:outline-none focus:ring-2 focus:ring-green-500 glow-border"
                    onchange="showPaymentDetails()">
                    <option value="">Select Payment Options</option>
                    @foreach($paymentMethods as $paymentMethod)
                    <option value="{{ $paymentMethod->method_name }}" @if(old('payment_method')==$paymentMethod->method_name) selected @endif>
                        {{ $paymentMethod->method_name }}
                    </option>
                    @endforeach
                </select>
            </div>


            <!-- Dynamic Payment Method Number Display -->
            <div id="payment_details" class="mt-4">
                @if(old('payment_method'))
                @php
                $selectedPaymentMethod = $paymentMethods->where('method_name', old('payment_method'))->first();
                @endphp
                @if($selectedPaymentMethod)
                <p class="text-green-600">{{ $selectedPaymentMethod->method_name }} Account Number:
                    {{ $selectedPaymentMethod->account_number }}</p>
                @endif
                @endif
            </div>

            <!-- File Upload -->
<div class="flex items-center justify-center w-full ">
    <label for="image"
        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
        
        <div class="flex flex-col items-center justify-center pt-5 pb-6 p-4">
            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 20 16">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
            </svg>
            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click To Upload Proof Of
                    Payment</span></p>
            <p class="text-xs text-gray-500">PNG, JPG </p>
        </div>

        <input id="image" type="file" name="image" class="hidden" onchange="previewFile(event)" />

       <!-- Preview Link inside the file upload container -->
<div id="link-preview" class=" hidden text-center text-blue-600 p-4">
    <p class="text-sm">Selected File:</p>
    <a id="file-link" href="" target="_blank" class="text-blue-600 break-all max-w-full overflow-hidden ">
        View File
    </a>
</div>


    </label>
</div>



            <div class="text-center">
    <button type="submit"
        class="bg-blue-600 text-white px-6 py-2 rounded-md mt-6 w-full hover:bg-blue-700 transition flex items-center justify-center">
        <!-- SVG Icon -->
        <svg class="h-5 w-5 text-white mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" />
            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
            <circle cx="12" cy="14" r="2" />
            <polyline points="14 4 14 8 8 8 8 4" />
        </svg>
        Submit Proof Payment
    </button>
</div>

        </form>
    </div>
</div>

<script>
const paymentData = @json($paymentMethods->keyBy('method_name'));


function showPaymentDetails() {
    const paymentMethod = document.getElementById('payment_method').value;
    const paymentDetails = document.getElementById('payment_details');

    if (paymentMethod && paymentData[paymentMethod]) {
        const data = paymentData[paymentMethod];
        paymentDetails.innerHTML = `
    <div class="space-y-2 p-6 border border-gray-300 rounded-lg">
     <p class="text-xs text-red-600 mb-4 "> Complete your payment now and upload the receipt as proof of payment below. </p>
        <p class="font-medium text-gray-700">
  Account Name:
  <span class="text-green-600 block sm:inline">${data.account_name}</span>
</p>

<p class="font-medium text-gray-700">
  ${data.method_name} Number:
  <span class="text-green-600 block sm:inline">${data.account_number}</span>
</p>

    </div>
`;
    } else {
        paymentDetails.innerHTML = '';
    }
}

// Trigger the function on page load (in case old value exists)
document.addEventListener('DOMContentLoaded', function() {
    showPaymentDetails();
});

// Image selected preview link
function previewFile(event) {
    const file = event.target.files[0];
    const fileLink = document.getElementById('file-link');
    const linkPreview = document.getElementById('link-preview');

    // Check if the file is an image (optional check, depending on your needs)
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();

        reader.onload = function(e) {
            fileLink.href = e.target.result; // Set the file link
            fileLink.textContent = file.name; // Display the file name
            linkPreview.classList.remove('hidden'); // Show the link preview
        };

        reader.readAsDataURL(file);
    } else {
        // Clear the preview if the selected file is not an image
        fileLink.href = '';
        linkPreview.classList.add('hidden');
    }
}

</script>




@endsection