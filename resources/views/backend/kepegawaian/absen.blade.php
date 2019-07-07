@extends('backend.app_backend')

@section('css')
    <!-- page specific plugin styles -->
    <link href="{{ asset('/css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/ui.jqgrid.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/css/bootstrap-editable.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/chosen.min.css') }}" rel="stylesheet">
@endsection

@section('breadcrumb')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{url('')}}">Home</a>
            </li>

            @foreach(array_reverse($aktif_menu) as $row)
            <li>
                {!!$row['nama']!!}
            </li>
            @endforeach
        </ul><!-- /.breadcrumb -->
        <div class="nav-search" id="nav-search">
            <form class="form-search">
                <span class="input-icon">
                    <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                    <i class="ace-icon fa fa-search nav-search-icon"></i>
                </span>
            </form>
        </div><!-- /.nav-search -->
    </div>
@endsection

@section('content')

<div class="page-header">
        <h1>
            Menu SDM
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Log Absensi
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <form id="print-1" role="form" method="POST" action="{{ url('PDF_Kepegawaian') }}" target="_blank">
                {!! csrf_field() !!}
                <input name="category" value="logabsen" type="hidden"/>
                <input name="start" value="" type="hidden"/>
                <input name="end" value="" type="hidden"/>
                <input name="divisi" value="5" type="hidden"/>
                <input name="page" value="absen" type="hidden"/>
                <input name="file" value="LogAbsen" type="hidden"/>
            </form>

            <form id="print-2" role="form" method="POST" action="{{ url('PDF_Kepegawaian') }}" target="_blank">
                {!! csrf_field() !!}
                <input name="category" value="logabsen" type="hidden"/>
                <input name="start" value="" type="hidden"/>
                <input name="end" value="" type="hidden"/>
                <input name="divisi" value="3" type="hidden"/>
                <input name="page" value="absen" type="hidden"/>
                <input name="file" value="LogAbsen" type="hidden"/>
            </form>
            <form id="print-3" role="form" method="POST" action="{{ url('PDF_Kepegawaian') }}" target="_blank">
                {!! csrf_field() !!}
                <input name="category" value="logabsen" type="hidden"/>
                <input name="start" value="" type="hidden"/>
                <input name="end" value="" type="hidden"/>
                <input name="divisi" value="4" type="hidden"/>
                <input name="page" value="absen" type="hidden"/>
                <input name="file" value="LogAbsen" type="hidden"/>
            </form>
            <form id="print-4" role="form" method="POST" action="{{ url('PDF_Kepegawaian') }}" target="_blank">
                {!! csrf_field() !!}
                <input name="category" value="logabsen" type="hidden"/>
                <input name="start" value="" type="hidden"/>
                <input name="end" value="" type="hidden"/>
                <input name="divisi" value="5" type="hidden"/>
                <input name="page" value="absen" type="hidden"/>
                <input name="file" value="LogAbsen" type="hidden"/>
            </form>
            <form id="print-5" role="form" method="POST" action="{{ url('PDF_Kepegawaian') }}" target="_blank">
                {!! csrf_field() !!}
                <input name="category" value="logabsen" type="hidden"/>
                <input name="start" value="" type="hidden"/>
                <input name="end" value="" type="hidden"/>
                <input name="divisi" value="6" type="hidden"/>
                <input name="page" value="absen" type="hidden"/>
                <input name="file" value="LogAbsen" type="hidden"/>
            </form>
            <form id="print-6" role="form" method="POST" action="{{ url('PDF_Kepegawaian') }}" target="_blank">
                {!! csrf_field() !!}
                <input name="category" value="logabsen" type="hidden"/>
                <input name="start" value="" type="hidden"/>
                <input name="end" value="" type="hidden"/>
                <input name="divisi" value="7" type="hidden"/>
                <input name="page" value="absen" type="hidden"/>
                <input name="file" value="LogAbsen" type="hidden"/>
            </form>
            <form id="log" role="form" method="POST" action="{{ url('PDF_Kepegawaian') }}" target="_blank">
                {!! csrf_field() !!}
                <input name="category" value="logabsen" type="hidden"/>
                <input name="start" value="" type="hidden"/>
                <input name="end" value="" type="hidden"/>
                <input name="karyawan" value="" type="hidden"/>
                <input name="page" value="absen" type="hidden"/>
                <input name="file" value="LogAbsen" type="hidden"/>
            </form>

            <form id="ciss" role="form" method="POST" action="{{ url('PDF_Kepegawaian') }}" target="_blank">
                {!! csrf_field() !!}
                <input name="category" value="absenr1" type="hidden"/>
                <input name="start" value="" type="hidden"/>
                <input name="end" value="" type="hidden"/>
                <input name="page" value="absenrekap1" type="hidden"/>
                <input name="file" value="RekapAbsen1" type="hidden"/>
            </form>

            <form id="rabsen" role="form" method="POST" action="{{ url('PDF_Kepegawaian') }}" target="_blank">
                {!! csrf_field() !!}
                <input name="category" value="absenr2" type="hidden"/>
                <input name="start" value="" type="hidden"/>
                <input name="end" value="" type="hidden"/>
                <input name="page" value="absenrekap2" type="hidden"/>
                <input name="file" value="RekapAbsen2" type="hidden"/>
            </form>

            <div class="btn-group">
                <button id="ambil" data-toggle="dropdown" class="btn btn-sm btn-danger dropdown-toggle" >
                    Perbaharui
                </button>
            </div>

            <div class="btn-group">
                <button id="print-log" data-toggle="dropdown" class="btn btn-sm btn-danger dropdown-toggle" >
                    Print Log
                </button>
            </div>

        <!--    <div class="btn-group">
                <button data-toggle="dropdown" class="btn btn-sm btn-danger dropdown-toggle">
                    Unduh / Cetak | Log Absen
                    <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                </button>

                <ul class="dropdown-menu dropdown-danger">
                    <li><a href="#" id="print1">Kepelabuhan</a></li>
                    <li><a href="#" id="print2">Pemanduan Dan Penundaan</a></li>
                    <li><a href="#" id="print3">Komersial Dan Pengembangan Usaha</a></li>
                    <li><a href="#" id="print4">Keuangan</a></li>
                    <li><a href="#" id="print5">SDM Dan Umum</a></li>
                    <li><a href="#" id="print6">T H L</a></li>
                </ul>
            </div>-->

            <div class="btn-group">
                <button data-toggle="dropdown" class="btn btn-sm btn-danger dropdown-toggle">
                    Unduh / Cetak
                    <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                </button>

                <ul class="dropdown-menu dropdown-danger">
                    <li><a href="#" id="print-ciss">Rekap C.I.S.S Absen</a></li>
                    <li><a href="#" id="print-rabsen">Rekap Absen</a></li>
                </ul>
            </div>

