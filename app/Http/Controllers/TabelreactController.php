<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\menuadmins;

class TabelreactController extends Controller
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
  public function index()
  {
    $multilevel = menuadmins::get_data();
    $index      = menuadmins::where('part','triact')->first();
    $aktif_menu = menuadmins::aktif_menu($index['id']);
    return view('backend.react.tabel', compact('multilevel','aktif_menu'));
  }
}
