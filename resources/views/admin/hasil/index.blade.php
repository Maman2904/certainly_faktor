<x-app-layout>
	<x-slot name="title">Hasil</x-slot>

	@if(session()->has('success'))
	<x-alert type="success" message="{{ session()->get('success') }}" />
	@endif
	<x-card>
		<div class="table-responsive">
			<table class="table table-hover border">
				<thead>
					<th>ID</th>
					@role('Admin')
					<th>Nama</th>
					@endrole
					<th>Defect</th>
					<th>Tanggal</th>
					<th></th>
				</thead>
				<tbody>
					@forelse($hasil as $row)
					<tr>
						<td>{{ $row->id }}</td>
						@role('Admin')
						<td>{{ $row->nama }}</td>
						@endrole
						<td>{{ unserialize($row->cf_max)[1] }} <b>(<span class="text-danger">{{ number_format(unserialize($row->cf_max)[0] * 100, 2) }}%</span>)</b></td>
						<td>{{ $row->created_at->format('d M Y, H:m:s') }}</td>
						<td>
							{{-- <a href="{{ asset(" storage/downloads/$row->file_pdf") }}" target="_blank" class="btn btn-primary btn-sm mr-1"><i class="fas fa-print mr-1"></i></a> --}}
							<a href="{{ route('admin.hasil', $row->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye mr-1"></i></a>
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="5" class="text-center">No Data</td>
					</tr>
					@endforelse
				</tbody>
			</table>
			<div class="mt-3">
				{{ $hasil->links() }}
			</div>
		</div>
	</x-card>
</x-app-layout>