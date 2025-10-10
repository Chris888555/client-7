<?php

namespace App\Models\Funnel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\Users;
use App\Models\Funnel\UserFunnel;

class FunnelLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_funnel_id',
        'user_id',     
        'name',
        'email',
        'phone',
        'role',          // step 1
        'capital',       // step 2
        'goal',          // step 3
        'commitment',    // step 4
    ];

    // Lead belongs to a user
    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    // Lead belongs to a funnel
    public function funnel()
    {
        return $this->belongsTo(UserFunnel::class, 'user_funnel_id');
    }
}
