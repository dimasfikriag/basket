@extends('layouts.app')

@section('content')
    <h1 class="page-title">Data Presensi</h1>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.presensi.create') }}" class="btn btn-primary">+ Tambah Presensi</a>

    <table>
        <tr>
            <th>No</th>
            <th>Latihan</th>
            <th>Pemain</th>
            <th>Status</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>

        @forelse($presensis as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    {{ $item->latihan?->tanggal ?? '-' }} -
                    {{ $item->latihan?->jam ?? '-' }}
                </td>
                <td>{{ $item->pemain?->nama_lengkap ?? '-' }}</td>
                <td>{{ ucfirst($item->status_kehadiran) }}</td>
                <td>{{ $item->keterangan ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.presensi.edit', $item->id) }}" class="btn btn-warning">Edit</a>

                    <form action="{{ route('admin.presensi.destroy', $item->id) }}" method="POST" class="inline-form">
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
                <td colspan="6">Belum ada data presensi</td>
            </tr>
        @endforelse
    </table>
@endsection