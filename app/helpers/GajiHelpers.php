<?php
namespace App\Helpers;
date_default_timezone_set('Asia/Jakarta');

// use App\Models\pkoperasi;
use App\Models\pegawai;
use App\Models\mrawatjalan;
use App\Models\mrawatjalan2;
use App\Models\fasilitas;
use App\Models\potongan;
use App\Models\upah;
use App\Models\koperasi;
use App\Models\pkoperasi;
use App\Models\absen;
use App\Models\cuti;
// use App\Models\pfg;
use App\Models\variabel2;

use DB;


class GajiHelpers {
    public static function upah($id_u,$jenis,$waktu) {
        $nilai= upah::where('jenis',$jenis)
            ->where('id_u',$id_u)
            ->where('berlaku','<=',strtotime($waktu))
            ->orderBy('berlaku','desc')
            ->first();

        return $nilai['nilai'];
    }

    public static function upah2($id_u,$jenis,$waktu) {
        $nilai= DB::table('tb_upah2')->where('jenis',$jenis)
            ->where('id_u',$id_u)
            ->where('berlaku','<=',strtotime($waktu))
            ->orderBy('berlaku','desc')
            ->first();

        if ($nilai)$value=$nilai->nilai; else $value=0;
        return $value;
    }

    public static function potongan($id_u,$jenis,$waktu) {
        $nilai= potongan::where('jenis',$jenis)
            ->where('id_u',$id_u)
            ->where('berlaku','<=',strtotime($waktu))
            ->orderBy('berlaku','desc')
            ->first();

        return $nilai['nilai'];
    }

    public static function rupah($id_u,$start,$end) {

        $responce['pokok']      = self::upah($id_u,'pokok',$start);
        $responce['honor']      = self::upah($id_u,'honor',$start);
        $responce['perum']      = self::upah($id_u,'perum',$start);
        $responce['jabatan']    = self::upah($id_u,'jabatan',$start);
        $responce['pandu']      = self::upah($id_u,'pandu',$start);
        $responce['profesi']    = self::upah($id_u,'profesi',$start);
        $responce['bkerja']     = self::upah($id_u,'bkerja',$start);
        $responce['umakan']     = self::upah($id_u,'umakan',$start)*self::rabsen($id_u,$start,$end)['hkerja'];
        $responce['utransport'] = self::upah($id_u,'utransport',$start)*self::rabsen($id_u,$start,$end)['hkerja'];
        $responce['lembur']     = self::upah($id_u,'lembur',$start);
        $responce['bcuti']      = self::upah($id_u,'bcuti',$start);
        $responce['kbl']        = self::upah($id_u,'kbl',$start);
        $responce['tkendaraan'] = self::upah($id_u,'tkendaraan',$start);
        $responce['bbm']        = self::upah($id_u,'bbm',$start);
        $responce['pkendaraan'] = self::upah($id_u,'pkendaraan',$start);

        $responce['tshift']     = self::htshift($id_u,$start,$end)['tshift'];

        $responce['st'] = $responce['pokok']+$responce['honor']+
            $responce['perum']+$responce['jabatan']+$responce['pandu']+
            $responce['profesi']+$responce['bkerja']+$responce['umakan']+
            $responce['utransport']+$responce['lembur']+$responce['bcuti']+
            $responce['kbl']+$responce['tkendaraan']+
            $responce['bbm']+$responce['pkendaraan']+self::htshift($id_u,$start,$end)['tshift'];

        return $responce;
    }

    public static function rpotongan($id_u,$start,$end) {

        $responce['bjb']        = self::potongan($id_u,'bjb',$start);
        $responce['kendaraan']  = self::potongan($id_u,'kendaraan',$start);
        $responce['absen']      = self::potongan($id_u,'absen',$start);
        $responce['pph21']      = self::potongan($id_u,'pph21',$start);
        $responce['lbl']        = self::potongan($id_u,'lbl',$start);

        $responce['sp'] = $responce['bjb']+$responce['kendaraan']+$responce['absen']+$responce['pph21']+$responce['lbl']+
        self::baziz($id_u,$start)['total']+self::tkoperasi($id_u,$start)['total']+
        self::dplk($id_u,$start)['karyawan']+self::bpjsker($id_u,$start)['karyawan']+self::bpjskes($id_u,$start)['karyawan'];

        //if (self::rupah($id_u,$start,$end)['st']>$responce['sp'] ) $responce['terima'] = self::rupah($id_u,$start,$end)['st']-$responce['sp']; else $responce['terima'] =0;
        return $responce;
    }

    public static function rabsen($id_u,$start,$end) {
        $query=absen::where('tb_absen.id_u', '=', $id_u)
            ->where('tb_absen.date', '>=', strtotime($start))
            ->where('tb_absen.date', '<=', strtotime($end))
            ->get();
        $responce['hkerja']=0;
        $responce['shift1']=$responce['shift2']=$responce['shift3']=0;
        foreach ($query as $row) {
            if ($row->hadir == 1){
                $responce['hkerja']++;
                if ($row->jmasuk=='00:00')$responce['shift1']++;
                if ($row->jmasuk=='08:00')$responce['shift2']++;
                if ($row->jmasuk=='16:00')$responce['shift3']++;
            }
        }
        $responce['tshift1']=$responce['shift1']*25000;
        $responce['tshift3']=$responce['shift3']*15000;
        $responce['tshift']=$responce['tshift1']+$responce['tshift3'];
        return $responce;
    }

