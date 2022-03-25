@extends('layout.template')
@section('cari')
<form action="{{ url('/cari/obat') }}" method="post" po class="form-inline mr-auto">
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
  <h1>Form Edit Diagnosa</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="{{ url('obat') }}">Data obat</a></div>
    <div class="breadcrumb-item"><a href="{{ url('obat') }}">Data Obat</a></div>
    <div class="breadcrumb-item">Form</div>
  </div>
</div>
<div class="card">
  <div class="card-header">
    <h4>Silahkan Isi From Di Bawah ini</h4>
  </div>
  <div class="card-body">
    <form action="{{ route('diagnosa.update',$data) }}" method="post">
      @csrf
      @method('put')
     <div class="form-group">
        <label>Nama Diagnosa</label>
        <input type="text" name="nama_diagnnosa" value="{{ $data->nama_diagnosa }}" class="form-control" required="">
      </div>
    <div class="card-footer text-right">
      <button class="btn btn-primary mr-1" type="submit">Simpan</button>
    </div>
    </form>
</div>
<script>
  document.getElementById('dashboard').classList.add('active');
</script>
@endsection