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

class Notif2Controller extends Controller
{
  public function index(Request $request)
  {
      $messages = Notif::get();
      if(request()->wantsJson()){
        return $messages;
      }
      return view('notif2');
  }

  public function store(Request $request)
  {

  }
}
