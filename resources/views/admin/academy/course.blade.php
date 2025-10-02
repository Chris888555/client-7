@extends('layouts.admin')
@section('title', 'Create Courses')

@section('content')
<div class="container mx-auto p-4 sm:p-8 max-w-full">

    
    {{-- Create Course Form --}}
   <form id="createCourseForm" method="POST" action="{{ route('academy.course.store') }}" enctype="multipart/form-data" class="space-y-4 mb-10">
    @csrf
    <input type="hidden" name="course_id" id="course_id">

   
    {{-- Course Name --}}
    <div>
        <label for="course_name" class="block text-sm font-medium text-gray-500 mb-1">Course Name</label>
        <input type="text" name="course_name" id="course_name" placeholder="Course Name" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200">
    </div>

    {{-- Course Description --}}
    <div>
        <label for="course_description" class="block text-sm font-medium text-gray-500 mb-1">Description</label>
        <textarea name="course_description" id="course_description" placeholder="Description" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200"></textarea>
    </div>

    {{-- Course Thumbnail --}}
    <div>
        <label for="course_thumbnail" class="block text-sm font-medium text-gray-500 mb-1">Thumbnail</label>
        <input type="file" id="course_thumbnail" name="course_thumbnail" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200">
        <img id="thumbnailPreview" src="" alt="Thumbnail Preview" class="w-40 h-auto mt-2 rounded border hidden">
        <p id="filePath" class="text-sm text-gray-500"></p>
    </div>

    {{-- Buttons --}}
    <div class="pt-2">
        <button type="submit" id="submitBtn" class="bg-teal-600 text-white px-4 py-2 rounded">Create Courses</button>
        <button type="button" id="cancelUpdateBtn" class="bg-gray-500 text-white px-4 py-2 rounded ml-2 hidden">
            Cancel
        </button>
    </div>
</form>

    <div class="flex flex-wrap items-center gap-2 mb-4">
            <button id="bulkDeleteBtn"
                class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded-md inline-flex items-center gap-1 shadow-sm transition">
                <i class="fas fa-trash"></i> Delete Selected
            </button>

            <button id="openReorderModal"
                class="bg-indigo-600 text-white text-sm px-4 py-2 rounded-md inline-flex items-center gap-1 shadow-sm transition hover:bg-indigo-700">
                <i class="fas fa-sort"></i> Reorder Courses
            </button>
        </div>

    {{-- Course Table --}}
    <div class="overflow-x-auto bg-white rounded-xl border border-slate-200 shadow-sm mt-4">
        <table class="min-w-full divide-y divide-slate-200 text-sm whitespace-nowrap">
            <thead class="bg-slate-50 text-slate-600 uppercase text-xs tracking-wider">
                <tr>
                     <th class="px-2 py-6 text-left text-xs font-medium text-gray-600 uppercase"><input type="checkbox" id="checkAll" /></th>
                     <th class="px-2 py-6 text-left text-xs font-medium text-gray-600 uppercase">Order</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Course Name</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Modules</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($courses as $index => $course)
                <tr>
                    <td class="px-2 py-3 text-sm text-left"><input type="checkbox" class="checkItem" value="{{ $course->course_id }}"></td>
                    <td class="px-2 py-3">{{ $course->order ?? '-' }}</td> 
                    <td class="px-4 py-3">{{ $course->course_name }}</td>
                      <td class="px-2 py-3 text-sm text-left">{{ $course->modules->count() }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('academy.manageModules', $course->course_id) }}" class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded text-xs inline-flex items-center gap-1">
                            <i class="fas fa-plus"></i> Manage Module
                        </a>


                       

                            <form method="POST" class="inline toggleVisibilityForm" data-id="{{ $course->course_id }}">
                                @csrf
                                <button type="submit"
                                         class="toggleBtn text-xs font-semibold px-5 py-2 rounded-md shadow-sm inline-flex items-center gap-1
                                         {{ $course->is_visible ? 'bg-green-600 hover:bg-green-700 text-white' : 'bg-slate-500 hover:bg-slate-600 text-white' }}">
                                         <i class="fas fa-eye{{ $course->is_visible ? '' : '-slash' }}"></i>
                                        <span class="toggleText">{{ $course->is_visible ? 'Visible' : 'Hidden' }}</span>
                                    </button>
                            </form>

                            <button type="button"
                                class="editCourseBtn bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded text-xs"
                                data-id="{{ $course->course_id }}"
                                data-name="{{ $course->course_name }}"
                                data-description="{{ $course->course_description }}"
                                data-thumbnail="{{ asset('storage/' . $course->course_thumbnail) }}">
                                <i class="fas fa-edit"></i> Update
                            </button>


                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-6 text-center text-gray-500">No courses found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

       <!-- ✅ Always show pagination -->
<x-paginations :paginator="$courses" />

     <!-- Modal Overlay -->
<div id="reorderModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-2 z-50 hidden">
    <div class="bg-white w-full max-w-[800px] p-6 rounded-lg shadow-lg relative">
        <!-- Close Button -->
        <button id="closeReorderModal" class="absolute top-2 right-3 text-gray-500 hover:text-red-500">
          <i class="fas fa-times text-3xl text-gray-700 p-3  hover:text-red-500"></i>

        </button>

        <h2 class="text-lg font-semibold mb-4">Reorder Courses</h2>

        <form id="reorderForm" method="POST" action="{{ route('admin.course.reorder.manual') }}">
            @csrf

            <div class="space-y-3 max-h-[400px] overflow-y-auto pr-2">
                @foreach($courses as $course)
                    <div class="flex items-center gap-4 p-3 bg-gray-50 rounded">
                        <input type="number" name="order[{{ $course->course_id }}]"
                            value="{{ $course->order }}"
                            class="w-16 px-3 py-2 border rounded text-center" />
                        <span class="text-sm text-slate-700 font-medium">
                            {{ $course->course_name }}
                        </span>
                    </div>
                @endforeach
            </div>

            <div class="mt-5 flex justify-start">
                <button type="submit"
                    class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700">
                    Save Order
                </button>
            </div>
        </form>
    </div>
