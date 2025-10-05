@extends('layouts.admin')

@section('title', 'Theme Settings')

@section('content')
<div class="container mx-auto p-4 sm:p-8 max-w-full">

<form id="clearCacheForm" class="inline">
    @csrf
    <button id="clearCacheBtn" type="button" class="bg-red-600 text-white px-4 py-2 rounded-lg">
        Clear Cache
    </button>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('clearCacheBtn').addEventListener('click', function(e) {
    e.preventDefault();

    Swal.fire({
        title: 'Clear cache now?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, clear it'
    }).then(result => {
        if (!result.isConfirmed) return;

        fetch("{{ route('clear.cache') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            credentials: 'same-origin' // ensure cookies/session sent
        })
        .then(async res => {
            const text = await res.text();
            let data = null;
            try { data = JSON.parse(text); } catch(e) { /* non-json */ }

            if (res.ok && data && data.success) {
                Swal.fire({ icon: 'success', title: data.message, timer: 1500, showConfirmButton: false });
            } else {
                console.error('Clear cache failed', res.status, text);
                const msg = (data && data.message) ? data.message : `Error ${res.status}`;
                Swal.fire({ icon: 'error', title: msg });
            }
        })
        .catch(err => {
            console.error('Network/Fetch error', err);
            Swal.fire({ icon: 'error', title: 'Network error. Check console.' });
        });
    });
});
</script>

<button id="refreshStorageBtn" 
    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
    Refresh Storage 
</button>

<script>
document.getElementById('refreshStorageBtn').addEventListener('click', function() {
    Swal.fire({
        title: 'Reconnect storage?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, reconnect'
    }).then(result => {
        if (!result.isConfirmed) return;

        fetch("{{ route('refresh.storage') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                Swal.fire({ icon: 'success', title: data.message, timer: 2000, showConfirmButton: false });
            } else {
                Swal.fire({ icon: 'error', title: data.message });
            }
        })
        .catch(() => {
            Swal.fire({ icon: 'error', title: 'Something went wrong!' });
        });
    });
});
</script>



    <form id="themeForm" class="space-y-4 mt-8">
        @csrf
        @method('POST')

        @php
            $fields = [
                'sidebar_bg' => 'Sidebar Background',
                'nav_hover_bg_color' => 'Nav Hover BG Color',
                'icon_bg_color' => 'Icon Background',
                'nav_text_color' => 'Nav Text Color',
                'nav_text_hover_color' => 'Nav Hover Text Color',
                'icon_text' => 'Icon Text Color',
             
            ];
        @endphp

        @foreach ($fields as $name => $label)
        <div>
            <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
            <div class="flex items-center gap-2">
                <input type="color" id="{{ $name }}" name="{{ $name }}" value="{{ $theme->$name }}" class="w-14 h-10 border rounded cursor-pointer color-picker" data-hex-input="{{ $name }}_hex">

               <input type="text" id="{{ $name }}_hex" value="{{ $theme->$name }}" class="w-28 px-2 py-1 text-sm border rounded bg-gray-100 text-gray-700 hex-input" data-color-input="{{ $name }}">


                <button type="button" onclick="copyToClipboard('{{ $name }}_hex')" class="text-blue-600 hover:text-blue-800">
                    <i class="fas fa-copy"></i>
                </button>
            </div>
        </div>
        @endforeach

        <button type="submit" class="bg-slate-800 text-white px-4 py-2 rounded-md hover:bg-slate-900 flex items-center gap-2">
            <i class="fa fa-save"></i>
            Save Theme
        </button>

    </form>
</div>
@endsection

@section('js')
<script>
    // Sync HEX value on color input change
  // Sync color input when hex is changed manually or pasted
document.querySelectorAll('.hex-input').forEach(input => {
    input.addEventListener('input', function () {
        const colorPicker = document.getElementById(this.dataset.colorInput);
        const val = this.value.trim();

        // Validate and apply only if proper hex
        if (/^#([0-9A-F]{3}){1,2}$/i.test(val)) {
            colorPicker.value = val;
        }
    });
});


    // Copy HEX to clipboard
    function copyToClipboard(inputId) {
        const input = document.getElementById(inputId);
        input.select();
        input.setSelectionRange(0, 99999);
        document.execCommand('copy');

        Swal.fire({
            icon: 'success',
            title: 'Copied!',
            text: input.value + ' copied to clipboard',
            confirmButtonText: 'OK',
            showConfirmButton: true
        });
    }

    // AJAX form submission
    document.getElementById('themeForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);

        fetch(`{{ route('admin.theme.update') }}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message || 'Theme updated successfully!',
                confirmButtonText: 'OK',
                showConfirmButton: true
            }).then(() => {
                location.reload();
            });
        })

        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: 'Something went wrong while saving.',
                confirmButtonText: 'OK',
                showConfirmButton: true
            });
        });
    });
</script>
@endsection