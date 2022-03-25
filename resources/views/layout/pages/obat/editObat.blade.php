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
	<h1>Form Edit obat {{ $obat->nama_obat }}</h1>
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
  	<form action="{{ route('obat.update', $obat) }}" method="post">
  		@csrf
  		@method('PUT')
	   <div class="form-group">
	      <label>Nama Obat</label>
	      <input type="text" name="nama_obat" class="form-control" value="{{ $obat->nama_obat }}" required="">
	    </div>
	    <div class="form-group">
	      <label>Jenis Obat</label>
	      <input type="text" name="jenis" class="form-control" value="{{ $obat->jenis }}" required="">
	    </div>
	    <div class="form-group">
	      <label>Harga</label>
	      <input type="number" name="harga" class="form-control" value="{{ $obat->harga }}" required="">
	    </div>
	  <div class="card-footer text-right">
	    <button class="btn btn-primary mr-1" type="submit">Simpan Perubahan</button>
	  </div>
    </form>
</div>
<script>
  document.getElementById('data-obat').classList.add('active');
</script>
@endsection