<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'Product Catalogue') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Roboto', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #1B3A5C;
            background-image:
                radial-gradient(ellipse at 20% 50%, rgba(200,148,26,0.08) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(255,255,255,0.04) 0%, transparent 50%);
        }

        .auth-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .auth-brand {
            text-align: center;
            margin-bottom: 32px;
        }
        .auth-brand-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            border-radius: 14px;
            background: rgba(200,148,26,0.15);
            margin-bottom: 16px;
        }
        .auth-brand-icon i {
            font-size: 28px;
            color: #C8941A;
        }
        .auth-brand h1 {
            color: #C8941A;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 4px;
            letter-spacing: 0.5px;
        }
        .auth-brand p {
            color: rgba(255,255,255,0.45);
            font-size: 14px;
        }

        .auth-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.25);
            overflow: hidden;
        }

        .auth-card-header {
            padding: 28px 32px 0;
        }
        .auth-card-header h2 {
            font-size: 20px;
            font-weight: 600;
            color: #1B3A5C;
            margin-bottom: 4px;
        }
        .auth-card-header p {
            color: #888;
            font-size: 14px;
        }

        .auth-card-body {
            padding: 24px 32px 32px;
        }

        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #555;
            margin-bottom: 6px;
        }
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #dce0e4;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Roboto', sans-serif;
            color: #333;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        .form-group input:focus {
            border-color: #1B3A5C;
            box-shadow: 0 0 0 3px rgba(27,58,92,0.1);
        }
        .form-group input.is-invalid {
            border-color: #dc3545;
        }
        .invalid-feedback {
            color: #dc3545;
            font-size: 12px;
            margin-top: 4px;
        }

        .form-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }
        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .form-check input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #1B3A5C;
        }
        .form-check label {
            font-size: 13px;
            color: #666;
            cursor: pointer;
        }
        .forgot-link {
            font-size: 13px;
            color: #1B3A5C;
            text-decoration: none;
            font-weight: 500;
        }
        .forgot-link:hover {
            color: #C8941A;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: #1B3A5C;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            font-family: 'Roboto', sans-serif;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-login:hover {
            background: #243f5f;
        }

        .auth-footer {
            text-align: center;
            margin-top: 24px;
            color: rgba(255,255,255,0.35);
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="auth-wrapper">
        @yield('content')
    </div>
</body>

</html>
