@extends('layouts.navbar')
@section('content')
	<title>Presensi || Data Presensi</title>
	@if(session('success'))
		<div class = "alert alert-success">
	{{ session('success') }}
		</div>
	@endif
	@if(session('error'))
		<div class = "alert alert-error">
	{{ session('error') }}
		</div>
	@endif
	<br>
	<h1 class="mt-4">Data Presensi</h1>
		<a type="button" class="btn btn-secondary" href="{{ url('/presensi') }}">Back</a>
		<button type="button" class="btn btn-success" onclick="return printArea('print')">Print</button>
	<div class="nav justify-content-end">
		<label>Search:
			<form action="" method="post">
				<input type="text" name="search" id="search" class="form-control" placeholder="" /><h3>Total Data : <span id="total_records"></span></h3>
			</form>
		</label>
	</div>
		<div id="container">
			<div id="print">
			<table id="datatable" class="table table-striped table-bordered autoWidth" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="th-sm">ID Presensi</th>
						<th class="th-sm">NIS</th>
						<th class="th-sm">ID Mapel</th>
						<th class="th-sm">Waktu</th>
						<th class="th-sm">Keterangan</th>
					</tr>
				</thead>
				@foreach ($presensi as $row)
				<tbody>
				<td>{{ $row->id_presensi}}</td>
				<td>{{ $row->nis}}</td>
				<td>{{ $row->id_mapel}}</td>
				<td>{{ $row->waktu}}</td>
				<td>{{ $row->keterangan}}</td>
				</tbody>
				@endforeach
				<tfoot>	
					<tr>
						<th>ID Presensi</th>
						<th>NIS</th>
						<th>ID Mapel</th>
						<th>Waktu</th>
						<th>Keterangan</th>
					</tr>
				</tfoot>
			</table>
			</div>
		</div>
		<script type="text/javascript" src="https://code.jquery.com/jqeury-3.5.1.min.js"></script>
		<script>
			function printArea(print) {
				var printPage = document.getElementById(print).innerHTML;
				var oriPage = document.body.innerHTML;
				document.body.innerHTML = printPage;
				window.print();
				document.body.innerHTML = oriPage;
			}
		</script>
@endsection