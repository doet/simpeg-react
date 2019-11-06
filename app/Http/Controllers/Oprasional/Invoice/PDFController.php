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
        $helperInv = InvoiceHelpers::items_inv($request->id);
        $page = 'backend.oprasional.pdfinvoice.'.$request->input('page');
        $nfile = $request->input('file');
        $orientation = 'landscape';

        $view =  \View::make($page, compact('helperInv'))->render();
        // return view($page, compact('result','mulai'));
        $customPaper = array(0,0,595.276,935.4331);
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
        $customPaper = array(0,0,595.276,935.4331);
      break;
      case 'kwitansi-dompdf':

        $query = DB::table('tb_inv')
          ->leftJoin('tb_ppjks', function ($join) {
            $join->on('tb_ppjks.id','tb_inv.ppjks_id');
          })
          ->leftJoin('tb_kapals', function ($join) {
            $join->on('tb_kapals.id','tb_ppjks.kapals_id');
          })
          ->where(function ($query) use ($request){
            $query->where('no_kwn',$request->id);
          })
          // ->select(
          //   'tb_jettys.code as jettyCode',
          //   'tb_jettys.name as jettyName',
          //   'tb_dls.*'
          // )
          // ->orderBy('tundaon', 'asc')
          ->get();

        $page = 'backend.oprasional.pdfinvoice.'.$request->input('page');
        $nfile = $request->input('file');
        $orientation = 'landscape';

        $view =  \View::make($page, compact('query','request'))->render();
        // return view($page, compact('result','mulai'));

        $customPaper = array(0,0,459.213,566.929);
      break;

      case 'inv_khusus-dompdf':
        $helperInv = InvoiceHelpers::items_inv($request->id);
        $page = 'backend.oprasional.pdfinvoice.'.$request->input('page');
        $nfile = $request->input('file');
        $orientation = 'landscape';

        $view =  \View::make($page, compact('helperInv'))->render();
        // return view($page, compact('result','mulai'));
        $customPaper = array(0,0,595.276,935.4331);
      break;
      
      case 'report_invoice-dompdf':
        $query = DB::table('tb_ppjks')
          ->where(function ($query) use ($request){
            if ($request->mulai!=null)$query->where('tb_ppjks.tglinv', strtotime($request->mulai));
            $query->where('tb_ppjks.bstdo','!=','');
            if ($request->input('s_id')) {
              $query->where('tb_ppjks.id', $request->input('s_id'));
            }
          })->orderBy('noinv','asc')->get();

          // dd($request->input());
        $page = 'backend.oprasional.pdfinvoice.'.$request->input('page');
        $nfile = $request->input('file');
        $orientation = 'landscape';

        $view =  \View::make($page, compact('query','request'))->render();
        // return view($page, compact('result','mulai'));

        $customPaper = array(0,0,595.276,935.4331);
      break;
    }

    // return view($page, compact('result','mulai'));

    $pdf = \App::make('dompdf.wrapper');


    $pdf->setPaper($customPaper,$orientation);

    $pdf->loadHTML($view);
        //->setOrientation($orientation)
        // ->setPaper('A4',$orientation);

    return $pdf->stream($nfile);

    // } else { echo "page tidak dapat di diperbaharui, silahkan kembali kehalaman sebelum";}
  }
}
