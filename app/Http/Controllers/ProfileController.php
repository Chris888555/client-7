<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Show the upload form
    public function showUploadForm()
    {
        // Check if the user is logged in
        $user = Auth::user();

        // If no user is logged in, redirect to the login page
        if (!$user) {
            return redirect()->route('login'); // You can change this route to your login page route
        }

        // If no profile picture is set, use the default profile picture
        if (!$user->profile_picture) {
            // Use the default profile picture if none is set
            $user->profile_picture = $user->default_profile ?? 'profile_photos/default.jpg'; // Fallback default image
        }

        // Pass the user data to the view
        return view('profile.uploadprofile', compact('user'));
    }

    public function showStudentHeader()
    {
        // Get the logged-in user
        $user = Auth::user();

        // If no user is logged in, redirect to the login page
        if (!$user) {
            return redirect()->route('login'); // Adjust to match your login route
        }

        // If no profile picture is set, use the default profile picture
        if (!$user->profile_picture) {
            // Use the default profile picture if none is set
            $user->profile_picture = $user->default_profile ?? 'profile_photos/default.jpg'; // Fallback default image
        }

        // Pass the user data to the view
        return view('includes.student-header', compact('user')); // Updated to student-header
    }

    public function uploadProfilePhoto(Request $request)
    {
        // Validate the request
        $request->validate([
            'cropped_profile_photo' => 'required|string',
        ]);

        // Decode the cropped image from base64
        $image = $request->input('cropped_profile_photo');
        $imageData = str_replace('data:image/jpeg;base64,', '', $image);
        $imageData = str_replace(' ', '+', $imageData);

        // Get the authenticated user
        $user = Auth::user();

        // Delete the old profile picture if it exists and is not the default
        if ($user->profile_picture && $user->profile_picture !== 'profile_photos/default.jpg') {
            $oldImagePath = storage_path('app/public/' . $user->profile_picture);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // Delete the old file
            }
        }

        // Generate a unique name for the new profile picture
        $imageName = 'profile_' . time() . '.jpg';

        // Save the new profile picture
        $newImagePath = storage_path('app/public/profile_photos/' . $imageName);
        file_put_contents($newImagePath, base64_decode($imageData));

        // Update the user's profile picture in the database
        $user->profile_picture = 'profile_photos/' . $imageName; // Store relative path
        $user->save();

        // Redirect with success message
        return redirect()->route('profile.uploadForm')->with('success', 'Profile photo updated successfully!');
    }

  

// Update name and email
public function updateDetails(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . auth()->id(),
    ]);

    $user = auth()->user();
    $user->name = $request->name; // <-- this is the correct column
    $user->email = $request->email;
    $user->save();

    return back()->with('success', 'Your details updated successfully.');
}

// Update password
public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'new_password' => ['required', 'string', 'min:3', 'confirmed'],
    ]);

    $user = auth()->user();
    $user->update([
        'password' => Hash::make($request->new_password),
    ]);

    return back()->with('success', 'Password changed successfully.');
}


}
