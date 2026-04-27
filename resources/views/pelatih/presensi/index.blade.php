@extends('layouts.app')

@section('content')
    <h1 class="page-title">Data Presensi</h1>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('pelatih.presensi.create') }}" class="btn btn-primary">+ Tambah Presensi</a>

    <table>
        <tr>
            <th>No</th>
            <th>Latihan</th>
            <th>Pemain</th>
            <th>Status</th>
            <th>Keterangan</th>
        </tr>

        @forelse($presensis as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->latihan?->tanggal ?? '-' }} - {{ $item->latihan?->jam ?? '-' }}</td>
                <td>{{ $item->pemain?->nama_lengkap ?? '-' }}</td>
                <td>{{ ucfirst($item->status_kehadiran) }}</td>
                <td>{{ $item->keterangan ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Belum ada data presensi</td>
            </tr>
        @endforelse
    </table>
@endsection