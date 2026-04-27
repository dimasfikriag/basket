<?php

namespace App\Http\Controllers;

use App\Models\Pemain;
use App\Models\Performa;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LaporanController extends Controller
{
    public function performa(Request $request)
    {
        $pemains = Pemain::all();

        $selectedPemain = $request->pemain_id;
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        $query = Performa::with(['pemain', 'latihan', 'pelatih']);

        if ($selectedPemain) {
            $query->where('pemain_id', $selectedPemain);
        }

        if ($tanggalAwal) {
            $query->whereDate('tanggal_penilaian', '>=', $tanggalAwal);
        }

        if ($tanggalAkhir) {
            $query->whereDate('tanggal_penilaian', '<=', $tanggalAkhir);
        }

        $performas = $query->orderBy('tanggal_penilaian', 'asc')->get();

        $rataRata = [
            'stamina' => round($performas->avg('stamina') ?? 0, 2),
            'speed' => round($performas->avg('speed') ?? 0, 2),
            'shooting' => round($performas->avg('shooting') ?? 0, 2),
            'passing' => round($performas->avg('passing') ?? 0, 2),
            'dribbling' => round($performas->avg('dribbling') ?? 0, 2),
            'defense' => round($performas->avg('defense') ?? 0, 2),
        ];

        $rataRataKeseluruhan = round(collect($rataRata)->avg(), 2);

        return view('laporan.performa', compact(
            'pemains',
            'selectedPemain',
            'tanggalAwal',
            'tanggalAkhir',
            'performas',
            'rataRata',
            'rataRataKeseluruhan'
        ));
    }
    public function exportPerforma(Request $request): StreamedResponse
{
    $selectedPemain = $request->pemain_id;
    $tanggalAwal = $request->tanggal_awal;
    $tanggalAkhir = $request->tanggal_akhir;

    $query = Performa::with(['pemain', 'latihan', 'pelatih']);

    if ($selectedPemain) {
        $query->where('pemain_id', $selectedPemain);
    }

    if ($tanggalAwal) {
        $query->whereDate('tanggal_penilaian', '>=', $tanggalAwal);
    }

    if ($tanggalAkhir) {
        $query->whereDate('tanggal_penilaian', '<=', $tanggalAkhir);
    }

    $performas = $query->orderBy('tanggal_penilaian', 'asc')->get();

    $filename = 'laporan_performa_' . now()->format('Ymd_His') . '.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$filename\"",
    ];

    $callback = function () use ($performas) {
        $file = fopen('php://output', 'w');

        fputcsv($file, [
            'No',
            'Pemain',
            'Tanggal Penilaian',
            'Tanggal Latihan',
            'Pelatih',
            'Stamina',
            'Speed',
            'Shooting',
            'Passing',
            'Dribbling',
            'Defense',
            'Catatan',
        ]);

        foreach ($performas as $index => $item) {
            fputcsv($file, [
                $index + 1,
                $item->pemain?->nama_lengkap ?? '-',
                $item->tanggal_penilaian ?? '-',
                $item->latihan?->tanggal ?? '-',
                $item->pelatih?->nama_lengkap ?? '-',
                $item->stamina ?? '-',
                $item->speed ?? '-',
                $item->shooting ?? '-',
                $item->passing ?? '-',
                $item->dribbling ?? '-',
                $item->defense ?? '-',
                $item->catatan ?? '-',
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}
}