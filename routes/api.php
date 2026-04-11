<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\ThemeOptionController;
use App\Http\Controllers\Api\HomePageController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\UserAddressController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\TestimonialsController;
use App\Http\Controllers\Api\ReelsController;

// Public routes (no authentication required)
Route::post('/register', [AuthController::class, 'register']);  
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Routes that require authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Edit profile route
    Route::post('/user/edit-profile', [AuthController::class, 'userEditProfile']);

    // Edit User Address route
    Route::post('/user/edit-address', [UserAddressController::class, 'updateAddress']);
    Route::get('/user/address', [UserAddressController::class, 'getAddress']);

    // Cart routes
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::get('/cart', [CartController::class, 'getCartItems']);
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeCartItem']);
    Route::put('/cart/update/{id}', [CartController::class, 'updateCartItem']);

    // Wishlist routes
    Route::get('/wishlist', [WishlistController::class, 'getWishlistItems']);
    Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist']);
    Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'removeWishlistItem']);

    Route::post('/order', [OrderController::class, 'store']);

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);

    Route::get('/orders', [OrderController::class, 'getUserOrders']);
    Route::get('/orders/{order}', [OrderController::class, 'getOrderDetails']);
});

// Categories routes
// Route::get('/first-four-subcategories', [CategoriesController::class, 'firstFourSubcategories']);
Route::get('/parent-categories-with-subcategories', [CategoriesController::class, 'getParentCategoriesWithSubcategories']);

// Products route
Route::get('/search-products', [ProductsController::class, 'searchProducts']);
Route::get('/get-products-by-category/{slug}', [ProductsController::class, 'getProductsByCategory']);
Route::get('/get-products-by-season-category/{slug}', [ProductsController::class, 'getProductsBySeasonCategory']);
Route::get('/get-products-details-by-slug/{slug}', [ProductsController::class, 'getProductDetailsBySlug']);
Route::get('/trending-best-selling-products', [ProductsController::class, 'getTrendingBestSellingProducts']);
Route::get('/get-home-cat-pro-tabs', [ProductsController::class, 'getHomeCatProTabs']);
Route::get('/all-products', [ProductsController::class, 'getAllProducts']);

// Theme Options route
Route::get('/get-theme-options', [ThemeOptionController::class, 'getThemeOptions']);

// Home Page Controller route
Route::get('/get-home-page-data', [HomePageController::class, 'getHomePageData']);

// Cashfree payment routes
Route::get('/cashfree/callback', [OrderController::class, 'cashfreeCallback'])->name('cashfree.callback');
Route::post('/cashfree/webhook', [OrderController::class, 'cashfreeWebhook'])->name('cashfree.webhook');

// Manage Leads routes
Route::post('/leads', [LeadController::class, 'store'])->name('admin.leads.store');

// Testimonials route
Route::get('/testimonials', [TestimonialsController::class, 'index']);

// Watch & Buy Reels route
Route::get('/reels', [ReelsController::class, 'index']);
