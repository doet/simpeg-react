@extends('backend.app_backend')

@section('css')
    <!-- page specific plugin styles -->
    <link href="{{ asset('') }}" rel="stylesheet">{!! Html::style('/css/chosen.min.css') !!}
    <link href="{{ asset('') }}" rel="stylesheet">{!! Html::style('/css/bootstrap-datepicker3.min.css') !!}

    <link href="{{ asset('') }}" rel="stylesheet">{!! Html::style('/css/ui.jqgrid.min.css') !!}

    <link href="{{ asset('') }}" rel="stylesheet">{!! Html::style('/css/colorbox.min.css') !!}
    <link href="{{ asset('') }}" rel="stylesheet">{!! Html::style('/css/uploadfile.css') !!}

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
            <div class="widget-box">
                <div class="widget-header widget-header-blue widget-header-flat">
                    <h4 class="widget-title lighter">New Item Wizard</h4>
                    <div class="widget-toolbar">
                        <label>
                            <small class="green">
                                <b>Status Karyawan</b>
                            </small>

                            <input id="karyawanaktif" name="karyawanaktif" type="checkbox" class="ace ace-switch ace-switch-4" <?php if($karyawan['aktif'] == 1) echo 'checked';?>/>
                            <span class="lbl middle"></span>
                        </label>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <div id="fuelux-wizard-container">
                            <div>
                                <ul class="steps">
                                    <li data-step="1" class="active">
                                        <span class="step">1</span>
                                        <span class="title">Data Karyawan</span>
                                    </li>
                                    <li data-step="2">
                                        <span class="step">2</span>
                                        <span class="title">Data Keluarga</span>
                                    </li>
                                    <li data-step="3">
                                        <span class="step">3</span>
                                        <span class="title">Dokumen</span>
                                    </li>
                                    <li data-step="4">
                                        <span class="step">4</span>
                                        <span class="title"></span>
                                    </li>
                                </ul>
                            </div>

                            <hr />

                            <div class="step-content pos-rel">

