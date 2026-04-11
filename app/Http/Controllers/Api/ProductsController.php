<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SeasonCategory;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Search products by query.
     */
    public function searchProducts(Request $request)
    {
        $query = $request->query('query');
        
        if (!$query) {
            return response()->json([
                'status' => 'error',
                'message' => 'Query parameter is required'
            ], 400);
        }

        $products = Product::where('title', 'like', '%' . $query . '%')
            ->select('id', 'title', 'slug', 'regular_price', 'sale_price', 'sale_start', 'sale_end', 'stock', 'product_image', 'product_image2')
            ->get()
            ->map(function ($product) {
                if ($product->product_image) {
                    $product->product_image = asset('admin_assets/uploads/' . $product->product_image);
                }
                if ($product->product_image2) {
                    $product->product_image2 = asset('admin_assets/uploads/' . $product->product_image2);
                }
                $product->discount_percentage = $product->regular_price > 0 && $product->sale_price > 0
                    ? round((($product->regular_price - $product->sale_price) / $product->regular_price) * 100)
                    : 0;
                return $product;
            });

        return response()->json([
            'status' => 'success',
            'message' => 'Products retrieved successfully',
            'products' => $products
        ], 200);
    }

    /**
     * Get products by category slug and return category details along with products.
     * Only limited product data will be returned.
     */
    public function getProductsByCategory($slug)
    {
        // Find the category by its slug
        $category = Category::where('slug', $slug)->with('children')->first();

        // If category not found, return an error response
        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ], 404);
        }

        if ($category && $category->image) {
            $category->image = asset('admin_assets/uploads/' . $category->image);
        }

        if ($category && $category->cat_banner_image) {
            $category->cat_banner_image = asset('admin_assets/uploads/' . $category->cat_banner_image);
        }

       // Get all products associated with the category and select limited fields
       $products = Product::where('category_id', $category->id)
       ->select('id', 'title', 'slug', 'regular_price', 'sale_price', 'sale_start', 'sale_end', 'stock', 'product_image', 'product_image2', 'category_id')
       ->get()
       ->map(function ($product) {
            // Modify the product image field to include the full path
            if ($product->product_image) {
                $product->product_image = asset('admin_assets/uploads/' . $product->product_image);
            }
            // Modify the product image 2 field to include the full path
            if ($product->product_image2) {
                $product->product_image2 = asset('admin_assets/uploads/' . $product->product_image2);
            }
           // Calculate the discount percentage if both prices are available
           $product->discount_percentage = $product->regular_price > 0 && $product->sale_price > 0
               ? round((($product->regular_price - $product->sale_price) / $product->regular_price) * 100)
               : 0;

           return $product;
       });

        // Check if there are no products found
        if ($products->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No products found for this category',
                'category' => $category,
                'products' => []
            ], 200);  // Still return 200 since it's a valid request, just no products
        }

        // Return category details with limited product data
        return response()->json([
            'status' => 'success',
            'message' => 'Products retrieved successfully',
            'category' => $category,
            'products' => $products
        ], 200);
    }

