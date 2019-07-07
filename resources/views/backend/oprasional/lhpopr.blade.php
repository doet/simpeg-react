@extends('backend.app_backend')

@section('css')
	<!-- page specific plugin styles -->
	<link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}" />
	<link href="{{ asset('/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/daterangepicker.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/ui.jqgrid.min.css') }}" />

	<link href="{{ asset('/css/bootstrap-editable.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/bootstrap-multiselect.min.css') }}" rel="stylesheet">

	<link href="{{ asset('/css/chosen.min.css') }}" rel="stylesheet">
	<style>
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
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Tunda On/Off</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-9" type="text" id="tundadate" name="tundadate" ></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">PC On/Off</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-9" type="text" id="pcdate" name="pcdate" ></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">BAPP</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm" type="text" id="bapp" name="bapp"></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>

							</div>
						</div>

					</div>
					<!-- 02 end body -->

					<!-- 03 footer -->
					<div class="modal-footer">
						<button class="btn btn-sm btn-danger pull-right" id='save'>
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

      <div class="row">
        <div class="col-xs-12">
          <!-- PAGE CONTENT BEGINS -->

					<div align="center">L H P<br />
							<span class="editable" id="psdate"></span>
					</div>
					</br>
					<form id="dompdf" role="form" method="POST" action="{{ url('oprasional/PDFAdmin') }}" target="_blank">
						{!! csrf_field() !!}
						<input name="page" value="" hidden/>
						<input name="file" value="" hidden/>
						<input name="start" value="" hidden/>
						<input name="sidx" value="" hidden/>
						<input name="ext1" value="" hidden/>
					</form>
					<div class="row">
						<div class="col-xs-12 col-sm-3">
							<div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right">List</label>

								<div class="col-xs-12 col-sm-9">
									<select id="ppjk" class="multiselect" multiple="">
										<option value=""></option>
									</select>
								</div>
							</div>
						</div>
					</diV>

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
	<script src="{{ asset('/js/daterangepicker.min.js') }}"></script>

	<script src="{{ asset('js/jquery.jqGrid.min.js') }}"></script>
	<script src="{{ asset('js/grid.locale-en.js') }}"></script>

	<script src="{{ asset('js/bootstrap-multiselect.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap-editable.min.js') }}"></script>
	<script src="{{ asset('/js/ace-editable.min.js') }}"></script>

	<script src="{{ asset('/js/chosen.jquery.min.js') }}"></script>

<script type="text/javascript">

	jQuery(function($) {
		//editables on first profile page
    $.fn.editable.defaults.mode = 'inline';
    $.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
                                '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';

		var setdate = moment().format('D MMMM YYYY');
		$('#psdate').html(moment().format('D MMMM YYYY'));
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
        $(grid_selector).jqGrid('setGridParam',{postData:{lhp:params.newValue}}).trigger("reloadGrid");
				// console.log(params.newValue);
        setdate = params.newValue;
				get_ppjk(setdate);
    });

		if(!ace.vars['touch']) {
			$('.chosen-select').chosen({
				allow_single_deselect:true,
			});
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
		};

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
				postsave = {datatb:'lhp',id:option.val(),checked:checked,lhp:setdate};
				getparameter("{{url('/api/oprasional/cud')}}",postsave,	function(data){
					$(grid_selector).jqGrid('setGridParam',{postData:{bstdo:setdate}}).trigger("reloadGrid");
				},function(data){});
	    }
		});

