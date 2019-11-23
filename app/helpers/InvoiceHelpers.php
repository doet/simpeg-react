<?php

namespace App\Helpers;
date_default_timezone_set('Asia/Jakarta');
use DB;

class InvoiceHelpers {
  public static function items_inv($id_ppjk) {
    $responce['data'] = DB::table('tb_ppjks')
      ->leftJoin('tb_agens', function ($join) {
        $join->on('tb_agens.id','tb_ppjks.agens_id');
      })
      ->leftJoin('tb_kapals', function ($join) {
        $join->on('tb_kapals.id','tb_ppjks.kapals_id');
      })
      ->where(function ($query) use ($id_ppjk){
        $query->where('tb_ppjks.bstdo','!=','');
        $query->where('tb_ppjks.id',$id_ppjk);
      })
      ->select(
        'tb_agens.name as agenName',
        'tb_agens.alamat as agenAlamat',
        'tb_agens.tlp as agenTlp',
        'tb_kapals.name as kapalsName',
        'tb_kapals.jenis as kapalsJenis',
        'tb_kapals.grt as kapalsGrt',
        'tb_kapals.bendera as kapalsBendera',
        'tb_ppjks.*'
      )
      ->first();
      $responce['data'] = (array)$responce['data'];
      // $query = DB::table('tb_dls')
      //   ->leftJoin('tb_jettys', function ($join) {
      //     $join->on('tb_jettys.id','tb_dls.jettys_id');
      //   })
      //   ->where(function ($query) use ($id_ppjk){
      //     $query->where('tb_dls.ppjks_id',$id_ppjk);
      //   })
      //   ->select(
      //     'tb_jettys.code as jettyCode',
      //     'tb_jettys.name as jettyName',
      //     'tb_dls.*'
      //   )
      //   ->orderBy('tundaon', 'asc')
      //   ->get();
    $query = DB::table('tb_dls')
      ->leftJoin('tb_jettys', function ($join) {
        $join->on('tb_jettys.id','tb_dls.jettys_id');
      })
      ->leftJoin('tb_ppjks', function ($join) {
        $join->on('tb_ppjks.id','tb_dls.ppjks_id');
      })
      ->leftJoin('tb_kapals', function ($join) {
        $join->on('tb_kapals.id','tb_ppjks.kapals_id');
      })
      ->where(function ($query) use ($id_ppjk){
        $query->where('tb_dls.ppjks_id',$id_ppjk);
      })->orderBy('date', 'asc')
      ->select(
        'tb_jettys.code as jettyCode',
        'tb_jettys.name as jettyName',
        'tb_kapals.grt as kapalsGrt',
        'tb_ppjks.dkurs as dkurs',
        'tb_ppjks.rute as rute',
        'tb_dls.*'
      )->get();

    $totalTarif = 0;
    $area=$tundaon=$dari=$ke= '';

    $code=$name=$isi=array();
    $i=0;

    if ($responce['data']['selisih']!='')$match=explode(",",$responce['data']['selisih']);
    // $match = 0;
    foreach ($query as $row ) {
      $isi[$i]['id']=$i;

      $isi[$i]['i']=$i;

      if (substr($row->jettyCode,0,1)=='S'){
        if(!in_array('Serang',$code))array_push($code,'Serang');
        // $area='Serang';
      } else {
        if(!in_array('Cilegon',$code))array_push($code,'Cilegon');
        // $area='Cilegon';
      }

      if(!in_array($row->jettyCode,$name))array_push($name,$row->jettyCode);
      if(in_array('12',$name)){
        if ($row->rute == '$') $headstatus=$row->jettyName.' .1'; else $headstatus=$row->jettyName.' .2';
      } else {
        if ($row->rute == '$') $headstatus='NON CIGADING 1'; else $headstatus='NON CIGADING 2';
      }

      $isi[$i]['bapp'] = $row->bapp;
      $isi[$i]['daria'] = $isi[$i]['kea'] = '';
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

      if ($row->ops=='Khusus'){
        $isi[$i]['dari'] = $row->jettyName;
        $isi[$i]['ke'] = $row->jettyName;
        // if ($row->shift!='on'){
        //   $isi[$i]['dari'] = $dari;
        //   $isi[$i]['ke'] = 'Laut/<i>Sea</i>';
        //   $tundaon='';
        //   $isi[$i]['daria']=$isi[$i-1]['kea'];
        //   $isi[$i]['kea']=$isi[$i-1]['kea'];
        // } else {
        //   // $isi[$i]['dari'] = $dari;
        //   $dari=$row->jettyName;
        //   $tundaon=$row->tundaon;
        //   $isi[$i]['daria']='';
        //   $isi[$i]['kea']='';
        // }
      }

      if ($tundaon!=''){
        $isi[$i]['tundaon']=date('d/m/y H:i',$tundaon);
        $row->tundaon = $tundaon;
      } else $isi[$i]['tundaon']=date('d/m/y H:i',$row->tundaon);
      $isi[$i]['tundaoff']=date('d/m/y H:i',$row->tundaoff);

      $selisih = self::selisih_waktu($row->tundaon,$row->tundaoff);
      $isi[$i]['selisihWaktu']=$selisih['selisihWaktu'];
      $isi[$i]['selisihWaktu2']=$selisih['selisihWaktu2'];

      $isi[$i]['mobilisasi']=self::mobilisasi($isi[$i]['daria'],$isi[$i]['kea']);

      $isi[$i]['jumlahWaktu']=$isi[$i]['mobilisasi']+$isi[$i]['selisihWaktu2'];

      $kapalsGrt = $row->kapalsGrt;

      $kurs=self::kurs($row->dkurs);
      if ($row->rute == '$' && $kurs->nilai == 0) $kurs->nilai=1;
      $tarif=self::tarif($row->rute,$kapalsGrt,$kurs->nilai,$row->tundaon);
      // dd($tarif);
      $tariffix = $tarif['tariffix'];
      $isi[$i]['jumlahTariffix']=$tariffix*$isi[$i]['jumlahWaktu'];

      $tarifvar=$tarif['tarifvar'];
      $isi[$i]['jumlahTarifvar']=$tarifvar*$kapalsGrt*$isi[$i]['jumlahWaktu'];
      if (empty($match[$i]))$match[$i]=0;
      // dd($match);
      $isi[$i]['jumlahTarif']=$isi[$i]['jumlahTarifvar']+$isi[$i]['jumlahTariffix']+$match[$i];

      if ($row->ops=='Berth'){
        if ($row->shift!='on'){
          $jml['jumlahTarif'] = $totalTarif = ($isi[$i]['jumlahTarif']-$match[$i])+$totalTarif;
          $i++;
        } else {
          $jml['jumlahTarif'] = $totalTarif = ($isi[$i]['jumlahTarif']-$match[$i])+$totalTarif;
          $i++;
        }
      }

      if ($row->ops=='Unberth'){
        if ($row->shift!='on'){
           $jml['jumlahTarif'] = $totalTarif = $isi[$i]['jumlahTarif']+$totalTarif;
          $i++;
        } else {

        }
      }
    }

    $responce['isi'] = $isi;
    $responce['jml_ori'] = array_map(function($v){return round($v);}, self::calculate_total($headstatus,$totalTarif));
    $responce['data']['headstatus'] = $headstatus;
    $responce['data']['code'] = $code;
    $responce['data']['tariffix'] = $tariffix;
    $responce['data']['tarifvar'] = $tarifvar;
    $responce['data']['kurs'] = $kurs;
    $responce['data']['tempo'] = strftime("%d %B %Y",self::cek_libur($responce['data']['tglinv'],3));

    return $responce;
  }

