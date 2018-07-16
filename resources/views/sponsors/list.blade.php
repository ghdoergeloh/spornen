<div class="card mb-3">
	<div class="card-header">Meine Sponsoren</div>
	<div class="card-body">
		@if ($edit)
		<a class="btn btn-primary" href="{{route($root_route.'sponsor.create', $root_route_params) }}">Neuen Sponsor Hinzufügen</a>
		<hr>
		@endif
		<div class="table-responsive">
		<table class="table table-striped table-hover table-condensed dataTable" cellspacing="0">
			<thead>
			<tr>
				<th>Nachname</th>
				<th>Vorname</th>
				<th class="hidden-xs hidden-sm">Straße, Nr.</th>
				<th class="hidden-xs hidden-sm">PLZ, Ort</th>
				<th class="visible-lg">Telefon</th>
				<th class="visible-lg">E-Mail</th>
				<th class="hidden-xs">Spende pro Runde</th>
				<th class="hidden-xs">Maximal- oder Festbetrag</th>
				@if ($edit)
				<th></th>
				@else
				<th class="hidden-xs hidden-sm"></th>
				@endif
			</tr>
			</thead>
			<tbody>
			@foreach ($runpart->sponsors as $sponsor)
			@if ($edit)
			<tr class="clickable-row" onclick="window.document.location = '{{route($root_route.'sponsor.edit', array_merge($root_route_params, [$sponsor->id])) }}';">
				@else
			<tr class="clickable-row" onclick="window.document.location = '{{route($root_route.'sponsor.show', array_merge($root_route_params, [$sponsor->id])) }}';">
				@endif
				<td>{{ $sponsor->lastname }}</td>
				<td>{{ $sponsor->firstname }}</td>
				<td class="hidden-xs hidden-sm">{{ $sponsor->street }} {{ $sponsor->housenumber }}</td>
				<td class="hidden-xs hidden-sm">{{ $sponsor->postcode }} {{ $sponsor->city }}</td>
				<td class="visible-lg">{{ $sponsor->phone }}</td>
				<td class="visible-lg">{{ $sponsor->email }}</td>
				<td class="hidden-xs text-right">{{ number_format($sponsor->donation_per_lap,2,',','.') }} €</td>
				<td class="hidden-xs text-right">{{ number_format($sponsor->donation_static_max,2,',','.') }} €</td>
				@if ($edit)
				<td class="action-cell">
					{{ Form::open([
						'method' => 'DELETE',
						'url' => route($root_route.'sponsor.destroy', array_merge($root_route_params, [$sponsor->id])) ]) }}
					<a class="btn btn-success hidden-xs hidden-sm"
					   href="{{route($root_route.'sponsor.edit', array_merge($root_route_params, [$sponsor->id])) }}"
					   data-toggle="tooltip" title="Bearbeiten">
						<span class="fa fa-pencil"/></a>
					{{ Form::button('<span class="fa fa-trash"></span>', [
						'type' => "submit",
						'class' => "btn btn-danger",
						'data-toggle' => "tooltip",
						'title' => "Löschen"
					]) }}
					{{ Form::close() }}
				</td>
				@else
				<td class="hidden-xs hidden-sm">
					<a class="btn btn-info"
					   href="{{route($root_route.'sponsor.show', array_merge($root_route_params, [$sponsor->id])) }}"
					   data-toggle="tooltip" title="Anzeigen">
						<span class="fa fa-list-alt"/></a>
				</td>
				@endif
			</tr>
			@endforeach
			</tbody>
		</table>
		</div>
	</div>
</div>
