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
        Schema::table('products', function (Blueprint $table) {
            $table->string('craft')->nullable();
            $table->string('material')->nullable();
            $table->string('man_hours')->nullable();
            $table->string('first_order_free_gift')->nullable();
            $table->string('third_order_free_gift')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['craft', 'material', 'man_hours', 'first_order_free_gift', 'third_order_free_gift']);
        });
    }
};
