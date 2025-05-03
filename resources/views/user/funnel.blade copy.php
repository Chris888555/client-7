@extends('layouts.app')

@section('title', 'Funnel Pro Add on')

@section('content')

@include('includes.nav')

<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

<div class="container m-auto p-4 sm:p-8 max-w-full text-blue-400">
    <h1 class="text-2xl md:text-3xl font-bold text-left">Funnel Pro</h1>
    <p class="text-gray-600 text-left mb-4">Access our Advanced and Optimized Sales Funnel</p>



    <div class="mb-6">
        @if($funnel)
        <div class="mt-6">
            @if($funnel->status == 'pending' && $funnel->is_active == 0)
            <div
                class="bg-yellow-100 border border-gray-200 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg flex items-center gap-3 mt-4 w-full   md:mx-0 ">
                <i class="ph ph-warning-circle text-yellow-600 text-2xl"></i>
                <p class="text-sm font-medium">
                    Your funnel is currently <strong>pending approval</strong>. Please check back soon — we'll notify
                    you once it's ready to go live!
                </p>
            </div>

            @elseif($funnel->status == 'rejected' && $funnel->is_active == 0)
            <div
                class="mb-8 bg-yellow-100 border border-gray-200 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg flex items-center gap-3 mt-4 w-full md:mx-0">
                <i class="ph ph-warning-circle text-yellow-600 text-2xl"></i>
                <p class="text-sm font-medium">
                    Your funnel submission has been <strong>rejected</strong>. Please revise and resubmit your proof to
                    try again. Make sure the reference number is clear.
                </p>
            </div>

            @elseif($funnel->status == 'expired' && $funnel->is_active == 0)
            <div
                class="mb-8 bg-yellow-100 border border-gray-200 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg flex items-center gap-3 mt-4 w-full   md:mx-0 ">
                <i class="ph ph-warning-circle text-yellow-600 text-2xl"></i>
                <p class="text-sm font-medium">
                    Your funnel access <strong>has expired</strong>. Please re-subscribe
                    to reactivate.
                </p>
            </div>




            {{-- Display expiration date --}}
            @if($funnel->expiration_date)
            <p class="text-red-600 font-medium mb-4">
                Your funnel expired on {{ \Carbon\Carbon::parse($funnel->expiration_date)->format('M d, Y') }}.
            </p>
            @endif


            <!--########### Show the form to re-submit payment for funnel activation, Payment required ############ -->
            <div class="relative mt-2 p-8  bg-white rounded-3xl border border-gray-200 transition-all">


                {{-- Badge --}}
                <div
                    class="absolute top-4 right-4 bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">
                    PRO Add-on
                </div>

                {{-- Users Trust --}}
                <div class="flex items-center justify-center gap-2 mt-6 text-sm text-gray-600 font-medium">
                    <span class="material-symbols-outlined text-green-500">group</span>
                    <span>700+ Users Trust This</span>
                </div>

                {{-- Headline --}}
                <h2 class="text-2xl font-bold text-center text-gray-800 mt-4 mb-2">Activate Your Funnel – Pro Add-on
                </h2>

                {{-- Subtitle --}}
                <p class="text-gray-600 text-sm text-center mb-6">
                    Unlock powerful business tools to grow and scale—no cost to start.
                </p>

                {{-- Feature Checklist --}}
                <ul class="text-gray-700 text-sm space-y-3 mb-6">
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-green-600">analytics</span>
                        Free Video Analytics
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-green-600">track_changes</span>
                        Free Page View Tracking
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-green-600">slideshow</span>
                        Free Powerful Sales Presentation
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-green-600">domain</span>
                        Free subdomain
                    </li>
                </ul>

                <form action="{{ route('funnel.resubmit') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="plan_duration" class="block text-lg font-semibold text-gray-700">Select Plan
                            Duration</label>
                        <select name="plan_duration"
                            class="w-full p-3 border border-gray-300 rounded-lg mt-2 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 hover:border-indigo-400 transition duration-300 ease-in-out">
                            <option value="1_month">1 Month</option>
                            <option value="6_months">6 Months</option>
                            <option value="1_year">1 Year</option>
                        </select>
                    </div>

                    <!-- Price Display Card -->
                    <div id="plan-price-card "
                        class="flex items-center gap-3 mt-4 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg shadow-sm transition duration-300 ease-in-out">

                        <div>
                            <p class="text-sm text-gray-700">Current Plan Price:</p>
                            <p id="plan-price" class="text-xl font-bold text-gray-500">₱99</p>
                        </div>
                    </div>

                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const planSelect = document.querySelector('select[name="plan_duration"]');
                        const priceDisplay = document.getElementById('plan-price');

                        const prices = {
                            '1_month': '₱99',
                            '6_months': '₱499',
                            '1_year': '₱899'
                        };

                        function updatePrice() {
                            const selectedPlan = planSelect.value;
                            priceDisplay.textContent = prices[selectedPlan] ? `Price: ${prices[selectedPlan]}` :
                                '';
                        }

                        // Initial display (optional)
                        updatePrice();

                        // Update on change
                        planSelect.addEventListener('change', updatePrice);
                    });
                    </script>

                    <div class="mb-4">
                        <h3 class="block text-lg font-semibold text-gray-700 mt-8">Attach Proof of Payment</h3>
                        <div class="flex flex-col items-center space-y-4 mt-2">
                            <div
                                class="relative w-full pt-10 pb-6 bg-white border-2 border-gray-300 border-dashed rounded-md cursor-pointer hover:border-gray-400 focus:outline-none">
                                <label class="flex justify-center w-full transition" for="proof_image">
                                    <span class="flex items-center space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                            </path>
                                        </svg>
                                        <span class="font-medium text-gray-600">Drop files to Attach, or <span
                                                class="text-blue-600 underline">browse</span></span>
                                    </span>
                                </label>
                                <!-- File Input Field -->
                                <input type="file" name="proof_image" id="proof_image" class="hidden"
                                    accept="image/png, image/jpeg" required>
                                <!-- File Path (Centered) -->
                                <div id="file-path" class="mt-2 text-green-600 text-sm text-center"></div>
                            </div>
                            <p class="text-gray-700 text-sm mt-4">
                                Please attach a proof of payment to proceed. Your payment will be verified by the admin,
                                and once confirmed, you will be granted access to the sales funnel. Kindly wait for the
                                verification process to be completed.
                            </p>

                        </div>


                        <script>
                        // Handle file selection and display the file path
                        document.getElementById('proof_image').addEventListener('change', function(event) {
                            const filePath = document.getElementById('file-path');
                            const file = event.target.files[0];

                            if (file) {
                                filePath.textContent = file.name; // Display file name
                            } else {
                                filePath.textContent = '';
                            }
                        });
                        </script>


                        <button type="submit"
                            class="bg-blue-500 text-white py-2 px-6 mt-6 rounded-lg flex items-center space-x-2 hover:bg-blue-600 transition">
                            <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                                <polyline points="17 21 17 13 7 13 7 21" />
                                <polyline points="7 3 7 8 15 8" />
                            </svg>
                            <span>Subscribe Now</span>
                        </button>

                </form>
            </div>
            @else

            <!-- Update Subdomain Button -->
            <button onclick="openModal('{{ $user->id }}', '{{ $user->subdomain }}')"
                class="mb-8 bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 flex items-center w-full md:w-auto">
                <svg class="h-5 w-5 text-white mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Update Subdomain
            </button>

            <!-- Update Subdomain MODAL -->

            <div id="modal" onclick="handleOutsideClick(event)"
                class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden p-4">
                <!-- Modal Content -->
                <div id="modalContent" class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm">
                    <h2 class="text-xl font-bold mb-4 text-center">Update Subdomain</h2>

                    <form id="updateForm" method="POST" action="{{ route('update.subdomain', ['id' => $user->id]) }}">
                        @csrf
                        <input type="hidden" id="userId" name="user_id">

                        <label class="block text-gray-600 mb-2">New Subdomain</label>
                        <input type="text" id="subdomain" name="subdomain" class="w-full p-2 border rounded-lg mb-2"
                            required oninput="validateSubdomain(this)">

                        <small id="errorText"
                            class="hidden bg-red-100 text-red-700 border border-red-400 p-2 rounded-md shadow-lg block">
                            Only letters, numbers, and hyphens (-) are allowed.
                        </small>

                        <div class="flex flex-wrap justify-end gap-2 mt-4">
                            <button type="button" onclick="closeModal()"
                                class="px-4 py-2 bg-gray-400 text-white rounded-lg w-full md:w-auto">Cancel</button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 w-full md:w-auto">Save</button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
            function openModal(userId, subdomain) {
                document.getElementById("modal").classList.remove("hidden");
                document.getElementById("userId").value = userId;
                document.getElementById("subdomain").value = subdomain;
            }

            function closeModal() {
                document.getElementById("modal").classList.add("hidden");
            }

            function handleOutsideClick(event) {
                const modalContent = document.getElementById("modalContent");
                if (!modalContent.contains(event.target)) {
                    closeModal();
                }
            }

            function validateSubdomain(input) {
                let regex = /^[a-zA-Z0-9-]+$/;
                let errorText = document.getElementById("errorText");

                if (!regex.test(input.value)) {
                    input.value = input.value.replace(/[^a-zA-Z0-9-]/g, "");
                    errorText.classList.remove("hidden");
                } else {
                    errorText.classList.add("hidden");
                }
            }
            </script>

            <!-- Update Subdomain End conde -->

            <hr class="border-t- border-gray-200 mb-8 mt-6">

            <!--########### Show the this when funnel is active ############ -->
            <div
                class="  bg-green-50 border border text-green-800 rounded-2xl p-4 mb-4 flex items-center gap-2 shadow-sm">
                <span class="material-icons text-green-600">check_circle</span>
                <p class="font-medium">Your funnel is <strong>active</strong>.</p>
            </div>

            @if($funnel->expiration_date)
            <div class="bg-gray-100 border border text-blue-800 rounded-2xl p-4 mb-4 flex items-center gap-2 shadow-sm">
                <span class="material-icons text-blue-600">event_busy</span>
                <p class="font-semibold">Expired On:
                    {{ \Carbon\Carbon::parse($funnel->expiration_date)->format('M d, Y') }}</p>
            </div>
            @endif

            <div class="p-6 border border-gray-200 rounded-2xl  bg-white">
                <div class="mb-2 flex items-center gap-2 text-gray-700">
                    <span class="material-icons text-gray-500">layers</span>
                    <p class="text-sm text-gray-600">Your Funnel Link :</p>
                </div>
                <div class="text-blue-600 font-semibold break-words text-sm flex items-center gap-1">
                    <span class="material-icons text-blue-500">link</span>
                    <a href="{{ url($user->subdomain) }}"
                        class="text-blue-600 font-semibold no-underline hover:no-underline focus:no-underline">
                        {{ url($user->subdomain) }}
                    </a>
                </div>

            </div>
            @endif
        </div>


        @if($funnel->status != 'pending' && $funnel->is_active != 0)
        <div class="flex row justify-start gap-2 mt-4">

            <!-- Copy Link Button -->
            <button id="copyBtn" onclick="copyToClipboard('{{ url($user->subdomain) }}')"
                class="bg-gray-500 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-600 flex items-center w-full md:w-auto">
                <i class="ph ph-copy mr-2"></i> <span id="copyBtnText">Copy Link</span>
            </button>

            <script>
            function copyToClipboard(text) {
                // Using the Clipboard API to copy the text to clipboard
                navigator.clipboard.writeText(text).then(function() {
                    // Changing the button text to "Copied!" after successful copy
                    const btnText = document.getElementById('copyBtnText');
                    btnText.textContent = 'Link Copied';
                    setTimeout(() => {
                        // Changing the button text back to "Copy Link" after 2 seconds
                        btnText.textContent = 'Copy Link';
                    }, 2000);
                }).catch(function(err) {
                    // If copying fails, log an error
                    console.error('Failed to copy: ', err);
                });
            }
            </script>

            <!-- View Funnel Button -->
            <!-- <a href="{{ url($user->subdomain) }}" target="_blank"
                class="bg-gray-500 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-600 flex items-center w-full md:w-auto">
                <i class="ph ph-eye mr-2"></i> View Funnel
            </a> -->

            <!-- Edit Funnel Button -->
            <a href="{{ route('edit-funnel') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-600 flex items-center w-full md:w-auto transition-all duration-300">
                <i class="ph ph-pencil mr-2"></i> Edit Funnel
            </a>
        </div>
        @endif
        @else


        <!--########### Only show the form when setting is ON for funnel activation, Payment required ############ -->
        @if($setting_value === 'ON')
        <div class="relative mt-2 p-8  bg-white rounded-3xl border border-gray-200 transition-all">

            {{-- Badge --}}
            <div
                class="absolute top-4 right-4 bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">
                PRO Add-on
            </div>

            {{-- Users Trust --}}
            <div class="flex items-center justify-center gap-2 mt-6 text-sm text-gray-600 font-medium">
                <span class="material-symbols-outlined text-green-500">group</span>
                <span>700+ Users Trust This</span>
            </div>

            {{-- Headline --}}
            <h2 class="text-2xl font-bold text-center text-gray-800 mt-4 mb-2">Activate Your Funnel – Pro Add-on</h2>

            {{-- Subtitle --}}
            <p class="text-gray-600 text-sm text-center mb-6">
                Unlock powerful business tools to grow and scale—no cost to start.
            </p>

            {{-- Feature Checklist --}}
            <ul class="text-gray-700 text-sm space-y-3 mb-6">
                <li class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-green-600">analytics</span>
                    Free Video Analytics
                </li>
                <li class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-green-600">track_changes</span>
                    Free Page View Tracking
                </li>
                <li class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-green-600">slideshow</span>
                    Free Powerful Sales Presentation
                </li>
                <li class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-green-600">domain</span>
                    Free subdomain
                </li>
            </ul>

            <form action="{{ route('funnel.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="plan_duration" class="block text-lg font-semibold text-gray-700">Select Plan
                        Duration</label>
                    <select name="plan_duration"
                        class="w-full p-3 border border-gray-300 rounded-lg mt-2 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 hover:border-indigo-400 transition duration-300 ease-in-out">
                        <option value="1_month">1 Month</option>
                        <option value="6_months">6 Months</option>
                        <option value="1_year">1 Year</option>
                    </select>
                </div>

                <!-- Price Display Card -->
                <div id="plan-price-card "
                    class="flex items-center gap-3 mt-4 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg shadow-sm transition duration-300 ease-in-out">

                    <div>
                        <p class="text-sm text-gray-700">Current Plan Price:</p>
                        <p id="plan-price" class="text-xl font-bold text-gray-500">₱99</p>
                    </div>
                </div>

                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const planSelect = document.querySelector('select[name="plan_duration"]');
                    const priceDisplay = document.getElementById('plan-price');

                    const prices = {
                        '1_month': '₱99',
                        '6_months': '₱499',
                        '1_year': '₱899'
                    };

                    function updatePrice() {
                        const selectedPlan = planSelect.value;
                        priceDisplay.textContent = prices[selectedPlan] ? `Price: ${prices[selectedPlan]}` : '';
                    }

                    // Initial display (optional)
                    updatePrice();

                    // Update on change
                    planSelect.addEventListener('change', updatePrice);
                });
                </script>

                <h3 class="block text-lg font-semibold text-gray-700 mt-8">Attach Proof of Payment</h3>
                <div class="flex flex-col items-center space-y-4 mt-2">
                    <div
                        class="relative w-full pt-10 pb-6 px-2 bg-white border-2 border-gray-300 border-dashed rounded-md cursor-pointer hover:border-gray-400 focus:outline-none">
                        <label class="flex justify-center w-full transition" for="proof_image">
                            <span class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                    </path>
                                </svg>
                                <span class="font-medium text-gray-600">Drop files to Attach, or <span
                                        class="text-blue-600 underline">browse</span></span>
                            </span>
                        </label>
                        <input type="file" name="proof_image" id="proof_image" class="hidden"
                            accept="image/png, image/jpeg" required>
                        <!-- File Path (Centered) -->
                        <div id="file-path" class="mt-2 text-green-600 text-sm text-center"></div>
                    </div>

                    <p class="text-gray-700 text-sm mt-4">
                        Please attach a proof of payment to proceed. Your payment will be verified by the admin, and
                        once confirmed, you will be granted access to the sales funnel. Kindly wait for the
                        verification process to be completed.
                    </p>

                </div>

                <script>
                // Handle file selection and display the file path
                document.getElementById('proof_image').addEventListener('change', function(event) {
                    const filePath = document.getElementById('file-path');
                    const file = event.target.files[0];

                    if (file) {
                        filePath.textContent = file.name; // Display file name
                    } else {
                        filePath.textContent = '';
                    }
                });
                </script>


                <button type="submit"
                    class="bg-blue-500 text-white py-2 px-6 mt-6 rounded-lg flex items-center space-x-2 hover:bg-blue-600 transition">
                    <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                        <polyline points="17 21 17 13 7 13 7 21" />
                        <polyline points="7 3 7 8 15 8" />
                    </svg>
                    <span>Subscribe Now</span>
                </button>

            </form>
        </div>
        @else


        <!--########### Show this only when setting is OFF No Payment Required to activate funnel ############ -->
        <div class="relative mt-2 p-8  bg-white rounded-3xl border border-gray-200 transition-all">


            {{-- Badge --}}
            <div
                class="absolute top-4 right-4 bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">
                PRO Add-on
            </div>

            {{-- Users Trust --}}
            <div class="flex items-center justify-center gap-2 mt-6 text-sm text-gray-600 font-medium">
                <span class="material-symbols-outlined text-green-500">group</span>
                <span>700+ Users Trust This</span>
            </div>

            {{-- Headline --}}
            <h2 class="text-2xl font-bold text-center text-gray-800 mt-4 mb-2">Activate Your Funnel For – FREE</h2>

            {{-- Subtitle --}}
            <p class="text-gray-600 text-sm text-center mb-6">
                Unlock powerful business tools to grow and scale—no cost to start.
            </p>

            {{-- Feature Checklist --}}
            <ul class="text-gray-700 text-sm space-y-3 mb-6">
                <li class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-green-600">analytics</span>
                    Free Video Analytics
                </li>
                <li class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-green-600">track_changes</span>
                    Free Page View Tracking
                </li>
                <li class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-green-600">slideshow</span>
                    Free Powerful Sales Presentation
                </li>
                <li class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-green-600">domain</span>
                    Free subdomain
                </li>
            </ul>

            {{-- Activate Button --}}
            <form action="{{ route('funnel.activate.direct') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full py-3 px-6 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl shadow-md transition-all duration-300 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-white">rocket_launch</span>
                    Activate Your Funnel
                </button>
            </form>

            {{-- Note --}}
            <p class="text-xs text-gray-500 text-center mt-4">No credit card needed · Instant activation</p>
        </div>


        @endif
        @endif
    </div>
</div>
@endsection