@extends('layouts.app')
@section('title')
- Projekt anlegen
@endsection
@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">
		{{ Form::open([
		'url' => route($root_route.'project.store', $root_route_params),
		'class' => "form-horizontal"]) }}
		@include('projects.projectForm')
		{{ Form::close() }}
	</div>
</div>
@endsection