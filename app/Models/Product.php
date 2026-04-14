<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'season_category_id',  
        'title',
        'slug',
        'short_description',
        'long_description',
        'sku',
        'regular_price',
        'sale_price',
        'stock',
        'reviews_count',
        'reviews_average',
        'rating',
        'sale_start',
        'sale_end',
        'product_type',
        'size',
        'matching_blouse',
        'additional_information',
        'qa',
        'product_image',
        'product_image2',
        'product_gallery_images',
        'craft',
        'material',
        'man_hours',
        'first_order_free_gift',
        'third_order_free_gift',
        'color',
        'disclaimer',
        'model_info'
    ];

    protected $casts = [
        'sale_start' => 'datetime',
        'sale_end' => 'datetime',
        'size' => 'array',
        'matching_blouse' => 'array',
    ];

    protected static function booted()
    {
        static::saving(function ($product) {
            $product->rating = $product->reviews_average;
        });
    }

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Season Category relationship
    public function seasonCategory()
    {
        return $this->belongsTo(SeasonCategory::class, 'season_category_id');
    }
}
