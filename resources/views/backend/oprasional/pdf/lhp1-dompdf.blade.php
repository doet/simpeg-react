<html>
    <head>
        <style>
            /** Define the margins of your page **/
            @page { margin: 100px 30px 80px 30px }
            header { position: fixed; top: -60px; left:0px; right: 10px;  }

            /* main { position: fixed; top: 50px; left: 0px; bottom: -10px; right: 0px;  } */

            footer { position: fixed; left: 10px; bottom: -15px; right: 0px;}
            footer .page:after { content: counter(page, normal); }

            header {
                /* position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                height: 50px; */

                /** Extra personal styles **/
                /* background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 35px; */
            }

            footer {
                /* position: fixed;
                bottom: -60px;
                left: 0px;
                right: 0px;
                height: 50px; */

                /** Extra personal styles **/
                /* background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 35px; */
            }
            /* #footer .page:after { content: counter(page, normal); } */

            thead {
              text-align: center;
              vertical-align: middle;
            }

            table {
                border-collapse: collapse;
              /* border: 1px dotted; */

              border-spacing: 0;
              margin-top:10px;
              width: 100%;
              margin-bottom:10px;
              max-height:50px;
              height:40px ;
              font-family :"Arial", Helvetica, sans-serif !important;
              font-size: 9px;
            }
            .right{
                border-right: 1px dotted;
            }
            .left{
              border-left: 1px dotted;
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
            .kuning {
                 background-color: #FFFF00;
                 /* color: #FFFFFF; */
            }
            .ungu {
                 background-color: #800080;
                 color: #FFFFFF;
            }
        </style>
    </head>
    <body style="font-family:'Arial', Helvetica, sans-serif ; font-size:12px;">
        <!-- Define header and footer blocks before your content -->
        <header>
          <img src="{{public_path().'\\pic\\logo.png'}}" width="125px"><div style="position:absolute; top:10; left:100"><b>PT. PELABUHAN CILEGON MANDIRI<br />
        Divisi Pemanduan dan Penundaan</b></div>
            <!-- <center>sssssssssssss<br />
          <font size="-1"><?php echo $mulai;?></font></center> -->
        </header>

        <footer>

          <p class="page">Halaman </p>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <div style="page-break-after: avoid;">
              <table width="350px">
                <thead>
                  <tr>
                    <td class="top right left" rowspan="2" colspan="17">FORMULIR</td>
                    <td class="top right" colspan="4">Doc No </td>
                    <td class="top right" colspan="3">F.PDP/01.004</td>
                  </tr>
                  <tr>
                    <td class="top right" colspan="4">Rev</td>
                    <td class="top right" colspan="3">0.0</td>
                  </tr>
                  <tr>
                    <td class="top right left" rowspan="2" colspan="17">LEMBAR HASIL PEKERJAAN</td>
                    <td class="top right" colspan="4">Tgl Efektif</td>
                    <td class="top right" colspan="3"><?php echo date("d/m/Y",$mulai);?></td>
                  </tr>
                  <tr>
                    <td class="top right" colspan="4">Halaman</td>
                    <td class="top right" colspan="3">1 dari 1</td>
                  </tr>
                  <tr>
                    <td class="top" colspan="24" ></td>
                  </tr>
                  <tr>
                    <td class="top right left" rowspan="2" width='20px'>No</td>
                    <td class="top right" rowspan="2" width='40px'>Nomor </br> PPJK</td>
                    <td class="top right" rowspan="2" width='30px'>Agen </br> (Code)</td>
                    <td class="top right button" colspan="2">Waktu Permintaan</td>
                    <td class="top right" rowspan="2" width='180px'>Nama Kapal</td>
                    <td class="top right" rowspan="2" width='35px'>GRT</td>
                    <td class="top right" rowspan="2" width='30px'>LOA </br> (Meter)</td>
                    <td class="top right" rowspan="2" width='80px'>Bendera</td>
                    <td class="top right" rowspan="2" width='110px'>Dermaga</td>
                    <td class="top right" rowspan="2" width='40px'>OPS </br> Kapal</td>
                    <td class="top right" rowspan="2" width='30px'>BAPP</td>
                    <td class="top right" rowspan="2" width='25px'>PC</td>
                    <td class="top right button" colspan="2">Pilot</td>
                    <td class="top right button" colspan="5">Kapal Tunda</td>
                    <td class="top right button" colspan="2">Waktu</td>
                    <td class="top right" rowspan="2" width='25px'>DD</td>
                    <td class="top right" rowspan="2">Ket</td>
                  </tr>
                  <tr>
                    <td class="right" width='55px'>tgl</td>
                    <td class="right" width='30px'>jam</td>

                    <td class="right" width='30px'>ON</td>
                    <td class="right" width='30px'>OFF</td>

                    <td class="right" width='20px'>GB</td>
                    <td class="right" width='20px'>GC</td>
                    <td class="right" width='20px'>GS</td>
                    <td class="right" width='20px'>MV</td>
                    <td class="right" width='20px'>MG</td>

                    <td class="right" width='30px'>ON</td>
                    <td class="right" width='30px'>OFF</td>
                  </tr>
                  <tr>
                    <td class="top" colspan="24" ></td>
                  </tr>
                </thead>
                <tbody class="zebra">
                  </tr>
                  <?php
                  $i=1;
                  $jppjk=0;
                  $jbapp=array();
                  $ppjk = $datetime = $jettyName = '';
                  foreach ($result as $row ) {
                    // dd($row->ppjk);
                    $date = explode(" ", date("d-m-Y H:i",$row->date));
                    if ($ppjk == $row->ppjk){
                      if ($datetime == $row->date && $jettyName=$row->jettyName){
                        $date[1] = 'SHIFT';
                        $classShift = 'blue';
                      } else {
                        $classShift = '';
                        $datetime = $row->date;
                        $jettyName = $row->jettyName;
                      }
                    }else{
                      $ppjk = $row->ppjk;
                      $classShift = '';
                      $jppjk++;
                      $datetime = $row->date;
                      $jettyName = $row->jettyName;
                    }
                    // if ($row->bapp != '') $jbapp = ;
                    if (!in_array($row->bapp,$jbapp) && $row->bapp!='')$jbapp[]=$row->bapp;

                    if (strpos($row->jettyCode,'S.')===0) $classJetty = 'kuning'; else $classJetty = '';

                    $tunda = json_decode($row->tunda);
                    if (in_array('GB', $tunda))$gb = 'GB';else $gb = '';
                    if (in_array('GC', $tunda))$gc = 'GC';else $gc = '';
                    if (in_array('GS', $tunda))$gs = 'GS';else $gs = '';
                    if (in_array('MV', $tunda))$mv = 'MV';else $mv = '';
                    if (in_array('MG', $tunda))$mg = 'MG';else $mg = '';

                    // if ($row->kapalsLoa == '')$row->kapalsLoa =0;
                    if ($row->kapalsJenis == '') $kapal =  $row->kapalsName; else $kapal = '('.$row->kapalsJenis.') '.$row->kapalsName;

                    if ($row->tundaon == '') $tundaon=$row->tundaon; else $tundaon=date("H:i",$row->tundaon);
                    if ($row->tundaoff == '') $tundaoff=$row->tundaon; else $tundaoff=date("H:i",$row->tundaoff);

                    if ($row->pcon == '') $pcon=$row->pcon; else $pcon=date("H:i",$row->pcon);
                    if ($row->pcoff == '') $pcoff=$row->pcoff; else $pcoff=date("H:i",$row->pcoff);

                    echo '<tr>';
                    echo '<td class="top right left" align="center">&nbsp;'.$i.'</td>';
                    echo '<td class="top right" align="center">'.$ppjk.'</td>';
                    echo '<td class="top right" align="center">'.$row->agenCode.'</td>';
                    echo '<td class="top right" align="center">'.$date[0].'</td>';
                    echo '<td class="top right '.$classShift.'" align="center">'.$date[1].'</td>';
                    echo '<td class="top right">&nbsp;'.$kapal.'</td>';
                    echo '<td class="top right" align="right">'.$row->kapalsGrt.'&nbsp;</td>';
                    echo '<td class="top right" align="right">'.$row->kapalsLoa.'&nbsp;</td>';
                    echo '<td class="top right">&nbsp;'.$row->kapalsBendera.'</td>';
                    echo '<td class="top right '.$classJetty.'">&nbsp;'.'('. $row->jettyCode .')'.$row->jettyName.'</td>';
                    echo '<td class="top right">&nbsp;'.$row->ops.'</td>';
                    echo '<td class="top right" align="center">'.$row->bapp.'</td>';

                    echo '<td class="top right" align="center">'.$row->pc.'</td>';
                    echo '<td class="top right" align="center">'.$pcon.'</td>';
                    echo '<td class="top right" align="center">'.$pcoff.'</td>';

                    echo '<td class="top right" align="center">'.$gb.'</td>';
                    echo '<td class="top right" align="center">'.$gc.'</td>';
                    echo '<td class="top right" align="center">'.$gs.'</td>';
                    echo '<td class="top right" align="center">'.$mv.'</td>';
                    echo '<td class="top right" align="center">'.$mg.'</td>';

                    echo '<td class="top right" align="center">'.$tundaon.'</td>';
                    echo '<td class="top right" align="center">'.$tundaoff.'</td>';
                    echo '<td class="top right" align="center">'.$row->dd.'</td>';
                    echo '<td class="top right">&nbsp;'.$row->ket.'</td>';
                    echo '</tr>';
                    $i++;
                  }
                  ?>
                  <tr>
                    <td class="top" colspan="24" ></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <table width="350px">
              <tr>
                <td class="">Keterangan : </td>
                <td class=""> </td>
                <td class=""> </td>
                <td class=""> </td>
                <td class=""> </td>
                <td class=""> </td>
              </tr>
              <tr>
                <td class="" width="100px">1. Jumlah PPJK </td>
                <td class="top right left" width="80px" align="center"> <?php echo $jppjk?></td>
                <td class="" width="20px"> </td>
                <td class="" width="100px">Jumlah BAPP </td>
                <td class="top right left" width="80px" align="center"> <?php echo count($jbapp)?></td>
                <td class=""> </td>
              </tr>
              <tr>
                <td class=""> </td>
                <td class="top"> </td>
                <td class=""> </td>
                <td class=""> </td>
                <td class="top"> </td>
                <td class=""> </td>
              </tr>
              <tr>
                <td class="" colspan="6">2. Diisi oleh Dispatcher setelah pelayanan (sesuai PPJK) dilakukan, diserahkan ke Spv.Opr, PDP </td>
              </tr>
            </table>

            <table width="350px">
              <tr>
                <td class=""> </td>
                <td class=""> </td>
                <td class=""> </td>
                <td class=""> </td>
                <td class="" rowspan="4" align="center">Dibuat Oleh,<br /><br /><br /><br /><br />Dispatcher Jaga</td>
                <td class=""> </td>
                <td class="" rowspan="4" align="center"><br /><br /><br /><br /><br />Spv. Oprasional PDP</td>
              </tr>
              <tr>
                <td class=""> </td>
                <td class="">Tanggal</td>
                <td class="top right left" align="center"><?php echo date("d/m/Y",$mulai);?></td>
                <td class=""> </td>
                <td class=""> </td>
              </tr>
              <tr>
                <td class=""> </td>
                <td class=""> </td>
                <td class="top"> </td>
                <td class=""> </td>
                <td class=""> </td>
              </tr>
              <tr>
                <td class=""> </td>
                <td class=""> </td>
                <td class=""> </td>
                <td class=""> </td>
                <td class=""> </td>
              </tr>
            </table>
            <!-- <p style="page-break-after: never;">
                Content Page 2
            </p> -->
        </main>
    </body>
</html>
