@extends('admin.admin_layouts.admin_app')

@section('content')
<div class="content-wrapper">
    <div class="content-margin">
        <div class="dashboard_heading flex-css">
            <div class="name">
                <h2 class="m-0">Order Management</h2>
            </div>
            <div class="list_links">
                <ul class="p-0 flex-css">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li>/</li>
                    <li class="active">Orders</li>
                </ul>
            </div>
        </div>
        <section class="dashboard_box users_edit">
            <div>
                @if(session('success'))
                    <div id="success-alert">
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
                <div class="card-body">
                    <div class="border-box">
                        <div class="card-header">
                            
                        </div>
                    </div>
                    <table id="productsTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Products</th>
                                <th>Total Price</th>
                                <th>Payment Method</th>
                                <th>Payment Status</th>
                                <th>Order Status</th>
                                <th>Date</th>
                                <!-- <th>Actions</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @if($orders && $orders->count() > 0)
                                @foreach($orders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->name ?? 'N/A' }}</td>
                                        <td>{{ $order->email ?? 'N/A' }}</td>
                                        <td>{{ $order->phone_number ?? 'N/A' }}</td>
                                        <td>
                                            @foreach($order->orderItems as $item)
                                                {{ $item->product->title ?? 'N/A' }}@if(!$loop->last), @endif
                                            @endforeach
                                        </td>
                                        <td>${{ number_format($order->total_price ?? 0, 2) }}</td>
                                        <td>
                                            <span class="badge badge-info">{{ ucfirst($order->payment_method ?? 'Unknown') }}</span>
                                        </td>
                                        <td>
                                            @if($order->payment_status == 'completed')
                                                <span class="badge badge-success">Completed</span>
                                            @elseif($order->payment_status == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @else
                                                <span class="badge badge-danger">{{ ucfirst($order->payment_status ?? 'Failed') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <select name="order_status" onchange="this.form.submit()" class="form-control form-control-sm">
                                                    <option value="pending" {{ ($order->order_status ?? 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="processing" {{ ($order->order_status ?? '') == 'processing' ? 'selected' : '' }}>Processing</option>
                                                    <option value="shipped" {{ ($order->order_status ?? '') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                                    <option value="delivered" {{ ($order->order_status ?? '') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                    <option value="cancelled" {{ ($order->order_status ?? '') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td>{{ $order->created_at ? $order->created_at->format('M d, Y H:i') : 'N/A' }}</td>
                                        <!-- <td>
                                            <div class="white_spaces">
                                                <a href="#" class="mr-2" title="View Order">
                                                    <svg class="fill-current" width="15" height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/></svg>
                                                </a>
                                            </div>
                                        </td> -->
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="11" class="text-center">No orders found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </section>
    </div>
</div>
@endsection