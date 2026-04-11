<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        // Count total users with role 'customer'
        $userRegistrationsCount = User::where('role', 'customer')->count();
        // Count total categories
        $categoriesCount = Category::count();
        // Count total products
        $productsCount = Product::count();
        return view('admin.dashboard.index',compact('userRegistrationsCount', 'categoriesCount', 'productsCount'));
    }
}