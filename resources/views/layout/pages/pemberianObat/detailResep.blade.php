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
    <h4>Form Resep</h4>
  </div>
  <div class="card-body">
    <form action="{{ route('resepObat.update', $no_pemeriksaan) }}" method="post">
      @csrf
      @method('PUT')
     <div class="form-group">
        <label>No Pemeriksaan</label>
        <input type="text" name="no_pemeriksaan" value="{{ $no_pemeriksaan }}" class="form-control" required="" readonly>
      </div>
      <div class="card datapasien">
        <div class="card-header">
          <h4>Total Obat</h4>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-striped table-md">
              <tr>
                <th>Nama Obat</th>
                <th>Satuan</th>
                <th>Jumlah</th>
                <th>Harga Obat</th>
                <th>Total Harga Obat</th>
                <th>Harga Pemeriksaan</th>
              </tr>
              @foreach ($data as $d)
              <input type="hidden" value="{{ $d->id_pemeriksaan }}" name="id_pemeriksaan">
              <tr>
                <td>{{ $d->obatModel->nama_obat }}</td>
                <td>{{ $d->satuan }}</td>
                <td>{{ $d->jumlah }}</td>
                <td>Rp.{{ number_format($d->obatModel->harga) }}</td>
                <td>Rp.{{ number_format($d->obatModel->harga * $d->jumlah) }}</td>
                <td>Rp.{{ number_format($d->pemeriksaanModel->harga) }}</td>
              </tr>
              @endforeach
              <tr class="mt-2">
                <th>Total</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Rp.{{ number_format($total) }}</th>
              </tr>
            </table>
          </div>
        </div>
      </div>

    <div class="card-footer text-right">
      <button class="btn btn-primary mr-1" type="submit">Bayar</button>
    </div>
    </form>
</div>
<script>
  document.getElementById('resep').classList.add('active');
</script>
@endsection