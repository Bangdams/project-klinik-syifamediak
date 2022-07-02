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

     <div class="form-group">
        <label>No Pemeriksaan</label>
        <input type="hidden" name="id_pemeriksaan" value="{{ session()->get('id_pemeriksaan') }}">
        <input type="text" name="no_pemeriksaan" value="{{ session()->get('no_pemeriksaan') }}" class="form-control" required="" readonly>
      </div>

      <div class="form-group">
        <label>Nama Pasien</label>
        <div class="input-group">
          <input type="text" value="{{ session()->get('nama_pasien') }}" class="form-control" readonly>
        </div>
      </div>

      <form method="post" action="{{ url('detailobat/tambah') }}">
        @csrf
        <div class="form-row" id="obat">
          <div class="form-group col-md-4">
            <label>Obat</label>
            <select name="id_obat" class="form-control pilihobat">
               <option>-- Pilih Obat --</option>
              @foreach ($obat as $ob)
               <option value="{{ $ob->id }}">{{ $ob->nama_obat }}</option>
              @endforeach
            </select>
          </div>
          
          <div class="form-group col-md-4">
            <label>Satuan</label>
            <select name="satuan" required class="form-control">
               <option>-- Pilih Satuan --</option>
               <option value="strip">strip</option>
               <option value="botol">botol</option>
               <option value="pcs">pcs</option>
            </select>
          </div>

          <div class="form-group col-md-4">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control jumlah" required="" placeholder="Isi Jumlah">
          </div>
        </div>
        <div>  
          <button class="btn btn-primary mt-1" type="submit">+</button>
        </div>
      </form>

      <form method="post" action="{{ route('resep.store') }}">
        {{-- Detail Resep --}}
        @csrf
        @foreach ($resep as $d)
        <div class="form-row mt-2" id="obat">
          <div class="form-group col-md-4">
            <label>Detail Obat</label>
            <input type="hidden" name="id_pasien" value="{{ session()->get('id_pasien') }}" class="form-control id_pasien" readonly>
            <input type="text" name="obat" class="form-control obat" value="{{ $d->obatModel->nama_obat }}" readonly>
          </div>
          
          <div class="form-group col-md-4">
            <label>Satuan</label>
            <input type="text" name="satuan" id="satuan" class="form-control satuan" value="{{ $d->satuan }}" readonly>
          </div>

          <div class="form-group col-md-4">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control jumlah" value="{{ $d->jumlah }}" readonly>
            <a href="{{ url('delete-resep', $d->no_resep) }}" class="btn btn-danger float-right mt-2">X</a>
          </div>
        </div>
        @endforeach
        <div class="card-footer text-right">
          <button class="btn btn-primary mr-1" id="simpan" type="submit">Proses</button>
        </div> 
      </form> 
</div>

{{-- 
<script src="{{ url('') }}assets/js/jquery.min"></script>
<script>
  $(document).ready(function  () {
    let baris = 1
    $(document).on('click', '#tambah', function () {
      baris = baris + 1
      var html = "<div class='form-group col-md-4' id='baris'"+baris+">"
          html += "<label>Obat ke "+baris+"</label>"
          html += "<select name='id_obat' class='form-control mt-1 mb-2 pilihobat'>"
          html += "<option>-- Pilih Obat --</option>"
          html += "@foreach ($obat as $ob)"
          html += "<option value='{{ $ob->id }}'>{{ $ob->nama_obat }}</option>"
          html += "@endforeach"
          html += "</select>"
          html += "</div>"

          html += "<div class='form-group col-md-4'>"
          html += "<label>Satuan</label>"
          html += "<input type='text' name='satuan' id='satuan' class='form-control satuan' placeholder='Isi Satuan'>"
          html += "</div>"

          html += "<div class='form-group col-md-4'>"
          html += "<label>Jumlah</label>"
          html += "<input type='number' name='jumlah' class='form-control jumlah' placeholder='Isi Jumlah'>"
          html += "</div>"

          $('#obat').append(html)
    })
  })

  $(document).on('click', '#simpan', function () {
    var satuan = []

    $('satuan').each(function(){
      satuan.push($(this).text());
    })

    $.ajax({
      type : 'POST',
      url : '{{ url('simpan') }}',
      data : {
        satuan : satuan,
        "_token" : "{{csrf_token()}}"
      },success: function (res) {
        console.log(res);
      },error: function (xhr) {
        console.log(xhr);
      }
    })

  })
</script>
 --}}
 @include('sweetalert::alert')
<script>
  document.getElementById('dashboard').classList.add('active');
</script>
@endsection