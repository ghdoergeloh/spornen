<div class="col-md-4">
	<div class="card mb-3">
		<div class="card-header">Wie viel würde ich sammeln, wenn...</div>
		<div class="card-body">
			{{ Form::open([
				'method' => 'GET',
				'url' => route($root_route.'runpart.calculate', array_merge($root_route_params, [$runpart->id])),
				'class' => ''.($errors->has('laps') ? ' is-invalid' : '')]) }}
			<div class="form-inline">
			<p>ich 
				{{ Form::number('laps', $laps, [ 'class' => "form-control", 'min' => "0", 'step' => "1", 'style' => "width: 60px"]) }}
				Runden laufen würde?
				<span role="button" class="fa fa-info-circle" data-toggle="modal" data-target="#calculation_dlg"></span>
			</p>
			</div>
			<p>
				{{ Form::submit('Ausrechnen', [ 'class' => "btn btn-primary"]) }}
			</p>
			@if ($errors->has('laps'))
			<div class="invalid-feedback">
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