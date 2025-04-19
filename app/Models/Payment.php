<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Optional: Define the table name if it's not the plural form of the model
    // protected $table = 'payments';

    protected $fillable = [
        'user_id',            // Add user_id to the fillable fields
        'first_name',
        'last_name',
        'email',
        'number',
        'shipping_address',
        'zip_code',
        'barangay',
        'image', // Add image to the fillable fields
    ];
}
