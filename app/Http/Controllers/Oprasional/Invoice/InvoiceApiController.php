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
          ->where(function ($query) use ($request){
            if ($request->input('search')){
              $query->where('id',$request->input('search'));
            };
          })
          ->select()
          ->get();
        foreach($query as $row) {
          $responce[]=$row;
        }
      break;
      case 'kurs':
        if ($request->input('search')==null)$search='-';else $search=strtotime($request->input('search'));
        $query = DB::table('tb_kurs')
          ->where(function ($query) use ($request, $search){
              $query->where('date',$search);
          })->orderBy('date', 'desc')
          ->first();
        $responce[]=array('a'=>$search);
        array_push($responce,$query);
      break;
      case 'nomor_akhir':
        $qu = DB::table('tb_ppjks');

        $fakturakhir =   DB::table('tb_ppjks')->where(function ($query) use ($request){
              $query->where('pajak','!=','');
              $lastdate = $query->orderBy('tglinv', 'desc')->first();
              if (isset($lastdate->tglinv)) $query->where('tglinv',$lastdate->tglinv);
          })
          ->orderBy('pajak', 'desc')
          ->first('pajak');
        if (isset($fakturakhir)) $fakturakhir=$fakturakhir->pajak; else $fakturakhir = null;
        $responce['fakturakhir'] = $fakturakhir;

        $manifest_faktur =  DB::table('tb_fakturpajak')
          ->orderBy('id', 'asc')
          ->where(function ($query) use ($request){
              // $query->where('tglinv','!=','');
          })->get(['noawal','noakhir']);

        $findindex='';
        foreach($manifest_faktur as $row) {
          $row->noawal = explode('.',$row->noawal);
          $row->noakhir = explode('.',$row->noakhir);
          $nojumlah = $row->noakhir[3]-$row->noawal[3];
          for($x=0; $x<=$nojumlah; $x++){
            $nofaktur[$x]=$row->noawal[0].'.'.$row->noawal[1].'.'.$row->noawal[2].'.'.($row->noawal[3]+$x);
            if (($fakturakhir==null)&&$findindex=='found') break;
            $responce['nextfaktur'] = $nofaktur[$x];
            // $responce['arraynextfaktur'][] =$nofaktur[$x];
             // .' - '. $fakturakhir;
            if ($findindex=='found') break;
            if (($fakturakhir==$nofaktur[$x])||($fakturakhir==null)) $findindex = 'found';
          }
          if (($findindex=='found')&&($responce['nextfaktur']!=$fakturakhir)||($fakturakhir==null)) break;
          // $responce['manifest_faktur'][] = $row;
        }

        $invoice =   DB::table('tb_ppjks')
          ->where(function ($query) use ($request){
            $query->where('noinv','!=','');
            $lastdate = $query->orderBy('tglinv', 'desc')->first();
            // if (empty($lastdate)) $lastdate ='';
            $last_noinv = $query->where('tglinv',$lastdate->tglinv)->get();
          })
          ->get();
        foreach($invoice as $row) {
          $array_noinv[] = explode('-',$row->noinv)[0];
        }
        $InvoiceHelpers = InvoiceHelpers::items_inv($request->cari)['data']['headstatus'];
        if (substr($InvoiceHelpers,0,3)=='NON')$prefix = 'LC' ;else $prefix = 'CG';
        // substr($row->jettyCode,0,1)
        $responce['invoiceakhir'] = max($array_noinv);
        $responce['nextinvoice']= (max($array_noinv)+1) .'-'. explode('.',explode('-',$row->noinv)[1])[0].'.'.$prefix;
      break;
      case 'invoice':
        $responce['data']  = InvoiceHelpers::items_inv($request->cari);
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
            $q->where('tb_ppjks.ppjk','like','%'.$request->input('cari').'%')
              ->orWhere('tb_kapals.name', 'like','%'.$request->input('cari').'%');
          })
          ->select(
            'tb_kapals.name as kapalsName',
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

        $kurs = str_replace(',','', $request->input('kurs'));
        $datakurs=array(
          'date'=>strtotime($request->input('dkurs')),
          'nilai'=>$kurs,
        );
        if ($request->input('dkurs') != ''){
          if (DB::table('tb_kurs')->where('date', strtotime($request->input('dkurs')))->exists()){
            DB::table('tb_kurs')->where('date', strtotime($request->input('dkurs')))->update($datakurs);
          } else {
            DB::table('tb_kurs')->insert($datakurs);
          }
        }
        $nilai  = InvoiceHelpers::items_inv($id);
        // dd($nilai['jml_ori']);
        $inv = $dddd->first();
        if ($inv->dkurs == null && $nilai['data']['rute'] != '$')$inv->dkurs = 1;
        if ($inv->date_issue && $inv->dkurs && $inv->pajak && $inv->noinv && $inv->refno){
          // dd($nilai['jml_ori']);
          InvoiceHelpers::nilai_inv(
            $id,
            $nilai['jml_ori']['totalTarif'],
            $nilai['jml_ori']['bhtPNBP'],
            $nilai['jml_ori']['ppn'],
            $nilai['jml_ori']['totalinv']
          );
        };
        $responce = array(
          'status' => "success",
          'msg' => 'ok',
          'data' => $inv->dkurs
        );
      break;
      case 'kwitansi':
        // dd($request->input());
        if ($request->input('tgl_pay')!='')$tgl_pay=strtotime($request->input('tgl_pay'));else $tgl_pay='';
        $datanya=array(
          'tgl_pay'=>$tgl_pay,
          'no_kwn'=>$request->input('no_kwn'),
        );
        $dddd = DB::table('tb_inv')->where('ppjks_id', $id);
        $dddd->update($datanya);

        $responce = array(
          'status' => "success",
          'msg' => 'ok',
        );

      break;
      case 'edit_nilai':
        $request->value = str_replace(",","",$request->value);
        $nilai  = InvoiceHelpers::items_inv($request->pk);
        $i = count($nilai['isi']);

        //maping Selisih
        if (empty($nilai['data']['selisih'])){
          for ($x = 0; $x <= $i+3; $x++) $selisih[$x]=0;
        } else {
          $tmp['selisih'] = explode(',',$nilai['data']['selisih']);
          for ($x = 0; $x <= $i+3; $x++){
            if(empty($tmp['selisih'][$x]))$tmp['selisih'][$x]=0;
            $selisih[$x]=$tmp['selisih'][$x];
          }
        }

        //ganti nilai resume selisih (recalculate) jika nilai total tunda diubah
        if ($i==$request->name){
          $new_calculate = InvoiceHelpers::calculate_total($nilai['data']['headstatus'],$request->value);

          $selisih[$i]   = round($request->value-$nilai['jml_ori']['totalTarif']);
          $selisih[$i+1] = round($new_calculate['bhtPNBP']-$nilai['jml_ori']['bhtPNBP']);
          $selisih[$i+2] = round($new_calculate['ppn']-$nilai['jml_ori']['ppn']);
          $selisih[$i+3] = round($new_calculate['totalinv']-$nilai['jml_ori']['totalinv']);
        } else {
          $selisih[$request->name] = 0;
          $tmp = array_map(function($v){return round($v['jumlahTarif'],2);}, $nilai['isi']);
          for ($x = 0; $x < $i; $x++){
            $tmp[$x] = $tmp[$x]+$selisih[$x];
            // +isset($selisih[$x]);
          }
          $tmp[$i]   = $nilai['jml_ori']['totalTarif']+$selisih[$i];
          $tmp[$i+1] = $nilai['jml_ori']['bhtPNBP']+$selisih[$i+1];
          $tmp[$i+2] = $nilai['jml_ori']['ppn']+$selisih[$i+2];
          $tmp[$i+3] = $nilai['jml_ori']['totalinv']+$selisih[$i+3];

          $selisih[$request->name] = round($request->value - $tmp[$request->name],2);
        }


        // $i = count($nilai['isi']);
        // if(empty($nilai['isi'][$request->name])){
        //   $tmp[$i]   = InvoiceHelpers::items_inv($request->pk)['jml_ori']['totalTarif']+isset($selisih[$i]);
        //
        //   if ($i == $request->name){
        //
        //   }
        //
        // //   // dd($tmp);
        // //   InvoiceHelpers::nilai_inv(
        // //     $request->pk,
        // //     $tmp[$i],
        // //     $tmp[$i+1],
        // //     $tmp[$i+2],
        // //     $tmp[$i+3]
        // //   );
        // }
        //
        $datanya=array(
          'selisih'=> implode(',',$selisih),
        );
        //
        $qu = DB::table('tb_ppjks')->where('id', $request->pk);
        $qu->update($datanya);
        if (!isset($new_calculate))$new_calculate = ''; else $new_calculate = array_map(function($v){return round($v);}, $new_calculate);
        $responce = array(
          'status' => "success",
          'msg' => $datanya,
          'rowId' => $new_calculate,
          'recalculate' => $new_calculate
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
            ->leftJoin('tb_inv', function ($join) {
              $join->on('tb_ppjks.id','tb_inv.ppjks_id');
            })
            ->where(function ($query) use ($mulai,$akhir,$request){
              if ($mulai!='')$query->where('tb_ppjks.tglinv', strtotime($mulai));
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
              'tb_inv.tgl_pay as tgl_pay',
              'tb_inv.no_kwn as no_kwn',
              // 'tb_kapals.grt as kapalsGrt',
              // 'tb_kapals.loa as kapalsLoa',
              // 'tb_kapals.bendera as kapalsBendera',
              // 'tb_jettys.name as jettyName',
              // 'tb_jettys.code as jettyCode',
              // // 'tb_jettys.color as jettyColor',
              'tb_ppjks.*'
            );
            // $qu->orderBy('bstdo', 'desc');
        break;
      }

      $count = $qu->count();

      // $count = $qu->count();

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
            if ($row->tgl_pay != '')  $row->tgl_pay=date('d-m-Y', $row->tgl_pay);
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
              $row->tgl_pay,
              $row->no_kwn
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
      $responce['xcoba'] = $query;
      return  Response()->json($responce);
  }
  public function jqgrid_sub(Request $request){

      $datatb = $request->input('datatb', '');
      // $cari = $request->input('cari', '0');

      $page = $request->input('page', '1');
      $limit = $request->input('rows', '10');
      $sord = $request->input('sord', 'asc');
      $sidx = $request->input('sidx', 'id');

      $mulai = $request->input('start', '0');
      $akhir = $request->input('end', '0');
      switch ($datatb) {
        case 'invoice':
          $qu = InvoiceHelpers::items_inv($request->cari);
          $dari = $ke = 0;
        break;
      }

      $count = count($qu);

      // $count = $qu->count();

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
      $query = $qu;
        // ->orderBy($sidx, $sord)
        // ->skip($start)->take($limit)
        // ->get();

      $i=0;
      // dd($query);
      foreach($query as $row) {
        switch ($datatb) {
          case 'invoice':   // Variabel Master
            $responce['rows'][$i]['id'] = $row['id'];
            $responce['rows'][$i]['cell'] = array(
              $row['id'],
              $row['dari'],
              $row['ke'],
              $row['jumlahWaktu'],
            );
            $i++;
          break;
        }
      }
      $responce['cob'] = $query;
      if(!isset($responce['rows'])){
        $responce['rows'][0]['id'] = '';
        $responce['rows'][0]['cell']=array('');
      }
      return  Response()->json($responce);
  }
}
