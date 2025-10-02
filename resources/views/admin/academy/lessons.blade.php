@extends('layouts.admin')
@section('title', 'Lessons for ' . $module->module_name)

@section('content')
<div class="container mx-auto p-4 sm:p-8 max-w-full">

    
    <div class="rounded-md bg-blue-50 border border-blue-200 p-4 text-sm text-blue-800">
    The lesson will be added to the <strong>selected category</strong>. Make sure you’ve chosen the correct one.
</div>


    {{-- Create/Update Lesson Form --}}
    <form id="createLessonForm" method="POST" action="{{ route('academy.lesson.store', $module->module_id) }}" class="space-y-4 mb-10">
        @csrf
        <input type="hidden" name="lesson_id" id="lesson_id">
       {{-- Category Selection --}}
        <div>
            <label for="category" class="block text-sm font-medium text-gray-500 mb-1">Category</label>

            <select id="category_select" class="mb-3 w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200 " onchange="toggleCustomCategory(this)">
                <option value="">-- Select Category --</option>
                @foreach($allCategories as $cat)
                    <option value="{{ $cat }}">{{ $cat }}</option>
                @endforeach
                <option value="_custom">Other (Type new category)</option>
            </select>

            <input type="text" name="category" id="category_input"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200"
                placeholder="Type new category here"
                style="display: none;" />
        </div>

     <div class="space-y-4">
        <div>
            <label for="lesson_name" class="block text-sm font-medium text-gray-500 mb-1">Lesson Name</label>
            <input type="text" name="lesson_name" id="lesson_name" placeholder="Lesson Name" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200">
        </div>

        <div>
            <label for="video_path" class="block text-sm font-medium text-gray-500 mb-1">Video Path (MP4 or YouTube)</label>
            <input type="text" name="video_path" id="video_path" placeholder="Mp4 or Youtube Link" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200">
        </div>

        <div>
            <label for="speaker_name" class="block text-sm font-medium text-gray-500 mb-1">Speaker Name</label>
            <input type="text" name="speaker_name" id="speaker_name" placeholder="Speaker Name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200">
        </div>

        <div>
            <label for="lesson_description" class="block text-sm font-medium text-gray-500 mb-1">Lesson Description</label>
            <textarea name="lesson_description" id="lesson_description" placeholder="Lesson Description" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200"></textarea>
        </div>
     </div>

        <div>
        <label for="docs_link" class="block text-sm font-medium text-gray-500 mb-1">
           Upload Link (Docs) <span class="text-red-500 text-xs">(Optional)</span>
        </label>
        <input type="text" name="docs_link" id="docs_link" placeholder="Google Drive link"
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200">
         </div>

         <div>
            <label for="docs_description" class="block text-sm font-medium text-gray-500 mb-1">
                Docs Description <span class="text-red-500 text-xs">(Optional)</span>
            </label>
            <textarea name="docs_description" id="docs_description" placeholder="Short description about the document"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200"></textarea>
        </div>


        <div>
            <button type="submit" id="submitLessonBtn"class="bg-teal-600 text-white inline-block mt-4 px-4 py-2 rounded">Add Lesson</button>
            <button type="button" id="cancelLessonBtn" style="background-color: #6b7280; color: #ffffff;" class="inline-block px-4 py-2 rounded ml-2 hidden">Cancel</button>
        </div>
    </form>

    <div class="flex flex-wrap items-center gap-2 mb-4">
    {{-- Filter by Category --}}
    <form method="GET" action="" class="flex items-center gap-2">
      
        <select name="category" id="categoryFilter" onchange="this.form.submit()"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200">
            <option value="">All Categories</option>
            @foreach($allCategories as $cat)
                <option value="{{ $cat }}" {{ $cat == $category ? 'selected' : '' }}>
                    {{ $cat }}
                </option>
            @endforeach
        </select>
    </form>

    {{-- Reorder Button --}}
    <button id="openReorderModal"
        class="bg-indigo-600 text-white text-sm px-4 py-2 rounded-md inline-flex items-center gap-1 shadow-sm transition hover:bg-indigo-700">
        <i class="fas fa-sort"></i> Reorder Lessons
    </button>
