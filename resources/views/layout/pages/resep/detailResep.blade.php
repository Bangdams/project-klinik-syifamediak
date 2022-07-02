@extends('layout.template')

@section('body')
<div class="section-header">
  <h1>Table Detail Resep Pasien</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="{{ url('cek') }}">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="{{ url('dataUser') }}">Tabel Pasien</a></div>
    <div class="breadcrumb-item">Table</div>
  </div>
</div>
{{-- Tabel Data Pasien --}}
    
<div class="card datapasien">
    <div class="card-header">
      <h4>Data Semua Pasien</h4>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped table-md">
          <tr>
            <th>#</th>
            <th>Nama Obat</th>
            <th>Jumlah Obat</th>
            <th>Status</th>
          </tr>
          @foreach ($resep as $r)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $r->obatModel->nama_obat }}</td>
            <td>{{ $r->jumlah }}</td>
            <td>{{ $r->status  }}</td>
          </tr>
          @endforeach
          <tr><td></td></tr>
          <tr>
            <td colspan="3"><b>Harga</b></td>
            <td>Rp.{{ number_format($total) }}</td>
          </tr>
        </table>
        <a href="/dataPemeriksaan" class="btn btn-success m-2 mt-3">Kembali</a>
      </div>
    </div>
</div>
@include('sweetalert::alert')
<script>
  document.getElementById('resep').classList.add('active');
</script>
@endsection