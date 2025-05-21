<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->id();
            $table->string('username')->unqique();
            $table->string('password');
            $table->string('dpassword');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('mobileno');
            $table->string('picture');
            $table->string('status');
            $table->string('sponsor');
            $table->string('role');
            $table->timestamps();
        });

        DB::table('users')->insert(
            [
                [
                    "username" => "admin",
                    "password" => Hash::make("0000"),
                    "dpassword" => "0000",
                    "firstname" => "Master",
                    "lastname" => "Admin",
                    "email" => "mainaccount@gmail.com",
                    "mobileno" => "09874627182",
                    "picture" => "images/defaulticon.jpeg",
                    "status" => "active",
                    "sponsor" => "-",
                    "role" => "admin",
                    "created_at" => date('Y-m-d H:i:s', strtotime("Now")),
                    "updated_at" => date('Y-m-d H:i:s', strtotime("Now")),
                ],[
                    "username" => "main",
                    "password" => Hash::make("0000"),
                    "dpassword" => "0000",
                    "firstname" => "Master",
                    "lastname" => "account",
                    "email" => "mainaccount@gmail.com",
                    "mobileno" => "09874627182",
                    "picture" => "images/defaulticon.jpeg",
                    "status" => "active",
                    "sponsor" => "-",
                    "role" => "user",
                    "created_at" => date('Y-m-d H:i:s', strtotime("Now")),
                    "updated_at" => date('Y-m-d H:i:s', strtotime("Now")),
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
