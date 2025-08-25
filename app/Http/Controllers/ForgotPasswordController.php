<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User\Users; 

class ForgotPasswordController extends Controller
{
    // Show the form
    public function showForm()
    {
        return view('auth.forgot-password');
    }

    // Process form submit
    public function sendPassword(Request $request)
    {
        $request->validate([
            'login' => 'required|string', 
        ]);

        // Use your imported Users model here
        $user = Users::where('email', $request->login)
                    ->orWhere('username', $request->login)
                    ->first();

        if (!$user) {
            return back()->withErrors(['login' => 'No account found with that email or username.']);
        }

        // Send email with email, username, dpassword
        Mail::send('emails.forgot-password', ['user' => $user], function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Your Account Password');
        });

        return back()->with('success', 'Your password has been sent to your email. If you don’t see it in your Primary inbox, please check your Spam folder.');
    }
}
