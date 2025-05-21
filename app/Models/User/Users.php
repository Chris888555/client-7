<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    public $id = false; 
    protected $fillable = [
        "username",
        "password",
        "dpassword",
        "firstname",
        "lastname",
        "email",
        "mobileno",
        "picture",
        "status",
        "sponsor",
        "role",
    ];

    public function getFullNameAttribute() {
        return $this->firstname . ' ' . $this->lastname;
    }
}
