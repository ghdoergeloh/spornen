<div class="form-group{{ $errors->has('donation_per_lap') ? ' has-error' : '' }}">
	<span class="col-md-4 control-label">
		{{ Form::label('donation_per_lap', 'Spende pro Runde ') }}
		<span role="button" class="glyphicon glyphicon-info-sign" data-toggle="modal" data-target="#calculation_dlg"></span>
	</span>
	<div class="col-md-6">
		{{ Form::number('donation_per_lap', null, [ 'class' => "form-control", 'min' => "0", 'step' => "0.01" ]) }}

		@if ($errors->has('donation_per_lap'))
		<span class="help-block">
			<strong>{{ $errors->first('donation_per_lap') }}</strong>
		</span>
		@endif
	</div>
</div>