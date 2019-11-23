Tanggal berlaku harga <span id='tgl_b'></span>, saat ini anda memilih tanggal <span id='tgl'></span>

<div class="space-4"></div>
<form class="form-horizontal" role="form" id="pn">
  <div class="form-group">
    <div class="col-xs-6">
        <span><strong>Cigading</strong></span>
    </div>
    <div class="col-xs-6">
        <span><strong>Non Cigading</strong></span>
    </div>
  </div>
    <div class="form-group">
      <div class="col-xs-6">
          <input type="text" placeholder="Cigading Rp" name="bht[cd]" class="form-control input-sm" />
      </div>
      <div class="col-xs-6">
          <input type="text" placeholder="non Cigading Rp" name="bht[nci]" class="form-control input-sm" />
      </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
      <div class="col-xs-6">
          <input type="text" placeholder="Cigading $" name="bht[ci]" class=" form-control input-sm" />
      </div>
      <div class="col-xs-6">
        <input type="text" placeholder="non Cigading $" name="bht[ncd]" class="form-control input-sm" />
      </div>
    </div>
    <div class="space-4"></div>

    <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
            <button class="btn btn-info" type="submit" id="save">
                <i class="ace-icon fa fa-check bigger-110"></i>
                Submit
            </button>

            &nbsp; &nbsp; &nbsp;
            <button class="btn" type="reset">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                Reset
            </button>
        </div>
    </div>
    <input name="f" type="hidden" value="bht"/>
    <input name="group" type="hidden" value="bht_"/>
</form>



<script type="text/javascript">
  jQuery(function($) {
    tgl = $('[name=tgl]').val();
    $('#tgl').html(moment.unix(tgl).format("DD MMM Y"));

    loadcal($('[name=group]').val());
    loadinput($('[name=group]').val(),tgl);

    $("#pn").submit(function(e) {
      e.preventDefault();
      var oper = 'add';
      var postData = 'datatb=mnilai&oper='+ oper +'&date='+ tgl +'&'+$("#pn").serialize();
      $.ajax({
        type: 'POST',
        url: "{{ url('/api/oprasional/cud/') }}",
        data: postData,
        beforeSend:function(){
          var newHTML = '<i class="ace-icon fa fa-spinner fa-spin "></i>Loading...';
          document.getElementById('save').innerHTML = newHTML;
        },
        success: function(msg) {
          var newHTML = '<i class="ace-icon fa fa-check bigger-110"></i>Submit';
          document.getElementById('save').innerHTML = newHTML;

          alert(msg.id);

          if(msg.status == "success"){
              loadcal()
              // document.getElementById("form-1").reset();
          } else {
              alert (msg.msg);
          }
        },
        error: function(xhr, Status, err) {
          //alert("Terjadi error : "+Status);
          alert (JSON.stringify(xhr));
          alert ("terjadi kesalahan harap hubungi administrator");
        }
      })
    })
  })

</script>
