<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\menuadmins;

class HomeController extends Controller
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

     public function topmenu()
     {
         return view('backend.top-menu');
     }
     public function twomenu1()
     {
         $multilevel = menuadmins::get_data();
         $aktif_menu = menuadmins::aktif_menu(13);
         return view('backend.two-menu-1', compact('multilevel','aktif_menu'));
     }
     public function twomenu2()
     {
         return view('backend.two-menu-2');
     }
     public function mobilemenu1()
     {
         $multilevel = menuadmins::get_data();
         $aktif_menu = menuadmins::aktif_menu(15);
         return view('backend.mobile-menu-1', compact('multilevel','aktif_menu'));
     }
     public function mobilemenu2()
     {
         $multilevel = menuadmins::get_data();
         $aktif_menu = menuadmins::aktif_menu(16);
         return view('backend.mobile-menu-2', compact('multilevel','aktif_menu'));
     }

     public function mobilemenu3()
     {
         $multilevel = menuadmins::get_data();
         $aktif_menu = menuadmins::aktif_menu(17);
         return view('backend.mobile-menu-3', compact('multilevel','aktif_menu'));
     }

     public function typography()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','typography')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.typography', compact('multilevel','aktif_menu','index'));
     }
     public function elements()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','elements')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.elements', compact('multilevel','aktif_menu'));
     }

     public function buttons()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','buttons')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.buttons', compact('multilevel','aktif_menu'));
     }

     public function contentslider()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','content-slider')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.content-slider', compact('multilevel','aktif_menu'));
     }

     public function treeview()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','treeview')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.treeview', compact('multilevel','aktif_menu'));
     }

     public function jqueryui()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','jquery-ui')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.jquery-ui', compact('multilevel','aktif_menu'));
     }

     public function nestablelist()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','nestable-list')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.nestable-list', compact('multilevel','aktif_menu'));
     }

     public function tables()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','tables')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.tables', compact('multilevel','aktif_menu'));
     }
     public function jqgrid()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','jqgrid')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.jqgrid', compact('multilevel','aktif_menu'));
     }

     public function formelements()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','form-elements')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.form-elements', compact('multilevel','aktif_menu'));
     }
     public function formelements2()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','form-elements-2')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.form-elements-2', compact('multilevel','aktif_menu'));
     }
     public function formwizard()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','form-wizard')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);

         return view('backend.form-wizard', compact('multilevel','aktif_menu'));
     }
     public function wysiwyg()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','wysiwyg')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);

         return view('backend.wysiwyg', compact('multilevel','aktif_menu'));
     }
     public function dropzone()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','dropzone')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);

         return view('backend.dropzone', compact('multilevel','aktif_menu'));
     }

     public function widgets()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','widgets')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.widgets', compact('multilevel','aktif_menu'));
     }

     public function calendar()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','calendar')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.calendar', compact('multilevel','aktif_menu'));
     }

     public function gallery()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','gallery')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.gallery', compact('multilevel','aktif_menu'));
     }

     public function profile()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','profile')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.profile', compact('multilevel','aktif_menu'));
     }

     public function inbox()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','inbox')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.inbox', compact('multilevel','aktif_menu'));
     }
     public function pricing()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','pricing')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.pricing', compact('multilevel','aktif_menu'));
     }
     public function invoice()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','invoice')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.invoice', compact('multilevel','aktif_menu'));
     }
     public function timeline()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','timeline')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.timeline', compact('multilevel','aktif_menu'));
     }
     public function search()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','search')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.search', compact('multilevel','aktif_menu'));
     }
     public function email()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','email')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.email', compact('multilevel','aktif_menu'));
     }
     public function emailcontrast()
     {
         return view('backend.email-contrast');
     }
     public function emailnewsletter()
     {
         return view('backend.email-newsletter');
     }
     public function emailnavbar()
     {
         return view('backend.email-navbar');
     }
     public function emailconfirmation()
     {
         return view('backend.email-confirmation');
     }

 /*    public function login()
     {
         $multilevel = menuadmins::get_data();
         $aktif_menu = menuadmins::aktif_menu(42);
         return view('backend.login', compact('multilevel','aktif_menu'));
     }*/


     public function faq()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','faq')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.faq', compact('multilevel','aktif_menu'));
     }
     public function error404()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','error-404')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.error-404', compact('multilevel','aktif_menu'));
     }
     public function error500()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','error-500')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.error-500', compact('multilevel','aktif_menu'));
     }
     public function grid()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','grid')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.grid', compact('multilevel','aktif_menu'));
     }
     public function blank()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','blank')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.blank', compact('multilevel','aktif_menu'));
     }
     public function dompdf()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','dompdf')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.dompdf', compact('multilevel','aktif_menu'));
     }
     public function webcamera()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','webcamera')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.webcamera', compact('multilevel','aktif_menu'));
     }
     public function qr()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','qr')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.qr', compact('multilevel','aktif_menu'));
     }
     public function excel()
     {
         $multilevel = menuadmins::get_data();
         $index      = menuadmins::where('part','excel')->first();
         $aktif_menu = menuadmins::aktif_menu($index['id']);
         return view('backend.excel', compact('multilevel','aktif_menu'));
     }
}
