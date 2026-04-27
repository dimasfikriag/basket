<?php

namespace App\Http\Controllers;

use App\Models\Pelatih;
use App\Models\User;
use App\Models\Latihan;
use Illuminate\Http\Request;

class PelatihController extends Controller
{
    public function index()
    {
        $pelatihs = Pelatih::with('user')->latest()->get();
        return view('admin.pelatih.index', compact('pelatihs'));
    }

    public function create()
    {
        $users = User::where('role', 'pelatih')->doesntHave('pelatih')->get();
        return view('admin.pelatih.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'nama_lengkap' => 'required|string|max:255',
            'lisensi' => 'nullable|string|max:255',
            'spesialisasi' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        Pelatih::create($request->all());

        return redirect()->route('admin.pelatih.index')
            ->with('success', 'Data pelatih berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pelatih = Pelatih::findOrFail($id);

        $users = User::where('role', 'pelatih')
            ->where(function ($query) use ($pelatih) {
                $query->doesntHave('pelatih')
                      ->orWhere('id', $pelatih->user_id);
            })->get();

        return view('admin.pelatih.edit', compact('pelatih', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'nama_lengkap' => 'required|string|max:255',
            'lisensi' => 'nullable|string|max:255',
            'spesialisasi' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $pelatih = Pelatih::findOrFail($id);
        $pelatih->update($request->all());

        return redirect()->route('admin.pelatih.index')
            ->with('success', 'Data pelatih berhasil diupdate');
    }

    public function destroy($id)
    {
        $pelatih = Pelatih::findOrFail($id);
        $pelatih->delete();

        return redirect()->route('admin.pelatih.index')
            ->with('success', 'Data pelatih berhasil dihapus');
    }

    public function latihans()
{
    return $this->hasMany(Latihan::class);
}
}