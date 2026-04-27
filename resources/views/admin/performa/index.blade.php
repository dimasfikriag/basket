@extends('layouts.app')

@section('content')
    <h1 class="page-title">Data Performa Pemain</h1>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.performa.create') }}" class="btn btn-primary">+ Tambah Performa</a>
<a href="{{ route('admin.performa.grafik') }}" class="btn btn-secondary">Lihat Grafik</a>

    <table>
        <tr>
            <th>No</th>
            <th>Pemain</th>
            <th>Latihan</th>
            <th>Pelatih</th>
            <th>Stamina</th>
            <th>Speed</th>
            <th>Shooting</th>
            <th>Passing</th>
            <th>Dribbling</th>
            <th>Defense</th>
            <th>Tanggal Penilaian</th>
            <th>Aksi</th>
        </tr>

        @forelse($performas as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->pemain?->nama_lengkap ?? '-' }}</td>
                <td>{{ $item->latihan?->tanggal ?? '-' }}</td>
                <td>{{ $item->pelatih?->nama_lengkap ?? '-' }}</td>
                <td>{{ $item->stamina ?? '-' }}</td>
                <td>{{ $item->speed ?? '-' }}</td>
                <td>{{ $item->shooting ?? '-' }}</td>
                <td>{{ $item->passing ?? '-' }}</td>
                <td>{{ $item->dribbling ?? '-' }}</td>
                <td>{{ $item->defense ?? '-' }}</td>
                <td>{{ $item->tanggal_penilaian ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.performa.edit', $item->id) }}" class="btn btn-warning">Edit</a>

                    <form action="{{ route('admin.performa.destroy', $item->id) }}" method="POST" class="inline-form">
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
                <td colspan="12">Belum ada data performa</td>
            </tr>
        @endforelse
    </table>
@endsection