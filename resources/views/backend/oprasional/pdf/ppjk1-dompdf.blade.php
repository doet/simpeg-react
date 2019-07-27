<html>
    <head>
        <style>
            /** Define the margins of your page **/
            @page { margin: 100px 30px 80px 30px }
            header { position: fixed; top: -60px; left:0px; right: 10px;  }

            /* main { position: fixed; top: 50px; left: 0px; bottom: -10px; right: 0px;  } */

            footer { position: fixed; left: 10px; bottom: -15px; right: 0px;}
            /* footer .page:after { content: counter(page, normal); } */

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
            .hal:after { content: counter(page); }

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

        <!-- <footer>
          <p class="page">Halaman </p>
        </footer> -->

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <div style="page-break-after: avoid;">
              <table>
                <thead>
                  <!-- top left right -->
                  <tr>
                    <td class="left top" colspan="8" rowspan="4">FORMULIR<br>LAPORAN BULANAN OPERASIONAL</td>
                    <td class="left top" align="left" colspan="3"> &nbsp;Doc No</td>
                    <td class="left top right" colspan="2" align="left"> &nbsp;f......</td>
                  </tr>
                  <tr>
                    <td class="left top" align="left" colspan="3"> &nbsp;Rev</td>
                    <td class="left top right" colspan="2" align="left"> &nbsp;0.0</td>
                  </tr>
                  <tr>
                    <td class="left top" align="left" colspan="3"> &nbsp;Tgl Efektif</td>
                    <td class="left top right" colspan="2" align="left"> &nbsp;<?php echo date('d M Y',$mulai);?></td>
                  </tr>
                  <tr>
                    <td class="left top" align="left" colspan="3"> &nbsp;Halaman</td>
                    <td class="left top right" colspan="2" align="left"> &nbsp;<span class="hal"></span></td>
                  </tr>
                  <tr>
                    <td class="left top" width='20px'>No</td>
                    <td class="left top" width='55px'>PPJK</td>
                    <td class="left top" width='50px'>Tgl</td>
                    <td class="left top" width='35px'>Agen</td>
                    <td class="left top">Nama Kapal</td>
                    <td class="left top" width='35px'>GRT</td>
                    <td class="left top" width='25px'>LOA</td>
                    <td class="left top">Bendera</td>
                    <td class="left top">Dermaga</td>
                    <td class="left top" width='25px'>Tarif</td>
                    <td class="left top" width='35px'>LSTP</td>
                    <td class="left top right" width='90px'>No Inv</td>
                    <td class="left top right">Ket</td>
                  </tr>
                  <tr>
                    <td class="top" colspan="13"></td>
                  </tr>
                </thead>
                <tbody class="zebra">
                  <?php
                  $i=1;
                  foreach ($result as $row) {
                    echo
                    '<tr>
                    <td class="left top" align="center"> '.$i.' </td>
                    <td class="left top" align="center"> '.$row->ppjk.' </td>
                    <td class="left top" align="center"> '.date("d/m/Y",$row->date_issue).' </td>
                    <td class="left top" align="center"> '.$row->agenCode.' </td>
                    <td class="left top"> &nbsp;'.$row->kapalsName.' </td>
                    <td class="left top" align="right"> '.$row->kapalsGrt.'&nbsp; </td>
                    <td class="left top" align="right"> '.$row->kapalsLoa.'&nbsp; </td>
                    <td class="left top"> &nbsp;'.$row->kapalsBendera.' </td>
                    <td class="left top"> &nbsp;'.$row->jettyName.' </td>
                    <td class="left top" align="center"> '.$row->rute.' </td>
                    <td class="left top" align="center"> '.$row->lstp.' </td>
                    <td class="left top" align="center"> '.$row->noinv.' </td>
                    <td class="left top right">&nbsp;'.$row->ket.' </td>
                    </tr>';
                    $i++;
                  }
                  ?>
                  <tr>
                    <td class="top" colspan="13"></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <p style="page-break-after: never;">

            </p>
        </main>
    </body>
</html>
