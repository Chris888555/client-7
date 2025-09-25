@extends('layouts.users')

@section('title', 'Update Buttons')

@section('content')
<div class="container m-auto p-4 sm:p-8 max-w-full space-y-8">

<!-- ✅ Reminder Note Card -->
    <div class="w-full mx-auto bg-yellow-50 border border-yellow-300 rounded-xl shadow-sm p-4">
        <div class="flex items-start gap-3">
            <!-- Icon (FAFA) -->
            <div class="flex-shrink-0">
                <i class="fas fa-circle-exclamation text-yellow-600 text-lg"></i>
            </div>

            <!-- Text -->
            <div class="flex-1">
                <h3 class="text-sm font-semibold text-yellow-800">Important Reminder</h3>
                <p class="mt-1 text-sm text-yellow-700 leading-relaxed">
                    Please make sure to <span class="font-semibold">update all button links</span> with the correct URLs 
                    so users will be redirected to the proper pages. Double-check before saving.
                </p>
            </div>
        </div>
    </div>


    <form id="buttonsForm" class="space-y-6">
        @csrf

        <!-- Messenger Button URL -->
        <x-input-text 
            label="Messenger Button URL" 
            name="messenger_btn" 
            type="url" 
            :value="$funnel->messenger_btn" 
            error-id="messengerError"
        />

        <!-- Messenger Button State -->
        <div class="flex items-center gap-2">
            <input type="checkbox" name="messenger_btn_state" value="1" {{ $funnel->messenger_btn_state ? 'checked' : '' }}>
            <label>Show Messenger Button</label>
        </div>

        <!-- Referral Button URL -->
        <x-input-text 
            label="Referral Button URL" 
            name="referral_btn" 
            type="url" 
            :value="$funnel->referral_btn" 
            error-id="referralError"
        />

        <!-- Referral Button State -->
        <div class="flex items-center gap-2">
            <input type="checkbox" name="referral_btn_state" value="1" {{ $funnel->referral_btn_state ? 'checked' : '' }}>
            <label>Show Referral Button</label>
        </div>

        <!-- Shop Button URL -->
        <x-input-text 
            label="Shop Button URL" 
            name="shop_btn" 
            type="url" 
            :value="$funnel->shop_btn" 
            error-id="shopError"
        />

        <!-- Shop Button State -->
        <div class="flex items-center gap-2">
            <input type="checkbox" name="shop_btn_state" value="1" {{ $funnel->shop_btn_state ? 'checked' : '' }}>
            <label>Show Shop Button</label>
        </div>

       <!-- Submit Button -->
        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition flex items-center justify-center gap-2">
            <i class="fas fa-save"></i>
            Save Changes
        </button>


    </form>
</div>

<script>
document.getElementById('buttonsForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch("{{ route('funnel.updateButtons') }}", {
        method: "POST",
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: data.message,
                confirmButtonText: 'OK',
                showConfirmButton: true,
            });
        }
    })
    .catch(err => {
        let errors = err.response?.json?.() || {};
        ['messenger','referral','shop'].forEach(id => {
            document.getElementById(id+'Error').classList.add('hidden');
            document.getElementById(id+'Error').innerText = '';
        });
        if(errors.errors){
            if(errors.errors.messenger_btn){
                document.getElementById('messengerError').classList.remove('hidden');
                document.getElementById('messengerError').innerText = errors.errors.messenger_btn[0];
            }
            if(errors.errors.referral_btn){
                document.getElementById('referralError').classList.remove('hidden');
                document.getElementById('referralError').innerText = errors.errors.referral_btn[0];
            }
            if(errors.errors.shop_btn){
                document.getElementById('shopError').classList.remove('hidden');
                document.getElementById('shopError').innerText = errors.errors.shop_btn[0];
            }
        }
    });
});
</script>

@endsection
