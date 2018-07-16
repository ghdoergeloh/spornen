@extends('layouts.app')
@section('title')
- Teilnahmen
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card mb-3">
			<div class="card-header">Meine Teilnahmen</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped" cellspacing="0">
						<thead>
        					<tr>
        						<th class="hidden-xs">Datum</th>
        						<th>Name</th>
        						<th class="hidden-xs hidden-sm">Gelaufene Runden</th>
        						<th>Sponsoren</th>
        					</tr>
    					</thead>
    					<tbody>
        					@foreach ($runparts as $runpart)
        					<tr>
        						<td class="hidden-xs">{{ $runpart->sponsoredRun->begin->format('d.m.Y') }}</td>
        						<td>{{ $runpart->sponsoredRun->name }}</td>
        						<td class="hidden-xs hidden-sm">{{ $runpart->laps }}</td>
        						<td class="action-cell">
        							<a class="btn btn-info"
        								href="{{route($root_route.'runpart.show', array_merge($root_route_params,[$runpart->id])) }}"
        								data-toggle="tooltip" title="Anzeigen">
        								<span class="fa fa-list-alt"/></a>
        							@if ( !$runpart->sponsoredRun->isElapsed() )
        							<a class="btn btn-success"
        								href="{{route($root_route.'runpart.edit', array_merge($root_route_params,[$runpart->id])) }}"
        								data-toggle="tooltip" title="Bearbeiten">
        								<span class="fa fa-pencil"/></a>
        							@endif
        					</tr>
        					@endforeach
    					</tbody>
    				</table>
				</div>
				@if ( $runparts->isEmpty() )
				<p>Du hast noch keine Sponsorenläufe, an denen du teilnimmst.</p>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection
