<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hasil Penentuan</title>
	<link href="{{ public_path('dist/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
	@php
	$hasil = App\Models\Hasil::find($id);
	@endphp

	<p class="mb-4">
		<b>Nama :</b> {{ $hasil->nama }}
	</p>

	<p class="mb-4">
		<b>Tanggal :</b> {{ $hasil->created_at->format('d M Y, H:m:s A') }}
	</p>

	<table class="table table-hover border">
		<thead class="thead-light">
			<tr>
				<th>Ciri-ciri saat ini</th>
				<th>Tingkat keyakinan</th>
				<th>CF User</th>
			</tr>
		</thead>
		<tbody>
			@foreach(unserialize($hasil->ciriciri_terpilih) as $ciriciri)
			<tr>
				<td>{{ $ciriciri['kode'] }} - {{ $ciriciri['nama'] }}</td>
				<td>{{ $ciriciri['keyakinan'] }}</td>
				<td>{{ $ciriciri['cf_user'] }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	@foreach(unserialize($hasil->hasil_penentuan) as $penentuan)
	<div class="card card-body shadow-none p-0 mt-5 border">
		<div class="card-header bg-primary text-white p-2">
			<h6 class="font-weight-bold">Tabel perhitungan Defect: {{ $penentuan['nama_defect'] }} ({{ $penentuan['kode_defect'] }})</h6>
		</div>
		<table class="table table-hover">
			<thead class="thead-light">
				<tr>
					<th>Ciri ciri</th>
					<th>CF User</th>
					<th>CF Expert</th>
					<th>CF (H, E)</th>
				</tr>
			</thead>
			<tbody>
				@foreach($penentuan['ciriciri'] as $ciriciri)
				<tr>
					<td>{{ $ciriciri['kode'] }} - {{ $ciriciri['nama'] }}</td>
					<td>{{ $ciriciri['cf_user'] }}</td>
					<td>{{ $ciriciri['cf_role'] }}</td>
					<td>{{ $ciriciri['hasil_perkalian'] }}</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot class="font-weight-bold">
				<tr>
					<td scope="row">Nilai CF</td>
					<td><span class="text-danger">{{ number_format($penentuan['hasil_cf'], 3) }}</span></td>
				</tr>
			</tfoot>
		</table>
	</div>
	@endforeach
	<div class="mt-5">
		<div class="alert alert-success">
			<h5 class="font-weight-bold">Kesimpulan</h5>
			<p>Berdasarkan dari ciriciri yang kamu pilih berdasarkan Role/Basis aturan yang sudah ditentukan oleh seorang pakar defect maka perhitungan Algoritma Certainty Factor
				mengambil nilai CF yang paling pinggi yakni <b>{{ number_format(unserialize($hasil->cf_max)[0], 3) }} ({{ number_format(unserialize($hasil->cf_max)[0], 3) * 100 }}%)</b> yaitu
				<b>{{ unserialize($hasil->cf_max)[1] }}</b>
			</p>
		</div>
	</div>
</body>

</html>