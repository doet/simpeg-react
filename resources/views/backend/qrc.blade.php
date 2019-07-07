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
            <img id="webcamimg" src="{{asset('images/vid.png')}}" onclick="setwebcam()" /> Scan
            <img id="qrimg" src="{{asset('images/cam.png')}}" onclick="setimg()" /> pic

            <div id="outdiv"><video id="v" muted autoplay></video></div>
            <div id="mainbody"> </div>
            <br>
            <div id="result"> </div>
            <div id="result2"> </div>

            <canvas id="qr-canvas" width="800" height="600"></canvas>

<br>
1. Copy file pendukung : llqrcode.js<br>
2. Copy juga file controllnya : webqr.js<br>
3. Sambungan hanya bisa menggunakan https://

<div class="select">
  <label for="audioSource">Audio source: </label><select id="audioSource"></select>
</div>

<div class="select">
  <label for="videoSource">Video source: </label><select id="videoSource"></select>
</div>
<video muted autoplay width="320px" height="240px"></video>
            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('js')
<script src="{{ asset('/js/llqrcode.js') }}"></script>
<script src="{{ asset('/js/webqr.js') }}"></script>
<script type="text/javascript">
  jQuery(function($) {
    load();
  })
</script>
@endsection
