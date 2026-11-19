@extends('layouts.app')

@section('content')
<h3>Tambah Area Parkir</h3>

<form method="POST" action="{{ route('admin.area.store') }}">
@csrf
<div class="mb-3">
<label class="form-label">Nama Area Parkir</label>
<input type="text" name="nama_area" class="form-control" placeholder="Contoh: Area A - Basement" required>
</div>

<div class="mb-3">
<label class="form-label">Kapasitas Maksimal</label>
<input type="number" name="kapasitas" class="form-control" min="1" placeholder="Contoh: 50" required>
</div>

<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('admin.area.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection