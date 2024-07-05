<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Template</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 20px 0;
        }
        .header h1 {
            margin: 0;
        }
        .content {
            padding: 20px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            color: #333333;
        }
        .content .email-info {
            font-weight: bold;
            color: #555555;
        }
        .footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 10px 0;
            font-size: 12px;
            color: #777777;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #45a049;
        }

        .mt-5{
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="email-container mt-5">
        <div class="header">
            <h1>{{ $name }}</h1>
        </div>
        <div class="content">
            <p>Hello {{ $name }},</p>
            <p class="email-info">Email: {{ $email }}</p>
            <p>{{ $messageContent }}</p>
            <a href="#" class="button">Get Started</a>
        </div>
        <div class="footer">
            <p>&copy; 2024 Your Company. All rights reserved.</p>
            <p>If you have any questions, feel free to <a href="#">contact us</a>.</p>
        </div>
    </div>
</body>
</html>
