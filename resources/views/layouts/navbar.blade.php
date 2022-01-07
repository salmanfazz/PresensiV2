<html>
	<head>
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<!-- DataTables CSS -->
		<link rel="stylesheet" href="{{ asset('/css/addons/datatables.min.css') }}">
		<!-- DataTables JS -->
		<script href="{{ asset('js/addons/datatables.min.js') }}"></script>
		<!-- DataTables Select CSS -->
		<!-- DataTables Select JS -->
		<script href="{{ asset('js/addons/datatables-select.min.js') }}"></script>
		<link rel="stylesheet" href="{{ asset('/css/simple-sidebar.css') }}"/>
	</head>
	<body>
		<div class="d-flex" id="wrapper">
			<!-- Sidebar -->
			<div class="bg-dark border-right" id="sidebar-wrapper">
					<div class="list-group list-group-flush">
						<a href="{{ url('/admin') }}" class="list-group-item list-group-item-action bg-dark text-light">Dashboard</a>
						<a href="{{ url('/presensi') }}" class="list-group-item list-group-item-action bg-dark text-light">Data Presensi</a>
						<a href="{{ url('/kelas') }}" class="list-group-item list-group-item-action bg-dark text-light">Data Kelas</a>
						<a href="{{ url('/jenjang') }}" class="list-group-item list-group-item-action bg-dark text-light">Data Jenjang</a>
						<a href="{{ url('/mapel') }}" class="list-group-item list-group-item-action bg-dark text-light">Data Mapel</a>
						<a href="{{ url('/tutor') }}" class="list-group-item list-group-item-action bg-dark text-light">Data Tutor</a>
						<a href="{{ url('/siswa') }}" class="list-group-item list-group-item-action bg-dark text-light">Data Siswa</a>
					</div>
			</div>
			<!-- /#sidebar-wrapper -->
			<!-- Page Content -->
			<div id="page-content-wrapper">
				<nav class="navbar navbar-expand-lg navbar-light bg-secondary border-bottom">
					<button class="btn btn-primary" id="menu-toggle"><<<</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
							<li class="nav-item active">
								<a class="nav-link text-light" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
							</li>
						</ul>
					</div>
				</nav>
				<div class="container-fluid">
					<main class="py-4">
						@yield('content')
					</main>
				</div>
			</div>
			<!-- /#page-content-wrapper -->
		</div>
	</body>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

		<script>
			<!-- Menu Toggle Script -->
			$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
			});
		</script>
</html>