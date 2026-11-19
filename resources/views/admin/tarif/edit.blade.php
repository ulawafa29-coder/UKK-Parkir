@extends('layouts.app')

@section('content')
<h3>Edit Tarif Parkir</h3>

<form method="POST" action="{{ route('admin.tarif.update', $tarif->id_tarif) }}">
@csrf 
@method('PUT')

<div class="mb-3">
<label class="form-label">Jenis Kendaraan</label>
<select name="jenis_kendaraan" class="form-select" required>
<option value="motor" @selected($tarif->jenis_kendaraan == 'motor')>Motor</option>
<option value="mobil" @selected($tarif->jenis_kendaraan == 'mobil')>Mobil</option>
<option value="lainnya" @selected($tarif->jenis_kendaraan == 'lainnya')>Lainnya</option>
</select>
</div>

<div class="mb-3">
<label class="form-label">Tarif per Jam (Rp)</label>
<input type="number" name="tarif_per_jam" class="form-control" value="{{ $tarif->tarif_per_jam }}" min="0" required>
</div>

<button type="submit" class="btn btn-primary">Update</button>
<a href="{{ route('admin.tarif.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection