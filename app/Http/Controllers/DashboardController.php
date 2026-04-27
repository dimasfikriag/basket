<?php

namespace App\Http\Controllers;

use App\Models\Pemain;
use App\Models\Pelatih;
use App\Models\Latihan;
use App\Models\Presensi;
use App\Models\Performa;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalPemain = Pemain::count();
        $totalPelatih = Pelatih::count();
        $totalLatihan = Latihan::count();
        $totalPresensi = Presensi::count();
        $totalPerforma = Performa::count();

        return view('admin.dashboard', compact(
            'totalPemain',
            'totalPelatih',
            'totalLatihan',
            'totalPresensi',
            'totalPerforma'
        ));
    }

    public function pelatih()
    {
        return view('pelatih.dashboard');
    }

    public function pemain()
    {
        return view('pemain.dashboard');
    }
}