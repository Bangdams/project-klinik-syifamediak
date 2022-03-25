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
	<h1>Table Data Pasien</h1>
	<div class="section-header-breadcrumb">
	  <div class="breadcrumb-item active"><a href="{{ url('cek') }}">Dashboard</a></div>
	  <div class="breadcrumb-item"><a href="{{ url('dataUser') }}">Tabel Pasien</a></div>
	  <div class="breadcrumb-item">Table</div>
	</div>
</div>
{{-- Tabel Data Pasien --}}
    
<div class="card datapasien">
    <div class="card-header">
      <h4>Daftar Pasien Yang Mau Di Periksa</h4>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped table-md">
          <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>Nomer Hp</th>
            <th>Jenis Kelamin</th>
            <th>Nomer Ktp</th>
            <th>Nomer Bpjs</th>
            <th>Action</th>
          </tr>
          @foreach ($data as $data)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->pasienModel->nama_pasien }}</td>
            <td>{{ $data->pasienModel->tgl_lahir }}</td>
            <td>{{ $data->pasienModel->alamat }}</td>
            <td>{{ $data->pasienModel->no_telepon  }}</td>
            @if ($data->pasienModel->jk == 'L')
              <td>Laki-laki</td>
            @elseif ($data->pasienModel->jk == 'P')
                <td>Perempuan</td>
            @endif
            <td>{{ $data->pasienModel->no_ktp }}</td>
            @if ($data->pasienModel->no_bpjs != null)
              <td>{{ $data->pasienModel->no_bpjs }}</td>
            @else
              <td>Tidak Mempunyai BPJS</td>
            @endif
            <td>
              <a href="{{ url('pemeriksaan/pasien', $data->pasienModel->nama_pasien) }}" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Periksa"><i class="fas fa-pencil-alt"></i> Periksa</a>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
    {{-- <div class="card-footer text-right">
      <nav class="d-inline-block">
        <ul class="pagination mb-0">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
          </li>
          <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
          <li class="page-item">
            <a class="page-link" href="#">2</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
          </li>
        </ul>
      </nav>
    </div> --}}
</div>
@include('sweetalert::alert')
<script>
  document.getElementById('pemeriksaan').classList.add('active');
</script>
@endsection