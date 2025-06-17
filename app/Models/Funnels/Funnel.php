<?php

namespace App\Models\Funnels;

use Illuminate\Database\Eloquent\Model;
use App\Models\Funnels\FunnelBlock;
use App\Models\User\Users;

class Funnel extends Model
{
    protected $table = 'funnels';

    protected $fillable = [
        'username',
        'page_link',
        'status',
    ];

    public function blocks()
    {
        return $this->hasMany(FunnelBlock::class, 'funnel_id');
    }


    public function funnels()
    {
        return $this->hasMany(\App\Models\Funnels\Funnel::class, 'user_id');
    }

   
    public function user()
    {
        return $this->belongsTo(Users::class, 'username', 'username');
    }
}
