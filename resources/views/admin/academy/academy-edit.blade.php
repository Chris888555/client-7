@extends('layouts.admin')

@section('title', 'Edit Academy Video')

@section('content')
<div class="container m-auto p-4 sm:p-8 max-w-full">

    <x-page-header-text title="Edit Academy Video" />

    <div class="flex items-center justify-center max-w-[350px] mx-auto p-2 bg-gray-50 rounded-2xl border gap-2">
        <a href="{{ route('academy.create') }}"
            class="w-full text-center hover:bg-gray-100 text-gray-800 px-5 py-2 rounded-xl  transition cursor-pointer">
            Create Academy
        </a>

        <a href="{{ route('academy.edit') }}"
            class="w-full text-center hover:bg-gray-100 bg-gray-100 text-teal-600 px-5 py-2 rounded-xl transition cursor-pointer">
            Update Academy
        </a>
    </div>


    {{-- Table Section --}}
    <div id="playlistTable">

        <div class="my-3">
            <button id="bulkDeleteBtn"
                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-200">
                <i class="fas fa-trash-alt"></i> Delete
            </button>
        </div>

        <div class="overflow-x-auto bg-white rounded-xl shadow-sm border">
            <table class="min-w-full divide-y divide-gray-200 whitespace-nowrap">
                <thead class="bg-gray-100 whitespace-nowrap">
                    <tr class="bg-gray-100">
                        <th class="px-4 py-3 text-left">
                            <input type="checkbox" id="checkAll" class="form-checkbox">
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Title</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Video Link</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Thumbnail</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($playlists))
                    @foreach ($playlists as $playlist)
                    <tr class="border-t whitespace-nowrap" id="row-{{ $playlist->id }}">
                        <td class="px-4 py-3">
                            <input type="checkbox" class="rowCheckbox form-checkbox" value="{{ $playlist->id }}">
                        </td>
                        <td class="px-4 py-3 text-sm text-left">{{ $playlist->title }}</td>
                        <td class="px-4 py-3 text-sm text-left">
                            <a href="{{ $playlist->video_link }}" target="_blank"
                                class="flex items-center text-teal-600 hover:text-blue-500">
                                <i class="fa fa-eye mr-1"></i> View
                            </a>
                        </td>

                        <td class="px-4 py-3 text-sm text-left">
                            @if ($playlist->thumbnail_url)
                            <img src="{{ asset('storage/' . $playlist->thumbnail_url) }}" alt="Thumbnail"
                                class="w-20 h-12 object-cover">
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-left">
                            <button
                                class="edit-btn text-gray-700 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm border shadow-sm transition duration-300 ease-in-out inline-block"
                                data-id="{{ $playlist->id }}" data-title="{{ $playlist->title }}"
                                data-link="{{ $playlist->video_link }}" data-thumbnail="{{ $playlist->thumbnail_url }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                                Update
                            </button>

                        </td>
                    </tr>
                    @endforeach

                    @else
                    <tr>
                        <td colspan="100%" class="px-4 py-6 text-center text-gray-500">
                            <x-no-materials />
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <x-paginations :paginator="$playlists" />
    </div>
    {{-- Hidden Edit Form --}}
    <div id="editFormContainer" style="display:none;">
        <form id="updatePlaylistForm" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" id="formAction" name="formAction">



            <!-- Playlist Title -->
            <x-input-text id="title" name="title" label="Video Title" placeholder="Enter video title"
                value="{{ old('title') }}" required />

            <!-- Video Link -->
            <x-input-text id="video_link" name="video_link" label="Video Link (YouTube or MP4)"
                placeholder="Enter video link" value="{{ old('video_link') }}" />



            <div class="mt-4">
                <label for="file" class="block text-sm font-medium text-gray-500 mb-2">
                    Image
                    <span class="text-xs text-red-400 ml-2">(Leave it empty if you don’t want to change the
                        thumbnail)</span>
                </label>

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
                        <p class="text-xs text-gray-500 text-center">Thumbnail Image — Max 10MB</p>
                    </div>
                    <p id="filePath" class="mt-3 text-sm font-medium text-teal-600 text-center break-words"></p>
                    <input type="file" name="file" id="file" accept=".png,.jpg,.jpeg,.mp4,.pdf" class="hidden">
                </label>
                @error('file')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div class="flex gap-2 mt-4">
                <button type="submit" class="bg-blue-100 text-blue-700 px-4 py-2 rounded hover:bg-blue-200">
                    <i class="fas fa-save mr-2"></i> Update Video
                </button>
                <button type="button" id="cancelEdit"
                    class="bg-red-100 text-gray-700 px-4 py-2 rounded hover:bg-red-200 ml-2">
                    <i class="fa-solid fa-xmark mr-1"></i> Cancel
                </button>

            </div>

        </form>
    </div>
</div>
@endsection

@section('js')
<script>
const fileInput = document.getElementById('file');
const filePathDisplay = document.getElementById('filePath');

// Show selected file
fileInput.addEventListener('change', function() {
    const file = fileInput.files[0];
    filePathDisplay.textContent = file ? `File selected: ${file.name}` : '';
});

$(document).ready(function() {
    // Show and populate form
    $('.edit-btn').on('click', function() {
        const id = $(this).data('id');
        const title = $(this).data('title');
        const link = $(this).data('link');

        $('#title').val(title);
        $('#video_link').val(link);
        $('#formAction').val(`{{ route('academy.update', '') }}/${id}`);


        $('#playlistTable').hide();
        $('#editFormContainer').show();
    });

    // Cancel button
    $('#cancelEdit').on('click', function() {
        $('#editFormContainer').hide();
        $('#playlistTable').show();
        $('#updatePlaylistForm')[0].reset();
        $('#filePath').text('');
    });

    // AJAX form submit
    $('#updatePlaylistForm').on('submit', function(e) {
        e.preventDefault();
        const form = $(this)[0];
        const formData = new FormData(form);
        const actionUrl = $('#formAction').val();

        $.ajax({
            url: actionUrl,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: res.message,
                    confirmButtonColor: '#3085d6'
                }).then(() => location.reload());
            },
            error: function(xhr) {
                const errors = xhr.responseJSON?.errors;
                let errorMsg = 'An error occurred.';

                if (errors) {
                    errorMsg = Object.values(errors).flat().join('\n');
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Update Failed',
                    text: errorMsg
                });
            }
        });
    });
});
</script>

<script>
$('#checkAll').on('click', function() {
    $('.rowCheckbox').prop('checked', this.checked);
});

$('#bulkDeleteBtn').on('click', function(e) {
    e.preventDefault();

    const selectedIds = $('.rowCheckbox:checked').map(function() {
        return $(this).val();
    }).get();

    if (selectedIds.length === 0) {
        Swal.fire('No items selected', 'Please select at least one video to delete.', 'warning');
        return;
    }

    Swal.fire({
        title: 'Are you sure?',
        text: "The selected materials will be deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("academy.bulkDelete") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    ids: selectedIds
                },
                success: function(response) {
                    // Remove rows
                    selectedIds.forEach(function(id) {
                        $('#row-' + id).remove();
                    });

                    Swal.fire('Deleted!', response.message, 'success');
                },
                error: function(xhr) {
                    Swal.fire('Error', xhr.responseJSON.message, 'error');
                }
            });
        }
    });
});
</script>

@endsection