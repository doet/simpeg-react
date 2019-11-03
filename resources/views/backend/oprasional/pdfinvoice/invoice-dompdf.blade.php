
<html>
    <head>
        <style>
            /** Define the margins of your page **/
            @page { margin: 150px 30px 80px 30px }
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
              /* font-family :"Arial", Helvetica, sans-serif !important; */
              font-size: 12px;
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
              <div style="position:absolute; top:-90; left:30; width:300">
                <img src="{{public_path().'\\images\\pemda.png'}}" width="100px">
              </div>
              <div style="position:absolute; top:-88; left:110">
                <b style="font-size:15px">BADAN USAHA MILIK DAERAH<br />
                  PEMERINTAH KOTA CILEGON<br /></b>
                <b style="font-size:20px">PT. PELABUHAN CILEGON MANDIRI</b><br />
                <b style="font-size:11px"> Jl. Yos Sudarso No. 20 Kec. Pulo Merak, Cilegon - Banten <br />
                  42438  Tel. 0254-574000  Fax. 574894
                </b>
              </div>

              <div style="position:absolute; top:-90; left:600;">
                <table>
                  <tr>
                    <td class="left top right button" align="center"><b style="font-size:15px"><?php echo $helperInv['data']['headstatus']?></b></td>
                    <td width='50px'>&nbsp;</td>
                    <td style="font-size: 10px;">
                      Distribusi/Distribution<br>
                      (1) Pengguna Jasa<br>
                      (2) Keuangan PT PCM<br>
                      (3) Komersil PT PCM<br>
                      (4) Subdin Hubla<br>
                    </td>
                  </tr>
                </table>

                <table >
                  <tr style="font-size:11px; font-weight: bold;">
                    <td class="left top right" align="center" style="background-color: #DCDCDC;" height='18px' width='140px'>&nbsp;Nomor Faktur Pajak</td>
                    <td class="top right" align="center" style="background-color: #DCDCDC;" width='120px'>&nbsp;Nomor Invoice</td>
                    <td class="top right" align="center" style="background-color: #DCDCDC;">&nbsp;Tanggal / <i>Date</i></td>
                  </tr>

                  <tr style="font-size:13px">
                    <td class="left top right button" align="center" height='18px'>&nbsp;<?php echo $helperInv['data']['pajak']?></td>
                    <td class="top right button" align="center">&nbsp;<?php echo $helperInv['data']['noinv']?></td>
                    <!-- ; -->
                    <!-- time() -->
                    <td class="top right button" align="center">&nbsp;<?php echo strftime("%d %B %Y", $helperInv['data']['tglinv'])?></i></td>
                  </tr>
                </table>
              </div>
              <div style="position:absolute; top:-8; left:5;"><b><i style="font-size:15px">NOTA TAGIHAN / INVOICE</i></b></div>
              <table>
                  <tr tr style="font-size:11px; font-weight: bold;">
                    <!-- rowspan="2" colspan="2" -->
                    <td class="left top right" colspan="2" style="background-color: #DCDCDC;">&nbsp;Kepada / <i>To :</i></td>
                    <td class="top right" colspan="2" style="background-color: #DCDCDC;">&nbsp;Berdasarkan / <i>Base on :</i></td>
                    <td class="top right" colspan="2" style="background-color: #DCDCDC;">&nbsp;Untuk / <i>For Ship :</i></td>
                  </tr>
                  <tr>
                    <td class="left top right" width="150px">&nbsp;Perusahaan / <i>Company</i></td>
                    <td class="top right" width="300px">&nbsp;<?php //echo $result->agenName?>PT Krakatau Bandar Samudera</td>
                    <td class="top right" width="150px">&nbsp;PPJ No.</td>
                    <td class="top right">&nbsp;<?php echo $helperInv['data']['ppjk'] ?></td>
                    <td class="top right" width="150px">&nbsp;Nama kapal / <i>Vessel name</i></td>
                    <td class="top right" width="250px">&nbsp;<?php echo $helperInv['data']['kapalsJenis'].'. '.$helperInv['data']['kapalsName']?></td>
                  </tr>
                  <tr>
                    <td class="left top right" rowspan="2">&nbsp;Alamat / <i>Address</i></td>
                    <td class="top right" rowspan="2">&nbsp;<?php //echo $result->agenAlamat?>Jl. May.Jen S.Parman KM.13 Cigading, Cilegon</td>
                    <td class="top right">&nbsp;Ref.No</td>
                    <td class="top right">&nbsp;<?php echo $helperInv['data']['refno']?></td>
                    <td class="top right">&nbsp;GRT(Ton)</td>
                    <td class="top right">&nbsp;<?php echo number_format($helperInv['data']['kapalsGrt'])?></td>
                  </tr>
                  <tr>
                    <td class="top right">&nbsp;BASTDO No.</td>
                    <td class="top right">&nbsp;<?php echo $helperInv['data']['bstdo']?></td>
                    <td class="top right">&nbsp;Jalur</td>
                    <td class="top right">&nbsp;<?php if($helperInv['data']['rute'] == '$') echo 'International'; else if($helperInv['data']['rute'] == 'Rp') echo 'Indonesia'?></td>
                  </tr>
                  <tr>
                    <td class="left top right button">&nbsp;Telepon / <i>Telephone</i></td>
                    <td class="top right button">&nbsp;<?php //echo $result->agenTlp?></td>
                    <td class="top right button">&nbsp;Area</td>
                    <td class="top right button">&nbsp;<?php if (count($helperInv['data']['code'])>1) echo 'Cilegon/Serang'; else echo $helperInv['data']['code'][0]; ?></td>
                    <td class="top right button"></td>
                    <td class="top right button"></td>
                  </tr>
              </table>
              Silahkan dibayarkan tagihan berikut / <i>Please pay invoice as follow :</i>
              <table style="font-size:11px;">
                <thead>
                  <tr>
                    <!-- rowspan="2" colspan="2" -->
                    <td class="left top right" rowspan="3" width='55px'>LSTP<br>No</td>
                    <td class="top right" rowspan="2" colspan="2">Lokasi / <i>Location</i></td>
                    <td class="top right" rowspan="3" width='70px'>Uraian /<br> <i>Description</i></td>
                    <td class="top right" rowspan="3" width='90px'>Mulai / <i>Start</i><br> <i>(hr/bln/th jam:mnt)</i><br> <i>(dd/mm/yy hr:mnt)</i></td>
                    <td class="top right" rowspan="3" width='90px'>Selesai / <i>Finish</i><br> <i>(hr/bln/th jam:mnt)</i><br> <i>(dd/mm/yy hr:mnt)</i></td>
                    <td class="top right" colspan="4">Jumlah Waktu (Jam) / <i>Duration</i> (hour)</td>
                    <td class="top right" colspan="5">Perhitungan Tagihan / <i>Calculation of Invoice</i></td>
                    <td class="top right" rowspan="3" width='100px'>Total / <i>Total</i></td>
                  </tr>
                  <tr>
                    <td class="top right" rowspan="2" width='35px'>Waktu/<br><i>Time</i></td>
                    <td class="top right" rowspan="2" width='45px'>Terhitung/<br><i>Counted</i></td>
                    <td class="top right" rowspan="2" width='45px'>Mobilisasi/<br><i>Mobilize</i></td>
                    <td class="top right" rowspan="2" width='35px'>Total/<br><i>Total</i></td>

                    <td class="top right" colspan="2">Tetap / <i>Fixed</i></td>
                    <td class="top right" colspan="3">Variabel / <i>Variable</i></td>
                  </tr>
                  <tr>
                    <td class="top right" width='115px'>Dari / <i>From</i></td>
                    <td class="top right" width='115px'>Ke / <i>To</i></td>

                    <td class="top right" width='85px'>Tarif / <i>Tariff</i></td>
                    <td class="top right" width='85px'>Jumlah / <i>Amount</i></td>
                    <td class="top right" width='50px'>Tarif / <i>Tariff</i></td>
                    <td class="top right" width='40px'>GRT</td>
                    <td class="top right" width='85px' >Jumlah / <i>Amount</i></td>
                  </tr>
                  <tr>
                    <td class="top" colspan="16" ></td>
                  </tr>
                </thead>
                <tbody>
              <?php
                if ($helperInv['data']['selisih']!='')$match=explode(",",$helperInv['data']['selisih']);
                $i=0;
                // dd($match);
                // dd($helperInv['isi']);
                 // = '';
                foreach ($helperInv['isi'] as $row) {
                  if (empty($row['dari']))$row['dari']="";
                  if (empty($row['ke']))$row['ke']="";
                  
                  if (empty($match[$i]))$match[$i]=0;
                  echo '<tr>';
                  echo '<td class="left top right" align="center"> '.$helperInv['data']['lstp'].' </td>';
                  echo '<td class="top right" align="center"> '.$row['dari'].' </td>';
                  echo '<td class="top right" align="center"> '.$row['ke'].' </td>';
                  echo '<td class="top right" align="center"> Tunda/<i>Towing</i> </td>';
                  echo '<td class="top right" align="center"> '.$row['tundaon'].' </td>';
                  echo '<td class="top right" align="center"> '.$row['tundaoff'].' </td>';
                  echo '<td class="top right" align="right" style="font-size:12px;"> '.number_format($row['selisihWaktu'],2).'&nbsp; </td>';
                  echo '<td class="top right" align="right" style="font-size:12px;"> '.number_format($row['selisihWaktu2'],2).'&nbsp;  </td>';
                  echo '<td class="top right" align="right" style="font-size:12px;"> '.number_format($row['mobilisasi'],2).'&nbsp;  </td>';
                  echo '<td class="top right" align="right" style="font-size:12px;"> '.number_format($row['jumlahWaktu'],2).'&nbsp;  </td>';
                  echo '<td class="top right" align="right" style="font-size:12px;">Rp. '.number_format($helperInv['data']['tariffix']).'&nbsp;</td>';
                  echo '<td class="top right" align="right" style="font-size:12px;">Rp. '.number_format($row['jumlahTariffix']).'&nbsp;</td>';
                  if($helperInv['data']['rute'] == '$') {
                    echo '<td class="top right" align="right" style="font-size:12px;">Rp. '.number_format($helperInv['data']['tarifvar']).'&nbsp;</td>';
                  } else{
                    echo '<td class="top right" align="right" style="font-size:12px;">Rp. '.number_format($helperInv['data']['tarifvar'],2).'&nbsp;</td>';
                  }
                  echo '<td class="top right" align="right" style="font-size:12px;"> '.number_format($helperInv['data']['kapalsGrt']).'&nbsp;</td>';
                  echo '<td class="top right" align="right" style="font-size:12px;">Rp. '.number_format($row['jumlahTarifvar']).'&nbsp;</td>';
                  echo '<td class="top right" align="right" style="font-size:12px;">Rp. '.number_format($row['jumlahTarif'],2).'&nbsp;</td>';
                  echo '</tr>';

                  $i++;
                }
                if (empty($match[$i]))$match[$i]=0;
                if (empty($match[$i+1]))$match[$i+1]=0;
                if (empty($match[$i+2]))$match[$i+2]=0;
                if (empty($match[$i+3]))$match[$i+3]=0;
                // if (empty($match[$i+4]))$match[$i+4]=0;
                // dd($helperInv);
              ?>
                </tbody>
                <?php
                // dd(InvoiceHelpers::calculate_total($headstatus,));
                ?>
                <tr>
                  <td class="top" colspan="6" rowspan="4"> &nbsp; </td>
                  <td class="top" colspan="9" align="right">Total Tunda&nbsp;</td>
                  <td class="left top right" align="right"  style="font-size:12px;">Rp. <?php echo number_format($helperInv['jml_ori']['totalTarif']+$match[$i])?>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="9" align="right">Bagi Hasil Tunda setelah PNBP&nbsp;</td>
                  <td class="left top right" align="right"  style="font-size:12px;">Rp. <?php echo number_format($helperInv['jml_ori']['bhtPNBP']+$match[$i+1])?>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="9" align="right">PPn / Total after VAT&nbsp;</td>
                  <td class="left top right" align="right"  style="font-size:12px;">Rp. <?php echo number_format($helperInv['jml_ori']['ppn']+$match[$i+2])?>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="9" align="right">Total Tagihan Bagi Hasil / Total Invoice&nbsp;</td>
                  <td class="left top right button" align="right"  style="font-size:12px;">Rp. <?php echo number_format($helperInv['jml_ori']['totalinv']+$match[$i+3])?>&nbsp;</td>
                </tr>
              </table>
            </div>

            <div style="position:absolute; top:80; left:650; width:300; font-size:11px;">
              <?php
              // dd($helperInv);
              if($helperInv['data']['rute']  == '$') {
                echo 'Kurs Jual Bank Indonesia 1 USD / '.date('d M Y', $helperInv['data']['kurs']->date).' = Rp. '.number_format($helperInv['data']['kurs']->nilai);
              } ?>
            </div>

            <div style="position:absolute; top:270; left:30; width:300; font-size:11px;">
              <table>
                <thead>
                  <tr>
                    <td class="left top right" style="background-color: #DCDCDC;" colspan="2" height='17px'>Dibayarkan ke / <i>Payable</i></td>
                    <td class="top right" style="background-color: #DCDCDC;" width="150px">Tanggal jatuh tempo / <i>Due</i></td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="left top right button">&nbsp;Bank BNI (IDR)</td>
                    <td class="top right button" width="130px">&nbsp;231.05.45</td>

                    <td class="top right button" rowspan="3" align="center">&nbsp;<b style="font-size:15px;"><?php echo $helperInv['data']['tempo']?></b></i></td>
                  </tr>
                  <tr>
                    <td class="left top right button">&nbsp;Bank Mandiri (IDR)</td>
                    <td class="top right button">&nbsp;116.000.458.7292</td>
                  </tr>
                  <tr>
                    <td class="left top right button">&nbsp;Bank Jabar (IDR)</td>
                    <td class="top right button">&nbsp;28.00.01.006542.7</td>
                  </tr>
                  <tr>
                    <td class="left top right button">&nbsp;Atas nama / <i>Favour</i></td>
                    <td class="top right button" colspan="2">&nbsp;PT. Pelabuhan Cilegon Mandiri</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div style="position:absolute; top:350; left:30; width:350; font-size:11px;" align='center'>
              PT. PELABUHAN CILEGON MANDIRI<br>Pelaksana Pelayanan Jasa<br><br><br><br><br><br><br>
              H. ARIEF RIVA'I, SH, MH,M.SI<br>Direktur Utama
            </div>
<div style="position:absolute; top:350; left:530; width:350; font-size:10px;" class="left top right button">
            <ol>
              Keterangan :
              <li>Pembayaran dianggap sah  apabila bukti  transfer pembayaran telah disah-kan oleh Bank  dan bukti transfer tersebut diserahkan ke PT. Pelabuhan Cilegon Mandiri / Payment  valid when the transfer document has been legalized by the bank and submit to PT. Pelabuhan Cilegon Mandiri .</li>
              <li>Mohon pembayaran agar dilunasi sebelum jatuh tempo. The payment shall be paid before due date.</li>
              <li>Keluhan mengenai invoice bila ada agar di ajukan 3(tiga) hari sebelum jatuh tempo. If there is any complain about the invoice, please inform us 3(three) days before due date.</li>
            </ol>
</div>



            <!-- <p style="page-break-after: never;">
                Content Page 2
            </p> -->
        </main>
    </body>
</html>
