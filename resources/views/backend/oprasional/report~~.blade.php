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
			<div style="width:75%;">
				<canvas id="canvas"></canvas>
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

		window.chartColors = {
			red: 'rgb(255, 99, 132)',
			orange: 'rgb(255, 159, 64)',
			yellow: 'rgb(255, 205, 86)',
			green: 'rgb(75, 192, 192)',
			blue: 'rgb(54, 162, 235)',
			purple: 'rgb(153, 102, 255)',
			grey: 'rgb(201, 203, 207)'
		};

		(function(global) {
			var MONTHS = [
				'January',
				'February',
				'March',
				'April',
				'May',
				'June',
				'July',
				'August',
				'September',
				'October',
				'November',
				'December'
			];

			var COLORS = [
				'#4dc9f6',
				'#f67019',
				'#f53794',
				'#537bc4',
				'#acc236',
				'#166a8f',
				'#00a950',
				'#58595b',
				'#8549ba'
			];

			var Samples = global.Samples || (global.Samples = {});
			var Color = global.Color;

			Samples.utils = {
				// Adapted from http://indiegamr.com/generate-repeatable-random-numbers-in-js/
				srand: function(seed) {
					this._seed = seed;
				},

				rand: function(min, max) {
					var seed = this._seed;
					min = min === undefined ? 0 : min;
					max = max === undefined ? 1 : max;
					this._seed = (seed * 9301 + 49297) % 233280;
					return min + (this._seed / 233280) * (max - min);
				},

				numbers: function(config) {
					var cfg = config || {};
					var min = cfg.min || 0;
					var max = cfg.max || 1;
					var from = cfg.from || [];
					var count = cfg.count || 8;
					var decimals = cfg.decimals || 8;
					var continuity = cfg.continuity || 1;
					var dfactor = Math.pow(10, decimals) || 0;
					var data = [];
					var i, value;

					for (i = 0; i < count; ++i) {
						value = (from[i] || 0) + this.rand(min, max);
						if (this.rand() <= continuity) {
							data.push(Math.round(dfactor * value) / dfactor);
						} else {
							data.push(null);
						}
					}

					return data;
				},

				labels: function(config) {
					var cfg = config || {};
					var min = cfg.min || 0;
					var max = cfg.max || 100;
					var count = cfg.count || 8;
					var step = (max - min) / count;
					var decimals = cfg.decimals || 8;
					var dfactor = Math.pow(10, decimals) || 0;
					var prefix = cfg.prefix || '';
					var values = [];
					var i;

					for (i = min; i < max; i += step) {
						values.push(prefix + Math.round(dfactor * i) / dfactor);
					}

					return values;
				},

				months: function(config) {
					var cfg = config || {};
					var count = cfg.count || 12;
					var section = cfg.section;
					var values = [];
					var i, value;

					for (i = 0; i < count; ++i) {
						value = MONTHS[Math.ceil(i) % 12];
						values.push(value.substring(0, section));
					}

					return values;
				},

				color: function(index) {
					return COLORS[index % COLORS.length];
				},

				transparentize: function(color, opacity) {
					var alpha = opacity === undefined ? 0.5 : 1 - opacity;
					return Color(color).alpha(alpha).rgbString();
				}
			};

			// DEPRECATED
			window.randomScalingFactor = function() {
				return Math.round(Samples.utils.rand(-100, 100));
			};

			// INITIALIZATION

			Samples.utils.srand(Date.now());

			// Google Analytics
			/* eslint-disable */
			if (document.location.hostname.match(/^(www\.)?chartjs\.org$/)) {
				(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
				ga('create', 'UA-28909194-3', 'auto');
				ga('send', 'pageview');
			}
			/* eslint-enable */

		}(this));
    CartJetty();

    function CartJetty(fname){
        var postData = {datatb:'rute',start:start,end:end,type:'bulan',_token:'{{csrf_token()}}'};
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

		////////////////////////////////////////////////////
				var config = {
					type: 'line',
					data: {
						labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
						datasets: [{
							label: 'Unfilled',
							fill: false,
							backgroundColor: window.chartColors.blue,
							borderColor: window.chartColors.blue,
							data: [
								randomScalingFactor(),
								randomScalingFactor(),
								randomScalingFactor(),
								randomScalingFactor(),
								randomScalingFactor(),
								randomScalingFactor(),
								randomScalingFactor()
							],
						}, {
							label: 'Dashed',
							fill: false,
							backgroundColor: window.chartColors.green,
							borderColor: window.chartColors.green,
							borderDash: [5, 5],
							data: [
								randomScalingFactor(),
								randomScalingFactor(),
								randomScalingFactor(),
								randomScalingFactor(),
								randomScalingFactor(),
								randomScalingFactor(),
								randomScalingFactor()
							],
						}, {
							label: 'Filled',
							backgroundColor: window.chartColors.red,
							borderColor: window.chartColors.red,
							data: [
								randomScalingFactor(),
								randomScalingFactor(),
								randomScalingFactor(),
								randomScalingFactor(),
								randomScalingFactor(),
								randomScalingFactor(),
								randomScalingFactor()
							],
							fill: true,
						}]
					},
					options: {
						responsive: true,
						title: {
							display: true,
							text: 'Data Rute'
						},
						tooltips: {
							mode: 'index',
							intersect: false,
						},
						hover: {
							mode: 'nearest',
							intersect: true
						},
						scales: {
							xAxes: [{
								display: true,
								scaleLabel: {
									display: true,
									labelString: 'Month'
								}
							}],
							yAxes: [{
								display: true,
								scaleLabel: {
									display: true,
									labelString: 'Value'
								}
							}]
						}
					}
				};
        console.log(config.data);
				window.onload = function() {
					var ctx = document.getElementById('canvas').getContext('2d');
					window.myLine = new Chart(ctx, config);
				};

  });
</script>
@endsection
