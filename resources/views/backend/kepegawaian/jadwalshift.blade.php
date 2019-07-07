@extends('backend.app_backend')

@section('css')
    <link href="{{ asset('/calendarscheduler/lib/fullcalendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/calendarscheduler/lib/fullcalendar.print.css') }}" rel='stylesheet' media='print' />
    <link href="{{ asset('/calendarscheduler/scheduler.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-colorpicker.min.css') }}" />
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
            Menu SDM
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Jadwal Operator
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
            <div class="col-sm-9">
                <div class="space"></div>
                <div id="calendar"></div>
            </div>

            <div class="col-sm-3">
                <div class="widget-box transparent">

                    <button id="setting" class="width-10 btn btn-sm btn-primary">
                        <i class="ace-icon fa fa-cogs"></i><span class="">Pengaturan</span>
                    </button>
                    <button id="setting" class="width-10 btn btn-sm btn-primary">
                        <i class="ace-icon fa fa-file-pdf-o"></i><span class="">Unduh</span>
                    </button>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <div id="external-events">

                                @foreach($query as $data)
                                    <!--<div class="external-event label-grey" data-class="label-grey">-->
                                    <div class="external-event" style="background-color: {{$data->warna}}" data-warna='{{$data->warna}}' data-id='{{$data->id}}' data-alias='{{$data->inisial}}' >
                                        <i class="ace-icon fa fa-arrows"></i>
                                        {{$data->nip}} | ({{$data->inisial}})   {{$data->nama}}
                                    </div>
                                @endforeach

                                <label>
                                    <input type="checkbox" class="ace ace-checkbox" id="drop-remove" />
                                    <span class="lbl"> Remove after drop</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="my-modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="smaller lighter blue no-margin">Setting</h3>
                    </div>

                    <div class="modal-body">
                        <div style="float: left; width: 50px;">Warna</div>
                        <div style="float: left; width: 300px;">Nama</div>
                        <div style="float: left; width: 50px;">Inisial</div>
                        <div>&nbsp;</div>
                    <form id="formopt">
                        @foreach($query as $data)
                        <input name="idu[{{$data->id}}]" hidden value="{{$data->id}}"></input>
                        <div style="float: left; width: 50px;">
                            <select id="simple-colorpicker-1" name="w[{{$data->id}}]" class="warna hide">
                                <option value=""></option>
                                <option value="#ac725e" <?php if ($data->warna=='#ac725e') echo 'selected';?>>#ac725e</option>
                                <option value="#d06b64" <?php if ($data->warna=='#d06b64') echo 'selected';?>>#d06b64</option>
                                <option value="#f83a22" <?php if ($data->warna=='#f83a22') echo 'selected';?>>#f83a22</option>
                                <option value="#fa573c" <?php if ($data->warna=='#fa573c') echo 'selected';?>>#fa573c</option>
                                <option value="#ff7537" <?php if ($data->warna=='#ff7537') echo 'selected';?>>#ff7537</option>
                                <option value="#ffad46" <?php if ($data->warna=='#ffad46') echo 'selected';?>>#ffad46</option>
                                <option value="#42d692" <?php if ($data->warna=='#42d692') echo 'selected';?>>#42d692</option>
                                <option value="#16a765" <?php if ($data->warna=='#16a765') echo 'selected';?>>#16a765</option>
                                <option value="#7bd148" <?php if ($data->warna=='#7bd148') echo 'selected';?>>#7bd148</option>
                                <option value="#b3dc6c" <?php if ($data->warna=='#b3dc6c') echo 'selected';?>>#b3dc6c</option>
                                <option value="#fbe983" <?php if ($data->warna=='#fbe983') echo 'selected';?>>#fbe983</option>
                                <option value="#fad165" <?php if ($data->warna=='#fad165') echo 'selected';?>>#fad165</option>
                                <option value="#92e1c0" <?php if ($data->warna=='#92e1c0') echo 'selected';?>>#92e1c0</option>
                                <option value="#9fe1e7" <?php if ($data->warna=='#9fe1e7') echo 'selected';?>>#9fe1e7</option>
                                <option value="#9fc6e7" <?php if ($data->warna=='#9fc6e7') echo 'selected';?>>#9fc6e7</option>
                                <option value="#4986e7" <?php if ($data->warna=='#4986e7') echo 'selected';?>>#4986e7</option>
                                <option value="#9a9cff" <?php if ($data->warna=='#9a9cff') echo 'selected';?>>#9a9cff</option>
                                <option value="#b99aff" <?php if ($data->warna=='#b99aff') echo 'selected';?>>#b99aff</option>
                                <option value="#c2c2c2" <?php if ($data->warna=='#c2c2c2') echo 'selected';?>>#c2c2c2</option>
                                <option value="#cabdbf" <?php if ($data->warna=='#cabdbf') echo 'selected';?>>#cabdbf</option>
                                <option value="#cca6ac" <?php if ($data->warna=='#cca6ac') echo 'selected';?>>#cca6ac</option>
                                <option value="#f691b2" <?php if ($data->warna=='#f691b2') echo 'selected';?>>#f691b2</option>
                                <option value="#cd74e6" <?php if ($data->warna=='#cd74e6') echo 'selected';?>>#cd74e6</option>
                                <option value="#a47ae2" <?php if ($data->warna=='#a47ae2') echo 'selected';?>>#a47ae2</option>

                            </select>
                        </div>
                        <div style="float: left; width: 300px;">{{$data->nip}} | {{$data->nama}} </div>
                        <div style="float: left; width: 50px;"><input name="inisial[{{$data->id}}]" size="5" value="{{$data->inisial}}"></input></div>
                        <div>&nbsp;</div><br>
                        @endforeach
                    </form>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-sm btn-pink" id="save" data-dismiss="modal">
                            <i class="ace-icon fa fa-floppy-o"></i>
                            Save
                        </button>&nbsp;
                        <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                            <i class="ace-icon fa fa-times"></i>
                            Close
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
@endsection

