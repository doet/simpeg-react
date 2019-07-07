<form id="formdapeg">
    {!! csrf_field() !!}
    <input type="hidden" name="datatb" value="formdapeg" />
    <input type="hidden" id='oper' name="oper" value="edit" />
    <input type="hidden" id='id' name="id" value="{{$e}}" />

    <div class="row">
      <div class="col-xs-4">
        <div class="row">
          <label class="control-label col-xs-5 no-padding-right">Set Tanggal :</label>
          <div class="col-xs-7">
              <span class="editable" id="setdate">{{ date('d F Y') }}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-4">
        <div class="row">
          <label class="control-label col-xs-5 no-padding-right">NIK :</label>
          <div class="col-xs-7">
              <input class="form-control input-sm" type="text" id="nip " name="nip" value="{{$karyawan['nip']}}"/>
          </div>
        </div>
        <div class="row">
          <label class="control-label col-xs-5 no-padding-right">Nama Lengkap :</label>
          <div class="col-xs-7">
              <input class="form-control input-sm" type="text" id="namal" name="namal" value="{{$karyawan['nama']}}"/>
          </div>
        </div>
        <div class="row">
          <label class="control-label col-xs-5 no-padding-right">Divisi :</label>
          <div class="col-xs-7">
            <select id="divisi" name="divisi"  class="chosen-select form-control input-sm" data-placeholder="Pilih ...">
              <option value=""> </option>
            </select>
          </div>
        </div>
        <div class="row">
          <label class="control-label col-xs-5 no-padding-right">Jabatan :</label>
          <div class="col-xs-7">
            <select id="jabatan" name="jabatan" class="chosen-select form-control input-sm" data-placeholder="Pilih ...">
              <option value=""> </option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-xs-4">
        <div class="row">
          <label class="control-label col-xs-5 no-padding-right">Waktu Kerja :</label>
          <div class="col-xs-7">
            <input id="wkerja" name="wkerja" type="checkbox" value="1" class="ace ace-switch ace-switch-4 input-sm" <?php if($karyawan['wkerja'] == 1) echo 'checked';?>/>
            <span class="lbl" data-lbl="&nbsp;O&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;III"></span>
            <small id="nonshift" class="green">
                <b>Non Shift / </b>
            </small>
            <small id="shift" class="green">
                <b>Shift</b>
            </small>
          </div>
        </div>
        <div class="row">
          <label class="control-label col-xs-5 no-padding-right">Status :</label>
          <div class="col-xs-7">
            <input id="sts" name="sts" type="checkbox" value="Tetap" class="ace ace-switch ace-switch-4 input-sm" <?php if($karyawan['status_pegawai'] == 'Tetap') echo 'checked';?>/>
            <span class="lbl" data-lbl="&nbsp;O&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;III"></span>
            <small id="kontrak" class="green ">
                <b>Kontrak / </b>
            </small>
            <small id="tetap" class="green ">
                <b>Tetap</b>
            </small> &nbsp;
          </div>
        </div>
        <div class="row">
          <label class="control-label col-xs-5 no-padding-right">T M B :</label>
          <div class="col-xs-7">
              <div class="input-group input-group-sm" >
                  <input type="text" name="tmb" class="tgl input-sm input-sm" id="tmb"/>
                  <span class="input-group-addon"><i class="ace-icon fa fa-calendar" class="input-sm"></i></span>
              </div>
          </div>
        </div>
        <div class="row">
          <label class="control-label col-xs-5 no-padding-right">T K B :</label>
          <div class="col-xs-7">
              <div class="input-group input-group-sm" >
                  <input type="text" name="tkb" class="tgl input-sm input-sm" id="tkb"/>
                  <span class="input-group-addon"><i class="ace-icon fa fa-calendar" class="input-sm"></i></span>
              </div>
          </div>
        </div>
      </div>
      <div class="col-xs-4">
        <div class="row">
          <label class="control-label col-xs-5 no-padding-right">ID Absen :</label>
          <div class="col-xs-7">
              <input type="text" name="idabsen" value="{{$karyawan['idabsen']}}" id="idabsen" class="input-sm" />
          </div>
        </div>
        <div class="row">
          <label class="control-label col-xs-5 no-padding-right">Email Address :</label>
          <div class="col-xs-7">
              <input type="email" name="email" value="{{$karyawan['email']}}" id="email" class="input-sm" />
          </div>
        </div>
        <div class="row">
          <label class="control-label col-xs-5 no-padding-right">Ganti Password :</label>
          <div class="col-xs-7">
              <input type="password" name="password" id="password" class="input-sm" />
          </div>
        </div>
        <div class="row">
          <label class="control-label col-xs-5 no-padding-right">&nbsp;</label>
          <div class="col-xs-7">
              &nbsp;
          </div>
        </div>
      </div>
    </div>

