<?php

namespace App\Http\Controllers\Academy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Academy\Course;
use App\Models\Academy\Module;
use App\Models\Academy\Lesson;
use App\Models\Academy\CompletedModule;
use App\Models\Academy\Certificate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class AcademyController extends Controller
{
  // View all visible courses
public function viewCourses()
{
    $courses = Course::where('is_visible', 1)
        ->orderBy('order')
        ->get();

    return view('user.academy.courses', compact('courses'));
}

  

   public function viewModuleLessonsByCategory($module_id)
{
    $module = Module::with(['lessons' => function ($q) {
        $q->orderBy('category')->orderBy('order');
    }, 'course'])->findOrFail($module_id); 

    $categories = $module->lessons->pluck('category')->unique()->filter();

    $completedLessons = \DB::table('completed_lessons')
        ->where('user_id', auth()->id())
        ->pluck('lesson_id')
        ->toArray();

    $lockedLessons = [];
    $unlockNext = true;

    foreach ($module->lessons as $lesson) {
        $isCompleted = in_array($lesson->lesson_id, $completedLessons);

        if ($isCompleted) continue;

        if ($unlockNext) {
            $unlockNext = false;
            continue;
        }

        $lockedLessons[] = $lesson->lesson_id;
    }

    $course = $module->course; // ✅ now we can pass $course

    return view('user.academy.module_lessons', compact(
        'module',
        'course', // ✅ pass this to avoid undefined error
        'categories',
        'completedLessons',
        'lockedLessons'
    ));
}





            public function completeLesson(Request $request)
        {
            $request->validate([
                'lesson_id' => 'required|exists:lessons,lesson_id',
            ]);

            $userId = auth()->id();
            $lessonId = $request->lesson_id;

            // Save completed lesson
            \DB::table('completed_lessons')->updateOrInsert([
                'user_id' => $userId,
                'lesson_id' => $lessonId
            ], [
                'completed_at' => now()
            ]);

            // Get module of the lesson
            $lesson = Lesson::find($lessonId);
            $moduleId = $lesson->module_id;

            // Check if all lessons in this module are completed by user
            $totalLessons = Lesson::where('module_id', $moduleId)->count();
            $completedLessons = \DB::table('completed_lessons')
                ->where('user_id', $userId)
                ->whereIn('lesson_id', Lesson::where('module_id', $moduleId)->pluck('lesson_id'))
                ->count();

            // If all lessons done, mark module complete
            if ($totalLessons == $completedLessons) {
                \DB::table('completed_modules')->updateOrInsert([
                    'user_id' => $userId,
                    'module_id' => $moduleId
                ], [
                    'completion_date' => now()
                ]);
            }

            return response()->json(['status' => 'success']);
        }

        public function checkCompletion($module_id)
        {
            $userId = auth()->id();

            $totalLessons = Lesson::where('module_id', $module_id)->count();

            $completedLessonsCount = \DB::table('completed_lessons')
                ->where('user_id', $userId)
                ->whereIn('lesson_id', Lesson::where('module_id', $module_id)->pluck('lesson_id'))
                ->count();

            return response()->json([
                'completed' => $totalLessons > 0 && $completedLessonsCount == $totalLessons
            ]);
        }

        public function viewCertificate($module_id)
        {
            $userId = auth()->id();

            $completedModule = \DB::table('completed_modules')
                ->where('user_id', $userId)
                ->where('module_id', $module_id)
                ->first();

            if (!$completedModule) {
                return redirect()->back()->with('error', 'Module not completed yet.');
            }

            // Load module and user data, pass to certificate view
            $module = Module::findOrFail($module_id);

            return view('user.academy.certificate', compact('module', 'completedModule'));
        }



    // Admin: show course list
    public function create()
    {
        $courses = Course::orderBy('order')->paginate(11); 
        return view('admin.academy.course', compact('courses'));
    }

    // Admin: store new course
    public function store(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'course_description' => 'nullable|string',
            'course_thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('course_thumbnail')) {
            $path = $request->file('course_thumbnail')->store('course_thumbnails', 'public');
        }

        Course::create([
            'course_name' => $request->course_name,
            'course_description' => $request->course_description,
            'course_thumbnail' => $path,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Course created successfully.'
        ]);
    }

    // Admin: manage modules of a course
    public function manageModules($id)
    {
        $course = Course::with('modules.lessons')->findOrFail($id);
        return view('admin.academy.modules', compact('course'));
    }

    // Admin: store a new module (just the name)
        public function storeModule(Request $request, $course_id)
        {
            $request->validate([
                'module_name' => 'required|string|max:255',
            ]);

            // ✅ Check if course already has a module
            $existingModule = Module::where('course_id', $course_id)->first();

            if ($existingModule) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'This course already has a module. Multiple modules are not allowed.'
                ], 422); // Use 422 for validation error
            }

            // ✅ Create if not exists
            Module::create([
                'course_id' => $course_id,
                'module_name' => $request->module_name,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Module created successfully.'
            ]);
        }


    // Show lesson manager inside a module
