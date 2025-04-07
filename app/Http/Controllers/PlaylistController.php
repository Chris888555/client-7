<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlaylistController extends Controller
{
    // Ensure only authenticated users can access
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show the form to create a new playlist
    public function create()
    {
          // Check if the user is authenticated and is an admin
        if (!auth()->check() || auth()->user()->is_admin == 0) {
            return redirect()->route('login');
        }
        
        return view('admin.upload-playlist');
    }

    // Store the playlist
    public function store(Request $request)
    {
        // Check if the user is authenticated and is an admin
        if (!auth()->check() || auth()->user()->is_admin == 0) {
            return redirect()->route('admin.login');
        }

        // Validate the form inputs
        $request->validate([
            'title' => 'required|max:255',
            'video_link' => 'required|url', // Validate that it's a valid URL
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validate thumbnail (optional)
        ]);

        // Handle the thumbnail upload
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // Store the playlist in the database
        Playlist::create([
            'title' => $request->title,
            'video_link' => $request->video_link,
            'thumbnail_url' => $thumbnailPath, // Save the path to the image
        ]);

        return redirect()->route('admin.upload-playlist')->with('success', 'Playlist uploaded successfully!');
    }





 // Show the form to edit a playlist
 public function edit()
 {
     $playlists = Playlist::all(); // Fetch all playlists
     return view('admin.update-playlist', compact('playlists')); // Pass the playlists to the view
 }

 // Update the playlist
 public function update(Request $request, $id)
 {
     $playlist = Playlist::findOrFail($id); // Find the playlist by ID or fail
 
     // Validate the form inputs
     $request->validate([
         'title' => 'required|max:255',
         'video_link' => 'required|url', // Validate that it's a valid URL
         'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validate thumbnail (optional)
     ]);
 
     // Handle the thumbnail upload if new file is uploaded
     $thumbnailPath = $playlist->thumbnail_url; // Keep the existing thumbnail if no new one is uploaded
     if ($request->hasFile('thumbnail')) {
         // Delete the old thumbnail if it exists
         if ($thumbnailPath) {
             Storage::disk('public')->delete($thumbnailPath);
         }
         $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
     }
 
     // Update the playlist data in the database
     $playlist->update([
         'title' => $request->title,
         'video_link' => $request->video_link,
         'thumbnail_url' => $thumbnailPath, // Update the thumbnail path
     ]);
 
     return redirect()->route('admin.update-playlist')->with('success', 'Playlist updated successfully!');
 }
 

 // Delete a playlist
 public function destroy($id)
 {
     $playlist = Playlist::findOrFail($id);

     // Delete the playlist's thumbnail from storage if it exists
     if ($playlist->thumbnail_url) {
         Storage::disk('public')->delete($playlist->thumbnail_url);
     }

     // Delete the playlist from the database
     $playlist->delete();

     return redirect()->route('admin.update-playlist')->with('success', 'Playlist deleted successfully!');
 }


}