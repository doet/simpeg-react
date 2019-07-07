@extends('backend.app_backend')

@section('css')
<!-- page specific plugin styles -->
<link href="{{ asset('/css/jquery-ui.custom.min.css') }}" rel="stylesheet">
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
            FAQ
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                frequently asked questions using tabs and accordions
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="tabbable">
                <ul class="nav nav-tabs padding-18 tab-size-bigger" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#faq-tab-1">
                            <i class="blue ace-icon fa fa-question-circle bigger-120"></i>
                            General
                        </a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#faq-tab-2">
                            <i class="green ace-icon fa fa-user bigger-120"></i>
                            Account
                        </a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#faq-tab-3">
                            <i class="orange ace-icon fa fa-credit-card bigger-120"></i>
                            Payments
                        </a>
                    </li>

                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="purple ace-icon fa fa-magic bigger-120"></i>

                            Misc
                            <i class="ace-icon fa fa-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-lighter dropdown-125">
                            <li>
                                <a data-toggle="tab" href="#faq-tab-4"> Affiliates </a>
                            </li>

                            <li>
                                <a data-toggle="tab" href="#faq-tab-4"> Merchants </a>
                            </li>
                        </ul>
                    </li><!-- /.dropdown -->
                </ul>

                <div class="tab-content no-border padding-24">
                    <div id="faq-tab-1" class="tab-pane fade in active">
                        <h4 class="blue">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            General Questions
                        </h4>

                        <div class="space-8"></div>

                        <div id="faq-list-1" class="panel-group accordion-style1 accordion-style2">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#faq-1-1" data-parent="#faq-list-1" data-toggle="collapse" class="accordion-toggle collapsed">
                                        <i class="ace-icon fa fa-chevron-left pull-right" data-icon-hide="ace-icon fa fa-chevron-down" data-icon-show="ace-icon fa fa-chevron-left"></i>

                                        <i class="ace-icon fa fa-user bigger-130"></i>
                                        &nbsp; High life accusamus terry richardson ad squid?
                                    </a>
                                </div>

                                <div class="panel-collapse collapse" id="faq-1-1">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#faq-1-2" data-parent="#faq-list-1" data-toggle="collapse" class="accordion-toggle collapsed">
                                        <i class="ace-icon fa fa-chevron-left pull-right" data-icon-hide="ace-icon fa fa-chevron-down" data-icon-show="ace-icon fa fa-chevron-left"></i>

                                        <i class="ace-icon fa fa-sort-amount-desc"></i>
                                        &nbsp; Can I have nested questions?
                                    </a>
                                </div>

                                <div class="panel-collapse collapse" id="faq-1-2">
                                    <div class="panel-body">
                                        <div id="faq-list-nested-1" class="panel-group accordion-style1 accordion-style2">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <a href="#faq-list-1-sub-1" data-parent="#faq-list-nested-1" data-toggle="collapse" class="accordion-toggle collapsed">
                                                        <i class="ace-icon fa fa-plus smaller-80 middle" data-icon-hide="ace-icon fa fa-minus" data-icon-show="ace-icon fa fa-plus"></i>&nbsp;
                   Enim eiusmod high life accusamus terry?
                                                    </a>
                                                </div>

                                                <div class="panel-collapse collapse" id="faq-list-1-sub-1">
                                                    <div class="panel-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <a href="#faq-list-1-sub-2" data-parent="#faq-list-nested-1" data-toggle="collapse" class="accordion-toggle collapsed">
                                                        <i class="ace-icon fa fa-plus smaller-80 middle" data-icon-hide="ace-icon fa fa-minus" data-icon-show="ace-icon fa fa-plus"></i>&nbsp;
                  Food truck quinoa nesciunt laborum eiusmod?
                                                    </a>
                                                </div>

                                                <div class="panel-collapse collapse" id="faq-list-1-sub-2">
                                                    <div class="panel-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <a href="#faq-list-1-sub-3" data-parent="#faq-list-nested-1" data-toggle="collapse" class="accordion-toggle collapsed">
                                                        <i class="ace-icon fa fa-plus smaller-80 middle" data-icon-hide="ace-icon fa fa-minus" data-icon-show="ace-icon fa fa-plus"></i>&nbsp;
                  Cupidatat skateboard dolor brunch?
                                                    </a>
                                                </div>

                                                <div class="panel-collapse collapse" id="faq-list-1-sub-3">
                                                    <div class="panel-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#faq-1-3" data-parent="#faq-list-1" data-toggle="collapse" class="accordion-toggle collapsed">
                                        <i class="ace-icon fa fa-chevron-left pull-right" data-icon-hide="ace-icon fa fa-chevron-down" data-icon-show="ace-icon fa fa-chevron-left"></i>

                                        <i class="ace-icon fa fa-credit-card bigger-130"></i>
                                        &nbsp; Single-origin coffee nulla assumenda shoreditch et?
                                    </a>
                                </div>

                                <div class="panel-collapse collapse" id="faq-1-3">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#faq-1-4" data-parent="#faq-list-1" data-toggle="collapse" class="accordion-toggle collapsed">
                                        <i class="ace-icon fa fa-chevron-left pull-right" data-icon-hide="ace-icon fa fa-chevron-down" data-icon-show="ace-icon fa fa-chevron-left"></i>

                                        <i class="ace-icon fa fa-files-o bigger-130"></i>
                                        &nbsp; Sunt aliqua put a bird on it squid?
                                    </a>
                                </div>

                                <div class="panel-collapse collapse" id="faq-1-4">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#faq-1-5" data-parent="#faq-list-1" data-toggle="collapse" class="accordion-toggle collapsed">
                                        <i class="ace-icon fa fa-chevron-left pull-right" data-icon-hide="ace-icon fa fa-chevron-down" data-icon-show="ace-icon fa fa-chevron-left"></i>

                                        <i class="ace-icon fa fa-cog bigger-130"></i>
                                        &nbsp; Brunch 3 wolf moon tempor sunt aliqua put?
                                    </a>
                                </div>

                                <div class="panel-collapse collapse" id="faq-1-5">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="faq-tab-2" class="tab-pane fade">
                        <h4 class="blue">
                            <i class="green ace-icon fa fa-user bigger-110"></i>
                            Account Questions
                        </h4>

                        <div class="space-8"></div>

                        <div id="faq-list-2" class="panel-group accordion-style1 accordion-style2">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#faq-2-1" data-parent="#faq-list-2" data-toggle="collapse" class="accordion-toggle collapsed">
                                        <i class="ace-icon fa fa-chevron-right smaller-80" data-icon-hide="ace-icon fa fa-chevron-down align-top" data-icon-show="ace-icon fa fa-chevron-right"></i>&nbsp;
    Enim eiusmod high life accusamus terry richardson?
                                    </a>
                                </div>

                                <div class="panel-collapse collapse" id="faq-2-1">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#faq-2-2" data-parent="#faq-list-2" data-toggle="collapse" class="accordion-toggle collapsed">
                                        <i class="ace-icon fa fa-chevron-right smaller-80" data-icon-hide="ace-icon fa fa-chevron-down align-top" data-icon-show="ace-icon fa fa-chevron-right"></i>&nbsp;
    Single-origin coffee nulla assumenda shoreditch et?
                                    </a>
                                </div>

                                <div class="panel-collapse collapse" id="faq-2-2">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#faq-2-3" data-parent="#faq-list-2" data-toggle="collapse" class="accordion-toggle collapsed">
                                        <i class="ace-icon fa fa-chevron-right middle smaller-80" data-icon-hide="ace-icon fa fa-chevron-down align-top" data-icon-show="ace-icon fa fa-chevron-right"></i>&nbsp;
    Sunt aliqua put a bird on it squid?
                                    </a>
                                </div>

                                <div class="panel-collapse collapse" id="faq-2-3">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#faq-2-4" data-parent="#faq-list-2" data-toggle="collapse" class="accordion-toggle collapsed">
                                        <i class="ace-icon fa fa-chevron-right smaller-80" data-icon-hide="ace-icon fa fa-chevron-down align-top" data-icon-show="ace-icon fa fa-chevron-right"></i>&nbsp;
    Brunch 3 wolf moon tempor sunt aliqua put?
                                    </a>
                                </div>

                                <div class="panel-collapse collapse" id="faq-2-4">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="faq-tab-3" class="tab-pane fade">
                        <h4 class="blue">
                            <i class="orange ace-icon fa fa-credit-card bigger-110"></i>
                            Payment Questions
                        </h4>

                        <div class="space-8"></div>

                        <div id="faq-list-3" class="panel-group accordion-style1 accordion-style2">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#faq-3-1" data-parent="#faq-list-3" data-toggle="collapse" class="accordion-toggle collapsed">
                                        <i class="ace-icon fa fa-plus smaller-80" data-icon-hide="ace-icon fa fa-minus" data-icon-show="ace-icon fa fa-plus"></i>&nbsp;
    Enim eiusmod high life accusamus terry richardson?
                                    </a>
                                </div>

                                <div class="panel-collapse collapse" id="faq-3-1">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#faq-3-2" data-parent="#faq-list-3" data-toggle="collapse" class="accordion-toggle collapsed">
                                        <i class="ace-icon fa fa-plus smaller-80" data-icon-hide="ace-icon fa fa-minus" data-icon-show="ace-icon fa fa-plus"></i>&nbsp;
    Single-origin coffee nulla assumenda shoreditch et?
                                    </a>
                                </div>

                                <div class="panel-collapse collapse" id="faq-3-2">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#faq-3-3" data-parent="#faq-list-3" data-toggle="collapse" class="accordion-toggle collapsed">
                                        <i class="ace-icon fa fa-plus smaller-80" data-icon-hide="ace-icon fa fa-minus" data-icon-show="ace-icon fa fa-plus"></i>&nbsp;
    Sunt aliqua put a bird on it squid?
                                    </a>
                                </div>

                                <div class="panel-collapse collapse" id="faq-3-3">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#faq-3-4" data-parent="#faq-list-3" data-toggle="collapse" class="accordion-toggle collapsed">
                                        <i class="ace-icon fa fa-plus smaller-80" data-icon-hide="ace-icon fa fa-minus" data-icon-show="ace-icon fa fa-plus"></i>&nbsp;
    Brunch 3 wolf moon tempor sunt aliqua put?
                                    </a>
                                </div>

                                <div class="panel-collapse collapse" id="faq-3-4">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="faq-tab-4" class="tab-pane fade">
                        <h4 class="blue">
                            <i class="purple ace-icon fa fa-magic bigger-110"></i>
                            Miscellaneous Questions
                        </h4>

                        <div class="space-8"></div>

                        <div id="faq-list-4" class="panel-group accordion-style1 accordion-style2">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#faq-4-1" data-parent="#faq-list-4" data-toggle="collapse" class="accordion-toggle collapsed">
                                        <i class="ace-icon fa fa-hand-o-right" data-icon-hide="ace-icon fa fa-hand-o-down" data-icon-show="ace-icon fa fa-hand-o-right"></i>&nbsp;
    Enim eiusmod high life accusamus terry richardson?
                                    </a>
                                </div>

                                <div class="panel-collapse collapse" id="faq-4-1">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#faq-4-2" data-parent="#faq-list-4" data-toggle="collapse" class="accordion-toggle collapsed">
                                        <i class="ace-icon fa fa-frown-o bigger-120" data-icon-hide="ace-icon fa fa-smile-o" data-icon-show="ace-icon fa fa-frown-o"></i>&nbsp;
    Single-origin coffee nulla assumenda shoreditch et?
                                    </a>
                                </div>

                                <div class="panel-collapse collapse" id="faq-4-2">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#faq-4-3" data-parent="#faq-list-4" data-toggle="collapse" class="accordion-toggle collapsed">
                                        <i class="ace-icon fa fa-plus smaller-80" data-icon-hide="ace-icon fa fa-minus" data-icon-show="ace-icon fa fa-plus"></i>&nbsp;
    Sunt aliqua put a bird on it squid?
                                    </a>
                                </div>

                                <div class="panel-collapse collapse" id="faq-4-3">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#faq-4-4" data-parent="#faq-list-4" data-toggle="collapse" class="accordion-toggle collapsed">
                                        <i class="ace-icon fa fa-plus smaller-80" data-icon-hide="ace-icon fa fa-minus" data-icon-show="ace-icon fa fa-plus"></i>&nbsp;
    Brunch 3 wolf moon tempor sunt aliqua put?
                                    </a>
                                </div>

                                <div class="panel-collapse collapse" id="faq-4-4">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                    </div>
                                </div>
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
<!-- page specific plugin scripts -->
<script src="{{ asset('/js/jquery-ui.custom.min.js') }}"></script> 
<script src="{{ asset('/js/jquery.ui.touch-punch.min.js') }}"></script> 

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function($) {

        $('#simple-colorpicker-1').ace_colorpicker({pull_right:true}).on('change', function(){
            var color_class = $(this).find('option:selected').data('class');
            var new_class = 'widget-box';
            if(color_class != 'default')  new_class += ' widget-color-'+color_class;
            $(this).closest('.widget-box').attr('class', new_class);
        });


        // scrollables
        $('.scrollable').each(function () {
            var $this = $(this);
            $(this).ace_scroll({
                size: $this.attr('data-size') || 100,
                //styleClass: 'scroll-left scroll-margin scroll-thin scroll-dark scroll-light no-track scroll-visible'
            });
        });
        $('.scrollable-horizontal').each(function () {
            var $this = $(this);
            $(this).ace_scroll(
              {
                horizontal: true,
                styleClass: 'scroll-top',//show the scrollbars on top(default is bottom)
                size: $this.attr('data-size') || 500,
                mouseWheelLock: true
              }
            ).css({'padding-top': 12});
        });

        $(window).on('resize.scroll_reset', function() {
            $('.scrollable-horizontal').ace_scroll('reset');
        });


        $('#id-checkbox-vertical').prop('checked', false).on('click', function() {
            $('#widget-toolbox-1').toggleClass('toolbox-vertical')
            .find('.btn-group').toggleClass('btn-group-vertical')
            .filter(':first').toggleClass('hidden')
            .parent().toggleClass('btn-toolbar')
        });

        /**
        //or use slimScroll plugin
        $('.slim-scrollable').each(function () {
            var $this = $(this);
            $this.slimScroll({
                height: $this.data('height') || 100,
                railVisible:true
            });
        });
        */


        /**$('.widget-box').on('setting.ace.widget' , function(e) {
            e.preventDefault();
        });*/

        /**
        $('.widget-box').on('show.ace.widget', function(e) {
            //e.preventDefault();
            //this = the widget-box
        });
        $('.widget-box').on('reload.ace.widget', function(e) {
            //this = the widget-box
        });
        */

        //$('#my-widget-box').widget_box('hide');



        // widget boxes
        // widget box drag & drop example
        $('.widget-container-col').sortable({
            connectWith: '.widget-container-col',
            items:'> .widget-box',
            handle: ace.vars['touch'] ? '.widget-title' : false,
            cancel: '.fullscreen',
            opacity:0.8,
            revert:true,
            forceHelperSize:true,
            placeholder: 'widget-placeholder',
            forcePlaceholderSize:true,
            tolerance:'pointer',
            start: function(event, ui) {
                //when an element is moved, it's parent becomes empty with almost zero height.
                //we set a min-height for it to be large enough so that later we can easily drop elements back onto it
                ui.item.parent().css({'min-height':ui.item.height()})
                //ui.sender.css({'min-height':ui.item.height() , 'background-color' : '#F5F5F5'})
            },
            update: function(event, ui) {
                ui.item.parent({'min-height':''})
                //p.style.removeProperty('background-color');


                //save widget positions
                var widget_order = {}
                $('.widget-container-col').each(function() {
                    var container_id = $(this).attr('id');
                    widget_order[container_id] = []


                    $(this).find('> .widget-box').each(function() {
                        var widget_id = $(this).attr('id');
                        widget_order[container_id].push(widget_id);
                        //now we know each container contains which widgets
                    });
                });

                ace.data.set('demo', 'widget-order', widget_order, null, true);
            }
        });


        ///////////////////////

        //when a widget is shown/hidden/closed, we save its state for later retrieval
        $(document).on('shown.ace.widget hidden.ace.widget closed.ace.widget', '.widget-box', function(event) {
            var widgets = ace.data.get('demo', 'widget-state', true);
            if(widgets == null) widgets = {}

            var id = $(this).attr('id');
            widgets[id] = event.type;
            ace.data.set('demo', 'widget-state', widgets, null, true);
        });


        (function() {
            //restore widget order
            var container_list = ace.data.get('demo', 'widget-order', true);
            if(container_list) {
                for(var container_id in container_list) if(container_list.hasOwnProperty(container_id)) {

                    var widgets_inside_container = container_list[container_id];
                    if(widgets_inside_container.length == 0) continue;

                    for(var i = 0; i < widgets_inside_container.length; i++) {
                        var widget = widgets_inside_container[i];
                        $('#'+widget).appendTo('#'+container_id);
                    }

                }
            }


            //restore widget state
            var widgets = ace.data.get('demo', 'widget-state', true);
            if(widgets != null) {
                for(var id in widgets) if(widgets.hasOwnProperty(id)) {
                    var state = widgets[id];
                    var widget = $('#'+id);
                    if
                    (
                        (state == 'shown' && widget.hasClass('collapsed'))
                        ||
                        (state == 'hidden' && !widget.hasClass('collapsed'))
                    )
                    {
                        widget.widget_box('toggleFast');
                    }
                    else if(state == 'closed') {
                        widget.widget_box('closeFast');
                    }
                }
            }


            $('#main-widget-container').removeClass('invisible');


            //reset saved positions and states
            $('#reset-widgets').on('click', function() {
                ace.data.remove('demo', 'widget-state');
                ace.data.remove('demo', 'widget-order');
                document.location.reload();
            });

        })();

    });
</script>
@endsection
