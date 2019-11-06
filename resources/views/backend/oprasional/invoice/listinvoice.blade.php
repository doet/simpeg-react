@extends('backend.app_backend')

@section('css')
	<!-- page specific plugin styles -->
	<link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/ui.jqgrid.min.css') }}" />

	<link rel="stylesheet" href="{{ asset('/css/bootstrap-editable.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker3.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('/css/daterangepicker.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/typeahead.js-bootstrap.css') }}" />

	<link rel="stylesheet" href="{{ asset('/css/chosen.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.min.css') }}" />
	<style>
		.ui-autocomplete { position: absolute; cursor: default; z-index: 1100 !important;}
		/* .editable-input	{
		    width:120px;
		} */
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
						<h3 class="smaller lighter blue no-margin">Form Invoice </h3>
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
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Tgl Doc</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-4 tgl" type="text" id="tglinv" name="tglinv" readonly></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Kurs</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												<input class="input-sm col-sm-4 tgl" type="text" id="dkurs" name="dkurs" readonly>
												<input class="input-sm col-sm-5" type="text" id="kurs" name="kurs">
											</div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Selisih</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-9" type="text" id="selisih" name="selisih" disabled></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>

							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">No Faktur</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-9" type="text" id="pajak" name="pajak"></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">No Invoice</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm input-mask-eyescript" type="text" id="noinv" name="noinv" placeholder="____-__/AF19.__"></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Ref.No</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-9" type="text" id="refno" name="refno"></div>
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

