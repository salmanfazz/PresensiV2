@extends('layouts.navbar')
@section('content')
	<title>Presensi || Data Mapel</title>
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
	<h1 class="mt-4">Data Mapel</h1>
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#TambahMapel">Tambah</button>
	<div class="nav justify-content-end">
		<label>Search:
			<form action="" method="post">
				<input type="text" name="search" id="search" class="form-control" placeholder="" /><h3>Total Data : <span id="total_records"></span></h3>
			</form>
		</label>
	</div>
		<div id="container">
			<table id="datatable" class="table table-striped table-bordered autoWidth" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="th-sm">ID Mapel</th>
						<th class="th-sm">Nama</th>
						<th class="th-sm">Jadwal</th>
						<th class="th-sm" colspan="2"><center>Aksi</center></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
				<tfoot>	
					<tr>
						<th>ID Mapel</th>
						<th>Nama</th>
						<th>Jadwal</th>
						<th colspan="2"><center>Aksi</center></th>
					</tr>
				</tfoot>
			</table>
		</div>
		<!-- Modal Tambah -->
		<div class="modal fade" id="TambahMapel" tabindex="-1" role="dialog" aria-labelledby="TambahMapel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title" id="">Tambah Mapel</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="{{ url('/mapel/add') }}" method="post">
							@csrf
							<div class="form-group">
								<label for="id_mapel" class="col-form-label" hidden>ID Mapel</label>
								<input type="text" class="form-control" id="id_mapel" name="id_mapel" hidden>
							</div>
							<div class="form-group">
								<label for="mapel" class="col-form-label">Nama</label><br>
								<input type="text" class="form-control" id="mapel" name="mapel">
							</div>
							<div class="form-group">
								<label for="jadwal" class="col-form-label">Jadwal</label><br>
								<input type="text" class="form-control" id="jadwal" name="jadwal">
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
		<div class="modal fade" id="addMapelDialog" tabindex="-1" role="dialog" aria-labelledby="EditMapel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title" id="">Edit Mapel</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="{{ url('/mapel/update') }}" method="post">
							@csrf
							@method('PATCH')
								<label for="id_mapel" class="col-form-label">ID Mapel</label>
								<input type="text" class="form-control" id="id_mapel" name="id_mapel" readonly>
							<div class="form-group">
								<label for="mapel" class="col-form-label">Nama</label><br>
								<input type="text" class="form-control" id="mapel" name="mapel">
							</div>
							<div class="form-group">
								<label for="jadwal" class="col-form-label">Jadwal</label><br>
								<input type="text" class="form-control" id="jadwal" name="jadwal">
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
		<script>
			$(document).on("click", ".open-EditMapel", function () {
				 var id_mapel = $(this).data('id_mapel');
				 var mapel = $(this).data('mapel');
				 var jadwal = $(this).data('jadwal');
				 $(".modal-body #id_mapel").val( id_mapel );
				 $(".modal-body #mapel").val( mapel );
				 $(".modal-body #jadwal").val( jadwal );
			});
		</script>
		<script>
			$(document).ready(function(){
				fetch_data();

				function fetch_data(query = '') {
					$.ajax({
					url:"{{ route('mapel.action') }}",
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