<div id="my-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
    <!-- 01 Header Form-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="smaller lighter blue no-margin">Form </h3>
                </div>
    <!-- 01 end heder form-->
    <!-- 02 body Form -->
                <div class="modal-body">
                    <form class="form-horizontal form-aktif" id="form-1" method="get">
                        {!! csrf_field() !!}
                        <input type="hidden" id='oper' name="oper" value="add" />
                        <input type="hidden" id='id' name="id" value="" />
                        <input type="hidden" id='id_uu' name="id_uu" value="" />
                        <div class="row">
                          <label class="control-label col-sm-3 no-padding-right">Tanggal :</label>
                          <div class=" col-sm-3">
                            <div class="input-group input-group-sm">
                              <input type="text" id="tdate" name="tdate" class="tgl" />
                              <span class="input-group-addon"><i class="ace-icon fa fa-calendar"></i></span>
                            </div>
                          </div>
                        </div><div class="space-2"></div>
                        <div class="row">
                          <label class="control-label col-sm-3 no-padding-right">Jam masuk :</label>
                          <div class="col-sm-3">
                            <input type="text" id="jmasuk" name="jmasuk" value="00:00" class="col-sm-6"/>
                          </div>
                        </div><div class="space-2"></div>
                        <div class="row">
                          <label class="control-label col-sm-3 no-padding-right">Jam keluar :</label>
                          <div class="col-sm-3">
                            <input type="text" id="jkeluar" name="jkeluar" value="00:00" class="col-sm-6"/>
                          </div>
                        </div><div class="space-2"></div>

                        <div class="row">
                          <label class="control-label col-sm-3 no-padding-right">Scan Masuk :</label>
                          <div class="col-sm-3">
                            <input class="col-sm-6" type="text" id="idate" name="idate" class="jam" />&nbsp;
                            <span class="help-inline">
                              <label class="middle">
                                <input id="cki" name="cki" class="ace" type="checkbox" value="1" checked>
                                <span class="lbl"> aktif</span>
                              </label>
                            </span>
                          </div>
                        </div><div class="space-2"></div>

                        <div class="row">
                          <label class="control-label col-sm-3 no-padding-right">Scan Pulang :</label>
                          <div class=" col-sm-3">
                              <input class="col-sm-6" type="text" id="odate" name="odate" class="jam" />&nbsp;
                              <span class="help-inline">
                                <label class="middle">
                                  <input id="cko" name="cko" class="ace" type="checkbox" value="1" checked>
                                  <span class="lbl"> aktif</span>
                                </label>
                              </span>
                          </div>
                        </div><div class="space-2"></div>

                        <div class="row">
                            <label class="control-label col-sm-3 no-padding-right" for="name">Kehadiran :</label>
                            <div class=" col-sm-9">
                                <div class="clearfix">
                                    <input id="hadir" name="hadir" type="checkbox" value="1" class="ace ace-switch ace-switch-4" checked/>
                                    <span class="lbl" data-lbl="&nbsp;O&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;III"></span>
                                    <small class="green">
                                        <b>Tidak hadir / Hadir</b>
                                    </small>
                                </div>
                            </div>
                        </div><div class="space-2"></div>

                        <div class="row">
                            <label class="control-label col-sm-3 no-padding-right" for="name">Status :</label>
                            <div class=" col-sm-4">
                                <select id="status" name="status" class="chosen-select form-control" data-placeholder="Pilih ..." >
                                    <option value="0">-</option>
                                    <option value="1">Tanpa ket</option>
                                    <option value="2">Ijin</option>
                                    <option value="6">Ijin Dinas</option>
                                    <option value="3">Sakit</option>
                                    <option value="5">SPD</option>
                                </select>
                            </div>
                        </div><div class="space-2"></div>

                        <div class="row">
                            <label class="control-label col-sm-3 no-padding-right" for="name">Ubah :</label>
                            <div class=" col-sm-9">
                                <div class="clearfix">
                                    <input id="ubah" name="ubah" type="checkbox" value="1" class="ace ace-switch ace-switch-4" checked/>
                                    <span class="lbl" data-lbl="&nbsp;O&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;III"></span>
                                    <small class="green">
                                        <b>Tidak ubah / Ubah</b>
                                    </small>
                                </div>
                            </div>
                        </div><div class="space-2"></div>

                        <div class="row">
                            <label class="control-label col-sm-3 no-padding-right" for="comment">Ket</label>
                            <div class=" col-sm-9">
                                <div class="clearfix"><input type="text" id="ket" name="ket" class="ket" value="" /></div>
                            </div>
                        </div><div class="space-2"></div>
                    </form>                  .
                </div>
                <!-- 02 end body Form -->
                <!-- 03 footer Form -->
                <div class="modal-footer">
                  <button class="btn btn-sm btn-danger pull-right" id='save'>
                      <i class="ace-icon fa fa-floppy-o"></i>Save
                  </button>
                  <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                      <i class="ace-icon fa fa-times"></i>Close
                  </button>
                </div>
                <!-- 03 end footer Form -->
            </div>
        </div><!-- /.modal-dialog -->
    </div>

            <div align="center">LOG ABSEN KARYAWAN<br />PT. PELABUHAN CILEGON MANDIRI<br />
                Priode : <?php echo '<span class="editable" id="psdate">16 '.date('F Y', strtotime('-1 month')).'</span> s.d. <span class="editable" id="pedate">15 '.date('F Y').'</span>';  ?>
            </div>
            <div class="row">
              <div class="col-xs-3">
                <select id="id_u_f" name="id_u_f" class="chosen-select form-control" data-placeholder="Pilih Nama ..." >

                </select>
              </div>
            </div>

            <table id="grid-table"></table>
            <div id="grid-pager"></div><br />
            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->


