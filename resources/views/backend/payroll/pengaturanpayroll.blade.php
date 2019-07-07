@extends('backend.app_backend')

@section('css')
    <!-- page specific plugin styles -->
    {!! Html::style('/css/jquery-ui.min.css') !!}
    {!! Html::style('/css/bootstrap-datepicker3.min.css') !!}
    {!! Html::style('/css/ui.jqgrid.min.css') !!}

    {!! Html::style('/css/bootstrap-editable.min.css') !!}

    {!! Html::style('/css/chosen.min.css') !!}

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
                                <a data-toggle="tab" href="#home" onclick="load('m_setpayrollpegawai','#isi')">
                                    <i class="green ace-icon fa fa-home bigger-120"></i>
                                    Setting Pegawai
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#messages" onclick="load('m_shift','#isi')">
                                    Tunjangan Shift
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
    
    {!! HTML::script('/js/bootstrap-datepicker.min.js') !!}
    {!! HTML::script('/js/jquery.jqGrid.min.js') !!}
    {!! HTML::script('/js/grid.locale-en.js') !!}

    {!! HTML::script('/js/bootstrap-editable.min.js') !!}
    {!! HTML::script('/js/ace-editable.min.js') !!}

    {!! HTML::script('/js/chosen.jquery.min.js') !!}



<!-- inline scripts related to this page -->
<script type="text/javascript">
    var site ="{{url('')}}";
    jQuery(function($) {
        //editables on first profile page
        $.fn.editable.defaults.mode = 'inline';
        $.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
        $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
                                    '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>'; 

        load("m_setpayrollpegawai","#isi");  

    });
</script>
@endsection
