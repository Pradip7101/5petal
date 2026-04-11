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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('season_category_id')->nullable()->constrained('season_categories')->onDelete('set null');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->string('sku')->unique();
            $table->decimal('regular_price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->integer('stock');
            $table->timestamp('sale_start')->nullable();
            $table->timestamp('sale_end')->nullable();
            $table->json('additional_information')->nullable(); // Repeater field
            $table->json('qa')->nullable(); // Repeater field
            $table->string('product_image')->nullable();
            $table->string('product_image2')->nullable();
            $table->json('product_gallery_images')->nullable(); // Repeater field
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
