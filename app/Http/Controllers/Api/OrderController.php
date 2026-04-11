<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\ThemeOption;
use App\Services\CashfreeService;
use NguyenHuy\Delhivery\Delhivery;
use App\Contracts\LogisticsHandler;

class OrderController extends Controller
{
     public function __construct(private LogisticsHandler $logisticsHandler) {}
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'pin_code' => 'required|string',
            'payment_method' => 'required|string|in:cod,cashfree,payu',
            'cartItems' => 'required|array',
            'total' => 'required|numeric',
        ]);

        // Initialize the calculated total
        $calculatedTotal = 0;

        // Get the current date and time
        $currentDate = now();

        $orderProducts = [];
        // Check product availability and recalculate total
        foreach ($request->cartItems as $item) {
            // Validate cart item structure
            if (!isset($item['product_id']) || !isset($item['quantity'])) {
                return response()->json(['status' => 'error', 'message' => 'Invalid cart item structure.'], 400);
            }
            
            $product = Product::find($item['product_id']);

            if (!$product) {
                return response()->json(['status' => 'error', 'message' => 'Product not found.'], 404);
            }

            if ($product->stock < $item['quantity']) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product ' . $product->name . ' is out of stock or insufficient quantity.'
                ], 400);
            }

            // Determine which price to use (sale or regular) based on the sale period
            $price = $this->getProductPrice($product, $currentDate);

             $orderProducts[] = [
                'product_title' => $product->title,
                'quantity' => $item['quantity'],
                'price' => $price
            ];

            // Calculate the total price based on actual product prices
            $calculatedTotal += $price * $item['quantity'];
        }

        // Compare calculated total with the total from the request
        if (abs($calculatedTotal - $request->total) > 0.01) { // Allowing a small difference due to floating point precision
            return response()->json(['status' => 'error', 'message' => 'Total price mismatch.'], 400);
        }

        // Map payu to cashfree for backward compatibility
        $paymentMethod = $request->payment_method;
        if ($request->payment_method === 'payu') {
            $paymentMethod = 'cashfree';
        }

        // Create the order in the database
        $order = Order::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'pin_code' => $request->pin_code,
            'total_price' => $calculatedTotal,
            'txn_id' => '',
            'cashfree_order_id' => '',
            'payment_method' => $paymentMethod,
            'payment_status' => 'pending',
        ]);

        // Create Order Items
        foreach ($request->cartItems as $item) {
            if (isset($item['product_id']) && isset($item['quantity'])) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $this->getProductPrice(Product::find($item['product_id']), $currentDate),
                ]);
            }
        }

         // Need to add delhivery integration here
        $shipmentData = $order->only(['id', 'name', 'address', 'country', 'state', 'city', 'pin_code', 'phone_number', 'email', 'total_price']);

        // Check the payment method
        if ($paymentMethod === 'cashfree') {
             $this->logisticsHandler->createShipment($shipmentData, $orderProducts, 'Prepaid');
            return $this->initiateCashfreeTransaction($order);
        } else {
            // Decrease stock for COD orders
            $this->logisticsHandler->createShipment($shipmentData, $orderProducts, 'COD');
            $this->decreaseStock($request->cartItems);
            return response()->json(['status' => 'success', 'message' => 'Order placed successfully!','payment_method'=>'cod'], 200);
        }
    }

    public function cashfreeWebhook(Request $request)
    {
        $data = $request->all();
        
        if (isset($data['link_id'])) {
            $linkId = $data['link_id'];
            $order = Order::with('orderItems.product')->where('cashfree_order_id', $linkId)->first();

            if ($order && $data['link_status'] === 'PAID') {
                $order->update(['payment_status' => 'completed']);
                
                // Process successful payment
                if ($order->orderItems && $order->orderItems->count() > 0) {
                    foreach ($order->orderItems as $item) {
                        $product = Product::find($item->product_id);
                        if ($product) {
                            $product->decrement('stock', $item->quantity);
                        }
                    }
                }

                // Send success emails
                $this->sendOrderEmails($order);
            }
        }

        return response()->json(['status' => 'ok']);
    }

    public function getUserOrders()
    {
        $orders = Order::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
    
        return response()->json([
            'status' => 'success',
            'message' => 'Orders collected successfully!',
            'orders' => $orders,
        ], 200);
    }
    
    public function getOrderDetails($orderId)
    {
        $order = Order::with('orderItems.product')
            ->where('user_id', auth()->id())
            ->findOrFail($orderId);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Order details data collected successfully!',
            'order' => $order,
        ], 200);
    }

    private function getProductPrice($product, $currentDate)
    {
        if ($product->sale_price && $product->sale_start && $product->sale_end && 
            $currentDate->between($product->sale_start, $product->sale_end)) {
            return $product->sale_price;
        }
        return $product->regular_price;
    }

    private function decreaseStock($cartItems)
    {
        foreach ($cartItems as $item) {
            if (isset($item['product_id']) && isset($item['quantity'])) {
                $product = Product::find($item['product_id']);
                if ($product) {
                    $product->decrement('stock', $item['quantity']);
                }
            }
        }
    }

    private function restoreStock($orderItems)
    {
        if ($orderItems) {
            foreach ($orderItems as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->increment('stock', $item->quantity);
                }
            }
        }
    }

    private function initiateCashfreeTransaction($order)
    {
        $cashfreeService = new CashfreeService();
        
        // Format phone number for Cashfree - handle the specific case
        $phone = preg_replace('/[^0-9]/', '', $order->phone_number);
        
        // For the test number 123456788765 (12 digits), treat as invalid and use default
        if (strlen($phone) === 12 && !preg_match('/^91[0-9]{10}$/', $phone)) {
            $phone = '9999999999'; // Use a valid test number
        } elseif (strlen($phone) === 10) {
            // Valid 10-digit Indian number
            $phone = $phone;
        } elseif (strlen($phone) === 12 && substr($phone, 0, 2) === '91') {
            // Valid 12-digit number starting with 91
            $phone = substr($phone, 2); // Remove 91 prefix, Cashfree will handle it
        } else {
            // Invalid format, use default
            $phone = '9999999999';
        }
        
        $linkData = [
            'customer_details' => [
                'customer_email' => $order->email,
                'customer_name' => $order->name,
                'customer_phone' => $phone,
            ],
            'link_amount' => (float)$order->total_price,
            'link_currency' => 'INR',
            'link_id' => 'link_' . $order->id . '_' . time(),
            'link_purpose' => 'Order Payment',
            'link_meta' => [
                'notify_url' => url('/api/cashfree/webhook'),
                'return_url' => url('/api/cashfree/callback?order_id=' . $order->id),
            ],
        ];

        $response = $cashfreeService->createPaymentLink($linkData);
        
        if ($response && isset($response['link_url'])) {
            $order->update([
                'cashfree_order_id' => $linkData['link_id'],
                'txn_id' => $linkData['link_id']
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Cashfree payment link created.',
                'payment_url' => $response['link_url'],
                'link_id' => $linkData['link_id'],
                'payment_method' => 'cashfree'
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to create Cashfree payment link.',
            'debug' => $response
        ], 500);
    }

    public function cashfreeCallback(Request $request)
    {
        $orderId = $request->query('order_id');
        $order = Order::with('orderItems.product')->find($orderId);

        if (!$order) {
            return response()->json(['status' => 'error', 'message' => 'Order not found.'], 404);
        }

        $cashfreeService = new CashfreeService();
        $linkDetails = $cashfreeService->getPaymentLink($order->cashfree_order_id);

        if ($linkDetails && $linkDetails['link_status'] === 'PAID') {
            $order->update(['payment_status' => 'completed']);
            
            if ($order->orderItems && $order->orderItems->count() > 0) {
                foreach ($order->orderItems as $item) {
                    $product = Product::find($item->product_id);
                    if ($product) {
                        $product->decrement('stock', $item->quantity);
                    }
                }
            }

            return response()->json(['status' => 'success', 'message' => 'Payment successful']);
        }

        $order->update(['payment_status' => 'failed']);
        return response()->json(['status' => 'error', 'message' => 'Payment failed']);
    }

    private function sendOrderEmails($order)
    {
        $themeOption = ThemeOption::first();
        $headerLogo = $themeOption ? asset('admin_assets/uploads/' . $themeOption->header_logo) : asset('admin_assets/images/AdminLTELogo.png');

        // Load order items if not already loaded
        if (!$order->relationLoaded('orderItems')) {
            $order->load('orderItems.product');
        }

        $userEmailData = [
            'headerLogo' => $headerLogo,
            'order' => $order,
            'products' => $order->orderItems ? $order->orderItems->map(function($item) {
                return [
                    'title' => $item->product ? $item->product->title : 'Product',
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ];
            }) : [],
        ];

        Mail::send('emails.order_success', $userEmailData, function ($message) use ($order) {
            $message->to($order->email)
                    ->subject('Your Order is Successful - Order ID: ' . $order->id);
        });

        if ($themeOption && $themeOption->admin_email) {
            Mail::send('emails.admin_order_success', $userEmailData, function ($message) use ($themeOption, $order) {
                $message->to($themeOption->admin_email)
                        ->subject('New Order Placed - Order ID: ' . $order->id);
            });
        }
    }
}
