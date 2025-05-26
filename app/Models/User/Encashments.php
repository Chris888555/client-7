<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Encashments extends Model
{
    public $id = false;
    protected $fillable = [
        "transactionid",
        "username",
        "name",
        "gross",
        "tax",
        "net",
        "fee",
        "total",
        "deduction",
        "option",
        "accountnumber",
        "userremarks",
        "status",
        "processby",
    ];

    public function users(){
        return $this->belongsTo(Users::class,  'username', 'username');
    }
}
