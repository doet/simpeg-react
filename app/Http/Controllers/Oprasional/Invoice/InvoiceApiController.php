<?php

namespace App\Http\Controllers\Oprasional\Invoice;
date_default_timezone_set('Asia/Jakarta');

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\AppHelpers;
use App\Helpers\InvoiceHelpers;

use DB;
use Auth;

class InvoiceApiController extends Controller
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
    $responce = array();
    switch ($datatb) {
      case 'ppjk':
        $query = DB::table('tb_ppjks')
        // ->join('tb_agens', function ($join) {
        //   $join->on('tb_agens.id','tb_ppjks.agens_id');
        // })
        // ->join('tb_kapals', function ($join) {
        //   $join->on('tb_kapals.id','tb_ppjks.kapals_id');
        // })
        // ->join('tb_jettys', function ($join) {
        //   $join->on('tb_jettys.id','tb_ppjks.jettys_id');
        // })
        ->where(function ($query) use ($request){
          if ($request->input('search')){
            $query->where('id',$request->input('search'));
          };
        })
        ->select(
        //   'tb_agens.code as agenCode',
        //   'tb_kapals.name as kapalsName',
        //   'tb_kapals.jenis as kapalsJenis',
        //   'tb_kapals.grt as kapalsGrt',
        //   'tb_kapals.loa as kapalsLoa',
        //   'tb_kapals.bendera as kapalsBendera',
        //   'tb_jettys.name as jettyName',
        //   // 'tb_jettys.color as jettyColor',
          // 'tb_ppjks.*'
        )
        ->get();
        foreach($query as $row) {
          $responce[]=$row;
        }
      break;
      case 'kurs':
        if ($request->input('search')==null)$search='-';else $search=strtotime($request->input('search'));
        $query = DB::table('tb_kurs')
          ->where(function ($query) use ($request, $search){
            // if ($search!='-'){
              $query->where('date',$search);
            // };
          })->orderBy('date', 'desc')
          ->first();
        $responce[]=array('a'=>$search);
        // $responce=$query;
        array_push($responce,$query);
      break;
    }
    return  Response()->json($responce);
  }

  public function autoc(Request $request){
    $datatb = $request->input('datatb', '');

    switch ($datatb) {
      case 'bstdo':
        $cari = $request->input('cari');
        $query = DB::table('tb_ppjks')
          // ->distinct('code')
          ->where('bstdo','like',$cari.'%')
          ->orderBy('bstdo', 'asc')
          ->get();
        $i=0;
        $value_n='';
        foreach($query as $row) {
          if ($row->bstdo != $value_n){
            // $responce[$i] = '('.$row->jenis.') '.$row->value;
            $responce[$i]['value'] = $row->bstdo;
            $i++;
            $value_n=$row->bstdo;
          }
        }
        if(empty($responce))$responce[0]='null';
      break;
      case 'ppjk':
        $query = DB::table('tb_ppjks')
          ->rightJoin('tb_kapals', function ($join) {
            $join->on('tb_kapals.id','tb_ppjks.kapals_id')
              ->where('tb_ppjks.bstdo','!=','');
          })
          // ->distinct('code')
          ->where(function ($q) use ($request){
            // $q->where('tb_ppjks.bstdo','!=','')
            //   ->orWhere('tb_ppjks.bstdo','!=',(NULL));
            $q->where('tb_ppjks.ppjk','like','%'.$request->input('cari').'%')
              ->orWhere('tb_kapals.name', 'like','%'.$request->input('cari').'%');
          })
          ->select(
            'tb_kapals.name as kapalsName',
            //   // 'tb_jettys.color as jettyColor',
            'tb_ppjks.*'
            )
          ->orderBy('ppjk', 'asc')
          ->get();
        $i=0;
        $value_n='';
        foreach($query as $row) {
          if ($row->ppjk != $value_n){
            $responce[$i]['value'] = $row->ppjk .' - '. $row->kapalsName;
            $responce[$i]['label'] = $row->ppjk .' - '. $row->kapalsName;
            $responce[$i]['id'] = $row->id;
            $i++;
            $value_n=$row->ppjk .' - '. $row->kapalsName;
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
      case 'inv':
        if ($request->input('tglinv')!='')$tglinv=strtotime($request->input('tglinv'));else $tglinv='';
        if ($request->input('dkurs') == '')$dkurs=null;else $dkurs=strtotime($request->input('dkurs'));
        $datanya=array(
          'noinv'=>$request->input('noinv'),
          'pajak'=>$request->input('pajak'),
          'refno'=>$request->input('refno'),
          'tglinv'=>$tglinv,
          'dkurs'=>$dkurs,
          'selisih'=>$request->input('selisih'),
        );
        $dddd = DB::table('tb_ppjks')->where('id', $id);
        $dddd->update($datanya);

        $kurs = str_replace('.', '', $request->input('kurs'));
        $datakurs=array(
          'date'=>strtotime($request->input('dkurs')),
          'nilai'=>$kurs,
        );
        if ($request->input('dkurs') != ''){
          if (DB::table('tb_kurs')->where('date', strtotime($request->input('dkurs')))->exists()){
            DB::table('tb_kurs')->where('date', strtotime($request->input('dkurs')))->update($datakurs);
          } else {
            DB::table('tb_kurs')->insert($datakurs);
            //->where('date', strtotime($request->input('dkurs')))
          }
        }


        // InvoiceHelpers::nilai_inv($dddd->first()->id);

        $responce = array(
          'status' => "success",
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
        case 'invoice':   // Vaariabel Master
          $qu = DB::table('tb_ppjks')
            ->leftJoin('tb_agens', function ($join) {
              $join->on('tb_agens.id','tb_ppjks.agens_id');
            })
            ->leftJoin('tb_kapals', function ($join) {
              $join->on('tb_kapals.id','tb_ppjks.kapals_id');
            })
            // ->RightJoin('tb_ppjks', function ($join) {
            //   $join->on('tb_ppjks.id','tb_dls.ppjks_id');
            // })
            // ->leftJoin('tb_jettys', function ($join) {
            //   $join->on('tb_jettys.id','tb_dls.jettys_id');
            // })
            ->where(function ($query) use ($mulai,$akhir,$request){
              $query->where('tb_ppjks.bstdo','!=','');
              if ($request->input('s_id')) {
                $query->where('tb_ppjks.id', $request->input('s_id'));
              }
            //   if (array_key_exists("lhp",$request->input())){
            //     $query->where('tb_ppjks.lhp', strtotime($request->input('lhp')));
            //   } else if (array_key_exists("bstdo",$request->input())){
            //     // $query->where('tb_ppjks.bstdo', $request->input('bstdo'));
            //     $query->where('tb_ppjks.bstdo','!=','');
            //   } else {
            //     $mulai = strtotime($mulai);
            //     $akhir = strtotime($akhir);
            //     if($akhir==0)$akhir = $mulai+(60 * 60 * 24);
            //     $query->where('tb_dls.date', '>=', $mulai)
            //       ->Where('tb_dls.date', '<', $akhir);
            //   }
            })
            ->select(
              'tb_agens.code as agenCode',
              'tb_kapals.name as kapalsName',
              'tb_kapals.jenis as kapalsJenis',
              // 'tb_kapals.grt as kapalsGrt',
              // 'tb_kapals.loa as kapalsLoa',
              // 'tb_kapals.bendera as kapalsBendera',
              // 'tb_jettys.name as jettyName',
              // 'tb_jettys.code as jettyCode',
              // // 'tb_jettys.color as jettyColor',
              'tb_ppjks.*'
              // 'tb_dls.*'
            );
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
      // dd($query);
      foreach($query as $row) {
        switch ($datatb) {
          case 'invoice':   // Variabel Master
            if ($row->kapalsJenis == '') $kapal =  $row->kapalsName; else $kapal = '('.$row->kapalsJenis.') '.$row->kapalsName;
            // if ($row->tundaon == '') $tundaon=$row->tundaon; else $tundaon=date("H:i",$row->tundaon);
            // if ($row->tundaoff == '') $tundaoff=$row->tundaon; else $tundaoff=date("H:i",$row->tundaoff);
            // if ($row->pcon == '') $pcon=$row->pcon; else $pcon=date("H:i",$row->pcon);
            // if ($row->pcoff == '') $pcoff=$row->pcon; else $pcoff=date("H:i",$row->pcoff);

            // if ($row->ppjk == '' || $row->ppjk == null) $row->ppjk = ''; else $row->ppjk = substr($row->ppjk, -5);
            if ($row->tglinv != '') $row->tglinv=date('d-m-Y', $row->tglinv);
            if ($row->rute != '' && $row->rute == '$')$row->rute = 'Internasional'; else if ($row->rute != '' && $row->rute == 'Rp')$row->rute = 'Domestic';
            if ($row->dkurs !='')$dkurs=date("d-m-Y",$row->dkurs); else $dkurs='';
            if ($row->inv_pay != '')  $row->inv_pay=date('d-m-Y', $row->inv_pay);
            $responce['rows'][$i]['id'] = $row->id;
            $responce['rows'][$i]['cell'] = array(
              $row->id,
              $row->bstdo,
              $row->ppjk,
              $row->agenCode,
              $kapal,
              $row->rute,
              $row->tglinv,
              $row->pajak,
              $row->noinv,
              $row->refno,
              $row->selisih,
              $row->id,
              $dkurs,
              $row->inv_pay
            );
            $i++;
          break;
        }
      }
      if(!isset($responce['rows'])){
        $responce['rows'][0]['id'] = '';
        $responce['rows'][0]['cell']=array('');
      }
      // print_r(empty($responce['rows']));
      // $responce['tambah'] = strtotime($mulai);
      return  Response()->json($responce);
  }
}
