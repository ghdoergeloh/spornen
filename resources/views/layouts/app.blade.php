<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>SponRun @yield('title')</title>
		<link rel="icon" type="image/x-icon" href="{{url('/favicon.ico')}}" />

		<!-- Fonts -->
		<link rel="stylesheet"
			  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"
			  integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+"
			  crossorigin="anonymous">
		<link rel="stylesheet"
			  href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

		<!-- Styles -->

		<link rel="stylesheet" href="{{url('/css/custom.css')}}">
		<link rel="stylesheet" href="{{url('/css/bootstrap.min.css')}}">
	</head>
	<body id="app-layout">
		@include('layouts.menu')
		@include('layouts.breadcrumbs')
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					@include('layouts.messages')
				</div>
			</div>
			<div class="content">@yield('content')</div>
		</div>

		<!-- JavaScripts -->
		<script src="{{url('/js/jquery-3.1.1.min.js')}}"
			integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
			crossorigin="anonymous"></script>
		<script src="{{url('/js/bootstrap.min.js')}}"
			integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
			crossorigin="anonymous"></script>
		<script src="{{url('/js/custom.js')}}"></script>
	</body>
</html>
