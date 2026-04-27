<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Latihan;
use App\Models\Pemain;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index()
    {
        $presensis = Presensi::with(['latihan', 'pemain'])->latest()->get();
        return view('admin.presensi.index', compact('presensis'));
    }

    public function create()
    {
        $latihans = Latihan::all();
        $pemains = Pemain::all();

        return view('admin.presensi.create', compact('latihans', 'pemains'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'latihan_id' => 'required|exists:latihans,id',
            'pemain_id' => 'required|exists:pemains,id',
            'status_kehadiran' => 'required|in:hadir,izin,sakit,alpha',
            'keterangan' => 'nullable|string',
        ]);

        Presensi::create($request->all());

        return redirect()->route('admin.presensi.index')
            ->with('success', 'Data presensi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $presensi = Presensi::findOrFail($id);
        $latihans = Latihan::all();
        $pemains = Pemain::all();

        return view('admin.presensi.edit', compact('presensi', 'latihans', 'pemains'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'latihan_id' => 'required|exists:latihans,id',
            'pemain_id' => 'required|exists:pemains,id',
            'status_kehadiran' => 'required|in:hadir,izin,sakit,alpha',
            'keterangan' => 'nullable|string',
        ]);

        $presensi = Presensi::findOrFail($id);
        $presensi->update($request->all());

        return redirect()->route('admin.presensi.index')
            ->with('success', 'Data presensi berhasil diupdate');
    }

    public function destroy($id)
    {
        $presensi = Presensi::findOrFail($id);
        $presensi->delete();

        return redirect()->route('admin.presensi.index')
            ->with('success', 'Data presensi berhasil dihapus');
    }
}