@extends('backend.app_backend')

@section('css')
    <!-- page specific plugin styles -->
    {!! Html::style('/css/jquery.scrollbar.css') !!}
    <style type="text/css">

        .scrollbar-macosx {
            max-height: 256px;
            height: 256px;
            overflow: auto;
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
      
      <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="content scrollbar-macosx">
                <table class="table  table-bordered table-hover">
                    <thead>
                        <tr id="header">
                        </tr>

                    </thead>

                    <tbody id="isinya">
                    </tbody>
                </table>
            </div>

            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('js')
    {!! HTML::script('/js/jquery.scrollbar.min.js') !!}

<!-- page specific plugin scripts -->
<script type="text/javascript">
    jQuery(function($) {
        $('.scrollbar-macosx').scrollbar();

        var postData = {datatb:'att',_token:'{{csrf_token()}}'};
        $.ajax({
            type: 'POST',
            url: "{{url('AttJson')}}",
            data: postData,
            beforeSend:function(){

            },
            success: function(tmp) {
                for (var i = 0, len = tmp.header.length; i < len; i++) {
                    if (i<=2){
                        $("#header").append("<th class='center'>"+ tmp.header[i]+"</th>");
                    }else{
                        $("#header").append("<th class='center'>"+ tmp.header[i]+"</th>");
                    }

                    //alert(JSON.stringify(tmp.header[i]));
                }

                for (var key in tmp.isinya){
                    $("#isinya").append("<tr id='row-"+key+"'></tr>");
                }

                for (var key in tmp.isinya){
                    for (var i = 0, len = tmp.isinya[key].length; i < len; i++) {
                        //alert(key);
                        $("#row-"+key).append("<td>"+tmp.isinya[key][i]+"</td>");
                    }
                }


                //alert(JSON.stringify(tmp));
            }
        });
        function Number(input)
        {
            return input.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
        };

    })
</script>

<!-- inline scripts related to this page -->

@endsection
