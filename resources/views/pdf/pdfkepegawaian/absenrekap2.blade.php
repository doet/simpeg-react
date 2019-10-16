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
	<img src="{{public_path().'\\pic\\logo.png'}}" width="125px"><div style="position:absolute; top:10; left:100"><b>PT. PELABUHAN CILEGON MANDIRI<br />
SDM & Hukum</b></div>
    <center>ATTENDANCE LOG<br />
	<font size="-1">Priode : {{ $start }} s.d. {{ $end }}</font></center>

</div>


  <div id="footer">
    <p class="page">Page </p>
  </div>

<?php

foreach ($query as $row) {
	$isi[$row->id_u]['sakit']=0;
	$isi[$row->id_u]['cuti']=0;
	$isi[$row->id_u]['ijin']=0;
	$isi[$row->id_u]['tdhadir']=0;
	$isi[$row->id_u]['spd']=0;
	$isi[$row->id_u]['hadir']=0;
	$isi[$row->id_u]['total']=0;

}
$nama=0;
if ($absen!='[]'){

	foreach ($absen as $absen) {
		$isi[$absen->id_u]['total']++;
		if($absen->status==3)$isi[$absen->id_u]['sakit']++;
		if($absen->status==4)$isi[$absen->id_u]['cuti']++;
		if($absen->status==2)$isi[$absen->id_u]['ijin']++;
		if($absen->status==1 OR ($absen->hadir==0 AND $absen->status==0))$isi[$absen->id_u]['tdhadir']++;
		if($absen->status==5)$isi[$absen->id_u]['spd']++;
		if($absen->hadir==1) $isi[$absen->id_u]['hadir']++;

		if ($nama!=$absen->nama){
			if($absen->status==3)$isi[$absen->id_u]['sakit']=1;
			if($absen->status==4)$isi[$absen->id_u]['cuti']=1;
			if($absen->status==2)$isi[$absen->id_u]['ijin']=1;
			if($absen->status==1)$isi[$absen->id_u]['tdhadir']=1;
			if($absen->status==5)$isi[$absen->id_u]['spd']=1;
			if($absen->hadir==1)$isi[$absen->id_u]['hadir']=1;
		}
		$nama=$absen->nama;
	}
}
echo '<table width="690px">
	<tr>
		<th class="left top right" width="50px" rowspan="2" align="center">No</th>
		<th class="top right" rowspan="2" align="center">Nama</th>
		<th class="left top right" colspan="6" align="center">Jumlah Hari</th>
		<th class="top right" width="80px" rowspan="2" align="center">Kekurangan Bulan Lalu</th>
		<th class="top right" width="80px" rowspan="2" align="center">Total Kehadiran</th>
	</tr>
	<tr>
		<th class="top right" width="45px" align="center">Kerja</th>
		<th class="top right" width="45px" align="center">S</th>
		<th class="top right" width="45px" align="center">C</th>
		<th class="top right" width="45px" align="center">I</th>
		<th class="top right" width="45px" align="center">A</th>
		<th class="top right" width="45px" align="center">SPD</th>
	</tr>
	<tr>
		<td class="left top right" colspan="10" style="background-color: lime"><b>Non Shift</b></td>
	</tr>';
	$no=1;
	$headwaktu=0;
	foreach ($query as $row) {
		if ($headwaktu!=$row->wkerja){
			echo'<tr>
					<td class="left top right" colspan="10" style="background-color: lime"><b>Shift</b></td>
				</tr>';
			$headwaktu=1;
		}
		echo '<tr>
				<td class="left top right" align="center"> '.$no.'</td>
				<td class="top right"> '.$row->nama.'</td>
				<td class="top right" align="center"> '.$isi[$row->id_u]['total'].' </td>
				<td class="top right" align="center"> '.$isi[$row->id_u]['sakit'].'</td>
				<td class="top right" align="center"> '.$isi[$row->id_u]['cuti'].'</td>
				<td class="top right" align="center"> '.$isi[$row->id_u]['ijin'].'</td>
				<td class="top right" align="center" style="background-color: LightCoral"> '.$isi[$row->id_u]['tdhadir'].'</td>
				<td class="top right" align="center"> '.$isi[$row->id_u]['spd'].'</td>
				<td class="top right" align="center"> 0 </td>
				<td class="top right" align="center" style="background-color: Bisque"> '.$isi[$row->id_u]['hadir'].' hari</td>
			</tr>';


		$no++;
	}

	echo '
	<tr>
		<td class="top" colspan="10"></td>
	</tr>
	</table>
	';
echo '<table width="800px" border="0" align="right">
	<tr>
		<td align="center" valign="top"> 17 '.date('M Y').'<br />Dibuat Oleh,<br />Admin SDM<br /><br /><br /><br /><br />&nbsp;</td>
		<td align="center" valign="top"><br />Diperiksa Oleh, <br />Spv. SDM & Umum<br /><br /><br /><br /><br />&nbsp;</td>
		<td align="center" valign="top"><br />Disetujui Oleh, <br />Mgr. SDM & Umum<br />
	<br /><br /><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>';
				//echo '<div style="page-break-after: always;"></div>';
?>
&nbsp;<br />
@stop
