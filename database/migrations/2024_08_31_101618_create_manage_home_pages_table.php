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
        Schema::create('manage_home_pages', function (Blueprint $table) {
            $table->id();
            $table->text('below_banner_description')->nullable();
            $table->string('sale_section_sale_text_left')->nullable();
            $table->string('sale_section_sale_text_right')->nullable();
            $table->timestamp('sale_section_sale_start')->nullable();
            $table->timestamp('sale_section_sale_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_home_pages');
    }
};
