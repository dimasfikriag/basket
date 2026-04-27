<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Performa;
use Illuminate\Http\Request;

class PemainAreaController extends Controller
{
    public function profil()
    {
        $user = auth()->user();
        $pemain = $user->pemain;

        return view('pemain.profil', compact('pemain'));
    }

    public function editProfil()
    {
        $user = auth()->user();
        $pemain = $user->pemain;

        return view('pemain.edit_profil', compact('pemain'));
    }

    public function updateProfil(Request $request)
    {
        $user = auth()->user();
        $pemain = $user->pemain;

        if (!$pemain) {
            return redirect()->route('pemain.profil')
                ->with('error', 'Data pemain tidak ditemukan.');
        }

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'nomor_punggung' => 'nullable|string|max:20',
            'posisi' => 'nullable|string|max:100',
            'tinggi_badan' => 'nullable|integer|min:0',
            'berat_badan' => 'nullable|integer|min:0',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $pemain->update([
            'nama_lengkap' => $request->nama_lengkap,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nomor_punggung' => $request->nomor_punggung,
            'posisi' => $request->posisi,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('pemain.profil')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    public function presensi()
    {
        $user = auth()->user();
        $pemain = $user->pemain;

        $presensis = [];

        if ($pemain) {
            $presensis = Presensi::with('latihan')
                ->where('pemain_id', $pemain->id)
                ->latest()
                ->get();
        }

        return view('pemain.presensi', compact('pemain', 'presensis'));
    }

    public function performa()
    {
        $user = auth()->user();
        $pemain = $user->pemain;

        $performas = [];

        if ($pemain) {
            $performas = Performa::with(['latihan', 'pelatih'])
                ->where('pemain_id', $pemain->id)
                ->latest()
                ->get();
        }

        return view('pemain.performa', compact('pemain', 'performas'));
    }

    public function grafik()
    {
        $user = auth()->user();
        $pemain = $user->pemain;

        $labels = [];
        $data = [];

        if ($pemain) {
            $performas = Performa::where('pemain_id', $pemain->id)
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
                ])->filter(fn($v) => !is_null($v));

                $rataRata = $nilai->count() > 0 ? round($nilai->avg(), 2) : 0;

                $data[] = $rataRata;
            }
        }

        return view('pemain.grafik', compact('pemain', 'labels', 'data'));
    }
}