public function manageLessons(Request $request, $id)
{
       $category = $request->query('category');

    // Load filtered lessons
    $lessons = Lesson::where('module_id', $id)
        ->when($category, fn($q) => $q->where('category', $category))
        ->orderBy('created_at', 'asc') // gagawin natin via join/subquery
        ->orderBy('order', 'asc')
        ->paginate(10);

    // Module details
    $module = Module::findOrFail($id);

    // For filter dropdown
    $allCategories = Lesson::where('module_id', $id)
        ->pluck('category')
        ->unique()
        ->filter();

    // For reorder modal
    $groupedLessons = Lesson::where('module_id', $id)
        ->orderBy('category')
        ->orderBy('order')
        ->get()
        ->groupBy('category');

    return view('admin.academy.lessons', compact(
        'module', 'lessons', 'allCategories', 'category', 'groupedLessons'
    ));
}


    // Admin: store lesson inside a module
 public function storeLesson(Request $request, $module_id)
{
    $request->validate([
        'lesson_name' => 'required|string|max:255',
        'category' => 'nullable|string|max:50', 
        'lesson_description' => 'nullable|string',
        'video_path' => 'nullable|string|max:255',
        'speaker_name' => 'nullable|string|max:100',
        'docs_link' => 'nullable|string|max:500',
        'docs_description' => 'nullable|string',
    ]);

    // Auto-convert YouTube URL to embed format
    $videoPath = $request->video_path;
    if (Str::contains($videoPath, ['youtu.be', 'youtube.com'])) {
        preg_match('/(?:youtu\.be\/|v=)([^\?&]+)/', $videoPath, $matches);
        if (isset($matches[1])) {
            $videoId = $matches[1];
            $videoPath = "https://www.youtube.com/embed/{$videoId}";
        }
    }

    // 🔍 Get the highest 'order' for the same category in the same module
    $lastOrder = Lesson::where('module_id', $module_id)
        ->when($request->category, function ($q) use ($request) {
            $q->where('category', $request->category);
        })
        ->max('order');

    // If none found, default to 0
    $newOrder = $lastOrder ? $lastOrder + 1 : 1;

    Lesson::create([
        'module_id' => $module_id,
        'lesson_name' => $request->lesson_name,
        'category' => $request->category,
        'lesson_description' => $request->lesson_description,
        'video_path' => $videoPath,
        'speaker_name' => $request->speaker_name,
        'docs_link' => $request->docs_link, 
        'docs_description' => $request->docs_description,
        'order' => $newOrder,
    ]);

    return response()->json(['status' => 'success', 'message' => 'Lesson created successfully.']);
}



// ###################################################################################################
// ###################################################################################################
// Function only COURSES
// ###################################################################################################
// ###################################################################################################


