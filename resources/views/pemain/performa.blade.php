@extends('layouts.app')

@section('content')
    <h1 class="page-title">Data Performa Saya</h1>

    @if($pemain)
        <table>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Latihan</th>
                <th>Pelatih</th>
                <th>Stamina</th>
                <th>Speed</th>
                <th>Shooting</th>
                <th>Passing</th>
                <th>Dribbling</th>
                <th>Defense</th>
                <th>Catatan</th>
            </tr>

            @forelse($performas as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->tanggal_penilaian ?? '-' }}</td>
                    <td>{{ $item->latihan?->tanggal ?? '-' }}</td>
                    <td>{{ $item->pelatih?->nama_lengkap ?? '-' }}</td>
                    <td>{{ $item->stamina ?? '-' }}</td>
                    <td>{{ $item->speed ?? '-' }}</td>
                    <td>{{ $item->shooting ?? '-' }}</td>
                    <td>{{ $item->passing ?? '-' }}</td>
                    <td>{{ $item->dribbling ?? '-' }}</td>
                    <td>{{ $item->defense ?? '-' }}</td>
                    <td>{{ $item->catatan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="11">Belum ada data performa</td>
                </tr>
            @endforelse
        </table>
    @else
        <p class="text-muted">Data pemain belum terhubung ke akun ini.</p>
    @endif
@endsection