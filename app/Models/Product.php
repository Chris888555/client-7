<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; // Ensure correct table name

    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'original_price', // <--- Add this line
        'category',
        'image_path',
        'shipping_rules',
        'weight',
        'product_purchased', // Add product_purchased to fillable
    ];

    protected $casts = [
        'shipping_rules' => 'array', // Cast shipping_rules as an array
    ];

    public $timestamps = false; // Prevent Laravel from using updated_at and created_at

    // Set default value for weight and product_purchased
    protected $attributes = [
        'weight' => 500, // Default weight
        'product_purchased' => 0, // Default product_purchased value
    ];
}
