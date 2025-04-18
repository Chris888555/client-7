<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FunnelSettingsController extends Controller
{
    /**
     * Show the funnel settings form.
     */
   public function index()
{
    $defaults = User::first(); // Get first user's settings as default values

    return view('funnel-setting', compact('defaults'));
}

    /**
     * Save settings and update all users.
     */
    public function save(Request $request)
    {
        // Validate inputs
        $request->validate([
            'facebook_link' => 'nullable|url',
            'join_fb_group' => 'nullable|url',
            'page_link' => 'nullable|url',
            'headline' => 'nullable|string|max:255',
            'subheadline' => 'nullable|string|max:255',
            'video_link' => 'nullable|url',
        ]);

        // Prepare the updated values
        $videoEmbed = null;
        if ($request->video_link) {
            if (strpos($request->video_link, 'youtube.com') !== false || strpos($request->video_link, 'youtu.be') !== false) {
                preg_match('/(?:https?:\/\/(?:www\.)?youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $request->video_link, $matches);
                if (isset($matches[1])) {
                    $videoEmbed = 'https://www.youtube.com/embed/' . $matches[1];
                }
            } elseif (strpos($request->video_link, '.mp4') !== false) {
                $videoEmbed = $request->video_link;
            }
        }

        // Update all users
        User::query()->update([
            'facebook_link' => $request->facebook_link,
            'join_fb_group' => $request->join_fb_group,
            'page_link' => $request->page_link,
            'headline' => $request->headline,
            'subheadline' => $request->subheadline,
            'video_link' => $videoEmbed,
        ]);

        return redirect()->back()->with('success', 'Funnel settings updated for all users!');
    }
}
