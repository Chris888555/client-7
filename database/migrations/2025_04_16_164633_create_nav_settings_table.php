<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavSettingsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nav_settings', function (Blueprint $table) {
            $table->id();
            $table->string('nav_bg_color')->default('#ffffff');
            $table->string('nav_text_color')->default('#000000');
            $table->string('nav_hover_color')->default('#ff0000');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nav_settings');
    }
}

  