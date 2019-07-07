<?php

namespace App\Http\Controllers\Kepegawaian;
date_default_timezone_set('Asia/Jakarta');

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\AppHelpers;
use App\Helpers\AbsenHelpers;
use App\Helpers\GajiHelpers;

use App\user;
use App\Models\pegawai;
use App\Models\cuti;
use App\Models\spd;
use App\Models\kk1;
use App\Models\kk2;
use App\Models\jnmshift;
use App\Models\jshift;
use App\Models\jshiftopt;
use App\Models\absen;
use App\Models\variabel;
use App\Models\fasilitas;
use App\Models\mrawatjalan;
use App\Models\mrawatjalan2;
use App\Models\jamkerja;

use App\Models\diagnos;
use App\Models\libur;

use DB;
use Auth;



class KepegawaianApiController extends Controller
{
  public function cud(Request $request){
    $datatb = $request->input('datatb', '');
    $oper = $request->input('oper');
    $id = $request->input('id');

    switch ($datatb) {
      case 'newuser':
        DB::beginTransaction();
        $status=$userbaru['id'] = 'data salah';
        try {
          $datanya=array(
              'name' => $request->input('nama'),
              'email' => $request->input('email'),
              'password' => bcrypt($request->input('password')),
              'created_at' =>date("Y-m-d H:i:s"),
              'updated_at' =>date("Y-m-d H:i:s")
          );
          User::insert($datanya);

          $userbaru = User::where('email',$request->input('email'))
            ->first();

          $datatambah1=array(
              'id' => $userbaru['id'],
              'nokk'=>'',
              'alamat'=>'',
              'goldar'=>'',
              'updated_at' =>date("Y-m-d H:i:s")
          );
          kk1::insert($datatambah1);
          $datakk2=array(
              'id_u' => $userbaru['id'],
              'hub' => 'karyawan',
              'jk' => '',
              'dob'=>'0',
              'hp'=>'',
              'nama'=> $request->input('nama'),
              'updated_at' =>date("Y-m-d H:i:s")
          );
          kk2::insert($datakk2);
          $datatambah3=array(
              'id_u' => $userbaru['id'],
              'platform' => '19/0',
              'updated_at' =>date("Y-m-d H:i:s")
          );
          mrawatjalan::insert($datatambah3);
          $datatambah4=array(
              'id' => $userbaru['id'],
              'tmb' =>0,
              'aktif' =>1,
              'updated_at' =>date("Y-m-d H:i:s")
          );
          pegawai::insert($datatambah4);

          DB::commit();

          $status = 'success';
        } catch (\Exception $e) {
          DB::rollback();
          $status = $e;
        }

        $responce = array(
            'status' => $status,
            'msg' => 'ok',
            'id' => $userbaru['id'],
        );
      break;
      case 'formdapeg':
        DB::beginTransaction();
        $status = '';
        try {
          $datakk1=array(
            'nokk'      => $request->input('nokk'),
            'alamat'    => $request->input('alamat'),
            'goldar'    => $request->input('goldar'),
            'keldekat'  => $request->input('keldekat'),
            'keltlp'    => $request->input('keltlp')
          );
          kk1::where('id', $id)->update($datakk1);

          $datakk2=array(
            'nama'  => $request->input('namal'),
            'jk'    => $request->input('jk'),
            'dob'   => strtotime($request->input('dob')),
            'hp'    => $request->input('keldekat'),
          );
          kk2::where('id_u', $id)->where('hub', 'karyawan')->update($datakk2);

          $rekbank=$request->input('bank')."-".$request->input('norek');
          $pendidikan=$request->input('pendidikan')."-".$request->input('jurusan');

          if (strtotime($request->input('tkb')))$aktif = 0;else $aktif = 1;

          $pegawai=array(
            'nip'       => $request->input('nip'),
            'idabsen'   => $request->input('idabsen'),
            'status_pegawai' => $request->input('sts',0),
            'tmb'       => strtotime($request->input('tmb')),
            'tkb'       => strtotime($request->input('tkb')),
            'jabatan'   => $request->input('jabatan'),
            'divisi'    => $request->input('divisi'),
            'wkerja'    => $request->input('wkerja',0),
            'rekbank'   => $rekbank,
            'pendidikan'=> $pendidikan,
            'aktif'     => $aktif,
          );
          pegawai::where('id', $id)->update($pegawai);

          DB::commit();

          $status = 'berhasil';
        } catch (\Exception $e) {
          DB::rollback();
          $status = $e;
        }

        $responce = array(
            'status' => $status,
            'msg' => 'ok',
        );
      break;
      case 'dtkeluarga':
        $datakk2=array(
          'id_u'  => $request->input('id_u'),
          'nama'  => $request->input('nama'),
          'jk'    => $request->input('jk'),
          'hub'   => $request->input('hub'),
          'dob'   => strtotime($request->input('dob')),
          'agama' => $request->input('agama'),
          'updated_at' => date("Y-m-d H:i:s")
        );

        if ($oper=='add')kk2::insert($datakk2);
        if ($oper=='edit')kk2::where('id', $id)->where('hub','!=','karyawan')->update($datakk2);
        if ($oper=='del')kk2::destroy($id);
        $responce = array(
            'status' => 'success',
            'msg' => 'ok',
        );
      break;
      case 'dct':
          $str=explode('/', $request->input('no'));
          if ($oper!='del'){
              $datanya=array(
                  'no'=>$str[1].'/'.$str[0],
                  'id_u'=>$request->input('id_u'),
                  'jeniscuti'=>$request->input('jcuti','2'),
                  'sdate'=>strtotime($request->input('sdate','')),
                  'edate'=>strtotime($request->input('edate','')),
                  'ket'=>$request->input('ket',''),
                  'updated_at' =>date("Y-m-d H:i:s")
              );
          }
          if ($request->input('ujc')=='on'){
              $cek = fasilitas::where('cutitahun', 'like', $str[1].'/%')
                  ->where('id_u','=',$request->input('id_u'))
                  ->first();
              $dataf =array(
                  'id_u'          =>$request->input('id_u'),
                  'cutitahun'     =>$str[1].'/'.$request->input('jthcuti'),
                  'updated_at'    =>date("Y-m-d H:i:s")
              );

              if (empty($cek)){
                  fasilitas::insert($dataf);
              } else {
                  fasilitas::where('id_u', $request->input('id_u'))
                      ->where('cutitahun','like',$str[1].'/%')
                      ->update($dataf);
              }
          }

          if ($oper=='add')cuti::insert($datanya);
          if ($oper=='edit')cuti::where('id', $id)->update($datanya);
          if ($oper=='del')cuti::destroy($id);
          $response = array(
              'status' => 'success',
              'msg' => 'ok',
          );
          return $response;
      break;
      case 'wspd':
          $str=explode('/', $request->input('no'));
          if ($oper!='del'){
              $datanya=array(
                  'no'=>$str[1].'/'.$str[0],
                  'id_u'=>$request->input('id_u'),
                  'sdate'=>strtotime($request->input('sdate','')),
                  'edate'=>strtotime($request->input('edate','')),
                  'ket'=>$request->input('ket',''),
                  'updated_at' =>date("Y-m-d H:i:s")
              );
          }

          if ($oper=='add')spd::insert($datanya);
          if ($oper=='edit')spd::where('id', $id)->update($datanya);
          if ($oper=='del')spd::destroy($id);
          $response = array(
              'status' => 'success',
              'msg' => 'ok',
          );
          return $response;
      break;
      case 'rjr':
          $no = explode("/",$request->input('no'));
          $str = str_replace(',', '', $request->input('debit',''));
          $tgldoc = strtotime($request->input('tgldoc')) ;
          $tglkw = $request->input('tglkw');

          $cekfill =  mrawatjalan2::where('id_u', $request->input('id_u'))
            ->where('tgldoc','like',substr($tgldoc,0,8).'%')
            ->orderBy('tgldoc', 'desc')
            ->first();

          //if ($cekfill->tgldoc) $tgldoc = $cekfill->tgldoc + 1;

          //dd($tgldoc);

          $datanya=array(
              'no'    =>$no[1].'/'.$no[0],
              'tgldoc'=>$tgldoc+$request->input('prefx'),
              'id_u'  =>$request->input('id_u'),
              'id_p'  =>$request->input('id_p'),
              'tgl'   =>strtotime($request->input('tglkw')),
              'uraian'=>$request->input('ket'),
              'debit' =>$str,
              'updated_at' =>date("Y-m-d H:i:s")
          );

          $diagnos = explode(",", $request->input('ket'));
          foreach($diagnos as $element)
          {
              $q = diagnos::where('ket','=',trim($element))
                  ->first();
                  if (!$q['ket'])diagnos::insert(array('ket'=>trim($element),'updated_at' =>date("Y-m-d H:i:s")));
          }
          if ($request->input('rj')){
              $cekdb = DB::table('tb_mrawatjalan')
                  ->where('id_u', $request->input('id_u'))
                  ->where('platform','like', $no[1].'%')
                  ->first();

              $platform = array(
                  'id_u'      =>$request->input('id_u'),
                  'platform'  =>$no[1].'/'.str_replace(',', '', $request->input('rj')),
                  'updated_at'=>date("Y-m-d H:i:s")
              );
              if ($cekdb){
                $update = DB::table('tb_mrawatjalan')
                  ->where('id', $cekdb->id)
                  ->update($platform);
              } else {
                DB::table('tb_mrawatjalan')->insert($platform);
              }
          }


          if ($oper=='add')   DB::table('tb_mrawatjalan2')->insert($datanya);
          if ($oper=='edit')  DB::table('tb_mrawatjalan2')->where('id', $id)->update($datanya);
          if ($oper=='del')   DB::table('tb_mrawatjalan2')->destroy($id);

          $response = array(
              'status' => 'success',
              'msg' => 'ok',
          );
          return $response;
      break;
      case 'jadwalshift':
          $datanya=array(
              'waktu'     =>$request->input('waktu')/1000,
              'jwaktu'    =>$request->input('jwaktu'),
              'petugas'   => $request->input('petugas'),
          );

          $cek1 = jshift::where('waktu',$request->input('waktu'))
              ->first();
          if ($cek1['waktu'])$oper='edit';

          if ($oper=='add')jshift::insert($datanya);
          //if ($oper=='edit')jshift::where('id', $id)->update($datanya);
          if ($oper=='del')jshift::destroy($id);

          $response = array(
              'status' => 'Succcess',
              'msg' => date('Y-m-d', ($request->input('waktu')/1000)),
          );
          return $response;
      break;
      case 'jshiftopt':
          foreach( $request->input('idu') as $id ) {
              $datanya=array(
                  'id_u' => $request->input('idu')[$id],
                  'inisial' => $request->input('inisial')[$id],
                  'warna' => $request->input('w')[$id],
                  'updated_at' =>date("Y-m-d H:i:s"),
              );

              $q = jshiftopt::where('id_u',$id)->count();

              if($q==0){
                  jshiftopt::insert($datanya);
              } else {
                  jshiftopt::where('id_u', $id)->update($datanya);
              }

              $response = array(
                  'status' => 'berhasil',
                  //'msg' => json_encode($absen).'-> '.$ds,
                  'msg' => $q,
              );
          }
          return $response;
      break;
      case 'absen2':
        $msg = '';
        $db = "D:/dbatt/attBackup.mdb";
        if(!file_exists($db)) $msg='data tidak ditemukan';

        $con_acs = new \PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".$db."; Uid=; Pwd=;");

        $start  = strtotime($request->input('start'));
        $end    = strtotime($request->input('end'));

        $query = pegawai::where('tbl_datapegawai.idabsen','!=','')
          //->join('tb_kk2','tbl_datapegawai.id', '=', 'tb_kk2.id_u')
          //->where('tb_kk2.hub','=','karyawan')
          ->where('tbl_datapegawai.aktif', 1)
          ->get();//pilih seluruh karyawan

        // $ds=0;
        $array=$arrayjamkerja=array();

        foreach($query as $row) {

          //----------------------------------------------> Start Cek Cuti
          $cekcuti = cuti::where('id_u','=',$row->id)
            ->whereBetween('sdate', [$start, $end])->get();
          $arraycuti=array();
          foreach($cekcuti as $cekcuti) {
            for($harinya=$cekcuti->sdate;$harinya<=$cekcuti->edate;$harinya=$harinya+(24*60*60)){
              $arraycuti[] = $harinya;
            }
          }
          //----------------------------------------------> end Cek Cuti

          //convert idabsen
          $sqlid = "select * from USERINFO WHERE Badgenumber='".$row->idabsen."'";
          $qryid = $con_acs->query($sqlid);
          while($dtid = $qryid->fetch()) { $idatt =$dtid['USERID']; }

          for($harinya=$start;$harinya<=$end;$harinya=$harinya+(24*60*60)){ // pengulangan hari awal sampai hari akhir absen

            $qstart = date('Y-m-d',$harinya-(24*60*60));    //var hari dalam date
            $qend   = date('Y-m-d',$harinya+(48*60*60));    //var hari tambah 24jam

            // olah data kosong absen non shift
            if ($row->wkerja==0) {

              $jamkerja = jamkerja::where('id_jnmshift', '!=', '')
                ->where('berlaku', '<=', $harinya)
                ->orderBy('berlaku','desc')
                ->first();

              $apsenhelper['hari']    = $harinya;
              $apsenhelper['userid']  = $row->id;
              $apsenhelper['jmasuk']  = $jamkerja['jmasuk'];
              $apsenhelper['jkeluar'] = $jamkerja['jkeluar'];

              AbsenHelpers::AbsenKosongNonSift($apsenhelper); //--------------------------> absen kosong


              //baca ms Acess berdasarkan id
              $sql = "select * from CHECKINOUT WHERE USERID=".$idatt." AND CHECKTIME BETWEEN {d '".$qstart."'} AND {d '".$qend."'} ORDER BY CHECKTIME DESC";
              $qry = $con_acs->query($sql);

              while($dt = $qry->fetch()){
                $apsenhelper['tc'] = strtotime($dt['CHECKTIME']); //timestamp waktu scan
//                AbsenHelpers::AbsenIsiNonSift($apsenhelper);      //---------> isi absen
                $msg = AbsenHelpers::AbsenIsiNonSift($apsenhelper)['status'];      //---------> isi absen
              }
            }

            if ($row->wkerja==1) {
              $cekabsen = absen::where('id_u', '=', $row->id) //--- cek diabsen sudah ada atau belum
                ->where('date','=', $harinya)
                ->where('ubah','!=', 1)
                ->get();

              $shiftindex= jshift::where('waktu','=',$harinya)->where('petugas','=', $row->id)
                ->orderBy('jwaktu', 'asc')
                ->get(); // mengantisipasi bila ada dalam satu hari 2 jam kerja agar masuk dalam log absen

              if(($cekabsen->count()!=0)AND($shiftindex->count()==0)){
                foreach($cekabsen as $cekabsen) {
                  absen::destroy($cekabsen->id);
                }
              }

              $apsenhelper['hari'] = $harinya;
              $apsenhelper['userid'] = $row->id;

              if (!(empty($shiftindex))){
                foreach($shiftindex as $index) {

                  $jamkerja = jamkerja::where('id_jnmshift', '=', $index->jwaktu)
                    ->where('berlaku', '<=', $harinya)
                    ->first();
                  $apsenhelper['jmasuk']=$jamkerja['jmasuk'];
                  $apsenhelper['jkeluar']=$jamkerja['jkeluar'];

                  $hasil = AbsenHelpers::AbsenKosongSift($apsenhelper); //--------------------------> absen kosong
                  $arrayjkerja[]=$hasil['arrayjkerja'];
                }

                if (!(empty($arrayjkerja))){
                  $hapus1 = absen::where('id_u', '=', $row->id)
                    ->where('date','=', $harinya)
                    ->whereNotIn('jmasuk', $arrayjkerja)
                    ->get();

                  foreach($hapus1 as $hapus1) {
                    absen::destroy($hapus1->id);
                  }
                }
                if (!(empty($shiftindex))){

                  foreach($shiftindex as $index) {
                     $jamkerja = jamkerja::where('id_jnmshift', '=', $index->jwaktu)
                      ->where('berlaku', '<=', $harinya)
                      ->first();
                    $apsenhelper['jmasuk']=$jamkerja['jmasuk'];
                    $apsenhelper['jkeluar']=$jamkerja['jkeluar'];

                    //baca ms Acess berdasarkan id
                    $sql = "select * from CHECKINOUT WHERE USERID=".$idatt." AND CHECKTIME BETWEEN {d '".$qstart."'} AND {d '".$qend."'}";
                    $qry = $con_acs->query($sql);

                    while($dt = $qry->fetch()){
                      $apsenhelper['indexjkerja']=$index->jwaktu;
                      $apsenhelper['tc'] = strtotime($dt['CHECKTIME']); //timestamp waktu scan
                      $hasil=AbsenHelpers::AbsenIsiSift($apsenhelper);  //-------------------> isi absen
                      $array[]=$hasil;
                    };
                  };
                }
              }
              if (in_array($harinya, $arraycuti)) {
                $apsenhelper['jmasuk']='';
                $apsenhelper['jkeluar']='';
                $apsenhelper['indexjkerja']='';
                $apsenhelper['tc']='';
                $hasilkosong=AbsenHelpers::AbsenKosongSift($apsenhelper);
                $hasilisi=AbsenHelpers::AbsenIsiSift($apsenhelper);
              }
            }
          }
        }

          $response = array(
              'status' => 'berhasil',
              //'msg' => json_encode($apsenhelper['userid']).'-> '.$ds,
              'msg' =>$msg,
              //'msg' => $xstart.'-> '.$xend.' Qry '.$ds,
              //'msg' => $qstart.'-> '.$qend.' Qry '.date('Y-m-d', $t).' '. $ke ,
          );

          return $response;
      break;
      case 'absen':
          if ($oper=='add'){
              $date = strtotime($request->input('tdate'));
              $idate = $request->input('idate');
              $odate = $request->input('odate');

              if($idate!='')$s1=strtotime(date('Y-m-d',$date).' '.$idate);else $s1=0;
              if($odate!='')$s2=strtotime(date('Y-m-d',$date).' '.$odate);else $s2=0;

              $datanya=array(
                  'id_u'  => $request->input('id_uu'),
                  'date'  => $date,
                  'jmasuk'=> $request->input('jmasuk'),
                  'jkeluar'=>$request->input('jkeluar'),
                  'idate' => $s1,
                  'odate' => $s2,
                  'hadir' => $request->input('hadir'),
                  'status'=> $request->input('status'),
                  'ubah'  => $request->input('ubah'),
                  'ket'   => $request->input('ket'),
                  'updated_at'=>date("Y-m-d H:i:s")
              );
              absen::insert($datanya);

              $response = array(
                  'status' => 'success',
                  'msg' => 'berhasil',
              );

              return $response;
          }

          if ($oper=='edit'){
              $cek2 = absen::where('id', '=',$request->input('id'))
                  ->first();

              $idate=$request->input('idate');
              $odate=$request->input('odate');
              if ($request->input('cki')!=1) $cki=0; else $cki=1;
              if ($request->input('cko')!=1) $cko=0; else $cko=1;
              if ($request->input('hadir')!=1) $hadir=0; else $hadir=1;
              if ($request->input('ubah')!=1) $ubah=0; else $ubah=1;

              if($idate!=0)$s1=strtotime(date('Y-m-d',$cek2['date']).' '. $idate);else $s1=0;
              if($odate!=0)$s2=strtotime(date('Y-m-d',$cek2['date']).' '. $odate);else $s2=0;

              $datanya=array(
                  'id'    => $request->input('id'),
                  'cki'   => $cki,
                  'idate' => $s1,
                  'cko'   => $cko,
                  'odate' => $s2,
                  'hadir' => $hadir,
                  'status'=> $request->input('status'),
                  'ubah'  => $ubah,
                  'ket'   => $request->input('ket')
              );
              absen::where('id', $id)->update($datanya);

              $response = array(
                  'status' => 'success',
                  'msg' => 'berhasil',
              );

              return $response;
          }
          if ($oper=='del')absen::destroy($id);
      break;
    }
    dd($request->input());
    return  Response()->json($responce);
  }

