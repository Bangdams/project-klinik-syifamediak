@extends('layout.template')
@section('cari')
<form action="{{ url('/cari/pasien') }}" method="post" po class="form-inline mr-auto">
  @csrf
  <ul class="navbar-nav mr-3">
    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    <li><a href="#" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
  </ul>
  <div class="search-element">
      <input class="form-control" name="cari" type="text" placeholder="Search" aria-label="Search" data-width="250">

      <button class="btn" type="submit"><i class="fas fa-search"></i></button>
  </div>
</form>
@endsection

@section('body')
<div class="section-header">
	<h1>Table Data Pasien</h1>
	<div class="section-header-breadcrumb">
	  <div class="breadcrumb-item active"><a href="{{ url('cek') }}">Dashboard</a></div>
	  <div class="breadcrumb-item"><a href="{{ url('dataUser') }}">Tabel Riwayat</a></div>
	  <div class="breadcrumb-item">Table</div>
	</div>
</div>
{{-- Tabel Data Pasien --}}
    
<div class="card datapasien">
    <div class="card-header">
      <h4>Daftar Riwayat Pemeriksaan</h4>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <a href="/cetak-riwayat-pemeriksaan" target=".blank" class="btn btn-primary mb-3" style="margin: 7px;">Cetak Pdf</a>
        <table class="table table-striped table-md">
          <tr>
            <th>#</th>
            <th>No Rekam Medis</th>
            <th>Nama</th>
            <th>Keluhan</th>
            <th>Diagnosa</th>
            <th>Terapi</th>
            <th>Tanggal</th>
            <th>Action</th>
          </tr>
          @foreach ($data as $data)
          @if ($tgl_now == $data->tanggal)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $data->no_pemeriksaan }}</td>
              @if ($data->id_pasien == null)
                <td>{{ $data->nama }}</td>
              @else
                <td>{{ $data->pasienModel->nama_pasien }}</td>
              @endif
              <td>{{ $data->keluhan }}</td>
              <td>{{ $data->diagnosaModel->nama_diagnosa }}</td>
              <td>{{ $data->terapi }}</td>
              <td>{{ $data->tanggal }}</td>
              <td>
                <a href="{{ route('resepObat.show',$data->id_pemeriksaan) }}" class="btn btn-success sm">Lihat Resep</a>
              </td>
            </tr>
          @endif
          @endforeach
        </table>
      </div>
    </div>
</div>
@include('sweetalert::alert')
<script>
  document.getElementById('resep').classList.add('active');
</script>
@endsection