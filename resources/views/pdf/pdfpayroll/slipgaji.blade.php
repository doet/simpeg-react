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
			<td>'. upah_helpers::RekapAbsen($row->payroll_id,'',$start,$end)['hk'] .'</td>
		</tr>
		</table>';

	echo '<table width="690px">
		<tr>
			<td width="10px">I</td>		
			<td width="10px">a.</td>
			<td width="60px">Upah Pokok</td>
			<td>'. number_format(upah_helpers::upah($row->payroll_id,'upahpokok',$start)) .'</td>
		</tr>
		<tr>
			<td></td>		
			<td>b.</td>
			<td>Tj. Prestasi</td>
			<td>0</td>
		</tr>a
		<tr>
			<td></td>		
			<td>c.</td>
			<td>Jabatan</td>
			<td>0</td>
		</tr>
		</table>';

	echo '<table width="690px">
		<tr>
			<td width="10px">II</td>		
			<td width="10px">a.</td>
			<td width="60px">Makan</td>
			<td>'. number_format(upah_helpers::slip($row->payroll_id,$start,$end)['makan']) .'</td>
		</tr>
		<tr>
			<td></td>		
			<td>b.</td>
			<td>Transport</td>
			<td>'. number_format(upah_helpers::slip($row->payroll_id,$start,$end)['transport']) .'</td>
		</tr>
		<tr>
			<td></td>		
			<td>c.</td>
			<td>THR 2015</td>
			<td> </td>
		</tr>
		<tr>
			<td></td>		
			<td>d.</td>
			<td>Shift</td>
			<td>'. number_format(upah_helpers::slip($row->payroll_id,$start,$end)['shift']) .'</td>
		</tr>
		<tr>
			<td></td>		
			<td>e.</td>
			<td>Lembur</td>
			<td>'. number_format(upah_helpers::slip($row->payroll_id,$start,$end)['lembur']) .'</td>
		</tr>
		<tr>
			<td></td>		
			<td>f.</td>
			<td>KHK</td>
			<td>'. number_format(upah_helpers::slip($row->payroll_id,$start,$end)['khk']) .'</td>
		</tr>
		<tr>
			<td></td>		
			<td>g.</td>
			<td>Lain-lain</td>
			<td>'. number_format(upah_helpers::slip($row->payroll_id,$start,$end)['lain']) .'</td>
		</tr>
		<tr>
			<td></td>		
			<td>h.</td>
			<td>Tunj. Skil</td>
			<td>'. number_format(upah_helpers::slip($row->payroll_id,$start,$end)['skill']) .'</td>
		</tr>
		<tr>
			<td></td>		
			<td>i.</td>
			<td>Fix Insentif</td>
			<td>'. number_format(upah_helpers::slip($row->payroll_id,$start,$end)['intensif']) .'</td>
		</tr>
		<tr>
			<td></td>		
			<td></td>
			<td>PENERIMAAN BRUTO</td>
			<td>'. number_format(upah_helpers::slip($row->payroll_id,$start,$end)['bruto']) .'</td>
		</tr>
		</table>';

	echo '<table width="690px">
		<tr>
			<td width="10px">III</td>		
			<td width="10px">a.</td>
			<td width="60px">Zakat, Infak, Sadaqoh</td>
			<td>'. number_format(upah_helpers::slip($row->payroll_id,$start,$end)['zis']) .'</td>
		</tr>
		<tr>
			<td></td>		
			<td>b.</td>
			<td>Pajak/PPh.Psl.21</td>
			<td>'. number_format(upah_helpers::slip($row->payroll_id,$start,$end)['pph21']) .'</td>
		</tr>		
		<tr>
			<td></td>		
			<td>c.</td>
			<td>BPJS/JHT</td>
			<td>'. number_format(upah_helpers::slip($row->payroll_id,$start,$end)['astek']) .'</td>
		</tr>
		<tr>
			<td></td>		
			<td>d.</td>
			<td>Kas Bon</td>
			<td>'. number_format(upah_helpers::slip($row->payroll_id,$start,$end)['bon']) .'</td>
		</tr>
		<tr>
			<td></td>		
			<td>e.</td>
			<td>Iuran SP-BCS</td>
			<td>'. number_format(upah_helpers::slip($row->payroll_id,$start,$end)['spbcs']) .'</td>
		</tr>
		<tr>
			<td></td>		
			<td>f.</td>
			<td>Alpa/Absen</td>
			<td>'. number_format(upah_helpers::slip($row->payroll_id,$start,$end)['absen']) .'</td>
		</tr>
		<tr>
			<td></td>		
			<td>g.</td>
			<td>Koprasi</td>
			<td>'. number_format(upah_helpers::slip($row->payroll_id,$start,$end)['koprasi']) .'</td>
		</tr>
		<tr>
			<td></td>		
			<td>h.</td>
			<td>Angsuran BPR</td>
			<td>'. number_format(upah_helpers::slip($row->payroll_id,$start,$end)['bpr']) .'</td>
		</tr>
		<tr>
			<td></td>		
			<td>i.</td>
			<td>Pinjaman Lain-lain</td>
			<td>'. number_format(upah_helpers::slip($row->payroll_id,$start,$end)['pinjaman']) .'</td>
		</tr>
		<tr>
			<td></td>		
			<td></td>
			<td>TOTAL POTONGAN</td>
			<td>'. number_format(upah_helpers::slip($row->payroll_id,$start,$end)['potongan']) .'</td>
		</tr>
		</table>';
		echo '<table width="690px">
		<tr>
			<td width="10px"> </td>		
			<td width="10px"> </td>
			<td width="60px">TOTAL PENERIMAAN</td>
			<td>'. number_format(upah_helpers::slip($row->payroll_id,$start,$end)['total']) .'</td>
		</tr>';
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