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
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">PPJK</label>
										<div class="col-xs-12 col-sm-5">
											<div class="clearfix">
												<select id="ppjk" name="ppjk" class="chosen-select" data-placeholder="PPJK ..." >
													<option></option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>

								<!-- <div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">PPJK</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-4" type="text" id="ppjk" name="ppjk"></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div> -->

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Agen</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												<select id="agen" name="agen" class="chosen-select" data-placeholder="Agen ..." disabled >
													<option></option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Waktu </label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												<input class="input-sm col-xs-12 col-sm-8" type="text" id="date" name="date" >
											</div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Kapal</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												<select id="kapal" name="kapal" class="chosen-select" data-placeholder="Kapal ..." disabled>
													<option></option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Dermaga</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												<select id="jetty" name="jetty" class="chosen-select" data-placeholder="Dermaga ...">
													<option></option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Ops</label>
										<div class="col-xs-12 col-sm-4">
											<div class="clearfix">
												<select id="ops" name="ops" class="chosen-select" data-placeholder="Ops ..." >
													<option ></option>
													<option value="Berth">Berth</option>
													<option value="Unberth">Unberth</option>
													<option value="Khusus">Khusus</option>
												</select>
											</div>
										</div>
										<span class="help-inline col-sm-5">
											<label class="middle">
												<input id="shift" name="shift" class="ace" type="checkbox">
												<span class="lbl">Shifting</span>
											</label>
										</span>
									</div>
								</div>
								<div class="space-2"></div>
							</div>
							<div class="col-xs-12 col-sm-6">

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">PC</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-3" type="text" id="pc" name="pc"></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>

								<div class="row">
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
									</div>
								</div>
								<div class="space-2"></div>

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">On/Off</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-9" type="text" id="tundadate" name="tundadate" readonly></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">DD</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-4" type="text" id="dd" name="dd"></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Ket</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm" type="text" id="ket" name="ket"></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Mooring</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm" type="text" id="mooring" name="mooring"></div>
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




      <div class="row">
        <div class="col-xs-12">
          <!-- PAGE CONTENT BEGINS -->

					<div align="center">Kegiatan Operator<br />
						<span class="editable" id="psdate"></span>
					</div>
					</br>

					<form id="dompdf" role="form" method="POST" action="{{ url('oprasional/PDFAdmin') }}" target="_blank">
						{!! csrf_field() !!}
						<input name="page" value="" hidden/>
						<input name="file" value="" hidden/>
						<input name="start" value="" hidden/>
						<input name="sidx" value="" hidden/>
						<input name="sord" value="" hidden/>
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
	jQuery(function($) {

		//editables on first profile page
    $.fn.editable.defaults.mode = 'inline';
    $.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
                                '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';

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
        setdate = params.newValue;
    });

		var setdate = moment().format('D MMMM YYYY');
		var start = $('#psdate').html();

		$('#date').datetimepicker({
			format: 'DD-MM-YYYY HH:mm',//use this option to display seconds
			date: moment(),
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
		})
		.prev().on(ace.click_event, function(){
				$(this).next().focus();
		});

		//
		// $('#on, #off').datetimepicker({
		// 		format: 'LT',
		// 		format: 'HH:mm',
		// 		date: nowdate,
		// });

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

		var posdata = {'datatb':'ppjk','filter':'noinv', _token:'{{ csrf_token() }}'};
		posdata.src="{{url('/api/oprasional/json')}}";
		posdata.elm="ppjk";
		src_chosen_full(posdata,function(data){
			$.each(data, function (idx, obj) {
				$('#ppjk').append('<option value="'+obj['id']+'">'+obj['ppjk']+'</option>');
			});
		},function(data){
			console.log();
			if (data === undefined || data.length == 0) {
				// $("#alamat").val('');
				// $("#npwp").val('');
				// $("#tlp").val('');
			} else {
				$('#agen').val(data[0].agens_id).trigger("chosen:updated");
				$('#kapal').val(data[0].kapals_id).trigger("chosen:updated");
				$('#jetty').val(data[0].jettys_id).trigger("chosen:updated");
				$("#save").prop('disabled', false);
			}
		});

		var posdata = {'datatb':'agen', _token:'{{ csrf_token() }}'};
		posdata.src="{{url('/api/oprasional/json')}}";
		posdata.elm="agen";
		src_chosen_full(posdata,function(data){
			$.each(data, function (idx, obj) {
				$('#agen').append('<option value="'+obj['id']+'">('+obj['code']+') '+obj['name']+'</option>');
			});
		},function(data){
			if (data === undefined || data.length == 0) {
				// $("#alamat").val('');
				// $("#npwp").val('');
				// $("#tlp").val('');
			} else {
				// $("#alamat").val(data[0].alamat);
				// $("#npwp").val(data[0].npwp);
				// $("#tlp").val(data[0].tlp);
			}
		});

		var posdata = {'datatb':'kapal', _token:'{{ csrf_token() }}'};
		posdata.src="{{url('/api/oprasional/json')}}";
		posdata.elm="kapal";
		src_chosen_full(posdata,function(data){
			$.each(data, function (idx, obj) {
	      $("#kapal").append('<option value="'+obj['id']+'">('+obj['jenis']+') '+obj['name']+'</option>');
	    });
		},function(data){
			if (data === undefined || data.length == 0) {
				// $("#bendera").val('');
				// $("#dwt").val('');
				// $("#grt").val('');
				// $("#loa").val('');
				// $("#draft").val('');
			} else {
				// $("#bendera").val(data[0].bendera);
				// $("#dwt").val(Numbers(data[0].dwt));
				// $("#grt").val(Numbers(data[0].grt));
				// $("#loa").val(Numbers(data[0].loa));
				// $("#draft").val(Numbers(data[0].draft));
			}
		});

		var posdata = {'datatb':'dermaga', _token:'{{ csrf_token() }}'};
		posdata.src="{{url('/api/oprasional/json')}}";
		posdata.elm="jetty";
		src_chosen_full(posdata,function(data){
			$.each(data, function (idx, obj) {
				$("#jetty").append('<option value="'+obj['id']+'">('+obj['code']+') '+obj['name']+'</option>');
			});
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

		var postsave={};
		postsave.url = "{{url('/api/oprasional/cud')}}";
		postsave.grid = '#grid-table';
		postsave.modal = '#modal';
		$('#save').click(function(e) {
			e.preventDefault();
			postsave.post += $("#form").serialize()+'&datatb=dl'+'&tunda='+$('#tunda').val();
			// console.log(postsave);
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
			caption: "LIST DL",
      datatype: "json",            //supported formats XML, JSON or Arrray
      mtype : "post",
      postData: {datatb:'dl',start:start,_token:'{{ csrf_token() }}',f:'dl'},
			url:"{{url('/api/oprasional/jqgrid')}}",
			editurl: "{{url('/api/oprasional/cud')}}",//nothing is saved
			sortname:'date',
			sortorder: 'desc',
			height: 'auto',
			colNames:['id', 'PPJK','AGEN','Waktu','Kapal','GRT','LOA','Bendera','Dermaga','OPS','bapp','PC','ON','OFF','Tunda','ON','OFF','DD','Ket','Rute','Mooring'],
			colModel:[
				{name:'tb_dls.id',index:'tb_dls.id', width:50, fixed:true, sortable:true, resize:false, align: 'center'},
				{name:'ppjk',index:'ppjk', width:50, sorttype:"int", editable: false},
				{name:'agenCode',index:'agenCode',width:45, editable:false, align: 'center'},
				{name:'date',index:'date', width:80,editable: false},
				{name:'kapalsName',index:'kapalsName', width:150, editable: false},
				{name:'grt',index:'grt', width:50, editable: false, align: 'right'},
				{name:'loa',index:'loa', width:35, editable:false, align: 'right'},
				{name:'bendera',index:'bendera', width:80, editable: false},
        {name:'jettyName',index:'jettyName', width:100, editable: false},
        {name:'ops',index: 'ops', width: 60,editable: false, align: 'center'},
				{name:'bapp',index:'bapp',width:50, editable: false, align: 'center',hidden:true},
        {name:'pc',index: 'pc', width: 40, editable: false, align: 'center'},
				{name:'on',index:'on',width:40, editable: false,hidden:true},
				{name:'off',index:'off',width:40, editable: false,hidden:true},
        {name:'tunda',index:'tunda',width:100, sortable:false, editable: false},
				{name:'on',index:'on',width:40, sortable:false, editable: false},
				{name:'off',index:'off',width:40, sortable:false, editable: false},
        {name:'dd',index:'dd',width:30, editable: false},
        {name:'ket',index:'ket',width:80, editable: false},
        {name:'rute',index:'rute',width:50, editable: false, align: 'center'},
				{name:'moring',index:'moring',width:120, editable: false}
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
					// console.log($(this).getGridParam("postData").sidx);
					// // var data = $(this).jqGrid('getRowData'); Get all data
					$('#dompdf input[name=page]').val('dl-dompdf');
					$('#dompdf input[name=start]').val(setdate);
					$('#dompdf input[name=sidx]').val($(this).getGridParam("postData").sidx);
					$('#dompdf input[name=sord]').val($(this).getGridParam("postData").sord);
					//
					// // console.log(setdate);
					$('#dompdf').submit();
				}
		}).jqGrid('navButtonAdd',pager_selector,{
				keys: true,
				caption:"",
				buttonicon:"ace-icon fa fa-pencil blue",
				position:"first",
				onClickButton:function(){
					$('#form').trigger("reset");
					var gsr = $(this).jqGrid('getGridParam','selrow');
					if(gsr){
						$('#tunda').multiselect('deselectAll', false).multiselect('refresh');
						$('#ppjk').prop('disabled', true).trigger("chosen:updated");
						$("#save").prop('disabled', false);

						var posdata= {'datatb':'dl','search':gsr};
						getparameter("{{url('/api/oprasional/json')}}",posdata,function(data){
							// console.log(data)
							$('#ppjk').val(data.ppjk).trigger("chosen:updated");
							$('#agen').val(data.agen).trigger("chosen:updated");
							$('#date').data("DateTimePicker").date(data.date);
							$('#kapal').val(data.kapal).trigger("chosen:updated");
							$('#jetty').val(data.jetty).trigger("chosen:updated");
							$('#ops').val(data.ops).trigger("chosen:updated");
							$('#pc').val(data.pc);

							if (data.shift==='on')$('#shift').prop('checked', true);
							// console.log(data.shift);

							if (data.tunda != null) {
								data.tunda.forEach(function(element) {
									$('option[value="'+element+'"]', $('#tunda')).prop('selected', true);
								});
								$('#tunda').multiselect('refresh');
							// // console.log(data.tunda);
							}
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
							// console.log(data.tundaoff);

							$('#dd').val(data.dd);
							$('#ket').val(data.ket);
							$('#mooring').val(data.mooring);
							// $('#bapp').val(data.bapp);
							// //
							// $('#pcdate').daterangepicker({
							// 	'applyClass' : 'btn-sm btn-success',
							// 	'cancelClass' : 'btn-sm btn-default',
							// 	"opens": "center",
							// 	timePicker: true,
							// 	timePicker24Hour: true,
							// 	startDate: data.pcon,
							// 	endDate: data.pcoff,
							// 	locale: {
							// 			applyLabel: 'Apply',
							// 			cancelLabel: 'Cancel',
							// 			format: 'DD/MM/YY HH:mm'
							// 	}
							// })
							// .prev().on(ace.click_event, function(){
							// 		$(this).next().focus();
							// });
							// //
							postsave.post = '';
							postsave.post += 'oper=edit&id='+gsr+'&';
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
				$('#ppjk').prop('disabled', false).trigger("chosen:updated");
				$('#ppjk, #agen, #kapal, #jetty, #ops').val('').trigger("chosen:updated");
				$('#date').data("DateTimePicker").date(moment());

				$('#tunda').multiselect('deselectAll', false).multiselect('refresh');
				$('#tundadate').daterangepicker({
					'applyClass' : 'btn-sm btn-success',
					'cancelClass' : 'btn-sm btn-default',
					"opens": "center",
					timePicker: true,
					timePicker24Hour: true,
					// 	startDate: moment().startOf('minute'),
					// 	endDate: moment().startOf('minute').add(1, 'hour')
					locale: {
							applyLabel: 'Apply',
							cancelLabel: 'Cancel',
							format: 'DD/MM/YY HH:mm'
					}
				})
				.prev().on(ace.click_event, function(){
						$(this).next().focus();
				});


				postsave.post = '';
				postsave.post += 'oper=add&';
				$('#modal').modal('show');
			}
		}).jqGrid('navButtonAdd',pager_selector,{
				caption:"DL-M",
				buttonicon:"ace-icon fa fa-file-excel-o green",
				position:"next",
				onClickButton:function(){
					var posdata = {category:'dl-m',start:setdate,_token:'{{csrf_token()}}'};
					getparameter2("{{url('/oprasional/XLS_Oprasional')}}",posdata,
						function(data){
							$("#loading").modal('hide');
							window.open("{{ url('/public/files/tmp/data_DL-M.xlsx') }}");
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
