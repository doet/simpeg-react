<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\menuadmins;

use App\Models\pegawai;

use DB;
use Auth;



class PayrollController extends Controller
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
     * @return Response
     */

    public function koperasi(){
      if (Auth::user()->admin){
        $id=Auth::user()->id;
        $multilevel = menuadmins::get_data(0,$id);
        $index      = menuadmins::where('part','koperasi')->first();
        $aktif_menu = menuadmins::aktif_menu($index['id']);
        return view('backend.payroll.koperasi', compact('multilevel','aktif_menu'));
      }
    }
    public function pkoperasi(){
      if (Auth::user()->admin){
        $id=Auth::user()->id;
        $multilevel = menuadmins::get_data(0,$id);
        $index      = menuadmins::where('part','pkoperasi')->first();
        $aktif_menu = menuadmins::aktif_menu($index['id']);
        return view('backend.payroll.pkoperasi', compact('multilevel','aktif_menu'));
      }
    }

    public function upah(){
      if (Auth::user()->admin){
        $id=Auth::user()->id;
        $multilevel = menuadmins::get_data(0,$id);
        $index      = menuadmins::where('part','upah')->first();
        $aktif_menu = menuadmins::aktif_menu($index['id']);
        return view('backend.payroll.upah', compact('multilevel','aktif_menu'));
      }
    }
    public function potongan(){
      if (Auth::user()->admin){
        $id=Auth::user()->id;
        $multilevel = menuadmins::get_data(0,$id);
        $index      = menuadmins::where('part','potongan')->first();
        $aktif_menu = menuadmins::aktif_menu($index['id']);
        return view('backend.payroll.potongan', compact('multilevel','aktif_menu'));
      }
    }
    public function uploaddata(){
      if (Auth::user()->admin){
        $id=Auth::user()->id;
        $multilevel = menuadmins::get_data(0,$id);
        $index      = menuadmins::where('part','uploaddata')->first();
        $aktif_menu = menuadmins::aktif_menu($index['id']);

        return view('backend.payroll.uploaddata', compact('multilevel','aktif_menu'));
      }
    }

    public function pengaturanpayroll(){
        if (Auth::user()->admin){
            $id=Auth::user()->id;
            $multilevel = menuadmins::get_data(0,$id);
            $index      = menuadmins::where('part','pengaturanpayroll')->first();
            $aktif_menu = menuadmins::aktif_menu($index['id']);

            return view('backend.payroll.masterdata', compact('multilevel','aktif_menu'));
            //return view('html5', compact('multilevel','aktif_menu'));
        }
    }



}
