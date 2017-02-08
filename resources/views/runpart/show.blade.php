@extends('layouts.app')
@section('title')
- Teilnahme
@endsection
@section('content')
<div class="container">
    <div class="row">
		<div class="col-md-12">
			@include('layouts.messages')
            <div class="panel panel-default">
                <div class="panel-heading">Daten</div>
                <div class="panel-body">
					<dl class="dl-horizontal">
						<dt>Anzahl der Sponsoren:</dt>
						<dd>{{ count($runpart->sponsors) }}</dd>
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
						<dd>{{ number_format($runpart->calculateSum(),2) }} €</dd>
					</dl>
                </div>
            </div>
			@include('sponsors.list', ['edit' => false])
        </div>
    </div>
</div>
@include('sponsors.calculation_dlg')
@endsection