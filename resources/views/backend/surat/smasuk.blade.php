
<div id="modal" class="modal fade" tabindex="-1">
	<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<!-- 01 Header -->
				<form id="form">
					<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h3 class="smaller lighter blue no-margin">Form Surat Masuk </h3>
					</div>
					<!-- 01 end heder -->
					<!-- 02 body -->
					<div class="modal-body">
						{{ csrf_field() }}
						<!-- <input type="hidden" name="datatb" value="keluarga" />
						<input type="hidden" id='oper-1' name="oper" value="add" />
						<input type="hidden" id='id-1' name="id" value="id" /> -->
						<div class="row">
							<div class="col-xs-12 col-sm-6">

                <div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 no-padding-right" for="comment">Tgl Masuk</label>
										<div class="col-xs-12 col-sm-8">
											<div class="clearfix"><input class="input-sm col-sm-4" type="text" id="date" name="date"></div>
										</div>
									</div>
								</div>
                <div class="space-2"></div>

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 no-padding-right" for="comment">Dari</label>
										<div class="col-xs-12 col-sm-8">
											<div class="clearfix"><input class="input-sm" type="text" id="dari" name="dari"></div>
										</div>
									</div>
								</div>
                <div class="space-2"></div>

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 no-padding-right" for="comment">Perihal</label>
										<div class="col-xs-12 col-sm-8">
											<div class="clearfix"><input class="input-sm " type="text" id="perihal" name="perihal"></div>
										</div>
									</div>
								</div>
                <div class="space-2"></div>

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 no-padding-right" for="comment">Disposisi Dari</label>
										<div class="col-xs-12 col-sm-8">
											<div class="clearfix"><input class="input-sm" type="text" id="ddari" name="ddari"></div>
										</div>
									</div>
								</div>
                <div class="space-2"></div>

								<div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 no-padding-right" for="comment">Disposisi Untuk</label>
										<div class="col-xs-12 col-sm-8">
											<div class="clearfix"><input class="input-sm" type="text" id="duntuk" name="duntuk"></div>
										</div>
									</div>
								</div>
                <div class="space-2"></div>

                <div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 no-padding-right" for="comment">isi</label>
										<div class="col-xs-12 col-sm-8">
											<div class="clearfix"><input class="input-sm" type="text" id="disi" name="disi"></div>
										</div>
									</div>
								</div>
                <div class="space-2"></div>

                <div class="row">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 no-padding-right" for="comment">Disposisi Lanjut</label>
										<div class="col-xs-12 col-sm-8">
											<div class="clearfix"><input class="input-sm" type="text" id="lanjutan" name="lanjutan"></div>
										</div>
									</div>
								</div>
                <div class="space-2"></div>
							</div>

							<div class="col-xs-12 col-sm-6">

                <div class="col-sm-12">
                  <!-- enctype="multipart/form-data" -->
                  <div  class="dropzone well" id="dropzone" >
                    <div class="fallback"><input name="file" type="file" multiple="" /></div>
                  </div>
                </div>
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
					</div>
					<!-- 02 end body -->

					<!-- 03 footer -->
					<div class="modal-footer">
						<button class="btn btn-sm btn-danger pull-right" id='save'>
								<i class="ace-icon fa fa-floppy-o"></i>Save
						</button>
						<button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
								<i class="ace-icon fa fa-times"></i>Close
						</button>
					</div>
					<!-- 03 end footer Form -->
				</div>
      </form>
	</div>
</div><!-- /.modal-dialog -->

<table id="table"></table>
<div id="pager"></div>

