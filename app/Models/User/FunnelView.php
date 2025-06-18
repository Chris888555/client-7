<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class FunnelView extends Model
{
    protected $fillable = [
        'user_cookie',
        'page_link',
        'username',
        'ip_address',
    ];
}
