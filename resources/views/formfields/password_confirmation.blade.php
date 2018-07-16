<div class="form-group">
	{{ Form::label('password_confirmation', 'Passwort bestätigen'.(isset($required) && $required ?' *':'')) }}

	<div>
		@if(isset($required) && $required)
		{{ Form::password('password_confirmation', [ 'class' => "form-control".($errors->has('password_confirmation') ? ' is-invalid' : '')]) }}
		@else
		{{ Form::password('password_confirmation', [ 'class' => "form-control".($errors->has('password_confirmation') ? ' is-invalid' : '')]) }}
		@endif

		@if ($errors->has('password_confirmation'))
		<div class="invalid-feedback">
			{{ $errors->first('password_confirmation') }}
		</div>
		@endif
	</div>
</div>