<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'features',
        'image',
    ];

    protected $casts = [
        'features' => 'array', // kung naka-JSON
    ];
}
