@extends('layouts.app')
@section('title')
- Sponsorenläufe
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card mb-3">
			<div class="card-header">Sponsorenläufe</div>
			<div class="card-body">
				<a class="btn btn-primary" href="{{route($root_route.'sponrun.create') }}">Neuen Sponsorenlauf anlegen</a>
				<hr>
				<div class="table-responsive">
					<table class="table table-striped" cellspacing="0">
						<thead>
							<tr>
								<th>Name</th>
								<th class="d-none d-sm-table-cell">Beginn<br>Ende</th>
								<th class="d-none d-md-table-cell">Straße, Nr.</th>
								<th class="d-none d-md-table-cell">PLZ, Ort</th>
    							<th class="d-none d-lg-table-cell">Teilnehmer</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($sponruns as $sponrun)
							<tr class="clickable-row">
								<td onclick="window.document.location = '{{route($root_route.'sponrun.show', [$sponrun->id]) }}';">{{ $sponrun->name }}</td>
								<td class="d-none d-sm-table-cell">{{ $sponrun->getBeginF() }}<br>{{ $sponrun->getEndF() }}</td>
								<td class="d-none d-md-table-cell">{{ $sponrun->street }} {{ $sponrun->housenumber }}</td>
								<td class="d-none d-md-table-cell">{{ $sponrun->postcode }} {{ $sponrun->city }}</td>
    							<td class="d-none d-lg-table-cell">{{ $sponrun->participants_count }}</td>
								<td class="action-cell">
									<a class="btn btn-info"
									   href="{{route($root_route.'sponrun.show', [$sponrun->id]) }}"
									   data-toggle="tooltip" title="Anzeigen">
										<span class="fa fa-list"/></a>
									<a class="btn btn-success"
									   href="{{route($root_route.'sponrun.edit', [$sponrun]) }}"
									   data-toggle="tooltip" title="Bearbeiten">
										<span class="fa fa-pencil"/></a>
									<a class="btn btn-warning"
									   href="{{route($root_route.'sponrun.evaluation', [$sponrun]) }}"
									   data-toggle="tooltip" title="Auswertung ">
										<span class="fa fa-download"/></a>
									@if ($sponrun->isElapsed())
									<a class="btn btn-warning"
									   href=""
									   data-toggle="tooltip" title="Wieder freigeben "
									   onclick="event.preventDefault();
												   $('#reopen-run-form{!! $sponrun->id !!}').submit();">
										<span class="fa fa-play"/></a>
									@else
									<a class="btn btn-warning"
									   href=""
									   data-toggle="tooltip" title="Sperren "
									   onclick="event.preventDefault();
											   $('#close-run-form{!! $sponrun->id !!}').submit();">
										<span class="fa fa-stop"/></a>
									@endif
									<a class="btn btn-danger"
									   href=""
									   data-toggle="tooltip" title="Löschen "
									   onclick="event.preventDefault();
											   if (confirm('Der Sponsorenlauf wird mit allen dazugehörigen Daten gelöscht.')) {
												   $('#delete-run-form{!! $sponrun->id !!}').submit();
											   }">
										<span class="fa fa-trash"/></a>
									@if ($sponrun->isElapsed())
									{{ Form::open([
											'method' => 'POST',
											'url' => route($root_route.'sponrun.reopen', array_merge($root_route_params, [$sponrun->id])),
											'class' => "hidden",
											'id' => 'reopen-run-form'.$sponrun->id
										]) }}
									{{ Form::close() }}
									@else
									{{ Form::open([
											'method' => 'POST',
											'url' => route($root_route.'sponrun.close', array_merge($root_route_params, [$sponrun->id])),
											'class' => "hidden",
											'id' => 'close-run-form'.$sponrun->id
										]) }}
									{{ Form::close() }}
									@endif
									{{ Form::open([
										'method' => 'DELETE',
										'url' => route($root_route.'sponrun.destroy', array_merge($root_route_params, [$sponrun->id])),
										'class' => "hidden",
										'id' => 'delete-run-form'.$sponrun->id
									]) }}
									{{ Form::close() }}
								</td>
							</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
