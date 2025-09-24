<?php

namespace App\Models\Funnel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\Users; 

class UserFunnel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'page_link',
        'meta_pixel_code', 
        'messenger_btn',
        'referral_btn',
        'shop_btn',
        'messenger_btn_state',
        'referral_btn_state',
        'shop_btn_state',
    ];

    // Funnel belongs to a user
    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    // Funnel has many leads
    public function leads()
    {
        return $this->hasMany(FunnelLead::class, 'user_funnel_id');
    }
}
