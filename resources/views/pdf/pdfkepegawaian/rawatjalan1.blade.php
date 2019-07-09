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
	foreach ($query  as $row) {
    $newArray[$row->karyawan][$i]['id'] = $row->urut;
		$newArray[$row->karyawan][$i]['id_u'] = $row->id_u;
    $newArray[$row->karyawan][$i]['no'] = $row->no;
		$newArray[$row->karyawan][$i]['pasien'] = $row->pasien;
		$newArray[$row->karyawan][$i]['debit'] = $row->debit;
		$newArray[$row->karyawan][$i]['tgldoc'] = $row->tgldoc;
		$newArray[$row->karyawan][$i]['platform'] = $row->platform;
		$newArray[$row->karyawan][$i]['rekbank'] = $row->rekbank;
		$i++;
	}
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
		foreach($newArray as $key => $val) {
			$i=0;
			$total = 0;

			echo '<tr  bgcolor="';
				if($no%2==0) echo"#f9f9f9"/*warna genap*/;else echo"#DCDCDC";/*warna ganjil*/
			echo '">';
			echo '<td class="left top right" rowspan="'.count($val).'">'.$key.'</td>';

			foreach($val as $key) {
				$total = $key['debit'] + $total;
			}
			foreach($val as $key) {
				if ($i != 0){
					echo '<tr  bgcolor="';
						if($no%2==0) echo"#f9f9f9"/*warna genap*/;else echo"#DCDCDC";/*warna ganjil*/
					echo '">';
				}
				$str=explode('/', $key['no']);
				echo '
					<td class="top right">'.$str[1].'/'.$str[0].'</td>
					<td class="top right">'.$key['pasien'].'</td>
					<td class="top right number"><span style=" position:absolute;">Rp.</span>'.number_format($key['debit']).'</td>
					';
				if ($i == 0){
					echo '<td class="top right number" rowspan="'.count($val).'"><span style=" position:absolute;">Rp.</span>'.number_format($total).'</td>';
					echo '<td class="top right" rowspan="'.count($val).'">'.$key['rekbank'].'</td>';
				}
				echo '</tr>';
				$i++;

			}
			$total2 = $total + $total2; $no++;
		}
	}
	echo '<tr>
					<th class="left top right button" colspan="4"><b>TOTAL</b></th>
					<th class="top right button number"><b><span style=" position:absolute;">Rp.</span>'.number_format($total2).'</b></th>
								<th class="top right button">&nbsp;</th>
				</tr>
			';
	echo '</table>';
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

Terbilang :<br />
<i>{{Terbilang($total2)}} Rupiah</i><br />
<br />

<table width="90%" border="0" align="center">
  <tr>
    <td align="center" valign="top">
			Diajukan Oleh <br />
			Staf SDM dan Hukum <br /><br /><br /><br /><br />
			( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )
		</td>
    <td align="center" valign="top">
			<br />
      Supervisor SDM &amp; Hukum<br /><br /><br /><br /><br />
			( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )
    </td>
    <td align="center" valign="top">
			<br />
      Manager SDM &amp; Hukum<br /><br /><br /><br /><br />
			( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )
		</td>
	</tr>
</table>
<span style="page-break-after:always"></span>
<!-- /////////////////////////////////////// hal 2 -->

<strong>Lampiran </strong><br />
<font size="-1">&nbsp;&nbsp;&nbsp;&nbsp;Priode : {{ $start }} s.d. {{ $end }}</font>
<br /><br />

&nbsp;&nbsp;&nbsp;&nbsp;a. Rawat Jalan

<?php
	echo '<table>
		 <tr>
			<th colspan="3" class="left top right">Nama Karyawan</th>
		<th rowspan="2" class="top right">Platform</th>
		<th rowspan="2" class="top right">Saldo<br />Sebelumnya</th>
						<th colspan="2" class="top right">Nilai Pembayaran</th>
						<th rowspan="2" class="top right">Sisa Platform</th>
		</tr>
		<tr>
			<th class="left top right">Nama Karyawan</th>
		<th class="top right">Tanggal</th>
			<th class="top right" width="40px">No</th>
						<th class="top right" width="80px">Kwitansi</th>
						<th class="top right" width="80px">Dibayarkan</th>
		</tr>
	';
	$total2=$no = 0;
	if (count($newArray) > 0) {
		foreach($newArray as $key => $val) {
			$i=0;
			$total = 0;

			echo '<tr  bgcolor="';
				if($no%2==0) echo"#f9f9f9"/*warna genap*/;else echo"#DCDCDC";/*warna ganjil*/
			echo '">';
			echo '<td class="left top right" rowspan="'.count($val).'">'.$key.'</td>';
			foreach($val as $key) {
				$total = $key['debit'] + $total;
			}
			foreach($val as $key) {
				if ($i != 0){
					echo '<tr  bgcolor="';
						if($no%2==0) echo"#f9f9f9"/*warna genap*/;else echo"#DCDCDC";/*warna ganjil*/
					echo '">';
				}
				$str=explode('/', $key['no']);
				$dana=explode('/', $key['platform']);
				if(empty($dana[1]))$dana[1]=0;
				if ($saldo[$key['id_u']]==0)$saldo[$key['id_u']]=$dana[1];

				echo '
					<td class="top right" align="center">'.date('d M Y', $key['tgldoc']).'</td>
					<td class="top right" align="center">'.$str[1].'/'.$str[0].'</td>

					<td class="top right number"><span style=" position:absolute;">Rp.</span>'.number_format(GajiHelpers::sisaRj($key['id_u'],$key['tgldoc'])['platform']).'</td>
					<td class="top right number"><span style=" position:absolute;">Rp.</span>'.number_format(GajiHelpers::sisaRj($key['id_u'],$key['tgldoc'])['total']).'</td>
					<td class="top right number"><span style=" position:absolute;">Rp.</span>'.number_format($key['debit']).'</td>
					';

				if ($i == 0){
					echo '<td class="top right number" rowspan="'.count($val).'"><span style=" position:absolute;">Rp.</span>'.number_format($total).'</td>';
				}
				if ($saldo[$key['id_u']] == $dana[1]){
					$saldo[$key['id_u']]=$dana[1]-$key['debit'];
				}else {
					$saldo[$key['id_u']] = GajiHelpers::sisaRj($key['id_u'],$key['tgldoc'])['total'] - $key['debit'];
				}
				$saldo[$key['id_u']] = GajiHelpers::sisaRj($key['id_u'],$key['tgldoc'])['total'] - $key['debit'];
				echo '<td class="top right number"><span style=" position:absolute;">Rp.</span>'.number_format($saldo[$key['id_u']]).'</td>';
				echo '</tr>';
				$i++;
			}
			$no++;

		}
	}
	echo '<tr>
					<td class="top" colspan="8"></td>

				</tr>
			';
	echo '</table>';
?><br />&nbsp;&nbsp;<br />
@stop
