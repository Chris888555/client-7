<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Codelogs extends Model
{
    public $id = false;
    protected $fillable = [
        "batchid",
        "creator",
        "quantity",
        "type",
        "name"
    ];
}
