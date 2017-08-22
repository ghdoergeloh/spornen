@extends('layouts.app')
@section('title')
- Sponsorenlauf anzeigen
@endsection
@section('content')
<div class="container">
    <div class="row">
		<div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Statistik</div>
                <div class="panel-body">
					<dl>
						<dt>Anzahl der Läufer:</dt>
						<dd>{{ $sponrun->participants_count }}</dd>
					</dl>
					@if ($sponrun->participants_count > 0 && $sponrun->totalLaps() > 0)
					<dl>
						<dt>Runden insgesamt:</dt>
						<dd>{{ $sponrun->totalLaps() }}</dd>
					</dl>
					<dl>
						<dt>Betrag insgesamt:</dt>
						<dd>{{ number_format($sponrun->totalDonationSum(),2,',','.') }} €</dd>
					</dl>
					<dl>
						<dt>Läufer mit meisten Runden ({{ $sponrun->participantionsMostLaps()[0]->laps }} Runden):</dt>
						@foreach ($sponrun->participantionsMostLaps() as $runpart)
						<dd>{{ $runpart->user->firstname }} {{ $runpart->user->lastname }}</dd>
						@endforeach
					</dl>
					<dl>
						<dt>Läufer mit meisten Sponsoren ({{ $sponrun->participantionsMostSponsors()[0]->sponsors->count() }} Sponsoren):</dt>
						@foreach ($sponrun->participantionsMostLaps() as $runpart)
						<dd>{{ $runpart->user->firstname }} {{ $runpart->user->lastname }}</dd>
						@endforeach
					</dl>
					<dl>
						<dt>Läufer mit größtem Betrag ({{ number_format($sponrun->participantionsHighestDonation()[0]->calculateDonationSum(),2,',','.') }} €):</dt>
						@foreach ($sponrun->participantionsHighestDonation() as $runpart)
						<dd>{{ $runpart->user->firstname }} {{ $runpart->user->lastname }}</dd>
						@endforeach
					</dl>
					<dl>
						<dt>Jüngster Läufer ({{ $sponrun->youngestParticipants()[0]->birthday->format('d.m.Y') }}):</dt>
						@foreach ($sponrun->youngestParticipants() as $participant)
						<dd>{{ $participant->firstname }} {{ $participant->lastname }}</dd>
						@endforeach
					</dl>
					<dl>
						<dt>Ältester Läufer ({{ $sponrun->oldestParticipants()[0]->birthday->format('d.m.Y') }}):</dt>
						@foreach ($sponrun->oldestParticipants() as $participant)
						<dd>{{ $participant->firstname }} {{ $participant->lastname }}</dd>
						@endforeach
					</dl>
					@endif
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
							<th class="hidden-xs">Straße, Nr.</th>
							<th class="hidden-xs">PLZ, Ort</th>
							<th class="visible-lg">Telefon</th>
							<th class="hidden-xs hidden-sm">E-Mail</th>
							<th class="hidden-xs">Runden</th>
							<th class="hidden-xs">Betrag</th>
							<th class="hidden-xs hidden-sm">Projekt</th>
							<th class="hidden-xs hidden-sm">Sponsoren</th>
							<th></th>
						</tr>
						@foreach ($sponrun->runParticipations as $runpart)
						<tr>
							<td>{{ $runpart->user->id }}</td>
							<td>{{ $runpart->user->lastname }}</td>
							<td>{{ $runpart->user->firstname }}</td>
							<td class="hidden-xs">{{ $runpart->user->street }} {{ $runpart->user->housenumber }}</td>
							<td class="hidden-xs">{{ $runpart->user->postcode }} {{ $runpart->user->city }}</td>
							<td class="visible-lg">{{ $runpart->user->phone }}</td>
							<td class="hidden-xs hidden-sm">{{ $runpart->user->email }}</td>
							<td class="text-right hidden-xs">{{ $runpart->laps }}</td>
							<td class="text-right hidden-xs">{{ number_format($runpart->calculateDonationSum(),2,',','.') }} €</td>
							<td class="text-right hidden-xs hidden-sm">{{ $runpart->project->name }}</td>
							<td class="text-right hidden-xs hidden-sm">{{ $runpart->sponsors->count() }}</td>
							<td>
								<a class="btn btn-success"
								   href="{{route($root_route.'sponrun.runpart.edit', array_merge($root_route_params,[$runpart->id])) }}"
								   data-toggle="tooltip" title="Bearbeiten">
									<span class="glyphicon glyphicon-pencil"/></a></td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection