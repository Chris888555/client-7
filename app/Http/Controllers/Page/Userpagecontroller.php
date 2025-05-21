<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User\Users;
use App\Models\User\Accounts;

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

    public function teams(){
        $account = Accounts::where('username', $this->usersession())->first();
        $accounts = Accounts::with('users', 'codes.codesettings')->where('uninode', 'like', $account->uninode.'.%')->orderBy('unilvl','asc')->get();
        
        $tr = '';
        
        foreach ($accounts as $key => $value) {
            if($this->usersession() != "main"){
                $unilvl = $value['unilvl'] - $account->unilvl;
            }else{
                $unilvl = $value['unilvl'];
            }
            $tr .= '
                <tr>
                    <td>'.($key + 1).'</td>
                    <td>'.$value->users->full_name.'</td>
                    <td>'.$value['username'].'</td>
                    <td>'.$value['sponsor'].'</td>
                    <td>'.$value->codes->codesettings->codename.'</td>
                    <td>'.$unilvl.'</td>
                </tr>
            ';
        }

        return view('user.team.index');
    }
}
