<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
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
                <h1>Password Reset Request</h1>
                <p>Hello,</p>
                <p>You are receiving this email because we received a password reset request for your account.</p>
                <p>If you did not request a password reset, please ignore this email.</p>
                <p>To reset your password, click the button below:</p>
                <a href="{{ $resetUrl }}" target="_blank">Reset Password</a>
                <p>This password reset link will expire in 60 minutes.</p>
                <p>Thank you,<br>{{ config('app.name') }} Team</p>
            </div>
            <div class="email-footer">
                <p>If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:</p>
                <p><a href="{{ $resetUrl }}">{{ $resetUrl }}</a></p>
            </div>
        </div>
    </div>
</body>
</html>
