<?php

namespace App\Models\Funnel;

use Illuminate\Database\Eloquent\Model;

class FunnelView extends Model
{
    protected $table = 'funnel_views';

    protected $fillable = [
        'user_id',
        'page_link',
        'user_cookie',
    ];
}
