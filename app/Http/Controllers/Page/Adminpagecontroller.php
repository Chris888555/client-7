<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User\Users;
use App\Models\User\Accounts;

use App\Models\Admin\Codes;
use App\Models\Admin\Codelogs;
use App\Models\Admin\Codesettings;

use Str;
use DB;
use DateTime;

class Adminpagecontroller extends Controller
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
        try {
            
            return view('admin.home.index');

        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function codes(){
        try {
            
            return view('admin.code.list',[
                "types" => Codesettings::all(),
                "codes" => Codes::with('codesettings')->where('status', "A")->orderBy('created_at','desc')->get(),
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    
    public function codeCreatePackage(){
        try {
            
            return view('admin.code.create_package',[
                "types" => Codesettings::all(),
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
