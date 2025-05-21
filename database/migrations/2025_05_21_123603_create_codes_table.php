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
        Schema::create('codes', function (Blueprint $table) {
            $table->id();
            $table->longText('codeid')->unique();
            $table->string('status');
            $table->longText('batchid');
            $table->longText('type');
            $table->date('dateused')->nullable();
            $table->longText('usedby')->nullable();
            $table->longText('owner');
            $table->timestamps();
        });

        DB::table('codes')->insert([
            'codeid' => 'P1-Z6DKF3q',
            'status' => 'U',
            'batchid' => "1234567890",
            'type' => '5e8ff9bf55',
            'dateused' => date('Y-m-d', strtotime('now')),
            'usedby' => 'main',
            'owner' => 'admin',
            "created_at" => date('Y-m-d H:i:s', strtotime("Now")),
            "updated_at" => date('Y-m-d H:i:s', strtotime("Now"))
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codes');
    }
};
