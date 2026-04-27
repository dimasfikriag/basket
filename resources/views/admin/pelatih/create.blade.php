@extends('layouts.app')

@section('content')
    <h1 class="page-title">Tambah Pelatih</h1>

    @if($errors->any())
        <div style="color:red; margin-bottom:15px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pelatih.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>User Akun (opsional)</label>
            <select name="user_id">
                <option value="">-- Pilih User Pelatih --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}">
        </div>

        <div class="form-group">
            <label>Lisensi</label>
            <input type="text" name="lisensi" value="{{ old('lisensi') }}">
        </div>

        <div class="form-group">
            <label>Spesialisasi</label>
            <input type="text" name="spesialisasi" value="{{ old('spesialisasi') }}">
        </div>

        <div class="form-group">
            <label>No HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp') }}">
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat">{{ old('alamat') }}</textarea>
        </div>

        <div class="button-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.pelatih.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
@endsection