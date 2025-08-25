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

        // ✅ Insert default values
       DB::table('theme_settings')->insert([
            'sidebar_bg' => '#1e3a8a',           // Dark Blue
            'nav_hover_bg_color' => '#e5e7eb',   // Light Gray
            'icon_bg_color' => '#e5e7eb',        // Light Gray
            'nav_text_color' => '#e5e7eb',       // Light Gray
            'nav_text_hover_color' => '#1e3a8a', // Dark Blue
            'icon_text' => '#1e3a8a',            // Dark Blue
            'logo_color' => '#e5e7eb',           // Light Gray
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
