<?php

namespace App\Http\Controllers\Oprasional\Invoice;
date_default_timezone_set('Asia/Jakarta');
setlocale (LC_TIME, 'IND');

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\InvoiceHelpers;
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

    $category = $request->input('page', 'unknow');
    switch ($category) {
      case 'invoice-dompdf':
        $result = DB::table('tb_ppjks')
          ->leftJoin('tb_agens', function ($join) {
            $join->on('tb_agens.id','tb_ppjks.agens_id');
          })
          ->leftJoin('tb_kapals', function ($join) {
            $join->on('tb_kapals.id','tb_ppjks.kapals_id');
          })
          // ->leftJoin('tb_jettys', function ($join) {
          //   $join->on('tb_jettys.id','tb_dls.jettys_id');
          // })
          // ->RightJoin('tb_ppjks', function ($join) {
          //   $join->on('tb_ppjks.id','tb_dls.ppjks_id');
          // })
          ->where(function ($query) use ($mulai,$akhir,$request){
            $query->where('tb_ppjks.bstdo','!=','');
            $query->where('tb_ppjks.id',$request->input('id',''));
          })
          ->select(
            'tb_agens.name as agenName',
            'tb_agens.alamat as agenAlamat',
            'tb_agens.tlp as agenTlp',
            'tb_kapals.name as kapalsName',
            'tb_kapals.jenis as kapalsJenis',
            'tb_kapals.grt as kapalsGrt',
            // 'tb_jettys.code as jettyCode',
            // 'tb_jettys.color as jettyColor',
            // 'tb_kapals.loa as kapalsLoa',
            // 'tb_kapals.bendera as kapalsBendera',
            // 'tb_jettys.name as jettyName',
            'tb_ppjks.*'
            // 'tb_dls.*'
          )
          ->first();
        $query = DB::table('tb_dls')
          ->leftJoin('tb_jettys', function ($join) {
            $join->on('tb_jettys.id','tb_dls.jettys_id');
          })
          ->where(function ($query) use ($result){
            $query->where('tb_dls.ppjks_id',$result->id);
          })
          ->select(
            'tb_jettys.code as jettyCode',
            'tb_jettys.name as jettyName',
            'tb_dls.*'
          )
          ->orderBy('tundaon', 'asc')
          ->get();

        $kurs = DB::table('tb_kurs')
          ->where(function ($query) use ($result){
            $query->where('date',$result->dkurs);
          })
          ->first();

        $tempo = strftime("%d %B %Y",cek_libur($result->tglinv,3));


        $page = 'backend.oprasional.pdfinvoice.'.$request->input('page');
        $nfile = $request->input('file');
        $orientation = 'landscape';

        $view =  \View::make($page, compact('result','query','kurs','tempo'))->render();
        // return view($page, compact('result','mulai'));
      break;
      case 'invoice-dompdf2':
        $result = DB::table('tb_ppjks')
          ->leftJoin('tb_agens', function ($join) {
            $join->on('tb_agens.id','tb_ppjks.agens_id');
          })
          ->leftJoin('tb_kapals', function ($join) {
            $join->on('tb_kapals.id','tb_ppjks.kapals_id');
          })
          // ->leftJoin('tb_jettys', function ($join) {
          //   $join->on('tb_jettys.id','tb_dls.jettys_id');
          // })
          // ->RightJoin('tb_ppjks', function ($join) {
          //   $join->on('tb_ppjks.id','tb_dls.ppjks_id');
          // })
          ->where(function ($query) use ($mulai,$akhir,$request){
            $query->where('tb_ppjks.bstdo','!=','');
            $query->where('tb_ppjks.id',$request->input('id',''));
          })
          ->select(
            'tb_agens.name as agenName',
            'tb_agens.alamat as agenAlamat',
            'tb_agens.tlp as agenTlp',
            'tb_kapals.name as kapalsName',
            'tb_kapals.jenis as kapalsJenis',
            'tb_kapals.grt as kapalsGrt',
            // 'tb_jettys.code as jettyCode',
            // 'tb_jettys.color as jettyColor',
            // 'tb_kapals.loa as kapalsLoa',
            // 'tb_kapals.bendera as kapalsBendera',
            // 'tb_jettys.name as jettyName',
            'tb_ppjks.*'
            // 'tb_dls.*'
          )
          ->first();
        $query = DB::table('tb_dls')
          ->leftJoin('tb_jettys', function ($join) {
            $join->on('tb_jettys.id','tb_dls.jettys_id');
          })
          ->where(function ($query) use ($result){
            $query->where('tb_dls.ppjks_id',$result->id);
          })
          ->select(
            'tb_jettys.code as jettyCode',
            'tb_jettys.name as jettyName',
            'tb_dls.*'
          )
          ->orderBy('tundaon', 'asc')
          ->get();

        $kurs = DB::table('tb_kurs')
          ->where(function ($query) use ($result){
            $query->where('date',$result->dkurs);
          })
          ->first();

        $page = 'backend.oprasional.pdfinvoice.'.$request->input('page');
        $nfile = $request->input('file');
        $orientation = 'landscape';

        $view =  \View::make($page, compact('result','query','kurs'))->render();
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
function cek_libur($day,$n,$status='false'){
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
    return cek_libur($day,$n,$status);
  }
  return $day;
}