<div>&nbsp; </div>

    <div class="row">
      <div class="col-xs-6">
        <div class="row">
          <label class="control-label col-xs-3 no-padding-right">Bank :</label>
          <div class="col-xs-3">

                <select id="bank" name="bank" class="chosen-select input-sm" data-placeholder="Pilih ..." >
                  <option value=""></option>
                  <option value="BCA">BCA</option>
                  <option value="BNI">BNI</option>
                  <option value="BRI">BRI</option>
                  <option value="MANDIRI">MANDIRI</option>
                </select>
              </div>

              <!-- <div class="col-xs-9">-->
                <label class="control-label col-xs-2" for="state">&nbsp; No Rek :&nbsp;</label>
                <input type="text" id="norek" name="norek" value="" class="input-sm"/>
              <!-- </div> -->

        </div>
        <div class="row">
          <label class="control-label col-xs-3 no-padding-right">Pendidikan Akhir :</label>
          <div class="col-xs-3">
                  <select id="pendidikan" name="pendidikan" class="chosen-select col-sm-1 input-sm" data-placeholder="Pilih ..." >
                      <option value=""></option>
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
          </div>
          <label class="control-label no-padding-right col-xs-2" for="state">&nbsp;Jurusan :&nbsp;</label>
          <input type="text" id="jurusan" name="jurusan" value="" class="input-sm" />
        </div>
      </div>
    </div>
    <div>&nbsp; </div>
    <div class="row">
      <div class="col-xs-4">
        <div class="row">
          <label class="control-label col-xs-5 no-padding-right">Jenis Kelamin : </label>
          <div class="col-xs-7">
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
        </div>
        <div class="row">
          <label class="control-label col-sm-5 no-padding-right">Tanggal Lahir : </label>
          <div class="col-sm-7">
              <div class="input-group input-group-sm" >
                  <input type="text" name="dob" class="tgl input-sm" id="dob" style="float: right"/>
                  <span class="input-group-addon"><i class="ace-icon fa fa-calendar"></i></span>
              </div>
          </div>
        </div>
        <div class="row">
          <label class="control-label col-sm-5 no-padding-right">Gol. Darah : </label>
          <div class="col-sm-7">
            <select id="goldar" name="goldar" class="chosen-select input-sm" data-placeholder="Pilih ..." >
                <option value=""></option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="AB">AB</option>
                <option value="O">O</option>
            </select>
          </div>
        </div>
        <div class="row">
          <label class="control-label col-sm-5 no-padding-right">Agama : </label>
          <div class="col-sm-7">
            <select id="agama" name="agama" class="chosen-select input-sm" data-placeholder="Pilih ..." >
              <option value=""></option>
              <option value="Islam">Islam</option>
              <option value="Kristen">Kristen</option>
              <option value="Buddha">Buddha</option>
              <option value="Hindu">Hindu</option>
            </select>
        </div>
      </div>
    </div>

    <div class="form-group col-xs-8">
        <div class="col-xs-12">
            <label class="control-label col-sm-4 no-padding-right">No KK : </label>
            <div class="col-sm-8">
                <input type="text" name="nokk" value="{{$karyawan['nokk']}}" class="input-sm" />
            </div>
        </div>
        <div class="col-xs-12">
            <label class="control-label col-sm-4 no-padding-right">Alamat : </label>
            <div class="col-sm-8">
                <textarea class="input-xlarge " name="alamat" id="alamat">{{$karyawan['alamat']}}</textarea>
            </div>
        </div>
        <div class="col-xs-12">
            <label class="control-label col-sm-4 no-padding-right">Keluarga Dekat : </label>
            <div class="col-sm-8">
                <span>
                    <input type="text" id="keldekat" name="keldekat" value="{{$karyawan['keldekat']}}" class="input-sm" />
                </span>
                <span>
                    <label class="control-label no-padding-right" for="state">Tlp :&nbsp;</label>
                    <input type="text" id="keltlp" name="keltlp" value="{{$karyawan['keltlp']}}" class="input-sm" />
                </span>
            </div>
        </div>
    </div>
    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <div class="modal-footer center">
        <button id="save" type="button" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancel</button>
    </div>
