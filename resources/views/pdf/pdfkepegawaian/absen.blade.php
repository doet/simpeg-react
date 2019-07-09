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
    <center>LOG ABSEN<br />
	<font size="-1">Priode : {{ $start }} s.d. {{ $end }}</font></center>

</div>


  <div id="footer">
    <p class="page">Page </p>
  </div>


<?php


if ($absen!='[]'){
	$namap='';
	$no = 1;
	$i=0;
	//$cell9=$jtk=$jijin=$jsakit=$jcuti=$jspd=$noatt=0;
	$cell9=$jtk=$jijin=$jsakit=$jcuti=$jspd=$noatt=0;
	$tslp='00:00';
	$tslm='00:00';
	foreach ($absen as $row) {
		if ($namap != $row->nama){
			if ($i != 0){
				echo '<tr><td class="top" colspan="9"></td></tr></tbody></table>';
				$no = 1;

		echo '<table width="350px">
		<tr>
			<td class="left top right">&nbsp;Masuk Lambat</td>
			<td class="top right">&nbsp;'.$tslm.'</td>
		</tr>
		<tr>
			<td class="left top right">&nbsp;Pulang Cepat</td>
			<td class="top right">&nbsp;'.$tslp.'</td>
		</tr>
		<tr>
			<td class="left top right">&nbsp;Total Masuk Terlambat dan Pulang Cepat</td>
			<td class="top right">&nbsp;'.AppHelpers::TotalWaktu($tslm,$tslp).'</td>
		</tr>
		<tr>
			<td class="left top right">&nbsp;Tanpa Keterangan</td>
			<td class="top right">&nbsp;'.$jtk.' Hari</td>
		</tr>
		<tr>
			<td class="left top right">&nbsp;Ijin</td>
			<td class="top right">&nbsp;'.$jijin.' Hari</td>
		</tr>
		<tr>
			<td class="left top right">&nbsp;Sakit</td>
			<td class="top right">&nbsp;'.$jsakit.' Hari</td>
		</tr>
		<tr>
			<td class="left top right">&nbsp;Cuti</td>
			<td class="top right">&nbsp;'.$jcuti.' Hari</td>
		</tr>
		<tr>
			<td class="left top right">&nbsp;SPD</td>
			<td class="top right">&nbsp;'.$jspd.' Hari</td>
		</tr>
		<tr>
			<td class="left top right">&nbsp;Jumlah Hari Kerja</td>
			<td class="top right">&nbsp;'.$cell9.' Hari</td>
		</tr>
		<tr>
			<td class="left top right">&nbsp;Lembur</td>
			<td class="top right">&nbsp;'.$lembur.' Hari</td>
		</tr>';
		if ($row->wkerja==1){
			echo '<tr>
				<td class="left top right">&nbsp;Shift 1</td>
				<td class="top right">&nbsp;'.Gajihelpers::rabsen($row->id_u,$start,$end)['tshift1'].' Hari</td>
			</tr>
			<tr>
				<td class="left top right">&nbsp;Shift 2</td>
				<td class="top right">&nbsp;'.$shift2.' Hari</td>
			</tr>
			<tr>
				<td class="left top right">&nbsp;Shift 3</td>
				<td class="top right">&nbsp;'.$shift3.' Hari</td>
			</tr>';
		}
		echo '<tr><td class="top" colspan="2"></td></tr></table>';
				echo '<div style="page-break-after: always;"></div>';

			}
			$lembur=$cell9=$jtk=$jijin=$jsakit=$jcuti=$jspd=$noatt=$shift1=$shift2=$shift3=0;

			$tslm='00:00';
			$tslp='00:00';
			echo 'Nama : '.$row->nama.'<table width="690px">
			<thead>
			   <tr>
			    <th class="left top right" width="20px">No</th>
                <th class="top right" width="80px">Tanggal</th>
                <th class="top right" width="50px">Waktu</th>
				<th class="top right" width="60px">Jam Kerja</th>
				<th class="top right" width="50px">Scan <br>Masuk</th>
				<th class="top right" width="50px">Scan <br>Pulang</th>
				<th class="top right" width="50px">Datang <br>Terlambat</th>
				<th class="top right" width="50px">Pulang <br>Cepat</th>
				<th class="top right" width="150px">Hari Kerja</th>
			  </tr>
			</thead>
			<tbody>';

		}

		if (!$row->idate==0){
            $sm=date('H:i', $row->idate);
            if ($row->jmasuk == '00:00')$jammasuk='24:00';else$jammasuk=$row->jmasuk;
            if ($row->cki==1){
                if ($jammasuk < $sm)$slm=AppHelpers::selisih ($sm,$row->jmasuk);else $slm='';
            } else {
                $slm='';
            }
        }else{
            $sm='0';
            $slm='';
            if($row->cki==1 AND $row->idate==0)$noatt++;
        }

        if (!$row->odate==0){
            $sp=date('H:i', $row->odate);
            if ($row->jkeluar == '24:00')$jamkeluar='00:00';else$jamkeluar=$row->jkeluar;
            if ($row->cko==1){
                if ($jamkeluar > $sp)$slp=AppHelpers::selisih ($row->jkeluar,$sp);else $slp='';
            } else {
                $slp='';
            }
        }else{
            $sp='0';
            $slp='';
            if($row->cko==1 AND $row->odate==0)$noatt++;
        }

		$cell5=$cell6=$cell7=$cell8='';			//Total Tidak Ada Jam Masuk Dan Pulang
		if ($sm == '0' && $sp == '0'){
			if ($row->cki!=0 && $row->cko!=0){
				$cell5 = $cell6 = $cell7 = $cell8 = 'pink';
			} else{
				if ($row->cki!=0)$cell5='#5BD7FF';
				if ($row->cko!=0)$cell6='#5BD7FF';
			}
		} else if ($sm == '0'){
			if ($row->cki!=0)$cell5='#5BD7FF';
		} else if ($sp == '0'){
			if ($row->cko!=0)$cell6='#5BD7FF';
		}

		if ($slm!='')$cell7='red';
		if ($slp!='')$cell8='yellow';

		switch ($row->status) {
			case '0':
				if($row->hadir==1)$cell9++;
				if($row->hadir==0)$cell9b='';else $cell9b=$cell9;
				if($row->ket)$cell9a = $cell9b.' - '.$row->ket; else $cell9a = $cell9b;
				//if($row->date==1481475600){$cell9a = $cell9b.' - Lembur';$lembur++;}
			break;
			case '1':
				if($row->hadir==1)$cell9++;
				if($row->hadir==0)$cell9b='';else $cell9b=$cell9;
				$cell9a = $cell9b.' (tanpa ket) '.$row->ket;
				$jtk++;
			break;
			case '2':
				if($row->hadir==1)$cell9++;
				if($row->hadir==0)$cell9b='';else $cell9b=$cell9;
				$cell9a = $cell9b.' (Ijin) '.$row->ket;
				$jijin++;
			break;
			case '3':
				if($row->hadir==1)$cell9++;
				if($row->hadir==0)$cell9b='';else $cell9b=$cell9;
				$cell9a = $cell9b.' (Sakit) '.$row->ket;
				$jsakit++;
			break;
			case '4':
				if($row->hadir==1)$cell9++;
				if($row->hadir==0)$cell9b='';else $cell9b=$cell9;
				$cell9a = $cell9b.' (Cuti) '.$row->ket;
				$jcuti++;
			break;
			case '5':
				if($row->hadir==1)$cell9++;
				if($row->hadir==0)$cell9b='';else $cell9b=$cell9;
				$cell9a = $cell9b.' (SPD) '.$row->ket;
				$jspd++;
			break;
			case '6':
				if($row->hadir==1)$cell9++;
				if($row->hadir==0)$cell9b='';else $cell9b=$cell9;
				$cell9a = $cell9b.' (Ijin Dinas) '.$row->ket;
				//$jspd++;
			break;
			case '7':
				if($row->hadir==1)$cell9++;
				if($row->hadir==0)$cell9b='';else $cell9b=$cell9;
				$cell9a = $cell9b.' (Lembur) '.$row->ket;
				$lembur++;
				//$jspd++;
			break;
		}


		if ($slm!='')$tslm=AppHelpers::TotalWaktu($tslm,$slm);
		if ($slp!='')$tslp=AppHelpers::TotalWaktu($tslp,$slp);

		if (date('N', $row->date)==1)$hariidn='Senin';
		if (date('N', $row->date)==2)$hariidn='Selasa';
		if (date('N', $row->date)==3)$hariidn='Rabu';
		if (date('N', $row->date)==4)$hariidn='Kamis';
		if (date('N', $row->date)==5)$hariidn="Jum'at";
		if (date('N', $row->date)==6)$hariidn='Sabtu';
		if (date('N', $row->date)==7)$hariidn='Minggu';

		if ($row->jmasuk=='00:00')$shift1++;
		if ($row->jmasuk=='08:00')$shift2++;
		if ($row->jmasuk=='16:00')$shift3++;

			$lbr = DB::table('tb_libur')
				->where('tgllibur',$row->date)
				->first();

			if ($lbr) $tg = "<font color='red'><b>".date('d M Y', $row->date)."</b></font>"; else $tg = date('d M Y', $row->date);

			echo '<tr  bgcolor="';
				if($no%2==1) echo"#f9f9f9"/*warna genap*/; else echo"#DCDCDC";/*warna ganjil*/
			echo '">';
			echo '<td class="left top right" align="center">'.$no.'</th>
                <td class="top right" align="center">&nbsp;'.$tg.'</th>
                <td class="top right" align="center">&nbsp;'.$hariidn.'</th>
				<td class="top right" align="center">&nbsp;'.$row->jmasuk.' - '.$row->jkeluar.'</th>
				<td class="top right" bgcolor="'.$cell5.'" align="center">&nbsp;'.$sm.'</th>
				<td class="top right" bgcolor="'.$cell6.'" align="center">&nbsp;'.$sp.'</th>
				<td class="top right" bgcolor="'.$cell7.'" align="center"><font color="white">&nbsp;'.$slm.'</font></th>
				<td class="top right" bgcolor="'.$cell8.'" align="center">&nbsp;'.$slp.'</th>
				<td class="top right">&nbsp;'.$cell9a.'</th>
			  </tr>';
		$namap=$row->nama;
		$no++;
		$i++;
	}
	if ($i == count($absen)){
		echo '<tr><td class="top" colspan="9"></td></tr></tbody></table>';
		$no = 1;

		echo '<table width="350px">
		<tr>
			<td class="left top right">&nbsp;Masuk Lambat</td>
			<td class="top right">&nbsp;'.$tslm.'</td>
		</tr>
		<tr>
			<td class="left top right">&nbsp;Pulang Cepat</td>
			<td class="top right">&nbsp;'.$tslp.'</td>
		</tr>
		<tr>
			<td class="left top right">&nbsp;Total Masuk Terlambat dan Pulang Cepat</td>
			<td class="top right">&nbsp;'.AppHelpers::TotalWaktu($tslm,$tslp).'</td>
		</tr>
		<tr>
			<td class="left top right">&nbsp;Tanpa Keterangan</td>
			<td class="top right">&nbsp;'.$jtk.' Hari</td>
		</tr>
		<tr>
			<td class="left top right">&nbsp;Ijin</td>
			<td class="top right">&nbsp;'.$jijin.' Hari</td>
		</tr>
		<tr>
			<td class="left top right">&nbsp;Sakit</td>
			<td class="top right">&nbsp;'.$jsakit.' Hari</td>
		</tr>
		<tr>
			<td class="left top right">&nbsp;Cuti</td>
			<td class="top right">&nbsp;'.$jcuti.' Hari</td>
		</tr>
		<tr>
			<td class="left top right">&nbsp;SPD</td>
			<td class="top right">&nbsp;'.$jspd.' Hari</td>
		</tr>
		<tr>
			<td class="left top right">&nbsp;Jumlah Hari Kerja</td>
			<td class="top right">&nbsp;'.GajiHelpers::rabsen($row->id_u,$start,$end)['hkerja'].' Hari</td>
		</tr>
		<tr>
			<td class="left top right">&nbsp;Lembur</td>
			<td class="top right">&nbsp;'.$lembur.' Hari</td>
		</tr>';
		if ($row->wkerja==1){
			echo '<tr>
				<td class="left top right">&nbsp;Shift 1</td>
				<td class="top right">&nbsp;'.GajiHelpers::rabsen($row->id_u,$start,$end)['shift1'].' Hari</td>
			</tr>
			<tr>
				<td class="left top right">&nbsp;Shift 2</td>
				<td class="top right">&nbsp;'.GajiHelpers::rabsen($row->id_u,$start,$end)['shift2'].' Hari</td>
			</tr>
			<tr>
				<td class="left top right">&nbsp;Shift 3</td>
				<td class="top right">&nbsp;'.GajiHelpers::rabsen($row->id_u,$start,$end)['shift3'].' Hari</td>
			</tr>';
		}
		echo '<tr><td class="top" colspan="2"></td></tr></table>';

				//echo '<div style="page-break-after: always;"></div>';

			$cell9=0;
			$tslm='00:00';
			$tslp='00:00';

	}
}
?>
&nbsp;<br />



@stop
