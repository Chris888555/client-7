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
        "pairing",
        "pv",
        "dropshippercent",
        "rebatepercent",
        "month",
        "lvlunilvl",
        "funnel",
        "store",
        "status",
        "created_at",
        "updated_at",
    ];
}
