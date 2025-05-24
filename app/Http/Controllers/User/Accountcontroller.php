<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Models\Admin\Codes;
use App\Models\Admin\Codesettings;
use App\Models\Admin\Globalsettings;
use App\Models\Admin\Indirectdrsettings;
use App\Models\Admin\Systemsettings;

use App\Models\User\Users;
use App\Models\User\Accounts;
use App\Models\User\Commissions;
use App\Models\User\Inventories;
use App\Models\User\Encashments;
use App\Models\User\Commissionlogs;
use App\Models\User\Subscriptions;
use App\Models\User\Addresses;
use App\Models\User\Activations;
use App\Models\User\Storesettings;
use App\Models\User\Checkouts;
use App\Models\User\Coderequests;
use App\Models\User\Pairinglogs;

use DB;
use Str;
use Hash;
use DateTime;

class Accountcontroller extends Controller
{
    public function __construct(){
        date_default_timezone_set("Asia/Manila");
    }

    function usersession(){
        return session()->get('usersession');
    }

    function datecreated(){
        return date('Y-m-d H:i:s', strtotime('now'));
    }

    function isValidUsername($username) {
        return preg_match('/^[a-zA-Z0-9]{4,15}$/', $username);
    }

    function accountInfo($username){
        return Accounts::where('username', $username)->first();
    }

    function CountDirectSponsor($sponsor){
        $datas = Accounts::where('sponsor',$sponsor)->get();
        return count($datas);
    }

