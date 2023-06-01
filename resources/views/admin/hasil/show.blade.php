<x-app-layout>
	<x-slot name="title">Hasil Defect</x-slot>
	@if(session()->has('success'))
	<x-alert type="success" message="{{ session()->get('success') }}" />
	@endif
	<x-card title="Berikut hasil penentuan Defect">
		<p class="mb-4">
			<i class="fas fa-user mr-1"></i> {{ $hasil->nama }} <i class="fas fa-calendar ml-4 mr-1"></i> {{ $hasil->created_at->format('d M Y, H:m:s') }}
		</p>

		<table class="table table-hover border">
			<thead class="thead-light">
				<tr>
					<th>Ciri ciri saat ini</th>
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
		<div class="card card-body p-0 mt-5 border" style="box-shadow: none !important;">
			<div class="card-header bg-primary text-white p-2">
				<h6 class="font-weight-bold">Tabel perhitungan Defect: {{ $penentuan['nama_defect'] }} ({{ $penentuan['kode_defect'] }})</h6>
			</div>
			<table class="table table-hover">
				<thead class="thead-light">
					<tr>
						<th>ciriciri</th>
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
				<h5 class="font-weight-bold">Penyebab</h5>
				<p>{{ unserialize($hasil->cf_max)[2] }}
				</p>
				<h5 class="font-weight-bold">Solusi</h5>
				<p>{{ unserialize($hasil->cf_max)[3] }}
				</p>
			</div>
			<div class="mt-3 text-center">
				{{-- <a href="{{ asset(" storage/downloads/$hasil->file_pdf") }}" target="_blank" class="btn btn-primary mr-1"><i class="fas fa-print mr-1"></i> Print</a> --}}
				<a href="{{ route('admin.penentuan') }}" class="btn btn-warning mr-1"><i class="fas fa-redo mr-1"></i> penentuan ulang</a>
			</div>
		</div>
	</x-card>
</x-app-layout>