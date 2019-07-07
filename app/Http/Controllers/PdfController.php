<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\menuadmin;

class PdfController extends Controller
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
                $page = 'pdf.pdfadmin.'.$request->input('page');
                $nfile = $request->input('file');
                $orientation = 'portrait';

                $view =  \View::make($page)->render();

            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)
                //->setOrientation($orientation)
                ->setPaper('a4',$orientation);

            return $pdf->stream($nfile);

        } else { echo "page tidak dapat di diperbaharui, silahkan kembali kehalaman sebelum";}
    }

}
