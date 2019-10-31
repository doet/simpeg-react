
<html>
    <head>
        <style>
            /** Define the margins of your page **/
            @page { margin: 40px 40px 80px 40px }
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
              /* table-layout: fixed; */
              border-spacing: 0;
              margin-top:10px;
              width: 100%;
              margin-bottom:10px;
              max-height:50px;
              height:40px ;
              /* font-family :"Arial", Helvetica, sans-serif !important; */
              font-size: 11px;
            }
            td {
              border: 1px dotted;

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
    <!-- <body style="font-family:'Arial', Helvetica, sans-serif ; font-size:12px;"> -->
    <body style="font-size:12px;">
        <!-- Define header and footer blocks before your content -->
        <!-- <header>
          <img src="{{public_path().'\\pic\\logo.png'}}" width="125px"><div style="position:absolute; top:10; left:100"><b>PT. PELABUHAN CILEGON MANDIRI<br />
        Divisi Pemanduan dan Penundaan</b></div>
        </header> -->

        <footer>

          <!-- <p class="page">Halaman </p> -->
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->

        <main>
            <div style="page-break-after: avoid;">
              Rekap Invoice Tanggal : <?php echo $request->mulai; ?><br/>

                <table>
                  <thead>
                    <tr>
                      <td rowspan="2">No&nbsp;</td>
                      <td rowspan="2">No. Inv&nbsp;</td>
                      <td rowspan="2">No. Faktur&nbsp;</td>
                      <td rowspan="2">No. PPJ&nbsp;</td>
                      <td rowspan="2">BSTDO&nbsp;</td>
                      <td rowspan="2">LSTP&nbsp;</td>
                      <td rowspan="2">No. Ref&nbsp;</td>
                      <td rowspan="2">Agen&nbsp;</td>
                      <td rowspan="2">Kapal&nbsp;</td>
                      <td rowspan="2">GRT&nbsp;</td>
                      <td colspan="4">Bagi Hasil Setelah PNBP&nbsp;</td>
                    </tr>
                    <tr>
                      <td>INTERNTL&nbsp;</td>
                      <td>DOMESTIK&nbsp;</td>
                      <td>CIGADING&nbsp;</td>
                      <td>NON CIGADING&nbsp;</td>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $international = $domestic = $cigading = $noncigading = $x = 0;
                  $sum_international = $sum_domestic = $sum_cigading = $sum_noncigading =  0;
                  // dd($query);
                    foreach($query as $row){
                      $x++;
                      $qu =  InvoiceHelpers::items_inv($row->id);
                      if ($qu['data']['kapalsGrt']=='')$qu['data']['kapalsGrt'] = 0;

                      $i = count($qu['isi'])+1;
                      if ($qu['data']['selisih']!='')$match=explode(",",$qu['data']['selisih']);
                      if (empty($match[$i]))$match[$i]=0;

                      if ($qu['data']['rute']=='$')$international = $qu['jml_ori']['bhtPNBP']+$match[$i]; else $international = 0;
                      if ($qu['data']['rute']=='Rp')$domestic = $qu['jml_ori']['bhtPNBP']+$match[$i]; else $domestic = 0;
                      if ($qu['data']['tujuan']=='CIGADING')$cigading = $qu['jml_ori']['bhtPNBP']+$match[$i]; else $cigading = 0;
                      if ($qu['data']['tujuan']!='CIGADING')$noncigading = $qu['jml_ori']['bhtPNBP']+$match[$i]; else $noncigading = 0;


                      $sum_international = $sum_international;
                      $sum_domestic = $sum_domestic+$domestic;
                      $sum_cigading = $sum_cigading+$cigading;
                      $sum_noncigading = $sum_noncigading+$noncigading;
                      //
                      if ($international!=0)$international = number_format($international); else $international = '';
                      if ($domestic!=0)$domestic = number_format($domestic); else $domestic = '';
                      if ($cigading!=0)$cigading = number_format($cigading); else $cigading = '';
                      if ($noncigading!=0)$noncigading = number_format($noncigading); else $noncigading = '';

                      echo "<tr>
                        <td style='text-align: center; width:30px;'>".$x."</td>
                        <td style='text-align: center; width:90px;'>".$qu['data']['noinv']."</td>
                        <td style='text-align: center; width:100px;'>".$qu['data']['pajak']."</td>
                        <td style='text-align: center; width:80px;'>".$qu['data']['ppjk']."</td>
                        <td style='text-align: center; width:40px;'>".$qu['data']['bstdo']."</td>
                        <td style='text-align: center; width:55px;'>".$qu['data']['lstp']."</td>
                        <td style='text-align: center; width:85px;'>".$qu['data']['refno']."</td>
                        <td style='text-align: center; '>".$qu['data']['agenName']."</td>
                        <td style='text-align: center; '>".$qu['data']['kapalsName']."</td>
                        <td style='text-align: center; width:45px;'>".number_format($qu['data']['kapalsGrt'])."</td>
                        <td style='text-align: right; width:75px;'>".$international."&nbsp;</td>
                        <td style='text-align: right; width:75px;'>".$domestic."&nbsp;</td>
                        <td style='text-align: right; width:75px;'>".$cigading."&nbsp;</td>
                        <td style='text-align: right; width:75px;'>".$noncigading."&nbsp;</td>
                      </tr>";

                    }
                    echo "<tr>
                      <td style='text-align: center;' colspan='10'> </td>
                      <td style='text-align: right;'>".number_format($sum_international)."&nbsp;</td>
                      <td style='text-align: right;'>".number_format($sum_domestic)."&nbsp;</td>
                      <td style='text-align: right;'>".number_format($sum_cigading)."&nbsp;</td>
                      <td style='text-align: right;'>".number_format($sum_noncigading)."&nbsp;</td>
                    </tr>";
                    // dd($qu);
                  // dd($query[0]);
                  ?>

                  </tbody>
                </table>


            </div>
        </main>
    </body>
</html>
