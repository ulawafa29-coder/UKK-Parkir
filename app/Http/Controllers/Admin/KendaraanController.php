<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::with('user')->latest()->paginate(10);
        return view('admin.kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        return view('admin.kendaraan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'plat_nomor' => 'required|string|max:15|unique:tb_kendaraan,plat_nomor',
            'jenis_kendaraan' => 'required|in:motor,mobil,lainnya',
            'warna' => 'nullable|string|max:30',
            'pemilik' => 'required|string|max:100',
        ]);

        $platNomor = strtoupper(trim($request->plat_nomor));

        Kendaraan::create([
            'plat_nomor' => $platNomor,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'warna' => $request->warna,
            'pemilik' => $request->pemilik,
            'id_user' => auth()->id(),
        ]);

        LogAktivitas::create([
            'id_user' => auth()->id(),
            'aktivitas' => 'Menambahkan data kendaraan baru dengan plat nomor: ' . $platNomor,
            'waktu_aktivitas' => now(),
        ]);

        return redirect()->route('admin.kendaraan.index')->with('success', 'Data kendaraan berhasil ditambahkan.');
    }

    public function edit(Kendaraan $kendaraan)
    {
        return view('admin.kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, Kendaraan $kendaraan)
    {
        $request->validate([
            'plat_nomor' => 'required|string|max:15|unique:tb_kendaraan,plat_nomor,' . $kendaraan->id_kendaraan . ',id_kendaraan',
            'jenis_kendaraan' => 'required|in:motor,mobil,lainnya',
            'warna' => 'nullable|string|max:30',
            'pemilik' => 'required|string|max:100',
        ]);

        $platNomor = strtoupper(trim($request->plat_nomor));

        $kendaraan->update([
            'plat_nomor' => $platNomor,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'warna' => $request->warna,
            'pemilik' => $request->pemilik,
        ]);

        LogAktivitas::create([
            'id_user' => auth()->id(),
            'aktivitas' => 'Memperbarui data kendaraan plat nomor: ' . $platNomor,
            'waktu_aktivitas' => now(),
        ]);

        return redirect()->route('admin.kendaraan.index')->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    public function destroy(Kendaraan $kendaraan)
    {
        $platNomor = $kendaraan->plat_nomor;
        $kendaraan->delete();

        LogAktivitas::create([
            'id_user' => auth()->id(),
            'aktivitas' => 'Menghapus data kendaraan dengan plat nomor: ' . $platNomor,
            'waktu_aktivitas' => now(),
        ]);

        return redirect()->route('admin.kendaraan.index')->with('success', 'Data kendaraan berhasil dihapus.');
    }
}