/////////////////////////////////////////////////
////////////////////////// combobox select
		function get_ppjk(setdate){
			var posdata= {'datatb':'ppjk', _token:'{{ csrf_token() }}',lhp_date:setdate};
			var $select_elem = $("#ppjk");
			// $select_elem.empty();
			$select_elem.html('');
			getparameter("{{url('/api/oprasional/json')}}",posdata,function(data){
				// console.log(data);
				$.each(data, function (idx, obj) {
					if (data[idx].lhp === null){
						var selected = '';
					} else {
						selected = 'selected';
					}

					if ((moment(setdate, "D MMMM YYYY") == data[idx].lhp+'000') || (data[idx].lhp === null)){
						$select_elem.append('<option value="'+data[idx].id+'" '+selected+'>'+data[idx].ppjk+'</option>');
					}
				});

				$select_elem.multiselect('rebuild');
			},function(data){});
		}

		get_ppjk(setdate);

		var postsave={};
		postsave.url = "{{url('/api/oprasional/cud')}}";
		postsave.grid = '#grid-table';
		postsave.modal = '#modal';
		$('#save').click(function(e) {
			e.preventDefault();
			postsave.post += $("#form").serialize()+'&datatb=lhp2';
			// console.log(postsave);
			saveGrid(postsave);
		});
