@extends('layouts.app')
@section('title')
- Teilnahme bearbeiten
@endsection
@section('content')
<div class="row">
	<div class="col-md-8">
		<div class="card card-default">
			<div class="card-header">Angaben zur Teilnahme</div>
			<div class="card-body">
				{{ Form::model($runpart,[
						'method' => 'PATCH',
						'url' => route($root_route.'runpart.update', array_merge($root_route_params, [$runpart->id])),
						'class' => "form-horizontal"]) }}

				@include('formfields.projects', [ 'selectedProjectId' => is_null($runpart->project)?null:$runpart->project->id])
				@if ($runpart->sponsoredRun->with_tshirt)
				@include('formfields.tshirt_sizes', [ 'selectedSize' => $runpart->tshirtSize])
				@endif
				@if (isset($adminview) && $adminview)
				@include('formfields.laps')
				@else
				@include('formfields.share_link')
				@endif

				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						{{ Form::reset('Abbrechen', [ 'class' => "btn btn-default"]) }}
						{{ Form::submit('Speichern', [ 'class' => "btn btn-primary"]) }}
					</div>
				</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
	@unless (isset($adminview) && $adminview)
	@include('runparts.calculatePanel')
	@endif
</div>
<div class="row">
	<div class="col-md-12">
		@include('sponsors.list', ['edit' => true, 'root_route' => $root_route.'runpart.'])
	</div>
</div>
@include('sponsors.calculation_dlg')
@endsection