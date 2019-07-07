@extends('backend.app_backend')

@section('css')
    <link href="{{ asset('/css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/ui.jqgrid.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/css/bootstrap-editable.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/chosen.min.css') }}" rel="stylesheet">
    <style type="text/css">
        .ui-autocomplete { position: absolute; cursor: default; z-index: 1100 !important;}
    </style>
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

    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
    <div id="my-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
    <!-- 01 Header Form-->
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="smaller lighter blue no-margin">Form Rawat Jalan</h3>
              </div>
            <!-- 01 end heder form-->
            <!-- 02 body Form -->
              <div class="modal-body">
                <form class="form-horizontal form-aktif" id="form-1" method="get">
                  {!! csrf_field() !!}
                  <input type="hidden" id='datatb' name="datatb" value="rjr" />
                  <input type="hidden" id='oper' name="oper" value="" />
                  <input type="hidden" id='id' name="id" value="" />

                  <div class="row">
                    <label class="control-label col-sm-3 no-padding-right" for="name">Nomor :</label>
                    <div class="col-sm-4">
                      <input type="text" id="no" name="no" value="" />
                    </div>
                  </div><div class="space-2"></div>

                  <div class="row">
                    <label class="control-label col-sm-3 no-padding-right">Tanggal dokumen :</label>
                    <div class="col-sm-4">
                      <div class="input-group input-group-sm ">
                        <input type="text" id="tgldoc" name="tgldoc" class="input-sm form-control tgl" value="" />
                        <input type="hidden" id="prefx" name="prefx" />
                        <span class="input-group-addon"><i class="ace-icon fa fa-calendar"></i></span>
                      </div>
                    </div>
                  </div><div class="space-2"></div>

                  <div class="row">
                    <label class="control-label col-sm-3 no-padding-right" for="name">Nama Karyawan :</label>
                    <div class="col-sm-4">
                      <select id="id_u" name="id_u" class="chosen-select form-control " data-placeholder="Pilih ..." >
                        <option value=""></option>

                      </select>
                    </div>
                  </div><div class="space-2"></div>

                  <div class="row">
                    <label class="control-label col-sm-3 no-padding-right" for="state">Nama Pasien :</label>
                    <div class="col-sm-4">
                      <select id="id_p" name="id_p" class="chosen-select form-control" data-placeholder="Pilih ...">
                        <option value=""></option>
                      </select>
                    </div>
                  </div><div class="space-2"></div>

                  <div class="row">
                    <label class="control-label col-sm-3 no-padding-right">Tanggal Kwitansi:</label>
                    <div class="col-sm-4">
                      <div class="input-group input-group-sm">
                        <input type="text" id="tglkw" name="tglkw" class="input-sm form-control tgl" />
                        <span class="input-group-addon"><i class="ace-icon fa fa-calendar"></i></span>
                      </div>
                    </div>
                  </div><div class="space-2"></div>

                  <div class="row">
                    <label class="control-label col-sm-3 no-padding-right" for="comment">Diagnosa</label>
                    <div class="col-sm-4">
                      <input type="text" id="ket" name="ket" class="ket" value="" />
                    </div>
                  </div><div class="space-2"></div>

                  <div class="row">
                    <label class="control-label col-sm-3 no-padding-right" for="name">Platform :</label>
                    <div class="col-sm-4">
                      <input class="col-sm-6" type="text" id="rj" name="rj" value="" disabled class="" onkeyup="formatNumber(this);" onchange="formatNumber(this);"/>
                      <span class="help-inline col-sm-6">
                        <label class="middle">
                          <input id="id-disable-check" name="urj" class="ace" type="checkbox">
                          <span class="lbl">Ubah</span>
                        </label>
                      </span>
                    </div>
                  </div><div class="space-2"></div>

                  <div class="row">
                    <label class="control-label col-sm-3 no-padding-right" for="comment">Sisa</label>
                    <label class="control-label col-sm-3 no-padding-right" id="sisa"><?php echo number_format(0);?></label>
                  </div><div class="space-2"></div>

                  <div class="row">
                    <label class="control-label col-sm-3 no-padding-right" for="name">Debit :</label>
                    <div class="col-sm-4">
                      <input type="text" id="debit" name="debit" value="" style="text-align: right;" onkeyup="formatNumber(this);" onchange="formatNumber(this);"/>
                    </div>
                  </div><div class="space-2"></div>
                </form>                  .
              </div>
    <!-- 02 end body Form -->
    <!-- 03 footer Form -->
                <div class="modal-footer">
                  <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>Close
                  </button>
                  <button  class="btn btn-sm btn-danger pull-right" id='save' onclick="
                    saveGrid({
                      'url'   : '{{ url('/api/kepegawaian/cud') }}',
                      'grid'  : '#grid-table',
                      'modal' : '#my-modal'
                    })">
                      <i class="ace-icon fa fa-floppy-o"></i>Save
                  </button>
                </div>
    <!-- 03 end footer Form -->
            </div>
        </div><!-- /.modal-dialog -->
    </div>
    <!-- end Form -->
            <div align="center">Data Rawat Jalan<br />PT. PELABUHAN CILEGON MANDIRI<br />
                Priode : <?php if(date('d')<15) echo '<span class="editable" id="psdate">1 '.date('F Y').'</span> s.d. <span class="editable" id="pedate">15 '.date('F Y').'</span>'; else echo '<span class="editable" id="psdate">15 '.date('F Y').'</span> s.d. <span class="editable" id="pedate">'.date('t F Y').'</span>'; ?></div><br />

            <div class="row">
              <div class="col-xs-3">
                <select id="id_u_f" name="id_u_f" class="chosen-select form-control" data-placeholder="Pilih Nama ..." >
                    <option value=""></option>
                </select>
              </div>
              <form id="pengajuan" role="form" method="POST" action="{{ url('PDF_Kepegawaian') }}" target="_blank">
                  {!! csrf_field() !!}
                  <input name="category" value="rawatjalan1" type="hidden"/>
                  <input name="start" value="" type="hidden"/>
                  <input name="end" value="" type="hidden"/>
                  <input name="page" value="rawatjalan1" type="hidden"/>
                  <input name="file" value="PengajuanPembiayaan" type="hidden"/>
              </form>
               <form id="form" role="form" method="POST" action="{{ url('PDF_Kepegawaian') }}" target="_blank">
                  {!! csrf_field() !!}
                  <input name="category" value="rawatjalan1" type="hidden"/>
                  <input name="start" value="" type="hidden"/>
                  <input name="end" value="" type="hidden"/>
                  <input name="page" value="rawatjalan2" type="hidden"/>
                  <input name="file" value="FormPembiayaan" type="hidden"/>
              </form>
              <form id="bulanan2" role="bulanan2" method="POST" action="{{ url('PDF_Kepegawaian') }}" target="_blank">
                  {!! csrf_field() !!}
                  <input name="category" value="bulanan2" type="hidden"/>
                  <input name="start" value="" type="hidden"/>
                  <input name="end" value="" type="hidden"/>
                  <input name="page" value="bulanan2" type="hidden"/>
                  <input name="file" value="Laporan2Bulanan" type="hidden"/>
              </form>
              <div class="col-xs-7"> </div>
              <div class="col-xs-2 btn-group">
                  <button data-toggle="dropdown" class="btn btn-sm btn-danger dropdown-toggle">
                      Unduh / Print
                      <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                  </button>

                  <ul class="dropdown-menu dropdown-danger">
                      <li><a href="#" id="print-pengajuan">Pengajuan</a></li>
                      <li><a href="#" id="print-form">Form</a></li>
                      <li><a href="#" id="print-bulanan2">Bulanan</a></li>
                  </ul>
              </div><!-- /.btn-group -->
            </div>

            <table id="grid-table"></table>
            <div id="grid-pager"></div>


            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('js')
    <script src="{{ asset('/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/js/moment.min.js') }}"></script>

    <script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-datetimepicker.min.js') }}"></script>

    <script src="{{ asset('/js/jquery.jqGrid.min.js') }}"></script>
    <script src="{{ asset('/js/grid.locale-en.js') }}"></script>

    <script src="{{ asset('/js/bootstrap-editable.min.js') }}"></script>
    <script src="{{ asset('/js/ace-editable.min.js') }}"></script>
    <script src="{{ asset('/js/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-tag.min.js') }}"></script>

