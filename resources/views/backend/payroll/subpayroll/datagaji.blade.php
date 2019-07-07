    <div class=" profile-user-info-striped col-xs-4">
        <div class="profile-info-row">
            <div class="profile-info-name"> Payroll ID </div>
            <div class="profile-info-value">
                <span> &nbsp;  </span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> Nama </div>
            <div class="profile-info-value">
                <span>{{ $data['nama'] }}</span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> Title </div>
            <div class="profile-info-value">                                    
                <span> &nbsp;  </span>
            </div>
        </div>
    </div>
    <div class=" profile-user-info-striped col-xs-4">
        <div class="profile-info-row">
            <div class="profile-info-name"> Jabatan </div>
            <div class="profile-info-value">
                <span>{{ $data['lb1'] }}</span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> Divisi </div>
            <div class="profile-info-value">                                    
                <span>{{ $data['lb2'] }} </span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> Waktu Keja </div>
            <div class="profile-info-value">
                <span>
                    @if ($data['wkerja'] == 0)
                        Non Shift
                    @elseif ($data['wkerja'] == 1)
                        Shift
                    @endif
                </span>
            </div>
        </div>                                              
    </div>
    <div class=" profile-user-info-striped col-xs-4">
        <div class="profile-info-row">
            <div class="profile-info-name"> Set Tanggal </div>
            <div class="profile-info-value">
                <span class="editable" id="setdate">{{ date('d F Y') }}</span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> &nbsp; </div>
            <div class="profile-info-value">                                    
                <span>&nbsp;</span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> &nbsp; </div>
            <div class="profile-info-value">
                <span>&nbsp;</span>
            </div>
        </div>                                              
    </div>
    <div>&nbsp;</div>

    <form id="form-gaji" method="get">
    <input type="hidden" id='_token' name="_token" value='<?php echo csrf_token();?>' />    
    <input type="hidden" id='datatb' name="datatb" value="datagaji" />
    <input type="hidden" id='id' name="id" value="{{ $data['id_u'] }}" />
    <input name="setdate" value="" type="hidden"/>
