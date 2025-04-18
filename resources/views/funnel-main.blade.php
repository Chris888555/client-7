@extends('layouts.app')

@section('title', 'Sales Funnel Link')

@section('content')

@include('includes.nav')

     <div class="container m-auto p-4 sm:p-8 max-w-full">
     
        <h1 class="text-2xl md:text-3xl font-bold text-left">Sales Funnel Links</h1>
        <p class="text-gray-600 text-left mb-4">Manage and share your custom funnel links.</p>

        <ul class="space-y-4">
            <!-- Loop through only the logged-in user's data -->
            <li class="bg-white p-8 rounded-lg border-2 border-gray-200">

                <div class="bg-gray-100 p-4 rounded-lg shadow-inner">
                    <p class="text-blue-600 font-medium text-center break-all">{{ url($user->subdomain) }}</p>
                </div>

                <div class="flex flex-wrap justify-center gap-2 mt-4">
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

                    <!-- Update Subdomain Button -->
                    <button onclick="openModal('{{ $user->id }}', '{{ $user->subdomain }}')"
                        class="bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600 flex items-center w-full md:w-auto">
                        <i class="ph ph-pencil-simple mr-2"></i> Update Subdomain
                    </button>

                    <!-- Edit Funnel Button -->
                    <a href="{{ route('edit-funnel') }}"
                        class="bg-purple-500 text-white px-4 py-2 rounded-lg shadow hover:bg-purple-600 hover:shadow-lg flex items-center w-full md:w-auto transition-all duration-300">
                        <i class="ph ph-pencil mr-2"></i> Edit Funnel
                    </a>



            </li>
        </ul>

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

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <div class="container m-auto p-4 sm:p-8 max-w-full">
        <div x-data="{ open: false }" class="w-full mx-auto p-6 bg-white  p-8 rounded-lg  border-2 border-gray-200">
            <button @click="open = !open"
                class="text-xl font-bold text-gray-800 w-full text-left flex justify-between items-center">
                Paano Gamitin ang Sales Funnel
                <span x-text="open ? '▲' : '▼'"></span>
            </button>

            <div x-show="open" x-transition class="mt-4 bg-yellow-300 p-6 rounded-lg">
                <p class="text-gray-600 mb-4">Ang sales funnel ay proseso ng pag-convert ng mga bisita sa customers.
                    Narito ang simpleng hakbang:</p>

                <ul class="list-disc pl-6 space-y-2 text-gray-700">
                    <li><span class="font-semibold">Maghanap ng mga potensyal na kliyente –</span> Mahalaga na may
                        makakita ng iyong sales funnel. Maaari kang mag-run ng ads o mag-post sa social media upang
                        makahanap ng mga interesadong kliyente.</li>
                    <li><span class="font-semibold">Ipasok sila sa sales funnel –</span> Siguraduhing dumaan sila sa
                        sales funnel upang ma-educate sila nang tama tungkol sa iyong produkto o serbisyo.</li>
                    <li><span class="font-semibold">Gawing epektibo ang follow-up –</span> Mahalaga ang follow-up upang
                        mapabalik sila sa iyong funnel. Maaari kang magbigay ng valuable information na makakatulong sa
                        kanila sa pagdedesisyon.</li>
                </ul>

                <p class="mt-4 text-gray-800 font-semibold">Tandaan, ang tamang diskarte at tuloy-tuloy na follow-up ang
                    susi sa mas mataas na conversion!</p>
            </div>
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