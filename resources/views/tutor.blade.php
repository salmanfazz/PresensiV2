@extends('layouts.navbar')
@section('content')
	<title>Presensi || Data Tutor</title>
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
	<h1 class="mt-4">Data Tutor</h1>
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#TambahTutor">Tambah</button>
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
						<th class="th-sm">NIP</th>
						<th class="th-sm">Nama</th>
						<th class="th-sm">ID Mapel</th>
						<th class="th-sm" colspan="2"><center>Aksi</center></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
				<tfoot>	
					<tr>
						<th>NIP</th>
						<th>Nama</th>
						<th>ID Mapel</th>
						<th colspan="2"><center>Aksi</center></th>
					</tr>
				</tfoot>
			</table>
		</div>
		<!-- Modal Tambah -->
		<div class="modal fade" id="TambahTutor" tabindex="-1" role="dialog" aria-labelledby="TambahTutor" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title" id="">Tambah Tutor</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="{{ url('/tutor/add') }}" method="post">
							@csrf
							<div class="form-group">
								<label for="nip" class="col-form-label">NIP</label>
								<input type="text" class="form-control" id="nip" name="nip">
							</div>
							<div class="form-group">
								<label for="nama" class="col-form-label">Nama</label><br>
								<input type="text" class="form-control" id="nama" name="nama">
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
		<div class="modal fade" id="addTutorDialog" tabindex="-1" role="dialog" aria-labelledby="EditTutor" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title" id="">Edit Tutor</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="{{ url('/tutor/update') }}" method="post">
							@csrf
							@method('PATCH')
								<label for="nip" class="col-form-label">NIP</label>
								<input type="text" class="form-control" id="nip" name="nip" readonly>
							<div class="form-group">
								<label for="nama" class="col-form-label">Nama</label><br>
								<input type="text" class="form-control" id="nama" name="nama">
							</div>
							<div class="form-group">
								<label for="id_mapel" class="col-form-label">ID Mapel</label><br>
								<select id="id_mapel" name="id_mapel">
									<option value="">-- Pilih ID Mapel --</option>
									@foreach ($mapel as $row)
									<option value="{{ $row->id_mapel}}">{{ $row->id_mapel}} - {{ $row->mapel}}</option>
									@endforeach
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
		<script>
			$(document).on("click", ".open-EditTutor", function () {
				 var nip = $(this).data('nip');
				 var nama = $(this).data('nama');
				 var id_mapel = $(this).data('id_mapel');
				 $(".modal-body #nip").val( nip );
				 $(".modal-body #nama").val( nama );
				 $(".modal-body #id_mapel").val( id_mapel );
			});
		</script>
		<script>
			$(document).ready(function(){
				fetch_data();

				function fetch_data(query = '') {
					$.ajax({
					url:"{{ route('tutor.action') }}",
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