
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
    <div class="page-header">
        <h1>
            Timeline
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                based on widget boxes with 2 different styles
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div id="timeline-2">
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-sm-offset-1 timeline-start">
										</div>
                </div>
            </div>

            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('js')
<!-- inline scripts related to this page -->
	<script type="text/javascript">
		jQuery(function($) {
			var posdata= {'datatb':'mkurs','search':1};

			getparameter("{{url('/api/oprasional/json')}}",posdata,function(data){

				const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
				var mounth = '';
				$.map( data, function( item ) {
					date = new Date(item.date*1000);
					console.log( item.nilai );
					if (date.getMonth() !== mounth){
						$(".timeline-start").prepend('\
						<div class="timeline-container timeline-style2">\
							<span class="timeline-label">\
								<b>'+  monthNames[date.getMonth()] +' / '+ date.getFullYear() +'</b>\
							</span>\
							<div class="timeline-items" data-row="items-'+  date.getMonth() +'">\
							</div>\
						</div>' );
						mounth = date.getMonth();
					}
					$("div[data-row = 'items-"+date.getMonth()+"']").prepend('\
					<div class="timeline-item clearfix">\
							<div class="timeline-info">\
									<span class="timeline-date">'+  date.getDate() +'</span>\
									<i class="timeline-indicator btn btn-info no-hover"></i>\
							</div>\
							<div class="widget-box transparent">\
									<div class="widget-body">\
											<div class="widget-main no-padding">\
													<span class="bigger-110">\
															<a href="#" class="purple bolder">$</a>\
															'+Numbers(item.nilai)+'\
													</span>\
													<br />\
													<i class="ace-icon fa fa-hand-o-right grey bigger-125"></i>\
													<a href="#">Click to read &hellip;</a>\
											</div>\
									</div>\
							</div>\
					</div>\
					');

				});
			});
		});
	</script>
@endsection
