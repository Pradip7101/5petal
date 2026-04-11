<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Fetch Wishlist
    public function getWishlistItems()
    {
        $user = Auth::user();

        // Check if the user is authenticated
        if (!$user) {
            return response()->json(['status' => 'guest', 'message' => 'Guest user, no wishlist available'], 200);
        }
    
        // Retrieve wishlist items along with related product and category information
        $wishlistItems = Wishlist::with(['product' => function ($query) {
            $query->select('id', 'title', 'slug', 'regular_price', 'sale_price', 'sale_start', 'sale_end', 'stock', 'product_image', 'product_image2', 'category_id')
                ->with(['category:id,name,slug']); // Include category name and slug only
        }])
        ->where('user_id', $user->id)
        ->get();
    
        // Track out-of-stock items
        $outOfStockItems = [];
        $wishlistItems->each(function ($wishlistItem) use (&$outOfStockItems) {
            $product = $wishlistItem->product;
    
            if ($product) {
                // Handle product images
                if ($product->product_image) {
                    $product->product_image = asset('admin_assets/uploads/' . $product->product_image);
                }
                if ($product->product_image2) {
                    $product->product_image2 = asset('admin_assets/uploads/' . $product->product_image2);
                }
    
                // Ensure category data is accessible
                if ($product->category) {
                    $product->category_name = $product->category->name;
                    $product->category_slug = $product->category->slug;
                }
    
                // Check if the product is out of stock
                if ($product->stock <= 0) {
                    // Add out-of-stock product to the list but do not exclude it from the wishlist
                    $outOfStockItems[] = $product->title;
                }
            }
        });
    
        // Convert wishlist items to an array
        $wishlistItemsArray = $wishlistItems->toArray();
    
        // If no out-of-stock items, return success with the full wishlist
        return response()->json(['status' => 'success', 'data' => $wishlistItemsArray], 200);
    }

    // Add to Wishlist
    public function addToWishlist(Request $request)
    {
        // Check if the product is already in the wishlist
        $wishlist = Wishlist::where('user_id', Auth::id())
                            ->where('product_id', $request->product_id)
                            ->first();
    
        if ($wishlist) {
            return response()->json(['status' => 'exists', 'message' => 'Product is already in your wishlist']);
        }
    
        // If not, add the product to the wishlist
        $wishlist = Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ]);
    
        return response()->json(['status' => 'success', 'message' => 'Product added to wishlist successfully!', 'data' => $wishlist]);
    }

    // Remove from Wishlist
    public function removeWishlistItem($productId)
    {
        $user = Auth::user();
    
        // Check if the user is authenticated
        if (!$user) {
            return response()->json(['status' => 'guest', 'message' => 'Guest user, manage wishlist locally'], 200);
        }
    
        // Find the wishlist item by user_id and product_id
        $wishlistItem = Wishlist::where('user_id', $user->id)->where('product_id', $productId)->first();
    
        if ($wishlistItem) {
            $wishlistItem->delete();
            return response()->json(['status' => 'success', 'message' => 'Product removed from wishlist successfully!']);
        }
    
        return response()->json(['status' => 'error', 'message' => 'Product not found in wishlist.'], 200);
    }
}
