@extends('layouts.app')

@section('content')
<h3>Data Kendaraan</h3>
<a href="{{ route('admin.kendaraan.create') }}" class="btn btn-primary mb-3">+ Tambah Kendaraan</a>

<table class="table table-bordered table-striped">
<thead>
<tr>
<th>#</th>
<th>Plat Nomor</th>
<th>Jenis Kendaraan</th>
<th>Warna</th>
<th>Pemilik</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
@foreach($kendaraans as $i => $kendaraan)
<tr>
<td>{{ $kendaraans->firstItem() + $i }}</td>
<td><strong>{{ $kendaraan->plat_nomor }}</strong></td>
<td><span class="badge bg-secondary text-uppercase">{{ $kendaraan->jenis_kendaraan }}</span></td>
<td>{{ $kendaraan->warna ?? '-' }}</td>
<td>{{ $kendaraan->pemilik }}</td>
<td>
<a href="{{ route('admin.kendaraan.edit', $kendaraan->id_kendaraan) }}" class="btn btn-sm btn-warning">Edit</a>
<form action="{{ route('admin.kendaraan.destroy', $kendaraan->id_kendaraan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data kendaraan ini?')">
@csrf @method('DELETE')
<button class="btn btn-sm btn-danger">Hapus</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>

{{ $kendaraans->links() }}
@endsection