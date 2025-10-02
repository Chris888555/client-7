@extends('layouts.admin')

@section('title', 'Update Materials')

@section('content')

<div class="container mx-auto p-4 sm:p-8 max-w-full">

{{-- ✅ Buttons --}}
<div class="flex items-center justify-center max-w-[380px] mx-auto p-2 bg-gray-50 rounded-2xl border gap-2">
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





    {{-- ✅ Material Table --}}
    <div id="materialsTable" class="mt-6">
        <div class="rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-0">

                {{-- ✅ Toolbar --}}
                <div class="flex justify-between items-center px-3 py-3 border-b border-gray-200">
                    <div class="flex gap-2 items-center">

                        <button id="bulkDeleteBtn" class="bg-red-600 text-white text-sm px-3 py-2 rounded-md hover:bg-red-700 transition flex items-center gap-1">
                            <i class="fas fa-trash-alt"></i> Delete Selected
                        </button>

                        <form method="GET" action="{{ route('materials.show') }}" class="flex items-center gap-2">
                            <select name="category" class="border border-gray-300 text-gray-700 text-sm rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-gray-200 w-auto" onchange="this.form.submit()">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                                @endforeach
                            </select>
                        </form>

                    </div>
                </div>

                {{-- ✅ Table Wrapper --}}
                <div class="overflow-x-auto max-h-[600px]">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead class="bg-gray-100 ">
                            <tr>
                                <th class="px-3 py-4"><input type="checkbox" id="checkAll" class="rounded"></th>
                                <th class="px-3 py-3">Preview</th>
                                <th class="px-3 py-3">Caption</th>
                                <th class="px-3 py-3">Category</th>
                                <th class="px-3 py-3 w-[120px]">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($materials as $material)
                            <tr class="border-b border-gray-200" data-category="{{ $material->category }}">
                                <td class="px-3 py-2"><input type="checkbox" class="checkItem rounded" value="{{ $material->id }}"></td>
                                <td class="px-3 py-2">
                                    <img src="{{ asset('storage/' . $material->file_path) }}" class="rounded-md" width="40" alt="Preview">
                                </td>
                                <td class="px-3 py-2" title="{{ $material->caption }}">
                                    <span class="inline md:hidden">
                                        {{ strlen($material->caption) > 10 ? substr($material->caption, 0, 10) . '...' : $material->caption }}
                                    </span>
                                    <span class="hidden md:inline">
                                        {{ strlen($material->caption) > 50 ? substr($material->caption, 0, 50) . '...' : $material->caption }}
                                    </span>
                                </td>
                                <td class="px-3 py-2">{{ $material->category }}</td>
                                <td class="px-3 py-2">
                                   <button class="text-gray-700 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm border shadow-sm transition duration-300 ease-in-out w-full editBtn flex items-center justify-center gap-1"
                                    data-id="{{ $material->id }}"
                                    data-caption="{{ $material->caption }}"
                                    data-category="{{ $material->category }}"
                                    data-img="{{ asset('storage/' . $material->file_path) }}">
                                    <i class="fas fa-pen-to-square"></i> Update
                                </button>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="100%">
                                    <x-no-data />
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
             <x-paginations :paginator="$materials" />
        </div>
    </div>

    {{-- ✅ Update Form --}}
    <div id="updateFormWrapper" class="hidden mt-4">
        <form id="updateForm" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('POST')
            <input type="hidden" id="materialId">

            {{-- Current Preview --}}
            <div>
                <label class="text-gray-600 font-medium block mb-1">Current Image</label>
                <img id="currentImage" src="" alt="Preview" class="rounded-md border" width="120">
            </div>

            {{-- Category --}}
            <div>
                <label for="editCategory" class="text-gray-600 font-medium block mb-1">Category</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200" name="category" id="editCategory">
                    <option value="FB Ads">FB Ads</option>
                    <option value="Posting">Posting</option>
                    <option value="Stories">Stories</option>
                    <option value="Product">Product</option>
                    <option value="Cover Photo">Cover Photo</option>
                    <option value="Testimonial">Testimonial</option>
                </select>
            </div>

            {{-- Caption --}}
            <div>
                <label for="editCaption" class="text-gray-600 font-medium block mb-1">Caption</label>
                <textarea class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200" id="editCaption" name="caption" rows="3"></textarea>
            </div>

            {{-- Upload --}}
                <div>
                    <label class="text-gray-600 font-medium block mb-1">
                        Upload Image <span class="text-red-500">(optional)</span>
                    </label>

                    <div id="uploadBox"
                        class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center 
                                bg-gray-50 hover:border-green-400 transition cursor-pointer">

                        <input type="file" name="file" id="file" class="hidden" accept=".jpg,.jpeg,.png">

                        <label for="file" class="flex flex-col items-center justify-center text-gray-500 cursor-pointer">
                            <!-- Match Code 1 Icon (SVG instead of bootstrap icon) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6h.1a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <p class="mb-1">Click to upload or drag image here</p>
                            <small class="text-gray-400">Only JPG or PNG (max 2MB)</small>
                        </label>

                        <!-- File path -->
                        <p id="filePath" class="mt-2 text-blue-600 text-sm font-semibold"></p>
                    </div>
                </div>

                <script>
                document.getElementById('file').addEventListener('change', function (e) {
                    const file = e.target.files[0];
                    const filePath = document.getElementById('filePath');
                    filePath.textContent = file ? file.name : "";
                });
                </script>


            {{-- Buttons --}}
            <div class="flex gap-2">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">Save Update</button>
                <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition" id="cancelEdit">Cancel</button>
            </div>

        </form>
    </div>

