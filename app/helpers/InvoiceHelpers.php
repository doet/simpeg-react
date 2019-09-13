<?php

namespace App\Helpers;
date_default_timezone_set('Asia/Jakarta');
use DB;

class InvoiceHelpers {
  public static function items_inv($id_ppjk) {
    $query = DB::table('tb_dls')
      ->leftJoin('tb_jettys', function ($join) {
        $join->on('tb_jettys.id','tb_dls.jettys_id');
      })
      ->where(function ($query) use ($id_ppjk){
        $query->where('tb_dls.ppjks_id',$id_ppjk);
      })->orderBy('date', 'asc')
      ->select(
        'tb_jettys.code as jettyCode',
        'tb_jettys.name as jettyName',
        'tb_dls.*'
      )->get();

    $i=0;
    foreach ($query as $row ) {
      $isi[$i]['id'] = $i;
      if ($row->ops=='Berth'){
        if ($row->shift!='on'){
          $isi[$i]['dari'] = 'Laut/<i>Sea</i>';
          $isi[$i]['ke'] = $row->jettyName;
          $dari=$row->jettyName;
          $isi[$i]['daria']=$isi[$i]['kea']=substr($row->jettyCode,0,1);
        } else {
          $isi[$i]['dari'] = $dari;
          $isi[$i]['ke'] = $row->jettyName;
          $dari=$row->jettyName;
          $isi[$i]['daria']=$isi[$i-1]['kea'];
          $isi[$i]['kea']=substr($row->jettyCode,0,1);
        }
      }

      if ($row->ops=='Unberth'){
        if ($row->shift!='on'){
          $isi[$i]['dari'] = $dari;
          $isi[$i]['ke'] = 'Laut/<i>Sea</i>';
          $tundaon='';
          $isi[$i]['daria']=$isi[$i-1]['kea'];
          $isi[$i]['kea']=$isi[$i-1]['kea'];
        } else {
          // $isi[$i]['dari'] = $dari;
          $dari=$row->jettyName;
          $tundaon=$row->tundaon;
          $isi[$i]['daria']='';
          $isi[$i]['kea']='';
        }
      }


      if ($row->ops=='Berth'){
        if ($row->shift!='on'){
          // $totalTarif = $isi[$i]['jumlahTarif']+$totalTarif;
          $i++;
        } else {
          // $totalTarif = $isi[$i]['jumlahTarif']+$totalTarif;
          $i++;
        }
      }

      if ($row->ops=='Unberth'){
        if ($row->shift!='on'){
          // $totalTarif = $isi[$i]['jumlahTarif']+$totalTarif;
          $i++;
        } else {

        }
      }
    }
  
    return $isi;
  }
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
