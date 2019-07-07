@extends('backend.app_backend')

@section('css')
    <!-- page specific plugin styles -->
    <style>
      /* .thumbnail {
          border: 0;
      } */

      #webcodecam-canvas, #scanned-img {
          /* background-color: #2d2d2d; */
      }

      #camera-select {
          display: inline-block;
          width: auto;
      }

      /* .btn {
          margin-bottom: 2px;
      }

      .form-control {
          height: 32px;
      }

      .h4, h4 {
          width: auto;
          float: left;
          font-size: 20px;
          line-height: 1.1;
          margin-top: 5px;
          margin-bottom: 5px;
      }

      .controls {
          float: right;
          display: inline-block;
      }

      .well {
          position: relative;
          display: inline-block;
      }

      .panel-heading {
          display: inline-block;
          width: 100%;
      }

      .container {
          width: 100%
      }

      pre {
          border: 0;
          border-radius: 0;
          background-color: #333;
          margin: 0;
          line-height: 125%;
          color: whitesmoke;
      }

      button {
          outline: none !important;
      }

      .table-bordered {
          color: #777;
          cursor: default;
      }

      .table-bordered a:hover {
          text-decoration: none;
      }

      .table-bordered th a {
          float: right;
          line-height: 3.49;
      }

      .table-bordered td a {
          float: left;
      }

      .table-bordered th img {
          float: left;
      }

      .table-bordered th, .table-bordered td {
          vertical-align: middle !important;
      }

      .scanner-laser {
          position: absolute;
          margin: 40px;
          height: 30px;
          width: 30px;
          opacity: 0.5;
      }

      .laser-leftTop {
          top: 0;
          left: 0;
          border-top: solid red 5px;
          border-left: solid red 5px;
      }

      .laser-leftBottom {
          bottom: 0;
          left: 0;
          border-bottom: solid red 5px;
          border-left: solid red 5px;
      }

      .laser-rightTop {
          top: 0;
          right: 0;
          border-top: solid red 5px;
          border-right: solid red 5px;
      }

      .laser-rightBottom {
          bottom: 0;
          right: 0;
          border-bottom: solid red 5px;
          border-right: solid red 5px;
          JS
      } */

      #webcodecam-canvas {
          /* background-color: #272822; */
      }
      #scanned-QR{
          /* word-break: break-word; */
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
<div id="modal" class="modal fade" tabindex="-1">
<div class="modal-dialog">
    <div class="modal-content">
      <!-- 01 Header -->


        <!-- 01 end heder -->
        <!-- 02 body -->
        <div class="modal-body">
          {{ csrf_field() }}
          <!-- <input type="hidden" name="datatb" value="keluarga" />
          <input type="hidden" id='oper-1' name="oper" value="add" />
          <input type="hidden" id='id-1' name="id" value="id" /> -->

                <div class="container" id="QR-Code">
                  <div class="panel panel-info">

                      <div class="navbar-form navbar-right">
                        <select class="form-control" id="camera-select"></select>
                        <div class="form-group" style="">
                          <input id="image-url" type="text" class="form-control" placeholder="Image url">
                          <button title="Decode Image" class="btn btn-default btn-sm" id="decode-img" type="button" data-toggle="tooltip">
                            <span class="glyphicon glyphicon-upload"></span>
                          </button>
                          <button title="Image shoot" class="btn btn-info btn-sm disabled" id="grab-img" type="button" data-toggle="tooltip">
                            <span class="glyphicon glyphicon-picture"></span>
                          </button>
                          <button title="Play" class="btn btn-success btn-sm" id="play" type="button" data-toggle="tooltip">
                            <span class="glyphicon glyphicon-play"></span>
                          </button>
                          <button title="Pause" class="btn btn-warning btn-sm" id="pause" type="button" data-toggle="tooltip">
                            <span class="glyphicon glyphicon-pause"></span>
                          </button>
                          <button title="Stop streams" class="btn btn-danger btn-sm" id="stop" type="button" data-toggle="tooltip">
                            <span class="glyphicon glyphicon-stop"></span>
                          </button>
                         </div>
                      </div>



                        <div class="well" style="">
                            <canvas width="320" height="240" id="webcodecam-canvas"></canvas>
                            <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                            <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                            <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                            <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
                        </div>
                        <div class="well" style="width: 100%; display:none" >
                            <label id="zoom-value" width="100">Zoom: 2</label>
                            <input id="zoom" onchange="Page.changeZoom();" type="range" min="10" max="30" value="20">
                            <label id="brightness-value" width="100">Brightness: 0</label>
                            <input id="brightness" onchange="Page.changeBrightness();" type="range" min="0" max="128" value="0">
                            <label id="contrast-value" width="100">Contrast: 0</label>
                            <input id="contrast" onchange="Page.changeContrast();" type="range" min="0" max="64" value="0">
                            <label id="threshold-value" width="100">Threshold: 0</label>
                            <input id="threshold" onchange="Page.changeThreshold();" type="range" min="0" max="512" value="0">
                            <label id="sharpness-value" width="100">Sharpness: off</label>
                            <input id="sharpness" onchange="Page.changeSharpness();" type="checkbox">
                            <label id="grayscale-value" width="100">grayscale: off</label>
                            <input id="grayscale" onchange="Page.changeGrayscale();" type="checkbox">
                            <br>
                            <label id="flipVertical-value" width="100">Flip Vertical: off</label>
                            <input id="flipVertical" onchange="Page.changeVertical();" type="checkbox">
                            <label id="flipHorizontal-value" width="100">Flip Horizontal: off</label>
                            <input id="flipHorizontal" onchange="Page.changeHorizontal();" type="checkbox">
                        </div>



                          <div class="well" style="overflow: hidden; display:none">
                              <img width="320" height="240" id="scanned-img" src="">
                          </div>
                          <div class="caption" style="display:none">
                              <h3>Scanned result</h3>
                              <p id="scanned-QR"></p>
                          </div>



                  </div>
                </div>


        </div>
        <!-- 02 end body -->

        <!-- 03 footer -->
        <div class="modal-footer">
          <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
              <i class="ace-icon fa fa-times"></i>Close
          </button>
        </div>
        <!-- 03 end footer Form -->
      </div>
    </div>
</div><!-- /.modal-dialog -->

  <div class="row">
    <div class="col-xs-12">
      <!-- PAGE CONTENT BEGINS -->

      <div class="input-group">
          <input class="form-control" type="text" id="search">
          <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="button" id="btn-qr">
                  <i class="ace-icon fa fa-calendar bigger-110"></i>
              </button>
          </span>
      </div>


      <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
  </div><!-- /.row -->
@endsection

@section('js')
<script src="{{ asset('js/filereader.js') }}"></script>

<script src="{{ asset('js/qrcodelib.js') }}"></script>
<script src="{{ asset('js/inventaris/webcodecamjs.js') }}"></script>
<script src="{{ asset('js/inventaris/main.js') }}"></script>
<script type="text/javascript">
  $( "#btn-qr" ).click(function() {
    $('#modal').modal('show');
  });

  $('#modal').on('hidden.bs.modal', function () {
    console.log('cloes');
  })

</script>
@endsection