<script type="text/javascript">
  jQuery(function($) {
    //editables on first profile page
    $.fn.editable.defaults.mode = 'inline';
    $.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
                                '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';

    $('.tgl').datepicker({format:'dd MM yyyy', autoclose:true});

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
    $('#id_u_f').chosen({allow_single_deselect:true}).change(function(e) {
        var id_u = $(this).val();
        $(grid_selector).jqGrid('setGridParam',{postData:{id_u:id_u}}).trigger("reloadGrid");
    });
    var posdata= {'datatb':'pegawai'};
    getparameter(site+'/api/kepegawaian/json',posdata,function(data){
      var $select_elem = $("#id_u_f");
      $select_elem.empty();
      $select_elem.append('<option value=""></option>');
      $.each(data.member, function (idx, obj) {
        $select_elem.append('<option value="' + idx + '">' + obj + '</option>');
      });
      $select_elem.trigger("chosen:updated");
      //////////////////////////////////////////////////////////////
      var $select_elem = $("#id_u");
      $select_elem.empty();
      $select_elem.append('<option value=""></option>');
      $.each(data.member, function (idx, obj) {
        $select_elem.append('<option value="' + idx + '">' + obj + '</option>');
      });
      $select_elem.trigger("chosen:updated");
    });
//////////////////////////////// end chosen

    var start = $('#psdate').html();
    var end = $('#pedate').html();
    $('input[name="start"]').val(start);
    $('input[name="end"]').val(end);

    var grid_selector = "#grid-table";
    var pager_selector = "#grid-pager";

    var setdate = start;

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
      caption: "Data Rawat Jalan",
      datatype: "json",            //supported formats XML, JSON or Arrray
      url:"{{url('api/kepegawaian/jqgrid')}}",
      mtype : "post",
      sortname:'no',
      postData: {datatb:'rjr',start:start,end:end,_token:'{{ csrf_token() }}'},
      height: 250,
      colNames:['No','Tanggal Doc','Karyawan','Hubungan','Nama Pasien','Tanggal Kwitansi','Diagnosa','Debit',''],
      colModel:[
        {name:'no',index:'no', width:50 },
        {name:'tgldoc',index:'tgldoc', width:70  },
        {name:'id_u',index:'id_u', width:90 },
        {name:'hub',index:'hub',width:50 },
        {name:'id_p',index:'id_p',width:90 },
        {name:'tglkw',index:'tglkw',width:70 },
        {name:'uraian',index:'uraian', width:130 },

        {name:'debit',index:'debit', width:80, sortable:false, editable: true, align: 'right', formatter: 'number',
            formatoptions: { thousandsSeparator: ",", decimalPlaces: 0, defaultValue: '0' }
        },
        {name:'id_px',index:'id_px',hidden: true},
      ],

      viewrecords : true,
      rowNum:10,
      rowList:[10,20,30],
      pager : pager_selector,
      altRows: true,
      //toppager: true,


      //multikey: "ctrlKey",
      multiboxonly: true,

      loadComplete : function(data) {
        //$(_tr).addClass("ui-state-error");
        var rowid = $(this).jqGrid('getDataIDs');
        var gridData = $(this).jqGrid('getRowData');

        for(var i=0; i<gridData.length; i++) {
          var tgl_keluar = data.rows[i].cell[7];

          if (tgl_keluar!=null) {
          //    $('#'+rowid[i]).css("background", "pink");;
          //    alert(rowid[i]);
          }

        }

        var table = this;
        setTimeout(function(){
            styleCheckbox(table);

            updateActionIcons(table);
            updatePagerIcons(table);
            enableTooltips(table);
        }, 0);
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
                .datepicker({format:'yyyy-mm-dd' , autoclose:true});
        }, 0);
    }

    //navButtons
    jQuery(grid_selector).jqGrid('navGrid',pager_selector,{   //navbar options
      edit: false,
      editicon : 'ace-icon fa fa-pencil blue',
      add: false,
      addicon : 'ace-icon fa fa-plus-circle purple',
      del: false,
      delicon : 'ace-icon fa fa-trash-o red',
      search: false,
      searchicon : 'ace-icon fa fa-search orange',
      refresh: true,
      refreshicon : 'ace-icon fa fa-refresh green',
      view: false,
      viewicon : 'ace-icon fa fa-search-plus grey',
    },{
      //edit record form
      //closeAfterEdit: true,
      //width: 700,
      recreateForm: true,
      beforeShowForm : function(e) {
          var form = $(e[0]);
          form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
          style_edit_form(form);
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
      onClick : function(e) {
          //alert(1);
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
            caption:"",
            buttonicon:"ace-icon fa fa-pencil blue",
            position:"first",
            onClickButton:function(){
                $('#form-1').trigger("reset");
                var gsr = $(this).jqGrid('getGridParam','selrow');

                $('#rj').get(0).setAttribute('disabled' , 'disabled');
                var objTag = $('#ket').data('tag');
                var values = objTag.values;
                for (var i = values.length; i > 0; i--) {
                    objTag.remove(i - 1);
                };

                if(gsr){
                  var postData= {datatb:'norawatjalan', cari: gsr, _token:'<?php echo csrf_token();?>', oper:'pra-edit'};

                  $.ajax({
                    url: "{{url('/api/kepegawaian/json')}}",
                    data : postData,
                    type: "post",
                    success: function(response){
                      $('#oper').val('edit');
                      $('#id').val(response.id);
                      $('#no').val(response.no);
                      $('#prefx').val(response.prefx);

                      $("#id_u").val(response.id_u).trigger("change").trigger("chosen:updated");

                      $('#tgldoc').datepicker("setDate", new Date(response.tgldoc));
                      $('#tglkw').datepicker("setDate", new Date(response.tgl));

                  //    $('#ket').data('tag').add(response.ket);
                          var string = response.ket;
                          var array = string.split(',');
                          $.each(array, function(index, value) {
                              $('#ket').data('tag').add(value.trim());
                              //console.log(value);
                      });

                      debit=addCommas(response.debit)
                      $('#debit').val(debit);
                    }
                  });
                  $('#my-modal').modal('show');
                } else {
                    alert("pilih tabel")
                }
            }
        }).jqGrid('navButtonAdd',pager_selector,{
            caption:"",
            buttonicon:"ace-icon fa fa-plus-circle purple",
            position:"first",
            onClickButton:function(){
              $('#form-1').trigger("reset");
              $('#oper').val('add');

              var postData= {datatb:'norawatjalan', _token:'{{ csrf_token() }}', oper:'pra-add'};
              $.ajax({
                  url: "{{url('/api/kepegawaian/json')}}",
                  data : postData,
                  type: "post",
                  success: function(response){
                      $('#no').val(response.no);
                      $('#prefx').val(response.prefx);
                  }
              });
              $('.tgl').datepicker("setDate", new Date());

              $("#id_u").val('').trigger("chosen:updated");
              $("#id_p").val('').trigger("change").prop('disabled', true).trigger("chosen:updated");

                $('#rj').get(0).setAttribute('disabled' , 'disabled');
                var objTag = $('#ket').data('tag');
                var values = objTag.values;
                for (var i = values.length; i > 0; i--) {
                    objTag.remove(i - 1);
                };
                $('#sisa').html(0);

                $('#my-modal').modal('show');
            }
        })

        // if(!ace.vars['old_ie']) $('#ttgldoc').datetimepicker({
        //   format: 'DD-MM-YYYY h:mm:ss A',//use this option to display seconds
        //   icons: {
        //     time: 'fa fa-clock-o',
        //     date: 'fa fa-calendar',
        //     up: 'fa fa-chevron-up',
        //     down: 'fa fa-chevron-down',
        //     previous: 'fa fa-chevron-left',
        //     next: 'fa fa-chevron-right',
        //     today: 'fa fa-arrows ',
        //     clear: 'fa fa-trash',
        //     close: 'fa fa-times'
        //   },
        // }).next().on(ace.click_event, function(){
        //     $(this).prev().focus();
        // });

        $('#print-pengajuan').click(function() {
          $('#pengajuan').submit();
        });
        $('#print-form').click(function() {
            document.getElementById('form').submit();
        });
        $('#print-bulanan2').click(function() {
            document.getElementById('bulanan2').submit();
        });

        $('#id_u').chosen({allow_single_deselect:true}).change(function(e) {
            selRowId = $(grid_selector).jqGrid ('getGridParam', 'selrow'),
            celValue = $(grid_selector).jqGrid ('getCell', selRowId, 'id_px');
            no = $('#no').val();

            var pasien = $(this).val();
            var postData= {datatb:'pilihpasien', nomor:no, cari: pasien,  _token:'{{ csrf_token() }}'};

            $.ajax({
                url: "{{url('/api/kepegawaian/json')}}",
                data : postData,
                type: "post",
                success: function(response) {
                    $('#id_p').html(response.opt);
                    if (celValue && $('#oper').val()=='edit'){
                      $('#id_p').val(celValue)
                    }
                    $("#id_p").prop('disabled', false).trigger("chosen:updated").trigger("change");

                    var rj = addCommas(response.rj);
                    $('#rj').val(rj);
                    var sisa = response.rj - response.total;
                    sisa = addCommas(sisa);
                    $('#sisa').html(sisa);
                }
            });
        });
        $('#sdate').on('hide',function(ev,date){
          if ($('#jcuti').is(":checked")){
            $.post( "{{url('KepegawaianJson')}}", {
              datatb:'haricuti',
              _token:'{{ csrf_token() }}',
              sdate:$('#sdate').val(),
              edate:$('#edate').val(),
              wkerja:$('#wkerja').val(),
              cari:$('#cari').val(),
            }, function(data,status) {
              $('#pakai').html('- Digunakan '+data['masacuti']+' Hari');
              $('#edate').datepicker('setStartDate',$('#sdate').val())
            })
          }else{
            $('#pakai').html('- Digunakan 0 Hari');
          }
        });

        $('#edate').on('hide',function(ev,date){
          if ($('#jcuti').is(":checked")){
            $.post( "{{url('KepegawaianJson')}}", {
              datatb:'haricuti',
              _token:'{{ csrf_token() }}',
              sdate:$('#sdate').val(),
              edate:$('#edate').val(),
              wkerja:$('#wkerja').val(),
              cari:$('#cari').val(),
            }, function(data,status) {
              $('#pakai').html('- Digunakan '+data['masacuti']+' Hari');
              $('#sdate').datepicker('setEndDate',$('#edate').val())
            })
          }else{
            $('#pakai').html('- Digunakan 0 Hari');
          }
        });

        var tag_input = $('#ket');
        try{
            tag_input.tag({
                placeholder:tag_input.attr('placeholder'),
                //enable typeahead by specifying the source array
                /**source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
                */
                //or fetch data from database, fetch those that match "query"
                source: function(query, process) {
                    var TagData = {datatb:'diagnos', _token:'{{ csrf_token() }}'};
                    $.ajax({
                        url: "{{url('/api/kepegawaian/json')}}",
                        data : TagData,
                        type: "post",
                    }).done(function(response){
                        process(response);
                    });
                }

            })

            //programmatically add a new
            var $tag_obj = $('#ket').data('tag');
            //$tag_obj.add('Programmatically Added');
        } catch(e) {
            //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
            tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
            $('#ket').autosize({append: "\n"});
        }

        $('#id-disable-check').on('click', function() {
            var inp = $('#rj').get(0);
            if(inp.hasAttribute('disabled')) {
                inp.removeAttribute('disabled');
            }
            else {
                inp.setAttribute('disabled' , 'disabled');
            }
        });

        function style_edit_form(form) {
            //enable datepicker on "sdate" field and switches for "stock" field
            form.find('input[name=sdate]').datepicker({format:'yyyy-mm-dd' , autoclose:true})

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
        function styleCheckbox(table) {
        /**
            $(table).find('input:checkbox').addClass('ace')
            .wrap('<label />')
            .after('<span class="lbl align-top" />')


            $('.ui-jqgrid-labels th[id*="_cb"]:first-child')
            .find('input.cbox[type=checkbox]').addClass('ace')
            .wrap('<label />').after('<span class="lbl align-top" />');
        */
        }


        //unlike navButtons icons, action icons in rows seem to be hard-coded
        //you can change them like this in here if you want
        function updateActionIcons(table) {
            /**
            var replacement =
            {
                'ui-ace-icon fa fa-pencil' : 'ace-icon fa fa-pencil blue',
                'ui-ace-icon fa fa-trash-o' : 'ace-icon fa fa-trash-o red',
                'ui-icon-disk' : 'ace-icon fa fa-check green',
                'ui-icon-cancel' : 'ace-icon fa fa-times red'
            };
            $(table).find('.ui-pg-div span.ui-icon').each(function(){
                var icon = $(this);
                var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
                if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
            })
            */
        }

            //replace icons with FontAwesome icons like above
        function updatePagerIcons(table) {
            var replacement = {
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

        function enableTooltips(table) {
            $('.navtable .ui-pg-button').tooltip({container:'body'});
            $(table).find('.ui-pg-div').tooltip({container:'body'});
        }

        //var selr = jQuery(grid_selector).jqGrid('getGridParam','selrow');

        $(document).one('ajaxloadstart.page', function(e) {
            $.jgrid.gridDestroy(grid_selector);
            $('.ui-jqdialog').remove();
        });
    });
</script>
@endsection
