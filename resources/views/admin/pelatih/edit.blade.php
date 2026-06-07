@extends('layouts.app')

@section('content')
    <h1 class="page-title">Edit Pelatih</h1>

    @if($errors->any())
        <div style="color:red; margin-bottom:15px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pelatih.update', $pelatih->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>User Akun (opsional)</label>
            <select name="user_id">
                <option value="">-- Pilih User Pelatih --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $pelatih->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} - {{ $user->email }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $pelatih->nama_lengkap) }}">
        </div>

        <div class="form-group">
            <label>Password (opsional)</label>
            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengganti password">
        </div>

        <div class="form-group">
            <label>Lisensi</label>
            <input type="text" name="lisensi" value="{{ old('lisensi', $pelatih->lisensi) }}">
        </div>

        <div class="form-group">
            <label>Spesialisasi</label>
            <input type="text" name="spesialisasi" value="{{ old('spesialisasi', $pelatih->spesialisasi) }}">
        </div>

        <div class="form-group">
            <label>No HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp', $pelatih->no_hp) }}">
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat">{{ old('alamat', $pelatih->alamat) }}</textarea>
        </div>

        <div class="button-group">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.pelatih.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
@endsection