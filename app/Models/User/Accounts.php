<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    public $id = false;
    protected $fillable = [
        "username",
        "sponsor",
        "upline",
        "pos",
        "binnode",
        "directctr",
        "binlvl",
        "count",
        "uninode",
        "unilvl",
        "left",
        "right",
        "pairs",
        "totalleft",
        "totalright",
        "totalpairs",
        "codeid",
    ];

    public function users(){
        return $this->hasOne(Users::class,  'username', 'username');
    }
    
    public function codes(){
        return $this->hasOne(Codes::class,  'codeid', 'codeid');
    }
    
    public function commissions(){
        return $this->hasOne(Commissions::class,  'username', 'username');
    }
    
    public function commissionlogs(){
        return $this->hasMany(Commissionlogs::class,  'toid', 'username');
    }
    
    public function products(){
        return $this->hasMany(Products::class,  'owner', 'username');
    }
}