<script type="text/javascript">
  jQuery(function($) {

    var renderfile;
    try {
      Dropzone.autoDiscover = false;
      var myDropzone = new Dropzone('#dropzone', {
        url:'oprasional/FileUpload',
        params: {
             datatb: "fsmasuk",
             _token:'{{ csrf_token() }}'
        },
        previewTemplate: $('#preview-template').html(),

        thumbnailHeight: 120,
        thumbnailWidth: 120,
        //maxFilesize: 0.5,

        //addRemoveLinks : true,
        //dictRemoveFile: 'Remove',

        dictDefaultMessage :
        '<i class="upload-icon ace-icon fa fa-cloud-upload blue fa-3x"></i>',

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
          // console.log(file);
          //alert(file.type);
          if (file.type != 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' && file.type !='application/vnd.ms-excel') {
            done("Error! Files of this type are not accepted");
          } else {
            done();
          }


          // if (renderfile)clearTimeout(renderfile);
          // renderfile = setTimeout(function(){
              // $('#tree2').find("li:not([data-template])").remove();
              // $('#tree2').tree('render');
              // $('#tree2').tree('refreshFolder', $('#1'));
              // $('#tree2').tree('refreshFolder', $('#2'));
          // }, 1000);
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

    $('#date').datepicker({format:'dd-mm-yyyy' , autoclose:true})

    var postsave='';
		$('#save').click(function(e) {
			e.preventDefault();
			postsave += $("#form").serialize()+'&datatb=smasuk';
			console.log(postsave);
			getparameter("{{url('/api/surat/cud')}}",postsave,	function(data){
					var newHTML = '<i class="ace-icon fa fa-floppy-o"></i>Save';
					$('#save').html(newHTML);
    //
					$('#form').trigger("reset");
    //
					$('#table').trigger("reloadGrid", [{current:true}]);
					$('#modal').modal('hide');
		// // 			// console.log(data);
			},function(data){
		// 			var newHTML = '<i class="ace-icon fa fa-spinner fa-spin "></i>Loading...';
		// 			$('#save').html(newHTML);
			});
		});

    var tabel = "#table";
    var pager_tabel = "#pager";

    //resize to fit page size
    $(window).on('resize.jqGrid', function () {
        $(tabel).jqGrid( 'setGridWidth', $(".page-content").width() );
    })

    //resize on sidebar collapse/expand
    var parent_column = $(tabel).closest('[class*="col-"]');
    $(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
        if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
            //setTimeout is for webkit only to give time for DOM changes and then redraw!!!
            setTimeout(function() {
                $(tabel).jqGrid( 'setGridWidth', parent_column.width() );
            }, 0);
        }
    })

    //if your grid is inside another element, for example a tab pane, you should use its parent's width:
    $(window).on('resize.jqGrid', function () {
        var parent_width = $(tabel).closest('.tab-pane').width();
        $(tabel).jqGrid( 'setGridWidth', parent_width );
    })
    //and also set width when tab pane becomes visible
    $('#myTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      if($(e.target).attr('href') == '#mygrid') {
        var parent_width = $(tabel).closest('.tab-pane').width();
        $(tabel).jqGrid( 'setGridWidth', parent_width );
      }
    })

    var master = jQuery(tabel).jqGrid({
      caption: "Surat Masuk",
      datatype: "json",            //supported formats XML, JSON or Arrray
      mtype : "post",
			postData: {datatb:'smasuk',_token:'{{ csrf_token() }}'},
			url:"{{url('/api/surat/jqgrid')}}",
			editurl: "{{url('/api/surat/cud')}}",//nothing is saved
      // serializeRowData:function(postdata,ids) {
      //   postdata.datatb = 'nilai';
      //   postdata.grup   = 'jabatan';
      //   postdata._token = '<?php echo csrf_token();?>';
      //   return postdata;
      // },
      sortname:'id',
      sortorder: 'desc',
      height: 250,
      colNames:[' ', 'Tanggal Masuk','Dari','Perihal','Disposisi Dari','Disposisi Untuk','Isi','Disposisi lanjutkan','file'],
      colModel:[
        {name:'myac',index:'', width:50, fixed:true, sortable:false, resize:false,
          // formatter:'actions',
          // formatoptions:{
          //   keys:true,
          //   delbutton: true,//disable delete button
					//
          //   delOptions:{recreateForm: true, beforeShowForm:beforeDeleteCallback},
          //   //editformbutton:true, editOptions:{recreateForm: true, beforeShowForm:beforeEditCallback}
          // }
        },
				{name:'date',index:'date', width:100, editable: true, align: 'center'},
				{name:'dari',index:'dari', width:100, editable: true},
				{name:'perihal',index:'perihal', width:150, editable: true},
				{name:'ddari',index:'ddari', width:100, editable: true},
				{name:'duntuk',index:'duntuk', width:100, editable: true},
				{name:'isi',index:'isi', width:150, editable: true},
				{name:'dlanjut',index:'dlanjut', width:100, editable: true},
        {name:'file',index:'file', width:50, editable: true},
      ],

      viewrecords : true,
      rowNum      : 10,
      rowList     : [10,20,30],
      pager       : pager_tabel,
      altRows     : true,
      multiboxonly: true,

      loadComplete : function() {
        var table = this;
        setTimeout(function(){
          styleCheckbox(table);

          updateActionIcons(table);
          updatePagerIcons(table);
          enableTooltips(table);
        }, 0);
      },
    });
    $(window).triggerHandler('resize.jqGrid');//trigger window resize to make the grid get the correct size

    //enable search/filter toolbar
    //jQuery(tabel).jqGrid('filterToolbar',{defaultSearch:true,stringResult:true})
    //jQuery(tabel).filterToolbar({});

    //navButtons
    jQuery(tabel).jqGrid('navGrid',pager_tabel, {   //navbar options
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
    },{
      //edit record form
      closeAfterEdit: true,
      //width: 700,
      recreateForm: true,
      beforeShowForm : function(e) {
        var form = $(e[0]);
        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
        style_edit_form(form);
      },
      onclickSubmit: function () {
        return { datatb:'magen', _token:'<?php echo csrf_token();?>'};
      }
    },{
      //new record form
      //width: 700,
      closeAfterAdd: true,
      recreateForm: true,
      viewPagerButtons: false,
      beforeShowForm : function(e) {
        var form = $(e[0]);
        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
        style_edit_form(form);
      },
      onclickSubmit: function () {
        return { datatb:'magen', _token:'<?php echo csrf_token();?>'};
      }
    },{
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
        return { datatb:'magen', _token:'<?php echo csrf_token();?>'};
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
      },
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
      }).jqGrid('navButtonAdd',pager_tabel,{
  				keys: true,
  				caption:"",
  				buttonicon:"ace-icon fa fa-pencil blue",
  				position:"first",
  				onClickButton:function(){
  					$('#form').trigger("reset");

  					var gsr = $(this).jqGrid('getGridParam','selrow');
  					if(gsr){
  						var posdata= {'datatb':'smasuk','iddata':gsr};
  						getparameter("{{url('/api/surat/json')}}",posdata,function(data){
                $('#date').val(data.date);
                $('#dari').val(data.dari);
                $('#perihal').val(data.perihal);
                $('#ddari').val(data.ddari);
                $('#duntuk').val(data.duntuk);
                $('#disi').val(data.isi);
                $('#lanjutan').val(data.lanjutan);

                postsave += 'oper=edit&id='+gsr+'&';
  						},function(data){ });

  						$('#modal').modal('show');
  					} else {
  						alert("pilih tabel")
  					}
  				}
  		}).jqGrid('navButtonAdd',pager_tabel,{
  			keys: true,
  			caption:"",
  			buttonicon:"ace-icon fa fa-plus-circle purple",
  			position:"first",
  			onClickButton:function(){
  				$('#form').trigger("reset");
          $('#date').datepicker("setDate", moment().format('dd-MM-yyyy'));
  				// $('#date').data("DateTimePicker").date(new Date(setdate));
          //
  				// $('#pcdate, #tundadate').daterangepicker({
  				// 	'applyClass' : 'btn-sm btn-success',
  				// 	'cancelClass' : 'btn-sm btn-default',
  				// 	"opens": "center",
  				// 	timePicker: true,
  				// 	timePicker24Hour: true,
  				// 	startDate: moment().startOf('minute'),
  				// 	endDate: moment().startOf('minute').add(1, 'minute'),
  				// 	locale: {
  				// 			applyLabel: 'Apply',
  				// 			cancelLabel: 'Cancel',
  				// 			format: 'DD/MM/YY HH:mm'
  				// 	}
  				// })
  				// .prev().on(ace.click_event, function(){
  				// 		$(this).next().focus();
  				// });
  				// // console.log(moment().startOf('minute'));
  				// $('#dermaga, #ops').val('').trigger("chosen:updated");
  				// $('#tunda').multiselect('deselectAll', false).multiselect('refresh');
  				// postsave ='';
  				// postsave += 'oper=add&';
  				$('#modal').modal('show');
  			}
  		})

      //var selr = jQuery(tabel).jqGrid('getGridParam','selrow');
      $(document).one('ajaxloadstart.page', function(e) {
        $(tabel).jqGrid('GridUnload');
        $('.ui-jqdialog').remove();
      });







    });
  </script>
