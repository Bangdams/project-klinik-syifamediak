@extends('layout.template')
@section('body')
<div class="card">
  <div class="card-header">
    <h4>Silahkan Isi From Di Bawah ini</h4>
  </div>
  <form method="post" action="{{ url('/daftarPasien/Poli/save', $data ) }}">
  	@csrf
		 	<div class="form-group">
		    <label>Pilih Poli</label>
		    <input type="hidden" value="{{ $data }}" name="id_pasien">
		    <select name="poli" class="form-control">
		       <option>-- Pilih Poli --</option>
		       <option value="umum">Umum</option>
		       <option value="bidan">Bidan</option>
		    </select>
		  </div>
		  <div class="card-footer text-right">
		      <button class="btn btn-primary mr-1" type="submit">Daftar</button>
		  </div>
  </form>
</div>
@endsection