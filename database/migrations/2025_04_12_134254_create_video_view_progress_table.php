<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('video_view_progresses', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id')->nullable(); // Optional, kung naka-login
        $table->string('cookie_id')->nullable(); // For non-logged in users
        $table->string('video_url');
        $table->float('percentage_watched')->default(0);
        $table->timestamps();
    });
}

};
