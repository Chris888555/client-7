<?php
namespace App\Http\Controllers\Academy;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller; 
use App\Models\Academy\Playlist;


class AcademyController extends Controller
{
   
    public function show()
{
    return view('admin.academy.create');  
}


public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:255',
        'video_link' => 'nullable|url',
        'file' => 'nullable|file|mimes:mp4,jpg,jpeg,png,pdf|max:10240',
    ]);

    $videoLink = null;
    $thumbnailUrl = null;

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        if (in_array(strtolower($extension), ['mp4'])) {
            $videoPath = $file->store('academy_videos', 'public');
            $videoLink = asset('storage/' . $videoPath);
        } else {
            $thumbnailPath = $file->store('academy_thumbnail', 'public');
            $thumbnailUrl = $thumbnailPath;
        }
    }

    // Fallback to video_link input if no uploaded MP4
    if (!$videoLink && $request->filled('video_link')) {
        $videoLinkInput = $request->video_link;
        $videoId = $this->extractYouTubeId($videoLinkInput);

        if ($videoId) {
            $videoLink = 'https://www.youtube.com/embed/' . $videoId;
        } elseif (str_ends_with($videoLinkInput, '.mp4')) {
            $videoLink = $videoLinkInput;
        } else {
            return back()->withErrors(['video_link' => 'Invalid video link.']);
        }
    }

    if (!$videoLink) {
        return back()->withErrors(['file' => 'Upload an MP4 or provide a valid video link.']);
    }

    Playlist::create([
        'title' => $request->title,
        'video_link' => $videoLink,
        'thumbnail_url' => $thumbnailUrl,
    ]);

    if ($request->ajax()) {
        return response()->json(['message' => 'Playlist uploaded successfully!']);
    }

    return redirect()->back()->with('success', 'Playlist uploaded successfully!');
}

private function extractYouTubeId($url)
{
    $pattern = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
    preg_match($pattern, $url, $matches);
    return $matches[1] ?? null;
}



public function showAcademy()
{
    $playlists = Playlist::all();
    return view('user.academy.academy', compact('playlists'));
}



public function showAcademyupdate()
{
    $playlists = Playlist::paginate(10); 
    return view('admin.academy.academy-edit', compact('playlists'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|max:255',
        'video_link' => 'nullable|url',
        'file' => 'nullable|file|mimes:mp4,jpg,jpeg,png,pdf|max:10240',
    ]);

    $playlist = Playlist::findOrFail($id);

    $videoLink = $playlist->video_link;
    $thumbnailUrl = $playlist->thumbnail_url;

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        if (in_array($extension, ['mp4'])) {
            $videoPath = $file->store('academy_videos', 'public');
            $videoLink = asset('storage/' . $videoPath);
        } else {
            $thumbnailPath = $file->store('academy_thumbnail', 'public');
            $thumbnailUrl = $thumbnailPath;
        }
    }

    if (!$request->hasFile('file') && $request->filled('video_link')) {
    $videoId = $this->extractYouTubeId($request->video_link);
    if ($videoId) {
        $videoLink = 'https://www.youtube.com/embed/' . $videoId;
    } else {
        // If not YouTube, assume direct MP4 link
        if (str_ends_with($request->video_link, '.mp4')) {
            $videoLink = $request->video_link;
        } else {
            return response()->json(['message' => 'Invalid video link'], 422);
        }
    }
}


    if (!$videoLink) {
        return back()->withErrors(['file' => 'Upload an MP4 or provide a YouTube link.']);
    }

    $playlist->update([
    'title' => $request->title,
    'video_link' => $videoLink,
    'thumbnail_url' => $thumbnailUrl,
]);


    if ($request->ajax()) {
        return response()->json(['message' => 'Video updated successfully.']);
    }

    return redirect()->back()->with('success', 'Video updated successfully.');
}

public function bulkDelete(Request $request)
{
    $ids = $request->ids; // array of IDs

    if (!$ids || !is_array($ids)) {
        return response()->json(['message' => 'No items selected'], 422);
    }

    // Fetch playlists first
    $playlists = Playlist::whereIn('id', $ids)->get();

    foreach ($playlists as $playlist) {
        // Delete video file if stored locally
        if ($playlist->video_link && str_contains($playlist->video_link, asset('storage'))) {
            // Extract relative path from full URL
            $videoPath = str_replace(asset('storage') . '/', '', $playlist->video_link);
            Storage::disk('public')->delete($videoPath);
        }

        // Delete thumbnail file if exists
        if ($playlist->thumbnail_url) {
            Storage::disk('public')->delete($playlist->thumbnail_url);
        }
    }

    // Delete DB records
    Playlist::whereIn('id', $ids)->delete();

    return response()->json(['message' => 'Selected videos deleted successfully.']);
}


}