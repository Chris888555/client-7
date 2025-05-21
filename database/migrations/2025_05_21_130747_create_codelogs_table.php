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
        Schema::create('codelogs', function (Blueprint $table) {
            $table->id();
            $table->string('batchid');
            $table->string('creator');
            $table->integer('quantity')->unsigned();
            $table->string('type');
        });

        DB::table('codelogs')->insert(
            [
                [
                    "batchid" => "1234567890",
                    "creator" => "admin",
                    "quantity" => 1,
                    "type" => "P1",
                    "created_at" => date('Y-m-d H:i:s', strtotime("Now")),
                    "updated_at" => date('Y-m-d H:i:s', strtotime("Now"))
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codelogs');
    }
};
