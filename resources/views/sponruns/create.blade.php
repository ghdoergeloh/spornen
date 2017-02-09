@extends('layouts.app')
@section('title')
- Sponsorenlauf anlegen
@endsection
@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">
		{{ Form::open([
		'route' => ['sponrun.store'],
		'class' => "form-horizontal"]) }}
		@include('sponruns.sponrunForm')
		{{ Form::close() }}
	</div>
</div>
@endsection