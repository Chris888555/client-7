<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Account Has Been Approved</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            color: #333333;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 6px;
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }
        .btn {
            display: inline-block;
            background: #2563eb;
            color: #ffffff !important; 
            padding: 12px 20px;
            border-radius: 6px;
            text-decoration: none;
            margin-top: 20px;
            text-decoration: none !important;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Hello {{ $user->name }},</h2>
    <p>Good news 🎉 Your account has been <strong>approved</strong> by our admin team.</p>
    <p>You can now log in and start using our platform.</p>
    <a href="{{ url('/login') }}" class="btn">Login Now</a>
    <p style="margin-top:30px;">
    Thanks,<br>
    - Admin
    </p>
</div>
</body>
</html>
