@extends('master')
 
@section('title', '')

@section('alert')

@endsection
 
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<style>
	.cards .content {
		display: flex;
		justify-content: space-between;
		flex-wrap: wrap;
		color: white;
	}

	.cards .content i {
		font-size: 70px;
	}

	.diagram_chart{
		width: 400px;
		height: 400px;
		margin: auto;
		text-align: center;
	}

</style>

<fieldset>
<!-- <legend>Overview</legend> -->

<div class="col-md-4">
	<div style="background: rgba(54, 162, 235, 0.6);" class="card cards">
		<div class="content">
			<div class="header">   
				<p style="text-align: center; font-weight: bold;">Jumlah Santri</p>
				<h3 style="text-align: center;"> {{ $siswa }} </h3>
			</div>
			<i class="glyphicon glyphicon-user"></i>
		</div>
	</div>
</div>

<div class="col-md-4">
	<div style="background: rgba(255, 99, 132, 0.6);" class="card cards">
		<div class="content">
			<div class="header">   
				<p style="text-align: center; font-weight: bold;"> Jumlah Halaqah </p>
				<h3 style="text-align: center;"> {{ $class }} </h3>
			</div>
			<i class="glyphicon glyphicon-blackboard"></i>
	    </div>
	</div>
</div>

<div class="col-md-4">
	<div style="background: rgba(75, 192, 192, 0.6);" class="card cards">
		<div class="content">
			<div class="header">   
				<p style="text-align: center; font-weight: bold;"> Jumlah hafalan </p>
				<h3 style="text-align: center;"> {{ $hafalan }} </h3>
			</div>
			<i class="glyphicon glyphicon-list-alt"></i>
	    </div>
	</div>
</div>


</fieldset>

<hr>

<fieldset>
<legend>Chart</legend>

<div class="diagram_chart">
	<canvas id="myChart" width="400px" height="400px"></canvas>
</div>

<script>
	var ctx = document.getElementById('myChart').getContext('2d');
	
	var myChart = new Chart(ctx, {
		type: 'pie',
		data: {
			labels: ['Santri', 'Halaqah', 'Hafalan'],
			datasets: [{
				label: 'Data Sekolah',
				data: [{{ $siswa }}, {{ $class }}, {{ $hafalan }}],
				backgroundColor: [
					'rgba(54, 162, 235, 0.6)',
					'rgba(255, 99, 132, 0.6)',
					'rgba(75, 192, 192, 0.6)',
				],
				borderColor: [
					'rgba(54, 162, 235, 1)',
					'rgba(255, 99, 132, 1)',
					'rgba(75, 192, 192, 1)'
				],
				borderWidth: 1
			}]
		}
	});
</script>

</fieldset>

@endsection