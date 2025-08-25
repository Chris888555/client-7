<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Your Account Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            color: #333333;
            margin: 0; 
            padding: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            margin: 15px 0;
        }
        ul {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            padding: 15px 25px;
            border-radius: 6px;
            list-style-type: none;
            max-width: 400px;
        }
        ul li {
            padding: 8px 0;
            border-bottom: 1px solid #e2e8f0;
        }
        ul li:last-child {
            border-bottom: none;
        }
        strong {
            color: #2563eb; /* blue-600 */
        }
    </style>
</head>
<body>
    <p>Hello <strong>{{ $user->name }}</strong>,</p>

    <p>You requested your account details. Here they are:</p>

    <ul>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Username:</strong> {{ $user->username }}</li>
        <li><strong>Password:</strong> {{ $user->dpassword }}</li>
    </ul>

    <p>Please keep your password safe.</p>

    <p>Thanks,<br />C.D Marketing Solutions</p>
</body>
</html>
