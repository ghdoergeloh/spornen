<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
    	content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Sponsorenläufe von {{ env('ORGANIZATION_NAME')}}">
    <meta name="author" content="Georg Dörgeloh">
    <title>{{ config('app.name') }} @yield('title')</title>
    
    <link rel="icon" type="image/x-icon" href="{{url('/favicon.ico')}}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>