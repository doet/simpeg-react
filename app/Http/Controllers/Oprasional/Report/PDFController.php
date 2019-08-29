<?php

namespace App\Http\Controllers\Oprasional\Report;
date_default_timezone_set('Asia/Jakarta');

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Auth;

class PDFController extends Controller
{
  // /**
  //  * Create a new controller instance.
  //  *
  //  * @return void
  //  */
  // public function __construct()
  // {
  //     $this->middleware('auth');
  // }
  //
  // /**
  //  * Show the application dashboard.
  //  *
  //  * @return \Illuminate\Http\Response
  //  */

  public function PDFMarker(Request $request){
    $mulai = $request->input('start', '0');
    $akhir = $request->input('end', '0');
    // $akhir = '05 March 2019';
    $sord = $request->input('sord', 'asc');
    $sidx = $request->input('sidx', 'id');

    $case = $request->input('case', 'unknow');
    $tmp['img'] = $request->input('img');
    switch ($case) {
      case 'rute':
        // if($request->input('type')=='bulan'){
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
        // }
        $page = 'backend.oprasional.pdfreport.'.$request->input('case');
        $nfile = $request->input('file');
        $orientation = 'potrait';

        $view =  \View::make($page, compact('akhir','tmp'))->render();
        // return view($page, compact('result','mulai'));
      break;
      case 'gerakan':
        // if($request->input('type')=='bulan'){
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
                $query->where('date', '>', strtotime($d_start))
                ->Where('date', '<', strtotime($d_end));
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
        // }
        $page = 'backend.oprasional.pdfreport.'.$request->input('case');
        $nfile = $request->input('file');
        $orientation = 'potrait';

        $view =  \View::make($page, compact('akhir','tmp'))->render();
        // return view($page, compact('result','mulai'));
      break;
      case 'rutegrt':
        // if($request->input('type')=='bulan'){
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

              // $data['down']['unknow'][$start] = array();
              // $data['up']['unknow'][$start] = array();
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
        // }
        $page = 'backend.oprasional.pdfreport.'.$request->input('case');
        $nfile = $request->input('file');
        $orientation = 'potrait';

        $view =  \View::make($page, compact('akhir','tmp'))->render();
        // return view($page, compact('result','mulai'));
      break;
      case 'pandu':
        // if($request->input('type')=='bulan'){
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
        // }
        // dd($tmp);
        $page = 'backend.oprasional.pdfreport.'.$request->input('case');
        $nfile = $request->input('file');
        $orientation = 'potrait';

        $view =  \View::make($page, compact('akhir','tmp'))->render();
        // return view($page, compact('result','mulai'));
      break;
    }

    // return view($page, compact('result','mulai'));

    $pdf = \App::make('dompdf.wrapper');

    $customPaper = array(0,0,595.276,935.4331);
    $pdf->setPaper($customPaper,$orientation);

    $pdf->loadHTML($view);
        //->setOrientation($orientation)
        // ->setPaper('A4',$orientation);

    return $pdf->stream($nfile);

    // } else { echo "page tidak dapat di diperbaharui, silahkan kembali kehalaman sebelum";}
  }
}
