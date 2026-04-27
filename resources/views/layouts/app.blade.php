<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basket Monitoring System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
        }

        .header {
            height: 60px;
            background-color: #1e3a5f;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 25px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .header .title {
            font-size: 20px;
            font-weight: bold;
        }

        .header .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logout-btn {
            background-color: #e74c3c;
            border: none;
            color: white;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }

        .main {
            display: flex;
            min-height: calc(100vh - 60px);
        }

        .sidebar {
            width: 230px;
            background-color: #243447;
            color: white;
            padding: 20px 0;
        }

        .sidebar h3 {
            padding: 0 20px 15px;
            font-size: 18px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 15px;
        }

        .sidebar a {
            display: block;
            color: #ecf0f1;
            text-decoration: none;
            padding: 12px 20px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #1b2836;
            padding-left: 28px;
        }

        .content {
            flex: 1;
            padding: 25px;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .page-title {
            margin-bottom: 20px;
            color: #1e3a5f;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background-color: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-warning {
            background-color: #f39c12;
            color: white;
        }

        .btn-warning:hover {
            background-color: #d68910;
        }

        .btn-danger {
            background-color: #e74c3c;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        .btn-secondary {
            background-color: #7f8c8d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #616a6b;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            background: white;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        table th {
            background-color: #1e3a5f;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .button-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .inline-form {
            display: inline;
        }

        .text-muted {
            color: #666;
        }
        .stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.stat-card {
    background: white;
    border-left: 5px solid #3498db;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.stat-card h3 {
    font-size: 16px;
    color: #555;
    margin-bottom: 10px;
}

.stat-card p {
    font-size: 28px;
    font-weight: bold;
    color: #1e3a5f;
}

.profile-card {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
    margin-top: 10px;
}

.profile-row {
    display: grid;
    grid-template-columns: 250px 1fr;
    border-bottom: 1px solid #eee;
}

.profile-row:last-child {
    border-bottom: none;
}

.profile-label {
    background-color: #1e3a5f;
    color: white;
    font-weight: bold;
    padding: 14px 16px;
}

.profile-value {
    background-color: #fff;
    padding: 14px 16px;
    color: #333;
}
    </style>
</head>
<body>

    <div class="header">
        <div class="title">Basket Monitoring System</div>

        <div class="user-info">
            <span>{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <div class="main">
        <div class="sidebar">
            @if(auth()->user()->role == 'admin')
                <h3>Menu Admin</h3>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.pemain.index') }}">Data Pemain</a>
                <a href="{{ route('admin.pelatih.index') }}">Data Pelatih</a>
                <a href="{{ route('admin.latihan.index') }}">Data Latihan</a>
                <a href="{{ route('admin.presensi.index') }}">Presensi</a>
                <a href="{{ route('admin.performa.index') }}">Performa</a>
                <a href="{{ route('admin.performa.grafik') }}">Grafik Performa</a>
                <a href="{{ route('admin.laporan.performa') }}">Laporan Performa</a>
           @elseif(auth()->user()->role == 'pelatih')
                <h3>Menu Pelatih</h3>
                <a href="{{ route('pelatih.dashboard') }}">Dashboard</a>
                <a href="{{ route('pelatih.pemain') }}">Data Pemain</a>
                <a href="{{ route('pelatih.presensi') }}">Presensi</a>
                <a href="{{ route('pelatih.performa') }}">Input Performa</a>
                <a href="{{ route('pelatih.grafik') }}">Grafik Pemain</a>
                <a href="{{ route('pelatih.laporan.performa') }}">Laporan Performa</a>
            @else
                <h3>Menu Pemain</h3>
                <a href="{{ route('pemain.dashboard') }}">Dashboard</a>
                <a href="{{ route('pemain.profil') }}">Profil Saya</a>
                <a href="{{ route('pemain.presensi') }}">Presensi Saya</a>
                <a href="{{ route('pemain.performa') }}">Performa Saya</a>
                <a href="{{ route('pemain.grafik') }}">Grafik Saya</a>
            @endif
        </div>

        <div class="content">
            <div class="card">
                @yield('content')
            </div>
        </div>
    </div>

</body>
</html>