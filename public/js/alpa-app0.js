/* Load Page */
new function ($) {
  $.fn.getCursorPosition = function () {
      var pos = 0;
      var el = $(this).get(0);
      // IE Support
      if (document.selection) {
          el.focus();
          var Sel = document.selection.createRange();
          var SelLength = document.selection.createRange().text.length;
          Sel.moveStart('character', -el.value.length);
          pos = Sel.text.length - SelLength;
      }
      // Firefox support
      else if (el.selectionStart || el.selectionStart == '0')
          // console.log(el.selectionStart);
          pos = el.selectionStart;
      return pos;
  }
  //SET CURSOR POSITION
  $.fn.setCursorPosition = function(pos) {
    this.each(function(index, elem) {
      if (elem.setSelectionRange) {
        elem.setSelectionRange(pos, pos);
      } else if (elem.createTextRange) {
        var range = elem.createTextRange();
        range.collapse(true);
        range.moveEnd('character', pos);
        range.moveStart('character', pos);
        range.select();
      }
    });
    return this;
  };
} (jQuery);

function load(page,div){
    var loading_image_large = site+'/public/images/loading_large.gif' ;
    var image_load = "<div class='ajax_loading'><img src='"+loading_image_large+"' /></div>";

    $.ajax({
      url: site+"/"+page,
      dataType:"html",
      beforeSend: function(){
        $(div).html(image_load);
      },
      success: function(response){
        $(div).html(response);
      },
      error:function (xhr, ajaxOptions, thrownError){
        var msg = "Sorry but <b>"+ page +"</b> was an error: "+ xhr.status ;
//            var pesan = msg + xhr.status + " /" + xhr.statusText + "  " + xhr.responseText
        $(div).html(msg);
      }
    });
    return false;
}

