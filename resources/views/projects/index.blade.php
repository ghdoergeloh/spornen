@extends('layouts.app')
@section('title')
- Projekte
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Projekte</div>
			<div class="panel-body">
				<a class="btn btn-primary" href="{{route('project.create') }}">Neues Projekt anlegen</a>
				<hr>
				<table class="table table-striped">
					<tr>
						<th class="hidden-xs">Projekt-Nr.</th>
						<th>Projektname</th>
						<th class="hidden-xs">Bereich</th>
						<th></th>
					</tr>
					@foreach ($projects as $project)
					<tr class="clickable-row">
						<td onclick="window.document.location = '{{route('project.show', [$project->id]) }}';">{{ $project->id }}</td>
						<td class="hidden-xs">{{ $project->name }}</td>
						<td class="hidden-xs">{{ $project->scope }}</td>
						<td>
							<a class="btn btn-success"
							   href="{{route('project.edit', [$project]) }}"
							   data-toggle="tooltip" title="Bearbeiten">
								<span class="glyphicon glyphicon-pencil"/></a>
							<a class="btn btn-danger"
							   href=""
							   data-toggle="tooltip" title="Löschen "
							   onclick="event.preventDefault();
                                           if (confirm('Das Projekt wird gelöscht.')) {
                                               document.getElementById('delete-project-form{!! $project->id !!}').submit();
                                           }">
								<span class="glyphicon glyphicon-trash"/></a>
							{{ Form::open([
								'method' => 'DELETE',
								'url' => route('project.destroy', [$project->id]),
								'class' => "hidden",
								'id' => 'delete-project-form'.$project->id
							]) }}
							{{ Form::close() }}
						</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
