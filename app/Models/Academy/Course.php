<?php

namespace App\Models\Academy;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $primaryKey = 'course_id';
    public $timestamps = true;

    protected $fillable = [
        'course_name',
        'course_description',
        'is_visible',
        'course_thumbnail',
        'order',
    ];

    public function modules()
    {
        return $this->hasMany(Module::class, 'course_id', 'course_id');
    }
    
    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'course_id');
    }
}