<div id="modal_kwitansi" class="modal fade" tabindex="-1">
	<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<!-- 01 Header -->
				<form id="form_kwitansi">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 class="smaller lighter blue no-margin">Form Kwitansi </h3>
					</div>
					<!-- 01 end heder -->
					<!-- 02 body -->
					<div class="modal-body">
						{{ csrf_field() }}
						<!-- <input type="hidden" name="datatb" value="keluarga" />
						<input type="hidden" id='oper-1' name="oper" value="add" />-->
						<input type="hidden" id='id_kwn' name="id" value="id" />
						<div class="row">
							<div class="col-xs-12 col-sm-6">

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Tgl Kwitansi</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-4 tgl" type="text" id="tgl_pay" name="tgl_pay" readonly></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>

							</div>
							<div class="col-xs-12 col-sm-6">

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">No Kwitansi</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-9" type="text" id="no_kwn" name="no_kwn"></div>
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
						<button class="btn btn-sm btn-danger pull-right" id='save_kwitansi'>
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
</div>

      <div class="row">
        <div class="col-xs-12">
          <!-- PAGE CONTENT BEGINS -->
					<form id="dompdf" role="form" method="POST" action="{{ url('oprasional/PDFInvoice') }}" target="_blank">
						{!! csrf_field() !!}
						<input name="page" value="" hidden/>
						<input name="file" value="" hidden/>
						<input name="start" value="" hidden/>
						<input name="bstdo" value="" hidden/>
						<input name="sidx" value="" hidden/>
					</form>

					<div align="center">Daftar Invoice<br />
						<span class="editable" id="psdate"></span>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-5">
							<div class="profile-user-info profile-user-info-striped ">

									<div class="profile-info-row">
										<div class="profile-info-name"> Display </div>

										<div class="profile-info-value">
											<select id="ppjk" class="multiselect" multiple="" disabled>
												<option value=""></option>
											</select>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Search PPJK </div>

										<div class="profile-info-value">
											<input class="input-sm col-xs-12" type="text" id="search" name="search">
										</div>
									</div>
							</div>
						</div>
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
	<script src="{{ asset('js/jquery.jqGrid.min.js') }}"></script>
	<script src="{{ asset('js/grid.locale-en.js') }}"></script>

	<script src="{{ asset('/js/bootstrap-editable.min.js') }}"></script>
	<script src="{{ asset('/js/ace-editable.min.js') }}"></script>

	<script src="{{ asset('/js/typeahead.js') }}"></script>
	<script src="{{ asset('/js/typeaheadjs.js') }}"></script>
	<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ asset('/js/daterangepicker.min.js') }}"></script>

	<script src="{{ asset('/js/chosen.jquery.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap-multiselect.min.js') }}"></script>
	<script src="{{ asset('/js/jquery.maskedinput.min.js') }}"></script>

	<script type="text/javascript">

	$(document).ready(function () {
    $("#txt").keypress(function () {
        alert($("#txt").getCursorPosition());
				$("#txt").setCursorPosition(5);
    });
  });
	jQuery(function($) {
		$.mask.definitions["9"] = '';
		$.mask.definitions["Q"] = '[0-9]';
		$.mask.definitions["X"] = '[A-Z]';
		$('.input-mask-eyescript').mask("QQQQ-QQ/AF19.XX");

		//editables on first profile page
    $.fn.editable.defaults.mode = 'inline';
    $.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
                                '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';

		// $('#psdate').html(moment().format('D MMMM YYYY'));
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
			},
			success: function(response, newValue) {

			}
		}).on('save', function(e, params) {
				$(grid_selector).jqGrid('setGridParam',{postData:{start:params.newValue}}).trigger("reloadGrid");
				// // $('input[name="start"]').val(params.newValue);
				setdate = params.newValue;

		});
		var setdate ='';

		$('.tgl').datepicker({
			format:'dd-mm-yyyy',
			autoclose:true,
		});

		$('#dkurs').on('changeDate', function (ev) {
			kurs($(this).val());
		});

		function kurs(dkurs){
			var posdata= {'datatb':'kurs','search':dkurs};
			// console.log(tglinv);
			getparameter("{{url('/api/oprasional/invoice/json')}}",posdata,function(data){
				if (data[1] !== null) {
					var a = new Date(data[1].date*1000);
					$('#dkurs').datepicker("update", a.getDate() +'-'+(a.getMonth()+1)+'-'+a.getFullYear());
					$('#kurs').val(Numbers(data[1].nilai));
				} else {
					// $('#dkurs').datepicker("update", tglinv);
					// $('#dkurs').val('');
					$('#kurs').val('');
				}
			});
		}

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
				// var target = $(this).find('input[type=radio]');
				// var which = parseInt(target.val());
				// if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
				// else $('#form-field-select-4').removeClass('tag-input-style');
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
				// postsave = {datatb:'bstdo',id:option.val(),checked:checked,bstdo:$('#NoBSTDO').html()};
				// getparameter("{{url('/api/oprasional/cud')}}",postsave,	function(data){
				// 	$(grid_selector).jqGrid('setGridParam',{postData:{bstdo:$('#NoBSTDO').html()}}).trigger("reloadGrid");
				// },function(data){});
	    }
		});

		var postsave={};
		postsave.url = "{{url('/api/oprasional/invoice/cud')}}";
		postsave.grid = '#grid-table';
		postsave.modal = '#modal';
		$('#save').click(function(e) {
			e.preventDefault();
			postsave.post += $("#form").serialize()+'&datatb=inv';
			saveGrid(postsave);
		});

		var postsave_kwitansi={};
		postsave_kwitansi.url = "{{url('/api/oprasional/invoice/cud')}}";
		postsave_kwitansi.grid = '#grid-table';
		postsave_kwitansi.modal = '#modal_kwitansi';
		$('#save_kwitansi').click(function(e) {
			e.preventDefault();
			postsave_kwitansi.post = $("#form_kwitansi").serialize()+'&datatb=kwitansi';
			saveGrid(postsave_kwitansi);
		});
