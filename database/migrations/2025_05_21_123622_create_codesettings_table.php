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
        Schema::create('codesettings', function (Blueprint $table) {
            $table->id();
            $table->string('recordid')->unique();
            $table->string('codetype', 20)->unique();
            $table->string('codename', 50);
            $table->char('prefix', 20);
            $table->float('price', 18, 2);
            $table->float('dr', 18, 2);
            $table->float('pairing', 18, 2);
            $table->float('infinity', 18, 2);
            $table->float('pv', 18, 2);
            $table->float('dropshippercent', 18, 2);
            $table->float('rebatepercent', 18, 2);
            $table->integer('month')->unsigned();
            $table->integer('lvlunilvl')->unsigned();
            $table->string('funnel');
            $table->string('store');
            $table->string('status');
            $table->timestamps();
        });

        DB::table('codesettings')->insert([
            [
                "recordid" => "5e8ff9bf55",
                "codetype" => "P1",
                "codename" => "Standard Package",
                "prefix" => "P1",
                "price" => 1999,
                "dr" => 200,
                "pairing" => 300,
                "infinity" => 50,
                "pv" => 30,
                "dropshippercent" => 0.25,
                "rebatepercent" => 0.25,
                "month" => 3,
                "lvlunilvl" => 10,
                "funnel" => "basic",
                "store" => "basic",
                "store" => "basic",
                "status" => "active",
                'created_at' => date('Y-m-d H:i:s', strtotime("Now")),
                'updated_at' => date('Y-m-d H:i:s', strtotime("Now"))
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codesettings');
    }
};
