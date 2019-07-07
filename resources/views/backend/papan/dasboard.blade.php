

<?php date_default_timezone_set('Asia/Jakarta')?>
@extends('backend.app_backend')

@section('css')
<link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
<link rel="stylesheet" href="{{asset('css/autocomplete.css')}}">
<style>
.table{
  width: 93%
}

.items-active {
  border-color: #FFF;
  border-style: solid;
  border-width: 5px;
  box-shadow: 0px 0px 5px #aaaaaa;
  z-index: 9999999;
  border-radius: 10px;
}

.items-elm {
  /* Safari 3-4, iOS 1-3.2, Android 1.6- */
  -webkit-border-radius: 10px;

  /* Firefox 1-3.6 */
  -moz-border-radius: 10px;

  /* Opera 10.5, IE 9, Safari 5, Chrome, Firefox 4, iOS 4, Android 2.1+ */
  border-radius: 10px;
}

.rowitems{
  /* Safari 3-4, iOS 1-3.2, Android 1.6- */
  -webkit-border-radius: 10px;

  /* Firefox 1-3.6 */
  -moz-border-radius: 10px;

  /* Opera 10.5, IE 9, Safari 5, Chrome, Firefox 4, iOS 4, Android 2.1+ */
  border-radius: 10px;

  background-color: #29e;
  height: 34px;
}

/* ----------------------------- drop ---------------------- */
div.dropzone {
  margin: auto;
  width:84px;
  height:34px;
  border-style: dashed;
  border-width: 2px;
  transition: background-color 0.3s;
  border-radius: 10px;
  text-align: center;
}
div.dropzone2 {
  margin: auto;
  width:84px;
  height:34px;
  border-style: dashed;
  border-width: 2px;
  transition: background-color 0.3s;
  border-radius: 10px;
  text-align: center;
}
div.drop-active {
  border-color: #29e;
  box-shadow: 0px 0px 1px #aaaaaa;
}
.drop-target {
  background-color: #29e;
  border-color: blue !important;
  border-style: solid;
}
/* ------------------------------- nav ----------------------------- */
.outer {
  /* border: 3px solid blue; */
  display: table;
  position: fixed;
  top:7%;
  right: 0;
  height: 500px;
  vertical-align: middle;
}

