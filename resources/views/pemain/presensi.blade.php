@extends('layouts.app')

@section('content')
    <h1 class="page-title">Riwayat Presensi Saya</h1>

    @if($pemain)
        <table>
            <tr>
                <th>No</th>
                <th>Tanggal Latihan</th>
                <th>Jam</th>
                <th>Lokasi</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>

            @forelse($presensis as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->latihan?->tanggal ?? '-' }}</td>
                    <td>{{ $item->latihan?->jam ?? '-' }}</td>
                    <td>{{ $item->latihan?->lokasi ?? '-' }}</td>
                    <td>{{ ucfirst($item->status_kehadiran) }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data presensi</td>
                </tr>
            @endforelse
        </table>
    @else
        <p class="text-muted">Data pemain belum terhubung ke akun ini.</p>
    @endif
@endsection