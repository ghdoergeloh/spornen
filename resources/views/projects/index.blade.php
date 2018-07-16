@extends('layouts.app')
@section('title')
- Projekte
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card mb-3">
			<div class="card-header">Projekte</div>
			<div class="card-body">
				<a class="btn btn-primary" href="{{route('project.create') }}">Neues Projekt anlegen</a>
				<hr>
				<div class="table-responsive">
					<table class="table table-striped dataTable" cellspacing="0">
						<thead>
    					<tr>
    						<th>Projekt-Nr.</th>
    						<th>Projektname</th>
    						<th>Bereich</th>
    						<th></th>
    					</tr>
    					</thead>
    					<tbody>
    					@foreach ($projects as $project)
    					<tr class="clickable-row">
    						<td onclick="window.document.location = '{{route('project.show', [$project->id]) }}';">{{ $project->id }}</td>
    						<td>{{ $project->name }}</td>
    						<td>{{ $project->scope }}</td>
    						<td class="action-cell">
    							<a class="btn btn-success"
    							   href="{{route('project.edit', [$project]) }}"
    							   data-toggle="tooltip" title="Bearbeiten">
    								<span class="fa fa-pencil"/></a>
    							<a class="btn btn-danger"
    							   href=""
    							   data-toggle="tooltip" title="Löschen "
    							   onclick="event.preventDefault();
                                               if (confirm('Das Projekt wird gelöscht.')) {
                                                   document.getElementById('delete-project-form{!! $project->id !!}').submit();
                                               }">
    								<span class="fa fa-trash"/></a>
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
    					</tbody>
    				</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
