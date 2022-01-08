@extends('layouts.navbar')
@section('content')
	<title>Presensi || Data Kelas</title>
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
	<h1 class="mt-4">Data Kelas</h1>
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#TambahKelas">Tambah</button>
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
						<th class="th-sm">ID Kelas</th>
						<th class="th-sm">Nama</th>
						<th class="th-sm" colspan="2"><center>Aksi</center></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
				<tfoot>	
					<tr>
						<th>ID Kelas</th>
						<th>Nama</th>
						<th colspan="2"><center>Aksi</center></th>
					</tr>
				</tfoot>
			</table>
		</div>
		<!-- Modal Tambah -->
		<div class="modal fade" id="TambahKelas" tabindex="-1" role="dialog" aria-labelledby="TambahKelas" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title" id="">Tambah Kelas</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="{{ url('/kelas/add') }}" method="post">
							@csrf
							<div class="form-group">
								<label for="id_kelas" class="col-form-label" hidden>ID Kelas</label>
								<input type="text" class="form-control" id="id_kelas" name="id_kelas" hidden>
							</div>
							<div class="form-group">
								<label for="kelas" class="col-form-label">Nama</label><br>
								<select id="kelas" name="kelas">
									<option value="">-- Pilih Nama Kelas --</option>
									<option value="Individu">Individu</option>
									<option value="Komunitas Kecil">Komunitas Kecil</option>
									<option value="Komunitas Besar">Komunitas Besar</option>
									<option value="Distance Learning Class">Distance Learning Class</option>
									<option value="Belajar Mandiri">Belajar Mandiri</option>
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
		<div class="modal fade" id="addKelasDialog" tabindex="-1" role="dialog" aria-labelledby="EditKelas" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title" id="">Edit Kelas</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="{{ url('/kelas/update') }}" method="post">
							@csrf
							@method('PATCH')
								<label for="id_kelas" class="col-form-label">ID Kelas</label>
								<input type="text" class="form-control" id="id_kelas" name="id_kelas" readonly>
							<div class="form-group">
								<label for="kelas" class="col-form-label">Nama</label><br>
								<select id="kelas" name="kelas">
									<option value="">-- Pilih Nama Kelas --</option>
									<option value="Individu">Individu</option>
									<option value="Komunitas Kecil">Komunitas Kecil</option>
									<option value="Komunitas Besar">Komunitas Besar</option>
									<option value="Distance Learning Class">Distance Learning Class</option>
									<option value="Belajar Mandiri">Belajar Mandiri</option>
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
			$(document).on("click", ".open-EditKelas", function () {
				 var id_kelas = $(this).data('id_kelas');
				 var kelas = $(this).data('kelas');
				 $(".modal-body #id_kelas").val( id_kelas );
				 $(".modal-body #kelas").val( kelas );
			});
		</script>
		<script>
			$(document).ready(function(){
				fetch_data();

				function fetch_data(query = '') {
					$.ajax({
					url:"{{ route('kelas.action') }}",
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