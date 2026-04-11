<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'orderItems.product'])
                      ->orderBy('created_at', 'desc')
                      ->get();
        
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->order_status = $request->order_status;
        $order->save();
        
        return redirect()->back()->with('success', 'Order status updated successfully');
    }
}