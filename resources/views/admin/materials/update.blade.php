@extends('layouts.admin')

@section('title', 'Update Materials')

@section('content')

<div class="container m-auto p-4 sm:p-8 max-w-full">
    <x-page-header-text title="Manage Materials" />

    <div class="flex items-center justify-center max-w-[350px] mx-auto p-2 bg-gray-50 rounded-2xl border gap-2">
        <a href="{{ route('materials.create') }}"
            class="w-full text-center  hover:bg-gray-100 text-gray-800  px-5 py-2 rounded-xl  transition cursor-pointer">
            Create Materials
        </a>

        <a href="{{ route('materials.show') }}"
            class="w-full text-center  hover:bg-gray-100 bg-gray-100 text-teal-600 px-5 py-2 rounded-xl transition cursor-pointer">
            Update Materials
        </a>
    </div>


    <!-- Filter + Table -->
    <div id="materialsWrapper">
        <div class="flex flex-row items-end gap-4 mb-6 max-w-full flex-wrap mt-6">
            <form method="GET" action="{{ route('materials.show') }}">
                <div class="flex flex-col">
                    <label for="filterCategory" class="text-sm font-medium text-gray-700 mb-1">Filter by
                        Category</label>
                    <select id="filterCategory" name="category" onchange="this.form.submit()"
                        class="py-2 border border-gray-300 rounded-lg p-3 focus:outline-none w-40 sm:w-64 cursor-pointer">
                        <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>All Categories</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </form>



            <button id="delete-selected"
                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-200 h-fit flex items-center gap-2">
                <i class="fas fa-trash-alt"></i>
                Delete
            </button>
        </div>


        <div class="overflow-x-auto bg-white rounded-xl shadow-sm border">
            <table class="min-w-full divide-y divide-gray-200 whitespace-nowrap" id="materialsTable">
                <thead class="bg-gray-100 whitespace-nowrap">
                    <tr>
                        <th class="px-4 py-3 text-left">
                            <input type="checkbox" id="select-all" class="form-checkbox">
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">File</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Category</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Title</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Caption</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($materials->count())
                    @foreach ($materials as $material)
                    <tr id="material-row-{{ $material->id }}" data-category="{{ $material->category }}">
                        <td class="px-4 py-3 text-sm text-left">
                            <input type="checkbox" class="material-checkbox form-checkbox" value="{{ $material->id }}">
                        </td>
                        <td class="px-4 py-3 text-sm text-left">
                            <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank"
                                class="text-teal-600 hover:text-blue-500 mr-3">
                                <i class="fa-solid fa-eye"></i> View
                            </a>

                        </td>

                        <td class="px-4 py-3 text-sm text-left">{{ $material->category ?? 'N/A' }}</td>
                        <td class="px-4 py-3 text-sm text-left">{{ $material->title ?? 'N/A' }}</td>
                        <td class="px-4 py-3 text-sm text-left">
                            {{ isset($material->caption) ? (strlen($material->caption) > 30 ? substr($material->caption, 0, 30) . '...' : $material->caption) : 'N/A' }}
                        </td>
                        <td class="px-4 py-3 text-sm text-left">
                            <a href="#"
                                class="trigger-edit text-gray-700 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm border shadow-sm transition duration-300 ease-in-out inline-block"
                                data-id="{{ $material->id }}" data-category="{{ $material->category }}"
                                data-title="{{ $material->title }}" data-caption="{{ $material->caption }}"
                                data-action="{{ route('materials.update', $material->id) }}">
                                <i class="fa-solid fa-pen-to-square"></i> Update
                            </a>
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
        <x-paginations :paginator="$materials" />

    </div>

    <!-- Update Form -->
    <div id="updateFormWrapper" class="hidden mt-6">
        <form method="POST" enctype="multipart/form-data" id="updateForm" class="space-y-4">
            @csrf
            @method('POST')

            <input type="hidden" id="formAction" name="formAction" value="">

            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-500 mb-2">Category</label>
                <select name="category_disabled" id="category" disabled
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed">
                    <option value="">Select Category</option>
                    <option value="Marketing Images" selected>Marketing Images</option>
                    <option value="Marketing Videos">Marketing Videos</option>
                    <option value="PDF Slides Copy">PDF Slides Copy</option>
                    <option value="Company Documents">Company Documents</option>
                </select>
                <!-- Hidden field to submit actual value -->
                <input type="hidden" id="category_hidden" value="Marketing Images">
            </div>

            <div id="title-wrapper">
                <x-input-text label="Title" name="title" id="title" placeholder="Enter title" required />
            </div>

            <div>
                <label for="caption" class="block text-sm font-semibold text-gray-500 mb-2">
                    Caption
                </label>
                <textarea name="caption" id="caption" @if(old('category')==='image' ) required @endif
                    placeholder="Type your caption here ..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200"></textarea>
            </div>

            <div class="mb-6">
                <label for="file" class="block text-sm font-medium text-gray-500 mb-2">
                    File (Image / Video / PDF)
                </label>
                <div class="flex items-center justify-center w-full">
                    <label for="file"
                        class="flex flex-col w-full  p-4 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition">

                        <div class="flex flex-col items-center justify-center mt-2">
                            <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-600" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M4 12l8-8m0 0l8 8m-8-8v12" />
                            </svg>
                            <p class="text-sm text-gray-600 text-center">
                                <span class="font-semibold">Click to upload</span> or drag and drop
                            </p>

                        </div>

                        <!-- File path text inside the padded label -->
                        <p id="filePath" class="mt-3 text-sm font-medium text-teal-600 text-center break-words"></p>

                        <input type="file" name="file" id="file" accept=".png,.jpg,.jpeg,.mp4,.pdf"
                            class="hidden focus:outline-none">
                    </label>
                </div>
            </div>
            <div>

                <!-- Update Button with Save Icon -->
                <button type="submit" class="bg-blue-100 text-blue-700 px-4 py-2 rounded hover:bg-blue-200">
                    <i class="fas fa-save mr-2"></i> Update Material
                </button>

                <!-- Cancel Button with X Icon -->
                <button type="button" class="bg-red-100 text-gray-700 px-4 py-2 rounded hover:bg-red-200 ml-2"
                    onclick="cancelUpdate()">
                    <i class="fa-solid fa-xmark mr-1"></i>Cancel
                </button>



        </form>
    </div>
