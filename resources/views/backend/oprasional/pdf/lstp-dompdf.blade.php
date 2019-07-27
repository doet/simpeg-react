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
                    <td class="left top" colspan="4" rowspan="4">FORMULIR<br>Permintaan LSTP</td>
                    <td class="left top" align="left"> &nbsp;Doc No</td>
                    <td class="left top right" colspan="2" align="left"> &nbsp;f......</td>
                  </tr>
                  <tr>
                    <td class="left top" align="left"> &nbsp;Rev</td>
                    <td class="left top right" colspan="2" align="left"> &nbsp;0.0</td>
                  </tr>
                  <tr>
                    <td class="left top" align="left"> &nbsp;Tgl Efektif</td>
                    <td class="left top right" colspan="2" align="left"> &nbsp;<?php echo $mulai;?></td>
                  </tr>
                  <tr>
                    <td class="left top" align="left"> &nbsp;Halaman</td>
                    <td class="left top right" colspan="2" align="left"> &nbsp;<span class="hal"></span></td>
                  </tr>
                  <tr>
                    <td class="left top">No</td>
                    <td class="left top">PPJK</td>
                    <td class="left top">TGL</td>
                    <td class="left top">NAMA KAPAL</td>
                    <td class="left top">BENDERA</td>
                    <td class="left top">DERMAGA</td>
                    <td class="left top right">LSTP</td>
                  </tr>
                  <tr>
                    <td class="top" colspan="7"></td>
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
                    <td class="left top"> &nbsp;'.$row->kapalsName.' </td>
                    <td class="left top"> &nbsp;'.$row->kapalsBendera.' </td>
                    <td class="left top"> &nbsp;'.$row->jettyName.' </td>
                    <td class="left top right" align="center"> '.$row->lstp.'  </td>
                    </tr>';
                    $i++;
                  }
                  ?>
                  <tr>
                    <td class="top" colspan="7"></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <p style="page-break-after: never;">

            </p>
        </main>
    </body>
</html>
