<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('who_i_am_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->string('name');
            $table->text('hook');
            $table->text('intro');
            $table->text('transition');
            $table->json('bullets'); // JSON array of bullet points
            $table->text('motivation');
            $table->text('testimonial')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('who_i_am_sections');
    }
};

