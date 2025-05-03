<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SerFunnel extends Model
{
    // Disable automatic timestamps
    public $timestamps = false;

    // Specify the table name (if different from the default)
    protected $table = 'user_funnels';

    // Fillable fields (adjust these to your actual fields)
    protected $fillable = [
        'status', 
        'is_active', 
        'approval_date', 
        'submitted_at', 
        // Add other fields as needed
    ];
}
