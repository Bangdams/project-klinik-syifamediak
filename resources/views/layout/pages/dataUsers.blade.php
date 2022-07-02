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
<div class="section-header">
	<h1>Table Data User</h1>
	<div class="section-header-breadcrumb">
	  <div class="breadcrumb-item active"><a href="{{ url('cek') }}">Dashboard</a></div>
	  <div class="breadcrumb-item"><a href="{{ url('dataUser') }}">Tabel User</a></div>
	  <div class="breadcrumb-item">Table</div>
	</div>
</div>

<div class="card">
	 <div class="card-header">
    <h4>Tambah Data</h4>
    <div class="card-header-action">
       {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah</button> --}}
       <a href="{{ url('addUser') }}" class="btn btn-primary">Tambah</a>
    </div>
	  </div>
	 <div class="card-body p-0">
	  <div class="table-responsive">
	    <table class="table table-striped mb-0">
	      <thead>
	        <tr>
	          <th>Email</th>
	          <th>Nama</th>
	          <th>Action</th>
	        </tr>
	      </thead>
	      <tbody>
	      	@foreach ($data as $dataUsers)
			        <tr>
			          <td>
			            {{ $dataUsers->email }}
			            <div class="table-links">
			              Level <a href="#">{{ $dataUsers->level }}</a>
			              <div class="bullet"></div>
			              <a href="#">Detail</a>
			            </div>
			          </td>
			          <td>
			            <a href="/edit/{{ $dataUsers->id }}" class="font-weight-600"><img src="../assets/img/avatar/avatar-1.png" alt="avatar" width="30" class="rounded-circle mr-1"> {{ $dataUsers->name }}</a>
			          </td>
			          <td>
			            <a href="{{ route('dataUsers.edit', $dataUsers) }}" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
			            <form action="{{ route('dataUsers.destroy', $dataUsers) }}" method="post" class="d-inline">
			            	@csrf
			            	@method('delete')
			            		<button type="submit" class="btn btn-danger btn-action b-0" data-toggle="tooltip" title="Hapus" onclick=" return confirm('apakah anda yakin hapus!!')"><i class="fas fa-trash"></i></button>
			            </form>	            
			          </td>
			        </tr>
	        @endforeach
	      </tbody>
	    </table>
	  </div>
	</div>
</div>

@include('sweetalert::alert')

<script>
  document.getElementById('dashboard').classList.add('active');
</script>
@endsection