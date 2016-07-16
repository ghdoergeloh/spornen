@extends('layouts.app')
@section('title')
- Sponsoren
@endsection
@section('content')
<div class="container">
    <div class="row">
		<div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Meine Sponsoren</div>
                <div class="panel-body">
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
							<th></th>
						</tr>
						@foreach ($sponsors as $sponsor)
						<tr class="clickable-row" onclick="window.document.location = '{{route('runpart.sponsor.edit', [$run->id, $sponsor->id]) }}';">
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
							<td class="hidden-xs hidden-sm"><a class="btn btn-success" href="{{route('runpart.sponsor.edit', [$run->id, $sponsor->id]) }}"><span class="glyphicon glyphicon-pencil"/></a></td>
							<td>
								{{ Form::open(['method' => 'DELETE', 'route' => [ 'runpart.sponsor.destroy', $run->id , $sponsor->id ]]) }}
								{{ Form::button('', [ 'type' => "submit", 'class' => "btn btn-danger glyphicon glyphicon-trash"]) }}
								{{ Form::close() }}
							</td>
						</tr>
						@endforeach
					</table>
					<a class="btn btn-primary" href="{{route('runpart.sponsor.create', $run->id) }}">Hinzufügen</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Wie viel würde ich sammeln, wenn...</div>
                <div class="panel-body">
					{{ Form::open([
						'method' => 'GET',
						'route' => [ 'runpart.sponsor.calculate', $run->id ],
						'class' => 'form-inline '.($errors->has('laps') ? ' has-error' : '')]) }}
					<p>ich 
						{{ Form::number('laps', $laps, [ 'class' => "form-control", 'min' => "0", 'step' => "1", 'style' => "width: 60px"]) }}
						Runden laufen würde?
						<span role="button" class="glyphicon glyphicon-info-sign" data-toggle="modal" data-target="#calculation_dlg"></span>
					</p>
					<p>
						{{ Form::button('Ausrechnen', [ 'type' => "submit", 'class' => "btn btn-primary"]) }}
					</p>
					@if ($errors->has('laps'))
					<span class="help-block">
						<strong>{{ $errors->first('laps') }}</strong>
					</span>
					@endif
					{{ Form::close() }}
					@if(isset($sum))
					<hr>
					Du würdest <b>{{ number_format($sum,2) }} €</b> sammeln.
					@endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('sponsors.calculation_dlg')
@endsection
