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
      <form id="print-1" role="form" method="POST" action="{{ url('oprasional/PDFReport') }}" target="_blank">
          {!! csrf_field() !!}
          <input name="case" value="rute" type="hidden"/>
          <input name="start" value="" type="hidden"/>
          <input name="end" value="" type="hidden"/>
          <input name="divisi" value="5" type="hidden"/>
          <input name="page" value="absen" type="hidden"/>
          <input name="img" value="" type="hidden"/>
      </form>
      <form id="print-2" role="form" method="POST" action="{{ url('oprasional/PDFReport') }}" target="_blank">
          {!! csrf_field() !!}
          <input name="case" value="gerakan" type="hidden"/>
          <input name="start" value="" type="hidden"/>
          <input name="end" value="" type="hidden"/>
          <input name="divisi" value="5" type="hidden"/>
          <input name="page" value="absen" type="hidden"/>
          <input name="img" value="" type="hidden"/>
      </form>
      <form id="print-3" role="form" method="POST" action="{{ url('oprasional/PDFReport') }}" target="_blank">
          {!! csrf_field() !!}
          <input name="case" value="rutegrt" type="hidden"/>
          <input name="start" value="" type="hidden"/>
          <input name="end" value="" type="hidden"/>
          <input name="divisi" value="5" type="hidden"/>
          <input name="page" value="absen" type="hidden"/>
          <input name="img" value="" type="hidden"/>
      </form>
      <form id="print-4" role="form" method="POST" action="{{ url('oprasional/PDFReport') }}" target="_blank">
          {!! csrf_field() !!}
          <input name="case" value="pandu" type="hidden"/>
          <input name="start" value="" type="hidden"/>
          <input name="end" value="" type="hidden"/>
          <input name="divisi" value="5" type="hidden"/>
          <input name="page" value="absen" type="hidden"/>
          <input name="img" value="" type="hidden"/>
      </form>

      <div align="center">Data Report<br />
        Priode : <span class="editable" id="psdate"></span> s.d. <span class="editable" id="pedate"></span>
      </div>
      <div class="row">
        <div class="col-xs-2 btn-group">
            <button data-toggle="dropdown" class="btn btn-sm btn-danger dropdown-toggle">
                Unduh / Print
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>

            <ul class="dropdown-menu dropdown-danger">
                <li><a href="#" id="print6">PPJK</a></li>
                <li><a href="#" id="print7">Form</a></li>
                <li><a href="#" id="print8">Bulanan</a></li>
            </ul>
        </div><!-- /.btn-group -->
      </div>
      <div class="row">

          <div class="col-sm-6" >
              <div class="widget-box">
                  <div class="widget-header widget-header-flat widget-header-small">
                      <h5 class="widget-title">
                          <i class="ace-icon fa fa-signal"></i>
                          Grafik Rute
                      </h5>

                      <div class="widget-toolbar no-border">
                        <div class="inline">
                          <button class="btn btn-minier btn-primary" id='print1'>
                            Convert PDF
                          </button>
                        </div>
                      </div>
                  </div>

                  <div class="widget-body">
                      <div class="widget-main">
                        <div>
                          <canvas id="rute"></canvas>
                        </div>
                      </div><!-- /.widget-main -->
                  </div><!-- /.widget-body -->
              </div><!-- /.widget-box -->
          </div><!-- /.col -->
          <div class="col-sm-6" >
              <div class="widget-box">
                  <div class="widget-header widget-header-flat widget-header-small">
                      <h5 class="widget-title">
                          <i class="ace-icon fa fa-signal"></i>
                          Grafik Gerakan
                      </h5>

                      <div class="widget-toolbar no-border">
                        <div class="inline">
                          <button class="btn btn-minier btn-primary" id='print2'>
                            Convert PDF
                          </button>
                        </div>
                      </div>
                      <div class="widget-toolbar no-border">
                          <div class="inline dropdown-hover">
                              <button class="btn btn-minier btn-primary">
                                  This Week
                                  <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                              </button>

                              <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                                  <li class="active">
                                      <a href="#" class="blue">
                                          <i class="ace-icon fa fa-caret-right bigger-110">&nbsp;</i>
                                          This Week
                                      </a>
                                  </li>

                                  <li>
                                      <a href="#">
                                          <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                          Last Week
                                      </a>
                                  </li>

                                  <li>
                                      <a href="#">
                                          <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                          This Month
                                      </a>
                                  </li>

                                  <li>
                                      <a href="#">
                                          <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                          Last Month
                                      </a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>

                  <div class="widget-body">
                      <div class="widget-main">
                        <div>
                          <canvas id="gerakan"></canvas>
                        </div>
                      </div><!-- /.widget-main -->
                  </div><!-- /.widget-body -->
              </div><!-- /.widget-box -->
          </div><!-- /.col -->
          <div class="col-sm-6" >
              <div class="widget-box">
                  <div class="widget-header widget-header-flat widget-header-small">
                      <h5 class="widget-title">
                          <i class="ace-icon fa fa-signal"></i>
                          Grafik Rute Berdasarkan GRT
                      </h5>

                      <div class="widget-toolbar no-border">
                        <div class="inline">
                          <button class="btn btn-minier btn-primary" id='print3'>
                            Convert PDF
                          </button>
                        </div>
                      </div>
                      <div class="widget-toolbar no-border">
                          <div class="inline dropdown-hover">
                              <button class="btn btn-minier btn-primary">
                                  This Week
                                  <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                              </button>

                              <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                                  <li class="active">
                                      <a href="#" class="blue">
                                          <i class="ace-icon fa fa-caret-right bigger-110">&nbsp;</i>
                                          This Week
                                      </a>
                                  </li>

                                  <li>
                                      <a href="#">
                                          <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                          Last Week
                                      </a>
                                  </li>

                                  <li>
                                      <a href="#">
                                          <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                          This Month
                                      </a>
                                  </li>

                                  <li>
                                      <a href="#">
                                          <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                          Last Month
                                      </a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>

                  <div class="widget-body">
                      <div class="widget-main">
                        <div>
                          <canvas id="rutegrt"></canvas>
                        </div>
                      </div><!-- /.widget-main -->
                  </div><!-- /.widget-body -->
              </div><!-- /.widget-box -->
          </div><!-- /.col -->
          <div class="col-sm-6" >
              <div class="widget-box">
                  <div class="widget-header widget-header-flat widget-header-small">
                      <h5 class="widget-title">
                          <i class="ace-icon fa fa-signal"></i>
                          Grafik Pandu
                      </h5>

                      <div class="widget-toolbar no-border">
                        <div class="inline">
                          <button class="btn btn-minier btn-primary" id='print4'>
                            Convert PDF
                          </button>
                        </div>
                      </div>
                  </div>

                  <div class="widget-body">
                      <div class="widget-main">
                        <div>
                          <canvas id="pandu"></canvas>
                        </div>
                      </div><!-- /.widget-main -->
                  </div><!-- /.widget-body -->
              </div><!-- /.widget-box -->
          </div><!-- /.col -->

      </div><!-- /.row -->

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
    $('#print1').click(function() {
      var canvas = document.getElementById("rute");
      var img    = canvas.toDataURL("image/png");
      $('input[name="img"]').val(img);
      document.getElementById('print-1').submit();
      // console.log(img);
    });
    $('#print2').click(function() {
      var canvas = document.getElementById("gerakan");
      var img    = canvas.toDataURL("image/png");
      $('input[name="img"]').val(img);
      document.getElementById('print-2').submit();
    });
    $('#print3').click(function() {
      var canvas = document.getElementById("rutegrt");
      var img    = canvas.toDataURL("image/png");
      $('input[name="img"]').val(img);
      document.getElementById('print-3').submit();
    });
    $('#print4').click(function() {
      var canvas = document.getElementById("pandu");
      var img    = canvas.toDataURL("image/png");
      $('input[name="img"]').val(img);
      document.getElementById('print-4').submit();
    });



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
        $('input[name="end"]').val(params.newValue);
        setdate = end = params.newValue;
    });

    var setdate = moment().format('D MMMM YYYY');
    var start = $('#psdate').html();
    var end = $('#pedate').html();
    $('input[name="end"]').val(end);

    function newCart(prm){
      // create initial empty chart
      var ctx_live = document.getElementById(prm.id);
      ctx_live.height = 100;
      var myChart = new Chart(ctx_live, {
        type: 'line',
        data: {
          labels: [],
          datasets: [],
        },
        options: {
          responsive: true,
  				tooltips: {
  					mode: 'index',
  					intersect: 'true',
  				},
        }
      });

      var postData = {datatb:prm.id,start:start,end:end,type:'bulan',_token:'{{csrf_token()}}'};
      $.ajax({
          type: 'POST',
          url: "{{url('oprasional/Chart')}}",
          data: postData,
          beforeSend:function(){

          },
          success: function(tmp) {
            myChart.data.labels = tmp.label;
            myChart.data.datasets = tmp.ds;
            myChart.update();
            myChart.render({
                duration: 800,
                lazy: false,
                easing: 'easeOutBounce'
            });
            console.log(prm.id);
          },
      });
    }

    var rutePrm = new Array();
    rutePrm.id = 'rute';
    newCart(rutePrm);

    var gerakanPrm = new Array();
    gerakanPrm.id = 'gerakan';
    newCart(gerakanPrm);

    var rutegrtPrm = new Array();
    rutegrtPrm.id = 'rutegrt';
    newCart(rutegrtPrm);

    var panduPrm = new Array();
    panduPrm.id = 'pandu';
    newCart(panduPrm);


  });
</script>
@endsection
