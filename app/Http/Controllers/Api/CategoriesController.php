<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    // Get parent categories with their subcategories and total subcategories count
    public function getParentCategoriesWithSubcategories()
    {
        $categories = Category::whereNull('parent_id')
            ->with(['children.products']) // Eager load subcategories with their products
            ->get()
            ->map(function ($category) {
                // Collect all products from subcategories
                $allSubcategoryProducts = $category->children->flatMap(function ($subcategory) {
                    return $subcategory->products;
                });
    
                // Get the latest 3 products from all subcategories
                $latestProducts = $allSubcategoryProducts->sortByDesc('created_at')->take(3)->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'title' => $product->title,
                        'slug' => $product->slug,
                        'product_image' => $product->product_image ? asset('admin_assets/uploads/' . $product->product_image) : '',
                        'product_image2' => $product->product_image2 ? asset('admin_assets/uploads/' . $product->product_image2) : '',
                        'regular_price' => $product->regular_price,
                        'sale_price' => $product->sale_price,
                        'stock' => $product->stock,
                        'sale_start' => $product->sale_start,
                        'sale_end' => $product->sale_end,
                        'discount_percentage' => $product->regular_price > 0 && $product->sale_price > 0
                            ? round((($product->regular_price - $product->sale_price) / $product->regular_price) * 100)
                            : 0,
                    ];
                });
    
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'image' => $category->image ? asset('admin_assets/uploads/' . $category->image) : '',
                    'cat_banner_mobile_image' => $category->cat_banner_mobile_image ? asset('admin_assets/uploads/' . $category->cat_banner_mobile_image) : '',
                    'subcategories' => $category->children->map(function ($subcategory) {
                        return [
                            'id' => $subcategory->id,
                            'name' => $subcategory->name,
                            'slug' => $subcategory->slug,
                            'image' => $subcategory->image ? asset('admin_assets/uploads/' . $subcategory->image) : '',
                            'category_video' => $subcategory->category_video
                            ? url('admin_assets/uploads/category-videos/' . $subcategory->category_video)
                            : null,
                            'product_count' => $subcategory->products->count(),
                        ];
                    }),
                    'total_subcategories' => $category->children->count(),
                    'product_count' => $category->products->count(), // Product count for the parent category
                    'latest_products' => $latestProducts, // Latest 3 products from subcategories
                ];
            });
    
        return response()->json([
            'status' => 'success',
            'message' => 'Parent categories with subcategories and latest products retrieved successfully.',
            'data' => $categories
        ]);
    }
    

    // Get the first four subcategories of the first parent category
    // public function firstFourSubcategories()
    // {
    //     $parentCategory = Category::whereNull('parent_id')->first();

    //     if (!$parentCategory) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'No parent categories found.',
    //         ], 404);
    //     }

    //     $subcategories = Category::where('parent_id', $parentCategory->id)
    //         ->limit(4)
    //         ->get();

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Subcategories retrieved successfully.',
    //         'data' => $subcategories
    //     ]);
    // }
}
