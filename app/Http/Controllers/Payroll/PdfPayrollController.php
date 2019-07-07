<?php

namespace App\Http\Controllers\Payroll;
date_default_timezone_set('Asia/Jakarta');

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\GajiHelpers;

use App\Models\menuadmins;
use App\Models\pegawai;
use App\Models\mrawatjalan2;
use App\Models\kk2;
use App\Models\absen;
use App\Models\cuti;



class PdfPayrollController extends Controller
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

    public function PDFMarker(Request $request){
      if($request->input('_token')) {
        $category = $request->input('category', 'unknow');
        $start = $request->input('start');
        $end = $request->input('end');
        $page = 'pdf.pdfpayroll.'.$request->input('page');
        $nfile = $request->input('file');
        $papersize = 'a4';
        $download=0;

        switch ($category) {
          case 'slip':
            $folder = 'slips';
            $orientation = 'portrait';
            $page = 'pdf.pdfpayroll.slip';
            $query = pegawai::where('tbl_datapegawai.tmb','>=',$start)
              // ->where('tbl_datapegawai.tkb',0)
              ->where(function ($qy) use ($start) {
                $qy->where('tbl_datapegawai.tkb','<',$start);
              })
              ->where('tbl_datapegawai.id','<',5)
              ->select('nip','nama','rekbank','wkerja','divisi.label as nmdivisi','jabatan.label as nmjabatan','tbl_datapegawai.id')
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

            foreach ($query as $row) {
              $view =  \View::make($page, compact('row','saldo','start','end'));

              $pdf = \App::make('dompdf.wrapper');
              $pdf->loadHTML($view)
                //->setOrientation($orientation)
                ->setPaper($papersize,$orientation);

              $pdf->save(public_path().'\\files\\'.$folder.'\\'.$nfile.'_'.$row->id.'.pdf')->stream($nfile);
            }
            return;
          break;
          case 'shift':
            $folder = 'tmp';
            $orientation = 'portrait';
            $query = pegawai::where('tbl_datapegawai.tmb','>=',$start)
              // ->where('tbl_datapegawai.tkb',0)
              ->where(function ($qy) use ($start) {
                $qy->where('tbl_datapegawai.tkb','<',$start);
              })
              ->where('tbl_datapegawai.id','!=',1)
              ->select('nip','nama','rekbank','wkerja','jabatan','divisi.label as nmdivisi','jabatan.label as nmjabatan','tbl_datapegawai.id')
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
              $view =  \View::make($page, compact('query','saldo','start','end'));
          break;
          case 'baziz':
            $folder = 'tmp';
            $orientation = 'portrait';
            $query = pegawai::where('tbl_datapegawai.tmb','>=',$start)
              // ->where('tbl_datapegawai.tkb',0)
              ->where(function ($qy) use ($start) {
                $qy->where('tbl_datapegawai.tkb','<',$start)
                  ->whereNotIn('tbl_datapegawai.id',[47,1008]);
              })
              ->where('tb_kk2.agama','Islam')
              ->select('nip','nama','rekbank','wkerja','jabatan','divisi.label as nmdivisi','jabatan.label as nmjabatan','tbl_datapegawai.id')
              ->join('tb_kk2','tbl_datapegawai.id','=','tb_kk2.id_u')
              ->join('tb_variabel as divisi', function ($join) {
                  $join->on('tbl_datapegawai.divisi', '=', 'divisi.vid')
                  ->where('divisi.grup', '=', 'divisi')
                  ->whereNotIn('divisi.vid',[7,8]);

              })
              ->join('tb_variabel as jabatan', function ($join) {
                  $join->on('tbl_datapegawai.jabatan', '=', 'jabatan.vid')
                  ->where('jabatan.grup', '=', 'jabatan');
              })
              ->where('tb_kk2.hub','karyawan')
              ->orderBy('divisi.sort', 'asc')
              ->orderBy('jabatan', 'asc')
              ->get();
              $view =  \View::make($page, compact('query','saldo','start','end'));
          break;
          case 'bpjskk':
            $folder = 'tmp';
            $orientation = 'portrait';
            $query = pegawai::where('tbl_datapegawai.tkb',0)
              ->where('tbl_datapegawai.tmb','>=',$start)
              ->select('nip','nama','rekbank','wkerja','jabatan','divisi.label as nmdivisi','jabatan.label as nmjabatan','tbl_datapegawai.id')
              ->join('tb_kk2','tbl_datapegawai.id','=','tb_kk2.id_u')
              ->join('tb_variabel as divisi', function ($join) {
                  $join->on('tbl_datapegawai.divisi', '=', 'divisi.vid')
                  ->where('divisi.grup', '=', 'divisi')
                  ->whereNotIn('divisi.vid',[7,8]);
              })
              ->join('tb_variabel as jabatan', function ($join) {
                  $join->on('tbl_datapegawai.jabatan', '=', 'jabatan.vid')
                  ->where('jabatan.grup', '=', 'jabatan');
              })
              ->where('tb_kk2.hub','karyawan')
              ->orderBy('divisi.sort', 'asc')
              ->orderBy('jabatan', 'asc')
              ->get();
              $view =  \View::make($page, compact('query','saldo','start','end'));
          break;
          case 'bpjsks':
            $folder = 'tmp';
            $orientation = 'portrait';
            $query = pegawai::where('tbl_datapegawai.tkb',0)
              ->where('tbl_datapegawai.tmb','>=',$start)
              ->select('nip','nama','rekbank','wkerja','jabatan','divisi.label as nmdivisi','jabatan.label as nmjabatan','tbl_datapegawai.id')
              ->join('tb_kk2','tbl_datapegawai.id','=','tb_kk2.id_u')
              ->join('tb_variabel as divisi', function ($join) {
                  $join->on('tbl_datapegawai.divisi', '=', 'divisi.vid')
                  ->where('divisi.grup', '=', 'divisi')
                  ->whereNotIn('divisi.vid',[7,8]);
              })
              ->join('tb_variabel as jabatan', function ($join) {
                  $join->on('tbl_datapegawai.jabatan', '=', 'jabatan.vid')
                  ->where('jabatan.grup', '=', 'jabatan');
              })
              ->where('tb_kk2.hub','karyawan')
              ->orderBy('divisi.sort', 'asc')
              ->orderBy('jabatan', 'asc')
              ->get();
              $view =  \View::make($page, compact('query','saldo','start','end'));
          break;
          case 'dplk':
            $folder = 'tmp';
            $orientation = 'portrait';
            $query = pegawai::where('tbl_datapegawai.tmb','>=',$start)
              // ->where('tbl_datapegawai.tkb',0)
              ->where(function ($qy) use ($start) {
                $qy->where('tbl_datapegawai.tkb','<',$start)
                  ->whereNotIn('tbl_datapegawai.id',[1008])
                  ->where('tbl_datapegawai.status_pegawai','Tetap');
              })
              ->select('nip','nama','rekbank','wkerja','jabatan','divisi.label as nmdivisi','jabatan.label as nmjabatan','tbl_datapegawai.id')
              ->join('tb_kk2','tbl_datapegawai.id','=','tb_kk2.id_u')
              ->join('tb_variabel as divisi', function ($join) {
                  $join->on('tbl_datapegawai.divisi', '=', 'divisi.vid')
                  ->where('divisi.grup', '=', 'divisi')
                  ->whereNotIn('divisi.vid',[7,8]);

              })
              ->join('tb_variabel as jabatan', function ($join) {
                  $join->on('tbl_datapegawai.jabatan', '=', 'jabatan.vid')
                  ->where('jabatan.grup', '=', 'jabatan');
              })
              ->where('tb_kk2.hub','karyawan')
              ->orderBy('divisi.sort', 'asc')
              ->orderBy('jabatan', 'asc')
              ->get();
              $view =  \View::make($page, compact('query','saldo','start','end'));
          break;
          case 'koperasi':
            $folder = 'tmp';
            $orientation = 'portrait';
            $query = pegawai::where('tbl_datapegawai.tmb','>=',$start)
              // ->where('tbl_datapegawai.tkb',0)
              ->where(function ($qy) use ($start) {
                $qy->where('tbl_datapegawai.tkb','<',$start)
                  ->whereNotIn('tbl_datapegawai.id',[1008]);
              })
              ->select('nip','nama','rekbank','wkerja','jabatan','divisi.label as nmdivisi','jabatan.label as nmjabatan','tbl_datapegawai.id')
              ->join('tb_kk2','tbl_datapegawai.id','=','tb_kk2.id_u')
              ->join('tb_variabel as divisi', function ($join) {
                  $join->on('tbl_datapegawai.divisi', '=', 'divisi.vid')
                  ->where('divisi.grup', '=', 'divisi')
                  ->whereNotIn('divisi.vid', [7,8]);
              })
              ->join('tb_variabel as jabatan', function ($join) {
                  $join->on('tbl_datapegawai.jabatan', '=', 'jabatan.vid')
                  ->where('jabatan.grup', '=', 'jabatan');
              })
              ->where('tb_kk2.hub','karyawan')
              ->orderBy('divisi.sort', 'asc')
              ->orderBy('jabatan', 'asc')
              ->get();
              $view =  \View::make($page, compact('query','saldo','start','end'));
          break;
        }


        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)
          //->setOrientation($orientation)
          ->setPaper($papersize,$orientation);

        $pdf->save(public_path().'\\files\\'.$folder.'\\'.$nfile.'.pdf')->stream($nfile);

        $responce = array(
            'status' => 'success',
            'msg' => 'ok',
            'nfile' => $nfile,
        );
        return  Response()->json($responce);

        //return $pdf->stream($nfile);
      //  return \App::loadFile(public_path().'/myfile.html')->save('/path-to/my_stored_file.pdf')->stream('download.pdf');
//        if ($download==0)return $pdf->stream($nfile.'.pdf');else return $pdf->download($nfile.'.pdf');

        } else { echo "page tidak dapat di diperbaharui, silahkan kembali kehalaman sebelum";}
    }

}
