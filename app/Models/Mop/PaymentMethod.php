<?php

namespace App\Models\Mop;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PaymentMethod extends Model
{
    protected $fillable = ['user_id', 'method_name', 'account_name', 'account_number'];

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
