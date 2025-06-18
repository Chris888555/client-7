<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class VideoProgress extends Model
{
    protected $table = 'video_progress'; 

    protected $fillable = [
        'user_cookie',
        'video_url',
        'page_link',
        'username',
        'progress',
        'max_watch_percentage',
    ];
}
