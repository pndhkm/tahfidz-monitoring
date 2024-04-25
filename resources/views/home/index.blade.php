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

	.diagram_chart {
    max-width: 100%; /* Membuat lebar maksimum 100% dari lebar viewport */
    width: auto; /* Mengatur lebar ke nilai otomatis */
    height: auto; /* Mengatur tinggi ke nilai otomatis */
    margin: auto;
    text-align: center;
}

/* Media queries untuk perangkat mobile dengan lebar maksimum 767px */
@media only screen and (max-width: 767px) {
    .diagram_chart {
        width: 100%; /* Mengatur lebar menjadi 100% */
        height: auto; /* Mengatur tinggi ke nilai otomatis */
    }
}


</style>

<fieldset>
<!-- <legend>Overview</legend> -->
<a href="#" data-toggle="modal" data-target="#siswaModal">
	<div class="col-md-4">
		<div style="background: rgba(54, 162, 235, 0.6);" class="card cards">
			<div class="content">
				<div class="header">   
					<p style="text-align: center; font-weight: bold;">Jumlah Peserta</p>
					<h3 style="text-align: center;"> {{ $siswaCount }} </h3>
				</div>
				<i class="glyphicon glyphicon-user"></i>
			</div>
		</div>
	</div>
</a>

<!-- Modal -->
<div id="siswaModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Daftar Peserta</h4>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>NIS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswa as $index => $student)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $student->siswa_name }}</td> 
                            <td>{{ $student->nis }}</td> 
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="col-md-4">
	<div style="background: rgba(255, 99, 132, 0.6);" class="card cards">
		<div class="content">
			<div class="header">   
				<p style="text-align: center; font-weight: bold;"> Jumlah Halaqah </p>
				<h3 style="text-align: center;"> {{ $classCount }} </h3>
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
	<canvas id="myChart" mwidth="100px" height="100px"></canvas>
</div>

<script>
	var ctx = document.getElementById('myChart').getContext('2d');
	
	var myChart = new Chart(ctx, {
		type: 'pie',
		data: {
			labels: ['Santri', 'Halaqah', 'Hafalan'],
			datasets: [{
				label: 'Data Sekolah',
				data: [{{ $siswaCount }}, {{ $classCount }}, {{ $hafalan }}],
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