</div>


    {{-- Lessons Table --}}
    <div class="overflow-x-auto bg-white rounded-xl border border-slate-200 shadow-sm mt-4">
        <table class="min-w-full divide-y divide-slate-200 text-sm whitespace-nowrap">
            <thead class="bg-slate-50 text-slate-600 uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Order</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Lesson Name</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Category</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Speaker</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Video Link</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Docs Link</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($lessons as $index => $lesson)
                <tr>
                    <td class="px-4 py-3">{{ $lesson->order ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $lesson->lesson_name }}</td>
                    <td class="px-4 py-3">{{ $lesson->category ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $lesson->speaker_name ?? '-' }}</td>
                    <td class="px-4 py-3">
                        @if ($lesson->video_path)
                            <a href="{{ $lesson->video_path }}" target="_blank" class="text-blue-600 hover:underline text-xs">View Video</a>
                        @else
                            <span class="text-gray-500 text-xs">N/A</span>
                        @endif
                    </td>
                     <td class="px-4 py-3">
                        @if ($lesson->docs_link)
                            <a href="{{ $lesson->docs_link }}" target="_blank" class="text-blue-600 hover:underline text-xs">View Docs</a>
                        @else
                            <span class="text-gray-500 text-xs">N/A</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 space-x-2">
                        <button type="button" class="editLessonBtn bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded text-xs"
                            data-id="{{ $lesson->lesson_id }}"
                            data-name="{{ $lesson->lesson_name }}"
                            data-category="{{ $lesson->category }}"
                            data-speaker="{{ $lesson->speaker_name }}"
                            data-description="{{ $lesson->lesson_description }}"
                            data-video="{{ $lesson->video_path }}"
                            data-docs="{{ $lesson->docs_link }}"
                            data-docs_description="{{ $lesson->docs_description }}">
                            Update
                        </button>
                        <form action="{{ route('academy.lesson.delete', $lesson->lesson_id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button data-id="{{ $lesson->lesson_id }}" class="deleteLessonBtn bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-xs">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-6 text-center text-gray-500">No lessons found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- ✅ Always show pagination -->
<x-paginations :paginator="$lessons" />
</div>

<!-- Reorder Modal -->
<div id="reorderModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-2 z-50 hidden">
    <div class="bg-white w-full max-w-[800px] p-6 rounded-lg shadow-lg relative">
        <button id="closeReorderModal" class="absolute top-2 right-3 text-gray-500 hover:text-red-500">
            <i class="fas fa-times text-3xl"></i>
        </button>

        <h2 class="text-lg font-semibold mb-4">Reorder Lessons</h2>

        <form method="POST" id="reorderForm" action="{{ route('academy.lesson.reorder', $module->module_id) }}">
            @csrf
            <div class="space-y-4 max-h-[400px] overflow-y-auto pr-2">
                @foreach($groupedLessons as $cat => $lessons)
                    <h4 class="font-medium text-gray-700">{{ $cat ?: 'Uncategorized' }}</h4>
                    @foreach($lessons as $lesson)
                        <div class="flex items-center gap-4 p-3 bg-gray-50 rounded">
                            <input type="number" name="order[{{ $lesson->lesson_id }}]"
                                   value="{{ $lesson->order }}"
                                   class="w-16 px-3 py-2 border rounded text-center" />
                            <span class="text-sm text-slate-700 font-medium">
                                {{ $lesson->lesson_name }}
                            </span>
                        </div>
                    @endforeach
                @endforeach
            </div>

            <div class="mt-5">
                <button type="submit" class="bg-teal-600 text-white px-5 py-2 rounded hover:bg-teal-700">
                    Save Order
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('openReorderModal').addEventListener('click', () => {
    document.getElementById('reorderModal').classList.remove('hidden');
});
document.getElementById('closeReorderModal').addEventListener('click', () => {
    document.getElementById('reorderModal').classList.add('hidden');
});
</script>
@endsection

@section('js')
<script>
    $('#createLessonForm').on('submit', function (e) {
        e.preventDefault();

        const form = $(this);
        const formData = new FormData(this);

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: formData,
            contentType: false,
            processData: false,
            success: res => {
                if (res.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Lesson Saved',
                        text: res.message ?? 'Lesson saved successfully!',
                        showConfirmButton: true
                    }).then(() => {
                        location.reload();
                    });
                }
            },
            error: err => {
                let errorMessage = 'Please check your input.';
                if (err.responseJSON?.message) {
                    errorMessage = err.responseJSON.message;
                }
                Swal.fire('Error', errorMessage, 'error');
            }
        });
    });

