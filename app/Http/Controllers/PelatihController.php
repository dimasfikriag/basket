<?php

namespace App\Http\Controllers;

use App\Models\Pelatih;
use App\Models\User;
use App\Models\Latihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'email' => 'required_without:user_id|nullable|string|email|max:255|unique:users,email',
            'password' => 'required_with:email|nullable|string|min:8',
            'nama_lengkap' => 'required|string|max:255',
            'lisensi' => 'nullable|string|max:255',
            'spesialisasi' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $data = $request->only([
            'user_id',
            'nama_lengkap',
            'lisensi',
            'spesialisasi',
            'no_hp',
            'alamat',
        ]);

        if (! $request->filled('user_id') && $request->filled('email')) {
            $user = User::create([
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'pelatih',
            ]);

            $data['user_id'] = $user->id;
        }

        Pelatih::create($data);

        $pelatih = Pelatih::where('nama_lengkap', $data['nama_lengkap'])->first();
        if ($pelatih) {
            $this->logActivity($pelatih, 'create', $data);
        }

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
            'password' => 'nullable|string|min:8',
            'nama_lengkap' => 'required|string|max:255',
            'lisensi' => 'nullable|string|max:255',
            'spesialisasi' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $pelatih = Pelatih::findOrFail($id);
        $data = $request->only([
            'user_id',
            'nama_lengkap',
            'lisensi',
            'spesialisasi',
            'no_hp',
            'alamat',
        ]);

        $pelatih->update($data);

        if ($request->filled('password') && $pelatih->user) {
            $pelatih->user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $this->logActivity($pelatih, 'update', $data);

        return redirect()->route('admin.pelatih.index')
            ->with('success', 'Data pelatih berhasil diupdate');
    }

    public function destroy($id)
    {
        $pelatih = Pelatih::findOrFail($id);
        $pelatihData = $pelatih->toArray();
        $pelatih->delete();

        $this->logActivity($pelatih, 'delete', $pelatihData);

        return redirect()->route('admin.pelatih.index')
            ->with('success', 'Data pelatih berhasil dihapus');
    }
}
