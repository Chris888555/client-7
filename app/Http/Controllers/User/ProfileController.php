<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User\Users;
use App\Http\Controllers\User\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function showProfileForm()
{
        $user = auth()->user(); // or use Auth::user();

    return view('user.home.myprofile', compact('user'));

}

    public function uploadProfilePhoto(Request $request)
    {
        $request->validate([
            'cropped_profile_photo' => 'required|string',
        ]);

        $image = $request->input('cropped_profile_photo');
        $imageData = str_replace('data:image/jpeg;base64,', '', $image);
        $imageData = str_replace(' ', '+', $imageData);

        $user = Auth::user();

        if ($user->profile_picture && $user->profile_picture !== 'profile_photos/default.jpg') {
            $oldImagePath = storage_path('app/public/' . $user->profile_picture);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $directory = storage_path('app/public/profile_photos');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $imageName = 'profile_' . time() . '.jpg';
        $newImagePath = $directory . '/' . $imageName;
        file_put_contents($newImagePath, base64_decode($imageData));

        $user->profile_picture = 'profile_photos/' . $imageName;
        $user->save();

       return response()->json(['message' => 'Profile uploaded successfully.']);
    }

// update profile info

public function updateInfo(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name'  => 'nullable|string|max:255',
        'email' => 'nullable|email',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors()
        ], 422);
    }

    $user = auth()->user();

    // Check if email is already taken by another user
    if ($request->filled('email')) {
        $exists = Users::where('email', $request->email)
                    ->where('id', '!=', $user->id)
                    ->exists();

        if ($exists) {
            return response()->json([
                'errors' => ['email' => ['Email is already taken.']]
            ], 422);
        }
    }

    $data = [];
    if ($request->filled('name')) $data['name'] = $request->name;
    if ($request->filled('email')) $data['email'] = $request->email;

    $user->update($data);

    return response()->json(['message' => 'Personal info updated successfully.']);
}


public function updatePassword(Request $request)
{
    $validator = Validator::make($request->all(), [
        'current_password' => 'required',
        'new_password' => 'required|string|min:3|confirmed',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors() // ← returns all errors
        ], 422);
    }

    if (!Hash::check($request->current_password, auth()->user()->password)) {
        return response()->json([
            'errors' => ['current_password' => ['Current password is incorrect.']]
        ], 422);
    }

    auth()->user()->update([
        'password' => Hash::make($request->new_password),
    ]);

    return response()->json(['message' => 'Password updated successfully.']);
}

}