/**
     * Get products by season category slug and return category details along with products.
     * Only limited product data will be returned.
     */
    public function getProductsBySeasonCategory($slug)
    {
        // Find the season category by its slug
        $seasonCategory = SeasonCategory::where('slug', $slug)->first();

        // If season category not found, return an error response
        if (!$seasonCategory) {
            return response()->json([
                'status' => 'error',
                'message' => 'Season category not found'
            ], 404);
        }

        // If the season category has an image, modify the image path
        if ($seasonCategory->image) {
            $seasonCategory->image = asset('admin_assets/uploads/' . $seasonCategory->image);
        }else{
            $seasonCategory->image = "";
        }

        if ($seasonCategory->banner_image) {
            $seasonCategory->banner_image = asset('admin_assets/uploads/' . $seasonCategory->banner_image);
        }else{
            $seasonCategory->banner_image = "";
        }

        // Get all products associated with the season category and select limited fields
        $products = Product::where('season_category_id', $seasonCategory->id)
            ->select('id', 'title', 'slug', 'regular_price', 'sale_price', 'sale_start', 'sale_end', 'stock', 'product_image', 'product_image2', 'season_category_id')
            ->get()
            ->map(function ($product) {
                // Modify the product image field to include the full path
                if ($product->product_image) {
                    $product->product_image = asset('admin_assets/uploads/' . $product->product_image);
                }
                // Modify the product image 2 field to include the full path
                if ($product->product_image2) {
                    $product->product_image2 = asset('admin_assets/uploads/' . $product->product_image2);
                }
                // Calculate the discount percentage if both prices are available
                $product->discount_percentage = $product->regular_price > 0 && $product->sale_price > 0
                    ? round((($product->regular_price - $product->sale_price) / $product->regular_price) * 100)
                    : 0;

                return $product;
            });

        // Check if there are no products found
        if ($products->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No products found for this season category',
                'season_category' => $seasonCategory,
                'products' => []
            ], 200);  // Still return 200 since it's a valid request, just no products
        }

        // Return season category details with limited product data
        return response()->json([
            'status' => 'success',
            'message' => 'Products retrieved successfully',
            'season_category' => $seasonCategory,
            'products' => $products
        ], 200);
    }

    /**
     * Get full product details by product slug.
     */
    public function getProductDetailsBySlug($slug)
    {
        // Find the product by its slug
        $product = Product::where('slug', $slug)->first();
        
        // If product not found, return an error response
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }
        
        // Calculate the discount percentage if both prices are available
        $product->discount_percentage = $product->regular_price > 0 && $product->sale_price > 0
            ? round((($product->regular_price - $product->sale_price) / $product->regular_price) * 100)
            : 0;

        // Append full path to the product image
        if($product->product_image){
            $product->product_image = asset('admin_assets/uploads/' . $product->product_image);
        }

        // Append full path to the product image 2
        if($product->product_image2){
            $product->product_image2 = asset('admin_assets/uploads/' . $product->product_image2);
        }

        // Decode product_gallery_images and append full path to each image
        $gallery_images = json_decode($product->product_gallery_images, true);
        if ($gallery_images) {
            foreach ($gallery_images as &$image) {
                $image['pro_image'] = asset('admin_assets/uploads/' . $image['pro_image']);
            }
            $product->product_gallery_images = json_encode($gallery_images);
        }
        
        // Ensure size is always a clean array
        $product->size = is_array($product->size) ? array_values($product->size) : [];

        // Add matching blouse data if product is saree
        if ($product->product_type === 'saree' && $product->matching_blouse) {
            $matchingBlouseIds = $product->matching_blouse;
            $matchingBlouses = Product::whereIn('id', $matchingBlouseIds)
                ->select('id', 'title', 'slug', 'size', 'regular_price', 'sale_price', 'product_image', 'product_image2', 'craft', 'material', 'man_hours', 'first_order_free_gift', 'third_order_free_gift')
                ->get()
                ->map(function ($blouse) {
                    if ($blouse->product_image) {
                        $blouse->product_image = asset('admin_assets/uploads/' . $blouse->product_image);
                    }
                    if ($blouse->product_image2) {
                        $blouse->product_image2 = asset('admin_assets/uploads/' . $blouse->product_image2);
                    }
                    $blouse->discount_percentage = $blouse->regular_price > 0 && $blouse->sale_price > 0
                        ? round((($blouse->regular_price - $blouse->sale_price) / $blouse->regular_price) * 100)
                        : 0;
                    return $blouse;
                });
            $product->matching_blouses_data = $matchingBlouses;
        } else {
            $product->matching_blouses_data = [];
        }

        // Fetch related category details and fix image path
        $category = $product->category;
        if ($category && $category->image) {
            $category->image = asset('admin_assets/uploads/' . $category->image);
        }
    
        // Return product details along with the category details
        return response()->json([
            'status' => 'success',
            'message' => 'Product details retrieved successfully',
            'product' => $product
        ], 200);
    }

    /**
     * Get 8 trending best-selling products.
     */
    public function getTrendingBestSellingProducts()
    {
        // Fetch the top 8 best-selling products with sorting by discount_percentage and sale_price
        $products = Product::whereNotNull('sale_price')
            ->orderByRaw('
                CASE
                    WHEN sale_price IS NOT NULL THEN ((regular_price - sale_price) / regular_price) * 100
                    ELSE 0
                END DESC
            ')
            ->orderBy('sale_price', 'desc')
            ->take(8)
            ->get()
            ->map(function ($product) {
                // Calculate the discount percentage
                $product->discount_percentage = $product->regular_price > 0 && $product->sale_price !== null
                    ? round((($product->regular_price - $product->sale_price) / $product->regular_price) * 100)
                    : 0;

                // Modify the product image field to include the full path
                if ($product->product_image) {
                    $product->product_image = asset('admin_assets/uploads/' . $product->product_image);
                }

                // Modify the product image 2 field to include the full path
                if ($product->product_image2) {
                    $product->product_image2 = asset('admin_assets/uploads/' . $product->product_image2);
                }

                return $product;
            });

        // Check if there are no products found
        if ($products->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No trending products found',
                'data' => []
            ], 200);  // Still return 200 since it's a valid request, just no products
        }

        // Return the list of trending best-selling products
        return response()->json([
            'status' => 'success',
            'message' => 'Trending Best Selling Products retrieved successfully',
            'data' => $products
        ], 200);
    }

    /**
     * Get 4 subcategories of "sarees" and 20 products for each subcategory.
     */
    public function getHomeCatProTabs()
    {
        // ✅ Get MAIN category dynamically (parent_id = NULL)
        $mainCategory = Category::whereNull('parent_id')->first();
    
        if (!$mainCategory) {
            return response()->json([
                'status' => 'error',
                'message' => 'Main category not found'
            ], 404);
        }
    
        // ✅ Get first 4 subcategories
        $subcategories = $mainCategory->children()->take(4)->get();
    
        $allProducts = collect();
    
        $subcategoriesData = $subcategories->map(function ($subcategory) use (&$allProducts) {
    
            $products = Product::where('category_id', $subcategory->id)
                ->select(
                    'id',
                    'title',
                    'slug',
                    'regular_price',
                    'sale_price',
                    'sale_start',
                    'sale_end',
                    'stock',
                    'product_image',
                    'product_image2'
                )
                ->take(20)
                ->get()
                ->map(function ($product) {
    
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
                            ? asset('admin_assets/uploads/' . $product->product_image)
                            : null,
                        'product_image2' => $product->product_image2
                            ? asset('admin_assets/uploads/' . $product->product_image2)
                            : null,
                        'discount_percentage' =>
                            ($product->regular_price > 0 && $product->sale_price)
                                ? round((($product->regular_price - $product->sale_price) / $product->regular_price) * 100)
                                : 0
                    ];
                });
    
            $allProducts = $allProducts->merge($products);
    
            return [
                'id' => $subcategory->id,
                'name' => $subcategory->name,
                'slug' => $subcategory->slug,
                'image' => $subcategory->image
                    ? asset('admin_assets/uploads/' . $subcategory->image)
                    : null,
                'products' => $products->take(4)->values()
            ];
        });
    
        $allProductsData = [
            'id' => 'all',
            'name' => 'All Products',
            'slug' => 'all-products',
            'products' => $allProducts->take(20)->values()
        ];
    
        return response()->json([
            'status' => 'success',
            'message' => 'Subcategories and products retrieved successfully.',
            'data' => [
                'main_category' => [
                    'id' => $mainCategory->id,
                    'name' => $mainCategory->name,
                    'slug' => $mainCategory->slug
                ],
                'subcategories' => $subcategoriesData,
                'all_products' => $allProductsData
            ]
        ], 200);
    }
    
    
    /**
     * Get all products with optional pagination.
     */
    public function getAllProducts(Request $request)
    {
        // Set the number of products per page for pagination
        $perPage = $request->query('per_page', 8); // Default to 8 products per page
        
        // Fetch products with selected fields and paginate the results
        $products = Product::select('id', 'title', 'slug', 'regular_price', 'sale_price', 'sale_start', 'sale_end', 'stock', 'product_image', 'product_image2', 'category_id')
            ->paginate($perPage);
        
        // Modify the product image paths to include the full URL
        $products->getCollection()->transform(function ($product) {
            if ($product->product_image) {
                $product->product_image = asset('admin_assets/uploads/' . $product->product_image);
            }
            if ($product->product_image2) {
                $product->product_image2 = asset('admin_assets/uploads/' . $product->product_image2);
            }

            // Calculate the discount percentage
            $product->discount_percentage = $product->regular_price > 0 && $product->sale_price !== null
                ? round((($product->regular_price - $product->sale_price) / $product->regular_price) * 100)
                : 0;

            return $product;
        });

        // Return paginated products as JSON response with pagination metadata
        return response()->json([
            'status' => 'success',
            'message' => 'Products retrieved successfully',
            'products' => $products,  // The paginated products
        ], 200);
    }

}
