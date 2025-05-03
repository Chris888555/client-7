<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'subdomain',
        'is_admin',
        'approved',
        'default_profile',
        'is_online',
        'facebook_link',
        'join_fb_group',
        'group_toggle',
        'page_link',
        'page_toggle',
        'headline',
        'subheadline',
        'video_link',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     public function userFunnels()
    {
        return $this->hasMany(UserFunnel::class);
    }
}
