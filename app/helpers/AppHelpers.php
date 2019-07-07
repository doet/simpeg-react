<?php

namespace App\Helpers;
use App\Models\libur;
// use App\Models\jshift;
// use App\Models\fasilitas;
use App\Models\cuti;
// use App\Models\kk2;
use App\Models\pegawai;
// use App\Models\variabel;
// use App\Models\upah;
// use App\Models\potongan;
// use App\Models\koperasi;

use DB;

class AppHelpers {

    public static function hitungcuti($tglawal,$tglakhir,$delimiter) {
    //    menetapkan parameter awal dan libur nasional
    //    pada prakteknya data libur nasional bisa diambil dari database

    //    $koneksi = mysqli_connect('localhost', 'root', '', 'harviacode');
    //    $query = "SELECT * FROM liburnasional";
    //    $result = mysqli_query($koneksi, $query);
    //    while ($row = mysqli_fetch_array($result)) {
    //        $liburnasional[] = tglindo($row['tgl']);
    //    }

        $query = libur::all();
        foreach($query as $data){
            $liburnasional[] = date('d-m-Y', $data->tgllibur);
        }

        $tgl_awal = $tgl_akhir = $minggu = $sabtu = $koreksi = $libur = 0;
        // $liburnasional = array("01-05-2014","15-05-2014","27-05-2014","29-05-2014");

        //    memecah tanggal untuk mendapatkan hari, bulan dan tahun
        $pecah_tglawal = explode($delimiter, $tglawal);
        $pecah_tglakhir = explode($delimiter, $tglakhir);

        //    mengubah Gregorian date menjadi Julian Day Count
        $tgl_awal = gregoriantojd($pecah_tglawal[1], $pecah_tglawal[0], $pecah_tglawal[2]);
        $tgl_akhir = gregoriantojd($pecah_tglakhir[1], $pecah_tglakhir[0], $pecah_tglakhir[2]);

        //    mengubah ke unix timestamp
        $jmldetik = 24*3600;
        $a = strtotime($tglawal);
        $b = strtotime($tglakhir);

        //  strtotime('22-09-2008')
        //  echo strtotime("01 January 2016 1 hours")."<br>";

        //    menghitung jumlah libur nasional
        for($i=$a; $i<$b; $i+=$jmldetik){
            foreach ($liburnasional as $key => $tgllibur) {
                if($tgllibur==date("d-m-Y",$i)){
                    $libur++;
                }
            }
        }

    //    menghitung jumlah hari minggu
        for($i=$a; $i<$b; $i+=$jmldetik){
            if(date("w",$i)=="0"){
                $minggu++;
            }
        }

        //    menghitung jumlah hari sabtu
        for($i=$a; $i<$b; $i+=$jmldetik){
            if(date("w",$i)=="6"){
                $sabtu++;
            }
        }

        //    dijalankan jika $tglakhir adalah hari sabtu atau minggu
        if(date("w",$b)=="0" || date("w",$b)=="6"){
            $koreksi = 1;
        }

        //    mengitung selisih dengan pengurangan kemudian ditambahkan 1 agar tanggal awal cuti juga dihitung
        $jumlahcuti =  $tgl_akhir - $tgl_awal - $libur - $minggu - $sabtu - $koreksi + 1;
        return $jumlahcuti;
    }

