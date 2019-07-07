@extends('backend.app_backend')

@section('css')
    <!-- page specific plugin styles -->

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
    <div class="page-header">
        <h1>
            Dashboard
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                overview &amp; stats
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->

            <div class="row">

                <div class="col-sm-3">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat widget-header-small">
                            <h5 class="widget-title">
                                <i class="ace-icon fa fa-signal"></i>
                                Traffic Sources
                            </h5>

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
                                <div id="piechart-placeholder"></div>
                            </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                    </div><!-- /.widget-box -->
                </div><!-- /.col -->
            </div><!-- /.row -->

            <div class="hr hr32 hr-dotted"></div>




            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('js')
    <!--[if lte IE 8]>
        <script src="{{asset('js/excanvas.min.js')}}"></script>
    <![endif]-->

    <!-- page specific plugin scripts -->
    <script src="{{ asset('/js/jquery.flot.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.flot.pie.min.js') }}"></script>

    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        jQuery(function($) {
          function drawPieChart(placeholder, data, position) {
              $.plot(placeholder, data, {
                series: {
                  pie: {
                    show: true,
                    tilt:0.9,
                    highlight: {
                      opacity: 0.25
                    },
                    stroke: {
                      color: '#fff',
                      width: 2
                    },
                    startAngle: 2
                  }
                },
                legend: {
                  show: true,
                  position: position || "ne",
                  labelBoxBorderColor: null,
                  margin:[0,0]
                },
                grid: {
                  hoverable: true,
                  clickable: true
                }
             })
         }
        var posdata= {'datatb':'r_rute','searchby':'rute'};
        getparameter("{{url('/api/oprasional/json')}}",posdata,function(data){
          var placeholder = $('#piechart-placeholder').css({'width':'100%' , 'min-height':'200px'});

          drawPieChart(placeholder, data);

          /**
          we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
          so that's not needed actually.
          */
          placeholder.data('chart', data);
          placeholder.data('draw', drawPieChart);


         //pie chart tooltip example
         var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
         var previousPoint = null;

         placeholder.on('plothover', function (event, pos, item) {
           if(item) {
             if (previousPoint != item.seriesIndex) {
               previousPoint = item.seriesIndex;
               var tip = item.series['label'] + " : " + Math.round(item.series['percent'])+'%';
               $tooltip.show().children(0).text(tip);
               console.log(item.series.data[0][1]);
             }
             $tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
           } else {
             $tooltip.hide();
             previousPoint = null;
           }

        });
      })




        })
    </script>
@endsection
