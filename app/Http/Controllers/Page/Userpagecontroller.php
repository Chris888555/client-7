<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Str;
use DB;
use DateTime;

class Userpagecontroller extends Controller
{
    public function __construct(){
        date_default_timezone_set("Asia/Manila");
    }

    function usersession(){
        return session()->get('usersession');
    }

    function dateCreated(){
        return date('Y-m-d', strtotime('now'));
    }

    public function getEnvValue(){
        return env('APP_ENV');
    }

    public function index(){
        return view('user.home.index');
    }
}
