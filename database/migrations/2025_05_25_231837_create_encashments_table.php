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
        Schema::create('encashments', function (Blueprint $table) {
            $table->id();
            $table->string('transactionid');
            $table->string('username');
            $table->string('name');
            $table->float('gross',18,2);
            $table->float('tax',18,2);
            $table->float('net',18,2);
            $table->float('fee',18,2);
            $table->float('total',18,2);
            $table->float('deduction',18,2);
            $table->string('option');
            $table->string('accountnumber');
            $table->string('userremarks');
            $table->string('status');
            $table->string('processby');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encashments');
    }
};
