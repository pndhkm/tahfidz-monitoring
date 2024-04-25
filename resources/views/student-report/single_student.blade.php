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
		<h4> Laporan Rekap Ananda {{ $siswa_id }} <h4> 
	<p>
</div>

<hr>

<table id="table_style">
<thead>
	<tr>
	<th> Surat </th>
	<!-- <th> Surat </th> -->
	<th> Penilaian</th>
	<th> Tanggal </th>
	</tr>
</thead>
<tbody>

<?= $old_assessment = null; ?>

<?php foreach ($data as $assessment) { ?>

    <tr>

    <td>{{ $assessment->assessment }}: {{ $assessment->range }}</td>
    <td>
		Kelancaran: {{ $assessment->kelancaran }} <br>
		Tajwid: {{ $assessment->tajwid }} <br>
		Makhraj: {{ $assessment->makhraj }} <br><br>
    	Catatan: {{ $assessment->note }}
	</td>
    <td>{{ date('d M Y', strtotime($assessment->date)) }}</td>
    
    </tr>

<?php } ?>

</tbody>
</table>	
</html>