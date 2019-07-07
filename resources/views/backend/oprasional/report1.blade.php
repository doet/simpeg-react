@extends('backend.app_backend')

@section('css')
    <!-- page specific plugin styles -->
  	<link rel="stylesheet" href="{{ asset('/css/bootstrap-editable.min.css') }}" />
  <style>
  	canvas {
  		-moz-user-select: none;
  		-webkit-user-select: none;
  		-ms-user-select: none;
  	}
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
  <div class="row">
    <div class="col-xs-12">
      <!-- PAGE CONTENT BEGINS -->
      <div align="center">Data Report<br />
        Priode : <span class="editable" id="psdate"></span> s.d. <span class="editable" id="pedate"></span>
      </div>
      <div style="width:90%;">
        <canvas id="mycanvas"></canvas>
      </div>
      <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
  </div><!-- /.row -->
@endsection

@section('js')
<script src="{{ asset('/js/moment.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-editable.min.js') }}"></script>
<script src="{{ asset('/js/ace-editable.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>

<script src="{{ asset('js/Chart.bundle.js') }}"></script>

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
        // $('input[name="start"]').val(params.newValue);
        setdate = end = params.newValue;
    });

    var setdate = moment().format('D MMMM YYYY');
    var start = $('#psdate').html();
    var end = $('#pedate').html();

    // create initial empty chart
    var ctx_live = document.getElementById("mycanvas");
    var myChart = new Chart(ctx_live, {
      type: 'line',
      data: {
        labels: [],
        datasets: [],
      },
      options: {
        responsive: true
      }
    });
    CartJetty();

    function CartJetty(fname){
        var postData = {datatb:'rute',_token:'{{csrf_token()}}'};
        $.ajax({
            type: 'POST',
            url: "{{url('oprasional/Chart')}}",
            data: postData,
            beforeSend:function(){

            },
            success: function(tmp) {
              var i=0;
              tmp.label.forEach(function(entry) {
                entry = new Date(entry*1000);
                tmp.label[i] = entry.getDate()+'/'+entry.getMonth();
                i++;
              });
              myChart.data.labels = tmp.label;
              myChart.data.datasets = tmp.ds;
              myChart.update();
              myChart.render({
                  duration: 800,
                  lazy: false,
                  easing: 'easeOutBounce'
              });
            },
        });
    }

  });
</script>
@endsection
