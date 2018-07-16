<div class="form-group">
	<span>
		{{ Form::label('donation_static_max', 'Maximal- oder Festbetrag'.(isset($required) && $required ?' *':'')) }}
		<span role="button" class="fa fa-info-circle" data-toggle="modal" data-target="#calculation_dlg"></span>
	</span>

	<div>
		@if(isset($required) && $required)
		{{ Form::number('donation_static_max', null, [ 'class' => "form-control".($errors->has('donation_static_max') ? ' is-invalid' : ''), 'min' => "0", 'step' => "0.01", 'required' => "required" ]) }}
		@else
		{{ Form::number('donation_static_max', null, [ 'class' => "form-control".($errors->has('donation_static_max') ? ' is-invalid' : ''), 'min' => "0", 'step' => "0.01" ]) }}
		@endif

		@if ($errors->has('donation_static_max'))
		<div class="invalid-feedback">
			{{ $errors->first('donation_static_max') }}
		</div>
		@endif
	</div>
</div>