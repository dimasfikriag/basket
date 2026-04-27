<?php

namespace App\Http\Controllers;

use App\Models\Latihan;
use App\Models\Pemain;
use App\Models\Pelatih;
use App\Models\Presensi;
use App\Models\Performa;
use Illuminate\Http\Request;

class PelatihAreaController extends Controller
{
    public function pemain()
    {
        $pemains = Pemain::latest()->get();
        return view('pelatih.pemain.index', compact('pemains'));
    }

    public function presensi()
    {
        $presensis = Presensi::with(['latihan', 'pemain'])->latest()->get();
        return view('pelatih.presensi.index', compact('presensis'));
    }

    public function createPresensi()
    {
        $latihans = Latihan::all();
        $pemains = Pemain::all();

        return view('pelatih.presensi.create', compact('latihans', 'pemains'));
    }

    public function storePresensi(Request $request)
    {
        $request->validate([
            'latihan_id' => 'required|exists:latihans,id',
            'pemain_id' => 'required|exists:pemains,id',
            'status_kehadiran' => 'required|in:hadir,izin,sakit,alpha',
            'keterangan' => 'nullable|string',
        ]);

        Presensi::create([
            'latihan_id' => $request->latihan_id,
            'pemain_id' => $request->pemain_id,
            'status_kehadiran' => $request->status_kehadiran,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pelatih.presensi')
            ->with('success', 'Presensi berhasil ditambahkan.');
    }

    public function performa()
    {
        $performas = Performa::with(['pemain', 'latihan', 'pelatih'])->latest()->get();
        return view('pelatih.performa.index', compact('performas'));
    }

    public function createPerforma()
    {
        $pemains = Pemain::all();
        $latihans = Latihan::all();
        $pelatih = auth()->user()->pelatih;

        return view('pelatih.performa.create', compact('pemains', 'latihans', 'pelatih'));
    }

    public function storePerforma(Request $request)
    {
        $request->validate([
            'pemain_id' => 'required|exists:pemains,id',
            'latihan_id' => 'required|exists:latihans,id',
            'stamina' => 'nullable|integer|min:0|max:10',
            'speed' => 'nullable|integer|min:0|max:10',
            'shooting' => 'nullable|integer|min:0|max:10',
            'passing' => 'nullable|integer|min:0|max:10',
            'dribbling' => 'nullable|integer|min:0|max:10',
            'defense' => 'nullable|integer|min:0|max:10',
            'catatan' => 'nullable|string',
            'tanggal_penilaian' => 'nullable|date',
        ]);

        $pelatih = auth()->user()->pelatih;

        Performa::create([
            'pemain_id' => $request->pemain_id,
            'latihan_id' => $request->latihan_id,
            'pelatih_id' => $pelatih?->id,
            'stamina' => $request->stamina,
            'speed' => $request->speed,
            'shooting' => $request->shooting,
            'passing' => $request->passing,
            'dribbling' => $request->dribbling,
            'defense' => $request->defense,
            'catatan' => $request->catatan,
            'tanggal_penilaian' => $request->tanggal_penilaian,
        ]);

        return redirect()->route('pelatih.performa')
            ->with('success', 'Performa berhasil ditambahkan.');
    }

    public function grafik(Request $request)
    {
        $pemains = Pemain::all();
        $selectedPemain = $request->pemain_id;

        $labels = [];
        $data = [];

        if ($selectedPemain) {
            $performas = Performa::where('pemain_id', $selectedPemain)
                ->orderBy('tanggal_penilaian', 'asc')
                ->get();

            foreach ($performas as $item) {
                $labels[] = $item->tanggal_penilaian;

                $nilai = collect([
                    $item->stamina,
                    $item->speed,
                    $item->shooting,
                    $item->passing,
                    $item->dribbling,
                    $item->defense,
                ])->filter(fn ($v) => !is_null($v));

                $data[] = $nilai->count() > 0 ? round($nilai->avg(), 2) : 0;
            }
        }

        return view('pelatih.grafik', compact('pemains', 'selectedPemain', 'labels', 'data'));
    }
}