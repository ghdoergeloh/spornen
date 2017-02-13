<div class="form-group{{ $errors->has('donation_static_max') ? ' has-error' : '' }}">
	<span class="col-md-4 control-label">
		{{ Form::label('donation_static_max', 'Maximal- oder Festbetrag'.(isset($required) && $required ?' *':'')) }}
		<span role="button" class="glyphicon glyphicon-info-sign" data-toggle="modal" data-target="#calculation_dlg"></span>
	</span>

	<div class="col-md-6">
		@if(isset($required) && $required)
		{{ Form::number('donation_static_max', null, [ 'class' => "form-control", 'min' => "0", 'step' => "0.01", 'required' => "required" ]) }}
		@else
		{{ Form::number('donation_static_max', null, [ 'class' => "form-control", 'min' => "0", 'step' => "0.01" ]) }}
		@endif

		@if ($errors->has('donation_static_max'))
		<span class="help-block">
			<strong>{{ $errors->first('donation_static_max') }}</strong>
		</span>
		@endif
	</div>
</div>