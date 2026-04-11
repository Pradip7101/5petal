<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f7;
            color: #51545e;
            margin: 0;
            padding: 0;
        }
        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            padding: 20px 0;
        }
        .header img {
            width: 120px;
        }
        .body-content {
            padding: 20px;
        }
        h1 {
            color: #333;
            font-size: 24px;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
        }
        .order-details, .order-items {
            margin-top: 20px;
            font-size: 16px;
        }
        .order-items li {
            padding: 5px 0;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-content">
        <div class="header">
            <img src="{{ $headerLogo }}" alt="Company Logo">
        </div>
        <div class="body-content">
            <h1>Thank You for Your Order!</h1>
            <p>Dear {{ $order->name }},</p>
            <p>Your order has been successfully placed! Here are your order details:</p>
            <div class="order-details">
                <p><strong>Order ID:</strong> {{ $order->id }}</p>
                <p><strong>Total Amount:</strong> ${{ $order->total_price }}</p>
                <p><strong>Email:</strong> {{ $order->email }}</p>
            </div>
            <h3>Order Items:</h3>
            <ul class="order-items">
                @foreach ($products as $item)
                    <li>{{ $item['title'] }} (x{{ $item['quantity'] }}) - ${{ $item['price'] }}</li>
                @endforeach
            </ul>
            <p>We appreciate your business and hope you enjoy your purchase!</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
