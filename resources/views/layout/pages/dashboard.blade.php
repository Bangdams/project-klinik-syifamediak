@extends('layout.template')
@section('body')
<div class="row">
  <div class="col-lg-4 col-md-4 col-sm-12">
    <div class="card card-statistic-2">
      <div class="card-chart">
        <canvas id="balance-chart" height="80"></canvas>
      </div>
      <div class="card-icon shadow-primary bg-primary">
        <i class="fa fa-user-md" style="color: white;"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Dokter</h4>
        </div>
        <div class="card-body">
          {{ $jml_dokter }}
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-12">
    <div class="card card-statistic-2">
      <div class="card-chart">
        <canvas id="balance-chart" height="80"></canvas>
      </div>
      <div class="card-icon shadow-primary bg-primary">
        <i class="fa fa-wheelchair" style="color: white;"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Pasien</h4>
        </div>
        <div class="card-body">
          {{ $jml_pasien }}
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-12">
    <div class="card card-statistic-2">
      <div class="card-chart">
        <canvas id="sales-chart" height="80"></canvas>
      </div>
      <div class="card-icon shadow-primary bg-primary">
        <i class="fa fa-medkit" style="color: white;"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Jumlah Obat</h4>
        </div>
        <div class="card-body">
          {{ $jml_obat }}
        </div>
      </div>
    </div>
  </div>
</div>
@include('sweetalert::alert')
<script>
  document.getElementById('dashboard').classList.add('active');
</script>
@endsection