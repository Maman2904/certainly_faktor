<x-app-layout>
	<x-slot name="head">
		<link href="{{ asset('dist/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
	</x-slot>

	<x-slot name="title">Data Rules Defect</x-slot>

	@if(session()->has('success'))
	<x-alert type="success" message="{{ session()->get('success') }}" />
	@endif
	<x-card>
		<div class="row">
			<div class="col-md-8">
				<form action="{{ route('admin.rulesdefect.update', $data_defect->id) }}" method="POST" id="update_rulesdefect">
					@csrf
					<div class="table-responsive">
						<table class="table align-items-center table-flush table-hover border" id="dataTableHover">
							<thead class="thead-light">
								<tr>
									<th style="width: 10%;">No.</th>
									<th style="width: 60%;">Ciri ciri</th>
									<th style="width: 20%;">Nilai</th>
									<th style="width: 10%;"></th>
								</tr>
							</thead>
							<tbody>
								@php $rows = 1; @endphp

								@foreach($ciriciri_defect->get() as $row)
								<tr>
									<td>{{ $rows }}</td>
									<td>{{ $row->nama }}</td>
									<td>
										<input type="number" step="0.2" class="form-control form-control-sm" value="{{ $row->pivot->value_cf }}" name="ciriciri-{{ $row->id }}">
									</td>
									<td>
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input check" data-id="{{ $row->id }}" id="ciriciri-{{ $row->id }}" checked>
											<label class="custom-control-label" for="ciriciri-{{ $row->id }}"></label>
										</div>
									</td>
								</tr>
								@php $rows++; @endphp
								@endforeach

								@foreach($ciriciri as $row)
								@if(!in_array($row->id, $ciriciri_id))
								<tr>
									<td>{{ $rows }}</td>
									<td>{{ $row->nama }}</td>
									<td>
										<input type="number" step="0.2" class="form-control form-control-sm" name="ciriciri-{{ $row->id }}" disabled>
									</td>
									<td>
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input check" data-id="{{ $row->id }}" id="ciriciri-{{ $row->id }}">
											<label class="custom-control-label" for="ciriciri-{{ $row->id }}"></label>
										</div>
									</td>
								</tr>
								@php $rows++; @endphp
								@endif
								@endforeach
							</tbody>
						</table>
					</div>
				</form>
			</div>
			<div class="col-md-4">
				<div class="list-group">
					@foreach($defect as $row)
					<a href="{{ route('admin.rulesdefect', $row->id) }}" class="list-group-item list-group-item-action {{ ($data_defect->nama == $row->nama) ? 'active' : '' }}">
						{{ $row->nama }}
					</a>
					@endforeach
				</div>
				<div class="mt-3">
					<button class="btn-primary btn save">Simpan</button>
					<a href="" class="btn-warning btn">Reset</a>
				</div>
			</div>
		</div>
	</x-card>

	<x-slot name="script">
		<!-- Page level plugins -->
		<script src="{{ asset('dist/vendor/datatables/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('dist/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
		<script>
			$('.save').click(function() {
				$('#update_rulesdefect').submit()
			})

			$('.check').change(function() {
				const id = $(this).data('id')

				if(this.checked) {
					$(`input[name="ciriciri-${id}"]`).removeAttr('disabled')
				} else {
					$(`input[name="ciriciri-${id}"]`).attr('disabled', '')
					$(`input[name="ciriciri-${id}"]`).val('')
				}
			})
		</script>
	</x-slot>
</x-app-layout>