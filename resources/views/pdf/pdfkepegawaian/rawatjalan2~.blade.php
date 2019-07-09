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
.dash-left{
	border-left: 1px dashed;
}
.dash-right{
  border-right: 1px dashed;
}
.dash-top{
  border-top: 1px dashed;
}
.dash-button{
  border-bottom: 1px dashed;
}
/*
	.tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;width: 100%; }
	.tg td{font-family:Arial;font-size:12px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#000;color:#333;background-color:#fff;}
	.tg th{font-family:Arial;font-size:12px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#000;color:#000;background-color:#f0f0f0;}
	.tg .tg-3wr7{font-weight:bold;font-size:12px;font-family:"Arial", Helvetica, sans-serif !important;;text-align:center}
	.tg .tg-ti5e{font-size:10px;font-family:"Arial", Helvetica, sans-serif !important; text-align:center}
	.tg .tg-rv4w{font-size:10px;font-family:"Arial", Helvetica, sans-serif !important;}
			*/
	.number {
		text-align:right
	}
	div.absolute {
    position: absolute;
    top: 10px;
	left: 130px;
}
</style>
<?php
		$jumlah = 0;
          foreach ($query  as $row) {
			$jumlah = $row->debit + $jumlah;
		}
?>
<table width="100px" align="right">
  <tr>
    <td class="left top button right" bgcolor="#DCDCDC"><font size="15"><b> P/17/   </b></font></td>
  </tr>
</table>
<img src="{{public_path().'\\pic\\logo.png'}}" width="125px">
<div class="absolute">
  <b>PT. PELABUHAN CILEGON MANDIRI<br />Divisi Keuangan</b>
</div>
<center>
  <h3>FORM PENGAJUAN BIAYA RAWAT JALAN</h3>
