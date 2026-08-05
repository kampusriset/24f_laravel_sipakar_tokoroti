<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flourie BAKERY - Login</title>

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

        .forgot-password {
            text-align: right;
            margin-bottom: 24px;
        }

        .forgot-password a {
            font-size: 13px;
            color: #d49b6a;
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-password a:hover {
            text-decoration: underline;
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

        .register-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #8a7a6a;
        }

        .register-link a {
            color: #2d1b0e;
            font-weight: 600;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 24px 0;
            color: #b5a89a;
            font-size: 12px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e8e0d8;
        }

        .divider span {
            padding: 0 16px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 500;
        }

        .btn-google {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            padding: 12px;
            border: 1.5px solid #e8e0d8;
            border-radius: 12px;
            text-decoration: none;
            color: #2d1b0e;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #fcfaf8;
            cursor: pointer;
        }

        .btn-google:hover {
            background: #f5f0eb;
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
            <p>Selamat datang kembali! 👋</p>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email / No Hp</label>
                <input
                    type="text"
                    id="email"
                    name="email"
                    placeholder="Masukkan Email atau Nomor Hp"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
                @error('email')
                    <small style="color:#e74c3c;font-size:12px;margin-top:4px;display:block;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan Kata Sandi"
                    required
                >
                @error('password')
                    <small style="color:#e74c3c;font-size:12px;margin-top:4px;display:block;">{{ $message }}</small>
                @enderror
            </div>

            <div class="forgot-password">
                <a href="{{ route('password.request') }}">Lupa Kata Sandi</a>
            </div>

            <button type="submit" class="btn-login">Masuk</button>
        </form>

        <div class="register-link">
            Hubungi Administrator jika Anda belum memiliki akun.
        </div>

        <div class="divider">
            <span>atau</span>
        </div>

        <a href="{{ route('google.login') }}" class="btn-google">
            <svg width="20" height="20" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
            </svg>
            Login dengan Google
        </a>
    </div>

</body>
</html>