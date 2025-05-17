<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketingContent extends Model
{
    use HasFactory;

    protected $table = 'marketing_contents';

    protected $fillable = [
        'caption',
        'image',
    ];
}
