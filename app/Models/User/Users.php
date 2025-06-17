<?php

namespace App\Models\User;

use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function funnels()
    {
        return $this->hasMany(\App\Models\Funnels\Funnel::class, 'user_id');
    }
}

