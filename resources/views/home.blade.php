@extends('layouts.app')
@section('title')
- Home
@endsection
@section('content')
<div class="container">
    <div class="row">
		@include('layouts.messages')
		<div class="col-md-4">
			<img class="img-responsive" alt="To All Nations" src="{{ url('/images/logo.jpg') }}">
		</div>
		<div class="col-md-6 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Hallo {{ Auth::user()->firstname }} </div>

                <div class="panel-body">
                    <b>Herzlich Willkommen!</b> Schön, dass du am Sponsorenlauf teilnimmst.
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Die Nächsten Sponsorenläufe</div>

                <div class="panel-body">
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
								{{ Form::submit('Teilnehmen', [ 'class' => "btn btn-default"]) }}
								{{ Form::close() }}
								@else
								<a class="btn btn-default" href="{{ route('runpart.edit',
											$sponrun->runParticipations
											->filter(function($runpart) {
												return $runpart->user == Auth::user();
											})->first()->id) }}">Meine Sponsoren</a>
								@endif
							</td>
						</tr>
						@endforeach
					</table>
					@if ( $sponruns->isEmpty() )
					<p>Es gibt noch keine neuen Sponsorenläufe</p>
					@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
