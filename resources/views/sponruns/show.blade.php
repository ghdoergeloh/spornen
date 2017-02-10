@extends('layouts.app')
@section('title')
- Sponsorenlauf anzeigen
@endsection
@section('content')
<div class="container">
    <div class="row">
		<div class="col-md-12">
			@include('layouts.messages')
            <div class="panel panel-default">
                <div class="panel-heading">Statistik</div>
                <div class="panel-body">
					<dl>
						<dt>Anzahl der Läufer:</dt>
						<dd>{{ $sponrun->runParticipations->count() }}</dd>
					</dl>
					<dl>
						<dt>Runden insgesamt:</dt>
						<dd>8640</dd>
					</dl>
					<dl>
						<dt>Betrag insgesamt:</dt>
						<dd>0.00 €</dd>
					</dl>
					<dl>
						<dt>Läufer mit meisten Runden (35):</dt>
						<dd>Fritz Peter Vonundzu, Karl Otto</dd>
					</dl>
					<dl>
						<dt>Läufer mit meisten Sponsoren (69):</dt>
						<dd>Hanelore Eckard</dd>
					</dl>
					<dl>
						<dt>Läufer mit größtem Betrag (3.536,50 €):</dt>
						<dd>Artur Peters</dd>
					</dl>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">Läufer</div>
				<div class="panel-body">
					<table class="table table-striped table-hover table-condensed">
						<tr>
							<th>Nr.</th>
							<th>Nachname</th>
							<th>Vorname</th>
							<th class="hidden-xs hidden-sm">Straße, Nr.</th>
							<th class="hidden-xs hidden-sm">PLZ, Ort</th>
							<th class="hidden-xs hidden-sm">Telefon</th>
							<th class="hidden-xs">E-Mail</th>
							<th class="hidden-xs">Runden</th>
							<th class="hidden-xs">Betrag</th>
							<th class="hidden-xs hidden-sm">Sponsoren</th>
						</tr>
						@foreach ($sponrun->runParticipations as $runParticipation)
						<tr>
							<td>{{ $runParticipation->user->id }}</td>
							<td>{{ $runParticipation->user->lastname }}</td>
							<td>{{ $runParticipation->user->firstname }}</td>
							<td class="hidden-xs hidden-sm">{{ $runParticipation->user->street }} {{ $runParticipation->user->housenumber }}</td>
							<td class="hidden-xs hidden-sm">{{ $runParticipation->user->postcode }} {{ $runParticipation->user->city }}</td>
							<td class="hidden-xs hidden-sm">{{ $runParticipation->user->phone }}</td>
							<td class="hidden-xs">{{ $runParticipation->user->email }}</td>
							<td>{{ $runParticipation->laps }}</td>
							<td>{{ $runParticipation->calculateSum() }} €</td>
							<td>{{ $runParticipation->sponsors()->count() }}</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection