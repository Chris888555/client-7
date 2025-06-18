<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');       
            $table->string('dpassword');      
            $table->string('profile_picture')->nullable();
            $table->string('role')->default('user'); 
            $table->boolean('is_approved')->default(0); 
            $table->timestamps();
        });

        // Insert Admin
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => Hash::make('123'),
            'dpassword' => '123',
            'role' => 'admin',
            'is_approved' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert User
        DB::table('users')->insert([
            'name' => 'Regular User',
            'email' => 'user@gmail.com',
            'username' => 'user',
            'password' => Hash::make('123'),
            'dpassword' => '123',
            'role' => 'user',
            'is_approved' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