    public function addNewAccount(Request $request){
        DB::beginTransaction();
        try {
            
            $username = $request->input('username');
            $sponsor = $request->input('sponsor');
            $upline = $request->input('upline');
            $position = $request->input('position');
            $email = $request->input('emailaddress');
            $mobileno = $request->input('mobilephone');

            if(!$this->isValidUsername($username)){
                return response()->json([ "msg" => "Invalid username!", "status" => false ]);
            }
            
            $checkUsername = Users::where("username", $username)->exists();
            if($checkUsername){
                return response()->json(["result" => false, "msg" => "Username already used!"]);
            }

            if(empty($sponsor)){
                return response()->json(["result" => false, "msg" => "Sponsor is empty!"]);
            }

            $checkSponsor = Accounts::where("username", $sponsor)->exists();

            if(!$checkSponsor){
                return response()->json(["result" => false, "msg" => "Sponsor not found!"]);
            }
            
            if(empty($upline)){
                return response()->json(["result" => false, "msg" => "Upline is empty!"]);
            }
            $checkUpline = Accounts::where("username", $upline)->exists();
            if(!$checkUpline){
                return response()->json(["result" => false, "msg" => "Upline not found!"]);
            }

            $checkPosition = Accounts::where('upline', $upline)->where('pos', $position)->first();
            if(!empty($checkPosition)){
                return response()->json(["result" => false, "msg" => "Position already used!"]);
            }

            if(env('APP_ENV') == "production"){
                $checkEmail = Users::where("email", $email)->exists();
                if($checkEmail){
                    return response()->json(["result" => false, "msg" => "Email address already used!"]);
                }
                
                $checkMobile = Users::where("mobileno", $mobileno)->exists();
                if($checkMobile){
                    return response()->json(["result" => false, "msg" => "Mobile number already used!"]);
                }
            }

            if(empty($request->input('codeid'))){
                return json_encode(["status"=> false, "msg" => "Code ID is empty!"]);
            }else{
                $checkCode = Codes::with('codesettings')->where('codeid', $request->input('codeid'))->first();
                if(empty($checkCode)){
                    return json_encode(["status"=> false, "msg" => "Code ID not found!"]);
                }

                if($checkCode->status == "U"){
                    return json_encode(["status"=> false, "msg" => "Code already used!"]);
                }
                
                $newupline = $upline;
                $pos = $position;

                $accountInfo_sponsor = $this->accountInfo($sponsor);
                $accountInfo_upline = $this->accountInfo($newupline);

                $binlvl = $accountInfo_upline->binlvl;
                $upline = Accounts::where('username',$sponsor)->first();
                $count = $this->CountDirectSponsor($sponsor);
                $temp = $count + 1;
                $uninode = $accountInfo_sponsor->uninode.".".$temp;
                $unilvl = $accountInfo_sponsor->unilvl + 1;
                $binnode = $accountInfo_upline->binnode.".".$pos;

                Accounts::create([
                    "username" => $username,
                    "sponsor" => $sponsor,
                    "upline" => $newupline,
                    "pos" => $pos,
                    "binnode" => $binnode,
                    "directctr" => $count + 1,
                    "binlvl" => $binlvl + 1,
                    "count" => $count + 1,
                    "uninode" => $uninode,
                    "unilvl" => $unilvl,
                    "left" => 0,
                    "right" => 0,
                    "pairs" => 0,
                    "totalleft" => 0,
                    "totalright" => 0,
                    "totalpairs" => 0,
                    "codeid" => $request->input('codeid')
                ]);
                
                Commissions::create([
                    "username" => $username,
                    "dr" => 0,
                    "passup" => 0,
                    "unilvl" => 0,
                    "infinity" => 0,
                    "sales" => 0,
                    "rebate" => 0,
                    "indirect" => 0,
                    "shareup" => 0,
                    "wholesale" => 0,
                    "groupsale" => 0,
                    "pairing" => 0,
                    "leadership" => 0,
                    "leadersupport" => 0,
                    "incentive" => 0,
                    "ranking" => 0,
                ]);

                Users::create([
                    "username" => $username,
                    "password" => Hash::make($request->input('password')),
                    "dpassword" => $request->input('password'),
                    "firstname" => $request->input('firstname'),
                    "lastname" => $request->input('lastname'),
                    "email" => $request->input('emailaddress'),
                    "mobileno" => $request->input('mobilephone'),
                    "picture" => "images/defaulticon.jpeg",
                    "status" => "active",
                    "sponsor" => $request->input('sponsor'),
                    "role" => "user",
                ]);
    
                Codes::where('codeid', $request->input('codeid'))->update([
                    "status" => "U", "dateused" => $this->datecreated(), "usedby" => $username
                ]);

                if($checkCode->codesettings->price > 0){
                    $this->processDirectReferral($username, $sponsor, $checkCode->codesettings->dr);
                    $temp = $this->accountInfo($this->usersession());
                    $check_account_added = Accounts::where('username', $username)->first();
                    if($check_account_added->directctr < 3){
                        $this->InfinityBonus($check_account_added->sponsor, $checkCode->codesettings->infinity);
                    }

                    $directrefferal = $checkCode->codesettings->pairing;
                    $isheadnode = false;
                    $curr_node = $this->accountInfo($newupline);
                    do{
                        $curr_node = $this->accountInfo($curr_node->username);
                        $pointvalue = $checkCode->codesettings->pv;
                        if($pos == "R"){
                                if($curr_node->left > 0){
                                    if($curr_node->left >= 30){
                                        if(($curr_node->right + 30) >= $pointvalue){
                                            Accounts::where("username", $curr_node->username)->update([
                                                "left" => (($curr_node->left - $pointvalue) <= 0) ? 0 : $curr_node->left - $pointvalue,
                                                "right" => (($curr_node->right - $pointvalue) <= 0) ? 0 : $curr_node->right - $pointvalue,
                                                "pairs" => $curr_node->pairs + 1,
                                                "totalpairs" => $curr_node->totalpairs + 1,
                                                "totalright" => $curr_node->totalright + $pointvalue
                                            ]);
                                            Pairinglogs::create([
                                                "username" => $curr_node->username,
                                                "from" => $username,
                                                "remarks" => "Pairing R"
                                            ]);
                                            $this->processPairing($curr_node->username, $username, "R", $directrefferal);
                                        }else{
                                            $this->Nopairing($curr_node->username, $pointvalue, "R");
                                        }
                                    }else{
                                        $this->Nopairing($curr_node->username, $pointvalue, "R");
                                    }
                                }else{
                                    $this->Nopairing($curr_node->username, $pointvalue, "R");
                                }
                        }else{
                                if($curr_node->right > 0){
                                    if($curr_node->right >= 30){
                                        if(($curr_node->left + 30) >= $pointvalue){
                                            Accounts::where("username", $curr_node->username)->update([
                                                "right" => (($curr_node->right - $pointvalue) <= 0) ? 0 : $curr_node->right - $pointvalue,
                                                "left" => (($curr_node->left - $pointvalue) <= 0) ? 0 : $curr_node->left - $pointvalue,
                                                "pairs" => $curr_node->pairs + 1,
                                                "totalpairs" => $curr_node->totalpairs + 1,
                                                "totalleft" => $curr_node->totalleft + $pointvalue
                                            ]);
                                            Pairinglogs::create([
                                                "username" => $curr_node->username,
                                                "from" => $username,
                                                "remarks" => "Pairing L"
                                            ]);
                                            $this->processPairing($curr_node->username, $username, "L", $directrefferal);
                                        }else{
                                            $this->Nopairing($curr_node->username, $pointvalue, "L");
                                        }
                                    }else{
                                        $this->Nopairing($curr_node->username, $pointvalue, "L");
                                    }
                                }else{
                                    $this->Nopairing($curr_node->username, $pointvalue, "L");
                                }
                        }
                        if($curr_node->upline == "-"){
                            $isheadnode = true;
                        }else{
                            $pos = $curr_node->pos;
                            $curr_node = $this->accountInfo($curr_node->upline);
                        }
                    }while(!$isheadnode || $isheadnode == false);
                }

            }

            DB::commit();
            return response()->json(['status' => true, 'msg' => 'Account created successfully.']);
        } catch (\Exception  | \Error $ex) {
            DB::rollback();
            return response()->json([
                "status" => false,
                "msg" => "Something went wrong.",
                "error" => $ex->getMessage()
            ]);
        }
    }

