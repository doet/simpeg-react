<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\menuadmins;
use DB;
use Auth;

class CekController extends Controller
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
    public function index()
    {      
        $id=Auth::user()->id;
        if (Auth::user()->admin){
            $multilevel = menuadmins::get_data(0,$id);
            $aktif_menu = menuadmins::aktif_menu();
            return view('backend.dashboard', compact('multilevel','aktif_menu'));
        } else {
            echo "Karyawan";
//            Route::get('/', 'UserController@index');
//            return Redirect::action('KaryawanController@index');
//            return redirect()->action('KaryawanController@biodata');
        }
    }
}
