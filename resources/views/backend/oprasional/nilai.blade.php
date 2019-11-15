
@extends('backend.app_backend')

@section('css')
<link rel="stylesheet" href="//cdn.jsdelivr.net/cal-heatmap/3.3.10/cal-heatmap.css" />

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
            <input name="tgl" type="hidden"/>
            <div id="cal-heatmap"></div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="tabbable">
                        <ul class="nav nav-tabs" id="myTab">

                            <li class="active">
                                <a data-toggle="tab" href="#home" onclick="load('oprasional/mdnilai','#isi')">
                                    <i class="green ace-icon fa fa-home bigger-120"></i>
                                    T.Domestik
                                </a>
                            </li>

                            <li class="">
                                <a data-toggle="tab" href="#home" onclick="load('oprasional/minilai','#isi')">
                                    <i class="green ace-icon fa fa-home bigger-120"></i>
                                    T.Internasional
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="isi" class="tab-pane fade in active">

                            </div>
                        </div>
                    </div>
                </div><!-- /.col -->
            </div>


            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('js')
<!-- inline scripts related to this page -->
<script type="text/javascript" src="//d3js.org/d3.v3.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/cal-heatmap/3.3.10/cal-heatmap.min.js"></script>
<script src="{{ asset('/js/moment.min.js') }}"></script>
<script type="text/javascript">
  // jQuery(function($) {

    var mdate = moment();
    tgl = mdate.startOf('day').unix();
    $('[name=tgl]').val(tgl);
    // $('#tgl').html(moment.unix(tgl).format("ll"));

    var cal = new CalHeatMap();
    cal.init({
      itemSelector: "#cal-heatmap",
      start: new Date(mdate.subtract(5, 'months').startOf('day').unix()*1000),
      domain: "month",
      subDomain: "day",
      range: 6,
      domainGutter: 10,
      displayLegend: false,
      legend: [1, 2, 3, 4],
      onComplete: function() {
        loaddata();
      },
      afterLoad: function() {
      },
      onClick: function(date, nb) {
        tgl = moment(date).unix();
        $('#tgl').html(moment.unix(tgl).format("ll"));
        $('[name=tgl]').val(tgl);
     }
    });

    function loaddata(){
      var calData = {} ;
      var posdata= {'datatb':'mkurs','search':1};
      getparameter("{{url('/api/oprasional/json')}}",posdata,function(data){
        data.map(function(element, index, array) {
          if (calData[element.date] === undefined)calData[element.date]=1; else calData[element.date] += 1;
        });
        cal.update(calData);
        // console.log(calData);
      })
    }

    load("oprasional/mdnilai","#isi");
  // });
</script>
@endsection
