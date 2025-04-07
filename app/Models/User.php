<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'password_reset_token',
        'password_reset_expires', 'is_admin', 'approved',
        'profile_picture', 'default_profile', 'is_online', 'subdomain',
        'referral_code', 'referred_by', 'facebook_link',
        'join_fb_group', 'group_toggle', 'page_link', 'page_toggle',
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'password_reset_expires' => 'datetime',
        'is_admin' => 'boolean',
        'approved' => 'boolean',
        'is_online' => 'boolean',
        'page_toggle' => 'boolean', // Ensure 'page_toggle' is cast as a boolean
    ];

    // In the User model (App\Models\User.php)
public function clients()
{
    return $this->hasMany(Client::class);
}

}
