<div class="form-group{{ $errors->has('donation_per_lap') ? ' has-error' : '' }}">
	<div class="col-md-4">
		{{ Form::label('donation_per_lap', 'Spende pro Runde ', [ 'class' => "control-label"]) }}
		<span role="button" class="glyphicon glyphicon-info-sign" data-toggle="modal" data-target="#calculation_dlg"></span>
	</div>
	<div class="col-md-6">
		{{ Form::number('donation_per_lap', null, [ 'class' => "form-control", 'min' => "0", 'step' => "0.01" ]) }}

		@if ($errors->has('donation_per_lap'))
		<span class="help-block">
			<strong>{{ $errors->first('donation_per_lap') }}</strong>
		</span>
		@endif
	</div>
</div>