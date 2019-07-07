<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notif;
use App\Events\NotifSent;

use App\Message;
use App\Events\MessageSent;

class Notif1Controller extends Controller
{
  public function index()
  {
    $messages = Notif::get();
    if(request()->wantsJson()){
      return $messages;
    }
    // dd($messages);
    return view('notif');
  }

  public function store(Request $request)
  {
    $message = new Notif;
    $content = $request->content;
    $message->content = $content;
    $message->uuid = $request->uuid;
    $message->users_id = 1;
    $message->read = 1;
    $message->save();
    broadcast(new NotifSent($message));
    return $message;
  }
}
