@extends('layouts.funnel')

@section('title', 'Checkout')

@section('content')
<div class="container sm:max-w-[1000px] mx-auto px-4 py-10">

   <h2 class="text-2xl sm:text-3xl md:text-5xl font-bold text-center mb-4 text-blue-700">
        Select Your Package Now
    </h2>
    <h3 class="text-lg sm:text-xl md:text-2xl text-center text-gray-700 mb-10">
        The Biggest Package, The Higher Income Potential and Product Discount
    </h3>


<!-- Step Progress Bar -->
<div class="flex justify-center mb-16 w-full max-w-md mx-auto">
    <!-- Step 1 -->
    <div class="flex-1 relative">
        <div id="step1Indicator" class="w-full h-3 rounded-l-full bg-blue-600 transition-all"></div>
        <div class="absolute top-4 left-1/2 transform -translate-x-1/2 text-xs font-semibold text-gray-800">
            Choose Package
        </div>
    </div>

    <!-- Step 2 -->
    <div class="flex-1 relative">
        <div id="step2Indicator" class="w-full h-3 rounded-r-full bg-gray-300 transition-all"></div>
        <div class="absolute top-4 left-1/2 transform -translate-x-1/2 text-xs font-semibold text-gray-800">
            Payment & Details
        </div>
    </div>
</div>


    <!-- STEP 1: Choose Package -->
    <div id="step1" class="space-y-6 ">
      
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 ">
            @foreach($packages as $package)
            <div class="border rounded-xl shadow p-4">
                 <!-- Image -->
            <div class="w-full overflow-hidden">
                <img src="{{ $package->image ? asset('storage/' . $package->image) : 'https://www.pixcrafter.com/wp-content/uploads/2023/12/beauty-product-bottle-packaging-mockup.jpg' }}" 
                     alt="{{ $package->name }}" 
                     class="w-full h-auto object-cover">
            </div>

                <div class="flex items-center justify-between mb-4 mt-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $package->name }}</h3>
                        <span class="text-xl font-bold text-blue-600">₱{{ number_format($package->price, 2) }}</span>
                    </div>
                 @php
                        $features = is_string($package->features) ? json_decode($package->features, true) : $package->features;
                    @endphp
                    @if(is_array($features))
                        <ul class="space-y-2 text-gray-700 mb-6 text-sm">
                            @foreach($features as $feature)
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-circle-check text-blue-600 text-base"></i>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                <button type="button" class="mt-3 w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg"
                        onclick="goToStep2({{ $package->id }}, '{{ $package->name }}', '₱{{ number_format($package->price, 2) }}')">
                    Buy Now
                </button>
            </div>
            @endforeach
        </div>
    </div>

    <!-- STEP 2: Payment + Buyer Details -->
    <div id="step2" class="hidden">
        <h3 class="text-xl font-semibold mb-4 text-blue-700">Payment & Basic Info</h3>

        <!-- Package Summary -->
        <div id="packageSummary" class="mb-6 border rounded-xl p-4 bg-gray-50 shadow-sm">
            <h4 class="font-semibold text-lg text-gray-800" id="summaryName"></h4>
            <p class="text-blue-600 font-bold text-base" id="summaryPrice"></p>
        </div>

        <form id="checkoutForm" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="package_id" id="packageInput">

            <!-- Payment Method -->
            <div>
                <label class="block font-medium mb-1">Select Payment Method</label>
                <select id="paymentSelect" name="payment_method_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 mb-4" required>
                    <option value="">-- Select Payment Method --</option>
                    @foreach($mops as $mop)
                        <option value="{{ $mop->id }}" 
                            data-method="{{ $mop->method_name }}" 
                            data-account="{{ $mop->account_name }}" 
                            data-number="{{ $mop->account_number }}">
                            {{ $mop->method_name }}
                        </option>
                    @endforeach
                </select>

                <div id="paymentCard" class="hidden border border-blue-600 rounded-xl shadow-md p-6 bg-white mb-6">
                    <h3 class="text-lg font-semibold text-blue-600 mb-2" id="methodName"></h3>
                    <p class="text-gray-700 mb-1">Account Name: <span id="accountName"></span></p>
                    <p class="text-gray-700 mb-3">Account Number: <span id="bankNumber"></span></p>
                    <p class="text-sm text-blue-500">Send your payment to this account.</p>
                </div>
            </div>

            <!-- Buyer Details -->
            <div>
                <label class="block font-medium mb-1">Full Name</label>
                <input type="text" name="full_name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" required>
            </div>

            <div>
                <label class="block font-medium mb-1">Mobile Number</label>
                <input type="text" name="mobile" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" required>
            </div>

            <div>
                <label class="block font-medium mb-1">Complete Shipping Address</label>
                <textarea name="address" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" rows="3" required></textarea>
            </div>

            <div class="bg-blue-50 border-l-4 border-blue-600 p-4 rounded-lg shadow-sm mb-6">
            <div class="flex items-start">
                <i class="fas fa-info-circle text-blue-600 text-xl mt-1 mr-3"></i>
                <div>
                <p class="text-blue-800 font-semibold text-base">Important Reminder</p>
                <p class="text-blue-700 text-sm leading-relaxed">
                    Please upload a <strong>clear screenshot of your proof of payment</strong> 
                    to ensure your account or order can be properly validated and processed.
                </p>
                </div>
            </div>
            </div>

            <div class="mb-4">
             <label class="block font-medium mb-2 text-gray-700">Upload Proof of Payment</label>
                <label id="uploadBox" 
                 class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-blue-400 rounded-lg cursor-pointer hover:border-blue-600 hover:bg-blue-50 transition duration-300 text-blue-700 relative">
                    <i class="fas fa-upload text-2xl mb-2 text-blue-600"></i>
                 <span id="uploadText" class="text-sm">Click to upload or drag and drop</span>
             <input id="payment_proof" type="file" name="payment_proof" class="hidden" accept="image/*" required>
    </label>
