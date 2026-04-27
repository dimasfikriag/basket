@extends('layouts.app')

@section('content')
    <h1 class="page-title">Data Pelatih</h1>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.pelatih.create') }}" class="btn btn-primary">+ Tambah Pelatih</a>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>User</th>
            <th>Lisensi</th>
            <th>Spesialisasi</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>

        @forelse($pelatihs as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_lengkap }}</td>
                <td>{{ $item->user?->email ?? '-' }}</td>
                <td>{{ $item->lisensi ?? '-' }}</td>
                <td>{{ $item->spesialisasi ?? '-' }}</td>
                <td>{{ $item->no_hp ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.pelatih.edit', $item->id) }}" class="btn btn-warning">Edit</a>

                    <form action="{{ route('admin.pelatih.destroy', $item->id) }}" method="POST" class="inline-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus data?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">Belum ada data pelatih</td>
            </tr>
        @endforelse
    </table>
@endsection