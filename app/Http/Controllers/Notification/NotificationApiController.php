<?php

namespace App\Http\Controllers\Notification;
date_default_timezone_set('Asia/Jakarta');

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;

use DB;
use Auth;

use App\Events\NotifSent;


class NotificationApiController extends Controller
{

  // public function __construct()
  // {
  //   $this->middleware('auth');
  // }

  public function jqgrid (Request $request)
  {
    // dd($request->input());
    $datatb = $request->input('datatb', '');
    $cari = $request->input('cari', '0');

    $page = $request->input('page', '1');
    $limit = $request->input('rows', '10');
    $sord = $request->input('sord', 'asc');
    $sidx = $request->sidx;
    switch ($datatb) {
      case 'notif':
        $qu = DB::table('notifs');
          // ->where(function ($query) use ($request){})
          // ->select();
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
        case 'notif':   // Variabel Master
          $responce['rows'][$i]['id'] = $row->id;
          $responce['rows'][$i]['cell'] = array(
            $row->id,
            $row->users_id,
            $row->content,
            $row->read,
            $row->uuid,
          );
          $i++;
        break;
      }
    }
    return  Response()->json($responce);
  }

  public function cud (Request $request){
    if ( $request->oper =='add'){
      $datanya['content'] = $request->content;
      $datanya['uuid'] = Uuid::uuid4();
      $datanya['users_id'] = $request->users;
      $datanya['created_at'] = date('Y-m-d H:i:s');
      DB::table('notifs')->insert($datanya);
      $datanya['id'] = DB::getPdo()->lastInsertId();
      $datanya['read'] = "0,";
    } else if ( $request->oper =='edit'){
      $datanya['content'] = $request->content;
      $datanya['uuid'] = $request->uuid;
      $datanya['updated_at']  = date('Y-m-d H:i:s');
      // $datanya['read'] = str_replace("0,","",$request->read);
      DB::table('notifs')->where('id', $request->id)->update($datanya);
      $datanya['users_id'] = $request->users;
      // $datanya['index'] = $request->index;
    }
    $datanya['oper'] = $request->oper;

    broadcast(new NotifSent($datanya));
    return $datanya;
  }
  public function json (Request $request){
    $responce['head'] = array(
      ['title'=>'id'],
      ['title'=>'uuid'],
      ['title'=>'user'],
      ['title'=>'Content'],
      ['title'=>'Read'],
    );
    $query = DB::table('notifs')->get();
    foreach($query as $key => $qu) {
      foreach($qu as $row) {
        $responce['body'][$key][] = $row;
      }
    }
    $responce['hide'] = array(1);
    return  Response()->json($responce);
  }
}