</div>

<script>
    const fileInput = document.getElementById('payment_proof');
    const uploadText = document.getElementById('uploadText');

    fileInput.addEventListener('change', () => {
        if(fileInput.files.length > 0){
            uploadText.textContent = fileInput.files[0].name;
        } else {
            uploadText.textContent = "Click to upload or drag and drop";
        }
    });
</script>

            <!-- Buttons -->
            <div class="flex justify-between">
                <button type="button" onclick="goBackStep1()" class="bg-gray-300 px-4 py-2 rounded-lg">← Back</button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Submit Order</button>
            </div>
        </form>
    </div>
</div>

<script>
    let username = "{{ $user->username ?? $funnel->user->username ?? '' }}";

    function goToStep2(packageId, name, price) {
        document.getElementById('step1').classList.add('hidden');
        document.getElementById('step2').classList.remove('hidden');
        document.getElementById('step1Indicator').className = "px-4 py-2 rounded-full bg-gray-200 text-gray-700";
        document.getElementById('step2Indicator').className = "px-4 py-2 rounded-full bg-blue-600 text-white";
        document.getElementById('packageInput').value = packageId;
        document.getElementById('summaryName').textContent = name;
        document.getElementById('summaryPrice').textContent = price;
    }

    function goBackStep1() {
        document.getElementById('step2').classList.add('hidden');
        document.getElementById('step1').classList.remove('hidden');
        document.getElementById('step1Indicator').className = "px-4 py-2 rounded-full bg-blue-600 text-white";
        document.getElementById('step2Indicator').className = "px-4 py-2 rounded-full bg-gray-200 text-gray-700";
    }

    const select = document.getElementById('paymentSelect');
    const card = document.getElementById('paymentCard');
    const methodNameEl = document.getElementById('methodName');
    const bankNumberEl = document.getElementById('bankNumber');
    const accountNameEl = document.getElementById('accountName');
    select.addEventListener('change', () => {
        const selected = select.selectedOptions[0];
        if (!selected.value) { card.classList.add('hidden'); return; }
        card.classList.remove('hidden');
        methodNameEl.textContent = selected.getAttribute('data-method');
        accountNameEl.textContent = selected.getAttribute('data-account');
        bankNumberEl.textContent = selected.getAttribute('data-number');
    });

    const form = document.getElementById('checkoutForm');
form.addEventListener('submit', function(e){
    e.preventDefault();
    let formData = new FormData(this);

    fetch("{{ route('checkout.store', $user->username) }}", {
        method: 'POST',
        body: formData,
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
    })
    .then(res => res.json())
    .then(res => {
        if(res.success){
            Swal.fire({
                icon: 'success',
                title: 'Order Placed!',
                text: res.success,
                timer: 1500,
                showConfirmButton: false,
                willClose: () => {
                    window.location.href = "{{ url('checkout/thank-you') }}/" + username;
                }
            });
        }
    })
    .catch(err => {
        err.json().then(errorData => {
            let msg = errorData.message || 'Something went wrong';
            Swal.fire('Error', msg, 'error');
        }).catch(() => {
            Swal.fire('Error', 'Something went wrong', 'error');
        });
    });
});

</script>

@endsection
