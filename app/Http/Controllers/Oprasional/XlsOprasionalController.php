<?php

namespace App\Http\Controllers\Oprasional;
date_default_timezone_set('Asia/Jakarta');

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

use App\Helpers\AppHelpers;
use App\Models\pegawai;
use DB;
use File;

class XlsOprasionalController extends Controller
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
      $mulai = $request->input('start', '0');
      $akhir = $request->input('end', '0');

      switch ($request->category) {
        case 'ppjk1':   // Variabel Master
          $writer = WriterFactory::create(Type::XLSX); // for XLSX files
          //$writer = WriterFactory::create(Type::CSV); // for CSV files
          //$writer = WriterFactory::create(Type::ODS); // for ODS files
          $old_path = public_path().'\\files\\blank.xlsx';
          $new_path = public_path().'\\files\\tmp\\data_ppjk.xlsx';
          File::copy($old_path, $new_path);

          $filePath = public_path().'\\files\\tmp\\data_ppjk.xlsx';
          $writer->openToFile($filePath); // write data to a file or to a PHP stream
          //$writer->openToBrowser($fileName); // stream data directly to the browser

          $query = DB::table('tb_ppjks')
            ->leftJoin('tb_agens', function ($join) {
              $join->on('tb_ppjks.agens_id', '=', 'tb_agens.id');
            })
            ->leftJoin('tb_kapals', function ($join) {
              $join->on('tb_ppjks.kapals_id', '=', 'tb_kapals.id');
            })
            ->leftJoin('tb_jettys', function ($join) {
              $join->on('tb_ppjks.jettys_idx', '=', 'tb_jettys.id');
            })
            ->where(function ($query) use ($mulai,$akhir){
                $mulai = strtotime($mulai);
                $akhir = strtotime($akhir);
                if($akhir==0)$akhir = $mulai+(60 * 60 * 24);
                $query->where('date_issue', '>=', $mulai)
                  ->Where('date_issue', '<', $akhir);
            })
            ->select(
              'tb_agens.code as agenCode',
              'tb_kapals.name as kapalsName',
              'tb_jettys.code as jettyCode',
              'tb_jettys.name as jettyName',
              'tb_ppjks.*'
            )
            ->orderBy('date_issue', 'asc')
            ->get();

          //$singleRow = array(0,0,0);
          $i=0;
          $multipleRows[$i] = array('No','date','ppjk','agen','kapal','jetty','eta','etd','asal','tujuan','etmal','cargo','muatan');

          foreach ($query as $row) {
            $i++;
            $multipleRows[$i] = array($i,date("d/m/Y",$row->date_issue),$row->ppjk,$row->agenCode,$row->kapalsName,$row->jettyName,date("d/m/Y H:i",$row->eta),date("d/m/Y H:i",$row->etd),$row->asal,$row->tujuan,$row->etmal,$row->cargo,$row->muat);
          }
        break;
        case 'dl-m':   // Variabel Master
          $writer = WriterFactory::create(Type::XLSX); // for XLSX files
          //$writer = WriterFactory::create(Type::CSV); // for CSV files
          //$writer = WriterFactory::create(Type::ODS); // for ODS files
          $old_path = public_path().'\\files\\blank.xlsx';
          $new_path = public_path().'\\files\\tmp\\data_DL-M.xlsx';
          File::copy($old_path, $new_path);

          $filePath = public_path().'\\files\\tmp\\data_DL-M.xlsx';
          $writer->openToFile($filePath); // write data to a file or to a PHP stream
          //$writer->openToBrowser($fileName); // stream data directly to the browser

          $result = DB::table('tb_dls')
            ->leftJoin('tb_ppjks', function ($join) {
              $join->on('tb_ppjks.id','tb_dls.ppjks_id');
            })
            ->leftJoin('tb_agens', function ($join) {
              $join->on('tb_agens.id','tb_ppjks.agens_id');
            })
            ->leftJoin('tb_kapals', function ($join) {
              $join->on('tb_kapals.id','tb_ppjks.kapals_id');
            })
            ->leftJoin('tb_jettys', function ($join) {
              $join->on('tb_jettys.id','tb_dls.jettys_id');
            })
            ->where(function ($query) use ($mulai,$akhir,$request){
                $akhir = strtotime($mulai)+(60 * 60 * 24)-1;
                $mulai = strtotime('1-'.date('m-Y',$akhir));
                $query->where('tb_dls.date', '>=', $mulai)
                  ->Where('tb_dls.date', '<', $akhir);
            })
            ->select(
              'tb_agens.code as agenCode',
              'tb_kapals.name as kapalsName',
              'tb_kapals.jenis as kapalsJenis',
              'tb_kapals.grt as kapalsGrt',
              'tb_kapals.loa as kapalsLoa',
              'tb_kapals.bendera as kapalsBendera',
              'tb_jettys.name as jettyName',
              'tb_jettys.code as jettyCode',
              // 'tb_jettys.color as jettyColor',
              'tb_ppjks.*',
              'tb_dls.*'
            )
            ->orderBy('date', 'asc')
            ->get();
            // dd(date('d-m-Y',strtotime($mulai)+(60 * 60 * 24)-1));
          $i=0;
          $multipleRows[$i] = array('No','ppjk','agen','date_req','kapal','grt','loa','bendera','jetty','ops','pc','tunda','mulai','akhir','dd','ket','rute','moring');
          foreach ($result as $row) {
            $i++;
            if ($row->kapalsJenis == '') $kapal =  $row->kapalsName; else $kapal = '('.$row->kapalsJenis.') '.$row->kapalsName;
            if ($row->tundaon == '') $tundaon=$row->tundaon; else $tundaon=date("H:i",$row->tundaon);
            if ($row->tundaoff == '') $tundaoff=$row->tundaon; else $tundaoff=date("H:i",$row->tundaoff);
            if ($row->pcon == '') $pcon=$row->pcon; else $pcon=date("H:i",$row->pcon);
            if ($row->pcoff == '') $pcoff=$row->pcon; else $pcoff=date("H:i",$row->pcoff);

            if ($row->ppjk == '' || $row->ppjk == null) $row->ppjk = ''; else $row->ppjk = substr($row->ppjk, -5);

            $multipleRows[$i] = array(
              $row->id,
              $row->ppjk,
              $row->agenCode,
              date("d/m/y H:i",$row->date),
              $kapal,
              AppHelpers::formatNomer($row->kapalsGrt),
              AppHelpers::formatNomer($row->kapalsLoa),
              $row->kapalsBendera,
              '('. $row->jettyCode .') '.$row->jettyName,
              $row->ops,
              $row->pc,
              $row->tunda,
              $tundaon,
              $tundaoff,
              $row->dd,
              $row->ket,
              $row->rute,
              $row->mooring
            );
          }
        break;
        case 'lhp-m':   // Variabel Master
          $writer = WriterFactory::create(Type::XLSX); // for XLSX files
          //$writer = WriterFactory::create(Type::CSV); // for CSV files
          //$writer = WriterFactory::create(Type::ODS); // for ODS files
          $old_path = public_path().'\\files\\blank.xlsx';
          $new_path = public_path().'\\files\\tmp\\data_LHP-M.xlsx';
          File::copy($old_path, $new_path);

          $filePath = public_path().'\\files\\tmp\\data_LHP-M.xlsx';
          $writer->openToFile($filePath); // write data to a file or to a PHP stream
          //$writer->openToBrowser($fileName); // stream data directly to the browser

          $result = DB::table('tb_dls')
            ->leftJoin('tb_ppjks', function ($join) {
              $join->on('tb_ppjks.id','tb_dls.ppjks_id');
            })
            ->leftJoin('tb_agens', function ($join) {
              $join->on('tb_agens.id','tb_ppjks.agens_id');
            })
            ->leftJoin('tb_kapals', function ($join) {
              $join->on('tb_kapals.id','tb_ppjks.kapals_id');
            })
            ->leftJoin('tb_jettys', function ($join) {
              $join->on('tb_jettys.id','tb_dls.jettys_id');
            })
            ->where(function ($query) use ($mulai,$akhir,$request){
              $mulai = strtotime($mulai);
              $akhir = strtotime('1-'.date('m-Y',$mulai));
              $query->where('tb_ppjks.lhp', '>=', $akhir)
                ->Where('tb_ppjks.lhp', '<=', $mulai);
              // $query->where('tb_ppjks.lhp', $akhir);

            })
            ->select(
              'tb_agens.code as agenCode',
              'tb_kapals.name as kapalsName',
              'tb_kapals.jenis as kapalsJenis',
              'tb_kapals.grt as kapalsGrt',
              'tb_kapals.loa as kapalsLoa',
              'tb_kapals.bendera as kapalsBendera',
              'tb_jettys.name as jettyName',
              'tb_jettys.code as jettyCode',
              // 'tb_jettys.color as jettyColor',
              'tb_ppjks.*',
              'tb_dls.*'
            )
            ->orderBy('ppjk')
            ->orderBy('date', 'asc')
            ->orderBy('tb_dls.id', 'asc')

            ->get();

          //$singleRow = array(0,0,0);
          $i=0;
          $multipleRows[$i] = array('No','ppjk','agen','date_req','kapal','grt','loa','bendera','jetty','ops','bapp','pc','pilot_on','pilot_off','GB','GC','GS','MV','MG','mulai','akhir','dd','ket','lstp','bstdo','moring');
          foreach ($result as $row) {
            $i++;
            if ($row->kapalsJenis == '') $kapal =  $row->kapalsName; else $kapal = '('.$row->kapalsJenis.') '.$row->kapalsName;
            if ($row->pcon == '') $pcon=$row->pcon; else $pcon=date("H:i",$row->pcon);
            if ($row->pcoff == '') $pcoff=$row->pcoff; else $pcoff=date("H:i",$row->pcoff);

            $tunda = json_decode($row->tunda);
            if (in_array('GB', $tunda))$gb = 'GB';else $gb = '';
            if (in_array('GC', $tunda))$gc = 'GC';else $gc = '';
            if (in_array('GS', $tunda))$gs = 'GS';else $gs = '';
            if (in_array('MV', $tunda))$mv = 'MV';else $mv = '';
            if (in_array('MG', $tunda))$mg = 'MG';else $mg = '';

            if ($row->tundaon == '') $tundaon=$row->tundaon; else $tundaon=date("H:i",$row->tundaon);
            if ($row->tundaoff == '') $tundaoff=$row->tundaon; else $tundaoff=date("H:i",$row->tundaoff);

            $multipleRows[$i] = array(
              $i,
              $row->ppjk,
              $row->agenCode,
              date("d-m-Y H:i",$row->date),
              $kapal,
              $row->kapalsGrt,
              $row->kapalsLoa,
              $row->kapalsBendera,
              '('. $row->jettyCode .')'.$row->jettyName,
              $row->ops,
              $row->bapp,
              $row->pc,
              $pcon,
              $pcoff,
              $gb,
              $gc,
              $gs,
              $mv,
              $mg,
              $tundaon,
              $tundaoff,
              $row->dd,
              $row->ket,
              $row->lstp,
              $row->bstdo,
              $row->mooring
            );
          }
        break;
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
