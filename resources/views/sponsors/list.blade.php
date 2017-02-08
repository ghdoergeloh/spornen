<div class="panel panel-default">
	<div class="panel-heading">Meine Sponsoren</div>
	<div class="panel-body">
		@if ($edit)
		<a class="btn btn-primary" href="{{route('runpart.sponsor.create', $runpart->sponsoredRun->id) }}">Neuen Sponsor Hinzufügen</a>
		<hr>
		@endif
		<table class="table table-striped table-hover table-condensed">
			<tr>
				<th>Nachname</th>
				<th>Vorname</th>
				<th class="hidden-xs hidden-sm">Straße</th>
				<th class="hidden-xs hidden-sm">Nr.</th>
				<th class="hidden-xs hidden-sm">PLZ</th>
				<th class="hidden-xs hidden-sm">Ort</th>
				<th class="hidden-xs hidden-sm">Telefon</th>
				<th class="hidden-xs">E-Mail</th>
				<th class="hidden-xs">Spende pro Runde</th>
				<th class="hidden-xs">Maximal- oder Festbetrag</th>
				<th class="hidden-xs hidden-sm"></th>
				@if ($edit)
				<th></th>
				@endif
			</tr>
			@foreach ($runpart->sponsors as $sponsor)
			@if ($edit)
			<tr class="clickable-row" onclick="window.document.location = '{{route('runpart.sponsor.edit', [$runpart->sponsoredRun->id, $sponsor->id]) }}';">
				@else
			<tr class="clickable-row" onclick="window.document.location = '{{route('runpart.sponsor.show', [$runpart->sponsoredRun->id, $sponsor->id]) }}';">
				@endif
				<td>{{ $sponsor->lastname }}</td>
				<td>{{ $sponsor->firstname }}</td>
				<td class="hidden-xs hidden-sm">{{ $sponsor->street }}</td>
				<td class="hidden-xs hidden-sm">{{ $sponsor->housenumber }}</td>
				<td class="hidden-xs hidden-sm">{{ $sponsor->postcode }}</td>
				<td class="hidden-xs hidden-sm">{{ $sponsor->city }}</td>
				<td class="hidden-xs hidden-sm">{{ $sponsor->phone }}</td>
				<td class="hidden-xs">{{ $sponsor->email }}</td>
				<td class="hidden-xs text-right">{{ $sponsor->donation_per_lap }} €</td>
				<td class="hidden-xs text-right">{{ $sponsor->donation_static_max }} €</td>
				@if ($edit)
				<td class="hidden-xs hidden-sm">
					<a class="btn btn-success"
					   href="{{route('runpart.sponsor.edit', [$runpart->sponsoredRun->id, $sponsor->id]) }}"
					   data-toggle="tooltip" title="Bearbeiten">
						<span class="glyphicon glyphicon-pencil"/></a></td>
				<td>
					{{ Form::open(['method' => 'DELETE', 'route' => [ 'runpart.sponsor.destroy', $runpart->sponsoredRun->id , $sponsor->id ]]) }}
					{{ Form::button('', [
						'type' => "submit",
						'class' => "btn btn-danger glyphicon glyphicon-trash",
						'data-toggle' => "tooltip",
						'title' => "Löschen"
					]) }}
					{{ Form::close() }}
				</td>
				@else
				<td class="hidden-xs hidden-sm">
					<a class="btn btn-info"
					   href="{{route('runpart.sponsor.show', [$runpart->sponsoredRun->id, $sponsor->id]) }}"
					   data-toggle="tooltip" title="Anzeigen">
						<span class="glyphicon glyphicon-list-alt"/></a></td>
				@endif
			</tr>
			@endforeach
		</table>
	</div>
</div>
