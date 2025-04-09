<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class GoogleController extends Controller
{
    /**
     * Redirect the user to Google for authentication.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the callback from Google after authentication.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        try {
            // Get user information from Google
            $user = Socialite::driver('google')->user();

            // Check if the user already exists in the database using Google ID
            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                // Check if the user is approved
                if ($finduser->approved == 1) {
                    // If user is approved, log them in
                    Auth::login($finduser);
                    return redirect()->intended('dashboard');
                } else {
                    // If user is not approved, show a success message
                    Session::flash('message', 'Your account is not approved yet. Please wait for approval.');
                    return redirect()->route('login'); // Or any other route you want to redirect to
                }
            } else {
                // If user doesn't exist, create a new user
                // Extract subdomain from email
                $subdomain = str_replace('.', '', explode('@', $user->email)[0]);

                // Ensure unique subdomain
                $originalSubdomain = $subdomain;
                $counter = 1;
                while (User::where('subdomain', $subdomain)->exists()) {
                    $subdomain = $originalSubdomain . $counter;
                    $counter++;
                }

                // Default profile image
                $defaultProfileUrl = 'https://tse1.mm.bing.net/th?id=OIP.lcdOc6CAIpbvYx3XHfoJ0gHaF3&pid=Api&P=0&h=220';
                $imageContents = file_get_contents($defaultProfileUrl);
                $imageName = 'profile_' . time() . '.jpg';
                $path = storage_path('app/public/profile_photos/' . $imageName);
                file_put_contents($path, $imageContents);
                $imagePath = 'profile_photos/' . $imageName;

                // Create new user
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => Hash::make('123456dummy'), // Set a dummy password or generate one
                    'subdomain' => $subdomain,
                    'approved' => 0, // New users should not be approved by default
                    'is_admin' => 0, // New users should not be admin by default
                    'default_profile' => $imagePath,
                    'is_online' => 0,
                    'facebook_link' => 'https://www.facebook.com/your-messenger-link',
                    'join_fb_group' => 'https://www.facebook.com/your-gc-group-link',
                    'group_toggle' => 0,
                    'page_link' => 'https://www.facebook.com/page-link',
                    'page_toggle' => 0,
                ]);

                // Log the new user in but not yet approved
                Auth::login($newUser);

                // Show success message
                Session::flash('message', 'Account created successfully, Please wait for approval.');
                return redirect()->route('register'); // Or any other route you want to redirect to
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
