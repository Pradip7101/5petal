<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'image',
        'cat_banner_image',
        'cat_banner_mobile_image',
        'parent_id',
        'category_video',
    ];

    /**
     * Get the parent category of this category.
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get the subcategories for this category.
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class); // Assuming you have a Product model
    }
}
