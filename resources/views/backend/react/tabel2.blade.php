@extends('backend.app_backend')

@section('css')
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

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


                                        <div class="table-header">
                                            Results for "Latest Registered Domains"
                                        </div>

                                        <!-- div.table-responsive -->

                                        <!-- div.dataTables_borderWrap -->

                                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </th>
                                                        <th>Domain</th>
                                                        <th>Price</th>
                                                        <th class="hidden-480">Clicks</th>

                                                        <th>
                                                            <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                                            Update
                                                        </th>
                                                        <th class="hidden-480">Status</th>

                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <a href="#">app.com</a>
                                                        </td>
                                                        <td>$45</td>
                                                        <td class="hidden-480">3,330</td>
                                                        <td>Feb 12</td>

                                                        <td class="hidden-480">
                                                            <span class="label label-sm label-warning">Expiring</span>
                                                        </td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <a class="blue" href="#">
                                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                                </a>

                                                                <a class="green" href="#">
                                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                </a>

                                                                <a class="red" href="#">
                                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                </a>
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <a href="#">base.com</a>
                                                        </td>
                                                        <td>$35</td>
                                                        <td class="hidden-480">2,595</td>
                                                        <td>Feb 18</td>

                                                        <td class="hidden-480">
                                                            <span class="label label-sm label-success">Registered</span>
                                                        </td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <a class="blue" href="#">
                                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                                </a>

                                                                <a class="green" href="#">
                                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                </a>

                                                                <a class="red" href="#">
                                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                </a>
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <a href="#">max.com</a>
                                                        </td>
                                                        <td>$60</td>
                                                        <td class="hidden-480">4,400</td>
                                                        <td>Mar 11</td>

                                                        <td class="hidden-480">
                                                            <span class="label label-sm label-warning">Expiring</span>
                                                        </td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <a class="blue" href="#">
                                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                                </a>

                                                                <a class="green" href="#">
                                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                </a>

                                                                <a class="red" href="#">
                                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                </a>
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <a href="#">best.com</a>
                                                        </td>
                                                        <td>$75</td>
                                                        <td class="hidden-480">6,500</td>
                                                        <td>Apr 03</td>

                                                        <td class="hidden-480">
                                                            <span class="label label-sm label-inverse arrowed-in">Flagged</span>
                                                        </td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <a class="blue" href="#">
                                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                                </a>

                                                                <a class="green" href="#">
                                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                </a>

                                                                <a class="red" href="#">
                                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                </a>
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <a href="#">pro.com</a>
                                                        </td>
                                                        <td>$55</td>
                                                        <td class="hidden-480">4,250</td>
                                                        <td>Jan 21</td>

                                                        <td class="hidden-480">
                                                            <span class="label label-sm label-success">Registered</span>
                                                        </td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <a class="blue" href="#">
                                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                                </a>

                                                                <a class="green" href="#">
                                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                </a>

                                                                <a class="red" href="#">
                                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                </a>
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <a href="#">team.com</a>
                                                        </td>
                                                        <td>$40</td>
                                                        <td class="hidden-480">3,200</td>
                                                        <td>Feb 09</td>

                                                        <td class="hidden-480">
                                                            <span class="label label-sm label-inverse arrowed-in">Flagged</span>
                                                        </td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <a class="blue" href="#">
                                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                                </a>

                                                                <a class="green" href="#">
                                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                </a>

                                                                <a class="red" href="#">
                                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                </a>
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <a href="#">up.com</a>
                                                        </td>
                                                        <td>$95</td>
                                                        <td class="hidden-480">8,520</td>
                                                        <td>Feb 22</td>

                                                        <td class="hidden-480">
                                                            <span class="label label-sm label-info arrowed arrowed-righ">Sold</span>
                                                        </td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <a class="blue" href="#">
                                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                                </a>

                                                                <a class="green" href="#">
                                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                </a>

                                                                <a class="red" href="#">
                                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                </a>
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <a href="#">view.com</a>
                                                        </td>
                                                        <td>$45</td>
                                                        <td class="hidden-480">4,100</td>
                                                        <td>Mar 12</td>

                                                        <td class="hidden-480">
                                                            <span class="label label-sm label-success">Registered</span>
                                                        </td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <a class="blue" href="#">
                                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                                </a>

                                                                <a class="green" href="#">
                                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                </a>

                                                                <a class="red" href="#">
                                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                </a>
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <a href="#">nice.com</a>
                                                        </td>
                                                        <td>$38</td>
                                                        <td class="hidden-480">3,940</td>
                                                        <td>Feb 12</td>

                                                        <td class="hidden-480">
                                                            <span class="label label-sm label-info arrowed arrowed-righ">Sold</span>
                                                        </td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <a class="blue" href="#">
                                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                                </a>

                                                                <a class="green" href="#">
                                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                </a>

                                                                <a class="red" href="#">
                                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                </a>
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <a href="#">fine.com</a>
                                                        </td>
                                                        <td>$25</td>
                                                        <td class="hidden-480">2,983</td>
                                                        <td>Apr 01</td>

                                                        <td class="hidden-480">
                                                            <span class="label label-sm label-warning">Expiring</span>
                                                        </td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <a class="blue" href="#">
                                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                                </a>

                                                                <a class="green" href="#">
                                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                </a>

                                                                <a class="red" href="#">
                                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                </a>
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <a href="#">good.com</a>
                                                        </td>
                                                        <td>$50</td>
                                                        <td class="hidden-480">6,500</td>
                                                        <td>Feb 02</td>

                                                        <td class="hidden-480">
                                                            <span class="label label-sm label-inverse arrowed-in">Flagged</span>
                                                        </td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <a class="blue" href="#">
                                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                                </a>

                                                                <a class="green" href="#">
                                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                </a>

                                                                <a class="red" href="#">
                                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                </a>
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <a href="#">great.com</a>
                                                        </td>
                                                        <td>$55</td>
                                                        <td class="hidden-480">6,400</td>
                                                        <td>Feb 24</td>

                                                        <td class="hidden-480">
                                                            <span class="label label-sm label-success">Registered</span>
                                                        </td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <a class="blue" href="#">
                                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                                </a>

                                                                <a class="green" href="#">
                                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                </a>

                                                                <a class="red" href="#">
                                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                </a>
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <a href="#">shine.com</a>
                                                        </td>
                                                        <td>$25</td>
                                                        <td class="hidden-480">2,200</td>
                                                        <td>Apr 01</td>

                                                        <td class="hidden-480">
                                                            <span class="label label-sm label-inverse arrowed-in">Flagged</span>
                                                        </td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <a class="blue" href="#">
                                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                                </a>

                                                                <a class="green" href="#">
                                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                </a>

                                                                <a class="red" href="#">
                                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                </a>
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <a href="#">rise.com</a>
                                                        </td>
                                                        <td>$42</td>
                                                        <td class="hidden-480">3,900</td>
                                                        <td>Feb 01</td>

                                                        <td class="hidden-480">
                                                            <span class="label label-sm label-info arrowed arrowed-righ">Sold</span>
                                                        </td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <a class="blue" href="#">
                                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                                </a>

                                                                <a class="green" href="#">
                                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                </a>

                                                                <a class="red" href="#">
                                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                </a>
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <a href="#">above.com</a>
                                                        </td>
                                                        <td>$35</td>
                                                        <td class="hidden-480">3,420</td>
                                                        <td>Mar 12</td>

                                                        <td class="hidden-480">
                                                            <span class="label label-sm label-warning">Expiring</span>
                                                        </td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <a class="blue" href="#">
                                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                                </a>

                                                                <a class="green" href="#">
                                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                </a>

                                                                <a class="red" href="#">
                                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                </a>
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <a href="#">share.com</a>
                                                        </td>
                                                        <td>$30</td>
                                                        <td class="hidden-480">3,200</td>
                                                        <td>Feb 11</td>

                                                        <td class="hidden-480">
                                                            <span class="label label-sm label-info arrowed arrowed-righ">Sold</span>
                                                        </td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <a class="blue" href="#">
                                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                                </a>

                                                                <a class="green" href="#">
                                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                </a>

                                                                <a class="red" href="#">
                                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                </a>
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <a href="#">fair.com</a>
                                                        </td>
                                                        <td>$35</td>
                                                        <td class="hidden-480">3,900</td>
                                                        <td>Mar 26</td>

                                                        <td class="hidden-480">
                                                            <span class="label label-sm label-inverse arrowed-in">Flagged</span>
                                                        </td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <a class="blue" href="#">
                                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                                </a>

                                                                <a class="green" href="#">
                                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                </a>

                                                                <a class="red" href="#">
                                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                </a>
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <a href="#">year.com</a>
                                                        </td>
                                                        <td>$48</td>
                                                        <td class="hidden-480">3,990</td>
                                                        <td>Feb 15</td>

                                                        <td class="hidden-480">
                                                            <span class="label label-sm label-warning">Expiring</span>
                                                        </td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <a class="blue" href="#">
                                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                                </a>

                                                                <a class="green" href="#">
                                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                </a>

                                                                <a class="red" href="#">
                                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                </a>
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <a href="#">day.com</a>
                                                        </td>
                                                        <td>$55</td>
                                                        <td class="hidden-480">5,600</td>
                                                        <td>Jan 29</td>

                                                        <td class="hidden-480">
                                                            <span class="label label-sm label-info arrowed arrowed-righ">Sold</span>
                                                        </td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <a class="blue" href="#">
                                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                                </a>

                                                                <a class="green" href="#">
                                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                </a>

                                                                <a class="red" href="#">
                                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                </a>
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <a href="#">light.com</a>
                                                        </td>
                                                        <td>$40</td>
                                                        <td class="hidden-480">3,100</td>
                                                        <td>Feb 17</td>

                                                        <td class="hidden-480">
                                                            <span class="label label-sm label-success">Registered</span>
                                                        </td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <a class="blue" href="#">
                                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                                </a>

                                                                <a class="green" href="#">
                                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                </a>

                                                                <a class="red" href="#">
                                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                </a>
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <a href="#">sight.com</a>
                                                        </td>
                                                        <td>$58</td>
                                                        <td class="hidden-480">6,100</td>
                                                        <td>Feb 19</td>

                                                        <td class="hidden-480">
                                                            <span class="label label-sm label-inverse arrowed-in">Flagged</span>
                                                        </td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <a class="blue" href="#">
                                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                                </a>

                                                                <a class="green" href="#">
                                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                </a>

                                                                <a class="red" href="#">
                                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                </a>
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <a href="#">right.com</a>
                                                        </td>
                                                        <td>$50</td>
                                                        <td class="hidden-480">4,400</td>
                                                        <td>Apr 01</td>

                                                        <td class="hidden-480">
                                                            <span class="label label-sm label-warning">Expiring</span>
                                                        </td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <a class="blue" href="#">
                                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                                </a>

                                                                <a class="green" href="#">
                                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                </a>

                                                                <a class="red" href="#">
                                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                </a>
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <a href="#">once.com</a>
                                                        </td>
                                                        <td>$20</td>
                                                        <td class="hidden-480">1,400</td>
                                                        <td>Apr 04</td>

                                                        <td class="hidden-480">
                                                            <span class="label label-sm label-info arrowed arrowed-righ">Sold</span>
                                                        </td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <a class="blue" href="#">
                                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                                </a>

                                                                <a class="green" href="#">
                                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                </a>

                                                                <a class="red" href="#">
                                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                </a>
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>


      <table id="lupa" class="table table-striped table-bordered table-hover display responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
                <th>Extn.</th>
                <th>E-mail</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger</td>
                <td>Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
                <td>5421</td>
                <td>t.nixon@datatables.net</td>
            </tr>
            <tr>
                <td>Garrett</td>
                <td>Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
                <td>8422</td>
                <td>g.winters@datatables.net</td>
            </tr>
            <tr>
                <td>Ashton</td>
                <td>Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009/01/12</td>
                <td>$86,000</td>
                <td>1562</td>
                <td>a.cox@datatables.net</td>
            </tr>
            <tr>
                <td>Cedric</td>
                <td>Kelly</td>
                <td>Senior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2012/03/29</td>
                <td>$433,060</td>
                <td>6224</td>
                <td>c.kelly@datatables.net</td>
            </tr>
            <tr>
                <td>Airi</td>
                <td>Satou</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>33</td>
                <td>2008/11/28</td>
                <td>$162,700</td>
                <td>5407</td>
                <td>a.satou@datatables.net</td>
            </tr>
            <tr>
                <td>Brielle</td>
                <td>Williamson</td>
                <td>Integration Specialist</td>
                <td>New York</td>
                <td>61</td>
                <td>2012/12/02</td>
                <td>$372,000</td>
                <td>4804</td>
                <td>b.williamson@datatables.net</td>
            </tr>
            <tr>
                <td>Herrod</td>
                <td>Chandler</td>
                <td>Sales Assistant</td>
                <td>San Francisco</td>
                <td>59</td>
                <td>2012/08/06</td>
                <td>$137,500</td>
                <td>9608</td>
                <td>h.chandler@datatables.net</td>
            </tr>
            <tr>
                <td>Rhona</td>
                <td>Davidson</td>
                <td>Integration Specialist</td>
                <td>Tokyo</td>
                <td>55</td>
                <td>2010/10/14</td>
                <td>$327,900</td>
                <td>6200</td>
                <td>r.davidson@datatables.net</td>
            </tr>
            <tr>
                <td>Colleen</td>
                <td>Hurst</td>
                <td>Javascript Developer</td>
                <td>San Francisco</td>
                <td>39</td>
                <td>2009/09/15</td>
                <td>$205,500</td>
                <td>2360</td>
                <td>c.hurst@datatables.net</td>
            </tr>
            <tr>
                <td>Sonya</td>
                <td>Frost</td>
                <td>Software Engineer</td>
                <td>Edinburgh</td>
                <td>23</td>
                <td>2008/12/13</td>
                <td>$103,600</td>
                <td>1667</td>
                <td>s.frost@datatables.net</td>
            </tr>
            <tr>
                <td>Jena</td>
                <td>Gaines</td>
                <td>Office Manager</td>
                <td>London</td>
                <td>30</td>
                <td>2008/12/19</td>
                <td>$90,560</td>
                <td>3814</td>
                <td>j.gaines@datatables.net</td>
            </tr>
            <tr>
                <td>Quinn</td>
                <td>Flynn</td>
                <td>Support Lead</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2013/03/03</td>
                <td>$342,000</td>
                <td>9497</td>
                <td>q.flynn@datatables.net</td>
            </tr>
            <tr>
                <td>Charde</td>
                <td>Marshall</td>
                <td>Regional Director</td>
                <td>San Francisco</td>
                <td>36</td>
                <td>2008/10/16</td>
                <td>$470,600</td>
                <td>6741</td>
                <td>c.marshall@datatables.net</td>
            </tr>
            <tr>
                <td>Haley</td>
                <td>Kennedy</td>
                <td>Senior Marketing Designer</td>
                <td>London</td>
                <td>43</td>
                <td>2012/12/18</td>
                <td>$313,500</td>
                <td>3597</td>
                <td>h.kennedy@datatables.net</td>
            </tr>
            <tr>
                <td>Tatyana</td>
                <td>Fitzpatrick</td>
                <td>Regional Director</td>
                <td>London</td>
                <td>19</td>
                <td>2010/03/17</td>
                <td>$385,750</td>
                <td>1965</td>
                <td>t.fitzpatrick@datatables.net</td>
            </tr>
            <tr>
                <td>Michael</td>
                <td>Silva</td>
                <td>Marketing Designer</td>
                <td>London</td>
                <td>66</td>
                <td>2012/11/27</td>
                <td>$198,500</td>
                <td>1581</td>
                <td>m.silva@datatables.net</td>
            </tr>
            <tr>
                <td>Paul</td>
                <td>Byrd</td>
                <td>Chief Financial Officer (CFO)</td>
                <td>New York</td>
                <td>64</td>
                <td>2010/06/09</td>
                <td>$725,000</td>
                <td>3059</td>
                <td>p.byrd@datatables.net</td>
            </tr>
            <tr>
                <td>Gloria</td>
                <td>Little</td>
                <td>Systems Administrator</td>
                <td>New York</td>
                <td>59</td>
                <td>2009/04/10</td>
                <td>$237,500</td>
                <td>1721</td>
                <td>g.little@datatables.net</td>
            </tr>
            <tr>
                <td>Bradley</td>
                <td>Greer</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>41</td>
                <td>2012/10/13</td>
                <td>$132,000</td>
                <td>2558</td>
                <td>b.greer@datatables.net</td>
            </tr>
            <tr>
                <td>Dai</td>
                <td>Rios</td>
                <td>Personnel Lead</td>
                <td>Edinburgh</td>
                <td>35</td>
                <td>2012/09/26</td>
                <td>$217,500</td>
                <td>2290</td>
                <td>d.rios@datatables.net</td>
            </tr>
            <tr>
                <td>Jenette</td>
                <td>Caldwell</td>
                <td>Development Lead</td>
                <td>New York</td>
                <td>30</td>
                <td>2011/09/03</td>
                <td>$345,000</td>
                <td>1937</td>
                <td>j.caldwell@datatables.net</td>
            </tr>
            <tr>
                <td>Yuri</td>
                <td>Berry</td>
                <td>Chief Marketing Officer (CMO)</td>
                <td>New York</td>
                <td>40</td>
                <td>2009/06/25</td>
                <td>$675,000</td>
                <td>6154</td>
                <td>y.berry@datatables.net</td>
            </tr>
            <tr>
                <td>Caesar</td>
                <td>Vance</td>
                <td>Pre-Sales Support</td>
                <td>New York</td>
                <td>21</td>
                <td>2011/12/12</td>
                <td>$106,450</td>
                <td>8330</td>
                <td>c.vance@datatables.net</td>
            </tr>
            <tr>
                <td>Doris</td>
                <td>Wilder</td>
                <td>Sales Assistant</td>
                <td>Sidney</td>
                <td>23</td>
                <td>2010/09/20</td>
                <td>$85,600</td>
                <td>3023</td>
                <td>d.wilder@datatables.net</td>
            </tr>
            <tr>
                <td>Angelica</td>
                <td>Ramos</td>
                <td>Chief Executive Officer (CEO)</td>
                <td>London</td>
                <td>47</td>
                <td>2009/10/09</td>
                <td>$1,200,000</td>
                <td>5797</td>
                <td>a.ramos@datatables.net</td>
            </tr>
            <tr>
                <td>Gavin</td>
                <td>Joyce</td>
                <td>Developer</td>
                <td>Edinburgh</td>
                <td>42</td>
                <td>2010/12/22</td>
                <td>$92,575</td>
                <td>8822</td>
                <td>g.joyce@datatables.net</td>
            </tr>
            <tr>
                <td>Jennifer</td>
                <td>Chang</td>
                <td>Regional Director</td>
                <td>Singapore</td>
                <td>28</td>
                <td>2010/11/14</td>
                <td>$357,650</td>
                <td>9239</td>
                <td>j.chang@datatables.net</td>
            </tr>
            <tr>
                <td>Brenden</td>
                <td>Wagner</td>
                <td>Software Engineer</td>
                <td>San Francisco</td>
                <td>28</td>
                <td>2011/06/07</td>
                <td>$206,850</td>
                <td>1314</td>
                <td>b.wagner@datatables.net</td>
            </tr>
            <tr>
                <td>Fiona</td>
                <td>Green</td>
                <td>Chief Operating Officer (COO)</td>
                <td>San Francisco</td>
                <td>48</td>
                <td>2010/03/11</td>
                <td>$850,000</td>
                <td>2947</td>
                <td>f.green@datatables.net</td>
            </tr>
            <tr>
                <td>Shou</td>
                <td>Itou</td>
                <td>Regional Marketing</td>
                <td>Tokyo</td>
                <td>20</td>
                <td>2011/08/14</td>
                <td>$163,000</td>
                <td>8899</td>
                <td>s.itou@datatables.net</td>
            </tr>
            <tr>
                <td>Michelle</td>
                <td>House</td>
                <td>Integration Specialist</td>
                <td>Sidney</td>
                <td>37</td>
                <td>2011/06/02</td>
                <td>$95,400</td>
                <td>2769</td>
                <td>m.house@datatables.net</td>
            </tr>
            <tr>
                <td>Suki</td>
                <td>Burks</td>
                <td>Developer</td>
                <td>London</td>
                <td>53</td>
                <td>2009/10/22</td>
                <td>$114,500</td>
                <td>6832</td>
                <td>s.burks@datatables.net</td>
            </tr>
            <tr>
                <td>Prescott</td>
                <td>Bartlett</td>
                <td>Technical Author</td>
                <td>London</td>
                <td>27</td>
                <td>2011/05/07</td>
                <td>$145,000</td>
                <td>3606</td>
                <td>p.bartlett@datatables.net</td>
            </tr>
            <tr>
                <td>Gavin</td>
                <td>Cortez</td>
                <td>Team Leader</td>
                <td>San Francisco</td>
                <td>22</td>
                <td>2008/10/26</td>
                <td>$235,500</td>
                <td>2860</td>
                <td>g.cortez@datatables.net</td>
            </tr>
            <tr>
                <td>Martena</td>
                <td>Mccray</td>
                <td>Post-Sales support</td>
                <td>Edinburgh</td>
                <td>46</td>
                <td>2011/03/09</td>
                <td>$324,050</td>
                <td>8240</td>
                <td>m.mccray@datatables.net</td>
            </tr>
            <tr>
                <td>Unity</td>
                <td>Butler</td>
                <td>Marketing Designer</td>
                <td>San Francisco</td>
                <td>47</td>
                <td>2009/12/09</td>
                <td>$85,675</td>
                <td>5384</td>
                <td>u.butler@datatables.net</td>
            </tr>
            <tr>
                <td>Howard</td>
                <td>Hatfield</td>
                <td>Office Manager</td>
                <td>San Francisco</td>
                <td>51</td>
                <td>2008/12/16</td>
                <td>$164,500</td>
                <td>7031</td>
                <td>h.hatfield@datatables.net</td>
            </tr>
            <tr>
                <td>Hope</td>
                <td>Fuentes</td>
                <td>Secretary</td>
                <td>San Francisco</td>
                <td>41</td>
                <td>2010/02/12</td>
                <td>$109,850</td>
                <td>6318</td>
                <td>h.fuentes@datatables.net</td>
            </tr>
            <tr>
                <td>Vivian</td>
                <td>Harrell</td>
                <td>Financial Controller</td>
                <td>San Francisco</td>
                <td>62</td>
                <td>2009/02/14</td>
                <td>$452,500</td>
                <td>9422</td>
                <td>v.harrell@datatables.net</td>
            </tr>
            <tr>
                <td>Timothy</td>
                <td>Mooney</td>
                <td>Office Manager</td>
                <td>London</td>
                <td>37</td>
                <td>2008/12/11</td>
                <td>$136,200</td>
                <td>7580</td>
                <td>t.mooney@datatables.net</td>
            </tr>
            <tr>
                <td>Jackson</td>
                <td>Bradshaw</td>
                <td>Director</td>
                <td>New York</td>
                <td>65</td>
                <td>2008/09/26</td>
                <td>$645,750</td>
                <td>1042</td>
                <td>j.bradshaw@datatables.net</td>
            </tr>
            <tr>
                <td>Olivia</td>
                <td>Liang</td>
                <td>Support Engineer</td>
                <td>Singapore</td>
                <td>64</td>
                <td>2011/02/03</td>
                <td>$234,500</td>
                <td>2120</td>
                <td>o.liang@datatables.net</td>
            </tr>
            <tr>
                <td>Bruno</td>
                <td>Nash</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>38</td>
                <td>2011/05/03</td>
                <td>$163,500</td>
                <td>6222</td>
                <td>b.nash@datatables.net</td>
            </tr>
            <tr>
                <td>Sakura</td>
                <td>Yamamoto</td>
                <td>Support Engineer</td>
                <td>Tokyo</td>
                <td>37</td>
                <td>2009/08/19</td>
                <td>$139,575</td>
                <td>9383</td>
                <td>s.yamamoto@datatables.net</td>
            </tr>
            <tr>
                <td>Thor</td>
                <td>Walton</td>
                <td>Developer</td>
                <td>New York</td>
                <td>61</td>
                <td>2013/08/11</td>
                <td>$98,540</td>
                <td>8327</td>
                <td>t.walton@datatables.net</td>
            </tr>
            <tr>
                <td>Finn</td>
                <td>Camacho</td>
                <td>Support Engineer</td>
                <td>San Francisco</td>
                <td>47</td>
                <td>2009/07/07</td>
                <td>$87,500</td>
                <td>2927</td>
                <td>f.camacho@datatables.net</td>
            </tr>
            <tr>
                <td>Serge</td>
                <td>Baldwin</td>
                <td>Data Coordinator</td>
                <td>Singapore</td>
                <td>64</td>
                <td>2012/04/09</td>
                <td>$138,575</td>
                <td>8352</td>
                <td>s.baldwin@datatables.net</td>
            </tr>
            <tr>
                <td>Zenaida</td>
                <td>Frank</td>
                <td>Software Engineer</td>
                <td>New York</td>
                <td>63</td>
                <td>2010/01/04</td>
                <td>$125,250</td>
                <td>7439</td>
                <td>z.frank@datatables.net</td>
            </tr>
            <tr>
                <td>Zorita</td>
                <td>Serrano</td>
                <td>Software Engineer</td>
                <td>San Francisco</td>
                <td>56</td>
                <td>2012/06/01</td>
                <td>$115,000</td>
                <td>4389</td>
                <td>z.serrano@datatables.net</td>
            </tr>
            <tr>
                <td>Jennifer</td>
                <td>Acosta</td>
                <td>Junior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>43</td>
                <td>2013/02/01</td>
                <td>$75,650</td>
                <td>3431</td>
                <td>j.acosta@datatables.net</td>
            </tr>
            <tr>
                <td>Cara</td>
                <td>Stevens</td>
                <td>Sales Assistant</td>
                <td>New York</td>
                <td>46</td>
                <td>2011/12/06</td>
                <td>$145,600</td>
                <td>3990</td>
                <td>c.stevens@datatables.net</td>
            </tr>
            <tr>
                <td>Hermione</td>
                <td>Butler</td>
                <td>Regional Director</td>
                <td>London</td>
                <td>47</td>
                <td>2011/03/21</td>
                <td>$356,250</td>
                <td>1016</td>
                <td>h.butler@datatables.net</td>
            </tr>
            <tr>
                <td>Lael</td>
                <td>Greer</td>
                <td>Systems Administrator</td>
                <td>London</td>
                <td>21</td>
                <td>2009/02/27</td>
                <td>$103,500</td>
                <td>6733</td>
                <td>l.greer@datatables.net</td>
            </tr>
            <tr>
                <td>Jonas</td>
                <td>Alexander</td>
                <td>Developer</td>
                <td>San Francisco</td>
                <td>30</td>
                <td>2010/07/14</td>
                <td>$86,500</td>
                <td>8196</td>
                <td>j.alexander@datatables.net</td>
            </tr>
            <tr>
                <td>Shad</td>
                <td>Decker</td>
                <td>Regional Director</td>
                <td>Edinburgh</td>
                <td>51</td>
                <td>2008/11/13</td>
                <td>$183,000</td>
                <td>6373</td>
                <td>s.decker@datatables.net</td>
            </tr>
            <tr>
                <td>Michael</td>
                <td>Bruce</td>
                <td>Javascript Developer</td>
                <td>Singapore</td>
                <td>29</td>
                <td>2011/06/27</td>
                <td>$183,000</td>
                <td>5384</td>
                <td>m.bruce@datatables.net</td>
            </tr>
            <tr>
                <td>Donna</td>
                <td>Snider</td>
                <td>Customer Support</td>
                <td>New York</td>
                <td>27</td>
                <td>2011/01/25</td>
                <td>$112,000</td>
                <td>4226</td>
                <td>d.snider@datatables.net</td>
            </tr>
        </tbody>
    </table>

                                <!-- PAGE CONTENT ENDS -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
