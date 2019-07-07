@extends('backend.oprasional.pdf.mpdf')
@section('content')
            <style type="text/css">
body {
/*  width: 500px;
    margin: 40px auto;
    color: #444;*/
    font-family: :"Arial", Helvetica, sans-serif !important;
    font-size: 11px;

}
    @page { margin: 110px 20px 40px 60px }
    #header { position: fixed; top: -90px; left:-10px; right: -10px; height: 80px; }
    #footer { position: fixed; left: -10px; bottom: -30px; right: -10px; height: 40px; }
    #footer .page:after { content: counter(page, normal); }

table {
    border-collapse: collapse; /* IE7 and lower */
    border-spacing: 0;
    margin-top:10px;
    width: 100%;
    margin-bottom:10px;
    max-height:50px;
    height:40px ;
    font-family :"Arial", Helvetica, sans-serif !important;
    font-size: 9px;
}



.left{
    border-left: 1px solid;
}
.right{
    border-right: 1px solid;
}
.top{
    border-top: 1px solid;
}
.button{
    border-bottom: 1px solid;
}

.zebra tr:nth-child(even) {
     background-color: #f9f9f9;
}
.zebra tr:nth-child(odd) {
     background-color: #DCDCDC;
}

.number {
    text-align:right
}

</style>



<div id="header">
    <div style="position:absolute; top:10; left:100"><b>Mau Diubah</div>

</div>
<center>Halaman dL</center>

  <div id="footer">
    <p class="page">halaman </p>
  </div>

@stop
