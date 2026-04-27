@extends('layouts.app')

@section('content')
    <h1 class="page-title">Tambah Performa Pemain</h1>

    @if($errors->any())
        <div style="color:red; margin-bottom:15px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pelatih.performa.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Pemain</label>
            <select name="pemain_id">
                <option value="">-- Pilih Pemain --</option>
                @foreach($pemains as $pemain)
                    <option value="{{ $pemain->id }}">{{ $pemain->nama_lengkap }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Latihan</label>
            <select name="latihan_id">
                <option value="">-- Pilih Latihan --</option>
                @foreach($latihans as $latihan)
                    <option value="{{ $latihan->id }}">{{ $latihan->tanggal }} - {{ $latihan->lokasi }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Penilaian</label>
            <input type="date" name="tanggal_penilaian" value="{{ old('tanggal_penilaian') }}">
        </div>

        <div class="form-group">
            <label>Stamina</label>
            <input type="number" name="stamina" min="0" max="10" value="{{ old('stamina') }}">
        </div>

        <div class="form-group">
            <label>Speed</label>
            <input type="number" name="speed" min="0" max="10" value="{{ old('speed') }}">
        </div>

        <div class="form-group">
            <label>Shooting</label>
            <input type="number" name="shooting" min="0" max="10" value="{{ old('shooting') }}">
        </div>

        <div class="form-group">
            <label>Passing</label>
            <input type="number" name="passing" min="0" max="10" value="{{ old('passing') }}">
        </div>

        <div class="form-group">
            <label>Dribbling</label>
            <input type="number" name="dribbling" min="0" max="10" value="{{ old('dribbling') }}">
        </div>

        <div class="form-group">
            <label>Defense</label>
            <input type="number" name="defense" min="0" max="10" value="{{ old('defense') }}">
        </div>

        <div class="form-group">
            <label>Catatan</label>
            <textarea name="catatan">{{ old('catatan') }}</textarea>
        </div>

        <div class="button-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('pelatih.performa') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
@endsection