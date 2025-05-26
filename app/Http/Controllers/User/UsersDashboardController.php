<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UsersDashboardController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Manila");
    
    }

    // Helper function to get 'usersession' from session
    protected function usersession()
    {
        return session()->get('usersession');
    }

    public function index()
    {
        $userSession = $this->usersession();

    return view('user.home.dashboard', compact('userSession'));


    }
}
