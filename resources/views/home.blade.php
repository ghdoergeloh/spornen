@extends('layouts.app')
@section('title')
- Home
@endsection
@section('content')
<div class="row">
	<div class="media col-md-4">
		<img class="img-responsive" alt="To All Nations" src="{{ url('/images/logo.jpg') }}">
	</div>
	<div class="col-md-8">
		<div class="card mb-3">
			<div class="card-header">Hallo {{ Auth::user()->firstname }} </div>

			<div class="card-body">
				<b>Herzlich Willkommen!</b> Schön, dass du am Sponsorenlauf teilnimmst.
			</div>
		</div>

		<div class="card mb-3">
			<div class="card-header">Die Nächsten Sponsorenläufe</div>

			<div class="card-body">
				<div class="table-responsive">
    				<table class="table table-striped">
    					<tr>
    						<th class="hidden-xs">Datum</th>
    						<th>Name</th>
    						<th class="visible-lg">Teilnehmer</th>
    						<th></th>
    					</tr>
    					@foreach ($sponruns as $sponrun)
    					<tr>
    						<td class="hidden-xs">{{ $sponrun->begin->format('d.m.Y') }}</td>
    						<td>{{ $sponrun->name }}</td>
    						<td class="visible-lg">{{ $sponrun->participants_count }}</td>
    						<td>
    							@if ( !$sponrun->participants->contains(Auth::user()) )
    							{{ Form::open(['route' => 'runpart.store']) }}
    							{{ Form::hidden('run_id', $sponrun->id) }}
    							{{ Form::submit('Teilnehmen', [ 'class' => "btn btn-secondary btn-block"]) }}
    							{{ Form::close() }}
    							@else
    							<a class="btn btn-primary btn-block" href="{{ route('runpart.edit',
    											$sponrun->runParticipations
    											->filter(function($runpart) {
    												return $runpart->user == Auth::user();
    											})->first()->id) }}">Meine Sponsoren</a>
    							@endif
    						</td>
    					</tr>
    					@endforeach
    				</table>
				</div>
				@if ( $sponruns->isEmpty() )
				<p>Es gibt noch keine neuen Sponsorenläufe</p>
				@endif
			</div>
		</div>
	</div>
</div>
@if ( config('app.newsletter_optional') && is_null(Auth::user()->wants_newsletter) )
	@include('general_dialogs.newsletter_dlg')
@endif
@endsection
