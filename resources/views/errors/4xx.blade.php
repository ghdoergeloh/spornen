@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card mb-3">
			@yield('error-message')
        	<div class="media col-md-6 offset-md-3">
    			<img class="img-responsive" alt="To All Nations" src="{{ url('/images/logo_4xx.jpg') }}">
        	</div>
		</div>
	</div>
</div>
@endsection