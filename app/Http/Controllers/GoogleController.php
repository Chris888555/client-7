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
        $user = Socialite::driver('google')->user();
        $finduser = User::where('google_id', $user->id)->first();

        if ($finduser) {
            if ($finduser->approved == 1) {
                Auth::login($finduser);
                return redirect()->intended('dashboard');
            } else {
                Session::flash('message', 'Your account is not approved yet. Please wait for approval.');
                return redirect()->route('login');
            }
        } else {
            $subdomain = str_replace('.', '', explode('@', $user->email)[0]);
            $originalSubdomain = $subdomain;
            $counter = 1;
            while (User::where('subdomain', $subdomain)->exists()) {
                $subdomain = $originalSubdomain . $counter;
                $counter++;
            }

            $defaultProfileUrl = 'https://tse1.mm.bing.net/th?id=OIP.lcdOc6CAIpbvYx3XHfoJ0gHaF3&pid=Api&P=0&h=220';
            $imageContents = file_get_contents($defaultProfileUrl);
            $imageName = 'profile_' . time() . '.jpg';
            $path = storage_path('app/public/profile_photos/' . $imageName);
            file_put_contents($path, $imageContents);
            $imagePath = 'profile_photos/' . $imageName;

            // Set video link
           // Choose one default video link (uncomment your preferred option)
// $defaultVideoLink = 'https://youtu.be/ccbp7R1li3w?si=fkLI7dCiltZhGNel'; // ✅ YouTube
$defaultVideoLink = 'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4'; // ✅ MP4

// Final video link assignment using the processor
$videoLink = $this->processVideoLink($defaultVideoLink);

            // Default headline and subheadline
            $headline = "Struggling to Make Sales? This Funnel Does the Selling For You";
            $subheadline = "Automate your leads, boost your sales, and grow your business — even while you sleep";

            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
                'password' => Hash::make('123456dummy'),
                'subdomain' => $subdomain,
                'approved' => 0,
                'is_admin' => 0,
                'default_profile' => $imagePath,
                'is_online' => 0,
                'facebook_link' => 'https://www.example.com/your-link',
                'join_fb_group' => 'https://www.example.com/your-link',
                'group_toggle' => 0,
                'page_link' => 'https://www.example.com/your-link',
                'page_toggle' => 0,
                'headline' => $headline,
                'subheadline' => $subheadline,
                'video_link' => $videoLink,
            ]);

            Auth::login($newUser);

            Session::flash('message', 'Account created successfully, Please wait for approval.');
            return redirect()->route('register');
        }
    } catch (Exception $e) {
        dd($e->getMessage());
    }
}
// Process both YouTube and MP4 links
private function processVideoLink($link)
{
    if (str_ends_with($link, '.mp4')) {
        return $link;
    }

    return $this->embedYouTubeLink($link);
}

// Convert YouTube to embed link
private function embedYouTubeLink($youtubeLink)
{
    $videoId = $this->getYouTubeVideoId($youtubeLink);
    return $videoId ? "https://www.youtube.com/embed/$videoId" : null;
}

// Extract YouTube video ID
private function getYouTubeVideoId($url)
{
    $parts = parse_url($url);

    if (isset($parts['query'])) {
        parse_str($parts['query'], $query);
        if (isset($query['v'])) {
            return $query['v'];
        }
    }

    if (isset($parts['path'])) {
        return ltrim($parts['path'], '/');
    }

    return null;
}

}
