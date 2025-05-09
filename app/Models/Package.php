<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

      // Disable timestamps for this model
    public $timestamps = false;


    // If your table is named 'packages', this line is optional
    protected $table = 'packages';

    // The fields that can be mass-assigned
    protected $fillable = [
        'user_id',
        'free_funnel',
        'packages_type',
    ];
}