<!--    <div class="form-group col-xs-4">
        <div class="col-xs-12">
            <label class="control-label col-sm-4 no-padding-right">T. Komunikasi :</label>
            <div class="col-sm-8">
                <label>
                    <input data='tkomunikasi' class="ace enableselect" type="checkbox">
                    <span class="lbl"> </span>
                    <input id="ck_tkomunikasi" name="dgaji['tkomunikasi']" type="hidden" value=""> 
                </label>
                <select id="tkomunikasi" class="chosen-select form-control col-sm-3" style="float: right;max-width:112px;" data-placeholder="Pilih ...">
                    <option value="gm">GM</option>
                    <option value="mgr">Mgr</option>
                    <option value="spv">Spv</option>
                    <option value="other">Kebijakan</option>
                </select> 
            </div>
        </div>
        <div class="col-xs-12">
            <label class="control-label col-sm-4 no-padding-right">T. Kontribusi :</label>
            <div class="col-sm-8">
                <label>
                    <input data="tkontribusi" class="ace enableselect" type="checkbox">
                    <span class="lbl"> </span>
                    <input id="ck_tkontribusi" name="dgaji['tkontribusi']" type="hidden" value=""> 
                </label>
                <select id="tkontribusi"  class="chosen-select form-control col-sm-3" style="float: right;max-width:112px;" data-placeholder="Pilih ...">
                    <option value="daily">Daily</option>
                    <option value="monthly">Monthly</option>
                </select> 
            </div>
        </div>
        <div class="col-xs-12">
            <label class="control-label col-sm-4 no-padding-right">T. Relokasi :</label>
            <div class="col-sm-8">
                <label>
                    <input data="trelokasi" class="ace enableselect" type="checkbox">
                    <span class="lbl"> </span>
                    <input id="ck_trelokasi" name="dgaji['trelokasi']" type="hidden" value=""> 
                </label>
                <select id="trelokasi" class="chosen-select form-control col-sm-3" style="float: right;max-width:112px;" data-placeholder="Pilih ...">
                    <option value="relokasi">Tj. Relokasi</option>
                    <option value="mess">Mess</option>
                    <option value="other">Kebijakan</option>
                </select> 
            </div>
        </div>
        <div class="col-xs-12">
            <label class="control-label col-sm-4 no-padding-right">Transport :</label>
            <div class="col-sm-8">
                <label>
                    <input data="transport" class="ace enableselect" type="checkbox">
                    <span class="lbl"> </span>
                    <input id="ck_transport" name="dgaji['transport']" type="hidden" value="">  
                </label>
                <select id="transport" class="chosen-select form-control col-sm-3" style="float: right;max-width:112px;" data-placeholder="Pilih ...">
                    <option value="daily">Daily</option>
                    <option value="monthly">Monthly</option>
                </select> 
            </div>
        </div>
    </div>

        <div class="form-group col-xs-3">
            <div class="col-xs-12">
                <label class="control-label col-sm-4 no-padding-right">Makan :</label>
                <div class="col-sm-8">
                    <label>
                        <input data="makan" class="ace enableselect" type="checkbox">
                        <span class="lbl"> </span>
                        <input id="ck_makan" name="dgaji['makan']" type="hidden" value="">                        
                    </label>
                    <select id="makan" class="chosen-select form-control col-sm-3" style="float: right;max-width:112px;" data-placeholder="Pilih ...">
                        <option value="daily">Daily</option>
                        <option value="monthly">Monthly</option>
                    </select> 
                </div>
            </div>
            <div class="col-xs-12">
                <label class="control-label col-sm-4 no-padding-right">KHK :</label>
                <div class="col-sm-8">
                    <label>
                        <input data="khk" class="ace enableselect" type="checkbox">
                        <span class="lbl"> </span>
                        <input id="ck_khk" name="dgaji['khk']" type="hidden" value="">
                    </label>
                    <select id="khk" class="chosen-select form-control col-sm-3" style="float: right;max-width:112px;" data-placeholder="Pilih ...">
                        <option value="type1">Type 1</option>
                        <option value="type2">Type 2</option>
                        <option value="type3">Type 3</option>
                    </select> 
                </div>
            </div>

            <div class="col-xs-12">
                <label class="control-label col-sm-4 no-padding-right">Shift :</label>
                <div class="col-sm-8">
                    <label>
                        <input data="shift" class="ace enableselect" type="checkbox">
                        <span class="lbl"> </span>
                        <input id="ck_shift" name="dgaji['shift']" type="hidden" value="">
                    </label>
                    <select id="shift" class="chosen-select form-control col-sm-3" style="float: right;max-width:112px;" data-placeholder="Pilih ...">
                        <option value="type1">Type 1</option>
                        <option value="type2">Type 2</option>
                        <option value="type3">Type 3</option>
                    </select> 
                </div>
            </div>
            <div class="col-xs-12">
                <label class="control-label col-sm-4 no-padding-right">Lembur :</label>
                <div class="col-sm-8">
                    <label>
                        <input data="lembur" class="ace enableselect" type="checkbox">
                        <span class="lbl"> </span>
                        <input id="ck_lembur" name="dgaji['lembur']" type="hidden" value="">
                    </label>
                    <select id="lembur" class="chosen-select form-control col-sm-3" style="float: right;max-width:112px;" data-placeholder="Pilih ...">
                        <option value="depnaker">Depnaker</option>
                        <option value="hr1">HR1</option>
                        <option value="hr2">HR2</option>
                        <option value="type4">Type 4</option>
                    </select> 
                </div>
            </div>
            <div class="col-xs-12">
                <label class="control-label col-sm-4 no-padding-right">BPJS TK :</label>
                <div class="col-sm-8">
                    <label>
                        <input data="bpjstk" class="ace enableselect" type="checkbox">
                        <span class="lbl"> </span>
                        <input id="ck_bpjstk" name="dgaji['bpjstk']" type="hidden" value="">
                    </label>
                    <select id="bpjstk" class="chosen-select form-control col-sm-3" style="float: right;max-width:112px;" data-placeholder="Pilih ...">
                        <option value="ppuclg1">PPU - Clg 1</option>
                        <option value="ppuclg2">PPU - Clg 2</option>
                        <option value="PPUnarogong">PPU - Narogong</option>
                        <option value="BPU">BPU</option>
                    </select> 
                </div>
            </div>
        </div>

        <div class="form-group col-xs-2">            
            <div class="col-xs-12">
                <label class="control-label col-sm-8 no-padding-right">BPJS Kes :</label>
                <div class="col-sm-4">
                    <label>
                        <input data="bpjskes" class="ace" type="checkbox">
                        <span class="lbl"> </span>
                        <input id="ck_bpjskes" name="dgaji['bpjskes']" type="hidden" value="">
                    </label>                
                </div>
            </div>
            <div class="col-xs-12">
                <label class="control-label col-sm-8 no-padding-right">I. Lembur :</label>
                <div class="col-sm-4">
                    <label>
                        <input data="ilembur" class="ace" type="checkbox">
                        <span class="lbl"> </span>
                        <input id="ck_ilembur" name="dgaji['ilembur']" type="hidden" value="">
                    </label>                
                </div>
            </div>
            <div class="col-xs-12">
                <label class="control-label col-sm-8 no-padding-right">I. Tonase :</label>
                <div class="col-sm-4">
                    <label>
                        <input data="itonase" class="ace" type="checkbox">
                        <span class="lbl"> </span>
                        <input id="ck_itonase" name="dgaji['itonase']" type="hidden" value="">
                    </label>                
                </div>
            </div>
            <div class="col-xs-12">
                <label class="control-label col-sm-8 no-padding-right">I. Lapangan :</label>
                <div class="col-sm-4">
                    <label>
                        <input data="ilapangan" class="ace" type="checkbox">
                        <span class="lbl"> </span>
                        <input id="ck_ilapangan" name="dgaji['ilapangan']" type="hidden" value="">
                    </label>                
                </div>
            </div>
            <div class="col-xs-12">
                <label class="control-label col-sm-8 no-padding-right">Sp BCS :</label>
                <div class="col-sm-4">
                    <label>
                        <input data='spbcs' class="ace" type="checkbox">
                        <span class="lbl"> </span>
                        <input id="ck_spbcs" name="dgaji['spbcs']" class="ace" type='hidden' value="">
                    </label>                
                </div>
            </div>         
        </div>

        <div class="form-group col-xs-3">
            <div class="col-xs-12">
                <label class="control-label col-sm-10 no-padding-right">As. Kesehatan Swasta :</label>
                <div class="col-sm-2">
                    <label>
                        <input data="manulife" class="ace" type="checkbox">
                        <span class="lbl"> </span>
                        <input id="ck_manulife" name="dgaji['manulife']" type="hidden" value="">
                    </label>                
                </div>
            </div>
            
            <div class="col-xs-12">
                <label class="control-label col-sm-10 no-padding-right">Fix Intentive :</label>
                <div class="col-sm-2">
                    <label>
                        <input data="fixintentive" class="ace" type="checkbox">
                        <span class="lbl"> </span>
                        <input id="ck_fixintentive" name="dgaji['fixintentive']" type="hidden" value="">
                    </label>                
                </div>
            </div>
            <div class="col-xs-12">
                <label class="control-label col-sm-10 no-padding-right">iuran Pensiun :</label>
                <div class="col-sm-2">
                    <label>
                        <input data="iuranpensiun" class="ace" type="checkbox">
                        <span class="lbl"> </span>
                        <input id="ck_iuranpensiun" name="dgaji['iuranpensiun']" type="hidden" value="">
                    </label>                
                </div>
            </div>
            <div class="col-xs-12">
                <label class="control-label col-sm-10 no-padding-right">Car Allowance :</label>
                <div class="col-sm-2">
                    <label>
                        <input data="carallowance" class="ace" type="checkbox">
                        <span class="lbl"> </span>
                        <input id="ck_carallowance" name="dgaji['carallowance']" type="hidden" value="">
                    </label>                
                </div>
            </div>
            <div class="col-xs-12">
                <label class="control-label col-sm-10 no-padding-right">Driver Allowance :</label>
                <div class="col-sm-2">
                    <label>
                        <input data='driverallowance' class="ace" type="checkbox">
                        <span class="lbl"> </span>
                        <input id="ck_driverallowance" name="dgaji['driverallowance']" type="hidden" value="">
                    </label>                
                </div>
            </div>            
        </div>-->
