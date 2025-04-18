<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class SalesFunnelController extends Controller
{
    public function showFunnel($subdomain)
{
    $user = User::where('subdomain', $subdomain)->firstOrFail();
    return view('sales_funnel', compact('user'));
}

##############################################################################

// update subdomain part
    public function updateSubdomain(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subdomain' => 'required|string|unique:users,subdomain',
        ]);

        // Find the logged-in user and update their subdomain
        $user = User::findOrFail($request->user_id);
        $user->subdomain = $request->subdomain;
        $user->save();

        return back()->with('success', 'Subdomain updated successfully!');
    }



##############################################################################

// Show the form to edit the Facebook link, Join FB Group link, and Page Link
public function showForm()
{
    // Get the current authenticated user
    $user = Auth::user(); // Assuming the user is authenticated
    return view('edit-funnel', compact('user'));
}

// Save the updated Facebook link, Join FB Group link, Page Link, Page Toggle, and Group Toggle
public function save(Request $request)
{
    // Validate the input
    $request->validate([
        'facebook_link' => 'nullable|url',
        'join_fb_group' => 'nullable|url',
        'page_link' => 'nullable|url',
        'headline' => 'nullable|string|max:255',  // Validate headline
        'subheadline' => 'nullable|string|max:255',  // Validate subheadline
        'video_link' => 'nullable|url',  // Validate video link
    ]);

    // Get the authenticated user
    $user = Auth::user();

    // Update the fields
    $user->facebook_link = $request->facebook_link;
    $user->join_fb_group = $request->join_fb_group;
    $user->page_link = $request->page_link;

    // New fields to update
    $user->headline = $request->headline;  // Update headline
    $user->subheadline = $request->subheadline;  // Update subheadline

    // Handle the video link (check if it's a YouTube link or an MP4 file)
    if ($request->video_link) {
        if (filter_var($request->video_link, FILTER_VALIDATE_URL)) {
            // Check if it's a YouTube link
            if (strpos($request->video_link, 'youtube.com') !== false || strpos($request->video_link, 'youtu.be') !== false) {
                // Extract YouTube video ID from the URL
                preg_match('/(?:https?:\/\/(?:www\.)?youtube\.com\/(?:v|e(?:mbed)?)\/([a-zA-Z0-9_-]{11}))/', $request->video_link, $matches);
                // If the regular YouTube URL did not work, try the shortened youtu.be URL format
                if (empty($matches)) {
                    preg_match('/(?:https?:\/\/(?:www\.)?youtu\.be\/)([a-zA-Z0-9_-]{11})/', $request->video_link, $matches);
                }
                // If a match was found, construct the embed link
                if (isset($matches[1])) {
                    $user->video_link = 'https://www.youtube.com/embed/' . $matches[1];
                }
            } elseif (strpos($request->video_link, '.mp4') !== false) {
                // If it's an MP4 file, store the URL directly
                $user->video_link = $request->video_link;
            }
        }
    }

    // Checkbox values (because there's always a hidden input, it always has a value)
    $user->page_toggle = $request->page_toggle; 
    $user->group_toggle = $request->group_toggle;

    // Save the updated data
    $user->save();

    // Redirect back with a success message
    return redirect()->route('edit-funnel')->with('success', 'Details updated successfully!');
}



}
