<!DOCTYPE html>
<html>
<head>
	<title>Laporan</title>
</head>
<style>

	#table_style {
	  font-family: DejaVu Sans, sans-serif;
	  border-collapse: collapse;
	  width: 100%;
	  padding-top: 20px;
	}

	#table_style td, #table_style th {
	  border: 1px solid #ddd;
	  padding: 8px;
	}

	#table_style tr:nth-child(even){background-color: #f2f2f2;}

	#table_style tr:hover {background-color: #ddd;}

	#table_style th {
	  padding-top: 12px;
	  padding-bottom: 12px;
	  text-align: left;
	  background-color: #4CAF50;
	  color: white;
	}

</style>
<body>

<div style="text-align: center; line-height: 1.5;">
	<p> 
		<h4> Laporan Rekap Santri Halaqah {{ $class_id }}<h4>
	<p>
</div>

<hr>

<table id="table_style">
<thead>
	<tr>
	<th> Santri </th>
	<!-- <th> Surat </th> -->
	<th> Kelancaran</th>
	<th> Tajwid </th>
	<th> Makhraj </th>
	<th> Nilai </th>
	<th> Banyak Halaman </th>
	<th> Keterangan </th>
	<th> Tanggal </th>
	</tr>
</thead>
<tbody>

<?= $old_assessment = null; ?>

<?php foreach ($data as $assessment) { ?>

    <tr>

    @if ($assessment->siswa_id != $old_assessment)
   
        <td>{{ $assessment->getSiswa->siswa_name }}</td>
        
        <?php $old_assessment = $assessment->siswa_id; ?>
   
   	@else
        <td></td>
    @endif
    
    <!-- <td>{{ $assessment->assessment }}</td> -->
    <td>{{ $assessment->kelancaran }}</td>
    <td>{{ $assessment->tajwid }}</td>
    <td>{{ $assessment->makhraj }}</td>
    <td>{{ $assessment->nilai }}</td>
    <td>{{ $assessment->banyak_halaman }}</td>
    <td>{{ $assessment->note }}</td>
    <td>{{ date('d M Y', strtotime($assessment->date)) }}</td>
    
    </tr>

<?php } ?>

</tbody>
</table>	
</html>