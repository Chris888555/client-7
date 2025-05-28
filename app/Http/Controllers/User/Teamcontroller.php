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

class Teamcontroller extends Controller
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

    public function headnode(Request $request){
        $account = Accounts::where('username', $request->input('username'))->first();

        if(!empty(session()->get('node'))){
            $next = Accounts::where('username', session()->get('node'))->first();
            if(session()->get('node')== session()->get('usersession')."_1"){
                session()->forget('node');
                return "success";
            }
            else{
                session()->put('node', $account->upline);
                return "success";
            }
        }
        else{
            return "failed";
        }
    }
    public function resetnode(){
        session()->forget('node');
        if(empty(session()->get('node'))){
            return "success";
        }
        else{
            return "failed";
        }
    }
    public function genealogyacc(Request $request){
        $data = Accounts::with('users','codes.codesettings')->where('username', $request->input('username'))->first();
        $output = '';
        $position = $request->input('position');
        if(!empty($data)){
            $output .= '
                <div class="row">
                    <div class="col-12">
                        <center>';
            $output .= '<img src="'.asset('images/'.$data->codes->codesettings->codename.'.png').'"style="width: 300px; height: auto;">';
            $output .= '</center>
                        <table class="table table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th colspan="2" id="label_username" style="text-align:center">'.$data->username.'</th>
                                </tr>
                                <tr>
                                    <th colspan="2" id="label_name" style="text-align:center">'.$data->firstname." ".$data->lastname.'</th>
                                </tr>
                                <tr>
                                    <th class="text-center text-warning">
                                        LEFT PV
                                    </th>
                                    <th class="text-center text-warning">
                                        RIGHT PV
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">
                                    '.$data->left.'
                                    </td>
                                    <td class="text-center">
                                    '.$data->right.'
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-warning text-center">PAIRS TODAY</th>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align:center">'.$data->pairs.'</td>
                                </tr>                               
                            </tbody>
                        </table>
                    </div>
                </div>
            ';
            return response()->json([
                'result' => true,
                'data' => $output,
            ]);
        }
        else{
            $output = '
            <div class="row">
                <div class="col-12">
                    <center>
                        <img src="'.asset('images/networkuser.png').'"style="width: 300px; height: auto;">
                    </center>
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th colspan="2" id="label_username" style="text-align:center">----</th>
                            </tr>
                            <tr>
                                <th colspan="2" id="label_name" style="text-align:center">----</th>
                            </tr>
                            <tr>
                                <th style="text-align:center">
                                    LEFT PV
                                </th>
                                <th style="text-align:center">
                                    RIGHT PV
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            </tr>
                            <tr>
                            </tr>
                            <tr>
                                <td style="text-align:center">
                                ----
                                </td>
                                <td style="text-align:center">
                                ----
                                </td>
                            </tr>
                            <tr>
                                <th colspan="2" style="text-align:center">PAIRS TODAY</th>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:center">----</td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="form-control btn btn-md btn-violet" data-pos='.$position.' id="addcustomer">NEW MEMBER</button>
                </div>
            </div>
            ';

            return response()->json([
                'result' => false,
                'data' => $output,
            ]);
        }
    }
    public function CheckAddCustomer(Request $request){
        if($request->input('position') == "L" || $request->input('position') == "R"){
            $head = Accounts::where('binnode',$request->head_node)->first();
            $new_pos = $request->input('position');
            return response()->json([
                "status" => true,
                "upline" => $head->username,
                "head_node" => $request->input('head_node'),
                "pos" => $new_pos
            ]);

        }
        else{
            $pre = substr($request->input('position'),0, -2);
            $sub = $request->input('head_node').".".$pre;
            $new_pos = substr($request->input('position'), -1);
            $head = Accounts::where('binnode',$sub)->first();
            if(!empty($head)){
                return json_encode(array(
                    "status" => true,
                    "upline" => $head->username,
                    "head_node" => $request->input('head_node'),
                    "pos" => $new_pos
                ));
            }
            else{
                return response()->json([
                    "status" => false,
                    "msg" => "You can`t add customer in this node"
                ]);
            }
        }
    }
    public function nextnode(Request $request){
        session()->put('node',$request->input('username'));
        if(!empty(session()->get('node'))){
            return "success";
        }
        else{
            $output = '
            <div class="row">
                <div class="col-12">
                    <center>
                        <img src="'.asset('images/networkuser.png').'"style="width: 300px; height: auto;">
                    </center>
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th colspan="2" id="label_username" style="text-align:center">----</th>
                            </tr>
                            <tr>
                                <th colspan="2" id="label_name" style="text-align:center">----</th>
                            </tr>
                            <tr>
                                <th style="text-align:center">
                                    LEFT PV
                                </th>
                                <th style="text-align:center">
                                    RIGHT PV
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            </tr>
                            <tr>
                            </tr>
                            <tr>
                                <td style="text-align:center">
                                ----
                                </td>
                                <td style="text-align:center">
                                ----
                                </td>
                            </tr>
                            <tr>
                                <th colspan="2" style="text-align:center">PAIRS TODAY</th>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:center">----</td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="form-control btn btn-md btn-violet" data-pos='.$request->input('position').' id="addcustomer">NEW MEMBER</button>
                </div>
            </div>
            ';
            return $output;
        }
    }
}
