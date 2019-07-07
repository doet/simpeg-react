@extends('backend.app_backend')

@section('css')
  <!-- page specific plugin styles -->
  <link href="{{ asset('/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/bootstrap-editable.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/jquery-ui.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/dropzone.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/jquery.scrollbar.css') }}" rel="stylesheet">

  <style type="text/css">
      .scrollbar-macosx {
          max-height: 256px;
          height: 256px;
          overflow: auto;
      }
  </style>
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
      <div id="loading" class="modal fade" tabindex="-1"><img src="{{ url('/public/images/loading2.gif') }}" style="position: fixed; top: 20%; left: 30%;" /></div>

      <div id="dialog-message" class="hide">
        <p class="bigger-110 bolder center grey">
          <i class="ace-icon fa fa-hand-o-right blue bigger-120"></i>
          Simpan data file kedalam DataBase
        </p>
      </div><!-- #dialog-message -->
      <div id="dialog-confirm" class="hide">
        <p class="bigger-110 bolder center grey">
          <i class="ace-icon fa fa-hand-o-right blue bigger-120"></i>
          Apakah kamu Yakin ?
        </p>
      </div><!-- #dialog-confirm -->

      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-12">Selected File :: <span id=nfile> -- Kosong --</span></div>
            <div class=col-md-2><button id="savetodb" class="btn btn-purple btn-sm" disabled>Save To DB</button></div>
            <div class=col-md-2><button id="hapus" class="btn btn-info btn-sm" disabled>Hapus</button></div>
            <div class=col-md-8>Berlaku Mulai : <?php echo '<span class="editable" id="psdate">'.date('F').' 2016</span>';  ?></div>
            <input name="setdate" value="" type="hidden"/>
            <div class="col-md-12">
              <div class="widget-box widget-color-green2">
                <div class="widget-header"><h4 class="widget-title lighter smaller">List File </h4></div>
                <div class="widget-body">
                  <div class="widget-main padding-8"><ul id="tree2"></ul></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
            <form action="{{url('api/payroll/cud')}}" class="dropzone well" id="dropzone" enctype="multipart/form-data">
              {!! csrf_field() !!}
              <input type="hidden" id='datatb' name="datatb" value="uploadfiles" />
              <div class="fallback"><input name="file" type="file" multiple="" /></div>
            </form>
            <div id="preview-template" class="hide">
              <div class="dz-preview dz-file-preview">
                <div class="dz-image"><img data-dz-thumbnail="" /></div>

                <div class="dz-details">
                  <div class="dz-size"><span data-dz-size=""></span></div>
                  <div class="dz-filename"><span data-dz-name=""></span></div>
                </div>

                <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>

                <div class="dz-error-message"><span data-dz-errormessage=""></span></div>

                <div class="dz-success-mark">
                  <span class="fa-stack fa-lg bigger-150">
                    <i class="fa fa-circle fa-stack-2x white"></i>
                    <i class="fa fa-check fa-stack-1x fa-inverse green"></i>
                  </span>
                </div>

                <div class="dz-error-mark">
                  <span class="fa-stack fa-lg bigger-150">
                    <i class="fa fa-circle fa-stack-2x white"></i>
                    <i class="fa fa-remove fa-stack-1x fa-inverse red"></i>
                  </span>
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
  <script src="{{ asset('/js/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('/js/bootstrap-editable.min.js') }}"></script>
  <script src="{{ asset('/js/ace-editable.min.js') }}"></script>
  <script src="{{ asset('/js/tree.min.js') }}"></script>
  <script src="{{ asset('/js/dropzone.min.js') }}"></script>
  <script src="{{ asset('/js/jquery.scrollbar.min.js') }}"></script>

  <!-- inline scripts related to this page -->
  <script type="text/javascript">
  //////////////////////////////////// upload
  var setdate = $('#psdate').html();

  var renderfile;
  try {
      Dropzone.autoDiscover = false;
      var myDropzone = new Dropzone('#dropzone', {
          previewTemplate: $('#preview-template').html(),

          thumbnailHeight: 120,
          thumbnailWidth: 120,
          //maxFilesize: 0.5,

          //addRemoveLinks : true,
          //dictRemoveFile: 'Remove',

          dictDefaultMessage :
          '<span class="bigger-150 bolder"><i class="ace-icon fa fa-caret-right red"></i> Drop files</span> to upload \
          <span class="smaller-80 grey">(or click)</span> <br /> \
          <i class="upload-icon ace-icon fa fa-cloud-upload blue fa-3x"></i>',

          thumbnail: function(file, dataUrl) {
              if (file.previewElement) {
                  $(file.previewElement).removeClass("dz-file-preview");
                  var images = $(file.previewElement).find("[data-dz-thumbnail]").each(function() {
                      var thumbnailElement = this;
                      thumbnailElement.alt = file.name;
                      thumbnailElement.src = dataUrl;
                  });
                  setTimeout(function() { $(file.previewElement).addClass("dz-image-preview"); }, 1);
              }
          },
          accept: function(file, done) {
              console.log(file);
              //alert(file.type);
              if (file.type != 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' && file.type !='application/vnd.ms-excel') {
                  done("Error! Files of this type are not accepted");
              } else {
                  done();
              }


              if (renderfile)clearTimeout(renderfile);
              renderfile = setTimeout(function(){
                $('#tree2').find("li:not([data-template])").remove();
                $('#tree2').tree('reload');
              }, 1000);

          }

      });


      //remove dropzone instance when leaving this page in ajax mode
      $(document).one('ajaxloadstart.page', function(e) {
          try {
              myDropzone.destroy();
          } catch(e) {}
      });
  } catch(e) {
    alert('Dropzone.js does not support older browsers!');
  }

  ////////////////////////////////////file tree
          var DataSourceTree = function (parentData, callback) {

          var $data = null;
          var param = null

          if (!("name" in parentData) && !("type" in parentData)) {
              param = 0;//load the first level

          }
          else if ("type" in parentData && parentData.type == "folder") {
              if ("additionalParameters" in parentData && "children" in parentData.additionalParameters) {
                  param = parentData.additionalParameters["id"];

              }
          }



          if (param != null) {

              var postData = {datatb:'files',sdate:'',id:param,_token:'{{csrf_token()}}'};
              $.ajax({
                  // url: "{{ url('/FilesJson/') }}",
                  url:"{{url('api/payroll/json')}}",
                  data: postData,
                  type: 'POST',
                  dataType: 'json',

                  success: function (response) {
                      if (response.status == "OK")
                          callback({ data: response.data });
                          //alert(JSON.stringify(param));
                  },
                  error: function (response) {
                      //console.log(response);
                  }
              })
          }
      };


      $('#tree2').ace_tree({
          dataSource: DataSourceTree ,
          loadingHTML:'<div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div>',
          'open-icon' : 'ace-icon fa fa-folder-open',
          'close-icon' : 'ace-icon fa fa-folder',
          'itemSelect' : true,
          'folderSelect': false,
          'multiSelect': false,
          'selected-icon' : null,
          'unselected-icon' : null,
          'folder-open-icon' : 'ace-icon tree-plus',
          'folder-close-icon' : 'ace-icon tree-minus'
      });

              /**
          //Use something like this to reload data
          $('#tree2').find("li:not([data-template])").remove();
          $('#tree2').tree('render');
          */



          //please refer to docs for more info
          $('#tree2')
          .on('loaded.fu.tree', function(e) {
          })
          .on('updated.fu.tree', function(e, result) {
          })
          .on('selected.fu.tree', function(e, result) {
              //if (result.target.type = 'item'){
            $("#nfile").html(result.target.fname);
            if (result.target.fname){
                 $('#hapus').prop('disabled', false);
                 $('#savetodb').prop('disabled', false);
            }

            loadfile(result.target.fname);
                //alert(JSON.stringify(result.target.fname));

          })
          .on('deselected.fu.tree', function(e, result) {
            $("#nfile").html(' -- Kosong --');
            if (result.target.fname){
                 $('#hapus').prop('disabled', true);
            }
          })
          .on('opened.fu.tree', function(e) {
          })
          .on('closed.fu.tree', function(e) {
          });


      $('.scrollbar-macosx').scrollbar();

  ///////////////////////////// selected File
  function loadfile(fname){

      // var postData = {fname:fname,datatb:'benefit',_token:'{{csrf_token()}}'};
      //
      // $.ajax({
      //     type: 'POST',
      //     //url: "{{url('FilesJson')}}",
      //     url:"{{url('api/Files/json')}}",
      //     data: postData,
      //     beforeSend:function(){
      //
      //
      //     },
      //     success: function(tmp) {
      //         // if (tmp.header){
      //         //
      //         //
      //              if (tmp.nfile)$('#savetodb').prop('disabled', false);
      //         //
      //         // } else {
      //         //
      //         //     if (tmp.nfile)$('#savetodb').prop('disabled', true);
      //         // }
      //         //
      //         //
      //         $("#nfile").html(tmp.nfile);
      //         if (tmp.nfile){
      //              $('#hapus').prop('disabled', false);
      //         }
      //         //alert(JSON.stringify(tmp));
      //     },
      // });
  };
  $( "#savetodb" ).on('click', function(e) {
      e.preventDefault();

      var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
          modal: true,
//          title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i> Save To DB </h4></div>",
          title_html: true,
          buttons: [{
            text: "Batal",
            "class" : "btn btn-minier",
            click: function() {
                $( this ).dialog( "close" );
            }
          },{
            text: "Simpan",
            "class" : "btn btn-primary btn-minier btn-simpan",
            click: function() {
              var postData = {fname:$('#nfile').html(),setdate:setdate,datatb:'savetodb',_token:'{{csrf_token()}}'};
              $.ajax({
                type: 'POST',
                url: "{{url('/api/payroll/cud')}}",
                data: postData,
                beforeSend:function(){
              //     //alert(setdate);
                  $('.btn-simpan').prop('disabled', true);
                  $( "#dialog-message" ).dialog( "close" );
                  $("#loading").modal();
                },
                success: function(tmp) {
                  $("#loading").modal('hide');
                }
              });
            }
          }]
      });
  });

  </script>
@endsection
