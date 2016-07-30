@extends('layouts.app')
@section('title')
- Teilnahme
@endsection
@section('content')
<div class="container">
    <div class="row">
		<div class="col-md-12">
			@include('layouts.messages')
			@include('sponsors.list')
            <div class="panel panel-default">
                <div class="panel-heading">Dieses Projekt will ich unterstützen</div>
                <div class="panel-body">
					{{ Form::open([
						'method' => 'PATCH',
						'route' => [ 'runpart.update', $run->id ],
						'class' => 'form-inline '.($errors->has('project') ? ' has-error' : '')]) }}
					{{ Form::select('project', $projects, $runpart->project->id, [ 'class' => "form-control" ]) }}
					{{ Form::submit('Speichern', [ 'class' => "btn btn-primary"]) }}
					{{ Form::close() }}
				</div>
			</div>
            <div class="panel panel-default">
                <div class="panel-heading">Wie viel würde ich sammeln, wenn...</div>
                <div class="panel-body">
					{{ Form::open([
						'method' => 'GET',
						'route' => [ 'runpart.calculate', $run->id ],
						'class' => 'form-inline '.($errors->has('laps') ? ' has-error' : '')]) }}
					<p>ich 
						{{ Form::number('laps', $laps, [ 'class' => "form-control", 'min' => "0", 'step' => "1", 'style' => "width: 60px"]) }}
						Runden laufen würde?
						<span role="button" class="glyphicon glyphicon-info-sign" data-toggle="modal" data-target="#calculation_dlg"></span>
					</p>
					<p>
						{{ Form::submit('Ausrechnen', [ 'class' => "btn btn-primary"]) }}
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