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
	<h1>Table Data Diagnosa</h1>
	<div class="section-header-breadcrumb">
	  <div class="breadcrumb-item active"><a href="{{ url('cek') }}">Dashboard</a></div>
	  <div class="breadcrumb-item"><a href="{{ url('dataUser') }}">Tabel Diagnosa</a></div>
	  <div class="breadcrumb-item">Diagnosa</div>
	</div>
</div>
{{-- Tabel Data Pasien --}}
    
<div class="card">
    <div class="card-header">
    <h4>Data Semua Obat</h4>
    </div>
    <div class="card-header">
      
      <a href="{{ route('diagnosa.create') }}" class="btn btn-primary">Tambah</a>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped table-md">
          <tr>
            <th>#</th>
            <th>Nama Diagnosa</th>
          </tr>
          @foreach ($diagnosa as $d)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $d->nama_diagnosa }}</td>
            <td>
              <a href="{{ route('diagnosa.edit', $d) }}" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i>
              </a>
              <form action="{{ route('diagnosa.destroy', $d) }}" method="post" class="d-inline">
                @csrf
                @method('delete')
                  <button type="submit" class="btn btn-danger btn-action b-0" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash"></i></button>
              </form>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
    <div class="card-footer text-right">
       <nav class="d-inline-block">
         {{ $diagnosa->links() }}
       </nav>
    </div>
  </div>
@include('sweetalert::alert')
<script>
  document.getElementById('dashboard').classList.add('active');
</script>
@endsection