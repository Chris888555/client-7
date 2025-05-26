<?php

namespace App\Http\Controllers\Funnels;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Codes;

class FunnelController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Manila");
    }

    // Return session username directly
    protected function usersession()
    {
        return session()->get('usersession'); 
    }

   public function show()
{
    $username = $this->usersession();

    if (!$username) {
        return redirect('/login')->with('error', 'Please login first.');
    }

    // Step 1: Get code record by 'usedby'
    $code = \App\Models\Admin\Codes::where('usedby', $username)->first();

    if (!$code) {
        return redirect()->back()->with('error', 'No code record found.');
    }

    // Step 2: Use code's 'type' as recordid to get codesettings
    $codeSetting = \App\Models\Admin\CodeSettings::where('recordid', $code->type)->first();

    $funnelValue = $codeSetting ? $codeSetting->funnel : null;

    return view('funnels.funnels', compact('funnelValue'));
}
 
}
