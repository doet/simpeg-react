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
    var postData = {datatb:'jetty',_token:'{{csrf_token()}}'};
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


  // used for example purposes
  function getRandomIntInclusive(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
  }

  dataSource = [
    {
      label: "Cigading",
      data: [65, 59, 80, 81, 56, 55, 40],
      backgroundColor: [
        'rgba(105, 0, 132, .2)',
      ],
      borderColor: [
        'rgba(200, 99, 132, .7)',
      ],
      borderWidth: 2,
      fill: false,
    },
    {
      label: "Titan",
      data: [28, 48, 40, 19, 86, 27, 90],
      backgroundColor: [
        'rgba(0, 137, 132, .2)',
      ],
      borderColor: [
        'rgba(0, 10, 130, .7)',
      ],
      borderWidth: 2,
      fill: false,
    }
  ]
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

  // this post id drives the example data
  var postId = 1;

  // logic to get new data
  var getData = function() {
    $.ajax({
      url: '',
      success: function(data) {
        // process your data to pull out what you plan to use to update the chart
        // e.g. new label and a new data point

        // add new label and data point to chart's underlying data structures
        //
        // myChart.data.labels.push(postId++);
        // myChart.data.labels.push(postId++);
        // myChart.data.labels.push(postId++);
        // myChart.data.labels.push(postId++);
        // myChart.data.labels.push(postId++);
        // myChart.data.labels.push(postId++);
        // myChart.data.labels.push(postId++);
        // myChart.data.labels.push(postId++);
        // myChart.data.datasets[0].data.push(11);
        // myChart.data.datasets[0].data.push(5);
        // myChart.data.datasets[0].data.push(2);
        // myChart.data.datasets[0].data.push(6);
        // myChart.data.datasets[0].data.push(1);
        // myChart.data.datasets[0].data.push(20);
        // myChart.data.datasets[0].data.push(16);
        // myChart.data.datasets[0].data.push(13);
        // myChart.data.datasets[1].data.push(9);
        // myChart.data.datasets[1].data.push(11);
        // myChart.data.datasets[1].data.push(5);
        // myChart.data.datasets[1].data.push(13);
        // myChart.data.datasets[1].data.push(1);
        // myChart.data.datasets[1].data.push(16);
        // myChart.data.datasets[1].data.push(6);
        // myChart.data.datasets[1].data.push(20);
        // myChart.data.datasets[1].data.push(2);
        // re-render the chart
        // myChart.update();
        // myChart.render({
        //     duration: 800,
        //     lazy: false,
        //     easing: 'easeOutBounce'
        // });
      }
    });
  };
  getData();
  // get new data every 3 seconds
  // setInterval(getData, 3000);

</script>
@endsection
