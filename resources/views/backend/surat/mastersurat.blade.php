@extends('backend.app_backend')

@section('css')
    <!-- page specific plugin styles -->
    <link href="{{ asset('/css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/ui.jqgrid.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/css/dropzone.min.css') }}" rel="stylesheet">
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
            <div class="row">
                <div class="col-sm-12">
                    <div class="tabbable">
                        <ul class="nav nav-tabs" id="myTab">

                            <li class="active">
                                <a data-toggle="tab" href="#home" onclick="load('surat/smasuk','#isi')">
                                    <i class="green ace-icon fa fa-home bigger-120"></i>
                                    Surat Masuk
                                </a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#home" onclick="load('surat/skeluar','#isi')">
                                    <i class="green ace-icon fa fa-home bigger-120"></i>
                                    Surat Keluar
                                </a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#home" onclick="load('surat/simemo','#isi')">
                                    <i class="green ace-icon fa fa-home bigger-120"></i>
                                    Internal Memo
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





          </div>

            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('js')
    <!-- page specific plugin scripts -->
    <script src="{{ asset('/js/jquery.jqGrid.min.js') }}"></script>
    <script src="{{ asset('/js/grid.locale-en.js') }}"></script>
    <script src="{{ asset('/js/moment.min.js') }}"></script>
    <script src="{{ asset('/js/dropzone.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
  <!-- inline scripts related to this page -->
  <script type="text/javascript">
    var site ="{{url('')}}";
    jQuery(function($){

      load("surat/smasuk","#isi");




    });
  </script>
@endsection
