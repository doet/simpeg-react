@extends('backend.app_backend')

@section('css')

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
    
    <form id="dompdf" role="form" method="POST" action="{{ url('PDFAdmin') }}" target="_blank">
        {!! csrf_field() !!}        
        <input name="page" value="page-dompdf" type="hidden"/>
        <input name="file" value="file-dompdf" type="hidden"/>
    </form>

    <div class="btn-group">
        <button data-toggle="dropdown" class="btn btn-sm btn-danger dropdown-toggle">
            Unduh / Print
            <i class="ace-icon fa fa-angle-down icon-on-right"></i>
        </button>

        <ul class="dropdown-menu dropdown-danger">
            <li><a href="#" id="print-dompdf">convert to pdf</a></li>            
        </ul>
    </div><!-- /.btn-group --><br>

1. Melalui terminal (dalam folder kerja) ketikan 'composer require barryvdh/laravel-dompdf', tunggu beberapa saat hingga selesai<br>
2. Dalam file config/app.php Tambahkan data array <br>
'Barryvdh\DomPDF\ServiceProvider::class,' dalam array 'providers' <br>dan<br>
'PDF' => Barryvdh\DomPDF\Facade::class, dalam array 'aliases'
            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('js')
<script type="text/javascript">
    jQuery(function($) {
        $('#print-dompdf').click(function() {
            document.getElementById('dompdf').submit();  
        });        
    });
</script>
@endsection
