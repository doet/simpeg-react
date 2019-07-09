@extends('pdf.mpdf')
@section('content')
	<style type="text/css">
		body {
		/*	width: 500px;
			margin: 40px auto;
			color: #444;*/
			font-family: :"Arial", Helvetica, sans-serif !important;
			font-size: 11px;

		}
    @page { margin: 110px 20px 40px 60px }
    #header { position: fixed; top: -90px; left:-10px; right: -10px; height: 80px; }
    #footer { position: fixed; left: -10px; bottom: -30px; right: -10px; height: 40px; }
    #footer .page:after { content: counter(page, normal); }

		table {
		  border-collapse: collapse; /* IE7 and lower */
		  border-spacing: 0;
			margin-top:10px;
		  width: 100%;
			margin-bottom:10px;
			max-height:50px;
			height:30px ;
			font-family :"Arial", Helvetica, sans-serif !important;
			font-size: 9px;
		}

		.left{
		    border-left: 1px solid;
		}
		.right{
		    border-right: 1px solid;
		}
		.top{
		    border-top: 1px solid;
		}
		.button{
			border-bottom: 1px solid;
		}

		.zebra tr:nth-child(even) {
		     background-color: #f9f9f9;
		}
		.zebra tr:nth-child(odd) {
		     background-color: #DCDCDC;
		}

		.number {
			text-align:right
		}
		.center {
			text-align:center;
		}


</style>



<div id="header">
	<img src="{{public_path().'\\pic\\logo.png'}}" width="125px">
	<div style="position:absolute; top:10; left:100"><b>PT. PELABUHAN CILEGON MANDIRI<br />Data Karyawan </b></div>
</div>

<table>
	<thead>
		<tr>
			<th class="center left top right">No</th>
			<th class="center top right">NIK</th>
			<th class="center top right">Nama Lengkap</th>
			<th class="center top right">Divisi</th>
			<th class="center top right">Jabatan</th>
			<th class="center top right">ID Sistem</th>
		</tr>
	</thead>
	<tbody>
<?php
	$no=1;
	foreach ($query as $row){
?>
		<tr>
			<td class="center left top right" width='20px'>{{$no++}}</td>
			<td class="center top right" width='60px'>{{$row->nip}}</td>
			<td class="top right">&nbsp;{{$row->nama}}</td>
			<td class="top right">&nbsp;{{$row->nmdivisi}}</td>
			<td class="top right">&nbsp;{{$row->nmjabatan}}</td>
			<td class="center top right" width='60px'>{{$row->id}}</td>
		</tr>
<?php
	}
?>
		<tr>
			<td class="top"> </td>
			<td class="top"> </td>
			<td class="top"> </td>
			<td class="top"> </td>
			<td class="top"> </td>
			<td class="top"> </td>
		</tr>
	</tbody>
</table>

<div id="footer">
  <p class="page">Page </p>
</div>

@stop
