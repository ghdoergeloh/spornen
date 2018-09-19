@extends('layouts.app')
@section('title')
- Projekt anlegen
@endsection
@section('content')
<div class="row">
	<div class="col-md-6 offset-md-2">
		{{ Form::open([
		'url' => route('project.store')]) }}
		@include('formfields.project_id', ['required' => true])
		@include('projects.projectForm')
		{{ Form::close() }}
	</div>
</div>
@endsection