@extends('layouts.admin')

@section('title', 'Manage Testimonials')

@section('content')
<div class="container m-auto p-4 sm:p-8 max-w-full">

{{-- ✅ Buttons --}}
<div class="flex items-center justify-center max-w-[350px] mx-auto p-2 bg-gray-50 rounded-2xl border gap-2">
    {{-- Create Packages --}}
    <a href="{{ route('admin.testimonials.create') }}"
        class="w-full text-center px-5 py-2 rounded-xl transition cursor-pointer 
        {{ request()->routeIs('admin.testimonials.create') 
            ? 'bg-blue-600 text-white hover:bg-blue-700' 
            : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}">
        Create Testi
    </a>

    {{-- List Packages --}}
    <a href="{{ route('admin.testimonials.list') }}"
        class="w-full text-center px-5 py-2 rounded-xl transition cursor-pointer 
        {{ request()->routeIs('admin.testimonials.list') 
            ? 'bg-blue-600 text-white hover:bg-blue-700' 
            : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}">
        List Testi
    </a>
</div>
   
{{-- ✅ Testimonial Table --}}
<div id="testimonialTable" class="mt-6">
    <div class="rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-0">

            {{-- ✅ Toolbar --}}
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
                            <th class="px-3 py-3">Name</th>
                            <th class="px-3 py-3">Message</th>
                            <th class="px-3 py-3">Video</th>
                            <th class="px-3 py-3 w-[120px]">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($testimonials as $t)
                            <tr class="border-b border-gray-200" id="row-{{ $t->id }}">
                                <td class="px-3 py-2"><input type="checkbox" class="rowCheckbox rounded" value="{{ $t->id }}"></td>
                                <td class="px-3 py-2 text-sm">{{ $t->name }}</td>
                                <td class="px-3 py-2 text-sm">{{ \Illuminate\Support\Str::limit($t->message, 30, '...') }}</td>
                                <td class="px-3 py-2 text-sm">
                                    @if($t->video_link)
                                        <a href="{{ $t->video_link }}" target="_blank" class="text-blue-600 hover:underline">View Video</a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="px-3 py-2">
                                    <button class="edit-btn text-gray-700 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm border shadow-sm transition duration-300 ease-in-out w-full flex items-center justify-center gap-1"
                                        data-id="{{ $t->id }}"
                                        data-name="{{ $t->name }}"
                                        data-message="{{ $t->message }}"
                                        data-video_link="{{ $t->video_link ?? '' }}">
                                        <i class="fa-solid fa-pen-to-square"></i> Update
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
       <x-paginations :paginator="$testimonials" />
    </div>
</div>


    {{-- Edit Form --}}
    <div id="editFormContainer" style="display: none;" class="mt-6 bg-white p-6 rounded-xl border">
        <form id="updateTestimonialForm" method="POST" action="" class="space-y-4">
            @csrf
            <input type="hidden" id="testimonial_id" name="id">

            <x-input-text id="name" name="name" label="Name" placeholder="Enter name" required />
            <x-input-text id="message" name="message" label="Message" placeholder="Enter message" type="textarea" rows="4" required />
            <x-input-text id="video_link" name="video_link" label="Video Link (optional)" placeholder="Enter YouTube/Mp4 link" />

            <div class="flex flex-row mt-4 gap-4">
                <button type="submit"
                    class="w-full max-w-[200px] flex items-center justify-center gap-2 px-4 py-2 border border-dashed border-blue-300 text-blue-700 hover:border-blue-400 hover:bg-blue-50 hover:text-blue-800 transition rounded shadow-sm">
                    <i class="fas fa-save"></i> Update
                </button>
                <button type="button" id="cancelEdit"
                    class="w-full max-w-[200px] flex items-center justify-center gap-2 px-4 py-2 border border-dashed border-red-300 text-red-700 hover:border-red-400 hover:bg-red-50 hover:text-red-800 transition rounded shadow-sm">
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
document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.edit-btn');
    const table = document.getElementById('testimonialTable');
    const form = document.getElementById('editFormContainer');
    const updateForm = document.getElementById('updateTestimonialForm');

    // Edit
    editButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            document.getElementById('testimonial_id').value = id;
            document.getElementById('name').value = btn.dataset.name;
            document.getElementById('message').value = btn.dataset.message;
            document.getElementById('video_link').value = btn.dataset.video_link;

            updateForm.action = `/admin/testimonials/update/${id}`;

            table.style.display = 'none';
            form.style.display = 'block';
        });
    });

    // Cancel
    document.getElementById('cancelEdit').addEventListener('click', () => {
        form.style.display = 'none';
        table.style.display = 'block';
    });

    // AJAX Update
    updateForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(updateForm);

        fetch(updateForm.action, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success'){
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

    // Bulk Delete (same approach)
    document.getElementById('bulkDeleteBtn').addEventListener('click', function() {
        const selectedIds = [...document.querySelectorAll('.rowCheckbox:checked')].map(cb => cb.value);
        if(selectedIds.length === 0) return Swal.fire('No selection', 'Please select at least one testimonial to delete.', 'warning');

        Swal.fire({
            title: 'Are you sure?',
            text: 'Selected testimonials will be permanently deleted!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete!',
        }).then(result => {
            if(result.isConfirmed){
                fetch(`{{ route('admin.testimonials.bulkDelete') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ ids: selectedIds })
                })
                .then(res => res.json())
                .then(data => {
                    if(data.status === 'success'){
                        selectedIds.forEach(id => document.getElementById('row-' + id).remove());
                        Swal.fire('Deleted!', data.message, 'success');
                    } else {
                        Swal.fire('Error', data.message || 'Failed to delete.', 'error');
                    }
                })
                .catch(() => Swal.fire('Error', 'Server error.', 'error'));
            }
        });
    });
});
</script>
@endsection