    public static function hitungcutishift($tglawal,$tglakhir,$delimiter,$cari) {
    //    menetapkan parameter awal dan libur shift

    //    $koneksi = mysqli_connect('localhost', 'root', '', 'harviacode');
    //    $query = "SELECT * FROM liburnasional";
    //    $result = mysqli_query($koneksi, $query);
    //    while ($row = mysqli_fetch_array($result)) {
    //        $liburnasional[] = tglindo($row['tgl']);
    //    }

        $query = libur::all();
        foreach($query as $data){
            $liburnasional[] = date('d-m-Y', $data->tgllibur);
        }

        $tgl_awal = $tgl_akhir = $minggu = $sabtu = $koreksi = $libur = 0;
        // $liburnasional = array("01-05-2014","15-05-2014","27-05-2014","29-05-2014");

        //    memecah tanggal untuk mendapatkan hari, bulan dan tahun
        $pecah_tglawal = explode($delimiter, $tglawal);
        $pecah_tglakhir = explode($delimiter, $tglakhir);

        //    mengubah Gregorian date menjadi Julian Day Count
        $tgl_awal = gregoriantojd($pecah_tglawal[1], $pecah_tglawal[0], $pecah_tglawal[2]);
        $tgl_akhir = gregoriantojd($pecah_tglakhir[1], $pecah_tglakhir[0], $pecah_tglakhir[2]);

        //    mengubah ke unix timestamp
        $jmldetik = 24*3600;
        $a = strtotime($tglawal);
        $b = strtotime($tglakhir);

        //  strtotime('22-09-2008')
        //  echo strtotime("01 January 2016 1 hours")."<br>";

        //    menghitung jumlah libur nasional
        for($i=$a; $i<$b; $i+=$jmldetik){
            foreach ($liburnasional as $key => $tgllibur) {
                if($tgllibur==date("d-m-Y",$i)){
                    $libur++;
                }
            }
        }

    //    menghitung jumlah hari minggu
        for($i=$a; $i<$b; $i+=$jmldetik){
            if(date("w",$i)=="0"){
                $minggu++;
            }
        }

        //    menghitung jumlah hari sabtu
        for($i=$a; $i<$b; $i+=$jmldetik){
            if(date("w",$i)=="6"){
                $sabtu++;
            }
        }

        //    dijalankan jika $tglakhir adalah hari sabtu atau minggu
        if(date("w",$b)=="0" || date("w",$b)=="6"){
            $koreksi = 1;
        }

        //    mengitung selisih dengan pengurangan kemudian ditambahkan 1 agar tanggal awal cuti juga dihitung
        $jumlahcuti =  $tgl_akhir - $tgl_awal - $koreksi + 1;
        return $jumlahcuti;
    }

    public static function hitunghari($tglawal,$tglakhir,$delimiter) {
        $tgl_awal = $tgl_akhir = 0;


        //    memecah tanggal untuk mendapatkan hari, bulan dan tahun
        $pecah_tglawal = explode($delimiter, $tglawal);
        $pecah_tglakhir = explode($delimiter, $tglakhir);

        //    mengubah Gregorian date menjadi Julian Day Count
        $tgl_awal = gregoriantojd($pecah_tglawal[1], $pecah_tglawal[0], $pecah_tglawal[2]);
        $tgl_akhir = gregoriantojd($pecah_tglakhir[1], $pecah_tglakhir[0], $pecah_tglakhir[2]);

        //    mengubah ke unix timestamp
        $jmldetik = 24*3600;
        $a = strtotime($tglawal);
        $b = strtotime($tglakhir);


        //    mengitung selisih dengan pengurangan kemudian ditambahkan 1 agar tanggal awal cuti juga dihitung
        $jumlahhari =  $tgl_akhir - $tgl_awal + 1;
        return $jumlahhari;
    }

    public static function sisacuti($tglawal,$tglakhir,$id_u) {


        $pegawai = pegawai::join('tb_fasilitas','tb_fasilitas.id_u', '=', 'tbl_datapegawai.id')
            ->where('tbl_datapegawai.id','=',$id_u)
            ->where('tb_fasilitas.cutitahun','like','18/%')
            ->first();
        $jumlah = cuti::where('id_u','=',$id_u)
            ->where('no','like','18/%')
            ->where('jeniscuti',1)
            ->get();

        $total=0;
        foreach($jumlah as $jumlah) {
          if ($pegawai['wkerja'] == 0){
            $jmlct = AppHelpers::hitungcuti(date('d-m-Y', $jumlah->sdate),date('d-m-Y', $jumlah->edate),'-');
          } else if($pegawai['wkerja'] == 1){
            $jmlct = AppHelpers::hitungcutishift(date('d-m-Y', $jumlah->sdate),date('d-m-Y', $jumlah->edate),'-',$id_u);
          }
            $total = $jmlct+$total;
        }

        $jatcut=explode("/",$pegawai['cutitahun']);
        $jumlahhari=$jatcut[1]-$total;
        return $jumlahhari;

    }

    public static function rekamdata($db,$jenis)
    {
        $cek = DB::table($db)->where('jenis',$jenis)->first();
        return $cek;
    }

    public static function Terbilang($x)
    {
        $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        if ($x < 12)
        return " " . $abil[$x];
        elseif ($x < 20)
        return Terbilang($x - 10) . "belas";
        elseif ($x < 100)
        return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
        elseif ($x < 200)
        return " seratus" . Terbilang($x - 100);
        elseif ($x < 1000)
        return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
        elseif ($x < 2000)
        return " seribu" . Terbilang($x - 1000);
        elseif ($x < 1000000)
        return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
        elseif ($x < 1000000000)
        return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
    }

