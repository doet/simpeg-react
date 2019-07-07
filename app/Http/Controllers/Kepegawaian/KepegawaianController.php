<?php

namespace App\Http\Controllers\Kepegawaian;
date_default_timezone_set('Asia/Jakarta');

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\menuadmins;
use App\Models\pegawai;
use App\Models\variabel;
use App\Models\kk2;


use DB;
use Auth;



class KepegawaianController extends Controller
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

    public function pkaryawa(){
        if (Auth::user()->admin){
            $id=Auth::user()->id;
            $multilevel = menuadmins::get_data(0,$id);
            $index      = menuadmins::where('part','pkaryawa')->first();
            $aktif_menu = menuadmins::aktif_menu($index['id']);

            $karyawan   = pegawai::where('tb_kk2.hub','karyawan')
                ->leftJoin('tb_kk2','tb_kk2.id_u', '=', 'tbl_datapegawai.id')
                ->leftJoin('tb_variabel as v1', function ($join) {
                    $join->on('v1.vid', '=', 'tbl_datapegawai.jabatan')
                        ->where('v1.grup', '=', 'jabatan');
                })

                ->leftJoin('tb_variabel as v2', function ($join) {
                    $join->on('v2.vid', '=', 'tbl_datapegawai.divisi')
                        ->where('v2.grup', '=', 'divisi');
                })
                ->orderBy('tbl_datapegawai.id', 'asc')
                ->get();

            return view('backend.kepegawaian.pkaryawa', compact('multilevel','aktif_menu','karyawan'));
        }
    }
    public function editkaryawan($e){

        if (Auth::user()->admin){
            $id=Auth::user()->id;
            $multilevel = menuadmins::get_data(0,$id);
            $index      = menuadmins::where('part','pkaryawa')->first();
            $aktif_menu = menuadmins::aktif_menu($index['id']);

            return view('backend.kepegawaian.editkaryawan', compact('multilevel','aktif_menu','e'));
        }
    }

    public function dapeg($e){

        if (Auth::user()->admin){

            $karyawan = pegawai::where('tb_kk2.hub','karyawan')
                ->leftJoin('tb_kk2','tb_kk2.id_u', '=', 'tbl_datapegawai.id')

                ->leftJoin('tb_variabel as v1', function ($join) {
                    $join->on('v1.vid', '=', 'tbl_datapegawai.jabatan')
                        ->where('v1.grup', '=', 'jabatan');
                })

                ->leftJoin('tb_variabel as v2', function ($join) {
                    $join->on('v2.vid', '=', 'tbl_datapegawai.divisi')
                        ->where('v2.grup', '=', 'divisi');
                })

                ->leftJoin('users','users.id', '=', 'tbl_datapegawai.id')
                ->leftJoin('tb_kk1','tb_kk1.id', '=', 'tbl_datapegawai.id')

                ->where('tbl_datapegawai.id', $e)
                ->first();

                $query = pegawai::orderBy('nip', 'desc')
                        ->first(array('nip'));

                $jbtnslc = variabel::where('grup', '=', 'jabatan')
                    //->where('vid', '!=', 0)
                    ->get();
                $divslc = variabel::where('grup', '=', 'divisi')
                    //->where('vid', '!=', 0)
                    ->get();

            return view('backend.kepegawaian.subkepegawaian.dapeg', compact('query', 'jbtnslc','divslc','karyawan','e'));
        }
    }
    public function dakel($e){

        if (Auth::user()->admin){
            return view('backend.kepegawaian.subkepegawaian.dakel', compact('e'));
        }
    }

    public function dcuti(){
      if (Auth::user()->admin){
        $id=Auth::user()->id;
        $multilevel = menuadmins::get_data(0,$id);
        $index      = menuadmins::where('part','dcuti')->first();
        $aktif_menu = menuadmins::aktif_menu($index['id']);

        $karyawan   = pegawai::where('tb_kk2.hub','karyawan')
          ->where('tbl_datapegawai.aktif', '=', 1)
          ->leftJoin('tb_kk2','tb_kk2.id_u', '=', 'tbl_datapegawai.id')
          ->leftJoin('tb_variabel as v1', function ($join) {
              $join->on('v1.vid', '=', 'tbl_datapegawai.jabatan')
                  ->where('v1.grup', '=', 'jabatan');
          })

          ->leftJoin('tb_variabel as v2', function ($join) {
              $join->on('v2.vid', '=', 'tbl_datapegawai.divisi')
                  ->where('v2.grup', '=', 'divisi');
          })
          ->orderBy('tbl_datapegawai.id', 'asc')
          ->get();

        return view('backend.kepegawaian.dcuti', compact('multilevel','aktif_menu','karyawan'));
      }
    }

    public function wspd(){
        if (Auth::user()->admin){
            $id=Auth::user()->id;
            $multilevel = menuadmins::get_data(0,$id);
            $index      = menuadmins::where('part','wspd')->first();
            $aktif_menu = menuadmins::aktif_menu($index['id']);
            $karyawan   = pegawai::where('tb_kk2.hub','karyawan')
                ->where('tbl_datapegawai.aktif', '=', 1)
                ->leftJoin('tb_kk2','tb_kk2.id_u', '=', 'tbl_datapegawai.id')
                ->leftJoin('tb_variabel as v1', function ($join) {
                    $join->on('v1.vid', '=', 'tbl_datapegawai.jabatan')
                        ->where('v1.grup', '=', 'jabatan');
                })

                ->leftJoin('tb_variabel as v2', function ($join) {
                    $join->on('v2.vid', '=', 'tbl_datapegawai.divisi')
                        ->where('v2.grup', '=', 'divisi');
                })
                ->orderBy('tbl_datapegawai.id', 'asc')
                ->get();

            return view('backend.kepegawaian.wspd', compact('multilevel','aktif_menu','karyawan'));
        }
    }
    public function mrawatjalan(){
        if (Auth::user()->admin){
            $id=Auth::user()->id;
            $multilevel = menuadmins::get_data(0,$id);
            $aktif_menu = menuadmins::aktif_menu(10);
            $karyawan = kk2::join('tbl_datapegawai','tbl_datapegawai.id', '=', 'tb_kk2.id_u')
                ->where('tb_kk2.hub', '=', 'karyawan')->where('tbl_datapegawai.aktif', '=', 1)->get();
            return view('backend.kepegawaian.mrawatjalan', compact('multilevel','aktif_menu','karyawan'));
        }
    }

    public function jshift(){
        if (Auth::user()->admin){
            $id=Auth::user()->id;
            $multilevel = menuadmins::get_data(0,$id);
            $index      = menuadmins::where('part','jshift')->first();
            $aktif_menu = menuadmins::aktif_menu($index['id']);
            $query = pegawai::join('tb_kk2','tbl_datapegawai.id', '=', 'tb_kk2.id_u')
                ->leftjoin('tb_jshiftopt', 'tbl_datapegawai.id', '=', 'tb_jshiftopt.id_u')
                ->where('tb_kk2.hub', '=', 'karyawan')
                ->where('tbl_datapegawai.wkerja', '!=', 0)
                ->where('tbl_datapegawai.jabatan', '=', 22)
                ->where('tbl_datapegawai.aktif', '=', 1)
                ->get(array('tbl_datapegawai.*','tb_kk2.*','tb_jshiftopt.*','tbl_datapegawai.id as id'));
            return view('backend.kepegawaian.jadwalshift', compact('multilevel','aktif_menu','karyawan','query'));
        }
    }

    public function jshiftopr(){
        if (Auth::user()->admin){
            $id=Auth::user()->id;
            $multilevel = menuadmins::get_data(0,$id);
            $index      = menuadmins::where('part','jshiftopr')->first();
            $aktif_menu = menuadmins::aktif_menu($index['id']);
            $query = pegawai::join('tb_kk2','tbl_datapegawai.id', '=', 'tb_kk2.id_u')
                ->leftjoin('tb_jshiftopt', 'tbl_datapegawai.id', '=', 'tb_jshiftopt.id_u')
                ->where('tb_kk2.hub', '=', 'karyawan')
                ->where('tbl_datapegawai.wkerja', '!=', 0)
                ->where('tbl_datapegawai.jabatan', '=', 10)
                ->where('tbl_datapegawai.aktif', '=', 1)
                ->get(array('tbl_datapegawai.*','tb_kk2.*','tb_jshiftopt.*','tbl_datapegawai.id as id'));
            return view('backend.kepegawaian.jadwalshiftopr', compact('multilevel','aktif_menu','query'));
        }
    }

    public function absen(){
        if (Auth::user()->admin){
            $id=Auth::user()->id;
            $multilevel = menuadmins::get_data(0,$id);
            $index      = menuadmins::where('part','absen')->first();
            $aktif_menu = menuadmins::aktif_menu($index['id']);

            $customer = pegawai::join('tb_kk2','tbl_datapegawai.id', '=', 'tb_kk2.id_u')
                ->where('tb_kk2.hub', '=', 'karyawan')
                ->where('tbl_datapegawai.aktif', '=', 1)
                ->get(array('tbl_datapegawai.*','tb_kk2.nama'));


            return view('backend.kepegawaian.absen', compact('multilevel','aktif_menu','customer'));
        }
    }
}
