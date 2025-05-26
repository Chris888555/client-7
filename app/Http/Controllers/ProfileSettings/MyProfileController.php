<?php

namespace App\Http\Controllers\ProfileSettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MyProfileController extends Controller
{
    public function index()
    {
         return view('profile.myprofile');
    }

   public function upload(Request $request)
{
    $request->validate([
        'cropped_profile_photo' => 'required|string',
    ]);

    // Convert base64 to image and store it
    $imageData = $request->input('cropped_profile_photo');
    $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);
    $image = base64_decode($imageData);

    $fileName = 'profiles/' . uniqid() . '.jpg';
    Storage::disk('s3')->put($fileName, $image, 'public');

    // Save the path or url to user's 'picture' column
    $user = auth()->user();
    $user->picture = Storage::disk('s3')->url($fileName);
    $user->save();

    return back()->with('image_url', $user->picture);
}

}