@section('js')
    <script src="{{ asset('/calendarscheduler/lib/moment.min.js') }}"></script>
    <script src="{{ asset('/calendarscheduler/lib/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('/calendarscheduler/scheduler.min.js') }}"></script>

    <script src="{{ asset('/js/jquery-ui.custom.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-colorpicker.min.js') }}"></script>
    <script type="text/javascript">
        $(function() { // document ready
            $('#setting').on('click',function(e){
               // $('#my-modal').modal({ backdrop: 'static', keyboard: false });
               $('#my-modal').modal('show');
            });
            $('.warna').ace_colorpicker();
            $("#save").on('click',function(e){
                $.ajax({
                   type: "POST",
                   url: "{{url('api/kepegawaian/cud')}}",
                   data: $("#formopt").serialize()+ '&datatb=' + 'jshiftopt'+ '&_token=' + '{{ csrf_token() }}'+ '&oper='+'add', // serializes the form's elements.

                   success: function(data)
                   {
                        $('#calendar').fullCalendar( 'refetchEvents' );
                        //alert(data.msg); // show response from the php script.
                   }
                });
            });


/* initialize the external events
    -----------------------------------------------------------------*/

    $('#external-events div.external-event').each(function() {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('event', {
                title: $(this).attr("data-alias"), // use the element's text as the event title
                stick: true, // maintain when user navigates (see docs on the renderEvent method)
                idu: $(this).attr("data-id"),
                color:  $(this).attr("data-warna")
            });

        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 999,
            revert: true,      // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
        });

    });

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            $('#calendar').fullCalendar({
                schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
                eventOverlap:false,
                editable: false,
                droppable: true,
                selectable: false,
                selectHelper: true,
                aspectRatio: 4.6,
                scrollTime: '00:00',
                defaultView: 'timelineMonth',
                buttonHtml: {
                  prev: '<i class="ace-icon fa fa-chevron-left"></i>',
                  next: '<i class="ace-icon fa fa-chevron-right"></i>'
                },

                header: {
                  left: 'today prev,next',
                  center: 'title',
                  right: 'timelineMonth'
                },
                resourceAreaWidth: '10%',
                resourceLabelText: 'SHIFT',
                resourceGroupField: 'group',
                resources: { // you can also specify a plain string like 'json/resources.json'
                  url:"{{url('api/kepegawaian/json')}}",
                  data: {datatb: 'jamkerjadriver',_token:'{{ csrf_token() }}'},
                  type: 'POST',
                  error: function() {
                    alert('terjadi kesalahan resorce');
                  }
                },
                events:{
                  url:"{{url('api/kepegawaian/json')}}",
                  data: {datatb: 'jshift',_token:'{{ csrf_token() }}'},
                  type: 'POST',
                  error: function() {
                    alert('terjadi kesalahan event');
                  }
                },
                drop: function(date, jsEvent, ui, resourceId) {
                  // is the "remove after drop" checkbox checked?
                  if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                  }
                },
                eventReceive: function(event) { // called when a proper external event is dropped
                  console.log('eventReceive', event);

                  var postData = {datatb:'jadwalshift',jwaktu:event.resourceId,waktu:Date.parse(event.start._d)-(7*60*60*1000),petugas:event.idu,_token:'{{ csrf_token() }}', oper:'add' };
                  $.ajax({
                    type: 'POST',
                    url: "{{url('api/kepegawaian/cud')}}",
                    data: postData,
                    success: function(msg) {
                      if(msg.status == 'berhasil'){
                      //lert (msg.msg);
                      } else {
                      //alert (msg.msg);
                      }

                      //$('#calendar').fullCalendar('rerenderEvents' );
                      $('#calendar').fullCalendar('removeEvents');
                      $('#calendar').fullCalendar( 'refetchEvents' );
                    }
                  });
                },
                eventDrop: function(event, delta, revertFunc) {
                  console.log('eventReceive', event);
                },
                eventClick: function(calEvent, jsEvent, view) {
                  console.log('eventReceive',calEvent);
                  //display a modal
                  var modal =
                  '<div class="modal fade">\
                    <div class="modal-dialog">\
                     <div class="modal-content">\
                       <div class="modal-body">\
                         <button type="button" class="close" data-dismiss="modal" style="margin-top:-10px;">&times;</button>\
                         \
                           <label>Hapus jadwal shift '+ calEvent.title +' <br> tanggal '+calEvent._start._i+'</label>\
                         \
                       </div>\
                       <div class="modal-footer">\
                          <button type="button" class="btn btn-sm btn-danger" data-action="delete"><i class="ace-icon fa fa-trash-o"></i> Delete Event</button>\
                          <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancel</button>\
                       </div>\
                    </div>\
                   </div>\
                  </div>';


                  var modal = $(modal).appendTo('body');
                  modal.find('button[data-action=delete]').on('click', function() {

                    var postData = {datatb:'jadwalshift',id:calEvent.id,_token:'{{ csrf_token() }}', oper:'del' };
                    $.ajax({
                      type: 'POST',
                      url: "{{url('api/kepegawaian/cud')}}",
                      data: postData,
                      success: function(msg) {
                        if(msg.status == 'berhasil'){
                        //lert (msg.msg);
                        } else {
                        //lert (msg.msg);
                        }
                        $('#calendar').fullCalendar( 'refetchEvents' );
                      }
                    });
                    modal.modal("hide");
                  });

                  modal.modal('show').on('hidden', function(){
                      modal.remove();
                  });


                  //console.log(calEvent.id);
                  //console.log(jsEvent);
                  //console.log(view);

                  // change the border color just for fun
                  //$(this).css('border-color', 'red');

                },
            });
        });

    </script>
@endsection
