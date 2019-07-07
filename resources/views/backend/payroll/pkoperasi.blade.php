@extends('backend.app_backend')

@section('css')
    <link href="{{ asset('/css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
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


    <form class="form-horizontal form-aktif" id="form-1" method="get">
    <div id="my-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
    <!-- 01 Header Form-->
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h3 class="smaller lighter blue no-margin">Koperasi <span id="uname"></span></h3>
                </div>
            <!-- 01 end heder form-->
            <!-- 02 body Form -->
                        <div class="modal-body">

                          {!! csrf_field() !!}
                          <input type="hidden" id='datatb' name="datatb" value="pkoperasi" />
                          <input type="hidden" id='oper' name="oper" value="" />
                          <input type="hidden" id='id' name="id" value="" />

                          <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">Nama Karyawan :</label>
                            <div class="col-xs-12 col-sm-9">
                              <select id="id_u" name="id_u" class="chosen-select form-control" data-placeholder="Pilih ..." >
                                <option value=""></option>
                              </select>
                            </div>
                          </div><div class="space-2"></div>

                          <div class="form-group">
                              <label class="control-label col-xs-12 col-sm-3 no-padding-right">Tanggal Pinjam :</label>
                              <div class="col-xs-12 col-sm-3">
                                  <div class="clearfix">
                                      <div class="input-group input-group-sm">
                                          <input type="text" id="tglpinjam" name="tglpinjam" class="tgl" value="" />
                                          <span class="input-group-addon"><i class="ace-icon fa fa-calendar"></i></span>
                                      </div>
                                  </div>
                              </div>
                          </div><div class="space-2"></div>

                          <div class="form-group">
                              <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Jumlah</label>
                              <div class="col-xs-12 col-sm-9">
                                  <div class="clearfix"><input type="text" id="jml" name="jml" value="" class="col-xs-12 col-sm-5" onkeyup="formatNumber(this);" onchange="formatNumber(this);"/></div>
                              </div>
                          </div><div class="space-2"></div>
                          <div class="form-group">
                              <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Jml+Bunga</label>
                              <div class="col-xs-12 col-sm-9">
                                  <div class="clearfix"><input type="text" id="jmlb" name="jmlb" value="" class="col-xs-12 col-sm-5" onkeyup="formatNumber(this);" onchange="formatNumber(this);"/></div>
                              </div>
                          </div><div class="space-2"></div>
                          <div class="form-group">
                              <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Tenor</label>
                              <div class="col-xs-12 col-sm-9">
                                  <div class="clearfix"><input type="text" id="tenor" name="tenor" value="" class="col-xs-12 col-sm-5"/></div>
                              </div>
                          </div><div class="space-2"></div>
                        </div>
    <!-- 02 end body Form -->
    <!-- 03 footer Form -->
                <div class="modal-footer">
                    <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                        <i class="ace-icon fa fa-times"></i>Close
                    </button>
                    <button  class="btn btn-sm btn-danger pull-right" id='save' type="button">
                        <i class="ace-icon fa fa-floppy-o"></i>Save
                    </button>
                </div>
    <!-- 03 end footer Form -->
            </div>
        </div><!-- /.modal-dialog -->
    </div>
    </form>
    <!-- end Form -->
    <div align="center">Data Pinjaman koperasi<br />PT. PELABUHAN CILEGON MANDIRI<br />
        Priode : <?php echo '<span class="editable" id="psdate">16 '.date('F Y', strtotime('-1 month')).'</span> s.d. <span class="editable" id="pedate">15 '.date('F Y').'</span>';  ?></div><br />

            <div class="row">
              <div class="col-xs-3">
                <select id="id_u_f" name="id_u_f" class="chosen-select form-control" data-placeholder="Pilih Nama ..." >
                    <option value=""></option>
                </select>
              </div>
            </div>

            <table id="grid-table"></table>
            <div id="grid-pager"></div>

            <!-- <object data="http://localhost/simpeg/public/files/tmp/data_pegawai.pdf" type="application/pdf" width="100%">
                <embed src="http://localhost/simpeg/public/files/tmp/data_pegawai.pdf" type="application/pdf" />
            </object> -->
            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('js')
    <script src="{{ asset('/js/jquery-ui.min.js') }}"></script>

    <script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.jqGrid.min.js') }}"></script>
    <script src="{{ asset('/js/grid.locale-en.js') }}"></script>

    <script src="{{ asset('/js/bootstrap-editable.min.js') }}"></script>
    <script src="{{ asset('/js/ace-editable.min.js') }}"></script>
    <script src="{{ asset('/js/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-tag.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>


