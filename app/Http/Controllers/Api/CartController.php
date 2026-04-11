<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Get all cart items for authenticated users
    public function getCartItems()
    {
        $user = Auth::user();

        // Check if the user is authenticated
        if (!$user) {
            return response()->json(['status' => 'guest', 'message' => 'Guest user, no cart available'], 200);
        }

        // Retrieve cart items along with related product and category information
        $cartItems = Cart::with(['product' => function ($query) {
            $query->select('id', 'title', 'slug', 'regular_price', 'sale_price', 'sale_start', 'sale_end', 'stock', 'product_image', 'product_image2', 'category_id')
                ->with(['category:id,name,slug']); // Include category name and slug only
        }])
        ->where('user_id', $user->id)
        ->get();

        // Track out-of-stock items
        $outOfStockItems = [];
        $cartItems->each(function ($cartItem) use (&$outOfStockItems) {
            $product = $cartItem->product;

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
                    // Add out-of-stock product to the list but do not exclude it from the cart
                    $outOfStockItems[] = $product->title;
                }
            }
        });

        // Convert cart items to an array
        $cartItemsArray = $cartItems->toArray();

        // If there are any out-of-stock items, send a warning message along with the full cart data
        if (!empty($outOfStockItems)) {
            return response()->json([
                'status' => 'warning',
                'message' => 'Some items are out of stock: ' . implode(', ', $outOfStockItems),
                'data' => $cartItemsArray // Return full cart data
            ], 200);
        }

        // If no out-of-stock items, return success with the full cart
        return response()->json(['status' => 'success', 'data' => $cartItemsArray], 200);
    }

    // Add item to cart (for authenticated users)
    public function addToCart(Request $request)
    {
        $user = Auth::user();

        // Check if the user is authenticated
        if (!$user) {
            return response()->json(['status' => 'guest', 'message' => 'Guest user, manage cart locally'], 200);
        }

        // Validate the request
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);
        $quantity = $request->quantity;

        // Check stock availability
        if ($product->stock < $quantity) {
            return response()->json(['status' => 'error', 'message' => 'Insufficient stock available!'], 200);
        }

        // Check if the product is already in the cart
        $cartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $product->id)
                        ->first();

        if ($cartItem) {
            // Update quantity if product is already in the cart
            $cartItem->quantity += $quantity;

            // Ensure quantity does not exceed stock
            if ($cartItem->quantity > $product->stock) {
                return response()->json(['status' => 'error', 'message' => 'Quantity exceeds stock availability!'], 200);
            }

            $cartItem->save();
        } else {
            // Add new product to the cart
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        return response()->json(['status' => 'success', 'message' => 'Product added to cart successfully!']);
    }

    // Remove item from cart for authenticated users
    public function removeCartItem($productId)
    {
        $user = Auth::user();
    
        // Check if the user is authenticated
        if (!$user) {
            return response()->json(['status' => 'guest', 'message' => 'Guest user, manage cart locally'], 200);
        }
    
        // Find the cart item by user_id and product_id
        $cartItem = Cart::where('user_id', $user->id)->where('product_id', $productId)->first();
    
        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['status' => 'success', 'message' => 'Item removed from cart successfully!']);
        }
    
        return response()->json(['status' => 'error', 'message' => 'Item not found in cart.'], 200);
    }

    // Update item quantity in the cart for authenticated users
    public function updateCartItem(Request $request, $id)
    {
        $user = Auth::user();
    
        // Check if the user is authenticated
        if (!$user) {
            return response()->json(['status' => 'guest', 'message' => 'Guest user, manage cart locally'], 200);
        }
    
        // Validate the request
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
    
        $cartItem = Cart::where('user_id', $user->id)->where('id', $id)->first();
    
        if ($cartItem) {
            $quantity = $request->quantity;
            $product = Product::find($cartItem->product_id);
    
            // Check if the product exists
            if (!$product) {
                return response()->json(['status' => 'error', 'message' => 'Product not found!'], 200);
            }
    
            // Check stock availability
            if ($product->stock < $quantity) {
                return response()->json(['status' => 'error', 'message' => 'Insufficient stock available!'], 200);
            }
    
            // Update the cart item's quantity
            $cartItem->quantity = $quantity;
            $cartItem->save();
    
            return response()->json(['status' => 'success', 'message' => 'Cart updated successfully!']);
        }
    
        return response()->json(['status' => 'error', 'message' => 'Item not found!'], 200);
    }    
}
