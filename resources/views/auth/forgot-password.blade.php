<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flourie BAKERY - Lupa Kata Sandi</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #faf8f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: white;
            border-radius: 24px;
            padding: 48px 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
        }

        .logo {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo h1 {
            font-size: 28px;
            font-weight: 700;
            color: #2d1b0e;
            letter-spacing: -0.5px;
        }

        .logo h1 span {
            color: #d49b6a;
        }

        .logo p {
            color: #8a7a6a;
            font-size: 14px;
            margin-top: 4px;
        }

        .info-text {
            color: #6b5f55;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 24px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #2d1b0e;
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e8e0d8;
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #fcfaf8;
            color: #2d1b0e;
            outline: none;
        }

        .form-group input:focus {
            border-color: #d49b6a;
            background: white;
            box-shadow: 0 0 0 4px rgba(212, 155, 106, 0.12);
        }

        .form-group input::placeholder {
            color: #b5a89a;
        }

        .form-group .error-message {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }

        .form-group .success-message {
            color: #27ae60;
            font-size: 14px;
            margin-top: 8px;
            display: block;
            text-align: center;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: #2d1b0e;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #3f2818;
            transform: translateY(-1px);
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #8a7a6a;
        }

        .back-link a {
            color: #2d1b0e;
            font-weight: 600;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        .decorative {
            position: fixed;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            opacity: 0.04;
            pointer-events: none;
        }

        .decorative-1 {
            top: -80px;
            right: -80px;
            background: #d49b6a;
        }

        .decorative-2 {
            bottom: -80px;
            left: -80px;
            background: #2d1b0e;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 32px 20px;
                margin: 16px;
                border-radius: 16px;
            }

            .logo h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

    <div class="decorative decorative-1"></div>
    <div class="decorative decorative-2"></div>

    <div class="login-container">
        <div class="logo">
            <h1>Flourie <span>BAKERY</span></h1>
            <p>Lupa Kata Sandi? 🔐</p>
        </div>

        <!-- Info Text -->
        <div class="info-text">
            Masukkan alamat email Anda dan kami akan mengirimkan link reset password.
        </div>

        <!-- Session Status (Success Message) -->
        @if (session('status'))
            <div class="form-group">
                <div class="success-message">
                    ✅ {{ session('status') }}
                </div>
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Masukkan alamat email Anda"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-login">Kirim Link Reset Password</button>
        </form>

        <!-- Back to Login -->
        <div class="back-link">
            <a href="{{ route('login') }}">← Kembali ke Login</a>
        </div>
    </div>

</body>
</html>