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
  <h1>Daftar Rekam Medis Pasien</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="{{ url('dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="{{ url('rekapObat') }}">Tabel Rekap Obat</a></div>
    <div class="breadcrumb-item">Table</div>
  </div>
</div>
<div class="card">
  <div class="card-header">
    <h4>Rekam Medis Pasien</h4>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      {{-- <form method="get" action="/cari" class="float-right mb-3">
        <input type="text" name="cari" class=".form-control-sm">
        <input type="submit" class="btn btn-primary" value="cari">
      </form> --}}
      <table class="table table-striped" id="table-1">
        <thead>
          <tr>
            <th>
              #
            </th>
            <th>Nama Pasien</th>
            <th>No Ktp</th>
            <th>No Bpjs</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $b)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $b->nama_pasien }}</td>
            <td>{{ $b->no_ktp }}</td>
            <td>{{ $b->no_bpjs }}</td>
            <td><a href="{{ url('detail-rm-pasien', $b->nama_pasien) }}" class="btn btn-success">Detail</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    $(document).on('click', '.detail-rm', function() {
      var nomer = $(this).data('nomer');
      var nama = $(this).data('nama');
      var keluhan = $(this).data('keluhan');
      var diagnosa = $(this).data('diagnosa');
      var terapi = $(this).data('terapi');
      var tanggal = $(this).data('tanggal');
      
      $('#no_pemeriksaan').val(nomer);
      $('#nama').val(nama);
      $('#keluhan').val(keluhan);
      $('#diagnosa').val(diagnosa);
      $('#terapi').val(terapi);
      $('#tanggal').val(tanggal);

    });
  });
</script>
<script>
  document.getElementById('resep').classList.add('active');
</script>
@endsection