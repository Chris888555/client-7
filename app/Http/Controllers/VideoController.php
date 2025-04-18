<?php

namespace App\Http\Controllers;

use App\Models\VideoWatchProgress;
use App\Models\User;
use Illuminate\Http\Request;

class VideoController extends Controller
{

public function saveVideoProgress(Request $request)
{
    // Retrieve the user based on the subdomain
    $user = User::where('subdomain', $request->subdomain)->firstOrFail();

    // Get the data sent from the frontend
    $userCookie = $request->user_cookie;
    $videoLink = $request->video_link;
    $progress = $request->progress;
    $maxWatchPercentage = $request->max_watch_percentage;

    // Check if there's existing progress for this user, video, and user_cookie
    $videoProgress = VideoWatchProgress::where('user_id', $user->id)
                                       ->where('video_link', $videoLink)
                                       ->where('user_cookie', $userCookie)
                                       ->first();

    if ($videoProgress) {
        // If a record exists with the same user_cookie, just update the progress
        $videoProgress->progress = $progress;
        $videoProgress->max_watch_percentage = max($videoProgress->max_watch_percentage, $maxWatchPercentage); // Update max watch percentage
        $videoProgress->save();
    } else {
        // If no record exists with the same user_cookie and video_link, create a new record
        VideoWatchProgress::create([
            'user_id' => $user->id,
            'video_link' => $videoLink,
            'progress' => $progress,
            'max_watch_percentage' => $maxWatchPercentage, // Set initial max watch to current progress
            'user_cookie' => $userCookie, // Store user cookie for tracking
        ]);
    }

    return response()->json(['message' => 'Progress saved successfully']);
}


// fetch video analytics

public function showAnalytics()
{
    $userId = auth()->id();

    // Paginate results, 10 records per page (you can change the number)
    $videoAnalytics = VideoWatchProgress::where('user_id', $userId)
                        ->orderBy('created_at', 'desc')
                        ->paginate(8);  // Adjust the number as needed

    return view('video-analytics', compact('videoAnalytics'));
}

 public function deleteSelectedAnalytics(Request $request)
{
    $selectedRecords = $request->input('selected');

    if ($selectedRecords && count($selectedRecords) > 0) {
        VideoWatchProgress::whereIn('id', $selectedRecords)->delete();
      return redirect()->route('video.analytics')->with('success', 'Selected records deleted successfully.');

    }

    return redirect()->route('video.analytics')->with('error', 'No records selected for deletion.');
}

}


 