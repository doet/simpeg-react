
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
            <div id="cal-heatmap"></div>
            <h3 class="row header smaller lighter purple">
                <span class="col-sm-6"> Perubahan Nilai </span><!-- /.col -->
            </h3><!-- /.row -->

            <form class="form-horizontal" role="form" id="pn">
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> text1 </label>

                    <div class="col-sm-10">
                        <input type="text" id="form-field-1" placeholder="text1" name="value[text1]" class="col-xs-10 col-sm-5" />
                    </div>
                </div>
                <div class="space-4"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> text2  </label>

                    <div class="col-sm-10">
                        <input type="text" id="form-field-1" placeholder="text2" name="value[text2]" class="col-xs-10 col-sm-5" />
                    </div>
                </div>
                <div class="space-4"></div>

                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" type="submit" id="save">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Submit
                        </button>

                        &nbsp; &nbsp; &nbsp;
                        <button class="btn" type="reset">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            Reset
                        </button>
                    </div>
                </div>
            </form>

            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('js')
<!-- inline scripts related to this page -->
<script type="text/javascript" src="//d3js.org/d3.v3.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/cal-heatmap/3.3.10/cal-heatmap.min.js"></script>
<script type="text/javascript">
  var date = new Date();
  var cal = new CalHeatMap();
  var calData = {} ;
	cal.init({
    // data: datas,
    start: new Date(2019, date.getMonth()-5, 1),
    domain: "month",
    subDomain: "day",
  //   // cellSize: 20,
  //   // subDomainTextFormat: "%d",
    range: 6,
    domainGutter: 10,
    displayLegend: false,
    legend: [1, 2, 3, 4],
  //   onClick: function(date, nb) {
  //     console.log(date);
	// 	// $("#onClick-placeholder").html("You just clicked <br/>on <b>" +
	// 	// 	date + "</b> <br/>with <b>" +
	// 	// 	(nb === null ? "unknown" : nb) + "</b> items"
	// 	// );
	//  }
  });

  var posdata= {'datatb':'mkurs','search':1};
  getparameter("{{url('/api/oprasional/json')}}",posdata,function(data){
    data.map(function(element, index, array) {
      if (calData[element.date] === undefined)calData[element.date]=1; else calData[element.date] += 1;
    });
    cal.update(calData);
  })

  $("#pn").submit(function(e) {
    e.preventDefault();
    var oper = 'add';
    var tgl = '1';
    var postData = 'datatb=mnilai&oper='+ oper +'&tgl='+ tgl +'&'+$("#pn").serialize();
    $.ajax({
        type: 'POST',
        url: "{{ url('/api/oprasional/cud/') }}",
        data: postData,
        beforeSend:function(){
            var newHTML = '<i class="ace-icon fa fa-spinner fa-spin "></i>Loading...';
            document.getElementById('save').innerHTML = newHTML;
        },
        success: function(msg) {
            var newHTML = '<i class="ace-icon fa fa-check bigger-110"></i>Submit';
            document.getElementById('save').innerHTML = newHTML;

            alert(msg.id);

            if(msg.status == "success"){
                $(grid_selector).trigger("reloadGrid");
                window.location.replace("{{url('')}}/editkaryawan/"+msg.id);
                $('#my-modal').modal('hide');
                document.getElementById("form-1").reset();

            } else {
                alert (msg.msg);
            }

        },
        error: function(xhr, Status, err) {
            //alert("Terjadi error : "+Status);
            alert (JSON.stringify(xhr));
            alert ("terjadi kesalahan harap hubungi administrator");
        }
    })


    console.log(postData);
});
</script>
@endsection
