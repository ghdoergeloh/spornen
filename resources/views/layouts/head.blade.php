<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
    	content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="SponRun, eine Anwendung für die Verwaltung von Sponsorenläufen">
    <meta name="author" content="Georg Dörgeloh">
    <title>{{ config('app.name') }} @yield('title')</title>
    
    <link rel="icon" type="image/x-icon" href="{{url('/favicon.ico')}}" />
    <!-- Bootstrap core CSS-->
    <link href="{{url('/theme/vendor/bootstrap/css/bootstrap.min.css')}}"
    	rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{url('/theme/vendor/font-awesome/css/font-awesome.min.css')}}"
    	rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="{{url('/theme/vendor/datatables/dataTables.bootstrap4.css')}}"
    	rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{url('/theme/css/sb-admin.css')}}"
    	rel="stylesheet">
    <!-- Custom styles-->
	<link href="{{url('/css/custom.css')}}"
		rel="stylesheet">
</head>