@endsection

@section('js')
<!-- page specific plugin scripts -->
<script src="{{ asset('/js/moment.min.js') }}"></script>

<script src="{{ asset('/js/jquery.jqGrid.min.js') }}"></script>
<script src="{{ asset('/js/grid.locale-en.js') }}"></script>

<script src="{{ asset('/js/bootstrap-editable.min.js') }}"></script>
<script src="{{ asset('/js/ace-editable.min.js') }}"></script>
<script src="{{ asset('/js/chosen.jquery.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-tag.min.js') }}"></script>

<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-datetimepicker.min.js') }}"></script>

<!-- inline scripts related to this page -->

<script type="text/javascript">
  jQuery(function($) {
    //editables on first profile page
    $.fn.editable.defaults.mode = 'inline';
    $.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
                                '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';

    //text editable
    $('#psdate').editable({
        type: 'adate',
        date: {
            //datepicker plugin options
                format: 'dd MM yyyy',
            viewformat: 'dd MM yyyy',
             weekStart: 1

            //,nativeUI: true//if true and browser support input[type=date], native browser control will be used
            //,format: 'yyyy-mm-dd',
            //viewformat: 'yyyy-mm-dd'
        }
    }).on('save', function(e, params) {
        $(grid_selector).jqGrid('setGridParam',{postData:{start:params.newValue}}).trigger("reloadGrid");
        $('input[name="start"]').val(params.newValue);
        setdate = params.newValue;
    });

    $('#pedate').editable({
        type: 'adate',
        date: {
            //datepicker plugin options
                format: 'dd MM yyyy',
            viewformat: 'dd MM yyyy',
             weekStart: 1

            //,nativeUI: true//if true and browser support input[type=date], native browser control will be used
            //,format: 'yyyy-mm-dd',
            //viewformat: 'yyyy-mm-dd'
        }
    }).on('save', function(e, params) {
        $(grid_selector).jqGrid('setGridParam',{postData:{end:params.newValue}}).trigger("reloadGrid");
        $('input[name="end"]').val(params.newValue);
    });

    //////////////////////////////// chosen
    if(!ace.vars['touch']) {
      $('.chosen-select').chosen({allow_single_deselect:true});
      //resize the chosen on window resize

      $(window)
      .off('resize.chosen')
      .on('resize.chosen', function() {
        $('.chosen-select').each(function() {
          var $this = $(this);
          $this.next().css({'width': '100%'});
        })
      }).trigger('resize.chosen');

      //resize chosen on sidebar collapse/expand
      $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
        if(event_name != 'sidebar_collapsed') return;
        $('.chosen-select').each(function() {
          var $this = $(this);
          $this.next().css({'width': '100%'});
        })
      });

      $('#chosen-multiple-style .btn').on('click', function(e){
        var target = $(this).find('input[type=radio]');
        var which = parseInt(target.val());
        if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
        else $('#form-field-select-4').removeClass('tag-input-style');
      });
    }

    var posdata= {'datatb':'pegawai'};
    getparameter(site+'/api/kepegawaian/json',posdata,function(data){
      var $select_elem = $("#id_u_f");
      $select_elem.empty();
      $.each(data.member, function (idx, obj) {
        $select_elem.append('<option value="' + idx + '">' + obj + '</option>');
      });
      $select_elem.trigger("chosen:updated");
    });

    $('#id_u_f').chosen({allow_single_deselect:true}).change(function(e) {
        var idu = $(this).val();
        $('input[name="karyawan"]').val(idu);
        $(grid_selector).jqGrid('setGridParam',{postData:{iduser:idu}}).trigger("reloadGrid");
    });
