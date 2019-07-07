<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuadminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menuadmins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->string('label',50)->default('-');
            $table->string('part',100)->default('#');
            $table->string('icon',25);
            $table->string('akses',50);
        });

        $menu = [
          ['id'=>1, 'akses'=>'1+0','parent_id' => 0, 'label' => 'UI & Elements',        'part'=>'',                  'icon'=>'fa-desktop'],
          ['id'=>2, 'akses'=>'1+0','parent_id' => 1, 'label' => 'Layouts',              'part'=>'',                  'icon'=>''],
          ['id'=>3, 'akses'=>'1+0','parent_id' => 1, 'label' => 'Typography',           'part'=>'typography',        'icon'=>''],
          ['id'=>4, 'akses'=>'1+0','parent_id' => 1, 'label' => 'Elements',             'part'=>'elements',          'icon'=>''],
          ['id'=>5, 'akses'=>'1+0','parent_id' => 1, 'label' => 'Buttons & Icons',      'part'=>'buttons',           'icon'=>''],
          ['id'=>6, 'akses'=>'1+0','parent_id' => 1, 'label' => 'Content Sliders',      'part'=>'content-slider',    'icon'=>''],
          ['id'=>7, 'akses'=>'1+0','parent_id' => 1, 'label' => 'Treeview',             'part'=>'treeview',          'icon'=>''],
          ['id'=>8, 'akses'=>'1+0','parent_id' => 1, 'label' => 'jQuery UI',            'part'=>'jquery-ui',         'icon'=>''],
          ['id'=>9, 'akses'=>'1+0','parent_id' => 1, 'label' => 'Nestable Lists',       'part'=>'nestable-list',     'icon'=>''],
          ['id'=>10,'akses'=>'1+0','parent_id' => 1, 'label' => 'Three Level Menu',     'part'=>'jshift',            'icon'=>''],
          ['id'=>11,'akses'=>'1+0','parent_id' => 2, 'label' => 'Top Menu',             'part'=>'top-menu',          'icon'=>''],
          ['id'=>12,'akses'=>'1+0','parent_id' => 2, 'label' => 'Two Menu1',            'part'=>'two-menu-1',        'icon'=>''],
          ['id'=>13,'akses'=>'1+0','parent_id' => 2, 'label' => 'Two Menu2',            'part'=>'two-menu-2',        'icon'=>''],
          ['id'=>14,'akses'=>'1+0','parent_id' => 2, 'label' => 'Default Mobile Menu',  'part'=>'mobile-menu-1',     'icon'=>''],
          ['id'=>15,'akses'=>'1+0','parent_id' => 2, 'label' => 'Mobile Menu 2',        'part'=>'mobile-menu-2',     'icon'=>''],
          ['id'=>16,'akses'=>'1+0','parent_id' => 2, 'label' => 'Mobile Menu 3',        'part'=>'mobile-menu-3',     'icon'=>''],
          ['id'=>17,'akses'=>'1+0','parent_id' => 10,'label' => 'item #1',              'part'=>'',                  'icon'=>'fa-leaf green'],
          ['id'=>18,'akses'=>'1+0','parent_id' => 10,'label' => '4th level',            'part'=>'',                  'icon'=>'fa-pencil orange'],
          ['id'=>19,'akses'=>'1+0','parent_id' => 18,'label' => 'Add Product',          'part'=>'',                  'icon'=>''],
          ['id'=>20,'akses'=>'1+0','parent_id' => 18,'label' => 'View Products',        'part'=>'',                  'icon'=>''],
          ['id'=>21,'akses'=>'1+0','parent_id' => 0, 'label' => 'Tables',               'part'=>'',                  'icon'=>'fa-list'],
          ['id'=>22,'akses'=>'1+0','parent_id' => 21,'label' => 'Simple & Dynamic',     'part'=>'tables',            'icon'=>''],
          ['id'=>23,'akses'=>'1+0','parent_id' => 21,'label' => 'jqGrid plugin',        'part'=>'jqgrid',            'icon'=>''],
          ['id'=>24,'akses'=>'1+0','parent_id' => 0, 'label' => 'Forms',                'part'=>'',                  'icon'=>'fa-pencil-square-o'],
          ['id'=>25,'akses'=>'1+0','parent_id' => 24,'label' => 'Form Elements',        'part'=>'form-elements',     'icon'=>''],
          ['id'=>26,'akses'=>'1+0','parent_id' => 24,'label' => 'Form Elements 2',      'part'=>'form-elements-2',   'icon'=>''],
          ['id'=>27,'akses'=>'1+0','parent_id' => 24,'label' => 'Form Wizard',          'part'=>'form-wizard',       'icon'=>''],
          ['id'=>28,'akses'=>'1+0','parent_id' => 24,'label' => 'Wysiwyg & Markdown',   'part'=>'wysiwyg',           'icon'=>''],
          ['id'=>29,'akses'=>'1+0','parent_id' => 24,'label' => 'Dropzone File Upload', 'part'=>'dropzone',          'icon'=>''],
          ['id'=>30,'akses'=>'1+0','parent_id' => 0, 'label' => 'Widgets',              'part'=>'widgets',           'icon'=>'fa-list-alt'],
          ['id'=>31,'akses'=>'1+0','parent_id' => 0, 'label' => 'Calendar',             'part'=>'calendar',          'icon'=>'fa-calendar'],
          ['id'=>32,'akses'=>'1+0','parent_id' => 0, 'label' => 'Gallery',              'part'=>'gallery',           'icon'=>'fa-picture-o'],
          ['id'=>33,'akses'=>'1+0','parent_id' => 0, 'label' => 'More Pages',           'part'=>'',                  'icon'=>'fa-tag'],
          ['id'=>34,'akses'=>'1+0','parent_id' => 33,'label' => 'User Profile',         'part'=>'profile',           'icon'=>''],
          ['id'=>35,'akses'=>'1+0','parent_id' => 33,'label' => 'Inbox',                'part'=>'inbox',             'icon'=>''],
          ['id'=>36,'akses'=>'1+0','parent_id' => 33,'label' => 'Pricing Tables',       'part'=>'pricing',           'icon'=>''],
          ['id'=>37,'akses'=>'1+0','parent_id' => 33,'label' => 'Pricing Tables',       'part'=>'invoice',           'icon'=>''],
          ['id'=>38,'akses'=>'1+0','parent_id' => 33,'label' => 'Timeline',             'part'=>'timeline',          'icon'=>''],
          ['id'=>39,'akses'=>'1+0','parent_id' => 33,'label' => 'Search Results',       'part'=>'search',            'icon'=>''],
          ['id'=>40,'akses'=>'1+0','parent_id' => 33,'label' => 'Email Templates',      'part'=>'email',             'icon'=>''],
          ['id'=>41,'akses'=>'1+0','parent_id' => 33,'label' => 'Login & Register',     'part'=>'login',             'icon'=>''],
          ['id'=>42,'akses'=>'1+0','parent_id' => 0, 'label' => 'Other Pages',          'part'=>'',                  'icon'=>'fa-file-o'],
          ['id'=>43,'akses'=>'1+0','parent_id' => 42,'label' => 'FAQ',                  'part'=>'faq',               'icon'=>''],
          ['id'=>44,'akses'=>'1+0','parent_id' => 42,'label' => 'Error 404',            'part'=>'error-404',         'icon'=>''],
          ['id'=>45,'akses'=>'1+0','parent_id' => 42,'label' => 'Error 500',            'part'=>'error-500',         'icon'=>''],
          ['id'=>46,'akses'=>'1+0','parent_id' => 42,'label' => 'Grid',                 'part'=>'grid',              'icon'=>''],
          ['id'=>47,'akses'=>'1+0','parent_id' => 42,'label' => 'Blank Page',           'part'=>'blank',             'icon'=>''],
          ['id'=>48,'akses'=>'1+0','parent_id' => 0, 'label' => 'Tambahan',             'part'=>'',                  'icon'=>''],
          ['id'=>49,'akses'=>'1+0','parent_id' => 48,'label' => 'DomPdf',               'part'=>'dompdf',            'icon'=>''],
          ['id'=>50,'akses'=>'1+0','parent_id' => 48,'label' => 'Web Camera',           'part'=>'webcamera',         'icon'=>''],
          ['id'=>51,'akses'=>'1+0','parent_id' => 48,'label' => 'Qr',                   'part'=>'qr',                'icon'=>''],
          ['id'=>52,'akses'=>'1+0','parent_id' => 48,'label' => 'Excel',                'part'=>'excel',             'icon'=>''],
          ['id'=>53,'akses'=>'1+0','parent_id' => 48,'label' => 'Multi Auth',           'part'=>'multiauth',         'icon'=>''],
          ['id'=>54,'akses'=>'1+0','parent_id' => 48,'label' => 'P O S',                'part'=>'pos',               'icon'=>''],
          ['id'=>55,'akses'=>'1+0','parent_id' => 48,'label' => 'BANK',                 'part'=>'pos',               'icon'=>''],
        ];

        DB::table('menuadmins')->insert($menu);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menuadmins');
    }
}
