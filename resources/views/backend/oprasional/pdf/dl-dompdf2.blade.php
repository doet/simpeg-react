@extends('backend.oprasional.pdf.mpdf')

@section('content')
<style type="text/css">
 @page { margin: 100px 20px 20px 20px }
  /*  #header { position: fixed; top: -90px; left:-10px; right: -10px; height: 80px; }
  #footer { position: fixed; left: -10px; bottom: -30px; right: -10px; height: 40px; }
  #footer .page:after { content: counter(page, normal); } */

  table {
      /* border-collapse: collapse; */
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
/*
  .number {
  	text-align:right
  } */

</style>

<div id="header">
	<img src="{{public_path().'\\pic\\logo.png'}}" width="125px"><div style="position:absolute; top:10; left:100"><b>PT. PELABUHAN CILEGON MANDIRI<br />
Operasional</b></div>
    <center>Laporan Harian<br />
	<font size="-1">Priode : </font></center>
</div>


  <div id="footer">
    <p class="page">Page </p>
  </div>

<table width="350px">
  <thead>
    <tr>
      <td class="right" rowspan="2" width='20px'>No</td>
      <td class="right" rowspan="2" width='30px'>Nomor </br> PPJK</td>
      <td class="right" rowspan="2" width='30px'>Agen </br> (Code)</td>
      <td class="right button" colspan="2">Waktu Permintaan</td>
      <td class="right" rowspan="2" width='150px'>Nama Kapal</td>
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
      <td class="right" width='30px'>tgl</td>
      <td class="right" width='55px'>jam</td>

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
    foreach ($result as $row ) {
      print_r($row->ppjk);

    }
    $i=1;
    // foreach ($result as $row ) {
    //   foreach ($row as $key=>$val ) {
    //     $tunda = json_decode($row['cell'][12]);
    //
    //     if (in_array('GB', $tunda))$gb = 'GB';else $gb = '';
    //     if (in_array('GC', $tunda))$gc = 'GC';else $gc = '';
    //     if (in_array('GS', $tunda))$gs = 'GS';else $gs = '';
    //     if (in_array('MV', $tunda))$mv = 'MV';else $mv = '';
    //     if (in_array('MG', $tunda))$mg = 'MG';else $mg = '';
    //
    //     $date = explode(" ", $row['cell'][3]);
    //
    //     if ($key == 'cell'){
    //       echo '<tr>';
    //       echo '<td class="top right">&nbsp;'.$i.'</td>';
    //       echo '<td class="top right" align="center">'.$row['cell'][1].'</td>';
    //       echo '<td class="top right" align="center">'.$row['cell'][2].'</td>';
    //       echo '<td class="top right" align="center">'.$date[1].'</td>';
    //       echo '<td class="top right" align="center">'.$date[0].'</td>';
    //       echo '<td class="top right">&nbsp;'.$row['cell'][4].'</td>';
    //       echo '<td class="top right">&nbsp;'.$row['cell'][5].'</td>';
    //       echo '<td class="top right">&nbsp;'.$row['cell'][6].'</td>';
    //       echo '<td class="top right">&nbsp;'.$row['cell'][7].'</td>';
    //       echo '<td class="top right">&nbsp;'.$row['cell'][8].'</td>';
    //       echo '<td class="top right">&nbsp;'.$row['cell'][9].'</td>';
    //       echo '<td class="top right" align="center">'.$row['cell'][10].'</td>';
    //       echo '<td class="top right" align="center">'.$row['cell'][11].'</td>';
    //
    //       echo '<td class="top right"  align="center">'.$gb.'</td>';
    //       echo '<td class="top right"  align="center">'.$gc.'</td>';
    //       echo '<td class="top right"  align="center">'.$gs.'</td>';
    //       echo '<td class="top right"  align="center"'.$mv.'</td>';
    //       echo '<td class="top right"  align="center"'.$mg.'</td>';
    //
    //       echo '<td class="top right" align="center">'.$row['cell'][13].'</td>';
    //       echo '<td class="top right" align="center">'.$row['cell'][14].'</td>';
    //       echo '<td class="top right">&nbsp;'.$row['cell'][15].'</td>';
    //       echo '<td class="top right">&nbsp;'.$row['cell'][16].'</td>';
    //       echo '<td class="top right" align="center">'.$row['cell'][17].'</td>';
    //       echo '</tr>';
    //       $i++;
    //     }
    //
    //   }
    // }
    ?>
  </tbody>
</table>
@endsection
