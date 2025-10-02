@extends('layouts.users')

@section('title', 'My Courses')

@section('content')

 
<div class="relative">
    {{-- ✅ Hero Banner --}}
    <div class="relative text-center text-white py-16"
        style="
            background-image: url('https://static.vecteezy.com/system/resources/previews/016/102/699/original/digital-technology-banner-blue-green-background-concept-cyber-polygonal-technology-abstract-tech-innovation-future-data-internet-network-ai-big-data-lines-dots-connection-illustration-free-vector.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        ">
        

        <div class="container mx-auto p-4 sm:p-8 max-w-full">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/50"></div>

                <!-- Content (above overlay) -->
                <div class="relative z-10 py-10 md:py-14 px-4">
                  <h1 class="text-4xl md:text-5xl font-bold mb-3">
                        Global Entrepreneurs <span class="text-red-500">Masterclass</span>
                    </h1>

                    <p class="text-white/70 text-lg mb-6">
                        Curated lessons designed to level up your skills and boost your confidence.
                    </p>
                </div>
            </div>
        </div>

        {{-- ✅ Course Grid --}}
        <div class="relative -mt-20 px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">

            @forelse($courses->where('is_visible', 1) as $course)

                @php
                $userId = auth()->id();

                // Get all lessons in the course
                $allLessons = $course->modules->pluck('lessons')->flatten();
                $totalLessons = $allLessons->count();

                // Get completed lessons by user
                $completedLessons = \DB::table('completed_lessons')
                    ->where('user_id', $userId)
                    ->whereIn('lesson_id', $allLessons->pluck('lesson_id'))
                    ->get();

                $completedCount = $completedLessons->count();
                $percent = $totalLessons > 0 ? round(($completedCount / $totalLessons) * 100) : 0;
                $hasProgress = $completedCount > 0;
                $allCompleted = $totalLessons > 0 && $completedCount === $totalLessons;

                $latestCompletion = $allCompleted
                    ? collect($completedLessons)->sortByDesc('completed_at')->first()->completed_at ?? null
                    : null;
            @endphp


                <div class="w-full">
                    <div class="bg-white rounded-2xl shadow-lg border h-full flex flex-col relative" style="box-shadow: 0 0 40px rgba(255, 255, 255, 0.8);">
                        @if($course->course_thumbnail)
                            <img src="{{ asset('storage/' . $course->course_thumbnail) }}"
                                 class="w-full h-48 object-cover rounded-t-2xl">
                        @endif

                        <div class="p-4 flex flex-col flex-grow">
                            <h5 class="font-bold text-lg">{{ $course->course_name }}</h5>
                            <p class="text-slate-500 text-sm">{{ Str::limit($course->course_description, 100) }}</p>

                            @if($allCompleted && $latestCompletion)
                                <p class="text-slate-400 text-sm mt-2">
                                    Completed on: {{ \Carbon\Carbon::parse($latestCompletion)->format('F d, Y') }}
                                </p>
                            @endif

                            <p class="text-slate-400 text-sm mb-2">
                                <i class="bi bi-play-circle"></i> {{ $totalLessons }} Lessons
                                @if($totalLessons > 0)
                                    &middot; {{ $percent }}% Completed
                                @endif
                            </p>

                            @if($totalLessons > 0)
                                <div class="w-full h-2 bg-slate-200 rounded mb-3">
                                    <div class="h-2 bg-blue-500 rounded" style="width: {{ $percent }}%"></div>
                                </div>
                            @endif

                          @forelse ($course->modules as $module)
                                <a href="{{ route('academy.module.lessons', $module->module_id) }}"
                                class="mt-auto inline-block text-center px-4 py-2 bg-teal-600 text-white text-sm font-semibold rounded-md hover:bg-teal-700 transition"
                                data-course-id="{{ $course->course_id }}">
                                    @if($allCompleted)
                                        Re-watch →
                                    @elseif($hasProgress)
                                        Continue Learning →
                                    @else
                                        Start Learning →
                                    @endif
                                </a>
                            @empty
                                <span class="inline-block text-gray-500 text-sm italic mt-2">No modules & Lessons yet.</span>
                            @endforelse
                        </div>
                    </div>
                </div>

            @empty
                <div class="col-span-full">
                    <div class="flex flex-col items-center justify-center text-center bg-white p-10 rounded-2xl shadow" style="min-height: 250px; box-shadow: 0 0 25px rgba(255, 255, 255, 0.8);">
                        <i class="fas fa-face-smile-beam text-4xl text-blue-400 mb-3"></i>
                        <h5 class="mb-2 font-semibold text-lg">No Courses Available</h5>
                        <p class="text-slate-500 text-sm">Please check back later or contact support for help.</p>
                    </div>
                </div>
            @endforelse

            </div>
        </div>
    </div>
</div>
@endsection
