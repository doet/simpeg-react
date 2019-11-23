<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('/',       'CekController@index');
Route::get('/home',   'CekController@index')->name('home');

/////////////////////////////////////////////////////////////////////////////////////// Master Data //////

Route::get('masterdata',      'Masterdata\MasterDataController@masterdata');                                       //
Route::get('mjabatan',        'Masterdata\MasterDataController@mjabatan');                                         //
Route::get('mdivisi',         'Masterdata\MasterDataController@mdivisi');                                          //
Route::get('mlibur',          'Masterdata\MasterDataController@mlibur');
Route::get('mdiagnosa',       'Masterdata\MasterDataController@mdiagnosa');
Route::get('mmuser',          'Masterdata\MasterDataController@mmuser');
Route::get('mamenu',          'Masterdata\MasterDataController@mamenu');

/////////////////////////////////////////////////////////////////////////////////////// Kepegawaian //////
Route::get('pkaryawa',          'Kepegawaian\KepegawaianController@pkaryawa');				//
Route::get('editkaryawan/{e}',  'Kepegawaian\KepegawaianController@editkaryawan');			//
Route::get('dapeg/{e}',         'Kepegawaian\KepegawaianController@dapeg');					//
Route::get('dakel/{e}',         'Kepegawaian\KepegawaianController@dakel');					//
Route::get('dcuti',							'Kepegawaian\KepegawaianController@dcuti');					//
Route::get('wspd',							'Kepegawaian\KepegawaianController@wspd');
Route::get('mrawatjalan',				'Kepegawaian\KepegawaianController@mrawatjalan');
Route::get('jshiftopr',					'Kepegawaian\KepegawaianController@jshiftopr');
Route::get('jshift',						'Kepegawaian\KepegawaianController@jshift');
Route::get('absen',							'Kepegawaian\KepegawaianController@absen');
Route::match(['get', 'post'],	'PDF_Kepegawaian',		'Kepegawaian\PdfKepegawaianController@PDFMarker');
Route::match(['get', 'post'],	'XLS_Kepegawaian',		'Kepegawaian\XlsKepegawaianController@XLSMarker');

/////////////////////////////////////////////////////////////////////////////////////// Payroll //////////
Route::get('koperasi',						'Payroll\PayrollController@koperasi');
Route::get('pkoperasi',						'Payroll\PayrollController@pkoperasi');
Route::get('upah',								'Payroll\PayrollController@upah');
Route::get('potongan',						'Payroll\PayrollController@potongan');

Route::get('uploaddata',					'Payroll\PayrollController@uploaddata');			//
Route::get('pengaturanpayroll',		'Payroll\PayrollController@pengaturanpayroll');			//
Route::match(['get', 'post'],	'PDF_payroll',		'Payroll\PdfPayrollController@PDFMarker');


Route::prefix('papan')->group(function(){
  Route::get('/',                 'Papan\PapanController@index');
});

Route::prefix('oprasional')->group(function(){
  Route::get('/',             'Oprasional\OprasionalController@upload');
  Route::get('/ppjk',         'Oprasional\OprasionalController@ppjk');
  Route::get('/dl',           'Oprasional\OprasionalController@dl');
  Route::get('/lhp',          'Oprasional\OprasionalController@lhp');
  Route::get('/bstdo',        'Oprasional\OprasionalController@bstdo');
  Route::get('/lstp',         'Oprasional\OprasionalController@lstp');
  Route::get('/report',       'Oprasional\OprasionalController@report');
  Route::get('/upload',       'Oprasional\OprasionalController@upload');
  Route::get('/chart',        'Oprasional\OprasionalController@chart');
  Route::get('/manifest',     'Oprasional\OprasionalController@manifest');

  Route::get('/masteroper',   'Oprasional\OprasionalController@masteroper');
  Route::get('/mkapal',       'Oprasional\OprasionalController@mkapal');
  Route::get('/magen',        'Oprasional\OprasionalController@magen');
  Route::get('/mpc',          'Oprasional\OprasionalController@mpc');
  Route::get('/mdermaga',     'Oprasional\OprasionalController@mdermaga');
  Route::get('/mmooring',     'Oprasional\OprasionalController@mmooring');

  Route::get('/nilai',        'Oprasional\OprasionalController@nilai');
  Route::get('/mdnilai',      'Oprasional\OprasionalController@mdnilai');
  Route::get('/minilai',      'Oprasional\OprasionalController@minilai');
  Route::get('/msum',         'Oprasional\OprasionalController@msum');


  Route::match(['get', 'post'],   'FileUpload',					'Oprasional\FilesCrudController@save');
  Route::match(['get', 'post'],   'FilesJson',					'Oprasional\FilesCrudController@json');
  Route::match(['get', 'post'],   'FilesSave',		  		'Oprasional\FilesCrudController@save');
  Route::match(['get', 'post'],   'PDFAdmin', 		    	'Oprasional\PdfController@PDFMarker');
  Route::match(['get', 'post'],	  'XLS_Oprasional',     'Oprasional\XlsOprasionalController@XLSMarker');
  Route::match(['get', 'post'],   'Chart',	     	  		'Oprasional\FilesCrudController@chart');

  Route::get('/listinvoice',  'Oprasional\Invoice\InvoiceController@listinvoice');

  Route::match(['get', 'post'],   'PDFInvoice', 		    	'Oprasional\Invoice\PdfController@PDFMarker');
  Route::match(['get', 'post'],   'PDFReport', 		      	'Oprasional\Report\PdfController@PDFMarker');
});

Route::prefix('surat')->group(function(){
  Route::get('/',             'Surat\SuratController@surat');
  Route::get('/smasuk',       'Surat\SuratController@smasuk');

});

Route::prefix('inventaris')->group(function(){
  Route::get('/',             'Inventaris\InventarisController@index');
});

Route::get('/notification',   'NotificationController@index');
Route::post('/notification',  'NotificationController@index');

Route::get('/message','MessageController@index');
Route::post('/message','MessageController@index');
//
Route::get('/notif','NotifController@index');
Route::post('/notif','NotifController@store');

Route::get('/notif2','Notif2Controller@index');
Route::post('/notif2','Notif2Controller@store');

Route::get('/triact','TabelreactController@index');
Route::post('/triact','TabelreactController@store');
