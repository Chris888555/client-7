<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('funnel_views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');   // owner ng funnel
            $table->string('page_link');             // unique funnel link
            $table->string('user_cookie');           // visitor identifier
            $table->timestamps();

            // para no duplicate per funnel + per visitor
            $table->unique(['page_link', 'user_cookie']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('funnel_views');
    }
};
