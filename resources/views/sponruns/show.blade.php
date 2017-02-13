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
						<dd>{{ $sponrun->participants_count }}</dd>
					</dl>
					@if ($sponrun->participants_count > 0 && $sponrun->totalLaps() > 0)
					<dl>
						<dt>Runden insgesamt:</dt>
						<dd>{{ $sponrun->totalLaps() }}</dd>
					</dl>
					<dl>
						<dt>Betrag insgesamt:</dt>
						<dd>{{ $sponrun->totalDonationSum() }} €</dd>
					</dl>
					<dl>
						<dt>Läufer mit meisten Runden ({{ $sponrun->participantionsMostLaps()[0]->laps }}):</dt>
						@foreach ($sponrun->participantionsMostLaps() as $runpart)
						<dd>{{ $runpart->user->firstname }} {{ $runpart->user->lastname }}</dd>
						@endforeach
					</dl>
					<dl>
						<dt>Läufer mit meisten Sponsoren ({{ $sponrun->participantionsMostSponsors()[0]->sponsors->count() }}):</dt>
						@foreach ($sponrun->participantionsMostLaps() as $runpart)
						<dd>{{ $runpart->user->firstname }} {{ $runpart->user->lastname }}</dd>
						@endforeach
					</dl>
					<dl>
						<dt>Läufer mit größtem Betrag ({{ $sponrun->participantionsHighestDonation()[0]->calculateDonationSum() }} €):</dt>
						@foreach ($sponrun->participantionsHighestDonation() as $runpart)
						<dd>{{ $runpart->user->firstname }} {{ $runpart->user->lastname }}</dd>
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
							<th class="hidden-xs hidden-sm">Straße, Nr.</th>
							<th class="hidden-xs hidden-sm">PLZ, Ort</th>
							<th class="hidden-xs hidden-sm">Telefon</th>
							<th class="hidden-xs">E-Mail</th>
							<th class="hidden-xs">Runden</th>
							<th class="hidden-xs">Betrag</th>
							<th class="hidden-xs hidden-sm">Sponsoren</th>
						</tr>
						@foreach ($sponrun->runParticipations as $runpart)
						<tr>
							<td>{{ $runpart->user->id }}</td>
							<td>{{ $runpart->user->lastname }}</td>
							<td>{{ $runpart->user->firstname }}</td>
							<td class="hidden-xs hidden-sm">{{ $runpart->user->street }} {{ $runpart->user->housenumber }}</td>
							<td class="hidden-xs hidden-sm">{{ $runpart->user->postcode }} {{ $runpart->user->city }}</td>
							<td class="hidden-xs hidden-sm">{{ $runpart->user->phone }}</td>
							<td class="hidden-xs">{{ $runpart->user->email }}</td>
							<td>{{ $runpart->laps }}</td>
							<td>{{ $runpart->calculateDonationSum() }} €</td>
							<td>{{ $runpart->sponsors()->count() }}</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection