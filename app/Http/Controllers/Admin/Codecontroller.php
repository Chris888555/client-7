<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Codesettings;
use App\Models\Admin\Codelogs;
use App\Models\Admin\Codes;

use Str;
use DB;
use DateTime;

class Codecontroller extends Controller
{
    public function __construct(){
        date_default_timezone_set("Asia/Manila");
    }

    function adminsession(){
        return session()->get('adminsession');
    }

    public function generate(Request $request){
        if($request->input('codetype') == "none"){
            return response()->json(["status" => false, "msg" => "Select code type!"]);            
        } else if($request->input('quantity') <= 0){
            return response()->json(["status" => false, "msg" => "Invalid quantity!"]);            
        }else{
            $codeInfo = Codesettings::where('recordid', $request->input('codetype'))->first();

            $all = Codes::get();
            DB::beginTransaction();
            try{
                $batchid = strtotime("Now");
                $owner = $this->adminsession();

                for($i = 0; $i < $request->input('quantity'); $i++) {
                    Codes::create([
                        "codeid" => strtoupper($codeInfo->codetype.'-'.count($all).$i.Str::random(5)),
                        "status" => "A",
                        "type" => $codeInfo->recordid,
                        "batchid" => $batchid,
                        "dateused" => null,
                        "usedby" => "-",
                        "owner" => $owner
                    ]);
                }

                Codelogs::create([
                    "batchid" => $batchid,
                    "creator" => $owner,
                    "quantity" => $request->input('quantity'),
                    "type" => $codeInfo->recordid,
                    "name" => $request->input("batchname"),
                ]);
                
                DB::commit();
                return response()->json(["status" => true, "msg" => "Code/s generated!"]);            
            }catch(\Exception $ex){
                DB::rollback();
                return response()->json(["status" => false, "msg" => "Something went wrong!".$ex->getMessage()]); 
            }catch(\Error $ex){
                DB::rollback();
                return response()->json(["status" => false, "msg" => "Something went wrong!".$ex->getMessage()]); 
            }
        }
    }

    public function createPackage(Request $request){
        DB::beginTransaction();
        try{
            Codesettings::create([
                "recordid" => strtotime("Now"),
                "codetype" => $request->input('codetype'),
                "codename" => $request->input('codename'),
                "prefix" => $request->input('prefix'),
                "price" => $request->input('price'),
                "dr" => $request->input('dr'),
                "pairing" => $request->input('pairing'),
                "infinity" => $request->input('infinity'),
                "pv" => $request->input('pv'),
                "dropshippercent" => $request->input('dropshippercent'),
                "rebatepercent" => $request->input('rebatepercent'),
                "month" => $request->input('month'),
                "maxcycles" => $request->input('maxcycles'),
                "lvlunilvl" => $request->input('lvlunilvl'),
                "funnel" => $request->input('funnel'),
                "store" => $request->input('store'),
                "status" => "active",
            ]);
            
            DB::commit();
            return response()->json(["status" => true, "msg" => "New package added!"]);            
        }catch(\Exception $ex){
            DB::rollback();
            return response()->json(["status" => false, "msg" => "Something went wrong!".$ex->getMessage()]); 
        }catch(\Error $ex){
            DB::rollback();
            return response()->json(["status" => false, "msg" => "Something went wrong!".$ex->getMessage()]); 
        }
    }
}
