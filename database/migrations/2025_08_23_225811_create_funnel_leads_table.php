<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('funnel_leads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_funnel_id');
            $table->unsignedBigInteger('user_id')->nullable(); // added user_id
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('role')->nullable();
            $table->timestamps();

            $table->foreign('user_funnel_id')
                  ->references('id')->on('user_funnels')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('set null'); // keep lead even if user is deleted
        });
    }

    public function down(): void {
        Schema::dropIfExists('funnel_leads');
    }
};
