@extends('backend.app_backend')

@section('css')
    <!-- page specific plugin styles -->

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
          input icon botstrap
          <div class="input-group">
            <div class="input-group-addon">
              <span class="fa fa-barcode"></span>
            </div>
            <input class="form-control" id="sn" name="sn"/>
          </div>
          <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
      </div><!-- /.row -->
@endsection

@section('js')


@endsection
