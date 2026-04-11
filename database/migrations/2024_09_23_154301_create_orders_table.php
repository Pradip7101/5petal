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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // In case of guest checkout
            $table->string('name');
            $table->string('address');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('pin_code');
            $table->string('phone_number');
            $table->string('email');
            $table->decimal('total_price', 10, 2);
            $table->string('payu_id');
            $table->string('txn_id');
            $table->string('payment_method');
            $table->enum('payment_status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
