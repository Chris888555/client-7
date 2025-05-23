<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Commissionlogs extends Model
{
    public $id = false;
    protected $fillable = [
        'fromid','toid','amount','remarks'
    ];
}
