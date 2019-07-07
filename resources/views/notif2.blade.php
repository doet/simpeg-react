<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Blank Page - Ace Admin</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{asset('font-awesome/4.5.0/css/font-awesome.min.css')}}" />

		<!-- page specific plugin styles -->
		@yield('css')

		<!-- text fonts -->
		<link rel="stylesheet" href="{{asset('css/fonts.googleapis.com.css')}}" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{{asset('css/ace.min.css')}}" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="{{asset('css/ace-part2.min.css')}}" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="{{asset('css/ace-skins.min.css')}}" />
		<link rel="stylesheet" href="{{asset('css/ace-rtl.min.css')}}" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="{{asset('css/ace-ie.min.css')}}" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="{{asset('js/ace-extra.min.js')}}"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="{{asset('js/html5shiv.min.js')}}"></script>
		<script src="{{asset('js/respond.min.js')}}"></script>
		<![endif]-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">
    <script src="http://localhost:6001/socket.io/socket.io.js"></script>
	</head>


</head>
<body>
    <div id="app">
      <p class="lead">This is a simple notif2.</p>
    </div>
    <div id="notif2"></div>
    <script src="{{ asset('/js/app.js')}}"></script>

    <!-- basic scripts -->

    <!--[if !IE]> -->
    <script src="{{asset('js/jquery-2.1.4.min.js')}}"></script>
    <script src="{{asset('/js/alpa-app.js')}}"></script>

    <!-- <![endif]-->

    <!--[if IE]>
<script src="{{asset('js/jquery-1.11.3.min.js')}}"></script>
<![endif]-->
    <script type="text/javascript">
      mobile = "{{ asset('js/jquery.mobile.custom.min.js') }}";
      if('ontouchstart' in document.documentElement) document.write("<script src='"+mobile+"'>"+"<"+"/script>");
    </script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>


    <!-- ace scripts -->
    <script src="{{asset('js/ace-elements.min')}}.js"></script>
    <script src="{{asset('js/ace.min.js')}}"></script>

</body>
</html>
