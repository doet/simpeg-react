<link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.min.css') }}" />

<div id="modal" class="modal fade" tabindex="-1">
	<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<!-- 01 Header -->
				<form id="form">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 class="smaller lighter blue no-margin">Form Laporan </h3>
					</div>
					<!-- 01 end heder -->
					<!-- 02 body -->
					<div class="modal-body">
						{{ csrf_field() }}
						<!-- <input type="hidden" name="datatb" value="keluarga" />
						<input type="hidden" id='oper-1' name="oper" value="add" />
						<input type="hidden" id='id-1' name="id" value="id" /> -->
						<div class="row">
							<div class="col-xs-12 col-sm-6">
                <div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">User</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
                        <div class="profile-info-value">
                          <select id="users" class="multiselect" name='user[]' multiple disabled>
                            <option value=""></option>
                          </select>
                        </div>
                      </div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>

              </div>
							<div class="col-xs-12 col-sm-6">

              </div>
						</div>

					</div>
					<!-- 02 end body -->

					<!-- 03 footer -->
					<div class="modal-footer">
						<button class="btn btn-sm btn-danger pull-right" id='save' disabled>
								<i class="ace-icon fa fa-floppy-o"></i>Save
						</button>
						<button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
								<i class="ace-icon fa fa-times"></i>Close
						</button>
					</div>
					<!-- 03 end footer Form -->
				</form>
			</div>
		</div>
</div><!-- /.modal-dialog -->

<table id="table"></table>
<div id="pager"></div>

<script src="{{ asset('/js/bootstrap-multiselect.min.js') }}"></script>
<script type="text/javascript">
  jQuery(function($) {
    $('.multiselect').multiselect({
			enableFiltering: true,
			enableHTML: true,
			buttonClass: 'btn btn-white btn-primary',
			templates: {
				button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown"><span class="multiselect-selected-text"></span> &nbsp;<b class="fa fa-caret-down"></b></button>',
				ul: '<ul class="multiselect-container dropdown-menu"></ul>',
				filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
				filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default btn-white btn-grey multiselect-clear-filter" type="button"><i class="fa fa-times-circle red2"></i></button></span>',
				li: '<li><a tabindex="0"><label></label></a></li>',
				divider: '<li class="multiselect-item divider"></li>',
				liGroup: '<li class="multiselect-item multiselect-group"><label></label></li>'
			},
			onChange: function(option, checked, select) {
        // console.log(option);
      // 	postsave = {datatb:'bstdo',id:option.val(),checked:checked,bstdo:$('#NoBSTDO').html()};
			// 	getparameter("{{url('/api/oprasional/cud')}}",postsave,	function(data){
			// 		$(grid_selector).jqGrid('setGridParam',{postData:{bstdo:$('#NoBSTDO').html()}}).trigger("reloadGrid");
			// 	},function(data){});
        $('#save').removeAttr('disabled');
	    }
		});

    var posdata= {'datatb':'users', _token:'{{ csrf_token() }}'};
    var $select_elem = $("#users");
    $select_elem.html('');
    getparameter("{{url('/api/masterdata/json')}}",posdata,function(data){
      $.each(data, function (idx, obj) {
        $select_elem.append('<option value="'+data[idx].id+'">'+data[idx].name+'</option>');
      });
      $select_elem.multiselect('rebuild');
    },function(data){});

    var postsave={};
		postsave.url = "{{url('/api/masterdata/cud')}}";
		postsave.grid = '#table';
		postsave.modal = '#modal';
		$('#save').click(function(e) {
			e.preventDefault();
			postsave.post += $("#form").serialize()+'&datatb=mamenu';
			saveGrid(postsave);
      postsave.post = '';
		});

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
      caption: "Akse Menu",
      datatype: "json",            //supported formats XML, JSON or Arrray
      mtype : "post",
      url:"{{url('api/masterdata/jqgrid')}}",
      editurl: "{{url('api/masterdata/cud')}}",//nothing is saved
      // serializeRowData:function(postdata,ids) {
      //     postdata.datatb = 'nilai';
      //     postdata.grup = 'jabatan';
      //     postdata._token = '<?php echo csrf_token();?>';
      //     return postdata;
      // },
      postData: {datatb:'mamenu', _token:'{{ csrf_token() }}'},
      sortname:'id',
      sortorder: 'desc',
      height: 250,
      colNames:['id', 'label','User','User Id'],
      colModel:[
        {name:'id',index:'id', width:30, editable: true},
        {name:'label',index:'label', width:90, editable: true},
        {name:'user',index:'user', width:90, editable: true},
        {name:'userid',index:'userid', width:90, editable: true}
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
      closeAfterEdit: true,
      //width: 700,
      recreateForm: true,
      beforeShowForm : function(e) {
        var form = $(e[0]);
        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
        style_edit_form(form);
      },
      onclickSubmit: function () {
        // return { datatb:'mlibur', grup:'jabatan', _token:'<?php echo csrf_token();?>'};
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
        // return { datatb:'mlibur', grup:'jabatan', _token:'<?php echo csrf_token();?>'};
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
        // return { datatb:'mlibur', grup:'jabatan', _token:'<?php echo csrf_token();?>'};
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
    }).jqGrid('navButtonAdd',pager_tabel,{
				keys: true,
				caption:"",
				buttonicon:"ace-icon fa fa-pencil blue",
				position:"first",
				onClickButton:function(){
					$('#form').trigger("reset");

          // if (!empty(user))user='';
          // console.log($select_elem);
          console.log('');
          $select_elem.multiselect('deselectAll', false);
          $select_elem.multiselect('updateButtonText')
          $select_elem.multiselect('rebuild');

          $('#save').attr('disabled','disabled');
					var gsr = $(this).jqGrid('getGridParam','selrow');
					if(gsr){
            var userid = $(this).jqGrid('getCell',gsr,'userid').split(",");
            $select_elem.multiselect('select', userid);
            postsave.post ='';
            postsave.post = 'oper=edit&id='+gsr+'&';

						$('#modal').modal('show');
					} else {
						alert("pilih tabel")
					}
				}
		})

    //var selr = jQuery(tabel).jqGrid('getGridParam','selrow');

    $(document).one('ajaxloadstart.page', function(e) {
      $(tabel).jqGrid('GridUnload');
      $('.ui-jqdialog').remove();
    });
  });
</script>
