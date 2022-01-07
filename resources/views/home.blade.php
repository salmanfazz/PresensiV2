@extends('layouts.app')
@section('content')
	<title>Presensi || Dashboard Siswa</title>
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
							<a href="{{ url('/presensiSiswa') }}" class="btn btn-primary">Detail</a>
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
				labels: ['Data Presensi'],
				datasets: [{
					label: 'Grafik Data',
					backgroundColor: 'rgb(255, 99, 132)',
					borderColor: 'rgb(255, 99, 132)',
					data: [{{$presensi}}]
				}]
			},

			// Configuration options go here
			options: {}
		});
		</script>
@endsection