</div>
<script>
document.getElementById('openReorderModal').addEventListener('click', function () {
    document.getElementById('reorderModal').classList.remove('hidden');
});

document.getElementById('closeReorderModal').addEventListener('click', function () {
    document.getElementById('reorderModal').classList.add('hidden');
});
</script>


</div>
@endsection

@section('js')
<script>
    // Display selected file name
    document.getElementById('course_thumbnail').addEventListener('change', function (e) {
        const filePath = document.getElementById('filePath');
        const file = e.target.files[0];
        filePath.textContent = file ? file.name : '';
    });

    // AJAX submission for course form
   $('#createCourseForm').on('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    const url = $(this).attr('action');
    const method = $(this).attr('method');

    $.ajax({
        url: url,
        type: method,
        data: formData,
        contentType: false,
        processData: false,
        success: res => {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: res.message,
                showConfirmButton: true
            }).then(() => {
                location.reload();
            });
        },
        error: err => {
            let errorMessage = 'Check your form and try again.';
            if (err.responseJSON?.message) {
                errorMessage = err.responseJSON.message;
            }
            Swal.fire('Error', errorMessage, 'error');
        }
    });
});


$(document).on('click', '.editCourseBtn', function () {
    const id = $(this).data('id');
    const name = $(this).data('name');
    const description = $(this).data('description');
    const thumbnail = $(this).data('thumbnail');

    $('#course_id').val(id);
    $('input[name="course_name"]').val(name);
    $('textarea[name="course_description"]').val(description);

    if (thumbnail) {
        $('#thumbnailPreview').attr('src', thumbnail).removeClass('hidden');
    } else {
        $('#thumbnailPreview').addClass('hidden').attr('src', '');
    }

    $('#submitBtn').text('Update Course')
        .removeClass('bg-blue-600')
        .addClass('bg-yellow-600');

    $('#cancelUpdateBtn').removeClass('hidden');

    $('#createCourseForm').attr('action', `/admin/course/${id}/update`);
});

// CANCEL BUTTON LOGIC
$(document).on('click', '#cancelUpdateBtn', function () {
    $('#course_id').val('');
    $('input[name="course_name"]').val('');
    $('textarea[name="course_description"]').val('');
    $('#thumbnailPreview').addClass('hidden').attr('src', '');

    $('#submitBtn').text('Create Course')
        .removeClass('bg-yellow-600')
        .addClass('bg-blue-600');

    $('#cancelUpdateBtn').addClass('hidden');

    $('#createCourseForm').attr('action', '/admin/course/store');
});


    
</script>

<script>
    $('#checkAll').on('change', function () {
        $('.checkItem').prop('checked', this.checked);
    });

    $('#bulkDeleteBtn').on('click', function () {
        const selected = $('.checkItem:checked').map(function () {
            return $(this).val();
        }).get();

        if (selected.length === 0) {
            Swal.fire('Warning', 'Select at least one course.', 'warning');
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: 'Selected courses will be deleted permanently.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete'
        }).then(result => {
            if (result.isConfirmed) {
                $.post("{{ route('admin.academy.course.bulkDelete') }}", {
                    _token: '{{ csrf_token() }}',
                    ids: selected
                }, res => {
                    Swal.fire('Deleted!', res.message, 'success').then(() => location.reload());
                }).fail(() => {
                    Swal.fire('Error', 'Something went wrong.', 'error');
                });
            }
        });
    });
</script>

<script>
$(document).on('submit', '.toggleVisibilityForm', function(e) {
    e.preventDefault();

    let form = $(this);
    let courseId = form.data('id');
    let btn = form.find('.toggleBtn');
    let text = form.find('.toggleText');
    let icon = form.find('i');

    $.ajax({
        url: `/admin/course/${courseId}/toggle-visibility`,
        method: 'POST',
        data: form.serialize(),
        success: function(res) {
            if (res.success) {
                // Toggle UI
                if (res.visible) {
                    btn.removeClass('bg-slate-500 hover:bg-slate-600')
                       .addClass('bg-green-600 hover:bg-green-700');
                    text.text('Visible');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                } else {
                    btn.removeClass('bg-green-600 hover:bg-green-700')
                       .addClass('bg-slate-500 hover:bg-slate-600');
                    text.text('Hidden');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                }

                Swal.fire({
                    icon: 'success',
                    title: 'Updated',
                    text: 'Course visibility updated!',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        },
        error: function() {
            Swal.fire('Error', 'Something went wrong.', 'error');
        }
    });
});
</script>

<script>
$(document).ready(function () {
    $('#reorderForm').on('submit', function (e) {
        e.preventDefault();

        const form = $(this);
        const url = form.attr('action');
        const formData = form.serialize();

        Swal.fire({
            title: 'Saving...',
            text: 'Please wait while saving the order.',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: res.message || 'Course order updated.',
                    timer: 1800,
                    showConfirmButton: false
                });
                // Do NOT close modal, do NOT reload
            },
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON?.message || 'Something went wrong.'
                });
            }
        });
    });
});
</script>


@endsection
