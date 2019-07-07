<?php

namespace App\Http\Controllers\Inventaris;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\menuadmins;

class InventarisController extends Controller
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
    $index      = menuadmins::where('part','bank')->first();
    $aktif_menu = menuadmins::aktif_menu($index['id']);
    return view('backend.inventaris.index', compact('multilevel','aktif_menu'));
  }
}