<script type="text/javascript">

  jQuery(function($) {
    $('#id_u_f').chosen({allow_single_deselect:true}).change(function(e) {
        var id_u = $(this).val();
        //$('input[name="lokasi"]').val(lokasi);

        $(grid_selector).jqGrid('setGridParam',{postData:{id_u:id_u}}).trigger("reloadGrid");
        //alert(lokasi);
    });

    var posdata= {'datatb':'pegawai'};
    getparameter(site+'/api/kepegawaian/json',posdata,function(data){
      //$('#idtrx').val(data.member);
      var $select_elem = $("#id_u_f");
      $select_elem.empty();

      $select_elem.append('<option value=""></option>');

      $.each(data.member, function (idx, obj) {
        $select_elem.append('<option value="' + idx + '">' + obj + '</option>');
      });

      $select_elem.trigger("chosen:updated");
    });

    var inx = [];
    var posdata= {'datatb':'pegawai'};
    getparameter(site+'/api/kepegawaian/json',posdata,function(data){
      //$('#idtrx').val(data.member);
      var $select_elem = $("#id_u");
      $select_elem.empty();

      $select_elem.append('<option value=""></option>');

      $.each(data.member, function (idx, obj) {
        $select_elem.append('<option value="' + idx + '">' + obj + '</option>');
        //inx.push(obj);
        inx['"'+obj+'"'] = idx;
      });

      $select_elem.trigger("chosen:updated");

    });

    $('#save').click(function() {
      var posdata = $("#form-1").serialize();

      getparameter2(site+'/api/payroll/cud',posdata,function(data){
        var newHTML = '<i class="ace-icon fa fa-floppy-o"></i>Save';
        $('#save').html(newHTML);

        $('#form-1').trigger("reset");
        $('#my-modal').modal('hide');
        $(grid_selector).trigger("reloadGrid");
      },function(data){
        var newHTML = '<i class="ace-icon fa fa-spinner fa-spin "></i>Loading...';
        $('#save').html(newHTML);
      });
    });

    $('#tglpinjam').datepicker({format:'dd MM yyyy', viewformat: 'dd MM yyyy', autoclose:true});

    var start = $('#psdate').html();
    var end = $('#pedate').html();
    $('input[name="start"]').val(start);
    $('input[name="end"]').val(end);

    var setdate = start;

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

    var grid_selector = "#grid-table";
    var pager_selector = "#grid-pager";

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
            caption: "Data Karyawan",
            datatype: "json",            //supported formats XML, JSON or Arrray
            url:"{{url('/api/payroll/jqgrid')}}",
            editurl: "{{url('/api/payroll/cud')}}",
            mtype : "post",
            sortname:'tglapp',
            sortorder: 'desc',
            postData: {datatb:'pkoperasi', start:start, end:end, _token:'{{ csrf_token() }}'},

            height: 250,
            colNames:['NIK','idu','Nama','Tgl. Pinjam','Pinjaman','Pjm+Bunga','Tenor', 'Angsuran','S.Tenor','S.Angsuran'],
            colModel:[
                {name:'nip',index:'nip', width:50, align:'center' },
                {name:'idu',index:'idu', hidden: true},
                {name:'nama',index:'nama', width:100  },
                {name:'tglp',index:'tglp', width:70, sortable:false, editable: true, align:'center' },
                {name:'jml',index:'jml', width:70, sortable:false, editable: true, align: 'right', formatter: 'number',
                    formatoptions: { thousandsSeparator: ",", decimalPlaces: 0, defaultValue: '0' }
                },
                {name:'jmlb',index:'jmlb', width:70, sortable:false, editable: true, align: 'right', formatter: 'number',
                    formatoptions: { thousandsSeparator: ",", decimalPlaces: 0, defaultValue: '0' }
                },
                {name:'tenor',index:'tenor', width:40, sortable:false, editable: true, align:'center' },
                {name:'angsuran',index:'angsuran', width:70, sortable:false, editable: true, align: 'right', formatter: 'number',
                    formatoptions: { thousandsSeparator: ",", decimalPlaces: 0, defaultValue: '0' }
                },
                {name:'st',index:'st', width:40, sortable:false, editable: false, align:'center' },
                {name:'sa',index:'sa', width:70, sortable:false, editable: true, align: 'right', formatter: 'number',
                    formatoptions: { thousandsSeparator: ",", decimalPlaces: 0, defaultValue: '0' }
                },
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
              $('.pdf').each(function() {
                $(this).mouseover(function() {
                  $(this).addClass('fa-lg').css("text-shadow", "0 0 #FF0000");
                }).mouseout(function() {
                    $(this).removeClass('fa-lg').css("text-shadow", "");
                }).click(function(e) {
                    var rowid = $(e.target).closest("tr.jqgrow").attr("id");
                    var posdata = {category:'biodatapegawai',karyawan:rowid,_token:'{{csrf_token()}}'};
                    getparameter2("{{url('/PDF_Kepegawaian')}}",posdata,
                      function(data){
                        $("#loading").modal('hide');
                        window.open("{{ url('/public/files/tmp') }}/"+data.nfile+".pdf");
                      },
                      function(data){
                        $("#loading").modal();
                      },
                    );

                  return false;
                });
              //   title: "Custom",
              });

              //$(_tr).addClass("ui-state-error");
              var rowid = $(this).jqGrid('getDataIDs');
              var gridData = $(this).jqGrid('getRowData');

              // for(var i=0; i<gridData.length; i++) {
              //     //alert(data.rows[i].cell[5]);
              //     var tgl_keluar = data.rows[i].cell[6];
              //
              //     if (tgl_keluar!=null && tgl_keluar!=0) {
              //         $('#'+rowid[i]).css("background", "pink");;
              //     //    alert(rowid[i]);
              //     }
              //
              // }

              var table = this;
              setTimeout(function(){
                  styleCheckbox(table);

                  updateActionIcons(table);
                  updatePagerIcons(table);
                  enableTooltips(table);
              }, 0);
            },
            onCellSelect: function(row, col, content, event) {
              // var cm = $(this).jqGrid("getGridParam", "colModel");
              // if (cm[col].name == 'pdf'){
              //   var posdata = {category:'biodatapegawai',karyawan:row,_token:'{{csrf_token()}}'};
              //   getparameter2("{{url('/PDF_Kepegawaian')}}",posdata,
              //     function(data){
              //       $("#loading").modal('hide');
              //       window.open("{{ url('/public/files/tmp') }}/"+data.nfile+".pdf");
              //     },
              //     function(data){
              //       $("#loading").modal();
              //     },
              //   );
              // }
            },
            beforeSelectRow: function (rowid, e) {
              //var iCol = $(this).getCellIndex(e.target);

              // var posdata = {category:'biodatapegawai',karyawan:rowid,_token:'{{csrf_token()}}'};
              // getparameter2("{{url('/PDF_Kepegawaian')}}",posdata,
              //   function(data){
              //     $("#loading").modal('hide');
              //     window.open("{{ url('/public/files/tmp') }}/"+data.nfile+".pdf");
              //   },
              //   function(data){
              //     $("#loading").modal();
              //   },
              // );
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
            del: true,
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
            position:"last",
            beforeShowForm : function(e) {
                var form = $(e[0]);
                if(form.data('styled')) return false;

                form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                style_delete_form(form);

                form.data('styled', true);
            },
            onClick : function(e) {
                //alert(1);
            },
            onclickSubmit: function () {
              return { datatb:'pkoperasi', _token:'{{csrf_token()}}'};
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

              if(gsr){
                var name = $(this).jqGrid ('getCell', gsr, 'nama');
                $('#uname').html(name);

                // alert(JSON.stringify(inx['"'+name+'"']));
                $('#id_u').val(inx['"'+name+'"']).trigger("change").trigger("chosen:updated");
                $('#tglpinjam').datepicker("setDate", new Date($(this).jqGrid ('getCell', gsr, 'tglp')));
                $('#jml').val(addCommas($(this).jqGrid ('getCell', gsr, 'jml')));
                $('#jmlb').val(addCommas($(this).jqGrid ('getCell', gsr, 'jmlb')));
                $('#tenor').val(addCommas($(this).jqGrid ('getCell', gsr, 'tenor')));
                $('#id').val(gsr);
                $('#oper').val('edit');

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
              $('#uname').html('');
              $("#id_u").val('').trigger("chosen:updated");
              $('#tglpinjam').datepicker("setDate", new Date());
              $('#id_u').chosen({allow_single_deselect:true}).change(function(e) {

              });
              $('#my-modal').modal('show');
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
