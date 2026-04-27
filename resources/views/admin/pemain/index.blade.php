@extends('layouts.app')

@section('content')
    <h1 class="page-title">Data Pemain</h1>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.pemain.create') }}" class="btn btn-primary">+ Tambah Pemain</a>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>User</th>
            <th>No Punggung</th>
            <th>Posisi</th>
            <th>Tinggi</th>
            <th>Berat</th>
            <th>Aksi</th>
        </tr>

        @forelse($pemains as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_lengkap }}</td>
                <td>{{ $item->user?->email ?? '-' }}</td>
                <td>{{ $item->nomor_punggung ?? '-' }}</td>
                <td>{{ $item->posisi ?? '-' }}</td>
                <td>{{ $item->tinggi_badan ? $item->tinggi_badan . ' cm' : '-' }}</td>
                <td>{{ $item->berat_badan ? $item->berat_badan . ' kg' : '-' }}</td>
                <td>
                    <a href="{{ route('admin.pemain.edit', $item->id) }}" class="btn btn-warning">Edit</a>

                    <form action="{{ route('admin.pemain.destroy', $item->id) }}" method="POST" class="inline-form">
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
                <td colspan="8">Belum ada data pemain</td>
            </tr>
        @endforelse
    </table>
@endsection