<!--            -->
        <div class="col-xs-12 col-sm-6" id="div_upah">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Komponen Upah Rp. <span id='tupah'>0</span></h4>

                    <span class="widget-toolbar">
                        <a href="#" data-action="reload">
                            <i class="ace-icon fa fa-refresh"></i>
                        </a>

                        <a href="#" data-action="collapse">
                            <i class="ace-icon fa fa-chevron-up"></i>
                        </a>

                        <a href="#" data-action="close">
                            <i class="ace-icon fa fa-times"></i>
                        </a>
                    </span>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                                        
                        <label class="control-label col-sm-8 no-padding-right">Upah Pokok</label>
                        <div class="col-sm-4">
                            <input id="pokok" class="input-sm form-control upah" type="text" name="dupah['pokok']" placeholder="Upah Pokok" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div>
                    
                        <label class="control-label col-sm-8 no-padding-right">Honor</label>
                        <div class="col-sm-4">
                            <input id="honor" class="input-sm form-control upah" type="text" name="dupah['honor']" placeholder="Honor" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div>

                        <label for="form-field-select-3" class="control-label col-sm-8 no-padding-right">Perumaahan</label>
                        <div class="col-sm-4">
                            <input id="perum" class="input-sm form-control upah" type="text" name="dupah['perum']" placeholder="Perumahan" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div>

                        <label for="form-field-select-3" class="control-label col-sm-8 no-padding-right">Jabatan</label>
                        <div class="col-sm-4">
                            <input id="jabatan" class="input-sm form-control upah" type="text" name="dupah['jabatan']" placeholder="Jabatan" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div>

                        <label for="form-field-select-3" class="control-label col-sm-8 no-padding-right">Pemanduan</label>
                        <div class="col-sm-4">
                            <input id="pandu" class="input-sm form-control upah" type="text" name="dupah['pandu']" placeholder="Pemanduan" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div>
                        <label for="form-field-select-3" class="control-label col-sm-8 no-padding-right">Beban Profesi</label>
                        <div class="col-sm-4">
                            <input id="profesi" class="input-sm form-control upah" type="text" name="dupah['profesi']" placeholder="Beban Profesi" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div>
                        <label for="form-field-select-3" class="control-label col-sm-8 no-padding-right">Beban Kerja</label>
                        <div class="col-sm-4">
                            <input id="bkerja" class="input-sm form-control upah" type="text" name="dupah['bkerja']" placeholder="Beban Kerja" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div>
                        <label for="form-field-select-3" class="control-label col-sm-8 no-padding-right">Uang Makan /hari</label>
                        <div class="col-sm-4">
                            <input id="umakan" class="input-sm form-control upah" type="text" name="dupah['umakan']" placeholder="Uang Makan" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div>
                        <label for="form-field-select-3" class="control-label col-sm-8 no-padding-right">Uang Transport /hari</label>
                        <div class="col-sm-4">
                            <input id="utransport" class="input-sm form-control upah" type="text" name="dupah['utransport']" placeholder="Uang Transport" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div>
                        <label for="form-field-select-3" class="control-label col-sm-8 no-padding-right">Lembur</label>
                        <div class="col-sm-4">
                            <input id="lembur" class="input-sm form-control upah" type="text" name="dupah['lembur']" placeholder="Lembur" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div>
                        <label for="form-field-select-3" class="control-label col-sm-8 no-padding-right">B Cuti</label>
                        <div class="col-sm-4">
                            <input id="bcuti" class="input-sm form-control upah" type="text" name="dupah['bcuti']" placeholder="B.Cuti" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div>
                        <label for="form-field-select-3" class="control-label col-sm-8 no-padding-right">Kurang Bulan Lalu</label>
                        <div class="col-sm-4">
                            <input id="kbl" class="input-sm form-control upah" type="text" name="dupah['kbl']" placeholder="KBL" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div>
                        <label for="form-field-select-3" class="control-label col-sm-8 no-padding-right">Tunjangan Kendaraan</label>
                        <div class="col-sm-4">
                            <input id="tkendaraan" class="input-sm form-control upah" type="text" name="dupah['tkendaraan']" placeholder="Tunjangan Kendaraan" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div>
                        <label for="form-field-select-3" class="control-label col-sm-8 no-padding-right">BBM</label>
                        <div class="col-sm-4">
                             <input id="bbm" class="input-sm form-control upah" type="text" name="dupah['bbm']" placeholder="BBM" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div>
                        <label for="form-field-select-3" class="control-label col-sm-8 no-padding-right">Perawatan Kendaraan</label>
                        <div class="col-sm-4">
                             <input id="pkendaraan" class="input-sm form-control upah" type="text" name="dupah['pkendaraan']" placeholder="P. Kendaraan" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div>
                        <label for="form-field-select-3" class="control-label col-sm-8 no-padding-right">Shift</label>
                        <div class="col-sm-4">
                             <input id="shift" class="input-sm form-control upah" type="text" name="dupah['shift']" placeholder="Shift" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div>                       

                        <div>&nbsp;</div>

                    </div>            
                </div>            
            </div><!-- /.span -->            
        </div><!-- /.row -->

        <div class="col-xs-12 col-sm-6" id='div_potongan'>
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Komponen Potongan Rp. <span id='tpotongan'>0</span></h4>

                    <span class="widget-toolbar">
                        <a href="#" data-action="reload">
                            <i class="ace-icon fa fa-refresh"></i>
                        </a>

                        <a href="#" data-action="collapse">
                            <i class="ace-icon fa fa-chevron-up"></i>
                        </a>

                        <a href="#" data-action="close">
                            <i class="ace-icon fa fa-times"></i>
                        </a>
                    </span>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                                        
                        <label for="form-field-select-3" class="control-label col-sm-8 no-padding-right">Bank BJB</label>
                        <div class="col-sm-4">
                            <input id="bjb" class="input-sm form-control potongan" type="text" name="dpotongan['bjb']" placeholder="Pinjamab BJB" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div>
                    
                        <label for="form-field-select-3" class="control-label col-sm-8 no-padding-right">Kendaraan</label>
                        <div class="col-sm-4">
                            <input id="kendaraan" class="input-sm form-control potongan" type="text" name="dpotongan['kendaraan']" placeholder="Kendaraan" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div>

                        <label for="form-field-select-3" class="control-label col-sm-8 no-padding-right">Absensi</label>
                        <div class="col-sm-4">
                            <input id="absen" class="input-sm form-control potongan" type="text" name="dpotongan['absen']" placeholder="Indisipliner Absensi" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div>

                        <label for="form-field-select-3" class="control-label col-sm-8 no-padding-right">PPH-21</label>
                        <div class="col-sm-4">
                            <input id="pph21" class="input-sm form-control potongan" type="text" name="dpotongan['pph21']" placeholder="PPH-21" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div>

                        <label for="form-field-select-3" class="control-label col-sm-8 no-padding-right">Kelebihan Bulan Lalu</label>
                        <div class="col-sm-4">
                            <input id="lbl" class="input-sm form-control potongan" type="text" name="dpotongan['lbl']" placeholder="LBL" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div> 

                        <label for="form-field-select-3" class="control-label col-sm-8 no-padding-right">BPJS Kesehatan</label>
                        <div class="col-sm-4">
                            <input data="ck-bpjskes" class="ace" type="checkbox">
                            <span class="lbl"> </span>
                            <input id="ck_ck-bpjskes" name="dpotongan['ck-bpjskes']" type="hidden" value="">
                        </div>         

                        <div>&nbsp;</div>
                    </div>
                </div>            
            </div><!-- /.span -->            
        </div><!-- /.row -->

        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div class="modal-footer center">
            <button id="save" type="button" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Save</button>
            <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancel</button>
        </div>
    </form>


