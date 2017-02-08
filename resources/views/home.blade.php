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
                <div class="panel-heading">Hallo {{ $user->firstname }} </div>

                <div class="panel-body">
                    <b>Herzlich Willkommen!</b> Schön, dass du am Sponsorenlauf teilnimmst.
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Die Nächsten Sponsorenläufe</div>

                <div class="panel-body">
					<table class="table table-striped">
						<tr>
							<th>Datum</th>
							<th>Name</th>
							<th>Teilnehmer</th>
							<th></th>
						</tr>
						@foreach ($runs as $run)
						<tr>
							<td>{{ $run->begin->format('d.m.Y') }}</td>
							<td>{{ $run->name }}</td>
							<td>{{ $run->participants->count() }}</td>
							<td>
								@if ( !$run->participants->contains($user) )
								{{ Form::open(['route' => 'runpart.store']) }}
								{{ Form::hidden('run_id', $run->id) }}
								{{ Form::submit('Teilnehmen', [ 'class' => "btn btn-default"]) }}
								{{ Form::close() }}
								@else
								<a class="btn btn-default" href="{{route('runpart.show', $run->id) }}">Meine Sponsoren</a>
								@endif
							</td>
						</tr>
						@endforeach
					</table>
					@if ( $runs->isEmpty() )
					<p>Es gibt noch keine neuen Sponsorenläufe</p>
					@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
