<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Codes extends Model
{
    public $id = false;
    protected $fillable = [
        "codeid","status","batchid","type","dateused","usedby","owner"
    ];

    public function codesettings(){
        return $this->belongsTo(Codesettings::class,  'type', 'codetype');
    }
}
