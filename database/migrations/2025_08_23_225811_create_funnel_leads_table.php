<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('funnel_leads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_funnel_id');
            $table->unsignedBigInteger('user_id')->nullable();
            
            // Step data
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();

            // Step 1–4 answers
            $table->string('role')->nullable(); // from step 1
            $table->string('capital')->nullable(); // from step 2
            $table->string('goal')->nullable(); // from step 3
            $table->string('commitment')->nullable(); // from step 4

            // optional tracking
            $table->string('page_link')->nullable();
            $table->timestamps();

            $table->foreign('user_funnel_id')
                  ->references('id')->on('user_funnels')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('set null');
        });
    }

    public function down(): void {
        Schema::dropIfExists('funnel_leads');
    }
};
