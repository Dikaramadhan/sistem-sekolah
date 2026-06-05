<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Sistem Informasi Sekolah</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --dark: #1A1A1A;
            --mid: #4A4A4A;
            --gray: #8A8A8A;
            --light: #D4D4D4;
            --lighter: #EFEFEF;
            --white: #FFFFFF;
            --black: #111111;
            --accent: #D4D4D4;
            --accent-light: #D4D4D4;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--lighter);
            color: var(--black);
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
        }

        /* ── LEFT PANEL ── */
        .left-panel {
            flex: 1;
            position: relative;
            overflow: hidden;
        }

        .left-panel-bg {
            position: absolute;
            inset: 0;
            background: url('{{ asset('img/bg.jpg') }}') center center / cover no-repeat;
        }

        .left-panel-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg,
                    rgba(26, 26, 26, 0.80) 0%,
                    rgba(26, 26, 26, 0.50) 50%,
                    rgba(26, 26, 26, 0.70) 100%);
        }

        .left-panel-content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px;
        }

        .left-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .left-logo-icon {
            width: 44px;
            height: 44px;
            background: var(--black);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: var(--white);
            font-size: 20px;
        }

        .left-logo-text {
            font-size: 16px;
            font-weight: 600;
            color: var(--white);
            line-height: 1.2;
        }

        .left-logo-text span {
            display: block;
            font-size: 10px;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.55);
            letter-spacing: 2.5px;
            text-transform: uppercase;
        }

        .left-hero {
            max-width: 480px;
        }

        .left-hero h1 {
            font-size: clamp(30px, 3.5vw, 50px);
            font-weight: 700;
            color: var(--white);
            line-height: 1.2;
            margin-bottom: 16px;
        }

        .left-hero h1 .accent {
            color: var(--accent-light);
        }

        .left-hero p {
            font-size: 14px;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.6);
            line-height: 1.9;
        }

        .left-stats {
            display: flex;
            gap: 32px;
        }

        .left-stat {
            text-align: center;
        }

        .left-stat-num {
            font-size: 28px;
            font-weight: 700;
            color: var(--accent-light);
            line-height: 1;
        }

        .left-stat-lbl {
            font-size: 10px;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.45);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-top: 4px;
        }

        /* ── RIGHT PANEL ── */
        .right-panel {
            width: 460px;
            flex-shrink: 0;
            background: var(--white);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 48px;
            position: relative;
            overflow-y: auto;
        }

        .right-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 3px;
            height: 100%;
            background: linear-gradient(180deg, var(--accent), var(--accent-light), var(--accent));
        }

        .form-header {
            margin-bottom: 36px;
        }

        .form-header .tag {
            display: inline-block;
            background: rgba(201, 147, 58, 0.1);
            color: var(--accent);
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 5px 12px;
            border-radius: 100px;
            margin-bottom: 14px;
        }

        .form-header h2 {
            font-size: 26px;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.25;
            margin-bottom: 6px;
        }

        .form-header p {
            font-size: 13px;
            font-weight: 300;
            color: var(--gray);
        }

        /* Alert */
        .alert-error {
            background: #FEE2E2;
            border: 1px solid #FCA5A5;
            border-radius: 8px;
            padding: 11px 14px;
            font-size: 12px;
            color: #DC2626;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .alert-success {
            background: #D1FAE5;
            border: 1px solid #6EE7B7;
            border-radius: 8px;
            padding: 11px 14px;
            font-size: 12px;
            color: #065F46;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Form */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 7px;
            letter-spacing: 0.3px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap i.icon-left {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--light);
            font-size: 14px;
            pointer-events: none;
        }

        .input-wrap input {
            width: 100%;
            padding: 12px 16px 12px 40px;
            border: 1.5px solid var(--lighter);
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 400;
            color: var(--dark);
            background: var(--lighter);
            outline: none;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        }

        .input-wrap input:focus {
            border-color: var(--accent);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(201, 147, 58, 0.1);
        }

        .input-wrap input:focus+.icon-right,
        .input-wrap input:focus~i.icon-left {
            color: var(--accent);
        }

        .input-wrap input.is-invalid {
            border-color: #EF4444;
            background: #FFF5F5;
        }

        .toggle-password {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            cursor: pointer;
            font-size: 14px;
            background: none;
            border: none;
            padding: 0;
            transition: color 0.2s;
        }

        .toggle-password:hover {
            color: var(--accent);
        }

        .invalid-feedback {
            font-size: 11px;
            color: #EF4444;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Remember */
        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 26px;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .remember-label input[type="checkbox"] {
            width: 15px;
            height: 15px;
            accent-color: var(--accent);
            cursor: pointer;
        }

        .remember-label span {
            font-size: 12px;
            font-weight: 400;
            color: var(--gray);
        }

        .forgot-link {
            font-size: 12px;
            font-weight: 500;
            color: var(--accent);
            text-decoration: none;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: var(--dark);
        }

        /* Submit */
        .btn-submit {
            width: 100%;
            background: var(--dark);
            color: var(--white);
            padding: 13px;
            border: none;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            letter-spacing: 0.3px;
        }

        .btn-submit:hover {
            background: var(--accent);
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(201, 147, 58, 0.25);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0 20px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--lighter);
        }

        .divider span {
            font-size: 11px;
            color: var(--gray);
            white-space: nowrap;
            font-weight: 300;
        }

        /* Role badges */
        .role-badges {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .role-badge {
            display: flex;
            align-items: center;
            gap: 6px;
            background: var(--lighter);
            border: 1px solid var(--light);
            border-radius: 100px;
            padding: 6px 14px;
            font-size: 11px;
            font-weight: 400;
            color: var(--mid);
            transition: all 0.2s;
        }

        .role-badge:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .role-badge i {
            font-size: 11px;
        }

        /* Footer */
        .form-footer {
            margin-top: 28px;
            text-align: center;
            font-size: 11px;
            font-weight: 300;
            color: var(--gray);
        }

        .form-footer a {
            color: var(--dark);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .form-footer a:hover {
            color: var(--accent);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .left-panel {
                display: none;
            }

            .right-panel {
                width: 100%;
                padding: 40px 28px;
            }
        }
    </style>
</head>

<body>

    {{-- LEFT PANEL --}}
    <div class="left-panel">
        <div class="left-panel-bg"></div>
        <div class="left-panel-overlay"></div>
        <div class="left-panel-content">

            <a href="{{ url('/') }}" class="left-logo">
                <div class="left-logo-icon">S</div>
                <div class="left-logo-text">
                    SMA Negeri 1 Nusantara
                    <span>Sistem Informasi</span>
                </div>
            </a>

            <div class="left-hero">
                <h1>
                    Selamat Datang di<br>
                    Portal <span class="accent">Akademik</span><br>
                    Sekolah
                </h1>
                <p>
                    Akses informasi akademik, jadwal pelajaran,<br>
                    nilai, dan absensi secara mudah dan real-time.
                </p>
            </div>

            <div class="left-stats">
                <div class="left-stat">
                    <div class="left-stat-num">1.200+</div>
                    <div class="left-stat-lbl">Siswa</div>
                </div>
                <div class="left-stat">
                    <div class="left-stat-num">80+</div>
                    <div class="left-stat-lbl">Guru</div>
                </div>
                <div class="left-stat">
                    <div class="left-stat-num">98%</div>
                    <div class="left-stat-lbl">Kelulusan</div>
                </div>
            </div>

        </div>
    </div>

    {{-- RIGHT PANEL --}}
    <div class="right-panel">

        <div class="form-header">
            <span class="tag">Portal Akademik</span>
            <h2>Masuk ke Akun Anda</h2>
            <p>Gunakan email dan password yang terdaftar</p>
        </div>

        @if (session('status'))
            <div class="alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                <i class="fas fa-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope icon-left"></i>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        placeholder="contoh@email.com" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" required
                        autofocus autocomplete="username">
                </div>
                @error('email')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <i class="fas fa-lock icon-left"></i>
                    <input type="password" id="password" name="password" placeholder="Masukkan password"
                        class="{{ $errors->has('password') ? 'is-invalid' : '' }}" required
                        autocomplete="current-password">
                    <button type="button" class="toggle-password" onclick="togglePassword()">
                        <i class="fas fa-eye" id="eye-icon"></i>
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Remember + Forgot --}}
            <div class="remember-row">
                <label class="remember-label">
                    <input type="checkbox" name="remember" id="remember_me">
                    <span>Ingat saya</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">
                        Lupa password?
                    </a>
                @endif
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-submit">
                <i class="fas fa-sign-in-alt"></i>
                Masuk Sekarang
            </button>

        </form>

        <div class="divider"><span>Login tersedia untuk</span></div>

        <div class="role-badges">
            <div class="role-badge">
                <i class="fas fa-user-shield" style="color:var(--accent)"></i>
                Admin
            </div>
            <div class="role-badge">
                <i class="fas fa-chalkboard-teacher" style="color:var(--dark)"></i>
                Guru
            </div>
            <div class="role-badge">
                <i class="fas fa-user-graduate" style="color:#059669"></i>
                Siswa
            </div>
        </div>

        <div class="form-footer">
            <a href="{{ url('/') }}">
                <i class="fas fa-arrow-left" style="font-size:9px; margin-right:4px"></i>
                Kembali ke halaman utama
            </a>
        </div>

    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>

</body>

</html>
