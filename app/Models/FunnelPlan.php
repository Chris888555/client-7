<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'months',
        'price',
        'setting_value',
    ];
}
