<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('theme_options', function (Blueprint $table) {
            $table->string('modal_title')->nullable();
            $table->string('modal_subtitle')->nullable();
            $table->text('modal_below_text')->nullable();
            $table->json('modal_features')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('theme_options', function (Blueprint $table) {
            $table->dropColumn(['modal_title', 'modal_subtitle', 'modal_below_text', 'modal_features']);
        });
    }
};
