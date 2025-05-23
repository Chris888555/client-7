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
        Schema::create('commissionlogs', function (Blueprint $table) {
            $table->id();
            $table->string('fromid',100);
            $table->string('toid',100);
            $table->float('amount',18,2);
            $table->string('remarks',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commissionlogs');
    }
};
