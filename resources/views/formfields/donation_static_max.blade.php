<div class="form-group{{ $errors->has('donation_static_max') ? ' has-error' : '' }}">
	<div class="col-md-4">
		{{ Form::label('donation_static_max', 'Maximal- oder Festbetrag 	', [ 'class' => "control-label"]) }}
		<span role="button" class="glyphicon glyphicon-info-sign" data-toggle="modal" data-target="#calculation_dlg"></span>
	</div>
	<div class="col-md-6">
		{{ Form::number('donation_static_max', null, [ 'class' => "form-control", 'min' => "0", 'step' => "0.01" ]) }}

		@if ($errors->has('donation_static_max'))
		<span class="help-block">
			<strong>{{ $errors->first('donation_static_max') }}</strong>
		</span>
		@endif
	</div>
</div>