<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Codesettings extends Model
{
    public $id = false;
    protected $fillable = [
        "recordid",
        "codetype",
        "codename",
        "prefix",
        "price",
        "dr",
        "infinity",
        "pairing",
        "pv",
        "dropshippercent",
        "rebatepercent",
        "month",
        "maxcycles",
        "lvlunilvl",
        "funnel",
        "store",
        "status",
    ];
}
