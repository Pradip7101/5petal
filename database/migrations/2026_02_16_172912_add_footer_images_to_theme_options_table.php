<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('theme_options', function (Blueprint $table) {
            $table->string('footer_image1')->nullable()->after('footer_payment_logo');
            $table->string('footer_image2')->nullable()->after('footer_image1');
        });
    }

    public function down(): void
    {
        Schema::table('theme_options', function (Blueprint $table) {
            $table->dropColumn(['footer_image1', 'footer_image2']);
        });
    }
};
