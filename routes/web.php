<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemainController;
use App\Http\Controllers\PelatihController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\PerformaController;
use App\Http\Controllers\PemainAreaController;
use App\Http\Controllers\PelatihAreaController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($role === 'pelatih') {
        return redirect()->route('pelatih.dashboard');
    } else {
        return redirect()->route('pemain.dashboard');
    }
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    // CRUD Pemain
    Route::get('/admin/pemain', [PemainController::class, 'index'])->name('admin.pemain.index');
    Route::get('/admin/pemain/create', [PemainController::class, 'create'])->name('admin.pemain.create');
    Route::post('/admin/pemain/store', [PemainController::class, 'store'])->name('admin.pemain.store');
    Route::get('/admin/pemain/{id}/edit', [PemainController::class, 'edit'])->name('admin.pemain.edit');
    Route::put('/admin/pemain/{id}', [PemainController::class, 'update'])->name('admin.pemain.update');
    Route::delete('/admin/pemain/{id}', [PemainController::class, 'destroy'])->name('admin.pemain.destroy');

    Route::get('/admin/laporan/performa', [LaporanController::class, 'performa'])->name('admin.laporan.performa');
    Route::get('/admin/laporan/performa/export', [LaporanController::class, 'exportPerforma'])->name('admin.laporan.performa.export');

    // CRUD Pelatih
    Route::get('/admin/pelatih', [PelatihController::class, 'index'])->name('admin.pelatih.index');
    Route::get('/admin/pelatih/create', [PelatihController::class, 'create'])->name('admin.pelatih.create');
    Route::post('/admin/pelatih/store', [PelatihController::class, 'store'])->name('admin.pelatih.store');
    Route::get('/admin/pelatih/{id}/edit', [PelatihController::class, 'edit'])->name('admin.pelatih.edit');
    Route::put('/admin/pelatih/{id}', [PelatihController::class, 'update'])->name('admin.pelatih.update');
    Route::delete('/admin/pelatih/{id}', [PelatihController::class, 'destroy'])->name('admin.pelatih.destroy');

    // CRUD Latihan
    Route::get('/admin/latihan', [LatihanController::class, 'index'])->name('admin.latihan.index');
    Route::get('/admin/latihan/create', [LatihanController::class, 'create'])->name('admin.latihan.create');
    Route::post('/admin/latihan/store', [LatihanController::class, 'store'])->name('admin.latihan.store');
    Route::get('/admin/latihan/{id}/edit', [LatihanController::class, 'edit'])->name('admin.latihan.edit');
    Route::put('/admin/latihan/{id}', [LatihanController::class, 'update'])->name('admin.latihan.update');
    Route::delete('/admin/latihan/{id}', [LatihanController::class, 'destroy'])->name('admin.latihan.destroy');

// CRUD Presensi
    Route::get('/admin/presensi', [PresensiController::class, 'index'])->name('admin.presensi.index');
    Route::get('/admin/presensi/create', [PresensiController::class, 'create'])->name('admin.presensi.create');
    Route::post('/admin/presensi/store', [PresensiController::class, 'store'])->name('admin.presensi.store');
    Route::get('/admin/presensi/{id}/edit', [PresensiController::class, 'edit'])->name('admin.presensi.edit');
    Route::put('/admin/presensi/{id}', [PresensiController::class, 'update'])->name('admin.presensi.update');
    Route::delete('/admin/presensi/{id}', [PresensiController::class, 'destroy'])->name('admin.presensi.destroy');

// CRUD Performa
Route::get('/admin/performa', [PerformaController::class, 'index'])->name('admin.performa.index');
Route::get('/admin/performa/create', [PerformaController::class, 'create'])->name('admin.performa.create');
Route::post('/admin/performa/store', [PerformaController::class, 'store'])->name('admin.performa.store');
Route::get('/admin/performa/grafik', [PerformaController::class, 'grafik'])->name('admin.performa.grafik');
Route::get('/admin/performa/{id}/edit', [PerformaController::class, 'edit'])->name('admin.performa.edit');
Route::put('/admin/performa/{id}', [PerformaController::class, 'update'])->name('admin.performa.update');
Route::delete('/admin/performa/{id}', [PerformaController::class, 'destroy'])->name('admin.performa.destroy');
});

Route::middleware(['auth', 'role:pelatih'])->group(function () {
    Route::get('/pelatih/dashboard', [DashboardController::class, 'pelatih'])->name('pelatih.dashboard');

    Route::get('/pelatih/pemain', [PelatihAreaController::class, 'pemain'])->name('pelatih.pemain');

    Route::get('/pelatih/presensi', [PelatihAreaController::class, 'presensi'])->name('pelatih.presensi');
    Route::get('/pelatih/presensi/create', [PelatihAreaController::class, 'createPresensi'])->name('pelatih.presensi.create');
    Route::post('/pelatih/presensi/store', [PelatihAreaController::class, 'storePresensi'])->name('pelatih.presensi.store');

    Route::get('/pelatih/performa', [PelatihAreaController::class, 'performa'])->name('pelatih.performa');
    Route::get('/pelatih/performa/create', [PelatihAreaController::class, 'createPerforma'])->name('pelatih.performa.create');
    Route::post('/pelatih/performa/store', [PelatihAreaController::class, 'storePerforma'])->name('pelatih.performa.store');

    Route::get('/pelatih/grafik', [PelatihAreaController::class, 'grafik'])->name('pelatih.grafik');

    Route::get('/pelatih/laporan/performa', [LaporanController::class, 'performa'])->name('pelatih.laporan.performa');
    Route::get('/pelatih/laporan/performa/export', [LaporanController::class, 'exportPerforma'])->name('pelatih.laporan.performa.export');
});

Route::middleware(['auth', 'role:pemain'])->group(function () {
    Route::get('/pemain/dashboard', [DashboardController::class, 'pemain'])->name('pemain.dashboard');

     Route::get('/pemain/profil', [PemainAreaController::class, 'profil'])->name('pemain.profil');
    Route::get('/pemain/profil/edit', [PemainAreaController::class, 'editProfil'])->name('pemain.profil.edit');
    Route::put('/pemain/profil/update', [PemainAreaController::class, 'updateProfil'])->name('pemain.profil.update');

    Route::get('/pemain/presensi', [PemainAreaController::class, 'presensi'])->name('pemain.presensi');
    Route::get('/pemain/performa', [PemainAreaController::class, 'performa'])->name('pemain.performa');
    Route::get('/pemain/grafik', [PemainAreaController::class, 'grafik'])->name('pemain.grafik');
});

require __DIR__.'/auth.php';