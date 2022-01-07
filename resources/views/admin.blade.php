@extends('layouts.navbar')
@section('content')
	<title>Presensi || Dashboard Admin</title>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
	<div class="container-fluid">
			<h1 class="mt-4">Dashboard</h1>
			<div class="row">
				<div class="col-sm-4">
					<div class="card">
						<div class="card-body bg-warning">
							<h5 class="card-title text-dark">Data Presensi</h5>
							<center><img src="icon/presensi.png" width="40%"/>
							<h1 id="presensi">{{ $presensi }}</h1></center>
						</div>
							<a href="{{ url('/presensi') }}" class="btn btn-primary">Detail</a>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card">
						<div class="card-body bg-success">
							<h5 class="card-title">Data Kelas</h5>
							<center><img src="icon/kelas.png" width="40%"/>
							<h1 id="kelas">{{ $kelas }}</h1></center>
						</div>
							<a href="{{ url('/kelas') }}" class="btn btn-primary">Detail</a>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card">
						<div class="card-body bg-danger">
							<h5 class="card-title">Data Jenjang</h5>
							<center><img src="icon/jenjang.png" width="40%"/>
							<h1>{{ $jenjang }}</h1></center>
						</div>
							<a href="{{ url('/jenjang') }}" class="btn btn-primary">Detail</a>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card">
						<div class="card-body bg-secondary">
							<h5 class="card-title">Data Mapel</h5>
							<center><img src="icon/mapel.png" width="42%"/>
							<h1>{{ $mapel }}</h1></center>
						</div>
							<a href="{{ url('/mapel') }}" class="btn btn-primary">Detail</a>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card">
						<div class="card-body bg-secondary">
							<h5 class="card-title">Data Tutor</h5>
							<center><img src="icon/tutor.png" width="42%"/>
							<h1>{{ $tutor }}</h1></center>
						</div>
							<a href="{{ url('/tutor') }}" class="btn btn-primary">Detail</a>
					</div>
				</div>
			</div>
		</div>
		<canvas id="myChart"></canvas>
		<script>
		var ctx = document.getElementById('myChart').getContext('2d');
		var chart = new Chart(ctx, {
			// The type of chart we want to create
			type: 'bar',

			// The data for our dataset
			data: {
				labels: ['Data Presensi','Data Kelas','Data Jenjang', 'Data Mapel', 'Data Tutor'],
				datasets: [{
					label: 'Grafik Data',
					backgroundColor: 'rgb(255, 99, 132)',
					borderColor: 'rgb(255, 99, 132)',
					data: [{{$presensi}},{{$kelas}},{{$jenjang}}, {{$mapel}}, {{$tutor}}]
				}]
			},

			// Configuration options go here
			options: {}
		});
		</script>
@endsection