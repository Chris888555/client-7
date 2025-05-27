@extends('layouts.admin')

@section('title', 'Upload Materials')

@section('content')

<div class="container mx-auto p-4 sm:p-8 w-full">

    <x-page-header-text title="Upload Materials" />

    <form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

       <!-- Caption -->
<x-textarea 
    id="caption"
    label="Caption" 
    name="caption" 
    placeholder="Enter caption for image..." 
    :required="old('category') === 'image'"
/>




<!-- Title -->
<x-input-text
    label="Title"
    name="title"
    placeholder="Enter title"
    required
/>

        <div>
            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
            <select name="category" id="category" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg
           focus:outline-none focus:ring-4 focus:ring-teal-400 focus:ring-opacity-50
           focus:border-teal-400 transition-shadow duration-300">

                <option value="">-- Select Category --</option>
                <option value="image">Image</option>
                <option value="video">Video</option>
                <option value="pdf">Pdf</option>
                <option value="legalities">Legalities</option>


            </select>
        </div>

        <div class="mb-6">
            <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                File (Image / Video / PDF)
            </label>
            <div class="flex items-center justify-center w-full">
                <label for="file"
                    class="flex flex-col w-full  p-4 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-blue-50 hover:bg-blue-100 transition">

                    <div class="flex flex-col items-center justify-center">
                        <svg aria-hidden="true" class="w-10 h-10 mb-3 text-teal-600" fill="none" stroke="currentColor"
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
                    <p id="filePath" class="mt-3 text-sm font-medium text-blue-600 text-center break-words"></p>

                    <input type="file" name="file" id="file" accept=".png,.jpg,.jpeg,.mp4,.pdf"
                        class="hidden focus:outline-none" required>
                </label>
            </div>
        </div>



        <!-- Submit -->
        <div>

          <x-button type="submit" icon="cloud_upload">Upload Materials</x-button>


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

// Initial check
toggleCaption();

categorySelect.addEventListener('change', toggleCaption);

function toggleCaption() {
    if (categorySelect.value === 'image') { // 'image' = Image
        captionField.style.display = 'block';
    } else {
        captionField.style.display = 'none';
        document.getElementById('caption').value = ''; // clear caption kapag hindi image
    }
}
</script>

@endsection