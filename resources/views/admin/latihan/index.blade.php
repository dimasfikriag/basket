@extends('layouts.app')

@section('content')
    <h1 class="page-title">Data Latihan</h1>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.latihan.create') }}" class="btn btn-primary">+ Tambah Latihan</a>

    <table>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Lokasi</th>
            <th>Pelatih</th>
            <th>Materi Latihan</th>
            <th>Aksi</th>
        </tr>

        @forelse($latihans as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->jam }}</td>
                <td>{{ $item->lokasi }}</td>
                <td>{{ $item->pelatih?->nama_lengkap ?? '-' }}</td>
                <td>{{ $item->materi_latihan ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.latihan.edit', $item->id) }}" class="btn btn-warning">Edit</a>

                    <form action="{{ route('admin.latihan.destroy', $item->id) }}" method="POST" class="inline-form">
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
                <td colspan="7">Belum ada data latihan</td>
            </tr>
        @endforelse
    </table>
@endsection