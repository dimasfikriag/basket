@extends('layouts.app')

@section('content')
    <h1 class="page-title">Edit Profil Saya</h1>

    @if($errors->any())
        <div style="color:red; margin-bottom:15px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($pemain)
        <form action="{{ route('pemain.profil.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $pemain->nama_lengkap) }}">
            </div>

            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pemain->tanggal_lahir) }}">
            </div>

            <div class="form-group">
                <label>Nomor Punggung</label>
                <input type="text" name="nomor_punggung" value="{{ old('nomor_punggung', $pemain->nomor_punggung) }}">
            </div>

            <div class="form-group">
                <label>Posisi</label>
                <select name="posisi">
    <option value="">-- Pilih Posisi --</option>
    <option value="Guard" {{ old('posisi', $pemain->posisi) == 'Guard' ? 'selected' : '' }}>Guard</option>
    <option value="Forward" {{ old('posisi', $pemain->posisi) == 'Forward' ? 'selected' : '' }}>Forward</option>
    <option value="Center" {{ old('posisi', $pemain->posisi) == 'Center' ? 'selected' : '' }}>Center</option>
</select>
            </div>

            <div class="form-group">
                <label>Tinggi Badan (cm)</label>
                <input type="number" name="tinggi_badan" value="{{ old('tinggi_badan', $pemain->tinggi_badan) }}">
            </div>

            <div class="form-group">
                <label>Berat Badan (kg)</label>
                <input type="number" name="berat_badan" value="{{ old('berat_badan', $pemain->berat_badan) }}">
            </div>

            <div class="form-group">
                <label>No HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $pemain->no_hp) }}">
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat">{{ old('alamat', $pemain->alamat) }}</textarea>
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('pemain.profil') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    @else
        <p class="text-muted">Data pemain tidak ditemukan.</p>
    @endif
@endsection