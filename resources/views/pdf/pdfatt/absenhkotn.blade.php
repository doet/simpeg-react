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
///// tmp date /////// 
$start='16 Dec 2016';
$end='15 Jan 2017';
$varcol=0;
	echo '<table width="690px">
		<tr align="center">		
			<td class="left top right">No</td>
			<td class="top right">Payroll ID</td>
			<td class="top right">Nama</td>
			<td class="top right">Ket</td>';
		for($i=strtotime($start); $i<=strtotime($end); $i=$i+(24*60*60)) {
			echo '<td class="top right">'.date('d',$i).'</td>';
			$varcol++;
		}
		echo '
			<td class="top right">Jml</td>
			<td class="top"></td>
			<td class="top right"></td>';
	echo '</tr>';

$no = 1; 
foreach($query as $row){	
	echo '<tr>
		<td class="left top right"  align="center">'.$no.'</td>		
		<td class="top right">'.$row->payroll_id.'</td>
		<td class="top right">'.$row->nama_karyawan.'</td>
		<td class="top right">'.'shift'.' </td>';

		for($i=strtotime($start); $i<=strtotime($end); $i=$i+(24*60*60)) {
			echo '<td class="top right"  align="center">'.upah_helpers::att($row->payroll_id,'shift',$i).'</td>';
		}

	echo '
		<td class="top right" align="center"></td>
		<td rowspan="6" class="top"> 
			D : '. upah_helpers::RekapAbsen($row->payroll_id,'',$start,$end)['D'].'</br>
			A : '. upah_helpers::RekapAbsen($row->payroll_id,'',$start,$end)['A'].'</br>
			N : '. upah_helpers::RekapAbsen($row->payroll_id,'',$start,$end)['N'].'</br>
			D/A : '. upah_helpers::RekapAbsen($row->payroll_id,'',$start,$end)['D/A'].'</br>
			A/N : '. upah_helpers::RekapAbsen($row->payroll_id,'',$start,$end)['A/N'].'</br>			
			N/D : '. upah_helpers::RekapAbsen($row->payroll_id,'',$start,$end)['N/D'].'</br>			
			</td>
		<td rowspan="6" class="top right"> 
			HK :'.upah_helpers::RekapAbsen($row->payroll_id,'',$start,$end)['hk'].'</br>
			Shift : '. upah_helpers::RekapAbsen($row->payroll_id,'',$start,$end)['shift'].'</br>
			Lembur : '. upah_helpers::RekapAbsen($row->payroll_id,'',$start,$end)['lembur'].'</br>
			IJ : '. upah_helpers::RekapAbsen($row->payroll_id,'',$start,$end)['IJ'].'</br>
			SK : '. upah_helpers::RekapAbsen($row->payroll_id,'',$start,$end)['SK'].'</br>
			CT : '. upah_helpers::RekapAbsen($row->payroll_id,'',$start,$end)['CT'].'</br>
			AL : '. upah_helpers::RekapAbsen($row->payroll_id,'',$start,$end)['AL'].'</br>
			</td>';

	echo '</tr>';

	echo '<tr>
		<td class="left right"> </td>		
		<td class="right"> </td>
		<td class="right"> </td>
		<td class="left top right"> lembur </td>';
		for($i=strtotime($start); $i<=strtotime($end); $i=$i+(24*60*60)) {
			echo '<td class="top right" align="center">'.upah_helpers::att($row->payroll_id,'lembur',$i).'</td>';		
		}
	echo '<td class="top right" align="center"> </td>';

	echo '</tr>';

	echo '<tr>
		<td class="left right"> </td>		
		<td class="right"> </td>
		<td class="right"> </td>
		<td class="top right"> lembur off </td>';
		for($i=strtotime($start); $i<=strtotime($end); $i=$i+(24*60*60)) {
			echo '<td class="top right" align="center">'.upah_helpers::att($row->payroll_id,'lembur off',$i).'</td>';		
		}
	echo '
		<td class="top right"></td>';


	echo '</tr>';

	echo '<tr>
		<td class="left right"> </td>		
		<td class="right"> </td>
		<td class="right"> </td>
		<td class="top right"> hit.shiftlmb. </td>';
		for($i=strtotime($start); $i<=strtotime($end); $i=$i+(24*60*60)) {
			echo '<td class="top right" align="center">'.upah_helpers::hit($row->payroll_id,$i).'</td>';		
		}
	echo '<td class="top right" align="center">'. upah_helpers::RekapAbsen($row->payroll_id,'',$start,$end)['hit'].'</td>';

	echo '</tr>';

	echo '<tr>
		<td class="left right"> </td>		
		<td class="right"> </td>
		<td class="right"> </td>
		<td class="top right"> makan </td>';
		for($i=strtotime($start); $i<=strtotime($end); $i=$i+(24*60*60)) {
			echo '<td class="top right" align="center">'.upah_helpers::mkn($row->payroll_id,$i).'</td>';		
		}
	echo '<td class="top right" align="center">'. upah_helpers::RekapAbsen($row->payroll_id,'',$start,$end)['mkn'].'</td>';

	echo '</tr>';

	echo '<tr>
		<td class="left right"> </td>		
		<td class="right"> </td>
		<td class="right"> </td>
		<td class="top right"> Transport </td>';
		for($i=strtotime($start); $i<=strtotime($end); $i=$i+(24*60*60)) {
			echo '<td class="top right" align="center">'.upah_helpers::trns($row->payroll_id,$i).'</td>';		
		}
	echo '<td class="top right" align="center">'. upah_helpers::RekapAbsen($row->payroll_id,'',$start,$end)['trns'].'</td>';

	echo '</tr>';
	$no++;
}
echo '<tr><td class="top" colspan='.($varcol+10).'></td></tr></table>';
		
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