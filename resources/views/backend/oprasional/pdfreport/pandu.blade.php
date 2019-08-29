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
          <font size="-1"><?php //echo $mulai;?></font></center> -->
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
                    <td class="top right left" rowspan="2" colspan="<?php echo (count($tmp['items']))-4?>">FORMULIR</td>
                    <td class="top right" colspan="3">Doc No </td>
                    <td class="top right" colspan="3">F.PDP/01.004</td>
                  </tr>
                  <tr>
                    <td class="top right" colspan="3">Rev</td>
                    <td class="top right" colspan="3">0.0</td>
                  </tr>
                  <tr>
                    <td class="top right left" rowspan="2" colspan="<?php echo (count($tmp['items']))-4?>">LAPORAN BULANAN OPERASIONAL</td>
                    <td class="top right" colspan="3">Tgl Efektif</td>
                    <td class="top right" colspan="3"><?php //echo date("d/m/Y",$mulai);?></td>
                  </tr>
                  <tr>
                    <td class="top right" colspan="3">Halaman</td>
                    <td class="top right" colspan="3">1 dari 1</td>
                  </tr>
                  <tr>
                    <td class="left top right" colspan="<?php echo (count($tmp['items']))+2?>" align="left">&nbsp; IV. Performa pandu berdasarkan gerakan</td>
                  </tr>
                  <tr>
                    <td class="top right left" width='40px' rowspan="2">No</td>
                    <td class="top right" rowspan="2">Bulan</td>
                    <td class="top right button" colspan="<?php echo count($tmp['items'])-1?>">Kode Pandu</td>
                    <td class="top right" width='25' rowspan="2">Total</td>
                  </tr>
                  <tr>
                    <?php

                      foreach ($tmp['items'] as $val) {
                      if ($val!='all'){
                        // if ($val=='unknow')$val='Tidak Diketahui';else if ($val=='Rp')$val='Dalam Negeri'; else if ($val=='$')$val='Luar Negeri';
                        echo '<td class="right" width="25">'.$val.'</td>';
                      }
                    }
                    ?>


                  </tr>
                  <tr>
                    <td class="top" colspan="<?php echo (count($tmp['items']))+2?>"></td>
                  </tr>
                </thead>
                <tbody class="zebra">
                  </tr>
                  <?php
                  foreach ($tmp['label'] as $key => $val) {
                    echo '<tr>
                    <td class="left top right" align="center">'. ($key+1) .'</td>
                    <td class="top right" align="center">'.$val.'</td>';
                    // dd($tmp['items']);
                    if ($tmp['ds'][array_search('all',$tmp['items'])]['data'][$key]!='')$jumlah[$key] = $tmp['ds'][array_search('all',$tmp['items'])]['data'][$key];else $jumlah[$key] = 0;
                    foreach ($tmp['ds'] as $row) {
                      echo '<td class="top right" align="center">'.$row['data'][$key].'</td>';
                    }
                    $total = 0;
                    echo '</tr>';
                  }
                  ?>
                  <tr>
                  <td class="top" colspan="<?php echo (count($tmp['items']))+2?>"></td>
                  </tr>
                </tbody>
              </table>
              <img src="<?php  echo $tmp['img']?>" width="100%">
            </div>
            <!-- <p style="page-break-after: never;">
                Content Page 2
            </p> -->
        </main>
    </body>
</html>
tml>
