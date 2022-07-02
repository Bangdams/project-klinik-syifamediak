<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CetakLaporan</title>
</head>
<body>
	<h2 align="center">Klinik Syifa Medika</h2>
	<p align="center">Laporan Riwayat Pemeriksaan</p>
	<table border="2" cellspacing="0" cellpadding="4" align="center" style="width: 95%;">
		  <tr>
            <th>#</th>
            <th>No Rekam Medis</th>
            <th>Nama</th>
            <th>Keluhan</th>
            <th>Diagnosa</th>
            <th>Terapi</th>
            <th>Tanggal</th>
          </tr>	
	     @foreach ($data as $data)
	        <tr align="center">
	          <td>{{ $loop->iteration }}</td>
	          <td>{{ $data->no_pemeriksaan }}</td>
	          @if ($data->id_pasien == null)
	            <td>{{ $data->nama }}</td>
	          @else
	            <td>{{ $data->pasienModel->nama_pasien }}</td>
	          @endif
	          <td>{{ $data->keluhan }}</td>
	          <td>{{ $data->diagnosaModel->nama_diagnosa }}</td>
	          <td>{{ $data->terapi }}</td>
	          <td>{{ $data->tanggal }}</td>
	        </tr>
		@endforeach
	</table>
</body>
</html>
<script type="text/javascript">
	window.print()
</script>