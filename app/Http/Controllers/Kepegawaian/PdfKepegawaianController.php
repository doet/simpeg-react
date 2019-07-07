<?php

namespace App\Http\Controllers\Kepegawaian;
date_default_timezone_set('Asia/Jakarta');

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\GajiHelpers;

use App\Models\menuadmin;
use App\Models\pegawai;
use App\Models\mrawatjalan2;
use App\Models\kk2;
use App\Models\absen;
use App\Models\cuti;

use DB;
use Auth;

class PdfKepegawaianController extends Controller
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
        $multilevel = menuadmin::get_data();
        $aktif_menu = menuadmin::aktif_menu();
        return view('backend.dashboard', compact('multilevel','aktif_menu'));
    }

    public function PDFMarker(Request $request){
        if($request->input('_token')) {
            $category = $request->input('category', 'unknow');
            $start = $request->input('start');
            $end = $request->input('end');
            $page = 'pdf.pdfkepegawaian.'.$request->input('page');
            $nfile = $request->input('file');
            $papersize = 'a4';
            $download=0;

            switch ($category) {
              case 'rawatjalan1': //Pengajuan Pembiyayaan
                $orientation = 'portrait';
                $query = DB::table('tb_mrawatjalan2')
                  ->leftJoin('tb_mrawatjalan', function ($join) {
                    $join->on('tb_mrawatjalan2.id_u', 'tb_mrawatjalan.id_u')
                      ->where('tb_mrawatjalan.platform','like', date('y').'/%');
                  })
                  ->leftJoin('tb_kk2 as user1', function ($join) {
                    $join->on('tb_mrawatjalan2.id_u', 'user1.id_u')
                      ->where('user1.hub', 'karyawan');
                  })
                  ->leftJoin('tb_kk2 as user2','tb_mrawatjalan2.id_p', 'user2.id')
                  ->leftJoin('tbl_datapegawai','tb_mrawatjalan2.id_u', 'tbl_datapegawai.id')
                 // // // // ->leftJoin('tb_mrawatjalan','tb_mrawatjalan2.id_u', '=', 'tb_mrawatjalan.id')
                  // ->join('tb_kk2', function ($join) {
                  //     $join->on('tb_mrawatjalan2.id_u', '=', 'tb_kk2.id_u')
                  //     ->where('tb_kk2.hub', '=', 'karyawan');
                  // })
                  // ->where(function ($qy) use ($request) {
                  //   if ($request->input('id_u')){
                  //     $qy->where('tb_kk2.id_u', $request->input('id_u'));
                  //   }
                  // })
                  ->where(function ($query) use ($start,$end){
                      $mulai = strtotime($start);
                      $akhir = strtotime($end);
                      if($akhir==0)$akhir = $mulai+(60 * 60 * 24);
                      $query->where('tgldoc', '>=', $mulai)
                        ->Where('tgldoc', '<=', $akhir);
                        // ->where('aktif', 1);
                  })
                  ->orderBy('tb_mrawatjalan2.id_u', 'asc')
                  // ->orderBy('tb_mrawatjalan2.no', 'asc')
                  ->select(
                    'tb_mrawatjalan2.id as urut',
                    'user1.nama as karyawan',
                    'user2.nama as pasien',
                    'tbl_datapegawai.rekbank',
                    'tb_mrawatjalan.*',
                    'tb_mrawatjalan2.*'
                  )
                  ->get();


                foreach ($query  as $row) {
                  $query2 = DB::table('tb_mrawatjalan2')
                    ->where('tb_mrawatjalan2.id_u', $row->id_u)
                    // ->where('tb_mrawatjalan2.tgldoc', '<', strtotime($start))
                    ->where(function ($query) use ($start,$end){
                        $mulai = strtotime($start);
                        $query->where('tgldoc', '<', $mulai)
                        ->where('tb_mrawatjalan.platform', date('y').'/%');
                    })
                    ->join('tb_mrawatjalan','tb_mrawatjalan2.id_u', 'tb_mrawatjalan.id')
                    ->get();

                    $dana=explode('/', $row->platform);
                    if (empty($dana[1]))$dana[1]=1;
                    $saldo[$row->id_u] = 0;
                    if ($saldo[$row->id_u] == 0) $saldo[$row->id_u] = $dana[1];
                    foreach ($query2  as $row2) {
                      $saldo[$row->id_u] = $saldo[$row->id_u] - $row2->debit;
                    }
                }
                $view =  \View::make($page, compact('query','saldo','start','end'));
                                 // return view($page, compact('query','saldo','start','end'));
              break;
                case 'bulanan2': //Pengajuan Pembiyayaan
                    $orientation = 'portrait';

                    $query = mrawatjalan2::orderBy('tb_mrawatjalan2.id_u', 'asc')
                    //                  ->join('tb_kk2 as user1','tb_mrawatjalan2.id_u', '=', 'user1.id_u')

                        ->join('tb_kk2 as user1', function ($join) {
                            $join->on('tb_mrawatjalan2.id_u', '=', 'user1.id_u')
                            ->where('user1.hub', '=', 'karyawan');
                        })

                        ->join('tb_kk2 as user2','tb_mrawatjalan2.id_p', '=', 'user2.id')
                        ->join('tbl_datapegawai','tb_mrawatjalan2.id_u', '=', 'tbl_datapegawai.id')
                        ->join('tb_mrawatjalan','tb_mrawatjalan2.id_u', '=', 'tb_mrawatjalan.id')
                        ->orderBy('tb_mrawatjalan2.no', 'asc')
                        ->where('tb_mrawatjalan2.tgldoc', '>=', strtotime($start))
                        ->where('tb_mrawatjalan2.tgldoc', '<=', strtotime($end))
                        ->where('tbl_datapegawai.aktif', '=', 1)
                        ->select('tb_mrawatjalan2.id','user1.nama as karyawan','user2.nama as pasien','tb_mrawatjalan2.*','tb_mrawatjalan.*','tbl_datapegawai.rekbank','user1.hub as hub')
                        ->get();


                    $view =  \View::make($page, compact('query','start','end'))->render();
                    //return view($page, compact('query','pasien','start','end'));
                break;
                case 'logabsen':    //Lampiran absen

                    $div = $request->input('divisi');
                    $idu = $request->input('karyawan');
                    $nfile = $nfile.'_'.$div;
                    $orientation = 'portrait';

                    $absen=absen::where('tb_absen.id_U', '=', $idu)
                        ->leftJoin('tbl_datapegawai','tb_absen.id_u', '=', 'tbl_datapegawai.id')

                        ->join('tb_kk2', function ($join) {
                            $join->on('tb_kk2.id_u', 'tb_absen.id_u')
                            ->where('tb_kk2.hub', 'karyawan');
                        })
                        ->where('tb_absen.date', '>=', strtotime($start))
                        ->where('tb_absen.date', '<=', strtotime($end))

                        ->orderBy('tbl_datapegawai.id_status_jabatan', 'asc')
                        ->orderBy('tb_kk2.nama', 'asc')
                        ->orderBy('tb_absen.date', 'asc')
                        //->skip(0)->take(50)
                        ->get(array('tb_absen.*','tb_absen.id as ida','tb_kk2.nama as nama','tb_kk2.id_u as id_u2','tbl_datapegawai.*'));

                    $view =  \View::make($page, compact('absen','start','end'))->render();
                    //return view($page, compact('query','absen','start','end'));
                break;
                case 'absenr1': //Lampiran absen
                    $orientation = 'portrait';
                    $query = kk2::orderBy('nama', 'asc')
                        ->where('hub','=','karyawan')
                        ->orderBy('nama', 'asc')
                        ->get();

                    $absen=absen::join('tbl_datapegawai','tb_absen.id_u', '=', 'tbl_datapegawai.id')
                        ->join('tb_kk2','tb_absen.id_u','=','tb_kk2.id_u')
                        ->where('tbl_datapegawai.divisi','=','6')
                        ->where('tb_kk2.hub','=','karyawan')
                        ->where('tb_absen.date', '>=', strtotime($start))
                        ->where('tb_absen.date', '<=', strtotime($end))
                        ->where('tbl_datapegawai.aktif', '=', 1)
                        ->orderBy('tbl_datapegawai.id_status_jabatan', 'asc')
                        ->orderBy('tb_kk2.nama', 'asc')
                        ->orderBy('tb_absen.date', 'asc')
                        //->skip(0)->take(50)
                        ->get(array('tb_absen.*','tb_absen.id as ida','tb_kk2.nama as nama','tb_kk2.id_u as id_u2'));


                    $rekap=absen::join('tbl_datapegawai','tb_absen.id_u', '=', 'tbl_datapegawai.id')
                        ->join('tb_kk2','tb_absen.id_u','=','tb_kk2.id_u')
                        //->where('tbl_datapegawai.divisi','=','6')
                        ->where('tb_kk2.hub','=','karyawan')
                        //->where('tb_absen.ket','!=','')
                        ->where('tb_absen.date', '>=', strtotime($start))
                        ->where('tb_absen.date', '<=', strtotime($end))
                        ->where('tbl_datapegawai.aktif', '=', 1)
                        ->orderBy('tbl_datapegawai.id_status_jabatan', 'asc')
                        ->orderBy('tb_kk2.nama', 'asc')
                        ->orderBy('tb_absen.date', 'asc')
                        //->skip(0)->take(50)
                        ->get(array('tb_absen.*','tb_absen.id as ida','tb_kk2.nama as nama','tb_kk2.id_u as id_u2'));

                    $cuti=cuti::join('tbl_datapegawai','tb_cuti.id_u', '=', 'tbl_datapegawai.id')
                        ->join('tb_kk2','tb_cuti.id_u','=','tb_kk2.id_u')
                        ->where('tb_kk2.hub','=','karyawan')
                        ->where('tb_cuti.sdate', '>=',strtotime($start))
                        ->where('tb_cuti.edate','<=',strtotime($end))
                        ->get();

                     $view =  \View::make($page, compact('rekap','query','absen','start','end','cuti'))->render();
                // //    return view($page, compact('rekap','query','absen','start','end','cuti'));
                    // $view =  \View::make('pdf.clear')->render();
                break;
                case 'absenr2': //Lampiran absen
                    $orientation = 'portrait';
                    $query = pegawai::join('tb_kk2','tbl_datapegawai.id','=','tb_kk2.id_u')
                        ->where('tb_kk2.hub','karyawan')
                        ->where('tbl_datapegawai.idabsen','!=','')
                        ->where('tbl_datapegawai.aktif', '=', 1)
                        ->orderBy('wkerja', 'asc')
                        ->orderBy('divisi', 'asc')
                        ->orderBy('jabatan', 'asc')
                        ->get();

                    $absen=absen::join('tbl_datapegawai','tb_absen.id_u', '=', 'tbl_datapegawai.id')
                        ->join('tb_kk2','tb_absen.id_u','=','tb_kk2.id_u')
                        //->where('tbl_datapegawai.divisi','=','6')
                        ->where('tbl_datapegawai.idabsen','!=','')
                        ->where('tb_kk2.hub','=','karyawan')
                        ->where('tb_absen.date', '>=', strtotime($start))
                        ->where('tb_absen.date', '<=', strtotime($end))
                        ->where('tbl_datapegawai.aktif', '=', 1)
                        ->orderBy('tbl_datapegawai.id_status_jabatan', 'asc')
                        ->orderBy('tb_kk2.nama', 'asc')
                        ->orderBy('tb_absen.date', 'asc')
                        //->skip(0)->take(50)
                        ->get(array('tb_absen.*','tb_absen.id as ida','tb_kk2.nama as nama','tb_kk2.id_u as id_u2'));
                    $view =  \View::make($page, compact('query','absen','start','end'))->render();
                    //return view($page, compact('query','absen','start','end'));
                break;
                case 'datapegawai':
                  $download = 2;

                  $orientation = 'portrait';

                  $query = pegawai::where('tbl_datapegawai.tkb',0)
                    ->select('nip','nama','divisi.label as nmdivisi','jabatan.label as nmjabatan','tbl_datapegawai.id')
                    ->join('tb_kk2','tbl_datapegawai.id','=','tb_kk2.id_u')
                    ->join('tb_variabel as divisi', function ($join) {
                        $join->on('tbl_datapegawai.divisi', '=', 'divisi.vid')
                        ->where('divisi.grup', '=', 'divisi');
                    })
                    ->join('tb_variabel as jabatan', function ($join) {
                        $join->on('tbl_datapegawai.jabatan', '=', 'jabatan.vid')
                        ->where('jabatan.grup', '=', 'jabatan');
                    })
                    ->where('tb_kk2.hub','karyawan')
                    ->orderBy('divisi.sort', 'asc')
                    ->orderBy('jabatan', 'asc')
                    ->get();

                  $page = 'pdf.pdfkepegawaian.data_pegawai'; $folder = 'tmp'; $nfile = 'data_pegawai';
                  $view =  \View::make($page, compact('query','saldo','start','end'));
                  //return view($page, compact('query','saldo','start','end'));
                break;
                case 'biodatapegawai':
                  $download = 2;
                  $idu = $request->input('karyawan');
                  $orientation = 'portrait';

                  $query = pegawai::where('tbl_datapegawai.id',$idu)
                    ->select(
                      'tbl_datapegawai.id','idabsen','tmb','tkb','wkerja','rekbank','pendidikan','foto','nip','nama',
                      'jk','dob','agama','email','nokk','alamat','goldar',
                      'divisi.label as nmdivisi','jabatan.label as nmjabatan')
                    ->join('tb_kk1','tbl_datapegawai.id','=','tb_kk1.id')
                    ->join('tb_kk2','tbl_datapegawai.id','=','tb_kk2.id_u')
                    ->join('users','tbl_datapegawai.id','=','users.id')
                    ->join('tb_variabel as divisi', function ($join) {
                        $join->on('tbl_datapegawai.divisi', '=', 'divisi.vid')
                        ->where('divisi.grup', '=', 'divisi');
                    })
                    ->join('tb_variabel as jabatan', function ($join) {
                        $join->on('tbl_datapegawai.jabatan', '=', 'jabatan.vid')
                        ->where('jabatan.grup', '=', 'jabatan');
                    })
                    ->where('tb_kk2.hub','karyawan')
                    ->first();

                  $page = 'pdf.pdfkepegawaian.biodata_pegawai'; $folder = 'tmp'; $nfile = 'biodata_pegawai';
                  $view =  \View::make($page, compact('query','saldo','start','end'));
                  //return view($page, compact('query','saldo','start','end'));
                break;
            }


            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)
                //->setOrientation($orientation)
                ->setPaper($papersize,$orientation);


                $response = array(
                    'status' => 'success',
                    'msg' => 'ok',
                    'nfile' => $nfile,
                );

            //return $pdf->stream($nfile);
            if ($download==0)return $pdf->stream($nfile.'.pdf');
            else if ($download==1)return $pdf->download($nfile.'.pdf');
            else if ($download==2){
              $pdf->save(public_path().'\\files\\'.$folder.'\\'.$nfile.'.pdf')->stream($nfile);
              return Response()->json($response);
            }

        } else { echo "page tidak dapat di diperbaharui, silahkan kembali kehalaman sebelum";}
    }

}
