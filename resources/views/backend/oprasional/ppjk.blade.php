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
				<form id="validation-form">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 class="smaller lighter blue no-margin">Form PPJK </h3>
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
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Tgl Dok </label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-9 tgl" type="text" id="date_issue" name="date_issue" readonly></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>
							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">No. PPJK </label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-9" type="text" id="ppjk" name="ppjk"></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>
							</div>
						</div>
						<div class="hr"></div>
						<div class="row">
							<div class="col-xs-12 col-sm-6">

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Agen </label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												<select id="agen" name="agen" class="chosen-select" data-placeholder="Agen ..." >
													<option></option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Alamat </label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-7" type="text" id="alamat" name="alamat" disabled></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">NPWP</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-4" type="text" id="npwp" name="npwp" disabled></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">No. Tlp / Hp </label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-8" type="text" id="tlp" name="tlp" disabled></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>
							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Kapal </label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												<select id="kapal" name="kapal" class="chosen-select" data-placeholder="Kapal ..." >
													<option></option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Bendera </label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-7" type="text" id="bendera" name="bendera" disabled></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">DWT </label>
										<div class="col-xs-12 col-sm-3">
											<div class="clearfix">
												<input class="input-sm col-sm-12" type="text" id="dwt" name="dwt" disabled>
											</div>
										</div>
										<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="comment">GRT </label>
										<div class="col-xs-12 col-sm-3">
											<div class="clearfix"><input class="input-sm col-sm-12" type="text" id="grt" name="grt" disabled></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">LOA </label>
										<div class="col-xs-12 col-sm-3">
											<div class="clearfix">
												<input class="input-sm col-sm-12" type="text" id="loa" name="loa" disabled>
											</div>
										</div>
										<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="comment">Draft </label>
										<div class="col-xs-12 col-sm-3">
											<div class="clearfix"><input class="input-sm col-sm-12" type="text" id="draf" name="draf" disabled></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>
							</div>
						</div>

						<div class="hr"></div>

						<div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Dermaga</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												<select id="jetty" name="jetty" class="chosen-select" data-placeholder="Dermaga ..." >
													<option></option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">ETA - ETD </label>
										<div class="col-xs-12 col-sm-9">
												<div class="clearfix"><input class="input-sm col-sm-9" type="text" name="etad" id="etad" readonly/></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Rute</label>
										<div class="col-xs-12 col-sm-6">
											<div class="clearfix">
												<select id="rute" name="rute" class="chosen-select" data-placeholder="Rute ..." >
													<option ></option>
													<option value="Rp">Domestik</option>
													<option value="$">Internasional</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Etmal</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-4" type="text" id="etmal" name="etmal"></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>

							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">P Asal</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-8" type="text" id="asal" name="asal"></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">P Tujuan</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-8" type="text" id="tujuan" name="tujuan"></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Cargo</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm" type="text" id="cargo" name="cargo"></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Bongkar/Muat</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-3" type="text" id="muat" name="muat"></div>
										</div>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Keterangan</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix"><input class="input-sm col-sm-12" type="text" id="ket" name="ket"></div>
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
					<div align="center">Daftar PPJK<br />
							Priode : <span class="editable" id="psdate"></span> s.d. <span class="editable" id="pedate"></span>
					</div>
					</br>

					<form id="dompdf" role="form" method="POST" action="{{ url('oprasional/PDFAdmin') }}" target="_blank">
						{!! csrf_field() !!}
						<input name="page" value="" hidden/>
						<input name="file" value="" hidden/>
						<input name="start" value="" hidden/>
						<input name="end" value="" hidden/>
					</form>

					<div class="row">
		        <div class="col-xs-12">
							<input class="input-sm col-xs-3" type="text" id="search" name="search">
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
	<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap-datetimepicker.min.js') }}"></script>
	<script src="{{ asset('/js/daterangepicker.min.js') }}"></script>

	<script src="{{ asset('js/jquery.jqGrid.min.js') }}"></script>
	<script src="{{ asset('js/grid.locale-en.js') }}"></script>

	<script src="{{ asset('js/bootstrap-multiselect.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap-editable.min.js') }}"></script>
	<script src="{{ asset('/js/ace-editable.min.js') }}"></script>

	<script src="{{ asset('/js/chosen.jquery.min.js') }}"></script>
	<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>