</div>


<script>
document.getElementById('file').addEventListener('change', function() {
    const file = this.files[0];
    const category = document.getElementById('category').value;
    const filePathDisplay = document.getElementById('filePath');

    if (!file) {
        filePathDisplay.textContent = '';
        return;
    }

    const fileType = file.type;
    const fileName = file.name.toLowerCase();

    // Helper booleans
    const isImage = fileType.startsWith('image/');
    const isVideo = fileType.startsWith('video/');
    const isPDF = fileType === 'application/pdf' || fileName.endsWith('.pdf');

    let invalid = false;
    let message = '';

    switch (category) {
        case 'Marketing Videos':
            if (isImage || isPDF) {
                invalid = true;
                message = 'Only video files are allowed for Marketing Videos.';
            }
            break;

        case 'Marketing Images':
            if (isVideo || isPDF) {
                invalid = true;
                message = 'Only image files are allowed for Marketing Images.';
            }
            break;

        case 'PDF Slides Copy':
            if (isImage || isVideo) {
                invalid = true;
                message = 'Only PDF files are allowed for PDF Slides Copy.';
            }
            break;

        case 'Company Documents':
            if (isVideo || isPDF) {
                invalid = true;
                message = 'Only image files are allowed for Company Documents.';
            }
            break;
    }

    if (invalid) {
        alert(message);
        this.value = ''; // Clear file input
        filePathDisplay.textContent = '';
    } else {
        filePathDisplay.textContent = `Selected: ${file.name}`;
    }
});



// Show update form and fill data
document.querySelectorAll('.trigger-edit').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const id = this.dataset.id;
        const category = this.dataset.category;
        const title = this.dataset.title;
        const caption = this.dataset.caption;
        const actionUrl = this.dataset.action;

        document.getElementById('updateFormWrapper').classList.remove('hidden');
        document.getElementById('materialsWrapper').style.display = 'none';

        const form = document.getElementById('updateForm');
        form.action = actionUrl;
        form.querySelector('#category').value = category;
        form.querySelector('#title').value = title;
        form.querySelector('#caption').value = caption;

        toggleFields(); // Handle caption/title visibility
    });
});

// File path display
document.getElementById('file').addEventListener('change', function() {
    const file = this.files[0];
    document.getElementById('filePath').textContent = file ? `Selected: ${file.name}` : '';
});

// Toggle fields based on category
function toggleFields() {
    const category = document.getElementById('category').value;
    const captionField = document.getElementById('caption').parentElement;
    const titleWrapper = document.getElementById('title-wrapper');
    const titleInput = document.getElementById('title');

    if (category === 'Marketing Images') {
        captionField.style.display = 'block';
        titleWrapper.style.display = 'none';
        titleInput.required = false;
    } else {
        captionField.style.display = 'none';
        titleWrapper.style.display = 'block';
        titleInput.required = true;
    }
}

function cancelUpdate() {
    document.getElementById('updateFormWrapper').classList.add('hidden');
    document.getElementById('materialsWrapper').style.display = 'block';
}

document.getElementById('category').addEventListener('change', toggleFields);
</script>
@endsection



@section('js')
<script>
document.getElementById('updateForm').addEventListener('submit', function(e) {
    e.preventDefault(); // prevent default submit

    const form = e.target;
    const formData = new FormData(form);
    formData.append('_method', 'POST'); // Important for Laravel to recognize as PUT

    const actionUrl = form.getAttribute('action');

    fetch(actionUrl, {
            method: 'POST', // Still POST, Laravel interprets it as PUT via _method
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(async response => {
            const data = await response.json();

            if (response.ok) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Material updated successfully!',
                }).then(() => {
                    location.reload();
                });
            } else {
                throw data;
            }
        })
        .catch(error => {
            let message = 'Something went wrong.';
            if (error.errors) {
                message = Object.values(error.errors).flat().join('\n');
            }

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: message,
            });
        });
});


document.getElementById('delete-selected').addEventListener('click', function() {
    const selectedIds = Array.from(document.querySelectorAll('.material-checkbox:checked'))
        .map(cb => cb.value);

    if (selectedIds.length === 0) {
        Swal.fire({
            title: 'No items selected',
            text: 'Please select at least one item to delete.',
            icon: 'warning'
        });
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
                url: '{{ route("materials.bulkDelete") }}', // adjust name as needed
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    ids: selectedIds
                },
                success: function(response) {
                    selectedIds.forEach(function(id) {
                        $('#material-row-' + id).remove();
                    });

                    Swal.fire('Deleted!', response.message, 'success');
                },
                error: function(xhr) {
                    Swal.fire('Error', xhr.responseJSON.message || 'Something went wrong.',
                        'error');
                }
            });
        }
    });
});
</script>
@endsection