@endsection

@section('js')
<!-- page specific plugin scripts -->
<script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/js/jquery.dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('/js/dataTables.select.min.js') }}"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<!-- inline scripts related to this page -->
    <script type="text/javascript">
            jQuery(function($) {
              $('#lupa')
              .DataTable({});


                //initiate dataTables plugin
                var myTable =
                $('#dynamic-table')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .DataTable( {
                    responsive: true,
                    columnDefs: [
                			{ responsivePriority: 1, targets: 0 },
                			{ responsivePriority: 10001, targets: 4 },
                			{ responsivePriority: 2, targets: -2 }
                		],
                    bAutoWidth: false,
                    "aoColumns": [
                      { "bSortable": false },
                      null, null,null, null, null,
                      { "bSortable": false }
                    ],
                    "aaSorting": [],


                    //"bProcessing": true,
                    //"bServerSide": true,
                    //"sAjaxSource": "http://127.0.0.1/table.php"   ,

                    //,
                    //"sScrollY": "200px",
                    //"bPaginate": false,

                    //"sScrollX": "100%",
                    //"sScrollXInner": "120%",
                    //"bScrollCollapse": true,
                    //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                    //you may want to wrap the table inside a "div.dataTables_borderWrap" element

                    //"iDisplayLength": 50


                    select: {
                        style: 'multi'
                    }
                } );



                $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

                new $.fn.dataTable.Buttons( myTable, {
                    buttons: [
                      {
                        "extend": "colvis",
                        "text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
                        "className": "btn btn-white btn-primary btn-bold",
                        columns: ':not(:first):not(:last)'
                      },
                      {
                        "extend": "copy",
                        "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                      },
                      {
                        "extend": "csv",
                        "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                      },
                      {
                        "extend": "excel",
                        "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                      },
                      {
                        "extend": "pdf",
                        "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                      },
                      {
                        "extend": "print",
                        "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                        "className": "btn btn-white btn-primary btn-bold",
                        autoPrint: false,
                        message: 'This print was produced using the Print button for DataTables'
                      }
                    ]
                } );
                myTable.buttons().container().appendTo( $('.tableTools-container') );

                //style the message box
                var defaultCopyAction = myTable.button(1).action();
                myTable.button(1).action(function (e, dt, button, config) {
                    defaultCopyAction(e, dt, button, config);
                    $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
                });


                var defaultColvisAction = myTable.button(0).action();
                myTable.button(0).action(function (e, dt, button, config) {

                    defaultColvisAction(e, dt, button, config);


                    if($('.dt-button-collection > .dropdown-menu').length == 0) {
                        $('.dt-button-collection')
                        .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
                        .find('a').attr('href', '#').wrap("<li />")
                    }
                    $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
                });

                ////

                setTimeout(function() {
                    $($('.tableTools-container')).find('a.dt-button').each(function() {
                        var div = $(this).find(' > div').first();
                        if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
                        else $(this).tooltip({container: 'body', title: $(this).text()});
                    });
                }, 500);





                myTable.on( 'select', function ( e, dt, type, index ) {
                    if ( type === 'row' ) {
                        $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
                    }
                } );
                myTable.on( 'deselect', function ( e, dt, type, index ) {
                    if ( type === 'row' ) {
                        $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
                    }
                } );




                /////////////////////////////////
                //table checkboxes
                $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

                //select/deselect all rows according to table header checkbox
                $('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
                    var th_checked = this.checked;//checkbox inside "TH" table header

                    $('#dynamic-table').find('tbody > tr').each(function(){
                        var row = this;
                        if(th_checked) myTable.row(row).select();
                        else  myTable.row(row).deselect();
                    });
                });

                //select/deselect a row when the checkbox is checked/unchecked
                $('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
                    var row = $(this).closest('tr').get(0);
                    if(this.checked) myTable.row(row).deselect();
                    else myTable.row(row).select();
                });



                $(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
                    e.stopImmediatePropagation();
                    e.stopPropagation();
                    e.preventDefault();
                });


                /********************************/
                //add tooltip for small view action buttons in dropdown menu
                $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});

                //tooltip placement on right or left
                function tooltip_placement(context, source) {
                    var $source = $(source);
                    var $parent = $source.closest('table')
                    var off1 = $parent.offset();
                    var w1 = $parent.width();

                    var off2 = $source.offset();
                    //var w2 = $source.width();

                    if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
                    return 'left';
                }




                /***************/
                $('.show-details-btn').on('click', function(e) {
                    e.preventDefault();
                    $(this).closest('tr').next().toggleClass('open');
                    $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
                });
                /***************/





                /**
                //add horizontal scrollbars to a simple table
                $('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
                  {
                    horizontal: true,
                    styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
                    size: 2000,
                    mouseWheelLock: true
                  }
                ).css('padding-top', '12px');
                */


            })
        </script>
@endsection
