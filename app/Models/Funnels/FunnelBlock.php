<?php

namespace App\Models\Funnels;

use Illuminate\Database\Eloquent\Model;

class FunnelBlock extends Model
{
    protected $table = 'funnel_blocks';

    protected $fillable = [
        'funnel_id',
        'block_name',
        'content',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'content' => 'array',
        'is_active' => 'boolean',
    ];

    public function funnel()
    {
        return $this->belongsTo(Funnel::class, 'funnel_id');
    }

    
}
