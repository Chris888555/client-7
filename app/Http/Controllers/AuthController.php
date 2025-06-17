<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User\Users;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login
public function login(Request $request)
{
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();

        if ($user->is_approved != 1) {
            Auth::logout();
            return response()->json([
                'success' => false,
                'message' => 'Your account is pending approval.',
            ], 403); // 403 = Forbidden
        }

        if ($user->role === 'admin') {
            return response()->json([
                'success' => true,
                'redirect' => route('admin.dashboard'),
            ]);
        }

        return response()->json([
            'success' => true,
            'redirect' => route('user.dashboard'),
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Invalid credentials.',
    ], 401);
}


// Log out function
public function logout()
{
    Auth::logout(); 
    return redirect('/login'); 
}

    // Show registration form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle registration
public function register(Request $request)
{
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|string|min:3|confirmed',
    ]);

    $username = explode('@', $request->email)[0];
    while (Users::where('username', $username)->exists()) {
        $username .= Str::random(3);
    }

    Users::create([
        'name'      => $request->name,
        'email'     => $request->email,
        'username'  => $username,
        'password'  => Hash::make($request->password),
        'dpassword' => $request->password,
    ]);

    // Return JSON success response for AJAX
    return response()->json([
        'success' => true,
        'redirect' => route('thankyou')
    ]);
}

}

