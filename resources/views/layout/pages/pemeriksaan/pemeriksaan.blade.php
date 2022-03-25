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
    <h4>Form Pemeriksaan</h4>
  </div>
  <div class="card-body">
    <form action="{{ route('pemeriksaan.store') }}" method="post">
      @csrf
     <div class="form-group">
        <label>No Pemeriksaan</label>
        <input type="text" name="no_pemeriksaan" value="{{ $nomer }}" class="form-control" required="" readonly>
      </div>

      <div class="form-group">
        <label>Nama Pasien</label>
        <div class="input-group">
          <input type="hidden" value="{{ $id_pasien->id }}" name="id_pasien">
          <input type="hidden" value="{{ Auth::user()->id }}" name="id">
          <input type="text" name="nama_pasien" value="{{ $id_pasien->nama_pasien }}" class="form-control" readonly>
        </div>
      </div>

      <div class="form-row">
        
        <div class="form-group col-md-3">
          <label for="tinggiBadan">Tinggi Badan</label>
          <div class="input-group">
            <input type="number" name="tinggi_badan" id="tinggiBadan" class="form-control" aria-label="Amount (to the nearest dollar)">
            <div class="input-group-append">
              <span class="input-group-text">Cm</span>
            </div>
          </div>
        </div>
        
        <div class="form-group col-md-3">
          <label for="beratBadan">Berat Badan</label>
          <div class="input-group">
            <input type="number" name="berat_badan" id="beratBadan" class="form-control" aria-label="Amount (to the nearest dollar)">
            <div class="input-group-append">
              <span class="input-group-text">Kg</span>
            </div>
          </div>
        </div>

        <div class="form-group col-md-3">
          <label for="suhuBadan">Suhu Badan</label>
           <div class="input-group">
              <input type="number" name="suhu_badan" class="form-control" aria-label="Amount (to the nearest dollar)">
              <div class="input-group-append">
                <span class="input-group-text">°C</span>
              </div>
           </div>
        </div>

        <div class="form-group col-md-3">
          <label for="tekananDarah">Tekanan Darah</label>
          <input type="number" name="tekanan_darah" id="tekananDarah" class="form-control" aria-label="Amount (to the nearest dollar)">
        </div>

      </div>

      <div class="form-group">
        <label>Keluhan</label>
        <input type="text" name="keluhan" class="form-control" required="" placeholder="Isi Keluhan Pasien">
      </div>
      
      <div class="form-group">
        <label>Diagnosa</label>
        <select name="diagnosa" class="form-control">
           <option>-- Pilih Diagnosa --</option>
          @foreach ($diagnosa as $d)
           <option value="{{ $d->id }}">{{ $d->nama_diagnosa }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label>Therapy</label>
        <input type="text" name="terapi" class="form-control" placeholder="Isi Jika Perlu Therapy">
      </div>
      
      <div class="form-group">
        <label>Harga</label>
        <input type="text" name="harga" class="form-control" required="" placeholder="Isi Harga">
      </div>
      
    <div class="card-footer text-right">
      <button class="btn btn-primary mr-1" type="submit">Simpan Pemeriksaan</button>
    </div>
    </form>
</div>
<script>
  document.getElementById('pemeriksaan').classList.add('active');
</script>
@endsection