    public static function htshift($id_u,$start,$end) {
        $start = strtotime($start);
        $end = strtotime($end);

        $query=absen::where('tb_absen.id_u', '=', $id_u)
            ->where('tb_absen.hadir', 1)
            ->where('tb_absen.date', '>=', $start)
            ->where('tb_absen.date', '<=', $end)
            ->get();

        $cek=pegawai::where('id', '=', $id_u)
            ->first();

        if ($cek['jabatan']==10){
            $s1 = variabel2::where('berlaku','<=',$start)
                ->where('jenis','dispatcher_s1')
                ->orderBy('berlaku','desc')
                ->first();
            $s3= variabel2::where('berlaku','<=',$start)
                ->where('jenis','dispatcher_s3')
                ->orderBy('berlaku','desc')
                ->first();
        } else {
            $s1 = variabel2::where('berlaku','<=',$start)
                ->where('jenis','driver_s1')
                ->orderBy('berlaku','desc')
                ->first();
            $s3= variabel2::where('berlaku','<=',$start)
                ->where('jenis','driver_s3')
                ->orderBy('berlaku','desc')
                ->first();
        }

        $responce['shift1']=$responce['shift2']=$responce['shift3']=0;
        foreach ($query as $row) {
            if ($row->jmasuk=='00:00')$responce['shift1']++;
            if ($row->jmasuk=='08:00')$responce['shift2']++;
            if ($row->jmasuk=='16:00')$responce['shift3']++;
        }
        $responce['tshift1']=$responce['shift1']*$s1['nilai'];
        $responce['tshift3']=$responce['shift3']*$s3['nilai'];
        $responce['tshift']=$responce['tshift1']+$responce['tshift3'];
        $responce['test']=$id_u;
        return $responce;
    }


    public static function koperasi($id_u,$jenis,$waktu) {
        $nilai= koperasi::where('jenis',$jenis)
            ->where('id_u',$id_u)
            ->where('berlaku','<=',strtotime($waktu))
            ->orderBy('berlaku','desc')
            ->first();

        return $nilai['nilai'];
    }
    public static function pkoperasi($id_u,$waktu) {

        $koperasi=pkoperasi::where('id_u',$id_u)
            ->orderBy('tglapp', 'desc')
            ->first();
        if ($koperasi){
            $responce['selisih']=AppHelpers::selisihhbt(date('d F Y',$koperasi['tglapp']),$waktu,'month');

            $responce['stenor']=$koperasi['tenor']-$responce['selisih'];
            if ($responce['stenor']<0)$responce['stenor']=0;

            $responce['angsur']=$koperasi['jmlplus']/$koperasi['tenor'];
            $responce['sangsur']=$responce['angsur']*$responce['stenor'];
        } else {
            $responce['angsur']=0;
        }

        return  $responce;
    }
    public static function tkoperasi($id_u,$waktu) {

        $responce['pokok']      = self::koperasi($id_u,'pokok',$waktu);
        $responce['wajib']      = self::koperasi($id_u,'wajib',$waktu);
        $responce['sukarela']   = self::koperasi($id_u,'sukarela',$waktu);
        $responce['mppa']       = self::koperasi($id_u,'mppa',$waktu);
        $responce['el']         = self::koperasi($id_u,'el',$waktu);
        $responce['w']          = $waktu;

        $responce['total'] = $responce['pokok']+$responce['wajib']+$responce['sukarela']+$responce['mppa']+$responce['el']+self::pkoperasi($id_u,$waktu)['angsur'];

        return  $responce;
    }

    public static function baziz($id_u,$start) {
        $upah= self::upah($id_u,'pokok',$start)+self::upah($id_u,'honor',$start);

        $responce['total'] = $upah*(2.5/100);
        return  $responce;
    }

    public static function dplk($id_u,$start) {
        $gajipokok= self::upah($id_u,'pokok',$start)+self::upah($id_u,'honor',$start);
        $responce['dplk']=$gajipokok*(15/100);
        $responce['perusahaan']=$responce['dplk']*(60/100);
        $responce['karyawan'] = $responce['dplk']*(40/100);
        $responce['total'] = $responce['perusahaan']+$responce['karyawan'];
        return  $responce;
    }

