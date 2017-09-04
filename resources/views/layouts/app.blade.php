<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>SponRun @yield('title')</title>
		<link rel="icon" type="image/x-icon" href="{{url('/favicon.ico')}}" />

		<!-- Styles -->
		<link rel="stylesheet" href="{{url('/css/custom.css')}}">
		<link rel="stylesheet" href="{{url('/css/app.css')}}">
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
		<script src="{{url('/js/app.js')}}"></script>
		<script src="{{url('/js/custom.js')}}"></script>
	</body>
</html>
