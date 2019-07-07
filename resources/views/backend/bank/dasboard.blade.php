<?php date_default_timezone_set('Asia/Jakarta')?>
@extends('backend.app_backend')

@section('css')
    <!-- page specific plugin styles -->
    <link href="{{ asset('/css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/moment.min.js') }}"></script>
    <link href="{{ asset('/css/ui.jqgrid.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/css/chosen.min.css') }}" rel="stylesheet">

    <style type="text/css">

      .ui-search-table input {
        width: 100%;
        height: 100%;
      }
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

    <div class="page-header">
        <h1>
            Data Transaksi
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                List Transaksi Harian
            </small>
        </h1>
    </div><!-- /.page-header -->
    @component('backend.bank.addform1')
        <strong>Whoops!</strong> Something went wrong!
    @endcomponent


    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->

            <table id="grid-table"></table>

            <div id="grid-pager"></div>

            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row">

    </div>
@endsection

@section('js')
    <!-- page specific plugin scripts -->
    <script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.jqGrid.min.js') }}"></script>
    <script src="{{ asset('/js/grid.locale-en.js') }}"></script>

    <script src="{{ asset('/js/chosen.jquery.min.js') }}"></script>

<!-- inline scripts related to this page -->
   <script type="text/javascript">


      jQuery(function($) {
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
        /**
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
        */

          jQuery(grid_selector).jqGrid({
            caption: "Data Transaksi",
            datatype: "json",            //supported formats XML, JSON or Arrray
            url:"{{url('api/bank/jqgrid')}}",
            editurl: "{{url('MasterParameterSave')}}",//nothing is saved
            mtype : "post",
            postData: {datatb:'datatrx', _token:'{{ csrf_token() }}'},
            sortname:'notrx',
            sortorder: 'asc',

            colNames:[' ', 'ID TRX','Kode','Tanggal','Member','Uraian','saldo awal','Setor','Tarik','saldo akhir'],
            colModel:[
              {name:'myac',index:'', width:80, fixed:true, sortable:false, resize:false, search: false,
                formatter:'actions',
                formatoptions:{
                  keys:true,
                  //delbutton: false,//disable delete button

                  delOptions:{recreateForm: true, beforeShowForm:beforeDeleteCallback},
                  //editformbutton:true, editOptions:{recreateForm: true, beforeShowForm:beforeEditCallback}
                }
              },
              {name:'notrx',index:'notrx', width:40, sorttype:"int", editable: true, },
              {name:'kodetrx',index:'kodetrx',width:40, editable:true, },
              {name:'tanggal',index:'tanggal', width:90,editable: true, searchoptions: {
                dataInit:function(el){
                  $(el).datepicker({
                    format:'dd-mm-yyyy' , autoclose:true, locale: 'id',
                  }).on('changeDate', function(e) {

                  var posisi;
                  wht = $(grid_selector).getGridParam("postData");
                  if (wht.filters) {
                    wht2 = JSON.parse(wht.filters);
                    if (wht2.rules.length == 0){
                      wht2.rules.push({"field":"tanggal","op":"cn","data": $(this).val() });
                    }else{
                      //cek variabel ready or not//
                      for(var i = 0; i < wht2.rules.length; ++i){

                        if (wht2.rules[i]['field'] == 'tanggal'){
                          posisi = i;
                        }
                      }
                      if (posisi){
                        alert('tidak ada');
                        wht2.rules.push({"field":"tanggal","op":"cn","data": $(this).val() });
                      } else {
                        wht2.rules[posisi].data=$(this).val();
                      }
                    }

                    cari = JSON.stringify(wht2.rules);
                    $(grid_selector).jqGrid('setGridParam',{
                      search:true,
                      postData:{ filters:'{"groupOp":"AND","rules":'+cari+'}' }
                    }).trigger("reloadGrid");

                  } else {
                    $(grid_selector).jqGrid('setGridParam',{
                      search:true,
                      postData:{ filters:'{"groupOp":"AND","rules":[{"field":"tanggal","op":"cn","data":"'+$(this).val()+'"}]}'}
                    }).trigger("reloadGrid");
                  }
                });
              }
            }},

            {name:'name',index:'name', width:60,editable: true},
            {name:'uraian',index:'uraian', width:150, editable: true},
            {name:'saldoa',index:'saldoa', width:40, sortable:false, editable: false, search: false},
            {name:'setor',index:'setor', width:40, sortable:false, editable: true, search: false},
            {name:'tarik',index:'tarik', width:40, sortable:false, editable: true, search: false},
            {name:'saldob',index:'saldob', width:40, sortable:false, editable: false, search: false}

          ],
          height: 250,
          viewrecords : true,
          rowNum:10,
          rowList:[10,20,30],
          pager : pager_selector,
          altRows: true,
          //toppager: true,

          //multiselect: true,
          //multikey: "ctrlKey",
          multiboxonly: true,

          loadComplete : function() {
            var table = this;
            setTimeout(function(){
              styleCheckbox(table);

              updateActionIcons(table);
              updatePagerIcons(table);
              enableTooltips(table);
            }, 0);
          },
          onSelectRow: function(rowid, e) {
            // selRowId = $(this).jqGrid ('getGridParam', 'selrow');
            // celValue = $(this).jqGrid ('getCell', selRowId, 'status');
            // scrollP = $(this).closest(".ui-jqgrid-bdiv").scrollTop();
            //alert(scrollP);

            return false;
          },

          //,autowidth: true,


          /**
          ,
          grouping:true,
          groupingView : {
               groupField : ['name'],
               groupDataSorted : true,
               plusicon : 'fa fa-chevron-down bigger-110',
               minusicon : 'fa fa-chevron-up bigger-110'
          },
          caption: "Grouping"
          */

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

        if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
          format: 'DD-MM-YYYY h:mm:ss A',//use this option to display seconds
          icons: {
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar',
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down',
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-arrows ',
            clear: 'fa fa-trash',
            close: 'fa fa-times'
          },
        }).next().on(ace.click_event, function(){
            $(this).prev().focus();
        });

          //navButtons
          jQuery(grid_selector).jqGrid('navGrid',pager_selector,
          {   //navbar options
            edit: false,
            editicon : 'ace-icon fa fa-pencil blue',
            add: false,
            addicon : 'ace-icon fa fa-plus-circle purple',
            del: true,
            delicon : 'ace-icon fa fa-trash-o red',
            search: true,
            searchicon : 'ace-icon fa fa-search orange',
            refresh: false,
            refreshicon : 'ace-icon fa fa-refresh green',
            view: true,
            viewicon : 'ace-icon fa fa-search-plus grey',
          },
          {
            //edit record form
            //closeAfterEdit: true,
            //width: 700,
            recreateForm: true,
            beforeShowForm : function(e) {
              var form = $(e[0]);
              form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
              style_edit_form(form);
            }
          },
          {
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
          },
          {
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
          },
          {
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
          },
          {
              //view record form
              recreateForm: true,
              beforeShowForm: function(e){
                  var form = $(e[0]);
                  form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />');
              }
          }).jqGrid('navButtonAdd',pager_selector,{
              keys: true,
              caption:"",
              buttonicon:"ace-icon fa fa-pencil blue",
              position:"first",
              onClickButton:function(){
                $('#form-1').trigger("reset");

                var gsr = $(this).jqGrid('getGridParam','selrow');

                var posdata = {'datatb':'member'}
                getparameter("{{url('/api/bank/json')}}",posdata,function(data){
                  //$('#idtrx').val(data.member);
                  var $select_elem = $("#member");
                  $select_elem.empty();
                  $select_elem.append('<option value=""></option>');
                  $.each(data.member, function (idx, obj) {
                    $select_elem.append('<option value="' + idx + '">' + obj + '</option>');
                  });
                  $select_elem.trigger("chosen:updated");

                });
                if(gsr){
                  var posdata= {'datatb':'loadtrx','idtrx':gsr};
                  getparameter("{{url('/api/bank/json')}}",posdata,function(data){
                    $('#oper').val('edit');
                    $('#id').val(gsr);
                    $('#notrx').val(data.notrx);
                    $("#kode").val(data.kode).prop('disabled', false).trigger("chosen:updated");
                    $('#date').datepicker({format:'dd MM yyyy', viewformat: 'dd MM yyyy', autoclose:true}).datepicker("setDate", data.tanggal).prop('disabled', true);

                    $('#date-timepicker1').val(data.tanggal);
                    $("#member").val(data.member).trigger("chosen:updated");
                    $('#uraian').val(data.uraian);
                    $('#nilai').val(data.nilai).get(0).removeAttribute('disabled');;
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

              var posdata = {'datatb':'newinput'}
              getparameter("{{url('/api/bank/json')}}",posdata,function(data){
                $('#idtrx').val(data.newid);
              });

              var posdata = {'datatb':'member'}
              getparameter("{{url('/api/bank/json')}}",posdata,function(data){
                //$('#idtrx').val(data.member);
                var $select_elem = $("#member");
                $select_elem.empty();
                $select_elem.append('<option value=""></option>');
                $.each(data.member, function (idx, obj) {
                  $select_elem.append('<option value="' + idx + '">' + obj + '</option>');
                });
                $select_elem.trigger("chosen:updated");
                $select_elem.chosen({allow_single_deselect:true}).change(function(e) {
                  $("#kode").trigger("change").prop('disabled', false).trigger("chosen:updated");
                });
              });


              $("#kode").val('').trigger("change").prop('disabled', true).trigger("chosen:updated");
              $("#kode").chosen({allow_single_deselect:true}).change(function(e) {
                $('#nilai').get(0).removeAttribute('disabled');
              });
              $('#date').datepicker({format:'dd MM yyyy', viewformat: 'dd MM yyyy', autoclose:true}).datepicker("setDate", '{{date("d F Y")}}').prop('disabled', false);

              $('#date-timepicker1').val('{{date("d-m-Y g:i:s A")}}');

              $('#nilai').get(0).setAttribute('disabled' , 'disabled');

              $('#oper').val('add');
              $('#my-modal').modal('show');

            }
          }).jqGrid('navButtonAdd',pager_selector,{
              caption:"",
              buttonicon:"ace-icon fa fa-refresh green",
              position:"last",
              onClickButton:function(){
                $(this).trigger("reloadGrid", [{current:true}]);
             }
          }).jqGrid('filterToolbar',{stringResult: true, searchOnEnter : false, defaultSearch : "cn", autosearch:true});

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
