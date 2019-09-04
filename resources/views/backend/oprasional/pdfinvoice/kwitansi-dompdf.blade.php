<html>
    <head>
        <style>
            /** Define the margins of your page **/
            @page { margin: 0px 0px 0px 0px }
            header { position: fixed; top: -60px; left:0px; right: 10px;  }

            /* main { position: fixed; top: 50px; left: 0px; bottom: -10px; right: 0px;  } */

            footer { position: fixed; left: 10px; bottom: -15px; right: 0px;}
            footer .page:after { content: counter(page, normal); }

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
          <?php
            $total = 0 ;
            foreach ($query as $row ) {
              $total = $total + $row->t_bht;
            }
          ?>
          <div style="page-break-after: avoid;">
            <div style="position:absolute; top:126; left:240;"><?php echo $query[0]->no_kwn ?></div>
            <div style="position:absolute; top:141; left:141;"><b><?php echo "PT. KRAKATAU BANDAR SAMUDRA"?></b></div>
            <div style="position:absolute; top:155; left:141;"><?php echo Terbilang($total)?></div>
            <div style="position:absolute; top:175; right:270; font-size: 14px;"><?php echo number_format($total) ?></div>


              <!--  left:42; -->
            <?php
            $top = 226;
            $i=1;
              foreach ($query as $row ) {
                // echo number_format($row->t_bht);
                echo '<div style="position:absolute; top:'.$top.'; left:41;">'.$i.'</div>';
                echo '<div style="position:absolute; top:'.$top.'; left:55; font-size: 11px;">'.$row->noinv.'</div>';
                echo '<div style="position:absolute; top:'.$top.'; left:126;">'.$row->name.'</div>';
                echo '<div style="position:absolute; top:'.$top.'; right:270;">'.number_format($row->t_bht).'</div>';
                $top = $top + 14;
                $i++;
              }
            ?>

            <div style="position:absolute; top:354; left:440;"><?php echo date('d - M - Y',$query[0]->tgl_pay) ?></div>
            <div style="position:absolute; top:435; left:421; text-align: center; font-size: 10px;"><b>H.ARIEF RIVA'I, SH, MH, M.SI</b><br>Derektur Utama<</div>
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
