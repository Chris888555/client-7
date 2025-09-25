<?php

namespace App\Models\Academy;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $primaryKey = 'lesson_id';
    public $timestamps = true;

    protected $fillable = [
        'module_id',
        'lesson_name',
        'category', 
        'lesson_description',
        'video_path',
        'speaker_name',
        'docs_link',
        'docs_description',
        'order',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id', 'module_id');
    }
}
