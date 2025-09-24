@extends('layouts.admin')

@section('title', 'Manage Packages')

@section('content')
<div class="container m-auto p-4 sm:p-8 max-w-full">

{{-- ✅ Buttons --}}
<div class="flex items-center justify-center max-w-[350px] mx-auto p-2 bg-gray-50 rounded-2xl border gap-2">
    <a href="{{ route('packages.create') }}"
        class="w-full text-center px-5 py-2 rounded-xl transition cursor-pointer 
        {{ request()->routeIs('packages.create') 
            ? 'bg-blue-600 text-white hover:bg-blue-700' 
            : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}">
        Create Packages
    </a>
    <a href="{{ route('packages.list') }}"
        class="w-full text-center px-5 py-2 rounded-xl transition cursor-pointer 
        {{ request()->routeIs('packages.list') 
            ? 'bg-blue-600 text-white hover:bg-blue-700' 
            : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}">
        List Packages
    </a>
</div>

{{-- ✅ Package Table --}}
<div id="packageTable" class="mt-6">
    <div class="rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-0">
            <div class="flex justify-between items-center px-3 py-3 border-b border-gray-200">
                <div class="flex gap-2 items-center">
                    <button id="bulkDeleteBtn" class="bg-red-600 text-white text-sm px-3 py-2 rounded-md hover:bg-red-700 transition flex items-center gap-1">
                        <i class="fas fa-trash-alt"></i> Delete Selected
                    </button>
                </div>
            </div>

            {{-- ✅ Table Wrapper --}}
            <div class="overflow-x-auto max-h-[600px]">
                <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-3 py-4"><input type="checkbox" id="checkAll" class="rounded"></th>
                            <th class="px-3 py-3">Image</th>
                            <th class="px-3 py-3">Name</th>
                            <th class="px-3 py-3">Price</th>
                            <th class="px-3 py-3">Features</th>
                            <th class="px-3 py-3 w-[120px]">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($packages as $pkg)
                            <tr class="border-b border-gray-200" id="row-{{ $pkg->id }}">
                                <td class="px-3 py-2"><input type="checkbox" class="rowCheckbox rounded" value="{{ $pkg->id }}"></td>
                                <td class="px-3 py-2">
                                    @if($pkg->image)
                                        <img src="{{ asset('storage/'.$pkg->image) }}" class="w-14 h-14 object-cover rounded-lg border">
                                    @else
                                        <span class="text-gray-400 text-xs">No Image</span>
                                    @endif
                                </td>
                                <td class="px-3 py-2 text-sm">{{ $pkg->name }}</td>
                                <td class="px-3 py-2 text-sm">₱{{ number_format($pkg->price, 2) }}</td>
                                <td class="px-3 py-2 text-sm">
                                    <ul class="list-disc ml-5">
                                        @foreach ((array) $pkg->features as $f)
                                            <li>{{ $f }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-3 py-2">
                                    <button class="edit-btn text-gray-700 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm border shadow-sm transition w-full flex items-center justify-center gap-1"
                                        data-id="{{ $pkg->id }}"
                                        data-name="{{ $pkg->name }}"
                                        data-price="{{ $pkg->price }}"
                                        data-features="{{ implode('||', (array) $pkg->features) }}"
                                        data-image="{{ $pkg->image ? asset('storage/'.$pkg->image) : '' }}">
                                        <i class="fa-solid fa-pen-to-square"></i> Update
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="100%"><x-no-data /></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <x-paginations :paginator="$packages" />
    </div>
</div>

{{-- ✅ Edit Form --}}
<div id="editFormContainer" style="display: none;" class="mt-6 bg-white p-6 rounded-xl border">
    <form id="updatePackageForm" method="POST" action="{{ route('packages.update') }}" class="space-y-4" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="pkg_id" name="id">

        <x-input-text id="pkg_name" name="name" label="Package Name" placeholder="Enter package name" required />
        <x-input-text id="pkg_price" name="price" type="number" label="Price" placeholder="₱0.00" required />

        {{-- Features --}}
        <div id="editFeaturesWrap" class="space-y-3">
            <label class="text-sm font-semibold text-gray-500">Features</label>
        </div>

        {{-- Image Upload --}}
        <div>
            <label class="text-sm font-semibold text-gray-500">Image</label>
            <input type="file" name="image" id="pkg_image" accept="image/*" 
                   class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-gray-200">
            <div class="mt-3">
                <img id="previewImage" src="" class="hidden w-32 h-32 object-cover rounded-lg border">
            </div>
        </div>

        <div class="flex gap-4 mt-4">
            <button type="submit"
                class="w-full max-w-[200px] flex items-center justify-center gap-2 px-4 py-2 border border-dashed border-blue-300 text-blue-700 hover:border-blue-400 hover:bg-blue-50 transition rounded shadow-sm">
                <i class="fas fa-save"></i> Update
            </button>
            <button type="button" id="cancelEdit"
                class="w-full max-w-[200px] flex items-center justify-center gap-2 px-4 py-2 border border-dashed border-red-300 text-red-700 hover:border-red-400 hover:bg-red-50 transition rounded shadow-sm">
                <i class="fas fa-circle-xmark"></i> Cancel
            </button>
        </div>
    </form>
</div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const editButtons = document.querySelectorAll('.edit-btn');
    const table = document.getElementById('packageTable');
    const form = document.getElementById('editFormContainer');
    const updateForm = document.getElementById('updatePackageForm');
    const featureWrap = document.getElementById('editFeaturesWrap');
    const previewImage = document.getElementById('previewImage');
    const imageInput = document.getElementById('pkg_image');

    // Edit button
    editButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('pkg_id').value = btn.dataset.id;
            document.getElementById('pkg_name').value = btn.dataset.name;
            document.getElementById('pkg_price').value = btn.dataset.price;

            // reset features
            featureWrap.innerHTML = '<label class="text-sm font-semibold text-gray-500">Features</label>';
            const features = btn.dataset.features ? btn.dataset.features.split('||') : [];
            features.forEach(f => {
                featureWrap.innerHTML += `<input type="text" name="features[]" value="${f}" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-gray-200 mb-2" required>`;
            });

            // preview image
            if (btn.dataset.image) {
                previewImage.src = btn.dataset.image;
                previewImage.classList.remove('hidden');
            } else {
                previewImage.src = '';
                previewImage.classList.add('hidden');
            }
            imageInput.value = '';

            table.style.display = 'none';
            form.style.display = 'block';
        });
    });

    // cancel edit
    document.getElementById('cancelEdit').addEventListener('click', () => {
        form.style.display = 'none';
        table.style.display = 'block';
    });

    // preview when uploading
    imageInput.addEventListener('change', e => {
        const file = e.target.files[0];
        if (file) {
            previewImage.src = URL.createObjectURL(file);
            previewImage.classList.remove('hidden');
        }
    });

    // AJAX update
    updateForm.addEventListener('submit', e => {
        e.preventDefault();
        const formData = new FormData(updateForm);

        fetch(updateForm.action, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                Swal.fire('Updated!', data.message, 'success').then(() => location.reload());
            } else {
                Swal.fire('Error', data.message || 'Update failed.', 'error');
            }
        })
        .catch(() => Swal.fire('Error', 'Server error.', 'error'));
    });

    // Check All
    document.getElementById('checkAll').addEventListener('change', function() {
        document.querySelectorAll('.rowCheckbox').forEach(cb => cb.checked = this.checked);
    });

    // Bulk delete
    document.getElementById('bulkDeleteBtn').addEventListener('click', () => {
        const ids = [...document.querySelectorAll('.rowCheckbox:checked')].map(cb => cb.value);
        if (!ids.length) {
            return Swal.fire('No selection', 'Please select at least one package.', 'warning');
        }

        Swal.fire({
            title: 'Delete?',
            text: 'This cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then(result => {
            if (result.isConfirmed) {
                fetch(`{{ route('packages.delete') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ ids })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        ids.forEach(id => {
                            const row = document.getElementById('row-' + id);
                            if (row) row.remove();
                        });
                        Swal.fire('Deleted!', data.message, 'success');
                    } else {
                        Swal.fire('Error', data.message || 'Delete failed.', 'error');
                    }
                })
                .catch(() => Swal.fire('Error', 'Server error.', 'error'));
            }
        });
    });
});
</script>
@endsection
