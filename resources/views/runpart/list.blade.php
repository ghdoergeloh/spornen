@extends('layouts.app')
@section('title')
- Teilnahmen
@endsection
@section('content')
<div class="container">
    <div class="row">
		<div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Meine Sponsoren</div>
                <div class="panel-body">
					<table class="table table-striped">
						<tr>
							<th>Datum</th>
							<th>Name</th>
							<th>Gelaufene Runden</th>
							<th>Sponsoren</th>
						</tr>
						@foreach ($runparts as $runpart)
						<tr>
							<td>{{ $runpart->sponsoredRun->begin->format('d.m.Y') }}</td>
							<td>{{ $runpart->sponsoredRun->name }}</td>
							<td>{{ $runpart->laps }}</td>
							<td><a class="btn btn-default" href="{{route('runpart.show', $runpart->sponsoredRun->id) }}">Anzeigen</a></td>
						</tr>
						@endforeach
					</table>
					@if ( $runparts->isEmpty() )
					<p>Du hast noch keine Sponsorenläufe, an denen du teilnimmst.</p>
					@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