// function active_menu(obj)
// {
// 	$(".acemn").attr("class", "acemn");
// 	var c = obj.split('>');
// 	var n = 0;
// 	c.forEach(function(entry) {
// 			if (n>0){
// 				$(c[n]).attr("class", "acemn active open");
// 				$(c[0]).attr("class", "acemn active");
// 			}else{
// 				$(c[n]).attr("class", "acemn active");
// 			}
// 		n++;
// 	});
//
// }
function Numbers(x) {
  if (!x) return;
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function formatNumber(input)
{
  if(input.id) $this = $("#"+input.id);
  else if (input.name) $this = $("[name = "+input.name+"]");
  else  return alert('formatNumber() tidak menemukan key id atau name');

  var p = $this.getCursorPosition();

  console.log(input.value);

  var cek = input.value.split('.');
  var num = input.value.replace(/\,/g,'');

  if(!isNaN(num)){
    if(num.indexOf('.') > -1){
      num = num.split('.');
      num[0] = num[0].toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1,')
                                .split('').reverse().join('').replace(/^[\,]/,'');
      if(num[1].length > 2){
        alert('Hanya diijinkan dua digit desimal');
        num[1] = num[1].substring(0,num[1].length-1);
        // $("#"+input.id).setCursorPosition(p);
      }
      input.value = num[0]+'.'+num[1];

      n = num[0].length - cek[0].length;
      $this.setCursorPosition(p+n);
    } else {
      nn = 0;
      old_count = (input.value.match(/,/g) || []).length;
      input.value = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1,').split('').reverse().join('').replace(/^[\,]/,'');
      new_count = (input.value.match(/,/g) || []).length;

      if (old_count !== new_count)nn=1;
      console.log(nn);

      $this.setCursorPosition(p+nn);
    };
  } else {
    alert('Anda hanya diperbolehkan memasukkan angka!');
    // input.value = input.value.substring(0,input.value.length-1);
    input.value = input.value.substring(0,p -1) + input.value.substring(p,input.value.length);
    $this.setCursorPosition(p-1);
  }
}


function formatNumber2(input)
{
  if(input.id) $this = $("#"+input.id);
  else if (input.name) $this = $("[name = "+input.name+"]");
  else  return alert('formatNumber() tidak menemukan key id atau name');

  var p = $this.getCursorPosition();

  var cek = input.value.split('.');
  var num = input.value.replace(/\,/g,'');

  if(!isNaN(num)){
    if(num.indexOf('.') > -1){
      num = num.split('.');
      num[0] = num[0].toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1,')
                                .split('').reverse().join('').replace(/^[\,]/,'');
      if(num[1].length > 2){
        alert('Hanya diijinkan dua digit desimal');
        num[1] = num[1].substring(0,num[1].length-1);
        // $("#"+input.id).setCursorPosition(p);
      }
      input.value = num[0]+'.'+num[1];

      n = num[0].length - cek[0].length;
      $this.setCursorPosition(p+n);
    } else {
      input.value = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1,').split('').reverse().join('').replace(/^[\,]/,'')
      $this.setCursorPosition(p);
    };
  } else {
    alert('Anda hanya diperbolehkan memasukkan angka!');
    // input.value = input.value.substring(0,input.value.length-1);
    input.value = input.value.substring(0,p -1) + input.value.substring(p,input.value.length);
    $this.setCursorPosition(p-1);
  }
}

function addCommas(n){
    var rx=  /(\d+)(\d{3})/;
    return String(n).replace(/^\d+/, function(w){
        while(rx.test(w)){
            w= w.replace(rx, '$1,$2');
        }
        return w;
    });
}


function getparameter(url,posdata,success){
  $.ajax({
    type: "POST",
    dataType: "json",
    url: url, //Relative or absolute path to response.php file
    data: posdata,
    success: function(data){
      success(data);
    }
  });
}

function getparameter2(url,posdata,success,beforeSend){
  $.ajax({
    type: "POST",
    dataType: "json",
    url: url, //Relative or absolute path to response.php file
    data: posdata,
    success: function(data){
      $("#loading").modal('hide');
      success(data);
    },
    beforeSend: function(data){
        $("#loading").modal();
        beforeSend(data);
    },
  });
}

// function SaveGrid(postsave){
//   getparameter2(postsave.url,postsave.post,
//     function(data){
//       var newHTML = '<i class="ace-icon fa fa-floppy-o"></i>Save';
//       $('#save').html(newHTML);
//
//       if(data.status == "success"){
//         console.log(data.status);
//         $(postsave.grid.toString()).trigger("reloadGrid");
//         $(postsave.modal.toString()).modal('hide');
//         $('#form').trigger("reset");
//
//       } else {
//         alert (data.msg);
//       }
//     },
//     function(data){
//       var newHTML = '<i class="ace-icon fa fa-spinner fa-spin "></i>Loading...';
//       $('#save').html(newHTML);
//     }
//   )
// }

function saveGrid(prm){
  var posdata = prm.post

  $.ajax({
    type: "POST",
    dataType: "json",
    url: prm.url, //Relative or absolute path to response.php file
    data: posdata,
    beforeSend:function(){
        var newHTML = '<i class="ace-icon fa fa-spinner fa-spin "></i>Loading...';
        $('#save').html(newHTML);

        // ubah save jadi loding
  //      alert(JSON.stringify($('#save')));
    },
    success: function(msg){

      var newHTML = '<i class="ace-icon fa fa-floppy-o"></i>Save';
      $('#save').html(newHTML);

      if(msg.status == "success"){
        $(prm.grid).trigger("reloadGrid");
        $(prm.modal).modal('hide');
        $('#form-1').trigger("reset");
        console.log(msg.msg);
      } else {
        console.log(msg.msg);
      }
    },
    error: function(xhr, Status, err) {
        //alert("Terjadi error : "+Status);
        alert (JSON.stringify(xhr));
        alert ("terjadi kesalahan harap hubungi administrator");
    }
  });
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// source chosen select //
function src_chosen(posdata,val){
  getparameter(posdata.src,posdata,function(data){
    var $select_elem = $("#"+posdata.elm);

    $select_elem.empty();
    $select_elem.append('<option value=""></option>');
    $.each(data.options, function (idx, obj) {
      $select_elem.append('<option value="' + idx + '">' + obj + '</option>');
    });
    $select_elem.trigger("chosen:updated");
    $select_elem.val(val).trigger("chosen:updated");
  });
};

function src_chosen_full(posdata,items,search){
  var $select_elem = $("#"+posdata.elm);
  $select_elem.empty();
  getparameter(posdata.src,posdata,function(data){

    $select_elem.append('<option value=""></option>');
    items(data);

    $select_elem.trigger("chosen:updated");
  });

  $select_elem.change(function(e) {
    e.preventDefault();
    posdata.search = $select_elem.val();
    getparameter(posdata.src,posdata,function(data){
      search(data);
    },function(data){})
  });
};



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Jqgrid //

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
      .datepicker({format:'dd MM yyyy' , autoclose:true});
  }, 0);
}