  public function jqgrid(Request $request){

    $datatb = $request->input('datatb', '');
    $cari = $request->input('cari', '0');

    $page = $request->input('page', '1');
    $limit = $request->input('rows', '10');
    $sord = $request->input('sord', 'asc');
    $sidx = $request->input('sidx', 'id');

// Menentukan Jumlah Query //
      switch ($datatb) {
        case 'dtkaryawan':  // Page SDM Data Karyawan
          $qu = pegawai::
            join('tb_kk2', function ($join) {
              $join->on('tb_kk2.id_u', 'tbl_datapegawai.id')
              ->where('tb_kk2.hub', 'karyawan');
            })

            ->leftJoin('tb_variabel as v1', function ($join) {
                $join->on('v1.vid', '=', 'tbl_datapegawai.jabatan')
                    ->where('v1.grup', '=', 'jabatan');
            })

            ->leftJoin('tb_variabel as v2', function ($join) {
                $join->on('v2.vid', '=', 'tbl_datapegawai.divisi')
                    ->where('v2.grup', '=', 'divisi');
            })

            ->leftJoin('users','users.id', '=', 'tbl_datapegawai.id')

            ->where(function ($qy) use ($request) {
              if ($request->input('id_u')){
                $qy->where('tb_kk2.id_u', $request->input('id_u'));
              }
            });

            $count = $qu->count();
        break;
        case 'dtkeluarga':  // Page SDM Data Karyawan
          $qu = kk2::where('id_u',$request->input('id_u'))
            ->where('hub','!=','karyawan')

            ->where(function ($qy) use ($request) {
              if ($request->input('id_u')){
                //$qy->where('tb_kk2.id_u', $request->input('id_u'));
              }
            });

            $count = $qu->count();
        break;
        case 'dct': // Page SDM Data Cuti

            $mulai = strtotime($request->input('start'));
            $akhir = strtotime($request->input('end'));

            $count = cuti::join('tb_kk2','tb_cuti.id_u', '=', 'tb_kk2.id_u')
                ->where('tb_kk2.hub','=','karyawan')
                ->where(function ($qy) use ($request) {
                  if ($request->input('id_u')){
                    $qy->where('tb_kk2.id_u', $request->input('id_u'));
                  }
                })
                ->count();
        break;
        case 'wspd': // Page SDM Data SPD
            $mulai = strtotime($request->input('start'));
            $akhir = strtotime($request->input('end'));

            $count = spd::join('tb_kk2','tb_spd.id_u', '=', 'tb_kk2.id_u')
                ->where('tb_kk2.hub','=','karyawan')
                ->where(function ($qy) use ($request) {
                  if ($request->input('id_u')){
                    $qy->where('tb_kk2.id_u', $request->input('id_u'));
                  }
                })
                ->count();
        break;
        case 'rjr': // rinci rawat

          $mulai = strtotime($request->input('start'));
          $akhir = strtotime($request->input('end'));

          $qu = mrawatjalan2::orderBy($sidx, $sord)
          //->join('tb_mrawatjalan','tb_mrawatjalan2.id_u', '=', 'tb_mrawatjalan.id_u')

            ->join('tb_kk2', function ($join) {
                $join->on('tb_mrawatjalan2.id_u', '=', 'tb_kk2.id_u')
                ->where('tb_kk2.hub', '=', 'karyawan');
            })
            ->where(function ($qy) use ($request) {
              if ($request->input('id_u')){
                $qy->where('tb_kk2.id_u', $request->input('id_u'));
              }
            })
            ->where('tb_mrawatjalan2.tgldoc', '>=', $mulai)
            ->where('tb_mrawatjalan2.tgldoc', '<=', $akhir);

          $count = $qu->count();
        break;
        case 'absen':
            //$count = absen::count();

            $mulai = strtotime($request->input('start'));
            $akhir = strtotime($request->input('end'));
            $iduser = $request->input('iduser');

          $qu = absen::join('tbl_datapegawai','tb_absen.id_u', '=', 'tbl_datapegawai.id')
            ->join('tb_kk2','tb_absen.id_u','=','tb_kk2.id_u')
            ->where('tb_kk2.hub','=','karyawan')
            ->where('tb_absen.date', '>=', $mulai)
            ->where('tb_absen.date', '<=', $akhir )
            ->where('tbl_datapegawai.id','=',$iduser)
            ->where('tbl_datapegawai.aktif', '=', 1)
            ->select('tb_absen.*','tb_absen.id as ida','tb_kk2.nama as nama','tb_kk2.id_u as id_u2');
          $count = $qu->count();
        break;
      }

// Membagi Query //
      if( $count > 0 ) {
        $total_pages = ceil($count/$limit);    //calculating total number of pages
      } else {
        $total_pages = 0;
      }

      if ($page > $total_pages) $page=$total_pages;
      $start = $limit*$page - $limit; // do not put $limit*($page - 1)
      $start = ($start<0)?0:$start;  // make sure that $start is not a negative value

      $responce['page'] = $page;
      $responce['total'] = $total_pages;
      $responce['records'] = $count;
      $test =0;
  // Mengambil Nilai Query //
      switch ($datatb) {
        case 'dtkaryawan':
          $query = $qu->orderBy($sidx, $sord)
            ->skip($start)->take($limit)
            ->get(array('tbl_datapegawai.*','tb_kk2.nama','v1.label as lb1','v2.label as lb2','users.email'));
        break;
        case 'dtkeluarga':

          $query = $qu->orderBy($sidx, $sord)
            ->skip($start)->take($limit)
            ->get();
        break;
        case 'dct': // Page CUTI Data Karyawan

          $query = cuti::join('tb_kk2','tb_cuti.id_u', '=', 'tb_kk2.id_u')
            ->where('tb_kk2.hub','=','karyawan')

            ->where(function ($qy) use ($request) {
              if ($request->input('id_u')){
                $qy->where('tb_kk2.id_u', $request->input('id_u'));
              }
            })

            ->orderBy($sidx, $sord)
            ->skip($start)->take($limit)

            ->get(array('tb_cuti.*','tb_cuti.id as idc','tb_kk2.*','tb_kk2.id as idu'));
        break;
        case 'wspd': // Page SPD Data Karyawan

          $query = spd::join('tb_kk2','tb_spd.id_u', '=', 'tb_kk2.id_u')
              ->join('tbl_datapegawai','tb_spd.id_u', '=', 'tbl_datapegawai.id')
              ->where('tb_kk2.hub','=','karyawan')
              ->where(function ($qy) use ($request) {
                if ($request->input('id_u')){
                  $qy->where('tb_kk2.id_u', $request->input('id_u'));
                }
              })
              ->orderBy($sidx, $sord)
              ->skip($start)->take($limit)

              ->get(array('tb_spd.*','tb_spd.id as idc','tb_kk2.*','tb_kk2.id as idu','tbl_datapegawai.*'));
        break;
        case 'rjr':
          $query = $qu
            ->orderBy($sidx, $sord)
            ->skip($start)->take($limit)
            ->get(array('tb_mrawatjalan2.*','tb_kk2.*','tb_mrawatjalan2.id as id'));
        break;
        case 'absen':   // Page absen
          $mulai = strtotime($request->input('start'));
          $akhir = strtotime($request->input('end'));

          $query = $qu
            ->orderBy('nama', 'asc')
            ->orderBy('date', 'asc')
            ->skip($start)->take($limit)
            ->get();
        break;
      }

      $i=0;
      foreach($query as $row) {
        switch ($datatb) {
          case 'dtkaryawan':
              $tmb='';
              if($row->tmb AND $row->tmb!=0)$tmb=date('d F Y', $row->tmb);

              $tkb='';
              if($row->tkb AND $row->tkb!=0)$tkb=date('d F Y', $row->tkb);

              if ($row->status_pegawai !="Tetap")$status='kontrak'; else $status=$row->status_pegawai;
              $responce['rows'][$i]['id'] = $row->id;
              $responce['rows'][$i]['cell'] = array(
                  $row->nip,
                  $row->nama,
                  $row->lb1,
                  $row->email,
                  $status,
                  $tmb,
                  $tkb
              );
              $i++;
          break;
          case 'dtkeluarga':
              $dob='';
              if($row->dob AND $row->dob!=0)$dob=date('d F Y', $row->dob);

              if ($row->status_pegawai !="Tetap")$status='kontrak'; else $status=$row->status_pegawai;
              $responce['rows'][$i]['id'] = $row->id;
              $responce['rows'][$i]['cell'] = array(
                  '',
                  $row->nama,
                  $row->hub,
                  $row->jk,
                  $dob,
                  $row->agama,
              );
              $i++;
          break;
          case 'dct':
            if($row->jeniscuti == 1){
              $jenis = 'Cuti Tahunan';
              $sisacuti = GajiHelpers::sisaCuti($row->id,$row->sdate)['total'] .' Hari dari '.GajiHelpers::sisaCuti($row->id,$row->sdate)['jatah'].' Hari';
            }
            if($row->jeniscuti == 2){$jenis = 'Cuti Otomatis';  $sisacuti = '-'; }

            $str=explode('/', $row->no);
            $responce['rows'][$i]['id'] = $row->idc;
            $responce['rows'][$i]['cell'] = array(
                AppHelpers::extractNilai($row->no)['n1'].'/'.AppHelpers::extractNilai($row->no)['n0'],
                $row->nama,
                $jenis,
                date('d F Y', $row->sdate),
                date('d F Y', $row->edate),
                GajiHelpers::sisaCuti($row->id,$row->sdate)['pakai'].' hari',
                $sisacuti,
                $row->ket
            );
            $i++;
          break;
          case 'wspd':
              if ($row->wkerja == 0){
                  $masacuti = AppHelpers::hitungcuti(date('d-m-Y', $row->sdate),date('d-m-Y', $row->edate),'-');
              } else if($row->wkerja == 1){
                  $masacuti = AppHelpers::hitungcutishift(date('d-m-Y', $row->sdate),date('d-m-Y', $row->edate),'-',$row->id_u);
              }
              $str=explode('/', $row->no);
              $responce['rows'][$i]['id'] = $row->idc;
              $responce['rows'][$i]['cell'] = array(
                  $str[1].'/'.$str[0],
                  $row->nama,
                  date('d F Y', $row->sdate),
                  date('d F Y', $row->edate),
                  $masacuti .' Hari',
                  $row->ket
              );
              $i++;
          break;
          case 'rjr':
              $pasien = kk2::where('id','=',$row->id_p)
                  ->first();

              $responce['rows'][$i]['id'] = $row->id;
              $responce['rows'][$i]['cell'] = array(
                  AppHelpers::extractNilai($row->no)['n1'].'/'.AppHelpers::extractNilai($row->no)['n0'],
                  date('d F Y', $row->tgldoc),
                  $row->nama,
                  $pasien->hub,
                  $pasien->nama,
                  date('d F Y', $row->tgl),
                  $row->uraian,
                  $row->debit,
                  $row->id_p,
              );
              $i++;
          break;
          case 'absen':
              if (!$row->idate==0){
                  $sm=date('H:i', $row->idate);
                  if ($row->jmasuk == '00:00')$jammasuk='24:00';else$jammasuk=$row->jmasuk;
                  if ($row->cki==1){
                      if ($jammasuk < $sm)$slm=AppHelpers::selisih ($sm,$row->jmasuk);else $slm='';
                  } else {
                      $slm='';
                  }
              }else{
                  $sm='0';
                  $slm='';
              }

              if (!$row->odate==0){
                  $sp=date('H:i', $row->odate);
                  if ($row->jkeluar == '24:00')$jamkeluar='00:00';else$jamkeluar=$row->jkeluar;
                  if ($row->cko==1){
                      if ($jamkeluar > $sp)$slp=AppHelpers::selisih ($row->jkeluar,$sp);else $slp='';
                  } else {
                      $slp='';
                  }
              }else{
                  $sp='0';
                  $slp='';
              }
              $status='';
              switch ($row->status) {
                  case '0':
                      $status = '-';
                  break;
                  case '1':
                      $status = 'Tanpa ket';
                  break;
                  case '2':
                      $status = 'Ijin';
                  break;
                  case '3':
                      $status = 'Sakit';
                  break;
                  case '4':
                      $status = 'Cuti';
                  break;
                  case '5':
                      $status = 'SPD';
                  break;
                  case '6':
                      $status = 'Ijin Dinas';
                  break;
                  case '7':
                      $status = 'Lembur';
                  break;
              }

              $responce['rows'][$i]['id'] = $row->ida;
              $responce['rows'][$i]['cell'] = array(
                  '',
                  $row->nama,
                  date('d M Y', $row->date),
                  date('D', $row->date),
                  $row->jmasuk.' - '.$row->jkeluar,
                  $sm,
                  $sp,
                  $slm,
                  $slp,
                  $row->hadir,
                  $status,
                  $row->ubah,
                  $row->ket,
                  $row->cki,
                  $row->cko
              );
              $i++;
          break;
        }
      }
      return  Response()->json($responce);
  }

