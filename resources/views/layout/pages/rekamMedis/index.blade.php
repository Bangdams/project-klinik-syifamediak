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
          @foreach ($data as $b)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $b->pemeriksaanModel->no_pemeriksaan??'' }}</td>
            @if ($b->pemeriksaanModel->id_pasien == null)
              <td>{{ $b->pemeriksaanModel->nama }}</td>
            @else
              <td>{{ $b->pemeriksaanModel->pasienModel->nama_pasien??'' }}</td>
            @endif
            <td>{{ $b->pemeriksaanModel->tanggal??'' }}</td>
            <td>
              @if ($b->pemeriksaanModel->id_pasien == null)
                <a class="btn btn-primary detail-rm" style="color: white;" data-toggle="modal" data-target="#cek"
                data-nomer="{{ $b->pemeriksaanModel->no_pemeriksaan }}"
                data-nama="{{ $b->pemeriksaanModel->nama }}"
                data-keluhan="{{ $b->pemeriksaanModel->keluhan }}"
                data-diagnosa="{{ $b->pemeriksaanModel->diagnosaModel->nama_diagnosa }}"
                data-terapi="{{ $b->pemeriksaanModel->terapi }}"
                data-tanggal="{{ $b->pemeriksaanModel->tanggal }}">Detail</a>
              @else
                <a class="btn btn-primary detail-rm" style="color: white;" data-toggle="modal" data-target="#cek"
                data-nomer="{{ $b->pemeriksaanModel->no_pemeriksaan }}"
                data-nama="{{ $b->pemeriksaanModel->pasienModel->nama_pasien }}"
                data-keluhan="{{ $b->pemeriksaanModel->keluhan }}"
                data-diagnosa="{{ $b->pemeriksaanModel->diagnosaModel->nama_diagnosa }}"
                data-terapi="{{ $b->pemeriksaanModel->terapi }}"
                data-tanggal="{{ $b->pemeriksaanModel->tanggal }}">Detail</a>
              @endif
            </td>
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