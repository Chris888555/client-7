@extends('layouts.admin')

@section('title', 'Create Academy')

@section('content')

<div class="container m-auto p-4 sm:p-8 max-w-full">


    <div class="flex items-center justify-center max-w-[350px] mx-auto p-2 bg-gray-50 rounded-2xl border gap-2">
        <a href="{{ route('academy.create') }}"
            class="w-full text-center  hover:bg-gray-100 bg-gray-100 text-teal-600 px-5 py-2 rounded-xl  transition cursor-pointer">
            Create Academy
        </a>

        <a href="{{ route('academy.edit') }}"
            class="w-full text-center  hover:bg-gray-100 text-gray-800 px-5 py-2 rounded-xl transition cursor-pointer">
            Update Academy
        </a>
    </div>


    <form id="playlistForm" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <!-- Playlist Title -->
        <x-input-text
            name="title"
            label="Video Title"
            placeholder="Enter video title"
            value="{{ old('title') }}"
            required
             
        />

        <!-- Video Link -->
        <x-input-text
            name="video_link"
            label="Video Link (YouTube or MP4)"
            placeholder="Enter video link"
            value="{{ old('video_link') }}"
            required
           
        />

        <!-- Custom File Upload -->
        <div class="mt-4">
             <label for="file" class="block text-sm font-medium text-gray-500 mb-2">
                Image 
            </label>
            <label for="file" class="flex flex-col w-full  p-4 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                <div class="flex flex-col items-center justify-center">
                    <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M4 12l8-8m0 0l8 8m-8-8v12" />
                    </svg>
                    <p class="text-sm text-gray-600 text-center">
                        <span class="font-semibold">Click to upload</span> or drag and drop
                    </p>
                    <p class="text-xs text-gray-500 text-center">Thumbnail Image — Max 10MB</p>
                </div>
                <p id="filePath" class="mt-3 text-sm font-medium text-teal-600 text-center break-words"></p>
                <input type="file" name="file" id="file" accept=".png,.jpg,.jpeg,.mp4,.pdf" class="hidden" required>
            </label>
        </div>

        <!-- Submit -->
        <div class="mt-4">
            <x-button type="submit" icon="fa-solid fa-floppy-disk">Upload Academy Video</x-button>

        </div>
    </form>
</div>


@endsection



@section('js')
<script>
$(document).ready(function () {

    // [1] DISPLAY SELECTED FILE NAME
    $('#file').on('change', function () {
        const fileName = this.files[0]?.name || '';
        $('#filePath').text(fileName); // Display filename beside input
    });

    const form = $('#playlistForm'); // Form target by ID

    // [2] HANDLE FORM SUBMISSION VIA AJAX
    form.on('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        const formData = new FormData(this); // Gather form data including file

        $.ajax({
            type: 'POST',
            url: '{{ route("academy.store") }}', // [Laravel] Backend route
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // [Laravel] CSRF token for security
            },
            success: function (response) {
                // [3] SHOW SUCCESS MESSAGE
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message || 'Upload completed!'
                }).then(() => {
                    form[0].reset(); // Reset form inputs
                    $('#filePath').text(''); // Clear filename display
                });
            },
            error: function (xhr) {
                // [4] HANDLE VALIDATION OR SERVER ERRORS
                let errorMsg = 'Something went wrong.';

                if (xhr.responseJSON) {
                    if (xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    } else if (xhr.responseJSON.errors) {
                        errorMsg = Object.values(xhr.responseJSON.errors).flat().join('\n');
                    }
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Upload Failed',
                    text: errorMsg
                });
            }
        });
    });
});
</script>
@endsection


