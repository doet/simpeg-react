@extends('backend.app_backend')

@section('css')
	<!-- <link rel="stylesheet" href="{{ asset('css/ui.jqgrid.min.css') }}" /> -->
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

					<a href="#" id="state2" data-type="typeaheadjs" data-pk="1" data-placement="right" data-title="Start typing State.."></a>


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

<script src="{{ asset('/js/jquery.jqGrid.min.js') }}"></script>
<script src="{{ asset('/js/grid.locale-en.js') }}"></script>

<script src="{{ asset('/js/bootstrap-multiselect.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-editable.min.js') }}"></script>
<script src="{{ asset('/js/ace-editable.min.js') }}"></script>

<script src="{{ asset('/js/chosen.jquery.min.js') }}"></script>
<script src="{{ asset('/js/jquery-typeahead.js') }}"></script>

<!-- <script src="{{ asset('/js/typeahead.js') }}"></script>
<script src="{{ asset('/js/typeaheadjs.js') }}"></script> -->

<script type="text/javascript">
	jQuery(function($) {
		//editables on first profile page
		$.fn.editable.defaults.mode = 'inline';
		$.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
		$.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
																'<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';


		$('#state2').editable({
			value: 'cxa',
			typeahead: {
				 name: 'state',
				 local: ["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]
			}
		});
});
</script>


@endsection
