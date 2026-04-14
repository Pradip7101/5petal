<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('products')) {

            if (!Schema::hasColumn('products', 'color')) {
                Schema::table('products', function (Blueprint $table) {
                    $table->string('color')->nullable();
                });
            }

            if (!Schema::hasColumn('products', 'disclaimer')) {
                Schema::table('products', function (Blueprint $table) {
                    $table->text('disclaimer')->nullable();
                });
            }

            if (!Schema::hasColumn('products', 'model_info')) {
                Schema::table('products', function (Blueprint $table) {
                    $table->string('model_info')->nullable();
                });
            }
        }
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $columns = [
                'color',
                'disclaimer', 
                'model_info'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('products', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};