function toggleCustomCategory(select) {
    const input = document.getElementById('category_input');

    if (select.value === '_custom') {
        // Show input for custom category
        input.style.display = 'block';
        input.required = true;
        input.name = 'category';
        select.removeAttribute('name');
        input.value = '';
    } else {
        // Hide input, set select as the category
        input.style.display = 'none';
        input.required = false;
        select.name = 'category';
        input.removeAttribute('name');
        input.value = '';
    }
}

$(document).on('click', '.editLessonBtn', function () {
    const id = $(this).data('id');
    const name = $(this).data('name');
    const category = $(this).data('category');
    const speaker = $(this).data('speaker');
    const description = $(this).data('description');
    const video = $(this).data('video');
    const docs = $(this).data('docs');
    const docs_description = $(this).data('docs_description'); 

    $('#lesson_id').val(id);
    $('#lesson_name').val(name);
    $('#speaker_name').val(speaker);
    $('#lesson_description').val(description);
    $('#video_path').val(video);
    $('#docs_link').val(docs);
    $('#docs_description').val(docs_description); 

    const select = $('#category_select');
    const input = $('#category_input');

    if (select.find(`option[value="${category}"]`).length) {
        // Existing category
        select.val(category).attr('name', 'category');
        input.hide().val('').removeAttr('name');
    } else {
        // Custom category
        select.val('_custom').removeAttr('name');
        input.show().val(category).attr('name', 'category');
    }

    $('#submitLessonBtn').text('Update Lesson').removeClass('bg-blue-600').addClass('bg-yellow-600');
    $('#cancelLessonBtn').removeClass('hidden');
    $('#createLessonForm').attr('action', `/admin/lesson/${id}/update`);
});

$(document).on('click', '#cancelLessonBtn', function () {
    $('#lesson_id').val('');
    $('#lesson_name').val('');
    $('#speaker_name').val('');
    $('#lesson_description').val('');
    $('#video_path').val('');
    $('#docs_link').val('');
    $('#docs_description').val(''); 

    // Reset category to default
    $('#category_select').val('').attr('name', 'category');
    $('#category_input').hide().val('').removeAttr('name');

    $('#submitLessonBtn').text('Add Lesson').removeClass('bg-yellow-600').addClass('bg-blue-600');
    $('#cancelLessonBtn').addClass('hidden');
    $('#createLessonForm').attr('action', `{{ route('academy.lesson.store', $module->module_id) }}`);
});


// On page load (for edit mode restore if needed)
document.addEventListener('DOMContentLoaded', () => {
    const select = document.getElementById('category_select');
    const input = document.getElementById('category_input');

    if (select.value === '_custom') {
        toggleCustomCategory(select);
    } else {
        select.name = 'category';
        input.removeAttribute('name');
    }
});



    $(document).on('click', '.deleteLessonBtn', function (e) {
        e.preventDefault();
        const lessonId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: 'This will permanently delete the lesson!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/lesson/${lessonId}/delete`,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res) {
                        Swal.fire('Deleted!', res.message, 'success');
                        $(`button[data-id="${lessonId}"]`).closest('tr').remove();
                    },
                    error: function () {
                        Swal.fire('Error', 'Something went wrong.', 'error');
                    }
                });
            }
        });
    });
</script>

<script>
document.getElementById('openReorderModal').addEventListener('click', () => {
    document.getElementById('reorderModal').classList.remove('hidden');
});
document.getElementById('closeReorderModal').addEventListener('click', () => {
    document.getElementById('reorderModal').classList.add('hidden');
});

// AJAX for reorder form
document.getElementById('reorderForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = this;
    const url = form.action;
    const formData = new FormData(form);

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) throw new Error('Request failed.');
        return response.json();
    })
   .then(data => {
    Swal.fire({
        icon: 'success',
        title: 'Updated!',
        text: 'Lesson order has been saved.',
        confirmButtonText: 'OK',
        showConfirmButton: true
    }).then(() => {
        location.reload(); // ⬅️ Reload after OK
    });

    document.getElementById('reorderModal').classList.add('hidden');
})

    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: 'Something went wrong.'
        });
    });
});
</script>



@endsection
