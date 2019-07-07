@extends('backend.app_backend')

@section('css')
    <!-- page specific plugin styles -->
		<link href="{{ asset('css/ui.jqgrid.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/css/bootstrap-editable.min.css') }}" rel="stylesheet">
		<link href="{{ asset('/css/typeahead.js-bootstrap.css') }}" rel="stylesheet">

		<link href="{{ asset('css/bootstrap-multiselect.min.css') }}" rel="stylesheet">

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

						<div align="center">BSTDO</div>
						<div class="col-xs-12 col-sm-6">
	            <div class="profile-user-info profile-user-info-striped ">
	                <div class="profile-info-row">
	                    <div class="profile-info-name"> No BSTDO </div>

	                    <div class="profile-info-value">
	                        <span id="NoBSTDO" data-type="typeaheadjs" data-pk="1" data-placement="right" data-title="No BSTDO">11000</span>
	                    </div>
	                </div>
									<div class="profile-info-row">
	                    <div class="profile-info-name"> LIST PPJK </div>

	                    <div class="profile-info-value">
	                    </div>
	                </div>
	            </div>
						</div>
						<select id="ppjk" class="multiselect" multiple="">
							<option value=""></option>
						</select>

            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('js')
	<script src="{{ asset('/js/moment.min.js') }}"></script>

	<script src="{{ asset('js/bootstrap-multiselect.min.js') }}"></script>

	<script src="{{ asset('/js/bootstrap-editable.min.js') }}"></script>
	<script src="{{ asset('/js/ace-editable.min.js') }}"></script>
	<script src="{{ asset('/js/typeahead.js') }}"></script>
	<script src="{{ asset('/js/typeaheadjs.js') }}"></script>

	<!-- inline scripts related to this page -->
	<script type="text/javascript">
	  jQuery(function($) {

	    //editables on first profile page
	    $.fn.editable.defaults.mode = 'inline';
	    $.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
	    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
	                                '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';
																	var setdate = moment().format('D MMMM YYYY');
			$('#state2').editable({
				value: 'cxa',
				typeahead: {
					 name: 'state',
					 local: ["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]
				}
			});

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
					postsave = {datatb:'lstp_ck',id:option.val(),checked:checked,lstp_ck:setdate};
					getparameter("{{url('/api/oprasional/cud')}}",postsave,	function(data){
						$(grid_selector).jqGrid('setGridParam',{postData:{lstp_ck:setdate}}).trigger("reloadGrid");
					},function(data){});
				}
			});

			function get_ppjk(setdate){
				var posdata= {'datatb':'ppjk', _token:'{{ csrf_token() }}',lhp_date:setdate};
				var $select_elem = $("#ppjk");
				// $select_elem.empty();
				$select_elem.html('');
				getparameter("{{url('/api/oprasional/json')}}",posdata,function(data){
					// console.log(data);
					$.each(data, function (idx, obj) {
						if (data[idx].lstp_ck === null){
							var selected = '';
						} else {
							selected = 'selected';
						}

						if ((moment(setdate, "D MMMM YYYY") == data[idx].lstp_ck+'000') || (data[idx].lstp_ck === null) && (data[idx].bstdo !== null)){
							$select_elem.append('<option value="'+data[idx].id+'" '+selected+'>'+data[idx].ppjk+'</option>');
						}
					});

					$select_elem.multiselect('rebuild');
				},function(data){});
			}

			get_ppjk(setdate);

	  });
	</script>
@endsection
