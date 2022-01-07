@extends('layouts.app')
@section('content')
	<title>Presensi || Data Presensi Siswa</title>
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
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#TambahPresensi">Tambah</button>
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
				<tbody>
				</tbody>
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
		<!-- Modal Tambah -->
		<div class="modal fade" id="TambahPresensi" tabindex="-1" role="dialog" aria-labelledby="TambahPresensi" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title" id="">Tambah Presensi</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="{{ url('/presensiSiswa/add') }}" method="post">
							@csrf
							<div class="form-group">
								<label for="id_presensi" class="col-form-label" hidden>ID Presensi</label>
								<input type="text" class="form-control" id="id_presensi" name="id_presensi" hidden>
							</div>
							<div class="form-group">
								<label for="nis" class="col-form-label">NIS</label><br>
								<select name="nis">
									<option value="">-- Pilih NIS --</option>
									@foreach ($siswa as $row)
									<option value="{{ $row->nis}}">{{ $row->nis}} - {{ $row->nama}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="id_mapel" class="col-form-label">ID Mapel</label><br>
								<select name="id_mapel">
									<option value="">-- Pilih ID Mapel --</option>
									@foreach ($mapel as $row)
									<option value="{{ $row->id_mapel}}">{{ $row->id_mapel}} - {{ $row->mapel}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								  <label for="waktu">Waktu</label><br>
								  <input type="datetime-local" id="waktu" name="waktu">
							</div>
							<div class="form-group">
								<label for="keterangan" class="col-form-label">Keterangan</label><br>
								<select name="keterangan">
									<option value="">-- Pilih Keterangan --</option>
									<option value="Hadir">Hadir</option>
									<option value="Izin">Izin</option>
									<option value="Sakit">Sakit</option>
									<option value="Alpa">Alpa</option>
									<option value="Telat">Telat</option>
								</select>
							</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" name="submit" class="btn btn-primary">Save</button>
					</div>
						</form>
				</div>
			</div>
		</div>
		
		<!-- Modal Edit -->
		<div class="modal fade" id="addPresensiDialog" tabindex="-1" role="dialog" aria-labelledby="EditPresensi" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title" id="">Edit Presensi</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="{{ url('/presensi/update') }}" method="post">
							@csrf
							@method('PATCH')
								<label for="id_presensi" class="col-form-label">ID Presensi</label>
								<input type="text" class="form-control" id="id_presensi" name="id_presensi" readonly>
							<div class="form-group">
							<label for="nis" class="col-form-label">NIS</label><br>
								<select name="nis">
									<option value="">-- Pilih NIS --</option>
									@foreach ($siswa as $row)
									<option value="{{ $row->nis}}">{{ $row->nis}} - {{ $row->nama}}</option>
									@endforeach
								</select>
							<div class="form-group">
								<label for="id_mapel" class="col-form-label">ID Mapel</label><br>
								<select id="id_mapel" name="id_mapel">
									<option value="">-- Pilih ID Mapel --</option>
									@foreach ($mapel as $row)
									<option value="{{ $row->id_mapel}}">{{ $row->id_mapel}} - {{ $row->mapel}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="keterangan" class="col-form-label">Keterangan</label><br>
								<select name="keterangan">
									<option value="">-- Pilih Keterangan --</option>
									<option value="Hadir">Hadir</option>
									<option value="Izin">Izin</option>
									<option value="Sakit">Sakit</option>
									<option value="Alpa">Alpa</option>
									<option value="Telat">Telat</option>
								</select>
							</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" name="submit" class="btn btn-primary">Save</button>
					</div>
						</form>
				</div>
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
		<script>
			$(document).on("click", ".open-EditPresensi", function () {
				 var id_presensi = $(this).data('id_presensi');
				 var nis = $(this).data('nis');
				 var id_mapel = $(this).data('id_mapel');
				 var waktu = $(this).data('waktu');
				 var keterangan = $(this).data('keterangan');
				 $(".modal-body #id_presensi").val( id_presensi );
				 $(".modal-body #nis").val( nis );
				 $(".modal-body #id_mapel").val( id_mapel );
				 $(".modal-body #waktu").val( waktu );
				 $(".modal-body #keterangan").val( keterangan );
			});
		</script>
		<script>
			$(document).ready(function(){
				fetch_data();

				function fetch_data(query = '') {
					$.ajax({
					url:"{{ route('presensiSiswa.action') }}",
					method:'GET',
					data:{query:query},
					dataType:'json',
						success:function(data) {
						$('tbody').html(data.table_data);
						$('#total_records').text(data.total_data);
						}
					})
				}

				$(document).on('keyup', '#search', function(){
					var query = $(this).val();
					fetch_data(query);
				});
			});
		</script>

@endsection