<script type="text/javascript">
    jQuery(function($) {

        var setdate = $('#setdate').html();
        $('input[name="setdate"]').val(setdate);

        //editables on first profile page
        $.fn.editable.defaults.mode = 'inline';
        $.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
        $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
                                    '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>'; 


        
////////////////////////////////////////////////////////////////////////////////////////////////////////
        $('input[type="checkbox"]').on('change', function() { 
            if(this.checked == true){
                $('#ck_'+$(this).attr('data')).val('on')                
            } else {
                $('#ck_'+$(this).attr('data')).val('')
            }
        });
/*        //enable chosen jika checkbox di-klik 
        $('input[type="checkbox"].enableselect').on('change', function() { 
            var elment = $(this).attr('data');
            //enableselecvalue($(this).attr('data')) 
            if(this.checked == true){
                var devaultselect = $('#'+elment+' option:first').val();                
                $('#'+elment).val(devaultselect).prop('disabled', false).trigger("chosen:updated");
                $('#ck_'+elment).val(devaultselect);
            } else {
                $('#'+elment).val('').prop('disabled', true).trigger("chosen:updated");
                $('#ck_'+elment).val('');
            }
        });
///////////////////////////////////////////////////////////////////////////////////////////////////////
        
        $('#div_potongan').height($('#div_upah').height());
*/       
        $('#setdate').editable({
            type: 'adate',
            date: {
                //datepicker plugin options
                    format: 'dd MM yyyy',
                viewformat: 'dd MM yyyy',
                 weekStart: 1
                 
                //,nativeUI: true//if true and browser support input[type=date], native browser control will be used
                //,format: 'yyyy-mm-dd',
                //viewformat: 'yyyy-mm-dd'
            }
        }).on('save', function(e, params) {
            $('input[name="setdate"]').val(params.newValue);
            setdate = params.newValue;
            reload();
        });
        
        reload();
/*
        //Posisi menentukan script ini jalan dengan baik - dibawah fungsi reload //////////
        $('.chosen-select').chosen({allow_single_deselect:true}).change(function(e) {   ///
            var selectvalue = $(this).val();                                            ///
            $('#ck_'+$(this).attr('id')).val(selectvalue);                              ///
                                                                                        ///
        });                                                                             ///
        ///////////////////////////////////////////////////////////////////////////////////
*/

        $('#save').click(function() {
            var postData = $("#form-gaji").serialize();
            //var postData = {datatb:'syn_parameter',_token:'<?php echo csrf_token();?>'};
            $.ajax({
                type: 'POST',
                url: "{{ url('/PayrollCrud/') }}",
                data: postData,
                beforeSend:function(){
                //    $("#ambil").prop('disabled', true);
                //    var newHTML = '<i class="ace-icon fa fa-spinner fa-spin "></i>Loading...';
                //    document.getElementById('ambil').innerHTML = newHTML;
                    
                },
                success: function(msg) {
                
                //    $("#ambil").prop('disabled', false);                   
                //    var newHTML = 'Perbaharui';
                //    document.getElementById('ambil').innerHTML = newHTML;
                //    if(msg.status == 'success'){
                //        alert (msg.msg);
                       
                //    } else {                            
                //        alert (msg.msg);
                       
                //    }
                    alert(JSON.stringify(msg)); 
                
                }
            })
        });

        function reload(){
             
            //$(".chosen-select").val('').trigger("change").prop('disabled', true).trigger("chosen:updated");        
            //$('.enableselect').prop("checked", false);  
            
            $('input[type="checkbox"]').prop("checked", false);
            $('.hide').prop('checked', true); // Checks it
            
            var wkerja = {{ $data['wkerja'] }};
            
            if (wkerja==0){
                $('#shift').prop('disabled', true);
            } else if (wkerja==1) {
                $('#shift').prop('disabled', false);
            }
            //alert(setdate);

            var inputarray = new Array();
            var postData = {datatb:'isidatagaji',id: {{ $data['id'] }},setdate:setdate,_token:'<?php echo csrf_token();?>'};
            $.ajax({
                type: 'POST',
                url: "{{ url('/PayrollJson/') }}",
                data: postData,
                beforeSend:function(){

                },
                success: function(tmp) {
                    $('.upah').val('');
                    $('.potongan').val('');
                    
                    for (var i = 0, len = tmp.length; i < len; i++) {

                        if(tmp[i]['potongan']){
                            $('#'+tmp[i]['potongan'].jenis).val(Number(tmp[i]['potongan'].nilai));

                            if (!tmp[i]['potongan'].jenis.indexOf("ck-")){       
                                if(tmp[i]['potongan'].nilai == 'on' ){
                                    $('input[type="checkbox"]').prop("checked", true);
                                    $('.hide').prop('checked', false); // Checks it
                                }
                                //$('input[type="checkbox"]').prop("checked", true);
                                //$('.hide').prop('checked', false); // Checks it

                            }
                            
                        }

                        if(tmp[i]['tunjangan']){
                            $('#'+tmp[i]['tunjangan'].jenis).val(Number(tmp[i]['tunjangan'].nilai));
                        }

                    }
                    
                      
                }
            })
        }
        function Number(input)
        {
            return input.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
        };
    })
</script>