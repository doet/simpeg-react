<?php

namespace App\Http\Controllers\Surat;
date_default_timezone_set('Asia/Jakarta');

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Auth;

class SuratApiController extends Controller
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
  public function json(Request $request){
    $datatb = $request->input('datatb', '');
    $id = $request->input('iddata', '');
    switch ($datatb) {
      case 'smasuk':
        $query = DB::table('tb_smasuk')
          ->where('tb_smasuk.id', $id)
          ->get();
        foreach($query as $row) {
          $responce['date']=$row->date;
          $responce['dari']=$row->dari;
          // $responce['date']=date("d-m-Y H:i",$row->date);
          $responce['perihal']=$row->perihal;
          $responce['ddari']=$row->ddari;
          $responce['duntuk']=$row->duntuk;
          $responce['isi']=$row->isi;
          $responce['lanjutan']=$row->lanjutan;
        }
      break;
    }
    return  Response()->json($responce);
  }

  public function autoc(Request $request){
    $datatb = $request->input('datatb', '');

    switch ($datatb) {
      case 'agen':
        $cari = $request->input('cari');
        $query = DB::table('tb_agens')
          // ->distinct('code')
          ->where('code','like',$cari.'%')
          ->orderBy('code', 'asc')
          ->get();
        $i=0;
        $value_n='';
        foreach($query as $row) {
          if ($row->code != $value_n){
            $responce[$i] = $row->code;
            $i++;
            $value_n=$row->code;
          }
        }
        if(empty($responce))$responce[0]='Null';
      break;
      case 'kapal':
        $cari = $request->input('cari');
        $query = DB::table('tb_kapals')
          // ->distinct('code')
          ->where('value','like',$cari.'%')
          ->orderBy('value', 'asc')
          ->get();
        $i=0;
        $value_n='';
        foreach($query as $row) {
          if ($row->value != $value_n){
            // $responce[$i] = '('.$row->jenis.') '.$row->value;
            $responce[$i] = $row->value;
            $i++;
            $value_n=$row->value;
          }
        }
        if(empty($responce))$responce[0]='Null';
      break;
      case 'dermaga':
        $cari = $request->input('cari');
        $query = DB::table('tb_jettys')
          // ->distinct('code')
          ->where('name','like',$cari.'%')
          ->orderBy('name', 'asc')
          ->get();
        $i=0;
        $value_n='';
        foreach($query as $row) {
          if ($row->name != $value_n){
            // $responce[$i] = '('.$row->jenis.') '.$row->value;
            $responce[$i] = $row->name;
            $i++;
            $value_n=$row->name;
          }
        }
        if(empty($responce))$responce[0]='Null';
      break;
    }
    return  Response()->json($responce);
  }

  public function cud(Request $request){
    $datatb = $request->input('datatb', '');
    $oper = $request->input('oper','');
    $id = $request->input('id');

    switch ($datatb) {
      case 'smasuk':
        $datanya=array(
          'date'=>strtotime($request->input('date','')),
          'dari'=>$request->input('dari',''),
          'perihal'=>$request->input('perihal',''),
          'ddari'=>$request->input('ddari',''),
          'duntuk'=>$request->input('duntuk',''),
          'isi'=>$request->input('disi',''),
          'lanjutan'=>$request->input('lanjutan',''),
        );

        if ($oper=='add')DB::table('tb_smasuk')->insert($datanya);
        if ($oper=='edit')DB::table('tb_smasuk')->where('id', $id)->update($datanya);
        if ($oper=='del')DB::table('tb_smasuk')->delete($id);

        $responce = array(
          'status' => $datanya,
          //"suscces",
          'msg' => 'ok',
        );
      break;
    }

    return  Response()->json($responce);
  }
  public function jqgrid(Request $request){

      $datatb = $request->input('datatb', '');
      $cari = $request->input('cari', '0');

      $page = $request->input('page', '1');
      $limit = $request->input('rows', '10');
      $sord = $request->input('sord', 'asc');
      $sidx = $request->input('sidx', 'id');

      $mulai = $request->input('start', '0');
      $akhir = $request->input('end', '0');
      switch ($datatb) {
        case 'smasuk':
          $qu = DB::table('tb_smasuk');
        break;
      }
      $count = $qu->count();

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

  // Mengambil Nilai Query //
      $query = $qu->orderBy($sidx, $sord)
        ->skip($start)->take($limit)
        ->get();

      $i=0;
      foreach($query as $row) {
        switch ($datatb) {
          case 'smasuk':   // Variabel Master
            $responce['rows'][$i]['id'] = $row->id;
            $responce['rows'][$i]['cell'] = array(
              // $i+1,
              $row->id,
              date("d-m-Y",$row->date),
              $row->dari,
              $row->perihal,
              $row->ddari,
              $row->duntuk,
              $row->isi,
              $row->lanjutan,
              $row->file,


            );
            $i++;
          break;
        }
      }
      if(!isset($responce['rows']))$responce['rows'][0]['cell']=array('');
      // print_r(empty($responce['rows']));
      $responce['tambah'] = strtotime($mulai);
      return  Response()->json($responce);
  }
}
