<?php

namespace App\Helpers;
use App\Models\libur;
use App\Models\jshift;
use App\Models\absen;
use App\Models\cuti;
use App\Models\spd;

class AbsenHelpers {

    public static function AbsenKosongNonSift($value) {
        if ($value['jmasuk'])   $ke=$value['jmasuk'];   else $ke='00:00';
        if ($value['jkeluar'])  $ku=$value['jkeluar'];  else $ku='00:00';

        //menentukan tabel sudah dibuat agar menjadi variabel tabel tidak dibuat lagi
        //menjadi id jika libur terditeksi selanjutnya agar tabel absen menghapus cell
        $cek2 = absen::where('id_u', '=', $value['userid'])
          ->where('date','=', $value['hari'])
          ->first();

        $cekcuti = cuti::where('id_u', '=', $value['userid'])
            ->where('sdate', '<=', $value['hari'])
            ->where('edate', '>=', $value['hari'])
            ->first();

        $cekspd = spd::where('id_u', '=', $value['userid'])
            ->where('sdate', '<=', $value['hari'])
            ->where('edate', '>=', $value['hari'])
            ->first();

        if ($cekcuti['id']){
            $hadir=0;
            $status=4;
            $ket=$cekcuti['ket'];
        } else if ($cekspd['id']){
            $hadir=0;
            $status=5;
            $ket=$cekspd['ket'];
        }else {
            $hadir=0;
            $status=0;
            $ket='';
        }

        if ($cek2['ubah']!=1){
          $datanya=array(
              'jmasuk'    =>$ke,
              'jkeluar'   =>$ku,
              'odate'     =>0,
              'idate'     =>0,
              'hadir'     =>$hadir,
              'status'    =>$status,
              'ket'       =>$ket,
              'id_u'      =>$value['userid'],
              'date'      =>$value['hari'],
              'updated_at' =>date("Y-m-d H:i:s")
          );
      } else {
          $datanya=array(
              'jmasuk'    =>$ke,
              'jkeluar'   =>$ku,
              'updated_at' =>date("Y-m-d H:i:s")
          );
      }

      $libur = libur::where('tgllibur','=', $value['hari'])->first(); // cek libur nasional
      $weekend=date('N',$value['hari']);                  //var hari dalam nomer -> buat cek weekend

      if ($weekend!=7 AND $weekend!=6 AND !$libur['id']){
          if ($cek2['id']) absen::where('id', $cek2['id'])->update($datanya); else absen::insert($datanya);
      }

      if ($libur['id']){
          if ($cek2['ubah']==0)absen::destroy($cek2['id']);
      }
      $responce['status']=$cek2['ubah'];

      return  $responce;
    }

    public static function AbsenKosongSift($value) {
        if ($value['jmasuk'])$ke=$value['jmasuk'];else $ke='00:00';
        if ($value['jkeluar'])$ku=$value['jkeluar'];else $ku='00:00';

        //menentukan tabel sudah dibuat agar menjadi variabel tabel tidak dibuat lagi
        $cek2 = absen::where('id_u', '=', $value['userid'])
            ->where('date','=', $value['hari'])
            ->where('jmasuk','=', $ke)
            ->first();

        if ($cek2['ubah']!=1){
                $datanya=array(
                    'jmasuk'    =>$ke,
                    'jkeluar'   =>$ku,
                    'odate'     =>0,
                    'idate'     =>0,
                    'id_u'      =>$value['userid'],
                    'date'      =>$value['hari'],
                    'updated_at' =>date("Y-m-d H:i:s")
                );
            } else {
                $datanya=array(
                    'jmasuk'    =>$ke,
                    'jkeluar'   =>$ku,
                    'updated_at' =>date("Y-m-d H:i:s")
                );
            }

            if ($cek2['id']){
                absen::where('id', $cek2['id'])->update($datanya);
            } else {
                absen::insert($datanya);
            }
            $responce['arrayjkerja']=$ke;
            $responce['status']='absen kosong';
        return  $responce;
    }

