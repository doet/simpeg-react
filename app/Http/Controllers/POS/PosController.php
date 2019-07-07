<?php

namespace App\Http\Controllers\POS;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\menuadmins;
use App\Models\tb_pos_produks;

class PosController extends Controller
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
         $aktif_menu = menuadmins::aktif_menu();
         return view('backend.dashboard', compact('multilevel','aktif_menu'));
     }

     public function pos()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','pos')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         $produk      = tb_pos_produks::all();
         return view('backend.pos', compact('multilevel','aktif_menu','produk'));
        //  return view('layouts.app2');
     }
}
