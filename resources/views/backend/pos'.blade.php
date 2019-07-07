@extends('backend.app_backend')

@section('css')
<style>
/*.headerbill{
  background: rgb(168, 199, 245);
  border: 0.5px solid white;
}
.nopadding {
  padding: 0 !important;
  margin: 0 !important;
  text-align: center;
}
.harga {
  text-align: right;
}*/
.produk{
  padding: 2px 2px 2px 2px;

  /*width:auto;
  background: rgb(97, 159, 250);*/
  /*
  display: table;
  height: 50px;

  text-align: center;*/
}
/*.produk span {
  vertical-align: middle;
  display: table-cell;
  border: 3px solid white;
  font-size: 12px;
}*/
.deskripsi{
  font-size: 9px;
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

            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-6 col-md-4" style="border: 0.5px solid black">
                  <div class="row" style="border: 0.5px solid white">
                    <div class="col-xs-1 col-sm-1 col-md-1 nopadding headerbill">No.</div>
                    <div class="col-xs-5 col-sm-6 col-md-5 nopadding headerbill">Uraian.</div>
                    <div class="col-xs-1 col-sm-1 col-md-1 nopadding headerbill">Qty</div>
                    <div class="col-xs-2 col-sm-2 col-md-2 nopadding headerbill">@harga</div>
                    <div class="col-xs-3 col-sm-2 col-md-3 nopadding headerbill">Jumlah</div>
                  </div>
                  <div class="row" style="border: 0.5px solid white">
                    <div class="col-xs-1 col-sm-1 col-md-1 nopadding ">1.</div>
                    <div class="col-xs-5 col-sm-6 col-md-5">Mi goreng</div>
                    <div class="col-xs-1 col-sm-1 col-md-1 nopadding ">5</div>
                    <div class="col-xs-2 col-sm-2 col-md-2 harga">5.000</div>
                    <div class="col-xs-3 col-sm-2 col-md-3 harga">25.000</div>
                  </div>
                  <div class="row" style="border: 0.5px solid white">
                    <div class="col-xs-1 col-sm-1 col-md-1 nopadding ">2.</div>
                    <div class="col-xs-5 col-sm-6 col-md-5">Mi goreng</div>
                    <div class="col-xs-1 col-sm-1 col-md-1 nopadding ">5</div>
                    <div class="col-xs-2 col-sm-2 col-md-2 harga">5.000</div>
                    <div class="col-xs-3 col-sm-2 col-md-3 harga">25.000</div>
                  </div>
                  <div class="row" style="border: 0.5px solid white">
                    <div class="col-xs-1 col-sm-1 col-md-1 nopadding ">3.</div>
                    <div class="col-xs-5 col-sm-6 col-md-5">Mi goreng</div>
                    <div class="col-xs-1 col-sm-1 col-md-1 nopadding ">5</div>
                    <div class="col-xs-2 col-sm-2 col-md-2 harga">5.000</div>
                    <div class="col-xs-3 col-sm-2 col-md-3 harga">25.000</div>
                  </div>
                  <div class="row" style="border: 0.5px solid white">
                    <div class="col-xs-1 col-sm-1 col-md-1 nopadding ">4.</div>
                    <div class="col-xs-5 col-sm-6 col-md-5">Mi goreng</div>
                    <div class="col-xs-1 col-sm-1 col-md-1 nopadding ">5</div>
                    <div class="col-xs-2 col-sm-2 col-md-2 harga">5.000</div>
                    <div class="col-xs-3 col-sm-2 col-md-3 harga">25.000</div>
                  </div>
                  <div class="row" style="border: 0.5px solid white">
                    <div class="col-xs-1 col-sm-1 col-md-1 nopadding ">5.</div>
                    <div class="col-xs-5 col-sm-6 col-md-5">Mi goreng</div>
                    <div class="col-xs-1 col-sm-1 col-md-1 nopadding ">5</div>
                    <div class="col-xs-2 col-sm-2 col-md-2 harga">5.000</div>
                    <div class="col-xs-3 col-sm-2 col-md-3 harga">25.000</div>
                  </div>
                  <div class="row" style="border: 0.5px solid white">
                    <div class="col-xs-1 col-sm-1 col-md-1 nopadding ">6.</div>
                    <div class="col-xs-5 col-sm-6 col-md-5">Mi goreng</div>
                    <div class="col-xs-1 col-sm-1 col-md-1 nopadding ">5</div>
                    <div class="col-xs-2 col-sm-2 col-md-2 harga">5.000</div>
                    <div class="col-xs-3 col-sm-2 col-md-3 harga">25.000</div>
                  </div>
                  <div class="row" style="border: 0.5px solid white">
                    <div class="col-xs-1 col-sm-1 col-md-1 nopadding ">7.</div>
                    <div class="col-xs-5 col-sm-6 col-md-5">Mi goreng</div>
                    <div class="col-xs-1 col-sm-1 col-md-1 nopadding ">5</div>
                    <div class="col-xs-2 col-sm-2 col-md-2 harga">5.000</div>
                    <div class="col-xs-3 col-sm-2 col-md-3 harga">25.000</div>
                  </div>
                  <div class="row" style="border: 0.5px solid white">
                    <div class="col-xs-1 col-sm-1 col-md-1 nopadding ">8.</div>
                    <div class="col-xs-5 col-sm-6 col-md-5">Mi goreng</div>
                    <div class="col-xs-1 col-sm-1 col-md-1 nopadding ">5</div>
                    <div class="col-xs-2 col-sm-2 col-md-2 harga">5.000</div>
                    <div class="col-xs-3 col-sm-2 col-md-3 harga">25.000</div>
                  </div>
                  <div class="row" style="border: 0.5px solid white">
                    <div class="col-xs-1 col-sm-1 col-md-1 nopadding ">9.</div>
                    <div class="col-xs-5 col-sm-6 col-md-5">Mi goreng</div>
                    <div class="col-xs-1 col-sm-1 col-md-1 nopadding ">5</div>
                    <div class="col-xs-2 col-sm-2 col-md-2 harga">5.000</div>
                    <div class="col-xs-3 col-sm-2 col-md-3 harga">25.000</div>
                  </div>
                  <div class="row" style="border: 0.5px solid white">
                    <div class="col-xs-1 col-sm-1 col-md-1 nopadding ">10.</div>
                    <div class="col-xs-5 col-sm-6 col-md-5">Mi goreng</div>
                    <div class="col-xs-1 col-sm-1 col-md-1 nopadding ">5</div>
                    <div class="col-xs-2 col-sm-2 col-md-2 harga">5.000</div>
                    <div class="col-xs-3 col-sm-2 col-md-3 harga">25.000</div>
                  </div>
                  <div class="row" style="border: 0.5px solid white">
                    <div class="col-xs-1 col-sm-1 col-md-1 nopadding ">-</div>
                    <div class="col-xs-8 col-sm-9 col-md-8 harga">Total Harga</div>
                    <div class="col-xs-3 col-sm-2 col-md-3 harga">25.000</div>
                  </div>
                </div>

                    <pos></pos>

              </div>
            </div>

            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('js')
<script type="text/javascript">

</script>
@endsection