// Update course Function
public function update(Request $request)
{
    $request->validate([
        'course_id' => 'required|exists:courses,course_id',
        'course_name' => 'required|string|max:255',
        'course_description' => 'nullable|string',
        'course_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $course = Course::find($request->course_id);

    if (!$course) {
        return response()->json(['status' => 'error', 'message' => 'Course not found.'], 404);
    }

    // Upload new thumbnail if provided
    if ($request->hasFile('course_thumbnail')) {
        // Delete old file if exists
        if ($course->course_thumbnail && Storage::disk('public')->exists($course->course_thumbnail)) {
            Storage::disk('public')->delete($course->course_thumbnail);
        }

        $course->course_thumbnail = $request->file('course_thumbnail')->store('course_thumbnails', 'public');
    }

    $course->update([
        'course_name' => $request->course_name,
        'course_description' => $request->course_description,
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Course updated successfully.'
    ]);
}

    // function to delete
public function bulkDelete(Request $request)
{
    $courses = Course::whereIn('course_id', $request->ids)->get();

    foreach ($courses as $course) {
        // Delete thumbnail if exists
        if ($course->course_thumbnail && Storage::disk('public')->exists($course->course_thumbnail)) {
            Storage::disk('public')->delete($course->course_thumbnail);
        }

        // Delete the course
        $course->delete();
    }

        return response()->json([
            'message' => 'Selected courses and thumbnails deleted successfully.'
        ]);
    }

    public function toggleVisibility($id)
    {
        $course = Course::findOrFail($id);
        $course->is_visible = !$course->is_visible;
        $course->save();

        return response()->json([
            'success' => true,
            'visible' => $course->is_visible
        ]);
    }

    public function reorderManual(Request $request)
    {
        foreach ($request->order as $courseId => $order) {
            Course::where('course_id', $courseId)->update(['order' => (int) $order]);
        }

        return response()->json(['message' => 'Courses reordered successfully.']);
    }


// ###################################################################################################
// ###################################################################################################
// Function only Module
// ###################################################################################################
// ###################################################################################################

// Admin: update existing module
public function updateModule(Request $request, $module_id)
{
    $request->validate([
        'module_name' => 'required|string|max:255',
    ]);

    $module = Module::findOrFail($module_id);
    $module->module_name = $request->module_name;
    $module->save();

    return response()->json([
        'status' => 'success',
        'message' => 'Module updated successfully.'
    ]);
}

public function deleteModule($module_id)
{
    $module = Module::findOrFail($module_id);
    $module->delete();

    return response()->json([
        'status' => 'success',
        'message' => 'Module deleted successfully.'
    ]);
}


// ###################################################################################################
// ###################################################################################################
// Function only Lessons
// ###################################################################################################
// ###################################################################################################

// Admin: update lesson inside a module
public function updateLesson(Request $request, $lesson_id)
{
    $request->validate([
        'lesson_name' => 'required|string|max:255',
        'category' => 'nullable|string|max:50',
        'lesson_description' => 'nullable|string',
        'video_path' => 'nullable|string|max:255',
        'speaker_name' => 'nullable|string|max:100',
        'docs_link' => 'nullable|string|max:500',
        'docs_description' => 'nullable|string',
    ]);

    $lesson = Lesson::findOrFail($lesson_id);

    // Auto-convert YouTube URL to embed format
    $videoPath = $request->video_path;
    if (Str::contains($videoPath, ['youtu.be', 'youtube.com'])) {
        preg_match('/(?:youtu\.be\/|v=)([^\?&]+)/', $videoPath, $matches);
        if (isset($matches[1])) {
            $videoId = $matches[1];
            $videoPath = "https://www.youtube.com/embed/{$videoId}";
        }
    }

    $lesson->update([
        'lesson_name' => $request->lesson_name,
        'category' => $request->category,
        'lesson_description' => $request->lesson_description,
        'video_path' => $videoPath,
        'speaker_name' => $request->speaker_name,
        'docs_link' => $request->docs_link, 
        'docs_description' => $request->docs_description,
    ]);

    return response()->json(['status' => 'success', 'message' => 'Lesson updated successfully.']);
}

public function deleteLesson($id)
{
    $lesson = Lesson::findOrFail($id);
    $lesson->delete();

    return response()->json(['success' => true, 'message' => 'Lesson deleted successfully.']);
}



public function reorderLessons(Request $request, $module_id)
{
    $orders = $request->input('order', []);

    foreach ($orders as $lessonId => $order) {
        Lesson::where('lesson_id', $lessonId)
            ->where('module_id', $module_id)
            ->update(['order' => (int) $order]);
    }

    return response()->json(['message' => 'Lesson order updated successfully.']);
}



}
