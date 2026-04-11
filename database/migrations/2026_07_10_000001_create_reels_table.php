<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reels', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('video_file')->nullable();       // uploaded MP4
            $table->string('youtube_id')->nullable();       // YouTube video ID
            $table->string('thumbnail_image')->nullable();  // uploaded thumbnail
            $table->unsignedTinyInteger('discount_percent')->default(0);
            $table->decimal('price', 10, 2);                // sale price
            $table->decimal('original_price', 10, 2);       // original / crossed price
            $table->string('views_count')->default('0');    // e.g. "2.7K"
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reels');
    }
};