<script type="text/javascript">

	jQuery(function($) {

		//editables on first profile page
    $.fn.editable.defaults.mode = 'inline';
    $.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
                                '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';

		$('#psdate').html(moment().startOf('month').format('D MMMM YYYY'));
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

		$('#etad').daterangepicker({
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

		// $('#on, #off').datetimepicker({
		// 		format: 'LT',
		// 		format: 'HH:mm',
		// 		date: nowdate,
		// });
		// alert(moment().startOf('minute'));

		var posdata = {'datatb':'agen', _token:'{{ csrf_token() }}'};
		posdata.src="{{url('/api/oprasional/json')}}";
		posdata.elm="agen";
		src_chosen_full(posdata,function(data){
			$.each(data, function (idx, obj) {
	      $('#agen').append('<option value="'+obj['id']+'">('+obj['code']+') '+obj['name']+'</option>');
	    });
		},function(data){
			if (data === undefined || data.length == 0) {
				$("#alamat").val('');
				$("#npwp").val('');
				$("#tlp").val('');
			} else {
				$("#alamat").val(data[0].alamat);
				$("#npwp").val(data[0].npwp);
				$("#tlp").val(data[0].tlp);
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
				$("#bendera").val('');
				$("#dwt").val('');
				$("#grt").val('');
				$("#loa").val('');
				$("#draft").val('');
			} else {
				$("#bendera").val(data[0].bendera);
				$("#dwt").val(Numbers(data[0].dwt));
				$("#grt").val(Numbers(data[0].grt));
				$("#loa").val(Numbers(data[0].loa));
				$("#draft").val(Numbers(data[0].draft));
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

		$('#validation-form').validate({
				errorElement: 'div',
				errorClass: 'help-block',
				focusInvalid: false,
				ignore: "",
				rules: {
						ppjk:{
							required:true,
						},
						agen:{
							required:true
						},
						kapal:{
							required:true
						},
						jetty:{
							required:true
						},
						rute:{
							required:true
						},
						// etmal:{
						// 	required:true
						// },
						// asal:{
						// 	required:true
						// },
						// tujuan:{
						// 	required:true
						// },
						// cargo:{
						// 	required:true
						// },
						// muat:{
						// 	required:true
						// },
				},

				messages: {
						// email: {
						// 		required: "Please provide a valid email.",
						// 		email: "Please provide a valid email."
						// },
						// password: {
						// 		required: "Please specify a password.",
						// 		minlength: "Please specify a secure password."
						// },
						// state: "Please choose state",
						// subscription: "Please choose at least one option",
						// gender: "Please choose gender",
						// agree: "Please accept our policy"
				},


				highlight: function (e) {
						$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
				},

				success: function (e) {
						$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
						$(e).remove();
				},

				errorPlacement: function (error, element) {
						if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
								var controls = element.closest('div[class*="col-"]');
								if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
								else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
						}
						else if(element.is('.select2')) {
								error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
						}
						else if(element.is('.chosen-select')) {
								error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
						}
						else error.insertAfter(element.parent());
				},

				submitHandler: function (form) {
				},
				invalidHandler: function (form) {
				},

		});

		jQuery.validator.addMethod("ppjk", function(value, element) {

			post = {'datatb':'ppjk','selectby':'ppjk','select':value};
			$.ajax({
				url : "{{url('/api/oprasional/json')}}",
				type : 'post',
				async: false,
				data : post,
				dataType: 'json',
				success : function(response){
					return data=response;
				}
			});
			// console.log(postsave.post);
			if (data.length===0) return true; else return false;
		}, 'PPJK is already exist.');


		var postsave={};
		postsave.url = "{{url('/api/oprasional/cud')}}";
		postsave.grid = '#grid-table';
		postsave.modal = '#modal';
		$('#save').click(function(e) {
			e.preventDefault();
			postsave.post += $("#validation-form").serialize()+'&datatb=ppjk';
			// console.log($('#ppjk').valid(
			// 	rules: {
			//
			// 	}
			// ));
			if ($('#validation-form').valid())	saveGrid(postsave);
			// postsave.post = '';
		});

		$( "#ppjk" ).change(function() {
			$('#ppjk').valid();
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
		var parameters = {datatb:'ppjk',start:start,end:end,_token:'{{ csrf_token() }}'};

		jQuery(grid_selector).jqGrid({
			caption: "Input PPJK",
      datatype: "json",            //supported formats XML, JSON or Arrray
      mtype : "post",
      postData: parameters,
			url:"{{url('/api/oprasional/jqgrid')}}",
			editurl: "{{url('/api/oprasional/cud')}}",//nothing is saved
			sortname:'date_issue',
			sortorder: 'desc',
			height: 'auto',
			colNames:['id','Date Issue','PPJK','Agen','Kapal','Jetty','ETA','ETD','Asal','Tujuan','Etmal','Cargo','Muatan','lstp_req','lstp_aprv','lstp','Ket'],
			colModel:[
				{name:'id',index:'id', width:40, fixed:true, sortable:true, resize:false, align: 'center'},
				{name:'date_issue',index:'date_issue', width:50, sorttype:"int"},
				{name:'ppjk',index:'ppjk', width:60},
				{name:'agen',index:'agen',width:30, align: 'center'},
				{name:'kapal',index:'kapal', width:90},
				{name:'jetty',index:'jetty', width:90},
				{name:'eta',index:'eta', width:80, align: 'center'},
				{name:'etd',index:'etd', width:80, sortable:false, align: 'center'},
				{name:'asal',index:'asal', width:70},
        {name:'tujuan',index:'tujuan', width:70},
        {name:'etmal',index: 'etmal', width: 50, align: 'center'},
        {name:'cargo',index:'cargo',width:50, align: 'center'},
				{name:'muatan',index:'muatan',width:50, align: 'center'},
				{name:'lstp_req',index:'lstp_req',width:50, align: 'center',hidden:true},
				{name:'lstp_aprv',index:'lstp_aprv',width:50, align: 'center',hidden:true},
				{name:'lstp',index:'lstp',width:50, align: 'center',hidden:true},
				{name:'ket',index:'ket',width:50, align: 'center'}
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
					$('#validation-form').trigger("reset");
					$( "#ppjk" ).rules("remove",'ppjk');
					// $('#ppjk').prop('readonly', true);

					var gsr = $(this).jqGrid('getGridParam','selrow');
					if(gsr){
						$('#ppjk').val($(this).jqGrid('getCell',gsr,'ppjk'));
						$('#etmal').val($(this).jqGrid('getCell',gsr,'etmal'));
						$('#asal').val($(this).jqGrid('getCell',gsr,'asal'));
						$('#tujuan').val($(this).jqGrid('getCell',gsr,'tujuan'));
						$('#cargo').val($(this).jqGrid('getCell',gsr,'cargo'));
						$('#muat').val($(this).jqGrid('getCell',gsr,'muatan'));
						$('#ket').val($(this).jqGrid('getCell',gsr,'ket'));

						var posdata= {'datatb':'ppjk','search':gsr};
						getparameter("{{url('/api/oprasional/json')}}",posdata,function(data){

							$('#agen').val(data[0].agens_id).trigger('chosen:updated').trigger("change");
							$('#kapal').val(data[0].kapals_id).trigger('chosen:updated').trigger("change");
							$('#jetty').val(data[0].jettys_idx).trigger('chosen:updated').trigger("change");
							$('#rute').val(data[0].rute).trigger('chosen:updated').trigger("change");

							$('#date_issue').datepicker("setDate", moment.unix(data[0].date_issue).format("DD MMMM YYYY"));
							$('#etad')
								.data('daterangepicker')
								.setStartDate(moment.unix(data[0].eta).format("DD/MM/YY HH:mm"));
							$('#etad')
								.data('daterangepicker')
								.setEndDate(moment.unix(data[0].etd).format("DD/MM/YY HH:mm"));
						});
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
			buttonicon:"ace-icon fa fa-plus-circle purple",
			position:"first",
			onClickButton:function(){
				$('#validation-form').trigger("reset");

				$('#ppjk').prop('readonly', false);

				$('.tgl').datepicker("setDate", '{{date("d F Y")}}');
				$('#agen, #kapal, #jetty').val('').trigger("chosen:updated");

				$('#etad')
					.data('daterangepicker')
					.setStartDate('{{date("d/m/y H:i")}}');
				$('#etad')
					.data('daterangepicker')
					.setEndDate('{{date("d/m/y H:i",strtotime("+1 hours"))}}');

				$( "#ppjk" ).rules("add",{ppjk:true});

				postsave.post = '';
				postsave.post += 'oper=add&';
				$('#modal').modal('show');
			}
		}).jqGrid('navButtonAdd',pager_selector,{
				keys: true,
				caption:"",
				buttonicon:"ace-icon fa fa-file-pdf-o orange",
				position:"last",
				onClickButton:function(){
					// var data = $(this).jqGrid('getRowData'); Get all data

					$('#dompdf input[name=page]').val('ppjk1-dompdf');
					// $('#dompdf input[name=bstdo]').val($('#NoBSTDO').html());
					$('#dompdf input[name=start]').val(start);
					$('#dompdf input[name=end]').val(end);
					$('#dompdf input[name=sidx]').val('ppjk');

					// console.log(setdate);

					$('#dompdf').submit();
				}
		})
		// .jqGrid('navButtonAdd',pager_selector,{
		// 		keys: true,
		// 		caption:"",
		// 		buttonicon:"ace-icon fa fa-file-pdf-o orange",
		// 		position:"last",
		// 		onClickButton:function(){
		// 			// var data = $(this).jqGrid('getRowData'); Get all data
		//
		// 			$('#dompdf input[name=page]').val('ppjk2-dompdf');
		// 			// $('#dompdf input[name=bstdo]').val($('#NoBSTDO').html());
		// 			$('#dompdf input[name=start]').val(start);
		// 			$('#dompdf input[name=end]').val(end);
		// 			$('#dompdf input[name=sidx]').val('ppjk');
		//
		// 			// console.log(setdate);
		//
		// 			$('#dompdf').submit();
		// 		}
		// })
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
