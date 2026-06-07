<?php

namespace App\Http\Controllers;

use App\Models\Pemain;
use App\Models\User;
use Illuminate\Http\Request;

class PemainController extends Controller
{
    public function index()
    {
        $pemains = Pemain::with('user')->latest()->get();
        return view('admin.pemain.index', compact('pemains'));
    }

    public function create()
    {
        $users = User::where('role', 'pemain')->doesntHave('pemain')->get();
        return view('admin.pemain.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'nomor_punggung' => 'nullable|string|max:20',
            'posisi' => 'nullable|string|max:100',
            'tinggi_badan' => 'nullable|integer',
            'berat_badan' => 'nullable|integer',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        Pemain::create($request->all());

        $pemain = Pemain::where('nama_lengkap', $request->nama_lengkap)->first();
        if ($pemain) {
            $this->logActivity($pemain, 'create', $request->all());
        }

        return redirect()->route('admin.pemain.index')
            ->with('success', 'Data pemain berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pemain = Pemain::findOrFail($id);
        $users = User::where('role', 'pemain')
            ->where(function ($query) use ($pemain) {
                $query->doesntHave('pemain')
                      ->orWhere('id', $pemain->user_id);
            })->get();

        return view('admin.pemain.edit', compact('pemain', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'nomor_punggung' => 'nullable|string|max:20',
            'posisi' => 'nullable|string|max:100',
            'tinggi_badan' => 'nullable|integer',
            'berat_badan' => 'nullable|integer',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $pemain = Pemain::findOrFail($id);
        $data = $request->all();
        $pemain->update($data);

        $this->logActivity($pemain, 'update', $data);

        return redirect()->route('admin.pemain.index')
            ->with('success', 'Data pemain berhasil diupdate');
    }

    public function destroy($id)
    {
        $pemain = Pemain::findOrFail($id);
        $pemainData = $pemain->toArray();
        $pemain->delete();

        $this->logActivity($pemain, 'delete', $pemainData);

        return redirect()->route('admin.pemain.index')
            ->with('success', 'Data pemain berhasil dihapus');
    }
}