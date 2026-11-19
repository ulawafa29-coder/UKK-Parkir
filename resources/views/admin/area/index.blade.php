@extends('layouts.app')

@section('content')
<h3>Data Area Parkir</h3>
<a href="{{ route('admin.area.create') }}" class="btn btn-primary mb-3">+ Tambah Area Parkir</a>

<table class="table table-bordered table-striped">
<thead>
<tr>
<th>#</th>
<th>Nama Area</th>
<th>Kapasitas</th>
<th>Terisi</th>
<th>Sisa Slot</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
@foreach($areas as $i => $area)
<tr>
<td>{{ $areas->firstItem() + $i }}</td>
<td><strong>{{ $area->nama_area }}</strong></td>
<td>{{ $area->kapasitas }}</td>
<td><span class="badge bg-warning text-dark">{{ $area->terisi }}</span></td>
<td><span class="badge bg-success">{{ $area->kapasitas - $area->terisi }}</span></td>
<td>
<a href="{{ route('admin.area.edit', $area->id_area) }}" class="btn btn-sm btn-warning">Edit</a>
<form action="{{ route('admin.area.destroy', $area->id_area) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus area parkir ini?')">
@csrf @method('DELETE')
<button class="btn btn-sm btn-danger">Hapus</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>

{{ $areas->links() }}
@endsection
