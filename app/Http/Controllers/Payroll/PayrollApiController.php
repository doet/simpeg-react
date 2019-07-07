<?php

namespace App\Http\Controllers\Payroll;
date_default_timezone_set('Asia/Jakarta');

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

use App\Helpers\GajiHelpers;

use App\Models\menuadmins;
use App\Models\pegawai;
use App\Models\variabel;
use App\Models\libur;
use App\Models\diagnos;
use App\Models\koperasi;
use App\Models\pkoperasi;
use App\Models\upah;
use App\Models\potongan;

use DB;
use Auth;
use File;


class PayrollApiController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      // $this->middleware('auth');

  }

  /**
   * Show the application dashboard.
   *
   * @return Response
   */
  //
  // public function jqgrid(Request $request){
  //
  //
  // }
  //
  public function json(Request $request){
    $datatb = $request->input('datatb','');
    $oper = $request->input('oper','');
    $id = $request->input('id','');
    $cari = $request->input('cari','');
//
//
    switch ($datatb) {

      // view Tree file's
      case 'files':
        $tree_data_2['status']="OK" ;

        if ($id == 0) {

          $tree_data_2['data'][1]['text'] = 'Excel';
          $tree_data_2['data'][1]['icon-class'] = "red";
          $tree_data_2['data'][1]['type'] = 'folder';
          $tree_data_2['data'][1]['additionalParameters']['id'] = 1;
          $tree_data_2['data'][1]['additionalParameters']['children'] = true;

          $tree_data_2['data'][2]['text'] = 'Slip';
          $tree_data_2['data'][2]['icon-class'] = "red";
          $tree_data_2['data'][2]['type'] = 'folder';
          $tree_data_2['data'][2]['additionalParameters']['id'] = 2;
          $tree_data_2['data'][2]['additionalParameters']['children'] = true;

        }else{
          //Buka Folder
          $folder = public_path().'\\files\\slips'; //Sesuaikan Folder nya

          if(!($buka_folder = opendir($folder))) die ("eRorr... Tidak bisa membuka Folder");

          $file_array = array();
          $filterfile=0;

          while($baca_folder = readdir($buka_folder)){
            if ($id == 1) {
              $filterfile = strpos($baca_folder,"excel");
            }else if ($id == 2) {
              $filterfile = strpos($baca_folder,"slip");
            }

            if ($filterfile) $file_array[] = $baca_folder;
            $jumlah_array = count($file_array);

            for($i=0; $i<$jumlah_array; $i++){
              $nama_file = $file_array;
          //    print_r($nama_file);
              //echo "$nama_file[$i-2] (". round(filesize($nama_file[$i])/1024,1) . "kb)<br/>";
              $tree_data_2['data'][$i]['text'] =  '<i class="ace-icon fa fa-file-excel-o blue"></i>'.$nama_file[$i];
              $tree_data_2['data'][$i]['fname'] =  $nama_file[$i];
              $tree_data_2['data'][$i]['type'] = 'item';
            }
          }

        }

        return $tree_data_2;
      break;
    }
  }

  public function cud(Request $request){
    $datatb = $request->input('datatb', '');
    $cari = $request->input('cari', '0');
    $oper = $request->input('oper');
    $id = $request->input('id');
    $setdate=strtotime($request->input('setdate'));

    switch ($datatb) {
      case 'koperasi':
        if ($request->get('koperasi')){
          foreach($request->get('koperasi') as $key=>$value){
            if (!$value)$value=0;
            $value = str_replace(",","", $value);
            $key = str_replace("'","", $key);
            $datanya=array(
              'id_u' => $id,
              'jenis' => $key,
              'nilai' => $value,
              'berlaku' => $setdate,
              'updated_at' =>date("Y-m-d H:i:s")
            );
            $tunjangan = koperasi::where('id_u',$id)
              ->where('berlaku','<=',$setdate)
              ->where('jenis',$key)
              ->orderBy('berlaku','desc')
              ->first();

            if (!$tunjangan){
              koperasi::insert($datanya);
            } else {
              if ($tunjangan['berlaku']==$setdate AND $tunjangan['nilai']!=$value) {
                koperasi::where('id', $tunjangan['id'])->update($datanya);
              } else if ($tunjangan['berlaku']!=$setdate AND $tunjangan['nilai']!=$value) {
                koperasi::insert($datanya);
              }
            }
          /*
          $potongan[0] = str_replace(',', '', $request->input('pokok'));
          $potongan[1] = str_replace(',', '', $request->input('wajib'));
          $potongan[2] = str_replace(',', '', $request->input('sukarela'));
          $potongan[3] = str_replace(',', '', $request->input('mppa'));
          $potongan[4] = str_replace(',', '', $request->input('loan'));
          for ($i= 0; $i <= 4; $i++){
              if ($potongan[$i]!='') {
                  $cek=koperasi::where('id_u', $id)->where('jenis', $i)->first();

                  $datanya=array(
                      'id_u'=>$id,
                      'jenis' => $i,
                      'nilai' => $potongan[$i],
                      'updated_at' =>date("Y-m-d H:i:s")
                  );
                  if($cek){
                      koperasi::where('id_u', $id)->where('jenis', $i)->update($datanya);
                  }else{
                      koperasi::insert($datanya);
                  }*/
              }
          }



          $response = array(
              'status' => 'success',
              'msg' => 'berhasil',
          );
          return $response;
      break;
      case 'pkoperasi':

          $datanya=array(
              'id_u' => $request->input('id_u'),
              'tglapp'=>strtotime($request->input('tglpinjam')),
              'jumlah'=>str_replace(',', '', $request->input('jml')),
              'jmlplus'=>str_replace(',', '', $request->input('jmlb')),
              'tenor'=>$request->input('tenor'),
              'updated_at' =>date("Y-m-d H:i:s")
          );

          if ($oper=='add')pkoperasi::insert($datanya);
          if ($oper=='edit')pkoperasi::where('id', $id)->update($datanya);
          if ($oper=='del')pkoperasi::destroy($id);

          $response = array(
              'status' => 'success',
              'msg' => 'berhasil',
          );
          return $response;
      break;
      case 'uploadfiles':

        if(isset($_FILES)){
          $ret = array();
          $path= public_path().'\\files\\slips';

          //membuat folder jika folder tidak ada
          if (!is_dir($path)) File::makeDirectory($path);

          $fs = $request->file('file');

          $name = explode('.', $fs->getClientOriginalName());
          if ($name[1]=='xlsx' || $name[1]=='xls'){
              $fileName = $name[0].'-'.date('Ymd').'.'.$name[1];
          }

          // $fileName   = $_FILES['file']['name'];
          // $file       = $path.$fileName;

          //simpan file ukuran sebenernya
        //  $realImagesName     = $_FILES["file"]["tmp_name"];
        //  move_uploaded_file($realImagesName, $file);

          $request->file('file')->move("public/files/slips", $fileName);
          print_r($path);
        }
      break;
      case 'savetodb':
        /// baca sekalian save k database ///

        $reader = ReaderFactory::create(Type::XLSX); // for XLSX files
        //$reader = ReaderFactory::create(Type::CSV); // for CSV files
        //$reader = ReaderFactory::create(Type::ODS); // for ODS files
        if ($request->input('fname'))$fname = $request->input('fname'); else return;
        $reader->open(public_path().'/files/slips/'.$fname);

        $arrytmp=$tmp=$header=$isinya=array();
        $l=0;

        foreach ($reader->getSheetIterator() as $sheet) {
          foreach ($sheet->getRowIterator() as $row) {
            if (strpos($fname,"upah") != false || strpos($fname,"potongan") != false){
              if ($l==0){
                for( $i=0 ; $i < count($row) ; $i++ ){
                  if ($row[$i]!=""){
                    array_push($header, $row[$i]);
                  }
                }
              }else{
                if ($row[1]!=""){
                  for( $i=0 ; $i < count($header) ; $i++ ){
                    array_push($isinya, $row[$i]);

                    //input data tidak termasuk dari field NO, id payroll, Nama
                    //$tanggalberlaku = strtotime(date("Y-m")) ;
                    $tanggalberlaku = strtotime($request->input('setdate')) ;
                    // if ($row[1] != "") $fillfield = $row[1]."\r\n"; else $fillfield = (NULL);
                    $fillfield = trim($row[1]);
                    if($row[$i]=='')$row[$i]=0;
                    if ($i > 2) {
                      $datanya=array(
                        'id_u'        =>  $fillfield,
                        'jenis'       =>  $header[$i],
                        'nilai'       =>  $row[$i],
                        'berlaku'     =>  $tanggalberlaku,
                        'updated_at'  =>  date("Y-m-d H:i:s")
                      );
                      //print_r($datanya);

                      // cek jika data sudah ada
                      if (strpos($fname,"upah") != false) $table='tb_upah'; else $table='syn_potongan';

                      $cek = DB::table($table)
                        ->where('id_u',$fillfield)
                        ->where('jenis',$header[$i])
                        ->where('berlaku', '<=' ,$tanggalberlaku)
                        ->orderBy('berlaku', 'desc')
                        ->first();

                      if(!$cek) {
                        //input data jika data belum tersedia
                        //try {
                          DB::table($table)->insert($datanya);
                        //} catch (\Exception $ex){
                      //     //ambil value diantara kata reference dan on
                        //  dd($ex->getMessage());
                          // echo 'error';
                        //}
                      } else {
                        //update data yang sudah tersedia
                        if ($cek->berlaku < $tanggalberlaku){
                          if ($cek->value != $row[$i]){
                            DB::table($table)->insert($datanya);
                          }
                        } else {
                          DB::table($table)->where('id',$cek->id)->update($datanya);
                        }
                      }
                    }
                  }
                }
              }
            }
            $l++;
          }
        }
        //
        $tmp['header']=$header;
        $tmp['isinya']=$isinya;
        return $tmp;
      break;
      case 'datagaji':
          $sakti = 123;
          if ($request->get('dupah')){
              foreach($request->get('dupah') as $key=>$value){
                  if (!$value)$value=0;
                  $value = str_replace(",","", $value);
                  $key = str_replace("'","", $key);
                  $datanya=array(
                      'id_u' => $id,
                      'jenis' => $key,
                      'nilai' => $value,
                      'berlaku' => $setdate,
                      'updated_at' =>date("Y-m-d H:i:s")
                  );
                  $tunjangan = upah::where('id_u',$id)
                      ->where('berlaku','<=',$setdate)
                      ->where('jenis',$key)
                      ->orderBy('berlaku','desc')
                      ->first();

                  if (!$tunjangan){
                      upah::insert($datanya);
                  } else {
                      if ($tunjangan['berlaku']==$setdate AND $tunjangan['nilai']!=$value) {
                          upah::where('id', $tunjangan['id'])->update($datanya);
                      } else if ($tunjangan['berlaku']!=$setdate AND $tunjangan['nilai']!=$value) {
                          upah::insert($datanya);
                      }
                  }
              }
          }

          if ($request->get('dpotongan')){
              foreach($request->get('dpotongan') as $key=>$value){
                  if (!$value)$value=0;
                  $value = str_replace(",","", $value);
                  $key = str_replace("'","", $key);
                  $datanya=array(
                      'id_u' => $id,
                      'jenis' => $key,
                      'nilai' => $value,
                      'berlaku' => $setdate,
                      'updated_at' =>date("Y-m-d H:i:s")
                  );
                  $tunjangan = potongan::where('id_u',$id)
                      ->where('berlaku','<=',$setdate)
                      ->where('jenis',$key)
                      ->orderBy('berlaku','desc')
                      ->first();

                  if (!$tunjangan){
                      potongan::insert($datanya);
                  } else {
                      if ($tunjangan['berlaku']==$setdate AND $tunjangan['nilai']!=$value) {
                          potongan::where('id', $tunjangan['id'])->update($datanya);
                      } else if ($tunjangan['berlaku']!=$setdate AND $tunjangan['nilai']!=$value) {
                          potongan::insert($datanya);
                      }
                  }
              }
          }

          if ($request->get('dupah2')){

              foreach($request->get('dupah2') as $key=>$value){
                  if (!$value)$value=0;

                  $value = str_replace(",","", $value);
                  $key = str_replace("'","", $key);
                  $datanya=array(
                      'id_u' => $id,
                      'jenis' => $key,
                      'nilai' => $value,
                      'berlaku' => $setdate,
                      'updated_at' =>date("Y-m-d H:i:s")
                  );
                  $tunjangan = DB::table('tb_upah2')->where('id_u',$id)
                      ->where('berlaku','<=',$setdate)
                      ->where('jenis',$key)
                      ->orderBy('berlaku','desc')
                      ->first();

                  if (!$tunjangan){
                      DB::table('tb_upah2')->insert($datanya);
                  } else {
                      if ($tunjangan->berlaku==$setdate AND $tunjangan->nilai!=$value){
                          DB::table('tb_upah2')->where('id', $tunjangan->id)->update($datanya);

                      } else if ($tunjangan->berlaku!=$setdate AND $tunjangan->nilai!=$value) {
                          DB::table('tb_upah2')->insert($datanya);

                      }
                  }
              }
          }
          $response = array(
              'status' => 'success',
              'msg' => $sakti,
          );
          return $response;
      break;
    //
    //   case 'delfile':
    //       $fileName = $request->input('fname');
    //       $path = public_path().'/files/';
    //
    //       $file = $path.$fileName;
    //
    //       unlink($file);
    //   break;
    //     case 'savetodb':
    //         /// baca sekalian save k database ///
    //
    //         $reader = ReaderFactory::create(Type::XLSX); // for XLSX files
    //         //$reader = ReaderFactory::create(Type::CSV); // for CSV files
    //         //$reader = ReaderFactory::create(Type::ODS); // for ODS files
    //         if ($request->input('fname'))$fname = $request->input('fname'); else return;
    //         $reader->open(public_path().'/files/'.$fname);
    //
    //         $arrytmp=$tmp=$header=$isinya=array();
    //         $l=0;
    //
    //         foreach ($reader->getSheetIterator() as $sheet) {
    //           foreach ($sheet->getRowIterator() as $row) {
    //             if (strpos($fname,"benefit") != false || strpos($fname,"potongan") != false){
    //               if ($l==0){
    //                 for( $i=0 ; $i < count($row) ; $i++ ){
    //                   if ($row[$i]!="")array_push($header, $row[$i]);
    //                 }
    //               }else{
    //                 for( $i=0 ; $i < count($header) ; $i++ ){
    //                   array_push($isinya,$row[$i]);
    //                   //input data tidak termasuk dari field NO, id payroll, Nama
    //                   //$tanggalberlaku = strtotime(date("Y-m")) ;
    //                   $tanggalberlaku = strtotime($request->input('setdate')) ;
    //
    //                   // if ($row[1] != "") $fillfield = $row[1]."\r\n"; else $fillfield = (NULL);
    //                   $fillfield = trim($row[1]);
    //
    //                   if ($i > 2) {
    //                     $datanya=array(
    //                       'payroll_id'  =>  $fillfield,
    //                       'jenis'       =>  $header[$i],
    //                       'value'       =>  $row[$i],
    //                       'berlaku'     =>  $tanggalberlaku,
    //                       'updated_at'  =>  date("Y-m-d H:i:s")
    //                     );
    //
    //                     // cek jika data sudah ada
    //                     if (strpos($fname,"benefit") != false) $table='tb_tunjangans'; else $table='syn_potongan';
    //
    //                     $cek = DB::table($table)
    //                       ->where('payroll_id',$fillfield)
    //                       ->where('jenis',$header[$i])
    //                       ->where('berlaku', '<=' ,$tanggalberlaku)
    //                       ->orderBy('berlaku', 'desc')
    //                       ->first();
    //
    //                     if(!$cek) {
    //                       //input data jika data belum tersedia
    //                       try {
    //                         DB::table($table)->insert($datanya);
    //                       } catch (\Exception $ex){
    //                         //ambil value diantara kata reference dan on
    //                         dd($ex->getMessage());
    //                       }
    //                     } else {
    //                       //update data yang sudah tersedia
    //
    //                       if ($cek->berlaku < $tanggalberlaku){
    //                         if ($cek->value != $row[$i]){
    //                           DB::table($table)->insert($datanya);
    //                         }
    //                       } else {
    //                         DB::table($table)->where('id',$cek->id)->update($datanya);
    //                       }
    //                     }
    //                   }
    //                 }
    //               }
    //
    //             } else if (strpos($fname,"karyawan") != false) {
    //               if ($l==0){
    //                 for( $i=0 ; $i < count($row) ; $i++ ){
    //                   if ($row[$i]!="") array_push($header, trim($row[$i]));
    //                 }
    //               }else{
    //                 if ($row[0]!=''){
    //                   for( $i=0 ; $i < count($header) ; $i++ ){
    //                     $fillfield = trim($row[1]);
    //
    //                     if ($row[$i]=="") {
    //                       $fillvalue=(NULL);
    //                     } else {
    //                       if (explode('_',$header[$i])[0] == 'tgl') {
    //                         if (is_array($row[$i])){
    //                           foreach ($row[$i] as $key => $value) {
    //                             $arrytmp[$key] = $value;
    //                           }
    //
    //                           $fillvalue=strtotime($arrytmp['date']);
    //                         }else{
    //                           $fillvalue=(NULL);
    //                         }
    //                         // array_push($isinya,$row[$i]);
    //                       }else {
    //                         $fillvalue=$row[$i];
    //                       }
    //                     }
    //
    //                     //
    //                     if ($i >= 1 ) {
    //                       $datanya=array(
    //                         'payroll_id'    => $fillfield,
    //                         $header[$i]     => $fillvalue,
    //                         'updated_at'    => date("Y-m-d H:i:s")
    //                       );
    //                       $cek = DB::table('syn_karyawans')
    //                         ->where('payroll_id',$fillfield)
    //                         ->first();
    //
    //                       $cn = DB::getSchemaBuilder()->getColumnListing('syn_karyawans');
    //                       if (in_array($header[$i],$cn)){
    //                         if(!$cek) {
    //                           DB::table('syn_karyawans')->insert($datanya);
    //                         } else {
    //                           DB::table('syn_karyawans')->where('id',$cek->id)->update($datanya);
    //                         }
    //                       }
    //                     }
    //                   }
    //                 }
    //               }
    //             }
    //             $l++;
    //           }
    //         }
    //
    //         $tmp['header']=$header;
    //         $tmp['isinya']=$isinya;
    //         return $tmp;
    //     break;
    }

  }
  public function jqgrid(Request $request){

    $datatb = $request->input('datatb', '');

    $page = $request->input('page', '1');
    $limit = $request->input('rows', '10');
    $sord = $request->input('sord', 'asc');
    $sidx = $request->input('sidx', 'id');

// Menentukan Jumlah Query //
      switch ($datatb) {
        case 'koperasi':  // Page SDM Data Karyawan
          $qu = pegawai::where('tbl_datapegawai.tkb',0)
            ->select('nip','nama','divisi.label as nmdivisi','jabatan.label as nmjabatan','tbl_datapegawai.id')
            ->join('tb_kk2','tbl_datapegawai.id','=','tb_kk2.id_u')
            ->join('tb_variabel as divisi', function ($join) {
                $join->on('tbl_datapegawai.divisi', '=', 'divisi.vid')
                ->where('divisi.grup', '=', 'divisi');
            })
            ->join('tb_variabel as jabatan', function ($join) {
                $join->on('tbl_datapegawai.jabatan', '=', 'jabatan.vid')
                ->where('jabatan.grup', '=', 'jabatan');
            })
            ->where(function ($qy) use ($request) {
              if ($request->input('id_u')){
                $qy->where('tb_kk2.id_u', $request->input('id_u'));
              }
            })
            ->where('tb_kk2.hub','karyawan');

            $count = $qu->count();
        break;
        case 'pkoperasi':

          $qu = pkoperasi::leftJoin('tbl_datapegawai','tb_pkoperasi.id_u', '=','tbl_datapegawai.id')
            ->join('tb_kk2', function ($join) {
              $join->on('tb_kk2.id_u', 'tbl_datapegawai.id')
                ->where('tb_kk2.hub', 'karyawan');
            })
            ->where(function ($qy) use ($request) {
              if ($request->input('id_u')){
                $qy->where('tb_kk2.id_u', $request->input('id_u'));
              }
            });

            $count = $qu->count();
        break;
        case 'upah':
          $qu = pegawai::where('tbl_datapegawai.tkb',0)
            ->select('nip','nama','divisi.label as nmdivisi','jabatan.label as nmjabatan','tbl_datapegawai.id')
            ->join('tb_kk2','tbl_datapegawai.id','=','tb_kk2.id_u')
            ->join('tb_variabel as divisi', function ($join) {
                $join->on('tbl_datapegawai.divisi', '=', 'divisi.vid')
                ->where('divisi.grup', '=', 'divisi');
            })
            ->join('tb_variabel as jabatan', function ($join) {
                $join->on('tbl_datapegawai.jabatan', '=', 'jabatan.vid')
                ->where('jabatan.grup', '=', 'jabatan');
            })
            ->where(function ($qy) use ($request) {
              if ($request->input('id_u')){
                $qy->where('tb_kk2.id_u', $request->input('id_u'));
              }
            })
            ->where('tb_kk2.hub','karyawan');

          $count = $qu->count();
        break;
        case 'potongan':
          $qu = pegawai::where('tbl_datapegawai.tkb',0)
            ->select('nip','nama','divisi.label as nmdivisi','jabatan.label as nmjabatan','tbl_datapegawai.id')
            ->join('tb_kk2','tbl_datapegawai.id','=','tb_kk2.id_u')
            ->join('tb_variabel as divisi', function ($join) {
                $join->on('tbl_datapegawai.divisi', '=', 'divisi.vid')
                ->where('divisi.grup', '=', 'divisi');
            })
            ->join('tb_variabel as jabatan', function ($join) {
                $join->on('tbl_datapegawai.jabatan', '=', 'jabatan.vid')
                ->where('jabatan.grup', '=', 'jabatan');
            })
            ->where(function ($qy) use ($request) {
              if ($request->input('id_u')){
                $qy->where('tb_kk2.id_u', $request->input('id_u'));
              }
            })
            ->where('tb_kk2.hub','karyawan');

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
        case 'koperasi':
          $query = $qu->orderBy($sidx, $sord)
          ->skip($start)->take($limit)
          ->orderBy('jabatan', 'asc')
          ->get();
        break;
        case 'pkoperasi':
          $query = $qu->orderBy($sidx, $sord)
          ->skip($start)->take($limit)
          ->get(array('tb_pkoperasi.*','tb_kk2.nama','tbl_datapegawai.nip'));
        break;
        case 'upah':
          $query = $qu->orderBy($sidx, $sord)
          ->skip($start)->take($limit)
          ->orderBy('jabatan', 'asc')
          ->get();
        break;
        case 'potongan':
          $query = $qu->orderBy($sidx, $sord)
          ->skip($start)->take($limit)
          ->orderBy('jabatan', 'asc')
          ->get();
        break;
      }
      // ->where($cari,$cari2,$value)
      // ->where(function ($qy) use ($request) {
      //   if ($request->input('id_u')){
      //     $qy->where('tb_kk2.id_u', $request->input('id_u'));
      //   }
      // });


      $i=0;
      foreach($query as $row) {
        switch ($datatb) {
          case 'koperasi':
              $start = $request->input('start');
              $end = $request->input('end');
              if ($row->wkerja==0) $wkerja = 'Non Shift'; else $wkerja = 'Shift';
              $responce['rows'][$i]['id'] = $row->id;
              $responce['rows'][$i]['cell'] = array(
                  $row->nip,
                  $row->nama,
                  GajiHelpers::tkoperasi($row->id,$start)['pokok'],
                  GajiHelpers::tkoperasi($row->id,$start)['wajib'],
                  GajiHelpers::tkoperasi($row->id,$start)['sukarela'],
                  GajiHelpers::tkoperasi($row->id,$start)['mppa'],
                  GajiHelpers::tkoperasi($row->id,$start)['el'],
                  GajiHelpers::pkoperasi($row->id,$start)['angsur'],
                  GajiHelpers::tkoperasi($row->id,$start)['total'],

              );
              $i++;
          break;
          case 'pkoperasi':
              $start = $request->input('start');
              $end = $request->input('end');
              if ($row->wkerja==0) $wkerja = 'Non Shift'; else $wkerja = 'Shift';
              $responce['rows'][$i]['id'] = $row->id;
              $responce['rows'][$i]['cell'] = array(
                  $row->nip,
                  $row->id,
                  $row->nama,
                  date('d F Y',$row->tglapp),
                  $row->jumlah,
                  $row->jmlplus,
                  $row->tenor,
                  GajiHelpers::pkoperasi($row->id_u,$start)['angsur'],
                  GajiHelpers::pkoperasi($row->id_u,$start)['stenor'],
                  GajiHelpers::pkoperasi($row->id_u,$start)['sangsur'],
              );
              $i++;
          break;
          case 'upah':
              $start = $request->input('start');
              $end = $request->input('end');
              if ($row->wkerja==0) $wkerja = 'Non Shift'; else $wkerja = 'Shift';
              $responce['rows'][$i]['id'] = $row->id;
              $responce['rows'][$i]['cell'] = array(
                  $row->nip,
                  $row->nama,
                  GajiHelpers::upah($row->id,'pokok',$start),
                  GajiHelpers::upah($row->id,'honor',$start),
                  GajiHelpers::upah($row->id,'perum',$start),
                  GajiHelpers::htshift($row->id,$start,$end)['tshift'],
                  GajiHelpers::upah($row->id,'jabatan',$start),
                  GajiHelpers::upah($row->id,'pandu',$start),
                  GajiHelpers::upah($row->id,'profesi',$start),
                  GajiHelpers::upah($row->id,'bkerja',$start),
                  GajiHelpers::upah($row->id,'umakan',$start),
                  GajiHelpers::upah($row->id,'utransport',$start),
                  GajiHelpers::upah($row->id,'lembur',$start),
                  GajiHelpers::upah($row->id,'bcuti',$start),
                  GajiHelpers::upah($row->id,'kbl',$start),
                  GajiHelpers::upah($row->id,'tkendaraan',$start),
                  GajiHelpers::upah($row->id,'bbm',$start),
                  GajiHelpers::upah($row->id,'pkendaraan',$start),
              );
              $i++;
          break;
          case 'potongan':
              $start = $request->input('start');
              $end = $request->input('end');
              if ($row->wkerja==0) $wkerja = 'Non Shift'; else $wkerja = 'Shift';
              $responce['rows'][$i]['id'] = $row->id;
              $responce['rows'][$i]['cell'] = array(
                $row->nip,
                $row->nama,
                GajiHelpers::potongan($row->id,'bjb',$start),
                GajiHelpers::potongan($row->id,'kendaraan',$start),
                GajiHelpers::potongan($row->id,'absen',$start),
                GajiHelpers::potongan($row->id,'pph21',$start),
                GajiHelpers::potongan($row->id,'lbl',$start),
                GajiHelpers::baziz($row->id,$start)['total'],
                GajiHelpers::tkoperasi($row->id,$start)['total'],
                GajiHelpers::dplk($row->id,$start)['karyawan'],
                GajiHelpers::bpjsker($row->id,$start,$end)['karyawan'],
                GajiHelpers::bpjskes($row->id,$start)['karyawan'],
              );
              $i++;
          break;
        }
      }
      return  Response()->json($responce);
  }
}
