@extends('backend.app_backend')

@section('css')

	<!-- page specific plugin styles -->
	<link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker3.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('/css/daterangepicker.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/ui.jqgrid.min.css') }}" />

	<link rel="stylesheet" href="{{ asset('/css/bootstrap-editable.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.min.css') }}" />

	<link rel="stylesheet" href="{{ asset('/css/chosen.min.css') }}" />
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
						<h3 class="smaller lighter blue no-margin">Form LSTP </h3>
					</div>
					<!-- 01 end heder -->
					<!-- 02 body -->
					<div class="modal-body">
						{{ csrf_field() }}
						<!-- <input type="hidden" name="datatb" value="keluarga" />
						<input type="hidden" id='id-1' name="id" value="id" /> -->
						<!-- <input type="hidden" id='oper' name="oper" value="" /> -->
						<div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Tgl Request </label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-9 tgl" type="text" id="date_req" name="date_req" readonly></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Tgl Aprov </label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-9 tgl" type="text" id="date_aprv" name="date_aprv" readonly></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>
							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">No. LSTP </label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-9" type="text" id="lstp" name="lstp" disabled></div>
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

					<div align="center">LSTP<br />
							<span class="editable" id="psdate"></span>
							<!-- s.d. <span class="editable" id="pedate"></span> -->
					</div>
					</br>

					<form id="dompdf" role="form" method="POST" action="{{ url('oprasional/PDFAdmin') }}" target="_blank">
						{!! csrf_field() !!}
						<input name="page" value="" hidden/>
						<input name="file" value="" hidden/>
						<input name="start" value="" hidden/>
						<input name="ext" value="" hidden/>
						<input name="end" value="" hidden/>
					</form>

					<div class="row">
		        <div class="col-xs-12">
							<input class="input-sm col-xs-3" type="text" id="search" name="search">
						</div>
						<!-- <div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="food">filter</label>

								<div class="col-xs-12 col-sm-9">
										<select id='filter' class="multiselect" multiple="">
											<option value="req">Date Req</option>
											<option value="aprov">Date Aprov</option>
										</select>
								</div>
						</div> -->

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

		// $('#psdate').html(moment().startOf('month').format('D MMMM YYYY'));
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
        $(grid_selector).jqGrid('setGridParam',{postData:{start:params.newValue}}).trigger("reloadGrid");
        // $('input[name="start"]').val(params.newValue);
        setdate = start = params.newValue;
    });

		$('#pedate').html(moment().endOf('month').format('D MMMM YYYY'));
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
        // $('input[name="start"]').val(params.newValue);
        setdate = end = params.newValue;
    });

		var setdate = moment().format('D MMMM YYYY');
		var start = $('#psdate').html();
    var end = $('#pedate').html();


		// $('.tgl').datepicker({format:'dd MM yyyy', viewformat: 'dd MM yyyy', autoclose:true});

		$('.tgl').datepicker({
				format:'dd MM yyyy',
				viewformat: 'dd MM yyyy',
				autoclose: true,
				todayHighlight: true
		})
		//show datepicker when clicking on the icon
		.next().on(ace.click_event, function(){
				$(this).prev().focus();
		});

		var postsave={};
		postsave.url = "{{url('/api/oprasional/cud')}}";
		postsave.grid = '#grid-table';
		postsave.modal = '#modal';
		$('#save').click(function(e) {
			e.preventDefault();
			postsave.post += $("#form").serialize()+'&datatb=lstp';
			saveGrid(postsave);
		});
		//////////////////
		// $('#filter').multiselect({
		// 	enableFiltering: false,
		// 	enableHTML: true,
		// 	buttonClass: 'btn btn-white btn-primary',
		// 	templates: {
		// 		button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown"><span class="multiselect-selected-text"></span> &nbsp;<b class="fa fa-caret-down"></b></button>',
		// 		ul: '<ul class="multiselect-container dropdown-menu"></ul>',
		// 		filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
		// 		filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default btn-white btn-grey multiselect-clear-filter" type="button"><i class="fa fa-times-circle red2"></i></button></span>',
		// 		li: '<li><a tabindex="0"><label></label></a></li>',
		// 		divider: '<li class="multiselect-item divider"></li>',
		// 		liGroup: '<li class="multiselect-item multiselect-group"><label></label></li>'
		// 	},
		// 	onChange: function(option, checked, select) {
		// 		// $(grid_selector).jqGrid('setGridParam',{postData:{start:params.newValue}}).trigger("reloadGrid");
		// 		console.log($('#filter').val());
		// 	}
		// });
		/////////////////////////

		// $('#filter').multiselect({
    //   onChange: function(option, checked, select) {
    //     alert('onChange triggered ...');
    //   }
    // });

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
		var parameters = {datatb:'ppjk',lstp:'on',start:start,end:end,_token:'{{ csrf_token() }}'};

		jQuery(grid_selector).jqGrid({
			caption: "Input LSTP",
      datatype: "json",            //supported formats XML, JSON or Arrray
      mtype : "post",
      postData: parameters,
			url:"{{url('/api/oprasional/jqgrid')}}",
			editurl: "{{url('/api/oprasional/cud')}}",//nothing is saved
			sortname:'date_issue',
			sortorder: 'desc',
			height: 'auto',
			colNames:['id','Date Issue','PPJK','AGEN','Kapal','Jetty','ETA','ETD','Asal','Tujuan','Etmal','Cargo','Muatan','Date Req','Date Aprv','LSTP','Moring'],
			colModel:[
				{name:'id',index:'id', width:40, fixed:true, sortable:true, resize:false, align: 'center'},
				{name:'date_issue',index:'date_issue', width:50, sorttype:"int"},
				{name:'PPJK',index:'PPJK', width:60, sorttype:"int"},
				{name:'AGEN',index:'AGEN',width:30, align: 'center'},
				{name:'Kapal',index:'Kapal', width:90},
				{name:'Jetty',index:'Jetty', width:90},
				{name:'ETA',index:'ETA', width:80, align: 'center',hidden:true},
				{name:'ETD',index:'ETD', width:80, align: 'center',hidden:true},
				{name:'Asal',index:'Asal', width:70, hidden:true},
        {name:'Tujuan',index:'Tujuan', width:70, hidden:true},
        {name:'Etmal',index: 'Etmal', width: 50,align: 'center',hidden:true},
        {name:'Cargo',index:'Cargo',width:50, align: 'center',hidden:true},
				{name:'Muatan',index:'Muatan',width:50, align: 'center',hidden:true},
				{name:'lstp_req',index:'lstp_req',width:50, align: 'center'},
				{name:'lstp_aprv',index:'lstp_aprv',width:50, align: 'center'},
				{name:'lstp',index:'lstp',width:50, align: 'center'},
				{name:'moring',index:'moring',width:50, align: 'center'}
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
		      return { datatb:'ppjk', _token:'<?php echo csrf_token();?>'};
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

					var gsr = $(this).jqGrid('getGridParam','selrow');
					if(gsr){
						req = $(this).jqGrid('getCell',gsr,'lstp_req');
						aprv = $(this).jqGrid('getCell',gsr,'lstp_aprv');
						lstp = $(this).jqGrid('getCell',gsr,'lstp');

						if (req !=='') {
							$('#date_req').datepicker("setDate", req);
							$('#lstp').val(lstp).prop("disabled", false);
							$('#date_aprv').datepicker("setDate", aprv).prop('disabled', false);
						}	else {
							$('#lstp').prop("disabled", true);
							$('#date_aprv').datepicker().prop('disabled', true);
							$('#date_req').datepicker().change(function () {
								$('#lstp').val(lstp).prop("disabled", false);
								$('#date_aprv').datepicker().prop('disabled', false);
							});
						}

						postsave.post = '';
						postsave.post += 'oper=edit&id='+gsr+'&';
						$('#modal').modal('show');
					} else {
						alert("pilih tabel")
					}
				}
		}).jqGrid('navButtonAdd',pager_selector,{
				keys: true,
				caption:"",
				buttonicon:"ace-icon fa fa-file-pdf-o orange",
				position:"last",
				onClickButton:function(){
					// var data = $(this).jqGrid('getRowData'); Get all data

					$('#dompdf input[name=page]').val('lstp-dompdf');
					// $('#dompdf input[name=bstdo]').val($('#NoBSTDO').html());
					$('#dompdf input[name=start]').val(start);
					$('#dompdf input[name=end]').val(end);
					$('#dompdf input[name=ext]').val('ext1');

					$('#dompdf input[name=sidx]').val('ppjk');

					// console.log(setdate);

					$('#dompdf').submit();
				}
		}).jqGrid('navButtonAdd',pager_selector,{
				keys: true,
				caption:"",
				buttonicon:"ace-icon fa fa-file-pdf-o orange",
				position:"last",
				onClickButton:function(){
					// var data = $(this).jqGrid('getRowData'); Get all data

					$('#dompdf input[name=page]').val('lstp-dompdf');
					// $('#dompdf input[name=bstdo]').val($('#NoBSTDO').html());
					$('#dompdf input[name=start]').val(start);
					$('#dompdf input[name=end]').val(end);
					$('#dompdf input[name=ext]').val('ext2');

					$('#dompdf input[name=sidx]').val('ppjk');

					// console.log(setdate);

					$('#dompdf').submit();
				}
		})
		.jqGrid('navButtonAdd',pager_selector,{
				caption:"",
				buttonicon:"ace-icon fa fa-file-excel-o green",
				position:"next",
				onClickButton:function(){
					var posdata = {category:'ppjk1',start:start,end:end,_token:'{{csrf_token()}}'};
					getparameter2("{{url('/oprasional/XLS_Oprasional')}}",posdata,
						function(data){
							$("#loading").modal('hide');
							window.open("{{ url('/public/files/tmp/data_ppjk.xlsx') }}");
						},
						function(data){
							$("#loading").modal();
						},
					);
				}
		});

		$("#search").autocomplete({
			source: function( request, response ) {
				var postcar= {'datatb':'ppjk', cari: request.term, _token:'{{ csrf_token() }}'};
				getparameter("{{url('/api/oprasional/autoc')}}",postcar,function(data){
					response( $.map( data, function( item ) {
						return {
							label: item.label,
							value: item.value,
							id: item.id
						}
					}));
				},function(data){
					//be4 send
				});
			},
			autoFocus: true,
			minLength: 0,
			select: function( event, ui ) {
				jQuery(grid_selector).jqGrid('setGridParam', { postData: {datatb:'ppjk',s_id:ui.item.id,start:start,end:end,_token:'{{ csrf_token() }}'}, }).trigger("reloadGrid");
				console.log(ui.item.id);
				parameters = {datatb:'ppjk',start:start,end:end,_token:'{{ csrf_token() }}'};
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
