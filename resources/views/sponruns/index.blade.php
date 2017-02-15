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
					<a class="btn btn-primary" href="{{route($root_route.'sponrun.create') }}">Neuen Sponsorenlauf anlegen</a>
					<hr>
					<table class="table table-striped">
						<tr>
							<th>Name</th>
							<th class="hidden-xs">Beginn<br>Ende</th>
							<th class="hidden-xs hidden-sm">Straße, Nr.</th>
							<th class="hidden-xs hidden-sm">PLZ, Ort</th>
							<th></th>
						</tr>
						@foreach ($sponruns as $sponrun)
						<tr class="clickable-row">
							<td onclick="window.document.location = '{{route($root_route.'sponrun.show', [$sponrun->id]) }}';">{{ $sponrun->name }}</td>
							<td class="hidden-xs">{{ $sponrun->getBeginF() }}<br>{{ $sponrun->getEndF() }}</td>
							<td class="hidden-xs hidden-sm">{{ $sponrun->street }} {{ $sponrun->housenumber }}</td>
							<td class="hidden-xs hidden-sm">{{ $sponrun->postcode }} {{ $sponrun->city }}</td>
							<td>
								{{ Form::open([
									'method' => 'DELETE',
									'url' => route($root_route.'sponrun.destroy', array_merge($root_route_params, [$sponrun->id])),
									'class' => 'form-inline'
								]) }}
								<a class="btn btn-info hidden-xs hidden-sm"
								   href="{{route($root_route.'sponrun.show', [$sponrun->id]) }}"
								   data-toggle="tooltip" title="Anzeigen">
									<span class="glyphicon glyphicon-list-alt"/></a>
								<a class="btn btn-success"
								   href="{{route($root_route.'sponrun.edit', [$sponrun]) }}"
								   data-toggle="tooltip" title="Bearbeiten">
									<span class="glyphicon glyphicon-pencil"/></a>
								<a class="btn btn-warning"
								   href="{{route($root_route.'sponrun.evaluation', [$sponrun]) }}"
								   data-toggle="tooltip" title="Auswertung ">
									<span class="glyphicon glyphicon-download-alt"/></a>
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
