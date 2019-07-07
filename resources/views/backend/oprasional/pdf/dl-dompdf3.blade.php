@extends('backend.oprasional.pdf.mpdf')

@section('content')
<style type="text/css">
 @page { margin: 100px 20px 20px 20px }
  #header { position: fixed; top: -70px; left:0px; right: 10px; height: 80px; }
  #conten { position: fixed; top: 50px; left: 0px; bottom: -10px; right: 0px;  }
  #footer { position: fixed; left: 10px; bottom: -10px; right: 0px; height: 40px; }
  #footer .page:after { content: counter(page, normal); }

  /* @media print {
      tr.page-break  { display: block; page-break-before: always; }
  } */
  div.breakNow { page-break-inside:avoid; page-break-after:always; }

  table {
      border-collapse: collapse;
    border: 1px dotted;

    border-spacing: 0;
  	margin-top:10px;
    width: 100%;
  	margin-bottom:10px;
  	max-height:50px;
  	height:40px ;
  	font-family :"Arial", Helvetica, sans-serif !important;
  	font-size: 9px;
  }

  thead {
    text-align: center;
    vertical-align: middle;
  }

  /* .left{
      border-left: 1px solid;
  }*/
  .right{
      border-right: 1px dotted;
  }
  .top{
      border-top: 1px dotted;
  }
  .button{
  	border-bottom: 1px dotted;
  }

  .zebra tr:nth-child(even) {
       background-color: #f9f9f9;
  }
  .zebra tr:nth-child(odd) {
       background-color: #DCDCDC;
  }
  .blue {
       background-color: #5373D1;
       color: #FFFFFF;
  }

</style>

<div id="header">
	<img src="{{public_path().'\\pic\\logo.png'}}" width="125px"><div style="position:absolute; top:10; left:100"><b>PT. PELABUHAN CILEGON MANDIRI<br />
Divisi Pemanduan dan Penundaan</b></div><br /><br /><br />
    <center>Laporan Harian<br />
	<font size="-1"><?php echo $mulai;?></font></center>
</div>
<div class="breakNow"></div>
<!-- <div style="page-break-after:always;"></div> -->
  <div id="footer">
    <p class="page">Halaman </p>
  </div>
<div id="conten">

  <table width="350px" class="print-friendly">
    <thead>
      <tr>
        <td class="right" rowspan="2" width='20px'>No</td>
        <td class="right" rowspan="2" width='30px'>Nomor </br> PPJK</td>
        <td class="right" rowspan="2" width='30px'>Agen </br> (Code)</td>
        <td class="right button" colspan="2">Waktu Permintaan</td>
        <td class="right" rowspan="2" width='200px'>Nama Kapal</td>
        <td class="right" rowspan="2" width='35px'>GRT</td>
        <td class="right" rowspan="2" width='30px'>LOA </br> (Meter)</td>
        <td class="right" rowspan="2" width='80px'>Bendera</td>
        <td class="right" rowspan="2" width='110px'>Dermaga</td>
        <td class="right" rowspan="2" width='40px'>OPS </br> Kapal</td>
        <td class="right" rowspan="2" width='30px'>BAPP</td>
        <td class="right" rowspan="2" width='25px'>PC</td>
        <td class="right button" colspan="5">Kapal Tunda</td>
        <td class="right button" colspan="2">Waktu</td>
        <td class="right" rowspan="2" width='35px'>DD</td>
        <td class="right" rowspan="2">Ket</td>
        <td class="" rowspan="2" width='20px'>Kurs</td>
      </tr>
      <tr>
        <td class="right" width='55px'>tgl</td>
        <td class="right" width='30px'>jam</td>

        <td class="right" width='20px'>GB</td>
        <td class="right" width='20px'>GC</td>
        <td class="right" width='20px'>GS</td>
        <td class="right" width='20px'>MV</td>
        <td class="right" width='20px'>MG</td>

        <td class="right" width='30px'>ON</td>
        <td class="right" width='30px'>OFF</td>
      </tr>
      <tr>
        <td class="top" colspan="23" ></td>
      </tr>
    </thead>
    <tbody class="zebra">
      </tr>
      <?php
      $i=1;
      $ppjk = '';
      foreach ($result as $row ) {
        $date = explode(" ", date("d-m-Y H:i",$row->date));
        if ($ppjk != $row->ppjk){
          $ppjk = $row->ppjk;
          $classShift = '';
        }else{
          $date[1] = 'SHIFT';
          $classShift = 'blue';
        }

        $tunda = json_decode($row->tunda);
        if (in_array('GB', $tunda))$gb = 'GB';else $gb = '';
        if (in_array('GC', $tunda))$gc = 'GC';else $gc = '';
        if (in_array('GS', $tunda))$gs = 'GS';else $gs = '';
        if (in_array('MV', $tunda))$mv = 'MV';else $mv = '';
        if (in_array('MG', $tunda))$mg = 'MG';else $mg = '';

        if ($i==10)$cssBreak = '';else $cssBreak = '';
        echo '<tr class="'.$cssBreak.'">';
        echo '<td class="top right">&nbsp;'.$i.'</td>';
        echo '<td class="top right" align="center">'.$ppjk.'</td>';
        echo '<td class="top right" align="center">'.$row->agenCode.'</td>';
        echo '<td class="top right" align="center">'.$date[0].'</td>';
        echo '<td class="top right '.$classShift.'" align="center">'.$date[1].'</td>';
        echo '<td class="top right">&nbsp;'.'('.$row->kapalsJenis.') '.$row->kapalsName.'</td>';
        echo '<td class="top right">&nbsp;'.$row->kapalsGrt.'</td>';
        echo '<td class="top right">&nbsp;'.$row->kapalsLoa.'</td>';
        echo '<td class="top right">&nbsp;'.$row->kapalsBendera.'</td>';
        echo '<td class="top right">&nbsp;'.'('. $row->jettyCode .')'.$row->jettyName.'</td>';
        echo '<td class="top right">&nbsp;'.$row->ops.'</td>';
        echo '<td class="top right" align="center">'.$row->bapp.'</td>';
        echo '<td class="top right" align="center">'.$row->pc.'</td>';

        echo '<td class="top right"  align="center">'.$gb.'</td>';
        echo '<td class="top right"  align="center">'.$gc.'</td>';
        echo '<td class="top right"  align="center">'.$gs.'</td>';
        echo '<td class="top right"  align="center"'.$mv.'</td>';
        echo '<td class="top right"  align="center"'.$mg.'</td>';

        echo '<td class="top right" align="center">'.date("H:i",$row->on).'</td>';
        echo '<td class="top right" align="center">'.date("H:i",$row->off).'</td>';
        echo '<td class="top right">&nbsp;'.$row->dd.'</td>';
        echo '<td class="top right">&nbsp;'.$row->ket.'</td>';
        echo '<td class="top right" align="center">'.$row->kurs.'</td>';
        echo '</tr>';

        $i++;
      }
      ?>
    </tbody>
  </table>

</div>
@endsection
