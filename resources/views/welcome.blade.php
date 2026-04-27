<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LA MAVERICK BASKETBALL</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #333;
        }

        .navbar {
            background: #1e3a5f;
            color: white;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .navbar .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 500;
        }

        .navbar .nav-links a:hover {
            text-decoration: underline;
        }

        .hero {
            background: linear-gradient(rgba(30, 58, 95, 0.85), rgba(30, 58, 95, 0.85)),
                        url('https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&w=1400&q=80') center/cover no-repeat;
            color: white;
            text-align: center;
            padding: 100px 20px;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero p {
            max-width: 800px;
            margin: 0 auto 30px;
            font-size: 18px;
            line-height: 1.6;
        }

        .hero-buttons a {
            display: inline-block;
            margin: 10px;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-primary {
            background: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background: #2980b9;
        }

        .btn-secondary {
            background: white;
            color: #1e3a5f;
        }

        .btn-secondary:hover {
            background: #ecf0f1;
        }

        .section {
            padding: 60px 40px;
            max-width: 1200px;
            margin: auto;
        }

        .section-title {
            text-align: center;
            font-size: 32px;
            color: #1e3a5f;
            margin-bottom: 40px;
        }

        .features,
        .roles {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .card h3 {
            color: #1e3a5f;
            margin-bottom: 15px;
        }

        .card p {
            line-height: 1.6;
            color: #555;
        }

        .about {
            background: white;
            border-radius: 12px;
            padding: 30px;
            line-height: 1.8;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .footer {
            background: #1e3a5f;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }

            .hero h1 {
                font-size: 34px;
            }

            .hero p {
                font-size: 16px;
            }

            .section {
                padding: 40px 20px;
            }
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="logo">LA MAVERICK BASKETBALL</div>
        <div class="nav-links">
            <a href="#about">Tentang</a>
            <a href="#features">Fitur</a>
            <a href="#roles">Role</a>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        </div>
    </div>

    <section class="hero">
        <h1>LA MAVERICK BASKETBALL</h1>
        <p>
            Website ini dirancang untuk membantu admin, pelatih, dan pemain dalam mengelola data pemain,
            memantau presensi latihan, menilai performa, serta melihat perkembangan pemain secara periodik.
        </p>

        <div class="hero-buttons">
            <a href="{{ route('login') }}" class="btn-primary">Mulai Sekarang</a>
            <a href="{{ route('register') }}" class="btn-secondary">Daftar Pemain</a>
        </div>
    </section>

    <section class="section" id="about">
        <h2 class="section-title">Tentang Sistem</h2>
        <div class="about">
            Sistem ini dibuat untuk mendukung proses pengelolaan dan evaluasi pemain basket secara lebih terstruktur.
            Admin dapat mengelola seluruh data utama sistem, pelatih dapat menilai performa serta melihat perkembangan pemain,
            dan pemain dapat memantau hasil latihan serta perkembangan performa dirinya sendiri.
        </div>
    </section>

    <section class="section" id="features">
        <h2 class="section-title">Fitur Utama</h2>
        <div class="features">
            <div class="card">
                <h3>Manajemen Data</h3>
                <p>Mengelola data pemain, pelatih, dan latihan dengan sistem berbasis web yang rapi dan mudah digunakan.</p>
            </div>

            <div class="card">
                <h3>Presensi Latihan</h3>
                <p>Mencatat kehadiran pemain pada setiap sesi latihan, termasuk hadir, izin, sakit, dan alpha.</p>
            </div>

            <div class="card">
                <h3>Penilaian Performa</h3>
                <p>Menyimpan hasil evaluasi pemain berdasarkan aspek stamina, speed, shooting, passing, dribbling, dan defense.</p>
            </div>

            <div class="card">
                <h3>Grafik & Laporan</h3>
                <p>Menampilkan grafik perkembangan pemain dan laporan performa untuk mendukung evaluasi berkala.</p>
            </div>
        </div>
    </section>

    <section class="section" id="roles">
        <h2 class="section-title">Role Pengguna</h2>
        <div class="roles">
            <div class="card">
                <h3>Admin</h3>
                <p>
                    Admin memiliki akses penuh untuk mengelola data pemain, data pelatih, latihan, presensi,
                    performa, serta melihat dashboard ringkasan sistem.
                </p>
            </div>

            <div class="card">
                <h3>Pelatih</h3>
                <p>
                    Pelatih dapat melihat data pemain, menginput presensi, menilai performa pemain,
                    dan memantau grafik perkembangan pemain.
                </p>
            </div>

            <div class="card">
                <h3>Pemain</h3>
                <p>
                    Pemain dapat melihat profil pribadi, riwayat presensi, hasil performa,
                    serta grafik perkembangan dirinya sendiri.
                </p>
            </div>
        </div>
    </section>

    <div class="footer">
        &copy; {{ date('Y') }} Basket Monitoring System | LA MAVERICK BASKETBALL
    </div>

</body>
</html>