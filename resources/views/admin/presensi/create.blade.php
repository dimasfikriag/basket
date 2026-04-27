@extends('layouts.app')

@section('content')
    <h1 class="page-title">Tambah Presensi</h1>

    @if($errors->any())
        <div style="color:red; margin-bottom:15px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.presensi.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Latihan</label>
            <select name="latihan_id">
                <option value="">-- Pilih Latihan --</option>
                @foreach($latihans as $latihan)
                    <option value="{{ $latihan->id }}">
                        {{ $latihan->tanggal }} - {{ $latihan->jam }} - {{ $latihan->lokasi }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Pemain</label>
            <select name="pemain_id">
                <option value="">-- Pilih Pemain --</option>
                @foreach($pemains as $pemain)
                    <option value="{{ $pemain->id }}">
                        {{ $pemain->nama_lengkap }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Status Kehadiran</label>
            <select name="status_kehadiran">
                <option value="">-- Pilih Status --</option>
                <option value="hadir">Hadir</option>
                <option value="izin">Izin</option>
                <option value="sakit">Sakit</option>
                <option value="alpha">Alpha</option>
            </select>
        </div>

        <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan">{{ old('keterangan') }}</textarea>
        </div>

        <div class="button-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.presensi.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
@endsection