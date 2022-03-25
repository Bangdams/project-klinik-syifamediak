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
  <h1>Rekap Obat</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="{{ url('dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="{{ url('rekapObat') }}">Tabel Rekap Obat</a></div>
    <div class="breadcrumb-item">Table</div>
  </div>
</div>
<div class="card">
  <div class="card-header">
    <h4>Rekap Pengeluaran Obat Perhari</h4>
  </div>
  <div class="card-body">
    <div class="mb-2">
      <a href="{{ url('cetakObatHarian') }}" target=".blank" class="btn btn-primary">Cetak PDF</a>
    </div>
    <div class="table-responsive">
      <table class="table table-striped" id="table-1">
        <thead>
          <tr>
            <th class="text-center">
              #
            </th>
            <th>Nama Obat</th>
            <th>Jenis</th>
            <th>Harga obat</th>
            <th>Stok Sekarang</th>
            <th>Jumlah Keluar</th>
            <th>Tanggal</th>
            <th>Total Harga Jual</th>
            {{-- <th>Action</th> --}}
          </tr>
        </thead>
        <tbody>
          @foreach ($obat as $b)
          @if ($b->pemeriksaanModel->tanggal == $tgl_now)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $b->obatModel->nama_obat }}</td>
            <td>{{ $b->obatModel->jenis }}</td>
            <td>Rp.{{ number_format($b->obatModel->harga) }}</td>
            <td>{{ $b->obatModel->stok }}</td>
            <td>{{ $b->jumlah }}</td>
            <td>{{ $b->pemeriksaanModel->tanggal }}</td>
            <td>Rp.{{ number_format($b->jumlah * $b->obatModel->harga) }}</td>
            {{-- <td><a href="#" class="btn btn-secondary">Detail</a></td> --}}
          </tr>
          @else
          {{-- <tr>
            <td colspan="8" align="center">Tidak Ada Transaksi Obat Hari ini</td>
          </tr> --}}
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer text-right">
      <nav class="d-inline-block">
        {{ $obat->links() }}
      </nav>
  </div>
</div>
<script>
  document.getElementById('data-obat').classList.add('active');
</script>
@endsection