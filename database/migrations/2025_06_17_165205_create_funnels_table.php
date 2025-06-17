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
      Schema::create('funnels', function (Blueprint $table) {
            $table->id();
            $table->string('username', 100);
            $table->string('page_link', 100)->unique(); 
            $table->enum('status', ['inactive', 'active'])->default('inactive');
            $table->boolean('is_editable')->default(true); 
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funnels');
    }
};
