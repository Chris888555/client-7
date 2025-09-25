<?php

namespace App\Models\Academy;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $primaryKey = 'module_id';
    public $timestamps = true;

    protected $fillable = [
        'course_id',
        'module_name',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'module_id', 'module_id');
    }

   public function completedModules()
{
    return $this->hasMany(CompletedModule::class, 'module_id');
}

}