    public static function bpjsker($id_u,$start,$end) {
        $cek = DB::table('tbl_datapegawai')
            ->where('id',$id_u)
            ->where('divisi',9)
            ->first();
        if (self::upah2($id_u,'ck-aktif',$start) == 1){
            if ($cek){
                $responce['ttunjangan'] =
                    self::upah2($id_u,'tmakan',$start)+
                    self::upah2($id_u,'ttransport',$start)+
                    self::upah2($id_u,'tbbm',$start)+
                    self::upah2($id_u,'tpp',$start)+
                    self::rupah($id_u,$start,$end)['st'];
            } else {
                $responce['ttunjangan'] =
                    self::upah2($id_u,'tmakan',$start)+
                    self::upah2($id_u,'ttransport',$start)+
                    self::upah2($id_u,'tbbm',$start)+
                    self::upah2($id_u,'tpp',$start)+
                    self::rupah($id_u,$start,$end)['pokok']+
                    self::rupah($id_u,$start,$end)['perum']+
                    self::rupah($id_u,$start,$end)['jabatan']+
                    self::rupah($id_u,$start,$end)['tshift'];
            }

        } else {
            $responce['ttunjangan'] =
                self::upah($id_u,'pokok',$start)+
                self::upah($id_u,'honor',$start)+
                self::upah($id_u,'perum',$start)+
                self::upah($id_u,'jabatan',$start);
        }

        $responce['jkm']  = $responce['ttunjangan']*(0.30/100);
        $responce['jkk']  = $responce['ttunjangan']*(0.89/100);
        $responce['jhtk'] = $responce['ttunjangan']*(2/100);
        $responce['jhtp'] = $responce['ttunjangan']*(3.70/100);
        $responce['jpk']  = $responce['ttunjangan']*(1/100);
        $responce['jpp']  = $responce['ttunjangan']*(2/100);

        $responce['karyawan'] = $responce['jhtk']+$responce['jpk'];

        $responce['tbpjskk'] =
            $responce['jkm']+
            $responce['jkk']+
            $responce['jhtk']+
            $responce['jhtp']+
            $responce['jpk']+
            $responce['jpp'];

        return  $responce;
    }
    public static function bpjskes($id_u,$start) {
        $cek = potongan::where('jenis','ck-bpjskes')
            ->where('nilai','on')
            ->where('id_u',$id_u)
            ->where('berlaku','<=',strtotime($start))
            ->orderBy('berlaku','desc')
            ->first();

        if ($cek){

            $responce['tgaji'] = self::upah($id_u,'pokok',$start)+self::upah($id_u,'honor',$start)+self::upah($id_u,'perum',$start);
            $responce['itung'] = $responce['tgaji'];
            if ($responce['tgaji']>=8000000)$responce['itung']=8000000;
            if ($responce['tgaji']<=4000000)$responce['kls']=2;else $responce['kls']=1;

            $responce['perusahaan'] = ($responce['itung']/100)*4;
            $responce['karyawan'] = ($responce['itung']/100)*1;
            $responce['tiuran'] = ($responce['itung']/100)*5;

        } else {

            $responce['tgaji'] = 0;
            $responce['itung'] = 0;
            $responce['kls']='-';
            $responce['perusahaan'] = 0;
            $responce['karyawan'] = 0;
            $responce['tiuran'] = 0;
        }
        return  $responce;
    }

    //Rawat Jalan
    public static function sisaRj($id_u,$tgl) {
        $query2 = mrawatjalan2::where('id_u', $id_u)
          ->where('tgldoc', '<', $tgl)
          ->where('no', 'like', date('y',$tgl).'/%')
          ->get();
        $total=$test=0;
        foreach($query2 as $row2) {
          $total=($row2->debit+$total);
          //$test=$tgl;
        }

        $platform = mrawatjalan::where('id_u', $id_u)
          ->where('platform', 'like', date('y',$tgl).'/%')
          ->first();

        $responce['platform'] = AppHelpers::extractNilai($platform['platform'])['n1'];
        $responce['total'] = AppHelpers::extractNilai($platform['platform'])['n1']-$total;


        return  $responce;
    }

    //cuti
    public static function sisaCuti($id_u,$tgl) {
        $jatah = fasilitas::where('id_u', '=', $id_u)
            ->where('cutitahun', 'like', date('y',$tgl).'/%')
            ->first();
        $query2 = cuti::where('tb_cuti.id_u', '=', $id_u)
            ->join('tbl_datapegawai','tb_cuti.id_u', '=', 'tbl_datapegawai.id')
            ->where('tb_cuti.sdate', '<=', $tgl)
            ->where('tb_cuti.no', 'like', date('y',$tgl).'/%')
            ->get();

        $total=$jmlct=0;
        foreach($query2 as $row) {
            if ($row->wkerja == 0){
              $jmlct = AppHelpers::hitungcuti(date('d-m-Y', $row->sdate),date('d-m-Y', $row->edate),'-');
            } else if($row->wkerja == 1){
              $jmlct = AppHelpers::hitungcutishift(date('d-m-Y', $row->sdate),date('d-m-Y', $row->edate),'-',$id_u);
            }
            $total = $jmlct+$total;
        }

        $responce['jatah'] = AppHelpers::extractNilai($jatah['cutitahun'])['n1'];
        $responce['pakai'] = $jmlct;
        $responce['total'] = AppHelpers::extractNilai($jatah['cutitahun'])['n1']-$total;
        return  $responce;
    }
    public static function test() {
      $responce = 'test';
      return  $responce;
    }
}
