@extends('layouts.app')

@section('content')
<h3>Tambah Tarif Parkir</h3>

<form method="POST" action="{{ route('admin.tarif.store') }}">
@csrf
<div class="mb-3">
<label class="form-label">Jenis Kendaraan</label>
<select name="jenis_kendaraan" class="form-select" required>
<option value="motor">Motor</option>
<option value="mobil">Mobil</option>
<option value="lainnya">Lainnya</option>
</select>
</div>

<div class="mb-3">
<label class="form-label">Tarif per Jam (Rp)</label>
<input type="number" name="tarif_per_jam" class="form-control" min="0" required>
</div>

<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('admin.tarif.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection