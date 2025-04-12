<?php

// In app/Models/VideoWatchProgress.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoWatchProgress extends Model
{
    use HasFactory;

    // Specify the table name (optional if it's the default pluralized form)
    protected $table = 'video_watch_progress';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'user_id',
        'video_link',
        'progress',
        'max_watch_percentage',
        'user_cookie',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

