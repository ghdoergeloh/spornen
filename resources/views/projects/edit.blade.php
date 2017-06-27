@extends('layouts.app')
@section('title')
- Projekt bearbeiten
@endsection
@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">
		{{ Form::model($sponrun, [
		'method' => 'PATCH',
		'route' => [$root_route.'project.update', implode(',', $root_route_params)],
		'class' => "form-horizontal"]) }}
		@include('projects.projectForm')
		{{ Form::close() }}
	</div>
</div>
@endsection