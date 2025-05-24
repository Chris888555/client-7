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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('sponsor');
            $table->string('upline');
            $table->char('pos');
            $table->string('binnode');
            $table->integer('directctr')->unsigned();
            $table->integer('binlvl')->unsigned();
            $table->integer('count')->unsigned();
            $table->string('uninode');
            $table->integer('unilvl')->unsigned();
            $table->float('left', 18 ,2);
            $table->float('right', 18 ,2);
            $table->integer('pairs')->unsigned();
            $table->float('totalleft', 18 ,2);
            $table->float('totalright', 18 ,2);
            $table->integer('totalpairs')->unsigned();
            $table->string('codeid');
            $table->timestamps();
        });

        DB::table('accounts')->insert([
            'username' => 'main',
            'sponsor' => '-',
            'upline' => '-',
            'pos' => 'T',
            'binnode' => 'T',
            'directctr' => 0,
            'binlvl' => 0,
            'count' => 1,
            'uninode' => 1,
            'unilvl' => 0,
            'left' => 0,
            'right' => 0,
            'pairs' => 0,
            'totalleft' => 0,
            'totalright' => 0,
            'totalpairs' => 0,
            'codeid' => 'P1-Z6DKF3q',
            'created_at' => date('Y-m-d H:i:s', strtotime("Now")),
            'updated_at' => date('Y-m-d H:i:s', strtotime("Now"))
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
