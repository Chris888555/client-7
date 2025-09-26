@extends('layouts.admin')

@section('title', 'Upload Image')

@section('content')

<div class="container m-auto p-4 sm:p-8 max-w-full">

 
{{-- ✅ Buttons --}}
<div class="flex items-center justify-center max-w-[350px] mx-auto p-2 bg-gray-50 rounded-2xl border gap-2">
    {{-- Create Materials --}}
    <a href="{{ route('materials.create') }}"
        class="w-full text-center px-5 py-2 rounded-xl transition cursor-pointer 
        {{ request()->routeIs('materials.create') 
            ? 'bg-teal-600 text-white hover:bg-teal-700' 
            : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}">
        Create Materials
    </a>

    {{-- List Materials --}}
    <a href="{{ route('materials.show') }}"
        class="w-full text-center px-5 py-2 rounded-xl transition cursor-pointer 
        {{ request()->routeIs('materials.show') 
            ? 'bg-teal-600 text-white hover:bg-teal-700' 
            : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}">
        List Materials
    </a>
</div>



    <form id="uploadForm" method="POST" action="{{ route('materials.store') }}" enctype="multipart/form-data">
        @csrf

        {{-- Category --}}
        <div class="mb-4">
            <label for="category" class="text-gray-600 font-medium block mb-1">Category <span class="text-red-500">*</span></label>
            <select name="category" id="category" class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-700 focus:outline-none focus:ring focus:ring-gray-200" required>
                <option value="">-- Select Type --</option>
                <option value="FB Ads">FB Ads</option>
                <option value="Posting">Posting</option>
                <option value="Stories">Stories</option>
                <option value="Product">Product</option>
                <option value="Cover Photo">Cover Photo</option>
                <option value="Testimonial">Testimonial</option>
            </select>
        </div>

        {{-- Caption --}}
        <div class="mb-4">
            <label for="caption" class="text-gray-600 font-medium block mb-1">Caption <span class="text-red-500">*</span></label>
            <textarea name="caption" id="caption" rows="3" placeholder="Enter caption (optional)" class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-700 focus:outline-none focus:ring focus:ring-gray-200"></textarea>
        </div>

        {{-- File Upload --}}
        <div class="mb-4">
    <label for="file" class="text-gray-600 font-medium block mb-1">
        Upload Image <span class="text-red-500">*</span>
    </label>

    <div id="uploadBox"
         class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center 
                bg-gray-50 hover:border-green-400 transition cursor-pointer">
        
        <input type="file" name="file" id="file" class="hidden" accept=".jpg,.jpeg,.png" required>

        <label for="file" class="flex flex-col items-center justify-center text-gray-500 cursor-pointer">
            <!-- Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6h.1a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
            </svg>
            <!-- Text -->
            <p class="mb-1">Click to upload or drag image here</p>
            <small class="text-gray-400">Only JPG or PNG (max 2MB)</small>
        </label>

        <!-- File path output -->
        <p id="filePath" class="mt-2 text-blue-600 text-sm font-semibold"></p>
    </div>
</div>

<script>
document.getElementById('file').addEventListener('change', function (e) {
    const file = e.target.files[0];
    const filePath = document.getElementById('filePath');
    if (file) {
        filePath.textContent = file.name;
    } else {
        filePath.textContent = "";
    }
});
</script>


       {{-- Submit --}}
        <x-button type="submit" icon="fa-solid fa-floppy-disk">
            Save Image
        </x-button>
        >

    </form>
</div>


@endsection

@section('js')
<script>
document.getElementById('uploadForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = this;
    const formData = new FormData(form);

    Swal.fire({
        title: 'Uploading...',
        html: 'Please wait while we upload your image.',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) throw new Error('Upload failed');
            return response.json();
        })
        .then(data => {
            Swal.fire('Success', data.message || 'Uploaded!', 'success');
            form.reset();
            document.getElementById('filePath').textContent = '';
        })
        .catch(error => {
            Swal.fire('Error', error.message || 'Something went wrong.', 'error');
        });
});
</script>
@endsection
