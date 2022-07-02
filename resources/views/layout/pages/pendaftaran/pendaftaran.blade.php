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
	<h1>Table Daftar Pasien</h1>
	<div class="section-header-breadcrumb">
	  <div class="breadcrumb-item active"><a href="{{ url('cek') }}">Dashboard</a></div>
	  <div class="breadcrumb-item"><a href="{{ url('dataUser') }}">Tabel Daftar Pasien</a></div>
	  <div class="breadcrumb-item">Table</div>
	</div>
</div>

<div class="card">
	<div class="text-center">
    <h5>Silahkan Pilih Opsi Dibawah Ini</h5>
  </div>
	<div class="card-body text-center">
		<input type="radio" name="pasien" checked class="btn1"> Pasien Lama
		<input type="radio" name="pasien" class="btn2 ml-3"> Pasien Baru
	</div>
</div>
	

{{-- Form Tambah Pasien --}}
<div class="card daftar">
  <div class="card-header">
    <h4>Silahkan Isi From Di Bawah ini</h4>
  </div>
  <div class="card-body">
    <form action="{{ route('pendaftaran.store') }}" method="post">
      @csrf
     <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama_pasien" class="form-control" placeholder="Masukan Nama" value="{{ old('nama_pasien') }}" required="">
      </div>
      <div class="form-group">
        <label>Alamat</label>
        <input type="text" name="alamat" class="form-control" placeholder="Masukan Alamat" value="{{ old('alamat') }}" required="">
      </div>
      <div class="form-group">
        <label>Tanggal Lahir</label>
        <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir') }}" class="form-control" required="" placeholder="Masukan Umur">
      </div>
      <div class="form-group">
        <label>Nomer Hp</label>
        <input type="number" name="no_telepon" class="form-control" placeholder="Masukan Nomer Hp" value="{{ old('no_telepon') }}" required="">
      </div>
      <div class="form-group">
        <label>No KTP</label>
        <input type="number" name="no_ktp" class="form-control" placeholder="Masukan Nomer KTP" value="{{ old('no_ktp') }}" required="">
         @error('no_ktp')
          <p style="color:red;">- {{ $message }}</p>
        @enderror
      </div>
      <div class="form-group">
        <label>No BPJS</label>
        <input type="number" name="no_bpjs" value="{{ old('no_bpjs') }}" placeholder="Masukan Nomer BPJS" class="form-control">
         @error('no_bpjs')
          <p style="color:red;">- {{ $message }}</p>
        @enderror
      </div>
      <div class="form-group">
        <div class="control-label">Jenis Kelamin</div>
        <div class="custom-switches-stacked mt-2">
          <label class="custom-switch">
            <input type="radio" name="jk" value="L" class="custom-switch-input">
            <span class="custom-switch-indicator"></span>
            <span class="custom-switch-description">Laki-Laki</span>
          </label>
          <label class="custom-switch">
            <input type="radio" name="jk" value="P" class="custom-switch-input">
            <span class="custom-switch-indicator"></span>
            <span class="custom-switch-description">Perempuan</span>
          </label>
          @error('jk')
          <p style="color:red;">- {{ $message }}</p>
        @enderror
        </div>
      </div>
    <div class="card-footer text-right">
      <button class="btn btn-primary mr-1" type="submit">Daftar</button>
    </div>
    </form>
  </div>
</div>

{{-- Cari Ktp Pasien --}}
<div class="card cari">
	<div class="card-header">
    <h4>- Pilih Ktp Pasien</h4>
  </div>
  <div class="card-body">
    <div class="form-group">
      <form method="get" action="{{ url('/cari/pasien/ktp/') }}">
        <select name="cari" class="form-control form-control-sm">
          <option>-- Pilih No Ktp Pasien --</option>
          @foreach ($ktp as $p)
            <option value="{{ $p->no_ktp }}">{{ $p->no_ktp }} ({{ $p->nama_pasien }})</option>
          @endforeach
        </select>
        <div class="card-footer text-right">
          <button class="btn btn-primary mr-1" type="submit">Cari</button>
        </div>
      </form>
    </div>
  </div>
</div>
   
{{-- Tabel Data Pasien --}}    
<div class="card datapasien">
    <div class="card-header">
      <h4>- Data Semua Pasien</h4>
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
          @foreach ($data as $datapasien)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $datapasien->nama_pasien }}</td>
            <td>{{ $datapasien->tgl_lahir }}</td>
            <td>{{ $datapasien->alamat }}</td>
            <td>{{ $datapasien->no_telepon }}</td>
            @if ($datapasien->jk == 'L')
            <td>Laki-Laki</td>
            @else
            <td>Perempuan</td>
            @endif
            <td>{{ $datapasien->no_ktp }}</td>
            <td>{{ $datapasien->no_bpjs  }}</td>
            <td> 
              @foreach ($datapasien->pendaftaranModel as $c)
              @if ($c->status == 'sudah') 
                {{-- <form action="{{ url('daftarPasien', $datapasien) }}" method="post">
                    @csrf
                    <input type="hidden" name="id_pasien" value="{{ $datapasien->id }}">
                    <input type="hidden" name="status" value="belum">
                    <button type="submit" class="btn btn-primary btn-action mr-1">Daftar</button>
                </form> --}}
                <a href="{{ url('/daftarPasien/Poli', $c->id_pasien) }}" class="btn btn-primary btn-action mr-1">Daftar</a>
              @else
                  <button type="submit" class="btn btn-primary btn-action mr-1">Sudah Daftar</button>
              @endif
              @endforeach
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
</div>

@include('sweetalert::alert')
{{-- Tabel Data Pasien baru --}}


<script>
  $(document).ready(function() {

    $(".daftar").hide() ;

    //jika class btn 1 di tekan maka jalankan ini 
    $(".btn1").click(function(){
      $(".datapasien").show() ;
      $(".daftar").hide() ;
      $(".cari").show();
    });

    // jika class btn 2 di tekan maka jalankan ini
    $(".btn2").click(function(){
      $(".daftar").show() ;
      $(".datapasien").show();
      $(".cari").hide();
    });
  });
  document.getElementById('pendaftaran').classList.add('active');
</script>
@endsection