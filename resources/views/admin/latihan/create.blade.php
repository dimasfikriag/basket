@extends('layouts.app')

@section('content')
    <h1 class="page-title">Tambah Latihan</h1>

    @if($errors->any())
        <div style="color:red; margin-bottom:15px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.latihan.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Pelatih</label>
            <select name="pelatih_id">
                <option value="">-- Pilih Pelatih --</option>
                @foreach($pelatihs as $pelatih)
                    <option value="{{ $pelatih->id }}">{{ $pelatih->nama_lengkap }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal') }}">
        </div>

        <div class="form-group">
            <label>Jam</label>
            <input type="time" name="jam" value="{{ old('jam') }}">
        </div>

        <div class="form-group">
            <label>Lokasi</label>
            <input type="text" name="lokasi" value="{{ old('lokasi') }}">
        </div>

        <div class="form-group">
            <label>Materi Latihan</label>
            <textarea name="materi_latihan">{{ old('materi_latihan') }}</textarea>
        </div>

        <div class="button-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.latihan.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
@endsection