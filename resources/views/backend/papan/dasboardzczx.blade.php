<?php date_default_timezone_set('Asia/Jakarta')?>
@extends('backend.app_backend')

@section('css')
<link href="{{ asset('css/datatables/jquery.dataTables.css') }}" rel="stylesheet">

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
            <table class="table table-bordered table-striped mt-3 vertical-middle">
                <thead>
                    <tr>
                        <th>
                            <div class="dropzone drop-delete" data-action="delete">
                                <span class="text-danger font-weight-normal">
                                    <i class="fa fa-trash"></i> HAPUS
                                </span>
                            </div>
                        </th>
                        <th class="nowrap px-2"><h6 class="m-0 font-weight-bold">Sen</h6></th>
                        <th class="nowrap px-2"><h6 class="m-0 font-weight-bold">Sel</h6></th>
                        <th class="nowrap px-2"><h6 class="m-0 font-weight-bold">Rab</h6></th>
                        <th class="nowrap px-2"><h6 class="m-0 font-weight-bold">Kam</h6></th>
                        <th class="nowrap px-2"><h6 class="m-0 font-weight-bold">Jum</h6></th>
                        <th class="nowrap px-2"><h6 class="m-0 font-weight-bold">Sab</h6></th>
                        <th class="nowrap px-2"><h6 class="m-0 font-weight-bold">Min</h6></th>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <td style="height: 90px">Hambali B. H. Ahmad</td>
                    <td class=" p-1" width="90">
                      <div class="dropzone" data-date="2019-01-28" data-user="28">
                        <div class="shift-box btn-danger p-2 mb-2 text-white radius d-flex align-items-center" style="min-height: 80px" data-schedule="2019" data-date="2019-01-28" data-user="" data-shift="" data-vanish="1">
                          <div><strong>Hari Libur</strong></div>
                        </div>
                      </div>
                    </td>
                    <td class=" p-1" width="90">
                      <div class="dropzone" data-date="2019-01-29" data-user="28">
                        <div class="shift-box btn-danger p-2 mb-2 text-white radius d-flex align-items-center" style="min-height: 80px" data-schedule="2020" data-date="2019-01-29" data-user="" data-shift="" data-vanish="1">
                          <div><strong>Hari Libur</strong></div>
                        </div>
                      </div>
                    </td>
                    <td class=" p-1" width="90">
                      <div class="dropzone" data-date="2019-01-30" data-user="28">
                        <div class="shift-box btn-info p-2 mb-2 text-white radius d-flex align-items-center" style="min-height: 80px" data-schedule="2021" data-date="2019-01-30" data-user="" data-shift="1" data-vanish="1">
                          <div>
                            <strong>Shift I</strong>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="grey-100 p-1" width="90">
                      <div class="dropzone" data-date="2019-01-31" data-user="28">
                        <div class="shift-box btn-info p-2 mb-2 text-white radius d-flex align-items-center" style="min-height: 80px" data-schedule="2041" data-date="2019-01-31" data-user="" data-shift="1" data-vanish="1">
                          <div>
                            <strong>Shift I</strong>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class=" p-1" width="90">
                      <div class="dropzone" data-date="2019-02-01" data-user="28"></div>
                    </td>
                    <td class=" p-1" width="90">
                      <div class="dropzone" data-date="2019-02-02" data-user="28"></div>
                    </td>
                    <td class=" p-1" width="90">
                      <div class="dropzone" data-date="2019-02-03" data-user="28"></div>
                    </td>
                  </tr>
                </tbody>
            </table>

          <div class="col-md-3">
              <h5 class="mb-4">
                  Daftar Shift
              </h5>
              <div class="card bg-faded mt-3">
                  <div class="card-body">
                    <div class="shift-box bg-danger p-2 mb-2 text-white radius" data-id="0">
                        <strong>Hari Libur</strong>
                    </div>

                    <div class="shift-box btn-info p-2 mb-2 text-white radius d-flex justify-content-between" data-id="1">
                      <div>
                        <strong>Shift I</strong><br>
                        <small>00:00 - 08:00 | 0m</small>
                      </div>
                      <div class="shift-edit align-self-center">
                        <button data-modal-load="http://pcm-sdm.ndt-dev.com/shift/edit/1" data-modal-title="Edit Shift" class="btn no-link text-white p-0 fz-25">
                          <i class="fa fa-edit"></i>
                        </button>
                      </div>
                    </div>
                    <div class="shift-box btn-success p-2 mb-2 text-white radius d-flex justify-content-between" data-id="2">
                      <div>
                        <strong>Shift II</strong><br>
                        <small>08:00 - 16:00 | 0m</small>
                      </div>
                      <div class="shift-edit align-self-center">
                        <button data-modal-load="http://pcm-sdm.ndt-dev.com/shift/edit/2" data-modal-title="Edit Shift" class="btn no-link text-white p-0 fz-25">
                          <i class="fa fa-edit"></i>
                        </button>
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
<script src="{{ asset('js/dataTables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/interact/interact.min.js') }}"></script>
<!-- inline scripts related to this page -->
<script type="text/javascript">
  jQuery(function($) {
    interact('.dropzone').dropzone({
        accept: '.shift-box',
        overlap: 'pointer',
        ondropactivate: function (event) {
            // add active dropzone feedback
            event.target.classList.add('drop-active');
        },
        ondragenter: function (event) {
            var draggableElement = event.relatedTarget,
            dropzoneElement = event.target;

            // feedback the possibility of a drop
            dropzoneElement.classList.add('drop-target');
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
                    minHeight: 80,
                    display: 'flex',
                    alignItems: 'center'
                })
                $new.find('small').css('font-size', '10px');
                $new.find('.shift-edit').remove();

                var URL = $box.data('schedule') === undefined
                    ? "/schedule"
                    : "/schedule/" + $box.data('schedule');

                $.post(URL, $new.data(), function (response) {
                    $new.attr('data-schedule', response.id);

                    $dropzone.append($new);

                    $dropzone.css('padding', 0);
                })

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

    interact('.shift-box').draggable({
        autoScroll: true,
        onmove: dragMoveListener,
        onend: function (event) {
            var target = event.target;

            target.setAttribute('data-x', 0);
            target.setAttribute('data-y', 0);

            target.style.webkitTransform =
            target.style.transform =
            'translate(0px,0px)';
        }
    });

    function dragMoveListener(event) {
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
    }

    $('.btn-all').on('click', function () {
        var self = $(this),
            all = self.data('all'),
            $select = self.closest('.card').find('select');

        if (all) {
            $select.find('option').removeAttr('selected');
            self.data('all', 0);
            self.find('i').addClass('fa-plus-square').removeClass('fa-check-square');
        } else {
            $select.find('option').prop('selected', 'selected');
            self.data('all', 1);
            self.find('i').removeClass('fa-plus-square').addClass('fa-check-square');
        }

        $select.trigger('change');
    })

    $(document).on('change', '[name="has_tolerance"]', function () {
        var self = $(this),
            $checkbox = self.closest('.form-group').find('.has-tolerance'),
            $collapse = self.closest('.form-group').find('.collapse');

        if ($checkbox.is(':checked')) {
            $collapse.collapse('show');
        } else {
            $collapse.collapse('hide');
        }
    })

    $(document).on('click', '.btn-delete-shift', function () {
        var self = $(this),
            URL = self.data('url');

        if (confirm('Anda yakin akan menghapus shift ini?')) {
            $.post(URL, {}, function () {
                location.reload();
            })
        }
    })
  });
</script>
@endsection
