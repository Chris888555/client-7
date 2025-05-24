<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Commissions extends Model
{
    public $id = false;
    protected $fillable = [
        "username",
        "dr",
        "passup",
        "unilvl",
        "infinity",
        "sales",
        "rebate",
        "indirect",
        "shareup",
        "wholesale",
        "groupsale",
        "pairing",
        "leadership",
        "leadersupport",
        "incentive",
        "ranking",
    ];

    public function users(){
        return $this->hasOne(Users::class,  'username', 'username');
    }
}
