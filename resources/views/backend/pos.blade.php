@extends('backend.app_backend')

@section('css')
<link href="{{ asset('') }}" rel="stylesheet">
        <style type="text/css">

            #imghelp{
                position:relative;
                left:0px;
                top:-160px;
                z-index:100;
                font:18px arial,sans-serif;
                background:#f0f0f0;
                margin-left:35px;
                margin-right:35px;
                padding-top:10px;
                padding-bottom:10px;
                border-radius:20px;
            }

            #qr-canvas{
                display:none;
            }
            #v{
                width:320px;
                height:240px;
            }

            #outdiv
            {
                width:326px;
                height:246px;
                border: solid;
                border-width: 3px 3px 3px 3px;
            }

            #result{
                border: solid;
                border-width: 1px 1px 1px 1px;
                padding:10px;
                width:70%;
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
          <div class="container">
            <div class="row">
              <div class="col-sm-5">
                <div id="outdiv"><video id="v" muted autoplay></video></div>
                <div id="mainbody"> </div>
                <br>
                <div id="result"> </div>
                <div id="result2"> </div>

                <canvas id="qr-canvas" width="800" height="600"></canvas>

                <button onclick="playAudio()" type="button">Audio</button>
              </div>
              <div class="col-sm-7">
                <div id="list" class="row">
                  <div class="col-xs-2 col-sm-2">
                    No.
                  </div>
                  <div class="col-xs-5 col-sm-5">
                    Nama
                  </div>
                  <div class="col-xs-5 col-sm-5">
                    Harga
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->

@endsection

@section('js')
<script src="{{ asset('/js/llqrcode.js') }}"></script>
<script src="{{ asset('/js/posqr.js') }}"></script>
<script type="text/javascript">
  jQuery(function($) {
    load();
  })
</script>
@endsection
