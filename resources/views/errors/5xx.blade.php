@extends('layouts.app')
@section('content')
<div class="row">            
	<div class="col-md-4">
		<img class="img-responsive" alt="To All Nations" src="{{ url('/images/logo_5xx.jpg') }}">
	</div>
	<div class="col-md-6 col-md-offset-1">
		<div class="card card-default">
			@yield('error-message')
		</div>
	</div>
</div>
@endsection