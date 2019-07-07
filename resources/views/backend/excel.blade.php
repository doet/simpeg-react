@extends('backend.app_backend')

@section('css')

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
          <input type="button" id="download" class="btn btn-sm btn-danger" value="Download">
          <br>
          1. Melalui terminal (dalam folder kerja) ketikan 'composer require box/spout', tunggu beberapa saat hingga selesai<br><br>

          <form id="fileupload" method="post" enctype="multipart/form-data" >
            {!! csrf_field() !!}
            <input type="file" name="inputfilenya" class="btn btn-sm " >
            <input type="submit" value="Upload" class="btn btn-sm btn-danger" id="upload">
          </form>

            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('js')
<script type="text/javascript">
    jQuery(function($) {
      var posdata = {_token:'{{csrf_token()}}'};
      $('#download').click( function( e ) {
        e.preventDefault();
        $.ajax( {
          type: 'POST',
          dataType: "json",
          url: "{{ url('ExcelExport') }}",
          data: posdata,
          success: function(data){
            alert(data.msg); // show response from the php script.
            window.open("{{ url('/public/files/tmp/test.xlsx') }}");
          },
          error: function(xhr, Status, err) {
              alert ('terjadi kesalahan');
          }
        });
      });

        $('#fileupload').submit( function( e ) {
            $.ajax( {
                url: "{{url('ExcelImport')}}",
                type: 'POST',
                data: new FormData( this ),
                processData: false,
                contentType: false,
                success: function(data){
                    alert(data.msg); // show response from the php script.
                    //window.open("{{ url('/public/files/tmp/data_pegawai.xlsx') }}");
                },
                error: function(xhr, Status, err) {
                    alert ('terjadi kesalahan');
                }
            });
            e.preventDefault();
        });

    });
</script>
@endsection
