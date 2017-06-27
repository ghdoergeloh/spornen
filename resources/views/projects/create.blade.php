@extends('layouts.app')
@section('title')
- Projekt anlegen
@endsection
@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">
		{{ Form::open([
		'url' => route('project.store'),
		'class' => "form-horizontal"]) }}
		@include('formfields.id', ['required' => true])
		@include('projects.projectForm')
		{{ Form::close() }}
	</div>
</div>
@endsection