    public function InfinityBonus($sponsor, $amount){
        $id = "";
        $currid = $sponsor;
        do{
            $info = Accounts::where('username',$currid)->first();
            $currid = $info->sponsor;
        }while($info->directctr < 3 && $currid != "-");
        $id = $info->sponsor;
        if($id != "-"){
            $info1 = Accounts::where('username', $id)->first();
            $commission = Commissions::where('username', $id)->first();
            $commission->update([
                "infinity" => $commission->infinity + $amount
            ]);
            $this->insertInCommissionlogs($sponsor, $id, $amount, "Infinity Bonus");
        }
    }

    public function Nopairing($username, $amount, $pos){
        $value = Accounts::where('username',$username)->first();
        if($pos == "L"){
            Accounts::where('username',$username)->update([
                "left" => $value->left + $amount,
                "totalleft" => $value->totalleft + $amount,
            ]);
        } else{
            $update = Accounts::where('username',$username)->update([
                "right" => $value->right + $amount,
                "totalright" => $value->totalright + $amount,
            ]);
        }
    }

    public function processPairing($username, $user, $pos, $amount){
        $day = date('a', strtotime("Now"));
        $currentDate = Carbon::now()->toDateString();

        $amCount = Pairinglogs::whereDate('created_at', $currentDate)
        ->whereTime('created_at', '>=', '00:00:00')
        ->whereTime('created_at', '<', '12:00:00')
        ->where('username', $username)
        ->count();

        $tempamCount = $amCount;
        $amCount = ltrim($amCount, '0');         
        $amCount = intval($amCount) + 1;


        $pmCount = Pairinglogs::whereDate('created_at', $currentDate)
        ->whereTime('created_at', '>=', '12:00:00')
        ->whereTime('created_at', '<', '24:00:00')
        ->where('username', $username)
        ->count();

        $temppmCount = $pmCount;
        $pmCount = ltrim($pmCount, '0');
        $pmCount = intval($pmCount) + 1;


        $isfifthpair = false;

        $account = Accounts::where('username', $username)->first();
        if($account->totalpairs % 5 == 0){
            $isfifthpair = true;
        }

        $process = false;

        if($day == "PM" || $day == "pm"){
            if($pmCount <= 10){
                $process = true;
            }else{
                Accounts::where("username", $username)->update([
                    "left" => 0
                ]);
                Accounts::where("username", $username)->update([
                    "right" => 0
                ]);
            }
        }else if($day == "AM" || $day == "am"){
            if($amCount <= 10){
                $process = true;
            }else{
                Accounts::where("username", $username)->update([
                    "left" => 0
                ]);
                Accounts::where("username", $username)->update([
                    "right" => 0
                ]);
            }
        }

        if($process){
            if(!$isfifthpair){
                $commission = Commissions::where('username', $username)->first();
                $commission->update([
                    "pairing" => $commission->pairing + $amount,
                ]);
                $this->insertInCommissionlogs($user, $username, $amount, "Cycle Commission");
            }else{
                $commission = Commissions::where('username', $username)->first();
                $commission->update([
                    "incentive" => $commission->incentive + 1,
                ]);
                $this->insertInCommissionlogs($user, $username, 1, "Incentive Points");
            }
        }
    }

    public function processDirectReferral($username, $sponsor, $amount){
        $commission = Commissions::where('username', $sponsor)->first();
        Commissions::where('username', $sponsor)->update([
            "dr" => $commission->dr + $amount,
        ]);
        $this->insertInCommissionlogs($username, $sponsor, $amount, "Direct Referral");
    }

    function insertInCommissionlogs($from, $to, $amount, $remarks){
        Commissionlogs::create([
            "fromid" => $from,
            "toid" => $to,
            "amount" => $amount,
            "remarks" => $remarks,
        ]);
    }
}