//////////////////////////////// end chosen

    var start = $('#psdate').html();
    var end = $('#pedate').html();
    var idu = $('#id_u_f').val();

    if(!idu)idu=1;

    $('input[name="start"]').val(start);
    $('input[name="end"]').val(end);
    $('input[name="karyawan"]').val(idu);

    var postsave={};
    postsave.url = "{{ url('/api/kepegawaian/cud') }}";
    postsave.grid = '#grid-table';
    postsave.modal = '#my-modal';
    $('#save').click(function(e) {
      e.preventDefault();
      postsave.post += $("#form-1").serialize()+'&datatb=absen';
      saveGrid(postsave);
    });

    var grid_selector = "#grid-table";
    var pager_selector = "#grid-pager";

    var parent_column = $(grid_selector).closest('[class*="col-"]');
    //resize to fit page size
    $(window).on('resize.jqGrid', function () {
      $(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
    })

    //resize on sidebar collapse/expand
    $(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
      if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
        //setTimeout is for webkit only to give time for DOM changes and then redraw!!!
        setTimeout(function() {
          $(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
        }, 20);
      }
    })

    //if your grid is inside another element, for example a tab pane, you should use its parent's width:
    $(window).on('resize.jqGrid', function () {
        var parent_width = $(grid_selector).closest('.tab-pane').width();
        $(grid_selector).jqGrid( 'setGridWidth', parent_width );
    })
    //and also set width when tab pane becomes visible
    $('#myTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      if($(e.target).attr('href') == '#mygrid') {
        var parent_width = $(grid_selector).closest('.tab-pane').width();
        $(grid_selector).jqGrid( 'setGridWidth', parent_width );
      }
    })


    jQuery(grid_selector).jqGrid({
      caption: "Absen",
      datatype: "json",            //supported formats XML, JSON or Arrray
      url:"{{url('api/kepegawaian/jqgrid')}}",
      mtype : "post",
      postData: {datatb:'absen', grup:'absen',start:start,end:end,iduser:idu,_token:'{{ csrf_token() }}'},
      height: 'auto',
      colNames:[' ', 'Nama', 'Tanggal','Waktu','Jam Kerja','S.Masuk','S.Pulang','Terlambat','Plg. Cepat','Kehadiran','Status','Ubah','ket','',''],
      colModel:[
        {name:'myac',index:'',width:10, editable: false},
        {name:'nama',index:'nama', width:90, editable: false},
        {name:'date',index:'date', width:90, editable: false},
        {name:'day',index:'day', width:60, editable: false},
        {name:'jkerja',index:'jkerja', width:90, editable: false},
        {name:'idate',index:'idate', width:90, editable: true},
        {name:'odate',index:'odate', width:60, editable: true},
        {name:'telat',index:'telat', width:60, editable: false},
        {name:'cepat',index:'cepat', width:60, editable: false},
        {name:'hadir',index: 'hadir', width: 50, align: 'center',editable: true,
          edittype: 'checkbox', editoptions: { value: "1:0" },
          formatter: "checkbox", formatoptions: { disabled: true}
        },
        {name:'status',index:'status',width:80, editable: true,align: 'center',
          edittype: 'select', editoptions: {
            value: '0:-;1:Tanpa ket;2:Ijin;3:Sakit;5:SPD'
          }
        },
        {name:'ubah',index: 'ubah', width: 50, align: 'center',editable: true,
          edittype: 'checkbox', editoptions: { value: "1:0" },
          formatter: "checkbox", formatoptions: { disabled: true}
        },
        {name:'ket',index:'ket',width:120, editable: true},
        {name:'iaktiv',index:'iaktiv',width:20,hidden:true },
        {name:'oaktiv',index:'oaktiv',width:20,hidden:true},
      ],

      viewrecords : true,
      rowNum:31,
      rowList:[10,20,31],
      pager : pager_selector,
      altRows: true,
      multiboxonly: true,
      grouping: true,
      groupingView : { groupField : ['nama'],groupColumnShow : [false]},
      loadComplete : function(data) {
        var gridData = $(this).jqGrid('getRowData');

        for(var i=0; i<gridData.length; i++) {
          var cell5 = data.rows[i].cell[5];
          var cell6 = data.rows[i].cell[6];
          var cell7 = data.rows[i].cell[7];
          var cell8 = data.rows[i].cell[8];
          var cki = data.rows[i].cell[13];
          var cko = data.rows[i].cell[14];

          if (cell5 == '0' && cell6 == '0'){
            if (cki!=0 && cko!=0){
              //alert(JSON.stringify(data.rows[i].id));
              $(this).setCell (data.rows[i].id,'idate','',{background:'pink'});
              $(this).setCell (data.rows[i].id,'odate','',{background:'pink'});
              $(this).setCell (data.rows[i].id,'telat','',{background:'pink'});
              $(this).setCell (data.rows[i].id,'cepat','',{background:'pink'});
            }else {
              if (cki!=0)$(this).setCell (data.rows[i].id,'idate','',{background:'#5BD7FF'});
              if (cko!=0)$(this).setCell (data.rows[i].id,'odate','',{background:'#5BD7FF'});
            }
          } else if (cell5 == '0'){
            if (cki!=0)$(this).setCell (data.rows[i].id,'idate','',{background:'#5BD7FF'});
          } else if (cell6 == '0'){
            if (cko!=0)$(this).setCell (data.rows[i].id,'odate','',{background:'#5BD7FF'});
          }

          if (cell7 != ''){
            $(this).setCell (data.rows[i].id,'telat','',{background:'red',color:'white'});
          }

          if (cell8 != ''){
            $(this).setCell (data.rows[i].id,'cepat','',{background:'yellow'});
          }
        }

        var table = this;
        setTimeout(function(){
          updateActionIcons(grid_selector);
          updatePagerIcons(grid_selector);
          enableTooltips(grid_selector);
        }, 0);
      },
      onSelectRow: function(rowid, e) {
        selRowId = $(this).jqGrid ('getGridParam', 'selrow'),
        celValue = $(this).jqGrid ('getCell', selRowId, 'status');

        if (celValue=='Cuti')alert('Untuk Mengubah data ini dapat menggunakan menu cuti');
    //    $('#'+rowid).parents('table').resetSelection();
        return false;
      },
    });
    $(window).triggerHandler('resize.jqGrid');//trigger window resize to make the grid get the correct size

    //enable search/filter toolbar
    //jQuery(grid_selector).jqGrid('filterToolbar',{defaultSearch:true,stringResult:true})
    //jQuery(grid_selector).filterToolbar({});


    //switch element when editing inline
    function aceSwitch( cellvalue, options, cell ) {
      setTimeout(function(){
        $(cell) .find('input[type=checkbox]')
          .addClass('ace ace-switch ace-switch-5')
          .after('<span class="lbl"></span>');
      }, 0);
    }
    //enable datepicker
    function pickDate( cellvalue, options, cell ) {
      setTimeout(function(){
        $(cell) .find('input[type=text]')
          .datepicker({format:'dd MM yyyy' , autoclose:true});
      }, 0);
    }

    //navButtons
    jQuery(grid_selector).jqGrid('navGrid',pager_selector,{   //navbar options
      edit: false,
      editicon : 'ace-icon fa fa-pencil blue',
      add: false,
      addicon : 'ace-icon fa fa-plus-circle purple',
      del: true,
      delicon : 'ace-icon fa fa-trash-o red',
      search: true,
      searchicon : 'ace-icon fa fa-search orange',
      refresh: true,
      refreshicon : 'ace-icon fa fa-refresh green',
      view: false,
      viewicon : 'ace-icon fa fa-search-plus grey',
    },{
      //edit record form
      closeAfterEdit: true,
      //width: 700,
      recreateForm: true,
      beforeShowForm : function(e) {
        var form = $(e[0]);
        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
        style_edit_form(form);
      },
      onclickSubmit: function () {
        return { datatb:'absen', _token:'{{ csrf_token() }}'};
      }
    },{
      //new record form
      //width: 700,
      closeAfterAdd: true,
      recreateForm: true,
      viewPagerButtons: false,
      beforeShowForm : function(e) {
        var form = $(e[0]);
        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar')
        .wrapInner('<div class="widget-header" />')
        style_edit_form(form);
      },
      onclickSubmit: function () {
        return { datatb:'nilai', grup:'jabatan', _token:'{{ csrf_token() }}'};
      }
    },{
      //delete record form
      recreateForm: true,
      beforeShowForm : function(e) {
        var form = $(e[0]);
        if(form.data('styled')) return false;

        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
        style_delete_form(form);

        form.data('styled', true);
      },
      onclickSubmit: function () {
        return { datatb: 'absen', _token:'{{ csrf_token() }}'};
      }
    },{
      //search form
      recreateForm: true,
      afterShowSearch: function(e){
        var form = $(e[0]);
        form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
        style_search_form(form);
      },
      afterRedraw: function(){
        style_search_filters($(this));
      }
      ,
      multipleSearch: true,
      /**
      multipleGroup:true,
      showQuery: true
      */
    },{
      //view record form
      recreateForm: true,
      beforeShowForm: function(e){
        var form = $(e[0]);
        form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
      }
    }).jqGrid('navButtonAdd',pager_selector,{
      keys: true,
      caption:"",
      buttonicon:"ace-icon fa fa-pencil blue",
      position:"first",
      onClickButton:function(){
        $('#form-1').trigger("reset");

        var gsr = jQuery(grid_selector).jqGrid('getGridParam','selrow');
        if(gsr){
          var postData= {datatb:'absen', cari: gsr, _token:'{{ csrf_token() }}', oper:'edit'};
          $.ajax({
            url: "{{url('/api/kepegawaian/json/')}}",
            data : postData,
            type: "post",
            success: function(response){
              $('#oper').val('edit');
              alert(response.date);
              $('#id').val(gsr);
              $('#tdate').datepicker({format:'dd MM yyyy', viewformat: 'dd MM yyyy', autoclose:true}).datepicker("setDate", response.date).prop('disabled', true);

              $('#jkeluar').val(response.jkeluar);
              $('#jmasuk').val(response.jmasuk);
              if(response.cki==1)$('#cki').prop('checked',true); else $('#cki').prop('checked',false);
              $('#idate').val(response.idate);
              if(response.cko==1)$('#cko').prop('checked',true); else $('#cko').prop('checked',false);
              $('#odate').val(response.odate);

              if(response.hadir==1)$('#hadir').prop('checked',true); else $('#hadir').prop('checked',false);
              $("#status").val(response.status).trigger("chosen:updated");
              if(response.ubah==1)$('#ubah').prop('checked',true); else $('#ubah').prop('checked',false);

              $('#ket').val(response.ket);
              //alert (response.idate);
            }
          });
          $('#my-modal').modal('show');
        } else alert("pilih tabel");
    }
    }).jqGrid('navButtonAdd',pager_selector,{
      caption:"",
      buttonicon:"ace-icon fa fa-plus-circle purple",
      position:"first",
      onClickButton:function(){
        $('#form-1').trigger("reset");
        $('#tdate').datepicker({format:'dd MM yyyy', viewformat: 'dd MM yyyy', autoclose:true}).datepicker("setDate", '{{date("d F Y")}}').prop('disabled', false);
        //$('.jam').datetimepicker({format:'D m Y',sideBySide: true});
        $('#id_uu').val($('#id_u_f').val());

        $('#oper').val('add');
        $('#my-modal').modal('show');
        //alert( $('#id_u_f').val() );

        // alert( $('#id_u').val() );
     }
    })


    $(document).keypress(function(e) {
      // alert (e.which);
      if(e.which == 10001) {
        $('#form-1').trigger("reset");

        var gsr = jQuery(grid_selector).jqGrid('getGridParam','selrow');
        if(gsr){
            var postData= {datatb:'absen', cari: gsr, _token:'{{ csrf_token() }}', oper:'edit'};
            $.ajax({
                url: "{{url('KepegawaianJson')}}",
                data : postData,
                type: "post",
                success: function(response){
                    $('#oper').val('edit');

                    $('#id').val(gsr);
                    $('#tdate').datepicker({format:'dd MM yyyy', viewformat: 'dd MM yyyy', autoclose:true}).datepicker("setDate", response.date).prop('disabled', true);

                    $('#jkeluar').val(response.jkeluar);
                    $('#jmasuk').val(response.jmasuk);
                    if(response.cki==1)$('#cki').prop('checked',true); else $('#cki').prop('checked',false);
                    $('#idate').val(response.idate);
                    if(response.cko==1)$('#cko').prop('checked',true); else $('#cko').prop('checked',false);
                    $('#odate').val(response.odate);

                    if(response.hadir==1)$('#hadir').prop('checked',true); else $('#hadir').prop('checked',false);
                    $("#status").val(response.status).trigger("chosen:updated");
                    if(response.ubah==1)$('#ubah').prop('checked',true); else $('#ubah').prop('checked',false);

                    $('#ket').val(response.ket);
                    //alert (response.idate);
                }

            });
            $('#my-modal').modal('show');
          } else alert("pilih tabel");
      }
    });

    $('#ambil').click(function() {
//              var request = $("#absenform").serialize();
      var postData = {datatb:'absen2', start:$('#psdate').html(),end:$('#pedate').html(),_token:'{{ csrf_token() }}', oper:'add' };
      $.ajax({
        type: 'POST',
        url: "{{ url('/api/kepegawaian/cud/') }}",
        data: postData,
        beforeSend:function(){
          $("#ambil").prop('disabled', true);
          var newHTML = '<i class="ace-icon fa fa-spinner fa-spin "></i>Loading...';
          document.getElementById('ambil').innerHTML = newHTML;

        },
        success: function(msg) {
          $("#ambil").prop('disabled', false);
          var newHTML = 'Perbaharui';
          document.getElementById('ambil').innerHTML = newHTML;
          if(msg.status == 'success'){
              alert (msg.msg);
              $(grid_selector).jqGrid('setGridParam',{postData:{start:$('#psdate').html(),end:$('#pedate').html()}}).trigger("reloadGrid");
          } else {
              alert (msg.msg);
              $(grid_selector).jqGrid('setGridParam',{postData:{start:$('#psdate').html(),end:$('#pedate').html()}}).trigger("reloadGrid");
          }
        }
      })
    });

    $('#print1').click(function() {
        document.getElementById('print-1').submit();
    });
    $('#print2').click(function() {
        document.getElementById('print-2').submit();
    });
    $('#print3').click(function() {
        document.getElementById('print-3').submit();
    });
    $('#print4').click(function() {
        document.getElementById('print-4').submit();
    });
    $('#print5').click(function() {
        document.getElementById('print-5').submit();
    });
    $('#print6').click(function() {
        document.getElementById('print-6').submit();
    });
    $('#print-log').click(function() {
        document.getElementById('log').submit();
    });
    $('#print-ciss').click(function() {
        document.getElementById('ciss').submit();
    });
    $('#print-rabsen').click(function() {
        document.getElementById('rabsen').submit();
    });
    $('#print-bulanan2').click(function() {
        document.getElementById('bulanan2').submit();
    });

    $('#btn').click(function() {
      var request = $("#form-1").serialize();

      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "{{ url('/KepegawaianCrud/') }}",
        data: request,
        beforeSend:function(){
            var newHTML = '<i class="ace-icon fa fa-spinner fa-spin "></i>Loading...';
            document.getElementById('btn').innerHTML = newHTML;

        },
        success: function(msg) {
          var newHTML = '<i class="ace-icon fa fa-floppy-o"></i>Save';
          document.getElementById('btn').innerHTML = newHTML;

          if(msg.status == 'success'){
            $(grid_selector).trigger("reloadGrid");
            $('#my-modal').modal('hide');
            $('#id_u').val();
            document.getElementById("form-1").reset();
            $(grid_selector).jqGrid('setGridParam',{postData:{iduser:$('#id_u').val()}}).trigger("reloadGrid");
          } else {
            alert (msg.msg);
          }

        },
        error: function(xhr, Status, err) {
          //alert("Terjadi error : "+Status);
          alert (JSON.stringify(xhr));
          alert ("terjadi kesalahan harap hubungi administrator");
        }
      });
    });


            function style_edit_form(form) {
                //enable datepicker on "sdate" field and switches for "stock" field
                form.find('input[name=sdate]').datepicker({format:'dd MM yyyy' , autoclose:true}).datepicker("setDate", new Date())

                form.find('input[name=stock]').addClass('ace ace-switch ace-switch-5').after('<span class="lbl"></span>');
                           //don't wrap inside a label element, the checkbox value won't be submitted (POST'ed)
                          //.addClass('ace ace-switch ace-switch-5').wrap('<label class="inline" />').after('<span class="lbl"></span>');


                //update buttons classes
                var buttons = form.next().find('.EditButton .fm-button');
                buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
                buttons.eq(0).addClass('btn-primary').prepend('<i class="ace-icon fa fa-check"></i>');
                buttons.eq(1).prepend('<i class="ace-icon fa fa-times"></i>')

                buttons = form.next().find('.navButton a');
                buttons.find('.ui-icon').hide();
                buttons.eq(0).append('<i class="ace-icon fa fa-chevron-left"></i>');
                buttons.eq(1).append('<i class="ace-icon fa fa-chevron-right"></i>');
            }

            function style_delete_form(form) {
                var buttons = form.next().find('.EditButton .fm-button');
                buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
                buttons.eq(0).addClass('btn-danger').prepend('<i class="ace-icon fa fa-trash-o"></i>');
                buttons.eq(1).addClass('btn-default').prepend('<i class="ace-icon fa fa-times"></i>')
            }

            function style_search_filters(form) {
                form.find('.delete-rule').val('X');
                form.find('.add-rule').addClass('btn btn-xs btn-primary');
                form.find('.add-group').addClass('btn btn-xs btn-success');
                form.find('.delete-group').addClass('btn btn-xs btn-danger');
            }
            function style_search_form(form) {
                var dialog = form.closest('.ui-jqdialog');
                var buttons = dialog.find('.EditTable')
                buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'ace-icon fa fa-retweet');
                buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'ace-icon fa fa-comment-o');
                buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'ace-icon fa fa-search');
            }

            function beforeDeleteCallback(e) {
                var form = $(e[0]);
                if(form.data('styled')) return false;

                form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                style_delete_form(form);

                form.data('styled', true);
            }

            function beforeEditCallback(e) {
                var form = $(e[0]);
                form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                style_edit_form(form);
            }



            //it causes some flicker when reloading or navigating grid
            //it may be possible to have some custom formatter to do this as the grid is being created to prevent this
            //or go back to default browser checkbox styles for the grid
            function styleCheckbox(grid_selector) {
            /**
                $(grid_selector).find('input:checkbox').addClass('ace')
                .wrap('<label />')
                .after('<span class="lbl align-top" />')


                $('.ui-jqgrid-labels th[id*="_cb"]:first-child')
                .find('input.cbox[type=checkbox]').addClass('ace')
                .wrap('<label />').after('<span class="lbl align-top" />');
            */
            }


            //unlike navButtons icons, action icons in rows seem to be hard-coded
            //you can change them like this in here if you want
            function updateActionIcons(grid_selector) {
                /**
                var replacement =
                {
                    'ui-ace-icon fa fa-pencil' : 'ace-icon fa fa-pencil blue',
                    'ui-ace-icon fa fa-trash-o' : 'ace-icon fa fa-trash-o red',
                    'ui-icon-disk' : 'ace-icon fa fa-check green',
                    'ui-icon-cancel' : 'ace-icon fa fa-times red'
                };
                $(grid_selector).find('.ui-pg-div span.ui-icon').each(function(){
                    var icon = $(this);
                    var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
                    if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
                })
                */
            }

            //replace icons with FontAwesome icons like above
            function updatePagerIcons(grid_selector) {
                var replacement =
                {
                    'ui-icon-seek-first' : 'ace-icon fa fa-angle-double-left bigger-140',
                    'ui-icon-seek-prev' : 'ace-icon fa fa-angle-left bigger-140',
                    'ui-icon-seek-next' : 'ace-icon fa fa-angle-right bigger-140',
                    'ui-icon-seek-end' : 'ace-icon fa fa-angle-double-right bigger-140'
                };
                $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function(){
                    var icon = $(this);
                    var $class = $.trim(icon.attr('class').replace('ui-icon', ''));

                    if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
                })
            }

            function enableTooltips(grid_selector) {
                $('.navtable .ui-pg-button').tooltip({container:'body'});
                $(grid_selector).find('.ui-pg-div').tooltip({container:'body'});
            }

            //var selr = jQuery(grid_selector).jqGrid('getGridParam','selrow');

            $(document).one('ajaxloadstart.page', function(e) {
                $(grid_selector).jqGrid('GridUnload');
                $('.ui-jqdialog').remove();
            });
        });
    </script>
@endsection
