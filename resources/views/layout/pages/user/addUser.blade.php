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
    <h4>Tambah Data User</h4>
  </div>
  <div class="card-body">
  	<form action="{{ route('dataUsers.store') }}" method="post">
  		@csrf
	   <div class="form-group">
	      <label>Nama</label>
	      <input type="text" name="name" @error('name') value="" @enderror value="{{ old('nama') }}" class="form-control" required="" placeholder="Isi Nama">
	      @error('name')
	      	<p style="color:red;">-{{ $message }}</p>
	      @enderror
	    </div>

	    <div class="form-group">
	      <label>Email</label>
	      <input type="email" name="email" @error('email') value="" @enderror value="{{ old('email') }}" class="form-control" required="" placeholder="Isi Email">
	      @error('email')
	      	<p style="color:red;">-{{ $message }}</p>
	      @enderror
	    </div>

	    <div class="form-group">
	      <label>Password</label>
	      <input type="password" name="password" class="form-control" placeholder="Isi Password Minimal 5 Huruf">
	      @error('password')
	      	<p style="color:red;">-{{ $message }}</p>
	      @enderror
	    </div>

	    <div class="form-group">
	      <div class="control-label">Hak Akses</div>
	      <div class="custom-switches-stacked mt-2">
	        <label class="custom-switch">
	          <input type="radio" name="level" value="dokter" class="custom-switch-input dokter">
	          <span class="custom-switch-indicator"></span>
	          <span class="custom-switch-description">Dokter</span>
	        </label>
	        <label class="custom-switch">
	          <input type="radio" name="level" value="apoteker" class="custom-switch-input apoteker">
	          <span class="custom-switch-indicator"></span>
	          <span class="custom-switch-description">Apoteker</span>
	        </label>
	        @error('level')
	      		<p style="color:red;">-{{ $message }}</p>
	        @enderror
	      </div>
	    </div>

	    <div class="form-group poli">
		    <label>Pilih Poli</label>
		    <select name="poli" class="form-control">
		       <option value="">-- Pilih Poli --</option>
		       <option value="umum">Umum</option>
		       <option value="bidan">Bidan</option>
		    </select>
		  </div>

	  <div class="card-footer text-right">
	    <button class="btn btn-primary mr-1" type="submit">Simpan</button>
	  </div>
    </form>
</div>
<script>
  $(document).ready(function() {

    $(".poli").hide() ;

    //jika class poli di tekan maka jalankan ini 
    $(".dokter").click(function(){
      $(".poli").show() ;
    });
		
		//jika class admin di tekan maka jalankan ini 
    $(".admin").click(function(){
      $(".poli").hide() ;
    });

    //jika class apoteker di tekan maka jalankan ini 
    $(".apoteker").click(function(){
      $(".poli").hide() ;
    });

  });

  document.getElementById('dashboard').classList.add('active');
</script>
@endsection