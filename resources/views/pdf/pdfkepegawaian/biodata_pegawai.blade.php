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
			font-size: 12px;
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
	<div style="position:absolute; top:10; left:100"><b>PT. PELABUHAN CILEGON MANDIRI<br />Bio Data Karyawan </b></div>
</div>

<table>
		<tr>
			<td class="">Nama</td>
			<td class="">{{$query->nama}}</td>
		</tr>
		<tr>
			<td class="">Jenis Kelamin</td>
			<td class="">{{$query->jk}}</td>
		</tr>
		<tr>
			<td class="">Tanggal Lahir</td>
			<td class="">{{date('d F Y',$query->dob)}}</td>
		</tr>
		<tr>
			<td class="">Agama</td>
			<td class="">{{$query->agama}}</td>
		</tr>
		<tr>
			<td class="">Gol Darah</td>
			<td class="">{{$query->goldar}}</td>
		</tr>
		<tr>
			<td class="">Alamat</td>
			<td class="">{{$query->alamat}}</td>
		</tr>
		<tr>
			<td class="top"> </td>
			<td class="top"> </td>
		</tr>
		<tr>
			<td class="">E-Mail</td>
			<td class="">{{$query->email}}</td>
		</tr>
		<tr>
			<td class="">Bank</td>
			<td class="">{{$query->rekbank}}</td>
		</tr>
		<tr>
			<td class="">E-Mail</td>
			<td class="">{{$query->email}}</td>
		</tr>
		<tr>
			<td class="">Pendidikan Terakhir</td>
			<td class="">{{$query->pendidikan}}</td>
		</tr>
		<tr>
			<td class="top"> </td>
			<td class="top"> </td>
		</tr>
		<tr>
			<td class="">Tanggal Masuk Kerja</td>
			<td class="">{{date('d F Y',$query->tmb)}}</td>
		</tr>
		<tr>
			<td class="">Tanggal Keluar Kerja</td>
			<td class="">{{$query->tkb}}</td>
		</tr>
		<tr>
			<td class="">NIK</td>
			<td class="">{{$query->nip}}</td>
		</tr>
		<tr>
			<td class="">Divisi</td>
			<td class="">{{$query->nmdivisi}}</td>
		</tr>
		<tr>
			<td class="">Jabatan</td>
			<td class="">{{$query->nmjabatan}}</td>
		</tr>
		<tr>
			<td class="">waktu Kerja</td>
			<td class="">{{$query->wkerja}}</td>
		</tr>

</table>

<div id="footer">
  <p class="page">Page </p>
</div>

@stop