    public static function AbsenIsiNonSift($value) {

        //menentukan tabel sudah dibuat agar menjadi variabel tabel tidak dibuat lagi
        //menjadi id jika libur terditeksi selanjutnya agar tabel absen menghapus cell
        $cek2 = absen::where('id_u', $value['userid'])
            ->where('date', $value['hari'])
            ->first();

        $cekcuti = cuti::where('id_u', '=', $value['userid'])
            ->where('sdate', '<=', $value['hari'])
            ->where('edate', '>=', $value['hari'])
            ->first();

        $cekspd = spd::where('id_u', '=', $value['userid'])
            ->where('sdate', '<=', $value['hari'])
            ->where('edate', '>=', $value['hari'])
            ->first();

        if ($cekcuti['id']){
            $hadir=0;
            $status=4;
            $ket=$cekcuti['ket'];
        } else if($cekspd['id']){
            $hadir=0;
            $status=5;
            $ket=$cekspd['ket'];
        } else {
            $hadir=1;
            $status=0;
            $ket='';
        }

        $rmasuk = strtotime(date('Y-m-d '.$cek2['jmasuk'],$value['hari']));
        $rkeluar= strtotime(date('Y-m-d '.$cek2['jkeluar'],$value['hari']));

        if ($cek2['ubah']!=1){

            if ($value['tc']>($rmasuk-(2*60*60)) AND $value['tc']<($rmasuk+(2*60*60)) ){
                $datanya=array(
                    'idate'     =>$value['tc'],
                    'hadir'     =>$hadir,
                    'status'    =>$status,
                    'ket'       =>$ket,
                    'updated_at' =>date("Y-m-d H:i:s")
                );
            }
            if ($value['tc']>($rkeluar-(2*60*60)) AND $value['tc']<($rkeluar+(2*60*60)) ){
                $datanya=array(
                    'odate'     =>$value['tc'],
                    'hadir'     =>$hadir,
                    'status'    =>$status,
                    'ket'       =>$ket,
                    'updated_at' =>date("Y-m-d H:i:s")
                );
            }
        }

        if (!(empty($datanya))) if ($cek2['id']) absen::where('id', $cek2['id'])->update($datanya);
        $masuk='isi tabel Non Sift';
        $responce['status']=$masuk;
        return  $responce;
    }

    public static function AbsenIsiSift($value) {
        if ($value['jmasuk'])$ke=$value['jmasuk'];else $ke='00:00';
        if ($value['jkeluar'])$ku=$value['jkeluar'];else $ku='00:00';

        //menentukan tabel sudah dibuat agar menjadi variabel tabel tidak dibuat lagi
        //menjadi id jika libur terditeksi selanjutnya agar tabel absen menghapus cell
        $cek2 = absen::where('id_u', '=', $value['userid'])
            ->where('date','=', $value['hari'])
            ->where('jmasuk','=', $ke)
            ->first();
        $rop1=$value['indexjkerja'];
        //-----------------------------------------------> cek tanggal ini cuti atau tidak
        $cekcuti = cuti::where('id_u', '=', $value['userid'])
            ->where('sdate', '<=', $value['hari'])
            ->where('edate', '>=', $value['hari'])
            ->first();
        $libur = libur::where('tgllibur','=', $value['hari'])->first(); // cek libur nasional

        if ($cekcuti['id']){
            $hadir=0;
            $status=4;
            $ket=$cekcuti['ket'];
        } else if ($libur['id']){
            $hadir=1;
            $status=7;
            $ket=$libur['ket'];
        } else {
            $hadir=1;
            $status=0;
            $ket='';
        }

        $rmasuk = strtotime(date('Y-m-d '.$cek2['jmasuk'],$value['hari']));
        $rkeluar= strtotime(date('Y-m-d '.$cek2['jkeluar'],$value['hari']));

        if ($cek2['ubah']!=1){
            $rop='luar';
            if ($value['tc']>($rmasuk-(2*60*60)) AND $value['tc']<($rmasuk+(2*60*60)) ){
                $rop=$cek2['id'].'=>'.date('d-m-Y h:i',$value['tc']);
                $datanya=array(
                    'idate'     =>$value['tc'],
                    'hadir'     =>$hadir,
                    'status'    =>$status,
                    'ket'       =>$ket,
                    'updated_at' =>date("Y-m-d H:i:s")
                );
            }
            if ($value['tc']>($rkeluar-(2*60*60)) AND $value['tc']<($rkeluar+(2*60*60)) ){
                $rop=$cek2['id'].'=>'.date('d-m-Y h:i',$value['tc']);
                $datanya=array(
                    'odate'     =>$value['tc'],
                    'hadir'     =>$hadir,
                    'status'    =>$status,
                    'ket'       =>$ket,
                    'updated_at' =>date("Y-m-d H:i:s")
                );
            }
        }

        if ($cekcuti['id']){
          $datanya=array(
              'hadir'     =>$hadir,
              'status'    =>$status,
              'ket'       =>$ket,
              'updated_at' =>date("Y-m-d H:i:s")
          );
        }

        if (!(empty($datanya))) if ($cek2['id']) absen::where('id', $cek2['id'])->update($datanya);
        $responce['jam']=$rop1;
        //$masuk='isi tabel Non Sift';
       // $responce['status']=$masuk;
        return  $responce;
    }

}
