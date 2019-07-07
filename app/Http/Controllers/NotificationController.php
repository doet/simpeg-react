<?php

namespace App\Http\Controllers;
date_default_timezone_set('Asia/Jakarta');

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\menuadmins;
use DB;
use Auth;

use App\Notif;
use App\Events\NotifSent;

use App\Message;
use App\Events\MessageSent;

class NotificationController extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  
  public function index(Request $request)
  {
    $multilevel = menuadmins::get_data();
    $index      = menuadmins::where('part','notification')->first();
    $aktif_menu = menuadmins::aktif_menu($index['id']);
    return view('backend.notification.notification', compact('multilevel','aktif_menu'));
  }

  public function store(Request $request)
  {
  }
}
