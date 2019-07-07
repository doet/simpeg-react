<?php date_default_timezone_set('Asia/Jakarta')?>
@extends('backend.app_backend')

@section('css')
<link href="{{ asset('css/datatables/jquery.dataTables.css') }}" rel="stylesheet">
<style>
<style>
.dropzone {
    border: dashed 1px transparent;
    transition: background-color 0.3s;
    border-radius: 4px;
    height: 80px;
}

.drop-delete {
  height: 30px;
  text-align: center;
  font-size: 20px;
}

.drop-delete > span {
  display: none;
}

.drop-active {
    border-color: #29e;
}

.drop-active.drop-delete {
  border-color: red;
  height: 50px;
  padding-top: 10px;
}

.drop-active.drop-delete > span {
  display: block;
}

.drop-target {
    background-color: #29e;
    border-color: blue !important;
    border-style: solid;
}

.drop-target.drop-delete {
  background-color: red;
    border-color: red !important;
    color: white !important;
    border-style: solid;
}

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

.drag-drop.can-drop {
    color: #000;
    background-color: #4e4;
}

  #footer {
      position: fixed;
      bottom: 0;
      width: 94%;
      background-color:white;
  }
  div#footer {
    /* width: 284px; */
    padding: 10px 10px 20px 10px;
    border: 1px solid #BFBFBF;
    background-color: white;
    box-shadow: 0px -5px 20px #aaaaaa;
  }

  .c1 {
      background-color:red;
      display: inline-block;
      min-width: 40px;
  }

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

  #inner-dropzone {
    height: 80px;
  }
  .dropzone {
    background-color: #ccc;
    border: dashed 4px transparent;
    border-radius: 4px;
    margin: 10px auto 30px;
    padding: 10px;
    width: 80%;
    transition: background-color 0.3s;
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
<div id="inner-dropzone" class="dropzone">#inner-dropzone</div>
            <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th class="th-sm">Name
                  </th>
                  <th class="th-sm">Position
                  </th>
                  <th class="th-sm">Office
                  </th>
                  <th class="th-sm">Age
                  </th>
                  <th class="th-sm">Start date
                  </th>
                  <th class="th-sm">Salary
                  </th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <div id="footer">
              <div class="c1">
                <div id="yes-drop" class="drag-drop"> #yes-drop </div>
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

        // enable draggables to be dropped into this
        interact('.dropzone').dropzone({
          // only accept elements matching this CSS selector
          accept: '#yes-drop',
          // Require a 75% element overlap for a drop to be possible
          overlap: 0.75,

          // listen for drop related events:

          ondropactivate: function (event) {
            // add active dropzone feedback
            event.target.classList.add('drop-active');
          },
          ondragenter: function (event) {
            var draggableElement = event.relatedTarget,
                dropzoneElement = event.target;

            // feedback the possibility of a drop
            dropzoneElement.classList.add('drop-target');
            draggableElement.classList.add('can-drop');
            draggableElement.textContent = 'Dragged in';
          },
          ondragleave: function (event) {
            // remove the drop feedback style
            event.target.classList.remove('drop-target');
            event.relatedTarget.classList.remove('can-drop');
            event.relatedTarget.textContent = 'Dragged out';
          },
          ondrop: function (event) {
            event.relatedTarget.textContent = 'Dropped';
          },
          ondropdeactivate: function (event) {
            // remove active dropzone feedback
            event.target.classList.remove('drop-active');
            event.target.classList.remove('drop-target');
          }
        });

        interact('.drag-drop').draggable({
          inertia: true,
          restrict: {
            restriction: "parent",
            endOnly: true,
            elementRect: { top: 0, left: 0, bottom: 1, right: 1 }
          },
          autoScroll: true,
          // dragMoveListener from the dragging demo above
          onmove: dragMoveListener,
        });

        function dragMoveListener(event) {

          var target = event.target,

          // keep the dragged position in the data-x/data-y attributes
          x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx,
          y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;
          console.log(event.target);

          target.style.zIndex = 9999999

          // translate the element
          target.style.webkitTransform =
          target.style.transform =
          'translate(' + x + 'px, ' + y + 'px)';

          // update the position attributes
          target.setAttribute('data-x', x);
          target.setAttribute('data-y', y);
        }
      });
    </script>
@endsection
