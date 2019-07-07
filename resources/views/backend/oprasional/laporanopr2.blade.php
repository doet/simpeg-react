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
		<div class="modal-dialog">
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
											<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">PPJK</label>
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix"><input class="input-sm col-sm-4" type="text" id="ppjk" name="ppjk"></div>
											</div>
										</div><div class="space-2"></div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Agen</label>
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix"><input class="input-sm col-sm-3" type="text" id="agen" name="agen"></div>
											</div>
										</div><div class="space-2"></div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Date</label>
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix"><input class="input-sm col-sm-8" type="text" id="date" name="date"></div>
											</div>
										</div><div class="space-2"></div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Kapal</label>
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix"><input class="input-sm" type="text" id="kapal" name="kapal"></div>
											</div>
										</div><div class="space-2"></div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Dermaga</label>
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													<select id="dermaga" name="dermaga" class="chosen-select" data-placeholder="Pilih Nama ..." >
														<option></option>
													</select>
												</div>
											</div>
										</div><div class="space-2"></div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">ops</label>
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													<select id="ops" name="ops" class="chosen-select" data-placeholder="Pilih Nama ..." >
														<option ></option>
														<option value="Berth">Berth</option>
														<option value="Unberth">Unberth</option>
													</select>
												</div>
											</div>
										</div><div class="space-2"></div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">BAPP</label>
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix"><input class="input-sm col-sm-4" type="text" id="bapp" name="bapp"></div>
											</div>
										</div><div class="space-2"></div>


									</div>
								</div>
								<div class="col-xs-12 col-sm-6">

									<div class="row">

										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">PC</label>
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix"><input class="input-sm col-sm-3" type="text" id="pc" name="pc"></div>
											</div>
										</div><div class="space-2"></div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">On/Off</label>
											<div class="col-xs-12 col-sm-9">
													<div class="clearfix"><input class="input-sm" type="text" name="pcdate" id="pcdate" /></div>
											</div>
										</div><div class="space-2"></div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Tunda</label>
											<div class="col-xs-12 col-sm-9">
													<select id="tunda" class="multiselect" multiple="">
															<option value="GB">GB</option>
															<option value="GC">GC</option>
															<option value="GS">GS</option>
															<option value="MV">MV</option>
															<option value="MG">MG</option>
													</select>
											</div>
										</div><div class="space-2"></div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">On/Off</label>
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix"><input class="input-sm" type="text" id="tundadate" name="tundadate"></div>
											</div>
										</div><div class="space-2"></div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">DD</label>
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix"><input class="input-sm col-sm-4" type="text" id="dd" name="dd"></div>
											</div>
										</div><div class="space-2"></div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Ket</label>
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix"><input class="input-sm" type="text" id="ket" name="ket"></div>
											</div>
										</div><div class="space-2"></div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Kurs</label>
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix"><input class="input-sm col-sm-3" type="text" id="kurs" name="kurs"></div>
											</div>
										</div><div class="space-2"></div>

									</div>

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
					</div>
				</div>
		</div><!-- /.modal-dialog -->




      <div class="row">
        <div class="col-xs-12">
          <!-- PAGE CONTENT BEGINS -->

					<div align="center">Kegiatan Operator<br />
							<span class="editable" id="psdate"></span>
					</div>
					</br>

					<form id="dompdf" role="form" method="POST" action="{{ url('oprasional/PDFAdmin') }}" target="_blank">
						{!! csrf_field() !!}
						<input name="page" value="" />
						<input name="file" value="" />
						<input name="start" value="" />
						<button type="submit" name="submit">submit</button>
					</form>
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

	var nowdate = new Date();
	var monthStartDay = new Date(nowdate.getFullYear(), nowdate.getMonth(), 1);
	var monthEndDay = new Date(nowdate.getFullYear(), nowdate.getMonth() + 1, 0);
	var setdate = formatDate(nowdate);

	function formatDate(date) {
	  var monthNames = [
	    "January", "February", "March",
	    "April", "May", "June", "July",
	    "August", "September", "October",
	    "November", "December"
	  ];

	  var day = date.getDate();
	  var monthIndex = date.getMonth();
	  var year = date.getFullYear();

	  return day + ' ' + monthNames[monthIndex] + ' ' + year;
	}

	jQuery(function($) {

		$('#psdate').html(formatDate(nowdate));
		//editables on first profile page
    $.fn.editable.defaults.mode = 'inline';
    $.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
                                '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';
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
        setdate = params.newValue;
    });

		if(!ace.vars['old_ie']) $('#date').datetimepicker({
			format: 'DD-MM-YYYY HH:mm',//use this option to display seconds
			date: nowdate,
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

		$( "#agen" ).autocomplete({
			source: function( request, response ) {
				var postcar= {'datatb':'agen', cari: request.term, _token:'{{ csrf_token() }}'};
				getparameter("{{url('/api/oprasional/autoc')}}",postcar,function(data){
					response( $.map( data, function( item ) {
						return {
							label: item,
							value: item
						}
					}));
				},function(data){
					//be4 send
				});
			},
			autoFocus: true,
			minLength: 0
		});
		//
		$( "#kapal" ).autocomplete({
			source: function( request, response ) {
				var postcar= {'datatb':'kapal', cari: request.term, _token:'{{ csrf_token() }}'};
				getparameter("{{url('/api/oprasional/autoc')}}",postcar,function(data){
					response( $.map( data, function( item ) {
						return {
							label: item,
							value: item
						}
					}));
				},function(data){
					//be4 send
				});
			},
			autoFocus: true,
			minLength: 0
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

		var posdata= {'datatb':'dermaga', _token:'{{ csrf_token() }}'};
		var $select_elem = $("#dermaga");
		$select_elem.empty();
		getparameter("{{url('/api/oprasional/json')}}",posdata,function(data){
	    $.each(data, function (idx, obj) {
	    	$select_elem.append('<option value="'+idx+'">'+obj+'</option>');
	    });
			$select_elem.val('').trigger("chosen:updated");
		},function(data){});

		$('.multiselect').multiselect({
		 enableFiltering: false,
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
		 }
		});

		var postsave;
		$('#save').click(function(e) {
			e.preventDefault();
			postsave += $("#form").serialize()+'&tunda='+$('#tunda').val()+'&datatb=dl';
			console.log(postsave);
			getparameter("{{url('/api/oprasional/cud')}}",postsave,	function(data){
					var newHTML = '<i class="ace-icon fa fa-floppy-o"></i>Save';
					$('#save').html(newHTML);

					$('#form').trigger("reset");

					$('#grid-table').trigger("reloadGrid", [{current:true}]);
					$('#modal').modal('hide');
		// 			// console.log(data);
			},function(data){
					var newHTML = '<i class="ace-icon fa fa-spinner fa-spin "></i>Loading...';
					$('#save').html(newHTML);
			});
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
      postData: {datatb:'dl',start:formatDate(nowdate),_token:'{{ csrf_token() }}'},
			url:"{{url('/api/oprasional/jqgrid')}}",
			editurl: "{{url('/api/oprasional/cud')}}",//nothing is saved
			sortname:'date',
			sortorder: 'desc',
			height: 'auto',
			colNames:[' ', 'PPJK','AGEN','Date','Kapal','GRT','LOA','Bendera','Dermaga','OPS','BAPP','PC','Tunda','ON','OFF','DD','Ket','Kurs'],
			colModel:[
				{name:'myac',index:'', width:50, fixed:true, sortable:false, resize:false, align: 'center'},
				{name:'ppjk',index:'ppjk', width:50, sorttype:"int", editable: false},
				{name:'agen',index:'agen',width:40, editable:false, align: 'center'},
				{name:'date',index:'date', width:100,editable: false},
				{name:'kapal',index:'kapal', width:150, editable: false},
				{name:'grt',index:'grt', width:60, editable: false},
				{name:'loa',index:'loa', width:60, sortable:false},
				{name:'bendera',index:'bendera', width:80, editable: false},
        {name:'dermaga',index:'dermaga', width:100, editable: false},
        {name:'ops',index: 'ops', width: 60,editable: false, align: 'center'},
        {name:'bapp',index:'bapp',width:50, editable: false, align: 'center'},
        {name:'pc',index: 'pc', width: 40, editable: false, align: 'center'},
        {name:'tunda',index:'tunda',width:100, editable: false},
        {name:'on',index:'on',width:40, editable: false},
        {name:'off',index:'off',width:40, editable: false},
        {name:'dd',index:'dd',width:40, editable: false},
        {name:'ket',index:'ket',width:100, editable: false},
        {name:'kurs',index:'kurs',width:50, editable: false, align: 'center'}
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
				del: true,
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
				caption:"DL",
				buttonicon:"ace-icon fa fa-file-pdf-o orange",
				position:"last",
				onClickButton:function(){
					// var data = $(this).jqGrid('getRowData'); Get all data

					// $('#dompdf input[name=page]').val('dl-dompdf');
					// $('#dompdf input[name=start]').val(setdate);
					// console.log(setdate);
					//
					//
					$('input[name=page]').val('dl-dompdf');
					$('input[name=file]').val('dl-dompdf');
					$('input[name=start]').val(setdate);

					$('#dompdf').submit();
				}
		}).jqGrid('navButtonAdd',pager_selector,{
				keys: true,
				caption:"",
				buttonicon:"ace-icon fa fa-pencil blue",
				position:"first",
				onClickButton:function(){
					$('#form').trigger("reset");
					$('#tunda').multiselect('deselectAll', false).multiselect('refresh');

					var gsr = $(this).jqGrid('getGridParam','selrow');
					if(gsr){
						var posdata= {'datatb':'loadlaporan','iddata':gsr};
						getparameter("{{url('/api/oprasional/json')}}",posdata,function(data){
							$('#ppjk').val(data.ppjk);

							$( "#agen" ).val(data.agen);

							$('#date').data("DateTimePicker").date(data.date);

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

							console.log();
							$( "#kapal" ).val(data.kapal);

							$('#dermaga').val(data.dermaga).trigger("chosen:updated");
							$('#ops').val(data.ops).trigger("chosen:updated");

							$('#bapp').val(data.bapp);
							$('#pc').val(data.pc);

							if (data.tunda != null) {
								data.tunda.forEach(function(element) {
									$('option[value="'+element+'"]', $('#tunda')).prop('selected', true);
								});
								$('#tunda').multiselect('refresh');
							// console.log(data.tunda);
							}
							$('#dd').val(data.dd);
							$('#ket').val(data.ket);
							$('#kurs').val(data.kurs);

							postsave ='';
							postsave += 'oper=edit&id='+gsr+'&';
						},function(data){ });

						$('#modal').modal('show');
					} else {
						alert("pilih tabel")
					}
				}
		}).jqGrid('navButtonAdd',pager_selector,{
				keys: true,
				caption:"",
				buttonicon:"ace-icon fa fa-plus-circle purple",
				position:"first",
				onClickButton:function(){
					$('#form').trigger("reset");
					$('#date').data("DateTimePicker").date(new Date(setdate));

					$('#pcdate, #tundadate').daterangepicker({
						'applyClass' : 'btn-sm btn-success',
						'cancelClass' : 'btn-sm btn-default',
						"opens": "center",
						timePicker: true,
						timePicker24Hour: true,
						startDate: moment().startOf('minute'),
						endDate: moment().startOf('minute').add(1, 'minute'),
						locale: {
								applyLabel: 'Apply',
								cancelLabel: 'Cancel',
								format: 'DD/MM/YY HH:mm'
						}
					})
					.prev().on(ace.click_event, function(){
							$(this).next().focus();
					});
					// console.log(moment().startOf('minute'));
					$('#dermaga, #ops').val('').trigger("chosen:updated");
					$('#tunda').multiselect('deselectAll', false).multiselect('refresh');
					postsave ='';
					postsave += 'oper=add&';
					$('#modal').modal('show');
				}
		})



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
