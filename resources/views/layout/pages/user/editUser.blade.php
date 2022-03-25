@extends('layout.template')
@section('cari')
<form action="{{ url('/cari/user') }}" method="post" po class="form-inline mr-auto">
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
<div class="card">
  <div class="card-header">
    <h4>Edit Data User {{ $dataUsers->nama }}</h4>
  </div>
  <div class="card-body">
  	<form action="{{ route('dataUsers.update', $dataUsers) }}" method="post">
  		@csrf
  		@method('PUT')
	   <div class="form-group">
	      <label>Nama</label>
	      <input type="text" name="name" class="form-control" value="{{ $dataUsers->name }}" required="">
	      @error('name')
	      	<p style="color:red;">-{{ $message }}</p>
	      @enderror
	    </div>
	    <div class="form-group">
	      <label>Email</label>
	      <input type="email" name="email" class="form-control" value="{{ $dataUsers->email }}" required="">
	      @error('email')
	      	<p style="color:red;">-{{ $message }}</p>
	      @enderror
	    </div>
	    <div class="form-group">
	      <label>Password</label>
	      <input type="password" name="password" class="form-control" placeholder="silahkan isi kalau lupa password">
	    </div>
	    <?php
	    	if ($dataUsers->level == 'admin') {
	    		$a = 'checked';
	    	}else{
	    		$a = '';
	    	}
	    	if ($dataUsers->level == 'dokter') {
	    		$d = 'checked';
	    	} else {
	    		$d = '';
	    	}
	    	if ($dataUsers->level == 'apoteker') {
	    		$ap = 'checked';
	    	} else {
	    		$ap = '';
	    	}
		?>
	    <div class="form-group">
	      <div class="control-label">Level</div>
	      <div class="custom-switches-stacked mt-2">
	        <label class="custom-switch">
	          <input type="radio" name="level" value="admin" class="custom-switch-input" {{ $a }}>
	          <span class="custom-switch-indicator"></span>
	          <span class="custom-switch-description">Admin</span>
	        </label>
	        <label class="custom-switch">
	          <input type="radio" name="level" value="dokter" class="custom-switch-input" {{ $d }}>
	          <span class="custom-switch-indicator"></span>
	          <span class="custom-switch-description">Dokter</span>
	        </label>
	        <label class="custom-switch">
	          <input type="radio" name="level" value="apoteker" class="custom-switch-input" {{ $ap }}>
	          <span class="custom-switch-indicator"></span>
	          <span class="custom-switch-description">Apoteker</span>
	        </label>
	      </div>
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