</form>


<script type="text/javascript">
    jQuery(function($) {

      var post = {'src':site+'/api/kepegawaian/json','elm':'divisi','tb':'tb_variabel','datatb':'selecttion','where':{'grup':'divisi'},'value':{'key':'vid','label':'label'}};
      src_chosen(post,{{$karyawan['divisi']}});

      var post= {'src':site+'/api/kepegawaian/json','elm':'jabatan','tb':'tb_variabel','datatb':'selecttion','where':{'grup':'jabatan'},'value':{'key':'vid','label':'label'}};
      src_chosen(post,{{$karyawan['jabatan']}});

      // $('#divisi').chosen({allow_single_deselect:true}).change(function(e) {
      //     alert($(this).val());
      // });
      var mystr = "{{$karyawan['rekbank']}}";
      var myarr = mystr.split("-");
      $('#bank').val(myarr[0]).trigger("chosen:updated");
      $('#norek').val(myarr[1]);

      var mystr = "{{$karyawan['rekbank']}}";
      var myarr = mystr.split("-");
      $('#bank').val(myarr[0]).trigger("chosen:updated");
      $('#norek').val(myarr[1])

      var mystr = "{{$karyawan['pendidikan']}}";
      var myarr = mystr.split("-");
      $('#pendidikan').val(myarr[0]).trigger("chosen:updated");
      $('#jurusan').val(myarr[1]);

      $('#goldar').val('{{$karyawan["goldar"]}}').trigger("chosen:updated");
      $("#agama").val('{{$karyawan["agama"]}}').trigger("chosen:updated");

      $('.tgl').datepicker({format:'dd MM yyyy', viewformat: 'dd MM yyyy', autoclose:true});

      var tmb  =  "{{ $karyawan['tmb'] }}";
      if (tmb && tmb!=0)$('#tmb').datepicker("setDate", new Date(tmb*1000));

      var tkb  =  "{{ $karyawan['tkb'] }}";
      if (tkb && tkb!=0)$('#tkb').datepicker("setDate", new Date(tkb*1000));

      var dob = "{{$karyawan['dob']}}";
      if (dob && dob!=0)$('#dob').datepicker("setDate", new Date(dob*1000));
      if(!ace.vars['touch']) {
          $('.chosen-select').chosen({allow_single_deselect:true});
          //resize the chosen on window resize

          $(window)
          .off('resize.chosen')
          .on('resize.chosen', function() {
              $('.chosen-select').each(function() {
                   var $this = $(this);
                   $this.next().css({'width': '100%'});
              })
          }).trigger('resize.chosen');
          //resize chosen on sidebar collapse/expand
          $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
              if(event_name != 'sidebar_collapsed') return;
              $('.chosen-select').each(function() {
                   var $this = $(this);
                   $this.next().css({'width': '100%'});
              })
          });


        $('#chosen-multiple-style .btn').on('click', function(e){
          var target = $(this).find('input[type=radio]');
          var which = parseInt(target.val());
          if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
          else $('#form-field-select-4').removeClass('tag-input-style');
        });
      }

        $('#save').click(function() {
            var postData = $("#formdapeg").serialize();
            $.ajax({
                type: 'POST',
                url: "{{url('api/kepegawaian/cud')}}",
                data: postData,
                beforeSend:function(){
                  var newHTML = '<i class="ace-icon fa fa-spinner fa-spin "></i>Loading...';
                  $('#save').html(newHTML);
                },
                success: function(msg) {
                /*    $("#ambil").prop('disabled', false); */
                  var newHTML = '<i class="ace-icon fa fa-floppy-o"></i>Save';
                  $('#save').html(newHTML);
                  // if(msg.status == 'success'){
                  //     alert (msg.msg);
                  //
                  // } else {
                  //     alert (msg.msg);
                  //
                  // }
                  alert(JSON.stringify(msg));
                }
            })
        });


        function Number(input)
        {
            return input.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
        };
    })
</script>
