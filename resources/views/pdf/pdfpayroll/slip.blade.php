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
	height:40px ;
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

</style>

  
 
<div id="header">
	<img src="{{public_path().'\\pic\\logo.png'}}" width="125px"><div style="position:absolute; top:10; left:100"><b>PT. BUANA CENTRA SWAKARSA<br />
SDM & Hukum</b></div>
    <center>PEMBAYARAN BAZIZ<br />
	<font size="-1">Priode : {{ $start }} s.d. {{ $end }} </font></center>
    
</div>


  <div id="footer">
    <p class="page">Page </p>
  </div>

<?php

foreach($query as $row){

	echo '<table width="690px">
		<tr>		
			<td width="60px">NIK</td>
			<td>'.$row->payroll_id.'</td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>'.$row->nama_karyawan.'</td>
		</tr>
		<tr>
			<td>Jabatan</td>
			<td>'.$row->title.'</td>
		</tr>
		<tr>
			<td>Divisi</td>
			<td>'.$row->div_name.'</td>
		</tr>
		<tr>
			<td>Priode</td>
			<td>'.$start.' - '.$end.'</td>
		</tr>
		<tr>
			<td>HK</td>
			<td>'.$upah_helpers::RekapAbsen('1506.2792','shift',$start,$end)['hk'].'</td>
		</tr>
		</table>';

	echo '<table width="690px">
		<tr>
			<td width="10px">I</td>		
			<td width="10px">a.</td>
			<td width="60px">Upah Pokok</td>
			<td>'.$row->div_name.'</td>
		</tr>
		<tr>
			<td>II</td>		
			<td>b.</td>
			<td>Transport</td>
			<td>'.$start.' - '.$end.'</td>
		</tr>
		<tr>
			<td>II</td>		
			<td>c.</td>
			<td>THR 2015</td>
			<td>'.$row->nama_karyawan.'</td>
		</tr>
		<tr>
			<td>II</td>		
			<td>d.</td>
			<td>Shift</td>
			<td>'.$row->nama_karyawan.'</td>
		</tr>
		<tr>
			<td>II</td>		
			<td>e.</td>
			<td>Lembur</td>
			<td>'.$row->nama_karyawan.'</td>
		</tr>
		<tr>
			<td>II</td>		
			<td>f.</td>
			<td>KHK</td>
			<td>'.$row->nama_karyawan.'</td>
		</tr>
		<tr>
			<td>II</td>		
			<td>g.</td>
			<td>Lain-lain</td>
			<td>'.$row->nama_karyawan.'</td>
		</tr>
		<tr>
			<td>II</td>		
			<td>h.</td>
			<td>Tunj. Skil</td>
			<td>'.$row->nama_karyawan.'</td>
		</tr>
		<tr>
			<td>II</td>		
			<td>i.</td>
			<td>Fix Insentif</td>
			<td>'.$row->nama_karyawan.'</td>
		</tr></table>';

	echo '<table width="690px">
		<tr>
			<td width="10px">I</td>		
			<td width="10px">a.</td>
			<td width="60px">Upah Pokok</td>
			<td>'.$row->div_name.'</td>
		</tr>
		<tr>
			<td>II</td>		
			<td>b.</td>
			<td>Transport</td>
			<td>'.$start.' - '.$end.'</td>
		</tr>
		<tr>
			<td>II</td>		
			<td>c.</td>
			<td>THR 2015</td>
			<td>'.$row->nama_karyawan.'</td>
		</tr>
		<tr>
			<td>II</td>		
			<td>d.</td>
			<td>Shift</td>
			<td>'.$row->nama_karyawan.'</td>
		</tr>
		<tr>
			<td>II</td>		
			<td>e.</td>
			<td>Lembur</td>
			<td>'.$row->nama_karyawan.'</td>
		</tr>
		<tr>
			<td>II</td>		
			<td>f.</td>
			<td>KHK</td>
			<td>'.$row->nama_karyawan.'</td>
		</tr>
		<tr>
			<td>II</td>		
			<td>g.</td>
			<td>Lain-lain</td>
			<td>'.$row->nama_karyawan.'</td>
		</tr>
		<tr>
			<td>II</td>		
			<td>h.</td>
			<td>Tunj. Skil</td>
			<td>'.$row->nama_karyawan.'</td>
		</tr>
		<tr>
			<td>II</td>		
			<td>i.</td>
			<td>Fix Insentif</td>
			<td>'.$row->nama_karyawan.'</td>
		</tr></table>';
}
		
	function Terbilang($x)
	{
		$abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
		if ($x < 12)
		return " " . $abil[$x];
		elseif ($x < 20)
    	return Terbilang($x - 10) . "Belas";
  		elseif ($x < 100)
    	return Terbilang($x / 10) . " Puluh" . Terbilang($x % 10);
  		elseif ($x < 200)
    	return " Seratus" . Terbilang($x - 100);
  		elseif ($x < 1000)
    	return Terbilang($x / 100) . " Ratus" . Terbilang($x % 100);
  		elseif ($x < 2000)
    	return " Seribu" . Terbilang($x - 1000);
  		elseif ($x < 1000000)
    	return Terbilang($x / 1000) . " Ribu" . Terbilang($x % 1000);
  		elseif ($x < 1000000000)
    	return Terbilang($x / 1000000) . " Juta" . Terbilang($x % 1000000);
	}
?>

@stop