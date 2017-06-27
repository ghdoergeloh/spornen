@extends('layouts.app')
@section('title')
- Sponsor anlegen
@endsection
@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">
		@include('layouts.messages')
		{{ Form::open([
			'url' => route($root_route.'sponsor.store', $root_route_params),
			'class' => "form-horizontal"]) }}
		@include('sponsors.sponsorForm')
		{{ Form::close() }}
	</div>
</div>
@endsection
