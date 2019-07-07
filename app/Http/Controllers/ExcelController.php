<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Models\menuadmin;
use App\Models\test;

use Box\Spout\Writer\WriterFactory;
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

use File;

class ExcelController extends Controller
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

    public function excelexport(Request $request){
      $writer = WriterFactory::create(Type::XLSX); // for XLSX files
      //$writer = WriterFactory::create(Type::CSV); // for CSV files
      //$writer = WriterFactory::create(Type::ODS); // for ODS files
      $old_path = public_path().'\\files\\blank.xlsx';
      $new_path = public_path().'\\files\\tmp\\test.xlsx';
      File::copy($old_path, $new_path);

      $filePath = public_path().'\\files\\tmp\\test.xlsx';
      $writer->openToFile($filePath); // write data to a file or to a PHP stream
      //$writer->openToBrowser($fileName); // stream data directly to the browser

      //$singleRow = array(0,0,0);

      $multipleRows[0] = array('No','Nama');
      $multipleRows[1] = array('1','Deni');
      $multipleRows[2] = array('2','Sofia');
      $multipleRows[3] = array('3','Rano');
      $multipleRows[4] = array('4','Julia');

      //$writer->addRow($singleRow); // add a row at a time
      $writer->addRows($multipleRows); // add multiple rows at a time

      $writer->close();

      $response = array(
          'status' => 'success',
          'msg' => 'ok',
      );
      return Response()->json($response);
    }

    public function ExcelImport(Request $request){

      if(isset($_FILES)){
        $path= public_path().'\\files\\upload';

        //membuat folder jika folder tidak ada
        if (!is_dir($path)) File::makeDirectory($path);

        $fs = $request->file('inputfilenya');

        $name = explode('.', $fs->getClientOriginalName());
        if ($name[1]=='xlsx' || $name[1]=='xls'){
          $fileName = $name[0].'-'.date('Ymd').'.'.$name[1];
        }

        // $fileName   = $_FILES['file']['name'];
        // $file       = $path.$fileName;

        // // simpan file ukuran sebenernya
        // $realImagesName     = $_FILES["file"]["tmp_name"];
        // move_uploaded_file($realImagesName, $file);

        $request->file('inputfilenya')->move("public/files/upload", $fileName);
      }

      $reader = ReaderFactory::create(Type::XLSX); // for XLSX files
      //$reader = ReaderFactory::create(Type::CSV); // for CSV files
      //$reader = ReaderFactory::create(Type::ODS); // for ODS files

      $filePath = $path."\\".$fileName;
      $reader->open($filePath);
      $isi=array();
      foreach ($reader->getSheetIterator() as $sheet) {
        foreach ($sheet->getRowIterator() as $row) {
          array_push($isi,$row[1]);
        }
      }

      $reader->close();

      $response = array(
          'status' => 'success',
          'msg' => $isi,
      );
      return Response()->json($response);
    }
}
