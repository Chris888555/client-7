<?php

namespace App\Models\Materials;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'file_path',
        'caption',
        'category',
    ];
}
