<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
          date_default_timezone_set("Asia/Manila");
    }

    protected function adminsession()
    {
        return session()->get('adminsession');
    }

    public function index()
    {
        $adminSession = $this->adminsession();
        return view('admin.home.dashboard', compact('adminSession'));
    }
}

