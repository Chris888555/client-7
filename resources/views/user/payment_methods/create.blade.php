@extends('layouts.users')

@section('title', 'Payment Method')

@section('content')
<div class="container mx-auto p-4 sm:p-8 max-w-full">

   
     {{-- ✅ Buttons --}}
<div class="flex items-center justify-center max-w-[350px] mx-auto p-2 bg-gray-50 rounded-2xl border gap-2">
    {{-- Create Packages --}}
    <a href="{{ route('payment-method.create') }}"
        class="w-full text-center px-5 py-2 rounded-xl transition cursor-pointer 
        {{ request()->routeIs('payment-method.create') 
            ? 'bg-teal-600 text-white hover:bg-teal-700' 
            : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}">
        Add Mop
    </a>

    {{-- List Packages --}}
    <a href="{{ route('payment-method.list') }}"
        class="w-full text-center px-5 py-2 rounded-xl transition cursor-pointer 
        {{ request()->routeIs('payment-method.list') 
            ? 'bg-teal-600 text-white hover:bg-teal-700' 
            : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}">
        List Mop
    </a>
</div>

    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md mt-6">
    <h4 class="text-sm font-semibold text-yellow-800">Note</h4>
    <p class="text-sm text-yellow-700 mt-1">
        You need to <span class="font-medium">create your Mode of Payment</span> first.  
        This will be linked and used on your sales funnel checkout page so your customers can complete their orders.
    </p>
    </div>


    <form id="payment-method-form" class="space-y-4">
        @csrf

        <x-input-text
            name="method_name"
            label="Payment Method"
            placeholder="Enter payment method Ex: Gcash"
            value="{{ old('method_name') }}"
            required
        />

        <x-input-text
            name="account_name"
            label="Account Name"
            placeholder="Enter account name"
            value="{{ old('account_name') }}"
            required
        />

        <x-input-text
            name="account_number"
            label="Account Number"
            placeholder="Enter account number"
            value="{{ old('account_number') }}"
            required
        />

       <!-- Submit -->
        <div class="mt-4">
            <x-button type="submit" icon="fa-solid fa-floppy-disk">Add Payment Method</x-button>

        </div>
    </form>
</div>
@endsection

@section('js')
<script>
    $('#payment-method-form').on('submit', function(e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: "{{ route('payment-method.store') }}",
            method: "POST",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                    confirmButtonColor: '#3085d6',
                });

                $('#payment-method-form')[0].reset();
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                let messages = Object.values(errors).map(err => err.join(', ')).join('<br>');

                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: messages,
                });
            }
        });
    });
</script>
@endsection