</div>

@endsection

@section('js')
<script>

const updateFormWrapper = document.getElementById('updateFormWrapper');
const materialsTable = document.getElementById('materialsTable');
const updateForm = document.getElementById('updateForm');

document.querySelectorAll('.editBtn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('materialId').value = this.dataset.id;
        document.getElementById('editCaption').value = this.dataset.caption;
        document.getElementById('editCategory').value = this.dataset.category;
        document.getElementById('currentImage').src = this.dataset.img;

        materialsTable.classList.add('hidden');
        updateFormWrapper.classList.remove('hidden');
    });
});

document.getElementById('cancelEdit').addEventListener('click', () => {
    updateFormWrapper.classList.add('hidden');
    materialsTable.classList.remove('hidden');
    updateForm.reset();
    filePathDisplay.textContent = '';
});

updateForm.addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const id = document.getElementById('materialId').value;

    Swal.fire({
        title: 'Saving...',
        text: 'Please wait while we save your changes.',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });

    fetch(`/admin/materials/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            Swal.fire('Success', data.message, 'success').then(() => {
                location.reload();
            });
        })
        .catch(() => {
            Swal.fire('Error', 'Update failed.', 'error');
        });
});

document.getElementById('checkAll').addEventListener('change', function() {
    document.querySelectorAll('.checkItem').forEach(cb => cb.checked = this.checked);
});

document.getElementById('bulkDeleteBtn').addEventListener('click', function() {
    const checkedIds = Array.from(document.querySelectorAll('.checkItem:checked')).map(cb => cb.value);

    if (checkedIds.length === 0) {
        Swal.fire('No Selection', 'Please select at least one item to delete.', 'info');
        return;
    }

    Swal.fire({
        title: 'Are you sure?',
        text: `You are about to delete ${checkedIds.length} materials.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then(result => {
        if (result.isConfirmed) {
            fetch(`{{ route('materials.bulkDelete') }}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ ids: checkedIds })
                })
                .then(res => res.json())
                .then(data => {
                    Swal.fire('Deleted', data.message, 'success').then(() => {
                        location.reload();
                    });
                })
                .catch(() => {
                    Swal.fire('Error', 'Deletion failed.', 'error');
                });
        }
    });
});
</script>
@endsection
