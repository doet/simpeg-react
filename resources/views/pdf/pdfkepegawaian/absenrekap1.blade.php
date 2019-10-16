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
    <center>REKAPITULASI CUTI, IZIN, PERJALANAN DINAS, & LEMBUR KARYAWAN<br />
	<font size="-1">Priode : {{ $start }} s.d. {{ $end }}</font></center>

</div>


  <div id="footer">
    <p class="page">Page </p>
  </div>


<?php

		echo '<table width="690px">
			  <tr>
			    <td class="left top right" colspan="7" style="background-color: lime"><b>1. Cuti</b></td>
			  </tr>
			   <tr>
			    <th class="left top right" width="50px">No</th>
				<th class="top right">Nama</th>
		        <th class="top right" width="200px">Tanggal</th>
		        <th class="top right" width="50px">Cuti</th>
				<th class="top right" width="50px">Sisa Cuti</th>
				<th class="top right" colspan="2">Keterangan</th>
			  </tr>	 ';
		$no=1;
		$cont=0;
		foreach ($cuti as $rowcuti) {
			$waktu=0;

			if ($rowcuti->wkerja == 0){
		      $masacuti = AppHelpers::hitungcuti(date('d-m-Y', $rowcuti->sdate),date('d-m-Y', $rowcuti->edate),'-');
	    } else if($rowcuti->wkerja == 1){
	        $masacuti = AppHelpers::hitungcutishift(date('d-m-Y', $rowcuti->sdate),date('d-m-Y', $rowcuti->edate),'-',$rowcuti->id_u);
	    }

		 	if ($rowcuti->sdate==$rowcuti->edate)$waktu=date('d M Y',$rowcuti->sdate);else $waktu=date('d M Y',$rowcuti->sdate).' s.d '.$waktu=date('d M Y',$rowcuti->edate);

			 echo '
			 	<tr>
			 		<td class="left top right" align="center">'.$no.'</td>
			 		<td class="top right">&nbsp;'.$rowcuti->nama.'</td>
			 	    <td class="top right" align="right"><span id="ijind'.$no.'">'.$waktu.'</span>&nbsp;</td>
			 	    <td class="top right" align="right"><span id="ijinh'.$no.'">'.$masacuti.'</span> hari &nbsp;</th>
			 		<td class="top right" align="right">'.AppHelpers::sisacuti(1,1,$rowcuti->id_u).' hari &nbsp;</td>
			 		<td class="top right" colspan="2">&nbsp;'.$rowcuti->ket.'</td>
			 		</tr>';
		 		$no++;
		}
		echo'
			  <tr>
			    <td class="left top right" colspan="7" style="background-color: lime"><b>2. Ijin</b></td>
			  </tr>
			  <tr>
			    <th class="left top right">No</th>
				<th class="top right">Nama</th>
		        <th class="top right">Tanggal</th>
		        <th class="top right">Jml. Hari</th>
				<th class="top right" colspan="3">Keterangan</th>
			  </tr>	';
		$no=1;
		$cont=0;
		$ket=$nm='';
		$hari=1;
		foreach ($rekap as $ijin) {
			switch ($ijin->status) {
				case '2':
					$status = 'Ijin';
				break;
				case '3':
					$status = 'Sakit';
				break;
				case '6':
					$status = 'Ijin dinas';
				break;
			}
			if ($ijin->status==2 OR $ijin->status==3 OR $ijin->status==6){
				if ($ijin->ket == $ket AND $ijin->nama == $nm){
					$hari++;
					$edate=date('d M Y',$ijin->date);

					echo '<script>var tgl = $("#'.$no.'-ijind");
						$(tgl).html(" s.d '.$edate.'");</script>';
					echo '<script>$("#'.$no.'-ijinh").html("'. $hari.'");</script>';

				}else{

					echo '<tr>
					    <td class="left top right" align="center">'.$no.'  </td>
						<td class="top right">&nbsp;'.$ijin->nama.'</td>
				        <td class="top right" align="right">'.date('d M Y',$ijin->date).'<span id="'.$no.'-ijind"></span>&nbsp;</td>
				        <td class="top right" align="right"><span id="'.$no.'-ijinh">'.$hari.'</span> hari &nbsp;</th>
				        <td class="top right" colspan="3">&nbsp;('.$status.') '.$ijin->ket.'</td>
					</tr>';
					$no++;
				}
				$ket=$ijin->ket;
				$nm=$ijin->nama;

			}
		}
		// //foreach ($rekap as $ijin) {
		// /*	switch ($ijin->status) {
		// 		case '2':
		// 			$status = 'Ijin';
		// 		break;
		// 		case '3':
		// 			$status = 'Sakit';
		// 		break;
		// 	}
		// 	if ($ijin->status==2 OR $ijin->status==3){
		// 		if ($ijin->date == $cont AND $ijin->ket==$ket){
		// 			$hari++;
		// 			echo '<script>
		// 				document.getElementById("ijinh'.($no-1).'").innerHTML = "'.$hari.'";
		// 			</script>';
		// 			if ($hari>2){
		// 				echo '<script>
		// 					var nawal=document.getElementById("ijind'.($no-1).'").innerHTML;
		// 					document.getElementById("etgl'.($no-1).'").innerHTML = "'.date('d M Y',$ijin->date).'" ;
		// 				</script>';
		// 			}elseif ($hari>1){
		// 				echo '<script>
		// 					var nawal=document.getElementById("ijind'.($no-1).'").innerHTML;
		// 					document.getElementById("ijind'.($no-1).'").innerHTML = nawal + " s.d. <span id=etgl'.($no-1).'>'.date('d M Y',$ijin->date).'</span>" ;
		// 				</script>';
		// 			}
		// 		}else {
		// 			$hari=1;
		// 			echo '
		// 			  <tr>
		// 			    <td class="left top right" align="center">'.$no.'</td>
		// 				<td class="top right">&nbsp;'.$ijin->nama.'</td>
		// 		        <td class="top right" align="right"><span id="ijind'.$no.'">'.date('d M Y',$ijin->date).'</span>&nbsp;</td>
		// 		        <td class="top right" align="right"><span id="ijinh'.$no.'">'.$hari.'</span> hari &nbsp;</th>
		// 				<td class="top right" colspan="3">&nbsp;('.$status.') '.$ijin->ket.'</td>
		// 			  </tr>';
		// 			  $no++;
		// 		}
		// 		$cont=$ijin->date+(24*60*60);
		// 		$ket=$ijin->ket;
		// 	}*/
		//
		//
		// 	//}
			echo '	  <tr>
			    <td class="left top right" colspan="7" style="background-color: lime"><b>3. Perjalanan Dinas</b></td>
			  </tr>
			   <tr>
			    <th class="left top right">No</th>
				<th class="top right">Nama</th>
		        <th class="top right">Tanggal</th>
		        <th class="top right">Jml. Hari</th>
				<th class="top right" colspan="3">Keterangan</th>
			  </tr>
			  ';
		$no=1;
		$cont=0;
		foreach ($rekap as $spd) {
			if ($spd->status==5){
				if ($spd->date == $cont AND $spd->ket==$ket){
					$hari++;

				}else {
					$hari=1;
					echo '
					  <tr>
					    <td class="left top right" align="center">'.$no.'</td>
						<td class="top right">&nbsp;'.$spd->nama.'</td>
				        <td class="top right" align="right"><span id="ijind'.$no.'">'.date('d M Y',$spd->date).'</span>&nbsp;</td>
				        <td class="top right" align="right"><span id="ijinh'.$no.'">'.$hari.'</span> hari &nbsp;</th>
						<td class="top right" colspan="3">&nbsp;'.$spd->ket.'</td>
					  </tr>';
					  $no++;
				}

				$cont=$spd->date+(24*60*60);
				$ket=$spd->ket;
			}
		}
		echo'	  <tr>
			    <td class="left top right" colspan="7" style="background-color: lime"><b>4. Lemburan</b></td>
			  </tr>
			  <tr>
			    <th class="left top right">No</th>
				<th class="top right">Nama</th>
		        <th class="top right">Tanggal</th>
		        <th class="top right">jam mulai</th>
		        <th class="top right">jam selesai</th>
		        <th class="top right" width="50px">jumlah jam</th>
				<th class="top right">Keterangan</th>
			  </tr>';

		foreach ($rekap as $lembur) {
			if ($lembur->status==7){echo '
			  <tr>
			    <td class="left top right" align="center">No</td>
				<td class="top right">&nbsp;'.$lembur->nama.'</td>
		        <td class="top right">'.date('d M Y',$lembur->date).'&nbsp;</td>
		        <td class="top right" align="center">'.$lembur->jmasuk.'</td>
		        <td class="top right" align="center">'.$lembur->jkeluar.'</td>
		        <td class="top right" width="50px" align="center">'.AppHelpers::selisih ($lembur->jkeluar,$lembur->jmasuk).'</td>
				<td class="top right">&nbsp;'.$lembur->ket.'</td>
			  </tr>';
			}
		}
		echo '	  <tr>
			    <td class="top" colspan="7"></td>
			  </tr>
			</table>
			';

		echo '<table width="800px" border="0" align="right">
			<tr>
				<td align="center" valign="top"> 17 '.date('M Y').'<br />Dibuat Oleh,<br />Admin SDM<br /><br /><br /><br /><br />&nbsp;</td>
				<td align="center" valign="top"><br />Diperiksa Oleh, <br />Spv. SDM & Umum<br /><br /><br /><br /><br />&nbsp;</td>
				<td align="center" valign="top"><br />Disetujui Oleh, <br />Mgr. SDM & Umum<br />
			<br /><br /><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>';
		echo '<div style="page-break-after: always;"></div>';
?>
&nbsp;<br />
@stop
