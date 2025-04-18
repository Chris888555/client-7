<?php

namespace App\Http\Controllers\Navs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NavSetting;  

class NavController extends Controller
{
    public function showNav()
    {
        // Fetch data from nav_settings table
        $navSettings = NavSetting::first();  // Assuming you want the first record, or you can use any query you need

        // Pass data to the view
        return view('includes.nav', compact('navSettings'));
    }
}
