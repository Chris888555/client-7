@extends('layouts.academy')

@section('title', 'Modules')

@section('content')
<div class="flex flex-col md:flex-row gap-4">

<!-- Mobile sidebar toggle button -->
<div class="md:hidden p-2 bg-white border-b shadow-sm flex justify-between items-center fixed top-0 left-0 right-0 z-50">
    <button id="sidebarToggle" class="text-slate-700 font-semibold px-3 py-1 rounded ">
        ☰ View Lessons
    </button>
   
</div>


   <div class="flex">
    {{-- Sidebar --}}
   <div id="sidebar"
        class="fixed top-0 left-0 h-full bg-gray-800  border-r shadow-sm p-4 overflow-y-auto
               transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out
               z-40 pt-16 md:pt-4"
        style="width: 100vw; max-width: 450px;"
    >
        
    <div class="pb-3 mb-4 border-b border-slate-700">

                <div class="pb-3 mb-2">
                    <a href="{{ route('user.academy.courses') }}" class="hidden md:inline-flex items-center gap-2 px-3 py-1.5 text-sm text-white border hover:bg-gray-700 transition rounded-md">
                    <i class="fas fa-arrow-left text-sm"></i>
                    Back
                </a>
            </div>

                <h4 class="mb-1 font-bold text-lg text-white">{{ $course->course_name }}</h4>
                <p class="text-white text-sm">{{ $course->course_description }}</p>
            </div>

            <h5 class="mb-3 text-base font-semibold text-white">Course Completion</h5>

         @php
        // Total lessons for this specific module
        $total = $module->lessons()->count();
    
        // Completed lessons only for this module
        $completed = $module->lessons()
            ->whereIn('lesson_id', $completedLessons) // $completedLessons should be IDs lang
            ->count();
    
            $percent = $total > 0 ? round(($completed / $total) * 100) : 0;
        @endphp
        
        <div class="mb-4">
            <div class="flex justify-between text-xs text-slate-100 mb-1">
                <span>{{ $percent }}% Completed</span>
                <span>{{ $completed }}/{{ $total }}</span>
            </div>
            <div class="w-full h-1.5 bg-slate-100 rounded">
                <div class="h-1.5 bg-green-600 rounded" style="width: {{ $percent }}%"></div>
            </div>
        </div>

        <div class="mb-4">
            <button id="checkCertificateBtn" class="w-full border border-green-600 text-green-600 bg-white px-4 py-2 rounded-md text-sm font-semibold hover:bg-green-50 mb-4">
                View Certificate
            </button>
        </div>
        
        <h3 class="mb-3 text-base font-semibold text-white">Module: {{ $module->module_name }}</h3>

            @foreach ($categories as $category)
                @php $counter = 1; @endphp
                <li class="list-none">
                    <button
                        class="mt-4 flex justify-between items-center w-full text-left px-3 py-2 rounded-md text-gray-100 bg-gray-500 font-semibold hover:text-gray-700 hover:bg-gray-200 transition toggle-category"
                        data-category="{{ $category }}"
                    >
                        <span>{{ $category }}</span>
                        <svg class="w-4 h-4 transform transition-transform arrow-icon" data-category="{{ $category }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <ul class="ml-4 mt-2 hidden lesson-list space-y-1" data-category="{{ $category }}">
                        @foreach ($module->lessons->where('category', $category) as $lesson)
                            <li>
                               <button
                                class="lesson-item group text-left text-sm w-full px-4 py-2 rounded-md transition flex justify-between items-center
                                    {{ in_array($lesson->lesson_id, $lockedLessons) ? 'opacity-50' : 'cursor-pointer' }}"
                                data-lesson-id="lesson-{{ $lesson->lesson_id }}"
                            >
                                <span class="flex items-center gap-2">
                                        <span class="font-mono w-6 text-white group-[.active]:text-green-600 group-[.active]:font-bold">
                                            {{ str_pad($counter, 2, '0', STR_PAD_LEFT) }}
                                        </span>
                                        <span class="truncate text-white group-[.active]:text-green-600 group-[.active]:font-bold">
                                            {{ $lesson->lesson_name }}
                                        </span>
                                </span>

                                    @if (in_array($lesson->lesson_id, $completedLessons))
                                        <i class="fas fa-check-circle text-green-500"></i>
                                    @elseif (in_array($lesson->lesson_id, $lockedLessons))
                                        <i class="fas fa-lock text-gray-400"></i>
                                    @endif
                                </button>
                            </li>
                            @php $counter++; @endphp
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>

    
    {{-- Main Content --}}
    <div class="relative">
    {{-- Main Content --}}
    <div class="fixed top-0 left-0 md:left-[450px] right-0 p-4 pt-20 md:pt-4 h-screen overflow-y-auto bg-white">
        @foreach ($module->lessons as $lesson)
            <div class="lesson-viewer hidden" id="lesson-{{ $lesson->lesson_id }}">
                <h3 class="text-xl font-bold mb-2">{{ $lesson->lesson_name }}</h3>
             

                @if ($lesson->video_path)
                    <div class="aspect-video mb-3 rounded border shadow-sm overflow-hidden">
                        @if (Str::contains($lesson->video_path, 'youtube.com/embed'))
                            <iframe class="w-full h-full" src="{{ $lesson->video_path }}" frameborder="0" allowfullscreen></iframe>
                        @else
                            <video controls class="w-full h-full">
                                <source src="{{ $lesson->video_path }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    </div>
                @endif

                <p class="text-sm italic text-slate-500 mb-3">Speaker: {{ $lesson->speaker_name }}</p>
            @if (!in_array($lesson->lesson_id, $completedLessons))
                <button
                    onclick="completeLesson({{ $lesson->lesson_id }})"
                    class="border border-blue-600 text-blue-600 text-sm px-3 py-1.5 rounded-md hover:bg-blue-50 transition mb-3 mark-complete-btn flex items-center gap-2"
                >
                    <i class="fas fa-check"></i> Mark as Complete
                </button>
            @else
                <button
                    disabled
                    class="border border-green-600 bg-green-50 text-green-600 text-sm px-3 py-1.5 rounded-md mb-3 flex items-center gap-2 cursor-not-allowed"
                >
                    <i class="fas fa-check-circle"></i> Lesson Completed
                </button>
            @endif
            <p class="text-sm text-green-600 mb-2">Discription:</p>
               <p class="text-sm text-slate-600 mb-3">{{ $lesson->lesson_description }}</p>

              @if ($lesson->docs_link)
                <div class="mt-4 rounded-lg p-5 shadow-lg bg-white border-t-4 border-blue-600">
                    <div class="flex items-start gap-3">

                        <!-- Text + Button -->
                        <div class="flex-1">
                            @if(!empty($lesson->docs_description))
                                <p class="text-sm text-slate-500 mb-3">{{ $lesson->docs_description }}</p>
                            @else
                                <p class="text-sm text-slate-500 mb-3">You can view or download the supporting documents for this lesson below.</p>
                            @endif
                            <a href="{{ $lesson->docs_link }}" target="_blank"
                            class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md shadow">
                            <i class="fas fa-file-download mr-2"></i> <!-- Font Awesome icon -->
                            View Documents
                            </a>
                        </div>
                    </div>
                </div>
            @endif


            </div>
        @endforeach

        <div id="noLesson" class="text-slate-500 text-sm">Please select a lesson to view.</div>
    </div>
