<?php

namespace App\Http\Controllers\POS;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\tb_pos_produks;

class ApiPosController extends Controller
{
  public function listmenu()
  {
    $heders = array();
    //$heders = array_unique();
    $result['produk'] =  tb_pos_produks::all();
    foreach ($result['produk'] as $row) {
      if (!in_array($row->jenis, $heders)) array_push($heders, $row->jenis);
    }
    $result['jenis'] = $heders;
    return response($result);
  }
}
