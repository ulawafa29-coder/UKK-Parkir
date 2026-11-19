@extends('layouts.app')
@section('content')
<h3>Catat Kendaraan Masuk</h3>
@if(session('error'))
 <div class="alert alert-danger">{{ session('error') }}</div>
@endif
<form method="POST" action="{{ route('petugas.transaksi.storeMasuk') }}">
 @csrf
 <div class="mb-3">
 <label>Kendaraan</label>
 <select name="id_kendaraan" class="form-select" required>
 @foreach($kendaraans as $k)
 <option value="{{ $k->id_kendaraan }}">{{ $k->plat_nomor }} - {{ $k->pemilik
}}</option>
 @endforeach
 </select>
 </div>
 <div class="mb-3">
 <label>Tarif</label>
 <select name="id_tarif" class="form-select" required>
 @foreach($tarifs as $t)
 <option value="{{ $t->id_tarif }}">{{ ucfirst($t->jenis_kendaraan) }} - Rp{{
number_format($t->tarif_per_jam) }}/jam</option>
 @endforeach
 </select>
 </div>
 <div class="mb-3">
 <label>Area Parkir</label>
  <select name="id_area" class="form-select" required>
 @foreach($areas as $a)
 <option value="{{ $a->id_area }}">{{ $a->nama_area }} ({{ $a->terisi }})</option>
 @endforeach
 </select>
 </div>
 <button class="btn btn-primary">Simpan</button>
</form>
@endsection