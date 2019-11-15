date : <span id='tgl'></span>

<form class="form-horizontal" role="form" id="pn">
    <input name="f" type="hidden" value="grt_i"/>
    <div class="form-group">
      <div class="col-xs-4">
          <input type="text" placeholder="<= BebanGRT" name="grt[]" class="col-xs-10 col-sm-5" />
      </div>
      <div class="col-xs-4">
          <input type="text" placeholder="Tarif.ttp" name="value[]" class="col-xs-10 col-sm-5" />
      </div>
      <div class="col-xs-4">
          <input type="text" placeholder="Tarif.var" name="var[]" class="col-xs-10 col-sm-5" />
      </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
      <div class="col-xs-4">
          <input type="text" placeholder="<= BebanGRT" name="grt[]" class="col-xs-10 col-sm-5" />
      </div>
      <div class="col-xs-4">
          <input type="text" placeholder="Tarif.ttp" name="value[]" class="col-xs-10 col-sm-5" />
      </div>
      <div class="col-xs-4">
          <input type="text" placeholder="Tarif.var" name="var[]" class="col-xs-10 col-sm-5" />
      </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
      <div class="col-xs-4">
          <input type="text" placeholder="<= BebanGRT" name="grt[]" class="col-xs-10 col-sm-5" />
      </div>
      <div class="col-xs-4">
          <input type="text" placeholder="Tarif.ttp" name="value[]" class="col-xs-10 col-sm-5" />
      </div>
      <div class="col-xs-4">
          <input type="text" placeholder="Tarif.var" name="var[]" class="col-xs-10 col-sm-5" />
      </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
      <div class="col-xs-4">
          <input type="text" placeholder="<= BebanGRT" name="grt[]" class="col-xs-10 col-sm-5" />
      </div>
      <div class="col-xs-4">
          <input type="text" placeholder="Tarif.ttp" name="value[]" class="col-xs-10 col-sm-5" />
      </div>
      <div class="col-xs-4">
          <input type="text" placeholder="Tarif.var" name="var[]" class="col-xs-10 col-sm-5" />
      </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
      <div class="col-xs-4">
          <input type="text" placeholder="<= BebanGRT" name="grt[]" class="col-xs-10 col-sm-5" />
      </div>
      <div class="col-xs-4">
          <input type="text" placeholder="Tarif.ttp" name="value[]" class="col-xs-10 col-sm-5" />
      </div>
      <div class="col-xs-4">
          <input type="text" placeholder="Tarif.var" name="var[]" class="col-xs-10 col-sm-5" />
      </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
      <div class="col-xs-4">
          <input type="text" placeholder="<= BebanGRT" name="grt[]" class="col-xs-10 col-sm-5" />
      </div>
      <div class="col-xs-4">
          <input type="text" placeholder="Tarif.ttp" name="value[]" class="col-xs-10 col-sm-5" />
      </div>
      <div class="col-xs-4">
          <input type="text" placeholder="Tarif.var" name="var[]" class="col-xs-10 col-sm-5" />
      </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
      <div class="col-xs-4">
          <input type="text" placeholder="<= BebanGRT" name="grt[]" class="col-xs-10 col-sm-5" />
      </div>
      <div class="col-xs-4">
          <input type="text" placeholder="Tarif.ttp" name="value[]" class="col-xs-10 col-sm-5" />
      </div>
      <div class="col-xs-4">
          <input type="text" placeholder="Tarif.var" name="var[]" class="col-xs-10 col-sm-5" />
      </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
      <div class="col-xs-4">
          <input type="text" placeholder="<= BebanGRT" name="grt[]" class="col-xs-10 col-sm-5" />
      </div>
      <div class="col-xs-4">
          <input type="text" placeholder="Tarif.ttp" name="value[]" class="col-xs-10 col-sm-5" />
      </div>
      <div class="col-xs-4">
          <input type="text" placeholder="Tarif.var" name="var[]" class="col-xs-10 col-sm-5" />
      </div>
    </div>
    <div class="space-4"></div>
    note: - untuk beban tak terhingga isikan nilai 0 pada input beban GRT
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
</form>



<script type="text/javascript">
  jQuery(function($) {
    tgl = $('[name=tgl]').val();
    $('#tgl').html(moment.unix(tgl).format("ll"));

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
              loaddata()
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
    //
    // // var date = new Date();
    // var cal = new CalHeatMap();
    // var calData = {} ;
    // function loaddata(){
    //   var posdata= {'datatb':'mkurs','search':1};
    //   getparameter("{{url('/api/oprasional/json')}}",posdata,function(data){
    //     data.map(function(element, index, array) {
    //       if (calData[element.date] === undefined)calData[element.date]=1; else calData[element.date] += 1;
    //     });
    //     console.log(calData);
    //     cal.update(calData);
    //   })
    // }

  })
</script>
