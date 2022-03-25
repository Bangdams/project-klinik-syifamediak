<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CetakLaporan</title>
</head>
<body>
	<h2 align="center">Klinik Syifa Medika</h2>
	<p align="center">Laporan Pengeluaran Obat</p>
	<table border="2" cellspacing="0" cellpadding="4" align="center" style="width: 95%;">
		<tr>
			<th>#</th>
			<th>Nama Obat</th>
			<th>Jenis</th>
			<th>Harga</th>
			<th>Stok Sekarang</th>
			<th>Jumlah Keluar</th>
			<th>Tanggal</th>
			<th>Total Harga</th>
		</tr>

		@foreach ($data as $b)	
		<tr align="center">

			 @if ($b->pemeriksaanModel->tanggal == $tgl_now)
			
				<td>{{ $loop->iteration }}</td>
	            <td>{{ $b->obatModel->nama_obat }}</td>
	            <td>{{ $b->obatModel->jenis }}</td>
	            <td>Rp.{{ number_format($b->obatModel->harga) }}</td>
	            <td>{{ $b->obatModel->stok }}</td>
	            <td>{{ $b->jumlah }}</td>
	            <td>{{ $b->pemeriksaanModel->tanggal }}</td>
	            <td>Rp.{{ number_format($b->jumlah * $b->obatModel->harga) }}</td>
	            
	        @endif
		</tr>
		@endforeach
	</table>
</body>
</html>
<script type="text/javascript">
	window.print()
</script>