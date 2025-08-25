<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'package_id',
        'package_name',
        'package_price',
        'payment_method_id',
        'payment_method_name',
        'payment_account_name',
        'payment_account_number',
        'full_name',
        'mobile',
        'address',
        'payment_proof',
    ];
}
