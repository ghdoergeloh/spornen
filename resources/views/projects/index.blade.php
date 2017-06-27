@extends('layouts.app')
@section('title')
- Projekte
@endsection
@section('content')
<div class="container">
    <div class="row">
		<div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Projekte</div>
                <div class="panel-body">
					<a class="btn btn-primary" href="{{route($root_route.'project.create') }}">Neues Project anlegen</a>
					<hr>
					<table class="table table-striped">
						<tr>
							<th>ID</th>
							<th class="hidden-xs">Projektname</th>
							<th class="hidden-xs">Projekt/Person</th>
							<th></th>
						</tr>
						@foreach ($projects as $project)
						<tr class="clickable-row">
							<td onclick="window.document.location = '{{route($root_route.'project.show', [$project->id]) }}';">{{ $project->id }}</td>
							<td class="hidden-xs">{{ $project->name }}</td>
							<td class="hidden-xs">{{ $project->scope }}</td>
							<td>
								<a class="btn btn-info hidden-xs hidden-sm"
								   href="{{route($root_route.'project.show', [$project->id]) }}"
								   data-toggle="tooltip" title="Anzeigen">
									<span class="glyphicon glyphicon-list-alt"/></a>
								<a class="btn btn-success"
								   href="{{route($root_route.'project.edit', [$project]) }}"
								   data-toggle="tooltip" title="Bearbeiten">
									<span class="glyphicon glyphicon-pencil"/></a>
							</td>
						</tr>
						@endforeach
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
