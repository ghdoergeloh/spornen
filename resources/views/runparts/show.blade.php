@extends('layouts.app')
@section('title')
- Teilnahme anzeigen
@endsection
@section('content')
<div class="container">
    <div class="row">
		<div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Daten</div>
                <div class="panel-body">
					<dl class="dl-horizontal">
						<dt>Anzahl der Sponsoren:</dt>
						<dd>{{ $runpart->sponsors->count() }}</dd>
					</dl>
					<dl class="dl-horizontal">
						<dt>Gewähltes Projekt:</dt>
						<dd>{{ $runpart->project->name }}</dd>
					</dl>
					<dl class="dl-horizontal">
						<dt>Gelaufene Runden:</dt>
						<dd>{{ $runpart->laps }}</dd>
					</dl>
					<dl class="dl-horizontal">
						<dt>Erlaufener Betrag:</dt>
						<dd>{{ number_format($runpart->calculateDonationSum(),2,',','.') }} €</dd>
					</dl>
                </div>
            </div>
			@include('sponsors.list', ['edit' => false, 'root_route' => $root_route.'runpart.'])
        </div>
    </div>
</div>
@include('sponsors.calculation_dlg')
@endsection