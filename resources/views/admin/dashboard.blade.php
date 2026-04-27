@extends('layouts.app')

@section('content')
    <h1 class="page-title">Dashboard Admin</h1>
    <p>Selamat datang di halaman admin.</p>
    <p class="text-muted">Berikut adalah ringkasan data sistem monitoring pemain basket.</p>

    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Pemain</h3>
            <p>{{ $totalPemain }}</p>
        </div>

        <div class="stat-card">
            <h3>Total Pelatih</h3>
            <p>{{ $totalPelatih }}</p>
        </div>

        <div class="stat-card">
            <h3>Total Latihan</h3>
            <p>{{ $totalLatihan }}</p>
        </div>

        <div class="stat-card">
            <h3>Total Presensi</h3>
            <p>{{ $totalPresensi }}</p>
        </div>

        <div class="stat-card">
            <h3>Total Performa</h3>
            <p>{{ $totalPerforma }}</p>
        </div>
    </div>
@endsection