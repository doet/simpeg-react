<?php

namespace App\Http\Controllers\Oprasional;
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
    if ($request->start)$mulai = strtotime($request->start); else $mulai = '';
    if ($request->end)$akhir = strtotime($request->end); else $akhir = '';

    // $akhir = '05 March 2019';
    $sord = $request->input('sord', 'asc');
    $sidx = $request->input('sidx', 'id');

    $category = $request->input('page', 'unknow');

    // dd($request->input());
    switch ($category) {
      case 'ppjk1-dompdf': //Pengajuan Pembiyayaan
      // dd($request->input());
        $result = DB::table('tb_ppjks')
          // ->leftJoin('tb_ppjks', function ($join) {
          //   $join->on('tb_ppjks.id','tb_dls.ppjks_id');
          // })
          ->leftJoin('tb_agens', function ($join) {
            $join->on('tb_agens.id','tb_ppjks.agens_id');
          })
          ->leftJoin('tb_kapals', function ($join) {
            $join->on('tb_kapals.id','tb_ppjks.kapals_id');
          })
          ->leftJoin('tb_jettys', function ($join) {
            $join->on('tb_jettys.id','tb_ppjks.jettys_idx');
          })
          ->where(function ($query) use ($mulai,$akhir,$request){
              // if (array_key_exists("bstdo",$request->input())){
              //   $query->where('tb_ppjks.bstdo', strtotime($request->input('bstdo')));
              // } else if (array_key_exists("lstp_ck",$request->input())){
              //   $query->where('tb_ppjks.lstp_ck', strtotime($request->input('lstp_ck')));
              // } else {

                if($akhir==0)$akhir = $mulai+(60 * 60 * 24);
                $query->where('tb_ppjks.date_issue', '>=', $mulai)
                  ->Where('tb_ppjks.date_issue', '<=', $akhir);
              // }
          })
          ->select(
            'tb_kapals.name as kapalsName',
            'tb_kapals.grt as kapalsGrt',
            'tb_kapals.loa as kapalsLoa',
            'tb_kapals.bendera as kapalsBendera',
            'tb_jettys.name as jettyName',
            'tb_agens.code as agenCode',
            // 'tb_kapals.jenis as kapalsJenis',
            // 'tb_jettys.code as jettyCode',
            // // 'tb_jettys.color as jettyColor',
            'tb_ppjks.*'
            // 'tb_dls.*'
          )
          ->orderBy('date_issue', 'asc')
          ->get();
          // $result = json_encode(json_decode($qu));
          // $result = json_decode($result,true);
          // if ($result['records']>1) $result = $result['rows']; else $result = array();
          // $result = $request->data;
          // print_r ($query);
          // dd($result);
          $page = 'backend.oprasional.pdf.'.$request->input('page');
          $nfile = $request->input('file');
          $orientation = 'portrait';
          // dd($request->input());
          $view =  \View::make($page, compact('result','mulai'))->render();
          $customPaper = "A4";
      break;
      case 'dl-dompdf': //Pengajuan Pembiyayaan
        $result = DB::table('tb_dls')
          ->leftJoin('tb_ppjks', function ($join) {
            $join->on('tb_ppjks.id','tb_dls.ppjks_id');
          })
          ->leftJoin('tb_agens', function ($join) {
            $join->on('tb_agens.id','tb_ppjks.agens_id');
          })
          ->leftJoin('tb_kapals', function ($join) {
            $join->on('tb_kapals.id','tb_ppjks.kapals_id');
          })
          ->leftJoin('tb_jettys', function ($join) {
            $join->on('tb_jettys.id','tb_dls.jettys_id');
          })
          ->where(function ($query) use ($mulai,$akhir,$request){
              if (array_key_exists("bstdo",$request->input())){
                $query->where('tb_ppjks.bstdo', strtotime($request->input('bstdo')));
              } else if (array_key_exists("lstp_ck",$request->input())){
                $query->where('tb_ppjks.lstp_ck', strtotime($request->input('lstp_ck')));
              } else {
                if($akhir==0)$akhir = $mulai+(60 * 60 * 24);
                $query->where('tb_dls.date', '>=', $mulai)
                  ->Where('tb_dls.date', '<=', $akhir-1);
              }
          })
          ->select(
            'tb_agens.code as agenCode',
            'tb_kapals.name as kapalsName',
            'tb_kapals.jenis as kapalsJenis',
            'tb_kapals.grt as kapalsGrt',
            'tb_kapals.loa as kapalsLoa',
            'tb_kapals.bendera as kapalsBendera',
            'tb_jettys.name as jettyName',
            'tb_jettys.code as jettyCode',
            // 'tb_jettys.color as jettyColor',
            'tb_ppjks.*',
            'tb_dls.*'
          )
          ->orderBy($sidx, $sord)
          ->get();
          // $result = json_encode(json_decode($qu));
          // $result = json_decode($result,true);
          // if ($result['records']>1) $result = $result['rows']; else $result = array();
          // $result = $request->data;
          // print_r ($query);
          // dd($result);
          $page = 'backend.oprasional.pdf.'.$request->input('page');
          $nfile = $request->input('file');
          $orientation = 'landscape';
          // dd($result);
          $view =  \View::make($page, compact('result','mulai'))->render();
          $customPaper = "A4";
      break;
      case 'lhp1-dompdf':
        // dd($request->input());
        // dd(strtotime('1-'.date('m-Y',$mulai)));
        $result = DB::table('tb_dls')
          ->leftJoin('tb_ppjks', function ($join) {
            $join->on('tb_ppjks.id','tb_dls.ppjks_id');
          })
          ->leftJoin('tb_agens', function ($join) {
            $join->on('tb_agens.id','tb_ppjks.agens_id');
          })
          ->leftJoin('tb_kapals', function ($join) {
            $join->on('tb_kapals.id','tb_ppjks.kapals_id');
          })
          ->leftJoin('tb_jettys', function ($join) {
            $join->on('tb_jettys.id','tb_dls.jettys_id');
          })
          ->where(function ($query) use ($mulai,$akhir,$request){

            if ($request->input('ext1')=='lhp1'){
              $query->where('tb_ppjks.lhp', $mulai);
            } else if ($request->input('ext1')=='lhp2'){
              // $akhir = $mulai+(60 * 60 * 24);
              // $akhir = $mulai
              $query->where('tb_ppjks.lhp', '>=', strtotime('1-'.date('m-Y',$mulai)));
                // $query->Where('tb_ppjks.lhp', '<=', );
              // $query->where('tb_ppjks.lhp', $akhir);
            }
          })
          ->select(
            'tb_agens.code as agenCode',
            'tb_kapals.name as kapalsName',
            'tb_kapals.jenis as kapalsJenis',
            'tb_kapals.grt as kapalsGrt',
            'tb_kapals.loa as kapalsLoa',
            'tb_kapals.bendera as kapalsBendera',
            'tb_jettys.name as jettyName',
            'tb_jettys.code as jettyCode',
            // 'tb_jettys.color as jettyColor',
            'tb_ppjks.*',
            'tb_dls.*'
          )
          ->orderBy('ppjk')
          ->orderBy('date', 'asc')
          ->orderBy('tb_dls.id', 'asc')

          ->get();
          // dd(strtotime($mulai));
        // $result = json_encode(json_decode($qu));
        // $result = json_decode($result,true);
        // if ($result['records']>1) $result = $result['rows']; else $result = array();
        // $result = $request->data;
        // print_r ($query);

        // dd()

        if ($request->input('ext1')=='lhp2'){
          $request->page = 'lhp2-dompdf';
          $customPaper = array(0,0,595.276,935.4331);
        } else {
          $customPaper = "A4";
        }
        // dd($request->page);

        $page = 'backend.oprasional.pdf.'.$request->page;
        $nfile = $request->input('file');
        $orientation = 'landscape';

        $view =  \View::make($page, compact('result','mulai'))->render();
      break;
      case 'lstp-dompdf':

      // dd($mulai);
        $result = DB::table('tb_ppjks')
          ->leftJoin('tb_agens', function ($join) {
            $join->on('tb_ppjks.agens_id', 'tb_agens.id');
          })
          ->leftJoin('tb_kapals', function ($join) {
            $join->on('tb_ppjks.kapals_id', 'tb_kapals.id');
          })
          ->leftJoin('tb_jettys', function ($join) {
            $join->on('tb_ppjks.jettys_idx', 'tb_jettys.id');
          })
          ->where(function ($query) use ($mulai,$akhir,$request){
            if($request->ext=='ext1'){
              $query->where('lstp_req',$mulai);
            } else if($request->ext=='ext2'){
              // $query->where('lstp_req',$mulai);
              $query->where('lstp_req', '>=', strtotime('1-'.date('m-Y',$mulai)))
                ->Where('lstp_req', '<=', $mulai+(60 * 60 * 24));
            };
            $query->where('lhp','!=','');
            // $query->where('bstdo',null);

            if ($request->input('s_id')) {
              $query->where('tb_ppjks.id', $request->input('s_id'));
            } else {
              // $mulai = strtotime($mulai);
              // $akhir = strtotime($akhir);
              // if($akhir==0)$akhir = $mulai+(60 * 60 * 24);
              // $query->where('date_issue', '>=', $mulai)
              //   ->Where('date_issue', '<=', $akhir);
            }
          })
          ->select(
            'tb_agens.code as agenCode',
            'tb_kapals.name as kapalsName',
            'tb_kapals.bendera as kapalsBendera',
            'tb_jettys.code as jettyCode',
            'tb_jettys.name as jettyName',
          //   // 'tb_jettys.color as jettyColor',
            'tb_ppjks.*'
          )
          ->orderBy('lstp_req', 'desc')
          ->get();

          $page = 'backend.oprasional.pdf.'.$request->input('page');
          $nfile = $request->input('file');
          $orientation = 'portrait';
          // dd($request->input());
          $view =  \View::make($page, compact('result','mulai'))->render();
          $customPaper = "A4";
      break;
      case 'bstdo-dompdf':
      // dd($request->input());
        $result = DB::table('tb_dls')
          ->join('tb_ppjks', function ($join) {
            $join->on('tb_ppjks.id','tb_dls.ppjks_id');
          })
          ->leftJoin('tb_jettys', function ($join) {
            $join->on('tb_jettys.id', '=', 'tb_dls.jettys_id');
          })
          ->leftJoin('tb_kapals', function ($join) {
            $join->on('tb_kapals.id', 'tb_ppjks.kapals_id');
          })
          ->leftJoin('tb_agens', function ($join) {
            $join->on('tb_agens.id', '=', 'tb_ppjks.agens_id');
          })
          ->where(function ($query) use ($mulai,$akhir,$request){
            if ($request->input('bstdo') != null) {
              $query->where('bstdo',$request->input('bstdo'));
            } else {
              $akhir = strtotime('1-'.date('m-Y',$mulai));

            }
          })
          ->select(
            'tb_jettys.code as jettyCode',
            'tb_kapals.jenis as kapalsJenis',
            'tb_agens.code as agenCode',
            'tb_kapals.name as kapalsName',
            'tb_kapals.grt as kapalsGrt',
            'tb_kapals.loa as kapalsLoa',
            'tb_kapals.bendera as kapalsBendera',
            'tb_jettys.name as jettyName',
            // 'tb_jettys.color as jettyColor',
            // 'tb_kapals.*',
            // 'tb_agens.*',
            // 'tb_jettys.*',
            'tb_ppjks.*',
            'tb_dls.*'
          )
          ->orderBy('ppjk', 'asc')
          ->orderBy('date', 'asc')
          ->orderBy('tb_dls.id', 'asc')
          ->get();

          // dd($request->input());
        // $result = json_encode(json_decode($qu));
        // $result = json_decode($result,true);
        // if ($result['records']>1) $result = $result['rows']; else $result = array();
        // $result = $request->data;
        // print_r ($query);

        // $mulai = strtotime($mulai);
        // dd($result);

        $page = 'backend.oprasional.pdf.'.$request->input('page');
        $nfile = $request->input('file');
        $orientation = 'landscape';
        // dd($mulai);
        $view =  \View::make($page, compact('result','mulai'))->render();
        // return view($page, compact('result','mulai'));
        $customPaper = "A4";
      break;
    }

    // return view($page, compact('result','mulai'));

    $pdf = \App::make('dompdf.wrapper');

    $pdf->loadHTML($view)
        //->setOrientation($orientation)
        ->setPaper($customPaper,$orientation);

    $dom_pdf = $pdf->getDomPDF();
    $canvas = $dom_pdf->get_canvas();

    $canvas->page_text(30, 805, "Halaman {PAGE_NUM} dari {PAGE_COUNT}", null, 8, array(0, 0, 0));

    return $pdf->stream($nfile);

    // } else { echo "page tidak dapat di diperbaharui, silahkan kembali kehalaman sebelum";}
  }
}
