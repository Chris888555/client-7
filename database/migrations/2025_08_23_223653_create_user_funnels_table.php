<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_funnels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('page_link')->unique();
            $table->text('meta_pixel_code')->nullable();

            // Button URLs
            $table->string('messenger_btn')->nullable()->default('https://your-link');
            $table->string('referral_btn')->nullable()->default('https://your-link');
            $table->string('shop_btn')->nullable()->default('https://your-link');

            // Button states: 0 = hide, 1 = show
            $table->boolean('messenger_btn_state')->default(1); 
            $table->boolean('referral_btn_state')->default(0);
            $table->boolean('shop_btn_state')->default(0);



            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_funnels');
    }
};
