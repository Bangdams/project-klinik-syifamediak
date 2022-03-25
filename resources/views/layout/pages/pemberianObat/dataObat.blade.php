@extends('layout.template')
@section('cari')
<form action="{{ url('/cari') }}" method="post" po class="form-inline mr-auto">
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
  <h1>Daftar Resep Pasien</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="{{ url('dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="{{ url('rekapObat') }}">Tabel Rekap Obat</a></div>
    <div class="breadcrumb-item">Table</div>
  </div>
</div>
<div class="card">
  <div class="card-header">
    <h4>Daftar Resep Pasien</h4>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped" id="table-1">
        <thead>
          <tr>
            <th>
              #
            </th>
            <th>No Pemeriksaan</th>
            <th>Nama Pasien</th>
            <th>Tanggal</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($obat as $b)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $b->pemeriksaanModel->no_pemeriksaan }}</td>
            <td>{{ $b->pemeriksaanModel->pasienModel->nama_pasien }}</td>
            <td>{{ $b->pemeriksaanModel->tanggal }}</td>
            <td><a href="{{ route('resepObat.edit', $b->id_pemeriksaan) }}" class="btn btn-primary">Detail</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@include('sweetalert::alert')
<script>
  document.getElementById('resep').classList.add('active');
</script>
@endsection