@extends('backend.app_backend')

@section('css')
    <!-- page specific plugin styles -->
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
      <div style="width:90%;">
        <canvas id="mycanvas"></canvas>
      </div>
      <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
  </div><!-- /.row -->
@endsection

@section('js')
<script src="{{ asset('js/Chart.bundle.js') }}"></script>
<script>

function CartJetty(fname){
    var postData = {datatb:'gerakanChart',_token:'{{csrf_token()}}'};
    $.ajax({
        type: 'POST',
        url: "{{url('oprasional/Chart')}}",
        data: postData,
        beforeSend:function(){

        },
        success: function(tmp) {
          console.log(tmp);
          var i=0;
          // tmp.label.forEach(function(entry) {
          //   entry = new Date(entry*1000);
          //   tmp.label[i] = entry.getDate()+'/'+entry.getMonth();
          //   i++;
          // });
          // myChart.data.labels = tmp.label;
          myChart.data.labels = tmp.label;
          myChart.data.datasets = tmp.ds;
          // console.log(tmp.ds);
    //       // myChart.data.datasets.push(dataSource2);
    //       myChart.data.datasets.forEach((dataSource2) => {
    //          // dataSource2.data.push(dataSource2.data);
    //          // console.log(dataSource2);
    //      });
          myChart.update();
          myChart.render({
              duration: 800,
              lazy: false,
              easing: 'easeOutBounce'
          });
          // console.log(myChart.data.datasets);
          // console.log(date.getDate())
        },
    });
}
CartJetty();

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


</script>
@endsection
