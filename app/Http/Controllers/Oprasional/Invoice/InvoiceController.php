<?php

namespace App\Http\Controllers\Oprasional\Invoice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\menuadmins;

class InvoiceController extends Controller
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
  // public function index()
  // {
  //   $multilevel = menuadmins::get_data();
  //   $index      = menuadmins::where('part','bank')->first();
  //   $aktif_menu = menuadmins::aktif_menu($index['id']);
  //   return view('backend.oprasional.uploadxls', compact('multilevel','aktif_menu'));
  // }

  public function listinvoice()
  {
    $multilevel = menuadmins::get_data();
    $index      = menuadmins::where('part','oprasional\listinvoice')->first();
    $aktif_menu = menuadmins::aktif_menu($index['id']);
    return view('backend.oprasional.invoice.listinvoice', compact('multilevel','aktif_menu'));
  }

  public function mkapal(){
    return view('backend.oprasional.submasterdata.mkapal');
  }
  public function magen(){
      return view('backend.oprasional.submasterdata.magen');
  }
  public function mpc(){
    return view('backend.oprasional.submasterdata.mpc');
  }
  public function mdermaga(){
      return view('backend.oprasional.submasterdata.mdermaga');
  }
  public function mmooring(){
      return view('backend.oprasional.submasterdata.mmooring');
  }
}