    public static function selisihhbt($start, $end, $period = "day")
    {
        $day = 0;
        $month = 0;
        $month_array = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        $datestart = strtotime($start);
        $dateend = strtotime($end);
        $month_start = strftime("%m", $datestart);
        $current_year = strftime("%y", $datestart);
        $diff = $dateend - $datestart;
        $date = $diff / (60 * 60 * 24);
        $day = $date;
        $awal = 1;
        while($date > 0)
        {
            if($awal)
            {
                $loop = $month_start - 1;
                $awal = 0;
            }
            else
            {
                $loop = 0;
            }
            for ($i = $loop; $i < 12; $i++)
            {
                if($current_year % 4 == 0 && $i == 1)
                    $day_of_month = 29;
                else
                    $day_of_month = $month_array[$i];
                $date -= $day_of_month;
                if($date <= 0)
                {
                    if($date == 0)
                        $month++;
                    break;
                }
                $month++;
            }
            $current_year++;
        }
        switch($period)
        {
            case "day"   : return $day; break;
            case "month" : return $month; break;
            case "year"  : return intval($month / 12); break;
        }
    }


    // selisih jam masuk dan keluar -> absen
    public static function selisih ($w1,$w2){
        list($h,$m) = explode(":",$w1) ;
        $dtAwal = mktime($h,$m,00,1,1,1);

        list($h,$m) = explode(":",$w2) ;
        $dtAkhir = mktime($h,$m,00,1,1,1);

        $dtSelisih = $dtAwal - $dtAkhir;

        $totalmenit=$dtSelisih/60;
        $jam = explode (".",$totalmenit/60);
        $sisamenit=($totalmenit/60)-$jam[0];
        $sisamenit2=$sisamenit*60;

        if (strlen($jam[0]) < 2)$hjam='0'.$jam[0];else $hjam=$jam[0];
        if (strlen($sisamenit2) < 2)$sisamenit3='0'.$sisamenit2;else $sisamenit3=$sisamenit2;

        return $hjam.':'.$sisamenit3 ;
    }
    
    //total penambahan waktu
    public static function TotalWaktu($w1,$w2){
        $time1_unix = strtotime(date('Y-m-d').' '.$w1.':00');
        $time2_unix = strtotime(date('Y-m-d').' '.$w2.':00');
        $begin_day_unix = strtotime(date('Y-m-d').' 00:00:00');
        $tslm = date('H:i', ($time1_unix + ($time2_unix - $begin_day_unix)));
        return $tslm ;
    }

    public static function view_nilai($vid,$grup) {
        $strmenu = "";
            $nilai= variabel::where('grup',$grup)
                ->where('vid',$vid)
                ->first();

        return $nilai['label'];
    }

    public static function upah($id_u,$jenis) {
        $strmenu = "";
        $nilai= upah::where('jenis',$jenis)
            ->where('id_u',$id_u)
            ->where('berlaku','!=','')
            ->first();

        return $nilai['nilai'];
    }

    public static function potongan($id_u,$jenis) {
        $strmenu = "";
        $nilai= potongan::where('jenis',$jenis)
            ->where('id_u',$id_u)
            ->where('berlaku','!=','')
            ->first();

        return $nilai['nilai'];
    }
    public static function koperasi($id_u,$jenis) {
        $strmenu = "";
        $nilai= koperasi::where('jenis',$jenis)
            ->where('id_u',$id_u)
            ->where('berlaku','!=','')
            ->first();

        return $nilai['nilai'];
    }

    //pisah tanggal
    public static function extractNilai($data) {
        $str=explode('/', $data);
        if (empty($str[0]))$str[0]=0;
        if (empty($str[1]))$str[1]=0;
        $responce['n0'] = $str[0];
        $responce['n1'] = $str[1];
        //$responce = $str[0];
        return  $responce;
    }

    public static function formatNomer($data) {
      if (is_numeric($data))$responce =  number_format($data); else $responce =$data;
      return  $responce;
    }

    public static function dateNtime($data) {
      $date=explode(' ', $data);
      if (empty($date[0]))$date[0]=0;
      if (empty($date[1]))$date[1]=0;
      $date[0]=explode('/', $date[0]);
      $responce['date']=strtotime($date[0][0].'-'.$date[0][1].'-20'.$date[0][2].' '.$date[1]);

      return $responce;
    }

    public static function RangeDate($data) {
      if (empty($data)) return $responce['startDate']=$responce['endDate']=0;
      $date=explode('-', $data);
      if (empty($date[0]))$date[0]=0;
      if (empty($date[1]))$date[1]=0;
      $responce['startDate']=AppHelpers::dateNtime($date[0])['date'];
      $responce['endDate']=AppHelpers::dateNtime(trim($date[1]))['date'];
      return $responce;
    }

}
