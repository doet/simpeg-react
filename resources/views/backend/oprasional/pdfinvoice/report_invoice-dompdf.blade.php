
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
                      <td rowspan="2">No. Ref&nbsp;</td>
                      <td rowspan="2">Agen&nbsp;</td>
                      <td rowspan="2">Kapal&nbsp;</td>
                      <td rowspan="2">GRT&nbsp;</td>
                      <td colspan="6">Bagi Hasil Setelah PNBP&nbsp;</td>
                    </tr>
                    <tr>
                      <td>LC VESSEL&nbsp;</td>
                      <td>LC BARGE&nbsp;</td>
                      <td>CG VESSEL&nbsp;</td>
                      <td>CG BARGE&nbsp;</td>
                      <td>KHUSUS&nbsp;</td>
                      <td>TOTAL&nbsp;</td>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $lcv = $lcb = $cgv = $cgb = $x = 0;
                  $sum_lcv = $sum_lcb = $sum_cgv = $sum_cgb = $sum_total =  0;

                    foreach($query as $row){
                      $x++;
                      $qu =  InvoiceHelpers::items_inv($row->id);
                      if ($qu['data']['kapalsGrt']=='')$qu['data']['kapalsGrt'] = 0;

                      $i = count($qu['isi'])+1;
                      // if (empty($match[$i]))$match[$i]=0;
                      $match[$i]=0;
                      if ($qu['data']['selisih']!='')$match=explode(",",$qu['data']['selisih']);

                      $nilai_match = $qu['jml_ori']['bhtPNBP']+$match[$i];
                      if (substr($qu['data']['headstatus'],0,3)=='NON'){
                        if ($qu['data']['kapalsJenis']=='BG'){
                          $lcb = $nilai_match;
                          $lcv = 0;
                          $cgb = 0;
                          $cgv = 0;
                        } else {
                          $lcv = $nilai_match;
                          $lcb = 0;
                          $cgb = 0;
                          $cgv = 0;
                        }
                      } else{
                        if ($qu['data']['kapalsJenis']=='BG'){
                          $cgb = $nilai_match;
                          $cgv = 0;
                          $lcv = 0;
                          $lcb = 0;
                        } else {
                          $cgv = $nilai_match;
                          $cgb = 0;
                          $lcv = 0;
                          $lcb = 0;
                        }
                      }


                      $sum_lcv = $sum_lcv+$lcv;
                      $sum_lcb = $sum_lcb+$lcb;
                      $sum_cgv = $sum_cgv+$cgv;
                      $sum_cgb = $sum_cgb+$cgb;
                      $sum_total = $sum_total+$nilai_match;
                      //
                      if ($lcv!=0)$lcv = number_format($lcv); else $lcv = '';
                      if ($lcb!=0)$lcb = number_format($lcb); else $lcb = '';
                      if ($cgv!=0)$cgv = number_format($cgv); else $cgv = '';
                      if ($cgb!=0)$cgb = number_format($cgb); else $cgb = '';
                      echo "<tr>
                        <td style='text-align: center; width:30px;'>".$x."</td>
                        <td style='text-align: center; width:90px;'>".$qu['data']['noinv']."</td>
                        <td style='text-align: center; width:100px;'>".$qu['data']['pajak']."</td>
                        <td style='text-align: center; width:80px;'>".$qu['data']['ppjk']."</td>
                        <td style='text-align: center; width:85px;'>".$qu['data']['refno']."</td>
                        <td style='text-align: center; '>".$qu['data']['agenName']."</td>
                        <td style='text-align: center; '>".$qu['data']['kapalsName']."</td>
                        <td style='text-align: center; width:45px;'>".number_format($qu['data']['kapalsGrt'])."</td>
                        <td style='text-align: right; width:75px;'>".$lcv."&nbsp;</td>
                        <td style='text-align: right; width:75px;'>".$lcb."&nbsp;</td>
                        <td style='text-align: right; width:75px;'>".$cgv."&nbsp;</td>
                        <td style='text-align: right; width:75px;'>".$cgb."&nbsp;</td>
                        <td style='text-align: right; width:75px;'>&nbsp;</td>
                        <td style='text-align: right; width:75px;'>".number_format($nilai_match)."&nbsp;</td>
                      </tr>";

                      // dd($qu['data']);
                    }
                    if ($sum_lcv!=0)$sum_lcv = number_format($sum_lcv); else $sum_lcv = '';
                    if ($sum_lcb!=0)$sum_lcb = number_format($sum_lcb); else $sum_lcb = '';
                    if ($sum_cgv!=0)$sum_cgv = number_format($sum_cgv); else $sum_cgv = '';
                    if ($sum_cgb!=0)$sum_cgb = number_format($sum_cgb); else $sum_cgb = '';
                    echo "<tr>
                      <td style='text-align: center;' colspan='8'> </td>
                      <td style='text-align: right;'>".$sum_lcv."&nbsp;</td>
                      <td style='text-align: right;'>".$sum_lcb."&nbsp;</td>
                      <td style='text-align: right;'>".$sum_cgv."&nbsp;</td>
                      <td style='text-align: right;'>".$sum_cgb."&nbsp;</td>
                      <td style='text-align: right;'>&nbsp;</td>
                      <td style='text-align: right;'>".number_format($sum_total)."&nbsp;</td>
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
