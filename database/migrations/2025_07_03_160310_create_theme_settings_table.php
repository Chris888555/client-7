<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('theme_settings', function (Blueprint $table) {
            $table->id();
            $table->string('sidebar_bg')->nullable();
            $table->string('nav_hover_bg_color')->nullable();
            $table->string('nav_text_color')->nullable();
            $table->string('nav_text_hover_color')->nullable();
            $table->string('icon_bg_color')->nullable();
            $table->string('icon_text')->nullable();
            $table->string('logo_color')->nullable();
            $table->timestamps();
        });

      // ✅ Insert default values (matched to image)
        DB::table('theme_settings')->insert([
            'sidebar_bg' => '#0c0c0c',          // Sidebar Background
            'nav_hover_bg_color' => '#212121',  // Nav Hover BG Color
            'icon_bg_color' => '#dcdbe1',       // Icon Background
            'nav_text_color' => '#dcdbe1',      // Nav Text Color
            'nav_text_hover_color' => '#dcdbe1',// Nav Hover Text Color
            'icon_text' => '#dcdbe1',           // Icon Text Color
            'logo_color' => '#dcdbe1',          // Logo Color (same as icons/texts)
            'created_at' => now(),
            'updated_at' => now(),
        ]);




    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theme_settings');
    }
};
