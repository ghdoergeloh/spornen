@extends('layouts.app')
@section('title')
- Teilnahme bearbeiten
@endsection
@section('content')
<div class="row">
	<div class="col-md-8">
		<div class="card mb-3">
			<div class="card-header">Angaben zur Teilnahme</div>
			<div class="card-body">
				{{ Form::model($runpart,[
						'method' => 'PATCH',
						'url' => route($root_route.'runpart.update', array_merge($root_route_params, [$runpart->id]))
				]) }}

				@include('formfields.projects', [ 'selectedProjectId' => is_null($runpart->project)?null:$runpart->project->id])
				@if ($runpart->sponsoredRun->with_tshirt)
				@include('formfields.tshirt_sizes', [ 'selectedSize' => $runpart->tshirtSize])
				@endif
				@if (isset($adminview) && $adminview)
				@include('formfields.laps')
				@else
				@include('formfields.share_link')
				@endif
				@if (isset($projects) && count($projects) > 1
					|| $runpart->sponsoredRun->with_tshirt
					|| (isset($adminview) && $adminview))
				<div class="form-group">
					{{ Form::reset('Abbrechen', [ 'class' => "btn btn-secondary"]) }}
					{{ Form::submit('Speichern', [ 'class' => "btn btn-primary"]) }}
				</div>
				@endif
				{{ Form::close() }}
				<a class="btn btn-danger"
					href="" data-toggle="tooltip" title="Abmelden"
					onclick="
								event.preventDefault();
								if (confirm('Wenn du dich abmeldest, werden alle deine Daten (z.B. deine Sponsoren) gelöscht. Du wirst jetzt vom Sponsorenlauf abgemeldet.')) {
									$('#cancel-runpart-form').submit();
								}
							">Abmelden</a>
					{{ Form::open([
						'method' => 'DELETE',
						'url' => route($root_route.'runpart.destroy', array_merge($root_route_params, [$runpart->id])),
						'class' => "hidden",
						'id' => 'cancel-runpart-form'
					]) }}
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