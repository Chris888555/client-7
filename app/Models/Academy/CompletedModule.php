<?php

namespace App\Models\Academy;

use Illuminate\Database\Eloquent\Model;

class CompletedModule extends Model
{
    protected $primaryKey = 'completion_id';
    protected $fillable = ['user_id', 'module_id', 'completion_date'];
    public $timestamps = false;

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
