@extends('layouts.app')

@section('content')
<h3>Tambah Kendaraan</h3>

<form method="POST" action="{{ route('admin.kendaraan.store') }}">
@csrf
<div class="mb-3">
<label class="form-label">Plat Nomor</label>
<input type="text" name="plat_nomor" class="form-control" placeholder="Contoh: B 1234 XYZ" required>
</div>

<div class="mb-3">
<label class="form-label">Jenis Kendaraan</label>
<select name="jenis_kendaraan" class="form-select" required>
<option value="motor">Motor</option>
<option value="mobil">Mobil</option>
<option value="lainnya">Lainnya</option>
</select>
</div>

<div class="mb-3">
<label class="form-label">Warna</label>
<input type="text" name="warna" class="form-control" placeholder="Contoh: Hitam">
</div>

<div class="mb-3">
<label class="form-label">Pemilik</label>
<input type="text" name="pemilik" class="form-control" placeholder="Nama Pemilik" required>
</div>

<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('admin.kendaraan.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection