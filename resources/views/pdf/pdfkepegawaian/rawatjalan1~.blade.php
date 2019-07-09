@extends('pdf.mpdf')
@section('content')
<style type="text/css">
	body {
	/*	width: 500px;
		margin: 40px auto;
		color: #444;*/
		font-family: :"Arial", Helvetica, sans-serif !important;
		font-size: 14px;

	}

	table {
    *border-collapse: collapse; /* IE7 and lower */
    border-spacing: 0;
    width: 100%;
	}

	.bordered {
    border: solid #ccc 1px;
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    border-radius: 6px;
    -webkit-box-shadow: 0 1px 1px #ccc;
    -moz-box-shadow: 0 1px 1px #ccc;
    box-shadow: 0 1px 1px #ccc;
	}
	.bordered tr:hover {
    background: #fbf8e9;
    -o-transition: all 0.1s ease-in-out;
    -webkit-transition: all 0.1s ease-in-out;
    -moz-transition: all 0.1s ease-in-out;
    -ms-transition: all 0.1s ease-in-out;
    transition: all 0.1s ease-in-out;
	}

	.bordered td, .bordered th {
    border-left: 1px solid #ccc;
    border-top: 1px solid #ccc;
    padding: 10px;
    text-align: left;
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

<div style="font-family:'Arial', Helvetica, sans-serif ; font-size:12px;">
	<center>
		<h3>PENGAJUAN PEMBIAYAAN RAWAT JALAN
			<br />KARYAWAN PT. PELABUHAN CILEGON MANDIRI
			<br /><font size="-1">Priode : {{ $start }} s.d. {{ $end }}</font>
		</h3>
	</center>
	<br /><br />

<?php
	$newArray = array();
	$i=0;
	foreach ($query as $row) {
		// $newArray['andi'][$i]['id'] = 1;
		$newArray[$row->id_u]['karyawan'] = $row->karyawan;
    $newArray[$row->id_u][$i]['id'] = $row->urut;
		$newArray[$row->id_u][$i]['id_u'] = $row->id_u;
    $newArray[$row->id_u][$i]['no'] = $row->no;
		$newArray[$row->id_u][$i]['pasien'] = $row->pasien;
		$newArray[$row->id_u][$i]['debit'] = $row->debit;
		$newArray[$row->id_u][$i]['tgldoc'] = $row->tgldoc;
		$newArray[$row->id_u][$i]['platform'] = $row->platform;
		$newArray[$row->id_u][$i]['rekbank'] = $row->rekbank;
		$i++;
		// print_r($row->urut);
	}
	// dd($newArray);
	echo '<table>
	  <tr>
	    <th class="left top right">Nama Karyawan</th>
	    <th class="top right">No Dok</th>
        <th class="top right">Nama Pasien</th>
        <th class="top right">Nilai Kwitansi</th>
        <th class="top right">Jumlah Dibayar</th>
        <th class="top right">No Rekening</th>
	  </tr>
	';
	$total2=0;
	$no = 0;
	if (count($newArray) > 0) {
		dd($newArray);
		foreach($newArray as $key => $val) {
			$i=0;
			$total = 0;
			//
			echo '<tr  bgcolor="';
				if($no%2==0) echo"#f9f9f9"/*warna genap*/;else echo"#DCDCDC";/*warna ganjil*/
			echo '">';
			echo '<td class="left top right">'.$key.'</td>';
			echo '<td class="top right">'.$key.'</td>';
			echo '<td class="top right">'.$i.'</td>';
			echo '<td class="top right">'.$key.'</td>';
			echo '<td class="top right">'.$key.'</td>';
			echo '<td class="top right">'.$key.'</td>';
			// echo '<td class="left top right" rowspan="'.count($val).'">'.$key.'</td>';
			//
			// foreach($val as $key) {
			// 	$total = $key['debit'] + $total;
			// }
			// foreach($val as $key) {
			// 	if ($i != 0){
			// 		echo '<tr  bgcolor="';
			// 			if($no%2==0) echo"#f9f9f9"/*warna genap*/;else echo"#DCDCDC";/*warna ganjil*/
			// 		echo '">';
			// 	}
			// 	$str=explode('/', $key['no']);
			// 	echo '
			// 		<td class="top right">'.$str[1].'/'.$str[0].'</td>
			// 		<td class="top right">'.$key['pasien'].'</td>
			// 		<td class="top right number"><span style=" position:absolute;">Rp.</span>'.number_format($key['debit']).'</td>
			// 		';
			// 	if ($i == 0){
			// 		echo '<td class="top right number" rowspan="'.count($val).'"><span style=" position:absolute;">Rp.</span>'.number_format($total).'</td>';
			// 		echo '<td class="top right" rowspan="'.count($val).'">'.$key['rekbank'].'</td>';
			// 	}
				echo '</tr>';
				$i++;

			// }
			// $total2 = $total + $total2; $no++;
		}
	}
	echo '<tr>
					<th class="left top right button" colspan="4"><b>TOTAL</b></th>
					<th class="top right button number"><b><span style=" position:absolute;">Rp.</span>'.number_format($total2).'</b></th>
								<th class="top right button">&nbsp;</th>
				</tr>
			';
	echo '</table>';?>
	<br />&nbsp;&nbsp;<br />
@stop
