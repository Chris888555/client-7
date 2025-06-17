<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');       // hashed password
            $table->string('dpassword');      // plain text password (not recommended)
            $table->string('profile_picture')->nullable();

            // Added fields
            $table->string('role')->default('user'); // user | admin
            $table->boolean('is_approved')->default(0); // 0 = not approved, 1 = approved

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