  public function json(Request $request)
  {
    $datatb = $request->input('datatb', '');
    $oper = $request->input('oper');
    $cari = $request->input('cari');
    $newid=$i= 0;
    switch ($datatb) {
      case 'pegawai':
        $query = pegawai::where('tb_kk2.hub','karyawan')
            ->leftJoin('tb_kk2','tb_kk2.id_u', '=', 'tbl_datapegawai.id')
            ->leftJoin('tb_variabel as v1', function ($join) {
                $join->on('v1.vid', '=', 'tbl_datapegawai.jabatan')
                    ->where('v1.grup', '=', 'jabatan');
            })

            ->leftJoin('tb_variabel as v2', function ($join) {
                $join->on('v2.vid', '=', 'tbl_datapegawai.divisi')
                    ->where('v2.grup', '=', 'divisi');
            })
            ->orderBy('tbl_datapegawai.id', 'asc')
            ->get();
        $member=array();
        foreach($query as $row) {
          $member[$row->id_u] = $row->nama;
        }
        $responce['member'] = $member;
      break;
      case 'nodatacuti': // master data cuti
          if ($oper == 'pra-edit'){
              $row = cuti::where('tb_cuti.id', '=', $cari)
                  ->join('tbl_datapegawai','tbl_datapegawai.id', '=', 'tb_cuti.id_u')
                  ->first();
              $strno=explode('/', $row->no);

              $jatahcuti = fasilitas::where('id_u','=',$row['id_u'])
                  ->where('cutitahun','like',$strno[0].'/%')
                  ->first();
              $str=explode('/', $jatahcuti['cutitahun']);
              if(empty($str[1]))$str[1]=0;

              $jumlah = cuti::where('id_u','=',$row['id_u'])
                  ->where('no','like',$strno[0].'/%')
                  ->where('no','<=',$row->no)
                  ->where('jeniscuti',1)
                  ->get();

              $total=0;
              foreach($jumlah as $jumlah) {
                  if ($row->wkerja == 0){
                      $jmlct = AppHelpers::hitungcuti(date('d-m-Y', $jumlah->sdate),date('d-m-Y', $jumlah->edate),'-');
                  } else if($row->wkerja == 1){
                      $jmlct = AppHelpers::hitungcutishift(date('d-m-Y', $jumlah->sdate),date('d-m-Y', $jumlah->edate),'-',$row->id_u);
                  }
                  $total = $jmlct+$total;
              }

              if ($row->wkerja == 0){
                  $masacuti = AppHelpers::hitungcuti(date('d-m-Y', $row->sdate),date('d-m-Y', $row->edate),'-');
              } else if($row->wkerja == 1){
                  $masacuti = AppHelpers::hitungcutishift(date('d-m-Y', $row->sdate),date('d-m-Y', $row->edate),'-',$row->id_u);
              }

              $noreg = $strno[1];
              if (strlen($noreg) == 1) {$noreg = '00'.$noreg;}
              elseif (strlen($noreg) == 2){$noreg = '0'.$noreg;};

              $responce['id'] = $cari;
              $responce['no'] =  $noreg.'/'.$strno[0];
              $responce['id_u'] = $row['id_u'];
              $responce['jcuti'] = $row['jeniscuti'];
              $responce['jthcuti'] = $str['1'];
              $responce['wkerja'] = $row['wkerja'];
              $responce['sisa'] = ($str['1']-$total)+$masacuti;
              $responce['sdate'] = date('d F Y', $row['sdate']);
              $responce['edate'] = date('d F Y', $row['edate']);
              $responce['ket'] = $row['ket'];

          } elseif ($oper == 'pra-add'){
              $query = cuti::orderBy('no', 'desc')
                  ->where('no','like',date("y").'/%')
                  ->first();
              if (empty($query['no'])) $str[1]=000;else $str=explode('/', $query['no']);

              $noreg = $str[1]+1;
              if (strlen($noreg) == 1) {$noreg = '00'.$noreg;}
              elseif (strlen($noreg) == 2){$noreg = '0'.$noreg;};
              $responce['no'] = $noreg.'/'.date("y");
          }
          return  Response()->json($responce);
      break;
      case 'haricuti': // master data keluarga
          $sdate = strtotime($request->input('sdate'));
          $edate = strtotime($request->input('edate'));
          $cari = $request->input('cari');
          $wkerja = $request->input('wkerja');

          if ($wkerja==0){
              $masacuti = AppHelpers::hitungcuti(date('d-m-Y', $sdate),date('d-m-Y', $edate),'-');
          }else if ($wkerja==1){
              $masacuti = AppHelpers::hitungcutishift(date('d-m-Y', $sdate),date('d-m-Y', $edate),'-',$cari);
          }

          $responce['masacuti'] = $masacuti;

          return  Response()->json($responce);
      break;
      case 'uraiancuti':
          $query = cuti::distinct('ket')->where('ket','like',$cari.'%')
              ->orderBy('ket', 'asc')
              ->get();
          $i=0;
          $value_n='';
          foreach($query as $row) {
              if ($row->ket != $value_n){
                  $responce[$i] = $row->ket;
                  $i++;
                  $value_n=$row->ket;
              }
          }
          if(empty($responce))$responce[0]='Null';
          return  Response()->json($responce);

      break;
      case 'nodataspd': // master data cuti
          if ($oper == 'pra-edit'){
              $query = spd::where('id', '=', $cari)
                  ->first();

              $str=explode('/', $query['no']);

              $noreg = $str[1];

              if (strlen($noreg) == 1) {$noreg = '00'.$noreg;}
              elseif (strlen($noreg) == 2){$noreg = '0'.$noreg;};

              $responce['id'] = $cari;
              $responce['no'] = $noreg.'/'.$str[0];
              $responce['id_u'] = $query['id_u'];
              $responce['wkerja'] = $query['wkerja'];
              $responce['sdate'] = date('d F Y', $query['sdate']);
              $responce['edate'] = date('d F Y', $query['edate']);
              $responce['ket'] = $query['ket'];
          } elseif ($oper == 'pra-add'){
              $query = spd::orderBy('no', 'desc')
                  ->where('no','like',date("y").'/%')
                  ->first();
              if (empty($query['no'])) $str[1]=000;else $str=explode('/', $query['no']);

              $noreg = $str[1]+1;
              if (strlen($noreg) == 1) {$noreg = '00'.$noreg;}
              elseif (strlen($noreg) == 2){$noreg = '0'.$noreg;};
              $responce['no'] = $noreg.'/'.date("y");

          }
          return  Response()->json($responce);
      break;
      case 'pilihkaryawan': // master cuti
          $total = fasilitas::where('tb_fasilitas.id_u', '=', $cari)
              ->where('tb_fasilitas.cutitahun', 'like', date('y').'/%')
              ->join('tbl_datapegawai','tbl_datapegawai.id', '=', 'tb_fasilitas.id_u')
              ->first();
          $jumlah = cuti::where('tb_cuti.id_u','=',$cari)
              ->where('tb_cuti.no','like',date('y').'/%')
              ->where('tb_cuti.jeniscuti','=',1)
              ->get();

          $terpakai=0;
          if (!empty($total)){
              foreach($jumlah as $jumlah) {
                  if ($total['wkerja'] == 0){
                      $jmlct = AppHelpers::hitungcuti(date('d-m-Y', $jumlah->sdate),date('d-m-Y', $jumlah->edate),'-');
                  } else if($total['wkerja'] == 1){
                      $jmlct = AppHelpers::hitungcutishift(date('d-m-Y', $jumlah->sdate),date('d-m-Y', $jumlah->edate),'-',$cari);
                  }
                  $terpakai = $jmlct+$terpakai;
              }

              $str=explode('/', $total['cutitahun']);
          } else {
              $str[1]=0;
              $total['wkerja']=0;
          }
          $responce['total']=$str[1];
          $responce['sisa']=$str[1]-$terpakai;
          $responce['wkerja']=$total['wkerja'];
          $responce['cari']=$cari;

          return  Response()->json($responce);
      break;
      case 'jamkerjadriver':
          $query = jnmshift::where('jenis', '!=', '0')
              ->where('group', '=', '1')
              ->get();
          foreach($query as $row) {
              $responce[$i] = array(
                  'group' => $row->jenis,
                  'id'    => $row->id,
                  'title' => $row->nama,
              );
              $i++;
          }
          return  Response()->json($responce);
      break;
      case 'jshift':
          $responce[0]=array('id'=>'0','resourceId'=>'0','start'=>'0','end'=>'0','title'=>'0','color'=>'0');
          $query = jshift::leftjoin('tb_jshiftopt', 'tb_jshift.petugas', '=', 'tb_jshiftopt.id_u')
              ->where('tb_jshift.waktu', '>', strtotime( $request->input('start'))- 3600)
              ->where('tb_jshift.waktu', '<', strtotime( $request->input('end'))+ 3600)
              ->get(array('tb_jshift.*','tb_jshiftopt.*','tb_jshift.id as id'));

          $cq = jshift::leftjoin('tb_jshiftopt', 'tb_jshift.petugas', '=', 'tb_jshiftopt.id_u')
              ->where('tb_jshift.waktu', '>', strtotime($request->input('start')))
              ->where('tb_jshift.waktu', '<', strtotime($request->input('end')))
              ->count();

          foreach($query as $row) {
              $responce[$i] = array(
                  'id'    => $row->id,
                  'resourceId' => $row->jwaktu,
                  'start' => date('Y-m-d', $row->waktu),
                  'end'   => date('Y-m-d', $row->waktu),
                  'title' => $row->inisial,
                  'color' => $row->warna
              );
              $i++;
          }
          return  Response()->json($responce);
      break;
      case 'jamkerjaopr':
          $query = jnmshift::where('jenis', '!=', '0')
              ->where('group', '=', '2')
              ->get();
          foreach($query as $row) {
              $responce[$i] = array(
                  'group' => $row->jenis,
                  'id'    => $row->id,
                  'title' => $row->nama,
              );
              $i++;
          }
          return  Response()->json($responce);
      break;
      case 'selecttion':
        $table = $request->input('tb');
        $query = DB::table($table)->where(function ($qy) use ($request) {
          if($request->input('where')){
            foreach($request->input('where') as $key => $value) {
              //$where[$key] = $value;
              $qy->where($key,  $value);
            }
          }
        })
        ->get();

        foreach ($request->input('value') as $key => $value) {
          $guide[$key]=$value;
        }

        $index=$label=0;
        //$options= array();
        foreach($query as $key => $value) {
          foreach ($value as $subkey => $subvalue) {
            if ($subkey == $guide['key']) $index = $subvalue;
            if ($subkey == $guide['label'])$label = $subvalue;
            $arry[$index] = $label;
          }
          $options=$arry;
        }

        $responce['options'] = $options;

      break;

      case 'norawatjalan': // master rawat jalan
          if ($oper == 'pra-edit'){
              $query = mrawatjalan2::where('id', $cari)
                  ->first();

              $str=explode('/', $query['no']);
              $noreg = $str[1];

              if (strlen($noreg) == 1) {$noreg = '00'.$noreg;}
              elseif (strlen($noreg) == 2){$noreg = '0'.$noreg;};

              $responce['id'] = $cari;
              $responce['no'] = $noreg.'/'.$str[0];
              $responce['prefx'] = $noreg;
              $responce['id_u'] = $query['id_u'];
              $responce['id_p'] = $query['id_p'];
              $responce['tgldoc'] = date('d F Y',$query['tgldoc']);
              $responce['tgl'] = date('d F Y',$query['tgl']);

              $responce['ket'] = $query['uraian'];
              $responce['debit'] = $query['debit'];

          } elseif ($oper == 'pra-add'){
              $query = mrawatjalan2::orderBy('no', 'desc')
                  ->where('no','like', date('y').'/%')
                  ->first();
              if (empty($query['no'])) $str[1]=000;else $str=explode('/', $query['no']);

              $noreg = $str[1]+1;
              if (strlen($noreg) == 1) {$noreg = '00'.$noreg;}
              elseif (strlen($noreg) == 2){$noreg = '0'.$noreg;};
              $responce['no'] = $noreg.'/'.date("y");
              $responce['prefx'] = $str[1]+1;
//                    $responce['no'] = $query['no'];
          }

/*               if ($oper == 'pra-edit'){
                  $noreg = $row->no;
                  if (strlen($noreg) == 1) {$noreg = '00'.$noreg;}
                  elseif (strlen($noreg) == 2){$noreg = '0'.$noreg;};

                  $danarj=mrawatjalan::where('id', '=', $row->id_u)
                      ->first();

                  $responce = array(
                      'id' => $row->id,
                      'no' => $noreg,
                      'tgldoc' => date('d F Y', $row->tgldoc)+ 3600,
                      'id_u' => $row->id_u,
                      'id_p' => $row->id_p,
                      'tgl' => date('d F Y', $row->tgl),
                      'ket' => $row->uraian,
                      'rj' => number_format($danarj['platform'])+ 3600,
                      'debit' => number_format($row->debit)
                  );
          }*/
          return  Response()->json($responce);
      break;
      case 'pilihpasien': // master rawat jalan
          $query = kk2::where('id_u', '=', $cari)
              ->get();
          $i=0;
          foreach($query as $row) {
              $responce['opt'][$i]="<option value= $row->id > $row->nama </option>";
              $i++;
          }
          $strno=explode('/', $request->input('nomor'));
          if (empty($strno))$th=date('y');else $th=$strno[1];
          $platform = mrawatjalan::where('id_u', '=', $cari)
              ->where('platform','like',$th.'/%')
              ->first();

          $str=explode('/', $platform['platform']);
          if (empty($platform))$str[1]=0;
          $responce['rj']=$str[1];


          $querytotal = mrawatjalan2::where('id_u', '=', $cari)
              ->where('no', 'like', $th.'/%')
              ->get();
          $total = 0;
          foreach($querytotal as $jml) {
              $total=$jml->debit+$total;
          }
          $responce['total']=$total;
/*


          if(!$cari){
              $responce['opt'][$i]='';
              $responce['rj']='';
          }else{
              if(!empty($platform))$str[1]=0;
              $str=explode('/', $platform['platform']);
              $responce['opt'][$i]="<option value= $row->id > $row->nama </option>";
              $responce['rj']=$str[1];
              $responce['total']=$total;
          }
          $i++;*/
          return  Response()->json($responce);

      break;
      case 'uraianspd':
          $query = spd::distinct('ket')->where('ket','like',$cari.'%')
              ->orderBy('ket', 'asc')
              ->get();
          $i=0;
          $value_n='';
          foreach($query as $row) {
              if ($row->ket != $value_n){
                  $responce[$i] = $row->ket;
                  $i++;
                  $value_n=$row->ket;
              }
          }
          if(empty($responce))$responce[0]='Null';
          return  Response()->json($responce);
      break;
      case 'diagnos':
          $query = diagnos::distinct('ket')->get();
          $i=0;
          foreach($query as $row) {
              $responce[$i] = $row->ket;
              $i++;
          }

          if(empty($responce))$responce[0]='Null';

      break;
      case 'absen': // edit absen

          $query = absen::where('id', '=', $cari)
              ->first();
          if ($query['idate']!=0)$i=date('H:i',$query['idate']);else $i=$query['idate'];
          if ($query['odate']!=0)$o=date('H:i',$query['odate']);else $o=$query['odate'];

          $responce['id'] = $cari;
          $responce['date'] = date('d M Y',$query['date']);
          $responce['jmasuk'] = $query['jmasuk'];
          $responce['jkeluar'] = $query['jkeluar'];
          $responce['cki'] = $query['cki'];
          $responce['idate'] = $i;
          $responce['cko'] = $query['cko'];
          $responce['odate'] = $o;
          $responce['hadir'] = $query['hadir'];
          $responce['status'] = $query['status'];
          $responce['ubah'] = $query['ubah'];
          $responce['ket'] = $query['ket'];


      break;
    }
    return  Response()->json($responce);
  }
}