<!-- - - - - - - - - - - - - - - Step 1 - - - - - - - - - - - - - - - - - - - - -->

                                <div class="step-pane active" data-step="1">
                                    <form class="form-horizontal" id="validation-form" method="get">
                                        {!! csrf_field() !!}
                                        <input type="hidden" id='datatb' name="datatb" value="edituser" />
                                        <input type="hidden" id='id' name="id" value="{{$karyawan['id']}}" />
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right">NIK : </label>
                        <div class="col-xs-12 col-sm-2">
                            <div class="clearfix">
                                <div class="input-group input-group-sm">
                                    <input type="text" id="nip " name="nip" value="{{$karyawan['nip']}}"/>
                                </div>
                            </div>
                        </div>
                    </div><div class="space-2"></div>

                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right">Nama Lengkap : </label>
                        <div class="col-xs-12 col-sm-2">
                            <div class="clearfix">
                                <div class="input-group input-group-sm">
                                    <input type="text" id="namal" name="namal" value="{{$karyawan['nama']}}"/>
                                </div>
                            </div>
                        </div>
                    </div><div class="space-2"></div>

                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right">Divisi :</label>
                        <div class="col-xs-12 col-sm-9">
                            <select id="divisi" name="divisi" class="chosen-select" data-placeholder="Pilih ..." >
                                <option value="">&nbsp;</option>
                                @foreach($divslc as $data)
                                    <option value="{{$data->vid}}">{{$data->label}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div><div class="space-2"></div>

                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Jabatan :</label>
                        <div class="col-xs-12 col-sm-9">
                            <select id="jabatan" name="jabatan" class="chosen-select" data-placeholder="Pilih ..." >
                                <option value="">&nbsp;</option>
                                @foreach($jbtnslc as $data)
                                    <option value="{{$data->vid}}">{{$data->label}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div><div class="space-2"></div>

                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">Waktu Kerja :</label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input id="wkerja" name="wkerja" type="checkbox" value="1" class="ace ace-switch ace-switch-4" <?php if($karyawan['wkerja'] == 1) echo 'checked';?>/>
                                <span class="lbl" data-lbl="&nbsp;O&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;III"></span>
                                <small id="nonshift" class="green">
                                    <b>Non Shift / </b>
                                </small>
                                <small id="shift" class="green">
                                    <b>Shift</b>
                                </small>
                            </div>
                        </div>
                    </div><div class="space-2"></div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">Status Pekerjaan :</label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input id="sts" name="sts" type="checkbox" value="Tetap" class="ace ace-switch ace-switch-4" <?php if($karyawan['status_pegawai'] == 'Tetap') echo 'checked';?>/>
                                <span class="lbl" data-lbl="&nbsp;O&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;III"></span>
                                <small id="kontrak" class="green ">
                                    <b>Kontrak / </b>
                                </small>
                                <small id="tetap" class="green ">
                                    <b>Tetap</b>
                                </small>
                            </div>
                        </div>
                    </div><div class="space-2"></div>

                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">TMB :</label>
                        <div class="col-xs-12 col-sm-2">
                            <div class="clearfix">
                                <div class="input-group input-group-sm">
                                    <input type="text" name="tmb" class="tgl" id="tmb" />
                                    <span class="input-group-addon"><i class="ace-icon fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div><div class="space-2"></div>


                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right">ID Absen :</label>
                        <div class="col-xs-12 col-sm-2">
                            <div class="clearfix">
                                <div class="input-group input-group-sm">
                                    <input type="text" name="idabsen" value="{{$karyawan['idabsen']}}" id="idabsen" />
                                </div>
                            </div>
                        </div>
                    </div><div class="space-2"></div>

                    <div class="form-group">
                        <?php
                        if ($karyawan['rekbank']){
                            $bank = explode('-', $karyawan['rekbank']);
                        } else {
                            $bank = explode('-', '-');
                        }
                        ?>
                        <label class="col-sm-3 control-label no-padding-right" for="state">Bank :</label>
                        <div class="col-sm-9">
                            <span>
                            <select id="bank" name="bank" class="chosen-select" data-placeholder="Pilih ..." >
                                <option value="">&nbsp;</option>
                                <option value="BCA">BCA</option>
                                <option value="BNI">BNI</option>
                                <option value="BRI">BRI</option>
                                <option value="MANDIRI">MANDIRI</option>
                            </select>
                        </span>
                        <span>
                            <label class="control-label no-padding-right" for="state">No Rek :&nbsp;</label>
                            <input type="text" id="norek" name="norek" value="{{$bank[1]}}"/>
                        </span>
                        </div>
                    </div><div class="space-2"></div>

                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Email Address :</label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix"><input type="email" name="email" value="{{$karyawan['email']}}" id="email" class="col-xs-12 col-sm-4" /></div>
                        </div>
                    </div><div class="space-2"></div>
                     <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Ganti Password :</label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix"><input type="password" name="password" id="password" class="col-xs-12 col-sm-4" /></div>
                        </div>
                    </div><div class="space-2"></div>
                    <div class="hr hr-dotted"></div>
                    <div class="form-group">
                        <?php
                        if ($karyawan['pendidikan']){
                            $pendidikan = explode('-', $karyawan['pendidikan']);
                        } else {
                            $pendidikan = explode('-', '-');
                        }
                        ?>
                        <label class="col-sm-3 control-label no-padding-right" for="state">Pendidikan Terakhir:</label>
                        <div class="col-sm-9">
                            <span>
                            <select id="pendidikan" name="pendidikan" class="chosen-select" data-placeholder="Pilih ..." >
                                <option value="">&nbsp;</option>
                                <option value="SD">SD</option>
                                <option value="SLTP">SLTP</option>
                                <option value="SLTA">SLTA</option>
                                <option value="D3">D3</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="ATT II">ATT II</option>
                                <option value="ANT II">ANT II</option>
                                <option value="ANT III">ANT III</option>
                            </select>
                        </span>
                        <span>
                            <label class="control-label no-padding-right" for="state">Jurusan:&nbsp;</label>
                            <input type="text" id="jurusan" name="jurusan" value="{{$pendidikan[1]}}"/>
                        </span>
                        </div>
                    </div><div class="space-2"></div>

                    <div class="hr hr-dotted"></div>

                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right">Jenis Kelamin</label>
                        <div class="col-xs-12 col-sm-9">
                            <span>
                                <label class="line-height-1 blue">
                                    <input name="jk" value="L" type="radio" class="ace" <?php if($karyawan['jk'] == 'L')echo 'checked="checked"';?>/><span class="lbl"> Laki - Laki</span>
                                </label>&nbsp;
                            </span>
                            <span>
                                &nbsp;<label class="line-height-1 blue">
                                    <input name="jk" value="P" type="radio" class="ace" <?php if($karyawan['jk'] == 'P')echo 'checked="checked"';?>/><span class="lbl"> Perempuan</span>
                                </label>
                            </span>
                        </div>
                    </div><div class="space-2"></div>

                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="dob">Tanggal Lahir :</label>
                        <div class="col-xs-12 col-sm-2">
                            <div class="clearfix">
                                <div class="input-group input-group-sm">
                                    <input type="text" name="dob" id="dob" class="tgl">
                                    <span class="input-group-addon"><i class="ace-icon fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div><div class="space-2"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="state">Golingan Darah :</label>
                        <div class="col-sm-9">
                            <span>
                                <select id="goldar" name="goldar" class="chosen-select" data-placeholder="Pilih ..." >
                                    <option value="">&nbsp;</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                </select>
                            </span>
                        </div>
                    </div><div class="space-2"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="state">Agama :</label>
                        <div class="col-sm-9">
                            <span>
                                <select id="agama" name="agama" class="chosen-select" data-placeholder="Pilih ..." >
                                    <option value="">&nbsp;</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Hindu">Hindu</option>
                                </select>
                            </span>
                        </div>
                    </div><div class="space-2"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="name">No KK :</label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix"><input type="text" name="nokk" value="{{$karyawan['nokk']}}" class="col-xs-12 col-sm-5"/></div>
                        </div>
                    </div>
                    <div class="space-2"></div>

                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Alamat</label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix"><textarea class="input-xlarge" name="alamat" id="alamat">{{$karyawan['alamat']}}</textarea></div>
                        </div>
                    </div><div class="space-2"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="state">Keluarga Dekat :</label>
                        <div class="col-sm-9">
                            <span>
                                <input type="text" id="keldekat" name="keldekat" value="{{$karyawan['keldekat']}}"/>
                            </span>
                            <span>
                                <label class="control-label no-padding-right" for="state">Tlp :&nbsp;</label>
                                <input type="text" id="keltlp" name="keltlp" value="{{$karyawan['keltlp']}}"/>
                            </span>
                        </div>
                    </div><div class="space-2"></div>
                                    </form>
                                </div>

<!-- - - - - - - - - - - - - - - Step 2 - - - - - - - - - - - - - - - - - - - - -->
                                <div class="step-pane" data-step="2">

            <div id="modal-kel" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
            <!-- 01 Header Form-->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="smaller lighter blue no-margin">Form Keluarga</h3>
                        </div>
            <!-- 01 end heder form-->
            <!-- 02 body Form -->
                        <div class="modal-body">
                            <form class="form-horizontal form-aktif" id="form-kel" method="get">
                                {!! csrf_field() !!}
                                <input type="hidden" id='datatb' name="datatb" value="dtmkeluarga" />
                                <input type="hidden" id='oper-kel' name="oper-kel" value="" />
                                <input type="hidden" id='idkel' name="id" value="" />
                                <input type="hidden" id='id_u' name="id_u" value="" />

                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-3 no-padding-right">Nama</label>
                                    <div class="col-xs-12 col-sm-9">
                                        <div class="clearfix"><input type="text" id="namakel" name="namakel"></div>
                                    </div>
                                </div><div class="space-2"></div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="state">HUB :</label>
                                    <div class="col-xs-12 col-sm-3">
                                        <span>
                                            <select id="hub" name="hub" data-placeholder="Pilih ..." >
                                                <option value="">&nbsp;</option>
                                                <option value="suami">Suami</option>
                                                <option value="istri">Istri</option>
                                                <option value="anak">Anak</option>
                                            </select>
                                        </span>
                                    </div>
                                </div><div class="space-2"></div>

                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-3 no-padding-right">Tanggal Lahir :</label>
                                    <div class="col-xs-12 col-sm-2">
                                        <div class="clearfix">
                                            <div class="input-group input-group-sm">
                                                <input type="text" name="dobkel" id="dobkel" class="tgl" value="{{date('d F Y')}}" />
                                                <span class="input-group-addon"><i class="ace-icon fa fa-calendar"></i></span>

                                            </div>
                                        </div>
                                    </div>
                                </div><div class="space-2"></div>
                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-3 no-padding-right">Jenis Kelamin</label>
                                    <div class="col-xs-12 col-sm-9">
                                        <span>
                                            <label class="line-height-1 blue">
                                                <input id="jkkell" name="jkkel" value="L" type="radio" class="ace"><span class="lbl"> Laki - Laki</span>
                                            </label>&nbsp;
                                        </span>
                                        <span>
                                            &nbsp;<label  class="line-height-1 blue">
                                                <input id="jkkelp" name="jkkel" value="P" type="radio" class="ace"><span class="lbl"> Perempuan</span>
                                            </label>
                                        </span>
                                    </div>
                                </div><div class="space-2"></div>
                            </form>
                        </div>
            <!-- 02 end body Form -->
            <!-- 03 footer Form -->
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                <i class="ace-icon fa fa-times"></i>Close
                            </button>
                            <button  class="btn btn-sm btn-danger pull-right" id='btn-kel'>
                                <i class="ace-icon fa fa-user-plus"></i>Save
                            </button>
                        </div>
            <!-- 03 end footer Form -->
                    </div>
                </div><!-- /.modal-dialog -->
            </div>
            <!-- end Form -->
                                    <div class="center">
                                        <table id="table_r"></table>
                                        <div id="pager_r"></div>
                                    </div>
                                </div>
<!-- - - - - - - - - - - - - - - Step 3 - - - - - - - - - - - - - - - - - - - - -->
                                <div class="step-pane" data-step="3">
            <div id="modal-dok" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
            <!-- 01 Header Form-->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="smaller lighter blue no-margin">Form Dokumen</h3>
                        </div>
            <!-- 01 end heder form-->
            <!-- 02 body Form -->
                        <div class="modal-body">
                            <input type="hidden" id='oper-dok' name="oper-dok" value="" />

                            <div id="fileuploader">Upload</div>
                            <button id='extrabutton' class="btn btn-sm btn-danger ">
                            <i class="ace-icon fa fa-user-plus"></i>send</button>

                        </div>
            <!-- 02 end body Form -->
            <!-- 03 footer Form -->
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                <i class="ace-icon fa fa-times"></i>Close
                            </button>
                        </div>
            <!-- 03 end footer Form -->
                    </div>
                </div><!-- /.modal-dialog -->
            </div>
            <!-- end Form -->

                                    <div class="center">
                                        <table id="table_r2"></table>
                                        <div id="pager_r2"></div>
                                    </div>
                                </div>
<!-- - - - - - - - - - - - - - - Step 4 - - - - - - - - - - - - - - - - - - - - -->
                                <div class="step-pane" data-step="4">
                                    <div class="center">
                                        <h3 class="green">Congrats!</h3>
                                        Your product is ready to ship! Click finish to continue!
                                    </div>
                                </div>
<!-- - - - - - - - - - - - - - - End Step - - - - - - - - - - - - - - - - - - - - -->
                            </div>
                        </div>

                        <hr />
                        <div class="wizard-actions">
                            <button class="btn btn-prev">
                                <i class="ace-icon fa fa-arrow-left"></i>
                                Prev
                            </button>

                            <button class="btn btn-success btn-next" data-last="Finish">
                                Next
                                <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                            </button>
                        </div>
                    </div><!-- /.widget-main -->
                </div><!-- /.widget-body -->
            </div>

            <div id="modal-wizard" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div id="modal-wizard-container">
                            <div class="modal-header">
                                <ul class="steps">
                                    <li data-step="1" class="active">
                                        <span class="step">1</span>
                                        <span class="title">Validation states</span>
                                    </li>

                                    <li data-step="2">
                                        <span class="step">2</span>
                                        <span class="title">Alerts</span>
                                    </li>

                                    <li data-step="3">
                                        <span class="step">3</span>
                                        <span class="title">Payment Info</span>
                                    </li>

                                    <li data-step="4">
                                        <span class="step">4</span>
                                        <span class="title">Other Info</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="modal-body step-content">
                                <div class="step-pane active" data-step="1">
                                    <div class="center">
                                        <h4 class="blue">Step 1</h4>
                                    </div>
                                </div>

                                <div class="step-pane" data-step="2">
                                    <div class="center">
                                        <h4 class="blue">Step 2</h4>
                                    </div>
                                </div>

                                <div class="step-pane" data-step="3">
                                    <div class="center">
                                        <h4 class="blue">Step 3</h4>
                                    </div>
                                </div>

                                <div class="step-pane" data-step="4">
                                    <div class="center">
                                        <h4 class="blue">Step 4</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer wizard-actions">
                            <button class="btn btn-sm btn-prev">
                                <i class="ace-icon fa fa-arrow-left"></i>
                                Prev
                            </button>

                            <button class="btn btn-success btn-sm btn-next" data-last="Finish">
                                Next
                                <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                            </button>

                            <button class="btn btn-danger btn-sm pull-left" data-dismiss="modal">
                                <i class="ace-icon fa fa-times"></i>
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('js')
    <!-- page specific plugin scripts -->
    <script src="{{ asset('') }}"></script>{!! HTML::script('/js/chosen.jquery.min.js') !!}
    <script src="{{ asset('') }}"></script>{!! HTML::script('/js/bootstrap-datepicker.min.js') !!}
    <script src="{{ asset('') }}"></script>{!! HTML::script('/js/jquery.maskedinput.min.js') !!}

    <script src="{{ asset('') }}"></script>{!! HTML::script('/js/wizard.min.js') !!}

    <script src="{{ asset('') }}"></script>{!! HTML::script('/js/jquery.jqGrid.min.js') !!}
    <script src="{{ asset('') }}"></script>{!! HTML::script('/js/grid.locale-en.js') !!}

    <script src="{{ asset('') }}"></script>{!! HTML::script('/js/jquery.colorbox.min.js') !!}
    <script src="{{ asset('') }}"></script>{!! HTML::script('/js/jquery.uploadfile.min.js') !!}

    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        jQuery(function($) {

            $('.chosen-select').chosen({allow_single_deselect:true,disable_search_threshold: 5});

            $('#divisi').val({{$karyawan['divisi']}}).trigger("chosen:updated");
            $('#jabatan').val({{$karyawan['jabatan']}}).trigger("chosen:updated");

            $('#bank').val('{{$bank[0]}}').trigger("chosen:updated");
            $('#goldar').val('{{$karyawan["goldar"]}}').trigger("chosen:updated");
            $('#pendidikan').val('{{$pendidikan[0]}}').trigger("chosen:updated");
            $('#agama').val('{{$karyawan["agama"]}}').trigger("chosen:updated");

            $('.tgl').datepicker({format:'dd MM yyyy', viewformat: 'dd MM yyyy', autoclose:true});
            $('#tmb').datepicker("setDate", new Date({{$karyawan['tmb']}}*1000));
            $('#dob').datepicker("setDate", new Date({{$karyawan['dob']}}*1000));

            var $validation = false;
            $('#fuelux-wizard-container').ace_wizard({
                //step: 2 //optional argument. wizard will jump to step "2" at first
                //buttons: '.wizard-actions:eq(0)'
            }).on('actionclicked.fu.wizard' , function(e, info){
                if(info.step == 1 ) {
                    var request = $("#validation-form").serialize();

                    //var request = $("#form-2").serialize();
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: "{{ url('/CrudxAdmin/') }}",
                        data: request,
                        beforeSend:function(){
                        //  var newHTML = '<i class="ace-icon fa fa-spinner fa-spin "></i><span  id="btn" class="bigger-110">Loading...</span>';
                        //  document.getElementById('btn').innerHTML = newHTML;

                        },
                        success: function(msg) {
                        //  var HTML = '<i class="ace-icon fa fa-key"></i><span  id="btn" class="bigger-110">Ubah</span>';
                        //  document.getElementById('btn').innerHTML = HTML;

                            if(msg.status == 'success'){
                                $("#btn").removeClass("kirim");

                            } else {
                                //alert (msg.msg);
                            }

                        },
                        error: function(xhr, Status, err) {
                            //alert("Terjadi error : "+Status);

                            alert (JSON.stringify(xhr));
                            //var HTML = '<i class="ace-icon fa fa-key"></i><span  id="btn" class="bigger-110">Ubah</span>';
                            //document.getElementById('btn').innerHTML = HTML;
                            alert ("terjadi kesalahan harap hubungi administrator");
                        }
                    });
                }
            })
            //.on('changed.fu.wizard', function() {
            //})
            .on('finished.fu.wizard', function(e) {
                bootbox.dialog({
                    message: "Thank you! Your information was successfully saved!",
                    buttons: {
                        "success" : {
                            "label" : "OK",
                            "className" : "btn-sm btn-primary"
                        }
                    }
                });
            }).on('stepclick.fu.wizard', function(e){
                //e.preventDefault();//this will prevent clicking and selecting steps
            });


            //jump to a step
            /**
            var wizard = $('#fuelux-wizard-container').data('fu.wizard')
            wizard.currentStep = 3;
            wizard.setState();
            */

            //determine selected step
            //wizard.selectedItem().step


            //documentation : http://docs.jquery.com/Plugins/Validation/validate
            $.mask.definitions['~']='[+-]';
            $('#phone').mask('(999) 999-9999');

            jQuery.validator.addMethod("phone", function (value, element) {
                return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
            }, "Enter a valid phone number.");

            $('#validation-form').validate({
                errorElement: 'div',
                errorClass: 'help-block',
                focusInvalid: false,
                ignore: "",
                rules: {
                    email: {
                        required: true,
                        email:true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    password2: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    },
                    name: {
                        required: true
                    },
                    phone: {
                        required: true,
                        phone: 'required'
                    },
                    url: {
                        required: true,
                        url: true
                    },
                    comment: {
                        required: true
                    },
                    state: {
                        required: true
                    },
                    platform: {
                        required: true
                    },
                    subscription: {
                        required: true
                    },
                    gender: {
                        required: true,
                    },
                    agree: {
                        required: true,
                    }
                },

                messages: {
                    email: {
                        required: "Please provide a valid email.",
                        email: "Please provide a valid email."
                    },
                    password: {
                        required: "Please specify a password.",
                        minlength: "Please specify a secure password."
                    },
                    state: "Please choose state",
                    subscription: "Please choose at least one option",
                    gender: "Please choose gender",
                    agree: "Please accept our policy"
                },


                highlight: function (e) {
                    $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
                },

                success: function (e) {
                    $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
                    $(e).remove();
                },

                errorPlacement: function (error, element) {
                    if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                        var controls = element.closest('div[class*="col-"]');
                        if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                        else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                    }
                    else if(element.is('.select2')) {
                        error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
                    }
                    else if(element.is('.chosen-select')) {
                        error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
                    }
                    else error.insertAfter(element.parent());
                },

                submitHandler: function (form) {
                },
                invalidHandler: function (form) {
                }
            });




            $('#modal-wizard-container').ace_wizard();
            $('#modal-wizard .wizard-actions .btn[data-dismiss=modal]').removeAttr('disabled');


            /**
            $('#date').datepicker({autoclose:true}).on('changeDate', function(ev) {
                $(this).closest('form').validate().element($(this));
            });

            $('#mychosen').chosen().on('change', function(ev) {
                $(this).closest('form').validate().element($(this));
            });
            */
            var tabel = "#table_r";
            var pager_tabel = "#pager_r";
            var tabel2 = "#table_r2";
            var pager_tabel2 = "#pager_r2";
            var operdok='add';


            //resize to fit page size
            $(window).on('resize.jqGrid', function () {
                $(tabel).jqGrid( 'setGridWidth', $(".page-content").width()-30 );
                $(tabel2).jqGrid( 'setGridWidth', $(".page-content").width()-30 );
            })

            //resize on sidebar collapse/expand
            var parent_column = $(tabel).closest('[class*="col-"]');
            var parent_column2 = $(tabel2).closest('[class*="col-"]');

            $(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
                if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
                    //setTimeout is for webkit only to give time for DOM changes and then redraw!!!
                    setTimeout(function() {
                        $(tabel).jqGrid( 'setGridWidth', parent_column.width() );
                        $(tabel2).jqGrid( 'setGridWidth', parent_column2.width() );
                    }, 0);
                }
            })
                        //if your grid is inside another element, for example a tab pane, you should use its parent's width:
            $(window).on('resize.jqGrid', function () {
                var parent_width = $(tabel).closest('.tab-pane').width();
                var parent_width2 = $(tabel2).closest('.tab-pane').width();
                $(tabel).jqGrid( 'setGridWidth', parent_width );
                $(tabel2).jqGrid( 'setGridWidth', parent_width2 );
            })
            //and also set width when tab pane becomes visible
            $('#myTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
              if($(e.target).attr('href') == '#mygrid') {
                var parent_width = $(tabel).closest('.tab-pane').width();
                var parent_width2 = $(tabel2).closest('.tab-pane').width();
                $(tabel).jqGrid( 'setGridWidth', parent_width );
                $(tabel2).jqGrid( 'setGridWidth', parent_width2 );
              }
            })


            var master = jQuery(tabel).jqGrid({
                caption: "Data Keluarga {{$karyawan['nama']}}",
                datatype: "json",            //supported formats XML, JSON or Arrray
                url:"{{url('GridAdmin')}}",
                editurl: "{{url('CrudAdmin')}}",//nothing is saved
                mtype : "post",
                height: 250,
                colNames:['Nama','Hub Keluarga','Jenis Kelamin','Tgl Lahir'],
                colModel:[
                    {name:'nama',index:'nama', width:120,editable: true},
                    {name:'hk',index:'hk', width:80, editable: false },
                    {name:'jk',index:'jk', width:150, editable: false},
                    {name:'dob',index:'dob', width:150,editable: true}
                ],
                postData: {datatb:'dtmkeluarga', cari:{{$karyawan['id']}}, _token:'<?php echo csrf_token();?>'},
                sortname:'id',
                viewrecords : true,
                rowNum:10,
                rowList:[10,20,30],
                pager : pager_tabel,
                altRows: true,
                multiboxonly: true,

                loadComplete : function() {
                    var table = this;
                    setTimeout(function(){

                        updatePagerIcons(table);
                        enableTooltips(table);
                    }, 0);
                },

                serializeRowData:function(postdata,ids) {
                    postdata._token = '<?php echo csrf_token();?>';
                    return postdata;
                }
            });
            $(window).triggerHandler('resize.jqGrid');//trigger window resize to make the grid get the correct size

            //navButtons
            jQuery(tabel).jqGrid('navGrid',pager_tabel,
            {   //navbar options

                edit: false,
                editicon : 'ace-icon fa fa-pencil blue',
                add: false,
                addicon : 'ace-icon fa fa-plus-circle purple',
                del: true,
                delicon : 'ace-icon fa fa-trash-o red',
                search: false,
                searchicon : 'ace-icon fa fa-search orange',
                refresh: true,
                refreshicon : 'ace-icon fa fa-refresh green',
                view: false,
                viewicon : 'ace-icon fa fa-search-plus grey',

            },{},{},{
                //delete record form
                recreateForm: true,
                beforeShowForm : function(e) {
                    var form = $(e[0]);
                    if(form.data('styled')) return false;

                    form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                    style_delete_form(form);

                    form.data('styled', true);
                },
                onclickSubmit: function () {
                    return { datatb:'dtmkeluarga', _token:'<?php echo csrf_token();?>', 'oper-kel':'del'};
                }
            },{}).jqGrid('navButtonAdd',pager_tabel,{
                caption:"",
                buttonicon:"ace-icon fa fa-pencil blue",
                position:"first",
                onClickButton:function(){
                    $('#form-kel').trigger("reset");
                    $('#hub').chosen({width: "95%",allow_single_deselect:true,disable_search_threshold: 5});

                    var gsr = jQuery(tabel).jqGrid('getGridParam','selrow');

                    if(gsr){
                        var postData= {datatb:'dtmkeluarga', cari: gsr, _token:'<?php echo csrf_token();?>', oper:'pra-edit'};
                         $('.tgl').datepicker({format:'dd MM yyyy', autoclose:true});
                        $.ajax({
                            url: "{{url('LookupAdmin')}}",
                            data : postData,
                            type: "post",
                            success: function(response){
                                $('#oper-kel').val('edit');
                                $('#idkel').val(gsr);
                                $('#id_u').val(response.id_u);
                                $('#namakel').val(response.nama);
                                $("#hub").val(response.hub).trigger("change").trigger("chosen:updated");
                                $('#dobkel').datepicker("setDate", new Date(response.dob*1000));
                                if(response.jk == 'L') $("#jkkell").prop("checked", true);else $("#jkkelp").prop("checked", true);
                            }
                        });
                        $('#modal-kel').modal('show');

                        $('#hub').val('').trigger("change").trigger("chosen:updated")

                    } else {
                        alert("pilih tabel")
                    }
                }
            }).jqGrid('navButtonAdd',pager_tabel,{
                caption:"",
                buttonicon:"ace-icon fa fa-user-plus purple",
                position:"first",
                onClickButton:function(){
                    $('#oper-kel').val('add');

                    $('#hub').chosen({width: "95%",allow_single_deselect:true,disable_search_threshold: 5});
                    $('#hub').val('').trigger("change").trigger("chosen:updated");
                    $("#jkkell").prop("checked", false);
                    $("#jkkelp").prop("checked", false);
                    $('#id_u').val("{{$karyawan['id']}}");
                    $('#form-kel').trigger("reset");
                    $('#modal-kel').modal('show');
               }
            })

            var master2 = jQuery(tabel2).jqGrid({
                caption: "Data Dokumen {{$karyawan['nama']}}",
                datatype: "json",            //supported formats XML, JSON or Arrray
                url:"{{url('GridAdmin')}}",
                editurl: "{{url('CrudAdmin')}}",//nothing is saved
                mtype : "post",
                height: 250,
                colNames:['Nama Dokumen','File'],
                colModel:[
                    {name:'nama',index:'nama', width:230,editable: true},
                    {name:'hk',index:'hk', width:370, editable: false, formatter:link},
                ],
                postData: {datatb:'dokumen', cari:{{$karyawan['id']}}, _token:'<?php echo csrf_token();?>'},
                sortname:'id',
                viewrecords : true,
                rowNum:10,
                rowList:[10,20,30],
                pager : pager_tabel2,
                altRows: true,
                multiboxonly: true,

                loadComplete : function() {
                    var table2 = this;
                    setTimeout(function(){

                        updatePagerIcons(table2);
                        enableTooltips(table2);
                    }, 0);
                },

                serializeRowData:function(postdata,ids) {
                    postdata.datatb = 'mlibur';
                    postdata._token = '<?php echo csrf_token();?>';
                    return postdata;
                },
                gridComplete: function(){
                    var $overflow = '';
                    var colorbox_params = {
                        rel: 'colorbox',
                        reposition:true,
                        scalePhotos:true,
                        scrolling:false,
                        previous:'<i class="ace-icon fa fa-arrow-left"></i>',
                        next:'<i class="ace-icon fa fa-arrow-right"></i>',
                        close:'&times;',
                        current:'{current} of {total}',
                        maxWidth:'100%',
                        maxHeight:'100%',
                        onOpen:function(){
                            $overflow = document.body.style.overflow;
                            document.body.style.overflow = 'hidden';
                        },
                        onClosed:function(){
                            document.body.style.overflow = $overflow;
                        },
                        onComplete:function(){
                            $.colorbox.resize();
                        }
                    };

                    $('[data-rel="colorbox"]').colorbox(colorbox_params);
                    $("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon
                }
            });
            $(window).triggerHandler('resize.jqGrid');//trigger window resize to make the grid get the correct size

            //navButtons
            jQuery(tabel2).jqGrid('navGrid',pager_tabel2,{   //navbar options

                edit: false,
                editicon : 'ace-icon fa fa-pencil blue',
                add: false,
                addicon : 'ace-icon fa fa-plus-circle purple',
                del: true,
                delicon : 'ace-icon fa fa-trash-o red',
                search: true,
                searchicon : 'ace-icon fa fa-search orange',
                refresh: true,
                refreshicon : 'ace-icon fa fa-refresh green',
                view: false,
                viewicon : 'ace-icon fa fa-search-plus grey',

            },{},{},{

                //delete record form
                recreateForm: true,
                beforeShowForm : function(e) {
                    var form = $(e[0]);
                    if(form.data('styled')) return false;

                    form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                    style_delete_form(form);

                    form.data('styled', true);
                },
                onclickSubmit: function () {
                    var myGrid = $(tabel2),
                    selRowId = myGrid.jqGrid ('getGridParam', 'selrow'),
                    celValue = myGrid.jqGrid ('getCell', selRowId, 'nama');

                    return { datatb:'uploadfile', _token:'<?php echo csrf_token();?>', cari:{{$karyawan['id']}}, filedoc:celValue };
                }
            },{
                //search form
                recreateForm: true,
                afterShowSearch: function(e){
                    var form = $(e[0]);
                    form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
                    style_search_form(form);
                },
                afterRedraw: function(){
                    style_search_filters($(this));
                }
                ,
                multipleSearch: true,
                /**
                multipleGroup:true,
                showQuery: true
                */
            },{
                //view record form
                recreateForm: true,
                beforeShowForm: function(e){
                    var form = $(e[0]);
                    form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
                }
            })/*.jqGrid('navButtonAdd',pager_tabel2,{
                caption:"",
                buttonicon:"ace-icon fa fa-pencil blue",
                position:"first",
                onClickButton:function(){
                    $('#form-dok').trigger("reset");

                    var gsr = jQuery(tabel2).jqGrid('getGridParam','selrow');

                    if(gsr){
                    //    var postData= {datatb:'dtmkeluarga', cari: gsr, _token:'<?php echo csrf_token();?>', oper:'pra-edit'};
                    //     $('.tgl').datepicker({format:'dd MM yyyy', autoclose:true});
                    //    $.ajax({
                    //        url: "{{url('LookupAdmin')}}",
                    //        data : postData,
                    //        type: "post",
                    //       success: function(response){
                    //          $('#oper-dok').val('edit');
                    //            $('#idkel').val(gsr);
                    //            $('#id_u').val(response.id_u);
                    //            $('#namakel').val(response.nama);
                    //            $("#hub").val(response.hub).trigger("change").trigger("chosen:updated");
                    //            $('#dobkel').datepicker("setDate", new Date(response.dob*1000));
                    //            if(response.jk == 'L') $("#jkkell").prop("checked", true);else $("#jkkelp").prop("checked", true);
                    //        }
                    //    });
                        $('#modal-dok').modal('show');

                    //    $('#hub').val('').trigger("change").trigger("chosen:updated")

                    } else {
                        alert("pilih tabel")
                    }
                }
            })*/.jqGrid('navButtonAdd',pager_tabel2,{
                caption:"",
                buttonicon:"ace-icon fa fa-user-plus purple",
                position:"first",
                onClickButton:function(){


                    var extraObj= $("#fileuploader").uploadFile({
                        url:"{{url('CrudAdmin')}}",
                            fileName:"myfile",
                            formData: {_token:'<?php echo csrf_token();?>',oper: 'add',datatb:'uploadfile',cari:{{$karyawan['id']}}},
                            returnType: "json",

                            showPreview:true,
                            previewHeight: "100px",
                            previewWidth: "100px",

                            extraHTML:function(){
                                    var html = "<div><b>Nama Dokumen:</b><input type='text' name='namad' value='' /> <br/>";
                                    html += "</div>";
                                    return html;
                            },
                            onSuccess:function(files,data,xhr,pd)
                            {
                                $(tabel2).trigger("reloadGrid");
                                //$('#modal-dok').modal('hide');

                            },
                            onError: function(files,status,errMsg,pd)
                            {
                                $("#eventsmessage").html($("#eventsmessage").html()+"<br/>Error for: "+JSON.stringify(files));
                            },

                            autoSubmit:false
                        });


                    $('#modal-dok').modal('show');
                    $("#extrabutton").click(function(){ extraObj.startUpload(); });

               }
            })

            function link(cellvalue, options, rowObject) {
                var doc = cellvalue.split("_");
                return "<a href='{{url('pic/dokumen')}}/{{$karyawan['id']}}/"+doc[1]+".jpg' title='"+doc[1]+"' data-rel='colorbox'><img width='150' height='150' alt='150x150' src='{{url('pic/dokumen/')}}/{{$karyawan['id']}}/"+doc[1]+".jpg' /></a>";
            }

            //replace icons with FontAwesome icons like above
            function updatePagerIcons(table) {
                var replacement =
                {
                    'ui-icon-seek-first' : 'ace-icon fa fa-angle-double-left bigger-140',
                    'ui-icon-seek-prev' : 'ace-icon fa fa-angle-left bigger-140',
                    'ui-icon-seek-next' : 'ace-icon fa fa-angle-right bigger-140',
                    'ui-icon-seek-end' : 'ace-icon fa fa-angle-double-right bigger-140'
                };
                $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function(){
                    var icon = $(this);
                    var $class = $.trim(icon.attr('class').replace('ui-icon', ''));

                    if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
                })
            }

            function enableTooltips(table) {
                $('.navtable .ui-pg-button').tooltip({container:'body'});
                $(table).find('.ui-pg-div').tooltip({container:'body'});
            }

            //switch element when editing inline
            function aceSwitch( cellvalue, options, cell ) {
                setTimeout(function(){
                    $(cell) .find('input[type=checkbox]')
                        .addClass('ace ace-switch ace-switch-5')
                        .after('<span class="lbl"></span>');
                }, 0);
            }
            //enable datepicker
            function pickDate( cellvalue, options, cell ) {
                setTimeout(function(){
                    $(cell) .find('input[type=text]')
                            .datepicker({format:'yyyy-mm-dd' , autoclose:true});
                }, 0);
            }

            function style_delete_form(form) {
                var buttons = form.next().find('.EditButton .fm-button');
                buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
                buttons.eq(0).addClass('btn-danger').prepend('<i class="ace-icon fa fa-trash-o"></i>');
                buttons.eq(1).addClass('btn-default').prepend('<i class="ace-icon fa fa-times"></i>')
            }

            if (!$('#karyawanaktif').prop("checked") ){$('.widget-main').addClass('hide');}


            $('#karyawanaktif').on('click', function(){
                $validation = this.checked;
                if(this.checked) {
                   //$('#sample-form').hide();
                    $('.widget-main').removeClass('hide');

                    var paktif=1;
                }
                else {
                    $('.widget-main').addClass('hide');
                   //$('#widget-body').hide();

                    var paktif=0;
                    //$('#sample-form').show();
                }
                $.post( "{{ url('/CrudxAdmin/') }}",
                    {
                      datatb: "karyawanaktif",
                      _token:'<?php echo csrf_token();?>',
                      id:{{$karyawan['id']}},
                      karyawanaktif:paktif
                    },
                function(data,status) {

                    //alert(paktif);

                }).fail(function() {

                    alert( "error" );

                })
            })


            $('#btn-kel').click(function() {
                var request = $("#form-kel").serialize();

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: "{{ url('/CrudAdmin/') }}",
                    data: request,
                    beforeSend:function(){
                        var newHTML = '<i class="ace-icon fa fa-spinner fa-spin "></i>Loading...';
                        document.getElementById('btn-kel').innerHTML = newHTML;
                    },
                    success: function(msg) {
                        var newHTML = '<i class="ace-icon fa fa-user-plus"></i>Save';
                        document.getElementById('btn-kel').innerHTML = newHTML;
                        //alert(msg.id);
                        if(msg.status == 'success'){
                            $(tabel).trigger("reloadGrid");
                            $('#modal-kel').modal('hide');
                            document.getElementById("form-kel").reset()
                        } else {
                            alert (msg.msg);
                        }
                    },
                    error: function(xhr, Status, err) {
                        //alert("Terjadi error : "+Status);
                        alert (JSON.stringify(xhr));
                        alert ("terjadi kesalahan harap hubungi administrator");
                    }
                });
            });


            $(document).one('ajaxloadstart.page', function(e) {
                $('[class*=select2]').remove();
                $('#colorbox, #cboxOverlay').remove();
            });

        })
    </script>
@endsection
