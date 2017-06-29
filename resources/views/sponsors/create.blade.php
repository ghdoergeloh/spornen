@extends('layouts.app')
@section('title')
- Sponsor anlegen
@endsection
@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">
		@if (isset($runpart))
		<p class="lead">Ich möchte Sponsor für den Läufer {{ $runpart->user->firstname }} {{ $runpart->user->lastname }} 
		sein{{ is_null( $runpart->project ) ? '.' : ', der für das Projekt "'. $runpart->project->name .'" läuft.' }}
		</p>
		@endif
		{{ Form::open([
			'url' => route($root_route.'sponsor.store', $root_route_params),
			'class' => "form-horizontal"]) }}
		@include('sponsors.sponsorForm')
		{{ Form::close() }}
	</div>
</div>
@endsection
