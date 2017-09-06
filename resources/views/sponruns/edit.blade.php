@extends('layouts.app')
@section('title')
- Sponsorenlauf bearbeiten
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card card-default">
			<div class="card-header">Sponsorenlauf bearbeiten</div>
			<div class="card-body">
		{{ Form::model($sponrun, [
		'method' => 'PATCH',
		'route' => [$root_route.'sponrun.update', implode(',', $root_route_params)],
		'class' => "form-horizontal"]) }}
		@include('sponruns.sponrunForm')
		{{ Form::close() }}
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="card card-default">
			<div class="card-header">Unterstützte Projektlisten vom Sponsorenlauf</div>
			<div class="card-body">
				{{ Form::open([
					'method' => 'PATCH',
					'route' => ['sponrun.removeProjectlists', $sponrun->id],
					'class' => "form-horizontal",
				]) }}
				<table class="table table-striped">
					<tr>
						<th></th>
						<th>Projektlistenname</th>
					</tr>
					@foreach ($sponrun->projectlists as $projectlist)
					<tr>
						<td>
							{{ Form::checkbox('projectlists[]', $projectlist->id) }}
						</td>
						<td>{{ $projectlist->name }}</td>
					</tr>
					@endforeach
				</table>
				{{Form::button('<i class="glyphicon glyphicon-minus"></i> Entfernen', ['type' => 'submit', 'class' => 'btn btn-danger'])}}
				{{ Form::close() }}
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card card-default">
			<div class="card-header">Weitere Projektlisten</div>
			<div class="card-body">
				{{ Form::open([
					'method' => 'PATCH',
					'route' => ['sponrun.addProjectlists', $sponrun->id],
					'class' => "form-horizontal"
				]) }}
				<table class="table table-striped">
					<tr>
						<th></th>
						<th>Projektlistenname</th>
					</tr>
					@foreach ($otherprojectlists as $projectlist)
					<tr>
						<td>
							{{ Form::checkbox('projectlists[]', $projectlist->id) }}
						</td>
						<td>{{ $projectlist->name }}</td>
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