<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('video_progress', function (Blueprint $table) {
            $table->id();
            $table->string('user_cookie');
            $table->string('video_url');
            $table->string('page_link')->nullable();
            $table->string('username')->nullable();
            $table->float('progress')->default(0);               // changed to float
            $table->float('max_watch_percentage')->default(0);   // changed to float
            $table->timestamps();

            $table->index('user_cookie');
            $table->index('video_url');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video_progress');
    }
};
