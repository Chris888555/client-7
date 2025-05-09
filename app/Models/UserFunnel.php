<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFunnel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'proof_image',
        'plan_duration',
        'status',
        'is_active',
        'submission_date',
        'approval_date',
        'expiration_date',
        'funnel_content',
        'landing_page_content',
        'page_link_1',  
        'page_link_2', 
    ];

    public $timestamps = false;

    protected $casts = [
        'funnel_content' => 'array',
        'landing_page_content' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
