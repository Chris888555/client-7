@extends('layouts.app')

@section('title', 'Upload Payment Method')

@section('content')

@include('includes.nav')

<!-- Alpine.js CDN -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<div x-data="{ open: false }" class="container m-auto p-4 sm:p-8 max-w-full">


    <!-- Upload Form -->
    <div class="mt-0">
        <h1 class="text-2xl md:text-3xl font-bold text-left">Upload Payment Method</h1>
        <p class="text-gray-600 text-left mb-6">Please fill in the details for your payment method to be added.</p>

        <form method="POST" action="{{ route('payment-method.store') }}" class="space-y-4">
            @csrf

            <div>
                <label for="method_name" class="block font-medium text-gray-700">Payment Method Name</label>
                <input type="text" id="method_name" name="method_name" required
                    class="mt-2 w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="account_name" class="block font-medium text-gray-700">Account Holder Name</label>
                <input type="text" id="account_name" name="account_name" required
                    class="mt-2 w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="account_number" class="block font-medium text-gray-700">Account Number</label>
                <input type="text" id="account_number" name="account_number" required
                    class="mt-2 w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="text-center">
                <button type="submit"
                    class="cursor-pointer bg-blue-700 w-full sm:max-w-[300px] text-white py-2 rounded-lg  text-lg transition-all duration-300 hover:bg-blue-800 flex items-center justify-center mt-6">

                    <!-- SVG Icon -->
                    <svg class="h-5 w-5 text-slate-50 mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                        <circle cx="12" cy="14" r="2" />
                        <polyline points="14 4 14 8 8 8 8 4" />
                    </svg>

                    Save Payment Method
                </button>
            </div>

        </form>
    </div>

    <!-- List of Uploaded Methods -->
    <div class="overflow-x-auto bg-white p-8 rounded-lg shadow  mx-auto mt-8">
        <h1 class="text-2xl md:text-3xl font-bold text-left">Manage Payment Method</h1>
        <p class="text-gray-600 text-left mb-6">Update or delete your saved payment method or add a new one.</p>

        <table class="w-full border border-gray-200 whitespace-nowrap">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-3 border-b">#</th>
                    <th class="p-3 border-b">Method Name</th>
                    <th class="p-3 border-b">Account Name</th>
                    <th class="p-3 border-b">Account Number</th>
                    <th class="p-3 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paymentMethods as $index => $method)
                <tr class="border-b">
                    <td class="p-3">{{ $index + 1 }}</td>
                    <td class="p-3">{{ $method->method_name }}</td>
                    <td class="p-3">{{ $method->account_name }}</td>
                    <td class="p-3">{{ $method->account_number }}</td>

                    <td class="p-3 space-x-2 flex items-center">
                        <!-- Update Button -->
                        <button
                            class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition flex items-center"
                            @click.prevent="
            open = true;
            $refs.id.value = '{{ $method->id }}';
            $refs.method_name.value = '{{ $method->method_name }}';
            $refs.account_name.value = '{{ $method->account_name }}';
            $refs.account_number.value = '{{ $method->account_number }}';
        ">
                            <svg class="h-5 w-5 text-slate-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Update
                        </button>

                        <!-- Delete Button -->
                        <form action="{{ route('payment-method.destroy', $method->id) }}" method="POST" class="inline">
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
                        </form>


                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Update Modal -->
    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg max-w-md w-full relative">
            <h3 class="text-lg font-bold mb-4">Update Payment Method</h3>
            <form method="POST" :action="'/payment-method/' + $refs.id.value + '/update'">
                @csrf
                @method('PUT')

                <input type="hidden" name="id" x-ref="id">

                <div class="mb-4">
                    <label class="block text-gray-700">Payment Method Name</label>
                    <input type="text" name="method_name" x-ref="method_name" required
                        class="w-full border rounded p-2 mt-1">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Account Name</label>
                    <input type="text" name="account_name" x-ref="account_name" required
                        class="w-full border rounded p-2 mt-1">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Account Number</label>
                    <input type="text" name="account_number" x-ref="account_number" required
                        class="w-full border rounded p-2 mt-1">
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" @click="open = false"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection