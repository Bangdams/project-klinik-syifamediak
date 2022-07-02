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
	<h1>Table Data Obat</h1>
	<div class="section-header-breadcrumb">
	  <div class="breadcrumb-item active"><a href="{{ url('cek') }}">Data Obat</a></div>
	  <div class="breadcrumb-item"><a href="{{ url('dataUser') }}">Tabel Obat</a></div>
	  <div class="breadcrumb-item">Table</div>
	</div>
</div>
  <div class="card">
    <div class="card-header">
    <h4>Data Semua Obat</h4>
    </div>
    <div class="card-header">
      
      <a href="{{ url('addObat') }}" class="btn btn-primary">Tambah</a>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped table-md">
          <tr>
            <th>#</th>
            <th>Nama Obat</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Jenis Obat</th>
            <th>Action</th>
          </tr>
          @foreach ($obat as $b)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $b->nama_obat }}</td>
            <td>{{ $b->stok }}</td>
            <td>Rp.{{ number_format($b->harga) }}</td>
            <td>{{ $b->jenis  }}</td>
            <td>
              <a href="{{ route('obat.edit', $b) }}" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>

              <a href="{{ url('obat/tambahStok', $b->nama_obat) }}" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Tambah Stok"><i class="fas fa-plus"></i></a>

                <form action="{{ route('obat.destroy', $b) }}" method="post" class="d-inline">
                  @csrf
                  @method('delete')
                    <button type="submit" class="btn btn-danger btn-action b-0" onclick=" return confirm('apakah anda yakin hapus!!')" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash"></i></button>
                </form>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
   <div class="card-footer text-right">
      <nav class="d-inline-block">
        {{ $obat->links() }}
      </nav>
  </div>
  </div>
  @include('sweetalert::alert')
<script>
  document.getElementById('data-obat').classList.add('active');
</script>
@endsection