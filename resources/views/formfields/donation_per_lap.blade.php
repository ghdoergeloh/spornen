<div class="form-group">
	<span>
		{{ Form::label('donation_per_lap', 'Spende pro Runde'.(isset($required) && $required ?' *':'')) }}
		<span role="button" class="fa fa-info-circle" data-toggle="modal" data-target="#calculation_dlg"></span>
	</span>

	<div>
		@if(isset($required) && $required)
		{{ Form::number('donation_per_lap', null, [ 'class' => "form-control".($errors->has('donation_per_lap') ? ' is-invalid' : ''), 'min' => "0", 'step' => "0.01", 'required' => "required"]) }}
		@else
		{{ Form::number('donation_per_lap', null, [ 'class' => "form-control".($errors->has('donation_per_lap') ? ' is-invalid' : ''), 'min' => "0", 'step' => "0.01" ]) }}
		@endif

		@if ($errors->has('donation_per_lap'))
		<div class="invalid-feedback">
			{{ $errors->first('donation_per_lap') }}
		</div>
		@endif
	</div>
</div>