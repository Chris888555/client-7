<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User\Users;
use App\Models\User\Accounts;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function registerWithSponsor($username){
        $check = Accounts::where('username', $username)->first();
        if(empty($check)){
            abort(404, 'Sponsor not found');
        }

        return view('auth.register_sponsor',[
            "sponsor" => $username
        ]);
    }

    public function login(Request $request)
    {
        if($request->input('username') == ""){
            return response()->json(["status" => false, "msg" => "Username is empty!"]);
        } else if($request->input('password') == ""){
            return response()->json(["status" => false, "msg" => "Password is empty"]);
        } else{
            $check = Users::where('username', $request->input('username'))->first();
            if(empty($check)){
                return response()->json(["status" => false, "msg" => "Account not found!"]);
            }else{
                if(Hash::check($request->input('password'), $check->password)){
                    if($check->role == "user"){
                        session()->put('usersession',$check->username);
                        session()->put('usersession_name',$check->full_name);
                        if(session()->get('usersession')){
                            return response()->json([
                                "role" => $check->role,
                                "status" => true,
                                "link" => "/"
                            ]);
                        }
                    }else if($check->role == "admin"){
                        session()->put('adminsession',$check->username);
                        session()->put('adminsession_name',$check->full_name);
                        if(session()->get('adminsession')){
                            return response()->json([
                                "role" => $check->role,
                                "status" => true,
                                "link" => "/admin"
                            ]);
                        }
                    }
                }else{
                    return response()->json(["status" => false, "msg" => "Incorrect password!"]);     
                }
            }
        }
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login');  // dito nagre-redirect sa login page
}

}
