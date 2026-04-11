<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('manage_home_pages', function (Blueprint $table) {
            $table->string('home_video')->nullable()->after('below_banner_description');
        });
    }

    public function down(): void
    {
        Schema::table('manage_home_pages', function (Blueprint $table) {
            $table->dropColumn('home_video');
        });
    }
};
