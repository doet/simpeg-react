@extends('backend.app_backend')

@section('css')
    <!-- page specific plugin styles -->
    <link href="{{ asset('/css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/ui.jqgrid.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/css/bootstrap-editable.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/css/chosen.min.css') }}" rel="stylesheet">

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
                                <a data-toggle="tab" href="#home" onclick="load('dapeg/{{$e}}','#isi')">
                                    <i class="green ace-icon fa fa-home bigger-120"></i>
                                    Data Pegawai
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#home" onclick="load('dakel/{{$e}}','#isi')">
                                    <i class=""></i>
                                    Data Keluarga
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

    <script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.jqGrid.min.js') }}"></script>
    <script src="{{ asset('/js/grid.locale-en.js') }}"></script>

    <script src="{{ asset('/js/bootstrap-editable.min.js') }}"></script>
    <script src="{{ asset('/js/ace-editable.min.js') }}"></script>

    <script src="{{ asset('/js/chosen.jquery.min.js') }}"></script>

    <script src="{{ asset('/js/jquery.maskedinput.min.js') }}"></script>

    <script src="{{ asset('/js/wizard.min.js') }}"></script>

    <script src="{{ asset('/js/jquery.colorbox.min.js') }}"></script>


<!-- inline scripts related to this page -->
<script type="text/javascript">
    
    jQuery(function($) {
        //editables on first profile page
        $.fn.editable.defaults.mode = 'inline';
        $.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
        $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
                                    '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';

        load("dapeg/{{$e}}","#isi");

    });
</script>
@endsection
