<?php

namespace App\Http\Controllers\Masterdata;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\menuadmins;

use DB;
use Auth;



class MasterDataController extends Controller
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

    public function masterdata(){
        if (Auth::user()->admin){
            $id=Auth::user()->id;
            $multilevel = menuadmins::get_data(0,$id);
            $index      = menuadmins::where('part','masterdata')->first();
            $aktif_menu = menuadmins::aktif_menu($index['id']);

            return view('backend.masterdata.masterdata', compact('multilevel','aktif_menu'));
            //return view('html5', compact('multilevel','aktif_menu'));
        }
    }

    public function mjabatan(){
        return view('backend.masterdata.submasterdata.mjabatan');
    }

    public function mdivisi(){
        return view('backend.masterdata.submasterdata.mdivisi');
    }

    public function mlibur(){
        return view('backend.masterdata.submasterdata.mlibur');
    }
    public function mdiagnosa(){
        return view('backend.masterdata.submasterdata.mdiagnosa');
    }
    public function mmuser(){
        return view('backend.masterdata.submasterdata.mmuser');
    }
    public function mamenu(){
        return view('backend.masterdata.submasterdata.mamenu');
    }

}
