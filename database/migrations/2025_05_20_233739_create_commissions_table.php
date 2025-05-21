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
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->float('dr',18,2);
            $table->float('passup',18,2);
            $table->float('pairing',18,2);
            $table->float('leadership',18,2);
            $table->float('leadersupport',18,2);
            $table->float('incentive',18,2);
            $table->float('unilvl',18,2);
            $table->float('sales',18,2);
            $table->float('rebate',18,2);
            $table->float('indirect',18,2);
            $table->float('shareup',18,2);
            $table->float('wholesale',18,2);
            $table->float('groupsale',18,2);
            $table->float('ranking',18,2);
            $table->timestamps();
        });

        DB::table('commissions')->insert(
            [
                [
                    'username' => 'main',
                    "dr" => 0,
                    "passup" => 0,
                    "unilvl" => 0,
                    "sales" => 0,
                    "pairing" => 0,
                    "leadership" => 0,
                    "leadersupport" => 0,
                    "incentive" => 0,
                    "rebate" => 0,
                    "indirect" => 0,
                    "shareup" => 0,
                    "wholesale" => 0,
                    "groupsale" => 0,
                    "ranking" => 0,
                    "created_at" => date('Y-m-d H:i:s', strtotime("Now")),
                    "updated_at" => date('Y-m-d H:i:s', strtotime("Now")),
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};
