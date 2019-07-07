    <div class=" profile-user-info-striped col-xs-12">
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

    <form id="form-shift" method="get">
    <input type="hidden" id='_token' name="_token" value='{{ csrf_token() }}' />    
    <input type="hidden" id='datatb' name="datatb" value="m_shift" />
    <input name="setdate" value="" type="hidden"/>
        <div class="col-xs-12 col-sm-6" id="div_upah">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Shift Dispatcher</h4>

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
                                        
                        <label class="control-label col-sm-8 no-padding-right">Shift 1 /hari</label>
                        <div class="col-sm-4">
                            <input id="dispatcher_s1" class="input-sm form-control tunjangan" type="text" name="dispatcher['dispatcher_s1']" placeholder="Tunjangan Shift 1" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div>
                        <label class="control-label col-sm-8 no-padding-right">Shift 3 /hari</label>
                        <div class="col-sm-4">
                            <input id="dispatcher_s3" class="input-sm form-control tunjangan" type="text" name="dispatcher['dispatcher_s3']" placeholder="tunjangan Shift 3" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div>
                        <div>&nbsp;</div>

                    </div>            
                </div>            
            </div><!-- /.span -->            
        </div><!-- /.row -->

        <div class="col-xs-12 col-sm-6" id='div_potongan'>
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Shift Driver</h4>

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
                                        
                        <label for="form-field-select-3" class="control-label col-sm-8 no-padding-right">Shift 1 /hari</label>
                        <div class="col-sm-4">
                            <input id="driver_s1" class="input-sm form-control tunjangan" type="text" name="driver['driver_s1']" placeholder="Tunjangan Shift 1" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
                        </div>
                    
                        <label for="form-field-select-3" class="control-label col-sm-8 no-padding-right">Shift 3 /hari</label>
                        <div class="col-sm-4">
                            <input id="driver_s3" class="input-sm form-control tunjangan" type="text" name="driver['driver_s3']" placeholder="Tunjangan Shift 3" style="text-align: right;" onkeyup="formatNumber(this);" tabindex="4" />
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


/*        
////////////////////////////////////////////////////////////////////////////////////////////////////////
        $('input[type="checkbox"]').on('change', function() { 
            if(this.checked == true){
                $('#ck_'+$(this).attr('data')).val('on')                
            } else {
                $('#ck_'+$(this).attr('data')).val('')
            }
        });
        //enable chosen jika checkbox di-klik 
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
            var postData = $("#form-shift").serialize();
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
                //    alert(JSON.stringify(msg)); 
                
                }
            })
        });

        function reload(){
             
            //$(".chosen-select").val('').trigger("change").prop('disabled', true).trigger("chosen:updated");        
            //$('.enableselect').prop("checked", false);  
            
            //$('input[type="checkbox"]').prop("checked", false);
            //$('.hide').prop('checked', true); // Checks it

            //alert(setdate);

            var inputarray = new Array();
            var postData = {datatb:'m_shift',setdate:setdate,_token:'<?php echo csrf_token();?>'};
            $.ajax({
                type: 'POST',
                url: "{{ url('/PayrollJson/') }}",
                data: postData,
                beforeSend:function(){

                },
                success: function(tmp) {
                    $('.tunjangan').val('');
                    
                    for (var i = 0, len = tmp.length; i < len; i++) {

                        if(tmp[i]){
                            $('#'+tmp[i].jenis).val(Number(tmp[i].nilai));
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