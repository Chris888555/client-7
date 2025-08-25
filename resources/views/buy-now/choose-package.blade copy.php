@extends('layouts.funnel')

@section('title', 'Choose Package')

@section('content')
<div class="container mx-auto px-4 py-10">

    <h2 class="text-2xl sm:text-3xl md:text-5xl font-bold text-center mb-4">
        Select Your Package Now
    </h2>
    <h3 class="text-lg sm:text-xl md:text-2xl text-center text-gray-700 mb-10">
        The Biggest Package, The Higher Income Potential and Product Discount
    </h3>

    <!-- Packages -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        @forelse($packages as $package)
        <div class="bg-white border rounded-2xl shadow-md overflow-hidden flex flex-col">
            <!-- Image -->
            <div class="w-full overflow-hidden">
                <img src="{{ $package->image ? asset('storage/' . $package->image) : 'https://www.pixcrafter.com/wp-content/uploads/2023/12/beauty-product-bottle-packaging-mockup.jpg' }}" 
                     alt="{{ $package->name }}" 
                     class="w-full h-auto object-cover">
            </div>

            <!-- Content -->
            <div class="p-6 flex-1 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $package->name }}</h3>
                        <span class="text-xl font-bold text-purple-600">₱{{ number_format($package->price, 2) }}</span>
                    </div>

                    @php
                        $features = is_string($package->features) ? json_decode($package->features, true) : $package->features;
                    @endphp
                    @if(is_array($features))
                        <ul class="space-y-2 text-gray-700 mb-6 text-sm">
                            @foreach($features as $feature)
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-circle-check text-green-600 text-base"></i>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <!-- Buy Now Button always at bottom -->
                <button class="w-full py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-xl shadow transition">
                    Buy Now
                </button>
            </div>
        </div>
        @empty
            <p class="col-span-full text-center text-gray-500">No packages available.</p>
        @endforelse
    </div>

    <!-- Payment Method Select -->
    <h2 class="text-xl font-semibold mb-2">Choose Payment Method for {{ $user->name }}</h2>
    <select id="paymentSelect" class="border rounded p-2 w-full mb-6">
        <option value="">-- Select Payment Method --</option>
        @foreach($mops as $mop)
            <option value="{{ $mop->id }}" 
                data-account="{{ $mop->account_name }}" 
                data-number="{{ $mop->account_number }}">
                {{ $mop->method_name }}
            </option>
        @endforeach
    </select>

    <!-- Card showing selected payment method -->
    <div id="paymentCard" class="hidden border rounded-xl shadow-md p-6 bg-white mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-2" id="methodName"></h3>
        <p class="text-gray-700 mb-1">Account Name: <span id="accountName"></span></p>
        <p class="text-gray-700 mb-3">Account Number: <span id="bankNumber"></span></p>
        <p class="text-sm text-gray-500">Send your payment to this payment method or follow instructions provided.</p>
    </div>

    <!-- Order Form -->
    <div class="bg-white border rounded-xl shadow-md p-6">
        <h3 class="text-lg font-semibold mb-4">Complete Your Order</h3>
        <form action="#" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Full Name -->
            <div>
                <label for="full_name" class="block text-gray-700 font-medium mb-1">Full Name</label>
                <input type="text" name="full_name" id="full_name" placeholder="Enter your full name"
                       class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Mobile Number -->
            <div>
                <label for="mobile_number" class="block text-gray-700 font-medium mb-1">Mobile Number</label>
                <input type="text" name="mobile_number" id="mobile_number" placeholder="Enter your mobile number"
                       class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Shipping Address -->
            <div>
                <label for="shipping_address" class="block text-gray-700 font-medium mb-1">Complete Shipping Address</label>
                <textarea name="shipping_address" id="shipping_address" rows="3" placeholder="Enter your shipping address"
                          class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-purple-500"></textarea>
            </div>

            <!-- Proof of Payment -->
            <div>
                <label for="payment_proof" class="block text-gray-700 font-medium mb-1">Upload Proof of Payment</label>
                <input type="file" name="payment_proof" id="payment_proof"
                       class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Hidden selected payment method -->
            <input type="hidden" name="payment_method_id" id="paymentMethodId">

            <button type="submit" class="w-full py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-xl shadow transition">
                Submit Order
            </button>
        </form>
    </div>
</div>

<script>
    const select = document.getElementById('paymentSelect');
    const card = document.getElementById('paymentCard');
    const methodNameEl = document.getElementById('methodName');
    const bankNumberEl = document.getElementById('bankNumber');
    const accountNameEl = document.getElementById('accountName');
    const paymentMethodInput = document.getElementById('paymentMethodId');

    select.addEventListener('change', () => {
        const selected = select.selectedOptions[0];

        if (!selected.value) {
            card.classList.add('hidden');
            paymentMethodInput.value = '';
            return;
        }

        // Show card
        card.classList.remove('hidden');

        // Populate details
        methodNameEl.textContent = selected.textContent;
        accountNameEl.textContent = selected.getAttribute('data-account');
        bankNumberEl.textContent = selected.getAttribute('data-number');

        // Set hidden input for form submission
        paymentMethodInput.value = selected.value;
    });
</script>
@endsection
