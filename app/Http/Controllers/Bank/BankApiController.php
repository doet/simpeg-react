<?php

namespace App\Http\Controllers\Bank;
date_default_timezone_set('Asia/Jakarta');

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\tb_banktrxs;
use App\Models\members;

class BankApiController extends Controller
{
  public function daftartrx()
  {

    $result = tb_banktrxs::all();
    return response($result);
  }

  public function jqgrid(Request $request){

      $datatb = $request->input('datatb', '');
      $cari = $request->input('cari', '0');

      $page = $request->input('page', '1');
      $limit = $request->input('rows', '10');
      $sord = $request->input('sord', 'asc');

// Menentukan Jumlah Query //
      switch ($datatb) {
        case 'datatrx':   // Variabel Master
// $responce =  members::count();
          $sidx = $request->input('sidx', 'id');
          $count = tb_banktrxs::count();
        break;
      }

// Membagi Query //
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
      $test =0;
  // Mengambil Nilai Query //
      switch ($datatb) {
        case 'datatrx':   // Vaariabel Master
          $query = tb_banktrxs::orderBy($sidx, $sord)
            ->where(function ($qy) use ($request) {

              if ($request->input('_search') == 'true') {
                $saring=json_decode($request->input('filters'));
                for($i=0 ; $i < count($saring->rules) ; $i++ ){
                  if ($saring->rules[$i]->field == 'kodetrx') {
                    $field = 'kodetrx';
                    $excpt = false;
                  } else  if ($saring->rules[$i]->field == 'name') {
                    $field = 'name';
                    $excpt = false;
                  } else  if ($saring->rules[$i]->field == 'uraian') {
                    $field = 'uraian';
                    $excpt = false;
                  } else  if ($saring->rules[$i]->field == 'tanggal') {
                    $field = 'tanggal';
                    $excpt = true;
                    $saring->rules[$i]->data = strtotime($saring->rules[$i]->data);
                  }

                  if ($saring != '') {
                    if ($excpt == false){
                      $qy->where($field, 'Like', $saring->rules[$i]->data.'%');
                    } else{
                      $qy->where($field, '>=', $saring->rules[$i]->data);
                      $qy->where($field, '<=', $saring->rules[$i]->data+86400);

                     }
                  }

                }
              }
            })
            //->where('user_id','1')
            ->orderBy('tanggal', 'asc')
            ->leftJoin('members','members.id','tb_banktrxs.user_id')
            ->skip($start)->take($limit)
            ->get(array('tb_banktrxs.*', 'members.name'));
        break;
      }

      $i=0;
      foreach($query as $row) {
        switch ($datatb) {
          case 'datatrx':   // Variabel Master
            $setor=$tarik = $start=$end=0;

            if ($row->kodetrx=='str'){
              $setor = $row->nilai;
              $tarik = 0;
            } else {
              $setor = 0;
              $tarik = '('.number_format($row->nilai).')';
            }

            $saldoa = tb_banktrxs::orderBy('tanggal', 'asc')
              ->leftJoin('members','members.id','tb_banktrxs.user_id')
              ->where('user_id',$row->user_id)
              ->where('tanggal','<',$row->tanggal)
              ->get(array('tb_banktrxs.*', 'members.name'));

            foreach($saldoa as $subrow) {
              $start = $start + $subrow->nilai;
              $end = $start + $row->nilai;
            }
            if ($start==0) $end = $start + $row->nilai;

            $responce['rows'][$i]['id'] = $row->id;
            $responce['rows'][$i]['cell'] = array(
              $test,
              $row->notrx,
              $row->kodetrx,
              date("d-m-Y H:i:s T", $row->tanggal),
              $row->user->name,
              $row->uraian,
              number_format($start),
              number_format($setor),
              $tarik,
              number_format($end)
            );
            $i++;
          break;
        }
      }
      return  Response()->json($responce);
  }
  public function json(Request $request)
  {
    $datatb = $request->input('datatb', '');

    $newid= 0;
    switch ($datatb) {
      case 'member':
        $query =  members::orderBy('name', 'asc')->get();
        $member=array();
        foreach($query as $row) {
          $member[$row->id] = $row->name;
        }
        $responce['member'] = $member;
      break;
      case 'newinput':
        $query =  tb_banktrxs::orderBy('id', 'asc')->get();
        foreach($query as $row) {
          $newid = $row->notrx;
        }
        $responce['newid'] = $newid+1;
      break;
      case 'loadtrx';
        $query =  tb_banktrxs::where('id',$request->input('idtrx', ''))->first();

        $responce['notrx'] = $query['notrx'];
        $responce['kode'] = $query['kodetrx'];
        $responce['tanggal'] = date("d-m-Y g:i:s A",$query['tanggal']);
        $responce['member'] = $query['user_id'];
        $responce['uraian'] = $query['uraian'];
        if ($query['kodetrx']=='trk')$query['nilai'] = str_replace('-', '', $query['nilai']);
        $responce['nilai'] = number_format($query['nilai']);
      break;
    }

    return  Response()->json($responce);
  }
  public function save(Request $request)
  {
    $datatb = $request->input('datatb', '');
    $oper = $request->input('oper', '');
    $id = $request->input('id', '');

    $newid= 0;
    switch ($datatb) {
      case 'trxharian':
        $nilai =  str_replace(',', '', $request->input('nilai'));
        if ($request->input('kode')=='trk') $nilai = '-'.$nilai;
        $datanya = array(
          'user_id' => $request->input('member'),
          'notrx' => $request->input('notrx'),
          'kodetrx' => $request->input('kode'),
          'tanggal' => strtotime($request->input('tanggal')),
          'uraian' => $request->input('uraian'),
          'nilai' => $nilai,
        );
        if ($oper=='add')tb_banktrxs::insert($datanya); //'created_at' =>date("Y-m-d H:i:s"),
        if ($oper=='edit')tb_banktrxs::where('id', $id)->update($datanya); //'updated_at' =>date("Y-m-d H:i:s")
        if ($oper=='del')tb_banktrxs::destroy($id);

        $responce['status'] = 'success';
      break;
    }

    return  Response()->json($responce);
  }
}
