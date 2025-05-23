<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Pairinglogs extends Model
{
    public $id = false;
    protected $fillable = [
        "username",
        "from",
        "remarks",
    ];
}
