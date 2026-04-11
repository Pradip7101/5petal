<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('products')) {

            if (!Schema::hasColumn('products', 'craft')) {
                Schema::table('products', function (Blueprint $table) {
                    $table->string('craft')->nullable();
                });
            }

            if (!Schema::hasColumn('products', 'material')) {
                Schema::table('products', function (Blueprint $table) {
                    $table->string('material')->nullable();
                });
            }

            if (!Schema::hasColumn('products', 'man_hours')) {
                Schema::table('products', function (Blueprint $table) {
                    $table->string('man_hours')->nullable();
                });
            }

            if (!Schema::hasColumn('products', 'first_order_free_gift')) {
                Schema::table('products', function (Blueprint $table) {
                    $table->string('first_order_free_gift')->nullable();
                });
            }

            if (!Schema::hasColumn('products', 'third_order_free_gift')) {
                Schema::table('products', function (Blueprint $table) {
                    $table->string('third_order_free_gift')->nullable();
                });
            }
        }
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $columns = [
                'craft',
                'material',
                'man_hours',
                'first_order_free_gift',
                'third_order_free_gift'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('products', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};