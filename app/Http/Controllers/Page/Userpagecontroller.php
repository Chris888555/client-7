<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Codes;

use App\Models\User\Users;
use App\Models\User\Accounts;
use App\Models\User\Commissions;
use App\Models\User\Encashments;

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
    
    function nodesession(){
        return session()->get('node');
    }

    function dateCreated(){
        return date('Y-m-d', strtotime('now'));
    }

    public function getEnvValue(){
        return env('APP_ENV');
    }

    function getTotalWithdrawal(){
        $encashments = Encashments::where('status', 'approved')->sum('gross');
    }

    function getTotalCommission(){
        $commission = Commissions::where('username', $this->usersession())->first();
        return $commission->dr + $commission->passup + $commission->unilvl + $commission->infinity + $commission->sales + $commission->rebate + $commission->indirect + $commission->shareup + $commission->wholesale + $commission->groupsale + $commission->dropship + $commission->pairing + $commission->leadership + $commission->leadersupport + $commission->ranking;
    }

    public function incomeStats(){
        $account = Accounts::with('users')->where('username', $this->usersession())->first();
        $account_created = $account->created_at;
        $is_new_account = false;
        if ($account_created) {
            $created_date = new DateTime($account_created);
            $now = new DateTime();
            $interval = $created_date->diff($now);
            if ($interval->days < 30) {
                $is_new_account = true;
            }
        }

        $commission = Commissions::where('username', $this->usersession())->first();

        $tr = "";

        $directs = Accounts::with('codes.codesettings')->where('sponsor', $this->usersession())->get();

        $downlines = Accounts::with('users', 'codes.codesettings')->where('uninode', 'like', $account->uninode.'.%')->where('username', '!=', $this->usersession())->orderBy('unilvl','asc')->get();

        return view('user.home.income-stats',[
            "user" => $account,
            "directs" => $directs,
            "commission" => $commission,
            "totalcommission" => $this->getTotalCommission(),
            "totalpayout" => $this->getTotalWithdrawal(),
            "downlines" => count($downlines)
        ]);
    }

    public function index(){
        $account = Accounts::with('users')->where('username', $this->usersession())->first();
        $account_created = $account->created_at;
        $is_new_account = false;
        if ($account_created) {
            $created_date = new DateTime($account_created);
            $now = new DateTime();
            $interval = $created_date->diff($now);
            if ($interval->days < 30) {
                $is_new_account = true;
            }
        }

        $commission = Commissions::where('username', $this->usersession())->first();

        $tr = "";

        $directs = Accounts::with('codes.codesettings')->where('sponsor', $this->usersession())->get();

        $downlines = Accounts::with('users', 'codes.codesettings')->where('uninode', 'like', $account->uninode.'.%')->where('username', '!=', $this->usersession())->orderBy('unilvl','asc')->get();

        return view('user.home.dashboard',[
            "user" => $account,
            "directs" => $directs,
            "commission" => $commission,
            "totalcommission" => $this->getTotalCommission(),
            "totalpayout" => $this->getTotalWithdrawal(),
            "downlines" => count($downlines)
        ]);
    }

    public function teams(){
        $account = Accounts::where('username', $this->usersession())->first();
        $accounts = Accounts::with('users', 'codes.codesettings')->where('uninode', 'like', $account->uninode.'.%')->where('username', '!=', $this->usersession())->orderBy('unilvl','asc')->get();
        
        $tr = '';
        if(count($accounts) > 0){
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
        }else{
            $tr = '
                <tr>
                    <td colspan="7" class="text-center">No Data Found</td>
                </tr>
            ';
        }

        return view('user.team.index',[
            "accounts" => $tr
        ]);
    }

    public function addNewAccount($position, $upline){
        $checkPosition = ["L","R"];
        if(!in_array($position, $checkPosition)){
            return abort("404");
        }
        $check_upline = Accounts::where('username', $upline)->first();
        if(empty($check_upline)){
            return abort("404");
        }
        return view('user.team.add_new_account',[
            "position" => $position,
            "upline" => $upline,
            "totalaccounts" => Accounts::count(),
            "activationcode" => Codes::where('status','A')->first(),
        ]);
    }

    public function genealogy(){
        $head_node = Accounts::with('users')->where('username', $this->usersession())->first();

        if(!empty($this->nodesession())){
            $head_node = Accounts::with('users')->where('username', $this->nodesession())->first();
        }

        return view('user.team.genealogy',[
            "head_node" => $head_node,
            "node_1" => Accounts::with('users', 'codes.codesettings')->where('binnode',$head_node->binnode)->first(),
            "node_2" => Accounts::with('users', 'codes.codesettings')->where('binnode',$head_node->binnode.".L")->first(),
            "node_3" => Accounts::with('users', 'codes.codesettings')->where('binnode',$head_node->binnode.".R")->first(),
            "node_4" => Accounts::with('users', 'codes.codesettings')->where('binnode',$head_node->binnode.".L.R")->first(),
            "node_5" => Accounts::with('users', 'codes.codesettings')->where('binnode',$head_node->binnode.".L.L")->first(),
            "node_6" => Accounts::with('users', 'codes.codesettings')->where('binnode',$head_node->binnode.".R.L")->first(),
            "node_7" => Accounts::with('users', 'codes.codesettings')->where('binnode',$head_node->binnode.".R.R")->first(),
        ]);
    }
}
