<?php

namespace App\Models\Materials;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
  protected $fillable = [
    'title', 'file_path', 'file_type', 'caption', 'category'
];

}

