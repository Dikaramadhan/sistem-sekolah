<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMA Negeri 1 Nusantara — Sekolah Unggulan</title>
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
        }

        /* ── NAVBAR ── */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 20px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.4s ease;
        }

        nav.scrolled {
            background: rgba(26, 26, 26, 0.97);
            padding: 14px 60px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.25);
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .nav-logo-icon {
            width: 42px;
            height: 42px;
            background: var(--dark);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            font-weight: 900;
            color: white;
            font-size: 18px;
        }

        .nav-logo-text {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: white;
            line-height: 1.2;
        }

        .nav-logo-text span {
            display: block;
            font-size: 11px;
            font-weight: 300;
            color: var(--light);
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .nav-links {
            display: flex;
            gap: 36px;
            align-items: center;
            list-style: none;
        }

        .nav-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 14px;
            font-weight: 400;
            letter-spacing: 0.5px;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: white;
        }

        .btn-login {
            background: white;
            color: var(--dark) !important;
            padding: 10px 24px;
            border-radius: 6px;
            font-weight: 600 !important;
            transition: background 0.3s !important;
        }

        .btn-login:hover {
            background: var(--lighter) !important;
        }

        /* ── HERO ── */
        #hero {
            min-height: 100vh;
            background: var(--dark);
            position: relative;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(rgba(4, 4, 4, 0.4), rgba(0, 0, 0, 0.8)),
                url('/img/bg.jpg') center center / cover no-repeat;
            /* background:
                radial-gradient(ellipse at 70% 50%, rgba(255, 255, 255, 0.04) 0%, transparent 60%),
                radial-gradient(ellipse at 10% 80%, rgba(255, 255, 255, 0.03) 0%, transparent 50%); */
        }

        .hero-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.04) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 60px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: var(--light);
            padding: 6px 16px;
            border-radius: 100px;
            font-size: 12px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 24px;
            animation: fadeUp 0.8s ease both;
        }

        .hero-title {
            font-family: 'Poppins', sans-serif;
            font-size: clamp(42px, 5vw, 68px);
            font-weight: 900;
            color: white;
            line-height: 1.1;
            margin-bottom: 24px;
            animation: fadeUp 0.8s 0.1s ease both;
        }

        .hero-title .accent {
            color: var(--light);
        }

        .hero-desc {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.55);
            line-height: 1.8;
            margin-bottom: 40px;
            animation: fadeUp 0.8s 0.2s ease both;
        }

        .hero-actions {
            display: flex;
            gap: 16px;
            animation: fadeUp 0.8s 0.3s ease both;
        }

        .btn-primary-hero {
            background: white;
            color: var(--dark);
            padding: 14px 32px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary-hero:hover {
            background: var(--lighter);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(255, 255, 255, 0.15);
        }

        .btn-outline-hero {
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 14px 32px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 400;
            font-size: 15px;
            transition: all 0.3s;
        }

        .btn-outline-hero:hover {
            border-color: white;
            background: rgba(255, 255, 255, 0.08);
        }

        .hero-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            animation: fadeUp 0.8s 0.4s ease both;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            transition: all 0.3s;
        }

        .stat-card:hover {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(255, 255, 255, 0.25);
            transform: translateY(-4px);
        }

        .stat-number {
            font-family: 'Poppins', sans-serif;
            font-size: 32px;
            font-weight: 900;
            color: white;
            line-height: 1;
        }

        .stat-label {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.45);
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-top: 6px;
        }

        /* ── SECTION UMUM ── */
        section {
            padding: 100px 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 60px;
        }

        .section-tag {
            display: inline-block;
            background: var(--light);
            color: var(--mid);
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 100px;
            margin-bottom: 16px;
        }

        .section-title {
            font-family: 'Poppins', sans-serif;
            font-size: clamp(28px, 3.5vw, 44px);
            font-weight: 700;
            color: var(--black);
            line-height: 1.2;
            margin-bottom: 16px;
        }

        .section-desc {
            font-size: 15px;
            color: var(--mid);
            line-height: 1.8;
            max-width: 560px;
        }

        /* ── PROFIL ── */
        #profil {
            background: var(--white);
        }

        .profil-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }

        .profil-image {
            position: relative;
        }

        .profil-image-main {
            width: 100%;
            aspect-ratio: 4/3;
            background: linear-gradient(135deg, var(--dark) 0%, var(--mid) 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .profil-image-main::after {
            content: '';
            position: absolute;
            inset: 0;
            background: url('/img/bg.jpg') center center / cover no-repeat;
            /* linear-gradient(rgba(11, 31, 58, 0.5), rgba(11, 31, 58, 0.5)),
                url('/img/bg.jpg') center center / cover no-repeat; */
        }

        .profil-image-badge {
            position: absolute;
            bottom: -20px;
            right: -20px;
            background: var(--dark);
            color: white;
            padding: 16px 24px;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 28px;
            font-weight: 900;
            line-height: 1;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .profil-image-badge span {
            display: block;
            font-size: 11px;
            font-weight: 400;
            opacity: 0.7;
            margin-top: 2px;
        }

        .visi-misi {
            margin-top: 32px;
            display: grid;
            gap: 16px;
        }

        .vm-card {
            background: var(--lighter);
            border-left: 4px solid var(--dark);
            padding: 20px 24px;
            border-radius: 0 10px 10px 0;
        }

        .vm-card h4 {
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 700;
            color: var(--black);
            margin-bottom: 6px;
        }

        .vm-card p {
            font-size: 13px;
            color: var(--mid);
            line-height: 1.7;
        }

        /* ── FASILITAS ── */
        #fasilitas {
            background: var(--lighter);
        }

        .fasilitas-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 48px;
        }

        .fasil-card {
            background: var(--white);
            border-radius: 16px;
            padding: 32px;
            transition: all 0.3s;
            border: 1px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .fasil-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--dark);
            transform: scaleX(0);
            transition: transform 0.3s;
            transform-origin: left;
        }

        .fasil-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 48px rgba(0, 0, 0, 0.08);
            border-color: var(--light);
        }

        .fasil-card:hover::before {
            transform: scaleX(1);
        }

        .fasil-icon {
            width: 52px;
            height: 52px;
            background: var(--lighter);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: var(--dark);
            margin-bottom: 20px;
        }

        .fasil-card h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 17px;
            font-weight: 700;
            color: var(--black);
            margin-bottom: 10px;
        }

        .fasil-card p {
            font-size: 13px;
            color: var(--mid);
            line-height: 1.7;
        }

        /* ── GALERI ── */
        #galeri {
            background: var(--dark);
        }

        #galeri .section-title {
            color: white;
        }

        #galeri .section-desc {
            color: rgba(255, 255, 255, 0.5);
        }

        #galeri .section-tag {
            background: rgba(255, 255, 255, 0.1);
            color: var(--light);
        }

        .galeri-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(2, 200px);
            gap: 12px;
            margin-top: 48px;
        }

        .galeri-item {
            border-radius: 12px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
        }

        .galeri-item:first-child {
            grid-column: span 2;
            grid-row: span 2;
        }

        .galeri-item:nth-child(4) {
            grid-column: span 2;
        }

        .galeri-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            transition: transform 0.4s;
        }

        .galeri-item:hover .galeri-placeholder {
            transform: scale(1.05);
        }

        .galeri-item:nth-child(1) .galeri-placeholder {
            background: #2a2a2a;
        }

        .galeri-item:nth-child(2) .galeri-placeholder {
            background: #333333;
        }

        .galeri-item:nth-child(3) .galeri-placeholder {
            background: #3d3d3d;
        }

        .galeri-item:nth-child(4) .galeri-placeholder {
            background: #474747;
        }

        .galeri-item:nth-child(5) .galeri-placeholder {
            background: #555555;
        }

        .galeri-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: flex-end;
            padding: 20px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .galeri-item:hover .galeri-overlay {
            opacity: 1;
        }

        .galeri-overlay span {
            color: white;
            font-size: 13px;
            font-weight: 500;
        }

        /* ── PENGUMUMAN ── */
        #pengumuman {
            background: var(--white);
        }

        .pengumuman-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 48px;
        }

        .pengumuman-card {
            border: 1px solid var(--lighter);
            border-radius: 14px;
            padding: 28px;
            transition: all 0.3s;
        }

        .pengumuman-card:hover {
            border-color: var(--light);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            transform: translateY(-4px);
        }

        .pengumuman-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .pengumuman-badge {
            font-size: 10px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 100px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .badge-urgent {
            background: #2a2a2a;
            color: white;
        }

        .badge-penting {
            background: var(--light);
            color: var(--dark);
        }

        .badge-biasa {
            background: var(--lighter);
            color: var(--mid);
        }

        .pengumuman-date {
            font-size: 11px;
            color: var(--gray);
        }

        .pengumuman-card h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 700;
            color: var(--black);
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .pengumuman-card p {
            font-size: 13px;
            color: var(--mid);
            line-height: 1.7;
        }

        /* ── KONTAK ── */
        #kontak {
            background: var(--lighter);
        }

        .kontak-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: start;
        }

        .kontak-info {
            display: grid;
            gap: 24px;
            margin-top: 32px;
        }

        .kontak-item {
            display: flex;
            gap: 16px;
            align-items: flex-start;
        }

        .kontak-icon {
            width: 44px;
            height: 44px;
            background: var(--dark);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
            flex-shrink: 0;
        }

        .kontak-item h4 {
            font-size: 13px;
            font-weight: 600;
            color: var(--black);
            margin-bottom: 4px;
        }

        .kontak-item p {
            font-size: 13px;
            color: var(--mid);
            line-height: 1.6;
        }

        .kontak-form {
            background: var(--white);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
        }

        .kontak-form h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--black);
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 6px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--light);
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            color: var(--black);
            background: var(--lighter);
            transition: border-color 0.3s;
            outline: none;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--dark);
            background: white;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .btn-submit {
            width: 100%;
            background: var(--dark);
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: var(--mid);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        /* ── FOOTER ── */
        footer {
            background: var(--black);
            padding: 60px 0 30px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 60px;
            padding-bottom: 40px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .footer-brand p {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.45);
            line-height: 1.8;
            margin-top: 16px;
            max-width: 280px;
        }

        .footer-col h4 {
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: white;
            margin-bottom: 16px;
            letter-spacing: 0.5px;
        }

        .footer-col ul {
            list-style: none;
            display: grid;
            gap: 10px;
        }

        .footer-col ul a {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.45);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-col ul a:hover {
            color: white;
        }

        .footer-bottom {
            padding-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-bottom p {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.25);
        }

        .footer-bottom a {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            nav {
                padding: 16px 24px;
            }

            nav.scrolled {
                padding: 12px 24px;
            }

            .nav-links {
                display: none;
            }

            .hero-content {
                grid-template-columns: 1fr;
                padding: 0 24px;
                gap: 48px;
            }

            .hero-stats {
                grid-template-columns: repeat(3, 1fr);
            }

            .container {
                padding: 0 24px;
            }

            section {
                padding: 70px 0;
            }

            .profil-grid,
            .kontak-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .fasilitas-grid {
                grid-template-columns: 1fr;
            }

            .galeri-grid {
                grid-template-columns: repeat(2, 1fr);
                grid-template-rows: auto;
            }

            .galeri-item:first-child {
                grid-column: span 2;
                grid-row: span 1;
            }

            .galeri-item:nth-child(4) {
                grid-column: span 1;
            }

            .pengumuman-grid {
                grid-template-columns: 1fr;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 32px;
            }
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    <nav id="navbar">
        <a href="#" class="nav-logo">
            <div class="nav-logo-icon">S</div>
            <div class="nav-logo-text">
                SMA Negeri 1 Nusantara
                <span>Sekolah Unggulan</span>
            </div>
        </a>
        <ul class="nav-links">
            <li><a href="#profil">Profil</a></li>
            <li><a href="#fasilitas">Fasilitas</a></li>
            <li><a href="#galeri">Galeri</a></li>
            <li><a href="#pengumuman">Pengumuman</a></li>
            <li><a href="#kontak">Kontak</a></li>
            <li><a href="{{ route('login') }}" class="btn-login">Masuk</a></li>
        </ul>
    </nav>

    {{-- HERO --}}
    <section id="hero">
        <div class="hero-bg"></div>
        <div class="hero-grid"></div>
        <div class="hero-content">
            <div>
                <div class="hero-badge">
                    <i class="fas fa-star" style="font-size:10px"></i>
                    Sekolah Terakreditasi A
                </div>
                <h1 class="hero-title">
                    Membentuk <span class="accent">Generasi</span><br>
                    Unggul & Berkarakter
                </h1>
                <p class="hero-desc">
                    SMA Negeri 1 Nusantara berkomitmen menghadirkan pendidikan berkualitas tinggi
                    yang mempersiapkan siswa menghadapi tantangan masa depan dengan ilmu,
                    iman, dan integritas.
                </p>
                <div class="hero-actions">
                    <a href="#profil" class="btn-primary-hero">
                        <i class="fas fa-book-open"></i> Kenali Kami
                    </a>
                    <a href="{{ route('login') }}" class="btn-outline-hero">
                        Masuk Sistem
                    </a>
                </div>
            </div>
            <div>
                <div class="hero-stats">
                    <div class="stat-card">
                        <div class="stat-number">1.200+</div>
                        <div class="stat-label">Siswa Aktif</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">80+</div>
                        <div class="stat-label">Tenaga Pendidik</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">25+</div>
                        <div class="stat-label">Tahun Berdiri</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">98%</div>
                        <div class="stat-label">Kelulusan</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">Prestasi</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">A</div>
                        <div class="stat-label">Akreditasi</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- PROFIL --}}
    <section id="profil">
        <div class="container">
            <div class="profil-grid">
                <div class="profil-image reveal">
                    <div class="profil-image-main">
                        <i class="fas fa-school"
                            style="font-size:100px; color:rgba(255,255,255,0.15); position:relative; z-index:1"></i>
                    </div>
                    <div class="profil-image-badge">
                        2000
                        <span>Berdiri sejak</span>
                    </div>
                </div>
                <div class="reveal">
                    <span class="section-tag">Tentang Kami</span>
                    <h2 class="section-title">Profil Sekolah</h2>
                    <p class="section-desc">
                        SMA Negeri 1 Nusantara adalah sekolah menengah atas negeri yang berlokasi di
                        Jl. Pendidikan No. 1, Kota Nusantara. Didirikan pada tahun 2000, sekolah ini
                        telah mencetak ribuan alumni berprestasi di berbagai bidang.
                    </p>
                    <div class="visi-misi">
                        <div class="vm-card">
                            <h4><i class="fas fa-eye" style="margin-right:6px"></i>Visi</h4>
                            <p>Menjadi sekolah unggul yang menghasilkan lulusan beriman, berilmu, berkarakter, dan
                                berdaya saing global.</p>
                        </div>
                        <div class="vm-card">
                            <h4><i class="fas fa-bullseye" style="margin-right:6px"></i>Misi</h4>
                            <p>Menyelenggarakan pendidikan berkualitas, membangun karakter mulia, mengembangkan potensi
                                siswa secara optimal, dan menjalin kerjasama dengan berbagai pihak.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FASILITAS --}}
    <section id="fasilitas">
        <div class="container">
            <div class="reveal">
                <span class="section-tag">Sarana & Prasarana</span>
                <h2 class="section-title">Fasilitas Unggulan</h2>
                <p class="section-desc">Kami menyediakan fasilitas lengkap dan modern untuk mendukung proses belajar
                    mengajar yang optimal.</p>
            </div>
            <div class="fasilitas-grid">
                @php
                    $fasilitas = [
                        [
                            'icon' => 'fas fa-laptop-code',
                            'nama' => 'Lab Komputer',
                            'desc' =>
                                '3 laboratorium komputer dengan spesifikasi terkini dan koneksi internet berkecepatan tinggi.',
                        ],
                        [
                            'icon' => 'fas fa-flask',
                            'nama' => 'Lab Sains',
                            'desc' =>
                                'Laboratorium fisika, kimia, dan biologi lengkap dengan peralatan eksperimen modern.',
                        ],
                        [
                            'icon' => 'fas fa-book',
                            'nama' => 'Perpustakaan',
                            'desc' => 'Koleksi lebih dari 10.000 buku pelajaran, referensi, dan literatur ilmiah.',
                        ],
                        [
                            'icon' => 'fas fa-running',
                            'nama' => 'Lapangan Olahraga',
                            'desc' => 'Lapangan basket, voli, dan area olahraga multifungsi yang representatif.',
                        ],
                        [
                            'icon' => 'fas fa-music',
                            'nama' => 'Ruang Kesenian',
                            'desc' => 'Studio musik, ruang tari, dan galeri seni untuk mengembangkan bakat siswa.',
                        ],
                        [
                            'icon' => 'fas fa-wifi',
                            'nama' => 'Konektivitas',
                            'desc' => 'WiFi tersedia di seluruh area sekolah untuk mendukung pembelajaran digital.',
                        ],
                    ];
                @endphp
                @foreach ($fasilitas as $f)
                    <div class="fasil-card reveal">
                        <div class="fasil-icon"><i class="{{ $f['icon'] }}"></i></div>
                        <h3>{{ $f['nama'] }}</h3>
                        <p>{{ $f['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- GALERI --}}
    <section id="galeri">
        <div class="container">
            <div class="reveal">
                <span class="section-tag">Galeri</span>
                <h2 class="section-title">Momen Berharga</h2>
                <p class="section-desc">Dokumentasi kegiatan dan kehidupan sekolah yang penuh semangat.</p>
            </div>
            <div class="galeri-grid reveal">
                @php
                    $galeriItems = [
                        ['img' => 'gedung.jpg', 'label' => 'Gedung Sekolah'],
                        ['img' => 'asset-1.jpg', 'label' => 'asset-1'],
                        ['img' => 'asset-2.jpg', 'label' => 'asset-2'],
                        // ['img' => 'asset-3.jpg', 'label' => 'asset-3'],
                        ['img' => 'asset-4.jpg', 'label' => 'asset-4'],
                    ];
                @endphp

                @foreach ($galeriItems as $g)
                    <div class="galeri-item">
                        <div class="galeri-placeholder">
                            <img src="{{ asset('img/' . $g['img']) }}" alt="{{ $g['label'] }}"
                                style="width:100%; height:100%; object-fit:cover; display:block;">
                        </div>
                        <div class="galeri-overlay">
                            <span>{{ $g['label'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- PENGUMUMAN --}}
    <section id="pengumuman">
        <div class="container">
            <div class="reveal" style="display:flex; justify-content:space-between; align-items:flex-end">
                <div>
                    <span class="section-tag">Info Terkini</span>
                    <h2 class="section-title">Pengumuman</h2>
                </div>
                @auth
                    <a href="{{ url('/' . auth()->user()->role . '/dashboard') }}"
                        style="font-size:13px; color:var(--dark); text-decoration:none; font-weight:500">
                        Lihat semua <i class="fas fa-arrow-right"></i>
                    </a>
                @endauth
            </div>
            <div class="pengumuman-grid">
                @php
                    $pengumumanList = \App\Models\Pengumuman::where('aktif', true)->latest()->take(3)->get();
                @endphp
                @forelse($pengumumanList as $p)
                    <div class="pengumuman-card reveal">
                        <div class="pengumuman-meta">
                            <span
                                class="pengumuman-badge badge-{{ strtolower($p->prioritas) }}">{{ $p->prioritas }}</span>
                            <span class="pengumuman-date">{{ $p->created_at->format('d M Y') }}</span>
                        </div>
                        <h3>{{ $p->judul }}</h3>
                        <p>{{ Str::limit($p->isi, 100) }}</p>
                    </div>
                @empty
                    <div class="pengumuman-card reveal"
                        style="grid-column:span 3; text-align:center; color:var(--gray)">
                        <i class="far fa-bell-slash"
                            style="font-size:32px; margin-bottom:12px; display:block; opacity:0.3"></i>
                        Belum ada pengumuman terbaru.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- KONTAK --}}
    <section id="kontak">
        <div class="container">
            <div class="kontak-grid">
                <div class="reveal">
                    <span class="section-tag">Hubungi Kami</span>
                    <h2 class="section-title">Informasi Kontak</h2>
                    <p class="section-desc">Kami siap membantu menjawab pertanyaan Anda seputar penerimaan siswa dan
                        informasi sekolah.</p>
                    <div class="kontak-info">
                        <div class="kontak-item">
                            <div class="kontak-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div>
                                <h4>Alamat</h4>
                                <p>Jl. Pendidikan No. 1, Kota Nusantara,<br>Provinsi Nusantara 12345</p>
                            </div>
                        </div>
                        <div class="kontak-item">
                            <div class="kontak-icon"><i class="fas fa-phone"></i></div>
                            <div>
                                <h4>Telepon</h4>
                                <p>(021) 1234-5678</p>
                            </div>
                        </div>
                        <div class="kontak-item">
                            <div class="kontak-icon"><i class="fas fa-envelope"></i></div>
                            <div>
                                <h4>Email</h4>
                                <p>info@sman1nusantara.sch.id</p>
                            </div>
                        </div>
                        <div class="kontak-item">
                            <div class="kontak-icon"><i class="fas fa-clock"></i></div>
                            <div>
                                <h4>Jam Operasional</h4>
                                <p>Senin – Jumat: 07.00 – 15.00 WIB<br>Sabtu: 07.00 – 12.00 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kontak-form reveal">
                    <h3>Kirim Pesan</h3>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" placeholder="Masukkan nama lengkap">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" placeholder="contoh@email.com">
                    </div>
                    <div class="form-group">
                        <label>Pesan</label>
                        <textarea placeholder="Tuliskan pesan Anda..."></textarea>
                    </div>
                    <button class="btn-submit">
                        <i class="fas fa-paper-plane"></i> Kirim Pesan
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="#" class="nav-logo" style="text-decoration:none">
                        <div class="nav-logo-icon">S</div>
                        <div class="nav-logo-text">
                            SMA Negeri 1 Nusantara
                            <span>Sekolah Unggulan</span>
                        </div>
                    </a>
                    <p>Berkomitmen menghadirkan pendidikan berkualitas yang membentuk generasi unggul dan berkarakter.
                    </p>
                </div>
                <div class="footer-col">
                    <h4>Menu</h4>
                    <ul>
                        <li><a href="#profil">Profil Sekolah</a></li>
                        <li><a href="#fasilitas">Fasilitas</a></li>
                        <li><a href="#galeri">Galeri</a></li>
                        <li><a href="#pengumuman">Pengumuman</a></li>
                        <li><a href="#kontak">Kontak</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Akses Cepat</h4>
                    <ul>
                        <li><a href="{{ route('login') }}">Login Siswa</a></li>
                        <li><a href="{{ route('login') }}">Login Guru</a></li>
                        <li><a href="{{ route('login') }}">Login Admin</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} SMA Negeri 1 Nusantara. All rights reserved.</p>
                <p>Sistem Informasi Sekolah by <a href="#">Dev Team</a></p>
            </div>
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', () => {
            document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 50);
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), i * 80);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });
    </script>

</body>

</html>
