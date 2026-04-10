<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: #fff;
            padding: 30px;
            border-radius: 16px;
            width: 360px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }

        input:focus {
            border-color: #4f46e5;
        }

        .btn {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: none;
            background: #4f46e5;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn:hover {
            background: #4338ca;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h2>Login</h2>

    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('sign') }}">
        @csrf

        <div class="form-group">
            <input
                type="email"
                name="email"
                placeholder="Email"
                value="{{ old('email') }}"
            >
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <input
                type="password"
                name="password"
                placeholder="Password"
            >
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn">Login</button>
    </form>
</div>

</body>
</html>
