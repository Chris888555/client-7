<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Import Str for random generation

class AuthController extends Controller
{
    // Show Register Page
    public function showRegister(Request $request)
    {
        // Get the referral code from the URL
        $referralCode = $request->query('ref'); // Extract referral code (use 'ref' from URL)

        // Pass the referral code to the view (you can use it in the registration form)
        return view('auth.register', compact('referralCode')); // Return register view with referralCode
    }

public function register(Request $request)
{
    // Validate the input fields
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            'unique:users',
            'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
        ],
        'password' => [
            'required',
            'string',
            'min:3',
            'confirmed',
        ],
        'video_link' => 'nullable|string',
    ], [
        'email.regex' => 'Only @gmail.com emails are allowed.',
        'password.min' => 'Password must be at least 3 characters long.',
        'password.confirmed' => 'Passwords do not match.',
    ]);

    // Extract subdomain from email
    $subdomain = str_replace('.', '', explode('@', $request->email)[0]);

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

    // Set video link
    $providedLink = $request->video_link;
    $defaultYouTube = 'https://youtu.be/ccbp7R1li3w?si=fkLI7dCiltZhGNel'; // ✅ YouTube 
    $defaultMP4 = 'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4'; // ✅ MP4 

    // Choose which default video to use (uncomment one)
    // $defaultVideoLink = $defaultYouTube;
    $defaultVideoLink = $defaultMP4;

    // Final video link assignment
    if ($request->video_link) {
        $videoLink = $this->processVideoLink($request->video_link);
    } else {
        $videoLink = $this->processVideoLink($defaultVideoLink);
    }


    // Default headline and subheadline
    $headline = $request->headline ?? "Struggling to Make Sales? This Funnel Does the Selling For You";
    $subheadline = $request->subheadline ?? "Automate your leads, boost your sales, and grow your business — even while you sleep";

    // Create user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'subdomain' => $subdomain,
        'is_admin' => 0,
        'approved' => 0,
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

    return back()->with('success', 'Registration successful!');
}

// Process both YouTube and MP4
private function processVideoLink($link)
{
    if (str_ends_with($link, '.mp4')) {
        return $link; // return direct MP4 link
    }

    return $this->embedYouTubeLink($link);
}

// Convert YouTube to embed link
private function embedYouTubeLink($youtubeLink)
{
    $videoId = $this->getYouTubeVideoId($youtubeLink);

    return $videoId ? "https://www.youtube.com/embed/$videoId" : null;
}

// Extract YouTube ID
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


    

    
    // Show Login Page
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['error' => 'Invalid email or password']);
    }

    // Convert `approved` to integer manually
    $user->approved = (int) $user->approved;

    if ((int)$user->approved !== 1) { // Convert manually to integer
        return back()->withErrors(['error' => 'Your account is not approved yet.']);
    }
    

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    return back()->withErrors(['error' => 'Invalid email or password']);
}

    


    // Logout (No Redirection)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return back();
    }

    
    // Check if email exists
public function checkEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Email not found']);
    }

    // Pass email to the reset password view
    return view('auth.reset-password', ['email' => $request->email]);
}

// Reset Password
public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required|min:3|confirmed',
    ]);

    $user = User::where('email', $request->email)->first();

    // Check if user exists, just to be safe
    if (!$user) {
        return back()->withErrors(['email' => 'Invalid email address']);
    }

    // Update the user's password
    $user->update([
        'password' => Hash::make($request->password),
    ]);

    // Redirect to login with a success message
    return redirect()->route('login')->with('status', 'Password successfully updated. Please log in with your new password.');
}


}

