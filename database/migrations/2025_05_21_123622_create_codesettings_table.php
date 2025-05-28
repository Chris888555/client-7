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
            $table->integer('maxcycles')->unsigned();
            $table->integer('lvlunilvl')->unsigned();
            $table->string('funnel');
            $table->string('store');
            $table->string('status');
            $table->timestamps();
        });

        DB::table('codesettings')->insert([
            [
                "recordid" => "5e8ff9bf56", "codetype" => "FSP1", "codename" => "FS Standard Package", "prefix" => "FSP1",
                "price" => 0, "dr" => 0, "pairing" => 0, "infinity" => 0, "pv" => 0,
                "dropshippercent" => 0.25, "rebatepercent" => 0.25, "month" => 3, "maxcycles" => 14, "lvlunilvl" => 10,
                "funnel" => "basic", "store" => "basic", "status" => "active",
                'created_at' => date('Y-m-d H:i:s', strtotime("Now")), 'updated_at' => date('Y-m-d H:i:s', strtotime("Now"))
            ],[
                "recordid" => "5e8ff9bf58", "codetype" => "FSP2", "codename" => "FS Gold Package", "prefix" => "FSP2",
                "price" => 0, "dr" => 0, "pairing" => 0, "infinity" => 0, "pv" => 0,
                "dropshippercent" => 0.30, "rebatepercent" => 0.30, "month" => 3, "maxcycles" => 28, "lvlunilvl" => 10,
                "funnel" => "basic", "store" => "basic", "status" => "active",
                'created_at' => date('Y-m-d H:i:s', strtotime("Now")), 'updated_at' => date('Y-m-d H:i:s', strtotime("Now"))
            ],[
                "recordid" => "5e8ff9bf60", "codetype" => "FSP3", "codename" => "FS Platinum Package", "prefix" => "FSP3",
                "price" => 0, "dr" => 0, "pairing" => 0, "infinity" => 0, "pv" => 0,
                "dropshippercent" => 0.35, "rebatepercent" => 0.35, "month" => 3, "maxcycles" => 56, "lvlunilvl" => 10,
                "funnel" => "basic", "store" => "builder", "status" => "active",
                'created_at' => date('Y-m-d H:i:s', strtotime("Now")), 'updated_at' => date('Y-m-d H:i:s', strtotime("Now"))
            ],[
                "recordid" => "5e8ff9bf62", "codetype" => "FSP4", "codename" => "FS Diamond Package", "prefix" => "FSP4",
                "price" => 0, "dr" => 0, "pairing" => 0, "infinity" => 0, "pv" => 0,
                "dropshippercent" => 0.40, "rebatepercent" => 0.40, "month" => 3, "maxcycles" => 112, "lvlunilvl" => 10,
                "funnel" => "builder", "store" => "builder", "status" => "active",
                'created_at' => date('Y-m-d H:i:s', strtotime("Now")), 'updated_at' => date('Y-m-d H:i:s', strtotime("Now"))
            ],[
                "recordid" => "5e8ff9bf64", "codetype" => "FSP5", "codename" => "FS Elite Package", "prefix" => "FSP5",
                "price" => 0, "dr" => 0, "pairing" => 0, "infinity" => 0, "pv" => 0,
                "dropshippercent" => 0.45, "rebatepercent" => 0.45, "month" => 3, "maxcycles" => 168, "lvlunilvl" => 10,
                "funnel" => "builder", "store" => "builder", "status" => "active",
                'created_at' => date('Y-m-d H:i:s', strtotime("Now")), 'updated_at' => date('Y-m-d H:i:s', strtotime("Now"))
            ],[
                "recordid" => "5e8ff9bf66", "codetype" => "FSP6", "codename" => "FS VIP Package", "prefix" => "FSP6",
                "price" => 0, "dr" => 0, "pairing" => 0, "infinity" => 0, "pv" => 0,
                "dropshippercent" => 0.50, "rebatepercent" => 0.50, "month" => 3, "maxcycles" => 224, "lvlunilvl" => 10,
                "funnel" => "builder", "store" => "builder", "status" => "active",
                'created_at' => date('Y-m-d H:i:s', strtotime("Now")), 'updated_at' => date('Y-m-d H:i:s', strtotime("Now"))
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
