<?php

namespace App\Models\Funnel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhoIAmSection extends Model
{
    use HasFactory;

    protected $table = 'who_i_am_sections';

    protected $fillable = [
        'user_id',
        'name',
        'hook',
        'intro',
        'transition',
        'bullets',
        'motivation',
        'testimonial',
        'image_path',
    ];

    protected $casts = [
        'bullets' => 'array', // automatically decode JSON
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