//////////////////////////////////////////

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
			caption: "Laporan",
      datatype: "json",            //supported formats XML, JSON or Arrray
      mtype : "post",
      postData: {datatb:'dl',lhp:setdate,_token:'{{ csrf_token() }}'},
			url:"{{url('/api/oprasional/jqgrid')}}",
			editurl: "{{url('/api/oprasional/cud')}}",//nothing is saved
			sortname:'date',
			sortorder: 'desc',
			height: 'auto',
			colNames:[' ', 'PPJK','AGEN','Date','Kapal','GRT','LOA','Bendera','Dermaga','OPS','BAPP','PC','ON','OFF','Tunda','ON','OFF','DD','Ket','Rute','LSTP','lstpx',"ppjks_id"],
			colModel:[
				{name:'tb_dls.id',index:'tb_dls.id', width:50, fixed:true, sortable:true, resize:false, align: 'center'},
				{name:'ppjk',index:'ppjk', width:55, sorttype:"int", editable: false},
				{name:'agenCode',index:'agenCode',width:45, editable:false, align: 'center'},
				{name:'date',index:'date', width:120,editable: false},
				{name:'kapalsName',index:'kapalsName', width:150, editable: false},
				{name:'grt',index:'grt', width:50, editable: false, align: 'right'},
				{name:'loa',index:'loa', width:50, editable:false, align: 'right'},
				{name:'bendera',index:'bendera', width:80, editable: false},
        {name:'jettyName',index:'jettyName', width:100, editable: false},
        {name:'ops',index: 'ops', width: 60,editable: false, align: 'center'},
				{name:'bapp',index:'bapp',width:50, editable: true, align: 'center'},
        {name:'pc',index: 'pc', width: 40, editable: false, align: 'center'},
				{name:'on',index:'on',width:40, editable: false},
				{name:'off',index:'off',width:40, editable: false},
        {name:'tunda',index:'tunda',width:100, sortable:false, editable: false},
				{name:'on',index:'on',width:40, sortable:false, editable: false},
				{name:'off',index:'off',width:40, sortable:false, editable: false},
        {name:'dd',index:'dd',width:40, editable: false},
        {name:'ket',index:'ket',width:100, editable: false},
        {name:'kurs',index:'kurs',width:50, editable: false, align: 'center'},
				{name:'lstp',index:'lstp',width:50, editable: false, align: 'center',hidden:true},
				{name:'',index:'lstpx',width:50, editable: false, align: 'center',hidden:true},
				{name:'ppjks_id',index:'ppjks_id',width:50, editable: false, align: 'center',hidden:true}
			],

			viewrecords : true,
			rowNum:10,
			rowList:[10,20,30],
			pager : pager_selector,
			altRows: true,
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


		//navButtons
		jQuery(grid_selector).jqGrid('navGrid',pager_selector,
			{ 	//navbar options
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
				},
				onclickSubmit: function () {
					var gsr = $(this).jqGrid('getGridParam','selrow');
					var ppjks_id = $(this).jqGrid('getCell',gsr,'ppjks_id');
		      return { datatb:'dl-bapp', _token:'<?php echo csrf_token();?>'};
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
				},
				onclickSubmit: function () {
		      return { datatb:'dl', _token:'<?php echo csrf_token();?>'};
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
					form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
				}
			}
		).jqGrid('navButtonAdd',pager_selector,{
				keys: true,
				caption:"",
				buttonicon:"ace-icon fa fa-pencil blue",
				position:"first",
				onClickButton:function(){
					$('#form').trigger("reset");
					//
					var gsr = $(this).jqGrid('getGridParam','selrow');
					if(gsr){
						var ppjks_id = $(this).jqGrid('getCell',gsr,'ppjks_id');
						var bapp = $(this).jqGrid('getCell',gsr,'bapp');
						// var mooring = $(this).jqGrid('getCell',gsr,'mooring');
						$('#bapp').val(bapp);

						var posdata= {'datatb':'dl','search':gsr};
						getparameter("{{url('/api/oprasional/json')}}",posdata,function(data){
							$('#tundadate').daterangepicker({
								'applyClass' : 'btn-sm btn-success',
								'cancelClass' : 'btn-sm btn-default',
								"opens": "center",
								timePicker: true,
								timePicker24Hour: true,
								startDate: data.tundaon,
								endDate: data.tundaoff,
								locale: {
									applyLabel: 'Apply',
									cancelLabel: 'Cancel',
									format: 'DD/MM/YY HH:mm'
								}
							})
							.prev().on(ace.click_event, function(){
								$(this).next().focus();
							});

							$('#pcdate').daterangepicker({
								'applyClass' : 'btn-sm btn-success',
								'cancelClass' : 'btn-sm btn-default',
								"opens": "center",
								timePicker: true,
								timePicker24Hour: true,
								startDate: data.pcon,
								endDate: data.pcoff,
								locale: {
									applyLabel: 'Apply',
									cancelLabel: 'Cancel',
									format: 'DD/MM/YY HH:mm'
								}
							})
							.prev().on(ace.click_event, function(){
								$(this).next().focus();
							});
							// console.log(data.pcon);
						});
						postsave.post = '';
						postsave.post += 'oper=edit&dls_id='+gsr+'&ppjks_id='+ppjks_id+'&';
						$('#modal').modal('show');
					} else {
						alert("pilih tabel")
					}
				}
		}).jqGrid('navButtonAdd',pager_selector,{
				keys: true,
				caption:"LHP",
				buttonicon:"ace-icon fa fa-file-pdf-o orange",
				position:"last",
				onClickButton:function(){
					// var data = $(this).jqGrid('getRowData'); Get all data

					$('#dompdf input[name=page]').val('lhp1-dompdf');
					$('#dompdf input[name=start]').val(setdate);
					$('#dompdf input[name=ext1]').val('lhp1');

					// console.log(setdate);

					$('#dompdf').submit();
				}
		}).jqGrid('navButtonAdd',pager_selector,{
				keys: true,
				caption:"LHP-M",
				buttonicon:"ace-icon fa fa-file-pdf-o orange",
				position:"last",
				onClickButton:function(){
					// var data = $(this).jqGrid('getRowData'); Get all data

					$('#dompdf input[name=page]').val('lhp1-dompdf');
					$('#dompdf input[name=start]').val(setdate);
					$('#dompdf input[name=ext1]').val('lhp2');

					// console.log(setdate);

					$('#dompdf').submit();
				}
		}).jqGrid('navButtonAdd',pager_selector,{
				caption:"",
				buttonicon:"ace-icon fa fa-file-excel-o green",
				position:"next",
				onClickButton:function(){
					var posdata = {category:'lhp-m',start:setdate,_token:'{{csrf_token()}}'};
					getparameter2("{{url('/oprasional/XLS_Oprasional')}}",posdata,
						function(data){
							$("#loading").modal('hide');
							window.open("{{ url('/public/files/tmp/data_LHP-M.xlsx') }}");
						},
						function(data){
							$("#loading").modal();
						},
					);
				}
		});

		//var selr = jQuery(grid_selector).jqGrid('getGridParam','selrow');

		$(document).one('ajaxloadstart.page', function(e) {
			$.jgrid.gridDestroy(grid_selector);
			$('.ui-jqdialog').remove();
		});
	});
</script>

@endsection
