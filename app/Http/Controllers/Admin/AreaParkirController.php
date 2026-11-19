<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AreaParkir;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class AreaParkirController extends Controller
{
    public function index()
    {
        $areas = AreaParkir::latest('id_area')->paginate(10);
        return view('admin.area.index', compact('areas'));
    }

    public function create()
    {
        return view('admin.area.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_area' => 'required|string|max:100|unique:tb_area_parkir,nama_area',
            'kapasitas' => 'required|integer|min:1',
        ]);

        AreaParkir::create([
            'nama_area' => $request->nama_area,
            'kapasitas' => $request->kapasitas,
            'terisi' => 0,
        ]);

        LogAktivitas::create([
            'id_user' => auth()->id(),
            'aktivitas' => 'Menambahkan area parkir baru: ' . $request->nama_area,
            'waktu_aktivitas' => now(),
        ]);

        return redirect()->route('admin.area.index')->with('success', 'Area parkir berhasil ditambahkan.');
    }

    public function edit(AreaParkir $area)
    {
        return view('admin.area.edit', compact('area'));
    }

    public function update(Request $request, AreaParkir $area)
    {
        $request->validate([
            'nama_area' => 'required|string|max:100|unique:tb_area_parkir,nama_area,' . $area->id_area . ',id_area',
            'kapasitas' => 'required|integer|min:1',
        ]);

        if ($request->kapasitas < $area->terisi) {
            return back()->withErrors(['kapasitas' => 'Kapasitas baru tidak boleh lebih kecil dari jumlah kendaraan yang sedang terisi (' . $area->terisi . ').']);
        }

        $area->update([
            'nama_area' => $request->nama_area,
            'kapasitas' => $request->kapasitas,
        ]);

        LogAktivitas::create([
            'id_user' => auth()->id(),
            'aktivitas' => 'Memperbarui area parkir: ' . $request->nama_area,
            'waktu_aktivitas' => now(),
        ]);

        return redirect()->route('admin.area.index')->with('success', 'Area parkir berhasil diperbarui.');
    }

    public function destroy(AreaParkir $area)
    {
        if ($area->terisi > 0) {
            return redirect()->route('admin.area.index')->with('error', 'Area parkir tidak dapat dihapus karena masih ada kendaraan di dalamnya!');
        }

        $namaArea = $area->nama_area;
        $area->delete();

        LogAktivitas::create([
            'id_user' => auth()->id(),
            'aktivitas' => 'Menghapus area parkir: ' . $namaArea,
            'waktu_aktivitas' => now(),
        ]);

        return redirect()->route('admin.area.index')->with('success', 'Area parkir berhasil dihapus.');
    }
}