@extends('layouts.app')
@section('title')
- Projekt bearbeiten
@endsection
@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">
		{{ Form::model($project, [
		'method' => 'PATCH',
		'route' => ['project.update', $project->id],
		'class' => "form-horizontal"]) }}
		@include('formfields.project_id_disabled')
		@include('projects.projectForm')
		{{ Form::close() }}
	</div>
</div>
@endsection