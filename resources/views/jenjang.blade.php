@extends('layouts.navbar')
@section('content')
	<title>Presensi || Data Jenjang</title>
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
	<h1 class="mt-4">Data Jenjang</h1>
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#TambahJenjang">Tambah</button>
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
						<th class="th-sm">ID Jenjang</th>
						<th class="th-sm">Nama</th>
						<th class="th-sm" colspan="2"><center>Aksi</center></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
				<tfoot>	
					<tr>
						<th>ID Jenjang</th>
						<th>Nama</th>
						<th colspan="2"><center>Aksi</center></th>
					</tr>
				</tfoot>
			</table>
		</div>
		<!-- Modal Tambah -->
		<div class="modal fade" id="TambahJenjang" tabindex="-1" role="dialog" aria-labelledby="TambahJenjang" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title" id="">Tambah Jenjang</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="{{ url('/jenjang/add') }}" method="post">
							@csrf
							<div class="form-group">
								<label for="id_jenjang" class="col-form-label" hidden>ID Jenjang</label>
								<input type="text" class="form-control" id="id_jenjang" name="id_jenjang" hidden>
							</div>
							<div class="form-group">
								<label for="jenjang" class="col-form-label">Nama</label><br>
								<select id="jenjang" name="jenjang">
									<option value="">-- Pilih Nama Jenjang --</option>
									<option value="Setara SD">Setara SD</option>
									<option value="Setara SMP">Setara SMP</option>
									<option value="Setara SMA">Setara SMA</option>
									<option value="Cambrige International Examination (CIE)">Cambrige International Examination (CIE)</option>
									<option value="Program Inklusi">Program Inklusi</option>
									<option value="Private Lesson Exclussive">Private Lesson Exclussive</option>
									<option value="Pendidikan Vokasi">Pendidikan Vokasi</option>
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
		<div class="modal fade" id="addJenjangDialog" tabindex="-1" role="dialog" aria-labelledby="EditJenjang" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title" id="">Edit Jenjang</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="{{ url('/jenjang/update') }}" method="post">
							@csrf
							@method('PATCH')
								<label for="id_jenjang" class="col-form-label">ID Jenjang</label>
								<input type="text" class="form-control" id="id_jenjang" name="id_jenjang" readonly>
							<div class="form-group">
								<label for="jenjang" class="col-form-label">Nama</label><br>
								<select id="jenjang" name="jenjang">
									<option value="">-- Pilih Nama Jenjang --</option>
									<option value="Setara SD">Setara SD</option>
									<option value="Setara SMP">Setara SMP</option>
									<option value="Setara SMA">Setara SMA</option>
									<option value="Cambrige International Examination (CIE)">Cambrige International Examination (CIE)</option>
									<option value="Program Inklusi">Program Inklusi</option>
									<option value="Private Lesson Exclussive">Private Lesson Exclussive</option>
									<option value="Pendidikan Vokasi">Pendidikan Vokasi</option>
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
			$(document).on("click", ".open-EditJenjang", function () {
				 var id_jenjang = $(this).data('id_jenjang');
				 var jenjang = $(this).data('jenjang');
				 $(".modal-body #id_jenjang").val( id_jenjang );
				 $(".modal-body #jenjang").val( jenjang );
			});
		</script>
		<script>
			$(document).ready(function(){
				fetch_data();

				function fetch_data(query = '') {
					$.ajax({
					url:"{{ route('jenjang.action') }}",
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