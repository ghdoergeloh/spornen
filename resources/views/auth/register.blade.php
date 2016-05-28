@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">            
	<div class="col-md-4">
		<img class="img-responsive" alt="To All Nations" src="../images/tan_900.jpg">
	</div>
		<div class="col-md-6 col-md-offset-1">
		@include('auth.registerPanel')
        </div>
    </div>
</div>
@endsection
