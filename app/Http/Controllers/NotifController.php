<?php

namespace App\Http\Controllers;
date_default_timezone_set('Asia/Jakarta');

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;

use App\Notif;
use App\Events\NotifSent;

use App\Message;
use App\Events\MessageSent;

class NotifController extends Controller
{
  public function index(Request $request)
  {
    // $messages = Notif::get();
    // if(request()->wantsJson()){
    //   return $messages;
    // }
    // dd($messages);
    // return view('notif2');
    $responce['users']=Auth::user();

    $query = DB::table('Notifs')
      ->where(function ($query) use ($responce){
      //   if ($request->input('search')){
          $query->where('users_id',$responce['users']->id)->orWhere('users_id', '0');
      //   };
      //   if ($request->input('filter')){
      //     $query->where($request->input('filter'),null);
      //   };
      })
      ->select()
      ->orderBy('id','desc')
      ->get();

    // $unread=array();
    $items=array();
    $i=0;
    $unread=0;
    foreach($query as $row) {
      $responce['msg'][$i]['id'] = $row->id;
      $responce['msg'][$i]['users_id'] = $row->users_id;
      $responce['msg'][$i]['uuid'] = $row->uuid;
      $responce['msg'][$i]['read'] = $row->read;
      $responce['msg'][$i]['content'] = $row->content;
      $responce['msg'][$i]['created_at'] = $row->created_at;
      $i++;

      if (!in_array($responce['users']->id,explode(",",$row->read)))$unread++;
    }
    $responce['unread']=$unread;
    return  Response()->json($responce);
  }

  public function store(Request $request)
  {
      // dd(Auth::user());
    if ( $request->oper =='add'){
      $datanya = new Notif;
      $datanya->content = $request->content;
      $datanya->uuid = $request->uuid;
      $datanya->users_id = 1;
      $datanya->read = 0;
      // $datanya->save();
      $datanya->oper =  $request->oper;
    } else if ( $request->oper =='edit'){
      $datanya['read'] = $request->read;
      $datanya['updated_at']  = $request->updated_at;
      $datanya['read'] = str_replace("0,","",$request->read);

      DB::table('notifs')->where('id', $request->id)->update($datanya);
      $datanya['users_id'] = $request->users_id;
      $datanya['index'] = $request->index;
    }
    $datanya['oper'] = $request->oper;

    broadcast(new NotifSent($datanya));
    return $datanya;
  }
}
