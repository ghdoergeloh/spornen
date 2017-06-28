@extends('layouts.app')
@section('title')
- Projektliste bearbeiten
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Projekt bearbeiten</div>
			<div class="panel-body">
				{{ Form::model($projectlist, [
					'method' => 'PATCH',
					'route' => ['projectlist.update', $projectlist->id],
					'class' => "form-horizontal"]) }}
				@include('projectlists.projectlistForm')
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">Projekte in der Liste</div>
			<div class="panel-body">
				{{ Form::open([
					'method' => 'POST',
					'url' => route('projectlist.removeProjects'),
					'class' => "form-horizontal",
				]) }}
				<table class="table table-striped">
					<tr>
						<th></th>
						<th class="hidden-xs">Projekt-Nr.</th>
						<th>Projektname</th>
						<th class="hidden-xs">Bereich</th>
					</tr>
					@foreach ($projectlist->projects as $project)
					<tr>
						<td>
							<div class="checkbox">
								<label>{{ Form::checkbox('projects', $project->id) }}</label>
							</div>
						</td>
						<td class="hidden-xs">{{ $project->id }}</td>
						<td>{{ $project->name }}</td>
						<td class="hidden-xs">{{ $project->scope }}</td>
					</tr>
					@endforeach
				</table>
				{{Form::button('<i class="glyphicon glyphicon-minus"></i> Hinzufügen', ['type' => 'submit', 'class' => 'btn btn-danger'])}}
				{{ Form::close() }}
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">Weitere Projekte</div>
			<div class="panel-body">
				{{ Form::open([
					'method' => 'POST',
					'url' => route('projectlist.addProjects'),
					'class' => "form-horizontal"
				]) }}
				<table class="table table-striped">
					<tr>
						<th></th>
						<th class="hidden-xs">Projekt-Nr.</th>
						<th>Projektname</th>
						<th class="hidden-xs">Bereich</th>
					</tr>
					@foreach ($otherprojects as $project)
					<tr>
						<td>
							<div class="checkbox">
								<label>{{ Form::checkbox('projects', $project->id) }}</label>
							</div>
						</td>
						<td class="hidden-xs">{{ $project->id }}</td>
						<td>{{ $project->name }}</td>
						<td class="hidden-xs">{{ $project->scope }}</td>
					</tr>
					@endforeach
				</table>
				{{Form::button('<i class="glyphicon glyphicon-plus"></i> Hinzufügen', ['type' => 'submit', 'class' => 'btn btn-success'])}}
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>

@endsection