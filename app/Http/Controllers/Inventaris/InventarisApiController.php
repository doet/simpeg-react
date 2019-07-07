<?php

namespace App\Http\Controllers\Inventaris;
date_default_timezone_set('Asia/Jakarta');

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Auth;

class InventarisApiController extends Controller
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
  // * Show the application dashboard.
  // *
  // * @return \Illuminate\Http\Response
  // */
  public function search(Request $request){
    $datatb = $request->input('datatb', '');
    $search = $request->input('search', '');
    switch ($datatb) {
      case 'infoasset':
        $infoasset = DB::table('tb_inventaris')
        // ->join('tb_agens', function ($join) {
        //
        // })
        // ->select(
        //   'tb_agens.code as agenCode',
        //   'tb_kapals.value as kapalsName',
        //   'tb_kapals.jenis as kapalsJenis',
        //   'tb_kapals.grt as kapalsGrt',
        //   'tb_kapals.loa as kapalsLoa',
        //   'tb_kapals.bendera as kapalsBendera',
        //   'tb_jettys.value as jettyName',
        //   // 'tb_jettys.color as jettyColor',
        //   'tb_dls.*'
        // )
        ->where('tb_inventaris.code', $search)
        ->first();
        $responce['infoasset'] = $infoasset;

        $riwayat = DB::table('tb_rasset')
        // ->join('tb_agens', function ($join) {
        //
        // })
        // ->select(
        //   'tb_agens.code as agenCode',
        //   'tb_kapals.value as kapalsName',
        //   'tb_kapals.jenis as kapalsJenis',
        //   'tb_kapals.grt as kapalsGrt',
        //   'tb_kapals.loa as kapalsLoa',
        //   'tb_kapals.bendera as kapalsBendera',
        //   'tb_jettys.value as jettyName',
        //   // 'tb_jettys.color as jettyColor',
        //   'tb_dls.*'
        // )
        ->where('tb_rasset.asset_id', $infoasset->id)
        ->get();
        $responce['riwayat'] = $riwayat;
      break;
    }

    return  Response()->json($responce);
  }

}
