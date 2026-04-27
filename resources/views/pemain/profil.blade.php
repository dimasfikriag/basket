@extends('layouts.app')

@section('content')
    <h1 class="page-title">Profil Saya</h1>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background:#f8d7da; color:#721c24; padding:12px; border-radius:6px; margin-bottom:15px;">
            {{ session('error') }}
        </div>
    @endif

    @if($pemain)
        <div style="margin-bottom: 20px;">
            <a href="{{ route('pemain.profil.edit') }}" class="btn btn-primary">Edit Profil</a>
        </div>

        <div class="profile-card">
            <div class="profile-row">
                <div class="profile-label">Nama Lengkap</div>
                <div class="profile-value">{{ $pemain->nama_lengkap ?? '-' }}</div>
            </div>

            <div class="profile-row">
                <div class="profile-label">Tanggal Lahir</div>
                <div class="profile-value">{{ $pemain->tanggal_lahir ?? '-' }}</div>
            </div>

            <div class="profile-row">
                <div class="profile-label">Nomor Punggung</div>
                <div class="profile-value">{{ $pemain->nomor_punggung ?? '-' }}</div>
            </div>

            <div class="profile-row">
                <div class="profile-label">Posisi</div>
                <div class="profile-value">{{ $pemain->posisi ?? '-' }}</div>
            </div>

            <div class="profile-row">
                <div class="profile-label">Tinggi Badan</div>
                <div class="profile-value">
                    {{ $pemain->tinggi_badan ? $pemain->tinggi_badan . ' cm' : '-' }}
                </div>
            </div>

            <div class="profile-row">
                <div class="profile-label">Berat Badan</div>
                <div class="profile-value">
                    {{ $pemain->berat_badan ? $pemain->berat_badan . ' kg' : '-' }}
                </div>
            </div>

            <div class="profile-row">
                <div class="profile-label">No HP</div>
                <div class="profile-value">{{ $pemain->no_hp ?? '-' }}</div>
            </div>

            <div class="profile-row">
                <div class="profile-label">Alamat</div>
                <div class="profile-value">{{ $pemain->alamat ?? '-' }}</div>
            </div>
        </div>
    @else
        <p class="text-muted">Data profil pemain belum terhubung ke akun ini.</p>
    @endif
@endsection