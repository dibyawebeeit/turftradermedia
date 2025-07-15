<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Forgot Password OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .otp-box {
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            background-color: #f0f4ff;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
            letter-spacing: 6px;
        }
        .footer {
            margin-top: 30px;
            font-size: 13px;
            color: #999;
            text-align: center;
        }
        h1 {
            color: #2d3748;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Forgot Your Password?</h1>
        <p>Hello,</p>
        <p>We received a request to reset your password. Use the 6-digit OTP below to proceed:</p>

        <div class="otp-box">
            {{$mailData['otp']}}
        </div>

        <p>This OTP is valid for 10 minutes. Please do not share this code with anyone.</p>

        <p>If you did not request a password reset, please ignore this email.</p>

        <p>Thank you,<br>
        {{ config('app.name') }}</p>

        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>
</html>
