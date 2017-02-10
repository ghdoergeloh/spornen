@extends('layouts.app')
@section('title')
- Sponsorenläufe
@endsection
@section('content')
<div class="container">
    <div class="row">
		<div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Sponsorenläufe</div>
                <div class="panel-body">
					<a class="btn btn-primary" href="{{route('sponrun.create') }}">Neuen Sponsorenlauf anlegen</a>
					<hr>
					<table class="table table-striped">
						<tr>
							<th>Name</th>
							<th>Beginn</th>
							<th>Ende</th>
							<th class="hidden-xs hidden-sm">Straße, Nr.</th>
							<th class="hidden-xs hidden-sm">PLZ, Ort</th>
							<th class="hidden-xs hidden-sm"></th>
							<th></th>
							<th></th>
						</tr>
						@foreach ($sponruns as $sponrun)
						<tr class="clickable-row" onclick="window.document.location = '{{route('sponrun.show', [$sponrun->id]) }}';">
							<td>{{ $sponrun->name }}</td>
							<td>{{ $sponrun->getBeginF() }}</td>
							<td>{{ $sponrun->getEndF() }}</td>
							<td class="hidden-xs hidden-sm">{{ $sponrun->street }} {{ $sponrun->housenumber }}</td>
							<td class="hidden-xs hidden-sm">{{ $sponrun->postcode }} {{ $sponrun->city }}</td>
							<td class="hidden-xs hidden-sm">
								<a class="btn btn-info"
								   href="{{route('sponrun.show', [$sponrun->id]) }}"
								   data-toggle="tooltip" title="Anzeigen">
									<span class="glyphicon glyphicon-list-alt"/></a></td>
							<td>
								<a class="btn btn-success"
								   href="{{route('sponrun.edit', [$sponrun]) }}"
								   data-toggle="tooltip" title="Bearbeiten">
									<span class="glyphicon glyphicon-pencil"/></a></td>
							<td>
								{{ Form::open(['method' => 'DELETE', 'route' => [ 'sponrun.destroy', $sponrun->id ]]) }}
								{{ Form::button('', [
									'type' => "submit",
									'class' => "btn btn-danger glyphicon glyphicon-trash",
									'data-toggle' => "tooltip",
									'title' => "Löschen"
								]) }}
								{{ Form::close() }}
							</td>
						</tr>
						@endforeach
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
