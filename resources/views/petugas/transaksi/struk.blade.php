@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Struk Parkir #{{ $transaksi->id_transaksi }}</title>
</head>
<body onload="window.print()">

<div class="center">
    <h4>APLIKASI PARKIR</h4>
    <p>Jl. Raya Perkantoran No. 1</p>
</div>
<div class="line"></div>
<p>No Transaksi : #{{ $transaksi->id_transaksi }}</p>
<p>Plat Nomor   : <strong>{{ $transaksi->kendaraan->plat_nomor }}</strong></p>
<p>Jenis        : {{ ucfirst($transaksi->kendaraan->jenis_kendaraan) }}</p>
<p>Area         : {{ $transaksi->area->nama_area }}</p>
<p>Masuk        : {{ $transaksi->waktu_masuk }}</p>
<p>Keluar       : {{ $transaksi->waktu_keluar }}</p>
<p>Durasi       : {{ $transaksi->durasi_jam }} Jam</p>
<div class="line"></div>
<p><strong>Total Biaya  : Rp {{ number_format($transaksi->total_biaya, 0, ',', '.') }}</strong></p>
<div class="line"></div>
<div class="center">
    <p>Petugas: {{ $transaksi->user->nama_lengkap ?? '-' }}</p>
    <p>Terima Kasih</p>
</div>

</body>
</html>
@endsection
