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
    <div class="page-header">
        <h1>
            Email Templates
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                along with an email converter tool
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="alert alert-block alert-info">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
                The following sample email templates are converted using the provided email tool which
converts normal Bootstrap HTML to email friendly table layout with inline CSS!
            </div>

            <div class="space-12"></div>

            <div class="row">
                <div class="col-xs-3">
                    <a href="email-confirmation" class="thumbnail" target="_blank">
                        <img class="img-responsive" src="{{asset('images/email/email1.png')}}" alt="Email Template" />
                    </a>
                </div>

                <div class="col-xs-3">
                    <a href="email-navbar" class="thumbnail" target="_blank">
                        <img class="img-responsive" src="{{asset('images/email/email2.png')}}" alt="Email Template" />
                    </a>
                </div>

                <div class="col-xs-3">
                    <a href="email-newsletter" class="thumbnail" target="_blank">
                        <img class="img-responsive" src="{{asset('images/email/email3.png')}}" alt="Email Template" />
                    </a>
                </div>

                <div class="col-xs-3">
                    <a href="email-contrast" class="thumbnail" target="_blank">
                        <img class="img-responsive" src="{{asset('images/email/email4.png')}}" alt="Email Template" />
                    </a>
                </div>
            </div>

            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('js')

@endsection
