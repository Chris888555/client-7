@extends('layouts.admin')

@section('title', 'Upload Materials')

@section('content')

<div class="container m-auto p-4 sm:p-8 max-w-full">


    <div class="flex items-center justify-center max-w-[350px] mx-auto p-2 bg-gray-50 rounded-2xl border gap-2">
        <a href="{{ route('materials.create') }}"
            class="w-full text-center  hover:bg-gray-100 bg-gray-100 text-teal-600 px-5 py-2 rounded-xl  transition cursor-pointer">
            Create Materials
        </a>

        <a href="{{ route('materials.show') }}"
            class="w-full text-center  hover:bg-gray-100 text-gray-800 px-5 py-2 rounded-xl transition cursor-pointer">
            Update Materials
        </a>
    </div>


    <form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm"
        class="space-y-4">
        @csrf

        <div>
            <label for="category" class="block text-sm font-medium text-gray-500 mb-2">Category</label>
            <select name="category" id="category" required class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg
           focus:outline-none cursor-pointer">

                <option value="">Select Category</option>
                <option value="Marketing Images">Marketing Images</option>
                <option value="Marketing Videos">Marketing Videos</option>
                <option value="PDF Slides Copy">PDF Slides Copy</option>
                <option value="Company Documents">Company Documents</option>


            </select>
        </div>

        <!-- Title -->
        <div id="title-wrapper">
            <x-input-text label="Title" name="title" placeholder="Enter title, atlest 50 characters" required />
        </div>


        <div>
            <label for="caption" class="block text-sm font-semibold text-gray-500 mb-2">
                Caption
            </label>
            <textarea name="caption" id="caption" @if(old('category')==='image' ) required @endif
                placeholder="Type your caption here ..." class="w-full px-4 py-3 border border-gray-300 rounded-lg
                        focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50
                        focus:border-gray-400 transition-shadow duration-300"></textarea>
        </div>

        <div class="mb-6">
            <label for="file" class="block text-sm font-medium text-gray-500 mb-2">
                File (Image / Video / PDF)
            </label>
            <div class="flex items-center justify-center w-full">
                <label for="file"
                    class="flex flex-col w-full  p-4 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition">

                    <div class="flex flex-col items-center justify-center">
                        <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-600" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M4 12l8-8m0 0l8 8m-8-8v12" />
                        </svg>
                        <p class="text-sm text-gray-600 text-center">
                            <span class="font-semibold">Click to upload</span> or drag and drop
                        </p>
                        <p class="text-xs text-gray-500 text-center">PNG, JPG, MP4, PDF — Max 10MB</p>
                    </div>

                    <!-- File path text inside the padded label -->
                    <p id="filePath" class="mt-3 text-sm font-medium text-teal-600 text-center break-words"></p>

                    <input type="file" name="file" id="file" accept=".png,.jpg,.jpeg,.mp4,.pdf"
                        class="hidden focus:outline-none" required>
                </label>
            </div>
        </div>
        <div>

      <x-button type="submit" icon="fa-solid fa-floppy-disk">Upload Materials</x-button>

        </div>
    </form>
</div>


<script>
// Select the input field and the element to show the file path
const fileInput = document.getElementById('file');
const filePathDisplay = document.getElementById('filePath');

// Add event listener for when a file is selected
fileInput.addEventListener('change', function() {
    const file = fileInput.files[0];

    if (file) {
        // Show the file path below the upload button in blue color
        filePathDisplay.textContent = `File selected: ${file.name}`;
    } else {
        filePathDisplay.textContent = ''; // Clear if no file is selected
    }
});
</script>


<script>
const categorySelect = document.getElementById('category');
const captionField = document.getElementById('caption').parentElement;
const titleWrapper = document.getElementById('title-wrapper');
const titleInput = titleWrapper.querySelector('input[name="title"]');

// Initial check
toggleFields();

categorySelect.addEventListener('change', toggleFields);

function toggleFields() {
    const category = categorySelect.value;

    // Caption field toggle (from existing logic)
    if (category === 'Marketing Images') {
        captionField.style.display = 'block';
    } else {
        captionField.style.display = 'none';
        document.getElementById('caption').value = '';
    }

    // Title field toggle (hide for Marketing Images only)
    if (category === 'Marketing Images') {
        titleWrapper.style.display = 'none';
        titleInput.value = '';
        titleInput.required = false;
    } else {
        titleWrapper.style.display = 'block';
        titleInput.required = true;
    }

}
</script>

@endsection


@section('js')
<script>
document.getElementById('uploadForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;
    const formData = new FormData(form);

    fetch(form.action, {
            method: form.method,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData,
        })
        .then(res => {
            if (!res.ok) throw new Error('Network error');
            return res.json();
        })
        .then(data => {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message || 'Uploaded!',
                showConfirmButton: true,
            });
            form.reset();
            document.getElementById('filePath').textContent = '';
        })
        .catch(err => {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: err.message || 'Something went wrong',
                showConfirmButton: true,
            });
        });
});
</script>
@endsection