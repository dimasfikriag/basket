@extends('layouts.app')

@section('content')
    <h1 class="page-title">Edit Performa Pemain</h1>

    @if($errors->any())
        <div style="color:red; margin-bottom:15px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.performa.update', $performa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Pemain</label>
            <select name="pemain_id">
                <option value="">-- Pilih Pemain --</option>
                @foreach($pemains as $pemain)
                    <option value="{{ $pemain->id }}" {{ $performa->pemain_id == $pemain->id ? 'selected' : '' }}>
                        {{ $pemain->nama_lengkap }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Latihan</label>
            <select name="latihan_id">
                <option value="">-- Pilih Latihan --</option>
                @foreach($latihans as $latihan)
                    <option value="{{ $latihan->id }}" {{ $performa->latihan_id == $latihan->id ? 'selected' : '' }}>
                        {{ $latihan->tanggal }} - {{ $latihan->lokasi }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Pelatih</label>
            <select name="pelatih_id">
                <option value="">-- Pilih Pelatih --</option>
                @foreach($pelatihs as $pelatih)
                    <option value="{{ $pelatih->id }}" {{ $performa->pelatih_id == $pelatih->id ? 'selected' : '' }}>
                        {{ $pelatih->nama_lengkap }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Penilaian</label>
            <input type="date" name="tanggal_penilaian" value="{{ old('tanggal_penilaian', $performa->tanggal_penilaian) }}">
        </div>

        <div class="form-group">
            <label>Stamina</label>
            <input type="number" name="stamina" value="{{ old('stamina', $performa->stamina) }}" min="0" max="100">
        </div>

        <div class="form-group">
            <label>Speed</label>
            <input type="number" name="speed" value="{{ old('speed', $performa->speed) }}" min="0" max="100">
        </div>

        <div class="form-group">
            <label>Shooting</label>
            <input type="number" name="shooting" value="{{ old('shooting', $performa->shooting) }}" min="0" max="100">
        </div>

        <div class="form-group">
            <label>Passing</label>
            <input type="number" name="passing" value="{{ old('passing', $performa->passing) }}" min="0" max="100">
        </div>

        <div class="form-group">
            <label>Dribbling</label>
            <input type="number" name="dribbling" value="{{ old('dribbling', $performa->dribbling) }}" min="0" max="100">
        </div>

        <div class="form-group">
            <label>Defense</label>
            <input type="number" name="defense" value="{{ old('defense', $performa->defense) }}" min="0" max="100">
        </div>

        <div class="form-group">
            <label>Catatan</label>
            <textarea name="catatan">{{ old('catatan', $performa->catatan) }}</textarea>
        </div>

        <div class="button-group">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.performa.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
@endsection