@extends('layouts.app')

@section('content')
    <h1 class="page-title">Data Pemain</h1>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Nomor Punggung</th>
            <th>Posisi</th>
            <th>Tinggi Badan</th>
            <th>Berat Badan</th>
            <th>No HP</th>
        </tr>

        @forelse($pemains as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_lengkap }}</td>
                <td>{{ $item->nomor_punggung ?? '-' }}</td>
                <td>{{ $item->posisi ?? '-' }}</td>
                <td>{{ $item->tinggi_badan ? $item->tinggi_badan . ' cm' : '-' }}</td>
                <td>{{ $item->berat_badan ? $item->berat_badan . ' kg' : '-' }}</td>
                <td>{{ $item->no_hp ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7">Belum ada data pemain</td>
            </tr>
        @endforelse
    </table>
@endsection