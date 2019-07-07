<?php

namespace App\Http\Controllers\Masterdata;
date_default_timezone_set('Asia/Jakarta');

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\menuadmins;
use App\Models\variabel;
use App\Models\libur;
use App\Models\diagnos;

use DB;
use Auth;



class MasterDataApiController extends Controller
{
  public function json(Request $request){
    $datatb = $request->input('datatb', '');
    $responce = array();
    switch ($datatb) {
      case 'users':
        $query = DB::table('users')
          ->where(function ($query) use ($request){
            $query->where('admin',1);
          })
          ->get();
        foreach($query as $row) {
          $responce[]=$row;
        }
      break;
    }
    // dd(Response()->json($responce));
    return Response()->json($responce);

  }
  public function cud(Request $request){
    $datatb = $request->input('datatb', '');
    $oper = $request->input('oper');
    $id = $request->input('id');

    switch ($datatb) {
      case 'nilai':
        $datanya=array(
          'grup'=>$request->input('grup'),
          'label'=>$request->input('label'),
          'label2'=>$request->input('label2',''),
          'updated_at' =>date("Y-m-d H:i:s")
        );

        if ($oper=='add')spd::insert($datanya);
        if ($oper=='edit')variabel::where('id', $id)->update($datanya);
        if ($oper=='del')spd::destroy($id);

        $response = array(
            'status' => 'success',
            'msg' => 'ok',
        );
        return $response;
      break;
      case 'mlibur':
        $datanya=array(
          'tgllibur'=>strtotime($request->input('sdate')),
          'ket'=>$request->input('keterangan',''),
          'updated_at' =>date("Y-m-d H:i:s")
        );

        if ($oper=='add')libur::insert($datanya);
        if ($oper=='edit')libur::where('id', $id)->update($datanya);
        if ($oper=='del')libur::destroy($id);
        $response = array(
            'status' => 'success',
            'msg' => 'ok',
        );
        return $response;
      break;
      case 'diagnos':
        $datanya=array(
          'ket'=>$request->input('keterangan',''),
          'updated_at' =>date("Y-m-d H:i:s")
        );

        if ($oper=='add')diagnos::insert($datanya);
        if ($oper=='edit')diagnos::where('id', $id)->update($datanya);
        if ($oper=='del')diagnos::destroy($id);
        $response = array(
            'status' => 'success',
            'msg' => 'ok',
        );
        return $response;
      break;
      case 'mamenu':
        $datanya=array(
          'akses'=>implode(",",$request->user),
        );

        if ($oper=='edit')$edit = DB::table('menuadmins')->where('id', $id)->update($datanya);
        // dd(DB::table('menuadmins')->where('id', $id)->first()->parent_id);
        // $response = array(
        //     'status' => 'success',
        //     'msg' => 'ok',
        // );
        return $response;
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

        switch ($datatb) {
            case 'nilai':   // Vaariabel Master
                $sidx = $request->input('sidx', 'sort');
                $qu = variabel::where('grup', '=', $request->input('grup'));
            break;
            case 'mlibur':   // Libur dan Cuti Bersama
                $sidx = $request->input('sidx', 'tgllibur');
                $qu = DB::table('tb_libur');
            break;
            case 'diagnos':  // diognosa sakit
                $sidx = $request->input('sidx', 'id');
                $qu = DB::table('tb_diagnos');
            break;
            case 'mmuser':
                $sidx = $request->input('sidx', 'id');
                $qu = DB::table('users')
                ->where(function ($query) use ($request){
                  $query->where('admin',1);
                });
            break;
            case 'mamenu':
                $sidx = $request->input('sidx', 'id');
                $qu = DB::table('menuadmins')
                ->where(function ($query) use ($request){
                  // $query->where('admin',1);
                });
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

        $query = $qu->orderBy($sidx, $sord)
          ->skip($start)->take($limit)
          ->get();

        $i=0;
        foreach($query as $row) {
            switch ($datatb) {
                case 'nilai':   // Variabel Master
                    $responce['rows'][$i]['id'] = $row->id;
                    $responce['rows'][$i]['cell'] = array(
                        '',
                        $row->vid,
                        $row->label,
                        $row->label2
                    );
                    $i++;
                break;
                case 'mlibur':  // Libur dan Cuti Bersama
                    $responce['rows'][$i]['id'] = $row->id;
                    $responce['rows'][$i]['cell'] = array(
                        '',
                        date('d F Y', $row->tgllibur),
                        $row->ket
                    );
                    $i++;
                break;
                case 'diagnos':  // Libur dan Cuti Bersama
                    $responce['rows'][$i]['id'] = $row->id;
                    $responce['rows'][$i]['cell'] = array(
                        '',
                        $row->id,
                        $row->ket
                    );
                    $i++;
                break;
                case 'mmuser':
                    $responce['rows'][$i]['id'] = $row->id;
                    $responce['rows'][$i]['cell'] = array(
                        $row->id,
                        $row->name,
                        $row->email,
                    );
                    $i++;
                break;
                case 'mamenu':
                  $username = '';
                  // $userarray = explode(",",$row->akses);
                  foreach(explode(",",$row->akses) as $u) {
                    $qu = DB::table('users')
                      ->where(function ($query) use ($u){
                        $query->where('admin',1);
                        $query->where('id',$u);
                      })->first();
                      if ($qu)$username = $username.''.$qu->name.',';
                  };

                  $responce['rows'][$i]['id'] = $row->id;
                  $responce['rows'][$i]['cell'] = array(
                      $row->id,
                      $row->label,
                      $username,
                      $row->akses,
                  );
                  $i++;
                break;

            }
        }
        return  Response()->json($responce);
    }
}
