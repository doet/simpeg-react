<?php

namespace App\Http\Controllers\Oprasional;
date_default_timezone_set('Asia/Jakarta');

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\AppHelpers;

use DB;
use Auth;

class OprasionalApiController extends Controller
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
    $sidx =$request->input('sidx', 'id');
    $sord =$request->input('sord', 'asc');
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
          if ($request->input('filter')){
            $query->where($request->input('filter'),null);
          };
          if ($request->select){
            $query->where($request->selectby,$request->select);
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
        //   'tb_jettys.color as jettyColor',
        //   'tb_ppjks.*'
        )
        // ->orderBy($sidx, $sord)
        ->get();
        // $responce[]=$sidx;
        foreach($query as $row) {
          $responce[]=$row;
        }
      break;
      case 'dl':
        $query = DB::table('tb_dls')
          ->join('tb_ppjks', function ($join) {
            $join->on('tb_ppjks.id','tb_dls.ppjks_id');
          })
          // ->join('tb_agens', function ($join) {
          //   $join->on('tb_agens.id','tb_ppjks.agens_id');
          // })

          // ->join('tb_kapals', function ($join) {
          //   $join->on('tb_dls.kapals_id', '=', 'tb_kapals.id');
          // })
          // ->join('tb_jettys', function ($join) {
          //   $join->on('tb_dls.jetty_id', '=', 'tb_jettys.id');
          // })
          ->select(
          //   'tb_agens.code as agenCode',
          //   'tb_kapals.name as kapalsName',
          //   'tb_kapals.jenis as kapalsJenis',
          //   'tb_kapals.grt as kapalsGrt',
          //   'tb_kapals.loa as kapalsLoa',
          //   'tb_kapals.bendera as kapalsBendera',
          //   'tb_jettys.name as jettyName',
          //   // 'tb_jettys.color as jettyColor',
          //   'tb_dls.*'
          )
          ->where(function ($query) use ($request){
            if ($request->input('search')){
              $query->where('tb_dls.id',$request->input('search'));
            };
          })
          ->get();
        foreach($query as $row) {
          $responce['ppjk']=$row->ppjks_id;
          $responce['agen']=$row->agens_id;
          $responce['date']=date("d-m-Y H:i",$row->date);
          $responce['kapal']=$row->kapals_id;
          $responce['jetty']=$row->jettys_id;
          $responce['ops']=$row->ops;
          $responce['shift']=$row->shift;
          $responce['pc']=$row->pc;
          $responce['tunda']=json_decode($row->tunda);

          if ($row->tundaon == '')$row->tundaon = $row->date;
          if ($row->tundaoff == '')$row->tundaoff = $row->date;
          $responce['tundaon']=date("d/m/y H:i",$row->tundaon);
          $responce['tundaoff']=date("d/m/y H:i",$row->tundaoff);

          if ($row->pcon == '')$row->pcon = $row->tundaon;
          if ($row->pcoff == '')$row->pcoff = $row->tundaoff;
          $responce['pcon']=date("d/m/y H:i",$row->pcon);
          $responce['pcoff']=date("d/m/y H:i",$row->pcoff);

          $responce['dd']=$row->dd;
          $responce['ket']=$row->ket;
          $responce['bapp']=$row->bapp;
          $responce['mooring']=$row->mooring;
        }
      break;
      case 'agen':
        $query = DB::table('tb_agens')
        ->where(function ($query) use ($request){
          if (array_key_exists("search",$request->input())){
            if ($request->input('search')==''){
              $query->where('id',null);
            }else{
              $query->where('id',$request->input('search'));
            }
          }
        })
        ->get();
        foreach($query as $row) {
          $responce[]=$row;
        }
      break;
      case 'kapal':
        $query = DB::table('tb_kapals')
        ->where(function ($query) use ($request){
          if (array_key_exists("search",$request->input())){
            if ($request->input('search')==''){
              $query->where('id',null);
            }else{
              $query->where('id',$request->input('search'));
            }
          }
        })
        ->get();
        foreach($query as $row) {
          $responce[]=$row;
        }
      break;
      case 'dermaga':
        $query = DB::table('tb_jettys')
          ->where(function ($query) use ($request){
            if (array_key_exists("search",$request->input())){
              if ($request->input('search')==''){
                $query->where('id',null);
              }else{
                $query->where('id',$request->input('search'));
              }
            }
          })
          ->get();
          foreach($query as $row) {
            $responce[]=$row;
          }
      break;
      case 'ppjkx':
        $lhp_date = $request->input('lhp_date', '');
        $query = DB::table('tb_dls')
          ->where(function ($query) use ($lhp_date){
              $lhp_date = strtotime($lhp_date);
              // $akhir = strtotime($akhir);
              // if($akhir==0)$akhir = $mulai+(60 * 60 * 24);
              // $query->where('date', '>=', $mulai)
              //   ->Where('date', '<=', $akhir);
              $query->where('lhp_date','')
                ->orWhere('lhp_date',$lhp_date)
                ->orWhere('lhp_date',null);
          })
          ->get();
        foreach($query as $row) {
          $responce['items'][$row->ppjk]=$row->ppjk;
          if ($row->lhp_date != '')$responce['selected'][$row->ppjk]='selected'; else $responce['selected'][$row->ppjk]='';
        }
        unset($responce['items'][null]);
      break;
      case 'r_rute':
        $query = DB::table('tb_ppjks')
        ->where(function ($query) use ($request){
          if ($request->input('search')){
            $query->where('id',$request->input('search'));
          };
          if ($request->input('filter')){
            $query->where($request->input('filter'),null);
          };
        })
        ->select(

        )
        ->get();
        // $responce[0]['label']='Rp';
        // $responce[1]['label']='$';

        $items=array();
        $count=0;
        foreach($query as $row) {
          if ($row->rute != ''){
            if (isset($items[$row->rute])) $items[$row->rute]= $items[$row->rute]+1 ; else $items[$row->rute]= 1 ;
          } else {
            if (isset($items['unknow'])) $items['unknow']= $items['unknow']+1 ; else $items['unknow']= 1 ;
          }
          $count++;
        }

        $i=0;
        foreach($items as $key=>$val) {
          $responce[$i]['label'] = $key .' = '.$val;
          $responce[$i]['data'] =$val;
           // number_format((100/$count)*$val,2);
          $i++;
        }
        $responce[0]['color']="#DA5430";
        $responce[1]['color']="#2091CF";
        $responce[2]['color']="#FEE074";

      break;
      case 'mtarif':
        $query = DB::table('tb_nilaiinv')
          ->where(function ($qu) use ($request){
            if ($request->search != '') {
              $getdate = $qu->where('date','<=',$request->search)->orderBy('date', 'desc')->first();
              if ($getdate) $qu->where('date',$getdate->date);
            }
            if ($request->group != '') $qu->where('desc','like',$request->group.'%');
          })
          ->orderBy('desc', 'asc')
          ->get();
          $i=0;
          foreach ($query as $row) {
            if (substr($row->desc,0,3) == substr($row->desc,0,1).'t_'){
              $responce['data'][$i]['id'] = $row->id;
              $responce['data'][$i]['date'] = $row->date;
              $responce['data'][$i]['grp'] = substr($row->desc,0,3);
              $responce['data'][$i]['desc'] = substr($row->desc,3);
              $responce['data'][$i]['value'] = $row->value;

            } else if (substr($row->desc,0,3) == substr($row->desc,0,1).'v_'){
              $responce['data'][$i]['id'] = $row->id;
              $responce['data'][$i]['date'] = $row->date;
              $responce['data'][$i]['grp'] = substr($row->desc,0,3);
              $responce['data'][$i]['desc'] = substr($row->desc,3);
              $responce['data'][$i]['value'] = $row->value;
            } else if (substr($row->desc,0,3) == 'bht'){
              $responce['data'][$i]['id'] = $row->id;
              $responce['data'][$i]['date'] = $row->date;
              $responce['data'][$i]['desc'] = $row->desc;
              $responce['data'][$i]['value'] = $row->value;
            }

            $i++;
          }
          if(isset($responce['data'])) {
            if ($request->search == ''){
              foreach ($responce['data'] as $rw) {
                $responce['date'][]=$rw['date'];
              }
              $responce['date'] = array_count_values($responce['date']);
            } else {
              if (substr($row->desc,0,3) == 'bht'){} else {
                foreach ($responce['data'] as $rw) {
                  $responce['rd'][$rw['desc']]['grt']=$rw['desc'];
                  if ($rw['grp'] == substr($row->desc,0,1).'t_'){
                    $responce['rd'][$rw['desc']]['value']=$rw['value'];
                  }
                  if ($rw['grp'] == substr($row->desc,0,1).'v_'){
                    $responce['rd'][$rw['desc']]['var']=$rw['value'];
                  }
                }
                ksort($responce['rd']);
                $responce['rd'] = array_values($responce['rd']);
              }
            }
          }
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
      case 'ppjk':
        $cari = $request->input('cari');
        $query = DB::table('tb_ppjks')
          ->leftJoin('tb_kapals', function ($join) {
            $join->on('tb_kapals.id','tb_ppjks.kapals_id');
          })
          // ->distinct('code')
          ->where(function ($q) use ($cari){
            $q->where('tb_ppjks.ppjk','like','%'.$cari.'%')
              ->orWhere('tb_kapals.name', 'like','%'.$cari.'%');
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
      case 'ppjk':
        DB::beginTransaction();
        try{
          $datanya=array(
            'date_issue'=> strtotime($request->input('date_issue','')),
            'ppjk'      => $request->input('ppjk',''),
            'agens_id'  => $request->input('agen',''),
            'kapals_id' => $request->input('kapal',''),
            'jettys_idx' => $request->input('jetty',''),
            'eta'       => AppHelpers::RangeDate($request->input('etad'))['startDate'],
            'etd'       => AppHelpers::RangeDate($request->input('etad'))['endDate'],
            'etmal'     => $request->input('etmal',''),
            'asal'      => $request->input('asal',''),
            'tujuan'    => $request->input('tujuan',''),
            'cargo'     => $request->input('cargo',''),
            'muat'      => $request->input('muat',''),
            'rute'      => $request->input('rute',''),
            'ket'       => $request->ket,
          );
          // dd($request->input());
          if ($oper=='add')DB::table('tb_ppjks')->insert($datanya);
          if ($oper=='edit')DB::table('tb_ppjks')->where('id', $id)->update($datanya);
          if ($oper=='del')DB::table('tb_ppjks')->delete($id);

          $data_dl=array(
            'ppjks_id'   => DB::getPdo()->lastInsertId(),
            'jettys_id' => $request->input('jetty',''),
            'date'       => AppHelpers::RangeDate($request->input('etad'))['startDate'],
          );
          if ($oper=='add')DB::table('tb_dls')->insert($data_dl);
          if ($oper=='del')DB::table('tb_dls')->where('ppjks_id', $id)->delete();

          DB::commit();

          $responce = array(
            'msg' => $request->input('lstp',''),
            'status' => 'success',
          );

        } catch (\Exception $e) {
          DB::rollback();
          $responce = array(
            'msg' => $e->errorInfo,
            'status' => $e,
          );
        }
      break;
      case 'dl':
        $date = $tunda = $tundaon = $tundaoff = '';
        if ($oper!='del'){
          $date = strtotime($request->input('date',''));

          if($request->input('tunda') !== ''){
            if($request->input('tunda') == 'null') $tunda =''; else $tunda = $request->input('tunda');
            $t = explode(",",$tunda);
            $tunda = array();
            foreach($t as $row) {
              array_push($tunda, $row);
            }
            $tunda = json_encode($tunda);
          }

          $datanya=array(
            'jettys_id' =>$request->input('jetty',''),
            'date'      =>$date,
            'ops'       =>$request->input('ops',''),
            'shift'     =>$request->input('shift',''),
            'pc'        =>$request->input('pc',''),
            'tunda'     =>$tunda,
            'tundaon'   =>AppHelpers::RangeDate($request->input('tundadate'))['startDate'],
            'tundaoff'  =>AppHelpers::RangeDate($request->input('tundadate'))['endDate'],
            'dd'        =>$request->input('dd',''),
            'ket'       =>$request->input('ket',''),
            'mooring'   =>$request->input('mooring','')
          );
        }

        if ($oper=='add'){
          $datanya['ppjks_id']=$request->input('ppjk','');
          DB::table('tb_dls')->insert($datanya);
        }
        if ($oper=='edit')DB::table('tb_dls')->where('id', $id)->update($datanya);
        if ($oper=='del')DB::table('tb_dls')->delete($id);

        $responce = array(
          'status' => 'success',
          //"suscces",
          'msg' => $request->input('tunda'),
        );
      break;
      case 'dl-bapp':
        if ($oper=='edit'){
          $datanya['bapp']=$request->input('bapp','');
        }
        DB::table('tb_dls')->where('id', $id)->update($datanya);

        $responce = array(
          'status' => 'success',
          //"suscces",
          'msg' => $id,
        );
      break;

      case 'lhp':
        if ($request->input('checked','') == 'true')$lhp = strtotime($request->input('lhp','')); else $lhp = null;
        $datanya=array(
          'lhp'=>$lhp,
        );
        DB::table('tb_ppjks')->where('id', $request->input('id',''))->update($datanya);
        //
        $responce = array(
          'status' => $request->input(),
          //"suscces",
          'msg' => 'ok',
        );
      break;
      case 'lhp2':
        $data_b=array(
          // 'moring'=>$request->input('moring',''),
          'tundaon'   =>AppHelpers::RangeDate($request->input('tundadate'))['startDate'],
          'tundaoff'  =>AppHelpers::RangeDate($request->input('tundadate'))['endDate'],
          'pcon'   =>AppHelpers::RangeDate($request->input('pcdate'))['startDate'],
          'pcoff'  =>AppHelpers::RangeDate($request->input('pcdate'))['endDate'],
          'bapp'  =>$request->input('bapp',''),
        );
        DB::table('tb_dls')->where('id', $request->input('dls_id',''))->update($data_b);
        //
        $responce = array(
          'status' => 'success',
          //"suscces",
          'msg' => 'ok',
        );
      break;

      case 'bstdo':
        if ($request->input('checked','') == 'true')$bstdo = $request->input('bstdo',''); else $bstdo = null;
        $datanya=array(
          'bstdo'=>$bstdo,
        );
        DB::table('tb_ppjks')->where('id', $request->input('id',''))->update($datanya);
        //
        $responce = array(
          'status' => $request->input(),
          //"suscces",
          'msg' => 'ok',
        );
      break;
      case 'lstp':
        // dd($request->input());
        if ($request->date_req)$request->date_req=strtotime($request->date_req);
        if ($request->date_aprv)$request->date_aprv=strtotime($request->date_aprv);
        $data_a=array(
          'lstp_req'=>$request->date_req,
          'lstp_aprv'=>$request->date_aprv,
          'lstp'=>$request->lstp,
        );
        DB::table('tb_ppjks')->where('id', $id)->update($data_a);
        // dd($data_a);
        //
        // $data_b=array(
        //   // 'moring'=>$request->input('moring',''),
        //   'tundaon'   =>AppHelpers::RangeDate($request->input('tundadate'))['startDate'],
        //   'tundaoff'  =>AppHelpers::RangeDate($request->input('tundadate'))['endDate'],
        //   'pcon'   =>AppHelpers::RangeDate($request->input('pcdate'))['startDate'],
        //   'pcoff'  =>AppHelpers::RangeDate($request->input('pcdate'))['endDate'],
        //   'bapp'  =>$request->input('bapp',''),
        // );
        // DB::table('tb_dls')->where('id', $request->input('dls_id',''))->update($data_b);
        //
        $responce = array(
          'status' => 'success',
          //"suscces",
          'msg' => 'ok',
        );
      break;
      case 'faktur':
        if ($request->date)$request->date=strtotime($request->date);
        $datanya=array(
          'date'=>$request->date,
          'noawal'=>$request->noawal,
          'noakhir'=>$request->noakhir,
        );

        if ($oper=='add')DB::table('tb_fakturpajak')->insert($datanya);
        if ($oper=='edit')DB::table('tb_fakturpajak')->where('id', $id)->update($datanya);
        if ($oper=='del')DB::table('tb_fakturpajak')->delete($id);

        $responce = array(
          'status' => 'success',
          //"suscces",
          'msg' => 'ok',
        );
      break;
      case 'mkapal':

        $datanya=array(
          'name'=>$request->input('name',''),
          'jenis'=>$request->input('jenis',''),
          'grt'=>str_replace(',','',$request->input('grt','')),
          'loa'=>$request->input('loa',''),
          'bendera'=>$request->input('bendera',''),
        );

        if ($oper=='add')DB::table('tb_kapals')->insert($datanya);
        if ($oper=='edit')DB::table('tb_kapals')->where('id', $id)->update($datanya);
        if ($oper=='del')DB::table('tb_kapals')->delete($id);

        $responce = array(
          'status' => $datanya,
          //"suscces",
          'msg' => 'ok',
        );
      break;
      case 'magen':
        $datanya=array(
          'code'=>$request->input('code',''),
          'name'=>$request->input('name',''),
          'alamat'=>$request->input('alamat',''),
          'user'=>$request->input('user',''),
          'tlp'=>$request->input('tlp',''),
          'npwp'=>$request->input('npwp',''),
          'ket'=>$request->input('ket',''),
        );

        if ($oper=='add')DB::table('tb_agens')->insert($datanya);
        if ($oper=='edit')DB::table('tb_agens')->where('id', $id)->update($datanya);
        if ($oper=='del')DB::table('tb_agens')->delete($id);

        $responce = array(
          'status' => $datanya,
          //"suscces",
          'msg' => 'ok',
        );
      break;
      case 'mpc':
        $datanya=array(
          'code'=>$request->input('code',''),
          'name'=>$request->input('name',''),
        );

        if ($oper=='add')DB::table('tb_pcs')->insert($datanya);
        if ($oper=='edit')DB::table('tb_pcs')->where('id', $id)->update($datanya);
        if ($oper=='del')DB::table('tb_pcs')->delete($id);

        $responce = array(
          'status' => $datanya,
          //"suscces",
          'msg' => 'ok',
        );
      break;
      case 'mdermaga':
        $datanya=array(
          'code'=>$request->input('code',''),
          'name'=>$request->input('name',''),
          'ket'=>$request->input('ket',''),
        );

        if ($oper=='add')DB::table('tb_jettys')->insert($datanya);
        if ($oper=='edit')DB::table('tb_jettys')->where('id', $id)->update($datanya);
        if ($oper=='del')DB::table('tb_jettys')->delete($id);

        $responce = array(
          'status' => $datanya,
          //"suscces",
          'msg' => 'ok',
        );
      break;
      case 'mmooring':
        $datanya=array(
          'code'=>$request->input('code',''),
          'name'=>$request->input('name',''),
          'alamat'=>$request->input('alamat',''),
          'user'=>$request->input('user',''),
          'tlp'=>$request->input('tlp',''),
          'npwp'=>$request->input('npwp',''),
        );

        if ($oper=='add')DB::table('tb_moorings')->insert($datanya);
        if ($oper=='edit')DB::table('tb_moorings')->where('id', $id)->update($datanya);
        if ($oper=='del')DB::table('tb_moorings')->delete($id);

        $responce = array(
          'status' => $datanya,
          //"suscces",
          'msg' => 'ok',
        );
      break;
      case 'mnilai':

        if ($request->group == 'bht_'){
          foreach ($request->bht as $key=>$value) {
            $id ='';
            $query = DB::table('tb_nilaiinv')
              ->where(function ($qu) use ($request,$key){
                $qu->where('date',$request->date);
                $qu->where('desc',$request->group.''.$key);
              })
              ->first();
            if($query != null){
              if ($value!='')$oper = 'edit'; else $oper = 'del';
              $id = $query->id;
            }

            if ($value!=''){
              $datanya=array(
                'date'=>$request->date ,
                'desc'=>$request->group.''.$key,
                'value'=>$value
              );
              // dd($datanya);
              if ($oper=='add')DB::table('tb_nilaiinv')->insert($datanya);
              if ($oper=='edit')DB::table('tb_nilaiinv')->where('id', $id)->update($datanya);
            } else if($id!=''){
              // dd('t',$id);
              if ($oper=='del')DB::table('tb_nilaiinv')->delete($id);
            }

          }

        } else {
          foreach ($request->value as $key=>$value) {
            $id ='';
            $query = DB::table('tb_nilaiinv')
            ->where(function ($qu) use ($request,$key){
              $qu->where('date',$request->date);
              $qu->where('desc',$request->group.'t_'.$request->grt[$key]);
            })
            ->first();
            if($query != null){
              if ($value!='')$oper = 'edit'; else $oper = 'del';
              $id = $query->id;
            }

            if ($value!='' && $request->grt[$key]!=''){
              if ($request->f == 'grt_d')$prfix = 'dt';else if ($request->f == 'grt_i')$prfix = 'it';
              $datanya=array(
                'date'=>$request->date ,
                'desc'=>$prfix.'_'.$request->grt[$key],
                'value'=>$value
              );
              if ($oper=='add')DB::table('tb_nilaiinv')->insert($datanya);
              if ($oper=='edit')DB::table('tb_nilaiinv')->where('id', $id)->update($datanya);
            } else if($id!=''){
              // dd('t',$id);
              if ($oper=='del')DB::table('tb_nilaiinv')->delete($id);
            }

          }

          foreach ($request->var as $key=>$value) {
            $id ='';
            $query = DB::table('tb_nilaiinv')
            ->where(function ($qu) use ($request,$key){
              $qu->where('date',$request->date);
              $qu->where('desc',$request->group.'v_'.$request->grt[$key]);
            })
            ->first();
            if($query != null){
              if ($value!='')$oper = 'edit'; else $oper = 'del';
              $id = $query->id;
            }

            if ($value!='' && $request->grt[$key]!=''){
              if ($request->f == 'grt_d')$prfix = 'dv';else if ($request->f == 'grt_i')$prfix = 'iv';
              $datanya=array(
                'date'=>$request->date ,
                'desc'=>$prfix.'_'.$request->grt[$key],
                'value'=>$value
              );
              if ($oper=='add')DB::table('tb_nilaiinv')->insert($datanya);
              if ($oper=='edit')DB::table('tb_nilaiinv')->where('id', $id)->update($datanya);
            } else if($id!=''){
              // dd('v'.$request->group);
              if ($oper=='del')DB::table('tb_nilaiinv')->delete($id);
            }
          }
        }
        // dd($request->input());
        $responce = array(
          'status' => 'success',
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
        case 'ppjk':   // Vaariabel Master
          $qu = DB::table('tb_ppjks')
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

              if (array_key_exists("lstp",$request->input())){
                $query->where('lhp','!=','');
                $query->where('bstdo',null);

                if ($request->input('s_id')) {
                  $query->where('tb_ppjks.id', $request->input('s_id'));
                } else {
                  // $mulai = strtotime($mulai);
                  // $akhir = strtotime($akhir);
                  // if($akhir==0)$akhir = $mulai+(60 * 60 * 24);
                  // $query->where('date_issue', '>=', $mulai)
                  //   ->Where('date_issue', '<=', $akhir);
                }
              } else {
                if ($request->input('s_id')) {
                  $query->where('tb_ppjks.id', $request->input('s_id'));
                } else {
                  $mulai = strtotime($mulai);
                  $akhir = strtotime($akhir);
                  if($akhir==0)$akhir = $mulai+(60 * 60 * 24);
                  $query->where('date_issue', '>=', $mulai)
                    ->Where('date_issue', '<=', $akhir);
                }
              }
            })
            ->select(
              'tb_agens.code as agenCode',
              'tb_kapals.name as kapalsName',
              'tb_jettys.code as jettyCode',
              'tb_jettys.name as jettyName',
            //   // 'tb_jettys.color as jettyColor',
              'tb_ppjks.*'
            );
        break;
        case 'dl':   // Vaariabel Master
          $qu = DB::table('tb_dls')
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
              if (array_key_exists("lhp",$request->input())){
                $query->where('tb_ppjks.lhp', strtotime($request->input('lhp')));
              } else if (array_key_exists("bstdo",$request->input())){
                $query->where('tb_ppjks.bstdo', $request->input('bstdo'));
              } else {
                $mulai = strtotime($mulai);
                $akhir = strtotime($akhir);
                if($akhir==0)$akhir = $mulai+(60 * 60 * 24);
                $query->where('tb_dls.date', '>=', $mulai)
                  ->Where('tb_dls.date', '<', $akhir);
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
            );
            if (array_key_exists("lhp",$request->input())){
              $qu->orderBy('ppjk');
              $qu->orderBy('date', 'asc');
              $qu->orderBy('tb_dls.id', 'asc');
            }
            if ($request->input('f')=='dl'){

            }
            if ($request->input('f')=='bstdo'){
              $qu->orderBy('ppjk');
              $qu->orderBy('date', 'asc');
              $qu->orderBy('tb_dls.id', 'asc');
            }
        break;
        case 'lhp':   // Vaariabel Master
          $qu = DB::table('tb_dls')
            ->leftJoin('tb_agens', function ($join) {
              $join->on('tb_dls.agens_id', '=', 'tb_agens.id');
            })
            ->leftJoin('tb_kapals', function ($join) {
              $join->on('tb_dls.kapals_id', '=', 'tb_kapals.id');
            })
            ->leftJoin('tb_jettys', function ($join) {
              $join->on('tb_dls.jetty_id', '=', 'tb_jettys.id');
            })
            ->where(function ($query) use ($mulai,$akhir){
                $mulai = strtotime($mulai);
                $akhir = strtotime($akhir);
                // if($akhir==0)$akhir = $mulai+(60 * 60 * 24);
                // $query->where('date', '>=', $mulai)
                //   ->Where('date', '<=', $akhir);

                // $query->where('lhp_date', '!=', '');
                $query->where('lhp_date', $mulai);

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
              'tb_dls.*'
            );
        break;
        case 'faktur':   // Vaariabel Master
          $qu = DB::table('tb_fakturpajak');
        break;
        case 'mkapal':
          $qu = DB::table('tb_kapals');
        break;
        case 'magen':
          $qu = DB::table('tb_agens');
        break;
        case 'mpc':
          $qu = DB::table('tb_pcs');
        break;
        case 'mdermaga':
          $qu = DB::table('tb_jettys');
        break;
        case 'mmooring':
          $qu = DB::table('tb_moorings');
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
          case 'ppjk':   // Variabel Master
            // if ($row->ppjk == '' || $row->ppjk == null) $row->ppjk = ''; else $row->ppjk = substr($row->ppjk, -5);
            if ($row->lstp_req!='')$row->lstp_req=date("d M Y",$row->lstp_req);
            if ($row->lstp_aprv!='')$row->lstp_aprv=date("d M Y",$row->lstp_aprv);
            $responce['rows'][$i]['id'] = $row->id;
            $responce['rows'][$i]['cell'] = array(
              $row->id,
              date("d/m/Y",$row->date_issue),
              $row->ppjk,
              $row->agenCode,
              $row->kapalsName,
              '('.$row->jettyCode.') '.$row->jettyName,
              date("d/m/Y H:i",$row->eta),
              date("d/m/Y H:i",$row->etd),
              $row->asal,
              $row->tujuan,
              $row->etmal,
              $row->cargo,
              $row->muat,
              $row->lstp_req,
              $row->lstp_aprv,
              $row->lstp,
              $row->ket,
            );
            $i++;
          break;
          case 'dl':   // Variabel Master
            if ($row->kapalsJenis == '') $kapal =  $row->kapalsName; else $kapal = '('.$row->kapalsJenis.') '.$row->kapalsName;
            if ($row->tundaon == '') $tundaon=$row->tundaon; else $tundaon=date("H:i",$row->tundaon);
            if ($row->tundaoff == '') $tundaoff=$row->tundaon; else $tundaoff=date("H:i",$row->tundaoff);
            if ($row->pcon == '') $pcon=$row->pcon; else $pcon=date("H:i",$row->pcon);
            if ($row->pcoff == '') $pcoff=$row->pcon; else $pcoff=date("H:i",$row->pcoff);

            if ($row->ppjk == '' || $row->ppjk == null) $row->ppjk = ''; else $row->ppjk = substr($row->ppjk, -5);

            $responce['rows'][$i]['id'] = $row->id;
            $responce['rows'][$i]['cell'] = array(
              $row->id,
              $row->ppjk,
              $row->agenCode,
              date("d/m/y H:i",$row->date),
              $kapal,
              AppHelpers::formatNomer($row->kapalsGrt),
              AppHelpers::formatNomer($row->kapalsLoa),
              $row->kapalsBendera,
              '('. $row->jettyCode .') '.$row->jettyName,
              $row->ops,
              $row->bapp,
              $row->pc,
              $pcon,
              $pcoff,
              $row->tunda,
              $tundaon,
              $tundaoff,
              $row->dd,
              $row->ket,
              $row->rute,
              $row->mooring,
              $row->lstp,
              $row->ppjks_id,
            );
            $i++;
          break;
          case 'lhp':   // Variabel Master
            if ($row->kapalsJenis == '') $kapal =  $row->kapalsName; else $kapal = '('.$row->kapalsJenis.') '.$row->kapalsName;
            if ($row->tundaon == '') $tundaon=$row->tundaon; else $tundaon=date("H:i",$row->tundaon);
            if ($row->tundaoff == '') $tundaoff=$row->tundaon; else $tundaoff=date("H:i",$row->tundaoff);

            if (is_numeric($row->kapalsGrt))$grt =  number_format($row->kapalsGrt); else $grt = $row->kapalsGrt;
            if (is_numeric($row->kapalsLoa))$loa =  number_format($row->kapalsLoa); else $loa = $row->kapalsLoa;

            $responce['rows'][$i]['id'] = $row->id;
            $responce['rows'][$i]['cell'] = array(
              $row->id,
              $row->ppjk,
              $row->agenCode,
              date("d-m-Y H:i",$row->date),
              $kapal,
              $grt,
              $loa,
              $row->kapalsBendera,
              '('. $row->jettyCode .')'.$row->jettyName,
              $row->ops,
              $row->bapp,
              $row->pc,
              $row->tunda,
              $tundaon,
              $tundaoff,
              $row->dd,
              $row->ket,
              '',
              $row->lstp,
              $row->moring
            );
            $i++;
          break;
          case 'faktur':   // Variabel Master
            // if ($row->date!='')$row->date=date("d M Y",$row->date);
            if ($row->date!='')$row->date=date("d M Y",$row->date);
            $responce['rows'][$i]['id'] = $row->id;
            $responce['rows'][$i]['cell'] = array(
              $row->id,
              $row->date,
              $row->noawal,
              $row->noakhir
            );
            $i++;
          break;
          case 'mkapal':   // Variabel Master
            $responce['rows'][$i]['id'] = $row->id;
            $responce['rows'][$i]['cell'] = array(
              // $i+1,
              $row->id,
              $row->name,
              $row->bendera,
              $row->jenis,
              AppHelpers::formatNomer(''),
              AppHelpers::formatNomer($row->grt),
              AppHelpers::formatNomer($row->loa),
            );
            $i++;
          break;
          case 'magen':   // Variabel Master
            $responce['rows'][$i]['id'] = $row->id;
            $responce['rows'][$i]['cell'] = array(
              // $i+1,
              $row->id,
              $row->code,
              $row->name,
              $row->alamat,
              $row->user,
              $row->tlp,
              $row->npwp,
              $row->ket,
            );
            $i++;
          break;
          case 'mpc':   // Variabel Master
            $responce['rows'][$i]['id'] = $row->id;
            $responce['rows'][$i]['cell'] = array(
              // $i+1,
              $row->id,
              $row->code,
              $row->name,
            );
            $i++;
          break;
          case 'mdermaga':   // Variabel Master
            $responce['rows'][$i]['id'] = $row->id;
            $responce['rows'][$i]['cell'] = array(
              // $i+1,
              $row->id,
              $row->code,
              $row->name,
              $row->ket,
            );
            $i++;
          break;
          case 'mmooring':   // Variabel Master
            $responce['rows'][$i]['id'] = $row->id;
            $responce['rows'][$i]['cell'] = array(
              // $i+1,
              $row->id,
              $row->code,
              $row->name,
              $row->alamat,
              $row->user,
              $row->tlp,
              $row->npwp,
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
