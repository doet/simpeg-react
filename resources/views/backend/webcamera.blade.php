@extends('backend.app_backend')

@section('css')
<link href="{{ asset('') }}" rel="stylesheet">

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
            <h1>Aktivkan Camera dan Audio</h1>
            <div class="select">
              <label for="audioSource">Audio source: </label><select id="audioSource"></select>
            </div>

            <div class="select">
              <label for="videoSource">Video source: </label><select id="videoSource"></select>
            </div>

            <video muted autoplay width="320px" height="240px"></video>
            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('js')

<script type="text/javascript">

'use strict';

var videoElement = document.querySelector('video');
var audioSelect = document.querySelector('select#audioSource');
var videoSelect = document.querySelector('select#videoSource');

navigator.mediaDevices.enumerateDevices()
  .then(gotDevices).then(getStream).catch(handleError);

audioSelect.onchange = getStream;
videoSelect.onchange = getStream;

function gotDevices(deviceInfos) {
  for (var i = 0; i !== deviceInfos.length; ++i) {
    var deviceInfo = deviceInfos[i];
    var option = document.createElement('option');
    option.value = deviceInfo.deviceId;
    if (deviceInfo.kind === 'audioinput') {
      option.text = deviceInfo.label ||
        'microphone ' + (audioSelect.length + 1);
      audioSelect.appendChild(option);
    } else if (deviceInfo.kind === 'videoinput') {
      option.text = deviceInfo.label || 'camera ' +
        (videoSelect.length + 1);
      videoSelect.appendChild(option);
      // alert(JSON.stringify(videoSelect.length));
    } else {
      console.log('Found ome other kind of source/device: ', deviceInfo);
    }
  }
}

  function getStream() {
    if (window.stream) {
      window.stream.getTracks().forEach(function(track) {
        track.stop();
      });
    }

    var constraints = {
      audio: {
        optional: [{
          sourceId: audioSelect.value
        }]
      },
      video: {
        optional: [{
          sourceId: videoSelect.value
        }]
      }
    };

    navigator.mediaDevices
      .getUserMedia(constraints)
      .then(gotStream)
      .catch(handleError);
  }

  function gotStream(stream) {
    window.stream = stream; // make stream available to console
    videoElement.srcObject = stream;
  }

  function handleError(error) {
    console.log('Error: ', error);
  }

</script>
@endsection