//////////////////////////////////////////////

		var grid_selector = "#grid-table";
		var pager_selector = "#grid-pager";

		var parent_column = $(grid_selector).closest('[class*="col-"]');
		//resize to fit page size
		$(window).on('resize.jqGrid', function () {
			$(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );

			// grid-table_1314_t
			// console.log(parent_column.width());
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
			//direction: "rtl",

			//subgrid options
			subGrid : true,
			//subGridModel: [{ name : ['No','Item Name','Qty'], width : [55,200,80] }],
			//datatype: "xml",
			subGridOptions : {
				plusicon : "ace-icon fa fa-plus center bigger-110 blue",
				minusicon  : "ace-icon fa fa-minus center bigger-110 blue",
				openicon : "ace-icon fa fa-chevron-right center orange"
			},
			//for this example we are using local data
			subGridRowExpanded: function (subgridDivId, rowId) {
				var subgridTableId = subgridDivId + "_t";
				var subgridTableId2 = subgridDivId + "_j";

				var content = '<div class="table-detail">\
				  <div class="row">\
						<div class="col-xs-12 col-sm-6">\
	            <div class="profile-user-info profile-user-info-striped" id='+ subgridTableId +'></div>\
		        </div>\
						<div class="col-xs-12 col-sm-6">\
	            <div class="profile-user-info profile-user-info-striped" id='+ subgridTableId2 +'>\
							</div>\
		        </div>\
				  </div>\
				</div>';
				$("#" + subgridDivId).html(content)

				var postData = {datatb:'invoice', cari: rowId, _token:'{{ csrf_token() }}'};
				getparameter("{{url('/api/oprasional/invoice/json')}}",postData,function(data){
					// console.log(data.data);
					rowData = $(grid_selector).getRowData(rowId);
					if(rowData['tglinv'] && rowData['pajak'] && rowData['noinv'] && rowData['refno']) x_edit = 'x_edit'; else x_edit = '';

					var i=0;
					var datanya = data.data;
					if (datanya.data.selisih === null) datanya.data.selisih = '0';
					var match = datanya.data.selisih.split(',');
					datanya.isi.forEach(function(element){
						// console.log(element);
						if (match[i] === undefined)match[i] = 0;
						if(element.jumlahTarif !== 0) element.jumlahTarif = Numbers((Number(element.jumlahTarif)+Number(match[i])).toFixed(2));
						// element.jumlahTarif
						$("#" + subgridTableId ).append('<div class="profile-info-row row">\
							<div class="profile-info-value col-xs-6 col-sm-5" style="text-align:right"> '+element.dari+' - '+element.ke+' </div>\
							<div class="profile-info-value col-xs-6 col-sm-7" style="text-align:left">\
							<span data-array="'+i+'" class="'+x_edit+'">'+element.jumlahTarif+'</span>\
							</div>\
						</div>');
						i++;
					});
					if (match[i] === undefined)match[i] = 0;
					if (match[i+1] === undefined)match[i+1] = 0;
					if (match[i+2] === undefined)match[i+2] = 0;
					if (match[i+3] === undefined)match[i+3] = 0;
					// totalTarif
					if(datanya.jml_ori.totalTarif !== 0)	datanya.jml_ori.totalTarif		= Numbers(datanya.jml_ori.totalTarif+Number(match[i]));
					if(datanya.jml_ori.bhtPNBP !== 0) 		datanya.jml_ori.bhtPNBP				= Numbers(datanya.jml_ori.bhtPNBP+Number(match[i+1]));
					if(datanya.jml_ori.ppn !== 0) 				datanya.jml_ori.ppn 					= Numbers(datanya.jml_ori.ppn+Number(match[i+2]));
					if(datanya.jml_ori.totalinv !== 0) 		datanya.jml_ori.totalinv 			= Numbers(datanya.jml_ori.totalinv+Number(match[i+3]));
					$("#" + subgridTableId2 ).append('<div class="profile-info-row row">\
						<div class="profile-info-value col-xs-6 col-sm-7" style="text-align:right">Total Tunda</div>\
						<div class="profile-info-value col-xs-6 col-sm-5" style="text-align:left">\
							<span data-array="'+i+'" class="'+x_edit+'">'+datanya.jml_ori.totalTarif+'</span>\
						</div>\
					</div>\
					<div class="profile-info-row row">\
						<div class="profile-info-value col-xs-6 col-sm-7" style="text-align:right">Bagi Hasil Tunda setelah PNBP</div>\
						<div class="profile-info-value col-xs-6 col-sm-5" style="text-align:left">\
							<span data-array="'+ (i + 1) +'" class="'+x_edit+'">'+datanya.jml_ori.bhtPNBP+'</span>\
						</div>\
					</div>\
					<div class="profile-info-row row">\
						<div class="profile-info-value col-xs-6 col-sm-7" style="text-align:right">PPn / Total after VAT</div>\
						<div class="profile-info-value col-xs-6 col-sm-5" style="text-align:left">\
							<span data-array="'+ (i + 2) +'" class="'+x_edit+'">'+datanya.jml_ori.ppn+'</span>\
						</div>\
					</div>\
					<div class="profile-info-row row">\
						<div class="profile-info-value col-xs-6 col-sm-7" style="text-align:right">Total Tagihan Bagi Hasil / Total Invoice</div>\
						<div class="profile-info-value col-xs-6 col-sm-5" style="text-align:left">\
							<span data-array="'+ (i + 3) +'" class="'+x_edit+'">'+datanya.jml_ori.totalinv+'</span>\
						</div>\
					</div>');

					$('.x_edit').editable({
						type: 'text',
						pk: rowId,
						params:function(params) {
				        params.datatb = 'edit_nilai';
								params.name = $(this).attr('data-array');
								// params.id = rowId;
								return params;
				    },
						// params:{datatb:'edit_nilai',b:$(this).attr('data-array')},
    				url: "{{url('/api/oprasional/invoice/cud')}}",
						inputclass:'input-sm',
						success: function(response, newValue){
							if (response.recalculate !== ''){
								var index_c = Number($(this).attr('data-array'));
								alert(JSON.stringify('recalculate data'))
								$('.x_edit[data-array='+ (index_c+1) +']').editable('setValue',Numbers(response.recalculate.bhtPNBP));
								$('.x_edit[data-array='+ (index_c+2) +']').editable('setValue',Numbers(response.recalculate.ppn));
								$('.x_edit[data-array='+ (index_c+3) +']').editable('setValue',Numbers(response.recalculate.totalinv));
							}
						}
					}).on('save', function(e, params) {
						// jQuery(grid_selector).jqGrid('setGridParam', { postData: {datatb:'invoice',_token:'{{ csrf_token() }}'} }).trigger("reloadGrid");
						// jQuery(grid_selector).jqGrid('expandSubGridRow', 1299);
						// console.log( params.response.rowId);

						console.log($(this).attr('data-array'));
					}).on("click",function(){

			      $(this).next().find(".editable-input input").attr("id",'in_'+rowId);
						$(this).next().find(".editable-input input").attr("onkeyup",'formatNumber(this);');
			    });
				});
				// $("#" + subgridTableId ).append("<div>test</div>");

				// $("#" + subgridDivId).html("<table id='" + subgridTableId + "'>"+ +"</table>");
				// $("#" + subgridTableId).jqGrid({
				// 	datatype: "json",            //supported formats XML, JSON or Arrray
		    //   mtype : "post",
		    //   postData: {datatb:'invoice', cari: rowId, _token:'{{ csrf_token() }}'},
				// 	url:"{{url('/api/oprasional/invoice/jqgrid_sub')}}",
				// 	sortname:'date',
				// 	sortorder: 'asc',
				// 	colNames: ['id','dari','ke','Total','Ubah'],
				// 	colModel: [
				// 		{ name: 'id' },
				// 		{ name: 'dari' },
				// 		{ name: 'ke' },
				// 		{ name: 'total' },
				// 		{ name: 'ubah' }
				// 	]
				// });


			},

			caption: "Daftar Invoice",
      datatype: "json",            //supported formats XML, JSON or Arrray
      mtype : "post",
      postData: {datatb:'invoice', start:setdate, _token:'{{ csrf_token() }}'},
			url:"{{url('/api/oprasional/invoice/jqgrid')}}",
			editurl: "{{url('/api/oprasional/invoice/cud')}}",//nothing is saved
			sortname:'ppjk',
			sortorder: 'desc',
			height: 'auto',
			colNames:[' ', 'BSTDO','PPJK','Agen','Kapal','Jalur','Date Doc','Faktur Pajak','No. Invoice','Ref No','Selisih','Status','dkurs','Date Pay','No Kwn'],
			colModel:[
				{name:'myac',index:'', width:50, fixed:true, sortable:false, resize:false, align: 'center'},
				{name:'bstdo',index:'bstdo', width:40,editable: false},
				{name:'ppjk',index:'ppjk', width:60, sorttype:"int", editable: false},
				{name:'agen',index:'agen',width:40, editable:false, align: 'center'},
				{name:'kapal',index:'kapal', width:60, editable: false},
				{name:'rute',index:'rute', width:60, editable: false},
				{name:'tglinv',index:'tglinv', width:60, editable: false, align: 'center'},
				{name:'pajak',index:'pajak', width:60, editable: false},
				{name:'noinv',index:'noinv', width:60, editable: false},
				{name:'refno',index:'refno', width:60, editable: false},
				{name:'selisih',index:'selisih', width:60, editable: false},
				{name:'status',index:'status', width:60, editable: false, formatter:status},
				{name:'dkurs',index:'dkurs', width:60, editable: false},
				{name:'tgl_pay',index:'tgl_pay', width:60, editable: false},
				{name:'no_kwn',index:'no_kwn', width:60, editable: false}
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

		function status( cellvalue, options, cell ) {
			// setTimeout(function(){
			// 	$(cell) .find('input[type=checkbox]')
			// 		.addClass('ace ace-switch ace-switch-5')
			// 		.after('<span class="lbl"></span>');
			// }, 0);
			file_c=pay_c="grey";
			url=url2=url3=on_click='';
			// console.log(cell);
			if (cell[5]=="Domestic" && cell[6]!=="" && cell[7]!==null && cell[8]!==null && cell[9]!==null){
				file_c="orange";
				on_click = "kwitansi('"+cellvalue+"','"+cell[13]+"','"+cell[14]+"')";
				url="href='{{ url('oprasional/PDFInvoice') }}?page=invoice-dompdf&id="+cellvalue+"'";
				url2="href='{{ url('oprasional/PDFInvoice') }}?page=invoice-dompdf2&id="+cellvalue+"'";
			} else if (cell[5]=="Internasional" && cell[6]!=="" && cell[7]!==null && cell[8]!==null && cell[9]!==null && cell[12]!==""){
				console.log();
				file_c="orange";
				on_click = "kwitansi('"+cellvalue+"','"+cell[13]+"','"+cell[14]+"')";
				if (cell[2].indexOf('PCM-') === 0){
					url="href='{{ url('oprasional/PDFInvoice') }}?page=inv_khusus-dompdf&id="+cellvalue+"'";
					url2="href='{{ url('oprasional/PDFInvoice') }}?page=inv_khusus-dompdf2&id="+cellvalue+"'";
				} else {
					url="href='{{ url('oprasional/PDFInvoice') }}?page=invoice-dompdf&id="+cellvalue+"'";
					url2="href='{{ url('oprasional/PDFInvoice') }}?page=invoice-dompdf2&id="+cellvalue+"'";
				}
			}// var gsr = $(this).jqGrid('getGridParam','selrow');
			// tglinv = $(this).jqGrid('getCell',gsr,'tglinv');
			if (cell[13]!==''&&cell[13]!==undefined&&cell[14]!==null&&cell[14]!==undefined){
				pay_c="orange";
				on_click = "kwitansi('"+cellvalue+"','"+cell[13]+"','"+cell[14]+"')";
				url3="href='{{ url('oprasional/PDFInvoice') }}?page=kwitansi-dompdf&id="+cell[14]+"'";
			}
			console.log(cell[14]);
			return '<div><a class="fa fa-file-pdf-o '+ file_c +'" '+url+'  method="POST" target="_blank"></a> <a class="fa fa-file-pdf-o '+
			file_c +'" '+url2+' method="POST" target="_blank"></a> <a class="fa fa-credit-card '+
			pay_c +'" onclick="'+on_click+'"></a> <a class="fa fa-file-pdf-o '+
			pay_c +'" '+url3+' method="POST" target="_blank"></a></div>';
		}

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

		var i=0;
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
					// var gsr = $(this).jqGrid('getGridParam','selrow');
					// var ppjks_id = $(this).jqGrid('getCell',gsr,'ppjks_id');
					//
		      // return { datatb:'lstp', ppjks_id:ppjks_id,dls_id:gsr,_token:'<?php echo csrf_token();?>'};
					alert(1);
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
		      return { datatb:'dl',_token:'<?php echo csrf_token();?>'};
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
					$('.tgl').datepicker('update', '');
					var gsr = $(this).jqGrid('getGridParam','selrow');
					if(gsr){

						tglinv = $(this).jqGrid('getCell',gsr,'tglinv');
						pajak = $(this).jqGrid('getCell',gsr,'pajak');
						noinv = $(this).jqGrid('getCell',gsr,'noinv');
						refno = $(this).jqGrid('getCell',gsr,'refno');
						dkurs = $(this).jqGrid('getCell',gsr,'dkurs');
						rute = $(this).jqGrid('getCell',gsr,'rute');
						selisih = $(this).jqGrid('getCell',gsr,'selisih');

						var posdata= {'datatb':'nomor_akhir',cari:gsr};
						getparameter("{{url('/api/oprasional/invoice/json')}}",posdata,function(data){
							if (pajak === "")$('#pajak').val(data.nextfaktur); else $('#pajak').val(pajak);
							if (noinv === "")$('#noinv').val(data.nextinvoice); else $('#noinv').val(noinv);
						});

						// if (noinv)$('#noinv').val(noinv); else $('#noinv').val("0000-00/AF19.XX");
						// console.log($('#noinv').val());
						// $('#pajak').val(pajak);
						// $('#noinv').val(noinv);
						$('#refno').val(refno);
						$('#selisih').val(selisih);

						//
						$('#tglinv').datepicker("setDate",tglinv);
						if (rute==='Domestic'){
							$('#dkurs').prop('disabled', true);
							$('#kurs').prop('disabled', true);
						} else {
							$('#dkurs').datepicker("setDate",dkurs);
							$('#dkurs').prop('disabled', false);
							$('#kurs').prop('disabled', false);
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
					if (setdate !== ''){
						window.open("{{url('oprasional/PDFInvoice')}}/?page=report_invoice-dompdf&mulai="+setdate, '_blank');

						// var posdata= {page:'report_invoice-dompdf',mulai:setdate, _token:'{{ csrf_token() }}'};
						// $.ajax({
						// 	type: "POST",
						//   url: "{{url('oprasional/PDFInvoice')}}",
						// 	data: posdata,
						//   success: function(data) {
						//
						// 	}
						// });
					}else{
						alert('tetntukan tanggal terlebih dahulu');
					}
				}
		});

		$('#search').on('keypress',function(e) {
	    if(e.which == 13) {
				s_id='';
      	jQuery(grid_selector).jqGrid('setGridParam', { postData: {datatb:'invoice',s_id:s_id,_token:'{{ csrf_token() }}'} }).trigger("reloadGrid");
	    }
		});
		$("#search").autocomplete({
			source: function( request, response ) {
				var postcar= {'datatb':'ppjk', cari: request.term, _token:'{{ csrf_token() }}'};
				getparameter("{{url('/api/oprasional/invoice/autoc')}}",postcar,function(data){
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
			minLength: 1,
			select: function( event, ui ) {
				jQuery(grid_selector).jqGrid('setGridParam', { postData: {datatb:'invoice',s_id:ui.item.id,_token:'{{ csrf_token() }}'} }).trigger("reloadGrid");
				console.log(ui.item.id);
				// parameters = {datatb:'ppjk',start:start,end:end,_token:'{{ csrf_token() }}'};
			},
		});


		$(document).one('ajaxloadstart.page', function(e) {
			$.jgrid.gridDestroy(grid_selector);
			$('.ui-jqdialog').remove();
		});
	});

	function kwitansi(cellvalue,date,nokiwitansi){

		$('#form_kwitansi').trigger("reset");
		$('.tgl').datepicker('update', '');

		$('#id_kwn').val(cellvalue);
		if (date!=='null') $('#tgl_pay').datepicker("setDate",date);
		if (nokiwitansi!=='null') $('#no_kwn').val(nokiwitansi);

		$('#modal_kwitansi').modal('show');
		// alert(date);
	}
</script>

@endsection
