@extends('layouts.app')

@section('content')
    <h1 class="page-title">Edit Latihan</h1>

    @if($errors->any())
        <div style="color:red; margin-bottom:15px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.latihan.update', $latihan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Pelatih</label>
            <select name="pelatih_id">
                <option value="">-- Pilih Pelatih --</option>
                @foreach($pelatihs as $pelatih)
                    <option value="{{ $pelatih->id }}" {{ $latihan->pelatih_id == $pelatih->id ? 'selected' : '' }}>
                        {{ $pelatih->nama_lengkap }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal', $latihan->tanggal) }}">
        </div>

        <div class="form-group">
            <label>Jam</label>
            <input type="time" name="jam" value="{{ old('jam', $latihan->jam) }}">
        </div>

        <div class="form-group">
            <label>Lokasi</label>
            <input type="text" name="lokasi" value="{{ old('lokasi', $latihan->lokasi) }}">
        </div>

        <div class="form-group">
            <label>Materi Latihan</label>
            <textarea name="materi_latihan">{{ old('materi_latihan', $latihan->materi_latihan) }}</textarea>
        </div>

        <div class="button-group">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.latihan.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
@endsection