function style_edit_form(form) {
  //enable datepicker on "sdate" field and switches for "stock" field
  form.find('input[name=sdate]').datepicker({format:'dd MM yyyy' , autoclose:true});
  form.find('input[name=dob]').datepicker({format:'dd MM yyyy' , autoclose:true});
  form.find('input[name=jk]').addClass('ace ace-switch ace-switch-5').after('<span class="lbl"></span>');
             //don't wrap inside a label element, the checkbox value won't be submitted (POST'ed)
            //.addClass('ace ace-switch ace-switch-5').wrap('<label class="inline" />').after('<span class="lbl"></span>');

  //update buttons classes
  var buttons = form.next().find('.EditButton .fm-button');
  buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
  buttons.eq(0).addClass('btn-primary').prepend('<i class="ace-icon fa fa-check"></i>');
  buttons.eq(1).prepend('<i class="ace-icon fa fa-times"></i>')

  buttons = form.next().find('.navButton a');
  buttons.find('.ui-icon').hide();
  buttons.eq(0).append('<i class="ace-icon fa fa-chevron-left"></i>');
  buttons.eq(1).append('<i class="ace-icon fa fa-chevron-right"></i>');
}

function style_delete_form(form) {
  var buttons = form.next().find('.EditButton .fm-button');
  buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
  buttons.eq(0).addClass('btn-danger').prepend('<i class="ace-icon fa fa-trash-o"></i>');
  buttons.eq(1).addClass('btn-default').prepend('<i class="ace-icon fa fa-times"></i>')
}

function style_search_filters(form) {
  form.find('.delete-rule').val('X');
  form.find('.add-rule').addClass('btn btn-xs btn-primary');
  form.find('.add-group').addClass('btn btn-xs btn-success');
  form.find('.delete-group').addClass('btn btn-xs btn-danger');
}
function style_search_form(form) {
  var dialog = form.closest('.ui-jqdialog');
  var buttons = dialog.find('.EditTable')
  buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'ace-icon fa fa-retweet');
  buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'ace-icon fa fa-comment-o');
  buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'ace-icon fa fa-search');
}

function beforeDeleteCallback(e) {
  var form = $(e[0]);
  if(form.data('styled')) return false;

  form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
  style_delete_form(form);

  form.data('styled', true);
}

function beforeEditCallback(e) {
  var form = $(e[0]);
  form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
  style_edit_form(form);
}

//it causes some flicker when reloading or navigating grid
//it may be possible to have some custom formatter to do this as the grid is being created to prevent this
//or go back to default browser checkbox styles for the grid
function styleCheckbox(table) {
/**
    $(table).find('input:checkbox').addClass('ace')
    .wrap('<label />')
    .after('<span class="lbl align-top" />')


    $('.ui-jqgrid-labels th[id*="_cb"]:first-child')
    .find('input.cbox[type=checkbox]').addClass('ace')
    .wrap('<label />').after('<span class="lbl align-top" />');
*/
}


//unlike navButtons icons, action icons in rows seem to be hard-coded
//you can change them like this in here if you want
function updateActionIcons(table) {
    /**
    var replacement =
    {
        'ui-ace-icon fa fa-pencil' : 'ace-icon fa fa-pencil blue',
        'ui-ace-icon fa fa-trash-o' : 'ace-icon fa fa-trash-o red',
        'ui-icon-disk' : 'ace-icon fa fa-check green',
        'ui-icon-cancel' : 'ace-icon fa fa-times red'
    };
    $(table).find('.ui-pg-div span.ui-icon').each(function(){
        var icon = $(this);
        var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
        if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
    })
    */
}

//replace icons with FontAwesome icons like above
function updatePagerIcons(table) {
    var replacement = {
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
