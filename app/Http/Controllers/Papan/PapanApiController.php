<?php

namespace App\Http\Controllers\Papan;
date_default_timezone_set('Asia/Jakarta');
// use File;
use Storage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\Models\tb_agens;
use App\Models\tb_vessels;
use App\Models\tb_jettys;

class PapanApiController extends Controller
{
  public function index(Request $request)
  {
    $file_n = storage_path()."\app\papan.json";
    $result = json_decode(file_get_contents($file_n), true);

    if ($request->input('cel')!=''){
      $row = $request->input('row');
      $col = $request->input('col');
      $data = $request->input('cel');

      if ($data == '-'){
        unset($result['data'][$row][$col]);
        if (!$result['data'][$row]){
          unset($result['data'][$row]);
          $delete = $row;
        }
      } else {
        if (!isset($result['data'][$row]))$add = $row;
        $result['data'][$row][$col] = $data;
      }
      Storage::put('papan.json', json_encode($result));
      if (isset($delete))$result['delete'] = $row;
      if (isset($add))$result['add'] = $add;
    }

    return response()->json($result);
    // return $result;
  }

  public function autocomplete(Request $request)
  {
    $hasils=array();
    $data=array();
    $query = $request->get('term','');
    $f = $request->get('f','');
    switch ($f) {
      case 'fagen':   // Variabel Master
        $hasils=tb_agens::where('value','LIKE','%'.$query.'%')->get();
      break;
      case 'fvessel':   // Variabel Master
        $hasils=tb_vessels::where('value','LIKE','%'.$query.'%')->get();
      break;
      case 'fjetty':   // Variabel Master
        $hasils=tb_jettys::where('value','LIKE','%'.$query.'%')->get();
      break;

    }
    foreach ($hasils as $hasil) {
      $data[]=array(
        'id'=>$hasil->id,
        'value'=>$hasil->value,
        'desc'=>$hasil->desc,
      );
    }
    if(count($data)) return $data;
    else return [
      'id'=>'-',
      'value'=>'No Result Found',
      'desc'=>'-'];
  }
}

// {"data":[["<div class=\"items-elm bg-danger text-white\" style=\"min-height: 30px; line-height: 30px;\">Time Req<\/div>"]]}
