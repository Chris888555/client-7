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
        $this->down();
        Schema::create('codelogs', function (Blueprint $table) {
            $table->id();
            $table->string('batchid');
            $table->string('creator');
            $table->integer('quantity')->unsigned();
            $table->string('type');
            $table->string('name');
            $table->timestamps();
        });

        DB::table('codelogs')->insert(
            [
                [
                    "batchid" => "1234567890",
                    "creator" => "admin",
                    "quantity" => 1,
                    "type" => "P1",
                    "name" => "Default codes",
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
