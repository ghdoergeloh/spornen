@extends('layouts.app')
@section('title')
- Projekt bearbeiten
@endsection
@section('content')
<div class="row">
	<div class="col-md-6 offset-md-2">
		{{ Form::model($project, [
		'method' => 'PATCH',
		'route' => ['project.update', $project->id]]) }}
		@include('formfields.project_id_disabled')
		@include('projects.projectForm')
		{{ Form::close() }}
	</div>
</div>
@endsection