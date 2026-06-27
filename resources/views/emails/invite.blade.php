<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation to Join {{ config('app.name') }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f8fafc;
            color: #334155;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #3b4df2;
            padding: 30px;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .content {
            padding: 30px;
            line-height: 1.6;
        }
        .content h2 {
            font-size: 20px;
            color: #0f172a;
            margin-top: 0;
        }
        .credentials {
            background-color: #f1f5f9;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #3b4df2;
        }
        .credentials p {
            margin: 8px 0;
            font-size: 15px;
        }
        .credentials strong {
            color: #0f172a;
        }
        .btn-container {
            text-align: center;
            margin: 30px 0 10px;
        }
        .btn {
            display: inline-block;
            background-color: #3b4df2;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            box-shadow: 0 2px 4px rgba(59, 77, 242, 0.3);
        }
        .btn:hover {
            background-color: #2c3bc6;
        }
        .footer {
            background-color: #f8fafc;
            padding: 20px 30px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ config('app.name') }}</h1>
        </div>
        <div class="content">
            <h2>You've been invited!</h2>
            <p>Hello {{ $name }},</p>
            <p>You have been invited by the Administrator to join the <strong>{{ config('app.name') }}</strong> team as a <strong>{{ ucfirst($role) }}</strong>.</p>
            
            <p>Here are your temporary login credentials. Please log in and update your password immediately to secure your account.</p>
            
            <div class="credentials">
                <p><strong>Email Address:</strong> {{ $email }}</p>
                <p><strong>Temporary Password:</strong> <code>{{ $password }}</code></p>
            </div>
            
            <div class="btn-container">
                <a href="{{ $loginUrl }}" class="btn" target="_blank">Log In Now</a>
            </div>
        </div>
        <div class="footer">
            <p>This invitation was sent from the {{ config('app.name') }} admin panel.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
