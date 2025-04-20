@extends('layouts.app')

@section('title', 'Sales Funnel Link')

@section('content')

@include('includes.nav')

<div class="container m-auto p-4 sm:p-8 max-w-full">

    <h1 class="text-2xl md:text-3xl font-bold text-left">Sales Funnel Links</h1>
    <p class="text-gray-600 text-left mb-4">Manage and share your custom funnel links.</p>

    <!-- Update Subdomain Button -->
    <button onclick="openModal('{{ $user->id }}', '{{ $user->subdomain }}')"
        class="mb-8 bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600 flex items-center w-full md:w-auto">
        <svg class="h-5 w-5 text-white mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
        Update Subdomain
    </button>


    <ul class="space-y-4">
        <!-- Loop through only the logged-in user's data -->
        <li class="bg-white p-8 rounded-lg border-2 border-gray-200">

            <div class="bg-gray-100 p-4 rounded-lg shadow-inner">
                <div class="flex items-left justify-start space-x-2">
                    <svg class="h-6 w-6 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 7h3a5 5 0 0 1 5 5 5 5 0 0 1-5 5h-3m-6 0H6a5 5 0 0 1-5-5 5 5 0 0 1 5-5h3" />
                        <line x1="8" y1="12" x2="16" y2="12" />
                    </svg>
                    <p class="text-blue-600 font-medium text-center break-all">{{ url($user->subdomain) }}</p>
                </div>
            </div>




            <div class="flex flex-wrap justify-start gap-2 mt-4">
                <!-- Copy Link Button -->
                <button onclick="copyToClipboard('{{ url($user->subdomain) }}')"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 flex items-center w-full md:w-auto">
                    <i class="ph ph-copy mr-2"></i> Copy Link
                </button>

                <!-- View Funnel Button -->
                <a href="{{ url($user->subdomain) }}" target="_blank"
                    class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 flex items-center w-full md:w-auto">
                    <i class="ph ph-eye mr-2"></i> View Funnel
                </a>



                <!-- Edit Funnel Button -->
                <a href="{{ route('edit-funnel') }}"
                    class="bg-purple-500 text-white px-4 py-2 rounded-lg shadow hover:bg-purple-600  flex items-center w-full md:w-auto transition-all duration-300">
                    <i class="ph ph-pencil mr-2"></i> Edit Funnel
                </a>



        </li>
    </ul>


    <!-- Payment form -->
    <div class="bg-white p-8 rounded-lg border-2 border-gray-200 mt-8">
        <div class="bg-gray-100 p-4 rounded-lg shadow-inner">
            <div class="flex items-left justify-start space-x-2 ">
                <svg class="h-6 w-6 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 7h3a5 5 0 0 1 5 5 5 5 0 0 1-5 5h-3m-6 0H6a5 5 0 0 1-5-5 5 5 0 0 1 5-5h3" />
                    <line x1="8" y1="12" x2="16" y2="12" />
                </svg>
                <p class="text-blue-600 font-medium text-center break-all  ">{{ url($user->subdomain) }}/payment-form
                </p>
            </div>
        </div>

        <div class="flex flex-wrap justify-start gap-2 mt-4">
            <!-- Copy Link Button -->
            <button onclick="copyToClipboard('{{ url($user->subdomain) }}/payment-form')"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 flex items-center w-full md:w-auto">
                <i class="ph ph-copy mr-2"></i> Copy Link
            </button>

            <!-- View Funnel Button -->
            <a href="{{ url($user->subdomain) }}/payment-form" target="_blank"
                class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 flex items-center w-full md:w-auto">
                <i class="ph ph-eye mr-2"></i> View Form
            </a>



            <!-- Edit Funnel Button -->
            <a href="{{ route('payment-method.create') }}"
                class="bg-purple-500 text-white px-4 py-2 rounded-lg shadow hover:bg-purple-600 flex items-center w-full md:w-auto transition-all duration-300">
                <i class="ph ph-pencil mr-2"></i> Edit Payment Method
            </a>
        </div>

        <!-- Payment form end -->

    </div>



    <!-- MODAL -->
    <div id="modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden p-4">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm">
            <h2 class="text-xl font-bold mb-4 text-center">Update Subdomain</h2>

            <form id="updateForm" method="POST">
                @csrf
                <input type="hidden" id="userId" name="user_id">

                <label class="block text-gray-600 mb-2">New Subdomain</label>
                <input type="text" id="subdomain" name="subdomain" class="w-full p-2 border rounded-lg mb-2" required
                    oninput="validateSubdomain(this)">

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
    function copyToClipboard(link) {
        navigator.clipboard.writeText(link).then(() => {
            // ✅ SweetAlert Success Message
            Swal.fire({
                icon: 'success',
                title: 'Copied!',
                text: 'The link has been copied to clipboard.',
                showConfirmButton: false,
                timer: 1500
            });
        });
    }

    function openModal(userId, subdomain) {
        document.getElementById('userId').value = userId;
        document.getElementById('subdomain').value = subdomain;

        // Set correct form action dynamically
        document.getElementById('updateForm').action = "/subdomain/update/" + userId;

        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }
    </script>

    <script>
    function validateSubdomain(input) {
        let regex = /^[a-zA-Z0-9-]+$/; // Allowed: letters, numbers, and hyphen
        let errorText = document.getElementById("errorText");

        if (!regex.test(input.value)) {
            input.value = input.value.replace(/[^a-zA-Z0-9-]/g, ""); // Remove invalid characters
            errorText.classList.remove("hidden");
        } else {
            errorText.classList.add("hidden");
        }
    }
    </script>

    @endsection