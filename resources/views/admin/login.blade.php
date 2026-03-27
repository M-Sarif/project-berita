<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Puspresma PTMA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --blue-dark:  #0d2b6e;
            --blue:       #1a4ab5;
            --blue-light: #3b6fd4;
            --accent:     #f97316;
            --white:      #ffffff;
            --gray-50:    #f8fafc;
            --gray-100:   #f1f5f9;
            --gray-200:   #e2e8f0;
            --gray-400:   #94a3b8;
            --gray-600:   #475569;
            --gray-800:   #1e293b;
            --error:      #ef4444;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--blue-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            position: relative;
            overflow: hidden;
        }

        /* Background decorative circles */
        body::before, body::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            opacity: 0.08;
        }
        body::before {
            width: 600px; height: 600px;
            background: var(--blue-light);
            top: -200px; right: -150px;
        }
        body::after {
            width: 400px; height: 400px;
            background: var(--accent);
            bottom: -150px; left: -100px;
        }

        .login-card {
            background: var(--white);
            border-radius: 20px;
            padding: 3rem 2.5rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.35);
            position: relative;
            z-index: 1;
            animation: slideUp 0.5s ease;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .login-logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-logo .logo-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 64px; height: 64px;
            background: var(--blue-dark);
            border-radius: 16px;
            margin-bottom: 1rem;
        }

        .login-logo .logo-icon svg {
            width: 36px; height: 36px; fill: white;
        }

        .login-logo h1 {
            font-size: 1.375rem;
            font-weight: 700;
            color: var(--blue-dark);
            letter-spacing: -0.3px;
        }

        .login-logo p {
            font-size: 0.8125rem;
            color: var(--gray-400);
            margin-top: 0.25rem;
        }

        .divider {
            height: 1px;
            background: var(--gray-200);
            margin: 1.75rem 0;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--gray-600);
            margin-bottom: 0.5rem;
            letter-spacing: 0.3px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px; height: 16px;
            color: var(--gray-400);
            pointer-events: none;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.75rem;
            border: 1.5px solid var(--gray-200);
            border-radius: 10px;
            font-family: inherit;
            font-size: 0.9375rem;
            color: var(--gray-800);
            background: var(--gray-50);
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        input:focus {
            border-color: var(--blue);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(26,74,181,0.12);
        }

        input.is-invalid {
            border-color: var(--error);
            background: #fff5f5;
        }

        .invalid-feedback {
            color: var(--error);
            font-size: 0.75rem;
            margin-top: 0.375rem;
        }

        .alert {
            padding: 0.875rem 1rem;
            border-radius: 10px;
            font-size: 0.875rem;
            margin-bottom: 1.25rem;
        }

        .alert-danger {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .alert-success {
            background: #f0fdf4;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .remember-row input[type="checkbox"] {
            width: 16px; height: 16px;
            accent-color: var(--blue);
            cursor: pointer;
            padding: 0;
        }

        .remember-row label {
            margin: 0;
            font-size: 0.875rem;
            color: var(--gray-600);
            cursor: pointer;
            font-weight: 500;
        }

        .btn-login {
            width: 100%;
            padding: 0.875rem;
            background: var(--blue-dark);
            color: white;
            border: none;
            border-radius: 10px;
            font-family: inherit;
            font-size: 0.9375rem;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: 0.3px;
            transition: background 0.2s, transform 0.1s;
        }

        .btn-login:hover  { background: var(--blue); }
        .btn-login:active { transform: scale(0.98); }

        .login-footer {
            text-align: center;
            margin-top: 1.75rem;
            font-size: 0.75rem;
            color: var(--gray-400);
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-logo">
        <div class="logo-icon">
            {{-- Logo PTMA sederhana menggunakan SVG --}}
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
            </svg>
        </div>
        <h1>Puspresma PTMA</h1>
        <p>Panel Administrator</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <div class="input-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="admin@example.com"
                    autocomplete="email"
                    class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                    required
                >
            </div>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="••••••••"
                    autocomplete="current-password"
                    required
                >
            </div>
        </div>

        <div class="remember-row">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Ingat saya</label>
        </div>

        <button type="submit" class="btn-login">Masuk ke Dashboard</button>
    </form>

    <div class="login-footer">
        &copy; {{ date('Y') }} Puspresma PTMA. Hak akses terbatas.
    </div>
</div>

</body>
</html>
