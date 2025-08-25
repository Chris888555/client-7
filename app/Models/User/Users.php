<?php

namespace App\Models\User;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Funnel\UserFunnel;
use App\Models\Funnel\FunnelLead;

class Users extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'dpassword',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // User has many funnels
    public function funnels()
    {
        return $this->hasMany(UserFunnel::class, 'user_id');
    }

    // User has many leads
    public function leads()
    {
        return $this->hasMany(FunnelLead::class, 'user_id');
    }
}

