@extends('layouts.app')

@section('title', 'My Clients Payment')

@section('content')

@include('includes.nav')

<!-- Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<div x-data="{ showModal: false, modalImage: '' }" class="container m-auto p-4 sm:p-8 max-w-full">

    <h1 class="text-2xl md:text-3xl font-bold text-left">List Of All Payments</h1>
    <p class="text-gray-600 text-left mb-4">Monitor your clients payments here.</p>

    <div x-data="{ showNote: true }" x-show="showNote"
        class="bg-yellow-100 border-l-4 border-yellow-500 p-4 text-gray-700 mb-6 relative">
        <button @click="showNote = false"
            class="absolute top-1/2 right-2 transform -translate-y-1/2 text-gray-700 hover:text-gray-900 focus:outline-none font-bold">
            &times;
        </button>
        <p class="font-medium">
            Click the image to view it larger.
        </p>
    </div>





    @if($payments->isEmpty())
    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
        <p>No payment records found.</p>
    </div>
    @else
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 whitespace-nowrap">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Number
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barangay
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Zip</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($payments as $payment)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $payment->first_name }}
                        {{ $payment->last_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $payment->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $payment->number }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $payment->shipping_address }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $payment->barangay }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $payment->zip_code }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($payment->image)
                        <img src="{{ asset('storage/' . $payment->image) }}" alt="Payment Image"
                            class="cursor-pointer w-16 h-auto object-cover rounded-md"
                            @click="modalImage = '{{ asset('storage/' . $payment->image) }}'; showModal = true" />
                        @else
                        <span class="text-sm text-gray-500">No image</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form action="{{ route('payments.destroy', $payment->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this payment?');">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition flex items-center"
                                onclick="event.preventDefault(); 
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('form').submit();
                }
            });">
                                <svg class="h-5 w-5 text-white mr-2" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6" />
                                    <path
                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                    <line x1="10" y1="11" x2="10" y2="17" />
                                    <line x1="14" y1="11" x2="14" y2="17" />
                                </svg>
                                Delete
                            </button>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- Pagination Links -->
    <div class="mt-4 flex justify-center">
        {{ $payments->links() }}
    </div>

    @endif

    <!-- Modal -->
    <div x-show="showModal" x-transition
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4"
        @click.self="showModal = false">

        <!-- Close Button -->
        <button class="absolute top-2 right-2 text-gray-600 hover:text-black text-2xl font-bold"
            @click="showModal = false">
            <svg class="h-8 w-8 text-slate-50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                <line x1="9" y1="9" x2="15" y2="15" />
                <line x1="15" y1="9" x2="9" y2="15" />
            </svg>
        </button>
        <div class="bg-white rounded-lg overflow-hidden shadow-lg max-w-2xl w-full p-4 relative">
            <!-- Image -->
            <img :src="modalImage" alt="Preview" class="w-full h-auto rounded">

            <!-- Download Button -->
            <a :href="modalImage" download="payment_image"
                class="mt-4 inline-block px-6 py-2 text-white bg-blue-500 hover:bg-blue-700 rounded-md text-sm">
                Download Image
            </a>
        </div>
    </div>

</div>

@endsection