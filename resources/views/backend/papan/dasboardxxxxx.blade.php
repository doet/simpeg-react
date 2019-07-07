

<?php date_default_timezone_set('Asia/Jakarta')?>
@extends('backend.app_backend')

@section('css')
<link href="{{ asset('css/datatables/jquery.dataTables.css') }}" rel="stylesheet">
<style>
<style>
.items-elm {
  width: 80px;
  line-height: 30px;
  border-radius: 10px;
  text-align: center;
  vertical-align: middle;
  margin:0 auto;
}
div.items-active {
  border-color: #FFF;
  border-style: solid;
  border-width: 5px;
  box-shadow: 0px 0px 5px #aaaaaa;
  z-index: 999;
}
/* --------------------------- drop ------------------------------*/
div.dropzone {
  margin: auto;
  width:84px;
  height:34px;
  border-style: dashed;
  border-width: 2px;
  transition: background-color 0.3s;
  border-radius: 10px;
}
div.drop-active {
  border-color: #29e;
  box-shadow: 0px 0px 1px #aaaaaa;
}
/* --------------------------- Slider ----------------------------*/
.sidenav {
  position: fixed;
  left: 0;
  right: 0;
  bottom:0px;
  width: 100%;
  text-align: center;
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
  justify-content: center;
  text-align: center;
  position:relative;
  margin:0 auto;
}
.sidenav-con {
  background-color: #111;
  height: 0px;
  /* overflow:hidden; */
  transition: 0.5s;
}
.cj{
  margin:0 auto;
  display: table;
  padding: 5px;

}
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
            <div class="dropzone drop-delete" style="display:none" data-action="delete">
              <span class="text-danger font-weight-normal"><i class="fa fa-trash"></i> HAPUS </span>
            </div>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
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
                <tr class="drag-elm" data-row=1>
                  <td class="col-0" data-col=0>
                    <div class="dropzone"></div>
                  </td>
                  <td class="col-1" data-col=1>
                    <div class="dropzone"></div>
                  </td>
                  <td class="col-2" data-col=2>
                    <div class="dropzone"></div>
                  </td>
                  <td class="col-3" data-col=3>
                    <div class="dropzone"></div>
                  </td>
                  <td class="col-4" data-col=4>
                    <div class="dropzone"></div>
                  </td>
                  <td class="col-5" data-col=5>
                    <div class="dropzone"></div>
                  </td>
                  <td class="col-6" data-col=6>
                    <div class="dropzone"></div>
                  </td>
                  <td class="col-7" data-col=7>
                    <div class="dropzone"></div>
                  </td>
                </tr>
                <tr class="drag-elm" data-row=2>
                  <td class="col-0" data-col=0>
                    <div class="dropzone"></div>
                  </td>
                  <td class="col-1" data-col=1>
                    <div class="dropzone"></div>
                  </td>
                  <td class="col-2" data-col=2>
                    <div class="dropzone"></div>
                  </td>
                  <td class="col-3" data-col=3>
                    <div class="dropzone"></div>
                  </td>
                  <td class="col-4" data-col=4>
                    <div class="dropzone"></div>
                  </td>
                  <td class="col-5" data-col=5>
                    <div class="dropzone"></div>
                  </td>
                  <td class="col-6" data-col=6>
                    <div class="dropzone"></div>
                  </td>
                  <td class="col-7" data-col=7>
                    <div class="dropzone"></div>
                  </td>
                </tr>
              </tbody>
            </table>

              <div class="sidenav">
                <div id="on-off" onclick="openNav()" class="">
                  <!-- <i  class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> -->
                  &#9776;
                </div>
                <div id="mySidenav" class="sidenav-con">
                  <div class="cj">
                    <table class="tabel-bottom">
                        <tr>
                          <td><div class="items-elm bg-danger text-white radius" data-id="0"><strong>Time Req</strong></div></td>
                          <td><div class="items-elm btn-info text-white radius" data-id="1"><strong>Agen</strong></div></td>
                          <td><div class="items-elm btn-success text-white radius" data-id="2"><strong>Vessel</strong></div></td>
                        </tr>
                        <tr>
                          <td><input></input></td>
                          <td><input></input></td>
                          <td><input></input></td>
                        </tr>
                    </table>
                  <div>
                </div>
              </div>
            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row">

    </div>
@endsection

@section('js')
<!-- page specific plugin scripts -->
<script src="{{ asset('js/dataTables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/interact/interact.min.js') }}"></script>
<!-- inline scripts related to this page -->
   <script type="text/javascript">
   function openNav() {
     if ($("#mySidenav").css('height')==='90px'){
       $("#mySidenav").height('0px');
     } else {
       $("#mySidenav").height('90px');
     }
   }
      jQuery(function($) {
        $(document).ready(function () {

          $('#dtBasicExample').DataTable({
            "paging"  : false,
            "ordering": false,
            "info"    : false,
            "searching": false,

            "ajax"    : {
              "url": "api/papan",
              "dataSrc": "data"
            },

            "columns": [
              { "width": "50px" },
              { "width": "50px" },
              { "width": "50px" },
              { "width": "50px" },
              { "width": "50px" },
              null
            ]
          });
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
            },
            ondragleave: function (event) {
                // remove the drop feedback style
                event.target.classList.remove('drop-target');
            },
            ondrop: function (event) {
                var $dropzone = $(event.target),
                    $box = $(event.relatedTarget),
                    markup = $box.html(),
                    classes = $box[0].classList.value;

                if ($dropzone.children().length == 0) {
                    if ($box.data('vanish') == 1) {
                        $box.remove();
                    }

                    var $new = $('<div></div>');

                    $new.addClass(classes);
                    $new.html(markup);
                    $new.attr('data-vanish', 1);
                    $new.attr('data-shift', $box.data('id'));
                    $new.attr('data-date', $dropzone.data('date'));
                    $new.attr('data-user', $dropzone.data('user'));
                    $new.css({
                        minHeight: 30,
                        display: 'flex',
                        alignItems: 'center'
                    })
                    $new.find('small').css('font-size', '10px');
                    $new.find('.shift-edit').remove();

                    // var URL = $box.data('schedule') === undefined
                    //     ? "/schedule"
                    //     : "/schedule/" + $box.data('schedule');
                    //
                    // $.post(URL, $new.data(), function (response) {
                        $new.attr('data-schedule', 1);

                        $dropzone.append($new);

                        $dropzone.css('padding', 0);
                    // })

                } else if ($dropzone.hasClass('drop-delete')) {
                    if ($box.data('vanish') == 1) {

                        $.post('/schedule/destroy/' + $box.data('schedule'), {}, function () {
                            $box.remove();
                        });
                    }
                } else {
                    event.relatedTarget.setAttribute('data-x', 0);
                    event.relatedTarget.setAttribute('data-y', 0);

                    event.relatedTarget.style.webkitTransform =
                    event.relatedTarget.style.transform =
                    'translate(0px,0px)';
                }
                // $dropzone.removeClass('dropzone');
            },
            ondropdeactivate: function (event) {
              // remove active dropzone feedback
              event.target.classList.remove('drop-active');
              event.target.classList.remove('drop-target');
            }
        });

        interact('.items-elm').draggable({
          inertia: true,
          restrict: {
            restriction: "parent",
            endOnly: true,
            elementRect: { top: 0, left: 0, bottom: 1, right: 1 }
          },
          autoScroll: true,
          // dragMoveListener from the dragging demo above
          onmove: function(event){
            var target = event.target,

            // keep the dragged position in the data-x/data-y attributes
            x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx,
            y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;


            target.style.zIndex = 9999999

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
          }
        });
      });
    </script>
@endsection
