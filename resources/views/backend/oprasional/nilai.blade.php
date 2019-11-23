
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

                            <li class="">
                                <a data-toggle="tab" href="#home" onclick="load('oprasional/msum','#isi')">
                                    <i class="green ace-icon fa fa-home bigger-120"></i>
                                    Sharing
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
      legend: [1, 9, 12, 15, 18],
      onComplete: function() {
        // loadcal();
      },
      afterLoad: function() {
        // setTimeout(function(){
        //   loadinput(tgl);
        // }, 1000);
      },
      onClick: function(date, nb) {
        tgl = moment(date).unix();

        $('#tgl').html(moment.unix(tgl).format("DD MMM Y"));
        $('[name=tgl]').val(tgl);
        $('#pn').trigger("reset");

        loadinput($('[name=group]').val(),tgl);

     }
    });

    function loadcal(group=''){
      var calData = {} ;
      var posdata= {'datatb':'mtarif','search':'','group':group};
      getparameter("{{url('/api/oprasional/json')}}",posdata,function(data){
        cal.update(data.date);
      })
    }

    function loadinput(group='',search=''){
      var posdata= {'datatb':'mtarif','group':group,'search':search};
      getparameter("{{url('/api/oprasional/json')}}",posdata,function(data){
        if (typeof data.data !== 'undefined'){
          $('#tgl_b').html(moment.unix(data.data[0]['date']).format("DD MMM Y"));
          if (data.data[0].desc.includes("bht_")) {
            data.data.map(function(a,i){
              d = a.desc.split("_");
              $('[name="bht['+ d[1] +']"]').val( a.value );
            })
          } else {
            data.rd.map(function(a,i){
              $( "#pn" ).children('div').children('div').children('[name="grt[]"]').eq(i).val(a.grt);
              $( "#pn" ).children('div').children('div').children('[name="value[]"]').eq(i).val(a.value);
              $( "#pn" ).children('div').children('div').children('[name="var[]"]').eq(i).val(a.var);
            });
          }
        }
      })
    }

    load("oprasional/mdnilai","#isi");
  // });
</script>
@endsection
