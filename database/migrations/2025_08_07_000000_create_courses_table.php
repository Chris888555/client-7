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
      Schema::create('courses', function (Blueprint $table) {
            $table->increments('course_id');
            $table->string('course_name');
            $table->text('course_description')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->string('course_thumbnail')->nullable();
            $table->integer('order')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
