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
        <div class="col-md-12">File :: <span id=nfile></span></div>
        <div class=col-md-2><button id="savetodb" class="btn btn-purple btn-sm" disabled>Save To DB</button></div>
        <div class=col-md-2><button id="hapus" class="btn btn-info btn-sm" disabled>Hapus</button></div>
        <div class=col-md-8>Berlaku Mulai : <?php echo '<span class="editable" id="psdate">'.date('F Y').'</span>';  ?></div>
        <input name="setdate" value="" type="hidden"/>
        <div class="col-md-12">
          <div class="widget-box widget-color-green2">
            <div class="widget-header"><h4 class="widget-title lighter smaller">File Hasil Upload</h4></div>
            <div class="widget-body">
              <div class="widget-main padding-8"><ul id="tree2"></ul></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">

        <form action="{{url('FilesSave')}}" class="dropzone well" id="dropzone" enctype="multipart/form-data">
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
jQuery(function($) {
  //editables on first profile page
  $.fn.editable.defaults.mode = 'inline';
  $.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
  $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
                              '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';

  var setdate = $('#psdate').html();
//  $('input[name="setdate"]').val(setdate);

  $('#psdate').editable({
    type: 'adate',
    date: {
        //datepicker plugin options
            format: 'MM yyyy',
        viewformat: 'MM yyyy',
        //,nativeUI: true//if true and browser support input[type=date], native browser control will be used
        viewMode: "months",
        minViewMode: "months"
    }
  }).on('save', function(e, params) {
//      $('input[name="setdate"]').val(params.newValue);
      setdate = params.newValue;
  });

    //////////////////////////////////// upload
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
                    $('#tree2').tree('render');
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
                url:"{{url('api/Files/json')}}",
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

                loadfile(result.target.fname);
               // alert(JSON.stringify(result.target.fname));
                //};
        })
        .on('deselected.fu.tree', function(e) {
        })
        .on('opened.fu.tree', function(e) {
        })
        .on('closed.fu.tree', function(e) {
        });


    $('.scrollbar-macosx').scrollbar();

/////////////////////////////tabel
    function loadfile(fname){
        var postData = {fname:fname,datatb:'benefit',_token:'{{csrf_token()}}'};

        $.ajax({
            type: 'POST',
            //url: "{{url('FilesJson')}}",
            url:"{{url('api/Files/json')}}",
            data: postData,
            beforeSend:function(){


            },
            success: function(tmp) {
                // if (tmp.header){
                //
                //
                     if (tmp.nfile)$('#savetodb').prop('disabled', false);
                //
                // } else {
                //
                //     if (tmp.nfile)$('#savetodb').prop('disabled', true);
                // }
                //
                //
                $("#nfile").html(tmp.nfile);
                if (tmp.nfile){
                  $('#hapus').prop('disabled', false);
                  $('#savetodb').prop('disabled', false);
                }
                //alert(JSON.stringify(tmp));
            },
        });
    }

///////////////////////////////// dialog
//override dialog's title function to allow for HTML titles
        $.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
            _title: function(title) {
                var $title = this.options.title || '&nbsp;'
                if( ("title_html" in this.options) && this.options.title_html == true )
                    title.html($title);
                else title.text($title);
            }
        }));

    $( "#savetodb" ).on('click', function(e) {
        e.preventDefault();

        var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
            modal: true,
            title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i> Save To DB </h4></div>",
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
                  url: "{{url('/api/Files/save')}}",
                  data: postData,
                  beforeSend:function(){
                    //alert(setdate);
                      $('.btn-simpan').prop('disabled', true);
                  },
                  success: function(tmp) {
                      $( "#dialog-message" ).dialog( "close" );
                  }
                });
              }
            }]
        });

        /**
        dialog.data( "uiDialog" )._title = function(title) {
            title.html( this.options.title );
        };
        **/
    });


    $( "#hapus" ).on('click', function(e) {
        e.preventDefault();
        $( "#dialog-confirm" ).removeClass('hide').dialog({
            resizable: false,
            width: '320',
            modal: true,
            title: "<div class='widget-header'><h4 class='smaller'><i class='ace-icon fa fa-exclamation-triangle red'></i> Hapus File</h4></div>",
            title_html: true,
            buttons: [{
                html: "<i class='ace-icon fa fa-trash-o bigger-110'></i>&nbsp; Hapus",
                "class" : "btn btn-danger btn-minier",
                click: function() {

                    var postData = {fname:$('#nfile').html(),datatb:'delfile',_token:'{{csrf_token()}}'};
                    $.ajax({
                        type: 'POST',
                        url: "{{url('/api/Files/save')}}",
                        data: postData,
                        beforeSend:function(){

                        },
                        success: function(tmp) {
                            $("#header").html('');
                            $("#isinya").html('');
                            loadfile();
                            $('#tree2').find("li:not([data-template])").remove();
                            $('#tree2').tree('render');
                            $('#hapus').prop('disabled', true);
                            $('#savetodb').prop('disabled', true);

                            $( "#dialog-confirm" ).dialog( "close" );
                        }
                    });

                }
            },{
                text: "Batal",
                "class" : "btn btn-minier",
                click: function() {
                    $( this ).dialog( "close" );
                }
            }]
        });
    });

    function Number(input)
    {
        return input.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    };


});
</script>
@endsection
