@extends('layouts.app')

@section('content')
    <h1 class="page-title">Edit Presensi</h1>

    @if($errors->any())
        <div style="color:red; margin-bottom:15px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.presensi.update', $presensi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Latihan</label>
            <select name="latihan_id">
                <option value="">-- Pilih Latihan --</option>
                @foreach($latihans as $latihan)
                    <option value="{{ $latihan->id }}" {{ $presensi->latihan_id == $latihan->id ? 'selected' : '' }}>
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
                    <option value="{{ $pemain->id }}" {{ $presensi->pemain_id == $pemain->id ? 'selected' : '' }}>
                        {{ $pemain->nama_lengkap }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Status Kehadiran</label>
            <select name="status_kehadiran">
                <option value="hadir" {{ $presensi->status_kehadiran == 'hadir' ? 'selected' : '' }}>Hadir</option>
                <option value="izin" {{ $presensi->status_kehadiran == 'izin' ? 'selected' : '' }}>Izin</option>
                <option value="sakit" {{ $presensi->status_kehadiran == 'sakit' ? 'selected' : '' }}>Sakit</option>
                <option value="alpha" {{ $presensi->status_kehadiran == 'alpha' ? 'selected' : '' }}>Alpha</option>
            </select>
        </div>

        <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan">{{ old('keterangan', $presensi->keterangan) }}</textarea>
        </div>

        <div class="button-group">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.presensi.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
@endsection