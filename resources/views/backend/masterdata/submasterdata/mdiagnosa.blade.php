<table id="table"></table>
<div id="pager"></div>

<script type="text/javascript">
  jQuery(function($) {
    var tabel = "#table";
    var pager_tabel = "#pager";

    //resize to fit page size
    $(window).on('resize.jqGrid', function () {
        $(tabel).jqGrid( 'setGridWidth', $(".page-content").width() );
    })

    //resize on sidebar collapse/expand
    var parent_column = $(tabel).closest('[class*="col-"]');
    $(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
        if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
            //setTimeout is for webkit only to give time for DOM changes and then redraw!!!
            setTimeout(function() {
                $(tabel).jqGrid( 'setGridWidth', parent_column.width() );
            }, 0);
        }
    })

    //if your grid is inside another element, for example a tab pane, you should use its parent's width:
    $(window).on('resize.jqGrid', function () {
        var parent_width = $(tabel).closest('.tab-pane').width();
        $(tabel).jqGrid( 'setGridWidth', parent_width );
    })
    //and also set width when tab pane becomes visible
    $('#myTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      if($(e.target).attr('href') == '#mygrid') {
        var parent_width = $(tabel).closest('.tab-pane').width();
        $(tabel).jqGrid( 'setGridWidth', parent_width );
      }
    })

    var master = jQuery(tabel).jqGrid({
      caption: "Diagnosa Penyakit",
      datatype: "json",            //supported formats XML, JSON or Arrray
      mtype : "post",
      url:"{{url('api/masterdata/jqgrid')}}",
      editurl: "{{url('api/masterdata/cud')}}",//nothing is saved
      // serializeRowData:function(postdata,ids) {
      //   postdata.datatb = 'nilai';
      //   postdata.grup   = 'jabatan';
      //   postdata._token = '<?php echo csrf_token();?>';
      //   return postdata;
      // },
      postData: {datatb:'diagnos', _token:'{{ csrf_token() }}'},
      sortname:'id',
      sortorder: 'desc',
      height: 250,
      colNames:[' ', 'id', 'label'],
      colModel:[
        {name:'myac',index:'', width:70, fixed:true, sortable:false, resize:false,
          formatter:'actions',
          formatoptions:{
            keys:true,
            delbutton: true,//disable delete button

            delOptions:{recreateForm: true, beforeShowForm:beforeDeleteCallback},
            //editformbutton:true, editOptions:{recreateForm: true, beforeShowForm:beforeEditCallback}
          }
        },
        {name:'vid',index:'vid', width:90, editable: false},
        {name:'keterangan',index:'keterangan', width:90, editable: true}
      ],

      viewrecords : true,
      rowNum      : 10,
      rowList     : [10,20,30],
      pager       : pager_tabel,
      altRows     : true,
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
    });
    $(window).triggerHandler('resize.jqGrid');//trigger window resize to make the grid get the correct size

    //enable search/filter toolbar
    //jQuery(tabel).jqGrid('filterToolbar',{defaultSearch:true,stringResult:true})
    //jQuery(tabel).filterToolbar({});

    //navButtons
    jQuery(tabel).jqGrid('navGrid',pager_tabel, {   //navbar options
      edit: true,
      editicon : 'ace-icon fa fa-pencil blue',
      add: true,
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
        return { datatb:'diagnos', _token:'<?php echo csrf_token();?>'};
      }
    },{
      //new record form
      //width: 700,
      closeAfterAdd: true,
      recreateForm: true,
      viewPagerButtons: false,
      beforeShowForm : function(e) {
        var form = $(e[0]);
        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
        style_edit_form(form);
      },
      onclickSubmit: function () {
        return { datatb:'diagnos', _token:'<?php echo csrf_token();?>'};
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
        return { datatb:'diagnos', _token:'<?php echo csrf_token();?>'};
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
      },
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
      })


      //var selr = jQuery(tabel).jqGrid('getGridParam','selrow');

      $(document).one('ajaxloadstart.page', function(e) {
        $(tabel).jqGrid('GridUnload');
        $('.ui-jqdialog').remove();
      });
    });
  </script>
