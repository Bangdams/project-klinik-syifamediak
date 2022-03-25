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
	<h1>Form Edit Pasien {{ $dataPasien->nama }}</h1>
	<div class="section-header-breadcrumb">
	  <div class="breadcrumb-item active"><a href="{{ url('cek') }}">Pendaftaran</a></div>
	  <div class="breadcrumb-item"><a href="{{ url('dataUser') }}">Edit Pasien</a></div>
	  <div class="breadcrumb-item">Form</div>
	</div>
</div>
<div class="card">
  <div class="card-header">
    <h4>Silahkan Isi From Di Bawah ini</h4>
  </div>
  <div class="card-body">
  	<form action="{{ route('dataPasien.update', $dataPasien) }}" method="post">
  		@csrf
  		@method('PUT')
	   <div class="form-group">
	      <label>Nama</label>
	      <input type="text" name="nama_pasien" class="form-control" value="{{ $dataPasien->nama_pasien }}" required="">
	    </div>
	    <div class="form-group">
	      <label>Alamat</label>
	      <input type="text" name="alamat" class="form-control" value="{{ $dataPasien->alamat }}" required="">
	    </div>
	    <div class="form-group">
	      <label>Tanggal Lahir</label>
	      <input type="date" name="tgl_lahir" class="form-control" value="{{ $dataPasien->tgl_lahir }}" required="">
	    </div>
	    <div class="form-group">
	      <label>Nomer Hp</label>
	      <input type="number" name="no_telepon" class="form-control" value="{{ $dataPasien->no_telepon }}" required="">
	    </div>
	    <div class="form-group">
	      <label>No KTP</label>
	      <input type="text" name="no_ktp" class="form-control" value="{{ $dataPasien->no_ktp }}" required="">
	    </div>
	    <div class="form-group">
	      <label>No BPJS</label>
	      <input type="text" name="no_bpjs" value="{{ $dataPasien->no_bpjs }}" class="form-control">
	    </div>
	    <?php
	    	if ($dataPasien->jk == 'L') {
	    		$l = 'checked';
	    	}else{
	    		$l = '';
	    	}

	    	if ($dataPasien->jk == 'P') {
	    		$p = 'checked';
	    	}else{
	    		$p = '';
	    	}
		?>
	    <div class="form-group">
	      <div class="control-label">Jenis Kelamin</div>
	      <div class="custom-switches-stacked mt-2">
	        <label class="custom-switch">
	          <input type="radio" name="jk" {{ $l }} value="L" class="custom-switch-input">
	          <span class="custom-switch-indicator"></span>
	          <span class="custom-switch-description">Laki-Laki</span>
	        </label>
	        <label class="custom-switch">
	          <input type="radio" name="jk" {{ $p }} value="P" class="custom-switch-input">
	          <span class="custom-switch-indicator"></span>
	          <span class="custom-switch-description">Perempuan</span>
	        </label>
	      </div>
	    </div>
	  <div class="card-footer text-right">
	    <button class="btn btn-primary mr-1" type="submit">Simpan Perubahan</button>
	  </div>
    </form>
</div>
<script>
  document.getElementById('pendaftaran').classList.add('active');
</script>
@endsection