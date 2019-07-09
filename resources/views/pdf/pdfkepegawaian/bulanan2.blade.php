@extends('pdf.mpdf')
@section('content')
      <style type="text/css">
body {
/*  width: 500px;
  margin: 40px auto;
  color: #444;*/
  font-family: :"Arial", Helvetica, sans-serif !important;
  font-size: 11px;

}

table {
    *border-collapse: collapse; /* IE7 and lower */
    border-spacing: 0;
    width: 100%;
  font-family: :"Arial", Helvetica, sans-serif !important;
  font-size: 10px;
  margin-left:20px;
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
  PT. Pelabuhan Cilegon Mandiri<br />
    SubDiv SDM & Hukum<br /><br />

Rekapitulasi Rawat Jalan<br />
<font size="-1">&nbsp;&nbsp;&nbsp;&nbsp;Priode : {{ $start }} s.d. {{ $end }}</font>
<br /><br />
<?php
  $newArray = array();
  $i=0;
  foreach ($query  as $row) {
      $newArray[$row['karyawan']][$i]['no'] = $row['no'];
    $newArray[$row['karyawan']][$i]['pasien'] = $row['pasien'];
    $newArray[$row['karyawan']][$i]['debit'] = $row['debit'];
    $newArray[$row['karyawan']][$i]['hub'] = $row['hub'];
    $newArray[$row['karyawan']][$i]['tgldoc'] = $row['tgldoc'];
    $newArray[$row['karyawan']][$i]['uraian'] = $row['uraian'];
    $i++;
  }

  echo '<table>
         <tr>
          <th colspan="3" class="left top right">Nama Karyawan</th>
          <th colspan="2" class="top right">Pasien</th>
                <th colspan="2" class="top right">Nilai Pembayaran</th>
                <th rowspan="2" class="top right" >Diagnosa</th>
        </tr>
        <tr>
          <th class="left top right">Nama Karyawan</th>
        <th class="top right">Tanggal</th>
          <th class="top right" width="35px">No</th>
                <th class="top right" width="60px">Hub</th>
                <th class="top right">Pasien</th>
                <th class="top right" width="80px">Kwitansi</th>
                <th class="top right" width="80px">Dibayarkan</th>
        </tr>
      ';
  $total2 = $no = 0;
  if (count($newArray) > 0) {
    foreach($newArray as $key => $val) {
      $i = $total = 0;

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
          <td class="top right" align="center">'.date('d M Y', $key['tgldoc']).'</td>
          <td class="top right">'.$str[1].'/'.$str[0].'</td>
          <td class="top right" align="center">'.$key['hub'].'</td>
          <td class="top right">'.$key['pasien'].'</td>

          <td class="top right number"><span style=" position:absolute;">Rp.</span>'.number_format($key['debit']).'</td>
          ';
        if ($i == 0){
          echo '<td class="top right number" rowspan="'.count($val).'"><span style=" position:absolute;">Rp.</span>'.number_format($total).'</td>';
        }
        echo '<td class="top right" align="center">'.$key['uraian'].'</td>';
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

?>
<br />
&nbsp;<br />


<table width="200px" border="0" align="right">
  <tr>
    <td align="center" valign="top">Dibuat Oleh <br />
Staf SDM dan Hukum<br />
<br />
<br />
<br />
<br />
Muhammad Yusuf</td>
  </tr>
</table>

@stop
