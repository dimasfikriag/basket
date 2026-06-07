<?php

namespace App\Http\Controllers;

use App\Models\Latihan;
use App\Models\Pelatih;
use Illuminate\Http\Request;

class LatihanController extends Controller
{
    public function index()
    {
        $latihans = Latihan::with('pelatih')->latest()->get();
        return view('admin.latihan.index', compact('latihans'));
    }

    public function create()
    {
        $pelatihs = Pelatih::all();
        return view('admin.latihan.create', compact('pelatihs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelatih_id' => 'nullable|exists:pelatihs,id',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'lokasi' => 'required|string|max:255',
            'materi_latihan' => 'nullable|string',
        ]);

        Latihan::create($request->all());

        $latihan = Latihan::where('tanggal', $request->tanggal)
            ->where('jam', $request->jam)
            ->first();
        if ($latihan) {
            $this->logActivity($latihan, 'create', $request->all());
        }

        return redirect()->route('admin.latihan.index')
            ->with('success', 'Data latihan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $latihan = Latihan::findOrFail($id);
        $pelatihs = Pelatih::all();

        return view('admin.latihan.edit', compact('latihan', 'pelatihs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pelatih_id' => 'nullable|exists:pelatihs,id',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'lokasi' => 'required|string|max:255',
            'materi_latihan' => 'nullable|string',
        ]);

        $latihan = Latihan::findOrFail($id);
        $data = $request->all();
        $latihan->update($data);

        $this->logActivity($latihan, 'update', $data);

        return redirect()->route('admin.latihan.index')
            ->with('success', 'Data latihan berhasil diupdate');
    }

    public function destroy($id)
    {
        $latihan = Latihan::findOrFail($id);
        $latihanData = $latihan->toArray();
        $latihan->delete();

        $this->logActivity($latihan, 'delete', $latihanData);

        return redirect()->route('admin.latihan.index')
            ->with('success', 'Data latihan berhasil dihapus');
    }
}