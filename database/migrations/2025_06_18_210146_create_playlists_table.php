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
    Schema::create('playlists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('video_link');
            $table->string('thumbnail_url')->nullable();
            $table->timestamps(); // adds created_at and updated_at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playlists');
    }
};
