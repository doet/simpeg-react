<?php

namespace App\Http\Controllers\Kepegawaian;
date_default_timezone_set('Asia/Jakarta');

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

use App\Models\pegawai;

use File;

class XlsKepegawaianController extends Controller
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

    public function XLSMarker(Request $request){
      $writer = WriterFactory::create(Type::XLSX); // for XLSX files
      //$writer = WriterFactory::create(Type::CSV); // for CSV files
      //$writer = WriterFactory::create(Type::ODS); // for ODS files
      $old_path = public_path().'\\files\\blank.xlsx';
      $new_path = public_path().'\\files\\tmp\\data_pegawai.xlsx';
      File::copy($old_path, $new_path);

      $filePath = public_path().'\\files\\tmp\\data_pegawai.xlsx';
      $writer->openToFile($filePath); // write data to a file or to a PHP stream
      //$writer->openToBrowser($fileName); // stream data directly to the browser

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

      //$singleRow = array(0,0,0);
      $i=0;
      $multipleRows[$i] = array('No','NIK','Nama','Divisi','Jabatan','ID Sistem');

      foreach ($query as $row) {
        $i++;
        $multipleRows[$i] = array($i,$row->nip,$row->nama,$row->nmdivisi,$row->nmjabatan,$row->id);
      }


      //$writer->addRow($singleRow); // add a row at a time
      $writer->addRows($multipleRows); // add multiple rows at a time

      $writer->close();

      $response = array(
          'status' => 'success',
          'msg' => 'ok',
      );
      return Response()->json($response);
    }

}
