@extends('layouts.admin')
@section('title', 'Modules for ' . $course->course_name)

@section('content')
<div class="container m-auto p-4 sm:p-8 max-w-full">
 
    {{-- Create / Update Form --}}
    <form id="createModuleForm" method="POST" action="{{ route('academy.module.store', $course->course_id) }}" class="space-y-2 mb-10">
    @csrf
    <input type="hidden" name="module_id" id="module_id">

    <label for="module_name" class="block text-sm font-medium text-gray-500">Module Name</label>
    <input type="text" name="module_name" id="module_name" placeholder="Module Name" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200">

    <div class="mt-4">
        <button type="submit" id="submitModuleBtn" class="inline-block mt-4 bg-green-600 text-white px-4 py-2 rounded">Save Module</button>
        <button type="button" id="cancelModuleBtn" class="inline-block bg-gray-500 text-white px-4 py-2 rounded ml-2 hidden">Cancel</button>
    </div>
</form>


    {{-- Modules Table --}}
    <div class="overflow-x-auto bg-white rounded-xl border border-slate-200 shadow-sm mt-4">
        <table class="min-w-full divide-y divide-slate-200 text-sm whitespace-nowrap">
            <thead class="bg-slate-50 text-slate-600 uppercase text-xs tracking-wider">
                <tr>
                    
                    <th class="px-4 py-3 text-left">Module Name</th>
                    <th class="px-4 py-3 text-left">Lessons</th>
                    <th class="px-4 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($course->modules as $index => $module)
                <tr>
                    
                    <td class="px-4 py-3">{{ $module->module_name }}</td>
                    <td class="px-4 py-3">{{ $module->lessons->count() }}</td>
                    <td class="px-4 py-3 space-x-2">
                        <a href="{{ route('academy.manageLessons', $module->module_id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-xs">Manage Lessons</a>

                        <button type="button"
                            class="editModuleBtn bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded text-xs"
                            data-id="{{ $module->module_id }}"
                            data-name="{{ $module->module_name }}">
                            Update
                        </button>

                        <button type="button"
                            class="deleteModuleBtn bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded text-xs"
                            data-id="{{ $module->module_id }}">
                            Delete
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-6 text-center text-gray-500">No modules found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
<script>
    // AJAX Save / Update Module
    $('#createModuleForm').on('submit', function (e) {
        e.preventDefault();

        const form = $(this);
        const formData = new FormData(this);
        const url = form.attr('action');

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: res => {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: res.message ?? 'Module saved successfully!',
                }).then(() => {
                    location.reload();
                });
            },
            error: err => {
                Swal.fire('Error', err.responseJSON?.message || 'Something went wrong.', 'error');
            }
        });
    });

    // Fill form for edit
    $(document).on('click', '.editModuleBtn', function () {
        const id = $(this).data('id');
        const name = $(this).data('name');

        $('#module_id').val(id);
        $('#module_name').val(name);

        $('#submitModuleBtn').text('Update Module').removeClass('bg-green-600').addClass('bg-yellow-600');
        $('#cancelModuleBtn').removeClass('hidden');

        $('#createModuleForm').attr('action', `/admin/module/${id}/update`);
    });

    // Cancel edit state
    $('#cancelModuleBtn').on('click', function () {
        $('#module_id').val('');
        $('#module_name').val('');

        $('#submitModuleBtn').text('Add Module').removeClass('bg-yellow-600').addClass('bg-green-600');
        $(this).addClass('hidden');

        $('#createModuleForm').attr('action', `{{ route('academy.module.store', $course->course_id) }}`);
    });

    // Delete with SweetAlert
    $(document).on('click', '.deleteModuleBtn', function () {
        const moduleId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: 'This will permanently delete the module and its lessons.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
        }).then(result => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/module/${moduleId}/delete`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: res => {
                        Swal.fire('Deleted!', res.message, 'success').then(() => {
                            location.reload();
                        });
                    },
                    error: () => {
                        Swal.fire('Error', 'Something went wrong.', 'error');
                    }
                });
            }
        });
    });
</script>
@endsection
