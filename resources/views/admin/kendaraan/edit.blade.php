@extends('layouts.app')

@section('content')
<h3>Edit Kendaraan</h3>

<form method="POST" action="{{ route('admin.kendaraan.update', $kendaraan->id_kendaraan) }}">
@csrf 
@method('PUT')

<div class="mb-3">
<label class="form-label">Plat Nomor</label>
<input type="text" name="plat_nomor" class="form-control" value="{{ $kendaraan->plat_nomor }}" required>
</div>

<div class="mb-3">
<label class="form-label">Jenis Kendaraan</label>
<select name="jenis_kendaraan" class="form-select" required>
<option value="motor" @selected($kendaraan->jenis_kendaraan == 'motor')>Motor</option>
<option value="mobil" @selected($kendaraan->jenis_kendaraan == 'mobil')>Mobil</option>
<option value="lainnya" @selected($kendaraan->jenis_kendaraan == 'lainnya')>Lainnya</option>
</select>
</div>

<div class="mb-3">
<label class="form-label">Warna</label>
<input type="text" name="warna" class="form-control" value="{{ $kendaraan->warna }}">
</div>

<div class="mb-3">
<label class="form-label">Pemilik</label>
<input type="text" name="pemilik" class="form-control" value="{{ $kendaraan->pemilik }}" required>
</div>

<button type="submit" class="btn btn-primary">Update</button>
<a href="{{ route('admin.kendaraan.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection