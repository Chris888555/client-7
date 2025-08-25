<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Related user (owner of payment method)
            $table->unsignedBigInteger('user_id'); // no FK para safe kahit madelete user

            // Package Info (snapshot para independent kahit madelete package)
            $table->unsignedBigInteger('package_id');
            $table->string('package_name');
            $table->decimal('package_price', 10, 2);

            // Payment Method (snapshot din)
            $table->unsignedBigInteger('payment_method_id');
            $table->string('payment_method_name');
            $table->string('payment_account_name')->nullable();
            $table->string('payment_account_number')->nullable();

            // Buyer Details
            $table->string('full_name');
            $table->string('mobile');
            $table->text('address');

            // Proof of Payment
            $table->string('payment_proof');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
