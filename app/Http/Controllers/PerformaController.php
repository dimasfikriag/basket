<?php

namespace App\Http\Controllers;

use App\Models\Performa;
use App\Models\Pemain;
use App\Models\Latihan;
use App\Models\Pelatih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerformaController extends Controller
{
    public function index()
    {
        $performas = Performa::with(['pemain', 'latihan', 'pelatih'])->latest()->get();
        return view('admin.performa.index', compact('performas'));
    }

    public function create()
    {
        $pemains = Pemain::all();
        $latihans = Latihan::all();
        $pelatihs = Pelatih::all();

        return view('admin.performa.create', compact('pemains', 'latihans', 'pelatihs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pemain_id' => 'required|exists:pemains,id',
            'latihan_id' => 'required|exists:latihans,id',
            'pelatih_id' => 'nullable|exists:pelatihs,id',
            'stamina' => 'nullable|integer|min:0|max:100',
            'speed' => 'nullable|integer|min:0|max:100',
            'shooting' => 'nullable|integer|min:0|max:100',
            'passing' => 'nullable|integer|min:0|max:100',
            'dribbling' => 'nullable|integer|min:0|max:100',
            'defense' => 'nullable|integer|min:0|max:100',
            'catatan' => 'nullable|string',
            'tanggal_penilaian' => 'nullable|date',
        ]);

        Performa::create($request->all());

        $performa = Performa::where('pemain_id', $request->pemain_id)
            ->where('latihan_id', $request->latihan_id)
            ->first();
        if ($performa) {
            $this->logActivity($performa, 'create', $request->all());
        }

        return redirect()->route('admin.performa.index')
            ->with('success', 'Data performa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $performa = Performa::findOrFail($id);
        $pemains = Pemain::all();
        $latihans = Latihan::all();
        $pelatihs = Pelatih::all();

        return view('admin.performa.edit', compact('performa', 'pemains', 'latihans', 'pelatihs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pemain_id' => 'required|exists:pemains,id',
            'latihan_id' => 'required|exists:latihans,id',
            'pelatih_id' => 'nullable|exists:pelatihs,id',
            'stamina' => 'nullable|integer|min:0|max:100',
            'speed' => 'nullable|integer|min:0|max:100',
            'shooting' => 'nullable|integer|min:0|max:100',
            'passing' => 'nullable|integer|min:0|max:100',
            'dribbling' => 'nullable|integer|min:0|max:100',
            'defense' => 'nullable|integer|min:0|max:100',
            'catatan' => 'nullable|string',
            'tanggal_penilaian' => 'nullable|date',
        ]);

        $performa = Performa::findOrFail($id);
        $data = $request->all();
        $performa->update($data);

        $this->logActivity($performa, 'update', $data);

        return redirect()->route('admin.performa.index')
            ->with('success', 'Data performa berhasil diupdate');
    }

    public function destroy($id)
    {
        $performa = Performa::findOrFail($id);
        $performaData = $performa->toArray();
        $performa->delete();

        $this->logActivity($performa, 'delete', $performaData);

        return redirect()->route('admin.performa.index')
            ->with('success', 'Data performa berhasil dihapus');
    }
    public function grafik(Request $request)
{
    $pemains = \App\Models\Pemain::all();

    $selectedPemain = $request->pemain_id;

    $labels = [];
    $data = [];

    if ($selectedPemain) {
        $performas = \App\Models\Performa::where('pemain_id', $selectedPemain)
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

    return view('admin.performa.grafik', compact('pemains', 'selectedPemain', 'labels', 'data'));
}
}