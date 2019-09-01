<?php

namespace App\Helpers;
date_default_timezone_set('Asia/Jakarta');
use DB;

class InvoiceHelpers {
  public static function selisih_waktu($won,$woff) {
    $responce['selisihWaktu']=number_format(($woff-$won)/3600,2);
    $exWaktu = explode(".",$responce['selisihWaktu']);

    if ($exWaktu[1]<=50 && $exWaktu[1]!=00 )$selisihWaktu2=$exWaktu[0]+0.5; else $selisihWaktu2=ceil($responce['selisihWaktu']);
    if ($selisihWaktu2<1)$selisihWaktu2=1;
    $responce['selisihWaktu2']=number_format($selisihWaktu2,2);
    return $responce;
  }

  public static function mobilisasi($daria,$kea) {
    if ($daria!='S' && $kea!='S') $mobilisasi=2;
    else if ($daria!='S' && $kea=='S') $mobilisasi=2.25;
    else if ($daria=='S' && $kea!='S') $mobilisasi=2.25;
    else if ($daria=='S' && $kea=='S') $mobilisasi=2.5;
    return $mobilisasi;
  }

  public static function tarif($rute,$kapalsGrt,$kurs) {
    if($rute == '$') {
      if ($kapalsGrt<=3500)$tariffix = 152.25*$kurs;
      else if ($kapalsGrt<=8000)$tariffix = 386.25*$kurs;
      else if ($kapalsGrt<=14000)$tariffix = 587.1*$kurs;
      else if ($kapalsGrt<=18000)$tariffix = 770*$kurs;
      else if ($kapalsGrt<=40000)$tariffix = 1220*$kurs;
      else if ($kapalsGrt<=75000)$tariffix = 1300*$kurs;
      else if ($kapalsGrt>75000)$tariffix = 1700*$kurs;
    } else {
      if ($kapalsGrt<=3500)$tariffix = 495000;
      else if ($kapalsGrt<=8000)$tariffix = 577500;
      else if ($kapalsGrt<=14000)$tariffix = 825000;
      else if ($kapalsGrt<=18000)$tariffix = 1031250;
    }
    $responce['tariffix'] = $tariffix;

    if($rute == '$') {
      if ($kapalsGrt<=14000)$tarifvar=0.005*$kurs;
      else if ($kapalsGrt<=40000)$tarifvar=0.004*$kurs;
      else if ($kapalsGrt>40000)$tarifvar=0.002*$kurs;
    } else {
      $tarifvar=3.30;
    }
    $responce['tarifvar'] = $tarifvar;
    return $responce;
  }


  public static function nilai_inv($ppjks_id,$totalTarif,$bhtPNBP,$ppn,$totalinv){
    $datainv = array(
      'ppjks_id'=>$ppjks_id,
      // 't_pandu'=>'1',
      't_tunda'=>$totalTarif,
      'bht_bnbp'=>$bhtPNBP,
      'pph'=>$ppn,
      't_bht'=>$totalinv
    );

    if (DB::table('tb_inv')->where('ppjks_id', $ppjks_id)->exists()){
      DB::table('tb_inv')->where('ppjks_id',$ppjks_id)->update($datainv);
    }else{
      DB::table('tb_inv')->insert($datainv);
    }
    return $datainv;
  }
}
