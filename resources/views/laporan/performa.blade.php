@extends('layouts.app')

@section('content')
    <h1 class="page-title">Laporan Performa Pemain</h1>

    <form method="GET" action="">
        <div class="form-group">
            <label>Pilih Pemain</label>
            <select name="pemain_id">
                <option value="">-- Semua Pemain --</option>
                @foreach($pemains as $pemain)
                    <option value="{{ $pemain->id }}" {{ $selectedPemain == $pemain->id ? 'selected' : '' }}>
                        {{ $pemain->nama_lengkap }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Awal</label>
            <input type="date" name="tanggal_awal" value="{{ $tanggalAwal }}">
        </div>

        <div class="form-group">
            <label>Tanggal Akhir</label>
            <input type="date" name="tanggal_akhir" value="{{ $tanggalAkhir }}">
        </div>

        <div class="button-group">
    <button type="submit" class="btn btn-primary">Tampilkan Laporan</button>

    <button type="button" class="btn btn-secondary" onclick="window.print()">Print</button>

    @if(auth()->user()->role == 'admin')
        <a href="{{ route('admin.laporan.performa.export', [
            'pemain_id' => request('pemain_id'),
            'tanggal_awal' => request('tanggal_awal'),
            'tanggal_akhir' => request('tanggal_akhir')
        ]) }}" class="btn btn-warning">Export CSV</a>
    @elseif(auth()->user()->role == 'pelatih')
        <a href="{{ route('pelatih.laporan.performa.export', [
            'pemain_id' => request('pemain_id'),
            'tanggal_awal' => request('tanggal_awal'),
            'tanggal_akhir' => request('tanggal_akhir')
        ]) }}" class="btn btn-warning">Export CSV</a>
    @endif
</div>
    </form>

    <hr style="margin: 20px 0;">

    <h2 style="margin-bottom: 15px;">Ringkasan Rata-Rata</h2>

    <table>
        <tr>
            <th>Stamina</th>
            <th>Speed</th>
            <th>Shooting</th>
            <th>Passing</th>
            <th>Dribbling</th>
            <th>Defense</th>
            <th>Rata-Rata Keseluruhan</th>
        </tr>
        <tr>
            <td>{{ $rataRata['stamina'] }}</td>
            <td>{{ $rataRata['speed'] }}</td>
            <td>{{ $rataRata['shooting'] }}</td>
            <td>{{ $rataRata['passing'] }}</td>
            <td>{{ $rataRata['dribbling'] }}</td>
            <td>{{ $rataRata['defense'] }}</td>
            <td><strong>{{ $rataRataKeseluruhan }}</strong></td>
        </tr>
    </table>

    <h2 style="margin: 25px 0 15px;">Detail Data Performa</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Pemain</th>
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
                <td>{{ $item->pemain?->nama_lengkap ?? '-' }}</td>
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
                <td colspan="12">Tidak ada data performa</td>
            </tr>
        @endforelse
    </table>
    <style>
@media print {
    .sidebar,
    .header,
    .button-group,
    form {
        display: none !important;
    }

    .content,
    .card {
        padding: 0 !important;
        margin: 0 !important;
        box-shadow: none !important;
        border: none !important;
    }

    body {
        background: white !important;
    }

    table {
        width: 100%;
        font-size: 12px;
    }

    .page-title {
        margin-bottom: 20px;
    }
}
</style>
@endsection