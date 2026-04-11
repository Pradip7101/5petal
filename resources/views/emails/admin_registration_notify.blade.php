<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Customer Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f7;
            color: #51545e;
            margin: 0;
            padding: 0;
        }
        .email-wrapper {
            width: 100%;
            background-color: #f4f4f7;
            padding: 20px;
        }
        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .email-header {
            text-align: center;
            padding-bottom: 20px;
        }
        .email-header img {
            width: 120px;
        }
        .email-body {
            padding: 20px;
        }
        .email-body h1 {
            font-size: 24px;
            color: #333333;
            margin-bottom: 20px;
        }
        .email-body p {
            font-size: 16px;
            line-height: 1.6;
            color: #51545e;
        }
        .email-body a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background-color: #3869d4;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .email-footer {
            text-align: center;
            font-size: 12px;
            color: #888888;
            padding-top: 20px;
        }
    </style>
</head>
<body>
   <div class="email-wrapper">
        <div class="email-content">
            <div class="email-header">
                <img src="{{ $headerLogo }}" alt="{{ config('app.name') }}" width="120" height="auto">
            </div>
            <div class="email-body">
                <h1>New Customer Registration</h1>
                <p>A new customer has registered:</p>
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Phone:</strong> {{ $user->phone }}</p>
            </div>
        </div>
    </div>
</body>
</html>