.middle {
  display: table-cell;
}
.middlex {
  padding: 10px;
  display: table-cell;
  background-color: #111;
  vertical-align: middle;

}
.inner {
  border: 3px solid red;
  margin-left: auto;
  margin-right: auto;
  width: 200px;
}
.tleft{
  /* Safari 3-4, iOS 1-3.2, Android 1.6- */
  -webkit-border-radius: 12px;

  /* Firefox 1-3.6 */
  -moz-border-radius: 12px;

  /* Opera 10.5, IE 9, Safari 5, Chrome, Firefox 4, iOS 4, Android 2.1+ */
  border-radius: 10px 0px 0px 10px;
  color:#fff;
  background-color: #111;
  width: 25px;
  line-height: 50px;
  vertical-align: middle;
  text-align: center;
  position:relative;
  margin:0 auto;
}
/*  ----------------------------- nav nuton ------------------ */
.sidenav {
  position: fixed;
  left: 0;
  right: 0;
  bottom:0px;
  width: 100%;
  /* text-align: center; */
  z-index: 1;
  transition: 0.5s;
  /* overflow-x: hidden; */
}
#on-off {
  /* Safari 3-4, iOS 1-3.2, Android 1.6- */
  -webkit-border-radius: 12px;

  /* Firefox 1-3.6 */
  -moz-border-radius: 12px;

  /* Opera 10.5, IE 9, Safari 5, Chrome, Firefox 4, iOS 4, Android 2.1+ */
  border-radius: 10px 10px 0px 0px;

  background-color: #111;
  width: 40px;
  line-height: 25px;
  /* justify-content: center; */
  text-align: center;
  position:relative;
  margin:0 auto;
  color:#fff;
}
.leftnav {
  position: fixed;
  left: 0;
  right: 0;
  bottom:20px;
  width: 100%;
  /* text-align: center; */
  z-index: 1;
  transition: 0.5s;
  /* overflow-x: hidden; */
}
.sidenav-con {
  background-color: #111;
  height: 0px;
  transition: 0.5s;
}
.cj{
  margin:0 auto;
  display: table;
  padding: 5px;
}
/*  ------------------------------------------- */
table.tabel-bottom td {
  border: 1px solid white;
  padding: 5px;
  text-align: center;
  border-style: dashed;
  justify-content: center;
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

    <div class="page-header">
        <h1>
            Dasboard
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                List Transaksi Harian
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="dropzone drop-delete" data-action="delete">
              <span class="text-danger font-weight-normal"><i class="fa fa-trash"></i> HAPUS </span>
            </div>

            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th></th>
                  <th>Time Req</th>
                  <th>Agen</th>
                  <th>Vessel</th>
                  <th>Jetty</th>
                  <th>Job</th>
                  <th>Status</th>
                  <th>PC</th>
                  <th>Gerak</th>
                </tr>
              </thead>
              <tbody>
                <tr class="drag-elm">
                  <td data-row="0">

                  </td>
                  <td class="col-0">
                    <div class="dropzone" data-col="0-0"> </div>
                  </td>
                  <td class="col-1">
                    <div class="dropzone" data-col="0-1"> </div>
                  </td>
                  <td class="col-2">
                    <div class="dropzone" data-col="0-2"> </div>
                  </td>
                  <td class="col-3">
                    <div class="dropzone" data-col="0-3"> </div>
                  </td>
                  <td class="col-4">
                    <div class="dropzone" data-col="0-4"> </div>
                  </td>
                  <td class="col-5">
                    <div class="dropzone" data-col="0-5"> </div>
                  </td>
                  <td class="col-6">
                    <div class="dropzone" data-col="0-6"> </div>
                  </td>
                  <td class="col-7">
                    <div class="dropzone" data-col="0-7"> </div>
                  </td>
                </tr>
                <tr class="drag-elm">
                  <td data-row="1">

                  </td>
                  <td class="col-0">
                    <div class="dropzone"  data-col="1-0"> </div>
                  </td>
                  <td class="col-1">
                    <div class="dropzone"  data-col="1-1"> </div>
                  </td>
                  <td class="col-2">
                    <div class="dropzone"  data-col="1-2"> </div>
                  </td>
                  <td class="col-3">
                    <div class="dropzone"  data-col="1-3"> </div>
                  </td>
                  <td class="col-4">
                    <div class="dropzone"  data-col="1-4"> </div>
                  </td>
                  <td class="col-5">
                    <div class="dropzone"  data-col="1-5"> </div>
                  </td>
                  <td class="col-6">
                    <div class="dropzone"  data-col="1-6"> </div>
                  </td>
                  <td class="col-7">
                    <div class="dropzone"  data-col="1-7"> </div>
                  </td>
                </tr>
              </tbody>
            </table>

            <div class="outer">
              <div class="middle">
                <div class="tleft">
                  ::
                </div>
              </div>
              <div class="middlex">
                <table class="tabel-bottom">
                  <tr>
                    <td><div class="dropzone2" data-col="0"> </div></td>
                  </tr>
                  <tr>
                    <td><div class="dropzone2" data-col="1"> </div></td>
                  </tr>
                  <tr>
                    <td><div class="dropzone2" data-col="2"> </div></td>
                  </tr>
                  <tr>
                    <td><div class="dropzone2" data-col="3"> </div></td>
                  </tr>
                  <tr>
                    <td><div class="dropzone2" data-col="4"> </div></td>
                  </tr>
                  <tr>
                    <td><div class="dropzone2" data-col="5"> </div></td>
                  </tr>
                  <tr>
                    <td><div class="dropzone2" data-col="6"> </div></td>
                  </tr>
                  <tr>
                    <td><div class="dropzone2" data-col="7"> </div></td>
                  </tr>
                  <tr>
                    <td><div class="dropzone2" data-col="8"> </div></td>
                  </tr>
                  <tr>
                    <td><div class="dropzone2" data-col="9"> </div></td>
                  </tr>
                </table>
              </div>
            </div>

            <div class="sidenav">
              <div id="on-off" onclick="openNav()">
                <!-- <i  class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> -->
                &#9776;
              </div>
              <div id="mySidenav" class="sidenav-con">
                <div class="cj">
                  <table class="tabel-bottom">
                      <tr>
                        <td><div id="d01" class="items-elm bg-danger text-white">Time Req</div></td>
                        <td><div id="d02" class="items-elm btn-info text-white">Agen</div></td>
                        <td><div id="d03" class="items-elm btn-success text-white">Vessel</div></td>
                      </tr>
                      <tr>
                        <td><input id="req"></input></td>
                        <td><input id="fagen"></input></td>
                        <td><input id="fvessel"></input></td>
                      </tr>
                  </table>
                </div>
              </div>
            </div>
            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('js')
<script src="{{ asset('js/interact/interact.min.js') }}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script type="text/javascript">
  function openNav() {
    if ($("#mySidenav").css('height')==='90px'){
      $("#mySidenav").height('0px');
    } else {
      $("#mySidenav").height('90px');
    }
  }
  // ---------------------------------
  $( "#req" ).autocomplete({
    minLength: 0,
    open: function(event, ui) {
      var oldTop2 = newTop = 0;
      var autocomplete = $("#ui-id-1");
      var oldTop2 = $(this).offset().top;
      var newTop = oldTop2 - autocomplete.height();
      // alert(autocomplete.height());
      autocomplete.css("top", newTop-15);
      console.log(oldTop2+' - '+autocomplete.height()+' = '+newTop);
    },
    source: function(request, response) {
      $.ajax({
        type: "POST",
        url: "api/autocomplete",
        dataType: "json",
        data: { term : request.term, f:'req'},
        success: function(data) { response(data); }
      });
    },
    select: function( event, ui ) {
      $( "#req" ).val( ui.item.label );
      $( "#d01" ).html( ui.item.label );
      $( "#req" ).val( "" );
      return false;
    },
    change: function( event, ui ) {
      $( "#d02" ).html($(this).val());
      $( "#req" ).val( "" );
    }
  });

  $( "#fagen" ).autocomplete({
    minLength: 0,
    open: function(event, ui) {
      var oldTop2 = newTop = 0;
      var autocomplete = $("#ui-id-2");
      var oldTop2 = $(this).offset().top;
      var newTop = oldTop2 - autocomplete.height();
      // alert(autocomplete.height());
      autocomplete.css("top", newTop-15);
      console.log(oldTop2+' - '+autocomplete.height()+' = '+newTop);
    },
    source: function(request, response) {
      $.ajax({
        type: "POST",
        url: "api/autocomplete",
        dataType: "json",
        data: { term : request.term, f:'fagen'},
        success: function(data) { response(data); }
      });
    },
    select: function( event, ui ) {
      $( "#fagen" ).val( ui.item.label );
      $( "#d02" ).html( ui.item.label );
      $( "#fagen" ).val( "" );
      return false;
    },
    change: function( event, ui ) {
      $( "#d02" ).html($(this).val());
      $( "#fagen" ).val( "" );
    }
  });

  $( "#fvessel" ).autocomplete({
    minLength: 0,
    open: function(event, ui) {
      var oldTop2 = newTop = 0;
      var autocomplete = $("#ui-id-3");
      var oldTop2 = $(this).offset().top;
      var newTop = oldTop2 - autocomplete.height();
      // alert(autocomplete.height());
      autocomplete.css("top", newTop-15);
      console.log(oldTop2+' - '+autocomplete.height()+' = '+newTop);
    },
    source: function(request, response) {
      $.ajax({
        type: "POST",
        url: "api/autocomplete",
        dataType: "json",
        data: { term : request.term, f:'fvessel'},
        success: function(data) { response(data); }
      });
    },
    select: function( event, ui ) {
      $( "#fvessel" ).val( ui.item.label );
      $( "#d03" ).html( ui.item.label );
      $( "#fvessel" ).val( "" );
      return false;
    },
    change: function( event, ui ) {
      $( "#d03" ).html($(this).val());
      $( "#fvessel" ).val( "" );
    }
  });
  // ---------------------------------------------------------------------
  $.post("api/papan", function (response) {
    // console.log(response);
    $.each( response.data, function( rkey, rvalue ) {
      $.each( response.data[rkey], function( ckey, cvalue ) {
        if(cvalue!=""){
          $('td[data-row='+rkey+']').html('<div class="rowitems">&ensp;</div>');
        }
        $('.dropzone[data-col='+rkey+'-'+ckey+']').html(cvalue);
      });
    });
  })


  interact('.items-elm').draggable({
    inertia: true,
    restrict: {
      restriction: "parent",
      endOnly: true,
      elementRect: { top: 0, left: 0, bottom: 0, right: 0 }
    },
    autoScroll: true,
    // dragMoveListener from the dragging demo above
    onmove: function (event) {
      var target = event.target,

      // keep the dragged position in the data-x/data-y attributes
      x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx,
      y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

      target.style.zIndex = 9999999;

      // translate the element
      target.style.webkitTransform =
      target.style.transform =
      'translate(' + x + 'px, ' + y + 'px)';

      // update the position attributes
      target.setAttribute('data-x', x);
      target.setAttribute('data-y', y);

      target.classList.add('items-active');
    },
    onend: function (event) {
        var target = event.target;

        target.setAttribute('data-x', 0);
        target.setAttribute('data-y', 0);

        target.style.webkitTransform =
        target.style.transform =
        'translate(0px,0px)';

        target.classList.remove('items-active');
        interact('.items-elm').draggable({
          restrict: {
            restriction: "parent",
            endOnly: true,
            elementRect: { top: 0, left: 0, bottom: 0, right: 0 }
          },
        });
    }
  });
  interact('.dropzone').dropzone({
      accept: '.items-elm',
      overlap: 'pointer',
      ondropactivate: function (event) {
          // add active dropzone feedback
          event.target.classList.add('drop-active');
          // console.log('active');
      },
      ondragenter: function (event) {
          var draggableElement = event.relatedTarget,
          dropzoneElement = event.target;

          // feedback the possibility of a drop
          dropzoneElement.classList.add('drop-target');
          // console.log(dropzoneElement.classList);
          interact('.items-elm').draggable({
            restrict: 'disable'
          });
          // alert('akti');
      },
      ondragleave: function (event) {
          // remove the drop feedback style
          event.target.classList.remove('drop-target');
          interact('.items-elm').draggable({
            restrict: {
              restriction: "parent",
              endOnly: true,
              elementRect: { top: 0, left: 0, bottom: 0, right: 0 }
            },
          });
      },
      ondrop: function (event) {
          var $dropzone = $(event.target),
              $box = $(event.relatedTarget),
              lablename = $box.html(),
              classes = $box[0].classList.value;
              // alert(classes);

            if ($dropzone.children().length == 0) {

              if ($box.attr('dp') == 1) {
                  $box.remove();
              }

              var $new = $('<div></div>');

              $new.addClass(classes);
              $new.html(lablename);
              $new.attr('dp',1);

              $new.css({
                  minHeight: 30,
                  lineHeight:'30px'
              })
              $dropzone.append($new);

              var datacol = $dropzone.attr('data-col').split('-');
              var data = {};
              data['row'] = datacol[0];
              data['col'] = datacol[1];
              data['cel'] = $dropzone.html();

              $.post("api/papan" ,data, function (response) {
                if (response.add !== undefined) $('td[data-row='+data['row']+']').html('<div class="rowitems">&ensp;</div>');;
              });
          } else if ($dropzone.hasClass('drop-delete')) {

            var datacol = $box.parents().attr('data-col').split('-');
            var dataval = {};
            dataval['row'] = datacol[0];
            dataval['col'] = datacol[1];
            dataval['cel'] = '-';

            $.post("api/papan",dataval, function (response) {
              if (response.delete !== undefined) $('td[data-row='+response.delete+']').html(' ');
              $box.remove();
            });
          } else {

              event.relatedTarget.setAttribute('data-x', 0);
              event.relatedTarget.setAttribute('data-y', 0);

              event.relatedTarget.style.webkitTransform =
              event.relatedTarget.style.transform =
              'translate(0px,0px)';
              // $dropzone.html('');
              // console.log( $box.parent().html() )
          }

      },
      ondropdeactivate: function (event) {
        // remove active dropzone feedback
        event.target.classList.remove('drop-active');
        event.target.classList.remove('drop-target');
      }
  });

  interact('.rowitems').draggable({
    inertia: true,
    restrict: {
      restriction: "parent",
      endOnly: true,
      elementRect: { top: 0, left: 0, bottom: 0, right: 0 }
    },
    autoScroll: true,
    // dragMoveListener from the dragging demo above
    onmove: function (event) {
      var target = event.target,

      // keep the dragged position in the data-x/data-y attributes
      x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx,
      y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

      target.style.zIndex = 9999999;

      // translate the element
      target.style.webkitTransform =
      target.style.transform =
      'translate(' + x + 'px, ' + y + 'px)';

      // update the position attributes
      target.setAttribute('data-x', x);
      target.setAttribute('data-y', y);

      target.classList.add('items-active');
    },
    onend: function (event) {
        var target = event.target;

        target.setAttribute('data-x', 0);
        target.setAttribute('data-y', 0);

        target.style.webkitTransform =
        target.style.transform =
        'translate(0px,0px)';

        target.classList.remove('items-active');
        interact('.items-elm').draggable({
          restrict: {
            restriction: "parent",
            endOnly: true,
            elementRect: { top: 0, left: 0, bottom: 0, right: 0 }
          },
        });
    }
  });
  interact('.dropzone2').dropzone({
      accept: '.rowitems',
      overlap: 'pointer',
      ondropactivate: function (event) {
          // add active dropzone feedback
          event.target.classList.add('drop-active');
          // console.log('active');
      },
      ondragenter: function (event) {
          var draggableElement = event.relatedTarget,
          dropzoneElement = event.target;

          // feedback the possibility of a drop
          dropzoneElement.classList.add('drop-target');
          // console.log(dropzoneElement.classList);
          interact('.rowitems').draggable({
            restrict: 'disable'
          });
          // alert('akti');
      },
      ondragleave: function (event) {
          // remove the drop feedback style
          event.target.classList.remove('drop-target');
          interact('.items-elm').draggable({
            restrict: {
              restriction: "parent",
              endOnly: true,
              elementRect: { top: 0, left: 0, bottom: 0, right: 0 }
            },
          });
      },
      ondrop: function (event) {
          var $dropzone = $(event.target),
              $box = $(event.relatedTarget),
              lablename = $box.html(),
              classes = $box[0].classList.value;
              // alert(classes);

            if ($dropzone.children().length == 0) {

              if ($box.attr('dp') == 1) {
                  $box.remove();
              }

              var $new = $('<div></div>');

              $new.addClass(classes);
              $new.html(lablename);
              $new.attr('dp',1);

              $new.css({
                  minHeight: 30,
                  lineHeight:'30px'
              })
              $dropzone.append($new);

              var datacol = $dropzone.attr('data-col').split('-');
              var data = {};
              data['row'] = datacol[0];
              data['col'] = datacol[1];
              data['cel'] = $dropzone.html();

              $.post("api/papan" ,data, function (response) {

              });
          } else if ($dropzone.hasClass('drop-delete')) {

            var datacol = $box.parents().attr('data-col').split('-');
            var data = {};
            data['row'] = datacol[0];
            data['col'] = datacol[1];
            data['cel'] = '-';

            $.post("api/papan",data, function () {
              $box.remove();
            });
          } else {

              event.relatedTarget.setAttribute('data-x', 0);
              event.relatedTarget.setAttribute('data-y', 0);

              event.relatedTarget.style.webkitTransform =
              event.relatedTarget.style.transform =
              'translate(0px,0px)';
              // $dropzone.html('');
              // console.log( $box.parent().html() )
          }

      },
      ondropdeactivate: function (event) {
        // remove active dropzone feedback
        event.target.classList.remove('drop-active');
        event.target.classList.remove('drop-target');
      }
  });
</script>

@endsection
