<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManageHomePage;
use App\Models\Category;
use App\Models\Product;
use App\Models\SeasonCategory;

class HomePageController extends Controller
{
    public function getHomePageData()
    {
        /* =========================
         |  HOME PAGE DATA
         ========================= */
        $homeData = ManageHomePage::first();

        if ($homeData) {
            if ($homeData->home_video) {
                $homeData->home_video_url = url('admin_assets/uploads/home-videos/' . $homeData->home_video);
            } else {
                $homeData->home_video_url = null;
            }
        }

        /* =========================
         |  ALL SUBCATEGORIES
         ========================= */
        $subCategories = Category::whereNull('parent_id')
            ->with(['children' => function ($query) {
                $query->withCount('products');
            }])
            ->get()
            ->flatMap(function ($mainCategory) {
                return $mainCategory->children->map(function ($category) {
                    return [
                        'id' => $category->id,
                        'name' => $category->name,
                        'slug' => $category->slug,
                        'image' => $category->image
                            ? url('admin_assets/uploads/' . $category->image)
                            : null,
                        'product_count' => $category->products_count,
                    ];
                });
            });

        /* =========================
         |  LATEST CATEGORY BANNERS
         ========================= */
        $latestCategoriesBanners = Category::whereNull('parent_id')
            ->with(['children' => function ($query) {
                $query->latest()->take(10);
            }])
            ->get()
            ->map(function ($category) {
                return $category->children->map(function ($subcategory) {
                    return [
                        'id' => $subcategory->id,
                        'name' => $subcategory->name,
                        'slug' => $subcategory->slug,
                        'description' => $subcategory->description,
                        // 'image' => $subcategory->image
                        //     ? url('admin_assets/uploads/' . $subcategory->image)
                        //     : null,
                        // 'cat_banner_image' => $subcategory->cat_banner_image
                        //     ? url('admin_assets/uploads/' . $subcategory->cat_banner_image)
                        //     : null,
                        // 'category_video' => $subcategory->category_video
                        //     ? url('admin_assets/uploads/category-videos/' . $subcategory->category_video)
                        //     : null,

                        'image' => $subcategory->image
                            ? url('admin_assets/uploads/' . $subcategory->image)
                            : null,

                        // ✅ desktop banner
                        'cat_banner_image' => $subcategory->cat_banner_image
                            ? url('admin_assets/uploads/' . $subcategory->cat_banner_image)
                            : null,

                        // 🔥 ✅ mobile banner (FINAL FIX)
                        'cat_banner_mobile_image' => $subcategory->cat_banner_mobile_image
                            ? url('admin_assets/uploads/' . $subcategory->cat_banner_mobile_image)
                            : null,

                        'category_video' => $subcategory->category_video
                            ? url('admin_assets/uploads/category-videos/' . $subcategory->category_video)
                            : null,

                    ];
                });
            })
            ->flatten(1);

        /* =========================
         |  SALE PRODUCTS
         ========================= */
        $latestSaleProducts = Product::whereNotNull('sale_price')
            ->latest()
            ->take(20)
            ->get()
            ->map(function ($product) {
                $discount = ($product->regular_price > 0 && $product->sale_price > 0)
                    ? round((($product->regular_price - $product->sale_price) / $product->regular_price) * 100)
                    : 0;

                return [
                    'id' => $product->id,
                    'title' => $product->title,
                    'slug' => $product->slug,
                    'regular_price' => $product->regular_price,
                    'sale_price' => $product->sale_price,
                    'stock' => $product->stock,
                    'sale_start' => $product->sale_start,
                    'sale_end' => $product->sale_end,
                    'product_image' => $product->product_image
                        ? url('admin_assets/uploads/' . $product->product_image)
                        : null,
                    'product_image2' => $product->product_image2
                        ? url('admin_assets/uploads/' . $product->product_image2)
                        : null,
                    'discount_percentage' => $discount,
                ];
            });

        /* =========================
         |  SEASON CATEGORIES
         ========================= */
        $seasonCategories = SeasonCategory::all()->map(function ($season) {
            return [
                'id' => $season->id,
                'title' => $season->title,
                'slug' => $season->slug,
                'image' => $season->image
                    ? url('admin_assets/uploads/' . $season->image)
                    : null,
            ];
        });

        $latestSeasonCategories = SeasonCategory::latest()
            ->take(2)
            ->get()
            ->map(function ($season) {
                return [
                    'id' => $season->id,
                    'title' => $season->title,
                    'slug' => $season->slug,
                    'image' => $season->image
                        ? url('admin_assets/uploads/' . $season->image)
                        : null,
                    'banner_image' => $season->banner_image
                        ? url('admin_assets/uploads/' . $season->banner_image)
                        : null,
                ];
            });

        /* =========================
         |  FINAL RESPONSE
         ========================= */
        return response()->json([
            'status' => 'success',
            'message' => 'Home Page Data retrieved successfully.',
            'data' => [
                'homeData' => $homeData,
                'fourSareesSubCategories' => $subCategories,
                'latestCategoriesBanners' => $latestCategoriesBanners,
                'latestSaleProducts' => $latestSaleProducts,
                'seasonCategories' => $seasonCategories,
                'latestSeasonCategories' => $latestSeasonCategories,
            ]
        ], 200);
    }
}
