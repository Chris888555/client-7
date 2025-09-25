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
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('lesson_id');
            $table->unsignedInteger('module_id');
            $table->string('lesson_name');
            $table->string('category')->nullable(); 
            $table->text('lesson_description')->nullable();
            $table->string('video_path')->nullable();
            $table->string('speaker_name')->nullable();
            $table->string('docs_link', 500)->nullable(); 
            $table->longText('docs_description')->nullable(); 
            $table->unsignedInteger('order')->default(0); 
            $table->timestamps();

            $table->foreign('module_id')
                  ->references('module_id')
                  ->on('modules')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
