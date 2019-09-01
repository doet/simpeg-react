<html>
    <head>
        <style>
            /** Define the margins of your page **/
            @page { margin: 0px 0px 0px 0px }
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
            <div style="position:absolute; top:127; left:240;"><?php echo $query[0]->no_kwn ?></div>
            <div style="position:absolute; top:141; left:141;"><?php echo "PT. KRAKATAU BANDAR SAMUDRA"?></div>
            <div style="position:absolute; top:155; left:141;"><?php echo Terbilang($query[0]->t_bht)?></div>
            <div style="position:absolute; top:178; left:255;"><?php echo number_format($query[0]->t_bht) ?></div>

            <div style="position:absolute; top:226;">
              <!--  left:42; -->
            <?php
              foreach ($query as $row ) {
                // echo number_format($row->t_bht);
                echo '<div style="position:absolute;left:42;">'.$row->noinv.'</div>';
                echo '<div style="position:absolute;left:141;">'.$row->name.'</div>';
                echo '<div style="position:absolute;left:226;">'.number_format($row->t_bht).'</div>';
              }
            ?>
            </div>
            <div style="position:absolute; top:354; left:377;">Cilegon, <?php echo date('d - M - Y',$query[0]->tgl_pay) ?></div>
          </div>

            <!-- <p style="page-break-after: never;">
                Content Page 2
            </p> -->
        </main>
    </body>
</html>
<?php
function Terbilang($x)
{
  $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
  if ($x < 12)
  return " " . $abil[$x];
  elseif ($x < 20)
    return Terbilang($x - 10) . " Belas";
    elseif ($x < 100)
    return Terbilang($x / 10) . " Puluh" . Terbilang($x % 10);
    elseif ($x < 200)
    return " Seratus" . Terbilang($x - 100);
    elseif ($x < 1000)
    return Terbilang($x / 100) . " Ratus" . Terbilang($x % 100);
    elseif ($x < 2000)
    return " Seribu" . Terbilang($x - 1000);
    elseif ($x < 1000000)
    return Terbilang($x / 1000) . " Ribu" . Terbilang($x % 1000);
    elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " Juta" . Terbilang($x % 1000000);
}
?>