  public static function calculate_total($headstatus,$totalTarif) {
    $responce['totalTarif']=$totalTarif;
    if (substr($headstatus,0,8)=='Cigading' || substr($headstatus,0,8)=='CIGADING'){
      $responce['bht99']    = $responce['totalTarif']*(98/100);
      $responce['bht5']     = $responce['bht99']*(5/100);
      $responce['bhtPNBP']  = $responce['bht99']-$responce['bht5'];
      $responce['ppn']      = $responce['bhtPNBP']*(10/100);
      $responce['totalinv'] = $responce['bhtPNBP']+$responce['ppn'];
    }

    if ($headstatus=='NON CIGADING 1' ||$headstatus=='NON CIGADING 2'){
      $responce['bht99']    = $responce['totalTarif']*(99/100);
      $responce['bht5']     = $responce['bht99']*(5/100);
      $responce['bhtPNBP']  = $responce['bht99']-$responce['bht5'];
      $responce['ppn']      = $responce['bhtPNBP']*(10/100);
      $responce['totalinv'] = $responce['bhtPNBP']+$responce['ppn'];
    }
    return $responce;
  }

  public static function kurs($date) {
    $kurs = DB::table('tb_kurs')
      ->where(function ($query) use ($date){
        $query->where('date',$date);
      })
      ->first();

    if ($kurs==null) $kurs=(object) array('nilai'=>'0');
    return $kurs;
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

  public static function tarif($rute,$kapalsGrt,$kurs,$tgl) {

    $qu_tariffix = DB::table('tb_nilaiinv')
      ->where(function ($qu) use ($tgl,$rute,$kapalsGrt){

        if ($rute == '$')$prefix = 'it_%'; else $prefix = 'dt_%';
        $desc = $qu->where('date','<=',$tgl)->where('desc','like',$prefix);
        $qu_desc = $desc->get();

        $d=array();
        $i=0;
        foreach ($qu_desc as $row) {
          $d[$i]=substr($row->desc,3);
          sort($d);
          $i++;
        }
        $f_id='';
        foreach ($d as $row) {
          $f_id=$row;
          if($kapalsGrt<=$row)break;
        }
        $qu->where('desc','like','%'.$f_id);
        // $qu->where('desc',$d);
      })->orderBy('date', 'asc')
      ->first();
      // dd($qu_tariffix);
    if($rute == '$') {
      // if ($kapalsGrt<=3500)$tariffix = 152.25*$kurs;
      // else if ($kapalsGrt<=8000)$tariffix = 386.25*$kurs;
      // else if ($kapalsGrt<=14000)$tariffix = 587.1*$kurs;
      // else if ($kapalsGrt<=18000)$tariffix = 770*$kurs;
      // else if ($kapalsGrt<=40000)$tariffix = 1220*$kurs;
      // else if ($kapalsGrt<=75000)$tariffix = 1300*$kurs;
      // else if ($kapalsGrt>75000)$tariffix = 1700*$kurs;
      if($qu_tariffix == null)$qu_tariffix_value = 0;
      $tariffix = $qu_tariffix_value*$kurs;
      // $tariffix = $qu_tariffix->date;
    } else {
      $tariffix = $qu_tariffix->value;
      // if ($kapalsGrt<=3500)$tariffix = 495000;
      // else if ($kapalsGrt<=8000)$tariffix = 577500;
      // else if ($kapalsGrt<=14000)$tariffix = 825000;
      // else if ($kapalsGrt<=18000)$tariffix = 1031250;
    }
    $responce['tariffix'] = $tariffix;


    $qu_tarifvar = DB::table('tb_nilaiinv')
      ->where(function ($qu) use ($tgl,$rute,$kapalsGrt){
        if ($rute == '$')$prefix = 'iv_%'; else $prefix = 'dv_%';
        $desc = $qu->where('date','<=',$tgl)->where('desc','like',$prefix);
        $qu_desc = $desc->get();

        $d=array();
        $i=0;
        foreach ($qu_desc as $row) {
          $d[$i]=substr($row->desc,3);
          sort($d);
          $i++;
        }
        $f_id='';
        foreach ($d as $row) {
          $f_id=$row;
          if($kapalsGrt<=$row)break;
        }
        $qu->where('desc','like','%'.$f_id);
        // $qu->where('desc',$d);
      })->orderBy('date', 'asc')
      ->first();
    // dd($qu_tarifvar);
    if($rute == '$') {
      if($qu_tariffix == null)$qu_tariffix_value = 0;
      $tarifvar=$qu_tariffix_value*$kurs;
      // if ($kapalsGrt<=14000)$tarifvar=0.005*$kurs;
      // else if ($kapalsGrt<=40000)$tarifvar=0.004*$kurs;
      // else if ($kapalsGrt>40000)$tarifvar=0.002*$kurs;
    } else {
      $tarifvar=$qu_tarifvar->value;
      // $tarifvar=3.30;
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

  public static function cek_libur($day,$n,$status='false'){
    $day1=24*60*60;

    if ($n<0){
      return $day-$day1;
    } else {

      $libnas = DB::table('tb_libur')
      ->where(function ($query) use ($day){
        $query->where('tgllibur',$day);
      })
      ->get();
      if (!empty($libnas[0]) || date('N', $day)==6 || date('N', $day)==7 ){
        $n++;
      }
      $day = $day+$day1;

      $n--;
      return self::cek_libur($day,$n,$status);
    }
    return $day;
  }
}
