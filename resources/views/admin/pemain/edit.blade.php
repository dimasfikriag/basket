@extends('layouts.app')

@section('content')
    <h1 class="page-title">Edit Pemain</h1>

    @if($errors->any())
        <div style="color:red; margin-bottom:15px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pemain.update', $pemain->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>User Akun (opsional)</label>
            <select name="user_id">
                <option value="">-- Pilih User Pemain --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $pemain->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} - {{ $user->email }}
                    </option>
                @endforeach
            </select>
        </div>

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
            <input type="text" name="posisi" value="{{ old('posisi', $pemain->posisi) }}">
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
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.pemain.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
@endsection