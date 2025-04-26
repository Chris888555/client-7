@extends('layouts.app')

@section('title', 'Product Upload')

@section('content')

@include('includes.nav')


<div class="container m-auto p-4 sm:p-8 max-w-full">

    <h1 class="text-2xl md:text-3xl font-bold text-left">Mange Orders</h1>
    <p class="text-gray-600 text-left mb-4">View, update, and organize all incoming orders in one place for a seamless
        experience.</p>


    <!-- Search Bar with Button -->
    <div class="flex flex-col sm:flex-row items-center mb-8 gap-4">
        <div class="w-full">
            <form action="" method="GET" class="w-full">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" name="search" id="default-search" value="{{ $search }}"
                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-light-blue-500 focus:border-light-blue-500 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-light-blue-500 dark:focus:border-light-blue-500"
                        placeholder="Search by name..." />
                    <button type="submit"
                        class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Search
                    </button>
                </div>
                <input type="hidden" name="view" value="{{ $view }}">
            </form>
        </div>


        <!-- Order View Filters -->


        <a href="?view=all&search={{ $search }}"
            class="w-full sm:w-[25%] px-4 py-3 rounded bg-gray-300 text-gray-800 {{ request('view') == 'all' || !request('view') ? 'bg-blue-500' : '' }}">
            All Orders
        </a>

        <a href="?view=pending&search={{ $search }}"
            class="w-full sm:w-[25%] px-4 py-3 rounded bg-yellow-600 text-white {{ request('view') == 'pending' ? 'bg-yellow-600' : '' }}">
            Pending Orders <span class="ml-2">({{ $pendingCount }})</span>
        </a>

        <a href="?view=shipped&search={{ $search }}"
            class="w-full sm:w-[25%] px-4 py-3 rounded bg-green-600 text-white {{ request('view') == 'shipped' ? 'bg-green-600' : '' }}">
            Shipped Orders <span class="ml-2">({{ $shippedCount }})</span>
        </a>



    </div>

    @if($checkouts->isEmpty())
    <div class="w-full flex items-center flex-wrap justify-center gap-10 border boder-gray-300 rounded-lg p-4">
        <div class="grid gap-4 w-60">
            <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" width="128" height="124" viewBox="0 0 128 124"
                fill="none">
                <g filter="url(#filter0_d_14133_718)">
                    <path
                        d="M4 61.0062C4 27.7823 30.9309 1 64.0062 1C97.0319 1 124 27.7699 124 61.0062C124 75.1034 119.144 88.0734 110.993 98.3057C99.7572 112.49 82.5878 121 64.0062 121C45.3007 121 28.2304 112.428 17.0071 98.3057C8.85599 88.0734 4 75.1034 4 61.0062Z"
                        fill="#F9FAFB" />
                </g>
                <path
                    d="M110.158 58.4715H110.658V57.9715V36.9888C110.658 32.749 107.226 29.317 102.986 29.317H51.9419C49.6719 29.317 47.5643 28.165 46.3435 26.2531L46.342 26.2509L43.7409 22.2253L43.7404 22.2246C42.3233 20.0394 39.8991 18.7142 37.2887 18.7142H20.8147C16.5749 18.7142 13.1429 22.1462 13.1429 26.386V57.9715V58.4715H13.6429H110.158Z"
                    fill="#EEF2FF" stroke="#A5B4FC" />
                <path
                    d="M49 20.2142C49 19.6619 49.4477 19.2142 50 19.2142H106.071C108.281 19.2142 110.071 21.0051 110.071 23.2142V25.6428H53C50.7909 25.6428 49 23.8519 49 21.6428V20.2142Z"
                    fill="#A5B4FC" />
                <circle cx="1.07143" cy="1.07143" r="1.07143" transform="matrix(-1 0 0 1 36.1429 23.5)"
                    fill="#4F46E5" />
                <circle cx="1.07143" cy="1.07143" r="1.07143" transform="matrix(-1 0 0 1 29.7144 23.5)"
                    fill="#4F46E5" />
                <circle cx="1.07143" cy="1.07143" r="1.07143" transform="matrix(-1 0 0 1 23.2858 23.5)"
                    fill="#4F46E5" />
                <path
                    d="M112.363 95.459L112.362 95.4601C111.119 100.551 106.571 104.14 101.323 104.14H21.8766C16.6416 104.14 12.0808 100.551 10.8498 95.4592C10.8497 95.4591 10.8497 95.459 10.8497 95.459L1.65901 57.507C0.0470794 50.8383 5.09094 44.4286 11.9426 44.4286H111.257C118.108 44.4286 123.166 50.8371 121.541 57.5069L112.363 95.459Z"
                    fill="white" stroke="#E5E7EB" />
                <path
                    d="M65.7893 82.4286C64.9041 82.4286 64.17 81.6945 64.17 80.7877C64.17 77.1605 58.686 77.1605 58.686 80.7877C58.686 81.6945 57.9519 82.4286 57.0451 82.4286C56.1599 82.4286 55.4258 81.6945 55.4258 80.7877C55.4258 72.8424 67.4302 72.8639 67.4302 80.7877C67.4302 81.6945 66.6961 82.4286 65.7893 82.4286Z"
                    fill="#4F46E5" />
                <path
                    d="M79.7153 68.5462H72.9358C72.029 68.5462 71.2949 67.8121 71.2949 66.9053C71.2949 66.0201 72.029 65.286 72.9358 65.286H79.7153C80.6221 65.286 81.3562 66.0201 81.3562 66.9053C81.3562 67.8121 80.6221 68.5462 79.7153 68.5462Z"
                    fill="#4F46E5" />
                <path
                    d="M49.9204 68.546H43.1409C42.2341 68.546 41.5 67.8119 41.5 66.9051C41.5 66.0198 42.2341 65.2858 43.1409 65.2858H49.9204C50.8056 65.2858 51.5396 66.0198 51.5396 66.9051C51.5396 67.8119 50.8056 68.546 49.9204 68.546Z"
                    fill="#4F46E5" />
                <circle cx="107.929" cy="91.0001" r="18.7143" fill="#EEF2FF" stroke="#E5E7EB" />
                <path
                    d="M115.161 98.2322L113.152 96.2233M113.554 90.1965C113.554 86.6461 110.676 83.7679 107.125 83.7679C103.575 83.7679 100.697 86.6461 100.697 90.1965C100.697 93.7469 103.575 96.6251 107.125 96.6251C108.893 96.6251 110.495 95.9111 111.657 94.7557C112.829 93.5913 113.554 91.9786 113.554 90.1965Z"
                    stroke="#4F46E5" stroke-width="1.6" stroke-linecap="round" />
                <defs>
                    <filter id="filter0_d_14133_718" x="2" y="0" width="124" height="124" filterUnits="userSpaceOnUse"
                        color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                            result="hardAlpha" />
                        <feOffset dy="1" />
                        <feGaussianBlur stdDeviation="1" />
                        <feComposite in2="hardAlpha" operator="out" />
                        <feColorMatrix type="matrix"
                            values="0 0 0 0 0.0627451 0 0 0 0 0.0941176 0 0 0 0 0.156863 0 0 0 0.05 0" />
                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_14133_718" />
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_14133_718" result="shape" />
                    </filter>
                </defs>
            </svg>
            <div>
                <h2 class="text-center text-black text-base font-semibold leading-relaxed pb-1">No
                    data found</h2>

            </div>
        </div>
    </div>
    @else

    @foreach($checkouts as $checkout)
    <div class="bg-white p-4 rounded-lg shadow-md mb-4 cursor-pointer" x-data="{ open: false, showModal: false }">
        <div class="flex justify-between items-center" @click="open = !open">
            <p class="text-lg font-semibold">
                Order #{{ $checkout->id }} - {{ $checkout->first_name }} {{ $checkout->last_name }}
                <span
                    class="ml-2 px-2 py-1 text-sm font-medium rounded {{ $checkout->status == 0 ? 'bg-yellow-500' : 'bg-green-500' }} text-white">
                    {{ $checkout->status == 0 ? 'Pending' : 'Shipped' }}
                </span>
            </p>
            <svg x-show="!open" class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 9l6 6 6-6"></path>
            </svg>
            <svg x-show="open" class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 15l-6-6-6 6"></path>
            </svg>
        </div>

        <!-- Order Details Section (Visible when 'open' is true) -->
        <div x-show="open" class="mt-4">
            <div class="bg-white p-6 rounded-lg shadow-[inset_0px_3px_34px_1px_#00000024]">
                <!-- Order Summary -->
                <h3 class="text-xl font-semibold mb-4">Order Summary</h3>

                <div class="space-y-4 border-b pb-4">
                    @php
                    $cartData = json_decode($checkout->cart_data, true);
                    $grandTotal = $cartData['grand_total'] ?? 0;
                    unset($cartData['grand_total']);
                    @endphp

                    @foreach($cartData as $item)
                    <div class="flex items-center space-x-4 border rounded-lg p-3">
                        <img src="{{ $item['image'] }}" class="w-16 h-16 object-cover rounded"
                            alt="{{ $item['name'] }}">
                        <div class="flex-grow">
                            <p class="font-semibold">{{ $item['name'] }}</p>
                            <p class="text-sm text-gray-600">Price: <span
                                    class="font-bold">₱{{ number_format($item['price'], 2) }}</span></p>
                            <p class="text-sm text-gray-600">Shipping: <span
                                    class="font-bold">₱{{ number_format($item['shippingFee'] ?? 0, 2) }}</span></p>
                            <p class="text-sm text-gray-600">Quantity: <span
                                    class="font-bold">{{ $item['quantity'] }}</span></p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Grand Total -->
                <div class="mt-4 text-lg font-bold text-gray-700 flex gap-4">
                    <span>Grand Total:</span>
                    <span class="text-red-500">₱{{ number_format($grandTotal, 2) }}</span>
                </div>
            </div>



            <!-- Customer Information Section -->
            <div class="mt-6 bg-white p-6 rounded-lg shadow-[inset_0px_3px_34px_1px_#00000024]">
               <h3 class="text-xl font-semibold mb-4">Customer Information</h3>
    <p><strong>Name:</strong> {{ $checkout->first_name }} {{ $checkout->last_name }}</p>
    <p><strong>Phone:</strong> {{ $checkout->phone }}</p>
    <p><strong>Address:</strong> {{ $checkout->address }}, {{ $checkout->barangay }}, {{ $checkout->city }}, {{ $checkout->state }}, Zip: {{ $checkout->zip_code }}</p>
            </div>
            
      

            <!-- Proof of Payment (Wrapper hidden if COD) -->
            <div class="mt-6 bg-white p-6 rounded-lg shadow-[inset_0px_3px_34px_1px_#00000024]"
                x-data="{ showModal: false, paymentOption: '{{ strtolower($checkout->payment_option) }}' }"
                x-show="paymentOption !== 'cod'" x-cloak>

                <h3 class="text-xl font-semibold mb-4">Proof of Payment</h3>

                <div class="cursor-pointer" @click="showModal = true">
                    <img src="{{ asset('storage/' . $checkout->proof_of_payment) }}" class="w-40 h-40 object-cover mt-2"
                        alt="Proof of Payment">
                    <div class="flex items-center text-blue-600 mt-2">
                        <span class="text-sm">Click to Expand</span>
                        <svg x-show="!showModal" class="ml-2 h-5 w-5 text-gray-600" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 9l6 6 6-6"></path>
                        </svg>
                        <svg x-show="showModal" class="ml-2 h-5 w-5 text-gray-600" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 15l-6-6-6 6"></path>
                        </svg>
                    </div>
                </div>

                <!-- Modal -->
                <div x-show="showModal"
                    class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50"
                    @click="showModal = false">
                    <div class="bg-white p-4 rounded-lg shadow-lg w-[90%] sm:max-w-[800px]">
                        <img src="{{ asset('storage/' . $checkout->proof_of_payment) }}"
                            class="w-full h-auto object-contain" alt="Proof of Payment">
                        <button @click="showModal = false" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">
                            Close
                        </button>
                    </div>
                </div>
            </div>

            <!-- Always show Payment Option -->
            <div class="mt-6 bg-white p-6 rounded-lg shadow-[inset_0px_3px_34px_1px_#00000024]"
                x-data="{ paymentOption: '{{ strtolower($checkout->payment_option) }}' }">
                <span>Payment Option:</span>
                <span x-text="paymentOption.toUpperCase()"></span>
            </div>