</center>
<table >
  <tr>
    <td width="25px" align="center">&nbsp;</td>
    <td width="70px" class="">Divisi</td>
    <td width="230px" class="" colspan="4">: SDM &amp; Umum</td>
    <td width="300px" class="" colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td width="25px" align="center">A</td>
    <td width="300px" class="left top right" colspan="5">No Anggaran : </td>
    <td width="300px" class="top right" colspan="5">Nama Anggaran : </td>
  </tr>
  <tr>
    <td width="25px" align="center"></td>
    <td width="300px" class="left top right" colspan="5">Nama Biaya : </td>
    <td width="300px" class="top right" colspan="5">Rp. {{number_format($jumlah)}}</td>
  </tr>
  <tr>
    <td width="25px" align="center">&nbsp;</td>
    <td width="300px" class="left right" colspan="5"><i>Priode {{ $start }} s.d. {{ $end }}</i></td>
    <td width="300px" class="right" colspan="5"># {{Terbilang($jumlah)}}</td>
  </tr>
  <tr>
    <td width="25px" align="center">&nbsp;</td>
    <td width="600px" class="left top right" colspan="10">Dokument yang dilampirkan :</td>
  </tr>
  <tr>
    <td width="25px" align="center">&nbsp;</td>
    <td width="100px" class="left" colspan="2"><img src="{{url('pic/nonchkbox.png')}}" alt="" width="15px" />1. Perjanjian Kerja</td>
    <td width="200px" class="" colspan="3">No; </td>
    <td width="100px" class="" colspan="2"><img src="{{url('pic/nonchkbox.png')}}" alt="" width="15px" />7. Invoice </td>
    <td width="200px" class="right" colspan="3">No;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left" colspan="2"><img src="{{url('pic/nonchkbox.png')}}" alt="" width="15px" />2. SPK</td>
    <td class="" colspan="3">No;</td>
    <td class="" colspan="2"><img src="{{url('pic/nonchkbox.png')}}" alt="" width="15px" />8.Kwitansi</td>
    <td class="right" colspan="3">No;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left" colspan="2"><img src="{{url('pic/nonchkbox.png')}}" alt="" width="15px" />3. BAST Pekerjaan</td>
    <td class="" colspan="3">No;</td>
    <td class="" colspan="2"><img src="{{url('pic/nonchkbox.png')}}" alt="" width="15px" />9. Faktur Pajak</td>
    <td class="right" colspan="3">No;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left" colspan="2"><img src="{{url('pic/nonchkbox.png')}}" alt="" width="15px" />4. SK Direktur</td>
    <td class="" colspan="3">No;</td>
    <td class="" colspan="2"><img src="{{url('pic/nonchkbox.png')}}" alt="" width="15px" />10. Lainnya:</td>
    <td class="right" colspan="3">No;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left" colspan="2"><img src="{{url('pic/nonchkbox.png')}}" alt="" width="15px" />5. Internal Memo</td>
    <td class="" colspan="3">No;</td>
    <td class="" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a.</td>
    <td class="right" colspan="3">No;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left" colspan="2"><img src="{{url('pic/nonchkbox.png')}}" alt="" width="15px" />6. Lembar Disposisi</td>
    <td class="" colspan="3">No;</td>
    <td class="" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b.</td>
    <td class="right" colspan="3">No;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left" colspan="5">&nbsp;</td>
    <td class="" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.</td>
    <td class="right" colspan="3">No;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left right" colspan="10">Catatan :</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left right" colspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left" colspan="5">&nbsp;</td>
    <td class="" colspan="2" align="right">Dibayar Secara : <img src="{{url('pic/nonchkbox.png')}}" width="15px"></td>
    <td class="right" colspan="3">TUNAI</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left" colspan="5">&nbsp;</td>
    <td class="" colspan="2" align="right"><img src="{{url('pic/chkbox.png')}}" width="15px"></td>
    <td class="right" colspan="3">TRANSFER</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left" colspan="5">&nbsp;</td>
    <td class="" colspan="2" align="right">No Rek : </td>
    <td class="right" colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left top right" colspan="10" bgcolor="#DCDCDC">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left" colspan="5" bgcolor="#DCDCDC"><i>Tgl & Yang Mengajukan : .................................</i></td>
    <td class="right" colspan="5" bgcolor="#DCDCDC"><i>Diketahui : .................................</i></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left top right" colspan="10">Perhitungan Divisi Keuangan <font size="8pt"><i>(utk pengeluaran yang memerlukan data bagian keuangan);</i></font></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left">Lampiran</td>
    <td class="right" colspan="9"><img src="{{url('pic/nonchkbox.png')}}" width="15px" /> ..................................................................</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left">&nbsp;</td>
    <td class="right" colspan="9"><img src="{{url('pic/nonchkbox.png')}}" width="15px" /> ..................................................................</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left" colspan="7">&nbsp;</td>
    <td class="right" colspan="3"><i>Dibuat Oleh : .................................</i></td>
  </tr>
  <tr>
    <td align="center">B</td>
    <td colspan="3" class="left top">Melebihi Pagu Anggaran, terlampir</td>
    <td class="top right" colspan="7"><img src="{{url('pic/nonchkbox.png')}}" alt="" width="15px" /> Form Tambahan Anggaran</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td colspan="3" class="left">&nbsp;</td>
    <td class="right" colspan="7"><img src="{{url('pic/nonchkbox.png')}}" alt="" width="15px" /> Form Subtitusi Anggaran</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left" colspan="7">&nbsp;</td>
    <td class="right" colspan="3"><i>Dibuat Oleh : .................................</i></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td  class="left right top" colspan="10">
      <table>
        <tr>
          <td width="100px">Dipotong Pajak :</td>
          <td><img src="{{url('pic/nonchkbox.png')}}" alt="" width="15px" /> PPh 21;tarif………..%</td>
          <td><img src="{{url('pic/nonchkbox.png')}}" alt="" width="15px" /> PPh 23;tarif………..%</td>
          <td><img src="{{url('pic/nonchkbox.png')}}" alt="" width="15px" /> lain;Pajak………..;tarif………..%</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td align="center"></td>
    <td class="left top right" colspan="10" ></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left" colspan="4"><font size="10pt"><strong> BIAYA YANG HARUS DIBAYAR : </strong></font></td>
    <td class="right" colspan="6" ><font size="12pt"><strong> Rp. {{number_format($jumlah)}}</strong></font></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left top" colspan="5" bgcolor="#DCDCDC">PEMERIKSA PAJAK</td>
    <td class="top right" colspan="5" bgcolor="#DCDCDC">Tgl & Paraf Pemeriksa</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left top" colspan="4" >Diperiksa ;</td>
    <td class="top" colspan="3">Diketahui ;</td>
    <td class="top right" colspan="3">Disetujui ;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="10" class="left right" >&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="10" class="left right" >&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left" colspan="4">Supervisor Verifikasi &amp; Perpajakan</td>
    <td class="" colspan="3">Manager Keuangan</td>
    <td class="right" colspan="3">Direktur Keuangan & SDM</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="top" colspan="10" align="center"><font size="6pt"><i>A:Diisi oleh yang mengajukan Biaya, B : Pemeriksa Kelengkapan Dokumen&amp;Anggaran, C : Diisi Pemeriksa Pajak</i></font></td>
  </tr>
  <tr>
    <td align="center" height="3px"></td>
    <td colspan="10" class="dash-button"></td>
  </tr>
  <tr>
    <td align="center"></td>
    <td colspan="10" align="center" height="3px"></td>
  </tr>
  <tr>
    <td align="center">C.a</td>
    <td colspan="10" bgcolor="#DCDCDC" class="left top right"><font size="8pt">Keterangan pemotongan / Pemungutan Pajak</font></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td colspan="10" class="left top right">a. Katagori Pajak / Nama Jenis Pajak :……………………………………………………………………………………</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left" width="80">b. Wajib Pajak</td>
    <td class="" colspan="2" width="15"><img src="{{url('pic/nonchkbox.png')}}" width="15px"> OP</td>
    <td class="" colspan="3">Nama : </td>
    <td class="right" colspan="4">Alamat : </td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left">&nbsp;</td>
    <td class="" colspan="2"><img src="{{url('pic/nonchkbox.png')}}" width="15px"> Badan Usaha</td>
    <td class="" colspan="3">Nama : </td>
    <td class="right" colspan="4">Alamat : </td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left" width="30">c. Nomor NPWP &nbsp;&nbsp; :</td>
    <td class="left top button right" colspan="8">&nbsp;</td>
    <td class="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left" colspan="3">d. PPh dipotong/dipungut :</td>
    <td class="right" colspan="7" rowspan="5">
      <table width="400px">
        <tr>
          <td class="dash-left dash-top dash-right">PERHITUNGAN VAT;</td>
        </tr>
        <tr>
          <td class="dash-left dash-top dash-right">DPP(USD)&nbsp;&nbsp;&nbsp;&nbsp; ......X (Kusrs)......&nbsp;&nbsp;&nbsp;&nbsp; DPP &nbsp;&nbsp;&nbsp;&nbsp;= Rp.</td>
        </tr>
        <tr>
          <td class="dash-left dash-right">PPn(USD)&nbsp;&nbsp;&nbsp;&nbsp; ......X (Kusrs)......&nbsp;&nbsp;&nbsp;&nbsp; (+)PPn&nbsp;&nbsp;= Rp.</td>
        </tr>
        <tr>
          <td class="dash-left dash-button dash-right">PPh(USD)&nbsp;&nbsp;&nbsp;&nbsp; ......X (Kusrs)......&nbsp;&nbsp;&nbsp;&nbsp; (-)PPh&nbsp;&nbsp;&nbsp;= Rp.</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{url('pic/nonchkbox.png')}}" width="15px"> PPh 21, Tarif &nbsp;&nbsp; =………%</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{url('pic/nonchkbox.png')}}" width="15px"> PPh 23, Tarif &nbsp;&nbsp; =………%</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{url('pic/nonchkbox.png')}}" width="15px"> PPh 15, Tarif &nbsp;&nbsp; =………%</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="left" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{url('pic/nonchkbox.png')}}" width="15px">&nbsp;<font size="7pt">Psl 4 ayat 2</font>, Tarif =…..….%</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td class="button left right" colspan="10">&nbsp;&nbsp;&nbsp;&nbsp;<font size="6pt"><i>VAT=Value Tax/biaya yang harus dibayar setelah pajak</i></font></td>
  </tr>
</table>

<?php
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
