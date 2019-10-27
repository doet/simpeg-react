<?php

namespace App\Http\Controllers\Oprasional;
date_default_timezone_set('Asia/Jakarta');

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\menuadmins;

use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

use DB;
use Auth;
use File;

class FilesCrudController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  public function json(Request $request)
  {
    $datatb = $request->input('datatb','');
    $oper = $request->input('oper','');
    $id = $request->input('id','');
    $cari = $request->input('cari','');


    switch ($datatb) {
        case 'files':
            $tree_data_2['status']="OK" ;
            $i=0;
            if ($id == 0) {
                $tree_data_2['data'][0]['text'] = 'DL';
                $tree_data_2['data'][0]['icon-class'] = "red";
                $tree_data_2['data'][0]['type'] = 'folder';
                $tree_data_2['data'][0]['attr']['id'] = 1;
                $tree_data_2['data'][0]['additionalParameters']['id'] = 1;
                $tree_data_2['data'][0]['additionalParameters']['children'] = true;

                $tree_data_2['data'][1]['text'] = 'LHP';
                $tree_data_2['data'][1]['icon-class'] = "red";
                $tree_data_2['data'][1]['type'] = 'folder';
                $tree_data_2['data'][1]['attr']['id'] = 2;
                $tree_data_2['data'][1]['additionalParameters']['id'] = 2;
                $tree_data_2['data'][1]['additionalParameters']['children'] = true;
            }else{
                // Buka Folder
                // $folder = "./files/oprasional/"; //Sesuaikan Folder nya
                $folder = "./public/files/oprasional"; //Sesuaikan Folder nya
                if(!($buka_folder = opendir($folder))) die ("eRorr... Tidak bisa membuka Folder");

                $file_array = array();
                $filterfile=0;
                while($baca_folder = readdir($buka_folder)){
                    if($id == 1)$filterfile = strpos($baca_folder,"DL"); else $filterfile = strpos($baca_folder,"LHP");
                        if ($filterfile === 0 ) $file_array[] = $baca_folder;
                }

                // print_r ($file_array);


                $jumlah_array = count($file_array);
                for($i=0; $i<$jumlah_array; $i++){
                    $nama_file = $file_array;
                    //echo "$nama_file[$i-2] (". round(filesize($nama_file[$i])/1024,1) . "kb)<br/>";
                    $tree_data_2['data'][$i]['text'] =  '<i class="ace-icon fa fa-file-excel-o blue"></i>'.$nama_file[$i];
                    $tree_data_2['data'][$i]['fname'] =  $nama_file[$i];
                    $tree_data_2['data'][$i]['type'] = 'item';
                }
                closedir($buka_folder);

                if (empty($tree_data_2['data'])){
                  $tree_data_2['data'][$i]['text'] = '.:: Empty ::.';
                  $tree_data_2['data'][$i]['fname'] = '.:: Empty ::.';
                  $tree_data_2['data'][$i]['type'] = 'item';
                };
            }
            return $tree_data_2;
        break;
        case 'prepost':
          $tmp = array();
          $tmp['nfile']=$request->input('fname');
          return $tmp;
        break;
        case 'ReaderFiles':
          return $this->ReadXlsx($request);
        break;
    }
  }

  public function save(Request $request){
    $datatb = $request->input('datatb', '');
    $cari = $request->input('cari', '0');
    $oper = $request->input('oper');
    $id = $request->input('id');

    $path= public_path().'\files\oprasional/';

    switch ($datatb) {
      case 'uploadfiles':

        if(isset($_FILES)){
          $ret = array();

          if (!is_dir($path)) File::makeDirectory($path);
          //print_r($_FILES['file']);
          $fs = $request->file('file');
          $fn = $fs->getClientOriginalName();


          // print_r($path);

          $name = explode('.', $fs->getClientOriginalName());
          if ($name[1]=='xlsx' || $name[1]=='xls'){
              $fileName = $name[0].'-'.strtotime(date('d-m-Y')).'.'.$name[1];
          }

          // $fileName   = $_FILES['file']['name'];
          // $file       = $path.$fileName;

          //simpan file ukuran sebenernya
        //  $realImagesName     = $_FILES["file"]["tmp_name"];
        //  move_uploaded_file($realImagesName, $file);

          $request->file('file')->move($path, $fileName);
        }
      break;

      case 'delfile':
          $fileName = $request->input('fname');
          $file       = $path.$fileName;
          unlink($file);
      break;
      case 'savetodb':
        $data = $this->ReadXlsx($request);
        foreach ($data['isinya'] as $row) {
          $tunda = array();
          // agen
          $agen = DB::table('tb_agens')->where(['code' => $row[2]])->first();

          if(!$agen) $agen['id'] = DB::table('tb_agens')->insertGetId(['code' => $row[2]]); $agen = (object) $agen;

          // kapal
          $kapal = DB::table('tb_kapals')->where(['value' => $row[6]])->first();
          if(!$kapal) $kapal['id'] = DB::table('tb_kapals')->insertGetId([
            'value'   => $row[6],
            'jenis'   => $row[5],
            'grt'     => preg_replace("/[^0-9]/","",$row[7]),
            'loa'     => preg_replace("/[^0-9]/","",$row[8]),
            'bendera' => $row[9]
          ]); $kapal = (object) $kapal;

          // dermaga
          $dermaga = DB::table('tb_jettys')->where(['code' => $row[10]])->first();
          if(!$dermaga) $dermaga['id'] = DB::table('tb_jettys')->insertGetId(['code' => $row[10],'name' => $row[11]]); $dermaga = (object) $dermaga;

          $d1 = explode('/', $row[3]);
          if ($row[4]!='SHIFT')$d2 = $row[4];
          $date = '2019-'.$d1[1].'-'.$d1[0].' '.$d2;

          $dateon = '2019-'.$d1[1].'-'.$d1[0].' '.$row[20];
          $dateoff = '2019-'.$d1[1].'-'.$d1[0].' '.$row[21];

          // $tunda = $row[19];
          if ($row[15] != '') array_push($tunda,$row[15]);
          if ($row[16] != '') array_push($tunda,$row[16]);
          if ($row[17] != '') array_push($tunda,$row[17]);
          if ($row[18] != '') array_push($tunda,$row[18]);
          if ($row[19] != '') array_push($tunda,$row[19]);

          DB::table('tb_dls')->insert([
             'ppjk'       => $row[1],
             'agens_id'   => $agen->id,
             'date'       => strtotime($date),
             'kapals_id'  => $kapal->id,
             'jetty_id'   => $dermaga->id,
             'ops'        => $row[12],
             'bapp'       => $row[13],
             'pc'         => $row[14],
             'tunda'      => json_encode($tunda),
             'tundaon'    => strtotime($dateon),
             'tundaoff'   => strtotime($dateoff),
             'dd'         => $row[22],
             'ket'        => $row[23],
             'kurs'       => $row[24]
           ]);
          // echo $data['isinya'];
        }
        //return
      break;
    }
  }
  public function ReadXlsx($request){
    $reader = ReaderFactory::create(Type::XLSX); // for XLSX files
    //$reader = ReaderFactory::create(Type::CSV); // for CSV files
    //$reader = ReaderFactory::create(Type::ODS); // for ODS files
    if ($request->input('fname'))$fname = 'oprasional/'.$request->input('fname'); else $fname = 'oprasional/blank.xlsx';
    $reader->open(public_path().'\files\/'.$fname);

    $arrytmp=$tmp=$header=$isinya=array();
    // $tgl=array('No','PPJK','Agen','Waktu','Kapal','GRT','LOA','Bendera','Bendera','Dermaga','Ops','Bapp','PC','Tunda','Waktu','DD','Ket','Kurs');
    // $tgllibur=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
    //
    // $priode=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
    $l=0;
    $tmp['nfile']=$request->input('fname');
    foreach ($reader->getSheetIterator() as $sheet) {
      foreach ($sheet->getRowIterator() as $row) {///row
        if ($l==0){
          for( $i=0 ; $i < count($row) ; $i++ ){
              array_push($header, $row[$i]);
          }
        }else{
          $isinya[$l]=array();
          for( $i=0 ; $i < count($row) ; $i++ ){
            if (is_object($row[$i]) == 'true')$row[$i] = date_format($row[$i], 'H:i');
            array_push($isinya[$l],$row[$i]);
          }
        }
        $l++;
      }
    }
    $tmp['header']=$header;
    $tmp['isinya']=$isinya;
    return $tmp;
  }

  public function chart(Request $request){
    $datatb = $request->input('datatb', '');
    $tmp = array();
    switch ($datatb) {
      case 'jetty':

        $start = 1558026000;
        $end = 1559802600;
        $day1 = (60 * 60 * 24);

        $i=$n= 0;
        /////////////////////// data harian
        for($start; $start < $end; $start = $start+$day1) {
          ////////////// data dalam 1 tanggal //////////////
          $tmp['label'][] = $start; // ambil tanggal sumbu x

          $jetty = DB::table('tb_dls')
            ->join('tb_jettys', function ($join) {
              $join->on('tb_dls.jettys_id','tb_jettys.id');
            })
            ->where(function ($query) use ($start,$day1){
                $query->where('date', '>', $start)
                  ->Where('date', '<', $start+$day1);
            })
            ->select('tb_jettys.name as jettyName','tb_jettys.color as jettyColor', 'tb_dls.*')
            ->get();
            $jty=0;
          // dd($jetty);
          foreach ($jetty as $row) {
            $jettyname[$row->jettys_id] = $row->jettyName;
            $jettycolor[$row->jettys_id] = $row->jettyColor;
            $subdata[$start][] = $row->jettys_id;
            $subdata2[$row->jettys_id][$n][] = $row->jettys_id;
          }
          $tmp['subdata'][$start] = array_count_values($subdata[$start]); // data jetty dalam satu hari
          $n++;
        }

        foreach ($jettyname as $key=>$jn){
          $jm=0;
          for($il=0; $il < count($tmp['label']); $il++) {
            // if (isset($subdata2[$key][$il])) $hasil[$key][] = array_count_values($subdata2[$key][$il]); else $hasil[$key][] = array($key=>0);
            if (isset($subdata2[$key][$il])) $jm = count($subdata2[$key][$il]); else $jm = 0;
            $tmp['pro'][$key][] = $jm;
          }

          $tmp['ds'][$i]['backgroundColor'] = ["$jettycolor[$key]"];
          $tmp['ds'][$i]['borderColor'] = ["$jettycolor[$key]"];
          $tmp['ds'][$i]['borderWidth'] = 2;
          $tmp['ds'][$i]['data'] = $tmp['pro'][$key];
          $tmp['ds'][$i]['fill'] = false;
          $tmp['ds'][$i]['label'] = $jn;
          $i++;
        }
      break;
      case 'gerakanChart':

        $start = strtotime($request->start);
        $end = strtotime($request->end);

        $day1 = (60 * 60 * 24);

        $i=$n= 0;
        $items=$all=array();
        /////////////////////// data harian
        // $tmp['items']=array('$',"Rp","all",'Cilegon',"Serang","all");
        for($start; $start < $end; $start = $start+$day1) {
          $label = date('d.m',$start);
          $tmp['label'][] = $label; // ambil tanggal sumbu x

          $query = DB::table('tb_dls')
            ->join('tb_jettys', function ($join) {
              $join->on('tb_dls.jettys_id','tb_jettys.id');
            })
            ->where(function ($query) use ($start,$day1){
                $query->where('date', '>', $start)
                  ->Where('date', '<', $start+$day1);
            })
            ->select('tb_jettys.name as jettyName','tb_jettys.code as jettyCode', 'tb_dls.*')
            ->get();

          foreach ($query as $row) {
            if ($row->jettyCode=='')$row->jettyCode='unknow';
            else if ($row->jettyCode[0]=='S')$row->jettyCode='Serang';
            else $row->jettyCode='Cilegon';
            if (!$row->jettyCode) $row->jettyCode = '';
            $tmp['items'][] = $row->jettyCode;
            $data2[$label][] = $row->jettyCode;
          }
          if(!isset($data2[$label]))$data2[$label] = array();
          if(is_array($data2[$label]))$data[$label]=array_count_values($data2[$label]);
          $data[$label]['all']=count($data2[$label]);
        }
        $tmp['items'] = array_values(array_unique($tmp['items']));
        $tmp['items'][] = 'all';

        foreach ($tmp['items'] as $val){
          foreach ($tmp['label'] as $row) {
            if (!array_key_exists($val,$data[$row]))$data[$row][$val]=0;
            $tmp['ds'][$val]['data'][$row] = $data[$row][$val];
            $tmp['ds'][$val]['label'] = $val;
          }
          $tmp['ds'][$val]['data'] = array_values($tmp['ds'][$val]['data']);
        }

        $tmp['ds'] = array_values($tmp['ds']);

        $tmp['ds'][array_search('Serang',$tmp['items'])]['backgroundColor'] = 'rgb(54, 162, 235)';
        $tmp['ds'][array_search('Serang',$tmp['items'])]['borderColor'] = 'rgb(54, 162, 235)';
        $tmp['ds'][array_search('Serang',$tmp['items'])]['fill'] = false;

        $tmp['ds'][array_search('Cilegon',$tmp['items'])]['backgroundColor'] = 'rgb(255, 99, 132)';
        $tmp['ds'][array_search('Cilegon',$tmp['items'])]['borderColor'] = 'rgb(255, 99, 132)';
        $tmp['ds'][array_search('Cilegon',$tmp['items'])]['fill'] = false;

        $tmp['ds'][array_search('all',$tmp['items'])]['backgroundColor'] = 'rgba(201, 203, 207,0.3)';
        $tmp['ds'][array_search('all',$tmp['items'])]['borderColor'] = 'rgb(255, 159, 64)';
        $tmp['ds'][array_search('all',$tmp['items'])]['fill'] = true;
        // dd($tmp);
      break;
      case 'gerakanChart2':
        $m_end = strtotime($request->input('end'));
        $end = date('m',$m_end);
        $day1 = (60 * 60 * 24);

        $start = 1564592400;
        $end = 1567070789;

        // $start = strtotime($request->start);
        // $end = strtotime($request->end);

        $day1 = (60 * 60 * 24);

        $i=$n= 0;
        $items=$all=array();
        /////////////////////// data harian
        // $tmp['items']=array('$',"Rp","all",'Cilegon',"Serang","all");
        for($start; $start < $end; $start = $start+$day1) {
          ////////////// data dalam 1 tanggal //////////////
          $label = date('d.m',$start);
          $tmp['label'][] = $label; // ambil tanggal sumbu x

          $query = DB::table('tb_dls')
            ->join('tb_jettys', function ($join) {
              $join->on('tb_dls.jettys_id','tb_jettys.id');
            })
            ->where(function ($query) use ($start,$day1){
                $query->where('date', '>', $start)
                  ->Where('date', '<', $start+$day1);
            })
            ->select('tb_jettys.name as jettyName','tb_jettys.code as jettyCode', 'tb_dls.*')
            ->get();

          // $data['unknow'] = array();
          foreach ($query as $row) {
            if ($row->jettyCode=='')$row->jettyCode='unknow';
            else if ($row->jettyCode[0]=='S')$row->jettyCode='Serang';
            else $row->jettyCode='Cilegon';
            $tmp['items'][] = $row->jettyCode;
            $data2[$label][]=$row->jettyCode;
          }
          if(!isset($data2[$label]))$data2[$label][] = '';
          $data[$label]=array_count_values($data2[$label]);
          $data[$label]['all']=count($data2[$label]);
        }
        $tmp['items'] = array_values(array_unique($tmp['items']));
        $tmp['items'][] = 'all';

        foreach ($tmp['items'] as $val){
          foreach ($tmp['label'] as $row) {

            if (!array_key_exists($val,$data[$row]))$data[$row][$val]=0;
            $tmp['ds'][$val]['data'][$row] = $data[$row][$val];
            $tmp['ds'][$val]['label'] = $val;
          }
          $tmp['ds'][$val]['data'] = array_values($tmp['ds'][$val]['data']);
        }
        $tmp['ds'] = array_values($tmp['ds']);

        $tmp['ds'][array_search('Serang',$tmp['items'])]['backgroundColor'] = 'rgb(54, 162, 235)';
        $tmp['ds'][array_search('Serang',$tmp['items'])]['borderColor'] = 'rgb(54, 162, 235)';
        $tmp['ds'][array_search('Serang',$tmp['items'])]['fill'] = false;

        $tmp['ds'][array_search('Cilegon',$tmp['items'])]['backgroundColor'] = 'rgb(255, 99, 132)';
        $tmp['ds'][array_search('Cilegon',$tmp['items'])]['borderColor'] = 'rgb(255, 99, 132)';
        $tmp['ds'][array_search('Cilegon',$tmp['items'])]['fill'] = false;

        $tmp['ds'][array_search('all',$tmp['items'])]['backgroundColor'] = 'rgba(201, 203, 207,0.3)';
        $tmp['ds'][array_search('all',$tmp['items'])]['borderColor'] = 'rgb(255, 159, 64)';
        $tmp['ds'][array_search('all',$tmp['items'])]['fill'] = true;
        // dd($tmp);
      break;
      case 'rute':

        if($request->input('type')=='bulan'){
          $m_end = strtotime($request->input('end'));
          $end = date('m',$m_end);
          $day1 = (60 * 60 * 24);

          $i=$n= 0;
          $items=$all=array();
          /////////////////////// data harian
          for($start=0; $start < $end; $start++) {
            ////////////// data dalam 1 tanggal //////////////

            $startt = $start+1;
            $d_start=date('Y',$m_end).'-'. $startt .'-1';
            $d_end=date('Y-m-t',strtotime($d_start));
            // dd($d_end);
            $tmp['label'][] = date('M y',strtotime($d_start)); // ambil tanggal sumbu x
            // $tmp['label2'][]=strtotime($d_end);
            $query = DB::table('tb_ppjks')
              ->where(function ($query) use ($d_start,$d_end){
                $query->where('date_issue', '>=', strtotime($d_start))
                ->Where('date_issue', '<=', strtotime($d_end));
              })
              ->get();

              // $data['unknow'][$start] = array();
            foreach ($query as $row) {
              if ($row->rute==null)$row->rute='unknow';
              $data[$row->rute][$start][]=$row->rute;
              $all[$start][]=$row->rute;
              $data[$row->rute] = array_filter($data[$row->rute]);
            }
            $data['all']=$all;
          }
          $data = array_filter($data); //hapus element array yang kosong
          // dd($data);
          foreach ($data as $key=>$val){
            for($start=0; $start < $end; $start++) {
              if ($key=='')$key='unknow';
              if(isset($data[$key][$start]))$jumlah= count($data[$key][$start]);else $jumlah='';
              $tmp['ds'][$key]['borderWidth'] = 2;
              $tmp['ds'][$key]['data'][$start] = $jumlah;
              $tmp['ds'][$key]['label'] = $key;
              if(!in_array($key,$items,true))array_push($items,$key);
            }
            $i++;
          }
          $tmp['ds'] = array_values($tmp['ds']);
          $tmp['items']=$items;
        }
        // dd($items);
        // array_values($tmp['ds']);

        // $tmp['ds'][array_search('unknow',$items)]['backgroundColor'] = 'rgb(255, 205, 86)';
        // $tmp['ds'][array_search('unknow',$items)]['borderColor'] = 'rgb(255, 205, 86)';
        // $tmp['ds'][array_search('unknow',$items)]['fill'] = false;
        // $tmp['ds'][array_search('unknow',$items)]['borderDash'] = [5, 5];

        $tmp['ds'][array_search('Rp',$items)]['backgroundColor'] = 'rgb(54, 162, 235)';
        $tmp['ds'][array_search('Rp',$items)]['borderColor'] = 'rgb(54, 162, 235)';
        $tmp['ds'][array_search('Rp',$items)]['fill'] = false;

        $tmp['ds'][array_search('$',$items)]['backgroundColor'] = 'rgb(255, 99, 132)';
        $tmp['ds'][array_search('$',$items)]['borderColor'] = 'rgb(255, 99, 132)';
        $tmp['ds'][array_search('$',$items)]['fill'] = false;

        $tmp['ds'][array_search('all',$items)]['backgroundColor'] = 'rgba(201, 203, 207,0.3)';
        $tmp['ds'][array_search('all',$items)]['borderColor'] = 'rgb(255, 159, 64)';
        $tmp['ds'][array_search('all',$items)]['fill'] = true;

      break;
      case 'gerakan':
        if($request->input('type')=='bulan'){
          $m_end = strtotime($request->input('end'));
          $end = date('m',$m_end);
          $day1 = (60 * 60 * 24);

          $i=$n= 0;
          $items=$all=array();
          /////////////////////// data harian
          for($start=0; $start < $end; $start++) {
            ////////////// data dalam 1 tanggal //////////////
            $startt = $start+1;
            $d_start=date('Y',$m_end).'-'. $startt .'-1';
            $d_end=date('Y-m-t',strtotime($d_start));
            // dd($d_end);
            $tmp['label'][] = date('M y',strtotime($d_start)); // ambil tanggal sumbu x
            // $tmp['label2'][]=strtotime($d_end);
            $query = DB::table('tb_dls')
              ->join('tb_jettys', function ($join) {
                $join->on('tb_dls.jettys_id','tb_jettys.id');
              })
              ->where(function ($query) use ($d_start,$d_end){
                $query->where('date', '>=', strtotime($d_start))
                ->Where('date', '<=', strtotime($d_end));
              })
              ->select('tb_jettys.name as jettyName','tb_jettys.code as jettyCode', 'tb_dls.*')
              ->get();

            $data['unknow'] = array();
            foreach ($query as $row) {
              if ($row->jettyCode=='')$row->jettyCode='unknow';
              else if ($row->jettyCode[0]=='S')$row->jettyCode='Serang';
              else $row->jettyCode='Cilegon';

              $data[$row->jettyCode][$start][]=$row->jettyCode;
              $all[$start][]=$row->jettyCode;
            }
          }
          $data['all']=$all;
          $data = array_filter($data); //hapus element array yang kosong
          // dd($data);

          foreach ($data as $key=>$val){
            for($start=0; $start < $end; $start++) {
              if ($key=='')$key='unknow';
              if(isset($data[$key][$start]))$jumlah= count($data[$key][$start]);else $jumlah='';
              $tmp['ds'][$key]['borderWidth'] = 2;
              $tmp['ds'][$key]['data'][$start] = $jumlah;
              $tmp['ds'][$key]['label'] = $key;
              if(!in_array($key,$items,true))array_push($items,$key);
            }
            $i++;
          }
          $tmp['ds'] = array_values($tmp['ds']);
          $tmp['items']=$items;
        }
        // dd($items);
        // array_values($tmp['ds']);

        $tmp['ds'][array_search('Serang',$items)]['backgroundColor'] = 'rgb(54, 162, 235)';
        $tmp['ds'][array_search('Serang',$items)]['borderColor'] = 'rgb(54, 162, 235)';
        $tmp['ds'][array_search('Serang',$items)]['fill'] = false;

        $tmp['ds'][array_search('Cilegon',$items)]['backgroundColor'] = 'rgb(255, 99, 132)';
        $tmp['ds'][array_search('Cilegon',$items)]['borderColor'] = 'rgb(255, 99, 132)';
        $tmp['ds'][array_search('Cilegon',$items)]['fill'] = false;

        $tmp['ds'][array_search('all',$items)]['backgroundColor'] = 'rgba(201, 203, 207,0.3)';
        $tmp['ds'][array_search('all',$items)]['borderColor'] = 'rgb(255, 159, 64)';
        $tmp['ds'][array_search('all',$items)]['fill'] = true;

      break;
      case 'rutegrt':
        if($request->input('type')=='bulan'){
          $m_end = strtotime($request->input('end'));
          $end = date('m',$m_end);
          $day1 = (60 * 60 * 24);

          $i=$n= 0;
          $items=$all=array();
          /////////////////////// data harian
          for($start=0; $start < $end; $start++) {
            ////////////// data dalam 1 tanggal //////////////
            $startt = $start+1;
            $d_start=date('Y',$m_end).'-'. $startt .'-1';
            $d_end=date('Y-m-t',strtotime($d_start));
            // dd($d_end);
            $tmp['label'][] = date('M y',strtotime($d_start)); // ambil tanggal sumbu x
            // $tmp['label2'][]=strtotime($d_end);
            $query = DB::table('tb_ppjks')
              ->join('tb_kapals', function ($join) {
                $join->on('tb_ppjks.kapals_id','tb_kapals.id');
              })
              ->where(function ($query) use ($d_start,$d_end){
                $query->where('date_issue', '>', strtotime($d_start))
                ->Where('date_issue', '<', strtotime($d_end));
              })
              ->select('tb_kapals.grt as kapalsGrt', 'tb_ppjks.*')
              ->get();

              // dd($d_start.','.$d_end);
            foreach ($query as $row) {
              if ($row->kapalsGrt>18000)$group='up'; else $group='down';
              if ($row->rute==null)$row->rute='unknow';
              $data[$group][$row->rute][$start][]=$row->rute;
              $all[$group][$start][]=$row->rute;
              $data[$group][$row->rute] = array_filter($data[$group][$row->rute]);
            }
          }
          $data['down']['all']=$all['down'];
          $data['up']['all']=$all['up'];
          $data['down'] = array_filter($data['down']); //hapus element array yang kosong
          $data['up'] = array_filter($data['up']);

          foreach ($data['down'] as $key=>$val){
            for($start=0; $start < $end; $start++) {
              if ($key=='')$key='unknow';
              if(isset($data['down'][$key][$start]))$jumlah= count($data['down'][$key][$start]);else $jumlah='';
              $tmp['ds']['d-'.$key]['borderWidth'] = 2;
              $tmp['ds']['d-'.$key]['data'][$start] = $jumlah;
              $tmp['ds']['d-'.$key]['label'] = 'd-'.$key;
              if(!in_array('d-'.$key,$items,true))array_push($items,'d-'.$key);
            }
            $i++;
          }
          foreach ($data['up'] as $key=>$val){
            for($start=0; $start < $end; $start++) {
              if ($key=='')$key='unknow';
              if(isset($data['up'][$key][$start]))$jumlah= count($data['up'][$key][$start]);else $jumlah='';
              $tmp['ds']['u-'.$key]['borderWidth'] = 2;
              $tmp['ds']['u-'.$key]['data'][$start] = $jumlah;
              $tmp['ds']['u-'.$key]['label'] = 'u-'.$key;
              if(!in_array('u-'.$key,$items,true))array_push($items,'u-'.$key);
            }
            $i++;
          }
          $tmp['ds'] = array_values($tmp['ds']);
          $tmp['items']=$items;
        }
        // dd($tmp['items']);
        // dd($tmp['ds']);
        // array_values($tmp['ds']);
        //
        // $tmp['ds'][array_search('u-unknow',$items)]['backgroundColor'] = 'rgb(255, 205, 86)';
        // $tmp['ds'][array_search('u-unknow',$items)]['borderColor'] = 'rgb(255, 205, 86)';
        // $tmp['ds'][array_search('u-unknow',$items)]['fill'] = false;
        // $tmp['ds'][array_search('u-unknow',$items)]['borderDash'] = [5, 5];

        $tmp['ds'][array_search('u-Rp',$items)]['backgroundColor'] = 'rgb(54, 162, 235)';
        $tmp['ds'][array_search('u-Rp',$items)]['borderColor'] = 'rgb(54, 162, 235)';
        $tmp['ds'][array_search('u-Rp',$items)]['fill'] = false;

        $tmp['ds'][array_search('u-$',$items)]['backgroundColor'] = 'rgb(255, 99, 132)';
        $tmp['ds'][array_search('u-$',$items)]['borderColor'] = 'rgb(255, 99, 132)';
        $tmp['ds'][array_search('u-$',$items)]['fill'] = false;

        $tmp['ds'][array_search('u-all',$items)]['backgroundColor'] = 'rgba(201, 203, 207,0.3)';
        $tmp['ds'][array_search('u-all',$items)]['borderColor'] = 'rgb(255, 159, 64)';
        $tmp['ds'][array_search('u-all',$items)]['fill'] = false;

        //
        // $tmp['ds'][array_search('d-unknow',$items)]['backgroundColor'] = 'rgb(255, 205, 0)';
        // $tmp['ds'][array_search('d-unknow',$items)]['borderColor'] = 'rgb(255, 205, 0)';
        // $tmp['ds'][array_search('d-unknow',$items)]['fill'] = false;
        // $tmp['ds'][array_search('d-unknow',$items)]['borderDash'] = [5, 5];

        $tmp['ds'][array_search('d-Rp',$items)]['backgroundColor'] = 'rgb(54, 162, 149)';
        $tmp['ds'][array_search('d-Rp',$items)]['borderColor'] = 'rgb(54, 162, 149)';
        $tmp['ds'][array_search('d-Rp',$items)]['fill'] = false;

        $tmp['ds'][array_search('d-$',$items)]['backgroundColor'] = 'rgb(255, 99, 46)';
        $tmp['ds'][array_search('d-$',$items)]['borderColor'] = 'rgb(255, 99, 46)';
        $tmp['ds'][array_search('d-$',$items)]['fill'] = false;

        $tmp['ds'][array_search('d-all',$items)]['backgroundColor'] = 'rgba(201, 203, 207,0.3)';
        $tmp['ds'][array_search('d-all',$items)]['borderColor'] = 'rgb(255, 100, 0)';
        $tmp['ds'][array_search('d-all',$items)]['fill'] = false;

      break;
      case 'pandu':
        if($request->input('type')=='bulan'){
          $m_end = strtotime($request->input('end'));
          $end = date('m',$m_end);
          $day1 = (60 * 60 * 24);

          $i=$n= 0;
          $items=$all=array();
          /////////////////////// data harian
          for($start=0; $start < $end; $start++) {
            ////////////// data dalam 1 tanggal //////////////
            $startt = $start+1;
            $d_start=date('Y',$m_end).'-'. $startt .'-1';
            $d_end=date('Y-m-t',strtotime($d_start));
            // dd($d_end);
            $tmp['label'][] = date('M y',strtotime($d_start)); // ambil tanggal sumbu x
            // $tmp['label2'][]=strtotime($d_end);
            $query = DB::table('tb_dls')
              ->where(function ($query) use ($d_start,$d_end){
                $query->where('date', '>', strtotime($d_start))
                ->Where('date', '<', strtotime($d_end));
              })
              ->get();

              $data['unknow'][$start] = array();
            foreach ($query as $row) {
              if ($row->pc==null)$row->pc='unknow';
              $data[$row->pc][$start][]=$row->pc;
              $all[$start][]=$row->pc;
              $data[$row->pc] = array_filter($data[$row->pc]);
            }
          }
          $data['all']=$all;
          $data = array_filter($data); //hapus element array yang kosong
          // dd($data);

          foreach ($data as $key=>$val){
            for($start=0; $start < $end; $start++) {
              if ($key=='')$key='unknow';
              if(isset($data[$key][$start]))$jumlah= count($data[$key][$start]);else $jumlah='';
              $tmp['ds'][$key]['borderWidth'] = 2;
              $tmp['ds'][$key]['data'][$start] = $jumlah;
              $tmp['ds'][$key]['label'] = $key;
              if(!in_array($key,$items,true))array_push($items,$key);
            }
            $i++;
          }
          $tmp['ds'] = array_values($tmp['ds']);
          $tmp['items']=$items;
        }
        // dd($tmp);
        // array_values($tmp['ds']);

        $tmp['ds'][array_search('unknow',$items)]['backgroundColor'] = 'rgb(255, 205, 86)';
        $tmp['ds'][array_search('unknow',$items)]['borderColor'] = 'rgb(255, 205, 86)';
        $tmp['ds'][array_search('unknow',$items)]['fill'] = false;
        $tmp['ds'][array_search('unknow',$items)]['borderDash'] = [5, 5];

        $tmp['ds'][array_search('12',$items)]['backgroundColor'] = 'rgb(54, 162, 235)';
        $tmp['ds'][array_search('12',$items)]['borderColor'] = 'rgb(54, 162, 235)';
        $tmp['ds'][array_search('12',$items)]['fill'] = false;

        $tmp['ds'][array_search('15',$items)]['backgroundColor'] = 'rgb(100, 255, 132)';
        $tmp['ds'][array_search('15',$items)]['borderColor'] = 'rgb(100, 255, 132)';
        $tmp['ds'][array_search('15',$items)]['fill'] = false;

        $tmp['ds'][array_search('16',$items)]['backgroundColor'] = 'rgb(54, 162, 185)';
        $tmp['ds'][array_search('16',$items)]['borderColor'] = 'rgb(54, 162, 185)';
        $tmp['ds'][array_search('16',$items)]['fill'] = false;

        $tmp['ds'][array_search('18',$items)]['backgroundColor'] = 'rgb(200, 100, 100)';
        $tmp['ds'][array_search('18',$items)]['borderColor'] = 'rgb(200, 100, 100)';
        $tmp['ds'][array_search('18',$items)]['fill'] = false;

        $tmp['ds'][array_search('20',$items)]['backgroundColor'] = 'rgb(54, 162, 135)';
        $tmp['ds'][array_search('20',$items)]['borderColor'] = 'rgb(54, 162, 135)';
        $tmp['ds'][array_search('20',$items)]['fill'] = false;

        $tmp['ds'][array_search('24',$items)]['backgroundColor'] = 'rgb(255, 99, 32)';
        $tmp['ds'][array_search('24',$items)]['borderColor'] = 'rgb(255, 99, 32)';
        $tmp['ds'][array_search('24',$items)]['fill'] = false;

        $tmp['ds'][array_search('26',$items)]['backgroundColor'] = 'rgb(54, 255, 235)';
        $tmp['ds'][array_search('26',$items)]['borderColor'] = 'rgb(54, 255, 235)';
        $tmp['ds'][array_search('26',$items)]['fill'] = false;

        $tmp['ds'][array_search('C3',$items)]['backgroundColor'] = 'rgb(255, 200, 132)';
        $tmp['ds'][array_search('C3',$items)]['borderColor'] = 'rgb(255, 200, 132)';
        $tmp['ds'][array_search('C3',$items)]['fill'] = false;

        $tmp['ds'][array_search('C11',$items)]['backgroundColor'] = 'rgb(50, 100, 235)';
        $tmp['ds'][array_search('C11',$items)]['borderColor'] = 'rgb(50, 100, 235)';
        $tmp['ds'][array_search('C11',$items)]['fill'] = false;

        $tmp['ds'][array_search('C13',$items)]['backgroundColor'] = 'rgb(255, 0, 132)';
        $tmp['ds'][array_search('C13',$items)]['borderColor'] = 'rgb(255, 0, 132)';
        $tmp['ds'][array_search('C13',$items)]['fill'] = false;

        $tmp['ds'][array_search('C14',$items)]['backgroundColor'] = 'rgb(54, 112, 185)';
        $tmp['ds'][array_search('C14',$items)]['borderColor'] = 'rgb(54, 112, 185)';
        $tmp['ds'][array_search('C14',$items)]['fill'] = false;

        $tmp['ds'][array_search('C15',$items)]['backgroundColor'] = 'rgb(200, 80, 200)';
        $tmp['ds'][array_search('C15',$items)]['borderColor'] = 'rgb(200, 80, 200)';
        $tmp['ds'][array_search('C15',$items)]['fill'] = false;

        $tmp['ds'][array_search('all',$items)]['backgroundColor'] = 'rgba(201, 203, 207,0.3)';
        $tmp['ds'][array_search('all',$items)]['borderColor'] = 'rgb(255, 159, 64)';
        $tmp['ds'][array_search('all',$items)]['fill'] = true;

      break;
    }
    // $tmp['hasil'] = $tmp['pro'][1][0][1];
    return $tmp;
  }
}