<div class="mt-4 flex flex-col md:flex-row md:space-x-4 space-y-2 md:space-y-0 items-center">
    <!-- Update Status Form -->
    <form action="{{ route('order.updateStatus', $checkout->id) }}" method="POST" class="w-full md:w-auto">
        @csrf
        @method('PUT')
        <button type="submit" name="status" value="1" class="w-full md:w-auto px-4 py-2 rounded bg-green-500 text-white">
            Mark as Shipped
        </button>
    </form>

    <form action="{{ route('order.updateStatus', $checkout->id) }}" method="POST" class="w-full md:w-auto">
        @csrf
        @method('PUT')
        <button type="submit" name="status" value="0" class="w-full md:w-auto px-4 py-2 rounded bg-yellow-500 text-white">
            Mark as Pending
        </button>
    </form>

    <!-- Delete Order Form -->
    <form action="{{ route('order.destroy', $checkout->id) }}" method="POST" class="w-full md:w-auto">
        @csrf
        @method('DELETE')
        <button type="submit" class="w-full md:w-auto px-4 py-2 rounded bg-red-500 text-white">
            Delete Order
        </button>
    </form>
</div>



        </div>
    </div>
    @endforeach
    @endif
    <!-- Pagination -->

    <div class="mt-6">
        <p class="text-gray-600 mb-4">
            Total: {{ $checkouts->total() }} results
        </p>
        <div class="flex flex-wrap gap-2">
            @foreach ($checkouts->links()->elements[0] as $page => $url)
            <a href="{{ $url }}"
                class="px-4 py-2 rounded-lg transition 
               {{ $page == $checkouts->currentPage() ? 'bg-blue-500 text-white font-semibold' : 'bg-gray-200 hover:bg-gray-300' }}">
                {{ $page }}
            </a>
            @endforeach



        </div>
    </div>

</div>
@endsection