</div>

{{-- JavaScript --}}
<script>
    function completeLesson(lessonId) {
        fetch('/academy/lesson/complete', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ lesson_id: lessonId })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                Swal.fire('Good job!', 'Lesson marked as complete!', 'success').then(() => {
                    location.reload(); // Refresh to update lock state
                });
            }
        });
    }

    // Toggle dropdown
    document.querySelectorAll('.toggle-category').forEach(btn => {
        btn.addEventListener('click', () => {
            const category = btn.dataset.category;
            const list = document.querySelector(`.lesson-list[data-category="${category}"]`);
            if (list) list.classList.toggle('hidden');

            const arrow = document.querySelector(`.arrow-icon[data-category="${category}"]`);
            if (arrow) arrow.classList.toggle('rotate-180');
        });
    });

   // Show lesson or show locked alert
function showLesson(lessonId) {
    const lessonBtn = document.querySelector(`.lesson-item[data-lesson-id="${lessonId}"]`);

    if (lessonBtn && lessonBtn.classList.contains('opacity-50')) {
        Swal.fire('Locked', 'Please complete previous lessons to unlock this one.', 'warning');
        return;
    }

    // Hide all lesson viewers
    document.querySelectorAll('.lesson-viewer').forEach(el => el.classList.add('hidden'));

    // Show selected lesson viewer
    const selected = document.getElementById(lessonId);
    if (selected) selected.classList.remove('hidden');

    // Hide the no-lesson message
    document.getElementById('noLesson').style.display = 'none';

    // Remove previous active state
    document.querySelectorAll('.lesson-item').forEach(item => {
        item.classList.remove('active');
    });

    // Add active to selected
    lessonBtn.classList.add('active');

    // 🔽 Hide sidebar on mobile
    if (window.innerWidth < 768) {
        document.getElementById('sidebar').classList.add('-translate-x-full');
    }
}



// Attach click event listeners to all lesson buttons
document.querySelectorAll('.lesson-item').forEach(item => {
    item.addEventListener('click', () => {
        const lessonId = item.dataset.lessonId;
        showLesson(lessonId);
    });
});


    // Auto-expand first category and open first lesson
    window.addEventListener('DOMContentLoaded', () => {
        const firstCategoryBtn = document.querySelector('.toggle-category');
        const firstLessonBtn = document.querySelector('.lesson-item:not(.cursor-not-allowed)');

        if (firstCategoryBtn) {
            const category = firstCategoryBtn.dataset.category;
            const list = document.querySelector(`.lesson-list[data-category="${category}"]`);
            const arrow = document.querySelector(`.arrow-icon[data-category="${category}"]`);
            if (list) list.classList.remove('hidden');
            if (arrow) arrow.classList.add('rotate-180');
        }

        if (firstLessonBtn) {
            firstLessonBtn.click();
        }
    });


    document.getElementById('checkCertificateBtn').addEventListener('click', function() {
    fetch('/academy/module/{{ $module->module_id }}/check-completion', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.completed) {
            // Redirect to certificate page
            window.location.href = `/academy/module/{{ $module->module_id }}/certificate`;
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Incomplete',
                text: 'Kailangan tapusin muna lahat ng lessons bago makita ang certificate.',
                confirmButtonText: 'OK'
            });
        }
    });
});

// Mobile sidebar toggle
    const sidebar = document.getElementById('sidebar');
    const sidebarToggleBtn = document.getElementById('sidebarToggle');

    sidebarToggleBtn.addEventListener('click', () => {
        if (sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.remove('-translate-x-full');
        } else {
            sidebar.classList.add('-translate-x-full');
        }
    });

    // Click outside sidebar closes it (mobile only)
    document.addEventListener('click', (e) => {
        if (!sidebar.contains(e.target) && !sidebarToggleBtn.contains(e.target) && window.innerWidth < 768) {
            sidebar.classList.add('-translate-x-full');
        }
    });
    if (window.innerWidth < 768) {
    document.getElementById('sidebar').classList.add('-translate-x-full');
}


</script>
@endsection
