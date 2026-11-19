<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\AreaParkir;

class DashboardController extends Controller
{
    public function index()
    {
        $kendaraanParkir = Transaksi::where('status', 'masuk')->count();
        $transaksiHariIni = Transaksi::whereDate('waktu_masuk', today())->count();
        $areas = AreaParkir::all();
        $transaksisAktif = Transaksi::with(['kendaraan', 'area'])
            ->where('status', 'masuk')
            ->latest('waktu_masuk')
            ->take(5)
            ->get();

        return view('petugas.dashboard', compact('kendaraanParkir', 'transaksiHariIni', 'areas', 'transaksisAktif'));
    }
}