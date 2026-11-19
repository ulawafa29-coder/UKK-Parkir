@extends('layouts.app')

@section('content')
<h3>Data Tarif Parkir</h3>
<a href="{{ route('admin.tarif.create') }}" class="btn btn-primary mb-3">+ Tambah Tarif</a>

<table class="table table-bordered table-striped">
<thead>
<tr>
<th>#</th>
<th>Jenis Kendaraan</th>
<th>Tarif per Jam</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
@foreach($tarifs as $i => $tarif)
<tr>
<td>{{ $tarifs->firstItem() + $i }}</td>
<td><span class="badge bg-secondary text-uppercase">{{ $tarif->jenis_kendaraan }}</span></td>
<td>Rp {{ number_format($tarif->tarif_per_jam, 0, ',', '.') }}</td>
<td>
<a href="{{ route('admin.tarif.edit', $tarif->id_tarif) }}" class="btn btn-sm btn-warning">Edit</a>
<form action="{{ route('admin.tarif.destroy', $tarif->id_tarif) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus tarif ini?')">
@csrf @method('DELETE')
<button class="btn btn-sm btn-danger">Hapus</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>

{{ $tarifs->links() }}
@endsection