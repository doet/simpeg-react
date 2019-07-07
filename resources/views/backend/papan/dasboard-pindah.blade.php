<?php date_default_timezone_set('Asia/Jakarta')?>
@extends('backend.app_backend')

@section('css')
<link href="{{ asset('css/datatables/jquery.dataTables.css') }}" rel="stylesheet">

<style>
  table.tabel-bottom td {
    border: 1px solid black;
    padding: 5px;
    text-align: center;
    border-style: dashed;
  }
  .div-bottom {
    position: fixed;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    height: 100px;
    text-align: center;
    background-color: rgba(0, 150, 0, .8);
    display: flex;
    justify-content: center;
    padding: 10px;
    z-index: 9999;
  }
  .items-elm {
    /* height: 80px; */
    width: 80px;
    line-height: 30px;
    border-radius: 10px;
    text-align: center;
    vertical-align: middle;
    /* margin: 0px 5px 0px 5px; */
  }
  div.items-active {
    border-color: #FFF;
    border-style: solid;
    border-width: 5px;
    box-shadow: 0px 0px 5px #aaaaaa;
  }
  div.dropzone {
    margin: auto;
    width:84px;
    height:34px;
    border-style: dashed;
    border-width: 2px;
    transition: background-color 0.3s;
    border-radius: 10px;
  }
  /* hapus
  .shift-box {
    height: 80px;
    border-style: dashed;
    border-width: 2px;
    transition: background-color 0.3s;
    border-radius: 10px;
  } */



  /*
  .dropzone {
    height: 80px;
    border-style: dashed;
    border-width: 2px;
    transition: background-color 0.3s;
    border-radius: 10px;
  }
  */
  /*
  .drop-delete {
    height: 30px;
    text-align: center;
    font-size: 20px;
  }
  */
  /*
  .drop-delete > span {
    display: none;
  }
  */

  div.drop-active {
    border-color: #29e;
    box-shadow: 0px 0px 1px #aaaaaa;
  }

  /*
  .drop-active.drop-delete {
    border-color: red;
    height: 50px;
    padding-top: 10px;
  }
  */
  /*
  .drop-active.drop-delete > span {
    display: block;
  }
  */

  .drop-target {
    background-color: #29e;
    border-color: blue !important;
    border-style: solid;
  }

  /*
  .drop-target.drop-delete {
    background-color: red;
    border-color: red !important;
    color: white !important;
    border-style: solid;
  }
  */
  /*
  .drag-drop {
    display: inline-block;
    min-width: 40px;
    padding: 2em 0.5em;

    color: #fff;
    background-color: #29e;
    border: solid 2px #fff;

    -webkit-transform: translate(0px, 0px);
    transform: translate(0px, 0px);

    transition: background-color 0.3s;
  }
  */
  /*
  .drag-drop.can-drop {
    color: #000;
    background-color: #4e4;
  }
  */
  #on-off {
    /* Safari 3-4, iOS 1-3.2, Android 1.6- */
    -webkit-border-radius: 12px;

    /* Firefox 1-3.6 */
    -moz-border-radius: 12px;

    /* Opera 10.5, IE 9, Safari 5, Chrome, Firefox 4, iOS 4, Android 2.1+ */
    border-radius: 10px 10px 0px 0px;

    background-color: #111;
    width: 30px;
    line-height: 30px;
    justify-content: center;
    text-align: center;
  }
  .sidenav {
    position: fixed;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    height: 35px;
    text-align: center;
    /* background-color: #111; */
    display: flex;
    justify-content: center;
    padding: 10px;
    z-index: 9999;
    transition: 0.5s;
    overflow-x: hidden;

    /* height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    right: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px; */
  }

  .sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
  }

  .sidenav a:hover {
    color: #f1f1f1;
  }

  .sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
  }

  @media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
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
      <!-- <div id="top-menu" class="modal aside" data-fixed="true" data-placement="top" data-background="true" data-backdrop="invisible" tabindex="-1">
          <div class="modal-dialog">
              <div>
                  <div class="modal-body container">
                      <div class="row">

                        <div class="items-elm bg-danger text-white radius" data-id="0"><strong>Time Req</strong></div>
                        <div class="items-elm btn-info text-white radius" data-id="1"><strong>Agen</strong></div>
                        <div class="items-elm btn-success text-white radius" data-id="2"><strong>Vessel</strong></div>

                      </div>
                  </div>
              </div><!

              <button class="btn btn-inverse btn-app btn-xs ace-settings-btn aside-trigger" data-target="#top-menu" data-toggle="modal" type="button">
                  <i data-icon1="fa-chevron-down" data-icon2="fa-chevron-up" class="ace-icon fa fa-chevron-down bigger-110 icon-only"></i>
              </button>
          </div>
      </div> -->


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
        <diV class="row div-bottom">
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
        </div>

        <div id="mySidenav" class="sidenav">
          <div id="on-off">
            <i  class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
          </div>
          <div class="closebtn" onclick="closeNav()">&times;</div>
          <a href="#">About</a>
          <a href="#">Services</a>
          <a href="#">Clients</a>
          <a href="#">Contact</a>
        </div>

        <div onclick="openNav()">&#9776; open</div>
      <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
  </div><!-- /.row -->

@endsection

@section('js')
<!-- page specific plugin scripts -->
<script src="{{ asset('js/dataTables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/interact/interact.min.js') }}"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
  function openNav() {
    $("#mySidenav").height('250px');
  }

  function closeNav() {
    $("#mySidenav").height('0px');
  }

  jQuery(function($) {
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

    var startPos = {x: 0, y: 0};
    interact('.items-elm').draggable({
        autoScroll: true,
        onmove: function (event) {
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
