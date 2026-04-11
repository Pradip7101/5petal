<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminEditProfileController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ThemeOptionController;
use App\Http\Controllers\Admin\SeasonCategoryController;
use App\Http\Controllers\Admin\ManageHomePageController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ReelsController;

Route::get('/', function () {
    return redirect()->route('admin.login');
});

// Redirect /admin to the login page if not logged in
// Route::get('/admin', function () {
//     return redirect()->route('admin.login');
// });

Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.post');
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('admin.password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('admin.password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('admin.password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('admin.password.update');
});

// Admin Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');



// Admin-only routes, protected by CheckAdmin middleware
Route::middleware([CheckAdmin::class])->group(function () {
    Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('admin.change.password.form');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('admin.change.password');
    Route::get('/profile', [AdminEditProfileController::class, 'editProfile'])->name('admin.profile.edit');
    Route::post('/profile', [AdminEditProfileController::class, 'updateProfile'])->name('admin.profile.update');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Users management routes
    Route::get('/users', [UsersController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UsersController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UsersController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UsersController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('admin.users.destroy');

    // Categories management routes
    Route::get('/categories', [CategoriesController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [CategoriesController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [CategoriesController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{category}/edit', [CategoriesController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{category}', [CategoriesController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{category}', [CategoriesController::class, 'destroy'])->name('admin.categories.destroy');

    // Products management routes
    Route::get('/products', [ProductsController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductsController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductsController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}/edit', [ProductsController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [ProductsController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [ProductsController::class, 'destroy'])->name('admin.products.destroy');
    Route::get('/products/{id}', [ProductsController::class, 'show'])->name('admin.products.show');

    // Orders management routes
    Route::get('/orders', [OrdersController::class, 'index'])->name('admin.orders.index');
    Route::patch('/orders/{id}/status', [OrdersController::class, 'updateStatus'])->name('admin.orders.updateStatus');

    // Theme Options
    Route::get('/theme-options', [ThemeOptionController::class, 'index'])->name('admin.theme-options');
    Route::put('/theme-options/update', [ThemeOptionController::class, 'update'])->name('admin.theme-options.update');

    // Season Category management routes
    Route::get('/season-category', [SeasonCategoryController::class, 'index'])->name('admin.season-category.index');
    Route::get('/season-category/create', [SeasonCategoryController::class, 'create'])->name('admin.season-category.create');
    Route::post('/season-category', [SeasonCategoryController::class, 'store'])->name('admin.season-category.store');
    Route::get('/season-category/{seasonCategory}/edit', [SeasonCategoryController::class, 'edit'])->name('admin.season-category.edit');
    Route::put('/season-category/{seasonCategory}', [SeasonCategoryController::class, 'update'])->name('admin.season-category.update');
    Route::delete('/season-category/{seasonCategory}', [SeasonCategoryController::class, 'destroy'])->name('admin.season-category.destroy');

    // Manage Home Pages routes
    Route::get('/manage-home-pages', [ManageHomePageController::class, 'index'])->name('admin.manage-home-pages');
    Route::put('/manage-home-pages/update', [ManageHomePageController::class, 'update'])->name('admin.manage-home-pages.update');

    // Reels (Watch & Buy) management routes
    Route::get('/reels', [ReelsController::class, 'index'])->name('admin.reels.index');
    Route::get('/reels/create', [ReelsController::class, 'create'])->name('admin.reels.create');
    Route::post('/reels', [ReelsController::class, 'store'])->name('admin.reels.store');
    Route::get('/reels/{reel}/edit', [ReelsController::class, 'edit'])->name('admin.reels.edit');
    Route::put('/reels/{reel}', [ReelsController::class, 'update'])->name('admin.reels.update');
    Route::delete('/reels/{reel}', [ReelsController::class, 'destroy'])->name('admin.reels.destroy');

    // Manage Leads routes
    Route::get('/leads', [LeadController::class, 'index'])->name('admin.leads.index');

    // Testimonials management routes
    Route::get('/testimonials', [\App\Http\Controllers\Admin\TestimonialsController::class, 'index'])->name('admin.testimonials.index');
    Route::get('/testimonials/create', [\App\Http\Controllers\Admin\TestimonialsController::class, 'create'])->name('admin.testimonials.create');
    Route::post('/testimonials', [\App\Http\Controllers\Admin\TestimonialsController::class, 'store'])->name('admin.testimonials.store');
    Route::get('/testimonials/{testimonial}/edit', [\App\Http\Controllers\Admin\TestimonialsController::class, 'edit'])->name('admin.testimonials.edit');
    Route::put('/testimonials/{testimonial}', [\App\Http\Controllers\Admin\TestimonialsController::class, 'update'])->name('admin.testimonials.update');
    Route::delete('/testimonials/{testimonial}', [\App\Http\Controllers\Admin\TestimonialsController::class, 'destroy'])->name('admin.testimonials.destroy');
});
